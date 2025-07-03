<?php
require_once __DIR__.'/../cms/db.php';

// ------------------ DB Connection ------------------
$db = cms_get_db();

// ------------------ Input Handling -----------------
$term       = trim($_GET['term'] ?? '');
$type       = $_GET['type'] ?? '';
$category   = $_GET['category'] ?? '';
$developer  = $_GET['developer'] ?? '';
$price      = $_GET['price'] ?? '';
$order      = $_GET['order'] ?? '';
$sort_by    = $_GET['sort_by'] ?? 'Name';
$sort_last  = $_GET['sort_last'] ?? $sort_by;
$sort_order = strtoupper($_GET['sort_order'] ?? 'ASC') === 'DESC' ? 'DESC' : 'ASC';
$browse     = $_GET['browse'] ?? '1';

// Build canonical URL for links
function build_url(array $params){
    $order = ['area','term','type','category','developer','price','order','sort_by','sort_last','sort_order','browse'];
    $out = [];
    foreach($order as $k){ $out[$k] = $params[$k] ?? ''; }
    return 'index.php?'.http_build_query($out, '', '&');
}

$base_params = [
    'area'       => 'search',
    'term'       => $term,
    'type'       => $type,
    'category'   => $category,
    'developer'  => $developer,
    'price'      => $price,
    'order'      => $order,
    'sort_by'    => $sort_by,
    'sort_last'  => $sort_last,
    'sort_order' => $sort_order,
    'browse'     => $browse
];

// ------------------ Query Builder ------------------
$where = [];
$params = [];
if($term !== ''){ $where[] = 'a.name LIKE ?'; $params[] = "%$term%"; }
if($developer !== ''){ $where[] = 'a.developer=?'; $params[] = $developer; }
if($category !== ''){ $where[] = 'a.appid IN (SELECT appid FROM app_categories WHERE category_id=?)'; $params[] = (int)$category; }
if($price !== ''){
    if(strpos($price,'-')!==false){ list($min,$max)=array_map('intval',explode('-', $price,2)); $where[]='a.price BETWEEN ? AND ?'; $params[]=$min/100; $params[]=$max/100; }
    else { $where[]='a.price <= ?'; $params[]=(int)$price/100; }
}

$sort_map = ['Name'=>'a.name','Developer'=>'a.developer','Price'=>'a.price','Metascore'=>'a.metacritic'];
$sort_col = $sort_map[$sort_by] ?? 'a.name';

$sql = 'SELECT a.*, GROUP_CONCAT(sc.name ORDER BY sc.ord SEPARATOR ", ") as cats '
      .'FROM store_apps a '
      .'LEFT JOIN app_categories ac ON a.appid=ac.appid '
      .'LEFT JOIN store_categories sc ON ac.category_id=sc.id';
if($where) $sql .= ' WHERE '.implode(' AND ', $where);
$sql .= ' GROUP BY a.appid ORDER BY '.$sort_col.' '.$sort_order;

$stmt = $db->prepare($sql);
$stmt->execute($params);
$apps = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Dropdown values
$developers = $db->query('SELECT name FROM store_developers ORDER BY name')->fetchAll(PDO::FETCH_COLUMN);
$categories = $db->query('SELECT id,name FROM store_categories WHERE visible=1 ORDER BY ord')->fetchAll(PDO::FETCH_ASSOC);
$prices = [
    ''       => '-',
    '1'      => 'Third-party',
    '1001'   => '$10 or less',
    '2001'   => '$20 or less',
    '3001'   => '$30 or less',
    '4001'   => '$40 or less',
    '5001'   => '$50 or less',
    '999991' => 'All'
];

function sort_link($label,$col,$params,$current,$order){
    $params['sort_by'] = $col;
    $params['sort_last'] = $col;
    $params['sort_order'] = ($current==$col && $order==='ASC') ? 'DESC' : 'ASC';
    $arrow = '';
    if($current==$col){
        $arrow = $order==='ASC' ? ' <font face="Wingdings 3" style="font-family: Wingdings 3; font-size: 9px;">&#112;</font>'
                                : ' <font face="Wingdings 3" style="font-family: Wingdings 3; font-size: 9px;">&#113;</font>';
    }
    return '<a href="'.htmlspecialchars(build_url($params)).'" class="header_link_user_admin"><strong>'.$label.'</strong>'.$arrow.'</a>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Steam Games</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="pragma" content="no-cache">
    <link rel="stylesheet" type="text/css" href="storefront.css">
</head>
<body style="background:#4c5844;margin:0;font-size:8px;font-family:Verdana,Arial,Helvetica;line-height:12px;">
<table width="100%" cellspacing="0" cellpadding="0" border="0" style="height:100%;">
<tr><td>
    <div style="padding:0;background:#000;margin-bottom:16px;width:100%;">
    <nobr><a href="http://www.steampowered.com/index.php"><img src="img/steam_logo_onblack.gif" alt="[Steam]" width="152" height="54" border="0" align="top"></a>
    <span style="margin-left:64px;position:absolute;top:32px;font-weight:bold;">
        <a href="http://store.steampowered.com/"><img src="img/games.gif" border="0" width="66" height="22" valign="bottom" alt="games"></a>
        <a href="http://www.steampowered.com/index.php?area=news"><img src="img/news.gif" border="0" width="54" height="22" valign="bottom" alt="news"></a>
        <a href="http://www.steampowered.com/index.php?area=getsteamnow"><img src="img/getSteamNow.gif" border="0" width="108" height="22" valign="bottom" alt="getSteamNow"></a>
        <a href="http://www.steampowered.com/index.php?area=cybercafes"><img src="img/cafes.gif" border="0" width="95" height="22" valign="bottom" alt="Cyber Cafes"></a>
    </span>
    </nobr>
    </div>
</td></tr>
<tr><td height="100%">
    <table align="center" cellspacing="0" cellpadding="0" style="height:100%;">
    <tr>
        <td bgcolor="#FFFFFF" valign="top" style="width:10px;height:10px"><img src="img/storefront/sp_top_left.gif"></td>
        <td bgcolor="#FFFFFF" valign="top" rowspan="3">
            <table align="center" width="736" cellspacing="0" cellpadding="0" border="0" style="height:100%;">
            <tr>
                <td width="10" valign="top" align="left" nowrap></td>
                <td width="118" valign="top" align="left" nowrap>
                    <table cellspacing="0" cellpadding="0">
                    <tr><td height="10"></td></tr>
                    <tr><td nowrap>
                        <span><a href="index.php?" class="menu_item">Home</a></span><br>
                        <div class="menu_spacer">&nbsp;</div>
                        <span><a href="index.php?area=browse&amp;" class="menu_item">Browse Games</a></span><br>
                        <span><a href="index.php?area=all&amp;" class="menu_item">All Games</a></span><br>
                        <span><font face="Wingdings 3"><span class="menu_pointer">&#132;</span></font> <a href="index.php?area=search&amp;" class="menu_item_current">Search</a></span><br>
                        <div class="menu_spacer">&nbsp;</div>
                        <span><a href="index.php?area=media&amp;" class="menu_item">Media</a></span><br>
                    </td></tr>
                    </table>
                </td>
                <td width="8"><nobr>&nbsp;&nbsp;</nobr></td>
                <td width="100%" valign="top" align="left">
                    <table cellpadding="0" cellspacing="0">
                    <tr><td width="600" height="50" background="img/title_grey.jpg"><span class="page_title">&nbsp;&nbsp;Search</span></td></tr>
                    <tr><td height="10"></td></tr>
                    <tr><td>
                    <span class="normal_text">
                        <form action="index.php" method="get">
                            <input type="hidden" name="area" value="search">
                            <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="10" height="10" background="img/search_blue_left_top.gif" nowrap></td>
                                <td bgcolor="#009ca5" width="100%"></td>
                                <td width="10" height="10" background="img/search_blue_right_top.gif" nowrap></td>
                            </tr>
                            <tr>
                                <td width="10" background="img/search_blue_left.gif" nowrap></td>
                                <td bgcolor="#009ca5" width="100%">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr><td width="100%">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr><td width="100%"><span class="search_form_text">Search Term(s)</span></td></tr>
                                        <tr><td width="100%"><input type="text" name="term" value="<?php echo htmlspecialchars($term); ?>" maxlength="64" style="width:100%;"></td></tr>
                                        <tr><td height="5"></td></tr>
                                        <tr><td width="100%">
                                            <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="33%"><span class="search_form_text">Developer</span></td>
                                                <td width="10" nowrap></td>
                                                <td width="33%"><span class="search_form_text">Category</span></td>
                                                <td width="10" nowrap></td>
                                                <td width="33%"><span class="search_form_text">Price</span></td>
                                            </tr>
                                            <tr>
                                                <td width="33%">
                                                    <select name="developer" style="width:100%;">
                                                        <option value="" selected>-</option>
                                                        <?php foreach($developers as $d): ?>
                                                        <option value="<?php echo htmlspecialchars($d); ?>"<?php if($developer==$d) echo ' selected'; ?>><?php echo htmlspecialchars($d); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td width="10" nowrap></td>
                                                <td width="33%">
                                                    <select name="category" style="width:100%;">
                                                        <option value="" selected>-</option>
                                                        <?php foreach($categories as $c): ?>
                                                        <option value="<?php echo $c['id']; ?>"<?php if($category==$c['id']) echo ' selected'; ?>><?php echo htmlspecialchars($c['name']); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td width="10" nowrap></td>
                                                <td width="33%">
                                                    <select name="price" style="width:100%;">
                                                        <?php foreach($prices as $val=>$label): ?>
                                                        <option value="<?php echo $val; ?>"<?php if($val!=='' && $price==$val) echo ' selected'; ?>><?php echo $label; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            </table>
                                        </td></tr>
                                        </table>
                                    </td></tr>
                                    </table>
                                </td>
                                <td width="10" nowrap></td>
                                <td><input type="submit" value="Search"></td>
                            </tr>
                            </table>
                        </form>
                        <br>
                        <?php if(!$apps): ?>
                            <div align="center"><em>Please specify a search term or select a developer or price from the search options.</em></div>
                        <?php else: ?>
                        <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width="5" height="20" nowrap background="img/endcap_blue_l.gif"></td>
                            <td class="h" nowrap width="100%" bgcolor="#5A6A50"><?php echo sort_link('Name','Name',$base_params,$sort_last,$sort_order); ?></td>
                            <td width="5" height="20" nowrap background="img/endcap_blue_r.gif"></td>
                            <td width="5" nowrap></td>
                            <td width="5" height="20" nowrap background="img/endcap_blue_l.gif"></td>
                            <td class="h" nowrap bgcolor="#5A6A50"><?php echo sort_link('Developer','Developer',$base_params,$sort_last,$sort_order); ?></td>
                            <td width="5" height="20" nowrap background="img/endcap_blue_r.gif"></td>
                            <td width="5" nowrap></td>
                            <td width="5" height="20" nowrap background="img/endcap_blue_l.gif"></td>
                            <td class="h" nowrap bgcolor="#5A6A50"><?php echo sort_link('Metascore','Metascore',$base_params,$sort_last,$sort_order); ?></td>
                            <td width="5" height="20" nowrap background="img/endcap_blue_r.gif"></td>
                            <td width="5" nowrap></td>
                            <td width="5" height="20" nowrap background="img/endcap_blue_l.gif"></td>
                            <td class="h" nowrap bgcolor="#5A6A50"><?php echo sort_link('Price','Price',$base_params,$sort_last,$sort_order); ?></td>
                            <td width="5" height="20" nowrap background="img/endcap_blue_r.gif"></td>
                        </tr>
                        <tr><td colspan="15" height="2"></td></tr>
                        <?php
                        $i=0;
                        foreach($apps as $a):
                            $bg = ($i++ % 2) ? '#f4f5f0' : '#ffffff';
                            $rowid = 'row_'.$a['appid'];
                            $price_txt = $a['price']>0 ? '$'.number_format($a['price'],2) : 'Third-party';
                        ?>
                        <tr class="h" onclick=" location.href='index.php?area=game&AppId=<?php echo $a['appid']; ?>&browse=1' " id="<?php echo $rowid; ?>" bgcolor="<?php echo $bg; ?>" onMouseOver="HiLiteRow('<?php echo $rowid; ?>', '#ECF39D');" onMouseOut="HiLiteRow('<?php echo $rowid; ?>', '<?php echo $bg; ?>');" >
                            <td nowrap width="5" height="20"></td>
                            <td class="h" nowrap width="100%"><?php echo htmlspecialchars($a['name']); ?></td>
                            <td colspan="3" width="15"></td>
                            <td class="h" nowrap><?php echo htmlspecialchars($a['developer']); ?></td>
                            <td colspan="3" width="15"></td>
                            <td class="h" nowrap align="center"><span class="ReleaseDateAvailable"><?php echo htmlspecialchars($a['availability']); ?></span></td>
                            <td colspan="3" width="15"></td>
                            <td class="h" nowrap align="right"><span class="price_text"><?php echo $price_txt; ?></span></td>
                            <td colspan="3" width="5"></td>
                        </tr>
                        <?php endforeach; ?>
                        </table>
                        <?php endif; ?>
                    </span>
                    </td></tr>
                    </table>
                </td>
            </tr>
            </table>
        </td>
        <td bgcolor="#FFFFFF" valign="top" style="width:10px;height:10px"><img src="img/storefront/sp_top_right.gif"></td>
    </tr>
    <tr><td bgcolor="#FFFFFF"></td><td bgcolor="#FFFFFF"></td></tr>
    <tr>
        <td bgcolor="#FFFFFF" valign="bottom" style="width:10px;height:10px"><img src="img/storefront/sp_bottom_left.gif"></td>
        <td bgcolor="#FFFFFF" valign="bottom" style="width:10px;height:10px"><img src="img/storefront/sp_bottom_right.gif"></td>
    </tr>
    </table>
</td></tr>
<tr><td>
    <div style="float:center;padding:8px 0;background:#4c5844;margin-bottom:0;width:100%;font-size:7pt;line-height:8pt;color:#75806f;">
        <table cellpadding="0" cellspacing="0">
        <tr>
            <td><a href="http://www.valvesoftware.com/"><img src="img/valve_greenlogo.gif" border="0"></a></td>
            <td>&nbsp;</td>
            <td><span style="font-size:7pt;line-height:8pt;color:#75806f;">&copy; 2006 Valve Corporation. All rights reserved.</span></td>
            <td width="15%">&nbsp;</td>
        </tr>
        </table>
    </div>
</td></tr>
</table>
</body>
</html>
