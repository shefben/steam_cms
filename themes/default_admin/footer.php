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
});
</script>
</body>
</html>
