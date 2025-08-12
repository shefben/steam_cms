<?php
/**
 * Simple Hello Plugin
 *
 * Demonstrates registering a basic admin page, template tag, and render hook.
 */

cms_register_admin_page('hello', 'Hello Plugin', function () {
    echo '<h2>Hello Plugin</h2><p>This is a simple example plugin.</p>';
});

cms_register_template_tag('hello_tag', function (string $name = 'world') {
    return 'Hello ' . htmlspecialchars($name, ENT_QUOTES);
});

// Append an HTML comment after any template renders
cms_add_hook('template_post_render', function ($html) {
    return $html . "\n<!-- simple_hello rendered -->";
});
