<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>{$site_title} - Welcome to Steam</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="themes/{$current_theme}/css/styles_global.css" rel="stylesheet" type="text/css" />
    <style>
        .inline { display: inline; }
        div.capsuleImage { position:relative; }
        div.capsuleLargeImage { position:relative; }
    </style>
</head>

<body>
    <!-- image preloads -->
    <div style="display: none;">
        <img src="themes/{$current_theme}/images/btn_getSteam_ovr.gif" alt="">
        <img src="themes/{$current_theme}/images/btn_right_wd_over.jpg" alt="">
    </div>

    <!-- header bar -->
    <div style="min-width:850px;">
        <div class="globalHeadBar_logo">
            <a href="/"><img src="{$logo_url}" alt="Steam main" border="0" /></a>
        </div>
        <div class="globalHeadBar">
            {foreach $navigation_links as $nav_link}
                <div class="globalNavItem">
                    <a href="{$nav_link.url}" title="{$nav_link.title}">
                        <span class="globalNavLink">{$nav_link.title}</span>
                    </a>
                </div>
            {/foreach}
        </div>
    </div>
    <br clear="all" />
    <!-- end header bar -->

    <center>
        <div class="contentBG_home">
            {block_placeholder "content"}
        </div>
    </center>

    <!-- Footer -->
    <div style="text-align: center; margin-top: 30px; color: #999999; font-size: 10px;">
        <p>&copy; 2006 Valve Corporation. All rights reserved. Steam and the Steam logo are trademarks of Valve Corporation.</p>
    </div>

</body>
</html>
