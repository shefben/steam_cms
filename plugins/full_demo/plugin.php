<?php
/**
 * Full Demo Plugin
 *
 * Showcases all features of the plugin API: new admin pages, nested sidebar
 * links, custom template tags, tag hooks, and template render hooks.
*/

use Twig\Environment;

// Parent admin page
cms_register_admin_page('demo_root', 'Demo Plugin', function () {
    echo '<h2>Demo Dashboard</h2><p>Welcome to the demo plugin.</p>';
});

// Child page nested under the parent link
cms_register_admin_page('demo_settings', 'Demo Settings', function () {
    if (isset($_POST['demo_option'])) {
        cms_set_setting('demo_option', trim($_POST['demo_option']));
        echo '<p>Demo option saved.</p>';
    }
    $val = cms_get_setting('demo_option', 'default');
    echo '<form method="post">';
    echo '<label>Demo Option: <input type="text" name="demo_option" value="' . htmlspecialchars($val, ENT_QUOTES) . '"></label>';
    echo '<br><br><input type="submit" value="Save"></form>';
}, 'demo_root.php');

// Custom template tag
cms_register_template_tag('demo_tag', function (string $text = 'demo') {
    return '<strong>' . htmlspecialchars($text, ENT_QUOTES) . '</strong>';
});

// Hook into existing nav_buttons tag
cms_hook_template_tag('nav_buttons', 'after', function ($html) {
    return $html . "<!-- nav_buttons hooked by demo plugin -->";
});

// Modify the news tag arguments before it renders
cms_hook_template_tag('news', 'before', function (array $args) {
    // Force at least one news item if count is missing
    if (!isset($args[1]) || $args[1] === null) {
        $args[1] = 1;
    }
    return $args;
});

// Add a global Twig variable after the environment is created
cms_add_hook('twig_environment', function ($env) {
    $env->addGlobal('demo_env', 'demo');
    return $env;
});

// Inject a variable before templates render
cms_add_hook('template_pre_render', function (array $data) {
    $data['vars']['demo_pre'] = 'pre-render';
    return $data;
});

// Append marker after rendering any template
cms_add_hook('template_post_render', function ($html) {
    return $html . "\n<!-- full_demo post render -->";
});

cms_register_sidebar_section_type(__DIR__ . '/sidebar.json', function(Environment $env, array $entries) {
    $items = [];
    foreach ($entries as $e) {
        $items[] = cms_plugin_build_sidebar_entry('demo_links', $e);
    }
    return '<div class="demo-links">' . implode('', $items) . '</div>';
});
