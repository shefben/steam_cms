<?php
/**
 * Generic dispatcher for plugin-defined admin pages.
 *
 * Plugins register pages via `cms_register_admin_page()` and they become
 * available through this script using `plugin.php?page=slug`.
 */
require_once 'admin_header.php';

$page = $_GET['page'] ?? '';

if ($page === '') {
    echo '<p>No plugin page specified.</p>';
} else {
    cms_handle_plugin_page($page);
}

require_once 'admin_footer.php';
