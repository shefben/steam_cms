<?php
/**
 * Migration: Reorganize nav_items
 * - Move Theme (rename to Themes), Header & Footer, Redirects, Settings under CMS Settings
 * - Move Survey Stats under Stats Management
 * - Sort CMS Settings sub-items alphabetically
 */

require_once __DIR__ . '/../cms/db.php';

function migrate_nav_items(): void {
    $db = cms_get_db();

    // Get current nav_items
    $stmt = $db->prepare("SELECT value FROM settings WHERE `key` = 'nav_items'");
    $stmt->execute();
    $json = $stmt->fetchColumn();

    if (!$json) {
        echo "No nav_items found in settings.\n";
        return;
    }

    $nav_items = json_decode($json, true);
    if (!is_array($nav_items)) {
        echo "Failed to decode nav_items JSON.\n";
        return;
    }

    // Map of items to move under cms_settings
    $cms_settings_items = ['theme.php', 'settings.php', 'header_footer.php', 'redirects.php'];

    // Update each item
    foreach ($nav_items as &$item) {
        $file = $item['file'] ?? '';

        // Move Survey Stats under Stats Management
        if ($file === 'survey_stats.php' && empty($item['parent'])) {
            $item['parent'] = 'stats_management';
            echo "Moved Survey Stats under Stats Management\n";
        }

        // Move Theme (rename to Themes), Settings, Header & Footer, Redirects under CMS Settings
        if (in_array($file, $cms_settings_items) && empty($item['parent'])) {
            $item['parent'] = 'cms_settings';
            echo "Moved {$item['label']} under CMS Settings\n";

            // Rename Theme to Themes
            if ($file === 'theme.php' && $item['label'] === 'Theme') {
                $item['label'] = 'Themes';
                echo "Renamed Theme to Themes\n";
            }
        }
    }
    unset($item);

    // Collect and sort CMS Settings children
    $cms_children = [];
    $other_items = [];
    $cms_settings_index = -1;

    foreach ($nav_items as $i => $item) {
        if (($item['parent'] ?? '') === 'cms_settings') {
            $cms_children[] = $item;
        } elseif ($item['file'] === 'cms_settings') {
            $cms_settings_index = count($other_items);
            $other_items[] = $item;
        } else {
            $other_items[] = $item;
        }
    }

    // Sort CMS children alphabetically by label
    usort($cms_children, function($a, $b) {
        return strcasecmp($a['label'], $b['label']);
    });

    echo "Sorted CMS Settings children: " . implode(', ', array_column($cms_children, 'label')) . "\n";

    // Rebuild nav_items with CMS children right after cms_settings
    if ($cms_settings_index >= 0) {
        $result = array_slice($other_items, 0, $cms_settings_index + 1);
        $result = array_merge($result, $cms_children);
        $result = array_merge($result, array_slice($other_items, $cms_settings_index + 1));
        $nav_items = $result;
    }

    // Save updated nav_items
    $new_json = json_encode($nav_items);
    $stmt = $db->prepare("UPDATE settings SET value = ? WHERE `key` = 'nav_items'");
    $stmt->execute([$new_json]);

    echo "nav_items updated successfully!\n";
}

// Run migration
migrate_nav_items();
