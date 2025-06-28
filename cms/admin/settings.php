<?php
require_once 'admin_header.php';
cms_require_permission('manage_settings');
$site_title = cms_get_setting('site_title','Steam');
$smtp_host = cms_get_setting('smtp_host','');
$smtp_port = cms_get_setting('smtp_port','');
$smtp_user = cms_get_setting('smtp_user','');
$smtp_pass = cms_get_setting('smtp_pass','');
$admin_theme = cms_get_setting('admin_theme','default');
$no_header_pages = cms_get_setting('no_header_pages','');
$header_bar_pages = cms_get_setting('header_bar_pages','');
$no_footer_pages = cms_get_setting('no_footer_pages','');
$footer_html = cms_get_setting('footer_html','');
$favicon = cms_get_setting('favicon','/favicon.ico');
$data_json = cms_get_setting('header_config',null);
$header_data = $data_json?json_decode($data_json,true):['logo'=>'','buttons'=>[]];
if(!$header_data) $header_data=['logo'=>'','buttons'=>[]];
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
    cms_set_setting('no_header_pages', trim($_POST['no_header_pages']));
    cms_set_setting('header_bar_pages', trim($_POST['header_bar_pages']));
    cms_set_setting('no_footer_pages', trim($_POST['no_footer_pages']));
    cms_set_setting('footer_html',$_POST['footer_html']);
    if(isset($_FILES['favicon']) && is_uploaded_file($_FILES['favicon']['tmp_name'])){
        $path = __DIR__.'/../content/favicon.ico';
        move_uploaded_file($_FILES['favicon']['tmp_name'],$path);
        cms_set_setting('favicon','/cms/content/favicon.ico');
        $favicon = '/cms/content/favicon.ico';
    }
    $logo = trim($_POST['logo']);
    $buttons = $_POST['buttons'] ?? [];
    $out = [];
    foreach($buttons as $b){
        if(isset($b['delete'])) continue;
        if(trim($b['url'])=='' && trim($b['img'])=='') continue;
        $out[] = [
            'url'=>trim($b['url']),
            'img'=>trim($b['img']),
            'hover'=>trim($b['hover']),
            'alt'=>trim($b['alt'])
        ];
    }
    cms_set_setting('header_config', json_encode(['logo'=>$logo,'buttons'=>$out]));
    echo '<p>Settings saved.</p>';
    $site_title = trim($_POST['site_title']);
    $smtp_host = trim($_POST['smtp_host']);
    $smtp_port = trim($_POST['smtp_port']);
    $smtp_user = trim($_POST['smtp_user']);
    $smtp_pass = trim($_POST['smtp_pass']);
    $admin_theme = $_POST['admin_theme'];
    $no_header_pages = trim($_POST['no_header_pages']);
    $header_bar_pages = trim($_POST['header_bar_pages']);
    $no_footer_pages = trim($_POST['no_footer_pages']);
    $footer_html = $_POST['footer_html'];
    $header_data = ['logo'=>$logo,'buttons'=>$out];
}
?>
<h2>Site Settings</h2>
<form method="post" enctype="multipart/form-data">
Site Title: <input type="text" name="site_title" value="<?php echo htmlspecialchars($site_title); ?>"><br><br>
Admin Theme: <select name="admin_theme">
<?php foreach($themes as $t): ?>
<option value="<?php echo htmlspecialchars($t); ?>" <?php echo $t==$admin_theme?'selected':''; ?>><?php echo htmlspecialchars($t); ?></option>
<?php endforeach; ?>
</select><br><br>
SMTP Host: <input type="text" name="smtp_host" value="<?php echo htmlspecialchars($smtp_host); ?>"><br>
SMTP Port: <input type="text" name="smtp_port" value="<?php echo htmlspecialchars($smtp_port); ?>"><br>
SMTP User: <input type="text" name="smtp_user" value="<?php echo htmlspecialchars($smtp_user); ?>"><br>
SMTP Password: <input type="password" name="smtp_pass" value="<?php echo htmlspecialchars($smtp_pass); ?>"><br><br>
Favicon: <img src="<?php echo htmlspecialchars($favicon); ?>" alt="favicon"> <input type="file" name="favicon" accept="image/x-icon"><br><br>
Pages without header bar (one per line):<br>
<textarea name="no_header_pages" style="width:100%;height:60px;"><?php echo htmlspecialchars($no_header_pages); ?></textarea><br>
Header bar only pages (one per line):<br>
<textarea name="header_bar_pages" style="width:100%;height:60px;"><?php echo htmlspecialchars($header_bar_pages); ?></textarea><br>
Pages without footer (one per line):<br>
<textarea name="no_footer_pages" style="width:100%;height:60px;"><?php echo htmlspecialchars($no_footer_pages); ?></textarea><br>
<h3>Header Configuration</h3>
<p>Current logo:</p>
<img src="<?php echo htmlspecialchars($header_data['logo']); ?>" alt="logo"><br>
<a href="logo.php">Upload new logo</a><br>
Logo URL: <input type="text" name="logo" value="<?php echo htmlspecialchars($header_data['logo']); ?>" size="50"><br><br>
<table border="1" cellpadding="2">
<tr><th>URL</th><th>Image</th><th>Hover</th><th>Alt</th><th>Delete</th></tr>
<?php foreach($header_data['buttons'] as $i=>$b): ?>
<tr>
<td><input type="text" name="buttons[<?php echo $i; ?>][url]" value="<?php echo htmlspecialchars($b['url']); ?>"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][img]" value="<?php echo htmlspecialchars($b['img']); ?>"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][hover]" value="<?php echo htmlspecialchars($b['hover']); ?>"></td>
<td><input type="text" name="buttons[<?php echo $i; ?>][alt]" value="<?php echo htmlspecialchars($b['alt']); ?>"></td>
<td><input type="checkbox" name="buttons[<?php echo $i; ?>][delete]"></td>
</tr>
<?php endforeach; ?>
</table>
<input type="button" value="Add Button" onclick="addButton()"><br><br>
<h3>Footer</h3>
<textarea name="footer_html" style="width:100%;height:200px;"><?php echo htmlspecialchars($footer_html); ?></textarea><br>
<input type="submit" name="save" value="Save">
</form>
<script>
function addButton(){
    var table=document.querySelector('table');
    var idx=table.rows.length-1;
    var row=table.insertRow(-1);
    row.innerHTML='<td><input type="text" name="buttons['+idx+'][url]"></td>'+
        '<td><input type="text" name="buttons['+idx+'][img]"></td>'+
        '<td><input type="text" name="buttons['+idx+'][hover]"></td>'+
        '<td><input type="text" name="buttons['+idx+'][alt]"></td>'+
        '<td><input type="checkbox" name="buttons['+idx+'][delete]"></td>';
}
</script>
<p><a href="index.php">Back</a></p>
<?php include 'admin_footer.php'; ?>
