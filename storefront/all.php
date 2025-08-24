<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$db = cms_get_db();

// Get sorting parameters exactly like archived URL structure
$sort_by = $_GET['sort_by'] ?? 'Name';
$sort_order = $_GET['sort_order'] ?? 'ASC';
$sort_last = $_GET['sort_last'] ?? 'Name';

$valid_sorts = ['Name' => 'name', 'Developer' => 'developer', 'Price' => 'price', 'ReleaseDate' => 'availability', 'Metascore' => 'metacritic'];
$sort_field = $valid_sorts[$sort_by] ?? 'name';
$sort_direction = strtoupper($sort_order) === 'DESC' ? 'DESC' : 'ASC';

$sql = "SELECT appid, name, developer, price, availability, metacritic
        FROM store_apps 
        ORDER BY $sort_field $sort_direction, name ASC";
$apps = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$theme = cms_get_setting('theme','2005_v2');
$links = cms_store_sidebar_links();
$page = cms_get_store_page('all');

// Generate the correct sorting URLs to match archived pages exactly
$name_sort_url = "index.php?area=all&sort_by=Name&sort_last=" . urlencode($sort_by) . "&sort_order=" . ($sort_by === 'Name' && $sort_order === 'ASC' ? 'DESC' : 'ASC') . "&";
$dev_sort_url = "index.php?area=all&sort_by=Developer&sort_last=" . urlencode($sort_by) . "&sort_order=" . ($sort_by === 'Developer' && $sort_order === 'ASC' ? 'DESC' : 'ASC') . "&";
$date_sort_url = "index.php?area=all&sort_by=ReleaseDate&sort_last=" . urlencode($sort_by) . "&sort_order=" . ($sort_by === 'ReleaseDate' && $sort_order === 'ASC' ? 'DESC' : 'ASC') . "&";
$price_sort_url = "index.php?area=all&sort_by=Price&sort_last=" . urlencode($sort_by) . "&sort_order=" . ($sort_by === 'Price' && $sort_order === 'ASC' ? 'DESC' : 'ASC') . "&";

// Build the content HTML to match the archived structure exactly
$content = '<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td background="img/endcap_blue_l.gif" height="20" nowrap="" width="5"></td>
<td bgcolor="#5A6A50" height="20" nowrap="" width="100%"><a class="header_link_user_admin" href="' . $name_sort_url . '"><strong>Name</strong> ' . ($sort_by === 'Name' ? '<font face="Wingdings 3" style="font-family: Wingdings 3; font-size: 9px;">p</font>' : '') . '</a></td>
<td background="img/endcap_blue_r.gif" height="20" nowrap="" width="5"></td>
<td nowrap="" width="5"></td>
<td background="img/endcap_blue_l.gif" height="20" nowrap="" width="5"></td>
<td bgcolor="#5A6A50" nowrap=""><a class="header_link_user_admin" href="' . $dev_sort_url . '"><strong>Developer</strong> ' . ($sort_by === 'Developer' ? '<font face="Wingdings 3" style="font-family: Wingdings 3; font-size: 9px;">p</font>' : '') . '</a></td>
<td background="img/endcap_blue_r.gif" height="20" nowrap="" width="5"></td>
<td nowrap="" width="5"></td>
<td background="img/endcap_blue_l.gif" height="20" nowrap="" width="5"></td>
<td bgcolor="#5A6A50" nowrap=""><a class="header_link_user_admin" href="' . $date_sort_url . '"><strong>Available</strong> ' . ($sort_by === 'ReleaseDate' ? '<font face="Wingdings 3" style="font-family: Wingdings 3; font-size: 9px;">p</font>' : '') . '</a></td>
<td background="img/endcap_blue_r.gif" height="20" nowrap="" width="5"></td>
<td nowrap="" width="5"></td>
<td background="img/endcap_blue_l.gif" height="20" nowrap="" width="5"></td>
<td bgcolor="#5A6A50" nowrap=""><a class="header_link_user_admin" href="' . $price_sort_url . '"><strong>Price</strong> ' . ($sort_by === 'Price' ? '<font face="Wingdings 3" style="font-family: Wingdings 3; font-size: 9px;">p</font>' : '') . '</a></td>
<td background="img/endcap_blue_r.gif" height="20" nowrap="" width="5"></td>
</tr>
<tr>
<td colspan="15" height="2"></td>
</tr>';

$row_colors = ['#ffffff', '#f4f5f0'];
$row_index = 0;

foreach ($apps as $app) {
    $bgcolor = $row_colors[$row_index % 2];
    $row_index++;
    
    $price_display = '';
    if ($app['price'] && $app['price'] > 0) {
        $price_display = '<span class="price_text">$' . number_format($app['price'], 2) . '</span>';
    } elseif ($app['developer'] && strpos($app['developer'], 'Valve') === false) {
        $price_display = '<span class="free_app">Third-party</span>';
    } else {
        $price_display = '<span class="owned_app">In account</span>';
    }
    
    $availability_class = 'ReleaseDateAvailable';
    $availability_text = 'Available';
    if (stripos($app['availability'], 'coming') !== false) {
        $availability_class = 'ReleaseDateComingSoon';
        $availability_text = 'Coming soon';
    } elseif (stripos($app['availability'], 'new') !== false) {
        $availability_class = 'ReleaseDateNewRelease';
        $availability_text = 'New release';
    } elseif (stripos($app['availability'], 'n/a') !== false || stripos($app['availability'], 'unavailable') !== false) {
        $availability_class = 'ReleaseDateUnavailable';
        $availability_text = 'n/a';
    }
    
    $content .= '<tr bgcolor="' . $bgcolor . '" class="h" id="row_' . $app['appid'] . '" onclick=" location.href=\'index.php?area=game&AppId=' . $app['appid'] . '&\' " onmouseout="HiLiteRow(\'row_' . $app['appid'] . '\', \'' . $bgcolor . '\');" onmouseover="HiLiteRow(\'row_' . $app['appid'] . '\', \'#ECF39D\');">
<td height="20" nowrap="" width="5"></td>
<td class="h" nowrap="" width="100%">' . htmlspecialchars($app['name']) . '</td>
<td colspan="3" width="15"></td>
<td class="h" nowrap="">' . htmlspecialchars($app['developer']) . '</td>
<td colspan="3" width="15"></td>
<td align="center" class="h" nowrap=""><span class="' . $availability_class . '">' . $availability_text . '</span></td>
<td colspan="3" width="15"></td>
<td align="right" class="h" nowrap="">' . $price_display . '</td>
<td colspan="3" width="5"></td>
</tr>';
}

$content .= '</table>
<script language="JavaScript">
function HiLiteRow(row_id, color) {
    var row = document.getElementById(row_id);
    if (row) {
        row.style.backgroundColor = color;
    }
}
</script>';

$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template($tpl, [
    'content' => $content,
    'links' => $links,
    'page' => $page,
    'theme_subdir' => 'storefront'
]);
?>