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
if (in_array($country, ['US','CA','MY'], true)) {
    $states = cms_cafe_state_names($country);
    if ($state && !isset($states[$state])) {
        $state = '';
    }
} else {
    $state = '';
}

if (isset($_GET['states']) && $country) {
    header('Content-Type: application/json');
    echo json_encode(cms_cafe_state_names($country));
    exit;
}

if ($country) {
    if ($state !== '') {
        $stmt = $db->prepare('SELECT * FROM cafe_directory WHERE country=? AND state=? ORDER BY ord,id');
        $stmt->execute([$country,$state]);
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

$tbodyHtml = '';
foreach ($entries as $e) {
    $tbodyHtml .= '<tr data-id="'.$e['id'].'"><form method="post">';
    $tbodyHtml .= '<td class="handle">&#9776;</td>';
    $tbodyHtml .= '<td><input type="text" name="name" value="'.htmlspecialchars($e['name']).'"></td>';
    $tbodyHtml .= '<td><input type="text" name="url" value="'.htmlspecialchars($e['url']).'"></td>';
    $tbodyHtml .= '<td><input type="text" name="phone" value="'.htmlspecialchars($e['phone']).'"></td>';
    $tbodyHtml .= '<td><input type="text" name="address" value="'.htmlspecialchars($e['address']).'"></td>';
    $tbodyHtml .= '<td><input type="text" name="city_state" value="'.htmlspecialchars($e['city_state']).'"></td>';
    $tbodyHtml .= '<td><input type="text" name="zip" value="'.htmlspecialchars($e['zip']).'"></td>';
    $tbodyHtml .= '<td>';
    $tbodyHtml .= '<input type="hidden" name="id" value="'.$e['id'].'">';
    if ($country) { $tbodyHtml .= '<input type="hidden" name="country_filter" value="'.$country.'">'; }
    if ($state !== '') { $tbodyHtml .= '<input type="hidden" name="state_filter" value="'.htmlspecialchars($state).'">'; }
    $tbodyHtml .= '<button name="update" value="1">Update</button>';
    $tbodyHtml .= ' <button name="delete_single" value="'.$e['id'].'" onclick="return confirm(\'Delete?\')">Delete</button>';
    $tbodyHtml .= '</td></form></tr>';
}

ob_start();
$q = '';
if ($country) {
    $q = 'country='.$country.'&';
    if ($state !== '') { $q .= 'state='.urlencode($state).'&'; }
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
<?php
$paginationHtml = ob_get_clean();

if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    echo json_encode(['tbody'=>$tbodyHtml,'pagination'=>$paginationHtml]);
    exit;
}
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
    <label for="state-select" id="state-label" style="<?php echo $states ? '' : 'display:none'; ?>">State:</label>
    <select id="state-select" name="state" style="<?php echo $states ? '' : 'display:none'; ?>">
        <option value="">All</option>
        <?php foreach ($states as $scode => $sname): ?>
            <option value="<?php echo htmlspecialchars($scode); ?>"<?php if ($scode === $state) echo ' selected'; ?>><?php echo htmlspecialchars($sname); ?></option>
        <?php endforeach; ?>
    </select>
    <noscript><button type="submit">Go</button></noscript>
</form>
<input type="hidden" id="dir-order" name="order">
<table border="1" id="dir-table">
<tr><th></th><th>Name</th><th>URL</th><th>Phone</th><th>Address</th><th>City/State</th><th>Zip</th><th>Actions</th></tr>
<tbody id="dir-body">
<?php echo $tbodyHtml; ?>
</tbody>
</table>
<?php echo $paginationHtml; ?>
<h3>Add Entry</h3>
<form method="post" id="add-form">
<label for="add-country">Country:</label>
<select name="country_filter" id="add-country">
    <?php foreach ($countries as $code => $name): ?>
        <option value="<?php echo $code; ?>"<?php if ($code === $country) echo ' selected'; ?>><?php echo htmlspecialchars($name); ?></option>
    <?php endforeach; ?>
</select>
<input type="hidden" name="state_filter" id="add-state" value="<?php echo htmlspecialchars($state); ?>">
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
    var body=document.getElementById('dir-body');
    function sendOrder(){
        var ids=[];
        $('#dir-body tr').each(function(){ids.push(this.dataset.id);});
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('order',ids.join(','));
        fetch('cafe_directory.php',{method:'POST',body:data});
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});

    function loadTable(country,state,page){
        $.get('cafe_directory.php',{ajax:1,country:country,state:state,page:page||1},function(res){
            $('#dir-body').html(res.tbody);
            $('.pagination').replaceWith(res.pagination);
            $('#add-country').val(country);
            $('#add-state').val(state);
        },'json');
    }

    function loadStates(country){
        $.get('cafe_directory.php',{states:1,country:country},function(res){
            var sel=$('#state-select');
            sel.empty().append($('<option>',{value:'',text:'All'}));
            $.each(res,function(code,name){ sel.append($('<option>',{value:code,text:name})); });
            $('#state-label, #state-select').show();
        },'json');
    }

    var currentCountry=$('#country-select').val();
    var currentState=$('#state-select').val();

    $('#country-select').on('change',function(){
        currentCountry=this.value;
        currentState='';
        $('#state-select').val('');
        if($.inArray(this.value,['US','CA','MY'])!==-1){
            loadStates(this.value);
        }else{
            $('#state-label, #state-select').hide();
            loadTable(this.value,'');
        }
    });

    $('#state-select').on('change',function(){
        currentState=this.value;
        loadTable(currentCountry,currentState);
    });

    $('.pagination').on('click','a',function(e){
        e.preventDefault();
        var p=parseInt(new URL(this.href).searchParams.get('page'))||1;
        loadTable(currentCountry,currentState,p);
    });
});
</script>
<?php include 'admin_footer.php'; ?>
