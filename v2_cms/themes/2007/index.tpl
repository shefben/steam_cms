{extends "layouts/main"}

{block "content"}
<div style="margin-bottom: 30px;">
    <h2 style="color: #ffffff; margin-bottom: 15px;">The Orange Box - Available Now!</h2>
    <p>Experience the next evolution in gaming with The Orange Box, featuring Half-Life 2: Episode Two, Portal, and Team Fortress 2.</p>
</div>

<!-- Featured Games Section -->
<div style="margin-bottom: 30px;">
    <h3 style="color: #66c0f4; margin-bottom: 15px;">Featured & Recommended</h3>
    <div class="clearfix">
        <div class="game-capsule">
            <div class="capsule-image" style="background: url('themes/2007/images/orange_box.jpg') center/cover;"></div>
            <div class="capsule-info">
                <div class="capsule-title">The Orange Box</div>
                <div class="capsule-price">$49.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: url('themes/2007/images/portal.jpg') center/cover;"></div>
            <div class="capsule-info">
                <div class="capsule-title">Portal</div>
                <div class="capsule-price">$19.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: url('themes/2007/images/tf2.jpg') center/cover;"></div>
            <div class="capsule-info">
                <div class="capsule-title">Team Fortress 2</div>
                <div class="capsule-price">$29.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: url('themes/2007/images/hl2ep2.jpg') center/cover;"></div>
            <div class="capsule-info">
                <div class="capsule-title">Half-Life 2: Episode Two</div>
                <div class="capsule-price">$29.99</div>
            </div>
        </div>
    </div>
</div>

{if $news_articles}
<div style="margin-bottom: 30px;">
    <h3 style="color: #66c0f4; margin-bottom: 15px;">Latest News</h3>
    {foreach $news_articles as $article}
        <div style="background: linear-gradient(to bottom, #2a475e 0%, #1e3a52 100%); border: 1px solid #3c4043; border-radius: 3px; padding: 16px; margin-bottom: 16px;">
            <h4 style="color: #ffffff; margin: 0 0 8px 0;">{$article.title}</h4>
            <div style="color: #8f8f8f; font-size: 11px; margin-bottom: 12px;">
                Published {$article.published_date} by {$article.author}
            </div>
            {if $article.excerpt}
                <div style="color: #66c0f4; font-style: italic; margin-bottom: 10px;">
                    {$article.excerpt}
                </div>
            {/if}
            <div style="color: #c7d5e0;">
                {$article.content}
            </div>
        </div>
    {/foreach}
</div>
{/if}

<!-- Popular Games -->
<div style="margin-bottom: 30px;">
    <h3 style="color: #66c0f4; margin-bottom: 15px;">Popular This Week</h3>
    <div class="clearfix">
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center;">Counter-Strike: Source</div>
            <div class="capsule-info">
                <div class="capsule-title">Counter-Strike: Source</div>
                <div class="capsule-price">$19.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center;">Garry's Mod</div>
            <div class="capsule-info">
                <div class="capsule-title">Garry's Mod</div>
                <div class="capsule-price">$9.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center;">Half-Life 2</div>
            <div class="capsule-info">
                <div class="capsule-title">Half-Life 2</div>
                <div class="capsule-price">$19.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center;">Day of Defeat: Source</div>
            <div class="capsule-info">
                <div class="capsule-title">Day of Defeat: Source</div>
                <div class="capsule-price">$19.99</div>
            </div>
        </div>
    </div>
</div>

<!-- Steam Stats -->
<div style="background: linear-gradient(to bottom, #2a475e 0%, #1e3a52 100%); border: 1px solid #3c4043; border-radius: 3px; padding: 20px;">
    <h3 style="color: #66c0f4; margin: 0 0 15px 0;">Steam Platform</h3>
    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 50%;">
            <ul style="list-style: none; margin: 0; padding: 0;">
                <li style="margin-bottom: 8px;">• Over 500 games available</li>
                <li style="margin-bottom: 8px;">• 10+ million registered users</li>
                <li style="margin-bottom: 8px;">• Community features and groups</li>
                <li style="margin-bottom: 8px;">• Achievement system</li>
            </ul>
        </div>
        <div style="display: table-cell; width: 50%;">
            <ul style="list-style: none; margin: 0; padding: 0;">
                <li style="margin-bottom: 8px;">• Automatic game updates</li>
                <li style="margin-bottom: 8px;">• Cloud save synchronization</li>
                <li style="margin-bottom: 8px;">• Voice and text chat</li>
                <li style="margin-bottom: 8px;">• Available in 18 languages</li>
            </ul>
        </div>
    </div>
</div>
{/block}
