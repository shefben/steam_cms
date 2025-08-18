<?php
require_once 'admin_header.php';
cms_require_permission('manage_store');

$db = cms_get_db();

$rows = $db->query('SELECT * FROM store_developers ORDER BY name')
    ->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Developers</h2>
<table class="data-table" id="devTable">
    <tr><th>Name</th><th>Website</th><th>Actions</th></tr>
    <?php foreach ($rows as $r): ?>
    <tr data-id="<?php echo $r['id']; ?>">
        <td class="name"><?php echo htmlspecialchars($r['name']); ?></td>
        <td class="website"><?php echo htmlspecialchars($r['website'] ?? ''); ?></td>
        <td class="actions">
            <button class="edit btn btn-primary btn-small" data-id="<?php echo $r['id']; ?>">Edit</button>
            <button class="delete btn btn-danger btn-small" data-id="<?php echo $r['id']; ?>">Delete</button>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<button id="addDev" class="btn btn-success">Add Developer</button>

<div id="devModal" style="display:none;" aria-modal="true" role="dialog">
    <form id="devForm">
        <input type="hidden" name="id" id="devId">
        <label>Name <input type="text" name="name" id="devName"></label><br>
        <label>Website <input type="text" name="website" id="devWebsite"></label><br>
        <div id="devGames" style="display:none;">
            <h3>Associated Games</h3>
            <ul id="gameList"></ul>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" id="devCancel" class="btn">Cancel</button>
    </form>
</div>

<script>
$(function(){
    function openModal(d){
        $('#devId').val(d.id||'');
        $('#devName').val(d.name||'');
        $('#devWebsite').val(d.website||'');
        var games=d.games||[];
        if(games.length){
            var ul=$('#gameList').empty();
            $.each(games,function(_,g){
                ul.append('<li>'+g.appid+' - '+g.name+'</li>');
            });
            $('#devGames').show();
        }else{
            $('#devGames').hide();
        }
        $('#devModal').show();
    }
    $('#addDev').on('click',function(){ openModal({}); });
    $('#devTable').on('click','.edit',function(){
        var id=$(this).data('id');
        $.get('storefront_developer.php',{id:id},function(res){
            openModal(res);
        },'json');
    });
    $('#devCancel').on('click',function(){ $('#devModal').hide(); });
    $('#devForm').on('submit',function(e){
        e.preventDefault();
        $.post('storefront_developer.php', $(this).serialize(), function(res){
            var row=$('tr[data-id="'+res.id+'"]').first();
            if(row.length){
                row.find('.name').text(res.name);
                row.find('.website').text(res.website);
            }else{
                var tr=$('<tr data-id="'+res.id+'">'+
                         '<td class="name"></td>'+
                         '<td class="website"></td>'+
                         '<td class="actions">'+
                         '<button class="edit btn btn-primary btn-small" data-id="'+res.id+'">Edit</button> '+
                         '<button class="delete btn btn-danger btn-small" data-id="'+res.id+'">Delete</button>'+"</td></tr>");
                tr.find('.name').text(res.name);
                tr.find('.website').text(res.website);
                $('#devTable').append(tr);
            }
            $('#devModal').hide();
        },'json');
    });
    $('#devTable').on('click','.delete',function(){
        if(confirm('Delete developer?')){
            var id=$(this).data('id');
            $.post('storefront_developer.php',{delete:id},function(){
                $('tr[data-id="'+id+'"]').remove();
            });
        }
    });
});
</script>

<?php include 'admin_footer.php'; ?>
