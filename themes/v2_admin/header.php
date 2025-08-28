<?php
// Admin header for v2_admin theme - fallback for non-Twig rendering
// This file provides basic HTML structure for pages that don't use Twig layouts
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?> - Steam CMS Admin</title>
    <link rel="stylesheet" href="<?= $theme_url ?>/style.css">
    <link rel="stylesheet" href="<?= $theme_url ?>/cropper.min.css">
    <link rel="stylesheet" href="<?= cms_base_url() ?>/cms/admin/css/file-picker.css?v=2">
    <script src="<?= $theme_url ?>/js/jquery.min.js"></script>
    <script src="<?= $theme_url ?>/js/jquery-ui.min.js"></script>
    <script src="<?= $theme_url ?>/js/Sortable.min.js"></script>
    <script src="<?= cms_base_url() ?>/cms/admin/js/file-picker.js?v=2"></script>
</head>
<body>
    <div class="admin-wrapper">
        <nav class="admin-nav">
            <div class="nav-header">
                <h1>Steam CMS Admin</h1>
                <div class="admin-info">Welcome, <?= htmlspecialchars($admin_name) ?></div>
            </div>
            <?= $nav_html ?>
        </nav>
        
        <div class="main-content">
            <div class="page-header">
                <h1><?= htmlspecialchars($page_title) ?></h1>
                <?php if (!empty($notifications_html)): ?>
                    <?= $notifications_html ?>
                <?php endif; ?>
            </div>
            
            <div class="page-content">