<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(cms_admin_language()); ?>">
<head>
    <meta charset="utf-8">
    <title>CMS Admin</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($theme_url); ?>/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="<?php echo htmlspecialchars($theme_url); ?>/js/chart.min.js"></script>
</head>
<body>
<header>
    <h1><?php echo htmlspecialchars(cms_admin_translate('CMS Administration')); ?></h1>
    <?php echo cms_admin_breadcrumb(); ?>
    <?php echo $notifications_html; ?>
</header>
<div class="admin-layout">
    <nav class="sidebar">
        <?php echo $nav_html; ?>
    </nav>
    <main class="admin-content">
