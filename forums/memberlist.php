<?php
if (isset($_GET['ltr'])) {
	$area = 'memberlist_ltr_'.$_GET['ltr'];
}
elseif (isset($_GET['what'])) {
	$area = 'memberlist_topposters';
}
else {
	$area = 0;
}
if (file_exists($area.".php")) {
	include $area.".php";
}
else {
	include "memberlist_notfound.php";
}
?>