<?php
ob_start();
require_once 'admin_header.php';
$admin_header = ob_get_clean();
cms_require_permission('manage_pages');
$db = cms_get_db();

if (isset($_GET['ajax']) && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $db->prepare('SELECT * FROM bug_reports WHERE id=?');
    $stmt->execute([$id]);
    $report = $stmt->fetch(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($report);
    exit;
}

if (isset($_POST['ajax'])) {
    if (isset($_POST['delete'])) {
        $id = (int) $_POST['delete'];
        $db->prepare('DELETE FROM bug_reports WHERE id=?')->execute([$id]);
        echo 'ok';
        exit;
    }
    $id = (int) ($_POST['id'] ?? 0);
    $stmt = $db->prepare('UPDATE bug_reports SET email_address=?, description=?, reproducible=?, repro_steps=?, os=?, connection_type=?, file_system=?, reporter_comments=?, updated=NOW() WHERE id=?');
    $stmt->execute([
        $_POST['email_address'] ?? '',
        $_POST['description'] ?? '',
        $_POST['repro'] ?? '',
        $_POST['repro_steps'] ?? '',
        $_POST['os'] ?? '',
        $_POST['connection_type'] ?? '',
        $_POST['file_system'] ?? '',
        $_POST['reporter_comments'] ?? '',
        $id,
    ]);
    echo 'ok';
    exit;
}

$reports = $db->query('SELECT id,email_address,os,connection_type,file_system,created FROM bug_reports ORDER BY created DESC')->fetchAll(PDO::FETCH_ASSOC);

echo $admin_header;
?>
<h2>Bug Reports</h2>
<table class="data-table" id="reportsTable">
<tr><th>ID</th><th>Email</th><th>OS</th><th>Connection</th><th>File System</th><th>Created</th><th>Actions</th></tr>
<?php foreach ($reports as $r): ?>
<tr data-id="<?php echo $r['id']; ?>">
  <td><?php echo $r['id']; ?></td>
  <td class="email"><?php echo htmlspecialchars($r['email_address']); ?></td>
  <td class="os"><?php echo htmlspecialchars($r['os']); ?></td>
  <td class="connection"><?php echo htmlspecialchars($r['connection_type']); ?></td>
  <td class="fs"><?php echo htmlspecialchars($r['file_system']); ?></td>
  <td><?php echo htmlspecialchars($r['created']); ?></td>
  <td><button class="edit btn btn-small" data-id="<?php echo $r['id']; ?>">View/Edit</button> <button class="delete btn btn-small" data-id="<?php echo $r['id']; ?>">Delete</button></td>
</tr>
<?php endforeach; ?>
</table>
<div id="bugModal" style="display:none;" aria-modal="true" role="dialog">
<form id="bugForm">
<input type="hidden" name="id" id="reportId">
<label>Email <input type="email" name="email_address" id="email"></label><br>
<label>Description<br><textarea name="description" id="description" rows="4" cols="40"></textarea></label><br>
<label>Reproducible <select name="repro" id="repro"><option>Yes</option><option>No</option></select></label><br>
<label>Repro Steps<br><textarea name="repro_steps" id="repro_steps" rows="4" cols="40"></textarea></label><br>
<label>OS <input type="text" name="os" id="os"></label><br>
<label>Connection <input type="text" name="connection_type" id="connection_type"></label><br>
<label>File System <input type="text" name="file_system" id="file_system"></label><br>
<label>Comments<br><textarea name="reporter_comments" id="reporter_comments" rows="4" cols="40"></textarea></label><br>
<button type="submit" class="btn btn-primary">Save</button>
<button type="button" id="bugCancel" class="btn">Cancel</button>
<input type="hidden" name="ajax" value="1">
</form>
</div>
<script>
$(function(){
  $('#reportsTable').on('click','.edit',function(){
    var id=$(this).data('id');
    $.get('bug_reports.php',{ajax:1,id:id},function(d){
      $('#reportId').val(d.id);
      $('#email').val(d.email_address);
      $('#description').val(d.description);
      $('#repro').val(d.reproducible);
      $('#repro_steps').val(d.repro_steps);
      $('#os').val(d.os);
      $('#connection_type').val(d.connection_type);
      $('#file_system').val(d.file_system);
      $('#reporter_comments').val(d.reporter_comments);
      $('#bugModal').show();
    },'json');
  });
  $('#bugCancel').on('click',function(){ $('#bugModal').hide(); });
  $('#bugForm').on('submit',function(e){
    e.preventDefault();
    $.post('bug_reports.php', $(this).serialize(), function(){
      var id=$('#reportId').val();
      var row=$('tr[data-id="'+id+'"]').first();
      row.find('.email').text($('#email').val());
      row.find('.os').text($('#os').val());
      row.find('.connection').text($('#connection_type').val());
      row.find('.fs').text($('#file_system').val());
      $('#bugModal').hide();
    });
  });
  $('#reportsTable').on('click','.delete',function(){
    if(confirm('Delete?')){
      var id=$(this).data('id');
      $.post('bug_reports.php',{ajax:1,delete:id},function(){
        $('tr[data-id="'+id+'"]').remove();
      });
    }
  });
});
</script>
<?php include 'admin_footer.php'; ?>
