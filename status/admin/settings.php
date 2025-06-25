<?php
session_start();
require_once '../functions.php';
if (!isset($_SESSION['uid'])) { header('Location: login.php'); exit; }
$db = db_connect();
if ($_SERVER['REQUEST_METHOD']=='POST') {
    set_setting($db,'main_network_ip',$_POST['main_network_ip']);
    set_setting($db,'main_network_port',$_POST['main_network_port']);
}
header('Location: index.php');
