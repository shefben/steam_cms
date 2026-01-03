<?php
require_once __DIR__.'/cms/template_engine.php';
require_once __DIR__.'/cms/db.php';
require_once __DIR__.'/cms/cafe_utils.php';

$theme      = cms_get_current_theme();
$page_title = 'Cyber Café Directory';
$db         = cms_get_db();
ob_start();

$country = isset($_GET['country']) ? strtoupper(preg_replace('/[^A-Z]/', '', $_GET['country'])) : null;
$state   = isset($_GET['state']) ? preg_replace('/[^A-Za-z0-9 ]/', '', $_GET['state']) : null;
$names   = cms_cafe_country_names();

if ($country === null) {
    echo '<div class="content" id="container">';
    echo '<h1>CYBER CAF&Eacute; DIRECTORY</h1><div class="narrower"><ul>';
    foreach ($names as $code => $name) {
        echo '<li><a href="index.php?area=cafe_directory&amp;country='.$code.'">'.htmlspecialchars($name).'</a></li>';
    }
    echo '</ul></div></div>';
    $content = ob_get_clean();
    $tpl = cms_theme_layout('default.twig', $theme);
    cms_render_template($tpl, [
        'page_title' => $page_title,
        'content'    => $content,
    ]);
    return;
}

$countryName = $names[$country] ?? $country;
$states = cms_cafe_state_names($country);

// Show state list if country has states
if ($state === null && !empty($states)) {
    echo '<div class="content" id="container">';
    echo '<h1>CYBER CAF&Eacute; DIRECTORY</h1><div class="narrower">';
    echo '<h3>'.htmlspecialchars($countryName).'</h3><ul>';
    foreach ($states as $code => $name) {
        $u = 'index.php?area=cafe_directory&amp;country='.$country.'&amp;state='.urlencode($code);
        echo '<li><a href="'.$u.'">'.htmlspecialchars($name).'</a></li>';
    }
    echo '</ul></div></div>';
    $content = ob_get_clean();
    $tpl = cms_theme_layout('default.twig', $theme);
    cms_render_template($tpl, [
        'page_title' => $page_title,
        'content'    => $content,
    ]);
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
$content = ob_get_clean();
$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template($tpl, [
    'page_title' => $page_title,
    'content'    => $content,
]);
