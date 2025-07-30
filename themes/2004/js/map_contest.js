$(function(){
    function showPage(n){
        $('.mc-page').hide();
        $('#mc-page'+n).show();
    }
    $('#mc-form1').on('submit',function(e){
        e.preventDefault();
        $.post('map_contest.php?ajax=1&page=1', $(this).serialize(), function(){
            showPage(2);
        },'json');
    });
    function uploadWithProgress(fd,url,progEls,cb){
        $.ajax({url:url,method:'POST',data:fd,processData:false,contentType:false,
            xhr:function(){var x=$.ajaxSettings.xhr();if(x.upload){x.upload.onprogress=function(e){if(e.lengthComputable){progEls.each(function(){this.value=e.loaded/e.total*100;$(this).show();});}}}return x;},
            success:function(r){progEls.hide();cb(r);} });
    }

    $('#ss-upload').on('change',function(){
        var files=this.files;var self=$(this);
        for(var i=0;i<files.length;i++){
            if($('#shotList .shot').length>=3){alert('Maximum 3 screenshots');break;}
            (function(f){
                var box=$('<div class="shot"><progress value="0" max="100"></progress></div>').appendTo('#shotList');
                var fd=new FormData();fd.append('screenshot',f);
                uploadWithProgress(fd,'map_contest.php?ajax=1&upload=screen',box.find('progress'),function(res){
                    if(res.ok){
                        var img=$('<img>').attr('src',res.url).attr('data-name',res.name);
                        var rm=$('<button type="button" class="remove">×</button>').on('click',function(){removeShot(res.name,box);});
                        box.empty().append(img).append(rm);
                    }else{box.remove();alert(res.error||'Error');}
                });
            })(files[i]);
        }
        self.val('');
    });

    function removeShot(name,box){
        $.post('map_contest.php?ajax=1&action=remove_screen',{name:name},function(){box.remove();});
    }

    $('#mc-form2').on('submit',function(e){
        e.preventDefault();
        var fd = new FormData(this);
        uploadWithProgress(fd,'map_contest.php?ajax=1&page=2',$('#mapProg, #srcProg'),function(){
            showPage(3);
        });
    });
    $('#mc-form3').on('submit',function(e){
        e.preventDefault();
        $.post('map_contest.php?ajax=1&page=3', $(this).serialize(), function(res){
            if(res.success){
                $('#contest-container').html('<p>Thank you for your submission!</p>');
            }else alert(res.error||'Error');
        },'json');
    });
    $('.mc-prev').on('click',function(){
        var t=$(this).data('prev');
        showPage(t);
    });
});
