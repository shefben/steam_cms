<?php
require __DIR__ . '/../cms/db.php';

// Preload settings cache to avoid database access.
$cms_settings_cache = [
    'cheat_form_page_2004' => '2004_cheat_v2',
];

$themeVariant = '2004-holiday';

// Old behaviour: using variant name would fall back to default v1.
$legacy = cms_get_cheat_form_page($themeVariant);

// New behaviour: base theme resolves admin-selected version.
$baseTheme = preg_split('/[-_]/', $themeVariant)[0];
$current = cms_get_cheat_form_page($baseTheme);

assert(!str_contains($legacy, 'Steam troubleshooter'));
assert(str_contains($current, 'Steam troubleshooter'));
?>
