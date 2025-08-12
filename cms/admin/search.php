<?php
require_once 'admin_header.php';

$q = trim($_GET['q'] ?? '');
$results = [];
if ($q !== '') {
    $like = '%' . $q . '%';

    // Administration pages: search by file name/title
    foreach (glob(__DIR__ . '/*.php') as $file) {
        $base = basename($file);
        if (in_array($base, ['admin_header.php','admin_footer.php','breadcrumbs.php','search.php'])) {
            continue;
        }
        $title = ucwords(str_replace('_', ' ', basename($file, '.php')));
        if (stripos($title, $q) !== false) {
            $results['Administration pages'][] = [
                'title' => $title,
                'url'   => $base,
            ];
        }
    }

    // Admin users
    $stmt = $db->prepare('SELECT id,username,first_name,last_name FROM admin_users WHERE username LIKE ? OR first_name LIKE ? OR last_name LIKE ?');
    $stmt->execute([$like,$like,$like]);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $name = trim($row['first_name'].' '.$row['last_name']);
        $label = $name !== '' ? $name . ' (' . $row['username'] . ')' : $row['username'];
        $results['Admin users'][] = [
            'title' => $label,
            'url'   => 'admin_users.php?edit=' . $row['id'],
        ];
    }

    // 2006 capsules
    $stmt = $db->prepare("SELECT c.id, COALESCE(c.title,a.name) AS title FROM storefront_capsule_items c LEFT JOIN store_apps a ON c.appid=a.appid WHERE (c.title LIKE ? OR a.name LIKE ?) AND c.theme LIKE '2006%'");
    $stmt->execute([$like,$like]);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $results['2006 capsules'][] = [
            'title' => $row['title'],
            'url'   => 'capsule_management_2006.php?edit=' . $row['id'],
        ];
    }

    // Storefront products grouped by category
    $stmt = $db->prepare('SELECT a.appid,a.name,COALESCE(GROUP_CONCAT(sc.name),"Uncategorized") AS cats FROM store_apps a LEFT JOIN app_categories ac ON a.appid=ac.appid LEFT JOIN store_categories sc ON ac.category_id=sc.id WHERE a.name LIKE ? GROUP BY a.appid,a.name');
    $stmt->execute([$like]);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $cats = explode(',', $row['cats']);
        foreach ($cats as $cat) {
            $cat = $cat !== '' ? $cat : 'Uncategorized';
            $results['Storefront products'][$cat][] = [
                'title' => $row['name'],
                'url'   => 'storefront_product.php?appid=' . $row['appid'],
            ];
        }
    }

    // Generic database search across remaining tables
    $tables = $db->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        if (in_array($table, ['admin_users','storefront_capsule_items','store_apps','app_categories','store_categories'])) {
            continue; // already categorized above
        }
        $cols = $db->query("SHOW COLUMNS FROM `{$table}`")->fetchAll(PDO::FETCH_ASSOC);
        $where = [];
        $params = [];
        foreach ($cols as $col) {
            if (preg_match('/char|text/i', $col['Type'])) {
                $where[] = "`{$col['Field']}` LIKE ?";
                $params[] = $like;
            }
        }
        if (!$where) {
            continue;
        }
        $sql = "SELECT * FROM `{$table}` WHERE " . implode(' OR ', $where) . ' LIMIT 5';
        $st = $db->prepare($sql);
        $st->execute($params);
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        if ($rows) {
            $results[ucwords(str_replace('_',' ',$table))] = $rows;
        }
    }
}
?>
<h2>Search Results</h2>
<?php if ($q === ''): ?>
<p>Enter a search term above.</p>
<?php else: ?>
<p>Results for "<strong><?= htmlspecialchars($q) ?></strong>"</p>
<?php foreach ($results as $category => $items): ?>
    <h3><?= htmlspecialchars($category) ?></h3>
    <?php if ($category === 'Storefront products'): ?>
        <?php foreach ($items as $catName => $prods): ?>
            <h4><?= htmlspecialchars($catName) ?></h4>
            <ul>
            <?php foreach ($prods as $item): ?>
                <li><a href="<?= htmlspecialchars($item['url']) ?>"><?= htmlspecialchars($item['title']) ?></a></li>
            <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    <?php elseif (isset($items[0]['title'])): ?>
        <ul>
        <?php foreach ($items as $item): ?>
            <li><a href="<?= htmlspecialchars($item['url']) ?>"><?= htmlspecialchars($item['title']) ?></a></li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <pre><?= htmlspecialchars(print_r($items, true)) ?></pre>
    <?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php include 'admin_footer.php'; ?>
