<?php
require_once 'cms/admin/admin_header.php'; // or something that initializes DB
$db = cms_get_db();
$sql = file_get_contents('troubleshooter_seed.sql');
$db->exec($sql);
echo "Imported\n";
