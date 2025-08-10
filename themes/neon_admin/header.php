<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(cms_admin_language()); ?>">
<head>
    <meta charset="utf-8">
    <title>CMS Admin</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($theme_url); ?>/style.css">
    <link rel="stylesheet" href="<?php echo htmlspecialchars($theme_url); ?>/cropper.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="<?php echo htmlspecialchars($theme_url); ?>/js/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="<?php echo htmlspecialchars($theme_url); ?>/js/chart.min.js"></script>
</head>
<body>
<header class="admin-header">
    <h1><?php echo htmlspecialchars(cms_admin_translate('CMS Administration')); ?></h1>
</header>
<?php echo cms_admin_breadcrumb(); ?>
<?php echo $notifications_html; ?>
<div class="container">
    <div class="neon-wrapper">
        <div class="content-wrapper">
            <aside class="sidebar">
                <div class="logo">
                    <h1>SteamCMS</h1>
                    <p>Administration</p>
                </div>
                <nav style="padding-top: 25px;">
                    <?php echo $nav_html; ?>
                </nav>
            </aside>
            <main class="main-content">
