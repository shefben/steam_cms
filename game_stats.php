<?php
declare(strict_types=1);

$page_title = 'Steam: Game and Player Statistics';

require_once __DIR__ . '/cms/utilities/functions.php';
require_once __DIR__ . '/cms/template_engine.php';
require_once __DIR__ . '/cms/db.php';
require_once __DIR__ . '/cms/game_stats.php';

$db    = cms_get_db();
$theme = cms_get_setting('theme', '2004');
$rows  = cms_game_stats_fetch_all($db);

$stats          = [];
$totalPlayers   = 0;
$totalServers   = 0;
$totalMinutes   = 0;
$maxPlayers     = 0;
$gameCount      = 0;

foreach ($rows as $row) {
    $players = (int)($row['current_players'] ?? 0);
    $servers = (int)($row['current_servers'] ?? 0);
    $minutes = (int)($row['player_minutes_per_month'] ?? 0);

    $format = cms_game_stats_format_minutes($minutes);

    $stats[] = [
        'id'                => (int)$row['id'],
        'game_name'         => $row['game_name'],
        'game_website'      => $row['game_website'] ?: null,
        'current_players'   => $players,
        'players_formatted' => number_format($players),
        'current_servers'   => $servers,
        'servers_formatted' => number_format($servers),
        'player_minutes'    => $minutes,
        'minutes_label'     => $format['text'],
    ];

    $totalPlayers += $players;
    $totalServers += $servers;
    $totalMinutes += $minutes;
    $maxPlayers    = max($maxPlayers, $players);
    $gameCount++;
}

$totals = [
    'players'          => $totalPlayers,
    'players_formatted'=> number_format($totalPlayers),
    'servers'          => $totalServers,
    'servers_formatted'=> number_format($totalServers),
    'minutes'          => $totalMinutes,
    'minutes_label'    => cms_game_stats_format_minutes($totalMinutes)['text'],
];

$fallback = headline_stats($maxPlayers ?: 0);
$avgUsersSetting   = (int)cms_get_setting('game_stats_avg_users', 0);
$avgMinutesSetting = (int)cms_get_setting('game_stats_avg_minutes', 0);

$avgUsers   = $avgUsersSetting > 0   ? $avgUsersSetting   : $fallback['users'];
$avgMinutes = $avgMinutesSetting > 0 ? $avgMinutesSetting : $fallback['minutes'];

$avgMinutesInfo  = cms_game_stats_format_minutes($avgMinutes);
$avgMinutesYears = cms_game_stats_minutes_to_years($avgMinutes);

$lastUpdatedText = trim((string)cms_get_setting('game_stats_last_updated_text', ''));

$currentPlayersTotal = (int)cms_get_setting('game_stats_current_players_total', 0);
$peakPlayersTotal    = (int)cms_get_setting('game_stats_peak_players_total', 0);
$currentServersTotal = (int)cms_get_setting('game_stats_current_servers_total', 0);
$peakServersTotal    = (int)cms_get_setting('game_stats_peak_servers_total', 0);

if ($currentPlayersTotal <= 0) {
    $currentPlayersTotal = $totalPlayers;
}
if ($peakPlayersTotal <= 0) {
    $peakPlayersTotal = max($currentPlayersTotal, $totalPlayers);
}
if ($currentServersTotal <= 0) {
    $currentServersTotal = $totalServers;
}
if ($peakServersTotal <= 0) {
    $peakServersTotal = max($currentServersTotal, $totalServers);
}

$summary = [
    'current_players' => number_format($currentPlayersTotal),
    'peak_players'    => number_format($peakPlayersTotal),
    'current_servers' => number_format($currentServersTotal),
    'peak_servers'    => number_format($peakServersTotal),
];

$legacyThemes = ['2004', '2005_v1', '2005_v2'];
$modernThemes = ['2006_v1', '2006_v2', '2007_v1', '2007_v2'];

$contentTheme = in_array($theme, $legacyThemes, true) ? '2005_v1' : (in_array($theme, $modernThemes, true) ? '2007_v1' : $theme);
$templatePath = cms_theme_page_template('game_stats', $contentTheme);

$templateDir    = dirname($templatePath);
$previousTheme  = cms_get_current_theme();
cms_set_current_theme($contentTheme);

$templateVars = [
    'page_title'          => $page_title,
    'stats'               => $stats,
    'totals'              => $totals,
    'avg_users'           => number_format($avgUsers),
    'avg_minutes_label'   => $avgMinutesInfo['text'],
    'avg_minutes_years'   => number_format($avgMinutesYears),
    'last_updated_text'   => $lastUpdatedText,
    'summary'             => $summary,
    'game_count'          => $gameCount,
];

$content = cms_render_string(file_get_contents($templatePath), $templateVars, $templateDir);

cms_set_current_theme($previousTheme);

$layoutFile = 'default.twig';
if (in_array($theme, ['2006_v2', '2007_v1', '2007_v2'], true)) {
    $layoutFile = 'default_with_sidebar.twig';
}

$layout = cms_theme_layout($layoutFile, $theme);

cms_render_template_theme($layout, $theme, [
    'page_title' => $page_title,
    'content'    => $content,
]);
