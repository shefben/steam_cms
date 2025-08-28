<?php
// Admin footer for v2_admin theme - fallback for non-Twig rendering
// This file provides basic closure for pages that don't use Twig layouts
?>
        </div>
        <!-- /main-content -->
    </div>
    <!-- /admin-wrapper -->
    
    <!-- Admin footer scripts -->
    <script>
    $(document).ready(function() {
        // Modal close handlers
        $(document).on('click', '.modal', function(e) {
            if (e.target === this) {
                $(this).hide();
            }
        });
        
        // Notification dismiss handlers
        $('.notify-dismiss').on('click', function() {
            var id = $(this).data('id');
            $.post('notifications.php', {dismiss: id});
            $(this).parent().fadeOut();
        });
        
        // Submenu toggles
        $('.submenu-toggle').on('click', function(e) {
            e.preventDefault();
            var target = $('#' + $(this).attr('aria-controls'));
            var expanded = $(this).attr('aria-expanded') === 'true';
            $(this).attr('aria-expanded', !expanded);
            target.toggle();
        });
    });
    </script>
</body>
</html>