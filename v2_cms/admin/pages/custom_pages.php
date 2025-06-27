<?php
// Custom pages management

$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                try {
                    $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9\s-]/', '', $_POST['slug'])));
                    $slug = preg_replace('/\s+/', '-', $slug);
                    
                    $data = [
                        'theme' => $current_theme,
                        'title' => $_POST['title'],
                        'slug' => $slug,
                        'content' => $_POST['content'],
                        'exclude_header' => isset($_POST['exclude_header']) ? 1 : 0,
                        'exclude_footer' => isset($_POST['exclude_footer']) ? 1 : 0,
                        'exclude_navigation' => isset($_POST['exclude_navigation']) ? 1 : 0,
                        'sort_order' => $_POST['sort_order']
                    ];
                    
                    $db->insert('custom_pages', $data);
                    $message = '<div class="alert alert-success">Custom page created successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'update':
                try {
                    $id = $_POST['id'];
                    $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9\s-]/', '', $_POST['slug'])));
                    $slug = preg_replace('/\s+/', '-', $slug);
                    
                    $data = [
                        'title' => $_POST['title'],
                        'slug' => $slug,
                        'content' => $_POST['content'],
                        'exclude_header' => isset($_POST['exclude_header']) ? 1 : 0,
                        'exclude_footer' => isset($_POST['exclude_footer']) ? 1 : 0,
                        'exclude_navigation' => isset($_POST['exclude_navigation']) ? 1 : 0,
                        'sort_order' => $_POST['sort_order']
                    ];
                    
                    $db->update('custom_pages', $data, 'id = ?', [$id]);
                    $message = '<div class="alert alert-success">Custom page updated successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'delete':
                try {
                    $id = $_POST['id'];
                    $db->delete('custom_pages', 'id = ?', [$id]);
                    $message = '<div class="alert alert-success">Custom page deleted successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'toggle_active':
                try {
                    $id = $_POST['id'];
                    $page = $db->queryOne("SELECT is_active FROM custom_pages WHERE id = ?", [$id]);
                    $new_status = $page['is_active'] ? 0 : 1;
                    $db->update('custom_pages', ['is_active' => $new_status], 'id = ?', [$id]);
                    $message = '<div class="alert alert-success">Page status updated!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
        }
    }
}

// Get editing page if specified
$editing_page = null;
if (isset($_GET['edit'])) {
    $editing_page = $db->queryOne("SELECT * FROM custom_pages WHERE id = ?", [$_GET['edit']]);
}

// Get all custom pages for current theme
$custom_pages = $db->query(
    "SELECT * FROM custom_pages WHERE theme = ? ORDER BY sort_order ASC, title ASC", 
    [$current_theme]
);
?>

<?= $message ?>

<div class="form-actions" style="margin-bottom: 30px;">
    <button type="button" class="btn btn-primary" onclick="togglePageForm()">
        <?= $editing_page ? 'Cancel Edit' : 'Add New Page' ?>
    </button>
</div>

<!-- Page Form -->
<div id="page-form" class="card" style="<?= $editing_page ? '' : 'display: none;' ?>">
    <div class="card-header">
        <h3><?= $editing_page ? 'Edit Custom Page' : 'Create New Custom Page' ?></h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="<?= $editing_page ? 'update' : 'create' ?>">
            <?php if ($editing_page): ?>
                <input type="hidden" name="id" value="<?= $editing_page['id'] ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title">Page Title *</label>
                    <input type="text" id="title" name="title" class="form-control" 
                           value="<?= htmlspecialchars($editing_page['title'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="slug">URL Slug *</label>
                    <input type="text" id="slug" name="slug" class="form-control" 
                           value="<?= htmlspecialchars($editing_page['slug'] ?? '') ?>" required
                           placeholder="page-url-slug">
                    <small style="color: #7f8c8d;">URL will be: <?= $cms->getSiteRoot() ?>/index.php?page=custom&slug=your-slug&theme=<?= $current_theme ?></small>
                </div>
            </div>
            
            <div class="form-group">
                <label for="content">Page Content *</label>
                <div style="border: 1px solid #ddd; border-radius: 4px;">
                    <div id="editor-toolbar" style="border-bottom: 1px solid #ddd; padding: 10px; background: #f8f9fa;">
                        <button type="button" onclick="formatText('bold')" class="btn btn-small">B</button>
                        <button type="button" onclick="formatText('italic')" class="btn btn-small">I</button>
                        <button type="button" onclick="formatText('underline')" class="btn btn-small">U</button>
                        <span style="margin: 0 10px;">|</span>
                        <button type="button" onclick="insertHeading()" class="btn btn-small">H</button>
                        <button type="button" onclick="insertLink()" class="btn btn-small">Link</button>
                        <button type="button" onclick="insertImage()" class="btn btn-small">Image</button>
                        <span style="margin: 0 10px;">|</span>
                        <button type="button" onclick="insertList('ul')" class="btn btn-small">• List</button>
                        <button type="button" onclick="insertList('ol')" class="btn btn-small">1. List</button>
                    </div>
                    <div id="content-editor" 
                         contenteditable="true" 
                         style="min-height: 300px; padding: 15px; outline: none;"
                         onkeyup="updateHiddenField()"
                         onpaste="updateHiddenField()"><?= $editing_page['content'] ?? '' ?></div>
                </div>
                <textarea id="content" name="content" style="display: none;" required><?= htmlspecialchars($editing_page['content'] ?? '') ?></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="form-control" 
                           value="<?= $editing_page['sort_order'] ?? (count($custom_pages) + 1) ?>" min="0">
                </div>
                <div class="form-group">
                    <label>Page Options</label>
                    <div style="margin-top: 8px;">
                        <label style="display: block; margin-bottom: 5px;">
                            <input type="checkbox" name="exclude_header" value="1" 
                                   <?= ($editing_page['exclude_header'] ?? false) ? 'checked' : '' ?>>
                            Exclude Header
                        </label>
                        <label style="display: block; margin-bottom: 5px;">
                            <input type="checkbox" name="exclude_footer" value="1" 
                                   <?= ($editing_page['exclude_footer'] ?? false) ? 'checked' : '' ?>>
                            Exclude Footer
                        </label>
                        <label style="display: block;">
                            <input type="checkbox" name="exclude_navigation" value="1" 
                                   <?= ($editing_page['exclude_navigation'] ?? false) ? 'checked' : '' ?>>
                            Exclude Navigation (keep logo only)
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <?= $editing_page ? 'Update Page' : 'Create Page' ?>
                </button>
                <button type="button" class="btn btn-danger" onclick="togglePageForm()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Pages List -->
<div class="card">
    <div class="card-header">
        <h3>Custom Pages for <?= htmlspecialchars($current_theme) ?></h3>
    </div>
    <div class="card-body">
        <?php if (empty($custom_pages)): ?>
            <p>No custom pages found for this theme. <a href="#" onclick="togglePageForm()">Create the first one!</a></p>
        <?php else: ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>URL Slug</th>
                        <th>Options</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($custom_pages as $page): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($page['title']) ?></strong>
                                <br><small style="color: #7f8c8d;">
                                    Created: <?= date('M j, Y', strtotime($page['created_at'])) ?>
                                </small>
                            </td>
                            <td>
                                <code><?= htmlspecialchars($page['slug']) ?></code>
                                <br><small>
                                    <a href="<?= $cms->getSiteRoot() ?>/index.php?page=custom&slug=<?= urlencode($page['slug']) ?>&theme=<?= $current_theme ?>" 
                                       target="_blank" style="color: #3498db;">View Page →</a>
                                </small>
                            </td>
                            <td>
                                <?php if ($page['exclude_header']): ?><span class="badge badge-warning">No Header</span><br><?php endif; ?>
                                <?php if ($page['exclude_footer']): ?><span class="badge badge-warning">No Footer</span><br><?php endif; ?>
                                <?php if ($page['exclude_navigation']): ?><span class="badge badge-warning">No Navigation</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="badge <?= $page['is_active'] ? 'badge-success' : 'badge-danger' ?>">
                                    <?= $page['is_active'] ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="?action=custom_pages&theme=<?= $current_theme ?>&edit=<?= $page['id'] ?>" 
                                   class="btn btn-small btn-warning">Edit</a>
                                
                                <form method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Toggle page status?')">
                                    <input type="hidden" name="action" value="toggle_active">
                                    <input type="hidden" name="id" value="<?= $page['id'] ?>">
                                    <button type="submit" class="btn btn-small <?= $page['is_active'] ? 'btn-warning' : 'btn-success' ?>">
                                        <?= $page['is_active'] ? 'Deactivate' : 'Activate' ?>
                                    </button>
                                </form>
                                
                                <form method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this page?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $page['id'] ?>">
                                    <button type="submit" class="btn btn-small btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<script>
function togglePageForm() {
    const form = document.getElementById('page-form');
    const isVisible = form.style.display !== 'none';
    
    if (isVisible) {
        form.style.display = 'none';
        <?php if (!$editing_page): ?>
        form.querySelector('form').reset();
        document.getElementById('content-editor').innerHTML = '';
        <?php endif; ?>
    } else {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth' });
    }
}

// WYSIWYG Editor Functions
function formatText(command) {
    document.execCommand(command, false, null);
    updateHiddenField();
}

function insertHeading() {
    const text = prompt('Enter heading text:');
    if (text) {
        document.execCommand('insertHTML', false, '<h3>' + text + '</h3>');
        updateHiddenField();
    }
}

function insertLink() {
    const url = prompt('Enter URL:');
    if (url) {
        const text = prompt('Enter link text:') || url;
        document.execCommand('insertHTML', false, '<a href="' + url + '">' + text + '</a>');
        updateHiddenField();
    }
}

function insertImage() {
    const url = prompt('Enter image URL:');
    if (url) {
        const alt = prompt('Enter alt text:') || 'Image';
        document.execCommand('insertHTML', false, '<img src="' + url + '" alt="' + alt + '" style="max-width: 100%;">');
        updateHiddenField();
    }
}

function insertList(type) {
    if (type === 'ul') {
        document.execCommand('insertUnorderedList', false, null);
    } else {
        document.execCommand('insertOrderedList', false, null);
    }
    updateHiddenField();
}

function updateHiddenField() {
    const editor = document.getElementById('content-editor');
    const hiddenField = document.getElementById('content');
    hiddenField.value = editor.innerHTML;
}

// Auto-generate slug from title
document.getElementById('title').addEventListener('keyup', function() {
    const title = this.value;
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/^-+|-+$/g, '');
    
    if (!document.getElementById('slug').value || document.getElementById('slug').dataset.auto !== 'false') {
        document.getElementById('slug').value = slug;
        document.getElementById('slug').dataset.auto = 'true';
    }
});

document.getElementById('slug').addEventListener('input', function() {
    this.dataset.auto = 'false';
});
</script>

<style>
.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: bold;
    text-transform: uppercase;
    display: inline-block;
    margin: 2px;
}

.badge-success {
    background: #27ae60;
    color: white;
}

.badge-danger {
    background: #e74c3c;
    color: white;
}

.badge-warning {
    background: #f39c12;
    color: white;
}

#content-editor {
    line-height: 1.5;
}

#content-editor h1, #content-editor h2, #content-editor h3 {
    margin: 15px 0 10px 0;
    color: #2c3e50;
}

#content-editor p {
    margin: 10px 0;
}

#content-editor a {
    color: #3498db;
    text-decoration: underline;
}

#content-editor ul, #content-editor ol {
    margin: 10px 0;
    padding-left: 30px;
}
</style>
