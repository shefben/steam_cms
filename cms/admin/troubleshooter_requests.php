<?php
require_once 'admin_header.php';
cms_require_permission('manage_pages');
$db=cms_get_db();
$pages=$db->query('SELECT DISTINCT page FROM support_requests ORDER BY page')->fetchAll(PDO::FETCH_COLUMN);
?>
<h2>Support Requests</h2>
<?php foreach($pages as $p): ?>
<h3><?php echo htmlspecialchars($p); ?></h3>
<input type="text" class="filter" data-table="table-<?php echo htmlspecialchars($p); ?>" placeholder="Filter...">
<?php
$reqs=$db->prepare('SELECT * FROM support_requests WHERE page=? ORDER BY created DESC');
$reqs->execute([$p]);
$rows=$reqs->fetchAll(PDO::FETCH_ASSOC);
?>
<table class="data-table sortable" id="table-<?php echo htmlspecialchars($p); ?>">
<thead><tr>
<th>Date</th><th>Language</th><th>F1</th><th>F2</th><th>F3</th><th>F4</th><th>F5</th><th>F6</th><th>F7</th><th>F8</th><th>F9</th><th>F10</th>
</tr></thead>
<tbody>
<?php foreach($rows as $r): ?>
<tr>
<td><?php echo htmlspecialchars($r['created']); ?></td>
<td><?php echo htmlspecialchars($r['language']); ?></td>
<?php for($i=1;$i<=10;$i++): $f='f'.$i; ?>
<td><?php echo htmlspecialchars($r[$f]); ?></td>
<?php endfor; ?>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<div class="pager" data-table="table-<?php echo htmlspecialchars($p); ?>"></div>
<?php endforeach; ?>
<script>
$(function(){
  $('table.sortable').each(function(){
    var $table=$(this);var per=20;var rows=$table.find('tbody tr');
    function showPage(p){rows.hide().slice((p-1)*per,p*per).show();}
    var pager=$('.pager[data-table="'+$table.attr('id')+'"]').empty();
    var total=Math.ceil(rows.length/per);var cur=1;
    function render(){pager.contents().first()[0].textContent='Page '+cur+' of '+total;}
    var prev=$('<button>Prev</button>');
    var next=$('<button>Next</button>');
    pager.append('Page '+cur+' of '+total+' ').append(prev).append(' ').append(next);
    prev.on('click',function(){if(cur>1){cur--;showPage(cur);render();}});
    next.on('click',function(){if(cur<total){cur++;showPage(cur);render();}});
    showPage(1);
    $table.find('th').on('click',function(){var i=$(this).index();rows.sort(function(a,b){return $(a).children().eq(i).text().localeCompare($(b).children().eq(i).text());});$table.find('tbody').append(rows);showPage(1);});
    $('.filter[data-table="'+$table.attr('id')+'"]').on('input',function(){
        var q=$(this).val().toLowerCase();
        rows.each(function(){
            var t=$(this).text().toLowerCase();
            $(this).toggle(t.indexOf(q)!==-1);
        });
        showPage(1);
    });
  });
});
</script>
<?php include 'admin_footer.php'; ?>
