<?php
require_once 'admin_header.php';
cms_require_permission('faq_add');

$db = cms_get_db();
$preview = [];

function norm_int($v){ return is_numeric($v) ? (int)$v : 0; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['preview']) && !empty($_FILES['file']['tmp_name'])) {
        if (($_FILES['file']['size'] ?? 0) > 1048576) { // 1MB limit
            die('File too large');
        }
        $tmp = $_FILES['file']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if ($ext === 'json') {
            $data = json_decode(file_get_contents($tmp), true) ?: [];
        } else {
            $fp = fopen($tmp, 'r');
            $header = fgetcsv($fp);
            $data = [];
            while (($row = fgetcsv($fp)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($fp);
        }
        $_SESSION['faq_import'] = $data;
        $preview = array_slice($data, 0, 5);
    } elseif (isset($_POST['import']) && !empty($_SESSION['faq_import'])) {
        $data = $_SESSION['faq_import'];
        unset($_SESSION['faq_import']);
        $stmt = $db->prepare('INSERT INTO faq_content(catid1,catid2,faqid1,faqid2,title,body,views) VALUES(?,?,?,?,?,?,?)');
        foreach ($data as $row) {
            $stmt->execute([
                norm_int($row['catid1'] ?? 0),
                norm_int($row['catid2'] ?? 0),
                norm_int($row['faqid1'] ?? 0),
                norm_int($row['faqid2'] ?? 0),
                $row['title'] ?? '',
                $row['body'] ?? '',
                norm_int($row['views'] ?? 0),
            ]);
        }
        cms_admin_log('Imported '.count($data).' FAQs');
        echo '<p>Import successful.</p><p><a href="faq.php">Back to list</a></p>';
        include 'admin_footer.php';
        exit;
    }
}
?>
<h2>Import FAQs</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <button type="submit" name="preview" class="btn btn-primary">Preview</button>
</form>
<?php if ($preview): ?>
<h3>Preview</h3>
<table class="table">
    <tr><th>catid1</th><th>faqid1</th><th>Title</th></tr>
    <?php foreach ($preview as $r): ?>
    <tr>
        <td><?php echo htmlspecialchars($r['catid1'] ?? '') ?></td>
        <td><?php echo htmlspecialchars($r['faqid1'] ?? '') ?></td>
        <td><?php echo htmlspecialchars($r['title'] ?? '') ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<form method="post">
    <button type="submit" name="import" value="1" class="btn btn-success">Import</button>
</form>
<?php endif; ?>
<p><a href="faq.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
