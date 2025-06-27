{extends "layouts/main"}

{block "content"}
<table width="100%" cellpadding="0" cellspacing="10" border="0">
    <tr>
        <td width="60%" valign="top">
            <!-- Main Content -->
            <h2 style="color: #ff6600;">Welcome to Steam</h2>
            <p>Experience gaming like never before with Steam's enhanced platform featuring automatic updates, community features, and the largest library of PC games.</p>

            {if $news_articles}
            <h3 style="color: #ff6600;">Latest News</h3>
            {foreach $news_articles as $article}
                <table width="100%" cellpadding="10" cellspacing="0" border="0" style="background-color: #333333; margin-bottom: 15px;">
                    <tr>
                        <td>
                            <font size="2" color="#ff6600"><b>{$article.title}</b></font>
                            <br>
                            <font size="1" color="#cccccc">{$article.published_date} - by {$article.author}</font>
                            <br><br>
                            <font size="2" color="#ffffff">
                                {if $article.excerpt}
                                    <i>{$article.excerpt}</i><br><br>
                                {/if}
                                {$article.content}
                            </font>
                        </td>
                    </tr>
                </table>
            {/foreach}
            {/if}

            <h3 style="color: #ff6600;">Steam Platform Features</h3>
            <ul style="color: #ffffff;">
                <li>Automatic game updates and patches</li>
                <li>Steam Community with friends and groups</li>
                <li>Integrated voice communication</li>
                <li>Game statistics and achievements</li>
                <li>Secure digital purchases</li>
                <li>Offline mode support</li>
            </ul>
        </td>
        <td width="40%" valign="top">
            <!-- Sidebar -->
            <table width="100%" cellpadding="10" cellspacing="0" border="0" style="background-color: #333333;">
                <tr>
                    <td>
                        <font size="2" color="#ff6600"><b>Featured Games</b></font>
                        <br><br>
                        <font size="2" color="#ffffff">
                            <b>Half-Life 2</b><br>
                            The revolutionary sequel with groundbreaking Source engine technology.
                            <br><br>
                            
                            <b>Counter-Strike: Source</b><br>
                            The world's most popular online action game, rebuilt with Source.
                            <br><br>
                            
                            <b>Half-Life 2: Lost Coast</b><br>
                            FREE technical demonstration showcasing HDR lighting.
                            <br><br>
                        </font>
                    </td>
                </tr>
            </table>
            
            <br>
            
            <table width="100%" cellpadding="10" cellspacing="0" border="0" style="background-color: #1a4a1a;">
                <tr>
                    <td align="center">
                        <font size="2" color="#66ff66"><b>Download Steam</b></font>
                        <br><br>
                        <font size="1" color="#ffffff">
                            Get the Steam client and start playing today!
                            <br><br>
                            <b>System Requirements:</b><br>
                            • Windows 2000/XP<br>
                            • 512 MB RAM<br>
                            • DirectX 8.0<br>
                            • Internet connection<br>
                            • 1 GB hard drive space
                        </font>
                    </td>
                </tr>
            </table>

            <br>

            <table width="100%" cellpadding="10" cellspacing="0" border="0" style="background-color: #4a1a1a;">
                <tr>
                    <td>
                        <font size="2" color="#ff6600"><b>Steam Stats</b></font>
                        <br><br>
                        <font size="1" color="#ffffff">
                            • Over 2 million active users<br>
                            • 50+ games available<br>
                            • 24/7 customer support<br>
                            • Available in 12 languages
                        </font>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
{/block}
