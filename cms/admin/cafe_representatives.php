<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/admin_auth.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']);
    if(isset($_POST['reorder']) && isset($_POST['order'])){
        $ids = array_map('intval', explode(',', $_POST['order']));
        foreach($ids as $i=>$id){
            $db->prepare('UPDATE cafe_representatives SET ord=? WHERE id=?')->execute([$i+1,$id]);
        }
        if($isAjax){ echo 'ok'; exit; }
    }
    if(isset($_POST['add'])){
        $stmt=$db->prepare('INSERT INTO cafe_representatives(url,website,email,rep_name,address,city_province,zip,country,phone,ord) VALUES(?,?,?,?,?,?,?,?,?,?)');
        $stmt->execute([$_POST['url'] ?? '',$_POST['website'] ?? '',$_POST['email'] ?? '',$_POST['rep_name'] ?? '',$_POST['address'] ?? '',$_POST['city_province'] ?? '',$_POST['zip'] ?? '',$_POST['country'] ?? '',$_POST['phone'] ?? '',$_POST['ord'] ?? 0]);
        if($isAjax){ header('Content-Type: application/json'); echo json_encode(['success'=>true,'id'=>$db->lastInsertId()]); exit; }
        header('Location: cafe_representatives.php'); exit;
    }
    if(isset($_POST['update'])){
        $stmt=$db->prepare('UPDATE cafe_representatives SET url=?,website=?,email=?,rep_name=?,address=?,city_province=?,zip=?,country=?,phone=? WHERE id=?');
        $stmt->execute([$_POST['url'] ?? '',$_POST['website'] ?? '',$_POST['email'] ?? '',$_POST['rep_name'] ?? '',$_POST['address'] ?? '',$_POST['city_province'] ?? '',$_POST['zip'] ?? '',$_POST['country'] ?? '',$_POST['phone'] ?? '',$_POST['id']]);
        if($isAjax){ header('Content-Type: application/json'); echo json_encode(['success'=>true]); exit; }
        header('Location: cafe_representatives.php'); exit;
    }
    if(isset($_POST['delete_single'])){
        $stmt=$db->prepare('DELETE FROM cafe_representatives WHERE id=?');
        $stmt->execute([$_POST['delete_single']]);
        if($isAjax){ header('Content-Type: application/json'); echo json_encode(['success'=>true]); exit; }
        header('Location: cafe_representatives.php'); exit;
    }
}
if(isset($_GET['get'])){
    $stmt=$db->prepare('SELECT * FROM cafe_representatives WHERE id=?');
    $stmt->execute([(int)$_GET['get']]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC) ?: []);
    exit;
}

require_once 'admin_header.php';

$entries=$db->query('SELECT * FROM cafe_representatives ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Cafe Representatives</h2>
<p class="page-description" style="color:#666;margin-bottom:15px;">Manage regional Steam Cafe sales representative contact listings.</p>
<p><button type="button" id="add-rep-btn" class="btn btn-primary">Add New Representative</button></p>
<table border="1" id="rep-table">
<tr><th></th><th>Website</th><th>URL</th><th>Email</th><th>Name</th><th>Address</th><th>City/Prov</th><th>Zip</th><th>Country</th><th>Phone</th><th>Actions</th></tr>
<tbody id="rep-body">
<?php foreach($entries as $e): ?>
<tr data-id="<?php echo $e['id']; ?>">
<td class="handle">&#9776;</td>
<td><?php echo htmlspecialchars($e['website'] ?? ''); ?></td>
<td><?php echo htmlspecialchars($e['url'] ?? ''); ?></td>
<td><?php echo htmlspecialchars($e['email'] ?? ''); ?></td>
<td><?php echo htmlspecialchars($e['rep_name'] ?? ''); ?></td>
<td><?php echo htmlspecialchars($e['address'] ?? ''); ?></td>
<td><?php echo htmlspecialchars($e['city_province'] ?? ''); ?></td>
<td><?php echo htmlspecialchars($e['zip'] ?? ''); ?></td>
<td><?php echo htmlspecialchars($e['country'] ?? ''); ?></td>
<td><?php echo htmlspecialchars($e['phone'] ?? ''); ?></td>
<td>
<button type="button" class="btn btn-primary btn-small edit-btn" data-id="<?php echo $e['id']; ?>">Edit</button>
<button type="button" class="btn btn-danger btn-small delete-btn" data-id="<?php echo $e['id']; ?>">Delete</button>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<div id="repModalOverlay" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:1000;justify-content:center;align-items:center;">
  <div class="modal" role="dialog" aria-modal="true" style="background:white;border-radius:8px;padding:0;width:90%;max-width:500px;box-shadow:0 4px 12px rgba(0,0,0,0.3);">
    <form id="repForm">
      <input type="hidden" name="id" id="rep-id">
      <div style="padding:20px;border-bottom:1px solid #ddd;">
        <h3 id="repModalTitle" style="margin:0;">Add Representative</h3>
      </div>
      <div class="modal-body" style="padding:20px;max-height:600px;overflow-y:auto;">
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Order:</label>
          <input type="number" name="ord" id="rep-ord" value="0" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Website:</label>
          <input type="text" name="website" id="rep-website" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">URL:</label>
          <input type="text" name="url" id="rep-url" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Email:</label>
          <input type="text" name="email" id="rep-email" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Name:</label>
          <input type="text" name="rep_name" id="rep-name" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Address:</label>
          <input type="text" name="address" id="rep-address" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">City/Prov:</label>
          <input type="text" name="city_province" id="rep-city-province" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Zip:</label>
          <input type="text" name="zip" id="rep-zip" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Country:</label>
          <input type="text" name="country" id="rep-country" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Phone:</label>
          <input type="text" name="phone" id="rep-phone" style="width:100%;padding:8px;"></div>
      </div>
      <div class="modal-footer" style="padding:15px 20px;border-top:1px solid #ddd;display:flex;justify-content:flex-end;gap:10px;">
        <button type="button" id="repCancel" class="btn" style="padding:8px 16px;border:1px solid #ccc;border-radius:4px;background:#f5f5f5;cursor:pointer;">Cancel</button>
        <button type="submit" class="btn btn-primary" style="padding:8px 16px;border:none;border-radius:4px;background:#007bff;color:white;cursor:pointer;">Save</button>
      </div>
    </form>
  </div>
</div>
<script>
$(function(){
    var body=document.getElementById('rep-body');
    var formHasChanges=false;
    function sendOrder(){
        var ids=[];
        body.querySelectorAll('tr').forEach(function(tr){ids.push(tr.dataset.id);});
        $.post('cafe_representatives.php',{reorder:1,order:ids.join(',')}).fail(function(xhr){
            console.error('cafe_representatives: reorder save failed', xhr.status, xhr.responseText);
        });
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});

    function refreshList(){
        location.reload();
    }

    function openModal(id){
        $('#repForm')[0].reset();
        $('#rep-id').val('');
        formHasChanges=false;
        if(id){
            $('#repModalTitle').text('Edit Representative');
            $.get('cafe_representatives.php',{get:id},function(d){
                $('#rep-id').val(d.id);
                $('#rep-ord').val(d.ord || 0);
                $('#rep-website').val(d.website || '');
                $('#rep-url').val(d.url || '');
                $('#rep-email').val(d.email || '');
                $('#rep-name').val(d.rep_name || '');
                $('#rep-address').val(d.address || '');
                $('#rep-city-province').val(d.city_province || '');
                $('#rep-zip').val(d.zip || '');
                $('#rep-country').val(d.country || '');
                $('#rep-phone').val(d.phone || '');
                formHasChanges=false;
            },'json').fail(function(xhr){
                console.error('cafe_representatives: load entry failed', xhr.status, xhr.responseText);
            });
        }else{
            $('#repModalTitle').text('Add Representative');
        }
        $('#repModalOverlay').css('display','flex');
    }
    function closeModal(){
        if(formHasChanges && !confirm('You have unsaved changes. Are you sure you want to discard them?')){
            return;
        }
        $('#repModalOverlay').hide();
        $('#repForm')[0].reset();
        formHasChanges=false;
    }
    $('#repForm input').on('change keyup',function(){ formHasChanges=true; });
    $('#repModalOverlay').on('click',function(e){
        if(e.target.id === 'repModalOverlay'){ closeModal(); }
    });
    $('#add-rep-btn').on('click',function(){ openModal(); });
    $('#rep-body').on('click','.edit-btn',function(){ openModal($(this).data('id')); });
    $('#rep-body').on('click','.delete-btn',function(){
        var id=$(this).data('id');
        if(confirm('Delete this representative?')){
            $.post('cafe_representatives.php',{delete_single:id},function(){
                refreshList();
            });
        }
    });
    $('#repCancel').on('click',function(){ closeModal(); });
    $('#repForm').on('submit',function(e){
        e.preventDefault();
        var id=$('#rep-id').val();
        var data=$(this).serialize();
        data += id ? '&update=1' : '&add=1';
        $.post('cafe_representatives.php',data,function(){
            formHasChanges=false;
            refreshList();
        }).fail(function(xhr){
            console.error('cafe_representatives: save failed', xhr.status, xhr.responseText);
            alert('Failed to save entry.');
        });
    });
});
</script>
<?php include 'admin_footer.php'; ?>
