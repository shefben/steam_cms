<?php
if (isset($_GET['userid'])) {
	$area = 'avatar_'.$_GET['userid'];
}
else {
	$area = 0;
}
if (file_exists($area.".gif")) {
	include $area.".gif";
}
else {
	include "forumid_notfound.php";
}
?>