<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../template_engine.php';
require_once __DIR__ . '/../theme_config.php';

$admin_theme = cms_get_setting('admin_theme', 'v2');
$base_url    = cms_base_url();
$theme_dir   = dirname(__DIR__, 2) . "/themes/{$admin_theme}_admin";
$theme_url   = ($base_url ? $base_url : '') . "/themes/{$admin_theme}_admin";
if (!is_dir($theme_dir)) {
    $theme_dir = dirname(__DIR__, 2) . '/themes/default_admin';
    $theme_url = ($base_url ? $base_url : '') . '/themes/default_admin';
}
$current_theme = cms_get_current_theme();

if (isset($admin_layout) && $admin_layout) {
    $page_content = ob_get_clean();
    // allow theme-defined widgets for this page
    ob_start();
    cms_render_theme_admin_widgets($current_theme, $page_id ?? '');
    $page_content .= ob_get_clean();
    
    // Add universal admin JavaScript functionality
    $page_content .= '
<!-- Universal Admin JavaScript Functionality -->
<script>
$(function(){
    // Navigation menu functionality
    $(\'.nav-menu\').on(\'click\',\'.submenu-toggle\', function(e){
        e.preventDefault();
        var $btn=$(this);
        var $sub=$(\'#\'+$btn.attr(\'aria-controls\'));
        $sub.slideToggle(150);
        var expanded=$btn.attr(\'aria-expanded\')===\'true\';
        $btn.attr(\'aria-expanded\', expanded?\'false\':\'true\');
    });

    $(\'.nav-menu li\').each(function(){
        var $li = $(this);
        var $link = $li.children(\'a\').first();
        var $toggle = $li.children(\'.submenu-toggle\').first();
        var $submenu = $li.children(\'.sub-menu\').first();

        if($toggle.length && $submenu.length) {
            $link.on(\'click\', function(e){
                e.preventDefault();
                $toggle.trigger(\'click\');
                return false;
            });
        }
    });

    // Notification functionality
    $(\'.notify-dismiss\').on(\'click\', function(e){
        e.preventDefault();
        var id = $(this).data(\'id\');
        var $li = $(this).closest(\'li\');
        $.post(\'notifications.php\', {id:id}).done(function(){
            $li.fadeOut(150, function(){ $(this).remove(); });
        });
    });

    // Notification icon functionality
    $(\'.notification-icon\').on(\'click\', function(e){
        e.preventDefault();
        e.stopPropagation();
        var $dropdown = $(this).find(\'.notification-dropdown\');
        if($dropdown.is(\':visible\')) {
            $dropdown.fadeOut(150);
        } else {
            loadNotifications();
            $dropdown.fadeIn(150);
        }
    });

    // Close notification dropdown when clicking outside
    $(document).on(\'click\', function(){
        $(\'.notification-dropdown\').fadeOut(150);
    });

    function loadNotifications() {
        $.get(\'notifications.php?action=recent&limit=10\')
            .done(function(data) {
                var $list = $(\'.notification-list\');
                $list.empty();
                if(data && data.length > 0) {
                    data.forEach(function(notification) {
                        var $item = $(\'<div class="notification-item">\');
                        $item.html(\'<div class="notification-type">\' + 
                                  escapeHtml(notification.type) + \'</div>\' +
                                  \'<div class="notification-message">\' + 
                                  escapeHtml(notification.message) + \'</div>\' +
                                  \'<div class="notification-time">\' + 
                                  escapeHtml(notification.created) + \'</div>\');
                        $list.append($item);
                    });
                } else {
                    $list.html(\'<div class="no-notifications">No recent notifications</div>\');
                }
            })
            .fail(function() {
                $(\'.notification-list\').html(\'<div class="notification-error">Error loading notifications</div>\');
            });
    }

    function escapeHtml(text) {
        var map = {
            \'&\': \'&amp;\',
            \'<\': \'&lt;\',
            \'>\': \'&gt;\',
            \'"\': \'&quot;\',
            "\'": \'&#039;\'
        };
        return text.replace(/[&<>"\']/g, function(m) { return map[m]; });
    }
    
    // Help modal functionality
    $(\'body\').on(\'click\',\'.help-icon\',function(e){
        e.preventDefault();
        var txt=$(this).data(\'help\');
        if(!txt) return;
        var $m=$(\'<div class="help-modal" aria-label="Help"><div class="dialog"></div></div>\');
        $m.find(\'.dialog\').text(txt);
        $(\'body\').append($m);
        $m.fadeIn(100);
        $m.on(\'click\',function(){ $m.fadeOut(150,function(){ $m.remove(); }); });
    });
});
</script>
</body>
</html>
';
    $admin_initials = implode('', array_map(fn($w) => strtoupper($w[0]), preg_split('/\s+/', $admin_name)));
    $breadcrumbs_html = cms_admin_breadcrumb();
    $sidebar = cms_admin_tag('sidebar', [
        'nav' => $nav_html,
        'theme_url' => $theme_url,
    ], $admin_theme);
    $page_title = $page_title ?? ucwords(str_replace('_', ' ', $page_id ?? ''));
    $content = cms_admin_tag('content', [
        'content' => $page_content,
        'page_title' => $page_title,
        'admin_name' => $admin_name,
        'admin_initials' => $admin_initials,
        'notifications_html' => $notifications_html ?? '',
        'breadcrumbs_html' => $breadcrumbs_html,
        'page_id' => $page_id ?? '',
    ], $admin_theme);
    cms_render_template($admin_layout, [
        'sidebar' => $sidebar,
        'content' => $content,
        'theme_url' => $theme_url,
        'base_url' => $base_url,
        'page_id' => $page_id ?? '',
        'admin_name' => $admin_name,
        'notifications_html' => $notifications_html ?? '',
        'breadcrumbs_html' => $breadcrumbs_html,
    ]);
} else {
    include "$theme_dir/footer.php";
}
