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

$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 50;
$offset = ($page - 1) * $limit;

if ($state !== null) {
    $totalStmt = $db->prepare('SELECT COUNT(*) FROM cafe_directory WHERE country=? AND state=?');
    $totalStmt->execute([$country, $state]);
    $total = (int)$totalStmt->fetchColumn();
    $pages = max(1, ceil($total / $limit));

    $stmt = $db->prepare("SELECT * FROM cafe_directory WHERE country=? AND state=? ORDER BY ord,id LIMIT $limit OFFSET $offset");
    $stmt->execute([$country, $state]);
} else {
    $totalStmt = $db->prepare('SELECT COUNT(*) FROM cafe_directory WHERE country=? AND (state IS NULL OR state="")');
    $totalStmt->execute([$country]);
    $total = (int)$totalStmt->fetchColumn();
    $pages = max(1, ceil($total / $limit));

    $stmt = $db->prepare("SELECT * FROM cafe_directory WHERE country=? AND (state IS NULL OR state=\"\") ORDER BY ord,id LIMIT $limit OFFSET $offset");
    $stmt->execute([$country]);
}
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

ob_start();
echo '<div class="pagination" style="margin-top:15px; margin-bottom:15px;">';
$q = ($state !== null) ? "&country=$country&state=$state" : "&country=$country";
if ($page > 1) echo '<a href="index.php?area=cafe_directory'.$q.'&page='.($page-1).'">&laquo; Prev</a> ';
for($i=max(1, $page-3); $i<=min($pages, $page+3); $i++) {
    if ($i == $page) echo "<b>$i</b> ";
    else echo '<a href="index.php?area=cafe_directory'.$q.'&page='.$i.'">'.$i.'</a> ';
}
if ($page < $pages) echo '<a href="index.php?area=cafe_directory'.$q.'&page='.($page+1).'">Next &raquo;</a>';
echo '</div>';
$paginationHtml = ob_get_clean();

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
echo $paginationHtml;
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
