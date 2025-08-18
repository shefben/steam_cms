<?php
// Buffer output so we can safely redirect after saving settings
ob_start();
require_once 'admin_header.php';
cms_require_permission('manage_settings');
$site_title = cms_get_setting('site_title','Steam');
$support_email = cms_get_setting('supportemail','');
$smtp_host = cms_get_setting('smtp_host','');
$smtp_port = cms_get_setting('smtp_port','');
$smtp_user = cms_get_setting('smtp_user','');
$smtp_pass = cms_get_setting('smtp_pass','');
$root_path = cms_get_setting('root_path','');
$admin_theme = cms_get_setting('admin_theme','default');
$news_year_only = cms_get_setting('news_year_only','1');
$json_nav = cms_get_setting('nav_items', null);
$nav_items = $json_nav ? json_decode($json_nav, true) : [];
$favicon = cms_get_setting('favicon','/favicon.ico');
$themes = [];
foreach(glob(dirname(__DIR__,2).'/themes/*_admin',GLOB_ONLYDIR) as $dir){
    $themes[] = basename($dir,'_admin');
}
if(isset($_POST['reorder']) && isset($_POST['items'])){
    $items = json_decode($_POST['items'], true) ?: [];
    $clean = [];
    foreach($items as $it){
        $clean[] = [
            'file' => trim($it['file'] ?? ''),
            'label' => trim($it['label'] ?? ''),
            'icon' => trim($it['icon'] ?? ''),
            'visible' => !empty($it['visible']) ? 1 : 0,
            'parent' => trim($it['parent'] ?? '')
        ];
    }
    cms_set_setting('nav_items', json_encode($clean));
    $nav_items = $clean;
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
        ob_end_clean();
        echo 'ok';
    }
    exit;
}
if(isset($_POST['save'])){
    cms_set_setting('site_title',trim($_POST['site_title']));
    cms_set_setting('supportemail',trim($_POST['supportemail']));
    cms_set_setting('smtp_host',trim($_POST['smtp_host']));
    cms_set_setting('smtp_port',trim($_POST['smtp_port']));
    cms_set_setting('smtp_user',trim($_POST['smtp_user']));
    cms_set_setting('smtp_pass',trim($_POST['smtp_pass']));
    cms_set_setting('root_path',trim($_POST['root_path']));
    cms_set_setting('admin_theme',$_POST['admin_theme']);
    cms_set_setting('news_year_only', $_POST['news_year_only']);
    if(isset($_POST['nav_items'])){
        $items = [];
        foreach($_POST['nav_items'] as $it){
            $items[] = [
                'file'=>trim($it['file']),
                'label'=>trim($it['label']),
                'icon'=>trim($it['icon'] ?? ''),
                'visible'=>isset($it['visible'])?1:0,
                'parent'=>trim($it['parent'] ?? '')
            ];
        }
        cms_set_setting('nav_items', json_encode($items));
    }
    // header and footer settings moved to header_footer.php
    if(isset($_FILES['favicon']) && is_uploaded_file($_FILES['favicon']['tmp_name'])){
        $path = __DIR__.'/../content/favicon.ico';
        move_uploaded_file($_FILES['favicon']['tmp_name'],$path);
        cms_set_setting('favicon','/cms/content/favicon.ico');
    }
    // header navigation settings moved to header_footer.php
    cms_admin_log('Updated site settings');
    // redirect to avoid mixed-theme output
    ob_end_clean();
    header('Location: settings.php?saved=1');
    exit;
}
?>
<?php if(isset($_GET['saved'])) echo '<p>Settings saved.</p>'; ?>
<h2>Site Settings <?php echo cms_help_icon('settings','site'); ?></h2>
<form method="post" enctype="multipart/form-data">
Site Title: <input type="text" name="site_title" value="<?php echo htmlspecialchars($site_title); ?>" title="Displayed in browser titles"><br><br>
Admin Theme: <select name="admin_theme" title="Color scheme for the admin panel">
<?php foreach($themes as $t): ?>
<option value="<?php echo htmlspecialchars($t); ?>" <?php echo $t==$admin_theme?'selected':''; ?>><?php echo htmlspecialchars($t); ?></option>
<?php endforeach; ?>
</select><br><br>
Only display news for specific year of theme:
<select name="news_year_only">
    <option value="1" <?php echo $news_year_only==='1'?'selected':''; ?>>Yes</option>
    <option value="0" <?php echo $news_year_only==='0'?'selected':''; ?>>No</option>
</select><br><br>
Support Email Address: <input type="text" name="supportemail" value="<?php echo htmlspecialchars($support_email); ?>" title="Email address for user support"><br><br>
SMTP Host: <input type="text" name="smtp_host" value="<?php echo htmlspecialchars($smtp_host); ?>" title="Mail server host"><br>
SMTP Port: <input type="text" name="smtp_port" value="<?php echo htmlspecialchars($smtp_port); ?>" title="Mail server port"><br>
SMTP User: <input type="text" name="smtp_user" value="<?php echo htmlspecialchars($smtp_user); ?>" title="Username for the mail server"><br>
SMTP Password: <input type="password" name="smtp_pass" value="<?php echo htmlspecialchars($smtp_pass); ?>" title="Password for the mail server"><br><br>
Root Path: <input type="text" name="root_path" value="<?php echo htmlspecialchars($root_path); ?>" title="Prefix for all local links"><br><br>
Favicon: <img src="<?php echo htmlspecialchars($favicon); ?>" alt="favicon"> <input type="file" name="favicon" accept="image/x-icon" title="Upload a custom site favicon"><br><br>
<h3>Sidebar Navigation <?php echo cms_help_icon('settings','sidebar'); ?></h3>
<?php $file_options = array_unique(array_column($nav_items,'file')); ?>
<datalist id="nav-files">
<?php foreach($file_options as $f): ?>
    <option value="<?php echo htmlspecialchars($f); ?>">
<?php endforeach; ?>
</datalist>
<table id="nav-table" class="data-table" cellpadding="2">
<thead>
    <tr><th></th><th>#</th><th>File</th><th>Label</th><th>Icon</th><th>Parent</th><th>Visible</th><th>Remove</th></tr>
</thead>
<tbody id="nav-body">
<?php foreach($nav_items as $idx=>$it): ?>
<tr data-index="<?php echo $idx; ?>">
    <td class="handle">&#9776;</td>
    <td class="order"><?php echo $idx+1; ?></td>
    <td><input type="text" name="nav_items[<?php echo $idx; ?>][file]" value="<?php echo htmlspecialchars($it['file']); ?>" title="Relative admin page path"></td>
    <td><input type="text" name="nav_items[<?php echo $idx; ?>][label]" value="<?php echo htmlspecialchars($it['label']); ?>" title="Display text in the sidebar"></td>
    <td><input type="text" name="nav_items[<?php echo $idx; ?>][icon]" value="<?php echo htmlspecialchars($it['icon'] ?? ''); ?>" style="width:50px" title="Emoji or text icon"></td>
    <td><input type="text" list="nav-files" name="nav_items[<?php echo $idx; ?>][parent]" value="<?php echo htmlspecialchars($it['parent'] ?? ''); ?>" style="width:150px" title="Parent menu file"></td>
    <td><input type="checkbox" name="nav_items[<?php echo $idx; ?>][visible]" <?php echo !empty($it['visible'])?'checked':''; ?> title="Show this link in the sidebar"></td>
    <td><button type="button" class="remove btn btn-small">Remove</button></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<button type="button" id="add-nav-item" class="btn btn-primary">Add Link</button><br><br>
<!-- header and footer settings moved to header_footer.php -->
<input type="submit" name="save" value="Save">
</form>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var tbody=document.getElementById('nav-body');
    function renumber(){
        tbody.querySelectorAll('tr').forEach(function(tr,i){
            tr.querySelector('.order').textContent=i+1;
            tr.querySelectorAll('input').forEach(function(inp){
                var m=inp.name.match(/^nav_items\[\d+\]\[(.+)\]/);
                if(m) inp.name='nav_items['+i+']['+m[1]+']';
            });
        });
    }
    function collect(){
        var items=[];
        tbody.querySelectorAll('tr').forEach(function(tr){
            items.push({
                file:tr.querySelector('input[name$="[file]"]').value,
                label:tr.querySelector('input[name$="[label]"]').value,
                icon:tr.querySelector('input[name$="[icon]"]').value,
                parent:tr.querySelector('input[name$="[parent]"]').value,
                visible:tr.querySelector('input[name$="[visible]"]').checked?1:0
            });
        });
        return items;
    }
    function sendOrder(){
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('items',JSON.stringify(collect()));
        fetch('settings.php',{method:'POST',body:data,headers:{'X-Requested-With':'XMLHttpRequest'}});
    }
    new Sortable(tbody,{handle:'.handle',animation:150,onEnd:function(){renumber();sendOrder();}});
    document.getElementById('add-nav-item').addEventListener('click',function(){
        var idx=tbody.querySelectorAll('tr').length;
        var tr=document.createElement('tr');
        tr.innerHTML='<td class="handle">&#9776;</td>'+
                     '<td class="order">'+(idx+1)+'</td>'+
                    '<td><input type="text" name="nav_items['+idx+'][file]" style="width:150px"></td>'+
                    '<td><input type="text" name="nav_items['+idx+'][label]" style="width:150px"></td>'+
                    '<td><input type="text" name="nav_items['+idx+'][icon]" style="width:50px"></td>'+
                    '<td><input type="text" list="nav-files" name="nav_items['+idx+'][parent]" style="width:150px"></td>'+
                    '<td><input type="checkbox" name="nav_items['+idx+'][visible]" checked></td>'+
                    '<td><button type="button" class="remove btn btn-small">Remove</button></td>';
        tbody.appendChild(tr);
        renumber();
        sendOrder();
    });
    tbody.addEventListener('click',function(e){
        if(e.target.classList.contains('remove')){
            e.preventDefault();
            e.target.closest('tr').remove();
            renumber();
            sendOrder();
        }
    });
});
</script>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
<?php ob_end_flush(); ?>
