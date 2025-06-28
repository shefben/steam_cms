<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');
$site_title = cms_get_setting('site_title','Steam');
$smtp_host = cms_get_setting('smtp_host','');
$smtp_port = cms_get_setting('smtp_port','');
$smtp_user = cms_get_setting('smtp_user','');
$smtp_pass = cms_get_setting('smtp_pass','');
$admin_theme = cms_get_setting('admin_theme','default');
$json_nav = cms_get_setting('nav_items', null);
$nav_items = $json_nav ? json_decode($json_nav, true) : ($default_nav ?? []);
if(!$nav_items) $nav_items = $default_nav ?? [];
$favicon = cms_get_setting('favicon','/favicon.ico');
$themes = [];
foreach(glob(dirname(__DIR__,2).'/themes/*_admin',GLOB_ONLYDIR) as $dir){
    $themes[] = basename($dir,'_admin');
}
if(isset($_POST['save'])){
    cms_set_setting('site_title',trim($_POST['site_title']));
    cms_set_setting('smtp_host',trim($_POST['smtp_host']));
    cms_set_setting('smtp_port',trim($_POST['smtp_port']));
    cms_set_setting('smtp_user',trim($_POST['smtp_user']));
    cms_set_setting('smtp_pass',trim($_POST['smtp_pass']));
    cms_set_setting('admin_theme',$_POST['admin_theme']);
    if(isset($_POST['nav_items'])){
        $items = [];
        foreach($_POST['nav_items'] as $it){
            $items[] = [
                'file'=>trim($it['file']),
                'label'=>trim($it['label']),
                'visible'=>isset($it['visible'])?1:0
            ];
        }
        cms_set_setting('nav_items', json_encode($items));
        $nav_items = $items;
    }
    // header and footer settings moved to header_footer.php
    if(isset($_FILES['favicon']) && is_uploaded_file($_FILES['favicon']['tmp_name'])){
        $path = __DIR__.'/../content/favicon.ico';
        move_uploaded_file($_FILES['favicon']['tmp_name'],$path);
        cms_set_setting('favicon','/cms/content/favicon.ico');
        $favicon = '/cms/content/favicon.ico';
    }
    // header navigation settings moved to header_footer.php
    echo '<p>Settings saved.</p>';
    $site_title = trim($_POST['site_title']);
    $smtp_host = trim($_POST['smtp_host']);
    $smtp_port = trim($_POST['smtp_port']);
    $smtp_user = trim($_POST['smtp_user']);
    $smtp_pass = trim($_POST['smtp_pass']);
    $admin_theme = $_POST['admin_theme'];
    // header and footer settings moved to header_footer.php
    // keep nav_items array for redisplay
    $nav_items = $nav_items;
}
?>
<h2>Site Settings</h2>
<form method="post" enctype="multipart/form-data">
Site Title: <input type="text" name="site_title" value="<?php echo htmlspecialchars($site_title); ?>" title="Displayed in browser titles"><br><br>
Admin Theme: <select name="admin_theme" title="Color scheme for the admin panel">
<?php foreach($themes as $t): ?>
<option value="<?php echo htmlspecialchars($t); ?>" <?php echo $t==$admin_theme?'selected':''; ?>><?php echo htmlspecialchars($t); ?></option>
<?php endforeach; ?>
</select><br><br>
SMTP Host: <input type="text" name="smtp_host" value="<?php echo htmlspecialchars($smtp_host); ?>" title="Mail server host"><br>
SMTP Port: <input type="text" name="smtp_port" value="<?php echo htmlspecialchars($smtp_port); ?>" title="Mail server port"><br>
SMTP User: <input type="text" name="smtp_user" value="<?php echo htmlspecialchars($smtp_user); ?>" title="Username for the mail server"><br>
SMTP Password: <input type="password" name="smtp_pass" value="<?php echo htmlspecialchars($smtp_pass); ?>" title="Password for the mail server"><br><br>
Favicon: <img src="<?php echo htmlspecialchars($favicon); ?>" alt="favicon"> <input type="file" name="favicon" accept="image/x-icon" title="Upload a custom site favicon"><br><br>
<h3>Sidebar Navigation</h3>
<table class="data-table" cellpadding="2">
<thead><tr><th>Order</th><th>File</th><th>Label</th><th>Visible</th></tr></thead>
<tbody>
<?php foreach($nav_items as $idx=>$it): ?>
<tr>
<td><?php echo $idx+1; ?></td>
<td><input type="text" name="nav_items[<?php echo $idx; ?>][file]" value="<?php echo htmlspecialchars($it['file']); ?>" title="Relative admin page path"></td>
<td><input type="text" name="nav_items[<?php echo $idx; ?>][label]" value="<?php echo htmlspecialchars($it['label']); ?>" title="Display text in the sidebar"></td>
<td><input type="checkbox" name="nav_items[<?php echo $idx; ?>][visible]" <?php echo !empty($it['visible'])?'checked':''; ?> title="Show this link in the sidebar"></td>
</tr>
<?php endforeach; ?>
</tbody>
</table><br>
<!-- header and footer settings moved to header_footer.php -->
<input type="submit" name="save" value="Save">
</form>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
