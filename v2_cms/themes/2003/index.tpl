{extends "layouts/main"}

{block "content"}
<p><b>Steam Public Beta Now Available</b></p>

<p>Welcome to Steam, Valve's digital distribution platform. The public beta is now available for download!</p>

<p><b>What's New in Steam:</b></p>
<ul>
    <li>Friends list and instant messaging</li>
    <li>Enhanced server browser with favorites</li>
    <li>Automatic game updates and patches</li>
    <li>Improved anti-cheat protection</li>
    <li>Game statistics and player profiles</li>
</ul>

{if $news_articles}
<p><b>Latest Steam News:</b></p>
{foreach $news_articles as $article}
    <div style="margin-bottom: 15px; padding: 10px; background-color: #1e251a; border: 1px solid #3a4330;">
        <b><font color="#bfba50">{$article.title}</font></b><br>
        <font size="1" color="#cccccc">Published: {$article.published_date} by {$article.author}</font><br><br>
        {if $article.excerpt}
            <font color="#bfba50"><i>{$article.excerpt}</i></font><br><br>
        {/if}
        <font size="2" color="#ffffff">
            {$article.content}
        </font>
    </div>
{/foreach}
{/if}

<p><b>Available Games:</b></p>
<ul>
    <li><b>Counter-Strike 1.6</b> - The world's most popular online action game</li>
    <li><b>Day of Defeat</b> - World War II team-based action</li>
    <li><b>Team Fortress Classic</b> - Class-based team combat</li>
    <li><b>Deathmatch Classic</b> - Classic Quake-style deathmatch</li>
</ul>

<p><b>System Requirements:</b><br>
• Windows 2000/XP<br>
• DirectX 8.0 or higher<br>
• 256MB RAM recommended<br>
• Internet connection required<br>
• 1GB available hard disk space</p>

<p><font color="#bfba50"><b>Download Steam Beta Today!</b></font><br>
Join thousands of players already enjoying the Steam experience.</p>
{/block}
