                </main>
            </div><!-- .content-wrapper -->
        </div><!-- .neon-wrapper -->
    </div><!-- .container -->
<script>
$(function(){
    $('.nav-menu li > a').on('click', function(e){
        var $sub = $(this).next('.sub-menu');
        if ($sub.length) {
            e.preventDefault();
            $sub.slideToggle(150);
        }
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
