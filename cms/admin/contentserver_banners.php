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
    return glob($dir.'/*.{gif,jpg,jpeg,png,GIF,JPG,JPEG,PNG}', GLOB_BRACE) ?: [];
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
$is_ajax = (isset($_POST['ajax']) && $_POST['ajax'] === '1') || (isset($_GET['ajax']) && $_GET['ajax'] === '1');
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
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode(['ok' => true]);
        } else {
            header('Location: contentserver_banners.php?year=' . rawurlencode($year));
        }
        exit;
    }
    if(isset($_POST['delete'])){
        $name = basename($_POST['delete']);
        if(file_exists("$img_dir/$name")) unlink("$img_dir/$name");
        if(file_exists("$disabled_dir/$name")) unlink("$disabled_dir/$name");
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode(['ok' => true]);
        } else {
            header('Location: contentserver_banners.php?year=' . rawurlencode($year));
        }
        exit;
    }
    if(isset($_POST['upload']) && isset($_FILES['banner']) && is_uploaded_file($_FILES['banner']['tmp_name'])){
        $tmp  = $_FILES['banner']['tmp_name'];
        $name = basename($_FILES['banner']['name']);
        $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $base = pathinfo($name, PATHINFO_FILENAME);

        // Validate extension and dimensions/type
        $allowed_exts  = ['gif','jpg','jpeg','png'];
        $allowed_types = [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG];
        $size = @getimagesize($tmp);
        $type_ok = $size && in_array($size[2], $allowed_types, true);
        $ext_ok  = in_array($ext, $allowed_exts, true);

        if($size && $size[0]===340 && $size[1]===56 && $ext_ok && $type_ok){
            $target = "$img_dir/$base.$ext";
            $i=1;
            while(file_exists($target)){
                $target = "$img_dir/{$base}_{$i}.{$ext}";
                $i++;
            }
            if(move_uploaded_file($tmp, $target)){
                if ($is_ajax) {
                    header('Content-Type: application/json');
                    echo json_encode(['ok' => true]);
                } else {
                    header('Location: contentserver_banners.php?year=' . rawurlencode($year));
                }
                exit;
            } else {
                $errors[$year] = 'Failed to move uploaded file.';
                if ($is_ajax) {
                    header('Content-Type: application/json');
                    echo json_encode(['ok' => false, 'error' => $errors[$year]]);
                    exit;
                }
            }
        } else {
            $errors[$year] = 'Banner must be exactly 340x56 and a GIF/JPG/PNG (.gif, .jpg, .jpeg, .png).';
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode(['ok' => false, 'error' => $errors[$year]]);
                exit;
            }
        }
    }
}

// AJAX: return table HTML for a given year
if ($is_ajax && (($_POST['action'] ?? $_GET['action'] ?? '') === 'list')) {
    $year = $_POST['year'] ?? $_GET['year'] ?? $years[0];
    if (!in_array($year, $years, true)) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['ok' => false, 'error' => 'Invalid year']);
        exit;
    }
    $y = $year; // local alias for template fragment
    ob_start();
    ?>
    <table border="1" cellpadding="2">
        <tr><th>Enabled</th><th>Image</th><th>Actions</th></tr>
        <?php foreach($enabled_imgs[$y] as $img): $n=basename($img); ?>
        <tr>
            <td>
                <form method="post" class="form-inline">
                    <input type="hidden" name="year" value="<?php echo htmlspecialchars($y); ?>">
                    <input type="hidden" name="file" value="<?php echo htmlspecialchars($n); ?>">
                    <input type="hidden" name="status" value="disable">
                    <input type="checkbox" onchange="this.form.submit()" checked>
                    <input type="hidden" name="toggle" value="1">
                </form>
            </td>
            <td><img src="<?php echo htmlspecialchars($base_url.'/platform/banner/'.$y.'/img/'.$n); ?>" width="340" height="56" alt=""></td>
            <td>
                <form method="post" class="form-inline">
                    <input type="hidden" name="year" value="<?php echo htmlspecialchars($y); ?>">
                    <button name="delete" value="<?php echo htmlspecialchars($n); ?>" onclick="return confirm('Delete banner?');" class="btn-small">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php foreach($disabled_imgs[$y] as $img): $n=basename($img); ?>
        <tr>
            <td>
                <form method="post" class="form-inline">
                    <input type="hidden" name="year" value="<?php echo htmlspecialchars($y); ?>">
                    <input type="hidden" name="file" value="<?php echo htmlspecialchars($n); ?>">
                    <input type="hidden" name="status" value="enable">
                    <input type="checkbox" onchange="this.form.submit()">
                    <input type="hidden" name="toggle" value="1">
                </form>
            </td>
            <td><img src="<?php echo htmlspecialchars($base_url.'/platform/banner/'.$y.'/img/disabled/'.$n); ?>" width="340" height="56" alt=""></td>
            <td>
                <form method="post" class="form-inline">
                    <input type="hidden" name="year" value="<?php echo htmlspecialchars($y); ?>">
                    <button name="delete" value="<?php echo htmlspecialchars($n); ?>" onclick="return confirm('Delete banner?');" class="btn-small">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php
    $html = ob_get_clean();
    header('Content-Type: application/json');
    echo json_encode(['ok' => true, 'html' => $html]);
    exit;
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
<div id="tab-<?php echo htmlspecialchars($y); ?>" class="tab-content" style="<?php echo $i===0?'':'display:none;'; ?>">
    <?php $err = $errors[$y] ?? null; ?>
    <?php if($err): ?>
    <div class="upload-error" style="color:red;"><?php echo htmlspecialchars($err); ?></div>
    <?php else: ?>
    <div class="upload-error" style="color:red;display:none;"></div>
    <?php endif; ?>
    <form class="uploadForm" method="post" enctype="multipart/form-data">
        <input type="hidden" name="year" value="<?php echo htmlspecialchars($y); ?>">
        <input type="file" name="banner" accept="image/gif,image/jpeg,image/png" required>
        <button type="submit" name="upload" value="1">Upload</button>
    </form>
    <div class="upload-progress" style="display:none; margin:8px 0;">
        <div class="bar" style="height:10px;width:0;background:#3498db;border-radius:5px;"></div>
        <div class="label" style="font-size:12px;color:#555;margin-top:4px;">0%</div>
    </div>
    <div id="table-<?php echo htmlspecialchars($y); ?>">
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
            <td><img src="<?php echo htmlspecialchars($base_url.'/platform/banner/'.$y.'/img/'.$n); ?>" width="340" height="56" alt=""></td>
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
            <td><img src="<?php echo htmlspecialchars($base_url.'/platform/banner/'.$y.'/img/disabled/'.$n); ?>" width="340" height="56" alt=""></td>
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

    // Normal form submission handles uploading; no JS interception
});
</script>
<?php include 'admin_footer.php'; ?>
