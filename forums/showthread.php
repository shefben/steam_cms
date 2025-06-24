<?php
if (isset($_GET['threadid'])) {
	$area = 'thread_'.$_GET['threadid'];
}
else {
	$area = 0;
}
if (isset($_GET['pagenumber'])) {
	$page = 'pagenumber_'.$_GET['pagenumber'];
}
else {
	$page = 0;
}
if (file_exists($area."_".$page.".php")) {
	include $area."_".$page.".php";
}
elseif (file_exists($area.".php")) {
	include $area.".php";
}
else {
	include "showthread_notfound.php";
}
?>