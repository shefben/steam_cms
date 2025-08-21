<?php                     /*  includes/bootstrap.php  */
if (!defined('CB_BOOT')) {
    define('CB_BOOT',true);
    session_start();
    require_once __DIR__.'/../config.php';
    require_once __DIR__.'/db.php';      // gives cb_db()
    require_once __DIR__.'/template.php';
}
