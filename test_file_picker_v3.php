<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Picker Test - Version 3</title>
    <link rel="stylesheet" href="/2004_cms/cms/admin/css/file-picker.css?v=debug4&t=<?= time() ?>">
    <script src="/2004_cms/themes/v2_admin/js/jquery.min.js"></script>
    <script src="/2004_cms/cms/admin/js/file-picker.js?v=debug4&t=<?= time() ?>"></script>
    <style>
        body { margin: 20px; font-family: Arial, sans-serif; }
        .test-section { margin: 30px 0; padding: 20px; border: 1px solid #ddd; }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; margin: 5px; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>File Picker Test - Version 3 (Cache-Busted)</h1>
    
    <div class="test-section">
        <h3>Test File Picker</h3>
        <button type="button" class="btn" 
                data-file-picker 
                data-upload-path="images" 
                data-target="#test-input"
                data-preview="#test-preview"
                data-allowed-types="png,jpg,jpeg,gif">
            Open File Picker
        </button>
        <input type="hidden" id="test-input" name="test_image">
        <img id="test-preview" src="" alt="Preview" style="max-width:200px;display:none;margin-top:10px;">
        <div style="margin-top: 10px;">Selected file: <span id="selected-file">None</span></div>
    </div>

    <div class="test-section">
        <h3>Debug Info</h3>
        <button type="button" class="btn" onclick="checkEverything()">Check Everything</button>
        <div id="debug-output" style="background: #f5f5f5; padding: 10px; margin-top: 10px; font-family: monospace;"></div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Test page V3: DOM loaded');
    
    // Monitor the hidden input for changes
    document.getElementById('test-input').addEventListener('change', function() {
        document.getElementById('selected-file').textContent = this.value || 'None';
    });
});

function checkEverything() {
    const output = document.getElementById('debug-output');
    const info = [];
    
    info.push('=== File Picker Debug Info V3 ===');
    info.push('Current time: ' + new Date().toLocaleTimeString());
    info.push('filePickerModal exists: ' + (typeof filePickerModal !== 'undefined'));
    info.push('openFilePicker function: ' + (typeof openFilePicker));
    
    if (typeof filePickerModal !== 'undefined' && filePickerModal) {
        const modal = document.getElementById('file-picker-modal');
        info.push('Modal element exists: ' + (modal ? 'YES' : 'NO'));
        
        if (modal) {
            const browseBtn = modal.querySelector('.upload-browse-btn');
            info.push('Browse button in modal: ' + (browseBtn ? 'YES' : 'NO'));
            
            if (browseBtn) {
                info.push('Browse button text: "' + browseBtn.textContent + '"');
                info.push('Browse button class: "' + browseBtn.className + '"');
            }
            
            const uploadPanel = modal.querySelector('#upload-panel');
            info.push('Upload panel exists: ' + (uploadPanel ? 'YES' : 'NO'));
            
            const h3Elements = modal.querySelectorAll('h3');
            info.push('H3 elements in modal: ' + h3Elements.length);
            h3Elements.forEach((h3, index) => {
                info.push('  H3 #' + (index + 1) + ': "' + h3.textContent + '"');
            });
        }
    }
    
    const buttons = document.querySelectorAll('[data-file-picker]');
    info.push('File picker buttons found: ' + buttons.length);
    
    info.push('jQuery available: ' + (typeof $ !== 'undefined' ? 'YES' : 'NO'));
    
    output.innerHTML = info.join('<br>');
}

// Test file manager endpoint
function testFileManager() {
    fetch('/2004_cms/cms/admin/file_manager.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=list&path=images'
    })
    .then(response => {
        console.log('File manager response status:', response.status);
        return response.text();
    })
    .then(text => {
        console.log('File manager raw response:', text);
        try {
            const data = JSON.parse(text);
            console.log('File manager parsed data:', data);
            if (data.success) {
                console.log('Found', data.files.length, 'files');
                data.files.forEach((file, index) => {
                    console.log(`File ${index + 1}:`, file.name, 'at', file.path);
                });
            }
        } catch (e) {
            console.error('JSON parse error:', e);
        }
    })
    .catch(error => {
        console.error('File manager fetch error:', error);
    });
}

// Auto-test file manager on load
setTimeout(testFileManager, 1000);
</script>

</body>
</html>