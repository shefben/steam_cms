<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$db = cms_get_db();

// Get sorting parameters exactly like archived URL structure
$sort_by = $_GET['sort_by'] ?? 'Name';
$sort_order = $_GET['sort_order'] ?? 'ASC';
$sort_last = $_GET['sort_last'] ?? 'Name';

$valid_sorts = ['Name' => 'name', 'Developer' => 'developer', 'Producer' => 'developer', 'Price' => 'price'];
$sort_field = $valid_sorts[$sort_by] ?? 'name';
$sort_direction = strtoupper($sort_order) === 'DESC' ? 'DESC' : 'ASC';

// Media items are typically trailers, demos, videos - we'll filter for media content
$sql = "SELECT appid, name, developer, price, availability, metascore, app_type 
        FROM store_apps 
        WHERE app_type IN ('trailer', 'video', 'demo', 'media') OR name LIKE '%trailer%' OR name LIKE '%movie%' OR name LIKE '%video%'
        ORDER BY $sort_field $sort_direction, name ASC";
$media_items = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$theme = cms_get_setting('theme','2005_v2');
$links = cms_store_sidebar_links();
$page = cms_get_store_page('media') ?: ['title' => 'All Media', 'name' => 'All Media'];

// Generate the correct sorting URLs to match archived pages exactly
$name_sort_url = "media.php?sort_by=Name&sort_last=" . urlencode($sort_by) . "&sort_order=" . ($sort_by === 'Name' && $sort_order === 'ASC' ? 'DESC' : 'ASC') . "&";
$producer_sort_url = "media.php?sort_by=Producer&sort_last=" . urlencode($sort_by) . "&sort_order=" . ($sort_by === 'Producer' && $sort_order === 'ASC' ? 'DESC' : 'ASC') . "&";
$price_sort_url = "media.php?sort_by=Price&sort_last=" . urlencode($sort_by) . "&sort_order=" . ($sort_by === 'Price' && $sort_order === 'ASC' ? 'DESC' : 'ASC') . "&";

// Build the content HTML to match the archived structure exactly
$content = '<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td background="img/title_grey.jpg" height="50" width="600"><span class="page_title">  All Media</span></td>
</tr>
<tr><td height="5"></td></tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td background="img/endcap_teal_l.gif" height="20" nowrap="" width="5"></td>
<td bgcolor="#317B8C" height="20" nowrap="" width="100%"><a class="header_link_user_admin" href="' . $name_sort_url . '"><strong>Name</strong> ' . ($sort_by === 'Name' ? '<font face="Wingdings 3" style="font-family: Wingdings 3; font-size: 9px;">p</font>' : '') . '</a></td>
<td background="img/endcap_teal_r.gif" height="20" nowrap="" width="5"></td>
<td nowrap="" width="5"></td>
<td background="img/endcap_teal_l.gif" height="20" nowrap="" width="5"></td>
<td bgcolor="#317B8C" nowrap=""><a class="header_link_user_admin" href="' . $producer_sort_url . '"><strong>Producer</strong> ' . ($sort_by === 'Producer' ? '<font face="Wingdings 3" style="font-family: Wingdings 3; font-size: 9px;">p</font>' : '') . '</a></td>
<td background="img/endcap_teal_r.gif" height="20" nowrap="" width="5"></td>
<td nowrap="" width="5"></td>
<td background="img/endcap_teal_l.gif" height="20" nowrap="" width="5"></td>
<td bgcolor="#317B8C" nowrap=""><a class="header_link_user_admin" href="' . $price_sort_url . '"><strong>Price</strong> ' . ($sort_by === 'Price' ? '<font face="Wingdings 3" style="font-family: Wingdings 3; font-size: 9px;">p</font>' : '') . '</a></td>
<td background="img/endcap_teal_r.gif" height="20" nowrap="" width="5"></td>
</tr>
<tr>
<td colspan="11" height="2"></td>
</tr>';

$row_colors = ['#ffffff', '#f4f5f0'];
$row_index = 0;

foreach ($media_items as $item) {
    $bgcolor = $row_colors[$row_index % 2];
    $row_index++;
    
    // Determine if item is "new" (you can customize this logic)
    $is_new = stripos($item['name'], 'new') !== false || 
              (isset($item['created']) && strtotime($item['created']) > strtotime('-30 days'));
    
    $new_badge = $is_new ? ' <span style="color: White; background-color: Red; font-family: Tahoma; font-size: 9px;"><strong> NEW </strong></span>' : '';
    
    $price_display = '<span class="owned_app">Free</span>';
    if ($item['price'] && $item['price'] > 0) {
        $price_display = '<span class="price_text">$' . number_format($item['price'], 2) . '</span>';
    }
    
    $content .= '<tr bgcolor="' . $bgcolor . '" class="h" id="row_' . $item['appid'] . '" onclick=" location.href=\'game.php?appid=' . $item['appid'] . '&\' " onmouseout="HiLiteRow(\'row_' . $item['appid'] . '\', \'' . $bgcolor . '\');" onmouseover="HiLiteRow(\'row_' . $item['appid'] . '\', \'#F4F0C9\');">
<td height="20" nowrap="" width="5"></td>
<td class="h" nowrap="" width="100%">' . htmlspecialchars($item['name']) . $new_badge . '</td>
<td colspan="3" width="15"></td>
<td class="h" nowrap="">' . htmlspecialchars($item['developer']) . '</td>
<td colspan="3" width="15"></td>
<td align="right" class="h" nowrap="">' . $price_display . '</td>
<td colspan="1" width="5"></td>
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

$tpl = cms_theme_layout('media.twig', $theme);
cms_render_template($tpl, [
    'content' => $content,
    'links' => $links,
    'page' => $page,
    'theme_subdir' => 'storefront',
    'page_title' => 'All Media'
]);
?>