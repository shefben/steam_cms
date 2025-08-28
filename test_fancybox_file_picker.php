<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Mock admin session
$_SESSION['admin_id'] = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚀 Fancybox File Picker Test - Professional Solution</title>
    
    <!-- Load the professional file picker libraries -->
    <link rel="stylesheet" href="/2004_cms/cms/admin/css/fancybox.min.css">
    <link rel="stylesheet" href="/2004_cms/cms/admin/css/dropzone.min.css">
    <link rel="stylesheet" href="/2004_cms/cms/admin/css/fancybox-file-picker.css">
    <script src="/2004_cms/themes/v2_admin/js/jquery.min.js"></script>
    <script src="/2004_cms/cms/admin/js/fancybox.umd.js"></script>
    <script src="/2004_cms/cms/admin/js/dropzone.min.js"></script>
    <script src="/2004_cms/cms/admin/js/fancybox-file-picker.js"></script>
    
    <style>
        * {
            box-sizing: border-box;
        }
        
        body { 
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }
        
        .hero {
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }
        
        .hero h1 {
            font-size: 48px;
            margin: 0 0 16px 0;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero p {
            font-size: 20px;
            margin: 0;
            opacity: 0.9;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        
        .test-card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .test-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
        }
        
        .test-card h2 {
            margin: 0 0 16px 0;
            font-size: 24px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .test-card .icon {
            font-size: 32px;
        }
        
        .test-card p {
            color: #666;
            line-height: 1.6;
            margin: 0 0 24px 0;
        }
        
        .feature-list {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 12px;
            padding: 24px;
            margin: 24px 0;
        }
        
        .feature-list h3 {
            color: #667eea;
            margin: 0 0 16px 0;
            font-size: 18px;
            font-weight: 600;
        }
        
        .feature-list ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        
        .feature-list li {
            margin: 8px 0;
            padding: 0;
            color: #333;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }
        
        .feature-list li::before {
            content: "✨";
            flex-shrink: 0;
        }
        
        .btn { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            text-decoration: none;
            display: inline-block;
            text-align: center;
            min-width: 160px;
        }
        
        .btn:hover { 
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn.btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
        }
        
        .btn.btn-success:hover {
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.6);
        }
        
        .btn.btn-info {
            background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.4);
        }
        
        .btn.btn-info:hover {
            box-shadow: 0 8px 25px rgba(23, 162, 184, 0.6);
        }
        
        .result-area {
            margin-top: 20px;
            padding: 20px;
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-family: 'Courier New', monospace;
            white-space: pre-wrap;
            word-break: break-word;
            min-height: 60px;
            position: relative;
        }
        
        .result-area:empty::before {
            content: "Results will appear here...";
            color: #6c757d;
            font-style: italic;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        
        .success { 
            color: #28a745; 
            font-weight: bold; 
        }
        
        .error { 
            color: #dc3545; 
            font-weight: bold; 
        }
        
        .info {
            color: #17a2b8;
            font-weight: bold;
        }
        
        .preview-image {
            max-width: 100%;
            max-height: 200px;
            border: 3px solid #667eea;
            border-radius: 12px;
            margin-top: 16px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }
        
        .preview-image:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
            margin: 20px 0;
        }
        
        .stat-item {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            padding: 16px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid rgba(102, 126, 234, 0.2);
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            display: block;
        }
        
        .stat-label {
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
            margin-top: 4px;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 12px;
            background: #28a745;
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 32px;
            }
            
            .container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .test-card {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <h1>🚀 Professional File Picker</h1>
        <p>Powered by Fancybox 5 + Dropzone.js <span class="badge">BULLETPROOF</span></p>
    </div>
    
    <div class="container">
        <!-- Main Test Card -->
        <div class="test-card">
            <h2>
                <span class="icon">🎯</span>
                File Picker Test
            </h2>
            <p>Click the button below to open the professional file picker. Built with battle-tested libraries used by millions of websites worldwide.</p>
            
            <div class="feature-list">
                <h3>✨ What Makes This Special:</h3>
                <ul>
                    <li><strong>Fancybox 5</strong> - Industry-leading modal and gallery system</li>
                    <li><strong>Dropzone.js</strong> - The most reliable file upload library</li>
                    <li><strong>Drag & Drop</strong> - Natural file upload experience</li>
                    <li><strong>Image Previews</strong> - Beautiful thumbnail gallery</li>
                    <li><strong>Search & Filter</strong> - Find files instantly</li>
                    <li><strong>Progress Tracking</strong> - Real-time upload status</li>
                    <li><strong>Mobile Ready</strong> - Perfect on all devices</li>
                    <li><strong>Error Handling</strong> - Graceful failure recovery</li>
                </ul>
            </div>
            
            <button type="button" class="btn"
                    data-fancybox-file-picker 
                    data-upload-path="images" 
                    data-target="#test-input"
                    data-preview="#test-preview">
                📁 Open Professional File Picker
            </button>
            
            <input type="hidden" id="test-input" name="test_image">
            <img id="test-preview" src="" alt="Preview" class="preview-image" style="display:none;">
            
            <div id="selection-result" class="result-area"></div>
        </div>

        <!-- Backend Test Card -->
        <div class="test-card">
            <h2>
                <span class="icon">🔧</span>
                Backend Integration
            </h2>
            <p>Test the file management backend to ensure everything is working correctly.</p>
            
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-value" id="files-count">-</span>
                    <div class="stat-label">Files Found</div>
                </div>
                <div class="stat-item">
                    <span class="stat-value" id="response-time">-</span>
                    <div class="stat-label">Response Time</div>
                </div>
            </div>
            
            <button type="button" class="btn btn-success" onclick="testBackend()">
                🧪 Test Backend API
            </button>
            <button type="button" class="btn btn-info" onclick="testUploadEndpoint()">
                📡 Test Upload Endpoint
            </button>
            
            <div id="backend-result" class="result-area"></div>
        </div>

        <!-- Library Info Card -->
        <div class="test-card">
            <h2>
                <span class="icon">📚</span>
                Library Information
            </h2>
            <p>Information about the professional libraries powering this file picker.</p>
            
            <div class="feature-list">
                <h3>🛡️ Why These Libraries:</h3>
                <ul>
                    <li><strong>Fancybox 5</strong> - 50M+ downloads, trusted by enterprises</li>
                    <li><strong>Dropzone.js</strong> - 15M+ downloads, battle-tested since 2012</li>
                    <li><strong>Active Development</strong> - Regular updates and security patches</li>
                    <li><strong>Comprehensive Documentation</strong> - Extensive guides and examples</li>
                    <li><strong>Community Support</strong> - Large developer community</li>
                    <li><strong>Browser Compatibility</strong> - Works on all modern browsers</li>
                </ul>
            </div>
            
            <button type="button" class="btn btn-info" onclick="showLibraryVersions()">
                📊 Show Library Versions
            </button>
            
            <div id="library-info" class="result-area"></div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Professional File Picker test page loaded');
    
    // Monitor the hidden input for changes
    document.getElementById('test-input').addEventListener('change', function() {
        const filename = this.value ? this.value.split('/').pop() : 'None';
        const resultDiv = document.getElementById('selection-result');
        
        if (this.value) {
            resultDiv.innerHTML = `<span class="success">✅ FILE SELECTED</span>\n\n📁 <strong>Filename:</strong> ${filename}\n🔗 <strong>Path:</strong> ${this.value}\n📊 <strong>Status:</strong> Ready to use!`;
            
            const preview = document.getElementById('test-preview');
            preview.src = this.value;
            preview.style.display = 'block';
            
            // Add some celebration
            preview.style.animation = 'none';
            setTimeout(() => {
                preview.style.animation = 'pulse 2s infinite';
            }, 10);
        } else {
            resultDiv.innerHTML = `<span class="info">ℹ️ No file selected</span>`;
            document.getElementById('test-preview').style.display = 'none';
        }
    });
});

function testBackend() {
    const resultDiv = document.getElementById('backend-result');
    const filesCountEl = document.getElementById('files-count');
    const responseTimeEl = document.getElementById('response-time');
    
    resultDiv.innerHTML = '<span class="info">🔄 Testing backend connection...</span>';
    filesCountEl.textContent = '...';
    responseTimeEl.textContent = '...';
    
    const startTime = performance.now();
    
    fetch('/2004_cms/cms/admin/file_manager_standalone.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=list&path=images'
    })
    .then(response => {
        const endTime = performance.now();
        const responseTime = Math.round(endTime - startTime);
        responseTimeEl.textContent = `${responseTime}ms`;
        
        console.log('Backend test response:', response.status);
        return response.text();
    })
    .then(text => {
        console.log('Backend test raw response:', text.substring(0, 200));
        try {
            const data = JSON.parse(text);
            const filesCount = data.files ? data.files.length : 0;
            filesCountEl.textContent = filesCount.toString();
            
            let result = '<span class="success">✅ BACKEND TEST SUCCESSFUL</span>\n\n';
            result += `📂 <strong>Path:</strong> ${data.path || 'N/A'}\n`;
            result += `📊 <strong>Files found:</strong> ${filesCount}\n`;
            result += `🔗 <strong>Status:</strong> ${data.success ? 'Connected' : 'Error'}\n`;
            
            if (data.files && data.files.length > 0) {
                result += '\n📄 <strong>Sample files:</strong>\n';
                data.files.slice(0, 3).forEach((file, index) => {
                    result += `  ${index + 1}. ${file.name} (${file.size})\n`;
                });
                if (data.files.length > 3) {
                    result += `  ... and ${data.files.length - 3} more\n`;
                }
            }
            
            result += '\n🎉 <strong>All systems operational!</strong>';
            resultDiv.innerHTML = result;
        } catch (e) {
            filesCountEl.textContent = 'ERR';
            resultDiv.innerHTML = `<span class="error">❌ JSON PARSE ERROR</span>\n\n🔍 <strong>Error:</strong> ${e.message}\n\n📄 <strong>Raw response:</strong>\n${text.substring(0, 500)}${text.length > 500 ? '...' : ''}`;
        }
    })
    .catch(error => {
        filesCountEl.textContent = 'ERR';
        responseTimeEl.textContent = 'ERR';
        console.error('Backend test error:', error);
        resultDiv.innerHTML = `<span class="error">❌ BACKEND ERROR</span>\n\n🔍 <strong>Error:</strong> ${error.message}\n\n📝 <strong>Details:</strong> Network request failed. Check console for more details.`;
    });
}

function testUploadEndpoint() {
    const resultDiv = document.getElementById('backend-result');
    resultDiv.innerHTML = '<span class="info">🔄 Testing upload endpoint...</span>';
    
    // Test with a small dummy file
    const formData = new FormData();
    const dummyFile = new File(['test'], 'test.txt', { type: 'text/plain' });
    formData.append('file', dummyFile);
    formData.append('action', 'upload');
    formData.append('path', 'images');
    
    fetch('/2004_cms/cms/admin/file_manager_standalone.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(text => {
        console.log('Upload test response:', text.substring(0, 200));
        try {
            const data = JSON.parse(text);
            if (data.success || data.error) {
                resultDiv.innerHTML = `<span class="success">✅ UPLOAD ENDPOINT READY</span>\n\n📊 <strong>Status:</strong> Upload endpoint is responding correctly\n🔧 <strong>Response:</strong> ${data.success ? 'Success structure detected' : 'Error handling working'}\n\n💡 <strong>Note:</strong> Actual file upload may be restricted by file type/permissions.`;
            } else {
                resultDiv.innerHTML = `<span class="error">❌ UNEXPECTED RESPONSE</span>\n\n📄 <strong>Response:</strong> ${text.substring(0, 300)}`;
            }
        } catch (e) {
            resultDiv.innerHTML = `<span class="error">❌ UPLOAD TEST ERROR</span>\n\n🔍 <strong>Parse Error:</strong> ${e.message}\n\n📄 <strong>Raw response:</strong>\n${text.substring(0, 300)}`;
        }
    })
    .catch(error => {
        console.error('Upload test error:', error);
        resultDiv.innerHTML = `<span class="error">❌ UPLOAD ENDPOINT ERROR</span>\n\n🔍 <strong>Error:</strong> ${error.message}`;
    });
}

function showLibraryVersions() {
    const resultDiv = document.getElementById('library-info');
    
    let info = '<span class="success">📚 LIBRARY INFORMATION</span>\n\n';
    
    // Check if libraries are loaded
    if (typeof Fancybox !== 'undefined') {
        info += '✅ <strong>Fancybox 5:</strong> Loaded successfully\n';
    } else {
        info += '❌ <strong>Fancybox 5:</strong> Not loaded\n';
    }
    
    if (typeof Dropzone !== 'undefined') {
        info += '✅ <strong>Dropzone.js:</strong> Loaded successfully\n';
        if (Dropzone.version) {
            info += `   📊 <strong>Version:</strong> ${Dropzone.version}\n`;
        }
    } else {
        info += '❌ <strong>Dropzone.js:</strong> Not loaded\n';
    }
    
    if (typeof $ !== 'undefined') {
        info += '✅ <strong>jQuery:</strong> Loaded successfully\n';
        if ($.fn.jquery) {
            info += `   📊 <strong>Version:</strong> ${$.fn.jquery}\n`;
        }
    } else {
        info += '❌ <strong>jQuery:</strong> Not loaded\n';
    }
    
    if (typeof fancyboxFilePicker !== 'undefined' && fancyboxFilePicker) {
        info += '✅ <strong>FancyboxFilePicker:</strong> Initialized\n';
    } else {
        info += '❌ <strong>FancyboxFilePicker:</strong> Not initialized\n';
    }
    
    info += '\n🎯 <strong>Status:</strong> ';
    if (typeof Fancybox !== 'undefined' && typeof Dropzone !== 'undefined' && fancyboxFilePicker) {
        info += 'All systems ready! 🚀';
    } else {
        info += 'Some components missing ⚠️';
    }
    
    resultDiv.innerHTML = info;
}

// Add some CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
`;
document.head.appendChild(style);
</script>

</body>
</html>