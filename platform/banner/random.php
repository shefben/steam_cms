<?php
require_once __DIR__.'/../../cms/db.php';
$theme = cms_get_setting('theme','2004');
if(preg_match('/(\d{4})/', $theme, $m)){
    $year = $m[1];
}else{
    $year = '2004';
}
$img_dir = __DIR__ . "/$year/img";
if(!is_dir($img_dir)){
    http_response_code(404);
    exit;
}
$files = glob($img_dir.'/*.{gif,jpg,png,GIF,JPG,PNG}', GLOB_BRACE);
if(!$files){
    http_response_code(404);
    exit;
}
$img = $files[array_rand($files)];
$mime = mime_content_type($img);
header('Content-Type: '.$mime);
readfile($img);
