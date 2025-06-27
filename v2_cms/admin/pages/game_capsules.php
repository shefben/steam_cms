<?php
// Game capsules management for modern themes (2007+)

if (!in_array($current_theme, ['2007', '2008', '2009'])) {
    echo '<div class="alert alert-warning">Game capsules are only available for themes 2007 and newer.</div>';
    return;
}

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
                        'description' => $_POST['description'],
                        'image_url' => $_POST['image_url'],
                        'game_url' => $_POST['game_url'],
                        'price' => $_POST['price'],
                        'release_date' => $_POST['release_date'] ?: null,
                        'sort_order' => $_POST['sort_order'],
                        'is_featured' => isset($_POST['is_featured']) ? 1 : 0
                    ];
                    
                    $db->insert('game_capsules', $data);
                    $message = '<div class="alert alert-success">Game capsule created successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'update':
                try {
                    $id = $_POST['id'];
                    $data = [
                        'title' => $_POST['title'],
                        'description' => $_POST['description'],
                        'image_url' => $_POST['image_url'],
                        'game_url' => $_POST['game_url'],
                        'price' => $_POST['price'],
                        'release_date' => $_POST['release_date'] ?: null,
                        'sort_order' => $_POST['sort_order'],
                        'is_featured' => isset($_POST['is_featured']) ? 1 : 0
                    ];
                    
                    $db->update('game_capsules', $data, 'id = ?', [$id]);
                    $message = '<div class="alert alert-success">Game capsule updated successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'delete':
                try {
                    $id = $_POST['id'];
                    $db->delete('game_capsules', 'id = ?', [$id]);
                    $message = '<div class="alert alert-success">Game capsule deleted successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'toggle_active':
                try {
                    $id = $_POST['id'];
                    $capsule = $db->queryOne("SELECT is_active FROM game_capsules WHERE id = ?", [$id]);
                    $new_status = $capsule['is_active'] ? 0 : 1;
                    $db->update('game_capsules', ['is_active' => $new_status], 'id = ?', [$id]);
                    $message = '<div class="alert alert-success">Capsule status updated!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'reorder':
                try {
                    $capsule_ids = json_decode($_POST['capsule_ids'], true);
                    foreach ($capsule_ids as $index => $id) {
                        $db->update('game_capsules', ['sort_order' => $index + 1], 'id = ?', [$id]);
                    }
                    $message = '<div class="alert alert-success">Game capsules reordered successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
        }
    }
}

// Get editing capsule if specified
$editing_capsule = null;
if (isset($_GET['edit'])) {
    $editing_capsule = $db->queryOne("SELECT * FROM game_capsules WHERE id = ?", [$_GET['edit']]);
}

// Get all game capsules for current theme
$game_capsules = $db->query(
    "SELECT * FROM game_capsules WHERE theme = ? ORDER BY sort_order ASC, title ASC", 
    [$current_theme]
);
?>

<?= $message ?>

<div class="form-actions" style="margin-bottom: 30px;">
    <button type="button" class="btn btn-primary" onclick="toggleCapsuleForm()">
        <?= $editing_capsule ? 'Cancel Edit' : 'Add New Game' ?>
    </button>
</div>

<!-- Game Capsule Form -->
<div id="capsule-form" class="card" style="<?= $editing_capsule ? '' : 'display: none;' ?>">
    <div class="card-header">
        <h3><?= $editing_capsule ? 'Edit Game Capsule' : 'Create New Game Capsule' ?></h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="<?= $editing_capsule ? 'update' : 'create' ?>">
            <?php if ($editing_capsule): ?>
                <input type="hidden" name="id" value="<?= $editing_capsule['id'] ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title">Game Title *</label>
                    <input type="text" id="title" name="title" class="form-control" 
                           value="<?= htmlspecialchars($editing_capsule['title'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price" class="form-control" 
                           value="<?= htmlspecialchars($editing_capsule['price'] ?? '') ?>" 
                           placeholder="$19.99 or Free">
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" 
                          placeholder="Brief description of the game..."><?= htmlspecialchars($editing_capsule['description'] ?? '') ?></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="image_url">Capsule Image URL</label>
                    <input type="url" id="image_url" name="image_url" class="form-control" 
                           value="<?= htmlspecialchars($editing_capsule['image_url'] ?? '') ?>"
                           placeholder="https://example.com/game_image.jpg">
                </div>
                <div class="form-group">
                    <label for="game_url">Game/Store URL</label>
                    <input type="url" id="game_url" name="game_url" class="form-control" 
                           value="<?= htmlspecialchars($editing_capsule['game_url'] ?? '') ?>"
                           placeholder="https://store.steampowered.com/app/123456/">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" id="release_date" name="release_date" class="form-control" 
                           value="<?= $editing_capsule['release_date'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="form-control" 
                           value="<?= $editing_capsule['sort_order'] ?? (count($game_capsules) + 1) ?>" min="1">
                </div>
            </div>
            
            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_featured" value="1" 
                           <?= ($editing_capsule['is_featured'] ?? false) ? 'checked' : '' ?>>
                    Featured Game (highlighted on homepage)
                </label>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <?= $editing_capsule ? 'Update Game Capsule' : 'Create Game Capsule' ?>
                </button>
                <button type="button" class="btn btn-danger" onclick="toggleCapsuleForm()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Game Capsules List -->
<div class="card">
    <div class="card-header">
        <h3>Game Capsules for <?= htmlspecialchars($current_theme) ?></h3>
        <p style="font-size: 12px; color: #7f8c8d; margin: 5px 0 0 0;">
            Drag and drop to reorder game capsules
        </p>
    </div>
    <div class="card-body">
        <?php if (empty($game_capsules)): ?>
            <p>No game capsules found for this theme. <a href="#" onclick="toggleCapsuleForm()">Create the first one!</a></p>
        <?php else: ?>
            <div id="sortable-capsules" class="capsules-grid">
                <?php foreach ($game_capsules as $capsule): ?>
                    <div class="capsule-item" data-id="<?= $capsule['id'] ?>">
                        <div class="drag-handle">⋮⋮</div>
                        <div class="capsule-preview">
                            <?php if ($capsule['image_url']): ?>
                                <img src="<?= htmlspecialchars($capsule['image_url']) ?>" 
                                     alt="<?= htmlspecialchars($capsule['title']) ?>"
                                     style="width: 100%; height: 120px; object-fit: cover;">
                            <?php else: ?>
                                <div style="width: 100%; height: 120px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #7f8c8d;">
                                    No Image
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="capsule-info">
                            <div class="capsule-title"><?= htmlspecialchars($capsule['title']) ?></div>
                            <div class="capsule-price"><?= htmlspecialchars($capsule['price'] ?: 'No price set') ?></div>
                            <?php if ($capsule['is_featured']): ?>
                                <span class="badge badge-success">Featured</span>
                            <?php endif; ?>
                            <span class="badge <?= $capsule['is_active'] ? 'badge-success' : 'badge-danger' ?>">
                                <?= $capsule['is_active'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </div>
                        <div class="capsule-actions">
                            <a href="?action=game_capsules&theme=<?= $current_theme ?>&edit=<?= $capsule['id'] ?>" 
                               class="btn btn-small btn-warning">Edit</a>
                            
                            <form method="POST" style="display: inline;" 
                                  onsubmit="return confirm('Toggle capsule status?')">
                                <input type="hidden" name="action" value="toggle_active">
                                <input type="hidden" name="id" value="<?= $capsule['id'] ?>">
                                <button type="submit" class="btn btn-small <?= $capsule['is_active'] ? 'btn-warning' : 'btn-success' ?>">
                                    <?= $capsule['is_active'] ? 'Hide' : 'Show' ?>
                                </button>
                            </form>
                            
                            <form method="POST" style="display: inline;" 
                                  onsubmit="return confirm('Are you sure you want to delete this game capsule?')">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $capsule['id'] ?>">
                                <button type="submit" class="btn btn-small btn-danger">Delete</button>
                            </form>
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
function toggleCapsuleForm() {
    const form = document.getElementById('capsule-form');
    const isVisible = form.style.display !== 'none';
    
    if (isVisible) {
        form.style.display = 'none';
        <?php if (!$editing_capsule): ?>
        form.querySelector('form').reset();
        <?php endif; ?>
    } else {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth' });
    }
}

// Sortable functionality
let draggedElement = null;

document.addEventListener('DOMContentLoaded', function() {
    const sortableList = document.getElementById('sortable-capsules');
    if (!sortableList) return;
    
    const items = sortableList.querySelectorAll('.capsule-item');
    
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
    const items = document.querySelectorAll('#sortable-capsules .capsule-item');
    const capsuleIds = Array.from(items).map(item => item.dataset.id);
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.style.display = 'none';
    
    const actionInput = document.createElement('input');
    actionInput.type = 'hidden';
    actionInput.name = 'action';
    actionInput.value = 'reorder';
    
    const idsInput = document.createElement('input');
    idsInput.type = 'hidden';
    idsInput.name = 'capsule_ids';
    idsInput.value = JSON.stringify(capsuleIds);
    
    form.appendChild(actionInput);
    form.appendChild(idsInput);
    document.body.appendChild(form);
    form.submit();
}
</script>

<style>
.capsules-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.capsule-item {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    cursor: move;
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
}

.capsule-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.drag-handle {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 5px;
    border-radius: 3px;
    font-size: 12px;
    cursor: grab;
    z-index: 10;
}

.capsule-preview {
    position: relative;
}

.capsule-info {
    padding: 15px;
}

.capsule-title {
    font-weight: bold;
    margin-bottom: 5px;
    color: #2c3e50;
}

.capsule-price {
    color: #27ae60;
    font-weight: bold;
    margin-bottom: 10px;
}

.capsule-actions {
    padding: 0 15px 15px 15px;
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

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
</style>
