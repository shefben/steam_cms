<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{$site_title} - Steam Store</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            background: #1b2838;
            color: #c6d4df;
        }
        
        a {
            color: #67c1f5;
            text-decoration: none;
        }
        
        a:hover {
            color: #ffffff;
        }
        
        .header {
            background: linear-gradient(to bottom, #213a5c 0%, #1e3651 50%, #17212e 100%);
            border-bottom: 1px solid #16202d;
            height: 104px;
            position: relative;
        }
        
        .header-content {
            width: 940px;
            margin: 0 auto;
            position: relative;
            height: 104px;
        }
        
        .logo {
            position: absolute;
            left: 16px;
            top: 12px;
        }
        
        .user-info {
            position: absolute;
            right: 16px;
            top: 16px;
            color: #67c1f5;
            font-size: 11px;
        }
        
        .main-nav {
            background: linear-gradient(to bottom, #67c1f5 0%, #417fb0 100%);
            height: 39px;
            border-bottom: 1px solid #417fb0;
        }
        
        .nav-content {
            width: 940px;
            margin: 0 auto;
            height: 39px;
            position: relative;
        }
        
        .nav-items {
            position: absolute;
            left: 16px;
            top: 0;
            height: 39px;
            line-height: 39px;
        }
        
        .nav-item {
            display: inline-block;
            margin-right: 1px;
        }
        
        .nav-link {
            display: block;
            padding: 0 16px;
            height: 39px;
            line-height: 39px;
            color: #1e3651;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: linear-gradient(to bottom, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.05) 50%, rgba(0,0,0,0.05) 51%, rgba(0,0,0,0.1) 100%);
        }
        
        .nav-link:hover {
            background: linear-gradient(to bottom, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.1) 50%, rgba(0,0,0,0.05) 51%, rgba(0,0,0,0.2) 100%);
            color: #000000;
        }
        
        .page-content {
            width: 940px;
            margin: 0 auto;
            padding: 16px;
            min-height: 600px;
        }
        
        .game-capsule {
            display: inline-block;
            width: 184px;
            margin: 0 5px 10px 0;
            background: #000;
            border: 1px solid #1b2838;
            vertical-align: top;
        }
        
        .capsule-image {
            width: 184px;
            height: 69px;
            background: #1b2838;
            position: relative;
            overflow: hidden;
        }
        
        .capsule-info {
            padding: 8px;
            min-height: 45px;
        }
        
        .capsule-title {
            color: #ffffff;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 4px;
            line-height: 14px;
        }
        
        .capsule-price {
            color: #90ba3c;
            font-weight: bold;
            font-size: 11px;
        }
        
        .section-header {
            background: linear-gradient(to bottom, #4c6b22 0%, #39511a 100%);
            border: 1px solid #39511a;
            color: #d2e885;
            font-weight: bold;
            padding: 8px 16px;
            margin: 16px 0 8px 0;
            font-size: 13px;
        }
        
        .content-block {
            background: linear-gradient(to bottom, #2a475e 0%, #1e3a52 100%);
            border: 1px solid #1e3a52;
            margin-bottom: 16px;
            padding: 16px;
        }
        
        .footer {
            background: #171a21;
            border-top: 1px solid #3c4043;
            padding: 16px 0;
            text-align: center;
            color: #8f8f8f;
            font-size: 10px;
            margin-top: 32px;
        }
        
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="logo">
                <a href="/"><img src="{$logo_url}" alt="Steam" /></a>
            </div>
            <div class="user-info">
                <a href="#">Login</a> | <a href="#">Join Steam</a>
            </div>
        </div>
    </div>

    <div class="main-nav">
        <div class="nav-content">
            <div class="nav-items">
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
    </div>

    <div class="page-content">
        {block_placeholder "content"}
    </div>

    <div class="footer">
        <p>&copy; 2008 Valve Corporation. All rights reserved. Steam and the Steam logo are trademarks and/or registered trademarks of Valve Corporation in the U.S. and/or other countries.</p>
    </div>
</body>
</html>
