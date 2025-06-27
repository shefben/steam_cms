<?php
// Navigation management page

$nav_model = new NavigationModel($db);
$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                try {
                    $data = [
                        'theme' => $current_theme,
                        'title' => $_POST['title'],
                        'url' => $_POST['url'],
                        'link_type' => $_POST['link_type'],
                        'image_path' => $_POST['image_path'],
                        'image_alt' => $_POST['image_alt'],
                        'target' => $_POST['target'],
                        'sort_order' => $_POST['sort_order'],
                        'css_class' => $_POST['css_class']
                    ];
                    
                    $nav_model->create($data);
                    $message = '<div class="alert alert-success">Navigation link created successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'update':
                try {
                    $id = $_POST['id'];
                    $data = [
                        'title' => $_POST['title'],
                        'url' => $_POST['url'],
                        'link_type' => $_POST['link_type'],
                        'image_path' => $_POST['image_path'],
                        'image_alt' => $_POST['image_alt'],
                        'target' => $_POST['target'],
                        'sort_order' => $_POST['sort_order'],
                        'css_class' => $_POST['css_class']
                    ];
                    
                    $nav_model->update($id, $data);
                    $message = '<div class="alert alert-success">Navigation link updated successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'delete':
                try {
                    $id = $_POST['id'];
                    $nav_model->delete($id);
                    $message = '<div class="alert alert-success">Navigation link deleted successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'reorder':
                try {
                    $link_ids = json_decode($_POST['link_ids'], true);
                    $nav_model->reorder($current_theme, $link_ids);
                    $message = '<div class="alert alert-success">Navigation order updated!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
        }
    }
}

// Get editing link if specified
$editing_link = null;
if (isset($_GET['edit'])) {
    $editing_link = $db->queryOne("SELECT * FROM navigation_links WHERE id = ?", [$_GET['edit']]);
}

// Get all navigation links for current theme
$nav_links = $nav_model->getByTheme($current_theme);
?>

<?= $message ?>

<div class="form-actions" style="margin-bottom: 30px;">
    <button type="button" class="btn btn-primary" onclick="toggleForm()">
        <?= $editing_link ? 'Cancel Edit' : 'Add New Link' ?>
    </button>
</div>

<!-- Navigation Link Form -->
<div id="nav-form" class="card" style="<?= $editing_link ? '' : 'display: none;' ?>">
    <div class="card-header">
        <h3><?= $editing_link ? 'Edit Navigation Link' : 'Create New Navigation Link' ?></h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="<?= $editing_link ? 'update' : 'create' ?>">
            <?php if ($editing_link): ?>
                <input type="hidden" name="id" value="<?= $editing_link['id'] ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title">Link Title *</label>
                    <input type="text" id="title" name="title" class="form-control" 
                           value="<?= htmlspecialchars($editing_link['title'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="url">URL *</label>
                    <input type="text" id="url" name="url" class="form-control" 
                           value="<?= htmlspecialchars($editing_link['url'] ?? '') ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="link_type">Link Type</label>
                    <select id="link_type" name="link_type" class="form-control" onchange="toggleLinkType()">
                        <option value="text" <?= ($editing_link['link_type'] ?? '') === 'text' ? 'selected' : '' ?>>Text Link</option>
                        <option value="image" <?= ($editing_link['link_type'] ?? '') === 'image' ? 'selected' : '' ?>>Image Link</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="target">Target</label>
                    <select id="target" name="target" class="form-control">
                        <option value="_self" <?= ($editing_link['target'] ?? '') === '_self' ? 'selected' : '' ?>>Same Window</option>
                        <option value="_blank" <?= ($editing_link['target'] ?? '') === '_blank' ? 'selected' : '' ?>>New Window</option>
                        <option value="_parent" <?= ($editing_link['target'] ?? '') === '_parent' ? 'selected' : '' ?>>Parent Frame</option>
                    </select>
                </div>
            </div>
            
            <div id="image-fields" style="<?= ($editing_link['link_type'] ?? '') === 'image' ? '' : 'display: none;' ?>">
                <div class="form-row">
                    <div class="form-group">
                        <label for="image_path">Image Path</label>
                        <input type="text" id="image_path" name="image_path" class="form-control" 
                               value="<?= htmlspecialchars($editing_link['image_path'] ?? '') ?>"
                               placeholder="/images/nav_image.gif">
                    </div>
                    <div class="form-group">
                        <label for="image_alt">Image Alt Text</label>
                        <input type="text" id="image_alt" name="image_alt" class="form-control" 
                               value="<?= htmlspecialchars($editing_link['image_alt'] ?? '') ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="form-control" 
                           value="<?= $editing_link['sort_order'] ?? (count($nav_links) + 1) ?>" min="1">
                </div>
                <div class="form-group">
                    <label for="css_class">CSS Class (Optional)</label>
                    <input type="text" id="css_class" name="css_class" class="form-control" 
                           value="<?= htmlspecialchars($editing_link['css_class'] ?? '') ?>"
                           placeholder="custom-nav-class">
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <?= $editing_link ? 'Update Link' : 'Create Link' ?>
                </button>
                <button type="button" class="btn btn-danger" onclick="toggleForm()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Navigation Links List -->
<div class="card">
    <div class="card-header">
        <h3>Navigation Links for <?= htmlspecialchars($current_theme) ?></h3>
        <p style="font-size: 12px; color: #7f8c8d; margin: 5px 0 0 0;">
            Drag and drop to reorder navigation links
        </p>
    </div>
    <div class="card-body">
        <?php if (empty($nav_links)): ?>
            <p>No navigation links found for this theme. <a href="#" onclick="toggleForm()">Create the first one!</a></p>
        <?php else: ?>
            <div id="sortable-nav" class="sortable-list">
                <?php foreach ($nav_links as $link): ?>
                    <div class="nav-item-row" data-id="<?= $link['id'] ?>">
                        <div class="drag-handle">⋮⋮</div>
                        <div class="nav-item-content">
                            <div class="nav-item-info">
                                <strong><?= htmlspecialchars($link['title']) ?></strong>
                                <br>
                                <small style="color: #7f8c8d;">
                                    <?= htmlspecialchars($link['url']) ?> 
                                    (<?= ucfirst($link['link_type']) ?> - <?= ucfirst($link['target']) ?>)
                                </small>
                            </div>
                            <div class="nav-item-actions">
                                <a href="?action=navigation&theme=<?= $current_theme ?>&edit=<?= $link['id'] ?>" 
                                   class="btn btn-small btn-warning">Edit</a>
                                
                                <form method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this navigation link?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $link['id'] ?>">
                                    <button type="submit" class="btn btn-small btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div style="margin-top: 20px;">
                <button type="button" class="btn btn-success" onclick="saveOrder()">Save Order</button>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function toggleForm() {
    const form = document.getElementById('nav-form');
    const isVisible = form.style.display !== 'none';
    
    if (isVisible) {
        form.style.display = 'none';
        <?php if (!$editing_link): ?>
        form.querySelector('form').reset();
        toggleLinkType(); // Reset image fields
        <?php endif; ?>
    } else {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth' });
    }
}

function toggleLinkType() {
    const linkType = document.getElementById('link_type').value;
    const imageFields = document.getElementById('image-fields');
    
    if (linkType === 'image') {
        imageFields.style.display = 'block';
    } else {
        imageFields.style.display = 'none';
    }
}

// Simple sortable functionality
let draggedElement = null;

document.addEventListener('DOMContentLoaded', function() {
    const sortableList = document.getElementById('sortable-nav');
    if (!sortableList) return;
    
    const items = sortableList.querySelectorAll('.nav-item-row');
    
    items.forEach(item => {
        item.draggable = true;
        
        item.addEventListener('dragstart', function(e) {
            draggedElement = this;
            this.style.opacity = '0.5';
        });
        
        item.addEventListener('dragend', function(e) {
            this.style.opacity = '';
            draggedElement = null;
        });
        
        item.addEventListener('dragover', function(e) {
            e.preventDefault();
        });
        
        item.addEventListener('drop', function(e) {
            e.preventDefault();
            if (draggedElement !== this) {
                const items = Array.from(sortableList.children);
                const draggedIndex = items.indexOf(draggedElement);
                const targetIndex = items.indexOf(this);
                
                if (draggedIndex < targetIndex) {
                    sortableList.insertBefore(draggedElement, this.nextSibling);
                } else {
                    sortableList.insertBefore(draggedElement, this);
                }
            }
        });
    });
});

function saveOrder() {
    const items = document.querySelectorAll('#sortable-nav .nav-item-row');
    const linkIds = Array.from(items).map(item => item.dataset.id);
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.style.display = 'none';
    
    const actionInput = document.createElement('input');
    actionInput.type = 'hidden';
    actionInput.name = 'action';
    actionInput.value = 'reorder';
    
    const idsInput = document.createElement('input');
    idsInput.type = 'hidden';
    idsInput.name = 'link_ids';
    idsInput.value = JSON.stringify(linkIds);
    
    form.appendChild(actionInput);
    form.appendChild(idsInput);
    document.body.appendChild(form);
    form.submit();
}
</script>

<style>
.sortable-list {
    border: 1px solid #ddd;
    border-radius: 4px;
}

.nav-item-row {
    display: flex;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #ddd;
    background: white;
    cursor: move;
    transition: background-color 0.2s;
}

.nav-item-row:last-child {
    border-bottom: none;
}

.nav-item-row:hover {
    background: #f8f9fa;
}

.drag-handle {
    color: #ccc;
    margin-right: 15px;
    cursor: grab;
    user-select: none;
}

.nav-item-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex: 1;
}

.nav-item-info {
    flex: 1;
}

.nav-item-actions {
    display: flex;
    gap: 10px;
}
</style>
