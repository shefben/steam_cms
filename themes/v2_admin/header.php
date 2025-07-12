<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CMS Admin</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($theme_url); ?>/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>
<div class="admin-wrapper">
<header class="admin-header">
    <div class="header-content">
        <h1>CMS Administration</h1>
        <div class="header-controls">
            <span class="user-info">Logged in as <?php echo htmlspecialchars($admin_name); ?></span>
            <a href="<?php echo htmlspecialchars($base_url); ?>/index.php" class="btn btn-small">Home</a>
            <a href="../logout.php" class="btn btn-small">Logout</a>
        </div>
    </div>
    <?php echo cms_admin_breadcrumb(); ?>
</header>
<div class="admin-layout">
<nav class="admin-sidebar">
<?php echo $nav_html; ?>
</nav>
<main class="admin-content">
