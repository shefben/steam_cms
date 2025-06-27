{extends "layouts/main"}

{block "content"}
<!-- Half-Life 2 Promotional Banner -->
<table width="100%" cellpadding="0" cellspacing="10" border="0">
    <tr>
        <td colspan="2" align="center">
            <div class="promo" style="padding: 20px; margin-bottom: 20px;">
                <img src="themes/{$current_theme}/images/hl2_logo_large.jpg" alt="Half-Life 2" border="0">
                <br><br>
                <font size="4" color="#ff6600"><b>Available Now Through Steam!</b></font>
                <br>
                <font size="2" color="#ffffff">
                    The most anticipated game of the decade is here. Experience the next chapter in the Half-Life saga.
                </font>
                <br><br>
                <a href="/store/hl2">
                    <img src="themes/{$current_theme}/images/btn_buynow.gif" alt="Buy Now" border="0">
                </a>
            </div>
        </td>
    </tr>
    <tr>
        <td width="60%" valign="top">
            <!-- News Section -->
            {if $news_articles}
            <font size="3" color="#ff6600"><b>Latest Steam News</b></font>
            <br><br>
            {foreach $news_articles as $article}
                <table width="100%" cellpadding="8" cellspacing="0" border="0" style="background-color: #333333; margin-bottom: 15px;">
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
        </td>
        <td width="40%" valign="top">
            <!-- Sidebar Content -->
            <table width="100%" cellpadding="10" cellspacing="0" border="0" style="background-color: #333333;">
                <tr>
                    <td>
                        <font size="2" color="#ff6600"><b>Source Engine Games</b></font>
                        <br><br>
                        <font size="2" color="#ffffff">
                            <b>Half-Life 2</b><br>
                            The groundbreaking sequel featuring the revolutionary Source engine.
                            <br><br>
                            
                            <b>Counter-Strike: Source</b><br>
                            The world's #1 online action game, rebuilt from the ground up.
                            <br><br>
                            
                            <b>Half-Life: Source</b><br>
                            The original Half-Life enhanced with Source engine physics.
                            <br><br>
                        </font>
                    </td>
                </tr>
            </table>
            
            <br>
            
            <table width="100%" cellpadding="10" cellspacing="0" border="0" style="background-color: #333333;">
                <tr>
                    <td>
                        <font size="2" color="#ff6600"><b>Steam Features</b></font>
                        <br><br>
                        <font size="2" color="#ffffff">
                            • Automatic game updates<br>
                            • Instant messaging and friends<br>
                            • Game statistics and achievements<br>
                            • Secure online purchases<br>
                            • Voice communication<br>
                            • Server browser<br>
                        </font>
                    </td>
                </tr>
            </table>
            
            <br>
            
            <table width="100%" cellpadding="10" cellspacing="0" border="0" style="background-color: #1a4a1a;">
                <tr>
                    <td align="center">
                        <font size="2" color="#66ff66"><b>System Requirements</b></font>
                        <br><br>
                        <font size="1" color="#ffffff">
                            <b>Minimum:</b><br>
                            • Windows 2000/XP<br>
                            • 1.2 GHz processor<br>
                            • 256 MB RAM<br>
                            • DirectX 7 graphics card<br>
                            • Internet connection<br>
                            • 4.5 GB hard drive space
                        </font>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
{/block}
