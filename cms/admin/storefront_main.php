<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db=cms_get_db();
$theme = cms_get_setting('theme', '2004');
$use_all = cms_get_setting('capsules_same_all', '1') === '1';
$positions = ['top1','top2','large','under1','under2','bottom1','bottom2'];
$is2006 = preg_match('/^200[67]/',$theme) === 1;
$showTabs = $theme === '2007_v2';

if(isset($_POST['update'])){
    $pos=$_POST['position'];
    $img=trim($_POST['image']);
    $appid=(int)$_POST['appid'];
    $size=$pos==='large'?'large':'small';
    if($use_all){
        $stmt=$db->prepare('REPLACE INTO storefront_capsules_all(position,size,image_path,appid,price,hidden) VALUES(?,?,?,?,0,0)');
        $stmt->execute([$pos,$size,$img,$appid]);
    }else{
        $stmt=$db->prepare('REPLACE INTO storefront_capsules_per_theme(theme,position,size,image_path,appid,price,hidden) VALUES(?,?,?,?,?,0,0)');
        $stmt->execute([$theme,$pos,$size,$img,$appid]);
    }
    exit('OK');
}

if (isset($_POST['save_caps'])) {
    $use_all = isset($_POST['use_all']);
    cms_set_setting('capsules_same_all', $use_all ? '1' : '0');
    foreach ($positions as $pos) {
        $appid = (int)($_POST['appid'][$pos] ?? 0);
        $price = isset($_POST['price'][$pos]) ? floatval($_POST['price'][$pos]) : null;
        $img = $_POST['current_image'][$pos] ?? '';
        $size = $pos === 'large' ? 'large' : 'small';
        if ($use_all) {
            $stmt = $db->prepare('REPLACE INTO storefront_capsules_all(position,size,image_path,appid,price,hidden) VALUES(?,?,?,?,?,0)');
            $stmt->execute([$pos,$size,$img,$appid,$price]);
        } else {
            $stmt = $db->prepare('REPLACE INTO storefront_capsules_per_theme(theme,position,size,image_path,appid,price,hidden) VALUES(?,?,?,?,?,?,0)');
            $stmt->execute([$theme,$pos,$size,$img,$appid,$price]);
        }
        if ($appid && $price !== null) {
            $db->prepare('UPDATE store_apps SET price=? WHERE appid=?')->execute([$price,$appid]);
        }
    }
}

if ($showTabs && isset($_POST['save_tabs'])) {
    $tabsIn = $_POST['tab'] ?? [];
    foreach ($tabsIn as $i => $tab) {
        $id = (int)($tab['id'] ?? 0);
        if (!empty($tab['delete'])) {
            if ($id) {
                $db->prepare('DELETE FROM storefront_tabs WHERE id=?')->execute([$id]);
                $db->prepare('DELETE FROM storefront_tab_games WHERE tab_id=?')->execute([$id]);
            }
            continue;
        }
        $title = trim($tab['title'] ?? '');
        $ord = $i + 1;
        if ($id) {
            $db->prepare('UPDATE storefront_tabs SET title=?, ord=? WHERE id=?')->execute([$title,$ord,$id]);
        } else {
            $stmt = $db->prepare('INSERT INTO storefront_tabs(theme,title,ord) VALUES(?,?,?)');
            $stmt->execute([$theme,$title,$ord]);
            $id = $db->lastInsertId();
        }
        $db->prepare('DELETE FROM storefront_tab_games WHERE tab_id=?')->execute([$id]);
        if (!empty($tab['games'])) {
            $o=1;
            foreach ($tab['games'] as $appid) {
                $appid = (int)$appid;
                $db->prepare('INSERT INTO storefront_tab_games(tab_id,appid,ord) VALUES(?,?,?)')->execute([$id,$appid,$o++]);
            }
        }
    }
}



$rows = [];
if ($use_all) {
    $rows = $db->query('SELECT * FROM storefront_capsules_all')->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $db->prepare('SELECT * FROM storefront_capsules_per_theme WHERE theme=?');
    $stmt->execute([$theme]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$caps = [];
foreach ($rows as $r) {
    $caps[$r['position']] = $r + ['image' => $r['image_path']];
}
$caps += array_fill_keys($positions, ['appid'=>0,'image'=>'']);
$apps = $db->query('SELECT appid,name,price,images FROM store_apps ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$price_map = [];
foreach ($apps as $a) { $price_map[$a['appid']] = $a['price']; }

$img_base = dirname(__DIR__, 2) . '/images/capsules';
$list = [];
if ($use_all) {
    foreach (glob($img_base.'/*', GLOB_ONLYDIR) as $dir) {
        foreach (glob($dir.'/*.png') as $file) {
            $list[] = basename(dirname($file)).'/'.basename($file);
        }
    }
} else {
    $dir = $img_base.'/'.$theme;
    if (is_dir($dir)) {
        foreach (glob($dir.'/*.png') as $file) {
            $list[] = $theme.'/'.basename($file);
        }
    }
}
$tabs = [];
if ($showTabs) {
    $stmt = $db->prepare('SELECT * FROM storefront_tabs WHERE theme=? ORDER BY ord,id');
    $stmt->execute([$theme]);
    $tabs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($tabs as &$t) {
        $g = $db->prepare('SELECT appid FROM storefront_tab_games WHERE tab_id=? ORDER BY ord');
        $g->execute([$t["id"]]);
        $t['games'] = $g->fetchAll(PDO::FETCH_COLUMN);
    }
    unset($t);
}
$images = [];
foreach ($positions as $pos) { $images[$pos] = []; foreach ($list as $f) { $images[$pos][] = ['file'=>$f,'label'=>$f]; } }
?>
<h2>Main Page</h2>
<form method="post" style="margin-bottom:15px;">
  <fieldset class="capsule-box-group">
    <legend>Capsule Links</legend>
    <label><input type="checkbox" name="use_all" value="1" <?php if($use_all) echo 'checked'; ?>> Use same capsules across all themes</label>
    <?php
      $labels = $is2006
        ? ['top1'=>'Top 1','top2'=>'Top 2','large'=>'Large','under1'=>'Under 1','under2'=>'Under 2','bottom1'=>'Bottom 1','bottom2'=>'Bottom 2']
        : ['top'=>'Top','middle'=>'Middle','bottom_left'=>'Bottom Left','bottom_right'=>'Bottom Right'];
      foreach($labels as $p=>$label):
      $app = $caps[$p]['appid'] ?? 0;
      $img = $caps[$p]['image'] ?? '';
      $price = $price_map[$app] ?? '';
    ?>
    <div class="capsule-box">
      <img id="preview_<?php echo $p; ?>" src="../../images/capsules/<?php echo htmlspecialchars($img); ?>" alt="<?php echo $label; ?> preview" class="capsule-preview">
      <input type="hidden" name="current_image[<?php echo $p; ?>]" value="<?php echo htmlspecialchars($img); ?>">
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
        <label>Price <input type="text" name="price[<?php echo $p; ?>]" value="<?php echo htmlspecialchars($price); ?>" size="6"></label>
      </div>
    </div>
    <?php endforeach; ?>
    <button type="submit" name="save_caps" class="btn btn-primary" style="margin-top:10px;">Save Capsules</button>
  </fieldset>
</form>
<div id="caps" style="position:relative;width:590px;height:<?php echo $is2006?580:511;?>px;">
  <?php $styleMap = $is2006 ? [
        'top1' => 'left:0;top:0;width:288px;height:105px',
        'top2' => 'left:301px;top:0;width:289px;height:105px',
        'large' => 'left:0;top:112px;width:590px;height:221px',
        'under1' => 'left:0;top:344px;width:288px;height:105px',
        'under2' => 'left:301px;top:344px;width:289px;height:105px',
        'bottom1' => 'left:0;top:456px;width:288px;height:105px',
        'bottom2' => 'left:301px;top:456px;width:289px;height:105px'
      ] : [
        'top' => 'left:1px;top:1px;width:588px;height:98px',
        'middle' => 'left:0;top:112px;width:589px;height:228px',
        'bottom_left' => 'left:0;top:352px;width:288px;height:158px',
        'bottom_right' => 'left:301px;top:352px;width:289px;height:158px'
      ];
      $dimsMap = [];
      foreach ($styleMap as $pos=>$style){
        if(preg_match('/width:(\\d+)px;height:(\\d+)px/',$style,$m)){
          $dimsMap[$pos] = ['width'=>(int)$m[1],'height'=>(int)$m[2]];
        }
      }
      foreach($styleMap as $p=>$style):
        $img=$caps[$p]['image']??'';
        $appid=$caps[$p]['appid']??0;
  ?>
  <img src="../../images/capsules/<?php echo htmlspecialchars($img); ?>" data-pos="<?php echo $p?>" data-app="<?php echo $appid?>" style="position:absolute;<?php echo $style; ?>;border:0;cursor:pointer;" alt="<?php echo ucfirst(str_replace('_',' ', $p)); ?> capsule" aria-label="<?php echo ucfirst(str_replace('_',' ', $p)); ?> capsule preview">
  <?php endforeach; ?>
</div>
  <div id="capsuleModal" class="capsule-modal" aria-label="Change capsule">
    <div class="dialog">
      <div id="capChoose">
        <button type="button" id="btnSelectExisting" class="btn btn-secondary">Choose Existing Image</button>
        <button type="button" id="btnUploadNew" class="btn btn-secondary">Upload New Image</button>
      </div>
      <div id="capExisting" style="display:none;">
        <label>Image
          <select id="existingFile"></select>
        </label>
        <label>App
          <select id="existingAppid"></select>
        </label>
        <div class="modal-actions">
          <button type="button" id="existingAccept" class="btn btn-primary">Accept</button>
          <button type="button" class="btn btn-secondary cancel">Cancel</button>
        </div>
      </div>
      <div id="capUpload" style="display:none;">
        <label>App <select id="uploadAppid"></select></label><br>
        <input type="file" id="uploadFile" accept="image/png"><br>
        <img id="uploadPreview" style="display:none;max-width:100%;margin-top:10px" alt="preview"><br>
        <div class="modal-actions">
          <button type="button" id="uploadAccept" class="btn btn-primary">OK</button>
          <button type="button" class="btn btn-secondary cancel">Cancel</button>
        </div>
      </div>
    </div>
  </div>
<?php if ($showTabs): ?>
<h3>Spotlight Tabs</h3>
<form method="post" id="tabsForm" style="margin-top:10px;">
 <table class="table" id="tabs-table">
  <thead><tr><th></th><th>Title</th><th>Games</th><th>Remove</th></tr></thead>
  <tbody>
  <?php foreach($tabs as $i=>$t): ?>
   <tr class="tab-row">
    <td class="handle">&#9776;</td>
    <td><input type="text" name="tab[<?php echo $i;?>][title]" value="<?php echo htmlspecialchars($t['title']);?>"></td>
    <td>
      <table class="table games-table"><tbody>
      <?php foreach($t['games'] as $g): ?>
       <tr><td class="handle">&#9776;</td><td>
          <select name="tab[<?php echo $i;?>][games][]">
           <?php foreach($apps as $a): ?>
            <option value="<?php echo $a['appid']; ?>" <?php if($a['appid']==$g) echo 'selected';?>><?php echo $a['appid'].' - '.htmlspecialchars($a['name']); ?></option>
           <?php endforeach; ?>
          </select>
       </td><td><button type="button" class="remove-game btn btn-small">x</button></td></tr>
      <?php endforeach; ?>
      </tbody></table>
      <button type="button" class="add-game btn btn-secondary" data-tab="<?php echo $i;?>">Add Game</button>
    </td>
    <td><button type="button" class="remove-tab btn btn-danger btn-small">Remove</button></td>
    <input type="hidden" name="tab[<?php echo $i;?>][id]" value="<?php echo $t['id']; ?>">
    <input type="hidden" name="tab[<?php echo $i;?>][delete]" value="">
   </tr>
  <?php endforeach; ?>
  </tbody>
 </table>
 <button type="button" id="add-tab" class="btn btn-secondary">Add Tab</button>
 <input type="submit" name="save_tabs" value="Save Tabs" class="btn btn-primary">
</form>
<?php endif; ?>
  <style>
  #capsuleModal {display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);align-items:center;justify-content:center;z-index:1000;}
  #capsuleModal .dialog{background:#fff;padding:20px;border:1px solid #333;max-width:600px;}
  </style>
  <script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
  <script>
  var images = <?php echo json_encode($images);?>;
  var apps = <?php echo json_encode($apps);?>;
  var dims = <?php echo json_encode($dimsMap); ?>;

  function populateAppLists() {
    var opts='';
    $.each(apps,function(i,a){ opts+='<option value="'+a.appid+'">'+a.appid+' - '+$('<div>').text(a.name).html()+'</option>';});
    $('#existingAppid,#uploadAppid').html(opts);
  }
  populateAppLists();

  $('.change-btn').on('click',function(){
    var pos=$(this).data('pos');
    $('#capsuleModal').data('pos',pos).css('display','flex');
    $('#capChoose').show();
    $('#capExisting,#capUpload').hide();
    $('#uploadPreview').hide();
    $('#uploadAccept').prop('disabled',true);
  });

  $('#btnSelectExisting').on('click',function(){
    var pos=$('#capsuleModal').data('pos');
    var grouped={};
    $.each(images[pos]||[],function(i,img){
       var p=img.file.split('/')[0];
       if(!grouped[p]) grouped[p]=[];
       grouped[p].push(img.file);
    });
    var opts='';
    $.each(grouped,function(group,files){
       opts+='<optgroup label="'+group+'">';
       $.each(files,function(_,f){ opts+='<option value="'+f+'">'+f+'</option>'; });
       opts+='</optgroup>';
    });
    $('#existingFile').html(opts);
    $('#existingAppid').val('');
    $('#capChoose').hide();
    $('#capExisting').show();
    $('#uploadPreview').hide();
    $('#uploadAccept').prop('disabled',false);
  });

  $('#existingAccept').on('click',function(){
    var pos=$('#capsuleModal').data('pos');
    var file=$('#existingFile').val();
    var appid=$('#existingAppid').val();
    if(!file||!appid){ alert('Select image and app'); return; }
    $.post('storefront_main.php',{update:1,position:pos,image:file,appid:appid},function(){
       $('#preview_'+pos).attr('src','../../images/capsules/'+file);
       $('#sel_'+pos).val(appid);
       $('img[data-pos='+pos+']').attr('src','../../images/capsules/'+file).data('app',appid);
       $('#capsuleModal').hide();
       $('#uploadPreview').hide();
       $('#uploadAccept').prop('disabled',false);
    });
  });

  $('#btnUploadNew').on('click',function(){
    $('#uploadFile').val('');
    $('#uploadAppid').val('');
    $('#uploadPreview').hide();
    $('#uploadAccept').prop('disabled',true);
    $('#capChoose').hide();
    $('#capUpload').show();
  });

  $('#uploadFile').on('change',function(){
    var pos=$('#capsuleModal').data('pos');
    var file=this.files[0];
    if(!file){$('#uploadPreview').hide();return;}
    var reader=new FileReader();
    reader.onload=function(e){
      $('#uploadPreview').attr('src',e.target.result).show();
      var img=new Image();
      img.onload=function(){
        var dw=dims[pos].width, dh=dims[pos].height;
        if(this.width!==dw||this.height!==dh){
          $('#uploadAccept').prop('disabled',true);
          alert('Image must be '+dw+'x'+dh+' pixels');
        }else{
          $('#uploadAccept').prop('disabled',false);
        }
      };
      img.src=e.target.result;
    };
    reader.readAsDataURL(file);
  });

  $('#uploadAccept').on('click',function(){
    if($(this).prop('disabled')) return;
    var pos=$('#capsuleModal').data('pos');
    var appid=$('#uploadAppid').val();
    var file=$('#uploadFile')[0].files[0];
    if(!appid||!file){ alert('All fields required'); return; }
    var fd=new FormData();
    fd.append('position',pos);
    fd.append('appid',appid);
    fd.append('file',file);
    $.ajax({url:'upload_capsule.php',type:'POST',data:fd,processData:false,contentType:false,success:function(rel){
       $('#preview_'+pos).attr('src','../../images/capsules/'+rel);
       $('#sel_'+pos).val(appid);
       $('img[data-pos='+pos+']').attr('src','../../images/capsules/'+rel).data('app',appid);
       images[pos]=images[pos]||[];
       images[pos].push({file:rel,label:appid});
       $('#capsuleModal').hide();
    }});
  });

  $('.cancel').on('click',function(){
    $('#capsuleModal').hide();
    $('#uploadPreview').hide();
    $('#uploadAccept').prop('disabled',false);
  });

  $('#capsuleModal').on('click', function(e){
    if(e.target === this) {
      $(this).hide();
      $('#uploadPreview').hide();
      $('#uploadAccept').prop('disabled',false);
    }
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

<?php if ($showTabs): ?>
  var tabIndex = <?php echo count($tabs); ?>;
  function gameRow(idx){
    var opts='';
    $.each(apps,function(i,a){opts+='<option value="'+a.appid+'">'+a.appid+' - '+$('<div>').text(a.name).html()+'</option>';});
    return '<tr><td class="handle">&#9776;</td><td><select name="tab['+idx+'][games][]">'+opts+'</select></td><td><button type="button" class="remove-game btn btn-small">x</button></td></tr>';
  }
  function initTabSort(row){
    Sortable.create($(row).find('.games-table tbody')[0],{handle:'.handle',animation:150});
  }
  $('#add-tab').on('click',function(){
    var idx=tabIndex++;
    var row='<tr class="tab-row">'+
      '<td class="handle">&#9776;</td>'+
      '<td><input type="text" name="tab['+idx+'][title]"></td>'+
      '<td><table class="table games-table"><tbody></tbody></table><button type="button" class="add-game btn btn-secondary" data-tab="'+idx+'">Add Game</button></td>'+
      '<td><button type="button" class="remove-tab btn btn-danger btn-small">Remove</button></td>'+
      '<input type="hidden" name="tab['+idx+'][id]" value="0"><input type="hidden" name="tab['+idx+'][delete]" value="">'+
      '</tr>';
    $('#tabs-table tbody').append(row);
    initTabSort($('#tabs-table tbody tr').last());
  });
  $('#tabsForm').on('click','.add-game',function(){
    var idx=$(this).data('tab');
    $(this).siblings('table').find('tbody').append(gameRow(idx));
  });
  $('#tabsForm').on('click','.remove-game',function(){ $(this).closest('tr').remove(); });
  $('#tabsForm').on('click','.remove-tab',function(){
    $(this).closest('tr').find('input[name$="[delete]"]').val('1');
    $(this).closest('tr').hide();
  });
  Sortable.create(document.querySelector('#tabs-table tbody'),{handle:'.handle',animation:150});
  $('#tabs-table tbody tr').each(function(){initTabSort(this);});
<?php endif; ?>
  </script>
<?php include 'admin_footer.php';?>
