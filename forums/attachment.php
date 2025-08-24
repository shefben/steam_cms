<?php
if (isset($_GET['postid'])) {
	$area = 'attachment_'.$_GET['postid'];
}
else {
	$area = 0;
}
if (file_exists($area.".php")) {
	include $area.".php";
}
else {
	include "attachment_notfound.php";
}
?>