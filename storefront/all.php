<?php
require_once __DIR__.'/../cms/header.php';
$db=cms_get_db();
$sql = 'SELECT a.*, GROUP_CONCAT(sc.name ORDER BY sc.ord SEPARATOR ", ") as cats '
      'FROM store_apps a '
      'LEFT JOIN app_categories ac ON a.appid=ac.appid '
      'LEFT JOIN store_categories sc ON ac.category_id=sc.id '
      'GROUP BY a.appid ORDER BY a.name';
$apps=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>All Games</h1>
<table class="table">
<tr><th>ID</th><th>Name</th><th>Categories</th><th>Developer</th><th>Price</th><th>Avail</th></tr>
<?php foreach($apps as $a): ?>
<tr>
  <td><a href="../index.php?area=game&AppId=<?php echo $a['appid']?>&"><?php echo $a['appid']?></a></td>
  <td><?php echo htmlspecialchars($a['name'])?></td>
  <td><?php echo htmlspecialchars($a['cats'])?></td>
  <td><?php echo htmlspecialchars($a['developer'])?></td>
  <td><?php echo $a['price']?></td>
  <td><?php echo htmlspecialchars($a['availability'])?></td>
</tr>
<?php endforeach; ?>
</table>
<?php include __DIR__.'/../cms/footer.php'; ?>

