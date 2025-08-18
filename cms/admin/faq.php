<?php
require_once 'admin_header.php';
cms_require_any_permission(['manage_faq','faq_add','faq_edit','faq_delete']);
$db=cms_get_db();
require_once __DIR__.'/faq_order.php';

$export = $_GET['export'] ?? '';
if ($export === 'csv' || $export === 'json') {
    cms_require_permission('faq_edit');
    $data = $db->query('SELECT faqid1,faqid2,catid1,catid2,title,body,views FROM faq_content ORDER BY faqid1,faqid2')->fetchAll(PDO::FETCH_ASSOC);
    $file = 'faq.' . ($export === 'csv' ? 'csv' : 'json');
    if ($export === 'csv') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $file);
        $out = fopen('php://output', 'w');
        if ($data) {
            fputcsv($out, array_keys($data[0]));
            foreach ($data as $r) {
                fputcsv($out, $r);
            }
        }
        fclose($out);
    } else {
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename=' . $file);
        echo json_encode($data);
    }
    exit;
}

if(isset($_POST['reorder']) && isset($_POST['order'])){
    cms_save_faq_order($_POST['order'], isset($_SERVER['HTTP_X_REQUESTED_WITH']));
    exit;
}
if(isset($_POST['delete'])){
    cms_require_permission('faq_delete');
    $stmt=$db->prepare('DELETE FROM faq_content WHERE faqid1=? AND faqid2=?');
    $stmt->execute([$_POST['faqid1'],$_POST['faqid2']]);
    cms_admin_log('Deleted FAQ '.$_POST['faqid1'].'-'.$_POST['faqid2']);
}

if (isset($_GET['getfaq'])) {
    cms_require_permission('faq_edit');
    $stmt = $db->prepare('SELECT catid1,catid2,title,body FROM faq_content WHERE faqid1=? AND faqid2=?');
    $stmt->execute([(int)$_GET['faqid1'], (int)$_GET['faqid2']]);
    header('Content-Type: application/json');
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit;
}

if (isset($_POST['ajax_save'])) {
    $faqid1 = (int)($_POST['faqid1'] ?? 0);
    $faqid2 = (int)($_POST['faqid2'] ?? 0);
    $cat = explode(',', $_POST['category']);
    $title = $_POST['title'];
    $body  = $_POST['body'];
    if ($faqid1 && $faqid2) {
        cms_require_permission('faq_edit');
        $db->prepare('UPDATE faq_content SET catid1=?,catid2=?,title=?,body=? WHERE faqid1=? AND faqid2=?')
            ->execute([$cat[0], $cat[1], $title, $body, $faqid1, $faqid2]);
        cms_admin_log('Updated FAQ '.$faqid1.'-'.$faqid2);
    } else {
        cms_require_permission('faq_add');
        $t = microtime(true);
        $sec = floor($t);
        $usec = (int)(($t - $sec) * 1e6);
        $faqid1 = $sec;
        $faqid2 = $usec * 100;
        $db->prepare('INSERT INTO faq_content(catid1,catid2,faqid1,faqid2,title,body) VALUES(?,?,?,?,?,?)')
            ->execute([$cat[0], $cat[1], $faqid1, $faqid2, $title, $body]);
        cms_admin_log('Created FAQ '.$faqid1.'-'.$faqid2);
    }
    $catstmt = $db->prepare('SELECT name FROM faq_categories WHERE id1=? AND id2=?');
    $catstmt->execute([$cat[0], $cat[1]]);
    $catname = $catstmt->fetchColumn() ?: '';
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'faqid1' => $faqid1,
        'faqid2' => $faqid2,
        'catid1' => $cat[0],
        'catid2' => $cat[1],
        'catname' => $catname,
        'title' => $title,
        'body' => $body
    ]);
    exit;
}
$rows=$db->query('SELECT f.*,c.name as catname FROM faq_content f JOIN faq_categories c ON c.id1=f.catid1 AND c.id2=f.catid2 ORDER BY c.name,title')->fetchAll(PDO::FETCH_ASSOC);
$cats=$db->query('SELECT * FROM faq_categories ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
$order = cms_get_setting('faq_order','');
$order = $order !== '' ? explode(',', $order) : [];
usort($rows,function($a,$b) use($order){
    $ia = array_search($a['faqid1'].'-'.$a['faqid2'],$order);
    $ib = array_search($b['faqid1'].'-'.$b['faqid2'],$order);
    if($ia===false) $ia = PHP_INT_MAX;
    if($ib===false) $ib = PHP_INT_MAX;
    return $ia <=> $ib;
});
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 15;
$total = count($rows);
$pages = max(1, (int)ceil($total/$perPage));
$rows = array_slice($rows, ($page-1)*$perPage, $perPage);
?>
<h2>FAQs</h2>
<?php if(cms_has_permission('faq_edit') || cms_has_permission('faq_add')): ?>
<p>
    <?php if(cms_has_permission('faq_edit')): ?>
    <a class="btn btn-secondary" href="faq.php?export=csv">Export CSV</a>
    <a class="btn btn-secondary" href="faq.php?export=json">Export JSON</a>
    <?php endif; ?>
    <?php if(cms_has_permission('faq_add')): ?>
    <a class="btn btn-secondary" href="faq_import.php">Import</a>
    <?php endif; ?>
</p>
<?php endif; ?>

<?php if(cms_has_permission('faq_add')): ?>
<p><button type="button" id="add-faq" class="btn btn-primary">Add FAQ</button></p>
<?php endif; ?>
<form id="faqOrder" method="post">
<input type="hidden" name="order" id="faq-order">
<table id="faq-table" class="data-table">
<thead><tr><th></th><th>Category</th><th>Title</th><th>Views</th><th>Actions</th></tr></thead>
<tbody id="faq-body">
<?php foreach($rows as $r): ?>
<tr data-id="<?php echo $r['faqid1'].'-'.$r['faqid2']; ?>">
<td class="handle">☰</td>
<td><?php echo htmlspecialchars($r['catname']); ?></td>
<td><?php echo htmlspecialchars($r['title']); ?></td>
<td><?php echo (int)$r['views']; ?></td>
<td>
<?php if(cms_has_permission('faq_edit')): ?>
    <button type="button" class="btn btn-primary edit-btn" data-faqid1="<?php echo $r['faqid1']; ?>" data-faqid2="<?php echo $r['faqid2']; ?>">Edit</button>
<?php endif; ?>
<?php if(cms_has_permission('faq_delete')): ?>
    <form method="post" style="display:inline"><input type="hidden" name="faqid1" value="<?php echo $r['faqid1']; ?>"><input type="hidden" name="faqid2" value="<?php echo $r['faqid2']; ?>"><input type="submit" name="delete" value="Delete"></form>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<button type="button" id="save-faq" class="btn btn-success">Save Order</button>
</form>
<div class="pagination">
<?php if($page>1): ?><a href="?page=<?php echo $page-1; ?>">&laquo; Prev</a><?php endif; ?>
<?php for($i=1;$i<=$pages;$i++): ?>
<a href="?page=<?php echo $i; ?>"<?php if($i==$page) echo ' class="current"'; ?>><?php echo $i; ?></a>
<?php endfor; ?>
<?php if($page<$pages): ?><a href="?page=<?php echo $page+1; ?>">Next &raquo;</a><?php endif; ?>
</div>
<div id="faq-modal" style="display:none;" aria-modal="true" role="dialog">
<form id="faq-form">
    <input type="hidden" name="faqid1" id="faqid1">
    <input type="hidden" name="faqid2" id="faqid2">
    <label>Category:
        <select name="category" id="faq-category">
            <?php foreach($cats as $c): ?>
            <option value="<?php echo $c['id1'].','.$c['id2']; ?>"><?php echo htmlspecialchars($c['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <br>
    <label>Title:<br><input type="text" name="title" id="faq-title"></label><br>
    <label>Body:<br><textarea name="body" id="faq-text" rows="10"></textarea></label><br>
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" id="faq-cancel" class="btn btn-secondary">Cancel</button>
    <input type="hidden" name="ajax_save" value="1">
</form>
</div>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded',function(){
    var body=document.getElementById('faq-body');
    function sendOrder(){
        var ids=[];
        body.querySelectorAll('tr').forEach(function(tr){ids.push(tr.dataset.id);});
        var data=new URLSearchParams();
        data.set('reorder','1');
        data.set('order',ids.join(','));
        fetch('faq.php',{method:'POST',body:data});
    }
    new Sortable(body,{handle:'.handle',onEnd:sendOrder});
    document.getElementById('save-faq').addEventListener('click',function(e){
        e.preventDefault();
        sendOrder();
    });

    var modal=document.getElementById('faq-modal');
    var form=document.getElementById('faq-form');
    var addBtn=document.getElementById('add-faq');
    var cancelBtn=document.getElementById('faq-cancel');
    var editor=CKEDITOR.replace('faq-text');

    function openModal(faq){
        document.getElementById('faqid1').value=faq?faq.faqid1:'';
        document.getElementById('faqid2').value=faq?faq.faqid2:'';
        document.getElementById('faq-category').value=faq?(faq.catid1+','+faq.catid2):'';
        document.getElementById('faq-title').value=faq?faq.title:'';
        editor.setData(faq?faq.body:'');
        modal.style.display='block';
    }
    if(addBtn){addBtn.addEventListener('click',function(){openModal(null);});}
    body.addEventListener('click',function(e){
        if(e.target.classList.contains('edit-btn')){
            var btn=e.target;
            fetch('faq.php?getfaq=1&faqid1='+btn.dataset.faqid1+'&faqid2='+btn.dataset.faqid2)
                .then(r=>r.json())
                .then(function(res){
                    res.faqid1=btn.dataset.faqid1;
                    res.faqid2=btn.dataset.faqid2;
                    openModal(res);
                });
        }
    });
    cancelBtn.addEventListener('click',function(){modal.style.display='none';});
    form.addEventListener('submit',function(e){
        e.preventDefault();
        var data=new FormData(form);
        data.set('body',editor.getData());
        fetch('faq.php',{method:'POST',body:data})
            .then(r=>r.json())
            .then(function(res){
                if(res.success){
                    modal.style.display='none';
                    var id=res.faqid1+'-'+res.faqid2;
                    var tr=body.querySelector('tr[data-id="'+id+'"]');
                    if(!tr){
                        tr=document.createElement('tr');
                        tr.dataset.id=id;
                        var td1=document.createElement('td');td1.className='handle';td1.textContent='☰';tr.appendChild(td1);
                        var td2=document.createElement('td');tr.appendChild(td2);
                        var td3=document.createElement('td');tr.appendChild(td3);
                        var td4=document.createElement('td');td4.textContent='0';tr.appendChild(td4);
                        var td5=document.createElement('td');
                        <?php if(cms_has_permission('faq_edit')): ?>
                        var eb=document.createElement('button');eb.type='button';eb.className='btn btn-primary edit-btn';eb.textContent='Edit';eb.dataset.faqid1=res.faqid1;eb.dataset.faqid2=res.faqid2;td5.appendChild(eb);
                        <?php endif; ?>
                        <?php if(cms_has_permission('faq_delete')): ?>
                        var df=document.createElement('form');df.method='post';df.style.display='inline';df.innerHTML='<input type="hidden" name="faqid1" value="'+res.faqid1+'"><input type="hidden" name="faqid2" value="'+res.faqid2+'"><input type="submit" name="delete" value="Delete">';td5.appendChild(df);
                        <?php endif; ?>
                        tr.appendChild(td5);
                        body.appendChild(tr);
                    }
                    tr.querySelector('td:nth-child(2)').textContent=res.catname;
                    tr.querySelector('td:nth-child(3)').textContent=res.title;
                }
            });
    });
});
</script>
<?php include 'admin_footer.php'; ?>
