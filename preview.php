<?php
session_start();
require_once __DIR__ . '/cms/template_engine.php';
require_once __DIR__ . '/cms/db.php';

$type  = $_GET['type'] ?? '';
$theme = preg_replace('/[^a-zA-Z0-9_\-]/', '', $_GET['theme'] ?? cms_get_setting('theme', '2004'));

if ($type === 'news') {
    cms_require_permission('news_edit');
    $id  = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $db  = cms_get_db();
    $stmt = $db->prepare('SELECT title,author,publish_date,content FROM news WHERE id=?');
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        echo 'Article not found.';
        exit;
    }
    $content = '<h2>' . htmlspecialchars($row['title']) . '</h2>' . $row['content'];
    $tpl = cms_theme_layout('default.twig', $theme);
    cms_render_template_theme($tpl, $theme, [
        'page_title' => $row['title'],
        'content'    => $content,
    ]);
    exit;
}

if ($type === 'page') {
    cms_require_permission('manage_pages');
    $slug = preg_replace('/[^a-zA-Z0-9_\-]/', '', $_GET['slug'] ?? '');
    if ($slug === '') {
        echo 'Page not specified.';
        exit;
    }
    $db   = cms_get_db();
    $stmt = $db->prepare('SELECT title,content,template FROM custom_pages WHERE slug=?');
    $stmt->execute([$slug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        echo 'Page not found.';
        exit;
    }
    $template = $row['template'] ?: 'default.twig';
    $tpl      = cms_theme_layout($template, $theme);
    cms_render_template_theme($tpl, $theme, [
        'page_title' => $row['title'],
        'content'    => $row['content'],
    ]);
    exit;
}

echo 'Invalid preview request.';
