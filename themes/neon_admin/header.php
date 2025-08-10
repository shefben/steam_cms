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
<div class="container">
    <div class="neon-wrapper">
        <div class="content-wrapper">
            <aside class="sidebar">
                <div class="logo">
                    <h1>SteamCMS</h1>
                    <p>Administration</p>
                </div>
                <nav>
                    <?php echo $nav_html; ?>
                </nav>
            </aside>
            <main class="main-content">
                <header class="header">
                    <div class="header-left">
                        <h2><?php echo htmlspecialchars(cms_admin_translate('CMS Administration')); ?></h2>
                        <p class="header-subtitle"><?php echo htmlspecialchars(cms_admin_translate('Welcome back, '.$admin_name)); ?></p>
                    </div>
                    <div class="header-right">
                        <div class="search-box">
                            <svg class="search-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"></path>
                            </svg>
                            <input type="text" class="search-input" placeholder="Search...">
                        </div>
                        <div class="header-actions">
                            <div class="icon-btn">
                                <i class="fas fa-bell"></i>
                                <?php if($notifications_html){ ?><div class="notification-dot"></div><?php } ?>
                            </div>
                            <div class="user-avatar"><?php echo htmlspecialchars(substr($admin_name,0,2)); ?></div>
                        </div>
                    </div>
                </header>
                <?php echo cms_admin_breadcrumb(); ?>
                <?php echo $notifications_html; ?>
