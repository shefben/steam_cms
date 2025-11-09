<?php
require_once __DIR__ . '/cms/db.php';
require_once __DIR__ . '/cms/template_engine.php';
require_once __DIR__ . '/cms/tournaments_service.php';

$theme = cms_get_setting('theme', '2004');
$service = cms_tournaments_service();
$blocks = $service->getContentBlocks('tourney_limited', $theme);

$errors = [];
$success = false;
$result = ['data' => []];
$values = $_POST ?: [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $service->validateSubmission($_POST);
    $errors = $result['errors'];
    $values = array_merge($values, $result['data']);
    if ($errors === []) {
        $created = $service->createSubmission($result['data']);
        cms_create_notification('Tournament Submission', 'New tournament submission: ' . $result['data']['title']);
        $success = true;
    }
}

$templatePath = cms_tournament_template('tourney_limited_signup', $theme);
$templateHtml = file_get_contents($templatePath);
if ($templateHtml === false) {
    throw new RuntimeException('Unable to load tourney_limited_signup template.');
}

$context = [
    'blocks' => $blocks,
    'errors' => $errors,
    'success' => $success,
    'values' => $values,
    'games' => $service->getGameOptions(),
    'registration_options' => $service->getRegistrationOptions(),
];

$content = cms_render_string($templateHtml, $context, dirname($templatePath));

$layout = cms_theme_layout('default.twig', $theme);
cms_render_template($layout, [
    'page_title' => 'Limited Game Tournament License Signup',
    'content' => $content,
    'show_title' => false,
]);
