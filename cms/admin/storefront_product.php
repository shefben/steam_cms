<?php
$isAjax = isset($_GET['ajax']) || isset($_POST['ajax']);
if(!$isAjax){
    require_once 'admin_header.php';
} else {
    // For AJAX requests, we still need to include the core dependencies
    // and handle admin session validation
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    require_once __DIR__ . '/../db.php';
    require_once __DIR__ . '/../template_engine.php';
    
    // Handle admin session validation for AJAX requests (copied from admin_header.php)
    if (!cms_current_admin()) {
        if (isset($_COOKIE['cms_admin_token'])) {
            $uid = cms_validate_admin_token($_COOKIE['cms_admin_token']);
            if ($uid) {
                session_regenerate_id(true);
                $_SESSION['admin_id'] = $uid;
            }
        }
        if (!cms_current_admin()) {
            if($isAjax){ echo '<div class="modal-content"><p>Session expired. Please refresh and log in again.</p></div>'; exit; }
            $ret = urlencode($_SERVER['REQUEST_URI']);
            header('Location: ../login.php?return=' . $ret);
            exit;
        }
    }
}
cms_require_permission('manage_store');
$db = cms_get_db();
$appid = (int)($_GET['id'] ?? 0);
$isNew = $appid === 0;
$imgDir = $isNew ? '' : cms_app_screenshot_fs_dir($appid);
$publicImg = $isNew ? '' : rtrim(cms_base_url(), '/') . '/storefront/images/apps/' . $appid . '/screenshots/';
$headerDir = $isNew ? '' : cms_app_header_fs_dir($appid);
$publicHeader = $isNew ? '' : rtrim(cms_base_url(), '/') . '/storefront/apps/' . $appid . '/headers/';
if(!$isNew){
    $stmt = $db->prepare('SELECT * FROM store_apps WHERE appid=?');
    $stmt->execute([$appid]);
    $app = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$app){
        if($isAjax){ echo '<div class="modal-content"><p>Unknown app.</p></div>'; exit; }
        echo '<p>Unknown app.</p>';
        include 'admin_footer.php';
        exit;
    }
    $screens = cms_get_app_screenshots($appid);
} else {
    $app = ['appid'=>'','name'=>'','price'=>'','developer'=>'','availability'=>'','description'=>'','metacritic'=>'','metacritic_url'=>'','trailer_url'=>'','hide_trailer'=>0,'sysreq_min'=>'','sysreq_rec'=>'','main_image'=>'','is_preload'=>0,'preload_start'=>'','preload_end'=>'','show_metascore'=>0];
    $screens = [];
}

if(isset($_GET['list']) && !$isNew){
    $dir = $_GET['list'] === 'headers' ? $headerDir : $imgDir;
    $files = [];
    if($dir && is_dir($dir)){
        foreach(glob($dir.'*') as $f){ $files[] = basename($f); }
    }
    header('Content-Type: application/json');
    echo json_encode($files);
    exit;
}

if(isset($_POST['delete_app'])){
    $id = (int)$_POST['delete_app'];
    $db->prepare('DELETE FROM store_apps WHERE appid=?')->execute([$id]);
    $db->prepare('DELETE FROM subscription_apps WHERE appid=?')->execute([$id]);
    $db->prepare('DELETE FROM developer_apps WHERE appid=?')->execute([$id]);
    $db->prepare('DELETE FROM app_categories WHERE appid=?')->execute([$id]);
    $db->prepare('DELETE FROM store_capsules WHERE appid=?')->execute([$id]);
    if($isAjax){ echo json_encode(['success'=>true]); exit; }
}

if(isset($_POST['add_screens']) && !$isNew){
    $files = array_map('basename', (array)$_POST['add_screens']);
    $max_ord = 0;
    foreach ($screens as $s) {
        if ($s['ord'] > $max_ord) {
            $max_ord = $s['ord'];
        }
    }
    $added = [];
    foreach ($files as $f) {
        if (!$f) {
            continue;
        }
        $max_ord++;
        cms_set_app_screenshot($appid, $f, false, $max_ord);
        $id = (int)$db->lastInsertId();
        $added[] = ['id' => $id, 'filename' => $f, 'url' => $publicImg . $f];
    }
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'screens' => $added]);
        exit;
    }
}
if(!$screens && !empty($app['images'])){
    $list = json_decode($app['images'], true) ?: [];
    $o = 1;
    foreach($list as $img){
        cms_set_app_screenshot($appid, $img, 0, $o++);
    }
    $screens = cms_get_app_screenshots($appid);
}

if(isset($_POST['save'])){
    $new_id = (int)$_POST['appid'];
    $imgDir = cms_app_screenshot_fs_dir($new_id);
    $publicImg = rtrim(cms_base_url(), '/') . '/storefront/images/apps/' . $new_id . '/screenshots/';
    $headerDir = cms_app_header_fs_dir($new_id);
    $publicHeader = rtrim(cms_base_url(), '/') . '/storefront/apps/' . $new_id . '/headers/';
    $name    = trim($_POST['name']);
    $price   = floatval($_POST['price']);
    $desc    = trim($_POST['description']);
    $dev_id  = (int)$_POST['developer'];
    $dev_name = $db->prepare('SELECT name FROM store_developers WHERE id=?');
    $dev_name->execute([$dev_id]);
    $dev_name = $dev_name->fetchColumn();
    $avail   = $_POST['availability'];
    $meta    = trim($_POST['metacritic']);
    $meta_url = trim($_POST['metacritic_url'] ?? '');
    $min_req = trim($_POST['sysreq_min']);
    $rec_req = trim($_POST['sysreq_rec']);
    $show_ms = isset($_POST['show_metascore']) ? 1 : 0;
    $trailer = trim($_POST['trailer_url']);
    $hide_trailer = isset($_POST['hide_trailer']) ? 1 : 0;
    $is_preload = isset($_POST['is_preload']) ? 1 : 0;
    $pre_start = $_POST['preload_start'] ?: null;
    $pre_end   = $_POST['preload_end'] ?: null;

    $main_image = $_POST['main_image_existing'] ?? ($app['main_image'] ?? '');
    if(!empty($_FILES['main_image']['tmp_name'])){
        if(!is_dir($headerDir)){
            mkdir($headerDir, 0755, true);
        }
        $fname = basename($_FILES['main_image']['name']);
        if(move_uploaded_file($_FILES['main_image']['tmp_name'], $headerDir.$fname)){
            $main_image = $fname;
        }
    }
    $uploaded = [];
    if(!empty($_FILES['screenshots']['name'][0])){
        if(!is_dir($imgDir)){
            mkdir($imgDir, 0755, true);
        }
        foreach($_FILES['screenshots']['tmp_name'] as $i=>$tmp){
            if(!$tmp) continue;
            $name = basename($_FILES['screenshots']['name'][$i]);
            if(move_uploaded_file($tmp, $imgDir.$name)){
                $uploaded[] = $name;
            }
        }
    }
    $max_ord = 0;
    foreach ($screens as $s) { if($s['ord']>$max_ord) $max_ord=$s['ord']; }
    if($uploaded){
        foreach($uploaded as $f){
            $max_ord++;
            cms_set_app_screenshot($appid,$f,false,$max_ord);
            $screens[]=['id'=>null,'filename'=>$f,'hidden'=>0,'ord'=>$max_ord];
        }
    }

    foreach($_POST['hide'] ?? [] as $id=>$val){
        $db->prepare('UPDATE store_screenshots SET hidden=? WHERE id=?')->execute([1,$id]);
    }
    foreach($screens as $s){
        if(empty($_POST['hide'][$s['id']??0])){
            $db->prepare('UPDATE store_screenshots SET hidden=0 WHERE id=?')->execute([$s['id']]);
        }
    }
    foreach($_POST['delete'] ?? [] as $id=>$val){
        $db->prepare('DELETE FROM store_screenshots WHERE id=?')->execute([$id]);
    }

    $images = array_column(cms_get_app_screenshots($appid), 'filename');

    $db->beginTransaction();
    if(!$isNew && $new_id && $new_id !== $appid){
        $db->prepare('UPDATE store_apps SET appid=? WHERE appid=?')->execute([$new_id,$appid]);
        $db->prepare('UPDATE subscription_apps SET appid=? WHERE appid=?')->execute([$new_id,$appid]);
        $db->prepare('UPDATE developer_apps SET appid=? WHERE appid=?')->execute([$new_id,$appid]);
        $db->prepare('UPDATE app_categories SET appid=? WHERE appid=?')->execute([$new_id,$appid]);
        $db->prepare('UPDATE store_capsules SET appid=? WHERE appid=?')->execute([$new_id,$appid]);
        $appid = $new_id;
    }
    if($isNew){
        $ins = $db->prepare('INSERT INTO store_apps(appid,name,price,description,developer,availability,show_metascore,metacritic,metacritic_url,sysreq_min,sysreq_rec,trailer_url,hide_trailer,is_preload,preload_start,preload_end,images,main_image) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $ins->execute([$new_id,$name,$price,$desc,$dev_name,$avail,$show_ms,$meta,$meta_url,$min_req,$rec_req,$trailer,$hide_trailer,$is_preload,$pre_start,$pre_end,json_encode($images),$main_image]);
        $appid = $new_id;
    } else {
        $upd = $db->prepare('UPDATE store_apps SET name=?,price=?,description=?,developer=?,availability=?,show_metascore=?,metacritic=?,metacritic_url=?,sysreq_min=?,sysreq_rec=?,trailer_url=?,hide_trailer=?,is_preload=?,preload_start=?,preload_end=?,images=?,main_image=? WHERE appid=?');
        $upd->execute([$name,$price,$desc,$dev_name,$avail,$show_ms,$meta,$meta_url,$min_req,$rec_req,$trailer,$hide_trailer,$is_preload,$pre_start,$pre_end,json_encode($images),$main_image,$appid]);
    }
    $db->prepare('DELETE FROM subscription_apps WHERE appid=?')->execute([$appid]);
    foreach($_POST['packages'] ?? [] as $sub){
        $db->prepare('INSERT INTO subscription_apps(subid,appid) VALUES(?,?)')->execute([(int)$sub,$appid]);
    }
    $db->prepare('DELETE FROM app_categories WHERE appid=?')->execute([$appid]);
    foreach($_POST['categories'] ?? [] as $cat){
        $db->prepare('INSERT INTO app_categories(appid,category_id) VALUES(?,?)')->execute([$appid,(int)$cat]);
    }
    $db->commit();
    if($isAjax){
        echo json_encode(['success'=>true]);
    }else{
        header('Location: storefront_products.php');
    }
    exit;
}
 $developers = $db->query('SELECT id,name FROM store_developers ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
 $dev_id = $db->prepare('SELECT id FROM store_developers WHERE name=?');
 $dev_id->execute([$app['developer']]);
 $cur_dev = $dev_id->fetchColumn();
 $images = array_column($screens, 'filename');
 $packages = $db->query('SELECT subid,name FROM subscriptions ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
 $cur_packs = $db->prepare('SELECT subid FROM subscription_apps WHERE appid=?');
 $cur_packs->execute([$appid]);
 $cur_packs = $cur_packs->fetchAll(PDO::FETCH_COLUMN);
 $categories = $db->query('SELECT id,name FROM store_categories WHERE visible=1 ORDER BY ord')->fetchAll(PDO::FETCH_ASSOC);
 $cur_cats = $db->prepare('SELECT category_id FROM app_categories WHERE appid=?');
 $cur_cats->execute([$appid]);
 $cur_cats = $cur_cats->fetchAll(PDO::FETCH_COLUMN);

ob_start();
?>
<h2><?php echo $isNew ? 'Add Product' : 'Edit Product'; ?></h2>
<form id="product-form" method="post" enctype="multipart/form-data">
<label>App ID <input type="text" name="appid" value="<?php echo $app['appid']?>"></label><br>
<label>Name <input type="text" name="name" value="<?php echo htmlspecialchars($app['name'])?>"></label><br>
<label>Price <input type="text" name="price" value="<?php echo $app['price']?>"></label><br>
<label>Developer <select name="developer">
<?php foreach($developers as $d): ?>
<option value="<?php echo $d['id']?>" <?php if($d['id']==$cur_dev) echo 'selected';?>><?php echo htmlspecialchars($d['name'])?></option>
<?php endforeach; ?>
</select></label><br>
<label>Availability <select name="availability">
<?php foreach(['Available','n/a','Comming Soon','New release'] as $opt): ?>
<option value="<?php echo $opt?>" <?php if($opt==$app['availability']) echo 'selected';?>><?php echo $opt?></option>
<?php endforeach; ?>
</select></label><br>
<label>Description<br><textarea name="description" rows="5" cols="60"><?php echo htmlspecialchars($app['description'])?></textarea></label>
<br><label>Metascore <input type="text" name="metacritic" value="<?php echo htmlspecialchars($app['metacritic'])?>"></label>
<br><label>Metascore URL <input type='text' name='metacritic_url' value='<?php echo htmlspecialchars($app['metacritic_url'] ?? '')?>'></label>
<br><label>Trailer URL <input type='text' name='trailer_url' value='<?php echo htmlspecialchars($app['trailer_url'] ?? '')?>'></label>
<br><label><input type="checkbox" name="hide_trailer" value="1" <?php if(!empty($app['hide_trailer'])) echo 'checked'; ?>> Hide trailer link</label>
<br><label>Upload Trailer <input type="file" name="trailer_file"></label>
<br><label>Minimum Requirements<br><textarea name="sysreq_min" rows="3" cols="60"><?php echo htmlspecialchars($app['sysreq_min'])?></textarea></label>
<br><label>Recommended Requirements<br><textarea name="sysreq_rec" rows="3" cols="60"><?php echo htmlspecialchars($app['sysreq_rec'])?></textarea></label>
<div>
 <button type="button" id="mainImageBtn" class="btn btn-secondary">Select Main Image</button>
 <input type="hidden" name="main_image_existing" id="main_image_existing" value="<?php echo htmlspecialchars($app['main_image']); ?>">
 <?php if($app['main_image']): ?>
  <div id="main-image-preview"><img src="<?php echo $publicHeader . $app['main_image']; ?>" width="100"></div>
 <?php else: ?>
  <div id="main-image-preview"></div>
 <?php endif; ?>
</div>
<div>
 <input type="file" id="screenshotsUpload" name="screenshots[]" multiple style="display:none">
 <button type="button" id="screenshotsBtn" class="btn btn-secondary">Add Screenshot</button>
</div>
<div class="screenshot-list">
<?php foreach($screens as $sc): ?>
 <div class="shot-item">
  <img src="<?php echo $publicImg . $sc['filename']; ?>" width="100" alt="screenshot">
  <div><?php echo htmlspecialchars($sc['filename']); ?></div>
  <label>Hide <input type="checkbox" name="hide[<?php echo $sc['id']; ?>]" value="1" <?php echo $sc['hidden']?'checked':''; ?>></label>
  <label>Delete <input type="checkbox" name="delete[<?php echo $sc['id']; ?>]" value="1"></label>
 </div>
<?php endforeach; ?>
</div>
<br><label><input type="checkbox" name="is_preload" value="1" <?php if($app['is_preload']) echo 'checked'; ?>> Is preload</label>
<br>Preload Start <input type="date" name="preload_start" value="<?php echo htmlspecialchars($app['preload_start']); ?>">
<br>Preload End <input type="date" name="preload_end" value="<?php echo htmlspecialchars($app['preload_end']); ?>">
<br><label>Packages<br><select name="packages[]" multiple size="5">
<?php foreach($packages as $p): $sel=in_array($p['subid'],$cur_packs)?'selected':''; ?>
<option value="<?php echo $p['subid']; ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($p['name']); ?></option>
<?php endforeach; ?>
</select></label>
<br><strong>Categories:</strong><br>
<?php foreach($categories as $c): $checked=in_array($c['id'],$cur_cats)?'checked':''; ?>
<label><input type="checkbox" name="categories[]" value="<?php echo $c['id']; ?>" <?php echo $checked; ?>> <?php echo htmlspecialchars($c['name']); ?></label><br>
<?php endforeach; ?>
<br><label><input type="checkbox" name="show_metascore" value="1" <?php if($app['show_metascore']) echo 'checked';?>> Show Metascore</label>
<div>
</div>
<button type="submit" name="save" class="btn btn-primary">Save</button>
<button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
</form>
<div id="image-upload-modal" class="modal" style="display:none">
  <div class="modal-content">
    <button type="button" id="upload-new" class="btn btn-secondary">Upload Image</button>
    <button type="button" id="choose-existing" class="btn btn-secondary">Choose Existing Image</button>
    <input type="file" id="hidden-upload" name="main_image" style="display:none">
  </div>
</div>
<div id="existing-images-modal" class="modal" style="display:none">
  <div class="modal-content">
    <select id="existing-image-select" class="image-picker show-html"></select>
    <button type="button" id="existing-image-save" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
  </div>
</div>
<div id="screenshot-upload-modal" class="modal" style="display:none">
  <div class="modal-content">
    <button type="button" id="upload-screenshot-new" class="btn btn-secondary">Upload Image</button>
    <button type="button" id="choose-screenshot-existing" class="btn btn-secondary">Choose Existing Image</button>
  </div>
</div>
<div id="existing-screens-modal" class="modal" style="display:none">
  <div class="modal-content">
    <select id="existing-screens-select" multiple class="image-picker show-html"></select>
    <button type="button" id="existing-screens-save" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
  </div>
</div>
<link rel="stylesheet" href="css/image-picker.css">
<script src="js/image-picker.min.js"></script>
<script>
function initImagePicker(){
  $('#mainImageBtn').on('click',function(){ $('#image-upload-modal').show(); });
  $('#upload-new').on('click',function(){ $('#hidden-upload').click(); });
  $('#hidden-upload').on('change',function(){
    $('#image-upload-modal').hide();
    if(this.files && this.files[0]){
      var reader=new FileReader();
      reader.onload=function(e){ $('#main-image-preview').html('<img src="'+e.target.result+'" width="100">'); };
      reader.readAsDataURL(this.files[0]);
    }
  });
  $('#choose-existing').on('click',function(){
    $.get('storefront_product.php',{ajax:1,list:'headers',id:<?php echo $appid; ?>},function(files){
      var sel=$('#existing-image-select').empty();
      $.each(files,function(i,f){ sel.append('<option data-img-src="<?php echo $publicHeader; ?>'+f+'" value="'+f+'">'+f+'</option>'); });
      sel.imagepicker();
      $('#existing-images-modal').show();
    },'json');
  });
  $('#existing-image-save').on('click',function(){
    var val=$('#existing-image-select').val();
    if(val){
      $('#main_image_existing').val(val);
      $('#main-image-preview').html('<img src="<?php echo $publicHeader; ?>'+val+'" width="100">');
    }
    $('#existing-images-modal').hide();
    $('#image-upload-modal').hide();
  });
  $('#screenshotsBtn').on('click',function(){ $('#screenshot-upload-modal').show(); });
  $('#upload-screenshot-new').on('click',function(){ $('#screenshotsUpload').click(); });
  $('#screenshotsUpload').on('change',function(){ $('#screenshot-upload-modal').hide(); });
  $('#choose-screenshot-existing').on('click',function(){
    $.get('storefront_product.php',{ajax:1,list:'screenshots',id:<?php echo $appid; ?>},function(files){
      var sel=$('#existing-screens-select').empty();
      $.each(files,function(i,f){ sel.append('<option data-img-src="<?php echo $publicImg; ?>'+f+'" value="'+f+'">'+f+'</option>'); });
      sel.imagepicker();
      $('#existing-screens-modal').show();
    },'json');
  });
  $('#existing-screens-save').on('click',function(){
    var vals=$('#existing-screens-select').val() || [];
    if(vals.length){
      $.post('storefront_product.php',{ajax:1,id:<?php echo $appid; ?>,add_screens:vals},function(res){
        if(res.success){
          $.each(res.screens,function(i,s){
            var item=$('<div class="shot-item"><img src="'+s.url+'" width="100" alt="screenshot"><div>'+s.filename+'</div><label>Hide <input type="checkbox" name="hide['+s.id+']" value="1"></label><label>Delete <input type="checkbox" name="delete['+s.id+']" value="1"></label></div>');
            $('.screenshot-list').append(item);
          });
        }
      },'json');
    }
    $('#existing-screens-modal').hide();
    $('#screenshot-upload-modal').hide();
  });
  $(document).on('click','.modal .cancel-btn',function(e){ e.stopPropagation(); $(this).closest('.modal').hide(); });
}
$(function(){ initImagePicker(); });
</script>
<?php
$form = ob_get_clean();
if($isAjax){
    echo '<div class="modal-content">'.$form.'</div>';
    exit;
}
echo $form;
include 'admin_footer.php';
