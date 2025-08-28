/**
 * Universal File Picker Modal for Steam CMS Admin
 * Allows selecting existing files or uploading new ones
 */

class FilePickerModal {
    constructor() {
        this.modal = null;
        this.currentCallback = null;
        this.currentUploadPath = null;
        this.allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        this.selectedFiles = null;
        this.init();
    }

    init() {
        console.log('File picker: init() called - Version 2.0');
        // Create modal HTML
        const modalHtml = `
            <div id="file-picker-modal" class="file-picker-modal" style="display: none;">
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
                                <select id="file-sort">
                                    <option value="name">Sort by Name</option>
                                    <option value="date">Sort by Date</option>
                                    <option value="size">Sort by Size</option>
                                </select>
                            </div>
                            <div class="file-picker-grid" id="file-grid">
                                <div class="file-picker-loading">Loading files...</div>
                            </div>
                            <div class="file-picker-pagination" id="file-pagination"></div>
                        </div>
                        <div id="upload-panel" class="file-picker-panel">
                            <div class="file-picker-upload-area" id="upload-area">
                                <div class="upload-drop-zone">
                                    <i class="upload-icon">📁</i>
                                    <h3>Upload Files</h3>
                                    <p>Drag and drop files here</p>
                                    <div class="upload-divider">
                                        <span>OR</span>
                                    </div>
                                    <button type="button" class="btn btn-primary upload-browse-btn">
                                        Browse Files
                                    </button>
                                    <p class="upload-note" id="upload-formats">Supported formats: JPG, PNG, GIF, WEBP</p>
                                    <input type="file" id="file-input" accept="image/*" multiple style="display: none;" />
                                </div>
                                <div class="upload-progress" id="upload-progress" style="display: none;">
                                    <div class="progress-bar">
                                        <div class="progress-fill"></div>
                                    </div>
                                    <div class="progress-text">Uploading...</div>
                                </div>
                                <div class="upload-preview" id="upload-preview"></div>
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
        console.log('File picker: Adding modal HTML to body');
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        this.modal = document.getElementById('file-picker-modal');
        console.log('File picker: Modal element found:', this.modal);
        
        if (!this.modal) {
            console.error('File picker: Failed to create modal element!');
            return;
        }
        
        this.bindEvents();
        console.log('File picker: Events bound successfully');
        
        // Debug: Check if browse button exists
        const browseBtn = this.modal.querySelector('.upload-browse-btn');
        console.log('File picker: Browse button found:', browseBtn ? 'YES' : 'NO');
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
        
        // File search and sort
        modal.querySelector('#file-search').addEventListener('input', (e) => this.filterFiles(e.target.value));
        modal.querySelector('#file-sort').addEventListener('change', (e) => this.sortFiles(e.target.value));
        
        // File selection
        modal.querySelector('#file-picker-select').addEventListener('click', () => this.selectFile());
        
        // Upload handling
        const fileInput = modal.querySelector('#file-input');
        const uploadArea = modal.querySelector('#upload-area');
        
        fileInput.addEventListener('change', (e) => this.handleFileSelection(e.target.files));
        
        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('drag-over');
        });
        
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('drag-over');
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('drag-over');
            this.handleFileSelection(e.dataTransfer.files);
        });
        
        // Browse button click
        const browseBtn = modal.querySelector('.upload-browse-btn');
        if (browseBtn) {
            console.log('File picker: Adding click event to browse button');
            browseBtn.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('File picker: Browse button clicked!');
                fileInput.click();
            });
        } else {
            console.error('File picker: Browse button not found during event binding!');
        }
        
        // ESC key to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.modal.style.display !== 'none') {
                this.close();
            }
        });
    }

    open(uploadPath, callback, options = {}) {
        console.log('File picker: open() called with path:', uploadPath);
        this.currentCallback = callback;
        this.currentUploadPath = uploadPath;
        this.allowedTypes = options.allowedTypes || this.allowedTypes;
        
        console.log('File picker: Displaying modal...');
        this.modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Update supported formats display
        const formatsNote = this.modal.querySelector('#upload-formats');
        if (formatsNote) {
            const formats = this.allowedTypes.map(t => t.toUpperCase()).join(', ');
            formatsNote.textContent = `Supported formats: ${formats}`;
        }
        
        // Reset state first
        console.log('File picker: Clearing selection and switching to browse tab...');
        this.clearSelection();
        this.switchTab('browse');
        
        // Load existing files after a brief delay to ensure DOM is ready
        console.log('File picker: Loading files...');
        setTimeout(() => {
            this.loadFiles();
        }, 100);
    }

    close() {
        this.modal.style.display = 'none';
        document.body.style.overflow = '';
        this.currentCallback = null;
        this.currentUploadPath = null;
        this.clearSelection();
    }

    switchTab(tab) {
        console.log('File picker: Switching to tab:', tab);
        
        // Update tab buttons
        const allTabs = this.modal.querySelectorAll('.file-picker-tab');
        console.log('File picker: Found', allTabs.length, 'tab buttons');
        allTabs.forEach(t => t.classList.remove('active'));
        
        const activeTab = this.modal.querySelector(`[data-tab="${tab}"]`);
        if (activeTab) {
            activeTab.classList.add('active');
            console.log('File picker: Tab button updated:', tab, 'has active class:', activeTab.classList.contains('active'));
        } else {
            console.error('File picker: Tab button not found:', tab);
        }
        
        // Update panels
        const allPanels = this.modal.querySelectorAll('.file-picker-panel');
        console.log('File picker: Found', allPanels.length, 'panels');
        allPanels.forEach(p => {
            p.classList.remove('active');
            console.log('File picker: Removed active from panel:', p.id);
        });
        
        const activePanel = this.modal.querySelector(`#${tab}-panel`);
        if (activePanel) {
            activePanel.classList.add('active');
            console.log('File picker: Panel updated:', tab, 'has active class:', activePanel.classList.contains('active'));
            console.log('File picker: Panel display style:', window.getComputedStyle(activePanel).display);
        } else {
            console.error('File picker: Panel not found:', `#${tab}-panel`);
        }
        
        // Clear selection when switching tabs
        if (tab === 'upload') {
            this.modal.querySelector('#selected-file-info').textContent = 'Select files to upload or browse existing files';
            this.modal.querySelector('#file-picker-select').textContent = 'Upload Selected';
        } else {
            this.modal.querySelector('#selected-file-info').textContent = 'No file selected';
            this.modal.querySelector('#file-picker-select').textContent = 'Select';
        }
        
        console.log('File picker: switchTab complete for:', tab);
    }

    async loadFiles() {
        const grid = this.modal.querySelector('#file-grid');
        grid.innerHTML = '<div class="file-picker-loading">Loading files...</div>';
        
        console.log('File picker: Loading files from path:', this.currentUploadPath);
        
        try {
            // Use standalone file manager
            const response = await fetch('file_manager_standalone.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=list&path=${encodeURIComponent(this.currentUploadPath)}`
            });
            
            console.log('File picker: Response status:', response.status);
            console.log('File picker: Response headers:', response.headers.get('content-type'));
            
            const text = await response.text();
            console.log('File picker: Raw response (first 500 chars):', text.substring(0, 500));
            
            // Check if response starts with HTML
            if (text.trim().startsWith('<!DOCTYPE') || text.trim().startsWith('<html')) {
                throw new Error('Server returned HTML instead of JSON. Check file_manager_simple.php for errors.');
            }
            
            let data;
            try {
                data = JSON.parse(text);
            } catch (jsonError) {
                console.error('File picker: JSON parse error:', jsonError);
                console.error('File picker: Full response:', text);
                throw new Error(`Invalid JSON response: ${jsonError.message}`);
            }
            
            console.log('File picker: Parsed data:', data);
            
            if (data.success) {
                console.log('File picker: Found', data.files.length, 'files');
                this.renderFiles(data.files);
            } else {
                console.error('File picker: Backend error:', data.error);
                grid.innerHTML = `<div class="file-picker-error">Backend Error: ${data.error || 'Unknown error'}</div>`;
            }
        } catch (error) {
            console.error('File picker: Load files error:', error);
            grid.innerHTML = `<div class="file-picker-error">
                <strong>Error loading files:</strong><br>
                ${error.message}<br><br>
                <small>Check browser console for details</small>
            </div>`;
        }
    }

    renderFiles(files) {
        console.log('File picker: renderFiles() called with', files.length, 'files');
        
        const grid = this.modal.querySelector('#file-grid');
        console.log('File picker: Grid element found:', grid ? 'YES' : 'NO');
        
        if (files.length === 0) {
            console.log('File picker: No files to render, showing empty message');
            grid.innerHTML = '<div class="file-picker-empty">No files found</div>';
            return;
        }
        
        console.log('File picker: Sample file data:', files[0]);
        
        const fileHtml = files.map(file => {
            const itemHtml = `
            <div class="file-picker-item" data-filename="${file.name}" data-path="${file.path}">
                <div class="file-picker-thumb">
                    <img src="${file.thumbnail || file.path}" alt="${file.name}" loading="lazy" />
                </div>
                <div class="file-picker-info">
                    <div class="file-picker-name">${file.name}</div>
                    <div class="file-picker-meta">${file.size} • ${file.modified}</div>
                </div>
            </div>
        `;
            return itemHtml;
        }).join('');
        
        console.log('File picker: Generated HTML length:', fileHtml.length);
        console.log('File picker: Sample HTML (first 200 chars):', fileHtml.substring(0, 200));
        
        grid.innerHTML = fileHtml;
        
        // Verify the HTML was actually inserted
        const insertedItems = grid.querySelectorAll('.file-picker-item');
        console.log('File picker: Items inserted into grid:', insertedItems.length);
        
        // Bind click events
        insertedItems.forEach((item, index) => {
            console.log(`File picker: Binding click event to item ${index + 1}:`, item.dataset.filename);
            item.addEventListener('click', () => this.selectFileItem(item));
        });
        
        console.log('File picker: renderFiles() complete');
    }

    selectFileItem(item) {
        // Clear previous selections
        this.modal.querySelectorAll('.file-picker-item').forEach(i => i.classList.remove('selected'));
        
        // Select clicked item
        item.classList.add('selected');
        
        const filename = item.dataset.filename;
        const path = item.dataset.path;
        
        this.modal.querySelector('#selected-file-info').textContent = filename;
        this.modal.querySelector('#file-picker-select').disabled = false;
        this.modal.querySelector('#file-picker-select').dataset.selectedPath = path;
    }

    clearSelection() {
        this.modal.querySelectorAll('.file-picker-item').forEach(i => i.classList.remove('selected'));
        this.modal.querySelector('#selected-file-info').textContent = 'No file selected';
        this.modal.querySelector('#file-picker-select').disabled = true;
        this.modal.querySelector('#file-picker-select').dataset.selectedPath = '';
        this.modal.querySelector('#file-picker-select').textContent = 'Select';
        this.selectedFiles = null;
        
        // Clear upload preview
        const uploadPreview = this.modal.querySelector('#upload-preview');
        if (uploadPreview) {
            uploadPreview.innerHTML = '';
        }
    }

    selectFile() {
        const selectedPath = this.modal.querySelector('#file-picker-select').dataset.selectedPath;
        
        if (this.selectedFiles && this.selectedFiles.length > 0) {
            // Handle upload of selected files
            this.handleFileUpload(this.selectedFiles);
        } else if (selectedPath && this.currentCallback) {
            // Handle selection of existing file
            this.currentCallback(selectedPath);
            this.close();
        }
    }

    handleFileSelection(files) {
        if (!files || files.length === 0) return;
        
        console.log('File picker: Files selected for upload:', files.length);
        
        // Validate file types
        const validFiles = [];
        const invalidFiles = [];
        
        for (let file of files) {
            const ext = file.name.split('.').pop().toLowerCase();
            if (this.allowedTypes.includes(ext)) {
                validFiles.push(file);
            } else {
                invalidFiles.push(file);
            }
        }
        
        if (invalidFiles.length > 0) {
            alert(`Some files have invalid types: ${invalidFiles.map(f => f.name).join(', ')}\nAllowed types: ${this.allowedTypes.join(', ')}`);
        }
        
        if (validFiles.length === 0) {
            return;
        }
        
        // Update UI
        const fileNames = validFiles.map(f => f.name).join(', ');
        this.modal.querySelector('#selected-file-info').textContent = `${validFiles.length} file(s) selected: ${fileNames}`;
        this.modal.querySelector('#file-picker-select').disabled = false;
        this.modal.querySelector('#file-picker-select').textContent = 'Upload Selected';
        
        // Store files for upload
        this.selectedFiles = validFiles;
        this.modal.querySelector('#file-picker-select').dataset.selectedPath = '';
        
        // Show preview of selected files
        this.showUploadPreview(validFiles);
    }

    showUploadPreview(files) {
        const uploadPreview = this.modal.querySelector('#upload-preview');
        uploadPreview.innerHTML = '';
        
        files.forEach(file => {
            const previewItem = document.createElement('div');
            previewItem.className = 'upload-preview-item pending';
            
            if (file.type.startsWith('image/')) {
                // Create image preview
                const img = document.createElement('img');
                img.style.width = '40px';
                img.style.height = '40px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '4px';
                
                const reader = new FileReader();
                reader.onload = (e) => {
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
                
                previewItem.appendChild(img);
            }
            
            const fileName = document.createElement('span');
            fileName.textContent = `📄 ${file.name} (${this.formatFileSize(file.size)})`;
            previewItem.appendChild(fileName);
            
            uploadPreview.appendChild(previewItem);
        });
    }

    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    async handleFileUpload(files) {
        if (!files || files.length === 0) return;
        
        const uploadProgress = this.modal.querySelector('#upload-progress');
        const uploadPreview = this.modal.querySelector('#upload-preview');
        const progressFill = uploadProgress.querySelector('.progress-fill');
        const progressText = uploadProgress.querySelector('.progress-text');
        
        uploadProgress.style.display = 'block';
        uploadPreview.innerHTML = '';
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            
            // Check file type
            const ext = file.name.split('.').pop().toLowerCase();
            if (!this.allowedTypes.includes(ext)) {
                alert(`File type .${ext} not allowed. Allowed types: ${this.allowedTypes.join(', ')}`);
                continue;
            }
            
            // Update progress
            const percent = Math.round(((i + 1) / files.length) * 100);
            progressFill.style.width = percent + '%';
            progressText.textContent = `Uploading ${file.name}... (${i + 1}/${files.length})`;
            
            try {
                const formData = new FormData();
                formData.append('action', 'upload');
                formData.append('path', this.currentUploadPath);
                formData.append('file', file);
                
                const response = await fetch('file_manager_standalone.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Add to preview
                    uploadPreview.innerHTML += `
                        <div class="upload-preview-item success">
                            <img src="${result.path}" alt="${file.name}" />
                            <span>✓ ${file.name}</span>
                        </div>
                    `;
                } else {
                    uploadPreview.innerHTML += `
                        <div class="upload-preview-item error">
                            <span>✗ ${file.name}: ${result.error || 'Upload failed'}</span>
                        </div>
                    `;
                }
            } catch (error) {
                uploadPreview.innerHTML += `
                    <div class="upload-preview-item error">
                        <span>✗ ${file.name}: Upload failed</span>
                    </div>
                `;
            }
        }
        
        progressText.textContent = 'Upload complete!';
        
        // Reload files in browse tab
        setTimeout(() => {
            uploadProgress.style.display = 'none';
            this.loadFiles();
            this.switchTab('browse');
        }, 1000);
    }

    filterFiles(query) {
        const items = this.modal.querySelectorAll('.file-picker-item');
        items.forEach(item => {
            const name = item.dataset.filename.toLowerCase();
            if (name.includes(query.toLowerCase())) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    sortFiles(sortBy) {
        const grid = this.modal.querySelector('#file-grid');
        const items = Array.from(grid.querySelectorAll('.file-picker-item'));
        
        items.sort((a, b) => {
            switch (sortBy) {
                case 'name':
                    return a.dataset.filename.localeCompare(b.dataset.filename);
                case 'date':
                    // Would need actual date data from server
                    return 0;
                case 'size':
                    // Would need actual size data from server
                    return 0;
                default:
                    return 0;
            }
        });
        
        // Re-append sorted items
        items.forEach(item => grid.appendChild(item));
    }
}

// Initialize global file picker
let filePickerModal = null;

document.addEventListener('DOMContentLoaded', () => {
    console.log('File picker: DOM loaded, initializing...');
    try {
        filePickerModal = new FilePickerModal();
        console.log('File picker: Modal created successfully');
    } catch (error) {
        console.error('File picker: Error creating modal:', error);
    }
});

// Global function to open file picker
function openFilePicker(uploadPath, callback, options = {}) {
    console.log('File picker: openFilePicker called with path:', uploadPath);
    if (filePickerModal) {
        console.log('File picker: Opening modal...');
        filePickerModal.open(uploadPath, callback, options);
    } else {
        console.error('File picker: Modal not initialized yet');
        alert('File picker is not ready yet. Please try again in a moment.');
    }
}

// Helper function to replace file input buttons
function initFilePickerButtons() {
    console.log('File picker: Initializing buttons...');
    const buttons = document.querySelectorAll('[data-file-picker]');
    console.log('File picker: Found', buttons.length, 'buttons');
    
    buttons.forEach(button => {
        console.log('File picker: Setting up button:', button);
        button.addEventListener('click', (e) => {
            e.preventDefault();
            console.log('File picker: Button clicked!', button);
            const uploadPath = button.dataset.uploadPath || 'images';
            const targetInput = button.dataset.target;
            const allowedTypes = button.dataset.allowedTypes ? button.dataset.allowedTypes.split(',') : undefined;
            
            console.log('File picker: uploadPath:', uploadPath, 'target:', targetInput, 'types:', allowedTypes);
            
            openFilePicker(uploadPath, (selectedPath) => {
                if (targetInput) {
                    const input = document.querySelector(targetInput);
                    if (input) {
                        input.value = selectedPath;
                        // Trigger change event
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
            }, { allowedTypes });
        });
    });
}

// Auto-initialize on DOM ready
document.addEventListener('DOMContentLoaded', initFilePickerButtons);

// Helper function for media uploads that need to be registered in the database
function openFilePickerForMedia(uploadPath, callback, options = {}) {
    openFilePicker(uploadPath, function(selectedPath) {
        // If this is a new upload to media directory, register it in the database
        if (uploadPath === 'media' && selectedPath) {
            // Register the file in the media table
            fetch('media_register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'filename=' + encodeURIComponent('/cms/content/' + selectedPath)
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      if (callback) callback(selectedPath);
                      // Refresh the page to show the new file in the list
                      setTimeout(() => location.reload(), 500);
                  }
              });
        } else {
            if (callback) callback(selectedPath);
        }
    }, options);
}

// Utility function to convert legacy file inputs to file picker buttons
function convertLegacyFileInputs() {
    document.querySelectorAll('input[type="file"]:not([data-converted])').forEach(function(input) {
        // Skip if already converted or if it has the data-file-picker attribute
        if (input.hasAttribute('data-converted') || input.closest('[data-file-picker]')) {
            return;
        }
        
        const uploadPath = input.getAttribute('data-upload-path') || 'images';
        const allowedTypes = input.getAttribute('accept') || 'jpg,jpeg,png,gif,webp';
        const previewId = input.getAttribute('data-preview');
        
        // Create file picker button
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-primary';
        button.textContent = 'Choose or Upload File';
        button.setAttribute('data-file-picker', '');
        button.setAttribute('data-upload-path', uploadPath);
        button.setAttribute('data-allowed-types', allowedTypes);
        
        // Add click handler
        button.addEventListener('click', function() {
            const types = allowedTypes.split(',').map(t => t.trim());
            openFilePicker(uploadPath, function(selectedPath) {
                // Create a File object to simulate the original input behavior
                const fileName = selectedPath.split('/').pop();
                button.textContent = 'File: ' + fileName;
                
                // Update preview if specified
                if (previewId) {
                    const preview = document.querySelector(previewId);
                    if (preview && preview.tagName === 'IMG') {
                        preview.src = selectedPath;
                        preview.style.display = 'block';
                    }
                }
                
                // Store the selected path in a data attribute for form processing
                button.setAttribute('data-selected-file', selectedPath);
                
                // Trigger a custom event that form handlers can listen for
                const event = new CustomEvent('fileSelected', {
                    detail: {
                        path: selectedPath,
                        fileName: fileName,
                        originalInput: input
                    }
                });
                button.dispatchEvent(event);
            }, { allowedTypes: types });
        });
        
        // Replace the original input
        input.parentNode.insertBefore(button, input);
        input.style.display = 'none';
        input.setAttribute('data-converted', 'true');
        
        // Add a hidden input to store the selected file path
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = input.name + '_path';
        input.parentNode.insertBefore(hiddenInput, input);
        
        // Update hidden input when file is selected
        button.addEventListener('fileSelected', function(e) {
            hiddenInput.value = e.detail.path;
        });
    });
}

// Auto-convert legacy file inputs when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    convertLegacyFileInputs();
    // Also convert any dynamically added file inputs
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === Node.ELEMENT_NODE) {
                    if (node.tagName === 'INPUT' && node.type === 'file') {
                        convertLegacyFileInputs();
                    } else if (node.querySelectorAll) {
                        const fileInputs = node.querySelectorAll('input[type="file"]:not([data-converted])');
                        if (fileInputs.length > 0) {
                            convertLegacyFileInputs();
                        }
                    }
                }
            });
        });
    });
    observer.observe(document.body, { childList: true, subtree: true });
});