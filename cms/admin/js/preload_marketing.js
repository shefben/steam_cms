$(function(){
  function openModal(data){
    $('#msgtype').val(data.msgtype || '');
    $('#language').val(data.language || '');
    $('#orig_msgtype').val(data.orig_msgtype || data.msgtype || '');
    $('#orig_language').val(data.orig_language || data.language || '');
    if(CKEDITOR.instances.content){ CKEDITOR.instances.content.destroy(true); }
    CKEDITOR.replace('content');
    CKEDITOR.instances.content.setData(data.content || '');
    $('#modalOverlay').show();
  }
  $('#addBtn').on('click', function(){ openModal({}); });
  $('#marketingTable').on('click', '.edit-btn', function(){
    var row=$(this).closest('tr');
    var msgtype=row.data('msgtype');
    var language=row.data('language');
    $.get('preload_marketing.php', {ajax:'get', msgtype:msgtype, language:language}, function(res){
      openModal(res);
    }, 'json');
  });
  $('#cancelBtn').on('click', function(){
    if(CKEDITOR.instances.content){ CKEDITOR.instances.content.destroy(true); }
    $('#modalOverlay').hide();
  });
  $('#contentForm').on('submit', function(e){
    e.preventDefault();
    var data={
      ajax:'save',
      msgtype:$('#msgtype').val(),
      language:$('#language').val(),
      content:CKEDITOR.instances.content.getData(),
      orig_msgtype:$('#orig_msgtype').val(),
      orig_language:$('#orig_language').val()
    };
    $.post('preload_marketing.php', data, function(res){
      if(res.success){
        var sel='tr[data-msgtype="'+res.orig_msgtype+'"][data-language="'+res.orig_language+'"]';
        var row=$(sel);
        if(row.length){
          row.remove();
        }
        var newRow=$('<tr>').attr('data-msgtype',res.msgtype).attr('data-language',res.language)
          .append($('<td>').text(res.msgtype))
          .append($('<td>').text(res.language))
          .append($('<td>').html('<button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button>'));
        $('#marketingTable').append(newRow);
        $('#cancelBtn').click();
      }else{
        alert(res.error || 'Failed');
      }
    }, 'json');
  });
  $('#marketingTable').on('click', '.delete-btn', function(){
    if(!confirm('Delete this entry?')) return;
    var row=$(this).closest('tr');
    var msgtype=row.data('msgtype');
    var language=row.data('language');
    $.post('preload_marketing.php', {ajax:'delete', msgtype:msgtype, language:language}, function(res){
      if(res.success){ row.remove(); }
      else{ alert(res.error || 'Failed'); }
    }, 'json');
  });
});
