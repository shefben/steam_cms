<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(cms_admin_language()); ?>">
<head>
    <meta charset="utf-8">
    <title>CMS Admin</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($theme_url); ?>/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="<?php echo htmlspecialchars($theme_url); ?>/js/chart.min.js"></script>
</head>
<body>
<div class="admin-wrapper">
<header class="admin-header">
    <div class="header-content">
        <h1><?php echo htmlspecialchars(cms_admin_translate('CMS Administration')); ?></h1>
        <div class="header-controls">
            <span class="user-info">Logged in as <?php echo htmlspecialchars($admin_name); ?></span>
            <a href="<?php echo htmlspecialchars($base_url); ?>/index.php" class="btn btn-small">Home</a>
            <a href="../logout.php" class="btn btn-small">Logout</a>
        </div>
    </div>
    <?php echo cms_admin_breadcrumb(); ?>
    <?php echo $notifications_html; ?>
</header>
<div class="admin-layout">
<nav class="admin-sidebar">
<?php echo $nav_html; ?>
</nav>
<main class="admin-content">
