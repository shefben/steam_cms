<?php
require_once 'admin_header.php';
require_once dirname(__DIR__).'/cafe_utils.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['reorder']) && isset($_POST['order'])){
        $ids = array_map('intval', explode(',', $_POST['order']));
        foreach($ids as $i=>$id){
            $db->prepare('UPDATE cafe_directory SET ord=? WHERE id=?')->execute([$i+1,$id]);
        }
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){ echo 'ok'; exit; }
    }
    if(isset($_POST['add'])){
        $ins=$db->prepare('INSERT INTO cafe_directory(url,name,phone,address,city_state,zip,ord,country,state) VALUES(?,?,?,?,?,?,?,?,?)');
        $ins->execute([
            $_POST['url'],
            $_POST['name'],
            $_POST['phone'],
            $_POST['address'],
            $_POST['city_state'],
            $_POST['zip'],
            $_POST['ord'],
            $_POST['country_filter'] ?? 'US',
            null
        ]);
        $redir = 'cafe_directory.php';
        if (!empty($_POST['country_filter'])) {
            $redir .= '?country='.urlencode($_POST['country_filter']);
            if (!empty($_POST['state_filter'])) {
                $redir .= '&state='.urlencode($_POST['state_filter']);
            }
        }
        header('Location: '.$redir); exit;
    }
    if(isset($_POST['update'])){
        $stmt=$db->prepare('UPDATE cafe_directory SET url=?,name=?,phone=?,address=?,city_state=?,zip=?,ord=? WHERE id=?');
        $stmt->execute([$_POST['url'],$_POST['name'],$_POST['phone'],$_POST['address'],$_POST['city_state'],$_POST['zip'],$_POST['ord'],$_POST['id']]);
        $redir = 'cafe_directory.php';
        if (!empty($_POST['country_filter'])) {
            $redir .= '?country='.urlencode($_POST['country_filter']);
            if (!empty($_POST['state_filter'])) {
                $redir .= '&state='.urlencode($_POST['state_filter']);
            }
        }
        header('Location: '.$redir); exit;
    }
    if(isset($_POST['delete_single'])){
        $stmt=$db->prepare('DELETE FROM cafe_directory WHERE id=?');
        $stmt->execute([$_POST['delete_single']]);
        $redir = 'cafe_directory.php';
        if (!empty($_POST['country_filter'])) {
            $redir .= '?country='.urlencode($_POST['country_filter']);
            if (!empty($_POST['state_filter'])) {
                $redir .= '&state='.urlencode($_POST['state_filter']);
            }
        }
        header('Location: '.$redir); exit;
    }
}

$countries = cms_cafe_country_names();
$country = isset($_GET['country']) ? strtoupper(preg_replace('/[^A-Z]/', '', $_GET['country'])) : '';
if ($country && !isset($countries[$country])) {
    $country = '';
}
$state = isset($_GET['state']) ? preg_replace('/[^A-Za-z0-9 ]/', '', $_GET['state']) : '';
if (!$country) {
    $state = '';
}
$states = [];
if (in_array($country, ['US', 'CA', 'MY'], true)) {
    $states = cms_cafe_state_names($country);
    if ($state && !isset($states[$state])) {
        $state = '';
    }
} else {
    $state = '';
}

if ($country) {
    if ($state !== '') {
        $stmt = $db->prepare('SELECT * FROM cafe_directory WHERE country=? AND state=? ORDER BY ord,id');
        $stmt->execute([$country, $state]);
    } else {
        $stmt = $db->prepare('SELECT * FROM cafe_directory WHERE country=? ORDER BY ord,id');
        $stmt->execute([$country]);
    }
    $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $all = $db->query('SELECT * FROM cafe_directory ORDER BY ord,id')->fetchAll(PDO::FETCH_ASSOC);
}

$page = max(1, (int)($_GET['page'] ?? 1));
$per = 15;
$total = count($all);
$pages = max(1, ceil($total / $per));
$page = min($page, $pages);
$entries = array_slice($all, ($page - 1) * $per, $per);
?>
<h2>Cafe Directory</h2>
<form id="country-filter" method="get" style="margin-bottom:10px">
    <label for="country-select">Country:</label>
    <select id="country-select" name="country">
        <option value="">All</option>
        <?php foreach ($countries as $code => $name): ?>
            <option value="<?php echo $code; ?>"<?php if ($code === $country) echo ' selected'; ?>><?php echo htmlspecialchars($name); ?></option>
        <?php endforeach; ?>
    </select>
    <?php if ($states): ?>
        <label for="state-select">State:</label>
        <select id="state-select" name="state">
            <option value="">All</option>
            <?php foreach ($states as $scode => $sname): ?>
                <option value="<?php echo htmlspecialchars($scode); ?>"<?php if ($scode === $state) echo ' selected'; ?>><?php echo htmlspecialchars($sname); ?></option>
            <?php endforeach; ?>
        </select>
    <?php endif; ?>
    <noscript><button type="submit">Go</button></noscript>
</form>
<input type="hidden" id="dir-order" name="order">
<table border="1" id="dir-table">
<tr><th></th><th>Name</th><th>URL</th><th>Phone</th><th>Address</th><th>City/State</th><th>Zip</th><th>Actions</th></tr>
<tbody id="dir-body">
<?php foreach($entries as $e): ?>
<tr data-id="<?php echo $e['id']; ?>"><form method="post">
<td class="handle">&#9776;</td>
<td><input type="text" name="name" value="<?php echo htmlspecialchars($e['name']); ?>"></td>
<td><input type="text" name="url" value="<?php echo htmlspecialchars($e['url']); ?>"></td>
<td><input type="text" name="phone" value="<?php echo htmlspecialchars($e['phone']); ?>"></td>
<td><input type="text" name="address" value="<?php echo htmlspecialchars($e['address']); ?>"></td>
<td><input type="text" name="city_state" value="<?php echo htmlspecialchars($e['city_state']); ?>"></td>
<td><input type="text" name="zip" value="<?php echo htmlspecialchars($e['zip']); ?>"></td>
<td>
<input type="hidden" name="id" value="<?php echo $e['id']; ?>">
<?php if($country): ?>
<input type="hidden" name="country_filter" value="<?php echo $country; ?>">
<?php endif; ?>
<?php if($state !== ''): ?>
<input type="hidden" name="state_filter" value="<?php echo htmlspecialchars($state); ?>">
<?php endif; ?>
<button name="update" value="1">Update</button>
<button name="delete_single" value="<?php echo $e['id']; ?>" onclick="return confirm('Delete?')">Delete</button>
</td>
</form></tr>
<?php endforeach; ?>
</tbody>
</table>
<?php
$q = '';
if ($country) {
    $q = 'country='.$country.'&';
    if ($state !== '') {
        $q .= 'state='.urlencode($state).'&';
    }
}
?>
<div class="pagination">
<?php if($page>1): ?><a href="?<?php echo $q; ?>page=<?php echo $page-1; ?>">&laquo; Prev</a><?php endif; ?>
<?php for($i=1;$i<=$pages;$i++): ?>
    <?php if($i==$page): ?>
        <strong><?php echo $i; ?></strong>
    <?php else: ?>
        <a href="?<?php echo $q; ?>page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endif; ?>
<?php endfor; ?>
<?php if($page<$pages): ?><a href="?<?php echo $q; ?>page=<?php echo $page+1; ?>">Next &raquo;</a><?php endif; ?>
</div>
<h3>Add Entry</h3>
<form method="post">
<?php if($country): ?>
<input type="hidden" name="country_filter" value="<?php echo $country; ?>">
<?php endif; ?>
<?php if($state !== ''): ?>
<input type="hidden" name="state_filter" value="<?php echo htmlspecialchars($state); ?>">
<?php endif; ?>
Order <input type="number" name="ord" value="0" style="width:50px">
Name <input type="text" name="name">
URL <input type="text" name="url">
Phone <input type="text" name="phone">
Address <input type="text" name="address">
City/State <input type="text" name="city_state">
Zip <input type="text" name="zip">
<button name="add" value="1">Add</button>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
$(function(){
    var body = document.getElementById('dir-body');
    function sendOrder(){
        var ids = [];
        $('#dir-body tr').each(function(){ ids.push(this.dataset.id); });
        var data = new URLSearchParams();
        data.set('reorder','1');
        data.set('order', ids.join(','));
        fetch('cafe_directory.php<?php echo $country ? '?country='.urlencode($country).($state!==''?'&state='.urlencode($state):'') : '';?>',{method:'POST',body:data});
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});
    $('#country-select').on('change', function () {
        if ($.inArray(this.value, ['US', 'CA', 'MY']) === -1) {
            $('#state-select').val('');
        }
        $('#country-filter').submit();
    });
});
</script>
<?php include 'admin_footer.php'; ?>
