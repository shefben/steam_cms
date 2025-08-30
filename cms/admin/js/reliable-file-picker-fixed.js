/**
 * Reliable File Picker - Simple Modal + FilePond
 * Uses proven FilePond for uploads with a custom but reliable modal
 */

class ReliableFilePicker {
    constructor() {
        this.modal = null;
        this.currentCallback = null;
        this.currentUploadPath = null;
        this.pondInstance = null;
        this.browsedFiles = [];
        this.selectedFile = null;
        
        this.init();
    }
    
    init() {
        console.log('ReliableFilePicker: Initializing...');
        
        // Prevent default drag/drop behavior globally when modal is open
        this.setupGlobalDragDropPrevention();
        
        // Create modal HTML
        const modalHtml = `
            <div id="reliable-file-picker-modal" class="reliable-modal" style="display: none;">
                <div class="reliable-modal-overlay"></div>
                <div class="reliable-modal-content">
                    <div class="modal-header">
                        <h3>🖼️ Choose or Upload Image</h3>
                        <button class="modal-close-btn" type="button">&times;</button>
                    </div>
                    
                    <div class="modal-tabs">
                        <button class="modal-tab active" data-tab="browse">📁 Browse Files</button>
                        <button class="modal-tab" data-tab="upload">⬆️ Upload New</button>
                    </div>
                    
                    <div class="modal-body">
                        <!-- Browse Panel -->
                        <div id="browse-tab-content" class="tab-content active">
                            <div class="search-box">
                                <input type="text" id="file-search-input" placeholder="🔍 Search files..." />
                            </div>
                            <div class="files-grid-container" id="files-grid-container">
                                <div class="loading-state">
                                    <div class="spinner"></div>
                                    <p>Loading files...</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Upload Panel -->
                        <div id="upload-tab-content" class="tab-content">
                            <div id="upload-filepond" class="upload-filepond">
                                <input type="file" id="filepond-input" accept="image/*" />
                            </div>
                            <div id="upload-status" class="upload-status" style="display: none;"></div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="selection-display">
                            <span id="selected-file-display">No file selected</span>
                        </div>
                        <div class="modal-actions">
                            <button id="modal-cancel-btn" class="btn btn-cancel">Cancel</button>
                            <button id="modal-select-btn" class="btn btn-select" disabled>Select File</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        this.modal = document.getElementById('reliable-file-picker-modal');
        
        this.bindEvents();
        console.log('ReliableFilePicker: Initialized successfully');
    }
    
    setupGlobalDragDropPrevention() {
        // Prevent default drag/drop behavior on entire document to stop browser from opening files
        const dragDropEvents = ['dragenter', 'dragover', 'dragleave', 'drop'];
        
        dragDropEvents.forEach(eventName => {
            document.addEventListener(eventName, (e) => {
                // Only prevent when modal is open
                if (this.modal && this.modal.style.display === 'block') {
                    // Check if the event target is within FilePond - if so, allow it
                    if (!e.target.closest('.filepond--root')) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                }
            }, true); // Use capture phase
        });
    }
    
    bindEvents() {
        // Modal close events
        this.modal.querySelector('.reliable-modal-overlay').addEventListener('click', () => this.close());
        this.modal.querySelector('.modal-close-btn').addEventListener('click', () => this.close());
        this.modal.querySelector('#modal-cancel-btn').addEventListener('click', () => this.close());
        
        // Tab switching
        this.modal.querySelectorAll('.modal-tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                this.switchTab(e.target.dataset.tab);
            });
        });
        
        // File selection
        this.modal.querySelector('#modal-select-btn').addEventListener('click', () => this.selectCurrentFile());
        
        // Search
        this.modal.querySelector('#file-search-input').addEventListener('input', (e) => {
            this.filterFiles(e.target.value);
        });
        
        // ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.modal.style.display === 'block') {
                this.close();
            }
        });
    }
    
    open(uploadPath, callback) {
        console.log('ReliableFilePicker: Opening for path:', uploadPath);
        
        this.currentCallback = callback;
        this.currentUploadPath = uploadPath || 'images';
        
        // Show modal
        this.modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Reset state
        this.selectedFile = null;
        this.updateSelection();
        this.switchTab('browse');
        
        // Load files
        this.loadFiles();
    }
    
    close() {
        console.log('ReliableFilePicker: Closing modal');
        
        this.modal.style.display = 'none';
        document.body.style.overflow = '';
        
        // Cleanup
        if (this.pondInstance) {
            this.pondInstance.destroy();
            this.pondInstance = null;
        }
        
        this.currentCallback = null;
        this.currentUploadPath = null;
        this.selectedFile = null;
        this.browsedFiles = [];
    }
    
    switchTab(tabName) {
        console.log('ReliableFilePicker: Switching to tab:', tabName);
        
        // Update tab buttons
        this.modal.querySelectorAll('.modal-tab').forEach(tab => {
            tab.classList.toggle('active', tab.dataset.tab === tabName);
        });
        
        // Update tab content
        this.modal.querySelectorAll('.tab-content').forEach(content => {
            content.classList.toggle('active', content.id === tabName + '-tab-content');
        });
        
        // Initialize FilePond on first upload access
        if (tabName === 'upload' && !this.pondInstance) {
            setTimeout(() => this.initFilePond(), 100);
        }
    }
    
    async loadFiles() {
        const container = this.modal.querySelector('#files-grid-container');
        container.innerHTML = `
            <div class="loading-state">
                <div class="spinner"></div>
                <p>Loading files...</p>
            </div>
        `;
        
        try {
            console.log('ReliableFilePicker: Making request to simple_file_api.php');
            
            const response = await fetch('simple_file_api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=list&path=${encodeURIComponent(this.currentUploadPath)}`
            });
            
            const text = await response.text();
            console.log('ReliableFilePicker: Raw response (first 200 chars):', text.substring(0, 200));
            
            // Check if response looks like HTML
            if (text.trim().startsWith('<!DOCTYPE') || text.trim().startsWith('<html')) {
                throw new Error('Server returned HTML instead of JSON. Check file_manager_standalone.php');
            }
            
            const data = JSON.parse(text);
            
            if (data.success && data.files) {
                console.log('ReliableFilePicker: Loaded', data.files.length, 'files');
                this.browsedFiles = data.files;
                this.renderFiles(data.files);
            } else {
                container.innerHTML = `
                    <div class="error-state">
                        <div class="error-icon">⚠️</div>
                        <p>Error: ${data.error || 'Unknown error'}</p>
                        <small>Check browser console for details</small>
                    </div>
                `;
            }
        } catch (error) {
            console.error('ReliableFilePicker: Load files error:', error);
            container.innerHTML = `
                <div class="error-state">
                    <div class="error-icon">❌</div>
                    <p>Failed to load files: ${error.message}</p>
                    <small>Check browser console for details</small>
                </div>
            `;
        }
    }
    
    renderFiles(files) {
        const container = this.modal.querySelector('#files-grid-container');
        
        if (files.length === 0) {
            container.innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon">📂</div>
                    <p>No files found</p>
                    <small>Try uploading some images</small>
                </div>
            `;
            return;
        }
        
        const filesHtml = files.map(file => `
            <div class="file-item" data-path="${file.path}" data-name="${file.name}">
                <div class="file-thumbnail">
                    <img src="${file.path}" alt="${file.name}" loading="lazy" 
                         onerror="this.style.display='none'; this.parentNode.innerHTML='<div class=\\'image-placeholder\\'>📷<br><small>Image</small></div>'" />
                </div>
                <div class="file-details">
                    <div class="file-name" title="${file.name}">${file.name}</div>
                    <div class="file-size">${file.size}</div>
                </div>
            </div>
        `).join('');
        
        container.innerHTML = `<div class="files-grid">${filesHtml}</div>`;
        
        // Add click handlers
        container.querySelectorAll('.file-item').forEach(item => {
            item.addEventListener('click', () => this.selectFileItem(item));
        });
    }
    
    selectFileItem(item) {
        // Remove previous selection
        this.modal.querySelectorAll('.file-item').forEach(i => i.classList.remove('selected'));
        
        // Select clicked item
        item.classList.add('selected');
        
        this.selectedFile = {
            path: item.dataset.path,
            name: item.dataset.name
        };
        
        this.updateSelection();
    }
    
    updateSelection() {
        const display = this.modal.querySelector('#selected-file-display');
        const selectBtn = this.modal.querySelector('#modal-select-btn');
        
        if (this.selectedFile) {
            display.textContent = this.selectedFile.name;
            selectBtn.disabled = false;
        } else {
            display.textContent = 'No file selected';
            selectBtn.disabled = true;
        }
    }
    
    selectCurrentFile() {
        if (this.selectedFile && this.currentCallback) {
            console.log('ReliableFilePicker: File selected:', this.selectedFile.path);
            this.currentCallback(this.selectedFile.path);
            this.close();
        }
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
    
    initFilePond() {
        if (this.pondInstance) return;
        
        console.log('ReliableFilePicker: Initializing FilePond');
        
        // Check if FilePond is available
        if (typeof FilePond === 'undefined') {
            console.error('ReliableFilePicker: FilePond is not loaded!');
            const statusDiv = this.modal.querySelector('#upload-status');
            statusDiv.style.display = 'block';
            statusDiv.innerHTML = '<div class="upload-error">❌ FilePond.js not loaded. Using fallback upload method.</div>';
            this.setupFallbackUpload();
            return;
        }
        
        const inputElement = this.modal.querySelector('#filepond-input');
        const statusDiv = this.modal.querySelector('#upload-status');
        
        // Create FilePond instance with proper drag & drop handling
        this.pondInstance = FilePond.create(inputElement, {
            server: {
                url: 'simple_file_api.php',
                process: {
                    url: '/',
                    method: 'POST',
                    ondata: (formData) => {
                        formData.append('action', 'upload');
                        formData.append('path', this.currentUploadPath || 'images');
                        return formData;
                    },
                    onload: (response) => {
                        try {
                            const data = JSON.parse(response);
                            if (data.success) {
                                console.log('FilePond upload success:', data);
                                statusDiv.style.display = 'block';
                                statusDiv.innerHTML = '<div class="upload-success">✅ Upload successful!</div>';
                                
                                // Reload files to show new upload
                                this.loadFiles();
                                
                                // Auto-select the uploaded file and close modal
                                setTimeout(() => {
                                    if (this.currentCallback) {
                                        this.currentCallback(data.path);
                                        this.close();
                                    }
                                }, 1500);
                                
                                return data.path;
                            } else {
                                throw new Error(data.error || 'Upload failed');
                            }
                        } catch (error) {
                            console.error('FilePond upload error:', error);
                            statusDiv.style.display = 'block';
                            statusDiv.innerHTML = `<div class="upload-error">❌ Upload failed: ${error.message}</div>`;
                            throw error;
                        }
                    },
                    onerror: (response) => {
                        console.error('FilePond server error:', response);
                        statusDiv.style.display = 'block';
                        statusDiv.innerHTML = `<div class="upload-error">❌ Upload failed: ${response}</div>`;
                    }
                }
            },
            
            // FilePond configuration
            allowMultiple: false,
            acceptedFileTypes: ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
            maxFileSize: '10MB',
            instantUpload: true,
            allowRevert: false,
            dropOnPage: false, // Only allow drops on the FilePond area
            dropOnElement: true,
            
            // Custom labels
            labelIdle: `
                <div style="text-align: center; padding: 30px 20px;">
                    <div style="font-size: 48px; margin-bottom: 15px; opacity: 0.7;">📤</div>
                    <div style="font-size: 20px; font-weight: 600; margin-bottom: 8px; color: #495057;">Drag & Drop your image here</div>
                    <div style="font-size: 14px; color: #6c757d; margin-bottom: 15px;">or <span class="filepond--label-action" style="color: #667eea; font-weight: 600; text-decoration: underline;">Browse Files</span></div>
                    <div style="font-size: 12px; color: #adb5bd;">Supports JPG, PNG, GIF up to 10MB</div>
                </div>
            `,
            
            // Event handlers
            onaddfile: (error, file) => {
                if (error) {
                    console.error('FilePond add file error:', error);
                    statusDiv.style.display = 'block';
                    statusDiv.innerHTML = `<div class="upload-error">❌ File error: ${error.main || error}</div>`;
                    return;
                }
                
                console.log('FilePond: File added successfully:', file.filename);
                statusDiv.style.display = 'block';
                statusDiv.innerHTML = '<div class="upload-progress">🚀 Uploading file...</div>';
            },
            
            onprocessfile: (error, file) => {
                if (error) {
                    console.error('FilePond process file error:', error);
                    statusDiv.style.display = 'block';
                    statusDiv.innerHTML = `<div class="upload-error">❌ Upload failed: ${error.main || error}</div>`;
                } else {
                    console.log('FilePond: File processed successfully:', file.filename);
                }
            }
        });
        
        console.log('ReliableFilePicker: FilePond initialized successfully with drag & drop');
    }
    
    setupFallbackUpload() {
        const container = this.modal.querySelector('#upload-filepond');
        container.innerHTML = `
            <div class="fallback-upload">
                <div class="upload-icon">📤</div>
                <h4>Upload Files</h4>
                <p>Supports JPG, PNG, GIF up to 10MB</p>
                <button type="button" class="upload-browse-btn">Choose Files</button>
            </div>
        `;
        
        container.querySelector('.upload-browse-btn').addEventListener('click', () => {
            this.createFallbackFileInput();
        });
    }
    
    createFallbackFileInput() {
        console.log('ReliableFilePicker: Creating fallback file input');
        
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*';
        fileInput.multiple = false;
        fileInput.style.display = 'none';
        
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                console.log('ReliableFilePicker: File selected via fallback:', file.name);
                this.uploadFileViaFallback(file);
            }
        });
        
        document.body.appendChild(fileInput);
        fileInput.click();
        
        // Clean up
        setTimeout(() => {
            document.body.removeChild(fileInput);
        }, 1000);
    }
    
    async uploadFileViaFallback(file) {
        const statusDiv = this.modal.querySelector('#upload-status');
        statusDiv.style.display = 'block';
        statusDiv.innerHTML = '<div class="upload-progress">Uploading via fallback...</div>';
        
        try {
            const formData = new FormData();
            formData.append('file', file);
            formData.append('action', 'upload');
            formData.append('path', this.currentUploadPath || 'images');
            
            const response = await fetch('simple_file_api.php', {
                method: 'POST',
                body: formData
            });
            
            const text = await response.text();
            const data = JSON.parse(text);
            
            if (data.success) {
                statusDiv.innerHTML = '<div class="upload-success">✅ Upload successful!</div>';
                this.loadFiles();
                
                setTimeout(() => {
                    if (this.currentCallback) {
                        this.currentCallback(data.path);
                        this.close();
                    }
                }, 1000);
            } else {
                statusDiv.innerHTML = `<div class="upload-error">❌ Upload failed: ${data.error}</div>`;
            }
        } catch (error) {
            console.error('Fallback upload error:', error);
            statusDiv.innerHTML = `<div class="upload-error">❌ Upload failed: ${error.message}</div>`;
        }
    }
}

// Global instance
let reliableFilePicker = null;

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('ReliableFilePicker: DOM ready, initializing...');
    try {
        reliableFilePicker = new ReliableFilePicker();
        console.log('ReliableFilePicker: Created successfully');
        
        // Initialize buttons
        initReliableFilePickerButtons();
    } catch (error) {
        console.error('ReliableFilePicker: Initialization error:', error);
    }
});

// Global function
function openReliableFilePicker(uploadPath, callback) {
    console.log('openReliableFilePicker called:', uploadPath);
    if (reliableFilePicker) {
        reliableFilePicker.open(uploadPath, callback);
    } else {
        console.error('ReliableFilePicker: Not ready');
        alert('File picker is loading, please wait...');
    }
}

// Initialize buttons
function initReliableFilePickerButtons() {
    const buttons = document.querySelectorAll('[data-reliable-file-picker]');
    console.log('ReliableFilePicker: Found', buttons.length, 'buttons');
    
    buttons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            
            const uploadPath = button.dataset.uploadPath || 'images';
            const targetInput = button.dataset.target;
            const previewElement = button.dataset.preview;
            
            openReliableFilePicker(uploadPath, (selectedPath) => {
                console.log('File selected:', selectedPath);
                
                // Update input
                if (targetInput) {
                    const input = document.querySelector(targetInput);
                    if (input) {
                        input.value = selectedPath;
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                }
                
                // Update preview
                if (previewElement) {
                    const preview = document.querySelector(previewElement);
                    if (preview) {
                        preview.src = selectedPath;
                        preview.style.display = 'block';
                    }
                }
            });
        });
    });
}