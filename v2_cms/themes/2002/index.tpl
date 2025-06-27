{extends "layouts/main"}

{block "content"}
<p><b>Steam - the future of digital distribution</b></p>

<p>Steam is Valve's revolutionary content delivery platform. With Steam you can:</p>

<ul>
    <li>Get automatic updates for all your games</li>
    <li>Access enhanced anti-piracy protection</li>
    <li>Join the largest gaming community</li>
    <li>Purchase and download games instantly</li>
</ul>

{if $news_articles}
<p><b>Latest News:</b></p>
{foreach $news_articles as $article}
    <div style="margin-bottom: 15px; padding: 8px; background-color: #3a4330;">
        <b>{$article.title}</b><br>
        <font size="1" color="#cccccc">Published: {$article.published_date}</font><br>
        <p>{$article.excerpt}</p>
        {if $article.content}
            <div style="margin-top: 10px;">
                {$article.content}
            </div>
        {/if}
    </div>
{/foreach}
{/if}

<p>
    <b>Steam System Requirements:</b><br>
    • Windows 2000/XP<br>
    • DirectX 8.0 or higher<br>
    • Internet connection required<br>
    • 128MB RAM minimum
</p>

<p><font size="1" color="#999999">
    Steam is currently in beta testing. Features and functionality may change.
</font></p>
{/block}
