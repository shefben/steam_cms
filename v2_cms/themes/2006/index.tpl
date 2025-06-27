{extends "layouts/main"}

{block "content"}
<div class="newsSection">
    <h2 style="color: #c6d73c; margin-bottom: 20px;">Welcome to the Steam Store</h2>
    
    <div style="margin-bottom: 30px;">
        <p>Steam is the ultimate destination for playing, discussing, and creating games. Browse the catalog of over 500 titles and discover your next favorite game.</p>
    </div>

    {if $news_articles}
    <h3 style="color: #c6d73c; margin-bottom: 15px;">Latest News</h3>
    {foreach $news_articles as $article}
        <div class="newsItem">
            <div class="newsTitle">{$article.title}</div>
            <div class="newsDate">Published: {$article.published_date} by {$article.author}</div>
            <div class="newsContent">
                {if $article.excerpt}
                    <p><strong>{$article.excerpt}</strong></p>
                {/if}
                {$article.content}
            </div>
        </div>
    {/foreach}
    {/if}

    <!-- Featured Games Section -->
    <div class="marginBottom">
        <h3 style="color: #c6d73c; margin-bottom: 15px;">Featured Games</h3>
        <div class="clearfix">
            <div class="gameCapsule">
                <div class="capsuleImage">
                    <img src="themes/{$current_theme}/images/hl2_capsule.jpg" alt="Half-Life 2" width="160" height="120">
                </div>
                <div class="capsuleTitle">Half-Life 2</div>
                <div class="capsulePrice">$39.95</div>
            </div>
            
            <div class="gameCapsule">
                <div class="capsuleImage">
                    <img src="themes/{$current_theme}/images/css_capsule.jpg" alt="Counter-Strike: Source" width="160" height="120">
                </div>
                <div class="capsuleTitle">Counter-Strike: Source</div>
                <div class="capsulePrice">$29.95</div>
            </div>
            
            <div class="gameCapsule">
                <div class="capsuleImage">
                    <img src="themes/{$current_theme}/images/dod_capsule.jpg" alt="Day of Defeat: Source" width="160" height="120">
                </div>
                <div class="capsuleTitle">Day of Defeat: Source</div>
                <div class="capsulePrice">$19.95</div>
            </div>
            
            <div class="gameCapsule">
                <div class="capsuleImage">
                    <img src="themes/{$current_theme}/images/tf2_capsule.jpg" alt="Team Fortress 2" width="160" height="120">
                </div>
                <div class="capsuleTitle">Team Fortress 2</div>
                <div class="capsulePrice">Coming Soon</div>
            </div>
        </div>
    </div>

    <!-- System Requirements -->
    <div style="background-color: #2c5530; border: 1px solid #4a7c4f; padding: 15px; margin-top: 20px;">
        <h3 style="color: #c6d73c; margin-top: 0;">Steam System Requirements</h3>
        <p><strong>Minimum:</strong></p>
        <ul>
            <li>Windows 2000/XP/Vista</li>
            <li>512 MB RAM</li>
            <li>DirectX 8.0 compatible graphics card</li>
            <li>Internet connection required</li>
            <li>1 GB available hard disk space</li>
        </ul>
        <p><strong>Recommended:</strong></p>
        <ul>
            <li>Windows XP/Vista</li>
            <li>1 GB RAM</li>
            <li>DirectX 9.0c compatible graphics card</li>
            <li>Broadband internet connection</li>
        </ul>
    </div>
</div>
{/block}
