<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']);

if (isset($_POST['delete_single'])) {
    $id = (int)$_POST['delete_single'];
    $db->prepare('DELETE FROM scheduled_content WHERE content_id=?')->execute([$id]);
    if ($isAjax) { header('Content-Type: application/json'); echo json_encode(['success'=>true]); exit; }
}

if (isset($_GET['get'])) {
    $stmt = $db->prepare('SELECT * FROM scheduled_content WHERE content_id=?');
    $stmt->execute([(int)$_GET['get']]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC) ?: []);
    exit;
}

$errors = [];
if (isset($_POST['save_item'])) {
    $type = $_POST['schedule_type'] ?? 'every_n_days';
    if (!in_array($type, ['every_n_days','day_of_month','fixed_range'], true)) {
        $errors[] = 'Invalid schedule type';
    } else {
        $id = (int)($_POST['content_id'] ?? 0);
        $params = [
            $_POST['theme_name'] ?? null,
            $_POST['description'] ?? '',
            $_POST['tag_name'] ?? '',
            $_POST['content'] ?? '',
            $type,
            $_POST['every_n_days'] ?: null,
            $_POST['day_of_month'] ?: null,
            $_POST['start_date'] ?: null,
            $_POST['end_date'] ?: null,
            $_POST['fixed_start_datetime'] ?: null,
            $_POST['fixed_end_datetime'] ?: null,
            isset($_POST['active']) ? 1 : 0,
        ];
        if ($id) {
            $params[] = $id;
            $db->prepare('UPDATE scheduled_content SET theme_name=?, description=?, tag_name=?, content=?, schedule_type=?, every_n_days=?, day_of_month=?, start_date=?, end_date=?, fixed_start_datetime=?, fixed_end_datetime=?, active=? WHERE content_id=?')->execute($params);
        } else {
            $db->prepare('INSERT INTO scheduled_content(theme_name,description,tag_name,content,schedule_type,every_n_days,day_of_month,start_date,end_date,fixed_start_datetime,fixed_end_datetime,active) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)')->execute($params);
            $id = $db->lastInsertId();
        }
        if ($isAjax) { header('Content-Type: application/json'); echo json_encode(['success'=>true,'id'=>$id]); exit; }
    }
    if ($isAjax && $errors) { header('Content-Type: application/json'); echo json_encode(['success'=>false,'error'=>implode(', ',$errors)]); exit; }
}

$rows = $db->query('SELECT * FROM scheduled_content ORDER BY content_id')->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if ($errors): ?>
<ul class="errors">
<?php foreach ($errors as $e): ?>
 <li><?php echo htmlspecialchars($e); ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<h2>Scheduled Content</h2>
<p class="page-description" style="color:#666;margin-bottom:15px;">Manage time/date-scheduled content blocks that automatically show or hide on the site based on a recurring or fixed date range.</p>
<p><button type="button" id="add-scheduled-btn" class="btn btn-primary">Add New Scheduled Content</button></p>
<table class="data-table" id="scheduled-table">
<tr><th>ID</th><th>Theme</th><th>Description</th><th>Tag</th><th>Type</th><th>Active</th><th>Actions</th></tr>
<tbody id="scheduled-body">
<?php foreach ($rows as $r): ?>
<tr data-id="<?php echo $r['content_id']; ?>">
  <td><?php echo $r['content_id']; ?></td>
  <td><?php echo htmlspecialchars($r['theme_name'] ?? ''); ?></td>
  <td><?php echo htmlspecialchars($r['description'] ?? ''); ?></td>
  <td><?php echo htmlspecialchars($r['tag_name'] ?? ''); ?></td>
  <td><?php echo htmlspecialchars($r['schedule_type'] ?? ''); ?></td>
  <td><?php echo $r['active'] ? 'Yes' : 'No'; ?></td>
  <td>
    <button type="button" class="btn btn-primary btn-small edit-btn" data-id="<?php echo $r['content_id']; ?>">Edit</button>
    <button type="button" class="btn btn-danger btn-small delete-btn" data-id="<?php echo $r['content_id']; ?>">Delete</button>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<div id="scheduledModalOverlay" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:1000;justify-content:center;align-items:center;">
  <div class="modal" role="dialog" aria-modal="true" style="background:white;border-radius:8px;padding:0;width:90%;max-width:600px;box-shadow:0 4px 12px rgba(0,0,0,0.3);">
    <form id="scheduledForm">
      <input type="hidden" name="content_id" id="sc-id">
      <div style="padding:20px;border-bottom:1px solid #ddd;">
        <h3 id="scheduledModalTitle" style="margin:0;">Add Scheduled Content</h3>
      </div>
      <div class="modal-body" style="padding:20px;max-height:600px;overflow-y:auto;">
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Theme:</label>
          <input type="text" name="theme_name" id="sc-theme" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Description:</label>
          <input type="text" name="description" id="sc-description" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Tag Name:</label>
          <input type="text" name="tag_name" id="sc-tag" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Content:</label>
          <textarea name="content" id="sc-content" rows="4" style="width:100%;padding:8px;"></textarea></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Schedule Type:</label>
          <select name="schedule_type" id="sc-type" style="width:100%;padding:8px;">
            <option value="every_n_days">every_n_days</option>
            <option value="day_of_month">day_of_month</option>
            <option value="fixed_range">fixed_range</option>
          </select></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Every N Days:</label>
          <input type="number" name="every_n_days" id="sc-every-n-days" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Day of Month:</label>
          <input type="number" name="day_of_month" id="sc-day-of-month" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Start Date:</label>
          <input type="date" name="start_date" id="sc-start-date" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">End Date:</label>
          <input type="date" name="end_date" id="sc-end-date" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Fixed Start:</label>
          <input type="datetime-local" name="fixed_start_datetime" id="sc-fixed-start" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Fixed End:</label>
          <input type="datetime-local" name="fixed_end_datetime" id="sc-fixed-end" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label><input type="checkbox" name="active" id="sc-active" value="1" checked> Active</label></div>
      </div>
      <div class="modal-footer" style="padding:15px 20px;border-top:1px solid #ddd;display:flex;justify-content:flex-end;gap:10px;">
        <button type="button" id="scheduledCancel" class="btn" style="padding:8px 16px;border:1px solid #ccc;border-radius:4px;background:#f5f5f5;cursor:pointer;">Cancel</button>
        <button type="submit" class="btn btn-primary" style="padding:8px 16px;border:none;border-radius:4px;background:#007bff;color:white;cursor:pointer;">Save</button>
      </div>
    </form>
  </div>
</div>
<script>
$(function(){
    var formHasChanges=false;
    function refreshList(){ location.reload(); }
    function fillForm(d){
        $('#sc-id').val(d && d.content_id ? d.content_id : '');
        $('#sc-theme').val(d ? (d.theme_name||'') : '');
        $('#sc-description').val(d ? (d.description||'') : '');
        $('#sc-tag').val(d ? (d.tag_name||'') : '');
        $('#sc-content').val(d ? (d.content||'') : '');
        $('#sc-type').val(d ? (d.schedule_type||'every_n_days') : 'every_n_days');
        $('#sc-every-n-days').val(d ? (d.every_n_days||'') : '');
        $('#sc-day-of-month').val(d ? (d.day_of_month||'') : '');
        $('#sc-start-date').val(d ? (d.start_date||'') : '');
        $('#sc-end-date').val(d ? (d.end_date||'') : '');
        $('#sc-fixed-start').val(d && d.fixed_start_datetime ? d.fixed_start_datetime.replace(' ','T').slice(0,16) : '');
        $('#sc-fixed-end').val(d && d.fixed_end_datetime ? d.fixed_end_datetime.replace(' ','T').slice(0,16) : '');
        $('#sc-active').prop('checked', d ? !!parseInt(d.active) : true);
    }
    function openModal(id){
        $('#scheduledForm')[0].reset();
        formHasChanges=false;
        if(id){
            $('#scheduledModalTitle').text('Edit Scheduled Content');
            $.get('scheduled_content.php',{get:id},function(d){
                fillForm(d);
                formHasChanges=false;
            },'json').fail(function(xhr){
                console.error('scheduled_content: load entry failed', xhr.status, xhr.responseText);
            });
        }else{
            $('#scheduledModalTitle').text('Add Scheduled Content');
            fillForm(null);
        }
        $('#scheduledModalOverlay').css('display','flex');
    }
    function closeModal(){
        if(formHasChanges && !confirm('You have unsaved changes. Are you sure you want to discard them?')){
            return;
        }
        $('#scheduledModalOverlay').hide();
        $('#scheduledForm')[0].reset();
        formHasChanges=false;
    }
    $('#scheduledForm input, #scheduledForm select, #scheduledForm textarea').on('change keyup',function(){ formHasChanges=true; });
    $('#scheduledModalOverlay').on('click',function(e){
        if(e.target.id === 'scheduledModalOverlay'){ closeModal(); }
    });
    $('#add-scheduled-btn').on('click',function(){ openModal(); });
    $('#scheduled-body').on('click','.edit-btn',function(){ openModal($(this).data('id')); });
    $('#scheduled-body').on('click','.delete-btn',function(){
        var id=$(this).data('id');
        if(confirm('Delete this scheduled content entry?')){
            $.post('scheduled_content.php',{delete_single:id},function(){
                refreshList();
            });
        }
    });
    $('#scheduledCancel').on('click',function(){ closeModal(); });
    $('#scheduledForm').on('submit',function(e){
        e.preventDefault();
        var data=$(this).serialize()+'&save_item=1';
        if(!$('#sc-active').is(':checked')){
            data=data.replace(/&active=1/,'');
        }
        $.post('scheduled_content.php',data,function(res){
            if(res.success){
                formHasChanges=false;
                $('#scheduledModalOverlay').hide();
                refreshList();
            }else{
                alert(res.error || 'Failed to save.');
            }
        },'json').fail(function(xhr){
            console.error('scheduled_content: save failed', xhr.status, xhr.responseText);
            alert('Failed to save entry.');
        });
    });
});
</script>
<?php include 'admin_footer.php'; ?>
