<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');

$base_dir = dirname(__DIR__,2);
$base_url = cms_base_url();

// years to manage
$years = [
    '2003','2004','2005','2006','2007','2008','2009','2010','2011','2012','custom'
];

function list_imgs($dir){
    return glob($dir.'/*.{gif,jpg,png,GIF,JPG,PNG}', GLOB_BRACE) ?: [];
}

// gather banner lists for each year
$enabled_imgs = $disabled_imgs = [];
foreach($years as $y){
    $img_dir = "$base_dir/platform/banner/$y/img";
    $disabled_dir = "$img_dir/disabled";
    if(!is_dir($img_dir)) mkdir($img_dir,0777,true);
    if(!is_dir($disabled_dir)) mkdir($disabled_dir,0777,true);
    $enabled_imgs[$y] = list_imgs($img_dir);
    $disabled_imgs[$y] = list_imgs($disabled_dir);
}

$errors = [];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $year = $_POST['year'] ?? '';
    if(!in_array($year,$years,true)) $year = $years[0];

    $img_dir = "$base_dir/platform/banner/$year/img";
    $disabled_dir = "$img_dir/disabled";
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
            $errors[$year] = 'Banner must be 340x50 pixels.';
        }
    }
}

?>
<h2>ContentServer Banner Management</h2>
<style>
    .tab-links{list-style:none;margin:10px 0 0;padding:0;display:flex;}
    .tab-links li{margin-right:4px;}
    .tab-link{display:block;padding:8px 15px;background:#ccc;color:#000;text-decoration:none;border:1px solid #888;border-bottom:none;transform:skewX(-20deg);border-radius:4px 4px 0 0;}
    .tab-link span{display:block;transform:skewX(20deg);}
    .tab-link.active{background:#fff;}
    .tab-content{border:1px solid #888;padding:10px;background:#fff;display:contents;}
</style>

<ul class="tab-links">
<?php foreach($years as $i=>$y): ?>
    <li><a href="#" class="tab-link<?php echo $i===0?' active':''; ?>" data-tab="<?php echo htmlspecialchars($y); ?>"><span><?php echo htmlspecialchars($y); ?></span></a></li>
<?php endforeach; ?>
</ul>

<?php foreach($years as $i=>$y): ?>
<div id="tab-<?php echo htmlspecialchars($y); ?>" class="tab-content" style="<?php echo $i===0?'':'display:contents;'; ?>">
    <?php $err = $errors[$y] ?? null; ?>
    <?php if($err): ?>
    <div class="upload-error" style="color:red;"><?php echo htmlspecialchars($err); ?></div>
    <?php else: ?>
    <div class="upload-error" style="color:red;display:none;"></div>
    <?php endif; ?>
    <form class="uploadForm" method="post" enctype="multipart/form-data">
        <input type="hidden" name="year" value="<?php echo htmlspecialchars($y); ?>">
        <input type="file" name="banner" required>
        <button type="submit" name="upload" value="1">Upload</button>
    </form>
    <table border="1" cellpadding="2">
        <tr><th>Enabled</th><th>Image</th><th>Actions</th></tr>
        <?php foreach($enabled_imgs[$y] as $img): $n=basename($img); ?>
        <tr>
            <td>
                <form method="post">
                    <input type="hidden" name="year" value="<?php echo htmlspecialchars($y); ?>">
                    <input type="hidden" name="file" value="<?php echo htmlspecialchars($n); ?>">
                    <input type="hidden" name="status" value="disable">
                    <input type="checkbox" onchange="this.form.submit()" checked>
                    <input type="hidden" name="toggle" value="1">
                </form>
            </td>
            <td><img src="<?php echo htmlspecialchars($base_url.'/platform/banner/'.$y.'/img/'.$n); ?>" width="340" height="50" alt=""></td>
            <td>
                <form method="post" style="display:inline">
                    <input type="hidden" name="year" value="<?php echo htmlspecialchars($y); ?>">
                    <button name="delete" value="<?php echo htmlspecialchars($n); ?>" onclick="return confirm('Delete banner?');">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php foreach($disabled_imgs[$y] as $img): $n=basename($img); ?>
        <tr>
            <td>
                <form method="post">
                    <input type="hidden" name="year" value="<?php echo htmlspecialchars($y); ?>">
                    <input type="hidden" name="file" value="<?php echo htmlspecialchars($n); ?>">
                    <input type="hidden" name="status" value="enable">
                    <input type="checkbox" onchange="this.form.submit()">
                    <input type="hidden" name="toggle" value="1">
                </form>
            </td>
            <td><img src="<?php echo htmlspecialchars($base_url.'/platform/banner/'.$y.'/img/disabled/'.$n); ?>" width="340" height="50" alt=""></td>
            <td>
                <form method="post" style="display:inline">
                    <input type="hidden" name="year" value="<?php echo htmlspecialchars($y); ?>">
                    <button name="delete" value="<?php echo htmlspecialchars($n); ?>" onclick="return confirm('Delete banner?');">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php endforeach; ?>

<p><a href="index.php">Back</a></p>

<script>
document.addEventListener('DOMContentLoaded', function(){
    $('.tab-link').on('click', function(e){
        e.preventDefault();
        var tab = $(this).data('tab');
        $('.tab-content').hide();
        $('#tab-' + tab).show();
        $('.tab-link').removeClass('active');
        $(this).addClass('active');
    });

    $('.uploadForm').on('submit', function(e){
        var file = $(this).find('input[type=file]')[0].files[0];
        if(!file) return;
        e.preventDefault();
        var form = this;
        var err = $(this).prevAll('.upload-error').first();
        var img = new Image();
        img.onload = function(){
            if(this.width!=340 || this.height!=50){
                err.text('Image must be 340x50 pixels.').show();
            } else {
                form.submit();
            }
        };
        img.onerror = function(){ err.text('Invalid image.').show(); };
        img.src = URL.createObjectURL(file);
    });
});
</script>
<?php include 'admin_footer.php'; ?>
