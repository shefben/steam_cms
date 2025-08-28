# Steam CMS Admin File Picker System

## Overview
The file picker system provides a universal modal interface for selecting existing files or uploading new files in the Steam CMS admin panel. It replaces traditional file input fields with a more user-friendly interface.

## Features
- **Modal Interface**: Dark overlay modal that closes when clicking outside
- **Dual Functionality**: Browse existing files OR upload new files
- **Image Preview**: Thumbnail previews for existing images
- **Multiple File Types**: Supports images, documents, media files
- **Drag & Drop**: Upload files by dragging and dropping
- **Search & Sort**: Filter and sort existing files
- **Path Management**: Organized by upload directories
- **Auto-conversion**: Automatically converts legacy file input fields

## Usage

### Method 1: Data Attributes (Recommended)
```html
<button type="button" class="btn btn-primary" 
        data-file-picker 
        data-upload-path="storefront/images/capsules" 
        data-target="#image-input"
        data-preview="#image-preview"
        data-allowed-types="png,jpg,jpeg">
    Choose or Upload Image
</button>
<input type="hidden" id="image-input" name="image_path">
<img id="image-preview" style="display:none; max-width:200px;">
```

### Method 2: JavaScript Function
```javascript
openFilePicker('images', function(selectedPath) {
    console.log('Selected file:', selectedPath);
    document.getElementById('my-input').value = selectedPath;
}, {
    allowedTypes: ['jpg', 'png', 'gif']
});
```

### Method 3: Media-Specific Function
For files that need to be registered in the media database:
```javascript
openFilePickerForMedia('media', function(selectedPath) {
    console.log('Media file uploaded:', selectedPath);
});
```

## Data Attributes

| Attribute | Description | Example |
|-----------|-------------|---------|
| `data-file-picker` | Marks button as file picker trigger | `data-file-picker` |
| `data-upload-path` | Target upload directory | `data-upload-path="images"` |
| `data-target` | CSS selector for input field to populate | `data-target="#my-input"` |
| `data-preview` | CSS selector for image preview element | `data-preview="#my-preview"` |
| `data-allowed-types` | Comma-separated file extensions | `data-allowed-types="png,jpg,jpeg"` |

## Upload Directories

The following upload paths are available:

- `images` - General images
- `storefront/images` - Storefront images
- `storefront/images/capsules` - Game capsules
- `storefront/images/apps` - Application images
- `themes` - Theme assets
- `platform/banner` - Platform banners
- `media` - Media files (registered in database)
- `uploads` - General uploads

## File Types

### Images
- `jpg`, `jpeg`, `png`, `gif`, `webp`, `svg`, `bmp`

### Media
- `mp4`, `mp3`, `wav`, `ogg`

### Documents
- `pdf`, `doc`, `docx`, `txt`

### Archives
- `zip`, `rar`, `tar`, `gz`

## Automatic Conversion

The system automatically converts traditional file input fields:

```html
<!-- This will be automatically converted -->
<input type="file" name="upload" accept="image/*">

<!-- Becomes this -->
<button type="button" class="btn btn-primary" data-file-picker>
    Choose or Upload File
</button>
<input type="hidden" name="upload_path">
```

## CSS Classes

### Buttons
- `.btn` - Base button class
- `.btn-primary` - Primary blue button
- `.btn-secondary` - Secondary gray button
- `.btn-small` - Smaller button size

### Containers
- `.file-picker-container` - Container for file picker button and info
- `.selected-file-name` - Display selected file name

## Events

### fileSelected Event
Triggered when a file is selected:
```javascript
document.addEventListener('fileSelected', function(e) {
    console.log('File selected:', e.detail.path);
    console.log('File name:', e.detail.fileName);
    console.log('Original input:', e.detail.originalInput);
});
```

## Backend Integration

### File Manager Endpoints
- `file_manager.php?action=list&path=images` - List files
- `file_manager.php` (POST) - Upload files
- `media_register.php` - Register media files in database

### Security
- Path traversal protection
- File type validation
- Size limits (10MB default)
- Admin permission required

## Examples

### Basic Image Upload
```html
<div class="form-row">
    <label>Product Image</label>
    <button type="button" class="btn btn-primary" 
            data-file-picker 
            data-upload-path="storefront/images/apps" 
            data-target="#product-image"
            data-preview="#product-preview"
            data-allowed-types="png,jpg">
        Choose Product Image
    </button>
    <input type="hidden" id="product-image" name="product_image">
    <img id="product-preview" style="max-width:200px; display:none;">
</div>
```

### Dynamic File Picker (JavaScript)
```javascript
function selectBannerImage() {
    openFilePicker('platform/banner', function(selectedPath) {
        $('#banner-path').val(selectedPath);
        $('#banner-preview').attr('src', selectedPath).show();
    }, {
        allowedTypes: ['jpg', 'png', 'gif']
    });
}
```

### Media Library Integration
```javascript
$('#add-media-btn').click(function() {
    openFilePickerForMedia('media', function(selectedPath) {
        // File automatically registered in media table
        location.reload(); // Refresh to show new file
    });
});
```

## Troubleshooting

### File Not Appearing
- Check upload directory permissions
- Verify path in `allowedPaths` array in `file_manager.php`
- Check browser console for JavaScript errors

### Upload Fails
- Verify file size under 10MB
- Check file type is in allowed extensions
- Ensure admin has proper permissions

### Modal Not Opening
- Check that file-picker.js is loaded
- Verify jQuery is available
- Check for JavaScript console errors
- Ensure modal HTML is present in DOM

## Customization

### Custom Upload Path
Add new paths to `$allowedPaths` in `file_manager.php`:
```php
$allowedPaths = [
    'custom' => '/custom/directory',
    // ... existing paths
];
```

### Custom File Types
Modify `$allowedExtensions` in `file_manager.php`:
```php
$allowedExtensions = ['jpg', 'png', 'custom_ext'];
```

### Custom Styling
Override CSS classes in your admin theme:
```css
.file-picker-modal {
    /* Custom modal styling */
}

[data-file-picker] {
    /* Custom button styling */
}
```