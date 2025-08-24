<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';
$db = cms_get_db();
$lang = $_GET['l'] ?? 'english';
$s    = $_GET['s'] ?? '';
$i    = $_GET['i'] ?? '';
$a    = $_GET['a'] ?? '';
// Use caching for frequently accessed data
$categories = cms_get_cached_categories();
$developers = cms_get_cached_developers(); 
$apps = $db->query('SELECT * FROM store_apps ORDER BY name LIMIT 20')->fetchAll(PDO::FETCH_ASSOC);
$links = cms_store_sidebar_links();

// Generate browse content
$content = '<h2>Browse Games</h2>';
$content .= '<div class="game-grid">';
foreach ($apps as $app) {
    $content .= '<div class="game-item">';
    $content .= '<h3><a href="?area=game&AppId=' . $app['appid'] . '">' . htmlspecialchars($app['name']) . '</a></h3>';
    if (!empty($app['description'])) {
        $content .= '<p>' . htmlspecialchars(substr($app['description'], 0, 100)) . '...</p>';
    }
    if ($app['price'] > 0) {
        $content .= '<p>Price: $' . number_format($app['price'], 2) . '</p>';
    }
    $content .= '</div>';
}
$content .= '</div>';

$theme = cms_get_setting('theme','2005_v2');
$page  = cms_get_store_page('browse');
$tpl = cms_theme_layout('browse.twig', $theme);
cms_render_template($tpl, [
    'categories' => $categories,
    'developers' => $developers,
    'apps'       => $apps,
    'links'      => $links,
    'lang'       => $lang,
    's'          => $s,
    'i'          => $i,
    'a'          => $a,
    'page'       => $page,
    'page_title' => $page['title'] ?: 'Browse Games',
    'content'    => $content,
    'theme_subdir' => 'storefront'
]);
?>
