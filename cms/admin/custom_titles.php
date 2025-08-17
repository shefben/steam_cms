<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
$csrf_token = cms_get_csrf_token();

function cms_render_title_row(array $r): string
{
    $id      = (int) $r['uniqueid'];
    $name    = htmlspecialchars($r['title_name'], ENT_QUOTES);
    $themes  = htmlspecialchars($r['themes'], ENT_QUOTES);
    $content = htmlspecialchars($r['title_content'], ENT_QUOTES);
    return "<tr data-id=\"{$id}\">"
        . "<td><input type=\"text\" class=\"title-name\" name=\"title_name[{$id}]\" value=\"{$name}\"></td>"
        . "<td><input type=\"text\" class=\"themes\" name=\"themes[{$id}]\" value=\"{$themes}\"></td>"
        . "<td><textarea class=\"title-content\" name=\"title_content[{$id}]\" rows=\"2\">{$content}</textarea></td>"
        . "<td><button type=\"button\" class=\"btn btn-danger delete-btn\" data-id=\"{$id}\">Delete</button></td>"
        . "</tr>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    if (!cms_verify_csrf($_POST['csrf_token'] ?? '')) {
        http_response_code(400);
        echo 'bad csrf';
        exit;
    }
    $action = $_POST['action'] ?? '';
    if ($action === 'save') {
        if (!empty($_POST['title_name'])) {
            foreach ($_POST['title_name'] as $id => $name) {
                $id      = (int) $id;
                $themes  = $_POST['themes'][$id] ?? '';
                $content = $_POST['title_content'][$id] ?? '';
                if ($id > 0) {
                    $stmt = $db->prepare('UPDATE custom_titles SET title_name=?, themes=?, title_content=? WHERE uniqueid=?');
                    $stmt->execute([$name, $themes, $content, $id]);
                }
            }
        }
        if (!empty($_POST['new_title_name'])) {
            $stmt = $db->prepare('INSERT INTO custom_titles(title_name,themes,title_content) VALUES(?,?,?)');
            $cnt  = count($_POST['new_title_name']);
            for ($i = 0; $i < $cnt; $i++) {
                $name = trim($_POST['new_title_name'][$i]);
                if ($name === '') {
                    continue;
                }
                $themes  = $_POST['new_themes'][$i] ?? '';
                $content = $_POST['new_title_content'][$i] ?? '';
                $stmt->execute([$name, $themes, $content]);
            }
        }
        echo 'ok';
        exit;
    }
    if ($action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id) {
            $db->prepare('DELETE FROM custom_titles WHERE uniqueid=?')->execute([$id]);
        }
        echo 'ok';
        exit;
    }
}

if (isset($_GET['ajax']) && $_GET['ajax'] == 1 && ($_GET['fetch'] ?? '') === 'rows') {
    $rows = $db->query('SELECT * FROM custom_titles ORDER BY uniqueid')->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $r) {
        echo cms_render_title_row($r);
    }
    exit;
}

$rows = $db->query('SELECT * FROM custom_titles ORDER BY uniqueid')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Custom Titles</h2>
<form id="titles-form">
<table id="titles-table" class="table">
<thead>
<tr><th>Name</th><th>Themes</th><th>Content</th><th>Delete</th></tr>
</thead>
<tbody>
<?php foreach ($rows as $r) { echo cms_render_title_row($r); } ?>
</tbody>
</table>
<button type="button" id="add-title" class="btn btn-secondary">Add New Title</button>
<button type="button" id="save-titles" class="btn btn-primary">Save</button>
</form>
<script>
var CSRF_TOKEN = <?php echo json_encode($csrf_token); ?>;
function newRow(){
    return '<tr class="new">'
        + '<td><input type="text" class="title-name" name="new_title_name[]"></td>'
        + '<td><input type="text" class="themes" name="new_themes[]"></td>'
        + '<td><textarea class="title-content" name="new_title_content[]" rows="2"></textarea></td>'
        + '<td><button type="button" class="btn btn-danger delete-btn">Delete</button></td>'
        + '</tr>';
}
function refreshRows(){
    $('#titles-table tbody').load('custom_titles.php?ajax=1&fetch=rows');
}
$(function(){
    $('#add-title').on('click', function(){
        $('#titles-table tbody').append(newRow());
    });
    $('#titles-table').on('click', '.delete-btn', function(){
        var row = $(this).closest('tr');
        var id  = $(this).data('id');
        if (id){
            $.post('custom_titles.php', {ajax:1,action:'delete',id:id,csrf_token:CSRF_TOKEN}, function(){
                refreshRows();
            });
        } else {
            row.remove();
        }
    });
    $('#save-titles').on('click', function(){
        var data = $('#titles-form').serialize();
        data += '&ajax=1&action=save&csrf_token=' + encodeURIComponent(CSRF_TOKEN);
        $.post('custom_titles.php', data, function(){
            refreshRows();
        });
    });
});
</script>
<?php include 'admin_footer.php'; ?>

