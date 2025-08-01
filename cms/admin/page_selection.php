<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$settingKeys = [
    'cafe_signup' => 'cafe_signup_page_2004',
    'cheat_form' => 'cheat_form_page_2004',
    'cd_account' => 'cd_account_page_2004',
    'download' => 'download_page_2004',
    'download_2003_v2' => 'download_page_2003_v2'
];
$current = [
    'cafe_signup' => cms_get_setting($settingKeys['cafe_signup'], '2004_signup_v1'),
    'cheat_form' => cms_get_setting($settingKeys['cheat_form'], '2004_cheat_v1'),
    'cd_account' => cms_get_setting($settingKeys['cd_account'], '2004_cd_v1'),
    'download' => cms_get_setting($settingKeys['download'], '2004_dlv3'),
    'download_2003_v2' => cms_get_setting($settingKeys['download_2003_v2'], '2003_v2_dlv2')
];
if(isset($_POST['save'])){
    foreach($settingKeys as $k=>$key){
        if(isset($_POST[$k])){
            cms_set_setting($key, $_POST[$k]);
        }
    }
    echo '<p>Selections saved.</p>';
    $current = [
        'cafe_signup' => cms_get_setting($settingKeys['cafe_signup'], '2004_signup_v1'),
        'cheat_form' => cms_get_setting($settingKeys['cheat_form'], '2004_cheat_v1'),
        'cd_account' => cms_get_setting($settingKeys['cd_account'], '2004_cd_v1'),
        'download' => cms_get_setting($settingKeys['download'], '2004_dlv3'),
        'download_2003_v2' => cms_get_setting($settingKeys['download_2003_v2'], '2003_v2_dlv2')
    ];
}
?>
<h2>Page Version Management</h2>
<form method="post" id="pageForm">
<div class="page-group">
  <h3>Choose 2004 Cafe Sign-Up template version</h3>
  <div class="page-options">
    <label>
      <input type="radio" name="cafe_signup" value="2004_signup_v1" <?php echo $current['cafe_signup']=='2004_signup_v1'?'checked':''; ?>><br>
      <span>Version 1</span><br>
      <img src="images/2004_cafe_signup_thumbnails/version_1.png" alt="Version 1">
    </label>
    <label>
      <input type="radio" name="cafe_signup" value="2004_signup_v2" <?php echo $current['cafe_signup']=='2004_signup_v2'?'checked':''; ?>><br>
      <span>Version 2</span><br>
      <img src="images/2004_cafe_signup_thumbnails/version_2.png" alt="Version 2">
    </label>
  </div>
</div>
<hr>
<div class="page-group">
  <h3>2004 Cheat Form</h3>
  <div class="page-options">
    <label>
      <input type="radio" name="cheat_form" value="2004_cheat_v1" <?php echo $current['cheat_form']=='2004_cheat_v1'?'checked':''; ?>><br>
      <span>Submission Form</span><br>
      <img src="images/2004_cheat_form/version_1.png" alt="Submission Form">
    </label>
    <label>
      <input type="radio" name="cheat_form" value="2004_cheat_v2" <?php echo $current['cheat_form']=='2004_cheat_v2'?'checked':''; ?>><br>
      <span>Use Troubleshooter</span><br>
      <img src="images/2004_cheat_form/version_2.png" alt="Use Troubleshooter">
    </label>
  </div>
</div>
<hr>
<div class="page-group">
  <h3>2004 CDKey Page</h3>
  <div class="page-options">
    <label>
      <input type="radio" name="cd_account" value="2004_cd_v1" <?php echo $current['cd_account']=='2004_cd_v1'?'checked':''; ?>><br>
      <span>Submission Form</span><br>
      <img src="images/cdkeypage_thumbnails/version_1.png" alt="Submission Form">
    </label>
    <label>
      <input type="radio" name="cd_account" value="2004_cd_v2" <?php echo $current['cd_account']=='2004_cd_v2'?'checked':''; ?>><br>
      <span>Use Troubleshooter</span><br>
      <img src="images/cdkeypage_thumbnails/version_1.png" alt="Use Troubleshooter">
    </label>
  </div>
</div>
<hr>
<div class="page-group">
  <h3>2004 Download Page</h3>
  <div class="page-options">
    <label>
      <input type="radio" name="download" value="2004_dlv1" <?php echo $current['download']=='2004_dlv1'?'checked':''; ?>><br>
      <span>Multi-Game Download Page</span><br>
      <img src="images/downloadpage_thumbnails/2004_dlv1.png" alt="Multi-Game Download Page">
    </label>
    <label>
      <input type="radio" name="download" value="2004_dlv2" <?php echo $current['download']=='2004_dlv2'?'checked':''; ?>><br>
      <span>Old Single Download Page</span><br>
      <img src="images/downloadpage_thumbnails/2004_dlv2.png" alt="Old Single Download Page">
    </label>
    <label>
      <input type="radio" name="download" value="2004_dlv3" <?php echo $current['download']=='2004_dlv3'?'checked':''; ?>><br>
      <span>Latest Download Page</span><br>
      <img src="images/downloadpage_thumbnails/2004_dlv3.png" alt="Latest Download Page">
    </label>
  </div>
</div>
<hr>
<div class="page-group">
  <h3>2003 Download Steam Page</h3>
  <div class="page-options">
    <label>
      <input type="radio" name="download_2003_v2" value="2003_v2_dlv1" <?php echo $current['download_2003_v2']=='2003_v2_dlv1'?'checked':''; ?>><br>
      <span>Multi-Game Download Page</span><br>
      <img src="images/downloadpage_thumbnails/2003_v2_dlv1.png" alt="Multi-Game">
    </label>
    <label>
      <input type="radio" name="download_2003_v2" value="2003_v2_dlv2" <?php echo $current['download_2003_v2']=='2003_v2_dlv2'?'checked':''; ?>><br>
      <span>Single-Steam Download Page</span><br>
      <img src="images/downloadpage_thumbnails/2003_v2_dlv2.png" alt="Single Steam">
    </label>
  </div>
</div>
<hr>
<button type="submit" name="save" class="btn btn-primary">Save</button>
<a href="index.php" class="btn">Cancel</a>
</form>
<style>
.page-options{display:flex;gap:20px;margin-top:5px;}
.page-options label{flex:1;text-align:center;}
.page-options img{max-width:100px;height:auto;}
.page-group{margin-bottom:10px;}
</style>
<?php include 'admin_footer.php'; ?>
