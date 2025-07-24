
<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

// ------------------ DB Connection ------------------
$db = cms_get_db();

// ------------------ Input Handling -----------------
$term       = trim($_GET['term'] ?? '');
$type       = $_GET['type'] ?? '';
$category   = $_GET['category'] ?? '';
$developer  = trim($_GET['developer'] ?? '');
$price      = $_GET['price'] ?? '';
$order      = $_GET['order'] ?? '';
$sort_by    = $_GET['sort_by'] ?? 'Name';
$sort_last  = $_GET['sort_last'] ?? $sort_by;
$sort_order = strtoupper($_GET['sort_order'] ?? 'ASC') === 'DESC' ? 'DESC' : 'ASC';
$browse     = $_GET['browse'] ?? '1';
$lang       = $_GET['l'] ?? 'english';
$s          = $_GET['s'] ?? '';
$i          = $_GET['i'] ?? '';
$a          = $_GET['a'] ?? '';

// Build canonical URL for links
function build_url(array $params){
    $order = [
        'area','term','type','category','developer','price','order',
        'sort_by','sort_last','sort_order','browse','l','s','i','a'
    ];
    $out = [];
    foreach ($order as $k) {
        $out[$k] = $params[$k] ?? '';
    }
    return 'index.php?' . http_build_query($out, '', '&');
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
    'browse'     => $browse,
    'l'          => $lang,
    's'          => $s,
    'i'          => $i,
    'a'          => $a
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
$developers = $db->query('SELECT name FROM store_developers ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
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

$theme = cms_get_setting('theme','2005_v2');
$links = cms_load_store_links(__FILE__);
$page  = cms_get_store_page('search');
$tpl = cms_theme_layout('default.twig', $theme);
cms_render_template($tpl, [
    'base_params' => $base_params,
    'developers'  => $developers,
    'categories'  => $categories,
    'prices'      => $prices,
    'apps'        => $apps,
    'term'        => $term,
    'developer'   => $developer,
    'category'    => $category,
    'price'       => $price,
    'sort_last'   => $sort_last,
    'sort_order'  => $sort_order,
    'links'       => $links,
    'lang'        => $lang,
    's'           => $s,
    'i'           => $i,
    'a'           => $a,
    'page'        => $page,
    'page_title'  => $page['title'],
    'theme_subdir'=> 'storefront'
]);
