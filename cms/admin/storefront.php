<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();
$featured = json_decode(cms_get_setting('store_featured','{}'), true) ?: [];

if(isset($_POST['save_featured'])){
    $featured = [
        'top'=>(int)$_POST['feat_top'],
        'middle'=>(int)$_POST['feat_middle'],
        'bottom_left'=>(int)$_POST['feat_bottom_left'],
        'bottom_right'=>(int)$_POST['feat_bottom_right']
    ];
    cms_set_setting('store_featured', json_encode($featured));
}

// handle category updates
if(isset($_POST['save_categories'])){
    foreach($_POST['id'] as $i=>$id){
        if(!empty($_POST['delete'][$i])){
            $stmt=$db->prepare('DELETE FROM store_categories WHERE id=?');
            $stmt->execute([$id]);
            continue;
        }
        $name = trim($_POST['name'][$i]);
        $ord = (int)$_POST['ord'][$i];
        $vis = isset($_POST['visible'][$i]) ? 1 : 0;
        $stmt = $db->prepare('UPDATE store_categories SET name=?, ord=?, visible=? WHERE id=?');
        $stmt->execute([$name,$ord,$vis,$id]);
    }
}
if(isset($_POST['add_category'])){
    $name = trim($_POST['new_name']);
    if($name!==''){
        $ord = (int)$db->query('SELECT IFNULL(MAX(ord),0)+1 FROM store_categories')->fetchColumn();
        $stmt = $db->prepare('INSERT INTO store_categories(name,ord,visible) VALUES(?,?,1)');
        $stmt->execute([$name,$ord]);
    }
}
// handle developer update via ajax
if(isset($_POST['dev_id'])){
    $stmt = $db->prepare('UPDATE store_developers SET name=? WHERE id=?');
    $stmt->execute([$_POST['dev_name'], (int)$_POST['dev_id']]);
    exit('OK');
}

// handle sidebar updates
if(isset($_POST['save_sidebar'])){
    foreach($_POST['sid'] as $i=>$id){
        if(!empty($_POST['del'][$i])){
            $db->prepare('DELETE FROM store_sidebar_links WHERE id=?')->execute([$id]);
            continue;
        }
        $label = trim($_POST['label'][$i]);
        $url = trim($_POST['url'][$i]);
        $type = $_POST['type'][$i]=='spacer'?'spacer':'link';
        $ord = $i+1;
        $vis = empty($_POST['hide'][$i]) ? 1 : 0;
        $db->prepare('UPDATE store_sidebar_links SET label=?,url=?,type=?,ord=?,visible=? WHERE id=?')->execute([$label,$url,$type,$ord,$vis,$id]);
    }
}
if(isset($_POST['add_sidebar']) || isset($_POST['add_spacer'])){
    $label = isset($_POST['add_spacer']) ? '' : trim($_POST['new_label']);
    $url   = isset($_POST['add_spacer']) ? '' : trim($_POST['new_url']);
    $type  = isset($_POST['add_spacer']) ? 'spacer' : 'link';
    $ord   = count($db->query('SELECT id FROM store_sidebar_links')->fetchAll()) + 1;
    $db->prepare('INSERT INTO store_sidebar_links(label,url,type,ord,visible) VALUES(?,?,?,?,1)')->execute([$label,$url,$type,$ord]);
}

$categories = $db->query('SELECT * FROM store_categories ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
$developers = $db->query('SELECT * FROM store_developers ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$sidebar_links = $db->query('SELECT * FROM store_sidebar_links ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Storefront</h2>
<ul class="tabs">
<li><a href="#main">Main</a></li>
<li><a href="#categories">Categories</a></li>
<li><a href="#products">Products</a></li>
<li><a href="#developers">Developers</a></li>
<li><a href="#sidebar">Sidebar</a></li>
</ul>
<div id="main">
<form method="post" style="margin-top:10px">
  <fieldset style="border:1px solid #ccc;padding:10px;width:340px;">
    <legend>Featured Apps</legend>
    <?php $app_opts = $db->query('SELECT appid,name,images FROM store_apps ORDER BY name')->fetchAll(PDO::FETCH_ASSOC); ?>
    <div class="feat">
      <label>Top<br><input type="text" class="filter" data-select="ftop"><br>
      <select id="ftop" name="feat_top" size="5">
        <?php foreach($app_opts as $a): $im=json_decode($a['images']?:'[]',true);$img=$im? $im[0] : '';?><option value="<?php echo $a['appid']?>" data-img="<?php echo $img?>" <?php if(($featured['top']??0)==$a['appid']) echo 'selected';?>><?php echo $a['appid'].' - '.htmlspecialchars($a['name'])?></option><?php endforeach; ?>
      </select></label>
      <img id="img_ftop" style="display:none;position:absolute;z-index:1000"/>
    </div>
    <div class="feat">
      <label>Middle<br><input type="text" class="filter" data-select="fmid"><br>
      <select id="fmid" name="feat_middle" size="5">
        <?php foreach($app_opts as $a): $im=json_decode($a['images']?:'[]',true);$img=$im? $im[0] : '';?><option value="<?php echo $a['appid']?>" data-img="<?php echo $img?>" <?php if(($featured['middle']??0)==$a['appid']) echo 'selected';?>><?php echo $a['appid'].' - '.htmlspecialchars($a['name'])?></option><?php endforeach; ?>
      </select></label>
      <img id="img_fmid" style="display:none;position:absolute;z-index:1000"/>
    </div>
    <div class="feat">
      <label>Bottom Left<br><input type="text" class="filter" data-select="fbl"><br>
      <select id="fbl" name="feat_bottom_left" size="5">
        <?php foreach($app_opts as $a): $im=json_decode($a['images']?:'[]',true);$img=$im? $im[0] : '';?><option value="<?php echo $a['appid']?>" data-img="<?php echo $img?>" <?php if(($featured['bottom_left']??0)==$a['appid']) echo 'selected';?>><?php echo $a['appid'].' - '.htmlspecialchars($a['name'])?></option><?php endforeach; ?>
      </select></label>
      <img id="img_fbl" style="display:none;position:absolute;z-index:1000"/>
    </div>
    <div class="feat">
      <label>Bottom Right<br><input type="text" class="filter" data-select="fbr"><br>
      <select id="fbr" name="feat_bottom_right" size="5">
        <?php foreach($app_opts as $a): $im=json_decode($a['images']?:'[]',true);$img=$im? $im[0] : '';?><option value="<?php echo $a['appid']?>" data-img="<?php echo $img?>" <?php if(($featured['bottom_right']??0)==$a['appid']) echo 'selected';?>><?php echo $a['appid'].' - '.htmlspecialchars($a['name'])?></option><?php endforeach; ?>
      </select></label>
      <img id="img_fbr" style="display:none;position:absolute;z-index:1000"/>
    </div>
    <div style="clear:both"><input type="submit" name="save_featured" value="Save Featured" class="btn btn-primary"></div>
  </fieldset>
</form>
</div>
<div id="categories" style="display:none">
<form method="post">
<table class="table">
<tr><th>Order</th><th>Name</th><th>Visible</th><th>Delete</th></tr>
<?php foreach($categories as $c): ?>
<tr>
  <td><input type="number" name="ord[]" value="<?php echo $c['ord']?>" style="width:50px"></td>
  <td><input type="text" name="name[]" value="<?php echo htmlspecialchars($c['name'])?>"></td>
  <td><input type="checkbox" name="visible[]" value="1" <?php if($c['visible']) echo 'checked';?>></td>
  <td><input type="checkbox" name="delete[]" value="1"></td>
  <input type="hidden" name="id[]" value="<?php echo $c['id']?>">
</tr>
<?php endforeach; ?>
</table>
<div style="margin-top:10px">
    <input type="submit" name="save_categories" value="Save" class="btn btn-primary">
</div>
</form>
<hr>
<form method="post" style="margin-top:10px">
    <input type="text" name="new_name" placeholder="New category">
    <input type="submit" name="add_category" value="Add" class="btn">
</form>
</div>
<div id="products" style="display:none">
<?php
$page = max(1, (int)($_GET['p'] ?? 1));
$per = 25;
$offset = ($page-1)*$per;
$rows = $db->prepare('SELECT * FROM store_apps ORDER BY appid LIMIT ? OFFSET ?');
$rows->execute([$per,$offset]);
$total = $db->query('SELECT COUNT(*) FROM store_apps')->fetchColumn();
?>
<table class="table">
<tr><th>ID</th><th>Image</th><th>Name</th><th>Developer</th><th>Price</th><th>Avail</th><th></th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?php echo $r['appid']?></td>
<td>
<?php $imgs = json_decode($r['images'] ?: '[]', true); if($imgs){$img=$imgs[0]; echo '<img src="../archived_steampowered/2005/storefront/screenshots/'.$img.'" width="40">';} ?>
</td>
<td><?php echo htmlspecialchars($r['name'])?></td>
<td><?php echo htmlspecialchars($r['developer'])?></td>
<td><?php echo $r['price']?></td>
<td><?php echo htmlspecialchars($r['availability'])?></td>
<td><a href="storefront_product.php?id=<?php echo $r['appid']?>">Edit</a></td>
</tr>
<?php endforeach; ?>
</table>
<?php
$pages = ceil($total/$per);
if($pages>1){
    echo '<div class="pagination">';
    if($page>1){
        $p=$page-1; echo "<a href='storefront.php?p=$p#products'>&laquo; Prev</a> ";
    }
    if($page<$pages){
        $p=$page+1; echo " <a href='storefront.php?p=$p#products'>Next &raquo;</a>";
    }
    echo '</div>';
}
?>
</div>
<div id="sidebar" style="display:none">
<form method="post">
<table class="table" id="sidebar-list">
<tr><th></th><th>Label</th><th>URL</th><th>Type</th><th>Hide</th><th>Remove</th></tr>
<?php foreach($sidebar_links as $s): ?>
<tr>
 <td class="handle">&#9776;<input type="hidden" name="ord[]" value="<?php echo $s['ord']?>"></td>
 <td><input type="text" name="label[]" class="editable" value="<?php echo htmlspecialchars($s['label'])?>" readonly<?php if($s['type']=='spacer') echo ' disabled';?>></td>
 <td><input type="text" name="url[]" class="editable" value="<?php echo htmlspecialchars($s['url'])?>" readonly<?php if($s['type']=='spacer') echo ' disabled';?>></td>
 <td>
  <select name="type[]">
   <option value="link"<?php if($s['type']=='link') echo ' selected';?>>Link</option>
   <option value="spacer"<?php if($s['type']=='spacer') echo ' selected';?>>Spacer</option>
  </select>
 </td>
 <td><input type="checkbox" name="hide[]" value="1" <?php if(!$s['visible']) echo 'checked';?>></td>
 <td>
  <?php if($s['type']!='spacer'): ?><button type="button" class="edit btn btn-secondary">Edit</button><?php endif; ?>
  <button type="button" class="remove btn btn-danger">Remove</button>
  <input type="hidden" name="del[]" value="">
 </td>
 <input type="hidden" name="sid[]" value="<?php echo $s['id']?>">
</tr>
<?php endforeach; ?>
</table>
<div style="margin-top:10px"><input type="submit" name="save_sidebar" value="Save" class="btn btn-primary"></div>
</form>
<hr>
<form method="post" id="addForm" style="margin-top:10px">
 <input type="text" name="new_label" placeholder="Label">
 <input type="text" name="new_url" placeholder="URL">
 <button name="add_sidebar" value="1" class="btn">Add Link</button>
 <button name="add_spacer" value="1" class="btn">Add Spacer</button>
</form>
</div>
<div id="developers" style="display:none">
<table class="table" id="dev-table">
<?php foreach($developers as $d): ?>
<tr data-id="<?php echo $d['id']?>"><td class="dev-name"><?php echo htmlspecialchars($d['name'])?></td></tr>
<?php endforeach; ?>
</table>
</div>
<script>
$('.tabs a').on('click', function(e){
  e.preventDefault();
  var id=$(this).attr('href');
  $('.tabs a').removeClass('active');
  $(this).addClass('active');
  $('div[id]').hide();
  $(id).show();
});
$('.tabs a:first').click();
$('#dev-table').on('click','.dev-name',function(){
  var td=$(this); var id=td.closest('tr').data('id');
  var text=td.text();
  var inp=$('<input>').val(text);
  td.empty().append(inp);
  inp.focus();
  inp.on('blur',function(){
    $.post('storefront.php',{dev_id:id,dev_name:inp.val()},function(){
        td.text(inp.val());
    });
  });
});
$('.filter').on('input',function(){
  var sel=$('#'+$(this).data('select')+' option');
  var val=$(this).val().toLowerCase();
  sel.each(function(){
    var t=$(this).text().toLowerCase();
    $(this).toggle(t.indexOf(val)>=0);
  });
});
$('select[id^=f]').on('change mousemove',function(e){
  var opt=$(this).find('option:selected');
  var img=opt.data('img');
  var target='#img_'+this.id;
  if(img){
    $(target).attr('src','../archived_steampowered/2005/storefront/screenshots/'+img).css({top:e.pageY+5,left:e.pageX+5}).show();
  }
});
function updateOrders(){
  $('#sidebar-list tr').each(function(i){
    $(this).find('input[name="ord[]"]').val(i+1);
  });
}
Sortable.create(document.querySelector('#sidebar-list'),{handle:'.handle',animation:150,onSort:updateOrders});
updateOrders();
$('#sidebar-list').on('click','.remove',function(){
  var row=$(this).closest('tr');
  row.find('input[name="del[]"]').val('1');
  row.hide();
});
$('#sidebar-list').on('click','.edit',function(){
  var row=$(this).closest('tr');
  row.find('.editable').prop('readonly',false);
  $(this).prop('disabled',true);
});
$('select[id^=f]').on('mouseleave',function(){ $('#img_'+this.id).hide(); });
</script>
<?php include 'admin_footer.php'; ?>
