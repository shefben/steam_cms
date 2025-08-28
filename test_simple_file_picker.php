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
    <title>Simple File Picker Test - Dropzone.js</title>
    
    <!-- Load the new simple file picker -->
    <link rel="stylesheet" href="/2004_cms/cms/admin/css/dropzone.min.css">
    <link rel="stylesheet" href="/2004_cms/cms/admin/css/simple-file-picker.css">
    <script src="/2004_cms/themes/v2_admin/js/jquery.min.js"></script>
    <script src="/2004_cms/cms/admin/js/dropzone.min.js"></script>
    <script src="/2004_cms/cms/admin/js/simple-file-picker.js"></script>
    
    <style>
        body { 
            margin: 20px; 
            font-family: Arial, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .header h1 {
            color: #333;
            margin: 0 0 10px 0;
            font-size: 32px;
        }
        
        .header p {
            color: #666;
            font-size: 16px;
            margin: 0;
        }
        
        .test-section { 
            margin: 30px 0; 
            padding: 25px; 
            border: 2px solid #e9ecef; 
            border-radius: 8px; 
            background: #f8f9fa;
        }
        
        .test-section h3 {
            margin-top: 0;
            color: #495057;
            font-size: 18px;
        }
        
        .btn { 
            padding: 12px 24px; 
            background: #007bff; 
            color: white; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            margin: 10px 5px; 
            font-size: 15px;
            font-weight: 500;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0,123,255,0.2);
        }
        
        .btn:hover { 
            background: #0056b3; 
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,123,255,0.3);
        }
        
        .btn.btn-success {
            background: #28a745;
            box-shadow: 0 2px 4px rgba(40,167,69,0.2);
        }
        
        .btn.btn-success:hover {
            background: #218838;
            box-shadow: 0 4px 8px rgba(40,167,69,0.3);
        }
        
        .result {
            margin-top: 15px;
            padding: 15px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: monospace;
            white-space: pre-wrap;
        }
        
        .success { 
            color: #28a745; 
            font-weight: bold; 
        }
        
        .error { 
            color: #dc3545; 
            font-weight: bold; 
        }
        
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            border: 2px solid #007bff;
            border-radius: 8px;
            margin-top: 15px;
        }
        
        .feature-list {
            background: #e7f3ff;
            border: 1px solid #007bff;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .feature-list h4 {
            color: #0056b3;
            margin-top: 0;
        }
        
        .feature-list ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        
        .feature-list li {
            margin: 5px 0;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Simple File Picker</h1>
            <p>Powered by Dropzone.js - A reliable, proven solution</p>
        </div>
        
        <div class="feature-list">
            <h4>✨ What's New:</h4>
            <ul>
                <li>✅ <strong>Dropzone.js integration</strong> - Battle-tested library used by millions</li>
                <li>✅ <strong>Drag & drop uploads</strong> - Just drag files into the upload area</li>
                <li>✅ <strong>File browsing</strong> - Browse and select existing files</li>
                <li>✅ <strong>Image previews</strong> - See thumbnails of all your images</li>
                <li>✅ <strong>Progress indicators</strong> - Real-time upload progress</li>
                <li>✅ <strong>Error handling</strong> - Clear error messages when things go wrong</li>
                <li>✅ <strong>Responsive design</strong> - Works perfectly on mobile and desktop</li>
            </ul>
        </div>
        
        <div class="test-section">
            <h3>🎯 Test the New File Picker</h3>
            <p>Click the button below to open the file picker. You can:</p>
            <ul>
                <li><strong>Browse Existing:</strong> See all your current images</li>
                <li><strong>Upload New:</strong> Drag & drop or click to upload new files</li>
            </ul>
            
            <button type="button" class="btn"
                    data-simple-file-picker 
                    data-upload-path="images" 
                    data-target="#test-input"
                    data-preview="#test-preview">
                📁 Open File Picker
            </button>
            
            <input type="hidden" id="test-input" name="test_image">
            <img id="test-preview" src="" alt="Preview" class="preview-image" style="display:none;">
            
            <div class="result">
                <strong>Selected file:</strong> <span id="selected-file">None</span>
            </div>
        </div>

        <div class="test-section">
            <h3>🔧 Backend Test</h3>
            <p>Test the file manager backend directly:</p>
            <button type="button" class="btn btn-success" onclick="testBackend()">Test Backend</button>
            <div id="backend-result" class="result" style="display: none;"></div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Simple File Picker test page loaded');
    
    // Monitor the hidden input for changes
    document.getElementById('test-input').addEventListener('change', function() {
        const filename = this.value ? this.value.split('/').pop() : 'None';
        document.getElementById('selected-file').textContent = filename;
        
        if (this.value) {
            const preview = document.getElementById('test-preview');
            preview.src = this.value;
            preview.style.display = 'block';
        }
    });
});

function testBackend() {
    const resultDiv = document.getElementById('backend-result');
    resultDiv.style.display = 'block';
    resultDiv.textContent = 'Testing backend...';
    
    fetch('/2004_cms/cms/admin/file_manager_standalone.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=list&path=images'
    })
    .then(response => {
        console.log('Backend test response:', response.status);
        return response.text();
    })
    .then(text => {
        console.log('Backend test raw response:', text);
        try {
            const data = JSON.parse(text);
            let result = '✅ BACKEND TEST SUCCESSFUL\n\n';
            result += `📁 Path: ${data.path}\n`;
            result += `📊 Files found: ${data.files ? data.files.length : 'N/A'}\n`;
            
            if (data.files && data.files.length > 0) {
                result += '\n📄 Sample files:\n';
                data.files.slice(0, 3).forEach((file, index) => {
                    result += `  ${index + 1}. ${file.name} (${file.size})\n`;
                });
                if (data.files.length > 3) {
                    result += `  ... and ${data.files.length - 3} more\n`;
                }
            }
            
            resultDiv.innerHTML = '<span class="success">' + result + '</span>';
        } catch (e) {
            resultDiv.innerHTML = '<span class="error">❌ JSON Parse Error: ' + e.message + '\n\nRaw response:\n' + text.substring(0, 500) + '</span>';
        }
    })
    .catch(error => {
        console.error('Backend test error:', error);
        resultDiv.innerHTML = '<span class="error">❌ BACKEND ERROR: ' + error.message + '</span>';
    });
}
</script>

</body>
</html>