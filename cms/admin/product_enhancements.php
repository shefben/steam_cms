<?php
require_once __DIR__.'/../template_engine.php';
require_once __DIR__.'/../db.php';

$db = cms_get_db();
$action = $_GET['action'] ?? 'list';
$type = $_GET['type'] ?? 'overlays'; // overlays or discounts

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $appid = (int)($_POST['appid'] ?? 0);
    
    if ($action === 'save' && $type === 'overlays') {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $active = (int)($_POST['active'] ?? 0);
        $start_date = $_POST['start_date'] ?: null;
        $end_date = $_POST['end_date'] ?: null;
        
        if ($id > 0) {
            // Update existing overlay
            $stmt = $db->prepare('
                UPDATE product_content_overlays 
                SET title = ?, content = ?, active = ?, start_date = ?, end_date = ?
                WHERE id = ?
            ');
            $stmt->execute([$title, $content, $active, $start_date, $end_date, $id]);
        } else {
            // Create new overlay
            $stmt = $db->prepare('
                INSERT INTO product_content_overlays (appid, title, content, active, start_date, end_date)
                VALUES (?, ?, ?, ?, ?, ?)
            ');
            $stmt->execute([$appid, $title, $content, $active, $start_date, $end_date]);
        }
        header('Location: product_enhancements.php?type=overlays');
        exit;
    }
    
    if ($action === 'save' && $type === 'discounts') {
        $discount_type = $_POST['discount_type'] ?? 'percentage';
        $discount_value = (float)($_POST['discount_value'] ?? 0);
        $discount_label = $_POST['discount_label'] ?? 'Discount';
        $active = (int)($_POST['active'] ?? 0);
        $start_date = $_POST['start_date'] ?: null;
        $end_date = $_POST['end_date'] ?: null;
        $package_id = (int)($_POST['package_id'] ?? 0) ?: null;
        
        if ($id > 0) {
            // Update existing discount
            $stmt = $db->prepare('
                UPDATE product_discounts 
                SET appid = ?, package_id = ?, discount_type = ?, discount_value = ?, 
                    discount_label = ?, active = ?, start_date = ?, end_date = ?
                WHERE id = ?
            ');
            $stmt->execute([$appid ?: null, $package_id, $discount_type, $discount_value, 
                           $discount_label, $active, $start_date, $end_date, $id]);
        } else {
            // Create new discount
            $stmt = $db->prepare('
                INSERT INTO product_discounts (appid, package_id, discount_type, discount_value, 
                                             discount_label, active, start_date, end_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ');
            $stmt->execute([$appid ?: null, $package_id, $discount_type, $discount_value, 
                           $discount_label, $active, $start_date, $end_date]);
        }
        header('Location: product_enhancements.php?type=discounts');
        exit;
    }
    
    if ($action === 'delete') {
        if ($type === 'overlays') {
            $stmt = $db->prepare('DELETE FROM product_content_overlays WHERE id = ?');
        } else {
            $stmt = $db->prepare('DELETE FROM product_discounts WHERE id = ?');
        }
        $stmt->execute([$id]);
        header('Location: product_enhancements.php?type=' . $type);
        exit;
    }
}

// Load data for list view
if ($action === 'list') {
    if ($type === 'overlays') {
        $stmt = $db->prepare('
            SELECT o.*, a.name as app_name 
            FROM product_content_overlays o 
            LEFT JOIN store_apps a ON o.appid = a.appid 
            ORDER BY o.created_at DESC
        ');
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $db->prepare('
            SELECT d.*, a.name as app_name, s.name as package_name
            FROM product_discounts d 
            LEFT JOIN store_apps a ON d.appid = a.appid 
            LEFT JOIN subscriptions s ON d.package_id = s.subid
            ORDER BY d.created_at DESC
        ');
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// JSON endpoint for AJAX edit
if ($action === 'get') {
    $id = (int)($_GET['id'] ?? 0);
    if ($type === 'overlays') {
        $stmt = $db->prepare('SELECT * FROM product_content_overlays WHERE id = ?');
    } else {
        $stmt = $db->prepare('SELECT * FROM product_discounts WHERE id = ?');
    }
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($item ?: []);
    exit;
}

// Load data for edit form
if ($action === 'edit') {
    $id = (int)($_GET['id'] ?? 0);
    if ($type === 'overlays') {
        $stmt = $db->prepare('SELECT * FROM product_content_overlays WHERE id = ?');
    } else {
        $stmt = $db->prepare('SELECT * FROM product_discounts WHERE id = ?');
    }
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Load apps for dropdown
$apps_stmt = $db->prepare('SELECT appid, name FROM store_apps ORDER BY name');
$apps_stmt->execute();
$apps = $apps_stmt->fetchAll(PDO::FETCH_ASSOC);

// Load packages for dropdown
$packages_stmt = $db->prepare('SELECT subid, name FROM subscriptions ORDER BY name');
$packages_stmt->execute();
$packages = $packages_stmt->fetchAll(PDO::FETCH_ASSOC);

$title = ucfirst($type) . ' Management';
$tpl = cms_admin_layout('default.twig');
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="../themes/admin/assets/css/admin.css">
    <script src="../includes/jquery/jquery.min.js"></script>
</head>
<body>

<div class="admin-header">
    <h1><?= $title ?></h1>
    <div class="nav-tabs">
        <a href="?type=overlays" class="<?= $type === 'overlays' ? 'active' : '' ?>">Content Overlays</a>
        <a href="?type=discounts" class="<?= $type === 'discounts' ? 'active' : '' ?>">Discounts</a>
    </div>
</div>

<?php if ($action === 'list'): ?>
<div class="admin-toolbar">
    <button onclick="showAddModal()">Add New <?= ucfirst(substr($type, 0, -1)) ?></button>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <?php if ($type === 'overlays'): ?>
                <th>ID</th>
                <th>App</th>
                <th>Title</th>
                <th>Active</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            <?php else: ?>
                <th>ID</th>
                <th>App/Package</th>
                <th>Type</th>
                <th>Value</th>
                <th>Label</th>
                <th>Active</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
        <tr>
            <?php if ($type === 'overlays'): ?>
                <td><?= $item['id'] ?></td>
                <td><?= htmlspecialchars($item['app_name'] ?? 'Unknown') ?></td>
                <td><?= htmlspecialchars($item['title']) ?></td>
                <td><?= $item['active'] ? 'Yes' : 'No' ?></td>
                <td><?= $item['start_date'] ?></td>
                <td><?= $item['end_date'] ?></td>
                <td>
                    <button onclick="editItem(<?= $item['id'] ?>)">Edit</button>
                    <button onclick="deleteItem(<?= $item['id'] ?>)">Delete</button>
                </td>
            <?php else: ?>
                <td><?= $item['id'] ?></td>
                <td><?= htmlspecialchars($item['app_name'] ?: $item['package_name'] ?: 'Unknown') ?></td>
                <td><?= ucfirst($item['discount_type']) ?></td>
                <td>
                    <?php if ($item['discount_type'] === 'percentage'): ?>
                        <?= $item['discount_value'] ?>%
                    <?php else: ?>
                        $<?= number_format($item['discount_value'], 2) ?>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($item['discount_label']) ?></td>
                <td><?= $item['active'] ? 'Yes' : 'No' ?></td>
                <td><?= $item['start_date'] ?></td>
                <td><?= $item['end_date'] ?></td>
                <td>
                    <button onclick="editItem(<?= $item['id'] ?>)">Edit</button>
                    <button onclick="deleteItem(<?= $item['id'] ?>)">Delete</button>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<!-- Modal for Add/Edit -->
<div id="itemModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle">Add <?= ucfirst(substr($type, 0, -1)) ?></h2>
        <form method="post" action="?action=save&type=<?= $type ?>">
            <input type="hidden" name="id" id="itemId" value="0">
            
            <div class="form-group">
                <label for="appid">App:</label>
                <select name="appid" id="appid" required>
                    <option value="">Select App</option>
                    <?php foreach ($apps as $app): ?>
                        <option value="<?= $app['appid'] ?>"><?= htmlspecialchars($app['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <?php if ($type === 'overlays'): ?>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" required>
                </div>
                
                <div class="form-group">
                    <label for="content">Content (HTML allowed):</label>
                    <textarea name="content" id="content" rows="4"></textarea>
                </div>
            <?php else: ?>
                <div class="form-group">
                    <label for="package_id">Package (optional):</label>
                    <select name="package_id" id="package_id">
                        <option value="">Select Package (optional)</option>
                        <?php foreach ($packages as $package): ?>
                            <option value="<?= $package['subid'] ?>"><?= htmlspecialchars($package['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="discount_type">Discount Type:</label>
                    <select name="discount_type" id="discount_type">
                        <option value="percentage">Percentage</option>
                        <option value="fixed_amount">Fixed Amount</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="discount_value">Discount Value:</label>
                    <input type="number" name="discount_value" id="discount_value" step="0.01" required>
                </div>
                
                <div class="form-group">
                    <label for="discount_label">Discount Label:</label>
                    <input type="text" name="discount_label" id="discount_label" value="Discount">
                </div>
            <?php endif; ?>
            
            <div class="form-group">
                <label for="start_date">Start Date (optional):</label>
                <input type="datetime-local" name="start_date" id="start_date">
            </div>
            
            <div class="form-group">
                <label for="end_date">End Date (optional):</label>
                <input type="datetime-local" name="end_date" id="end_date">
            </div>
            
            <div class="form-group">
                <label for="active">Active:</label>
                <input type="checkbox" name="active" id="active" value="1" checked>
            </div>
            
            <div class="form-actions">
                <button type="submit">Save</button>
                <button type="button" onclick="closeModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function showAddModal() {
    document.getElementById('modalTitle').textContent = 'Add <?= ucfirst(substr($type, 0, -1)) ?>';
    document.getElementById('itemId').value = '0';
    document.querySelector('#itemModal form').reset();
    document.getElementById('active').checked = true;
    document.getElementById('itemModal').style.display = 'block';
}

function editItem(id) {
    // AJAX call to load item data
    fetch(`?action=get&type=<?= $type ?>&id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalTitle').textContent = 'Edit <?= ucfirst(substr($type, 0, -1)) ?>';
            document.getElementById('itemId').value = data.id;
            document.getElementById('appid').value = data.appid || '';
            
            <?php if ($type === 'overlays'): ?>
                document.getElementById('title').value = data.title || '';
                document.getElementById('content').value = data.content || '';
            <?php else: ?>
                document.getElementById('package_id').value = data.package_id || '';
                document.getElementById('discount_type').value = data.discount_type || 'percentage';
                document.getElementById('discount_value').value = data.discount_value || '';
                document.getElementById('discount_label').value = data.discount_label || '';
            <?php endif; ?>
            
            document.getElementById('start_date').value = data.start_date ? data.start_date.replace(' ', 'T') : '';
            document.getElementById('end_date').value = data.end_date ? data.end_date.replace(' ', 'T') : '';
            document.getElementById('active').checked = data.active == 1;
            
            document.getElementById('itemModal').style.display = 'block';
        });
}

function deleteItem(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '?action=delete&type=<?= $type ?>';
        
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id';
        idInput.value = id;
        
        form.appendChild(idInput);
        document.body.appendChild(form);
        form.submit();
    }
}

function closeModal() {
    document.getElementById('itemModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('itemModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

<style>
.admin-header h1 {
    margin: 0 0 20px 0;
    color: #333;
}

.nav-tabs {
    margin-bottom: 20px;
}

.nav-tabs a {
    display: inline-block;
    padding: 10px 20px;
    margin-right: 5px;
    background: #f5f5f5;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #333;
}

.nav-tabs a.active {
    background: #007cba;
    color: white;
    border-color: #007cba;
}

.admin-toolbar {
    margin-bottom: 20px;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.admin-table th,
.admin-table td {
    padding: 8px 12px;
    border: 1px solid #ddd;
    text-align: left;
}

.admin-table th {
    background-color: #f5f5f5;
    font-weight: bold;
}

.admin-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 20px;
    border: none;
    width: 80%;
    max-width: 600px;
    border-radius: 4px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: black;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-group input[type="checkbox"] {
    width: auto;
}

.form-actions {
    margin-top: 20px;
    text-align: right;
}

.form-actions button {
    padding: 8px 16px;
    margin-left: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.form-actions button[type="submit"] {
    background: #007cba;
    color: white;
}

.form-actions button[type="button"] {
    background: #666;
    color: white;
}
</style>

</body>
</html>