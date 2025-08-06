<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db=cms_get_db();

if(isset($_POST['toggle_hidden'])){
    $id=(int)$_POST['id'];
    $hidden=isset($_POST['hidden'])?1:0;
    $db->prepare('UPDATE `0405_storefront_thirdpartGames` SET isHidden=? WHERE id=?')->execute([$hidden,$id]);
    exit('ok');
}
if(isset($_GET['load'])){
    $id=(int)$_GET['load'];
    $stmt=$db->prepare('SELECT * FROM `0405_storefront_thirdpartGames` WHERE id=?');
    $stmt->execute([$id]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit;
}
if(isset($_GET['ajax']) && $_GET['ajax']==='upload' && isset($_FILES['file'])){
    $id=(int)($_POST['id']??0);
    $type=$_POST['type']??'thumb';
    $dir=CMS_ROOT.'/storefront/images';
    if(!is_dir($dir)) mkdir($dir,0777,true);
    $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    $uid = $id ?: uniqid();
    if($type==='screen'){$fname="t2_{$uid}.{$ext}";}else{$fname="t1_{$uid}.{$ext}";}
    $dest="$dir/$fname";
    move_uploaded_file($_FILES['file']['tmp_name'],$dest);
    echo '/storefront/images/'.$fname;
    exit;
}
if(isset($_POST['delete'])){
    $id=(int)$_POST['delete'];
    $db->prepare('DELETE FROM `0405_storefront_thirdpartGames` WHERE id=?')->execute([$id]);
    header('Location: legacy_storefront_thirdparty.php');
    exit;
}
if(isset($_POST['save_game'])){
    $record=(int)($_POST['record_id']??0);
    $title=trim($_POST['title']);
    $desc=trim($_POST['description']);
    $url=trim($_POST['websiteUrl']);
    $thumb=$_POST['current_thumb']??'';
    $screen=$_POST['current_screen']??'';
    if(!empty($_POST['remove_screenshot'])) $screen='';
    if($record){
        $stmt=$db->prepare('UPDATE `0405_storefront_thirdpartGames` SET title=?,description=?,image_thumb=?,image_screenshot=?,websiteUrl=? WHERE id=?');
        $stmt->execute([$title,$desc,$thumb,$screen,$url,$record]);
    }else{
        $stmt=$db->prepare('INSERT INTO `0405_storefront_thirdpartGames`(title,description,image_thumb,image_screenshot,websiteUrl,isHidden) VALUES(?,?,?,?,?,0)');
        $stmt->execute([$title,$desc,$thumb,$screen,$url]);
    }
}
$games=$db->query('SELECT * FROM `0405_storefront_thirdpartGames` ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Legacy Storefront Thirdparty Game Management</h2>
<table class="data-table" id="tp-table">
<thead><tr><th class="sortable">IndexID</th><th class="sortable">Title</th><th>Image Preview</th><th>Website URL</th><th>Hidden</th><th>Tasks</th></tr></thead>
<tbody>
<?php foreach($games as $g): ?>
<tr data-id="<?php echo $g['id']; ?>">
 <td><?php echo $g['id']; ?></td>
 <td>
<?php if(preg_match('~^/storefront/images/~',$g['title'])): ?>
    <img src="<?php echo htmlspecialchars($g['title']); ?>" width="32">
<?php else: ?>
    <?php echo htmlspecialchars($g['title']); ?>
<?php endif; ?>
 </td>
 <td><?php if($g['image_thumb']): ?><img src="<?php echo htmlspecialchars($g['image_thumb']); ?>" width="32" height="32"><?php endif; ?></td>
 <td><?php if($g['websiteUrl']): ?><a href="<?php echo htmlspecialchars($g['websiteUrl']); ?>" target="_blank">link</a><?php endif; ?></td>
 <td><input type="checkbox" class="toggle-hidden" data-id="<?php echo $g['id']; ?>" <?php if($g['isHidden']) echo 'checked';?>></td>
 <td>
  <button type="button" class="edit-btn btn btn-small" data-id="<?php echo $g['id']; ?>">Edit</button>
  <form method="post" style="display:inline"><input type="hidden" name="delete" value="<?php echo $g['id']; ?>"><button class="btn btn-danger btn-small">Delete</button></form>
 </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<hr>
<h3>Add or Edit Thirdparty Games</h3>
<form method="post" enctype="multipart/form-data" id="tpForm">
<input type="hidden" name="save_game" value="1">
<input type="hidden" name="record_id" id="record_id">
<input type="hidden" name="current_thumb" id="current_thumb">
<input type="hidden" name="current_screen" id="current_screen">
<input type="hidden" name="remove_screenshot" id="remove_screenshot" value="0">
<label>Game Name <input type="text" name="title" id="title"></label><br>
<label>Main Image <span id="thumbPrev"></span> <input type="file" name="main_image" id="main_image"></label><br>
<label>Screenshot <span id="screenPrev"></span> <input type="file" name="screenshot" id="screenshot">
<button type="button" id="removeShot" disabled>Remove Screenshot</button></label><br>
<label>Description<br><textarea name="description" id="description" rows="5" cols="60"></textarea></label><br>
<label>Thirdparty Website URL <input type="text" name="websiteUrl" id="websiteUrl"></label><br>
<button type="submit" class="btn btn-primary">Save Game</button> <button type="reset" id="cancelBtn" class="btn">Cancel</button>
</form>
<script>
$(function () {
    function uploadFileTP(input, type) {
        var fd = new FormData();
        fd.append('file', input.files[0]);
        fd.append('id', $('#record_id').val() || 0);
        fd.append('type', type);
        $.ajax({
            url: 'legacy_storefront_thirdparty.php?ajax=upload',
            method: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function (p) {
                if (type === 'thumb') {
                    $('#thumbPrev').html('<img src="' + p + '" width="32">');
                    $('#current_thumb').val(p);
                } else {
                    $('#screenPrev').html('<img src="' + p + '" width="32">');
                    $('#current_screen').val(p);
                    $('#removeShot').prop('disabled', false);
                }
            }
        });
    }

    $(document).on('change', '.toggle-hidden', function () {
        var id = $(this).data('id');
        $.post('legacy_storefront_thirdparty.php', {
            toggle_hidden: 1,
            id: id,
            hidden: this.checked ? 1 : 0
        });
    });

    $(document).on('click', '.edit-btn', function () {
        var id = $(this).data('id');
        $.getJSON('legacy_storefront_thirdparty.php', { load: id }, function (d) {
            $('#record_id').val(d.id);
            $('#title').val(d.title);
            $('#current_thumb').val(d.image_thumb);
            $('#thumbPrev').html(d.image_thumb ? '<img src="' + d.image_thumb + '" width="32">' : '');
            $('#current_screen').val(d.image_screenshot);
            $('#screenPrev').html(d.image_screenshot ? '<img src="' + d.image_screenshot + '" width="32">' : '');
            $('#description').val(d.description);
            $('#websiteUrl').val(d.websiteUrl);
            $('#removeShot').prop('disabled', !d.image_screenshot);
        });
    });

    $('#main_image').on('change', function () {
        uploadFileTP(this, 'thumb');
    });

    $('#screenshot').on('change', function () {
        uploadFileTP(this, 'screen');
    });

    $('#removeShot').on('click', function () {
        $('#screenPrev').empty();
        $('#current_screen').val('');
        $('#remove_screenshot').val('1');
        $(this).prop('disabled', true);
    });

    $('#tpForm').on('reset', function () {
        setTimeout(function () {
            $('#thumbPrev').empty();
            $('#screenPrev').empty();
            $('#current_thumb, #current_screen').val('');
            $('#removeShot').prop('disabled', true);
            $('#remove_screenshot').val('0');
        });
    });
});
</script>
<?php include 'admin_footer.php'; ?>
