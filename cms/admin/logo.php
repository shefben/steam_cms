<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');
$logo_file = __DIR__.'/../content/logo.png';
$default = '/img/steam_logo_onblack.gif';
$current = file_exists($logo_file) ? '/cms/content/logo.png' : $default;
$size = @getimagesize(file_exists($logo_file)?$logo_file:($_SERVER['DOCUMENT_ROOT'].$default));
$w = $size ? $size[0] : 152;
$h = $size ? $size[1] : 54;
$tmp = isset($_POST['tmp'])?$_POST['tmp']:'';
if(isset($_POST['crop']) && $tmp){
    $img = @imagecreatefromstring(file_get_contents($tmp));
    if($img){
        $x=(int)$_POST['x']; $y=(int)$_POST['y'];
        $cw=(int)$_POST['w']; $ch=(int)$_POST['h'];
        if($cw<=0||$ch<=0){ $cw=imagesx($img); $ch=imagesy($img); }
        $dst=imagecreatetruecolor($w,$h);
        imagealphablending($dst,true);imagesavealpha($dst,true);
        imagecopyresampled($dst,$img,0,0,$x,$y,$w,$h,$cw,$ch);
        imagepng($dst,$logo_file);
        imagedestroy($dst); imagedestroy($img); unlink($tmp);
        $current='/cms/content/logo.png';
        echo '<p>Logo updated.</p>';
    }else echo '<p>Invalid image.</p>';
    $tmp='';
}elseif(isset($_FILES['logo'])){
    if(is_uploaded_file($_FILES['logo']['tmp_name'])){
        $tmp = __DIR__.'/../content/tmp_logo.png';
        move_uploaded_file($_FILES['logo']['tmp_name'],$tmp);
    }
}
?>
<h2>Upload Logo</h2>
<p>Current Logo:</p>
<img src="<?php echo $current; ?>" alt="logo"><br><br>
<?php if($tmp): ?>
    <p>Crop to <?php echo $w.'x'.$h; ?> and submit.</p>
    <img src="<?php echo '/cms/content/tmp_logo.png'; ?>" id="cropimg" style="max-width:300px"><br>
    <form method="post">
    <input type="hidden" name="tmp" value="<?php echo htmlspecialchars($tmp); ?>">
    X:<input type="number" name="x" value="0"> Y:<input type="number" name="y" value="0"><br>
    W:<input type="number" name="w" value="<?php echo $w; ?>"> H:<input type="number" name="h" value="<?php echo $h; ?>"><br>
    <input type="submit" name="crop" value="Crop & Save">
    </form>
<?php else: ?>
    <form method="post" enctype="multipart/form-data">
    <input type="file" name="logo" accept="image/*">
    <input type="submit" value="Upload">
    </form>
<?php endif; ?>
<p><a href="header.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
