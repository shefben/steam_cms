<?php
// FAQ management page

$faq_model = new FAQModel($db);
$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create_category':
                try {
                    $data = [
                        'theme' => $current_theme,
                        'name' => $_POST['name'],
                        'description' => $_POST['description'],
                        'sort_order' => $_POST['sort_order']
                    ];
                    
                    $faq_model->createCategory($data);
                    $message = '<div class="alert alert-success">FAQ category created successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'create_entry':
                try {
                    $data = [
                        'category_id' => $_POST['category_id'],
                        'question' => $_POST['question'],
                        'answer' => $_POST['answer'],
                        'sort_order' => $_POST['sort_order']
                    ];
                    
                    $faq_model->createEntry($data);
                    $message = '<div class="alert alert-success">FAQ entry created successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'update_category':
                try {
                    $id = $_POST['id'];
                    $data = [
                        'name' => $_POST['name'],
                        'description' => $_POST['description'],
                        'sort_order' => $_POST['sort_order']
                    ];
                    
                    $faq_model->updateCategory($id, $data);
                    $message = '<div class="alert alert-success">FAQ category updated successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'update_entry':
                try {
                    $id = $_POST['id'];
                    $data = [
                        'category_id' => $_POST['category_id'],
                        'question' => $_POST['question'],
                        'answer' => $_POST['answer'],
                        'sort_order' => $_POST['sort_order']
                    ];
                    
                    $faq_model->updateEntry($id, $data);
                    $message = '<div class="alert alert-success">FAQ entry updated successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'delete_category':
                try {
                    $id = $_POST['id'];
                    $faq_model->deleteCategory($id);
                    $message = '<div class="alert alert-success">FAQ category and all entries deleted successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'delete_entry':
                try {
                    $id = $_POST['id'];
                    $faq_model->deleteEntry($id);
                    $message = '<div class="alert alert-success">FAQ entry deleted successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
        }
    }
}

// Get editing items if specified
$editing_category = null;
$editing_entry = null;
if (isset($_GET['edit_category'])) {
    $editing_category = $db->queryOne("SELECT * FROM faq_categories WHERE id = ?", [$_GET['edit_category']]);
}
if (isset($_GET['edit_entry'])) {
    $editing_entry = $db->queryOne("SELECT * FROM faq_entries WHERE id = ?", [$_GET['edit_entry']]);
}

// Get all categories and entries for current theme
$categories = $faq_model->getCategories($current_theme);
?>

<?= $message ?>

<div class="form-actions" style="margin-bottom: 30px;">
    <button type="button" class="btn btn-primary" onclick="toggleCategoryForm()">
        <?= $editing_category ? 'Cancel Edit Category' : 'Add New Category' ?>
    </button>
    <button type="button" class="btn btn-success" onclick="toggleEntryForm()">
        <?= $editing_entry ? 'Cancel Edit Entry' : 'Add New FAQ Entry' ?>
    </button>
</div>

<!-- Category Form -->
<div id="category-form" class="card" style="<?= $editing_category ? '' : 'display: none;' ?>">
    <div class="card-header">
        <h3><?= $editing_category ? 'Edit FAQ Category' : 'Create New FAQ Category' ?></h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="<?= $editing_category ? 'update_category' : 'create_category' ?>">
            <?php if ($editing_category): ?>
                <input type="hidden" name="id" value="<?= $editing_category['id'] ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="cat_name">Category Name *</label>
                    <input type="text" id="cat_name" name="name" class="form-control" 
                           value="<?= htmlspecialchars($editing_category['name'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="cat_sort_order">Sort Order</label>
                    <input type="number" id="cat_sort_order" name="sort_order" class="form-control" 
                           value="<?= $editing_category['sort_order'] ?? (count($categories) + 1) ?>" min="1">
                </div>
            </div>
            
            <div class="form-group">
                <label for="cat_description">Description</label>
                <textarea id="cat_description" name="description" class="form-control" rows="3" 
                          placeholder="Brief description of this FAQ category..."><?= htmlspecialchars($editing_category['description'] ?? '') ?></textarea>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <?= $editing_category ? 'Update Category' : 'Create Category' ?>
                </button>
                <button type="button" class="btn btn-danger" onclick="toggleCategoryForm()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Entry Form -->
<div id="entry-form" class="card" style="<?= $editing_entry ? '' : 'display: none;' ?>">
    <div class="card-header">
        <h3><?= $editing_entry ? 'Edit FAQ Entry' : 'Create New FAQ Entry' ?></h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="<?= $editing_entry ? 'update_entry' : 'create_entry' ?>">
            <?php if ($editing_entry): ?>
                <input type="hidden" name="id" value="<?= $editing_entry['id'] ?>">
            <?php endif; ?>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="entry_category_id">Category *</label>
                    <select id="entry_category_id" name="category_id" class="form-control" required>
                        <option value="">Select a category...</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" 
                                    <?= ($editing_entry['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="entry_sort_order">Sort Order</label>
                    <input type="number" id="entry_sort_order" name="sort_order" class="form-control" 
                           value="<?= $editing_entry['sort_order'] ?? 1 ?>" min="1">
                </div>
            </div>
            
            <div class="form-group">
                <label for="entry_question">Question *</label>
                <input type="text" id="entry_question" name="question" class="form-control" 
                       value="<?= htmlspecialchars($editing_entry['question'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="entry_answer">Answer *</label>
                <textarea id="entry_answer" name="answer" class="form-control large" rows="6" required 
                          placeholder="Detailed answer to the question..."><?= htmlspecialchars($editing_entry['answer'] ?? '') ?></textarea>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <?= $editing_entry ? 'Update Entry' : 'Create Entry' ?>
                </button>
                <button type="button" class="btn btn-danger" onclick="toggleEntryForm()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- FAQ Categories and Entries List -->
<div class="card">
    <div class="card-header">
        <h3>FAQ Categories and Entries for <?= htmlspecialchars($current_theme) ?></h3>
    </div>
    <div class="card-body">
        <?php if (empty($categories)): ?>
            <p>No FAQ categories found for this theme. <a href="#" onclick="toggleCategoryForm()">Create the first one!</a></p>
        <?php else: ?>
            <?php foreach ($categories as $category): ?>
                <div class="faq-category-section">
                    <div class="category-header">
                        <h4><?= htmlspecialchars($category['name']) ?></h4>
                        <div class="category-actions">
                            <a href="?action=faq&theme=<?= $current_theme ?>&edit_category=<?= $category['id'] ?>" 
                               class="btn btn-small btn-warning">Edit Category</a>
                            
                            <form method="POST" style="display: inline;" 
                                  onsubmit="return confirm('Are you sure? This will delete the category and ALL its entries!')">
                                <input type="hidden" name="action" value="delete_category">
                                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                <button type="submit" class="btn btn-small btn-danger">Delete Category</button>
                            </form>
                        </div>
                    </div>
                    
                    <?php if ($category['description']): ?>
                        <p class="category-description"><?= htmlspecialchars($category['description']) ?></p>
                    <?php endif; ?>
                    
                    <?php
                    $entries = $faq_model->getEntriesByCategory($category['id']);
                    ?>
                    
                    <?php if (empty($entries)): ?>
                        <p style="color: #7f8c8d; font-style: italic;">No entries in this category yet.</p>
                    <?php else: ?>
                        <div class="faq-entries">
                            <?php foreach ($entries as $entry): ?>
                                <div class="faq-entry">
                                    <div class="entry-question">
                                        <strong>Q: <?= htmlspecialchars($entry['question']) ?></strong>
                                    </div>
                                    <div class="entry-answer">
                                        <strong>A:</strong> <?= nl2br(htmlspecialchars($entry['answer'])) ?>
                                    </div>
                                    <div class="entry-actions">
                                        <a href="?action=faq&theme=<?= $current_theme ?>&edit_entry=<?= $entry['id'] ?>" 
                                           class="btn btn-small btn-warning">Edit</a>
                                        
                                        <form method="POST" style="display: inline;" 
                                              onsubmit="return confirm('Are you sure you want to delete this FAQ entry?')">
                                            <input type="hidden" name="action" value="delete_entry">
                                            <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                                            <button type="submit" class="btn btn-small btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
function toggleCategoryForm() {
    const form = document.getElementById('category-form');
    const isVisible = form.style.display !== 'none';
    
    if (isVisible) {
        form.style.display = 'none';
        <?php if (!$editing_category): ?>
        form.querySelector('form').reset();
        <?php endif; ?>
    } else {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth' });
    }
}

function toggleEntryForm() {
    const form = document.getElementById('entry-form');
    const isVisible = form.style.display !== 'none';
    
    if (isVisible) {
        form.style.display = 'none';
        <?php if (!$editing_entry): ?>
        form.querySelector('form').reset();
        <?php endif; ?>
    } else {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>

<style>
.faq-category-section {
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 20px;
    overflow: hidden;
}

.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8f9fa;
    padding: 15px 20px;
    border-bottom: 1px solid #ddd;
}

.category-header h4 {
    margin: 0;
    color: #2c3e50;
}

.category-actions {
    display: flex;
    gap: 10px;
}

.category-description {
    padding: 15px 20px;
    margin: 0;
    background: #ffffff;
    border-bottom: 1px solid #ecf0f1;
    color: #7f8c8d;
    font-style: italic;
}

.faq-entries {
    background: #ffffff;
}

.faq-entry {
    padding: 20px;
    border-bottom: 1px solid #ecf0f1;
    position: relative;
}

.faq-entry:last-child {
    border-bottom: none;
}

.entry-question {
    margin-bottom: 10px;
    color: #2c3e50;
}

.entry-answer {
    margin-bottom: 15px;
    line-height: 1.5;
    color: #555;
}

.entry-actions {
    display: flex;
    gap: 10px;
}

.faq-entry:hover {
    background: #f8f9fa;
}
</style>
