/**
 * Professional File Picker using Fancybox 5 + Dropzone.js
 * Reliable, proven libraries for a bulletproof solution
 */

class FancyboxFilePicker {
    constructor() {
        this.currentCallback = null;
        this.currentUploadPath = null;
        this.dropzoneInstance = null;
        this.browsedFiles = [];
        this.fancyboxInstance = null;
        
        this.init();
    }
    
    init() {
        console.log('FancyboxFilePicker: Initializing...');
        
        // Create the modal HTML structure
        const modalHtml = `
            <div id="fancybox-file-picker" style="display: none;">
                <div class="fancybox-file-picker-container">
                    <div class="file-picker-header">
                        <h3>🖼️ Choose or Upload Image</h3>
                        <p>Select from existing files or upload new ones</p>
                    </div>
                    
                    <div class="file-picker-tabs">
                        <button class="file-picker-tab active" data-tab="browse">
                            📁 Browse Existing
                        </button>
                        <button class="file-picker-tab" data-tab="upload">
                            ⬆️ Upload New
                        </button>
                    </div>
                    
                    <div class="file-picker-content">
                        <div id="browse-panel" class="file-picker-panel active">
                            <div class="file-picker-search">
                                <input type="text" id="file-search" placeholder="🔍 Search files..." />
                            </div>
                            <div class="browse-gallery" id="browse-gallery">
                                <div class="loading">
                                    <div class="spinner"></div>
                                    <p>Loading files...</p>
                                </div>
                            </div>
                        </div>
                        
                        <div id="upload-panel" class="file-picker-panel">
                            <div id="dropzone-area" class="dropzone-custom">
                                <div class="dropzone-message">
                                    <div class="dropzone-icon">📤</div>
                                    <h4>Drop files here or click to upload</h4>
                                    <p>Supports: JPG, PNG, GIF up to 10MB</p>
                                    <button type="button" class="btn btn-primary">Choose Files</button>
                                </div>
                            </div>
                            <div id="upload-progress" class="upload-progress" style="display: none;"></div>
                        </div>
                    </div>
                    
                    <div class="file-picker-footer">
                        <div class="selection-info">
                            <span id="selected-file-name">No file selected</span>
                        </div>
                        <div class="action-buttons">
                            <button id="cancel-btn" class="btn btn-secondary">Cancel</button>
                            <button id="select-btn" class="btn btn-primary" disabled>Select File</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to page
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        
        this.bindEvents();
        console.log('FancyboxFilePicker: Initialized successfully');
    }
    
    bindEvents() {
        const modal = document.getElementById('fancybox-file-picker');
        
        // Tab switching
        modal.querySelectorAll('.file-picker-tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                this.switchTab(e.target.dataset.tab);
            });
        });
        
        // Cancel and Select buttons
        modal.querySelector('#cancel-btn').addEventListener('click', () => this.close());
        modal.querySelector('#select-btn').addEventListener('click', () => this.selectFile());
        
        // Search functionality
        modal.querySelector('#file-search').addEventListener('input', (e) => {
            this.filterFiles(e.target.value);
        });
        
        // ESC key to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.fancyboxInstance) {
                this.close();
            }
        });
    }
    
    open(uploadPath, callback) {
        console.log('FancyboxFilePicker: Opening for path:', uploadPath);
        
        this.currentCallback = callback;
        this.currentUploadPath = uploadPath || 'images';
        
        // Show the modal element first
        const modalElement = document.getElementById('fancybox-file-picker');
        modalElement.style.display = 'block';
        
        // Open with Fancybox
        this.fancyboxInstance = new Fancybox([
            {
                src: '#fancybox-file-picker',
                type: 'inline',
                width: '90%',
                height: '85%'
            }
        ], {
            dragToClose: false,
            closeButton: 'top',
            mainClass: 'fancybox-file-picker-modal',
            trapFocus: true,
            autoFocus: true,
            placeFocusBack: false,
            animated: true,
            showClass: 'fancybox-zoomInUp',
            hideClass: 'fancybox-zoomOutDown',
            on: {
                destroy: () => {
                    this.cleanup();
                    // Hide the modal element
                    modalElement.style.display = 'none';
                }
            }
        });
        
        // Load files and initialize upload
        setTimeout(() => {
            this.loadFiles();
            this.initDropzone();
            
            // Reset state
            this.clearSelection();
            this.switchTab('browse');
        }, 100);
    }
    
    close() {
        if (this.fancyboxInstance) {
            this.fancyboxInstance.destroy();
            this.fancyboxInstance = null;
        }
    }
    
    cleanup() {
        this.currentCallback = null;
        this.currentUploadPath = null;
        this.clearSelection();
        
        // Destroy dropzone
        if (this.dropzoneInstance) {
            this.dropzoneInstance.destroy();
            this.dropzoneInstance = null;
        }
    }
    
    switchTab(tab) {
        console.log('FancyboxFilePicker: Switching to tab:', tab);
        
        const modal = document.getElementById('fancybox-file-picker');
        
        // Update tab buttons
        modal.querySelectorAll('.file-picker-tab').forEach(t => t.classList.remove('active'));
        modal.querySelector(`[data-tab="${tab}"]`).classList.add('active');
        
        // Update panels
        modal.querySelectorAll('.file-picker-panel').forEach(p => p.classList.remove('active'));
        modal.querySelector(`#${tab}-panel`).classList.add('active');
        
        // Initialize dropzone on first upload tab access
        if (tab === 'upload' && !this.dropzoneInstance) {
            setTimeout(() => this.initDropzone(), 100);
        }
    }
    
    async loadFiles() {
        const gallery = document.getElementById('browse-gallery');
        gallery.innerHTML = `
            <div class="loading">
                <div class="spinner"></div>
                <p>Loading files...</p>
            </div>
        `;
        
        try {
            const response = await fetch('file_manager_standalone.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=list&path=${encodeURIComponent(this.currentUploadPath)}`
            });
            
            const text = await response.text();
            console.log('FancyboxFilePicker: Raw response:', text.substring(0, 200));
            
            const data = JSON.parse(text);
            
            if (data.success) {
                console.log('FancyboxFilePicker: Found', data.files.length, 'files');
                this.browsedFiles = data.files;
                this.renderFiles(data.files);
            } else {
                gallery.innerHTML = `
                    <div class="error">
                        <div class="error-icon">⚠️</div>
                        <p>Error: ${data.error}</p>
                    </div>
                `;
            }
        } catch (error) {
            console.error('FancyboxFilePicker: Error loading files:', error);
            gallery.innerHTML = `
                <div class="error">
                    <div class="error-icon">❌</div>
                    <p>Error loading files: ${error.message}</p>
                </div>
            `;
        }
    }
    
    renderFiles(files) {
        const gallery = document.getElementById('browse-gallery');
        
        if (files.length === 0) {
            gallery.innerHTML = `
                <div class="empty">
                    <div class="empty-icon">📂</div>
                    <p>No files found</p>
                    <small>Upload some images to get started</small>
                </div>
            `;
            return;
        }
        
        const fileHtml = files.map((file, index) => `
            <div class="gallery-item" data-path="${file.path}" data-name="${file.name}" data-index="${index}">
                <div class="gallery-thumb">
                    <img src="${file.path}" alt="${file.name}" loading="lazy" />
                    <div class="gallery-overlay">
                        <div class="gallery-name">${file.name}</div>
                        <div class="gallery-size">${file.size}</div>
                    </div>
                </div>
            </div>
        `).join('');
        
        gallery.innerHTML = `<div class="gallery-grid">${fileHtml}</div>`;
        
        // Bind click events for file selection
        gallery.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', () => this.selectFileItem(item));
        });
    }
    
    initDropzone() {
        if (this.dropzoneInstance) return;
        
        const dropzoneElement = document.getElementById('dropzone-area');
        
        // Prevent Dropzone from auto-discovering
        Dropzone.autoDiscover = false;
        
        this.dropzoneInstance = new Dropzone(dropzoneElement, {
            url: 'file_manager_standalone.php',
            paramName: 'file',
            maxFilesize: 10, // MB
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            clickable: true,
            dictDefaultMessage: `
                <div class="dropzone-message">
                    <div class="dropzone-icon">📤</div>
                    <h4>Drop files here or click to upload</h4>
                    <p>Supports: JPG, PNG, GIF up to 10MB</p>
                </div>
            `,
            dictRemoveFile: 'Remove',
            dictCancelUpload: 'Cancel',
            previewTemplate: `
                <div class="dz-preview dz-file-preview">
                    <div class="dz-image">
                        <img data-dz-thumbnail />
                    </div>
                    <div class="dz-details">
                        <div class="dz-size"><span data-dz-size></span></div>
                        <div class="dz-filename"><span data-dz-name></span></div>
                    </div>
                    <div class="dz-progress">
                        <span class="dz-upload" data-dz-uploadprogress></span>
                    </div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    <div class="dz-success-mark">✓</div>
                    <div class="dz-error-mark">✗</div>
                    <div class="dz-remove" data-dz-remove>Remove</div>
                </div>
            `,
            
            init: function() {
                const picker = this;
                
                this.on('sending', function(file, xhr, formData) {
                    formData.append('action', 'upload');
                    formData.append('path', picker.currentUploadPath || 'images');
                });
                
                this.on('success', function(file, response) {
                    console.log('Upload successful:', response);
                    
                    // Show success message
                    const progressDiv = document.getElementById('upload-progress');
                    progressDiv.style.display = 'block';
                    progressDiv.innerHTML = `
                        <div class="upload-success">
                            <span class="success-icon">✅</span>
                            <span>File uploaded successfully!</span>
                        </div>
                    `;
                    
                    // Auto-reload browse files
                    picker.loadFiles();
                    
                    // Auto-select uploaded file and close after delay
                    setTimeout(() => {
                        if (response.success && picker.currentCallback) {
                            picker.currentCallback(response.path);
                            picker.close();
                        }
                    }, 1500);
                });
                
                this.on('error', function(file, errorMessage) {
                    console.error('Upload error:', errorMessage);
                    
                    const progressDiv = document.getElementById('upload-progress');
                    progressDiv.style.display = 'block';
                    progressDiv.innerHTML = `
                        <div class="upload-error">
                            <span class="error-icon">❌</span>
                            <span>Upload failed: ${errorMessage.error || errorMessage}</span>
                        </div>
                    `;
                });
                
                this.on('uploadprogress', function(file, progress) {
                    const progressDiv = document.getElementById('upload-progress');
                    progressDiv.style.display = 'block';
                    progressDiv.innerHTML = `
                        <div class="upload-progress-bar">
                            <div class="progress-bar" style="width: ${progress}%"></div>
                            <span class="progress-text">${Math.round(progress)}%</span>
                        </div>
                    `;
                });
                
            }.bind(this)
        });
    }
    
    selectFileItem(item) {
        // Clear previous selections
        document.querySelectorAll('.gallery-item').forEach(i => i.classList.remove('selected'));
        
        // Select clicked item
        item.classList.add('selected');
        
        const filename = item.dataset.name;
        const path = item.dataset.path;
        
        document.getElementById('selected-file-name').textContent = filename;
        document.getElementById('select-btn').disabled = false;
        document.getElementById('select-btn').dataset.selectedPath = path;
    }
    
    selectFile() {
        const selectedPath = document.getElementById('select-btn').dataset.selectedPath;
        
        if (selectedPath && this.currentCallback) {
            this.currentCallback(selectedPath);
            this.close();
        }
    }
    
    clearSelection() {
        document.querySelectorAll('.gallery-item').forEach(i => i.classList.remove('selected'));
        document.getElementById('selected-file-name').textContent = 'No file selected';
        document.getElementById('select-btn').disabled = true;
        document.getElementById('select-btn').dataset.selectedPath = '';
        
        // Clear upload progress
        const progressDiv = document.getElementById('upload-progress');
        progressDiv.style.display = 'none';
        progressDiv.innerHTML = '';
    }
    
    filterFiles(query) {
        if (!query.trim()) {
            this.renderFiles(this.browsedFiles);
            return;
        }
        
        const filtered = this.browsedFiles.filter(file => 
            file.name.toLowerCase().includes(query.toLowerCase())
        );
        this.renderFiles(filtered);
    }
}

// Global instance
let fancyboxFilePicker = null;

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('FancyboxFilePicker: DOM loaded, initializing...');
    try {
        fancyboxFilePicker = new FancyboxFilePicker();
        console.log('FancyboxFilePicker: Created successfully');
    } catch (error) {
        console.error('FancyboxFilePicker: Error creating:', error);
    }
});

// Global function to open file picker
function openFancyboxFilePicker(uploadPath, callback) {
    console.log('openFancyboxFilePicker called with path:', uploadPath);
    if (fancyboxFilePicker) {
        fancyboxFilePicker.open(uploadPath, callback);
    } else {
        console.error('FancyboxFilePicker: Not initialized yet');
        alert('File picker is loading. Please try again in a moment.');
    }
}

// Initialize file picker buttons
function initFancyboxFilePickerButtons() {
    console.log('FancyboxFilePicker: Initializing buttons...');
    const buttons = document.querySelectorAll('[data-fancybox-file-picker]');
    console.log('FancyboxFilePicker: Found', buttons.length, 'buttons');
    
    buttons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            console.log('FancyboxFilePicker: Button clicked!', button);
            
            const uploadPath = button.dataset.uploadPath || 'images';
            const targetInput = button.dataset.target;
            
            openFancyboxFilePicker(uploadPath, (selectedPath) => {
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

// Auto-initialize buttons on DOM ready
document.addEventListener('DOMContentLoaded', initFancyboxFilePickerButtons);