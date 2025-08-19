<?php
ob_start();
require_once 'admin_header.php';
$admin_header = ob_get_clean();
cms_require_permission('manage_pages');
$db = cms_get_db();
$themes = cms_get_themes();

if(isset($_GET['ajax']) && isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $stmt = $db->prepare('SELECT * FROM download_files WHERE id=?');
    $stmt->execute([$id]);
    $file = $stmt->fetch(PDO::FETCH_ASSOC);
    if($file){
        $m = $db->prepare('SELECT host,url FROM download_file_mirrors WHERE file_id=? ORDER BY ord,id');
        $m->execute([$id]);
        $file['mirrors'] = $m->fetchAll(PDO::FETCH_ASSOC);
    }
    header('Content-Type: application/json');
    echo json_encode($file);
    exit;
}

if(isset($_POST['ajax'])){
    if(isset($_POST['delete'])){
        $id=(int)$_POST['delete'];
        $db->prepare('DELETE FROM download_files WHERE id=?')->execute([$id]);
        echo 'ok';
        exit;
    }
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = trim($_POST['title']);
    $desc = $_POST['description'];
    $size = trim($_POST['file_size']);
    $url = trim($_POST['main_url']);
    $visible = isset($_POST['visible']) ? implode(',', array_map('trim', (array)$_POST['visible'])) : '';
    $usingButton = isset($_POST['usingbutton']) ? 1 : 0;
    $buttonText = trim($_POST['buttonText'] ?? '');
    if(isset($_FILES['main_file']) && $_FILES['main_file']['tmp_name']){
        $fname = basename($_FILES['main_file']['name']);
        $dest = CMS_ROOT.'/downloads/'.$fname;
        move_uploaded_file($_FILES['main_file']['tmp_name'],$dest);
        $url = 'downloads/'.$fname;
    }
    if($id){
        $stmt=$db->prepare('UPDATE download_files SET title=?,description=?,file_size=?,main_url=?,visibleontheme=?,usingbutton=?,buttonText=?,updated=NOW() WHERE id=?');
        $stmt->execute([$title,$desc,$size,$url,$visible,$usingButton,$buttonText,$id]);
        $db->prepare('DELETE FROM download_file_mirrors WHERE file_id=?')->execute([$id]);
    }else{
        $stmt=$db->prepare('INSERT INTO download_files(title,description,file_size,main_url,visibleontheme,usingbutton,buttonText,created,updated) VALUES(?,?,?,?,?,?,?,NOW(),NOW())');
        $stmt->execute([$title,$desc,$size,$url,$visible,$usingButton,$buttonText]);
        $id = $db->lastInsertId();
    }
    if(isset($_POST['mirror_urls']) && is_array($_POST['mirror_urls'])){
        $hosts = $_POST['mirror_hosts'] ?? [];
        $urls = $_POST['mirror_urls'];
        $m=$db->prepare('INSERT INTO download_file_mirrors(file_id,host,url,ord) VALUES(?,?,?,?)');
        $ord=1;
        foreach($urls as $i=>$u){
            $u=trim($u); $h=trim($hosts[$i] ?? ''); if($u==='') continue;
            $m->execute([$id,$h,$u,$ord++]);
        }
    }
    echo 'ok';
    exit;
}

$limit=10;
$page=max(1,(int)($_GET['page']??1));
$offset=($page-1)*$limit;
$total=$db->query('SELECT COUNT(*) FROM download_files')->fetchColumn();
$stmt=$db->prepare('SELECT id,title,file_size,visibleontheme FROM download_files ORDER BY id LIMIT ? OFFSET ?');
$stmt->bindValue(1,$limit,PDO::PARAM_INT);
$stmt->bindValue(2,$offset,PDO::PARAM_INT);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

echo $admin_header;
?>
<h2>Download File Management</h2>
<table class="data-table" id="filesTable">
<tr><th>ID</th><th>Filename</th><th>File Size</th><th>Mirrors</th><th>Visible</th><th>Actions</th></tr>
<?php foreach($rows as $r):
    $cnt=$db->prepare('SELECT COUNT(*) FROM download_file_mirrors WHERE file_id=?');
    $cnt->execute([$r['id']]);
    $mc=$cnt->fetchColumn();
?>
<tr data-id="<?php echo $r['id']; ?>">
  <td><?php echo $r['id']; ?></td>
  <td><?php echo htmlspecialchars($r['title']); ?></td>
  <td><?php echo htmlspecialchars($r['file_size']); ?></td>
  <td><?php echo $mc; ?></td>
  <td><?php echo htmlspecialchars($r['visibleontheme']); ?></td>
  <td><button class="edit btn btn-small" data-id="<?php echo $r['id']; ?>">Edit</button>
      <button class="delete btn btn-small" data-id="<?php echo $r['id']; ?>">Delete</button></td>
</tr>
<?php endforeach; ?>
</table>
<?php
$pages=ceil($total/$limit);
if($pages>1){
    echo '<p>Page: ';
    for($i=1;$i<=$pages;$i++){
        $ac=$i==$page?' style="font-weight:bold"':'';
        echo '<a href="?page='.$i.'"'.$ac.'>'.$i.'</a> ';
    }
    echo '</p>';
}
?>
<button id="addFile" class="btn btn-primary">Add Download</button>
<div id="modalOverlay" style="display:none;"></div>

<div id="fileModal" style="display:none;" aria-modal="true" role="dialog">
<form id="fileForm">
<input type="hidden" name="id" id="fileId">
<label class="half">File title <input type="text" name="title" id="fileTitle" required></label>
<label class="half">File size <input type="text" name="file_size" id="fileSize"></label>
<div class="full-width">
  <label>Description</label>
  <div id="descToolbar">
    <button type="button" data-cmd="bold"><b>B</b></button>
    <button type="button" data-cmd="italic"><i>I</i></button>
    <button type="button" data-cmd="underline"><u>U</u></button>
  </div>
  <div id="fileDesc" class="wysiwyg" contenteditable="true"></div>
  <input type="hidden" name="description" id="fileDescInput">
</div>
<div class="full-width">
  <label>Main download <input type="text" name="main_url" id="fileUrl"><input type="file" name="main_file"></label>
</div>
<div id="mirrorFields" class="full-width"><!-- mirrors --><button type="button" id="addMirror">+</button></div>
<div id="themeChecks" class="full-width">
<?php foreach($themes as $t): ?>
    <label class="theme-option"><input type="checkbox" name="visible[]" value="<?php echo htmlspecialchars($t); ?>"> <?php echo htmlspecialchars($t); ?></label>
<?php endforeach; ?>
</div>
<label class="full-width" style="margin-top:8px;"><input type="checkbox" name="usingbutton" id="usingButton"> Generate Steam Download Button (2004 theme only!) <input type="text" name="buttonText" id="buttonText" style="width:60%;" disabled></label>
<div class="full-width actions">
  <button type="submit" class="btn btn-primary">Save</button>
  <button type="button" id="cancelBtn" class="btn">Cancel</button>
</div>
<input type="hidden" name="ajax" value="1">
</form>
</div>
<script>
$(function(){
 function addMirror(host,url){
   var cnt=$('#mirrorFields .mirror-row').length;
   if(cnt>=10) return;
   var row=$('<div class="mirror-row"><input type="text" name="mirror_hosts[]" placeholder="Host '+(cnt+1)+'"> <input type="text" name="mirror_urls[]" placeholder="URL '+(cnt+1)+'"></div>');
   row.insertBefore('#addMirror');
   if(host) row.find('input[name="mirror_hosts[]"]').val(host);
   if(url) row.find('input[name="mirror_urls[]"]').val(url);
   if(cnt>=9) $('#addMirror').hide();
 }
 $('#addMirror').on('click',function(){ addMirror(); });
 function openModal(){ $('#modalOverlay').show(); $('#fileModal').show(); }
 function closeModal(){ $('#modalOverlay').hide(); $('#fileModal').hide(); }
 $('#modalOverlay').on('click',closeModal);
 $('#addFile').on('click',function(){
  $('#fileForm')[0].reset();
  $('#mirrorFields .mirror-row').remove();
  $('#addMirror').show();
  $('#fileId').val('');
  $('#themeChecks input[type=checkbox]').prop('checked',false);
  $('#usingButton').prop('checked',false);$('#buttonText').prop('disabled',true).val('');
  $('#fileDesc').empty();$('#fileDescInput').val('');
  openModal();
 });
 $('#filesTable').on('click','.edit',function(){
  var id=$(this).data('id');
 $.get('download_files.php',{ajax:1,id:id},function(d){
    $('#fileForm')[0].reset(); $('#mirrorFields .mirror-row').remove(); $('#addMirror').show();
    $('#fileId').val(d.id); $('#fileTitle').val(d.title); $('#fileDesc').html(d.description); $('#fileDescInput').val(d.description); $('#fileSize').val(d.file_size); $('#fileUrl').val(d.main_url);
    $('#themeChecks input[type=checkbox]').prop('checked',false);
    if(d.visibleontheme){
       d.visibleontheme.split(',').forEach(function(t){ $('#themeChecks input[value="'+t.trim()+'"]').prop('checked',true); });
    }
     if(d.usingbutton==1){ $('#usingButton').prop('checked',true); $('#buttonText').prop('disabled',false).val(d.buttonText); } else { $('#usingButton').prop('checked',false); $('#buttonText').prop('disabled',true).val(''); }
     if(d.mirrors){d.mirrors.forEach(function(m){addMirror(m.host,m.url);}); if($('#mirrorFields .mirror-row').length>=10) $('#addMirror').hide(); }
     openModal();
  },'json');
});
$('#filesTable').on('click','.delete',function(){ if(confirm('Delete?')){ $.post('download_files.php',{ajax:1,delete:$(this).data('id')},function(){location.reload();}); } });
$('#cancelBtn').on('click',closeModal);
$('#fileForm').on('submit',function(e){ e.preventDefault(); $('#fileDescInput').val($('#fileDesc').html()); var fd=new FormData(this); $.ajax({url:'download_files.php',method:'POST',data:fd,processData:false,contentType:false,success:function(){location.reload();}}); });
$('#usingButton').on('change',function(){ $('#buttonText').prop('disabled',!this.checked); });
$('#descToolbar button').on('click',function(){ document.execCommand($(this).data('cmd'),false,null); });
});
</script>
<style>
#modalOverlay{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:999;}
#fileModal{background:#fff;border:1px solid #333;padding:20px;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000;width:80%;max-width:900px;max-height:90vh;overflow-y:auto;}
#fileModal form{display:flex;flex-wrap:wrap;gap:10px;}
#fileModal label{display:block;margin-top:5px;}
#fileModal label.half{width:48%;}
#fileModal .full-width{width:100%;}
#fileModal .actions{margin-top:10px;}
.mirror-row{margin-bottom:4px;}
.mirror-row input[type=text]{margin-right:4px;}
#descToolbar button{margin-right:4px;}
.wysiwyg{border:1px solid #ccc;min-height:100px;padding:4px;}
.theme-option{margin-right:6px;}
</style>
<?php include 'admin_footer.php'; ?>
