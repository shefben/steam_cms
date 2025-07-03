<?php
require_once __DIR__.'/../cms/header.php';
$db = cms_get_db();
$where = [];
$params = [];
if(isset($_GET['developer'])){
    $where[] = 'developer=?';
    $params[] = $_GET['developer'];
}
if(isset($_GET['category'])){
    $where[] = 'appid IN (SELECT appid FROM app_categories WHERE category_id=?)';
    $params[] = (int)$_GET['category'];
}
if(isset($_GET['price'])){
    if(strpos($_GET['price'],'-')!==false){
        list($min,$max)=array_map('intval',explode('-',$_GET['price'],2));
        $where[]='price BETWEEN ? AND ?';
        $params[]=$min/100; $params[]=$max/100;
    }else{
        $where[] = 'price <= ?';
        $params[] = (int)$_GET['price']/100;
    }
}
if(isset($_GET['text'])){
    $where[] = 'name LIKE ?';
    $params[] = '%'.$_GET['text'].'%';
}
$sort_fields=['Price'=>'price','Name'=>'name','Developer'=>'developer'];
$key=$_GET['sort_by'] ?? '';
$sort_by = $sort_fields[$key] ?? 'appid';
$order = strtoupper($_GET['sort_order'] ?? 'ASC') === 'DESC' ? 'DESC' : 'ASC';
$sql = 'SELECT * FROM store_apps';
if($where) $sql .= ' WHERE '.implode(' AND ', $where);
$sql .= " ORDER BY $sort_by $order";
$apps = $db->prepare($sql);
$apps->execute($params);
$apps = $apps->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>Search Results</h1>
<table class="table">
<tr><th>ID</th><th>Name</th><th>Developer</th><th>Price</th><th>Avail</th></tr>
<?php foreach($apps as $a): ?>
<tr>
<td><a href="../index.php?area=game&AppId=<?php echo $a['appid']?>&"><?php echo $a['appid']?></a></td>
<td><?php echo htmlspecialchars($a['name'])?></td>
<td><?php echo htmlspecialchars($a['developer'])?></td>
<td><?php echo $a['price']?></td>
<td><?php echo htmlspecialchars($a['availability'])?></td>
</tr>
<?php endforeach; ?>
</table>
<?php require_once __DIR__.'/../cms/footer.php'; ?>
