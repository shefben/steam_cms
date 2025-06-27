{extends "layouts/main"}

{block "content"}
<section class="featured-games">
    <h3>Featured & Recommended</h3>
    <div class="game-grid">
        <div class="game-capsule">
            <div class="game-image">Left 4 Dead 2</div>
            <div class="game-title">Left 4 Dead 2</div>
            <div class="game-price">$29.99</div>
        </div>
        <div class="game-capsule">
            <div class="game-image">Team Fortress 2</div>
            <div class="game-title">Team Fortress 2</div>
            <div class="game-price">Free to Play</div>
        </div>
        <div class="game-capsule">
            <div class="game-image">Portal</div>
            <div class="game-title">Portal</div>
            <div class="game-price">$19.99</div>
        </div>
        <div class="game-capsule">
            <div class="game-image">Half-Life 2: Episode Two</div>
            <div class="game-title">Half-Life 2: Episode Two</div>
            <div class="game-price">$7.99</div>
        </div>
    </div>
</section>

{if $news_articles}
<section class="news-section">
    <h2>Latest News</h2>
    {foreach $news_articles as $article}
        <article class="news-article">
            <h3 class="news-title">{$article.title}</h3>
            <div class="news-meta">
                Published {$article.published_date} by {$article.author}
            </div>
            {if $article.excerpt}
                <div class="news-excerpt">{$article.excerpt}</div>
            {/if}
            <div class="news-content">
                {$article.content}
            </div>
        </article>
    {/foreach}
</section>
{/if}
{/block}

{block "sidebar"}
<div class="widget">
    <h3>Top Sellers</h3>
    <ul>
        <li><a href="#">Left 4 Dead 2</a></li>
        <li><a href="#">Modern Warfare 2</a></li>
        <li><a href="#">Team Fortress 2</a></li>
        <li><a href="#">Counter-Strike: Source</a></li>
        <li><a href="#">Garry's Mod</a></li>
    </ul>
</div>

<div class="widget">
    <h3>New Releases</h3>
    <ul>
        <li><a href="#">Borderlands</a></li>
        <li><a href="#">Dragon Age: Origins</a></li>
        <li><a href="#">Torchlight</a></li>
        <li><a href="#">Shattered Horizon</a></li>
    </ul>
</div>

<div class="widget">
    <h3>Special Offers</h3>
    <ul>
        <li><a href="#">Weekend Deal - 50% off</a></li>
        <li><a href="#">Midweek Madness</a></li>
        <li><a href="#">Publisher Sale</a></li>
        <li><a href="#">Free Weekend</a></li>
    </ul>
</div>

<div class="widget">
    <h3>Steam Stats</h3>
    <ul>
        <li>25,000,000+ user accounts</li>
        <li>1,200+ games available</li>
        <li>1,000,000+ peak concurrent users</li>
        <li>Available in 21+ languages</li>
    </ul>
</div>
{/block}
