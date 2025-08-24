<?php
if (isset($_GET['forumid'])) {
	$area = 'announcement_'.$_GET['forumid'];
}
if (file_exists($area.".php")) {
	include $area.".php";
}
else {
	include "announcement_notfound.php";
}
?>