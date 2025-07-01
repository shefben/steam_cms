<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');
$base_dir = dirname(__DIR__,2);
$img_dir = $base_dir.'/platform/banner/img';
$disabled_dir = $img_dir.'/disabled';
if(!is_dir($disabled_dir)) mkdir($disabled_dir,0777,true);
$base_url = cms_base_url();
function list_imgs($dir){
    return glob($dir.'/*.{gif,jpg,png,GIF,JPG,PNG}', GLOB_BRACE) ?: [];
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['toggle'])){
        $name = basename($_POST['file']);
        if($_POST['status']==='disable'){
            if(file_exists("$img_dir/$name")) rename("$img_dir/$name","$disabled_dir/$name");
        }else{
            if(file_exists("$disabled_dir/$name")) rename("$disabled_dir/$name","$img_dir/$name");
        }
        header('Location: contentserver_banners.php');
        exit;
    }
    if(isset($_POST['delete'])){
        $name = basename($_POST['delete']);
        if(file_exists("$img_dir/$name")) unlink("$img_dir/$name");
        if(file_exists("$disabled_dir/$name")) unlink("$disabled_dir/$name");
        header('Location: contentserver_banners.php');
        exit;
    }
    if(isset($_POST['upload']) && isset($_FILES['banner']) && is_uploaded_file($_FILES['banner']['tmp_name'])){
        $size = getimagesize($_FILES['banner']['tmp_name']);
        if($size && $size[0]==340 && $size[1]==50){
            $name = basename($_FILES['banner']['name']);
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $base = pathinfo($name, PATHINFO_FILENAME);
            $target = "$img_dir/$name";
            $i=1;
            while(file_exists($target)){
                $target = "$img_dir/{$base}_{$i}.{$ext}";
                $i++;
            }
            move_uploaded_file($_FILES['banner']['tmp_name'],$target);
            header('Location: contentserver_banners.php');
            exit;
        }else{
            $error = 'Banner must be 340x50 pixels.';
        }
    }
}
$enabled_imgs = list_imgs($img_dir);
$disabled_imgs = list_imgs($disabled_dir);
?>
<h2>ContentServer Banner Management</h2>
<?php if(isset($error)): ?>
<div id="upload-error" style="color:red;"><?php echo htmlspecialchars($error); ?></div>
<?php else: ?>
<div id="upload-error" style="color:red;display:none;"></div>
<?php endif; ?>
<form id="uploadForm" method="post" enctype="multipart/form-data">
<input type="file" name="banner" id="banner" required>
<button type="submit" name="upload" value="1">Upload</button>
</form>
<table border="1" cellpadding="2">
<tr><th>Enabled</th><th>Image</th><th>Actions</th></tr>
<?php foreach($enabled_imgs as $img): $n=basename($img); ?>
<tr>
<td>
<form method="post">
<input type="hidden" name="file" value="<?php echo htmlspecialchars($n); ?>">
<input type="hidden" name="status" value="disable">
<input type="checkbox" onchange="this.form.submit()" checked>
<input type="hidden" name="toggle" value="1">
</form>
</td>
<td><img src="<?php echo htmlspecialchars($base_url.'/platform/banner/img/'.$n); ?>" width="340" height="50" alt=""></td>
<td>
<form method="post" style="display:inline">
<button name="delete" value="<?php echo htmlspecialchars($n); ?>" onclick="return confirm('Delete banner?');">Delete</button>
</form>
</td>
</tr>
<?php endforeach; ?>
<?php foreach($disabled_imgs as $img): $n=basename($img); ?>
<tr>
<td>
<form method="post">
<input type="hidden" name="file" value="<?php echo htmlspecialchars($n); ?>">
<input type="hidden" name="status" value="enable">
<input type="checkbox" onchange="this.form.submit()">
<input type="hidden" name="toggle" value="1">
</form>
</td>
<td><img src="<?php echo htmlspecialchars($base_url.'/platform/banner/img/disabled/'.$n); ?>" width="340" height="50" alt=""></td>
<td>
<form method="post" style="display:inline">
<button name="delete" value="<?php echo htmlspecialchars($n); ?>" onclick="return confirm('Delete banner?');">Delete</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="index.php">Back</a></p>
<script>
$('#uploadForm').on('submit', function(e){
  var file = $('#banner')[0].files[0];
  if(!file) return;
  e.preventDefault();
  var img = new Image();
  img.onload = function(){
    if(this.width!=340 || this.height!=50){
      $('#upload-error').text('Image must be 340x50 pixels.').show();
    } else {
      $('#uploadForm')[0].submit();
    }
  };
  img.onerror = function(){ $('#upload-error').text('Invalid image.').show(); };
  img.src = URL.createObjectURL(file);
});
</script>
<?php include 'admin_footer.php'; ?>
