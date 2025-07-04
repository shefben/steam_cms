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


$rows = $db->query('SELECT * FROM store_capsules')->fetchAll(PDO::FETCH_ASSOC);
$caps = [];
foreach ($rows as $r) {
    $caps[$r['position']] = $r;
}
$apps = $db->query('SELECT appid,name FROM store_apps ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);

$img_base = dirname(__DIR__, 2) . '/storefront/images/capsules';
$images = ['top'=>[], 'middle'=>[], 'bottom_left'=>[], 'bottom_right'=>[]];
if(is_dir($img_base)){
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($img_base));
    foreach ($it as $file) {
        if ($file->isFile() && preg_match('#/(\d{4}_\d{2}-[^/]+)/(top|middle|bottom_left|bottom_right)_capsule\.png$#', $file->getPathname(), $m)) {
            $folder = $m[1];
            $pos = $m[2];
            if (preg_match('/(\d{4})_(\d{2})/', $folder, $mm)) {
                $label = $mm[1] . '-' . $mm[2];
            } else {
                $label = $folder;
            }
            $rel = $folder . '/' . $pos . '_capsule.png';
            $images[$pos][] = ['file' => $rel, 'label' => $label];
        }
    }
}
?>
<h2>Main Page</h2>
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
<div id="menu" role="menu" aria-label="Capsule options" style="display:none;position:absolute;background:#fff;border:1px solid #000;z-index:1000"></div>
<div id="uploadForm" role="dialog" aria-label="Upload capsule" style="display:none;position:fixed;top:10%;left:10%;background:#fff;border:1px solid #000;padding:10px;z-index:2000">
  <form id="uform" enctype="multipart/form-data">
    <input type="hidden" name="position">
    <label>Year <select id="uyear" name="year"></select></label>
    <label>Month <select id="umonth" name="month" disabled></select></label><br>
    <label>App <select name="appid">
      <?php foreach($apps as $a): ?>
      <option value="<?php echo $a['appid'];?>"><?php echo $a['appid'].' - '.htmlspecialchars($a['name']);?></option>
      <?php endforeach; ?>
    </select></label><br>
    <input type="file" name="file" id="ufile"><br>
    <img id="upreview" style="max-width:200px;display:none" alt="preview"><br>
    <button type="submit">Upload</button> <button type="button" id="uclose">Cancel</button>
  </form>
</div>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script>
var images = <?php echo json_encode($images);?>;
var apps = <?php echo json_encode($apps);?>;
var menu = $('#menu');

$('img[data-pos]').on('click',function(e){
  var pos = $(this).data('pos');
  var app = $(this).data('app');
  var list = '<ul style="list-style:none;margin:0;padding:4px">';
  $.each(images[pos] || [], function(i,img){
      list += '<li class="choice" data-file="'+img.file+'" style="padding:4px;cursor:pointer">'
          +'<img src="../storefront/images/capsules/'+img.file+'" width="48" height="24" alt="'+img.label+' thumbnail"><br>'
          +img.label+'</li>';
  });
  list += '<li id="upload">Upload...</li></ul>';
  menu.html(list).css({top:e.pageY,left:e.pageX}).show();
  menu.data({img:$(this), pos:pos, appid:app});
});
menu.on('click','.choice',function(){
  var file=$(this).data('file');
  var img=menu.data('img');
  var pos=menu.data('pos');
  var appid=menu.data('appid');
  $.post('storefront_main.php',{update:1,position:pos,image:file,appid:appid},function(){
      img.attr('src','../storefront/images/capsules/'+file);
      menu.hide();
  });
});
menu.on('click','#upload',function(){
  $('#uform')[0].reset();
  $('#uform [name=position]').val(menu.data('pos'));
  $('#uyear').val('');
  $('#umonth').prop('disabled',true).empty();
  $('#upreview').hide();
  $('#uploadForm').show();
});
$('#uform').on('submit',function(e){
  e.preventDefault();
  var fd=new FormData(this);
  $.ajax({url:'upload_capsule.php',type:'POST',data:fd,processData:false,contentType:false,success:function(path){
      var img=menu.data('img');
      var pos=menu.data('pos');
      img.attr('src','../storefront/images/capsules/'+path);
      img.data('app',fd.get('appid'));
      images[pos]=images[pos]||[];
      var label=fd.get('year')+'-'+('0'+fd.get('month')).slice(-2);
      images[pos].push({file:path,label:label});
      $('#uploadForm').hide();
      menu.hide();
  }});
});
$('#uclose').on('click',function(){ $('#uploadForm').hide(); });
$(document).on('click',function(e){ if(!$(e.target).closest('#menu').length) menu.hide(); });
$('#ufile').on('change',function(){
  if(this.files && this.files[0]){
    $('#upreview').attr('src',URL.createObjectURL(this.files[0])).show();
  }
});
var months=['','January','February','March','April','May','June','July','August','September','October','November','December'];
for(var y=new Date().getFullYear();y>=2002;y--){
  $('#uyear').append('<option value="'+y+'">'+y+'</option>');
}
$('#uyear').on('change',function(){
  var y=$(this).val();
  $('#umonth').empty().prop('disabled',!y);
  if(y){
    for(var m=1;m<=12;m++){
      var mm=('0'+m).slice(-2);
      $('#umonth').append('<option value="'+mm+'">'+months[m]+'</option>');
    }
  }
});
</script>
<?php include 'admin_footer.php';?>
