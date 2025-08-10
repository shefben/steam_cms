                </main>
            </div><!-- .content-wrapper -->
        </div><!-- .neon-wrapper -->
    </div><!-- .container -->
<script>
$(function(){
    $('.nav-menu').on('click','.submenu-toggle', function(e){
        e.preventDefault();
        var $btn=$(this);
        var $sub=$('#'+$btn.attr('aria-controls'));
        $sub.slideToggle(150);
        var expanded=$btn.attr('aria-expanded')==='true';
        $btn.attr('aria-expanded', expanded?'false':'true');
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
