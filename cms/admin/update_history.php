<?php
require_once 'admin_header.php';
$db = cms_get_db();
if(isset($_GET['ajax'])){
    header('Content-Type: application/json');
    $action = $_GET['action'] ?? $_POST['action'] ?? '';
    if($action === 'appids'){
        $rows = $db->query('SELECT DISTINCT appid FROM platform_update_history ORDER BY appid')->fetchAll(PDO::FETCH_COLUMN);
        echo json_encode($rows);
        exit;
    }
    if($action === 'list'){
        $appid = (int)($_GET['appid'] ?? 0);
        $stmt = $db->prepare('SELECT id, appid, date, title, content FROM platform_update_history WHERE appid=? ORDER BY date DESC');
        $stmt->execute([$appid]);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;
    }
    if($action === 'save' && $_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = (int)($_POST['id'] ?? 0);
        $appid = (int)($_POST['appid'] ?? 0);
        $date = $_POST['date'] ?? date('Y-m-d');
        $title = trim($_POST['title'] ?? '');
        $content = $_POST['content'] ?? '';
        if($id){
            $stmt = $db->prepare('UPDATE platform_update_history SET appid=?, date=?, title=?, content=? WHERE id=?');
            $stmt->execute([$appid, $date, $title, $content, $id]);
            cms_admin_log('Updated platform update history '.$id);
        } else {
            $stmt = $db->prepare('INSERT INTO platform_update_history (appid,date,title,content) VALUES (?,?,?,?)');
            $stmt->execute([$appid, $date, $title, $content]);
            cms_admin_log('Added platform update history '.$db->lastInsertId());
        }
        echo json_encode(['status'=>'ok']);
        exit;
    }
    if($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = (int)($_POST['id'] ?? 0);
        $stmt = $db->prepare('DELETE FROM platform_update_history WHERE id=?');
        $stmt->execute([$id]);
        cms_admin_log('Deleted platform update history '.$id);
        echo json_encode(['status'=>'ok']);
        exit;
    }
    echo json_encode(['status'=>'error']);
    exit;
}
$appids = $db->query('SELECT DISTINCT appid FROM platform_update_history ORDER BY appid')->fetchAll(PDO::FETCH_COLUMN);
?>
<h2>Update History Management</h2>
<label for="appidFilter">Select AppID:</label>
<select id="appidFilter">
    <option value="">--Select AppID--</option>
    <?php foreach($appids as $a): ?>
    <option value="<?php echo (int)$a; ?>"><?php echo (int)$a; ?></option>
    <?php endforeach; ?>
</select>
<table id="updateTable" class="data-table">
    <thead>
        <tr>
            <th data-col="date">Date</th>
            <th data-col="appid">AppID</th>
            <th data-col="title">Title</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<div id="pagination"></div>
<hr>
<h2>Add or Edit Update History</h2>
<form id="updateForm">
    <input type="hidden" name="id" id="formId">
    <p><label>Date <input type="text" name="date" id="formDate" placeholder="YYYY-MM-DD"></label></p>
    <p><label>AppID <input type="number" name="appid" id="formAppid"></label></p>
    <p><label>Title <input type="text" name="title" id="formTitle"></label></p>
    <p><label>Description<br><textarea name="content" id="formContent"></textarea></label></p>
    <p><button type="submit" class="btn">Save</button></p>
</form>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('formContent');
$('#formDate').datepicker({dateFormat:'yy-mm-dd', changeMonth:true, changeYear:true});
const perPage = 10;
let entries = [];
let sortCol = 'date';
let sortDir = 'desc';
let currentPage = 1;
function renderTable(){
    entries.sort(function(a,b){
        let av=a[sortCol], bv=b[sortCol];
        if(sortCol==='date'){ av=new Date(av); bv=new Date(bv); }
        if(av<bv) return sortDir==='asc' ? -1 : 1;
        if(av>bv) return sortDir==='asc' ? 1 : -1;
        return 0;
    });
    const start=(currentPage-1)*perPage;
    const pageData=entries.slice(start,start+perPage);
    const tbody = $('#updateTable tbody').empty();
    pageData.forEach(function(e){
        const tr=$('<tr>');
        tr.append('<td>'+e.date+'</td>');
        tr.append('<td>'+e.appid+'</td>');
        tr.append('<td>'+escapeHtml(e.title||'')+'</td>');
        tr.append('<td><button class="edit-btn btn btn-small" data-id="'+e.id+'">Edit</button> <button class="delete-btn btn btn-small" data-id="'+e.id+'">Delete</button></td>');
        tbody.append(tr);
    });
    renderPagination();
}
function renderPagination(){
    const totalPages=Math.ceil(entries.length/perPage);
    const pag=$('#pagination').empty();
    if(totalPages<=1) return;
    if(currentPage>1) pag.append('<button class="btn btn-small" id="prevPage">Prev</button>');
    pag.append('<span> Page '+currentPage+' of '+totalPages+' </span>');
    if(currentPage<totalPages) pag.append('<button class="btn btn-small" id="nextPage">Next</button>');
}
function loadEntries(){
    const appid=$('#appidFilter').val();
    if(!appid){ entries=[]; renderTable(); return; }
    $.getJSON('update_history.php', {ajax:1, action:'list', appid:appid}, function(res){
        entries=res;
        currentPage=1;
        $('#formAppid').val(appid);
        renderTable();
    });
}
$('#appidFilter').on('change', loadEntries);
$('#pagination').on('click','#prevPage',function(){ if(currentPage>1){ currentPage--; renderTable(); } });
$('#pagination').on('click','#nextPage',function(){ const t=Math.ceil(entries.length/perPage); if(currentPage<t){ currentPage++; renderTable(); } });
$('#updateTable').on('click','.delete-btn',function(){
    if(!confirm('Delete this entry?')) return;
    const id=$(this).data('id');
    $.post('update_history.php?ajax=1',{action:'delete',id:id},function(){ loadEntries(); },'json');
});
$('#updateTable').on('click','.edit-btn',function(){
    const id=$(this).data('id');
    const entry=entries.find(e=>e.id==id);
    if(!entry) return;
    $('#formId').val(entry.id);
    $('#formDate').val(entry.date);
    $('#formAppid').val(entry.appid);
    $('#formTitle').val(entry.title);
    CKEDITOR.instances.formContent.setData(entry.content);
});
$('#updateTable th').on('click',function(){
    const col=$(this).data('col');
    if(!col) return;
    if(sortCol===col){ sortDir = sortDir==='asc' ? 'desc' : 'asc'; } else { sortCol=col; sortDir='asc'; }
    renderTable();
});
$('#updateForm').on('submit',function(e){
    e.preventDefault();
    const payload={action:'save', id:$('#formId').val(), date:$('#formDate').val(), appid:$('#formAppid').val(), title:$('#formTitle').val(), content:CKEDITOR.instances.formContent.getData()};
    $.post('update_history.php?ajax=1', payload, function(){
        $('#updateForm')[0].reset();
        CKEDITOR.instances.formContent.setData('');
        loadEntries();
    },'json');
});
function escapeHtml(t){ return $('<div>').text(t).html(); }
</script>
<?php include 'admin_footer.php'; ?>
