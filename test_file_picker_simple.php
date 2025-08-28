<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Picker Test</title>
    <link rel="stylesheet" href="/cms/admin/css/file-picker.css">
    <script src="/themes/v2_admin/js/jquery.min.js"></script>
    <script src="/cms/admin/js/file-picker.js"></script>
    <style>
        body { margin: 20px; font-family: Arial, sans-serif; }
        .test-section { margin: 30px 0; padding: 20px; border: 1px solid #ddd; }
        .debug-output { background: #f5f5f5; padding: 10px; margin: 10px 0; font-family: monospace; }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>File Picker Test - Simple Version</h1>
    
    <div class="test-section">
        <h3>Test 1: Data Attribute Method</h3>
        <button type="button" class="btn" 
                data-file-picker 
                data-upload-path="images" 
                data-target="#test-input-1"
                data-preview="#test-preview-1"
                data-allowed-types="png,jpg,jpeg,gif">
            Choose or Upload Image
        </button>
        <input type="hidden" id="test-input-1" name="test_image">
        <img id="test-preview-1" src="" alt="Preview" style="max-width:200px;display:none;margin-top:10px;">
        <div style="margin-top: 10px;">Selected file: <span id="selected-file-1">None</span></div>
    </div>

    <div class="test-section">
        <h3>Test 2: JavaScript Method</h3>
        <button type="button" class="btn" id="js-test-button">
            Choose Image (JavaScript)
        </button>
        <img id="test-preview-2" src="" alt="Preview" style="max-width:200px;display:none;margin-top:10px;">
        <div style="margin-top: 10px;">Selected file: <span id="selected-file-2">None</span></div>
    </div>

    <div class="test-section">
        <h3>Debug Information</h3>
        <button type="button" class="btn" onclick="runDebug()">Run Debug Check</button>
        <div id="debug-output" class="debug-output">Click the debug button to see information...</div>
    </div>

    <div class="test-section">
        <h3>File Manager Test</h3>
        <button type="button" class="btn" onclick="testFileManager()">Test File Manager Backend</button>
        <div id="file-manager-output" class="debug-output">Click to test the file manager backend...</div>
    </div>

<script>
// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('Simple test: DOM loaded');
    
    // Monitor the hidden input for changes
    const testInput1 = document.getElementById('test-input-1');
    if (testInput1) {
        testInput1.addEventListener('change', function() {
            document.getElementById('selected-file-1').textContent = this.value || 'None';
        });
    }
    
    // Test JavaScript method
    const jsButton = document.getElementById('js-test-button');
    if (jsButton) {
        jsButton.addEventListener('click', function() {
            console.log('Simple test: JavaScript button clicked');
            
            if (typeof openFilePicker === 'function') {
                openFilePicker('images', function(selectedPath) {
                    console.log('Simple test: File selected via JS:', selectedPath);
                    const preview = document.getElementById('test-preview-2');
                    if (preview) {
                        preview.src = selectedPath;
                        preview.style.display = 'block';
                    }
                    document.getElementById('selected-file-2').textContent = selectedPath;
                }, {
                    allowedTypes: ['jpg', 'jpeg', 'png', 'gif']
                });
            } else {
                console.error('openFilePicker function not available!');
                alert('openFilePicker function not available!');
            }
        });
    }
});

function runDebug() {
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
    
    // Check console for errors
    info.push('');
    info.push('Browser console should show initialization messages.');
    info.push('If you see errors in console, that\'s the issue!');
    
    output.innerHTML = info.join('<br>');
}

function testFileManager() {
    const output = document.getElementById('file-manager-output');
    output.innerHTML = 'Testing file manager...';
    
    fetch('/cms/admin/file_manager.php', {
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
        let data;
        try {
            data = JSON.parse(text);
            console.log('File manager parsed data:', data);
        } catch (e) {
            console.error('Failed to parse JSON:', e);
            output.innerHTML = 'Error: Response is not valid JSON<br>Raw response: ' + text;
            return;
        }
        
        if (data.success) {
            output.innerHTML = 'Success! Found ' + data.files.length + ' files<br>' +
                              'Files: ' + data.files.map(f => f.name).join(', ');
        } else {
            output.innerHTML = 'Error: ' + (data.error || 'Unknown error');
        }
    })
    .catch(error => {
        console.error('File manager fetch error:', error);
        output.innerHTML = 'Fetch Error: ' + error.message;
    });
}
</script>

</body>
</html>