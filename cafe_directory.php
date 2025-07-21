<?php
$page_title = 'Cyber Café Directory';
require_once __DIR__.'/cms/db.php';
include __DIR__.'/cms/header.php';
$db = cms_get_db();

function cafe_country_names(): array {
    static $map = null;
    if ($map !== null) return $map;
    $html = file_get_contents(__DIR__.'/archived_steampowered/2004/cafe_directory.html');
    preg_match_all('/country=([A-Z]{2})[^>]*>([^<]+)/', $html, $m, PREG_SET_ORDER);
    $map = [];
    foreach ($m as $row) {
        $map[$row[1]] = trim(html_entity_decode($row[2], ENT_QUOTES));
    }
    return $map;
}

function cafe_state_names(string $country): array {
    $file = __DIR__.'/archived_steampowered/2004/cafe_directory/'.$country.'.txt';
    if (!is_file($file)) return [];
    $html = file_get_contents($file);
    preg_match_all('/state=([^"&]+)[^>]*>([^<]+)/', $html, $m, PREG_SET_ORDER);
    $states = [];
    foreach ($m as $row) {
        if ($row[1] === '?') continue;
        $states[$row[1]] = trim(html_entity_decode($row[2], ENT_QUOTES));
    }
    return $states;
}

$country = isset($_GET['country']) ? strtoupper(preg_replace('/[^A-Z]/', '', $_GET['country'])) : null;
$state   = isset($_GET['state']) ? preg_replace('/[^A-Za-z0-9 ]/', '', $_GET['state']) : null;
$names   = cafe_country_names();

if ($country === null) {
    echo '<div class="content" id="container">';
    echo '<h1>CYBER CAF&Eacute; DIRECTORY</h1><div class="narrower"><ul>';
    foreach ($names as $code => $name) {
        echo '<li><a href="index.php?area=cafe_directory&amp;country='.$code.'">'.htmlspecialchars($name).'</a></li>';
    }
    echo '</ul></div></div>';
    include 'cms/footer.php';
    return;
}

$countryName = $names[$country] ?? $country;
$stateDir = __DIR__.'/archived_steampowered/2004/cafe_directory/'.$country;
if ($state === null && is_dir($stateDir)) {
    $states = cafe_state_names($country);
    echo '<div class="content" id="container">';
    echo '<h1>CYBER CAF&Eacute; DIRECTORY</h1><div class="narrower">';
    echo '<h3>'.htmlspecialchars($countryName).'</h3><ul>';
    foreach ($states as $code => $name) {
        $u = 'index.php?area=cafe_directory&amp;country='.$country.'&amp;state='.urlencode($code);
        echo '<li><a href="'.$u.'">'.htmlspecialchars($name).'</a></li>';
    }
    echo '</ul></div></div>';
    include 'cms/footer.php';
    return;
}

if ($state !== null) {
    $stmt = $db->prepare('SELECT * FROM cafe_directory WHERE country=? AND state=? ORDER BY ord,id');
    $stmt->execute([$country, $state]);
} else {
    $stmt = $db->prepare('SELECT * FROM cafe_directory WHERE country=? AND (state IS NULL OR state="") ORDER BY ord,id');
    $stmt->execute([$country]);
}
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<div class="content" id="container">';
echo '<h1>CYBER CAF&Eacute; DIRECTORY</h1><div class="narrower">';
foreach ($entries as $e) {
    echo '<p><strong>';
    if ($e['url']) {
        $url = htmlspecialchars($e['url']);
        $name = htmlspecialchars($e['name']);
        echo '<a href="'.$url.'" target="_blank">'.$name.'</a>';
    } else {
        echo htmlspecialchars($e['name']);
    }
    echo '</strong> <span style="font-size:10px;color:#999;" title="phone number"><font face="wingdings">(</font> '.htmlspecialchars($e['phone']).'</span><br>';
    echo htmlspecialchars($e['address']).'<br>';
    echo htmlspecialchars($e['city_state']).'<br>';
    echo htmlspecialchars($e['zip']).'<br><br></p>';
}
if ($state !== null) {
    echo '&raquo; <a href="index.php?area=cafe_directory&amp;country='.$country.'">return to states</a>';
} else {
    echo '&raquo; <a href="index.php?area=cafe_directory">return to countries</a>';
}
echo '</div></div>';
include 'cms/footer.php';

