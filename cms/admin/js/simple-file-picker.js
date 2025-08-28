/**
 * Simple File Picker using Dropzone.js
 * Much more reliable than custom implementation
 */

class SimpleFilePicker {
    constructor() {
        this.modal = null;
        this.dropzoneInstance = null;
        this.currentCallback = null;
        this.currentUploadPath = null;
        this.browsedFiles = [];
        
        this.init();
    }
    
    init() {
        console.log('SimpleFilePicker: Initializing...');
        
        // Create modal HTML
        const modalHtml = `
            <div id="simple-file-picker-modal" class="file-picker-modal" style="display: none;">
                <div class="file-picker-overlay"></div>
                <div class="file-picker-content">
                    <div class="file-picker-header">
                        <h3>Choose or Upload Image</h3>
                        <button class="file-picker-close">&times;</button>
                    </div>
                    <div class="file-picker-tabs">
                        <button class="file-picker-tab active" data-tab="browse">Browse Existing</button>
                        <button class="file-picker-tab" data-tab="upload">Upload New</button>
                    </div>
                    <div class="file-picker-body">
                        <div id="browse-panel" class="file-picker-panel active">
                            <div class="file-picker-filter">
                                <input type="text" id="file-search" placeholder="Search files..." />
                            </div>
                            <div class="browse-grid" id="browse-grid">
                                <div class="loading">Loading files...</div>
                            </div>
                        </div>
                        <div id="upload-panel" class="file-picker-panel">
                            <div id="dropzone-area" class="dropzone">
                                <div class="dz-message">
                                    <span class="dz-message-text">Drop files here or click to upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="file-picker-footer">
                        <div class="file-picker-selection">
                            <span id="selected-file-info">No file selected</span>
                        </div>
                        <div class="file-picker-buttons">
                            <button id="file-picker-cancel" class="btn btn-secondary">Cancel</button>
                            <button id="file-picker-select" class="btn btn-primary" disabled>Select</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to page
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        this.modal = document.getElementById('simple-file-picker-modal');
        
        this.bindEvents();
        console.log('SimpleFilePicker: Initialized successfully');
    }
    
    bindEvents() {
        const modal = this.modal;
        
        // Close modal events
        modal.querySelector('.file-picker-close').addEventListener('click', () => this.close());
        modal.querySelector('.file-picker-overlay').addEventListener('click', () => this.close());
        modal.querySelector('#file-picker-cancel').addEventListener('click', () => this.close());
        
        // Tab switching
        modal.querySelectorAll('.file-picker-tab').forEach(tab => {
            tab.addEventListener('click', (e) => this.switchTab(e.target.dataset.tab));
        });
        
        // File selection
        modal.querySelector('#file-picker-select').addEventListener('click', () => this.selectFile());
        
        // Search
        modal.querySelector('#file-search').addEventListener('input', (e) => this.filterFiles(e.target.value));
        
        // ESC key to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.modal.style.display !== 'none') {
                this.close();
            }
        });
    }
    
    open(uploadPath, callback) {
        console.log('SimpleFilePicker: Opening modal for path:', uploadPath);
        
        this.currentCallback = callback;
        this.currentUploadPath = uploadPath || 'images';
        
        this.modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Reset state
        this.clearSelection();
        this.switchTab('browse');
        
        // Load existing files
        this.loadFiles();
        
        // Initialize Dropzone for upload tab
        this.initDropzone();
    }
    
    close() {
        this.modal.style.display = 'none';
        document.body.style.overflow = '';
        this.currentCallback = null;
        this.currentUploadPath = null;
        this.clearSelection();
        
        // Destroy dropzone instance
        if (this.dropzoneInstance) {
            this.dropzoneInstance.destroy();
            this.dropzoneInstance = null;
        }
    }
    
    switchTab(tab) {
        console.log('SimpleFilePicker: Switching to tab:', tab);
        
        // Update tab buttons
        this.modal.querySelectorAll('.file-picker-tab').forEach(t => t.classList.remove('active'));
        this.modal.querySelector(`[data-tab="${tab}"]`).classList.add('active');
        
        // Update panels
        this.modal.querySelectorAll('.file-picker-panel').forEach(p => p.classList.remove('active'));
        this.modal.querySelector(`#${tab}-panel`).classList.add('active');
        
        if (tab === 'upload' && !this.dropzoneInstance) {
            this.initDropzone();
        }
    }
    
    async loadFiles() {
        const grid = this.modal.querySelector('#browse-grid');
        grid.innerHTML = '<div class="loading">Loading files...</div>';
        
        try {
            const response = await fetch('file_manager_standalone.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=list&path=${encodeURIComponent(this.currentUploadPath)}`
            });
            
            const text = await response.text();
            console.log('SimpleFilePicker: Raw response:', text.substring(0, 200));
            
            const data = JSON.parse(text);
            
            if (data.success) {
                console.log('SimpleFilePicker: Found', data.files.length, 'files');
                this.browsedFiles = data.files;
                this.renderFiles(data.files);
            } else {
                grid.innerHTML = `<div class="error">Error: ${data.error}</div>`;
            }
        } catch (error) {
            console.error('SimpleFilePicker: Error loading files:', error);
            grid.innerHTML = `<div class="error">Error loading files: ${error.message}</div>`;
        }
    }
    
    renderFiles(files) {
        const grid = this.modal.querySelector('#browse-grid');
        
        if (files.length === 0) {
            grid.innerHTML = '<div class="empty">No files found</div>';
            return;
        }
        
        const fileHtml = files.map(file => `
            <div class="file-item" data-path="${file.path}" data-name="${file.name}">
                <img src="${file.path}" alt="${file.name}" loading="lazy" />
                <div class="file-info">
                    <div class="file-name">${file.name}</div>
                    <div class="file-size">${file.size}</div>
                </div>
            </div>
        `).join('');
        
        grid.innerHTML = fileHtml;
        
        // Bind click events
        grid.querySelectorAll('.file-item').forEach(item => {
            item.addEventListener('click', () => this.selectFileItem(item));
        });
    }
    
    initDropzone() {
        if (this.dropzoneInstance) return;
        
        const dropzoneElement = this.modal.querySelector('#dropzone-area');
        
        this.dropzoneInstance = new Dropzone(dropzoneElement, {
            url: 'file_manager_standalone.php',
            paramName: 'file',
            maxFilesize: 10, // MB
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            dictDefaultMessage: 'Drop files here or click to upload',
            
            init: function() {
                const picker = this;
                this.on('sending', function(file, xhr, formData) {
                    formData.append('action', 'upload');
                    formData.append('path', picker.currentUploadPath || 'images');
                });
                
                this.on('success', function(file, response) {
                    console.log('Upload successful:', response);
                    // Reload the browse tab
                    picker.loadFiles();
                    // Auto-select the uploaded file
                    setTimeout(() => {
                        if (response.success && picker.currentCallback) {
                            picker.currentCallback(response.path);
                            picker.close();
                        }
                    }, 500);
                });
                
                this.on('error', function(file, errorMessage) {
                    console.error('Upload error:', errorMessage);
                    alert('Upload failed: ' + (errorMessage.error || errorMessage));
                });
            }.bind(this)
        });
    }
    
    selectFileItem(item) {
        // Clear previous selections
        this.modal.querySelectorAll('.file-item').forEach(i => i.classList.remove('selected'));
        
        // Select clicked item
        item.classList.add('selected');
        
        const filename = item.dataset.name;
        const path = item.dataset.path;
        
        this.modal.querySelector('#selected-file-info').textContent = filename;
        this.modal.querySelector('#file-picker-select').disabled = false;
        this.modal.querySelector('#file-picker-select').dataset.selectedPath = path;
    }
    
    clearSelection() {
        this.modal.querySelectorAll('.file-item').forEach(i => i.classList.remove('selected'));
        this.modal.querySelector('#selected-file-info').textContent = 'No file selected';
        this.modal.querySelector('#file-picker-select').disabled = true;
        this.modal.querySelector('#file-picker-select').dataset.selectedPath = '';
    }
    
    selectFile() {
        const selectedPath = this.modal.querySelector('#file-picker-select').dataset.selectedPath;
        
        if (selectedPath && this.currentCallback) {
            this.currentCallback(selectedPath);
            this.close();
        }
    }
    
    filterFiles(query) {
        const filteredFiles = this.browsedFiles.filter(file => 
            file.name.toLowerCase().includes(query.toLowerCase())
        );
        this.renderFiles(filteredFiles);
    }
}

// Initialize global instance
let simpleFilePicker = null;

document.addEventListener('DOMContentLoaded', () => {
    console.log('SimpleFilePicker: DOM loaded, initializing...');
    try {
        simpleFilePicker = new SimpleFilePicker();
        console.log('SimpleFilePicker: Created successfully');
    } catch (error) {
        console.error('SimpleFilePicker: Error creating:', error);
    }
});

// Global function to open file picker
function openSimpleFilePicker(uploadPath, callback) {
    console.log('openSimpleFilePicker called with path:', uploadPath);
    if (simpleFilePicker) {
        simpleFilePicker.open(uploadPath, callback);
    } else {
        console.error('SimpleFilePicker: Not initialized yet');
        alert('File picker is loading. Please try again in a moment.');
    }
}

// Initialize file picker buttons
function initSimpleFilePickerButtons() {
    console.log('SimpleFilePicker: Initializing buttons...');
    const buttons = document.querySelectorAll('[data-simple-file-picker]');
    console.log('SimpleFilePicker: Found', buttons.length, 'buttons');
    
    buttons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            console.log('SimpleFilePicker: Button clicked!', button);
            
            const uploadPath = button.dataset.uploadPath || 'images';
            const targetInput = button.dataset.target;
            
            openSimpleFilePicker(uploadPath, (selectedPath) => {
                console.log('File selected:', selectedPath);
                
                if (targetInput) {
                    const input = document.querySelector(targetInput);
                    if (input) {
                        input.value = selectedPath;
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                }
                
                // Update preview if exists
                const previewId = button.dataset.preview;
                if (previewId) {
                    const preview = document.querySelector(previewId);
                    if (preview) {
                        preview.src = selectedPath;
                        preview.style.display = 'block';
                    }
                }
            });
        });
    });
}

// Auto-initialize on DOM ready
document.addEventListener('DOMContentLoaded', initSimpleFilePickerButtons);