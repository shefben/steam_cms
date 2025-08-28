<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Mock admin session
$_SESSION['admin_id'] = 1;

// Generate unique cache buster
$cacheBuster = time() . '_' . rand(1000, 9999);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Force Refresh File Picker Test - <?= $cacheBuster ?></title>
    
    <!-- Force refresh all assets with unique cache busters -->
    <link rel="stylesheet" href="/2004_cms/cms/admin/css/file-picker.css?force=<?= $cacheBuster ?>">
    <script src="/2004_cms/themes/v2_admin/js/jquery.min.js?force=<?= $cacheBuster ?>"></script>
    <script src="/2004_cms/cms/admin/js/file-picker.js?force=<?= $cacheBuster ?>"></script>
    
    <!-- Disable all caching -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    <style>
        body { margin: 20px; font-family: Arial, sans-serif; background: #f0f8ff; }
        .test-section { margin: 30px 0; padding: 20px; border: 2px solid #007bff; border-radius: 8px; background: white; }
        .btn { padding: 12px 24px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; margin: 10px; font-size: 16px; }
        .btn:hover { background: #0056b3; }
        .cache-info { background: #fffacd; padding: 15px; border: 1px solid #ffd700; border-radius: 4px; margin: 20px 0; }
        .success { color: #28a745; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>
    <h1>🔄 FORCE REFRESH FILE PICKER TEST</h1>
    <h2>Cache Buster: <?= $cacheBuster ?></h2>
    
    <div class="cache-info">
        <h3>⚠️ IMPORTANT BROWSER CACHE CLEARING INSTRUCTIONS:</h3>
        <ol>
            <li><strong>Hard Refresh:</strong> Press <kbd>Ctrl+F5</kbd> (Windows) or <kbd>Cmd+Shift+R</kbd> (Mac)</li>
            <li><strong>Clear Browser Cache:</strong> 
                <ul>
                    <li>Chrome: F12 → Network tab → Right-click "Disable cache" → Refresh</li>
                    <li>Firefox: F12 → Network tab → Settings gear → "Disable cache" → Refresh</li>
                </ul>
            </li>
            <li><strong>Incognito/Private Mode:</strong> Open this page in a private browsing window</li>
        </ol>
        <p><strong>If you still see the old interface after these steps, the cache is very aggressive!</strong></p>
    </div>
    
    <div class="test-section">
        <h3>🎯 File Picker Test</h3>
        <p><strong>What you SHOULD see when clicking the button:</strong></p>
        <ul>
            <li>Modal opens with dark semi-transparent overlay</li>
            <li>Two tabs: "Browse Existing" and "Upload New"</li>
            <li>Upload tab has a prominent blue "Browse Files" button</li>
            <li>Browse tab shows image thumbnails if images exist</li>
        </ul>
        
        <button type="button" class="btn" 
                data-file-picker 
                data-upload-path="images" 
                data-target="#test-input"
                data-preview="#test-preview"
                data-allowed-types="png,jpg,jpeg,gif">
            🚀 OPEN FILE PICKER (FORCE REFRESH)
        </button>
        
        <input type="hidden" id="test-input" name="test_image">
        <img id="test-preview" src="" alt="Preview" style="max-width:200px;display:none;margin-top:10px;">
        <div style="margin-top: 10px;">Selected file: <span id="selected-file">None</span></div>
    </div>

    <div class="test-section">
        <h3>🔍 Real-Time Debug Monitor</h3>
        <button type="button" class="btn" onclick="runDiagnostics()">Run Diagnostics</button>
        <button type="button" class="btn" onclick="testFileManager()">Test Backend</button>
        <div id="diagnostic-output" style="background: #f8f9fa; padding: 15px; margin-top: 15px; border: 1px solid #dee2e6; border-radius: 4px; font-family: monospace; white-space: pre-wrap;"></div>
    </div>

<script>
console.log('🔄 Force refresh test page loaded - Cache buster: <?= $cacheBuster ?>');

document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ DOM loaded');
    
    // Monitor the hidden input for changes
    document.getElementById('test-input').addEventListener('change', function() {
        document.getElementById('selected-file').textContent = this.value || 'None';
    });
    
    // Auto-run diagnostics
    setTimeout(runDiagnostics, 1000);
});

function runDiagnostics() {
    const output = document.getElementById('diagnostic-output');
    const results = [];
    
    results.push('🔄 FORCE REFRESH DIAGNOSTICS - Cache: <?= $cacheBuster ?>');
    results.push('⏰ ' + new Date().toLocaleString());
    results.push('');
    
    // Check if FilePickerModal class exists
    results.push('📁 FilePickerModal class: ' + (typeof FilePickerModal !== 'undefined' ? '✅ FOUND' : '❌ MISSING'));
    
    // Check if global instance exists
    results.push('🌐 filePickerModal instance: ' + (typeof filePickerModal !== 'undefined' && filePickerModal ? '✅ FOUND' : '❌ MISSING'));
    
    // Check jQuery
    results.push('💎 jQuery: ' + (typeof $ !== 'undefined' ? '✅ v' + $.fn.jquery : '❌ MISSING'));
    
    // Check if modal element exists in DOM
    const modal = document.getElementById('file-picker-modal');
    results.push('🎭 Modal element: ' + (modal ? '✅ EXISTS' : '❌ MISSING'));
    
    if (modal) {
        // Check for upload panel content
        const uploadPanel = modal.querySelector('#upload-panel');
        results.push('📤 Upload panel: ' + (uploadPanel ? '✅ EXISTS' : '❌ MISSING'));
        
        if (uploadPanel) {
            const browseBtn = uploadPanel.querySelector('.upload-browse-btn');
            results.push('🔘 Browse button: ' + (browseBtn ? '✅ EXISTS' : '❌ MISSING'));
            
            if (browseBtn) {
                results.push('📝 Button text: "' + browseBtn.textContent.trim() + '"');
                results.push('🎨 Button classes: "' + browseBtn.className + '"');
            }
            
            // Check for new upload UI elements
            const h3 = uploadPanel.querySelector('h3');
            results.push('📋 Upload heading: ' + (h3 ? '✅ "' + h3.textContent + '"' : '❌ MISSING'));
            
            const divider = uploadPanel.querySelector('.upload-divider');
            results.push('➗ Upload divider: ' + (divider ? '✅ EXISTS' : '❌ MISSING'));
        }
        
        // Check browse panel
        const browsePanel = modal.querySelector('#browse-panel');
        results.push('📋 Browse panel: ' + (browsePanel ? '✅ EXISTS' : '❌ MISSING'));
        
        if (browsePanel) {
            const grid = browsePanel.querySelector('#file-grid');
            results.push('🎯 File grid: ' + (grid ? '✅ EXISTS' : '❌ MISSING'));
        }
    }
    
    // Check buttons
    const buttons = document.querySelectorAll('[data-file-picker]');
    results.push('🔘 File picker buttons: ' + buttons.length + ' found');
    
    // Check asset loading
    const cssLink = document.querySelector('link[href*="file-picker.css"]');
    const jsScript = document.querySelector('script[src*="file-picker.js"]');
    results.push('🎨 CSS loaded: ' + (cssLink ? '✅ ' + cssLink.href : '❌ MISSING'));
    results.push('📜 JS loaded: ' + (jsScript ? '✅ ' + jsScript.src : '❌ MISSING'));
    
    results.push('');
    results.push('🎯 EXPECTED RESULT: When you click the file picker button above:');
    results.push('   1. Modal should open with dark overlay');
    results.push('   2. Upload tab should have blue "Browse Files" button');
    results.push('   3. Browse tab should show image thumbnails');
    results.push('');
    results.push('❌ If you still see old interface, clear browser cache completely!');
    
    output.textContent = results.join('\n');
}

function testFileManager() {
    console.log('🧪 Testing standalone file manager...');
    fetch('/2004_cms/cms/admin/file_manager_standalone.php?cache=' + Date.now(), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=list&path=images'
    })
    .then(response => {
        console.log('📡 File manager response:', response.status);
        return response.text();
    })
    .then(text => {
        const output = document.getElementById('diagnostic-output');
        try {
            const data = JSON.parse(text);
            output.textContent += '\n\n🧪 BACKEND TEST:\n';
            output.textContent += '✅ File manager working\n';
            output.textContent += '📁 Files found: ' + (data.files ? data.files.length : 'N/A') + '\n';
            if (data.files && data.files.length > 0) {
                output.textContent += '📄 Sample file: ' + data.files[0].name + '\n';
                output.textContent += '🔗 Sample path: ' + data.files[0].path + '\n';
            }
        } catch (e) {
            output.textContent += '\n\n❌ BACKEND ERROR:\n' + text.substring(0, 300);
        }
    });
}
</script>

</body>
</html>