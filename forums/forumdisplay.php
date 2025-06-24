<?php
if (isset($_GET['forumid'])) {
	$area = 'forumid_'.$_GET['forumid'];
}
if (file_exists($area.".php")) {
	include $area.".php";
}
else {
	include "forumid_notfound.php";
}
?>