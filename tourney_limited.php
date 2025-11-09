<?php
require_once __DIR__ . '/cms/db.php';
require_once __DIR__ . '/cms/template_engine.php';
require_once __DIR__ . '/cms/tournaments_service.php';

$theme = cms_get_setting('theme', '2004');
$service = cms_tournaments_service();

$blocks = $service->getContentBlocks('tourney_limited', $theme);
$calendar = $service->getCalendarData();

$templatePath = cms_tournament_template('tourney_limited', $theme);
$templateHtml = file_get_contents($templatePath);
if ($templateHtml === false) {
    throw new RuntimeException('Unable to load tourney_limited template.');
}

$pageTitle = $blocks['hero_title']['content'] ?? 'Tournament Hub';
$content = cms_render_string(
    $templateHtml,
    [
        'blocks' => $blocks,
        'calendar_months' => $calendar['months'],
        'sidebar_events' => $calendar['sidebar'],
        'events_by_month' => $calendar['events'],
        'calendar_range' => $calendar['range'],
    ],
    dirname($templatePath)
);

$layout = cms_theme_layout('default.twig', $theme);
cms_render_template($layout, [
    'page_title' => $pageTitle,
    'content' => $content,
    'show_title' => false,
]);
