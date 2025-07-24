<?php
if (isset($_GET['id'])) {
	$area = $_GET['id'];
}
else { $area = "notfound"; }

if (file_exists("image_".$area.".php") == true) {
	$area = "image_".$area;
}
else { $area = "image_notfound"; }

include $area.".php";
?>