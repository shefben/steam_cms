<?php
require_once __DIR__ . '/cms/db.php';
require_once __DIR__ . '/cms/template_engine.php';
require_once __DIR__ . '/cms/tournaments_service.php';

$theme = cms_get_setting('theme', '2004');
$service = cms_tournaments_service();

$blocks = $service->getContentBlocks('tourney_calendar', $theme);
$monthParam = isset($_GET['month']) ? preg_replace('/[^0-9-]/', '', $_GET['month']) : '';
$anchor = null;
if ($monthParam && preg_match('/^(\d{4})-(\d{2})$/', $monthParam, $matches)) {
    $anchor = \DateTimeImmutable::createFromFormat('Y-m-d', $matches[1] . '-' . $matches[2] . '-01');
}

$calendar = $service->getCalendarData($anchor ?: null);
$templatePath = cms_tournament_template('tourney_calendar', $theme);
$templateHtml = file_get_contents($templatePath);
if ($templateHtml === false) {
    throw new RuntimeException('Unable to load tourney_calendar template.');
}

$content = cms_render_string(
    $templateHtml,
    [
        'blocks' => $blocks,
        'calendar_months' => $calendar['months'],
        'events_by_month' => $calendar['events'],
        'sidebar_events' => $calendar['sidebar'],
        'calendar_range' => $calendar['range'],
    ],
    dirname($templatePath)
);

$layout = cms_theme_layout('default.twig', $theme);
cms_render_template($layout, [
    'page_title' => 'Tournament Calendar',
    'content' => $content,
    'show_title' => false,
]);
