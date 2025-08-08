<?php
$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE settings(key TEXT PRIMARY KEY, value TEXT)');
function cms_get_db(){global $pdo; return $pdo;}
function cms_set_setting($k,$v){$db=cms_get_db();$stmt=$db->prepare("REPLACE INTO settings(key,value) VALUES(?,?)");$stmt->execute([$k,$v]);}
function cms_get_setting($k,$d=''){ $db=cms_get_db();$stmt=$db->prepare('SELECT value FROM settings WHERE key=?');$stmt->execute([$k]);$v=$stmt->fetchColumn();return $v!==false?$v:$d;}
function cms_require_permission($p){}
function cms_require_any_permission($p){}
function cms_admin_log($m){}
require __DIR__.'/../cms/admin/faq_order.php';
ob_start();
cms_save_faq_order('1-1,2-2', true);
$out = ob_get_clean();
assert($out === 'ok');
assert(cms_get_setting('faq_order') === '1-1,2-2');
cms_save_faq_order('3-3', false);
assert(cms_get_setting('faq_order') === '3-3');
?>
