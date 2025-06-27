<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>{$site_title} - Steam Store</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            background: #1b2838;
            color: #c7d5e0;
        }
        
        a {
            color: #66c0f4;
            text-decoration: none;
        }
        
        a:hover {
            color: #ffffff;
        }
        
        .header {
            background: linear-gradient(to bottom, #1b2838 0%, #2a475e 100%);
            border-bottom: 1px solid #3c4043;
            padding: 10px 0;
        }
        
        .header-container {
            width: 940px;
            margin: 0 auto;
            display: table;
        }
        
        .logo {
            display: table-cell;
            vertical-align: middle;
        }
        
        .nav {
            background: linear-gradient(to bottom, #2a475e 0%, #1e3a52 100%);
            border-bottom: 1px solid #3c4043;
        }
        
        .nav-container {
            width: 940px;
            margin: 0 auto;
        }
        
        .nav-item {
            display: inline-block;
            margin-right: 2px;
        }
        
        .nav-link {
            display: block;
            padding: 8px 16px;
            color: #b8b6b4;
            font-size: 12px;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.2) 100%);
        }
        
        .nav-link:hover {
            background: linear-gradient(to bottom, rgba(103,193,245,0.3) 0%, rgba(103,193,245,0.1) 100%);
            color: #ffffff;
        }
        
        .content {
            width: 940px;
            margin: 0 auto;
            padding: 20px 0;
        }
        
        .game-capsule {
            float: left;
            width: 184px;
            margin: 5px;
            background: #000000;
            border: 1px solid #3c4043;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .capsule-image {
            width: 100%;
            height: 69px;
            background: #333333;
            position: relative;
        }
        
        .capsule-info {
            padding: 8px;
        }
        
        .capsule-title {
            color: #ffffff;
            font-weight: bold;
            margin-bottom: 4px;
        }
        
        .capsule-price {
            color: #5ba032;
            font-weight: bold;
        }
        
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
        
        .footer {
            background: #171a21;
            border-top: 1px solid #3c4043;
            padding: 20px 0;
            text-align: center;
            color: #8f8f8f;
            font-size: 10px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-container">
            <div class="logo">
                <a href="/"><img src="{$logo_url}" alt="Steam" /></a>
            </div>
        </div>
    </div>

    <div class="nav">
        <div class="nav-container">
            {foreach $navigation_links as $nav_link}
                <div class="nav-item">
                    <a href="{$nav_link.url}" class="nav-link" 
                       {if $nav_link.target != '_self'}target="{$nav_link.target}"{/if}>
                        {$nav_link.title}
                    </a>
                </div>
            {/foreach}
        </div>
    </div>

    <div class="content">
        {block_placeholder "content"}
    </div>

    <div class="footer">
        <p>&copy; 2007 Valve Corporation. All rights reserved. Steam and the Steam logo are trademarks and/or registered trademarks of Valve Corporation in the U.S. and/or other countries.</p>
    </div>
</body>
</html>
