<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');

// Core versioned pages
cms_register_versioned_page('cafe_signup', 'Choose 2004 Cafe Sign-Up template version', 'cafe_signup_page_2004');
cms_register_page_version(
    'cafe_signup',
    '2004_signup_v1',
    'Version 1',
    'images/2004_cafe_signup_thumbnails/version_1.PNG',
    ['2004']
);
cms_register_page_version(
    'cafe_signup',
    '2004_signup_v2',
    'Version 2',
    'images/2004_cafe_signup_thumbnails/version_2.PNG',
    ['2004']
);

cms_register_versioned_page('cheat_form', '2004 Cheat Form', 'cheat_form_page_2004');
cms_register_page_version(
    'cheat_form',
    '2004_cheat_v1',
    'Submission Form',
    'images/2004_cheat_form/version_1.PNG',
    ['2004']
);
cms_register_page_version(
    'cheat_form',
    '2004_cheat_v2',
    'Use Troubleshooter',
    'images/2004_cheat_form/version_2.PNG',
    ['2004']
);

cms_register_versioned_page('cd_account', '2004 CDKey Page', 'cd_account_page_2004');
cms_register_page_version(
    'cd_account',
    '2004_cd_v1',
    'Submission Form',
    'images/cdkeypage_thumbnails/version_1.png',
    ['2004']
);
cms_register_page_version(
    'cd_account',
    '2004_cd_v2',
    'Use Troubleshooter',
    'images/cdkeypage_thumbnails/version_2.png',
    ['2004']
);

$pages = cms_plugin_page_versions();
$current = [];
foreach ($pages as $key => $info) {
    $default = $info['versions'][0]['value'] ?? '';
    $current[$key] = cms_get_setting($info['setting'], $default);
}

if (isset($_POST['save'])) {
    foreach ($pages as $key => $info) {
        if (isset($_POST[$key])) {
            cms_set_setting($info['setting'], $_POST[$key]);
        }
    }
    echo '<p>Selections saved.</p>';
    foreach ($pages as $key => $info) {
        $default = $info['versions'][0]['value'] ?? '';
        $current[$key] = cms_get_setting($info['setting'], $default);
    }
}

$current_theme = cms_get_setting('theme', '2004');
$img_base = cms_base_url() . '/cms/admin/';
?>
<h2>Page Version Management</h2>
<form method="post" id="pageForm">
<?php foreach ($pages as $key => $info):
    $versions = [];
    foreach ($info['versions'] as $ver) {
        if ($ver['themes']) {
            $match = false;
            foreach ($ver['themes'] as $theme) {
                if (
                    $current_theme === $theme
                    || str_starts_with($current_theme, $theme . '_')
                    || str_starts_with($current_theme, $theme . '-')
                ) {
                    $match = true;
                    break;
                }
            }
            if (!$match) {
                continue;
            }
        }
        $versions[] = $ver;
    }
    if (!$versions) {
        continue;
    }
?>
  <div class="page-group">
    <h3><?php echo htmlspecialchars($info['title']); ?></h3>
    <div class="page-options">
      <?php foreach ($versions as $ver):
            $checked = $current[$key] === $ver['value'] ? 'checked' : '';
      ?>
      <label>
        <input type="radio" name="<?php echo htmlspecialchars($key); ?>" value="<?php echo htmlspecialchars($ver['value']); ?>" <?php echo $checked; ?>><br>
        <span><?php echo htmlspecialchars($ver['label']); ?></span><br>
        <img src="<?php echo htmlspecialchars($img_base . $ver['image']); ?>" alt="<?php echo htmlspecialchars($ver['label']); ?>">
      </label>
      <?php endforeach; ?>
    </div>
  </div>
  <hr>
<?php endforeach; ?>
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

