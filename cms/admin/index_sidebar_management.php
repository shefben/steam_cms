<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');

$theme       = cms_get_setting('theme', '2006_v1');
$themes_all  = cms_get_themes();
$themes      = array_values(array_filter($themes_all, fn($t) => (int)substr($t, 0, 4) >= 2006));
$csrf_token  = cms_get_csrf_token();
$db          = cms_get_db();

$builtins = [
    'getsteamnow'      => ['title' => 'GET STEAM NOW',      'html' => '<p>Get Steam Now</p>'],
    'spotlight'        => ['title' => 'SPOTLIGHT',          'html' => '<p>Spotlight content</p>'],
    'findmore'         => ['title' => 'FIND MORE',          'html' => '<p>Find More</p>'],
    'searchbar'        => ['title' => 'SEARCHBAR',          'html' => '<form><input type="text" placeholder="Search"></form>'],
    'latestnews'       => ['title' => 'LATEST NEWS',        'html' => '<p>Latest News</p>'],
    'publishercatalogs'=> ['title' => 'PUBLISHER CATALOGS', 'html' => '<p>Publisher Catalogs</p>'],
    'browsecatalog'    => ['title' => 'BROWSE THE CATALOG', 'html' => '<p>Browse the Catalog</p>'],
    'newonsteam'       => ['title' => 'NEW ON STEAM',       'html' => '{{ new_on_steam_list()|raw }}'],
    'comingsoon'       => ['title' => 'COMING SOON TO STEAM','html' => '<p>Coming Soon</p>'],
];

$existing_sections = [];
try {
    $stmt = $db->query('SELECT section_id,title FROM sidebar_sections ORDER BY title');
    $existing_sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    if ($e->getCode() !== '42S02') {
        throw $e;
    }
}

if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    if (isset($_GET['fetch']) && $_GET['fetch'] === 'html') {
        echo cms_get_sidebar_sections_html($theme, true);
        exit;
    }
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $stmt = $db->prepare('SELECT section_id,title,icon_path,is_collapsible,collapsible_id,has_icicles FROM sidebar_sections WHERE section_id=?');
        $stmt->execute([$id]);
        $section = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($section) {
            $v = $db->prepare('SELECT variant_id,theme_list,html_content FROM sidebar_section_variants WHERE section_id=? ORDER BY variant_id');
            $v->execute([$id]);
            $section['variants'] = $v->fetchAll(PDO::FETCH_ASSOC);
        }
        header('Content-Type: application/json');
        echo json_encode($section);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    if (!cms_verify_csrf($_POST['csrf_token'] ?? '')) {
        http_response_code(400);
        echo 'bad csrf';
        exit;
    }
    $action = $_POST['action'] ?? '';
    if ($action === 'insert_existing') {
        $source = $_POST['source'] ?? '';
        if (str_starts_with($source, 'builtin:')) {
            $key = substr($source, 8);
            if (isset($builtins[$key])) {
                $b = $builtins[$key];
                $stmt = $db->prepare('INSERT INTO sidebar_sections(title,icon_path,sort_order) VALUES(?,?,(SELECT IFNULL(MAX(sort_order),0)+1 FROM sidebar_sections))');
                $stmt->execute([$b['title'], null]);
                $sid = (int)$db->lastInsertId();
                $db->prepare('INSERT INTO sidebar_section_variants(section_id,theme_list,html_content) VALUES(?,?,?)')
                    ->execute([$sid, implode(',', $themes), $b['html']]);
            }
        } elseif (str_starts_with($source, 'section:')) {
            $id = (int)substr($source, 8);
            $stmt = $db->prepare('SELECT title,icon_path,is_collapsible,collapsible_id,has_icicles FROM sidebar_sections WHERE section_id=?');
            $stmt->execute([$id]);
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $db->prepare('INSERT INTO sidebar_sections(title,icon_path,is_collapsible,collapsible_id,has_icicles,sort_order) VALUES(?,?,?,?,?,(SELECT IFNULL(MAX(sort_order),0)+1 FROM sidebar_sections))')
                    ->execute([$row['title'], $row['icon_path'], $row['is_collapsible'], $row['collapsible_id'], $row['has_icicles']]);
                $newId = (int)$db->lastInsertId();
                $v = $db->prepare('SELECT theme_list,html_content FROM sidebar_section_variants WHERE section_id=?');
                $v->execute([$id]);
                $ins = $db->prepare('INSERT INTO sidebar_section_variants(section_id,theme_list,html_content) VALUES(?,?,?)');
                while ($vr = $v->fetch(PDO::FETCH_ASSOC)) {
                    $ins->execute([$newId, $vr['theme_list'], $vr['html_content']]);
                }
            }
        }
        echo 'ok';
        exit;
    }
    if ($action === 'order') {
        $order = $_POST['order'] ?? [];
        $ord = 1;
        $stmt = $db->prepare('UPDATE sidebar_sections SET sort_order=? WHERE section_id=?');
        foreach ($order as $sid) {
            $stmt->execute([$ord++, (int)$sid]);
        }
        echo 'ok';
        exit;
    }
    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $db->prepare('DELETE FROM sidebar_sections WHERE section_id=?')->execute([$id]);
        echo 'ok';
        exit;
    }
    if ($action === 'save') {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $title = trim($_POST['title'] ?? '');
        $icon = trim($_POST['icon'] ?? '');
        $is_collapsible = isset($_POST['collapsible']) ? 1 : 0;
        $collapsible_id = trim($_POST['collapsible_id'] ?? '');
        $has_icicles = isset($_POST['icicles']) ? 1 : 0;
        if ($id) {
            $stmt = $db->prepare('UPDATE sidebar_sections SET title=?,icon_path=?,is_collapsible=?,collapsible_id=?,has_icicles=?,updated_at=NOW() WHERE section_id=?');
            $stmt->execute([$title, $icon, $is_collapsible, $collapsible_id, $has_icicles, $id]);
        } else {
            $stmt = $db->prepare('INSERT INTO sidebar_sections(title,icon_path,is_collapsible,collapsible_id,has_icicles,sort_order) VALUES(?,?,?,?,?,(SELECT IFNULL(MAX(sort_order),0)+1 FROM sidebar_sections))');
            $stmt->execute([$title, $icon, $is_collapsible, $collapsible_id, $has_icicles]);
            $id = (int)$db->lastInsertId();
        }
        $v_ids = $_POST['variant_id'] ?? [];
        $v_themes = $_POST['variant_themes'] ?? [];
        $v_html = $_POST['variant_html'] ?? [];
        $allowed = $themes;
        for ($i = 0; $i < count($v_themes); $i++) {
            $vid = (int)($v_ids[$i] ?? 0);
            $theme_list = array_filter(array_map('trim', explode(',', $v_themes[$i] ?? '')), fn($t) => in_array($t, $allowed, true));
            $html = $v_html[$i] ?? '';
            if ($vid) {
                $stmt = $db->prepare('UPDATE sidebar_section_variants SET theme_list=?,html_content=?,updated_at=NOW() WHERE variant_id=? AND section_id=?');
                $stmt->execute([implode(',', $theme_list), $html, $vid, $id]);
            } else {
                $stmt = $db->prepare('INSERT INTO sidebar_section_variants(section_id,theme_list,html_content) VALUES(?,?,?)');
                $stmt->execute([$id, implode(',', $theme_list), $html]);
            }
        }
        $del = $_POST['delete_variants'] ?? [];
        foreach ($del as $dv) {
            $db->prepare('DELETE FROM sidebar_section_variants WHERE variant_id=? AND section_id=?')->execute([(int)$dv, $id]);
        }
        echo 'ok';
        exit;
    }
}
?>
<link rel="stylesheet" href="../themes/<?php echo $theme; ?>/css/styles_global.css">
<link rel="stylesheet" href="../themes/<?php echo $theme; ?>/css/styles_content.css">
<div id="sidebar-preview" class="rightCol_1">
<?php echo cms_get_sidebar_sections_html($theme, true); ?>
</div>
<button id="add-content" class="btn btn-primary">Add Content</button>
<div id="content-modal" style="display:none;" title="Add Content">
    <label for="action-select">Action</label>
    <select id="action-select">
        <option value="existing">Existing Content Sections</option>
        <option value="add">Add New Content Section</option>
        <option value="edit">Edit Pre-Existing Section Content</option>
    </select>

    <div id="existing-container">
        <label for="existing-select">Section</label>
        <select id="existing-select">
            <option value="">Select...</option>
<?php foreach ($builtins as $key => $info): ?>
            <option value="builtin:<?php echo htmlspecialchars($key); ?>">Built-in: <?php echo htmlspecialchars($info['title']); ?></option>
<?php endforeach; ?>
<?php foreach ($existing_sections as $sec): ?>
            <option value="section:<?php echo (int)$sec['section_id']; ?>"><?php echo htmlspecialchars($sec['title']); ?></option>
<?php endforeach; ?>
        </select>
    </div>

    <div id="edit-container" style="display:none;">
        <label for="edit-select">Section</label>
        <select id="edit-select">
            <option value="">Select...</option>
<?php foreach ($existing_sections as $sec): ?>
            <option value="<?php echo (int)$sec['section_id']; ?>"><?php echo htmlspecialchars($sec['title']); ?></option>
<?php endforeach; ?>
        </select>
    </div>

    <form id="section-form" style="display:none;">
        <input type="hidden" id="section-id" name="id">
        <label>Sidebar Title <input type="text" id="section-title" name="title" required></label>
        <label>Header Icon <input type="text" id="section-icon" name="icon"></label>
        <label><input type="checkbox" id="section-collapsible" name="collapsible"> Collapsible</label>
        <div id="collapsible-id-field" style="display:none;"><label>Collapsible Content ID <input type="text" id="section-cid" name="collapsible_id"></label></div>
        <label><input type="checkbox" id="section-icicles" name="icicles"> Icicles</label>
        <div id="variants-container"></div>
        <button type="button" id="add-variant" class="btn">+ Add New Version HTML</button>
    </form>

    <button id="save-section" class="btn btn-primary" style="display:none;">Save</button>
    <button id="cancel-modal" class="btn">Cancel</button>
</div>
<script>
var CSRF_TOKEN = <?php echo json_encode($csrf_token); ?>;
var themes = <?php echo json_encode($themes); ?>;
var deletedVariants = [];
function variantBlock(id, themeList, html){
    var block = $('<div class="variant-block"></div>');
    block.append('<input type="hidden" class="variant-id" value="'+(id||'')+'">');
    var checks = $('<div class="theme-checks"></div>');
    themes.forEach(function(t){
        var chk = $('<label><input type="checkbox" class="theme-check" value="'+t+'"> '+t+'</label>');
        if(themeList && themeList.indexOf(t) >= 0){ chk.find('input').prop('checked', true); }
        checks.append(chk);
    });
    block.append(checks);
    var editor = $('<div class="wysiwyg" contenteditable="true"></div>').html(html||'');
    block.append(editor);
    var del = $('<button type="button" class="btn delete-variant">Remove Variant</button>');
    block.append(del);
    return block;
}
function addVariant(id, themeList, html){
    $('#variants-container').append(variantBlock(id, themeList, html));
}
function resetForm(){
    deletedVariants = [];
    $('#section-form')[0].reset();
    $('#variants-container').empty();
    $('#section-id').val('');
    $('#collapsible-id-field').hide();
}
function refreshPreview(){
    $('#sidebar-preview').load('index_sidebar_management.php?ajax=1&fetch=html', setupPreview);
}
function setupPreview(){
    new Sortable(document.getElementById('sidebar-preview'), {handle:'h1', onEnd: saveOrder});
}
function saveOrder(){
    var order = [];
    $('#sidebar-preview .sidebar-section').each(function(){ order.push($(this).data('id')); });
    $.post('index_sidebar_management.php', {ajax:1,action:'order',order:order,csrf_token:CSRF_TOKEN});
}
$(function(){
    setupPreview();
    $('#add-content').on('click', function(){
        resetForm();
        $('#action-select').val('existing').trigger('change');
        $('#content-modal').show();
    });
    $('#cancel-modal').on('click', function(){ $('#content-modal').hide(); });
    $('#action-select').on('change', function(){
        var val = $(this).val();
        $('#existing-container').toggle(val==='existing');
        $('#edit-container').toggle(val==='edit');
        $('#section-form').toggle(val==='add' || val==='edit');
        $('#save-section').toggle(val==='add' || val==='edit');
    }).trigger('change');
    $('#existing-select').on('change', function(){
        var val = $(this).val();
        if(!val) return;
        $.post('index_sidebar_management.php', {ajax:1,action:'insert_existing',source:val,csrf_token:CSRF_TOKEN}, function(){
            refreshPreview();
            $('#content-modal').hide();
            $('#existing-select').val('');
        });
    });
    $('#edit-select').on('change', function(){
        var id = $(this).val();
        if(!id) return;
        resetForm();
        $.getJSON('index_sidebar_management.php', {ajax:1,id:id}, function(sec){
            $('#section-id').val(sec.section_id);
            $('#section-title').val(sec.title);
            $('#section-icon').val(sec.icon_path);
            if(sec.is_collapsible==1){ $('#section-collapsible').prop('checked',true); $('#collapsible-id-field').show(); $('#section-cid').val(sec.collapsible_id); }
            if(sec.has_icicles==1){ $('#section-icicles').prop('checked',true); }
            if(sec.variants){ sec.variants.forEach(function(v){ addVariant(v.variant_id, v.theme_list ? v.theme_list.split(',') : [], v.html_content); }); }
            $('#section-form').show();
            $('#save-section').show();
        });
    });
    $('#section-collapsible').on('change', function(){ $('#collapsible-id-field').toggle(this.checked); });
    $('#add-variant').on('click', function(){ addVariant(0, [], ''); });
    $('#variants-container').on('click', '.delete-variant', function(){
        var vid = $(this).closest('.variant-block').find('.variant-id').val();
        if(vid){ deletedVariants.push(vid); }
        $(this).closest('.variant-block').remove();
    });
    $('#save-section').on('click', function(){
        var data = {ajax:1,action:'save',csrf_token:CSRF_TOKEN};
        data.id = $('#section-id').val();
        data.title = $('#section-title').val();
        data.icon = $('#section-icon').val();
        if($('#section-collapsible').is(':checked')){ data.collapsible = 1; data.collapsible_id = $('#section-cid').val(); }
        if($('#section-icicles').is(':checked')){ data.icicles = 1; }
        data['variant_id'] = [];
        data['variant_themes'] = [];
        data['variant_html'] = [];
        $('#variants-container .variant-block').each(function(){
            data['variant_id'].push($(this).find('.variant-id').val());
            var tlist = [];
            $(this).find('.theme-check:checked').each(function(){ tlist.push($(this).val()); });
            data['variant_themes'].push(tlist.join(','));
            data['variant_html'].push($(this).find('.wysiwyg').html());
        });
        data['delete_variants'] = deletedVariants;
        $.post('index_sidebar_management.php', data, function(){
            refreshPreview();
            $('#content-modal').hide();
        });
    });
    $('#sidebar-preview').on('click', '.edit-section', function(){
        var id = $(this).data('id');
        $('#action-select').val('edit').trigger('change');
        $('#edit-select').val(id).trigger('change');
        $('#content-modal').show();
    });
    $('#sidebar-preview').on('click', '.delete-section', function(){
        if(!confirm('Delete section?')) return;
        var id = $(this).data('id');
        $.post('index_sidebar_management.php', {ajax:1,action:'delete',id:id,csrf_token:CSRF_TOKEN}, function(){ refreshPreview(); });
    });
});
</script>
<style>
#content-modal{background:#fff;border:1px solid #333;padding:10px;position:fixed;top:10%;left:50%;transform:translateX(-50%);z-index:1000;width:600px;}
#content-modal label{display:block;margin-top:5px;}
.variant-block{border:1px solid #ccc;padding:5px;margin-top:8px;}
.variant-block .theme-checks label{margin-right:6px;}
.section-controls{text-align:right;}
.section-controls button{margin-left:4px;}
.wysiwyg{border:1px solid #ccc;min-height:80px;padding:4px;margin-top:4px;}
</style>
<?php require_once 'admin_footer.php'; ?>
