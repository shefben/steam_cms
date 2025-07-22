#!/usr/bin/env php
<?php
declare(strict_types=1);

require_once __DIR__.'/../cms/db.php';

const ROOT_DIR = __DIR__.'/../archived_steampowered/2004/cafe_directory';
const ROOT_HTML = __DIR__.'/../archived_steampowered/2004/cafe_directory.html';

$db = cms_get_db();
$db->exec('DELETE FROM cafe_directory');

$countries = [];
$html = file_get_contents(ROOT_HTML);
preg_match_all('/country=([A-Z]{2})[^>]*>([^<]+)/', $html, $m, PREG_SET_ORDER);
foreach($m as $row){
    $countries[$row[1]] = trim(html_entity_decode($row[2], ENT_QUOTES));
}

$insert = $db->prepare('INSERT INTO cafe_directory(url,name,phone,address,city_state,zip,ord,country,state) VALUES(?,?,?,?,?,?,?,?,?)');

function importFile(PDOStatement $ins, string $file, string $country, ?string $state): void {
    $html = file_get_contents($file);
    $html = str_replace("\r", '', $html);
    $pattern = '/<li[^>]*>\s*<strong>(?:<a[^>]*href="([^" ]+)"[^>]*>)?([^<]+)(?:<\/a>)?<\/strong>.*?<span[^>]*>[^0-9]*([0-9\-() ]+)\s*<\/span><br>\s*([^<]*)<br>\s*([^<]*)<br>\s*([^<]*)<br>/si';
    preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
    $seen = [];
    $ord = 0;
    foreach($matches as $m){
        $url = $m[1] ?? '';
        if($url){
            $url = preg_replace('/https?:\/\/web\.archive\.org\/web\/\d+(?:id_)?\//','',$url);
        }
        $name = html_entity_decode(trim($m[2]), ENT_QUOTES);
        $phone = trim($m[3]);
        $phone = preg_replace('/^[()\s]+|[()\s]+$/', '', $phone);
        $address = html_entity_decode(trim($m[4]), ENT_QUOTES);
        $city = html_entity_decode(trim($m[5]), ENT_QUOTES);
        $zip = trim($m[6]);
        $key = strtolower($country.'|'.($state ?? '').'|'.$name.'|'.$address.'|'.$city.'|'.$zip);
        if(isset($seen[$key])) continue;
        $seen[$key] = true;
        $ins->execute([
            $url,
            $name,
            $phone,
            $address,
            $city,
            $zip,
            $ord++,
            $country,
            $state
        ]);
    }
}

foreach($countries as $code=>$name){
    $dir = ROOT_DIR.'/'.$code;
    if(is_dir($dir)){
        foreach(glob($dir.'/*.txt') as $file){
            $state = basename($file,'.txt');
            importFile($insert, $file, $code, $state);
        }
    }
    $countryFile = ROOT_DIR.'/'.$code.'.txt';
    if(is_file($countryFile)){
        // Countries without states have data here
        if(!is_dir($dir)){
            importFile($insert, $countryFile, $code, null);
        }
    }
}

echo "Imported cafe directory\n";
