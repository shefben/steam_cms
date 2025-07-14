<?php
require_once 'admin_header.php';
cms_require_permission('news_create');

$db = cms_get_db();
$preview = [];

function norm_date(string $raw): string {
    $ts = strtotime($raw);
    return $ts !== false ? date('Y-m-d H:i:s', $ts) : $raw;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['preview']) && !empty($_FILES['file']['tmp_name'])) {
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
        $_SESSION['news_import'] = $data;
        $preview = array_slice($data, 0, 5);
    } elseif (isset($_POST['import']) && !empty($_SESSION['news_import'])) {
        $data = $_SESSION['news_import'];
        unset($_SESSION['news_import']);
        $db->beginTransaction();
        $stmt = $db->prepare('INSERT INTO news(title,author,publish_date,publish_at,content,views,is_official,status) VALUES(?,?,?,?,?,0,0,\'published\')');
        foreach ($data as $row) {
            $date = norm_date($row['publish_date'] ?? '');
            $stmt->execute([
                $row['title'] ?? '',
                $row['author'] ?? '',
                $date,
                $date,
                $row['content'] ?? ''
            ]);
        }
        $db->commit();
        cms_admin_log('Imported '.count($data).' news articles');
        echo '<p>Import successful.</p><p><a href="news.php">Back to list</a></p>';
        include 'admin_footer.php';
        exit;
    }
}
?>
<h2>Import News</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <button type="submit" name="preview" class="btn btn-primary">Preview</button>
</form>
<?php if ($preview): ?>
<h3>Preview</h3>
<table class="table">
    <tr><th>Title</th><th>Author</th><th>Date</th></tr>
<?php foreach ($preview as $r): ?>
    <tr>
        <td><?php echo htmlspecialchars($r['title'] ?? '') ?></td>
        <td><?php echo htmlspecialchars($r['author'] ?? '') ?></td>
        <td><?php echo htmlspecialchars($r['publish_date'] ?? '') ?></td>
    </tr>
<?php endforeach; ?>
</table>
<form method="post">
    <button type="submit" name="import" value="1" class="btn btn-success">Import</button>
</form>
<?php endif; ?>
<p><a href="news.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
