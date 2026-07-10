<?php
/**
 * Single Large Capsule Management
 * Admin panel for managing large capsule entries for 2007-2010 themes
 * Supports up to 12 entries per theme with appid, image_path, description, url
 * Title and price are looked up from store_apps table
 */
require_once 'admin_header.php';
cms_require_permission('manage_store');

$db = cms_get_db();

// Get available themes that support single large capsule
$themes = ['2007_v1', '2007_v2', '2008', '2009', '2010'];
$selectedTheme = $_GET['theme'] ?? $_POST['theme'] ?? $themes[0];

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $action = $_POST['action'] ?? '';

    if ($action === 'list') {
        $theme = $_POST['theme'] ?? $selectedTheme;
        $stmt = $db->prepare('
            SELECT slc.*, a.name AS title, a.price
            FROM single_large_capsule slc
            LEFT JOIN store_apps a ON slc.appid = a.appid
            WHERE slc.theme = ?
            ORDER BY slc.`order` ASC
        ');
        $stmt->execute([$theme]);
        $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'ok', 'entries' => $entries]);
        exit;
    }

    if ($action === 'get') {
        $id = (int)($_POST['id'] ?? 0);
        $stmt = $db->prepare('
            SELECT slc.*, a.name AS title, a.price
            FROM single_large_capsule slc
            LEFT JOIN store_apps a ON slc.appid = a.appid
            WHERE slc.id = ?
        ');
        $stmt->execute([$id]);
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($entry) {
            echo json_encode(['status' => 'ok', 'entry' => $entry]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Entry not found']);
        }
        exit;
    }

    if ($action === 'save') {
        $id = isset($_POST['id']) && $_POST['id'] !== '' ? (int)$_POST['id'] : null;
        $theme = $_POST['theme'] ?? $selectedTheme;
        $appid = isset($_POST['appid']) && $_POST['appid'] !== '' ? (int)$_POST['appid'] : null;
        $image_path = trim($_POST['image_path'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $url = trim($_POST['url'] ?? '');

        // Validate: maximum 12 entries per theme
        if (!$id) {
            $stmt = $db->prepare('SELECT COUNT(*) FROM single_large_capsule WHERE theme = ?');
            $stmt->execute([$theme]);
            $count = (int)$stmt->fetchColumn();
            if ($count >= 12) {
                echo json_encode(['status' => 'error', 'message' => 'Maximum 12 entries allowed per theme']);
                exit;
            }
        }

        // Auto-generate URL if appid is set and URL is empty
        if ($appid && empty($url)) {
            $url = "index.php?area=game&AppId={$appid}";
        }

        if ($id) {
            // Update existing entry
            $stmt = $db->prepare('
                UPDATE single_large_capsule
                SET appid = ?, image_path = ?, description = ?, url = ?, updated_at = NOW()
                WHERE id = ?
            ');
            $stmt->execute([$appid, $image_path, $description, $url, $id]);
        } else {
            // Get next order value
            $stmt = $db->prepare('SELECT COALESCE(MAX(`order`), 0) + 1 FROM single_large_capsule WHERE theme = ?');
            $stmt->execute([$theme]);
            $order = (int)$stmt->fetchColumn();

            // Insert new entry
            $stmt = $db->prepare('
                INSERT INTO single_large_capsule (theme, appid, image_path, description, url, `order`)
                VALUES (?, ?, ?, ?, ?, ?)
            ');
            $stmt->execute([$theme, $appid, $image_path, $description, $url, $order]);
            $id = (int)$db->lastInsertId();
        }

        // Fetch updated entry with app info
        $stmt = $db->prepare('
            SELECT slc.*, a.name AS title, a.price
            FROM single_large_capsule slc
            LEFT JOIN store_apps a ON slc.appid = a.appid
            WHERE slc.id = ?
        ');
        $stmt->execute([$id]);
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(['status' => 'ok', 'entry' => $entry]);
        exit;
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $db->prepare('DELETE FROM single_large_capsule WHERE id = ?')->execute([$id]);
        echo json_encode(['status' => 'ok']);
        exit;
    }

    if ($action === 'reorder') {
        $order = $_POST['order'] ?? [];
        foreach ($order as $i => $id) {
            $db->prepare('UPDATE single_large_capsule SET `order` = ? WHERE id = ?')
               ->execute([$i + 1, (int)$id]);
        }
        echo json_encode(['status' => 'ok']);
        exit;
    }

    if ($action === 'search_apps') {
        $query = trim($_POST['query'] ?? '');
        if (strlen($query) < 2) {
            echo json_encode(['status' => 'ok', 'apps' => []]);
            exit;
        }
        $stmt = $db->prepare('
            SELECT appid, name, price
            FROM store_apps
            WHERE name LIKE ? OR appid = ?
            ORDER BY name
            LIMIT 20
        ');
        $stmt->execute(['%' . $query . '%', $query]);
        $apps = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'ok', 'apps' => $apps]);
        exit;
    }

    echo json_encode(['status' => 'error', 'message' => 'Unknown action']);
    exit;
}

// Load current entries
$stmt = $db->prepare('
    SELECT slc.*, a.name AS title, a.price
    FROM single_large_capsule slc
    LEFT JOIN store_apps a ON slc.appid = a.appid
    WHERE slc.theme = ?
    ORDER BY slc.`order` ASC
');
$stmt->execute([$selectedTheme]);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
$entryCount = count($entries);
?>
<h2>Single Large Capsule Management</h2>
<p class="page-description" style="color:#666;margin-bottom:15px;">Manage the large capsule banner shown on the storefront.</p>
<p>Manage the rotating large capsule entries for 2007-2010 themes. Maximum 12 entries per theme.</p>

<div class="form-row" style="margin-bottom: 15px;">
    <label for="theme-select">Theme:</label>
    <select id="theme-select" onchange="changeTheme(this.value)">
        <?php foreach ($themes as $t): ?>
        <option value="<?= htmlspecialchars($t) ?>" <?= $t === $selectedTheme ? 'selected' : '' ?>>
            <?= htmlspecialchars($t) ?>
        </option>
        <?php endforeach; ?>
    </select>
    <span id="entry-count" style="margin-left: 15px; color: #666;">
        (<?= $entryCount ?>/12 entries)
    </span>
</div>

<div id="entries-list" class="entries-grid">
    <?php foreach ($entries as $entry): ?>
    <div class="entry-card" data-id="<?= $entry['id'] ?>">
        <span class="handle">&#9776;</span>
        <button type="button" class="delete-btn" data-id="<?= $entry['id'] ?>">&times;</button>
        <?php if ($entry['image_path']): ?>
        <img src="../storefront/images/capsules/<?= htmlspecialchars($entry['image_path']) ?>" alt="" class="entry-image">
        <?php else: ?>
        <div class="no-image">No Image</div>
        <?php endif; ?>
        <div class="entry-info">
            <div class="entry-title"><?= htmlspecialchars($entry['title'] ?: 'No App Selected') ?></div>
            <?php if ($entry['price']): ?>
            <div class="entry-price">$<?= number_format((float)$entry['price'], 2) ?></div>
            <?php endif; ?>
        </div>
        <button type="button" class="btn btn-small edit-btn" data-id="<?= $entry['id'] ?>">Edit</button>
    </div>
    <?php endforeach; ?>
</div>

<button type="button" id="add-entry" class="btn btn-secondary" <?= $entryCount >= 12 ? 'disabled' : '' ?>>
    Add Entry
</button>

<!-- Edit Modal -->
<div id="entry-modal" class="modal-overlay" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-header">
            <h3 id="modal-title">Edit Entry</h3>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form id="entry-form">
            <input type="hidden" name="id" id="entry-id">
            <input type="hidden" name="theme" id="entry-theme" value="<?= htmlspecialchars($selectedTheme) ?>">

            <div class="form-row">
                <label for="entry-appid">Game (App ID)</label>
                <div class="app-search-container">
                    <input type="text" id="app-search" placeholder="Search by name or app ID...">
                    <div id="app-results" class="app-results" style="display:none;"></div>
                </div>
                <input type="hidden" name="appid" id="entry-appid">
                <div id="selected-app" class="selected-app" style="display:none;">
                    <span id="selected-app-name"></span>
                    <button type="button" id="clear-app" class="btn btn-small">&times;</button>
                </div>
            </div>

            <div class="form-row">
                <label for="entry-image">Image</label>
                <div class="file-picker-container">
                    <button type="button" class="btn btn-primary"
                            data-reliable-file-picker
                            data-upload-path="storefront/images/capsules"
                            data-target="#entry-image-path"
                            data-preview="#entry-image-preview"
                            data-allowed-types="png,jpg,jpeg,gif">
                        Choose or Upload Image
                    </button>
                </div>
                <input type="hidden" name="image_path" id="entry-image-path">
                <img id="entry-image-preview" src="" alt="Preview" style="max-width:200px;display:none;margin-top:5px;">
            </div>

            <div class="form-row">
                <label for="entry-description">Description</label>
                <textarea name="description" id="entry-description" rows="3"></textarea>
            </div>

            <div class="form-row">
                <label for="entry-url">URL (leave empty for auto-generated game page URL)</label>
                <input type="text" name="url" id="entry-url" placeholder="index.php?area=game&AppId=...">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn modal-close">Cancel</button>
            </div>
        </form>
    </div>
</div>

<style>
.entries-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 15px;
}
.entry-card {
    width: 200px;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px;
    position: relative;
    background: #fff;
}
.entry-card .handle {
    cursor: move;
    position: absolute;
    top: 5px;
    left: 5px;
    color: #999;
}
.entry-card .delete-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 1px solid #666;
    background: #fff;
    color: #666;
    cursor: pointer;
    line-height: 18px;
    padding: 0;
}
.entry-card .delete-btn:hover {
    background: #f44336;
    color: #fff;
    border-color: #f44336;
}
.entry-card .entry-image {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 4px;
    margin-bottom: 8px;
}
.entry-card .no-image {
    width: 100%;
    height: 120px;
    background: #eee;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
    border-radius: 4px;
    margin-bottom: 8px;
}
.entry-card .entry-info {
    margin-bottom: 8px;
}
.entry-card .entry-title {
    font-weight: bold;
    font-size: 13px;
    margin-bottom: 3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.entry-card .entry-price {
    color: #4CAF50;
    font-size: 12px;
}
.entry-card .edit-btn {
    width: 100%;
}

/* Modal styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}
.modal-dialog {
    background: #fff;
    border-radius: 8px;
    width: 500px;
    max-width: 90%;
    max-height: 90vh;
    overflow-y: auto;
}
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #ddd;
}
.modal-header h3 {
    margin: 0;
}
.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #666;
}
#entry-form {
    padding: 20px;
}
#entry-form .form-row {
    margin-bottom: 15px;
}
#entry-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
#entry-form input[type="text"],
#entry-form textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.form-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    margin-top: 20px;
}

/* App search */
.app-search-container {
    position: relative;
}
.app-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #ddd;
    border-top: none;
    max-height: 200px;
    overflow-y: auto;
    z-index: 100;
}
.app-result {
    padding: 8px 10px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
}
.app-result:hover {
    background: #f5f5f5;
}
.selected-app {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 5px;
    padding: 5px 10px;
    background: #e3f2fd;
    border-radius: 4px;
}
</style>

<script>
$(function(){
    var currentTheme = '<?= htmlspecialchars($selectedTheme) ?>';
    var maxEntries = 12;

    // Sortable entries
    Sortable.create(document.getElementById('entries-list'), {
        handle: '.handle',
        animation: 150,
        onEnd: function() {
            var order = [];
            $('#entries-list .entry-card').each(function() {
                order.push($(this).data('id'));
            });
            $.post('single_large_capsule.php', { action: 'reorder', order: order });
        }
    });

    // Theme change
    window.changeTheme = function(theme) {
        window.location.href = 'single_large_capsule.php?theme=' + encodeURIComponent(theme);
    };

    // Add entry
    $('#add-entry').on('click', function() {
        openModal();
    });

    // Edit entry
    $('#entries-list').on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        $.post('single_large_capsule.php', { action: 'get', id: id }, function(r) {
            if (r.status === 'ok') {
                openModal(r.entry);
            }
        }, 'json');
    });

    // Delete entry
    $('#entries-list').on('click', '.delete-btn', function(e) {
        e.stopPropagation();
        if (!confirm('Delete this entry?')) return;
        var $card = $(this).closest('.entry-card');
        var id = $(this).data('id');
        $.post('single_large_capsule.php', { action: 'delete', id: id }, function(r) {
            if (r.status === 'ok') {
                $card.fadeOut(200, function() { $(this).remove(); updateCount(); });
            }
        }, 'json');
    });

    // Modal handling
    function openModal(entry) {
        entry = entry || {};
        $('#entry-id').val(entry.id || '');
        $('#entry-theme').val(currentTheme);
        $('#entry-appid').val(entry.appid || '');
        $('#entry-image-path').val(entry.image_path || '');
        $('#entry-description').val(entry.description || '');
        $('#entry-url').val(entry.url || '');
        $('#app-search').val('');
        $('#app-results').hide();

        if (entry.appid && entry.title) {
            $('#selected-app-name').text(entry.appid + ' - ' + entry.title);
            $('#selected-app').show();
        } else {
            $('#selected-app').hide();
        }

        if (entry.image_path) {
            $('#entry-image-preview').attr('src', '../storefront/images/capsules/' + entry.image_path).show();
        } else {
            $('#entry-image-preview').hide();
        }

        $('#modal-title').text(entry.id ? 'Edit Entry' : 'Add Entry');
        $('#entry-modal').fadeIn(150);
    }

    // Close modal
    $('.modal-close, .modal-overlay').on('click', function(e) {
        if (e.target === this) {
            $('#entry-modal').fadeOut(150);
        }
    });

    // App search
    var searchTimeout;
    $('#app-search').on('input', function() {
        clearTimeout(searchTimeout);
        var query = $(this).val();
        if (query.length < 2) {
            $('#app-results').hide();
            return;
        }
        searchTimeout = setTimeout(function() {
            $.post('single_large_capsule.php', { action: 'search_apps', query: query }, function(r) {
                if (r.status === 'ok' && r.apps.length > 0) {
                    var html = '';
                    r.apps.forEach(function(app) {
                        html += '<div class="app-result" data-appid="' + app.appid + '" data-name="' +
                                escapeHtml(app.name) + '">' + app.appid + ' - ' + escapeHtml(app.name) +
                                ' ($' + parseFloat(app.price || 0).toFixed(2) + ')</div>';
                    });
                    $('#app-results').html(html).show();
                } else {
                    $('#app-results').hide();
                }
            }, 'json');
        }, 300);
    });

    // Select app from search
    $('#app-results').on('click', '.app-result', function() {
        var appid = $(this).data('appid');
        var name = $(this).data('name');
        $('#entry-appid').val(appid);
        $('#selected-app-name').text(appid + ' - ' + name);
        $('#selected-app').show();
        $('#app-search').val('');
        $('#app-results').hide();
    });

    // Clear selected app
    $('#clear-app').on('click', function() {
        $('#entry-appid').val('');
        $('#selected-app').hide();
    });

    // Form submit
    $('#entry-form').on('submit', function(e) {
        e.preventDefault();
        var data = {
            action: 'save',
            id: $('#entry-id').val(),
            theme: $('#entry-theme').val(),
            appid: $('#entry-appid').val(),
            image_path: $('#entry-image-path').val(),
            description: $('#entry-description').val(),
            url: $('#entry-url').val()
        };
        $.post('single_large_capsule.php', data, function(r) {
            if (r.status === 'ok') {
                $('#entry-modal').fadeOut(150);
                location.reload(); // Simple reload to refresh the list
            } else {
                alert(r.message || 'Error saving entry');
            }
        }, 'json');
    });

    function updateCount() {
        var count = $('#entries-list .entry-card').length;
        $('#entry-count').text('(' + count + '/' + maxEntries + ' entries)');
        $('#add-entry').prop('disabled', count >= maxEntries);
    }

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});
</script>
<?php include 'admin_footer.php'; ?>
