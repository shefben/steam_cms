<?php
// News management page

$news_model = new NewsModel($db);
$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                try {
                    $data = [
                        'title' => $_POST['title'],
                        'content' => $_POST['content'],
                        'excerpt' => $_POST['excerpt'],
                        'theme' => $current_theme,
                        'author' => $_POST['author'] ?: $_SESSION['admin_user']['username'],
                        'published_date' => $_POST['published_date'],
                        'featured_image' => $_POST['featured_image']
                    ];
                    
                    $news_model->create($data);
                    $message = '<div class="alert alert-success">News article created successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'update':
                try {
                    $id = $_POST['id'];
                    $data = [
                        'title' => $_POST['title'],
                        'content' => $_POST['content'],
                        'excerpt' => $_POST['excerpt'],
                        'author' => $_POST['author'],
                        'published_date' => $_POST['published_date'],
                        'featured_image' => $_POST['featured_image']
                    ];
                    
                    $news_model->update($id, $data);
                    $message = '<div class="alert alert-success">News article updated successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'delete':
                try {
                    $id = $_POST['id'];
                    $news_model->delete($id);
                    $message = '<div class="alert alert-success">News article deleted successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'toggle_active':
                try {
                    $id = $_POST['id'];
                    $news_model->toggleActive($id);
                    $message = '<div class="alert alert-success">Article status updated!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
        }
    }
}

// Get editing article if specified
$editing_article = null;
if (isset($_GET['edit'])) {
    $editing_article = $news_model->getById($_GET['edit']);
}

// Get all news for current theme
$news_articles = $news_model->getAll($current_theme);
?>

<?= $message ?>

<div class="form-actions" style="margin-bottom: 30px;">
    <button type="button" class="btn btn-primary" onclick="toggleForm()">
        <?= $editing_article ? 'Cancel Edit' : 'Add New Article' ?>
    </button>
</div>

<!-- Article Form -->
<div id="article-form" class="card" style="<?= $editing_article ? '' : 'display: none;' ?>">
    <div class="card-header">
        <h3><?= $editing_article ? 'Edit Article' : 'Create New Article' ?></h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="<?= $editing_article ? 'update' : 'create' ?>">
            <?php if ($editing_article): ?>
                <input type="hidden" name="id" value="<?= $editing_article['id'] ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" id="title" name="title" class="form-control" 
                           value="<?= htmlspecialchars($editing_article['title'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" id="author" name="author" class="form-control" 
                           value="<?= htmlspecialchars($editing_article['author'] ?? $_SESSION['admin_user']['username']) ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="published_date">Published Date *</label>
                    <input type="date" id="published_date" name="published_date" class="form-control" 
                           value="<?= $editing_article['published_date'] ?? date('Y-m-d') ?>" required>
                </div>
                <div class="form-group">
                    <label for="featured_image">Featured Image URL</label>
                    <input type="url" id="featured_image" name="featured_image" class="form-control" 
                           value="<?= htmlspecialchars($editing_article['featured_image'] ?? '') ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="excerpt">Excerpt</label>
                <textarea id="excerpt" name="excerpt" class="form-control" rows="3" 
                          placeholder="Brief summary of the article..."><?= htmlspecialchars($editing_article['excerpt'] ?? '') ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="content">Content *</label>
                <textarea id="content" name="content" class="form-control large" rows="10" required 
                          placeholder="Article content..."><?= htmlspecialchars($editing_article['content'] ?? '') ?></textarea>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <?= $editing_article ? 'Update Article' : 'Create Article' ?>
                </button>
                <button type="button" class="btn btn-danger" onclick="toggleForm()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Articles List -->
<div class="card">
    <div class="card-header">
        <h3>News Articles for <?= htmlspecialchars($current_theme) ?></h3>
    </div>
    <div class="card-body">
        <?php if (empty($news_articles)): ?>
            <p>No news articles found for this theme. <a href="#" onclick="toggleForm()">Create the first one!</a></p>
        <?php else: ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news_articles as $article): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($article['title']) ?></strong>
                                <?php if ($article['excerpt']): ?>
                                    <br><small style="color: #7f8c8d;"><?= htmlspecialchars(substr($article['excerpt'], 0, 100)) ?>...</small>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($article['author']) ?></td>
                            <td><?= date('M j, Y', strtotime($article['published_date'])) ?></td>
                            <td>
                                <span class="badge <?= $article['is_active'] ? 'badge-success' : 'badge-danger' ?>">
                                    <?= $article['is_active'] ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="?action=news&theme=<?= $current_theme ?>&edit=<?= $article['id'] ?>" 
                                   class="btn btn-small btn-warning">Edit</a>
                                
                                <form method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Toggle article status?')">
                                    <input type="hidden" name="action" value="toggle_active">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                    <button type="submit" class="btn btn-small <?= $article['is_active'] ? 'btn-warning' : 'btn-success' ?>">
                                        <?= $article['is_active'] ? 'Deactivate' : 'Activate' ?>
                                    </button>
                                </form>
                                
                                <form method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this article?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
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
function toggleForm() {
    const form = document.getElementById('article-form');
    const isVisible = form.style.display !== 'none';
    
    if (isVisible) {
        form.style.display = 'none';
        // Reset form if not editing
        <?php if (!$editing_article): ?>
        form.querySelector('form').reset();
        <?php endif; ?>
    } else {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>

<style>
.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: bold;
    text-transform: uppercase;
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
