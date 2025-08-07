<?php
// Dynamic capsules admin page for themes 2006+

$is2007 = str_starts_with($theme, '2007');
$page_slugs = ['all'=>'All Games','browse'=>'Browse Games','search'=>'Search'];
$pages = [];
foreach(array_keys($page_slugs) as $slug){
    $pages[$slug] = cms_get_store_page($slug);
}

if(isset($_POST['save_pages'])){
    foreach($page_slugs as $slug=>$label){
        $title = trim($_POST[$slug.'_title'] ?? '');
        $img   = trim($_POST[$slug.'_image'] ?? '');
        cms_set_store_page($slug, $title, $img);
        $pages[$slug] = ['title' => $title, 'titleimage' => $img];
    }
}

if(isset($_POST['save_capsules'])){
    $use_all = isset($_POST['use_all']);
    cms_set_setting('capsules_same_all', $use_all ? '1' : '0');
    $caps = $_POST['caps'] ?? [];
    if($use_all){
        $db->prepare('DELETE FROM storefront_capsule_items WHERE theme IS NULL')->execute();
    }else{
        $db->prepare('DELETE FROM storefront_capsule_items WHERE theme=?')->execute([$theme]);
    }
    $ord = 1;
    $stmt = $db->prepare('INSERT INTO storefront_capsule_items(theme,type,appid,image_path,price,title,content,ord) VALUES(?,?,?,?,?,?,?,?)');
    foreach($caps as $cap){
        $type = $cap['type'] ?? 'small';
        $appid = isset($cap['appid']) && $cap['appid'] !== '' ? (int)$cap['appid'] : null;
        $img = trim($cap['image'] ?? '');
        $price = isset($cap['price']) && $cap['price'] !== '' ? floatval($cap['price']) : null;
        $stmt->execute([$use_all?null:$theme, $type, $appid, $img, $price, null, null, $ord++]);
    }
}

if($is2007 && isset($_POST['save_tabs'])){
    $tabsIn = $_POST['tab'] ?? [];
    foreach($tabsIn as $i=>$tab){
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
                $appid=(int)$appid;
                $db->prepare('INSERT INTO storefront_tab_games(tab_id,appid,ord) VALUES(?,?,?)')->execute([$id,$appid,$o++]);
            }
        }
    }
}

if($use_all){
    $rows = $db->query('SELECT * FROM storefront_capsule_items WHERE theme IS NULL ORDER BY ord')->fetchAll(PDO::FETCH_ASSOC);
}else{
    $stmt = $db->prepare('SELECT * FROM storefront_capsule_items WHERE theme=? ORDER BY ord');
    $stmt->execute([$theme]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$apps = $db->query('SELECT appid,name FROM store_apps ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$tabs = [];
if($is2007){
    $stmt = $db->prepare('SELECT * FROM storefront_tabs WHERE theme=? ORDER BY ord,id');
    $stmt->execute([$theme]);
    $tabs = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<h2>Main Page</h2>
<form method="post" style="margin-bottom:15px;">
  <fieldset>
    <legend>Page Titles</legend>
    <table class="table">
      <tr><th>Page</th><th>Title</th><th>Image Path</th></tr>
      <?php foreach($page_slugs as $slug=>$label): ?>
      <tr>
        <td><?php echo $label; ?></td>
        <td><input type="text" name="<?php echo $slug; ?>_title" value="<?php echo htmlspecialchars($pages[$slug]['title']); ?>"></td>
        <td><input type="text" name="<?php echo $slug; ?>_image" value="<?php echo htmlspecialchars($pages[$slug]['titleimage']); ?>"></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <button type="submit" name="save_pages" class="btn btn-primary">Save Titles</button>
  </fieldset>
</form>
<form method="post" id="capsForm" style="margin-bottom:15px;">
  <fieldset>
    <legend>Capsules</legend>
    <label><input type="checkbox" name="use_all" <?php if($use_all) echo 'checked'; ?>> Use same capsules for all themes</label>
    <div id="capsule-list">
      <?php foreach($rows as $i=>$c): ?>
      <div class="capsule-row">
        <span class="handle">&#9776;</span>
        <select name="caps[<?php echo $i; ?>][type]" class="caps-type">
          <option value="small" <?php if($c['type']==='small') echo 'selected'; ?>>Small</option>
          <option value="large" <?php if($c['type']==='large') echo 'selected'; ?>>Large</option>
          <option value="gear" <?php if($c['type']==='gear') echo 'selected'; ?>>Gear</option>
          <option value="free" <?php if($c['type']==='free') echo 'selected'; ?>>Free</option>
          <option value="tabbed" <?php if($c['type']==='tabbed') echo 'selected'; ?>>Tabbed</option>
        </select>
        <select name="caps[<?php echo $i; ?>][appid]" class="caps-app">
          <option value="">-- App --</option>
          <?php foreach($apps as $a): ?>
          <option value="<?php echo $a['appid']; ?>" <?php if((int)$a['appid']==(int)$c['appid']) echo 'selected'; ?>><?php echo $a['appid'].' - '.htmlspecialchars($a['name']); ?></option>
          <?php endforeach; ?>
        </select>
        <input type="text" name="caps[<?php echo $i; ?>][image]" value="<?php echo htmlspecialchars($c['image_path']); ?>" placeholder="image path">
        <input type="text" name="caps[<?php echo $i; ?>][price]" value="<?php echo htmlspecialchars($c['price']); ?>" size="6" placeholder="price">
        <button type="button" class="remove-capsule btn btn-danger btn-small">Remove</button>
      </div>
      <?php endforeach; ?>
    </div>
    <button type="button" id="add-capsule" class="btn btn-secondary">Add Capsule</button>
    <button type="submit" name="save_capsules" class="btn btn-primary">Save Capsules</button>
  </fieldset>
</form>
<?php if($is2007): ?>
<form method="post" id="tabsForm" style="margin-bottom:15px;">
  <fieldset>
    <legend>Tabbed Capsule</legend>
    <table class="table" id="tabs-table">
      <thead><tr><th></th><th>Title</th><th>Games</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach($tabs as $i=>$tab): ?>
        <tr class="tab-row">
          <td class="handle">&#9776;</td>
          <td><input type="text" name="tab[<?php echo $i; ?>][title]" value="<?php echo htmlspecialchars($tab['title']); ?>"></td>
          <td>
            <table class="table games-table"><tbody>
            <?php
              $g = $db->prepare('SELECT appid FROM storefront_tab_games WHERE tab_id=? ORDER BY ord');
              $g->execute([$tab['id']]);
              foreach($g->fetchAll(PDO::FETCH_ASSOC) as $row): ?>
              <tr><td class="handle">&#9776;</td><td><select name="tab[<?php echo $i; ?>][games][]">
                <option value="">-- App --</option>
                <?php foreach($apps as $a): ?>
                <option value="<?php echo $a['appid']; ?>" <?php if((int)$a['appid']===(int)$row['appid']) echo 'selected'; ?>><?php echo $a['appid'].' - '.htmlspecialchars($a['name']); ?></option>
                <?php endforeach; ?>
              </select></td><td><button type="button" class="remove-game btn btn-small">x</button></td></tr>
            <?php endforeach; ?>
            </tbody></table>
            <button type="button" class="add-game btn btn-secondary" data-tab="<?php echo $i; ?>">Add Game</button>
          </td>
          <td><button type="button" class="remove-tab btn btn-danger btn-small">Remove</button></td>
          <input type="hidden" name="tab[<?php echo $i; ?>][id]" value="<?php echo $tab['id']; ?>">
          <input type="hidden" name="tab[<?php echo $i; ?>][delete]" value="">
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <button type="button" id="add-tab" class="btn btn-secondary">Add Tab</button>
    <button type="submit" name="save_tabs" class="btn btn-primary">Save Tabs</button>
  </fieldset>
</form>
<?php endif; ?>
<script>
$(function(){
var apps = <?php echo json_encode($apps); ?>;
function appOptions(){
  var opts='<option value="">-- App --</option>';
  $.each(apps,function(i,a){opts+='<option value="'+a.appid+'">'+a.appid+' - '+$('<div>').text(a.name).html()+'</option>';});
  return opts;
}
$('#add-capsule').on('click',function(){
  var idx=$('#capsule-list .capsule-row').length;
  var row='<div class="capsule-row"><span class="handle">&#9776;</span>'+
    '<select name="caps['+idx+'][type]" class="caps-type"><option value="small">Small</option><option value="large">Large</option><option value="gear">Gear</option><option value="free">Free</option><option value="tabbed">Tabbed</option></select>'+
    '<select name="caps['+idx+'][appid]" class="caps-app">'+appOptions()+'</select>'+
    '<input type="text" name="caps['+idx+'][image]" placeholder="image path">'+
    '<input type="text" name="caps['+idx+'][price]" size="6" placeholder="price">'+
    '<button type="button" class="remove-capsule btn btn-danger btn-small">Remove</button></div>';
  $('#capsule-list').append(row);
});
$('#capsule-list').on('click','.remove-capsule',function(){ $(this).closest('.capsule-row').remove(); });
Sortable.create(document.getElementById('capsule-list'),{handle:'.handle',animation:150});
<?php if($is2007): ?>
var tabIndex = <?php echo count($tabs); ?>;
function gameRow(idx){
  var opts=appOptions();
  return '<tr><td class="handle">&#9776;</td><td><select name="tab['+idx+'][games][]">'+opts+'</select></td><td><button type="button" class="remove-game btn btn-small">x</button></td></tr>';
}
function initTabSort(row){
  Sortable.create($(row).find('.games-table tbody')[0],{handle:'.handle',animation:150});
}
$('#add-tab').on('click',function(){
  var idx=tabIndex++;
  var row='<tr class="tab-row"><td class="handle">&#9776;</td><td><input type="text" name="tab['+idx+'][title]"></td><td><table class="table games-table"><tbody></tbody></table><button type="button" class="add-game btn btn-secondary" data-tab="'+idx+'">Add Game</button></td><td><button type="button" class="remove-tab btn btn-danger btn-small">Remove</button></td><input type="hidden" name="tab['+idx+'][id]" value="0"><input type="hidden" name="tab['+idx+'][delete]" value=""></tr>';
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
});
</script>
