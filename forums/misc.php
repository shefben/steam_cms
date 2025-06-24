<?php
if (isset($_GET['page'])) {
	$area = 'misc_page_'.$_GET['page'];
}
else {
	$area = 0;
}
if (file_exists($area.".php")) {
	include $area.".php";
}
else {
	include "misc_notfound.php";
}
?>