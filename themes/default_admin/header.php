<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(cms_admin_language()); ?>">
<head>
    <meta charset="utf-8">
    <title>CMS Admin</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($theme_url); ?>/style.css">
</head>
<body>
<header>
    <h1><?php echo htmlspecialchars(cms_admin_translate('CMS Administration')); ?></h1>
    <?php echo $nav_html; ?>
    <?php echo cms_admin_breadcrumb(); ?>
    <?php echo $notifications_html; ?>
</header>
<main>
