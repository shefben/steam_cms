<?php
ob_start();
require_once 'admin_header.php';
$admin_header = ob_get_clean();
cms_require_permission('manage_pages');
$db = cms_get_db();
$langs = ['en','fr','de','it','es'];
$lang = in_array($_GET['lang'] ?? '', $langs, true) ? $_GET['lang'] : $langs[0];

if (isset($_GET['ajax']) && $_GET['ajax'] === 'get') {
    $slug = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['slug'] ?? '');
    $stmt = $db->prepare('SELECT * FROM troubleshooter_pages WHERE lang=? AND slug=?');
    $stmt->execute([$lang, $slug]);
    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($edit ?: []);
    exit;
}

if (isset($_POST['ajax']) && $_POST['ajax'] === 'save') {
    $slug = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['slug']);
    $title = trim($_POST['title']);
    $content = $_POST['content'];
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id) {
        $stmt = $db->prepare(
            'UPDATE troubleshooter_pages SET lang=?,slug=?,title=?,content=?,updated=NOW() WHERE id=?'
        );
        $stmt->execute([$lang, $slug, $title, $content, $id]);
    } else {
        $sql = 'INSERT INTO troubleshooter_pages(lang,slug,title,content,created,updated) VALUES(?,?,?,?,NOW(),NOW())';
        $stmt = $db->prepare($sql);
        $stmt->execute([$lang, $slug, $title, $content]);
        $id = $db->lastInsertId();
    }
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'id' => $id]);
    exit;
}

$pages = $db->prepare('SELECT slug,title FROM troubleshooter_pages WHERE lang=? ORDER BY slug');
$pages->execute([$lang]);
$pages = $pages->fetchAll(PDO::FETCH_ASSOC);

echo $admin_header;
?>
<link rel="stylesheet" href="css/missing.css">
<h2>Manage Troubleshooter Pages</h2>
<form method="get" id="langForm">
<select name="lang" onchange="document.getElementById('langForm').submit()">
<?php foreach ($langs as $l) : ?>
    <?php $selected = ($l == $lang) ? ' selected' : ''; ?>
    <option value="<?php echo $l; ?>"<?php echo $selected; ?>><?php echo strtoupper($l); ?></option>
<?php endforeach; ?>
</select>
</form>
<table class="data-table">
<tr><th>Slug</th><th>Title</th><th>Actions</th></tr>
<?php foreach ($pages as $p) : ?>
<tr>
<td><?php echo htmlspecialchars($p['slug']); ?></td>
<td><?php echo htmlspecialchars($p['title']); ?></td>
<td><a href="#" class="edit-link" data-slug="<?php echo htmlspecialchars($p['slug']); ?>">Edit</a></td>
</tr>
<?php endforeach; ?>
</table>
<button id="addBtn">Add Page</button>

<div id="modalOverlay" class="modal-overlay" style="display:none;">
  <div class="modal" role="dialog" aria-modal="true">
    <form id="pageForm">
      <input type="hidden" name="lang" value="<?php echo htmlspecialchars($lang); ?>">
      <input type="hidden" name="id" id="page_id" value="">
      <label>Slug: <input type="text" name="slug" id="slug"></label>
      <label>Title: <input type="text" name="title" id="title"></label>
      <textarea name="content" id="content" style="width:100%;height:300px;"></textarea>
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="button" id="cancelBtn">Cancel</button>
    </form>
  </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
$(function(){
  function openModal(data){
    $('#slug').prop('readonly', !!data.slug).val(data.slug||'');
    $('#title').val(data.title||'');
    $('#page_id').val(data.id||'');
    if(CKEDITOR.instances.content){ CKEDITOR.instances.content.destroy(true); }
    CKEDITOR.replace('content');
    CKEDITOR.instances.content.setData(data.content||'');
    $('#modalOverlay').show();
  }
  $('#addBtn').on('click', function(){
    openModal({});
  });
  $('.edit-link').on('click', function(e){
    e.preventDefault();
    var slug=$(this).data('slug');
    $.get('troubleshooter_manage.php', {ajax:'get', lang:'<?php echo $lang; ?>', slug:slug}, function(res){
      openModal(res);
    }, 'json');
  });
  $('#cancelBtn').on('click', function(){
    if(CKEDITOR.instances.content){ CKEDITOR.instances.content.destroy(true); }
    $('#modalOverlay').hide();
  });
  $('#pageForm').on('submit', function(e){
    e.preventDefault();
    var data=$(this).serializeArray();
    data.push({name:'content',value:CKEDITOR.instances.content.getData()});
    data.push({name:'ajax',value:'save'});
    $.post('troubleshooter_manage.php?lang=<?php echo $lang; ?>', data, function(){
      location.reload();
    }, 'json');
  });
});
</script>
<?php include 'admin_footer.php'; ?>

