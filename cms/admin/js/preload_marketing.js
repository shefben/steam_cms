$(function(){
  console.log('preload_marketing.js: initializing, jQuery=', typeof $, 'CKEDITOR=', typeof CKEDITOR);

  function openModal(data){
    $('#msgtype').val(data.msgtype || '');
    $('#language').val(data.language || '');
    $('#orig_msgtype').val(data.orig_msgtype || data.msgtype || '');
    $('#orig_language').val(data.orig_language || data.language || '');
    if(typeof CKEDITOR !== 'undefined'){
      if(CKEDITOR.instances.content){ CKEDITOR.instances.content.destroy(true); }
      CKEDITOR.replace('content', {baseHref: '/' });
      CKEDITOR.instances.content.setData(data.content || '');
    } else {
      $('#content').val(data.content || '');
    }
    $('#modalOverlay').css('display','flex');
  }
  function closeModal(){
    if(typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content){ CKEDITOR.instances.content.destroy(true); }
    $('#modalOverlay').hide();
  }

  $(document).on('click', '#addBtn', function(){
    console.log('preload_marketing.js: addBtn clicked');
    openModal({});
  });

  $(document).on('click', '#marketingTable .edit-btn', function(){
    console.log('preload_marketing.js: edit-btn clicked');
    var row=$(this).closest('tr');
    var msgtype=row.data('msgtype');
    var language=row.data('language');
    $.get('preload_marketing.php', {ajax:'get', msgtype:msgtype, language:language}, function(res){
      openModal(res);
    }, 'json').fail(function(xhr){
      console.error('preload_marketing.js: edit load failed', xhr.status, xhr.responseText);
      alert('Failed to load entry for editing.');
    });
  });

  $(document).on('click', '#cancelBtn', function(){
    console.log('preload_marketing.js: cancelBtn clicked');
    closeModal();
  });

  $(document).on('click', '#modalOverlay', function(e){
    if(e.target.id === 'modalOverlay'){ closeModal(); }
  });

  $(document).on('submit', '#contentForm', function(e){
    e.preventDefault();
    console.log('preload_marketing.js: contentForm submit');
    var contentVal = (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.content)
      ? CKEDITOR.instances.content.getData()
      : $('#content').val();
    var data={
      ajax:'save',
      msgtype:$('#msgtype').val(),
      language:$('#language').val(),
      content: contentVal,
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
          .append($('<td>').html('<button type="button" class="edit-btn">Edit</button> <button type="button" class="delete-btn">Delete</button>'));
        $('#marketingTable').append(newRow);
        closeModal();
      }else{
        alert(res.error || 'Failed');
      }
    }, 'json').fail(function(xhr){
      console.error('preload_marketing.js: save failed', xhr.status, xhr.responseText);
      alert('Failed to save entry.');
    });
  });

  $(document).on('click', '#marketingTable .delete-btn', function(){
    console.log('preload_marketing.js: delete-btn clicked');
    if(!confirm('Delete this entry?')) return;
    var row=$(this).closest('tr');
    var msgtype=row.data('msgtype');
    var language=row.data('language');
    $.post('preload_marketing.php', {ajax:'delete', msgtype:msgtype, language:language}, function(res){
      if(res.success){ row.remove(); }
      else{ alert(res.error || 'Failed'); }
    }, 'json').fail(function(xhr){
      console.error('preload_marketing.js: delete failed', xhr.status, xhr.responseText);
      alert('Failed to delete entry.');
    });
  });
});
