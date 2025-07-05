<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db=cms_get_db();

if(isset($_POST['update'])){
    $pos=$_POST['position'];
    $img=trim($_POST['image']);
    $appid=(int)$_POST['appid'];
    $stmt=$db->prepare('REPLACE INTO store_capsules(position,image,appid) VALUES(?,?,?)');
    $stmt->execute([$pos,$img,$appid]);
    exit('OK');
}

if (isset($_POST['save_caps'])) {
    foreach (['top','middle','bottom_left','bottom_right'] as $pos) {
        $appid = (int)($_POST['appid'][$pos] ?? 0);
        $img = $db->prepare('SELECT image FROM store_capsules WHERE position=?');
        $img->execute([$pos]);
        $path = $img->fetchColumn() ?: '';
        $stmt = $db->prepare('REPLACE INTO store_capsules(position,image,appid) VALUES(?,?,?)');
        $stmt->execute([$pos,$path,$appid]);
    }
    $rows = $db->query('SELECT * FROM store_capsules')->fetchAll(PDO::FETCH_ASSOC);
    $caps = [];
    foreach ($rows as $r) {
        $caps[$r['position']] = $r;
    }
}


$rows = $db->query('SELECT * FROM store_capsules')->fetchAll(PDO::FETCH_ASSOC);
$caps = [];
foreach ($rows as $r) {
    $caps[$r['position']] = $r;
}
$apps = $db->query('SELECT appid,name FROM store_apps ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);

$img_base = dirname(__DIR__, 2) . '/storefront/images/capsules';
$images = ['top'=>[], 'middle'=>[], 'bottom_left'=>[], 'bottom_right'=>[]];
foreach (array_keys($images) as $pos) {
    $dir = $img_base . '/' . $pos;
    if (!is_dir($dir)) continue;
    foreach (glob($dir.'/*.png') as $file) {
        $base = basename($file, '.png');
        if (preg_match('/(\d{2})_\d{2}_(\d{4})/', $base, $m)) {
            $label = $m[2] . '-' . $m[1];
        } else {
            $label = $base;
        }
        $images[$pos][] = ['file' => $pos.'/'.basename($file), 'label' => $label];
    }
}
?>
<h2>Main Page</h2>
<form method="post" style="margin-bottom:15px;">
  <fieldset class="capsule-box-group">
    <legend>Capsule Links</legend>
    <?php foreach(['top'=>'Top','middle'=>'Middle','bottom_left'=>'Bottom Left','bottom_right'=>'Bottom Right'] as $p=>$label):
      $app = $caps[$p]['appid'] ?? 0;
      $img = $caps[$p]['image'] ?? '';
    ?>
    <div class="capsule-box">
      <img id="preview_<?php echo $p; ?>" src="../storefront/images/capsules/<?php echo htmlspecialchars($img); ?>" alt="<?php echo $label; ?> preview" class="capsule-preview">
      <button type="button" class="btn change-btn" data-pos="<?php echo $p; ?>">Change Capsule</button>
      <div>
        <input type="text" class="filter" data-select="sel_<?php echo $p; ?>" placeholder="Filter apps"><br>
        <select id="sel_<?php echo $p; ?>" name="appid[<?php echo $p; ?>]" size="5" class="capsule-select">
          <?php foreach($apps as $a): ?>
          <?php $imgs = json_decode($a['images'] ?? '[]', true); $imgp = $imgs ? $imgs[0] : ''; ?>
          <option value="<?php echo $a['appid']; ?>" data-img="<?php echo htmlspecialchars($imgp); ?>" <?php if($app==$a['appid']) echo 'selected'; ?>><?php echo $a['appid'].' - '.htmlspecialchars($a['name']); ?></option>
          <?php endforeach; ?>
        </select>
        <img id="img_sel_<?php echo $p; ?>" style="display:none;position:absolute;z-index:1000" alt="preview">
      </div>
    </div>
    <?php endforeach; ?>
    <button type="submit" name="save_caps" class="btn btn-primary" style="margin-top:10px;">Save Capsules</button>
  </fieldset>
</form>
<div id="caps" style="position:relative;width:590px;height:511px;">
  <?php foreach([
        'top' => 'left:1px;top:1px;width:588px;height:98px',
        'middle' => 'left:0;top:112px;width:589px;height:228px',
        'bottom_left' => 'left:0;top:352px;width:288px;height:158px',
        'bottom_right' => 'left:301px;top:352px;width:289px;height:158px'
      ] as $p=>$style):
        $img=$caps[$p]['image']??'';
        $appid=$caps[$p]['appid']??0;
  ?>
  <img src="../storefront/images/capsules/<?php echo htmlspecialchars($img); ?>" data-pos="<?php echo $p?>" data-app="<?php echo $appid?>" style="position:absolute;<?php echo $style; ?>;border:0;cursor:pointer;" alt="<?php echo ucfirst(str_replace('_',' ', $p)); ?> capsule" aria-label="<?php echo ucfirst(str_replace('_',' ', $p)); ?> capsule preview">
  <?php endforeach; ?>
</div>
  <div id="capsuleModal" class="capsule-modal" aria-label="Change capsule">
    <div class="dialog">
      <div id="capChoose">
        <button type="button" id="btnSelectExisting" class="btn btn-secondary">Choose Existing Image</button>
        <button type="button" id="btnUploadNew" class="btn btn-secondary">Upload New Image</button>
      </div>
      <div id="capExisting" style="display:none;">
        <div id="existingList" class="image-list"></div>
        <label>App
          <select id="existingAppid"></select>
        </label>
        <div class="modal-actions">
          <button type="button" id="existingAccept" class="btn btn-primary">Accept</button>
          <button type="button" class="btn btn-secondary cancel">Cancel</button>
        </div>
      </div>
      <div id="capUpload" style="display:none;">
        <label>Month <input type="text" id="upMonth" size="2"></label>
        <label>Day <input type="text" id="upDay" size="2"></label>
        <label>Year <input type="text" id="upYear" size="4"></label><br>
        <label>App <select id="uploadAppid"></select></label><br>
        <input type="file" id="uploadFile"><br>
        <div class="modal-actions">
          <button type="button" id="uploadAccept" class="btn btn-primary">OK</button>
          <button type="button" class="btn btn-secondary cancel">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <style>
  #capsuleModal {display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);align-items:center;justify-content:center;}
  #capsuleModal .dialog{background:#fff;padding:20px;border:1px solid #333;max-width:600px;}
  #capsuleModal .image-list{display:flex;flex-wrap:wrap;margin-bottom:10px;}
  #capsuleModal .img-choice{width:96px;border:1px solid #555;margin:4px;cursor:pointer;}
  #capsuleModal .img-choice.selected{outline:2px solid #007bff;}
  </style>
  <script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
  <script>
  var images = <?php echo json_encode($images);?>;
  var apps = <?php echo json_encode($apps);?>;

  function populateAppLists() {
    var opts='';
    $.each(apps,function(i,a){ opts+='<option value="'+a.appid+'">'+a.appid+' - '+$('<div>').text(a.name).html()+'</option>';});
    $('#existingAppid,#uploadAppid').html(opts);
  }
  populateAppLists();

  $('.change-btn').on('click',function(){
    var pos=$(this).data('pos');
    $('#capsuleModal').data('pos',pos).show();
    $('#capChoose').show();
    $('#capExisting,#capUpload').hide();
  });

  $('#btnSelectExisting').on('click',function(){
    var pos=$('#capsuleModal').data('pos');
    var html='';
    $.each(images[pos]||[],function(i,img){
       html+='<img src="../storefront/images/capsules/'+img.file+'" class="img-choice" data-file="'+img.file+'" alt="thumbnail">';
    });
    $('#existingList').html(html);
    $('#existingAppid').val('');
    $('#capChoose').hide();
    $('#capExisting').show();
  });

  $('#existingList').on('click','.img-choice',function(){
    $('#existingList .img-choice').removeClass('selected');
    $(this).addClass('selected');
    $('#capExisting').data('file',$(this).data('file'));
  });

  $('#existingAccept').on('click',function(){
    var pos=$('#capsuleModal').data('pos');
    var file=$('#capExisting').data('file');
    var appid=$('#existingAppid').val();
    if(!file||!appid){ alert('Select image and app'); return; }
    $.post('storefront_main.php',{update:1,position:pos,image:file,appid:appid},function(){
       $('#preview_'+pos).attr('src','../storefront/images/capsules/'+file);
       $('#sel_'+pos).val(appid);
       $('img[data-pos='+pos+']').attr('src','../storefront/images/capsules/'+file).data('app',appid);
       $('#capsuleModal').hide();
    });
  });

  $('#btnUploadNew').on('click',function(){
    $('#uploadFile').val('');
    $('#upMonth,#upDay,#upYear').val('');
    $('#uploadAppid').val('');
    $('#capChoose').hide();
    $('#capUpload').show();
  });

  $('#uploadAccept').on('click',function(){
    var pos=$('#capsuleModal').data('pos');
    var m=$('#upMonth').val(), d=$('#upDay').val(), y=$('#upYear').val();
    var appid=$('#uploadAppid').val();
    var file=$('#uploadFile')[0].files[0];
    if(!m||!d||!y||!appid||!file){ alert('All fields required'); return; }
    var fd=new FormData();
    fd.append('position',pos);
    fd.append('month',m);
    fd.append('day',d);
    fd.append('year',y);
    fd.append('appid',appid);
    fd.append('file',file);
    $.ajax({url:'upload_capsule.php',type:'POST',data:fd,processData:false,contentType:false,success:function(rel){
       $('#preview_'+pos).attr('src','../storefront/images/capsules/'+rel);
       $('#sel_'+pos).val(appid);
       $('img[data-pos='+pos+']').attr('src','../storefront/images/capsules/'+rel).data('app',appid);
       images[pos]=images[pos]||[];
       images[pos].push({file:rel,label:y+'-'+m+'-'+d});
       $('#capsuleModal').hide();
    }});
  });

  $('.cancel').on('click',function(){
    $('#capsuleModal').hide();
  });

  $('.filter').on('input',function(){
    var sel=$('#'+$(this).data('select')+' option');
    var val=$(this).val().toLowerCase();
    sel.each(function(){
      $(this).toggle($(this).text().toLowerCase().indexOf(val)>=0);
    });
  });

  $('.capsule-select').on('mousemove change',function(e){
    var opt=$(this).find('option:selected');
    var img=opt.data('img');
    var tgt='#img_'+this.id;
    if(img){
      $(tgt).attr('src','../archived_steampowered/2005/storefront/screenshots/'+img).css({top:e.pageY+5,left:e.pageX+5}).show();
    }
  });
  $('.capsule-select').on('mouseleave',function(){ $('#img_'+this.id).hide(); });
  </script>
<?php include 'admin_footer.php';?>
