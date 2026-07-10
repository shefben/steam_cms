<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/admin_auth.php';
require_once dirname(__DIR__).'/cafe_utils.php';
cms_require_permission('manage_pages');
$db = cms_get_db();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']);
    if(isset($_POST['reorder']) && isset($_POST['order'])){
        $ids = array_map('intval', explode(',', $_POST['order']));
        foreach($ids as $i=>$id){
            $db->prepare('UPDATE cafe_directory SET ord=? WHERE id=?')->execute([$i+1,$id]);
        }
        if($isAjax){ echo 'ok'; exit; }
    }
    if(isset($_POST['add'])){
        $ins=$db->prepare('INSERT INTO cafe_directory(url,name,phone,address,city_state,zip,ord,country,state) VALUES(?,?,?,?,?,?,?,?,?)');
        $ins->execute([
            $_POST['url'] ?? '',
            $_POST['name'] ?? '',
            $_POST['phone'] ?? '',
            $_POST['address'] ?? '',
            $_POST['city_state'] ?? '',
            $_POST['zip'] ?? '',
            $_POST['ord'] ?? 0,
            $_POST['country_filter'] ?? 'US',
            $_POST['state_filter'] ?: null
        ]);
        if($isAjax){ header('Content-Type: application/json'); echo json_encode(['success'=>true,'id'=>$db->lastInsertId()]); exit; }
        header('Location: cafe_directory.php'); exit;
    }
    if(isset($_POST['update'])){
        $stmt=$db->prepare('UPDATE cafe_directory SET url=?,name=?,phone=?,address=?,city_state=?,zip=? WHERE id=?');
        $stmt->execute([$_POST['url'] ?? '',$_POST['name'] ?? '',$_POST['phone'] ?? '',$_POST['address'] ?? '',$_POST['city_state'] ?? '',$_POST['zip'] ?? '',$_POST['id']]);
        if($isAjax){ header('Content-Type: application/json'); echo json_encode(['success'=>true]); exit; }
        header('Location: cafe_directory.php'); exit;
    }
    if(isset($_POST['delete_single'])){
        $stmt=$db->prepare('DELETE FROM cafe_directory WHERE id=?');
        $stmt->execute([$_POST['delete_single']]);
        if($isAjax){ header('Content-Type: application/json'); echo json_encode(['success'=>true]); exit; }
        header('Location: cafe_directory.php'); exit;
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

if (isset($_GET['get'])) {
    $stmt = $db->prepare('SELECT * FROM cafe_directory WHERE id=?');
    $stmt->execute([(int)$_GET['get']]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC) ?: []);
    exit;
}

require_once 'admin_header.php';

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
    $tbodyHtml .= '<tr data-id="'.$e['id'].'">';
    $tbodyHtml .= '<td class="handle">&#9776;</td>';
    $tbodyHtml .= '<td>'.htmlspecialchars($e['name'] ?? '').'</td>';
    $tbodyHtml .= '<td>'.htmlspecialchars($e['url'] ?? '').'</td>';
    $tbodyHtml .= '<td>'.htmlspecialchars($e['phone'] ?? '').'</td>';
    $tbodyHtml .= '<td>'.htmlspecialchars($e['address'] ?? '').'</td>';
    $tbodyHtml .= '<td>'.htmlspecialchars($e['city_state'] ?? '').'</td>';
    $tbodyHtml .= '<td>'.htmlspecialchars($e['zip'] ?? '').'</td>';
    $tbodyHtml .= '<td>';
    $tbodyHtml .= '<button type="button" class="btn btn-primary btn-small edit-btn" data-id="'.$e['id'].'">Edit</button>';
    $tbodyHtml .= ' <button type="button" class="btn btn-danger btn-small delete-btn" data-id="'.$e['id'].'">Delete</button>';
    $tbodyHtml .= '</td></tr>';
}

ob_start();
$q_params = [];
if ($country !== '') {
    $q_params[] = 'country=' . urlencode($country);
}
if ($state !== '') {
    $q_params[] = 'state=' . urlencode($state);
}
$q = implode('&', $q_params) . ($q_params ? '&' : '');
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
<p class="page-description" style="color:#666;margin-bottom:15px;">Manage the public Internet Cafe directory listings shown on the storefront, filterable by country/state.</p>
<p><button type="button" id="add-cafe-btn" class="btn btn-primary">Add New Cafe</button></p>
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
<table border="1" id="dir-table">
<tr><th></th><th>Name</th><th>URL</th><th>Phone</th><th>Address</th><th>City/State</th><th>Zip</th><th>Actions</th></tr>
<tbody id="dir-body">
<?php echo $tbodyHtml; ?>
</tbody>
</table>
<?php echo $paginationHtml; ?>

<div id="cafeModalOverlay" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:1000;justify-content:center;align-items:center;">
  <div class="modal" role="dialog" aria-modal="true" style="background:white;border-radius:8px;padding:0;width:90%;max-width:500px;box-shadow:0 4px 12px rgba(0,0,0,0.3);">
    <form id="cafeForm">
      <input type="hidden" name="id" id="cafe-id">
      <div style="padding:20px;border-bottom:1px solid #ddd;">
        <h3 id="cafeModalTitle" style="margin:0;">Add Cafe</h3>
      </div>
      <div class="modal-body" style="padding:20px;max-height:600px;overflow-y:auto;">
        <div style="margin-bottom:12px;">
          <label style="display:block;margin-bottom:4px;font-weight:bold;">Country:</label>
          <select name="country_filter" id="cafe-country" style="width:100%;padding:8px;">
              <?php foreach ($countries as $code => $name): ?>
              <option value="<?php echo $code; ?>"<?php if ($code === $country) echo ' selected'; ?>><?php echo htmlspecialchars($name); ?></option>
              <?php endforeach; ?>
          </select>
        </div>
        <input type="hidden" name="state_filter" id="cafe-state" value="<?php echo htmlspecialchars($state); ?>">
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Order:</label>
          <input type="number" name="ord" id="cafe-ord" value="0" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Name:</label>
          <input type="text" name="name" id="cafe-name" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">URL:</label>
          <input type="text" name="url" id="cafe-url" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Phone:</label>
          <input type="text" name="phone" id="cafe-phone" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Address:</label>
          <input type="text" name="address" id="cafe-address" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">City/State:</label>
          <input type="text" name="city_state" id="cafe-city-state" style="width:100%;padding:8px;"></div>
        <div style="margin-bottom:12px;"><label style="display:block;margin-bottom:4px;font-weight:bold;">Zip:</label>
          <input type="text" name="zip" id="cafe-zip" style="width:100%;padding:8px;"></div>
      </div>
      <div class="modal-footer" style="padding:15px 20px;border-top:1px solid #ddd;display:flex;justify-content:flex-end;gap:10px;">
        <button type="button" id="cafeCancel" class="btn" style="padding:8px 16px;border:1px solid #ccc;border-radius:4px;background:#f5f5f5;cursor:pointer;">Cancel</button>
        <button type="submit" class="btn btn-primary" style="padding:8px 16px;border:none;border-radius:4px;background:#007bff;color:white;cursor:pointer;">Save</button>
      </div>
    </form>
  </div>
</div>
<script>
$(function(){
    var body=document.getElementById('dir-body');
    var formHasChanges=false;
    function sendOrder(){
        var ids=[];
        $('#dir-body tr').each(function(){ids.push(this.dataset.id);});
        $.post('cafe_directory.php',{reorder:1,order:ids.join(',')}).fail(function(xhr){
            console.error('cafe_directory: reorder save failed', xhr.status, xhr.responseText);
        });
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});

    function loadTable(country,state,page){
        $.get('cafe_directory.php',{ajax:1,country:country,state:state,page:page||1},function(res){
            $('#dir-body').html(res.tbody);
            $('.pagination').replaceWith(res.pagination);
        },'json').fail(function(xhr){
            console.error('cafe_directory loadTable failed:', xhr.responseText);
        });
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

    $(document).on('click','.pagination a',function(e){
        e.preventDefault();
        var match = this.href.match(/[?&]page=(\d+)/);
        var p = match ? parseInt(match[1]) : 1;
        loadTable(currentCountry,currentState,p);
    });

    function openModal(id){
        $('#cafeForm')[0].reset();
        $('#cafe-id').val('');
        $('#cafe-country').val(currentCountry || 'US');
        $('#cafe-state').val(currentState || '');
        formHasChanges=false;
        if(id){
            $('#cafeModalTitle').text('Edit Cafe');
            $.get('cafe_directory.php',{get:id},function(d){
                $('#cafe-id').val(d.id);
                $('#cafe-country').val(d.country || currentCountry || 'US');
                $('#cafe-state').val(d.state || '');
                $('#cafe-ord').val(d.ord || 0);
                $('#cafe-name').val(d.name || '');
                $('#cafe-url').val(d.url || '');
                $('#cafe-phone').val(d.phone || '');
                $('#cafe-address').val(d.address || '');
                $('#cafe-city-state').val(d.city_state || '');
                $('#cafe-zip').val(d.zip || '');
                formHasChanges=false;
            },'json').fail(function(xhr){
                console.error('cafe_directory: load entry failed', xhr.status, xhr.responseText);
            });
        }else{
            $('#cafeModalTitle').text('Add Cafe');
        }
        $('#cafeModalOverlay').css('display','flex');
    }
    function closeModal(){
        if(formHasChanges && !confirm('You have unsaved changes. Are you sure you want to discard them?')){
            return;
        }
        $('#cafeModalOverlay').hide();
        $('#cafeForm')[0].reset();
        formHasChanges=false;
    }
    $('#cafeForm input, #cafeForm select').on('change keyup',function(){ formHasChanges=true; });
    $('#cafeModalOverlay').on('click',function(e){
        if(e.target.id === 'cafeModalOverlay'){ closeModal(); }
    });
    $('#add-cafe-btn').on('click',function(){ openModal(); });
    $('#dir-body').on('click','.edit-btn',function(){ openModal($(this).data('id')); });
    $('#dir-body').on('click','.delete-btn',function(){
        var id=$(this).data('id');
        if(confirm('Delete this cafe?')){
            $.post('cafe_directory.php',{delete_single:id},function(){
                loadTable(currentCountry,currentState);
            });
        }
    });
    $('#cafeCancel').on('click',function(){ closeModal(); });
    $('#cafeForm').on('submit',function(e){
        e.preventDefault();
        var id=$('#cafe-id').val();
        var data=$(this).serialize();
        data += id ? '&update=1' : '&add=1';
        $.post('cafe_directory.php',data,function(){
            formHasChanges=false;
            $('#cafeModalOverlay').hide();
            loadTable(currentCountry,currentState);
        }).fail(function(xhr){
            console.error('cafe_directory: save failed', xhr.status, xhr.responseText);
            alert('Failed to save entry.');
        });
    });
});
</script>
<?php include 'admin_footer.php'; ?>
