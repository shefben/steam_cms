<?php
require_once __DIR__ . '/cms/db.php';
require_once __DIR__ . '/cms/template_engine.php';

$page_title = 'Report a Bug';
$theme = cms_get_setting('theme', '2004');
$tpl = cms_theme_layout('default_with_sidebar.twig', $theme);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'email_address'    => $_POST['email_address'] ?? '',
        'description'      => $_POST['description'] ?? '',
        'repro'            => $_POST['repro'] ?? '',
        'repro_steps'      => $_POST['repro_steps'] ?? '',
        'os'               => $_POST['OS'] ?? '',
        'connection_type'  => $_POST['ConType'] ?? '',
        'file_system'      => $_POST['FS_type'] ?? '',
        'reporter_comments'=> $_POST['reporter_comments'] ?? '',
    ];
    cms_insert_bug_report($data);
    cms_render_template($tpl, [
        'content'    => '<p>Thank you for submitting your bug report.</p>',
        'page_title' => $page_title,
    ]);
    return;
}

$content = <<<'HTML'
<p><b>:: Report a bug</b></p>
<p>To report a <b>bug,</b> please fill out and submit this form.</p>
<form method="post">
<p><b>Your Email Address (will only be used to contact you about this bug report)</b></p>
<p><input type="email" name="email_address" size="33" maxlength="256" required></p>
<p><b>Detailed description of this bug</b></p>
<p><textarea cols="59" rows="6" name="description"></textarea></p>
<p><b>Is this bug reproducible?</b></p>
<p><select name="repro" size="1"><option>Yes</option><option>No</option></select></p>
<p><b>If yes, please describe the exact steps required to reproduce this bug</b></p>
<p><textarea cols="59" rows="6" name="repro_steps"></textarea></p>
<p><b>Your Operating System</b></p>
<p><select name="OS" size="1">
<option selected="">Choose your OS</option>
<option>Windows 95</option>
<option>Windows 98 or Me</option>
<option>Windows 2000</option>
<option>Windows XP</option>
</select></p>
<p><b>Your Connection Type</b></p>
<p><select name="ConType" size="1">
<option selected="">Choose your Connection Type</option>
<option>DSL</option>
<option>Cable Modem</option>
<option>Satellite</option>
<option>LAN (greater than 1.5 mbps)</option>
<option>56K Modem or slower</option>
</select></p>
<p><b>Your File System</b></p>
<p><select name="FS_type" size="1">
<option selected="">Choose your File System</option>
<option>NOT SURE</option>
<option>FAT</option>
<option>FAT32</option>
<option>NTFS</option>
</select></p>
<p><b>Any additional comments you have that may help us with this bug</b></p>
<p><textarea cols="59" rows="6" name="reporter_comments"></textarea></p>
<p><input type="submit" value="Submit"> <input type="reset" value="Reset"></p>
</form>
HTML;

cms_render_template($tpl, [
    'content'    => $content,
    'page_title' => $page_title,
]);
