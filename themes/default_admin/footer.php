</main>
<footer>
    <p>CMS Admin Panel</p>
</footer>
</body>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
<script src="<?php echo htmlspecialchars($theme_url); ?>/js/Sortable.min.js"></script>
<script>
$(function(){
  var link = $('#sf-parent > a');
  link.on('click',function(e){
    e.preventDefault();
    var sub = $('#sf-sub');
    sub.slideToggle('fast');
    link.attr('aria-expanded', sub.is(':visible'));
  });
  if(window.location.pathname.indexOf('storefront')!==-1){
    $('#sf-sub').show();
    link.attr('aria-expanded','true');
  }
});
</script>
</html>
