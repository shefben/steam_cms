<?php
require_once 'admin_header.php';
cms_require_permission('admin');
?>
<h2>File Picker Test Page</h2>

<div style="margin: 20px 0;">
    <h3>Test 1: Data Attribute Method</h3>
    <button type="button" class="btn btn-primary" 
            data-file-picker 
            data-upload-path="images" 
            data-target="#test-input-1"
            data-preview="#test-preview-1"
            data-allowed-types="png,jpg,jpeg">
        Choose or Upload Image (Data Attributes)
    </button>
    <input type="hidden" id="test-input-1" name="test_image">
    <img id="test-preview-1" src="" alt="Preview" style="max-width:200px;display:none;margin-top:5px;">
    <div>Selected file: <span id="selected-file-1">None</span></div>
</div>

<div style="margin: 20px 0;">
    <h3>Test 2: JavaScript Method</h3>
    <button type="button" class="btn btn-primary" id="js-test-button">
        Choose Image (JavaScript)
    </button>
    <img id="test-preview-2" src="" alt="Preview" style="max-width:200px;display:none;margin-top:5px;">
    <div>Selected file: <span id="selected-file-2">None</span></div>
</div>

<div style="margin: 20px 0;">
    <h3>Test 3: Legacy File Input (Auto-Conversion)</h3>
    <input type="file" name="legacy_upload" accept="image/*" data-upload-path="images">
    <div>This should be automatically converted to a file picker button</div>
</div>

<div style="margin: 20px 0;">
    <h3>Debug Info</h3>
    <button type="button" class="btn btn-secondary" onclick="debugFilePicker()">Debug File Picker</button>
    <div id="debug-output" style="background: #f5f5f5; padding: 10px; margin-top: 10px; font-family: monospace;"></div>
</div>

<script>
// Test the data attribute method
document.addEventListener('DOMContentLoaded', function() {
    console.log('Test page: DOM loaded');
    
    // Monitor the hidden input for changes
    document.getElementById('test-input-1').addEventListener('change', function() {
        document.getElementById('selected-file-1').textContent = this.value || 'None';
    });
    
    // Test JavaScript method
    document.getElementById('js-test-button').addEventListener('click', function() {
        console.log('Test page: JavaScript button clicked');
        
        if (typeof openFilePicker === 'function') {
            openFilePicker('images', function(selectedPath) {
                console.log('Test page: File selected via JS:', selectedPath);
                document.getElementById('test-preview-2').src = selectedPath;
                document.getElementById('test-preview-2').style.display = 'block';
                document.getElementById('selected-file-2').textContent = selectedPath;
            }, {
                allowedTypes: ['jpg', 'jpeg', 'png', 'gif']
            });
        } else {
            alert('openFilePicker function not available!');
        }
    });
});

function debugFilePicker() {
    const output = document.getElementById('debug-output');
    const info = [];
    
    info.push('=== File Picker Debug Info ===');
    info.push('filePickerModal: ' + (typeof filePickerModal));
    info.push('openFilePicker function: ' + (typeof openFilePicker));
    
    const modal = document.getElementById('file-picker-modal');
    info.push('Modal element exists: ' + (modal ? 'YES' : 'NO'));
    
    const buttons = document.querySelectorAll('[data-file-picker]');
    info.push('File picker buttons found: ' + buttons.length);
    
    info.push('jQuery available: ' + (typeof $ !== 'undefined' ? 'YES' : 'NO'));
    
    // Check if CSS is loaded
    const cssLoaded = document.querySelector('link[href*="file-picker.css"]');
    info.push('CSS loaded: ' + (cssLoaded ? 'YES' : 'NO'));
    
    // Check if JS is loaded
    const jsLoaded = document.querySelector('script[src*="file-picker.js"]');
    info.push('JS loaded: ' + (jsLoaded ? 'YES' : 'NO'));
    
    info.push('');
    info.push('Console messages should appear in browser dev tools.');
    
    output.innerHTML = info.join('<br>');
}
</script>

<?php include 'admin_footer.php'; ?>