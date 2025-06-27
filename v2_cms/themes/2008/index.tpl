{extends "layouts/main"}

{block "content"}
<div class="section-header">
    Featured & Recommended
</div>

<!-- Featured Games Grid -->
<div class="clearfix" style="margin-bottom: 20px;">
    {if $game_capsules}
        {foreach $game_capsules as $capsule}
            {if $capsule.is_featured}
                <div class="game-capsule">
                    <div class="capsule-image">
                        {if $capsule.image_url}
                            <img src="{$capsule.image_url}" alt="{$capsule.title}" style="width: 184px; height: 69px;" />
                        {else}
                            <div style="width: 184px; height: 69px; background: #1b2838; display: flex; align-items: center; justify-content: center; color: #67c1f5; font-size: 10px;">
                                {$capsule.title}
                            </div>
                        {/if}
                    </div>
                    <div class="capsule-info">
                        <div class="capsule-title">{$capsule.title}</div>
                        <div class="capsule-price">{$capsule.price|default:"Free to Play"}</div>
                    </div>
                </div>
            {/if}
        {/foreach}
    {else}
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center; font-size: 10px;">Left 4 Dead</div>
            <div class="capsule-info">
                <div class="capsule-title">Left 4 Dead</div>
                <div class="capsule-price">$49.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center; font-size: 10px;">Fallout 3</div>
            <div class="capsule-info">
                <div class="capsule-title">Fallout 3</div>
                <div class="capsule-price">$49.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center; font-size: 10px;">Dead Space</div>
            <div class="capsule-info">
                <div class="capsule-title">Dead Space</div>
                <div class="capsule-price">$49.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center; font-size: 10px;">Mirror's Edge</div>
            <div class="capsule-info">
                <div class="capsule-title">Mirror's Edge</div>
                <div class="capsule-price">$19.99</div>
            </div>
        </div>
    {/if}
</div>

{if $news_articles}
<div class="section-header">
    Latest News & Updates
</div>

{foreach $news_articles as $article}
    <div class="content-block">
        <h3 style="color: #ffffff; margin: 0 0 8px 0; font-size: 14px;">{$article.title}</h3>
        <div style="color: #8f8f8f; font-size: 11px; margin-bottom: 12px;">
            {$article.published_date} - by {$article.author}
        </div>
        {if $article.excerpt}
            <div style="color: #67c1f5; font-style: italic; margin-bottom: 10px;">
                {$article.excerpt}
            </div>
        {/if}
        <div style="color: #c6d4df; line-height: 1.4;">
            {$article.content}
        </div>
    </div>
{/foreach}
{/if}

<div class="section-header">
    Browse Games
</div>

<div class="clearfix">
    {if $game_capsules}
        {foreach $game_capsules as $capsule}
            {if !$capsule.is_featured}
                <div class="game-capsule">
                    <div class="capsule-image">
                        {if $capsule.image_url}
                            <img src="{$capsule.image_url}" alt="{$capsule.title}" style="width: 184px; height: 69px;" />
                        {else}
                            <div style="width: 184px; height: 69px; background: #1b2838; display: flex; align-items: center; justify-content: center; color: #67c1f5; font-size: 10px;">
                                {$capsule.title}
                            </div>
                        {/if}
                    </div>
                    <div class="capsule-info">
                        <div class="capsule-title">{$capsule.title}</div>
                        <div class="capsule-price">{$capsule.price|default:"Free to Play"}</div>
                    </div>
                </div>
            {/if}
        {/foreach}
    {else}
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center; font-size: 10px;">The Orange Box</div>
            <div class="capsule-info">
                <div class="capsule-title">The Orange Box</div>
                <div class="capsule-price">$29.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center; font-size: 10px;">Counter-Strike: Source</div>
            <div class="capsule-info">
                <div class="capsule-title">Counter-Strike: Source</div>
                <div class="capsule-price">$19.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center; font-size: 10px;">Team Fortress 2</div>
            <div class="capsule-info">
                <div class="capsule-title">Team Fortress 2</div>
                <div class="capsule-price">$19.99</div>
            </div>
        </div>
        
        <div class="game-capsule">
            <div class="capsule-image" style="background: #333; color: #666; display: flex; align-items: center; justify-content: center; font-size: 10px;">Garry's Mod</div>
            <div class="capsule-info">
                <div class="capsule-title">Garry's Mod</div>
                <div class="capsule-price">$9.99</div>
            </div>
        </div>
    {/if}
</div>

<div class="content-block" style="margin-top: 32px;">
    <h3 style="color: #d2e885; margin: 0 0 16px 0;">About Steam</h3>
    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 50%; padding-right: 16px;">
            <p style="margin: 0 0 12px 0; line-height: 1.4;">
                Steam is the ultimate destination for playing, discussing, and creating games. With over 1,500 games available and growing, Steam offers the largest collection of PC games on the planet.
            </p>
            <p style="margin: 0; line-height: 1.4;">
                Join millions of players worldwide and experience gaming like never before with automatic updates, community features, and more.
            </p>
        </div>
        <div style="display: table-cell; width: 50%; padding-left: 16px;">
            <ul style="list-style: none; margin: 0; padding: 0;">
                <li style="margin-bottom: 6px; color: #67c1f5;">✓ Over 1,500 games available</li>
                <li style="margin-bottom: 6px; color: #67c1f5;">✓ 15+ million registered users</li>
                <li style="margin-bottom: 6px; color: #67c1f5;">✓ Automatic game updates</li>
                <li style="margin-bottom: 6px; color: #67c1f5;">✓ Achievement system</li>
                <li style="margin-bottom: 6px; color: #67c1f5;">✓ Community features</li>
                <li style="margin: 0; color: #67c1f5;">✓ Cloud save synchronization</li>
            </ul>
        </div>
    </div>
</div>
{/block}
