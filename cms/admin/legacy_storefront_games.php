<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db=cms_get_db();

if(isset($_POST['toggle_hidden'])){
    $appid=(int)$_POST['appid'];
    $hidden=isset($_POST['hidden'])?1:0;
    $db->prepare('UPDATE `0405_storefront_games` SET isHidden=? WHERE appid=?')->execute([$hidden,$appid]);
    exit('ok');
}
if(isset($_GET['load'])){
    $appid=(int)$_GET['load'];
    $stmt=$db->prepare('SELECT * FROM `0405_storefront_games` WHERE appid=?');
    $stmt->execute([$appid]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit;
}
if(isset($_GET['ajax']) && $_GET['ajax']==='upload' && isset($_FILES['file'])){
    $appid=(int)($_POST['appid']??0);
    $type=$_POST['type']??'thumb';
    $dir=CMS_ROOT.'/storefront/images';
    if(!is_dir($dir)) mkdir($dir,0777,true);
    $ext=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    if($type==='screen'){$fname="gi2_{$appid}.{$ext}";}
    elseif($type==='title'){$fname="gn_{$appid}.{$ext}";}
    else{$fname="gi1_{$appid}.{$ext}";}
    $dest="$dir/$fname";
    move_uploaded_file($_FILES['file']['tmp_name'],$dest);
    echo '/storefront/images/'.$fname;
    exit;
}
if(isset($_POST['delete'])){
    $appid=(int)$_POST['delete'];
    $db->prepare('DELETE FROM `0405_storefront_games` WHERE appid=?')->execute([$appid]);
    header('Location: legacy_storefront_games.php');
    exit;
}
if(isset($_POST['save_game'])){
    $appid=(int)$_POST['appid'];
    $title_mode=$_POST['title_mode']??'text';
    $title=$title_mode==='image'?($_POST['title_image']??''):trim($_POST['title_text']??'');
    $desc=trim($_POST['description']);
    $purchase=$_POST['purchaseButtonStr'];
    if($purchase==='custom'){$purchase=trim($_POST['custom_purchase']);}
    $thumb=$_POST['current_thumb']??'';
    $screen=$_POST['current_screen']??'';
    if(isset($_POST['remove_screenshot'])) $screen='';
    $stmt=$db->prepare('REPLACE INTO `0405_storefront_games`(appid,title,description,image_thumb,image_screenshot,purchaseButtonStr,isHidden) VALUES(?,?,?,?,?,?,0)');
    $stmt->execute([$appid,$title,$desc,$thumb,$screen,$purchase]);
}
$games=$db->query('SELECT * FROM `0405_storefront_games` ORDER BY appid')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Legacy Storefront Game Management</h2>
<table class="data-table" id="games-table">
<thead><tr><th class="sortable">App ID</th><th class="sortable">Title</th><th>Image Preview</th><th>Hidden</th><th>Tasks</th></tr></thead>
<tbody>
<?php foreach($games as $g): ?>
<tr data-id="<?php echo $g['appid']; ?>">
 <td><?php echo $g['appid']; ?></td>
 <td>
<?php if(preg_match('~^/storefront/images/~',$g['title'])): ?>
    <img src="<?php echo htmlspecialchars($g['title']); ?>" width="32">
<?php else: ?>
    <?php echo htmlspecialchars($g['title']); ?>
<?php endif; ?>
 </td>
 <td><?php if($g['image_thumb']): ?><img src="<?php echo htmlspecialchars($g['image_thumb']); ?>" width="32" height="32"><?php endif; ?></td>
 <td><input type="checkbox" class="toggle-hidden" data-id="<?php echo $g['appid']; ?>" <?php if($g['isHidden']) echo 'checked';?>></td>
 <td>
  <button type="button" class="edit-btn btn btn-small" data-id="<?php echo $g['appid']; ?>">Edit</button>
  <form method="post" style="display:inline"><input type="hidden" name="delete" value="<?php echo $g['appid']; ?>"><button class="btn btn-danger btn-small">Delete</button></form>
 </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<hr>
<h3>Add or Edit Games</h3>
<form method="post" enctype="multipart/form-data" id="gameForm">
<input type="hidden" name="save_game" value="1">
<input type="hidden" name="current_thumb" id="current_thumb">
<input type="hidden" name="current_screen" id="current_screen">
<input type="hidden" name="title_image" id="title_image">
<label>Application ID <input type="number" name="appid" id="appid"></label><br>
<div>
 <label><input type="radio" name="title_mode" value="text" id="title_mode_text" checked> Text Only</label>
 <div id="textTitleWrap"><input type="text" name="title_text" id="title_text"></div>
 <label><input type="radio" name="title_mode" value="image" id="title_mode_image"> Title Image</label>
 <div id="imageTitleWrap"><span id="titleImgPrev">No Image selected</span> <button type="button" id="uploadTitleBtn">Upload</button><input type="file" id="titleFile" style="display:none"></div>
</div><br>
<label>Main Image <span id="thumbPrev"></span> <input type="file" name="main_image" id="main_image"></label><br>
<label>Screenshot <span id="screenPrev"></span> <input type="file" name="screenshot" id="screenshot">
<button type="submit" name="remove_screenshot" value="1" id="removeShot" disabled>Remove Screenshot</button></label><br>
<label>Description<br><textarea name="description" id="description" rows="5" cols="60"></textarea></label><br>
<div>Purchase Button text:<br>
<label><input type="radio" name="purchaseButtonStr" value="CLICK for PURCHASE OPTIONS" id="pb1"> CLICK for PURCHASE OPTIONS</label><br>
<label><input type="radio" name="purchaseButtonStr" value="DOWNLOAD & INSTALL NOW" id="pb2"> DOWNLOAD & INSTALL NOW</label><br>
<label><input type="radio" name="purchaseButtonStr" value="custom" id="pb3"> Custom <input type="text" name="custom_purchase" id="custom_purchase"></label>
</div>
<button type="submit" class="btn btn-primary">Save Game</button> <button type="reset" id="cancelBtn" class="btn">Cancel</button>
</form>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script>
function uploadFile(input,type){
  var fd=new FormData();
  fd.append('file',input.files[0]);
  fd.append('appid',$('#appid').val());
  fd.append('type',type);
  $.ajax({url:'legacy_storefront_games.php?ajax=upload',method:'POST',data:fd,processData:false,contentType:false,success:function(p){
    if(type==='thumb'){ $('#thumbPrev').html('<img src="'+p+'" width="32">'); $('#current_thumb').val(p); }
    else if(type==='screen'){ $('#screenPrev').html('<img src="'+p+'" width="32">'); $('#current_screen').val(p); $('#removeShot').prop('disabled',false); }
    else { $('#titleImgPrev').html('<img src="'+p+'" width="32">'); $('#title_image').val(p); $('#title_mode_image').prop('checked',true); }
  }});
}
$('.toggle-hidden').on('change',function(){var id=$(this).data('id');$.post('legacy_storefront_games.php',{toggle_hidden:1,appid:id,hidden:this.checked?1:0});});
$('.edit-btn').on('click',function(){var id=$(this).data('id');$.getJSON('legacy_storefront_games.php',{load:id},function(d){$('#appid').val(d.appid);if(d.title.match(/^\/storefront\/images\//)){ $('#title_mode_image').prop('checked',true); $('#title_image').val(d.title); $('#titleImgPrev').html('<img src="'+d.title+'" width="32">'); $('#title_text').val(''); }else{ $('#title_mode_text').prop('checked',true); $('#title_text').val(d.title); $('#title_image').val(''); $('#titleImgPrev').html('No Image selected'); }$('#current_thumb').val(d.image_thumb);$('#thumbPrev').html(d.image_thumb?'<img src="'+d.image_thumb+'" width="32">':'');$('#current_screen').val(d.image_screenshot);$('#screenPrev').html(d.image_screenshot?'<img src="'+d.image_screenshot+'" width="32">':'');$('#description').val(d.description);var pb=d.purchaseButtonStr;if(pb=="CLICK for PURCHASE OPTIONS"){$('#pb1').prop('checked',true);}else if(pb=="DOWNLOAD & INSTALL NOW"){$('#pb2').prop('checked',true);}else{$('#pb3').prop('checked',true);$('#custom_purchase').val(pb);}$('#removeShot').prop('disabled',!d.image_screenshot);});});
$('#pb1,#pb2').on('change',function(){if(this.checked)$('#custom_purchase').val('');});
$('#pb3').on('change',function(){if(this.checked)$('#custom_purchase').focus();});
$('#main_image').on('change',function(){uploadFile(this,'thumb');});
$('#screenshot').on('change',function(){uploadFile(this,'screen');});
$('#uploadTitleBtn').on('click',function(){$('#titleFile').click();});
$('#titleFile').on('change',function(){uploadFile(this,'title');});
</script>
<?php include 'admin_footer.php'; ?>
