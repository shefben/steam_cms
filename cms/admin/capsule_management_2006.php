<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');
$db = cms_get_db();
$theme = cms_get_setting('theme', '2006_v1');
$gearLarge = str_starts_with($theme, '2007');
$use_all = cms_get_setting('capsules_same_all', '1') === '1';
$themesList = ['2006_v1','2006_v2','2007_v1','2007_v2'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $action = $_POST['action'] ?? '';
    if ($action === 'save') {
        $id = isset($_POST['id']) && $_POST['id'] !== '' ? (int)$_POST['id'] : null;
        $type = $_POST['type'] ?? 'small';
        if ($type === 'tabbed' || $type === 'multi-large') {
            echo json_encode(['status' => 'error']);
            exit;
        }
        $title = trim($_POST['title'] ?? '');
        $content = $_POST['content'] ?? '';
        $appid = isset($_POST['appid']) && $_POST['appid'] !== '' ? (int)$_POST['appid'] : null;
        $name = trim($_POST['name'] ?? '');
        $price = isset($_POST['price']) && $_POST['price'] !== '' ? (float)$_POST['price'] : null;
        $img_path = $_POST['current_image'] ?? '';
        if (!in_array($type, ['gear', 'free'], true)) {
            if (!empty($_FILES['image']['tmp_name'])) {
                $target = $use_all ? 'all' : $theme;
                $base = dirname(__DIR__, 2) . '/storefront/images/capsules/' . $target;
                if (!is_dir($base)) {
                    mkdir($base, 0777, true);
                }
                $file = ($appid ?: time()) . '.png';
                $dest = $base . '/' . $file;
                $img = imagecreatefrompng($_FILES['image']['tmp_name']);
                if ($img) {
                    imagepng($img, $dest);
                    imagedestroy($img);
                    $img_path = $target . '/' . $file;
                }
            }
            if ($appid && $name !== '') {
                $stmt = $db->prepare('INSERT INTO store_apps(appid,name,price) VALUES(?,?,?) ON DUPLICATE KEY UPDATE name=VALUES(name), price=VALUES(price)');
                $stmt->execute([$appid, $name, $price]);
            }
        } else {
            $appid = null;
            $price = null;
            $img_path = '';
        }
        if ($id) {
            $stmt = $db->prepare('UPDATE storefront_capsule_items SET type=?, appid=?, image_path=?, price=?, title=?, content=? WHERE id=?');
            $stmt->execute([$type, $appid, $img_path, $price, $title, $content, $id]);
        } else {
            if ($use_all) {
                $ord = (int)$db->query('SELECT MAX(ord) FROM storefront_capsule_items WHERE theme IS NULL')->fetchColumn() + 1;

                $stmt = $db->prepare('INSERT INTO storefront_capsule_items(theme,type,appid,image_path,price,title,content,ord) VALUES(?,?,?,?,?,?,?,?)');
                $stmt->execute([null, $type, $appid, $img_path, $price, $title, $content, $ord]);
                $id = (int)$db->lastInsertId();
            } else {
                $themesSel = $_POST['themes'] ?? [$theme];
                $stmtIns = $db->prepare('INSERT INTO storefront_capsule_items(theme,type,appid,image_path,price,title,content,ord) VALUES(?,?,?,?,?,?,?,?)');
                $firstId = null;
                foreach ($themesSel as $th) {
                    $st = $db->prepare('SELECT MAX(ord) FROM storefront_capsule_items WHERE theme=?');
                    $st->execute([$th]);
                    $ord = (int)$st->fetchColumn() + 1;
                    $stmtIns->execute([$th, $type, $appid, $img_path, $price, $title, $content, $ord]);
                    if ($firstId === null) {
                        $firstId = (int)$db->lastInsertId();
                    }
                }
                $id = $firstId ?? 0;
            }
        }
        echo json_encode(['status' => 'ok', 'id' => $id, 'image' => $img_path, 'title' => $title, 'content' => $content, 'type' => $type]);
        exit;
    } elseif ($action === 'save_tabbed') {
        $id = isset($_POST['id']) && $_POST['id'] !== '' ? (int)$_POST['id'] : null;
        if (!$id) {
            if ($use_all) {
                $ord = (int)$db->query('SELECT MAX(ord) FROM storefront_capsule_items WHERE theme IS NULL')->fetchColumn() + 1;
            } else {
                $stmt = $db->prepare('SELECT MAX(ord) FROM storefront_capsule_items WHERE theme=?');
                $stmt->execute([$theme]);
                $ord = (int)$stmt->fetchColumn() + 1;
            }
            $stmt = $db->prepare('INSERT INTO storefront_capsule_items(theme,type,appid,image_path,price,title,content,ord) VALUES(?,?,?,?,?,?,?,?)');
            $stmt->execute([$use_all ? null : $theme, 'tabbed', null, '', null, null, null, $ord]);
            $id = (int)$db->lastInsertId();
        }
        $db->prepare('DELETE FROM storefront_tab_games WHERE tab_id IN (SELECT id FROM storefront_tabs WHERE theme=?)')->execute([$theme]);
        $db->prepare('DELETE FROM storefront_tabs WHERE theme=?')->execute([$theme]);
        $tabs = $_POST['tabs'] ?? [];
        foreach ($tabs as $i => $tab) {
            $title = trim($tab['title'] ?? '');
            $stmt = $db->prepare('INSERT INTO storefront_tabs(theme,title,ord) VALUES(?,?,?)');
            $stmt->execute([$theme, $title, $i + 1]);
            $tabId = (int)$db->lastInsertId();
            $games = $tab['games'] ?? [];
            $o = 1;
            foreach ($games as $game) {
                $appid = isset($game['appid']) && $game['appid'] !== '' ? (int)$game['appid'] : null;
                $img = $game['image'] ?? '';
                $name = trim($game['name'] ?? '');
                $price = isset($game['price']) && $game['price'] !== '' ? (float)$game['price'] : null;
                if ($appid && $name !== '') {
                    $db->prepare('INSERT INTO store_apps(appid,name,price) VALUES(?,?,?) ON DUPLICATE KEY UPDATE name=VALUES(name), price=VALUES(price)')->execute([$appid, $name, $price]);
                }
                $db->prepare('INSERT INTO storefront_tab_games(tab_id,appid,image_path,ord) VALUES(?,?,?,?)')->execute([$tabId, $appid, $img, $o++]);
            }
        }
        echo json_encode(['status' => 'ok', 'id' => $id]);
        exit;
    } elseif ($action === 'get_tabbed') {
        $out = [];
        $stmt = $db->prepare('SELECT id,title FROM storefront_tabs WHERE theme=? ORDER BY ord');
        $stmt->execute([$theme]);
        $tabs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($tabs as $tab) {
            $g = $db->prepare('SELECT g.appid,g.image_path,a.name,a.price FROM storefront_tab_games g JOIN store_apps a ON g.appid=a.appid WHERE g.tab_id=? ORDER BY g.ord');
            $g->execute([$tab['id']]);
            $out[] = ['title' => $tab['title'], 'games' => $g->fetchAll(PDO::FETCH_ASSOC)];
        }
        echo json_encode(['status' => 'ok', 'tabs' => $out]);
        exit;
    } elseif ($action === 'save_multi_large') {
        $id = isset($_POST['id']) && $_POST['id'] !== '' ? (int)$_POST['id'] : null;
        if (!$id) {
            if ($use_all) {
                $ord = (int)$db->query('SELECT MAX(ord) FROM storefront_capsule_items WHERE theme IS NULL')->fetchColumn() + 1;
            } else {
                $stmt = $db->prepare('SELECT MAX(ord) FROM storefront_capsule_items WHERE theme=?');
                $stmt->execute([$theme]);
                $ord = (int)$stmt->fetchColumn() + 1;
            }
            $group = 'multi_' . time() . '_' . rand(1000, 9999);
            $stmt = $db->prepare('INSERT INTO storefront_capsule_items(theme,type,appid,image_path,price,title,content,ord) VALUES(?,?,?,?,?,?,?,?)');
            $stmt->execute([$use_all ? null : $theme, 'multi-large', null, $group, null, null, null, $ord]);
            $id = (int)$db->lastInsertId();
        } else {
            $stmt = $db->prepare('SELECT image_path FROM storefront_capsule_items WHERE id=?');
            $stmt->execute([$id]);
            $group = $stmt->fetchColumn();
        }
        echo json_encode(['status' => 'ok', 'id' => $id, 'group' => $group]);
        exit;
    } elseif ($action === 'add_multi_app') {
        $group = $_POST['group'] ?? '';
        $appid = isset($_POST['appid']) && $_POST['appid'] !== '' ? (int)$_POST['appid'] : null;
        $image_path = $_POST['image_path'] ?? '';
        $price = isset($_POST['price']) && $_POST['price'] !== '' ? (float)$_POST['price'] : 0;
        
        if ($appid && $group) {
            $stmt = $db->prepare('SELECT COUNT(*) FROM multicapsule WHERE `group`=?');
            $stmt->execute([$group]);
            $count = (int)$stmt->fetchColumn();
            if ($count >= 7) {
                echo json_encode(['status' => 'error', 'message' => 'Maximum 7 apps allowed']);
                exit;
            }
            
            $stmt = $db->prepare('SELECT MAX(`order`) FROM multicapsule WHERE `group`=?');
            $stmt->execute([$group]);
            $order = (int)$stmt->fetchColumn() + 1;
            $stmt = $db->prepare('INSERT INTO multicapsule(`group`, `order`, appid, image_path, price) VALUES(?,?,?,?,?)');
            $stmt->execute([$group, $order, $appid, $image_path, $price]);
            
            $stmt = $db->prepare('SELECT name FROM store_apps WHERE appid=?');
            $stmt->execute([$appid]);
            $name = $stmt->fetchColumn() ?: 'Unknown Game';
            
            echo json_encode(['status' => 'ok', 'id' => $db->lastInsertId(), 'appid' => $appid, 'name' => $name]);
            exit;
        }
        echo json_encode(['status' => 'error']);
        exit;
    } elseif ($action === 'remove_multi_app') {
        $id = (int)($_POST['id'] ?? 0);
        $db->prepare('DELETE FROM multicapsule WHERE id=?')->execute([$id]);
        echo json_encode(['status' => 'ok']);
        exit;
    } elseif ($action === 'get_multi_apps') {
        $group = $_POST['group'] ?? '';
        $stmt = $db->prepare('SELECT m.id, m.appid, m.image_path, m.price, a.name FROM multicapsule m LEFT JOIN store_apps a ON m.appid=a.appid WHERE m.`group`=? ORDER BY m.`order`');
        $stmt->execute([$group]);
        $apps = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'ok', 'apps' => $apps]);
        exit;
    } elseif ($action === 'upload_game_image') {
        $target = $use_all ? 'all' : $theme;
        $base = dirname(__DIR__, 2) . '/storefront/images/capsules/' . $target;
        if (!is_dir($base)) {
            mkdir($base, 0777, true);
        }
        $file = 'tab_' . time() . '_' . rand(1000,9999) . '.png';
        $dest = $base . '/' . $file;
        $img = imagecreatefrompng($_FILES['game_image']['tmp_name'] ?? '');
        if ($img) {
            imagepng($img, $dest);
            imagedestroy($img);
            echo json_encode(['status' => 'ok', 'path' => $target . '/' . $file]);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    } elseif ($action === 'list_capsule_images') {
        $target = $use_all ? 'all' : $theme;
        $base = dirname(__DIR__, 2) . '/storefront/images/capsules/' . $target;
        $images = [];
        if (is_dir($base)) {
            foreach (glob($base . '/*.png') as $f) {
                $images[] = $target . '/' . basename($f);
            }
        }
        echo json_encode(['status' => 'ok', 'images' => $images]);
        exit;
    } elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $db->prepare('DELETE FROM storefront_capsule_items WHERE id=?')->execute([$id]);
        echo json_encode(['status' => 'ok']);
        exit;
    } elseif ($action === 'reorder') {
        $order = $_POST['order'] ?? [];
        foreach ($order as $i => $cid) {
            $db->prepare('UPDATE storefront_capsule_items SET ord=? WHERE id=?')->execute([$i + 1, (int)$cid]);
        }
        echo json_encode(['status' => 'ok']);
        exit;
    }
    echo json_encode(['status' => 'error']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare('SELECT i.*, a.name FROM storefront_capsule_items i LEFT JOIN store_apps a ON i.appid=a.appid WHERE i.id=?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    if ($row) {
        echo json_encode(['status' => 'ok', 'id' => (int)$row['id'], 'type' => $row['type'], 'appid' => $row['appid'], 'price' => $row['price'], 'image' => $row['image_path'], 'title' => $row['title'], 'content' => $row['content'], 'name' => $row['name']]);
    } else {
        echo json_encode(['status' => 'error']);
    }
    exit;
}

if ($use_all) {
    $rows = $db->query('SELECT i.*, a.name FROM storefront_capsule_items i LEFT JOIN store_apps a ON i.appid=a.appid WHERE i.theme IS NULL ORDER BY i.ord')->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $db->prepare('SELECT i.*, a.name FROM storefront_capsule_items i LEFT JOIN store_apps a ON i.appid=a.appid WHERE i.theme=? ORDER BY i.ord');
    $stmt->execute([$theme]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<h2>Index Capsule Management</h2>
<div id="capsule-grid" class="capsule-grid">
<?php foreach ($rows as $r): ?>
  <div class="capsule <?php echo htmlspecialchars($r['type']); ?>" data-id="<?php echo $r['id']; ?>" data-appid="<?php echo $r['appid']; ?>" data-price="<?php echo htmlspecialchars($r['price']); ?>" data-type="<?php echo htmlspecialchars($r['type']); ?>" data-image="<?php echo htmlspecialchars($r['image_path']); ?>" data-title="<?php echo htmlspecialchars($r['title'] ?? '', ENT_QUOTES); ?>" data-content="<?php echo htmlspecialchars($r['content'] ?? '', ENT_QUOTES); ?>">
    <span class="handle">&#9776;</span>
    <button type="button" class="delete-circle">&times;</button>
    <?php if ($r['image_path']): ?><img src="<?php echo htmlspecialchars('../storefront/images/capsules/' . $r['image_path']); ?>" alt="">
    <?php endif; ?>
    <?php if (!empty($r['content'])): ?>
      <div class="cap-content"><?php echo $r['content']; ?></div>
    <?php endif; ?>
    <div class="cap-name"><?php echo htmlspecialchars($r['name'] ?: ($r['title'] ?? ''), ENT_QUOTES); ?></div>
    <button type="button" class="edit btn btn-small">Edit</button>
  </div>
<?php endforeach; ?>
</div>
<button type="button" id="add-capsule" class="btn btn-secondary">Add Capsule</button>
<button type="button" id="add-tabbed" class="btn btn-secondary">Add Tabbed Capsule</button>

<div id="capsule-modal" title="Capsule" style="display:none;">
  <form id="capsule-form">
    <input type="hidden" name="id" id="cap-id">
    <input type="hidden" name="current_image" id="cap-current-image">
    <div class="form-row">
      <label for="cap-type">Capsule Type</label>
      <select name="type" id="cap-type">
        <option value="large">Large Capsule</option>
        <option value="small">Small Capsule</option>
        <option value="tabbed">Tabbed Capsule</option>
        <option value="multi-large">Multi-App Large Capsule</option>
        <option value="gear">GetTheGear</option>
        <option value="free">Freestuff/Custom</option>
      </select>
    </div>
    <div class="form-row" id="row-name">
      <label for="cap-name">Game Name</label>
      <input type="text" name="name" id="cap-name">
    </div>
    <div class="form-row" id="row-appid">
      <label for="cap-appid">Game ID</label>
      <input type="text" name="appid" id="cap-appid">
    </div>
    <div class="form-row" id="row-price">
      <label for="cap-price">Game Price</label>
      <input type="text" name="price" id="cap-price">
    </div>
    <div class="form-row" id="row-image">
      <label for="cap-image">Game Capsule Image</label>
      <input type="file" name="image" id="cap-image" accept="image/png">
      <img id="cap-preview" src="" alt="Preview" style="max-width:100%;display:none;margin-top:5px;">
    </div>
    <div class="form-row" id="row-title" style="display:none;">
      <label for="cap-title">Capsule Title</label>
      <input type="text" name="title" id="cap-title">
    </div>
    <div class="form-row" id="row-content" style="display:none;">
      <label for="cap-content">Content</label>
      <div id="cap-content" class="wysiwyg" contenteditable="true"></div>
      <textarea name="content" id="cap-content-hidden" style="display:none;"></textarea>
    </div>
    <div class="form-row">
      <label>Themes</label>
      <div id="cap-themes">
        <?php foreach($themesList as $th): ?>
          <label><input type="checkbox" name="themes[]" value="<?php echo $th; ?>" <?php echo $th === $theme ? 'checked' : ''; ?>> <?php echo $th; ?></label>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="form-row" id="row-multi-apps" style="display:none;">
      <label>Apps in Multi-Capsule</label>
      <div id="multi-apps-list"></div>
      <button type="button" id="add-multi-app" class="btn btn-small">+ Add App</button>
    </div>
    <div class="form-row" style="text-align:right;">
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="button" id="cap-cancel" class="btn">Cancel</button>
    </div>
  </form>
</div>
<div id="multi-app-modal" title="Add App to Multi-Capsule" style="display:none;">
  <form id="multi-app-form">
    <input type="hidden" id="multi-group" name="group">
    <div class="form-row">
      <label for="multi-appid">Application</label>
      <select name="appid" id="multi-appid">
        <?php foreach($apps as $a): ?>
        <option value="<?php echo $a['appid']; ?>"><?php echo $a['appid'].' - '.htmlspecialchars($a['name']); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-row">
      <label for="multi-image-path">Image Path</label>
      <input type="text" name="image_path" id="multi-image-path">
    </div>
    <div class="form-row">
      <label for="multi-price">Price</label>
      <input type="text" name="price" id="multi-price">
    </div>
    <div class="form-row" style="text-align:right;">
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="button" id="multi-cancel" class="btn">Cancel</button>
    </div>
  </form>
</div>
<div id="tabbed-modal" title="Tabbed Capsule" style="display:none;">
  <form id="tabbed-form">
    <input type="hidden" id="tabbed-id">
    <div id="tabs-config"></div>
    <button type="button" id="add-tab" class="btn btn-small">Add Tab</button>
    <div class="form-row" style="text-align:right;margin-top:10px;">
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="button" id="tabbed-cancel" class="btn">Cancel</button>
    </div>
  </form>
</div>
<?php
$cssDir = dirname(__DIR__, 2) . '/themes/' . $theme . '/css';
$cssFiles = [
    'steampowered.css',
    'styles_global.css',
    'styles_capsules.css',
    'styles_content.css',
    'styles_home.css'
];
foreach ($cssFiles as $css) {
    $abs = $cssDir . '/' . $css;
    if (is_file($abs)) {
        echo '<link rel="stylesheet" href="../themes/' . htmlspecialchars($theme) . '/css/' . htmlspecialchars($css) . '">';
    }
}
?>
<link rel="stylesheet" href="css/image-picker.css">
<script src="js/image-picker.min.js"></script>
<style>
  .capsule-grid{display:flex;flex-wrap:wrap;gap:10px;margin-bottom:10px;}
  .capsule{border:1px solid #ccc;padding:5px;position:relative;text-align:left;transform:scale(0.8);transform-origin:top left;overflow:hidden;}
  .capsule.small{flex:0 0 calc(50% - 10px);width:231px;}
  .capsule.large,.capsule.tabbed,.capsule.multi-large{flex:0 0 100%;width:467px;}
  .capsule.gear,.capsule.free{flex:0 0 <?php echo $gearLarge ? '100%' : 'calc(50% - 10px)'; ?>;width:<?php echo $gearLarge ? 467 : 231; ?>px;}
  .capsule .handle{cursor:move;position:absolute;top:5px;left:5px;}
  .capsule .delete-circle{position:absolute;top:5px;right:5px;width:20px;height:20px;border-radius:50%;border:1px solid #666;background:#fff;color:#666;line-height:18px;padding:0;cursor:pointer;}
  .capsule img{max-width:100%;height:auto;display:block;margin:0 auto 5px;}
  .cap-content{margin-bottom:5px;}
  .capsule .btn{margin:2px;}
  #row-content{align-items:flex-start;}
  .wysiwyg{border:1px solid #ccc;min-height:120px;padding:5px;overflow:auto;flex:1;}
  #tabbed-form .tab-block{border:1px solid #ccc;padding:5px;margin-bottom:10px;}
  #tabbed-form .tab-header{display:flex;align-items:center;gap:5px;margin-bottom:5px;}
  #tabbed-form .games{display:flex;flex-wrap:wrap;gap:10px;}
  #tabbed-form .game{border:1px solid #ccc;padding:5px;flex:0 0 calc(50% - 10px);}
  #tabbed-form .game img{max-width:100%;height:auto;margin-bottom:5px;display:none;}
  .multi-app-item{padding:5px;border:1px solid #ddd;margin-bottom:5px;display:flex;justify-content:space-between;align-items:center;}
  #add-multi-placeholder{color:#666;font-style:italic;padding:10px;text-align:center;}
  body{color:#000;}
</style>
<script>
$(function(){
  var currentTheme = '<?php echo $theme; ?>';
  var existingImages = [];
  $.post('capsule_management_2006.php',{action:'list_capsule_images'},function(r){
    if(r.status==='ok'){ existingImages = r.images; }
  },'json');
  function fixPaths(el){
    el.find('[src],[href]').each(function(){
      var $el=$(this);
      var attr=$el.is('link')||$el.is('a')?'href':'src';
      var val=$el.attr(attr);
      if(val && !val.match(/^(?:https?:|\/|\.\.\/)/)){
        $el.attr(attr,'../'+val);
      }
    });
  }
  function restorePaths(el){
    el.find('[src],[href]').each(function(){
      var $el=$(this);
      var attr=$el.is('link')||$el.is('a')?'href':'src';
      var val=$el.attr(attr);
      if(val && val.indexOf('../')===0){
        $el.attr(attr,val.substring(3));
      }
    });
  }
  $('#capsule-grid .cap-content').each(function(){fixPaths($(this));});
  function updateOrder(){
    var order=[];
    $('#capsule-grid .capsule').each(function(){order.push($(this).data('id'));});
    $.post('capsule_management_2006.php',{action:'reorder',order:order});
  }
  Sortable.create(document.getElementById('capsule-grid'),{
    handle:'.handle',
    animation:150,
    onEnd:function(){updateOrder();}
  });
  function toggleFields(t){
    if(t==='gear'||t==='free'){
      $('#row-name,#row-appid,#row-price,#row-image,#row-multi-apps').hide();
      $('#row-title,#row-content').show();
    }else if(t==='multi-large'){
      $('#row-name,#row-appid,#row-price,#row-image,#row-title,#row-content').hide();
      $('#row-multi-apps').show();
    }else{
      $('#row-name,#row-appid,#row-price,#row-image').show();
      $('#row-title,#row-content,#row-multi-apps').hide();
    }
  }
  function openModal(data){
    $('#cap-id').val(data.id||'');
    $('#cap-type').val(data.type||'small');
    $('#cap-name').val(data.name||'');
    $('#cap-appid').val(data.appid||'');
    $('#cap-price').val(data.price||'');
    $('#cap-current-image').val(data.image||'');
    $('#cap-title').val(data.title||'');
    $('#cap-content').html(data.content||'');
    fixPaths($('#cap-content'));
    $('#cap-themes input').prop('checked',false);
    $('#cap-themes input[value="'+currentTheme+'"]').prop('checked',true);
    toggleFields(data.type||'small');
    if(data.type === 'multi-large') {
      currentGroup = data.image || '';
      loadMultiApps(currentGroup);
    }
    if(data.image && data.type !== 'multi-large'){
      $('#cap-preview').attr('src','../storefront/images/capsules/'+data.image).show();
    }else{
      $('#cap-preview').hide();
    }
    $('#capsule-modal').dialog({modal:true,width:500});
  }
  $('#cap-type').on('change',function(){toggleFields(this.value);});
  // Multi-app functionality
  var currentGroup = '';
  function loadMultiApps(group) {
    if (!group) return;
    $.post('capsule_management_2006.php', {action: 'get_multi_apps', group: group}, function(r) {
      if (r.status === 'ok') {
        var html = '';
        r.apps.forEach(function(app, i) {
          html += '<div class="multi-app-item" data-id="' + app.id + '">' + 
                  app.appid + ' - ' + app.name + 
                  ' <button type="button" class="btn btn-small remove-multi-app" data-id="' + app.id + '">−</button></div>';
        });
        if (r.apps.length < 7) {
          html += '<div id="add-multi-placeholder">Click + Add App to add more games</div>';
        }
        $('#multi-apps-list').html(html);
        $('#add-multi-app').toggle(r.apps.length < 7);
      }
    }, 'json');
  }
  
  function openMultiModal(group) {
    currentGroup = group;
    $('#multi-group').val(group);
    $('#multi-appid').val('');
    $('#multi-image-path').val('');
    $('#multi-price').val('');
    $('#multi-app-modal').dialog({modal: true, width: 400});
  }

  $('#add-multi-app').on('click', function() {
    openMultiModal(currentGroup);
  });
  
  $('#multi-cancel').on('click', function() {
    $('#multi-app-modal').dialog('close');
  });
  
  $('#multi-app-form').on('submit', function(e) {
    e.preventDefault();
    var data = {
      action: 'add_multi_app',
      group: $('#multi-group').val(),
      appid: $('#multi-appid').val(),
      image_path: $('#multi-image-path').val(),
      price: $('#multi-price').val()
    };
    $.post('capsule_management_2006.php', data, function(r) {
      if (r.status === 'ok') {
        loadMultiApps(currentGroup);
        $('#multi-app-modal').dialog('close');
      } else {
        alert(r.message || 'Error adding app');
      }
    }, 'json');
  });
  
  $('#multi-apps-list').on('click', '.remove-multi-app', function() {
    var id = $(this).data('id');
    $.post('capsule_management_2006.php', {action: 'remove_multi_app', id: id}, function(r) {
      if (r.status === 'ok') {
        loadMultiApps(currentGroup);
      }
    }, 'json');
  });

  $('#add-capsule').on('click',function(e){e.preventDefault();openModal({});});
  $('#add-tabbed').on('click',function(e){e.preventDefault();openTabbedModal({});});
  $('#capsule-grid').on('click','.edit',function(e){
    e.preventDefault();
    var c=$(this).closest('.capsule');
    var id=c.data('id');
    if(c.data('type')==='tabbed'){
      openTabbedModal({id:id});
    }else{
      $.getJSON('capsule_management_2006.php',{id:id},function(r){
        if(r.status==='ok'){
          openModal({id:r.id,type:r.type,name:r.name,appid:r.appid,price:r.price,image:r.image,title:r.title,content:r.content});
        }
      });
    }
  });
  $('#capsule-grid').on('click','.delete-circle',function(){
    if(!confirm('Delete this capsule?')) return;
    var c=$(this).closest('.capsule');
    $.post('capsule_management_2006.php',{action:'delete',id:c.data('id')},function(){c.remove();updateOrder();},'json');
  });
  $('#cap-image').on('change',function(){
    var f=this.files[0];
    if(f){
      var r=new FileReader();
      r.onload=function(e){$('#cap-preview').attr('src',e.target.result).show();};
      r.readAsDataURL(f);
    }
  });
  $('#cap-cancel').on('click',function(){$('#capsule-modal').dialog('close');});
  $('#capsule-form').on('submit',function(e){
    e.preventDefault();
    var type = $('#cap-type').val();
    if (type === 'multi-large') {
      var data = {
        action: 'save_multi_large',
        id: $('#cap-id').val()
      };
      $.post('capsule_management_2006.php', data, function(r) {
        if (r.status === 'ok') {
          var id = $('#cap-id').val();
          currentGroup = r.group;
          if (!id) {
            var html = '<div class="capsule multi-large" data-id="' + r.id + '" data-type="multi-large" data-image="' + r.group + '">';
            html += '<span class="handle">&#9776;</span><button type="button" class="delete-circle">&times;</button>';
            html += '<div class="cap-name">Multi-App Large Capsule</div><button type="button" class="edit btn btn-small">Edit</button></div>';
            var el = $(html).data({id: r.id, type: 'multi-large', image: r.group});
            $('#capsule-grid').append(el);
          }
          $('#capsule-modal').dialog('close');
        }
      }, 'json');
      return;
    }
    restorePaths($('#cap-content'));
    $('#cap-content-hidden').val($('#cap-content').html());
    var fd=new FormData(this);
    fd.append('action','save');
    $.ajax({url:'capsule_management_2006.php',method:'POST',data:fd,processData:false,contentType:false,dataType:'json',success:function(r){
      if(r.status==='ok'){
        var id=$('#cap-id').val();
        var img=r.image;var name=$('#cap-name').val();var appid=$('#cap-appid').val();var price=$('#cap-price').val();var type=r.type;var title=$('#cap-title').val();var content=$('#cap-content').html();
        if(id){
          var c=$('#capsule-grid .capsule[data-id="'+id+'"]');
          c.data({appid:appid,price:price,type:type,image:img,title:title,content:content});
          if(img){
            if(c.find('img').length){c.find('img').attr('src','../storefront/images/capsules/'+img);}else{c.prepend('<img src="../storefront/images/capsules/'+img+'" alt="">');}
          }else{
            c.find('img').remove();
          }
          c.removeClass('small large gear free').addClass(type);
          c.find('.cap-name').text(type==='gear'||type==='free'?title:name);
          if(content){
            if(c.find('.cap-content').length){c.find('.cap-content').html(content);}else{c.find('.cap-name').before('<div class="cap-content">'+content+'</div>');}
            fixPaths(c.find('.cap-content'));
          }else{
            c.find('.cap-content').remove();
          }
        }else{
          var el=$('<div class="capsule '+type+'" data-id="'+r.id+'" data-appid="'+appid+'" data-price="'+price+'" data-type="'+type+'" data-image="'+img+'"></div>');
          el.append('<span class="handle">&#9776;</span><button type="button" class="delete-circle">&times;</button>');
          if(img){el.append('<img src="../storefront/images/capsules/'+img+'" alt="">');}
          if(content){el.append('<div class="cap-content">'+content+'</div>');}
          el.append('<div class="cap-name">'+$('<div>').text(type==='gear'||type==='free'?title:name).html()+'</div><button type="button" class="edit btn btn-small">Edit</button>');
          fixPaths(el.find('.cap-content'));
          el.data({appid:appid,price:price,type:type,image:img,title:title,content:content});
          $('#capsule-grid').append(el);
        }
        $('#capsule-modal').dialog('close');
        $('#capsule-form')[0].reset();
        $('#cap-preview').hide();
        $('#cap-content').empty();
      }
    }});
  });

  var tabCount=0;
  function buildImageOptions(selected){
    var opts='<option value="">-- Select Image --</option>';
    existingImages.forEach(function(img){
      opts+='<option data-img-src="../storefront/images/capsules/'+img+'" value="'+img+'"'+(img===selected?' selected':'')+'>'+img+'</option>';
    });
    return opts;
  }
  function addGame(block,data){
    var games=block.find('.game').length;
    if(games>=10) return;
    var imgPath=data&&data.image?data.image:'';
    var html='<div class="game"><input type="hidden" class="game-img-path" value="'+imgPath+'">'
      +'<div><label>Existing Image<select class="game-existing">'+buildImageOptions(imgPath)+'</select></label></div>'
      +'<div><label>Upload<input type="file" class="game-image" accept="image/png"></label><img class="preview"'+(imgPath?' src="../storefront/images/capsules/'+imgPath+'" style="display:block;"':'')+'></div>'
      +'<div><label>Name<input type="text" class="game-name" value="'+(data&&data.name?data.name:'')+'"></label></div>'
      +'<div><label>Game ID<input type="text" class="game-appid" value="'+(data&&data.appid?data.appid:'')+'"></label></div>'
      +'<div><label>Price<input type="text" class="game-price" value="'+(data&&data.price?data.price:'')+'"></label></div>'
      +'<button type="button" class="btn btn-small remove-game">Remove</button></div>';
    var el=$(html);
    block.find('.games').append(el);
    el.find('select.game-existing').imagepicker();
  }
  function addTab(index,data){
    if(tabCount>=5) return; tabCount++;
    var html='<div class="tab-block" data-index="'+index+'"><div class="tab-header"><label>Tab Title</label><input type="text" class="tab-title" value="'+(data&&data.title?data.title:'')+'"><button type="button" class="btn btn-small add-game">Add Game</button></div><div class="games"></div></div>';
    var blk=$(html);
    $('#tabs-config').append(blk);
    if(data&&data.games){data.games.forEach(function(g){addGame(blk,g);});}
  }
  function openTabbedModal(data){
    tabCount=0; $('#tabs-config').empty(); $('#tabbed-id').val(data.id||'');
    if(data.id){
      $.post('capsule_management_2006.php',{action:'get_tabbed'},function(r){
        if(r.status==='ok' && r.tabs.length){
          r.tabs.forEach(function(t,i){addTab(i+1,t);});
        }else{
          addTab(1);
        }
        $('#tabbed-modal').dialog({modal:true,width:700});
      },'json');
    }else{
      addTab(1);
      $('#tabbed-modal').dialog({modal:true,width:700});
    }
  }
  $('#add-tab').on('click',function(){addTab(tabCount+1);});
  $('#tabs-config').on('click','.add-game',function(){addGame($(this).closest('.tab-block'));});
  $('#tabs-config').on('click','.remove-game',function(){$(this).closest('.game').remove();});
  $('#tabs-config').on('change','.game-existing',function(){
    var game=$(this).closest('.game');
    var path=$(this).val();
    game.find('.game-img-path').val(path);
    if(path){
      game.find('img.preview').attr('src','../storefront/images/capsules/'+path).show();
    }else{
      game.find('img.preview').hide();
    }
  });
  $('#tabs-config').on('change','.game-image',function(){
    var game=$(this).closest('.game');
    var fd=new FormData(); fd.append('action','upload_game_image'); fd.append('game_image',this.files[0]);
    $.ajax({url:'capsule_management_2006.php',method:'POST',data:fd,processData:false,contentType:false,dataType:'json',success:function(r){
      if(r.status==='ok'){
        existingImages.push(r.path);
        var sel=game.find('select.game-existing');
        sel.append('<option data-img-src="../storefront/images/capsules/'+r.path+'" value="'+r.path+'">'+r.path+'</option>');
        sel.val(r.path).imagepicker();
        game.find('.game-img-path').val(r.path);
        game.find('img.preview').attr('src','../storefront/images/capsules/'+r.path).show();
      }
    }});
  });
  $('#tabbed-cancel').on('click',function(){$('#tabbed-modal').dialog('close');});
  $('#tabbed-form').on('submit',function(e){
    e.preventDefault();
    var fd=new FormData();
    fd.append('action','save_tabbed');
    fd.append('id',$('#tabbed-id').val());
    $('#tabs-config .tab-block').each(function(i){
      fd.append('tabs['+i+'][title]',$(this).find('.tab-title').val());
      $(this).find('.game').each(function(j){
        fd.append('tabs['+i+'][games]['+j+'][appid]',$(this).find('.game-appid').val());
        fd.append('tabs['+i+'][games]['+j+'][name]',$(this).find('.game-name').val());
        fd.append('tabs['+i+'][games]['+j+'][price]',$(this).find('.game-price').val());
        fd.append('tabs['+i+'][games]['+j+'][image]',$(this).find('.game-img-path').val());
      });
    });
    $.ajax({url:'capsule_management_2006.php',method:'POST',data:fd,processData:false,contentType:false,dataType:'json',success:function(r){
      if(r.status==='ok'){
        if(!$('#tabbed-id').val()){
          var el=$('<div class="capsule tabbed" data-id="'+r.id+'" data-type="tabbed"></div>');
          el.append('<span class="handle">&#9776;</span><button type="button" class="delete-circle">&times;</button><div class="cap-name">Tabbed Capsule</div><button type="button" class="edit btn btn-small">Edit</button>');
          $('#capsule-grid').append(el);
        }
        $('#tabbed-modal').dialog('close');
      }
    }});
  });
});
</script>
<?php include 'admin_footer.php'; ?>
