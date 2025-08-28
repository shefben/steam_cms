<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Mock admin session
$_SESSION['admin_id'] = 1;

require_once __DIR__ . '/cms/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>File Picker Debug Test</title>
    <link rel="stylesheet" href="/2004_cms/cms/admin/css/file-picker.css?v=debug4&t=<?= time() ?>">
    <script src="/2004_cms/themes/v2_admin/js/jquery.min.js"></script>
    <script src="/2004_cms/cms/admin/js/file-picker.js?v=debug4&t=<?= time() ?>"></script>
    <style>
        body { margin: 20px; font-family: Arial, sans-serif; }
        .test-section { margin: 30px 0; padding: 20px; border: 1px solid #ddd; }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; margin: 5px; }
        .btn:hover { background: #0056b3; }
        .debug-info { background: #f8f9fa; padding: 15px; margin: 10px 0; border: 1px solid #e9ecef; }
        
        /* Debug styles to make elements more visible */
        .file-picker-grid { 
            border: 2px solid red !important; 
            min-height: 200px !important;
            background: #fff !important;
        }
        .file-picker-item { 
            border: 2px solid blue !important; 
            background: yellow !important;
            margin: 5px !important;
            padding: 10px !important;
        }
        .file-picker-thumb img {
            border: 2px solid green !important;
            max-width: 100px !important;
            max-height: 100px !important;
        }
    </style>
</head>
<body>
    <h1>File Picker Debug Test - Detailed Debugging</h1>
    
    <div class="test-section">
        <h3>Test File Picker</h3>
        <button type="button" class="btn" 
                data-file-picker 
                data-upload-path="images" 
                data-target="#test-input"
                data-preview="#test-preview"
                data-allowed-types="png,jpg,jpeg,gif">
            Open File Picker (DEBUG MODE)
        </button>
        <input type="hidden" id="test-input" name="test_image">
        <img id="test-preview" src="" alt="Preview" style="max-width:200px;display:none;margin-top:10px;">
        <div style="margin-top: 10px;">Selected file: <span id="selected-file">None</span></div>
    </div>

    <div class="test-section">
        <h3>Debug Controls</h3>
        <button type="button" class="btn" onclick="debugModal()">Debug Modal State</button>
        <button type="button" class="btn" onclick="debugGrid()">Debug Grid Contents</button>
        <button type="button" class="btn" onclick="testDirectFileManager()">Test File Manager Direct</button>
        <div id="debug-output" class="debug-info"></div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Debug test page: DOM loaded');
    
    // Monitor the hidden input for changes
    document.getElementById('test-input').addEventListener('change', function() {
        document.getElementById('selected-file').textContent = this.value || 'None';
    });
});

function debugModal() {
    const output = document.getElementById('debug-output');
    const info = [];
    
    info.push('=== Modal Debug Info ===');
    info.push('Date: ' + new Date().toLocaleString());
    info.push('filePickerModal exists: ' + (typeof filePickerModal !== 'undefined'));
    
    if (typeof filePickerModal !== 'undefined' && filePickerModal) {
        const modal = document.getElementById('file-picker-modal');
        info.push('Modal element exists: ' + (modal ? 'YES' : 'NO'));
        
        if (modal) {
            info.push('Modal display: ' + modal.style.display);
            info.push('Modal class: ' + modal.className);
            
            const grid = modal.querySelector('#file-grid');
            info.push('Grid exists: ' + (grid ? 'YES' : 'NO'));
            if (grid) {
                info.push('Grid innerHTML length: ' + grid.innerHTML.length);
                info.push('Grid children count: ' + grid.children.length);
                info.push('Grid first 100 chars: ' + grid.innerHTML.substring(0, 100));
            }
            
            const items = modal.querySelectorAll('.file-picker-item');
            info.push('File picker items found: ' + items.length);
            
            const browsePanel = modal.querySelector('#browse-panel');
            info.push('Browse panel exists: ' + (browsePanel ? 'YES' : 'NO'));
            if (browsePanel) {
                info.push('Browse panel has active class: ' + browsePanel.classList.contains('active'));
            }
            
            const uploadPanel = modal.querySelector('#upload-panel');
            info.push('Upload panel exists: ' + (uploadPanel ? 'YES' : 'NO'));
            if (uploadPanel) {
                info.push('Upload panel has active class: ' + uploadPanel.classList.contains('active'));
            }
        }
    }
    
    output.innerHTML = info.join('<br>');
}

function debugGrid() {
    const output = document.getElementById('debug-output');
    const info = [];
    
    info.push('=== Grid Debug Info ===');
    
    if (typeof filePickerModal !== 'undefined' && filePickerModal) {
        const modal = document.getElementById('file-picker-modal');
        if (modal) {
            const grid = modal.querySelector('#file-grid');
            if (grid) {
                info.push('Grid HTML content:');
                info.push('<pre style="background:#f0f0f0;padding:10px;margin:5px 0;">' + 
                         grid.innerHTML.substring(0, 1000) + '</pre>');
                
                const items = grid.querySelectorAll('.file-picker-item');
                info.push('Items found in grid: ' + items.length);
                
                items.forEach((item, index) => {
                    if (index < 5) { // Show first 5 items
                        info.push(`Item ${index + 1}: ${item.dataset.filename} (${item.dataset.path})`);
                    }
                });
                
                if (items.length > 5) {
                    info.push(`... and ${items.length - 5} more items`);
                }
            } else {
                info.push('Grid not found!');
            }
        } else {
            info.push('Modal not found!');
        }
    } else {
        info.push('filePickerModal not initialized!');
    }
    
    output.innerHTML = info.join('<br>');
}

function testDirectFileManager() {
    console.log('Testing file manager directly...');
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
        const output = document.getElementById('debug-output');
        
        try {
            const data = JSON.parse(text);
            console.log('File manager parsed data:', data);
            
            const info = [];
            info.push('=== Direct File Manager Test ===');
            info.push('Response status: SUCCESS');
            info.push('Files found: ' + (data.files ? data.files.length : 'N/A'));
            
            if (data.files && data.files.length > 0) {
                info.push('First 3 files:');
                for (let i = 0; i < Math.min(3, data.files.length); i++) {
                    const file = data.files[i];
                    info.push(`  ${i + 1}. ${file.name} (${file.path})`);
                }
            }
            
            output.innerHTML = info.join('<br>');
        } catch (e) {
            console.error('JSON parse error:', e);
            const info = [];
            info.push('=== Direct File Manager Test ===');
            info.push('Response status: ERROR');
            info.push('JSON parse error: ' + e.message);
            info.push('Raw response (first 500 chars):');
            info.push('<pre style="background:#ffe0e0;padding:10px;margin:5px 0;">' + 
                     text.substring(0, 500) + '</pre>');
            
            output.innerHTML = info.join('<br>');
        }
    })
    .catch(error => {
        console.error('File manager fetch error:', error);
        const output = document.getElementById('debug-output');
        output.innerHTML = '=== Direct File Manager Test ===<br>FETCH ERROR: ' + error.message;
    });
}

// Auto-test on load
setTimeout(function() {
    console.log('Running auto-debug...');
    debugModal();
}, 2000);
</script>

</body>
</html>