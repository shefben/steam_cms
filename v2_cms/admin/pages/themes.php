<?php
// Theme configuration and management page

$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update_theme_config':
                try {
                    $theme_id = $_POST['theme_id'];
                    $data = [
                        'display_name' => $_POST['display_name'],
                        'description' => $_POST['description'],
                        'layout_type' => $_POST['layout_type'],
                        'has_navigation' => isset($_POST['has_navigation']) ? 1 : 0,
                        'header_style' => $_POST['header_style'],
                        'color_scheme' => $_POST['color_scheme'],
                        'is_active' => isset($_POST['is_active']) ? 1 : 0
                    ];
                    
                    $db->update('theme_configs', $data, 'id = ?', [$theme_id]);
                    $message = '<div class="alert alert-success">Theme configuration updated successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
        }
    }
}

// Get all themes
$themes = $db->query("SELECT * FROM theme_configs ORDER BY theme ASC");
$current_theme_config = null;
if (isset($_GET['edit'])) {
    $current_theme_config = $db->queryOne("SELECT * FROM theme_configs WHERE id = ?", [$_GET['edit']]);
}
?>

<?= $message ?>

<div class="stats-grid">
    <?php foreach ($themes as $theme): ?>
        <div class="stat-card <?= $theme['is_active'] ? 'success' : 'danger' ?>">
            <div class="stat-number" style="font-size: 18px;"><?= htmlspecialchars($theme['theme']) ?></div>
            <div class="stat-label"><?= htmlspecialchars($theme['display_name']) ?></div>
            <div style="margin-top: 10px;">
                <a href="?action=themes&theme=<?= $current_theme ?>&edit=<?= $theme['id'] ?>" 
                   class="btn btn-small btn-primary">Configure</a>
                <a href="?action=dashboard&theme=<?= $theme['theme'] ?>" 
                   class="btn btn-small btn-success">Switch To</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php if ($current_theme_config): ?>
<div class="card">
    <div class="card-header">
        <h3>Configure Theme: <?= htmlspecialchars($current_theme_config['display_name']) ?></h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="update_theme_config">
            <input type="hidden" name="theme_id" value="<?= $current_theme_config['id'] ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="display_name">Display Name</label>
                    <input type="text" id="display_name" name="display_name" class="form-control" 
                           value="<?= htmlspecialchars($current_theme_config['display_name']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="layout_type">Layout Type</label>
                    <select id="layout_type" name="layout_type" class="form-control">
                        <option value="table" <?= $current_theme_config['layout_type'] === 'table' ? 'selected' : '' ?>>Table-based</option>
                        <option value="css" <?= $current_theme_config['layout_type'] === 'css' ? 'selected' : '' ?>>CSS-based</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3"><?= htmlspecialchars($current_theme_config['description']) ?></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="header_style">Header Style</label>
                    <input type="text" id="header_style" name="header_style" class="form-control" 
                           value="<?= htmlspecialchars($current_theme_config['header_style']) ?>">
                </div>
                <div class="form-group">
                    <label for="color_scheme">Color Scheme</label>
                    <input type="text" id="color_scheme" name="color_scheme" class="form-control" 
                           value="<?= htmlspecialchars($current_theme_config['color_scheme']) ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label>
                    <input type="checkbox" name="has_navigation" value="1" 
                           <?= $current_theme_config['has_navigation'] ? 'checked' : '' ?>>
                    Has Navigation Menu
                </label>
            </div>
            
            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" 
                           <?= $current_theme_config['is_active'] ? 'checked' : '' ?>>
                    Theme Active
                </label>
            </div>
            
            <button type="submit" class="btn btn-success">Update Theme Configuration</button>
            <a href="?action=themes&theme=<?= $current_theme ?>" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h3>Theme Usage Statistics</h3>
    </div>
    <div class="card-body">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Theme</th>
                    <th>News Articles</th>
                    <th>FAQ Entries</th>
                    <th>Navigation Links</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($themes as $theme): ?>
                    <?php
                    $news_count = $db->queryOne("SELECT COUNT(*) as count FROM news_articles WHERE theme = ?", [$theme['theme']])['count'];
                    $faq_count = $db->queryOne("SELECT COUNT(*) as count FROM faq_entries fe JOIN faq_categories fc ON fe.category_id = fc.id WHERE fc.theme = ?", [$theme['theme']])['count'];
                    $nav_count = $db->queryOne("SELECT COUNT(*) as count FROM navigation_links WHERE theme = ?", [$theme['theme']])['count'];
                    ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($theme['display_name']) ?></strong></td>
                        <td><?= $news_count ?></td>
                        <td><?= $faq_count ?></td>
                        <td><?= $nav_count ?></td>
                        <td>
                            <span class="badge <?= $theme['is_active'] ? 'badge-success' : 'badge-danger' ?>">
                                <?= $theme['is_active'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
