<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$site_title} - Steam Store</title>
    <link rel="stylesheet" href="themes/{$current_theme}/css/styles.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <a href="/">
                    <img src="{$logo_url}" alt="Steam" />
                </a>
            </div>
        </div>
    </header>

    <nav>
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
    </nav>

    <main>
        <div class="content-area">
            {block_placeholder "content"}
        </div>
        
        <aside class="sidebar">
            {block_placeholder "sidebar"}
        </aside>
    </main>

    <footer>
        <p>&copy; 2009 Valve Corporation. All rights reserved. Steam and the Steam logo are trademarks and/or registered trademarks of Valve Corporation in the U.S. and/or other countries.</p>
    </footer>
</body>
</html>
