</main>
<script>
$(function(){
    $('#sf-parent > a').on('click', function(e){
        e.preventDefault();
        $('#sf-sub').slideToggle(150);
    });
    $('#cafe-parent > a').on('click', function(e){
        e.preventDefault();
        $('#cafe-sub').slideToggle(150);
    });
    $('#faq-parent > a').on('click', function(e){
        e.preventDefault();
        $('#faq-sub').slideToggle(150);
    });
    $('#ts-parent > a').on('click', function(e){
        var $sub = $('#ts-sub');
        if ($sub.length) {
            e.preventDefault();
            $sub.slideToggle(150);
        }
    });
    $('#download-parent > a').on('click', function(e){
        e.preventDefault();
        $('#download-sub').slideToggle(150);
    });
    $('#legacy-sf-parent > a').on('click', function(e){
        var $sub = $('#legacy-sf-sub');
        if ($sub.length) {
            e.preventDefault();
            $sub.slideToggle(150);
        }
    });
    $('#random_content-parent > a').on('click', function(e){
        e.preventDefault();
        $('#random_content-sub').slideToggle(150);
    });
    $('.notify-dismiss').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var $li = $(this).closest('li');
        $.post('notifications.php', {id:id}).done(function(){
            $li.fadeOut(150, function(){ $(this).remove(); });
        });
    });
    $('body').on('click','.help-icon',function(e){
        e.preventDefault();
        var txt=$(this).data('help');
        if(!txt) return;
        var $m=$('<div class="help-modal" aria-label="Help"><div class="dialog"></div></div>');
        $m.find('.dialog').text(txt);
        $('body').append($m);
        $m.fadeIn(100);
        $m.on('click',function(){ $m.fadeOut(150,function(){ $m.remove(); }); });
    });
});
</script>
</body>
</html>
