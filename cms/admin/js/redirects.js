$(function(){
    $('#addRedirectForm').on('submit', function(e){
        e.preventDefault();
        var slug = $.trim($('#slug').val());
        var target = $.trim($('#target').val());
        if (!slug || !target) { return; }
        $.post('redirects.php', {action:'add', slug:slug, target:target}, function(res){
            if (res.success) {
                var row = $('<tr>').attr('data-id', res.id)
                    .append($('<td>').addClass('slug').text(slug))
                    .append($('<td>').addClass('target').text(target))
                    .append($('<td>').addClass('hits').text('0'))
                    .append($('<td>').addClass('actions').html('<button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button>'));
                $('#redirectsTable').append(row);
                $('#slug').val('');
                $('#target').val('');
            } else {
                alert(res.error || 'Failed to add redirect');
            }
        }, 'json');
    });

    $('#redirectsTable').on('click', '.delete-btn', function(){
        if (!confirm('Delete this redirect?')) return;
        var row = $(this).closest('tr');
        var id = row.data('id');
        $.post('redirects.php', {action:'delete', id:id}, function(res){
            if (res.success) {
                row.remove();
            } else {
                alert(res.error || 'Failed to delete');
            }
        }, 'json');
    });

    $('#redirectsTable').on('click', '.edit-btn', function(){
        var row = $(this).closest('tr');
        var slug = row.find('.slug').text();
        var target = row.find('.target').text();
        row.data('orig-slug', slug);
        row.data('orig-target', target);
        row.find('.slug').html('<input type="text" class="edit-slug" value="'+slug+'">');
        row.find('.target').html('<input type="text" class="edit-target" value="'+target+'">');
        row.find('.actions').html('<button class="save-btn">Save</button> <button class="cancel-btn">Cancel</button>');
    });

    $('#redirectsTable').on('click', '.cancel-btn', function(){
        var row = $(this).closest('tr');
        row.find('.slug').text(row.data('orig-slug'));
        row.find('.target').text(row.data('orig-target'));
        row.find('.actions').html('<button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button>');
    });

    $('#redirectsTable').on('click', '.save-btn', function(){
        var row = $(this).closest('tr');
        var id = row.data('id');
        var slug = $.trim(row.find('.edit-slug').val());
        var target = $.trim(row.find('.edit-target').val());
        if (!slug || !target) { alert('Slug and Target required'); return; }
        $.post('redirects.php', {action:'save', id:id, slug:slug, target:target}, function(res){
            if (res.success) {
                row.find('.slug').text(slug);
                row.find('.target').text(target);
                row.find('.actions').html('<button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button>');
            } else {
                alert(res.error || 'Failed to update');
            }
        }, 'json');
    });
});
