<?php
session_start();
require_once __DIR__ . '/../db.php';

if (!cms_current_admin()) {
    header('Location: ../login.php');
    exit;
}

$db = cms_get_db();
$action = $_GET['action'] ?? '';
$message = '';
$error = '';
$csrfToken = cms_get_csrf_token();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!cms_verify_csrf($_POST['csrf_token'] ?? '')) {
        $error = 'Invalid CSRF token';
    } elseif ($action === 'create_tab') {
        $tab_name = trim($_POST['tab_name']);
        $tab_order = (int)$_POST['tab_order'];
        $active = isset($_POST['active']) ? 1 : 0;
        
        if (!empty($tab_name)) {
            try {
                $stmt = $db->prepare('INSERT INTO tabbed_capsules (tab_name, tab_order, active) VALUES (?, ?, ?)');
                $stmt->execute([$tab_name, $tab_order, $active]);
                $message = 'Tab created successfully!';
            } catch (PDOException $e) {
                $error = 'Error creating tab: ' . $e->getMessage();
            }
        } else {
            $error = 'Tab name is required';
        }
    } elseif ($action === 'edit_tab') {
        $tab_id = (int)$_POST['tab_id'];
        $tab_name = trim($_POST['tab_name']);
        $tab_order = (int)$_POST['tab_order'];
        $active = isset($_POST['active']) ? 1 : 0;
        
        if (!empty($tab_name) && $tab_id > 0) {
            try {
                $stmt = $db->prepare('UPDATE tabbed_capsules SET tab_name = ?, tab_order = ?, active = ? WHERE id = ?');
                $stmt->execute([$tab_name, $tab_order, $active, $tab_id]);
                $message = 'Tab updated successfully!';
            } catch (PDOException $e) {
                $error = 'Error updating tab: ' . $e->getMessage();
            }
        } else {
            $error = 'Valid tab name and ID are required';
        }
    } elseif ($action === 'delete_tab') {
        $tab_id = (int)$_POST['tab_id'];
        
        if ($tab_id > 0) {
            try {
                $stmt = $db->prepare('DELETE FROM tabbed_capsules WHERE id = ?');
                $stmt->execute([$tab_id]);
                $message = 'Tab deleted successfully!';
            } catch (PDOException $e) {
                $error = 'Error deleting tab: ' . $e->getMessage();
            }
        }
    } elseif ($action === 'add_game') {
        $tab_id = (int)$_POST['tab_id'];
        $appid = (int)$_POST['appid'];
        $game_order = (int)$_POST['game_order'];
        $custom_name = trim($_POST['custom_name']);
        $custom_price = !empty($_POST['custom_price']) ? (float)$_POST['custom_price'] : null;
        $release_date = !empty($_POST['release_date']) ? $_POST['release_date'] : null;
        
        if ($tab_id > 0 && $appid > 0) {
            try {
                $stmt = $db->prepare('INSERT INTO tabbed_capsule_games (tab_id, appid, game_order, custom_name, custom_price, release_date) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->execute([$tab_id, $appid, $game_order, $custom_name, $custom_price, $release_date]);
                $message = 'Game added to tab successfully!';
            } catch (PDOException $e) {
                $error = 'Error adding game: ' . $e->getMessage();
            }
        } else {
            $error = 'Valid tab and app ID are required';
        }
    } elseif ($action === 'remove_game') {
        $game_id = (int)$_POST['game_id'];
        
        if ($game_id > 0) {
            try {
                $stmt = $db->prepare('DELETE FROM tabbed_capsule_games WHERE id = ?');
                $stmt->execute([$game_id]);
                $message = 'Game removed from tab successfully!';
            } catch (PDOException $e) {
                $error = 'Error removing game: ' . $e->getMessage();
            }
        }
    }
}

// Get all tabs
$tabs = $db->query('SELECT * FROM tabbed_capsules ORDER BY tab_order')->fetchAll(PDO::FETCH_ASSOC);

// Get all available apps
$apps = $db->query('SELECT appid, name, price FROM store_apps ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);

// Get tab-specific games if viewing a specific tab
$tab_games = [];
$selected_tab_id = $_GET['tab_id'] ?? null;
if ($selected_tab_id) {
    $stmt = $db->prepare('
        SELECT tcg.*, a.name as app_name, a.price as app_price 
        FROM tabbed_capsule_games tcg 
        LEFT JOIN store_apps a ON a.appid = tcg.appid 
        WHERE tcg.tab_id = ? 
        ORDER BY tcg.game_order
    ');
    $stmt->execute([$selected_tab_id]);
    $tab_games = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabbed Capsule Management - Steam CMS Admin</title>
    <link rel="stylesheet" href="../admin/style.css">
    <script src="js/jquery.min.js"></script>
    <style>
    .tab-section {
        background: #f5f5f5;
        border: 1px solid #ddd;
        padding: 20px;
        margin: 20px 0;
        border-radius: 5px;
    }
    .game-item {
        background: #fff;
        border: 1px solid #ddd;
        padding: 10px;
        margin: 10px 0;
        border-radius: 3px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .game-info {
        flex-grow: 1;
    }
    .game-actions {
        flex-shrink: 0;
    }
    .form-group {
        margin: 10px 0;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-group input, .form-group select {
        width: 100%;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }
    .btn {
        background: #2196F3;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 3px;
        cursor: pointer;
        margin: 5px;
    }
    .btn:hover {
        background: #1976D2;
    }
    .btn-danger {
        background: #f44336;
    }
    .btn-danger:hover {
        background: #d32f2f;
    }
    .btn-success {
        background: #4CAF50;
    }
    .btn-success:hover {
        background: #45a049;
    }
    .message {
        background: #dff0d8;
        border: 1px solid #d6e9c6;
        color: #3c763d;
        padding: 10px;
        border-radius: 3px;
        margin: 10px 0;
    }
    .error {
        background: #f2dede;
        border: 1px solid #ebccd1;
        color: #a94442;
        padding: 10px;
        border-radius: 3px;
        margin: 10px 0;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        border-radius: 5px;
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
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Tabbed Capsule Management</h1>
        <p>Manage the tabbed single column capsule system for the 2008 Steam theme.</p>
        
        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <div class="tab-section">
            <h2>Tabs</h2>
            <button class="btn btn-success" onclick="openCreateTabModal()">Create New Tab</button>
            
            <table class="admin-table" style="width: 100%; margin-top: 20px; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f0f0f0;">
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">ID</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Tab Name</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Order</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Active</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Games</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tabs as $tab): ?>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 10px;"><?= $tab['id'] ?></td>
                            <td style="border: 1px solid #ddd; padding: 10px;"><?= htmlspecialchars($tab['tab_name']) ?></td>
                            <td style="border: 1px solid #ddd; padding: 10px;"><?= $tab['tab_order'] ?></td>
                            <td style="border: 1px solid #ddd; padding: 10px;"><?= $tab['active'] ? 'Yes' : 'No' ?></td>
                            <td style="border: 1px solid #ddd; padding: 10px;">
                                <?php
                                $gameCount = $db->prepare('SELECT COUNT(*) FROM tabbed_capsule_games WHERE tab_id = ?');
                                $gameCount->execute([$tab['id']]);
                                echo $gameCount->fetchColumn();
                                ?>
                            </td>
                            <td style="border: 1px solid #ddd; padding: 10px;">
                                <a href="?tab_id=<?= $tab['id'] ?>" class="btn">Manage Games</a>
                                <button class="btn" onclick="openEditTabModal(<?= htmlspecialchars(json_encode($tab)) ?>)">Edit</button>
                                <button class="btn btn-danger" onclick="deleteTab(<?= $tab['id'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?php if ($selected_tab_id): ?>
            <?php
            $selected_tab = array_filter($tabs, function($t) use ($selected_tab_id) {
                return $t['id'] == $selected_tab_id;
            });
            $selected_tab = reset($selected_tab);
            ?>
            <div class="tab-section">
                <h2>Managing Games for Tab: <?= htmlspecialchars($selected_tab['tab_name']) ?></h2>
                <button class="btn btn-success" onclick="openAddGameModal(<?= $selected_tab_id ?>)">Add Game to Tab</button>
                <a href="?" class="btn">Back to All Tabs</a>
                
                <?php if (!empty($tab_games)): ?>
                    <?php foreach ($tab_games as $game): ?>
                        <div class="game-item">
                            <div class="game-info">
                                <strong><?= htmlspecialchars($game['custom_name'] ?: $game['app_name']) ?></strong><br>
                                App ID: <?= $game['appid'] ?> | 
                                Price: $<?= number_format($game['custom_price'] ?: $game['app_price'], 2) ?> |
                                Order: <?= $game['game_order'] ?>
                                <?php if ($game['release_date']): ?>
                                    | Release: <?= $game['release_date'] ?>
                                <?php endif; ?>
                            </div>
                            <div class="game-actions">
                                <button class="btn btn-danger" onclick="removeGame(<?= $game['id'] ?>)">Remove</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No games added to this tab yet.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Create Tab Modal -->
    <div id="createTabModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('createTabModal')">&times;</span>
            <h2>Create New Tab</h2>
            <form method="post" action="?action=create_tab">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">
                <div class="form-group">
                    <label for="tab_name">Tab Name:</label>
                    <input type="text" id="tab_name" name="tab_name" required>
                </div>
                <div class="form-group">
                    <label for="tab_order">Order:</label>
                    <input type="number" id="tab_order" name="tab_order" value="<?= count($tabs) + 1 ?>" required>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="active" value="1" checked> Active
                    </label>
                </div>
                <button type="submit" class="btn btn-success">Create Tab</button>
            </form>
        </div>
    </div>
    
    <!-- Edit Tab Modal -->
    <div id="editTabModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('editTabModal')">&times;</span>
            <h2>Edit Tab</h2>
            <form method="post" action="?action=edit_tab">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">
                <input type="hidden" id="edit_tab_id" name="tab_id">
                <div class="form-group">
                    <label for="edit_tab_name">Tab Name:</label>
                    <input type="text" id="edit_tab_name" name="tab_name" required>
                </div>
                <div class="form-group">
                    <label for="edit_tab_order">Order:</label>
                    <input type="number" id="edit_tab_order" name="tab_order" required>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="edit_active" name="active" value="1"> Active
                    </label>
                </div>
                <button type="submit" class="btn btn-success">Update Tab</button>
            </form>
        </div>
    </div>
    
    <!-- Add Game Modal -->
    <div id="addGameModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addGameModal')">&times;</span>
            <h2>Add Game to Tab</h2>
            <form method="post" action="?action=add_game">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">
                <input type="hidden" id="game_tab_id" name="tab_id">
                <div class="form-group">
                    <label for="appid">Select Game:</label>
                    <select id="appid" name="appid" required>
                        <option value="">Select a game...</option>
                        <?php foreach ($apps as $app): ?>
                            <option value="<?= $app['appid'] ?>"><?= htmlspecialchars($app['name']) ?> (ID: <?= $app['appid'] ?>) - $<?= number_format($app['price'], 2) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="game_order">Display Order:</label>
                    <input type="number" id="game_order" name="game_order" value="1" required>
                </div>
                <div class="form-group">
                    <label for="custom_name">Custom Name (optional):</label>
                    <input type="text" id="custom_name" name="custom_name" placeholder="Leave blank to use original name">
                </div>
                <div class="form-group">
                    <label for="custom_price">Custom Price (optional):</label>
                    <input type="number" step="0.01" id="custom_price" name="custom_price" placeholder="Leave blank to use original price">
                </div>
                <div class="form-group">
                    <label for="release_date">Release Date (optional):</label>
                    <input type="date" id="release_date" name="release_date">
                </div>
                <button type="submit" class="btn btn-success">Add Game</button>
            </form>
        </div>
    </div>
    
    <script>
    const csrfToken = '<?= htmlspecialchars($csrfToken, ENT_QUOTES) ?>';
    function openCreateTabModal() {
        document.getElementById('createTabModal').style.display = 'block';
    }
    
    function openEditTabModal(tab) {
        document.getElementById('edit_tab_id').value = tab.id;
        document.getElementById('edit_tab_name').value = tab.tab_name;
        document.getElementById('edit_tab_order').value = tab.tab_order;
        document.getElementById('edit_active').checked = tab.active == 1;
        document.getElementById('editTabModal').style.display = 'block';
    }
    
    function openAddGameModal(tabId) {
        document.getElementById('game_tab_id').value = tabId;
        document.getElementById('addGameModal').style.display = 'block';
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
    
    function deleteTab(tabId) {
        if (confirm('Are you sure you want to delete this tab? This will also remove all games from the tab.')) {
            var form = document.createElement('form');
            form.method = 'post';
            form.action = '?action=delete_tab';

            var idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'tab_id';
            idInput.value = tabId;
            form.appendChild(idInput);

            var tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = 'csrf_token';
            tokenInput.value = csrfToken;
            form.appendChild(tokenInput);

            document.body.appendChild(form);
            form.submit();
        }
    }
    
    function removeGame(gameId) {
        if (confirm('Are you sure you want to remove this game from the tab?')) {
            var form = document.createElement('form');
            form.method = 'post';
            form.action = '?action=remove_game';

            var idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'game_id';
            idInput.value = gameId;
            form.appendChild(idInput);

            var tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = 'csrf_token';
            tokenInput.value = csrfToken;
            form.appendChild(tokenInput);

            document.body.appendChild(form);
            form.submit();
        }
    }
    
    // Close modal when clicking outside of it
    window.onclick = function(event) {
        var modals = document.getElementsByClassName('modal');
        for (var i = 0; i < modals.length; i++) {
            if (event.target == modals[i]) {
                modals[i].style.display = 'none';
            }
        }
    }
    </script>
</body>
</html>