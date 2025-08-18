<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
try {
    // Verify the marketing table exists and is accessible
    $db->query("SELECT msgtype, message FROM marketing");
} catch (PDOException $e) {
    error_log($e->getMessage());
    // Optionally fallback or notify admin
    die("Required table 'marketing' is missing.");
}

if (isset($_GET['ajax']) && $_GET['ajax'] === 'get') {
    $msgtype = preg_replace('/[^a-z0-9_]/i', '', $_GET['msgtype'] ?? '');
    $language = preg_replace('/[^a-z0-9_]/i', '', $_GET['language'] ?? '');
    $stmt = $db->prepare('SELECT msgtype, language, content FROM marketing WHERE msgtype=? AND language=?');
    $stmt->execute([$msgtype, $language]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC) ?: []);
    exit;
}

if (isset($_POST['ajax'])) {
    header('Content-Type: application/json');
    $action = $_POST['ajax'];
    if ($action === 'save') {
        $msgtype = preg_replace('/[^a-z0-9_]/i', '', $_POST['msgtype'] ?? '');
        $language = preg_replace('/[^a-z0-9_]/i', '', $_POST['language'] ?? '');
        $content = $_POST['content'] ?? '';
        $orig_msgtype = preg_replace('/[^a-z0-9_]/i', '', $_POST['orig_msgtype'] ?? $msgtype);
        $orig_language = preg_replace('/[^a-z0-9_]/i', '', $_POST['orig_language'] ?? $language);
        $stmt = $db->prepare('SELECT COUNT(*) FROM marketing WHERE msgtype=? AND language=?');
        $stmt->execute([$orig_msgtype, $orig_language]);
        if ($stmt->fetchColumn()) {
            $stmt = $db->prepare('UPDATE marketing SET msgtype=?, language=?, content=? WHERE msgtype=? AND language=?');
            $stmt->execute([$msgtype, $language, $content, $orig_msgtype, $orig_language]);
        } else {
            $stmt = $db->prepare('INSERT INTO marketing (msgtype, language, content) VALUES (?,?,?)');
            $stmt->execute([$msgtype, $language, $content]);
        }
        echo json_encode([
            'success' => true,
            'msgtype' => $msgtype,
            'language' => $language,
            'orig_msgtype' => $orig_msgtype,
            'orig_language' => $orig_language,
        ]);
    } elseif ($action === 'delete') {
        $msgtype = preg_replace('/[^a-z0-9_]/i', '', $_POST['msgtype'] ?? '');
        $language = preg_replace('/[^a-z0-9_]/i', '', $_POST['language'] ?? '');
        $stmt = $db->prepare('DELETE FROM marketing WHERE msgtype=? AND language=?');
        $stmt->execute([$msgtype, $language]);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Unknown action']);
    }
    exit;
}

$rows = $db->query('SELECT msgtype, language FROM marketing ORDER BY msgtype, language')->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="css/missing.css">
<h2>Preload Marketing Content</h2>
<table class="data-table" id="marketingTable">
<tr><th>Message Type</th><th>Language</th><th>Action</th></tr>
<?php foreach ($rows as $r) : ?>
<tr data-msgtype="<?php echo htmlspecialchars($r['msgtype']); ?>" data-language="<?php echo htmlspecialchars($r['language']); ?>">
<td><?php echo htmlspecialchars($r['msgtype']); ?></td>
<td><?php echo htmlspecialchars($r['language']); ?></td>
<td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
</tr>
<?php endforeach; ?>
</table>
<button id="addBtn">Add New Preload Content</button>
<div id="modalOverlay" class="modal-overlay" style="display:none;">
  <div class="modal" role="dialog" aria-modal="true">
    <form id="contentForm">
      <input type="hidden" name="orig_msgtype" id="orig_msgtype">
      <input type="hidden" name="orig_language" id="orig_language">
      <label>Message Type: <input type="text" name="msgtype" id="msgtype"></label>
      <label>Language: <input type="text" name="language" id="language"></label>
      <label>Content:</label>
      <textarea name="content" id="content" style="width:100%;height:300px;"></textarea>
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="button" id="cancelBtn">Cancel</button>
    </form>
  </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="js/preload_marketing.js"></script>
<?php include 'admin_footer.php'; ?>
