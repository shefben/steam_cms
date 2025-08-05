<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db = cms_get_db();
$allThemes = ['2003_v2','2004','2005_v1','2005_v2'];
$pages = $db->query('SELECT * FROM support_pages ORDER BY version')->fetchAll(PDO::FETCH_ASSOC);
$version = $_GET['version'] ?? ($pages[0]['version'] ?? '');
if(isset($_POST['create']) && !empty($_POST['new_version'])){
    $ver = preg_replace('/[^a-zA-Z0-9_]/','',$_POST['new_version']);
    if($ver !== ''){
        $db->prepare('INSERT INTO support_pages(version,years,content,created,updated) VALUES(?,?,"",NOW(),NOW())')->execute([$ver,$ver]);
        header('Location: support_page.php?version='.$ver);
        exit;
    }
}
if(isset($_POST['save'])){
    $ver = $_POST['version'];
    $years = isset($_POST['years'])?implode(',',array_intersect($allThemes,$_POST['years'])):'';
    $content = $_POST['content'];
    $page = $db->prepare('SELECT id FROM support_pages WHERE version=?');
    $page->execute([$ver]);
    $id = $page->fetchColumn();
    if($id){
        $db->prepare('UPDATE support_pages SET years=?,content=?,updated=NOW() WHERE id=?')->execute([$years,$content,$id]);
        $db->prepare('DELETE FROM support_page_faqs WHERE support_id=?')->execute([$id]);
        if(isset($_POST['faq'])){
            $ord=1;
            $ins=$db->prepare('INSERT INTO support_page_faqs(support_id,faqid1,faqid2,ord) VALUES(?,?,?,?)');
            foreach($_POST['faq'] as $fid){
                list($f1,$f2)=array_map('intval',explode(',',$fid));
                $ins->execute([$id,$f1,$f2,$ord++]);
            }
        }
    }
}
$edit = null;
if ($version) {
    $stmt = $db->prepare('SELECT * FROM support_pages WHERE version=?');
    $stmt->execute([$version]);
    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
}
$usedYears = [];
foreach ($pages as $p) {
    if ($p['version'] === $version) continue;
    foreach (explode(',', $p['years']) as $y) {
        $y = trim($y);
        if ($y !== '') $usedYears[$y] = true;
    }
}
$faqs = $db->query('SELECT faqid1,faqid2,title FROM faq_content ORDER BY title')->fetchAll(PDO::FETCH_ASSOC);
$selectedFaqs=[];
if($edit){
    $rows=$db->prepare('SELECT faqid1,faqid2 FROM support_page_faqs WHERE support_id=? ORDER BY ord');
    $rows->execute([$edit['id']]);
    $selectedFaqs=$rows->fetchAll(PDO::FETCH_ASSOC);
    $selectedFaqs=array_map(function($r){return $r['faqid1'].','.$r['faqid2'];},$selectedFaqs);
}
?>
<h2>Support Pages</h2>
<form method="get" id="verForm">
<select name="version" onchange="document.getElementById('verForm').submit()">
<?php foreach($pages as $p): ?>
<option value="<?php echo htmlspecialchars($p['version']); ?>"<?php if($p['version']===$version) echo ' selected'; ?>><?php echo htmlspecialchars($p['version']); ?></option>
<?php endforeach; ?>
</select>
</form>
<form method="post">
<input type="hidden" name="version" value="<?php echo htmlspecialchars($version); ?>">
<fieldset><legend>Years</legend>
<?php foreach($allThemes as $t): ?>
<?php $checked=$edit && in_array($t, explode(',', $edit['years'])); ?>
<label><input type="checkbox" name="years[]" value="<?php echo $t; ?>"<?php echo $checked?' checked':''; ?><?php echo !$checked && isset($usedYears[$t])?' disabled':''; ?>> <?php echo $t; ?></label>
<?php endforeach; ?>
</fieldset>
<br>
<textarea name="content" id="content" style="width:100%;height:300px;"><?php echo htmlspecialchars($edit['content']??''); ?></textarea><br>
<h3>Top FAQs (max 5)</h3>
<input type="text" id="faq-filter" placeholder="Filter..." style="margin-bottom:5px;width:100%;">
<table id="faq-table" class="data-table"><thead><tr><th></th><th class="sortable">Title</th></tr></thead><tbody>
<?php foreach($faqs as $f): $id=$f['faqid1'].','.$f['faqid2']; ?>
<tr><td><input type="checkbox" name="faq[]" value="<?php echo $id; ?>"<?php echo in_array($id,$selectedFaqs)?' checked':''; ?>></td><td class="title"><?php echo htmlspecialchars($f['title']); ?></td></tr>
<?php endforeach; ?>
</tbody></table>
<div id="faq-pagination" style="text-align:center;margin-bottom:10px;">
<button type="button" id="faq-prev">&lt; Prev</button> <span></span> <button type="button" id="faq-next">Next &gt;</button>
</div>
<input type="submit" name="save" value="Save" class="btn btn-primary">
</form>
<form method="post" style="margin-top:20px;">
New Version: <input type="text" name="new_version"> <button name="create" value="1">Add</button>
</form>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('content');
$(function(){
  function updateFaq(){
    var count=$('input[name="faq[]"]:checked').length;
    if(count>=5){
      $('input[name="faq[]"]').not(':checked').prop('disabled',true);
    }else{
      $('input[name="faq[]"]').prop('disabled',false);
    }
  }
  updateFaq();
  $('input[name="faq[]"]').on('change',updateFaq);
  $('#faq-filter').on('input',function(){
    var q=this.value.toLowerCase();
    $('#faq-table tbody tr').each(function(){
      $(this).toggle($(this).find('.title').text().toLowerCase().indexOf(q)!==-1);
    });
    showPage(1);
  });
  var perPage=20,current=1,$rows=$('#faq-table tbody tr');
  function showPage(p){
    current=p;var start=(p-1)*perPage,end=start+perPage;
    $rows.hide().slice(start,end).show();
    $('#faq-pagination span').text('Page '+p+' / '+Math.ceil($rows.length/perPage));
    $('#faq-prev').prop('disabled',p===1);
    $('#faq-next').prop('disabled',p>=Math.ceil($rows.length/perPage));
  }
  $('#faq-prev').on('click',function(){if(current>1)showPage(current-1);});
  $('#faq-next').on('click',function(){if(current<Math.ceil($rows.length/perPage))showPage(current+1);});
  $('#faq-table th.sortable').on('click',function(){
    var idx=$(this).index();
    $rows.sort(function(a,b){
      var A=$(a).children().eq(idx).text().toLowerCase();
      var B=$(b).children().eq(idx).text().toLowerCase();
      return A.localeCompare(B);
    });
    $('#faq-table tbody').append($rows);
    showPage(1);
  });
  showPage(1);
});
</script>
<?php include 'admin_footer.php'; ?>
