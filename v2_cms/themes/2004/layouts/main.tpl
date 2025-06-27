<html>
<head>
    <style type="text/css">
    <!--
    body { margin: 0; padding: 0; background-color: #1a1a1a; font-family: Arial, sans-serif; }
    a { color: #ff6600; text-decoration: none; }
    a:hover { color: #ffaa33; text-decoration: underline; }
    .header { background-color: #000000; }
    .content { background-color: #2a2a2a; color: #ffffff; }
    .promo { background-color: #330000; border: 2px solid #ff6600; }
    -->
    </style>
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
    <title>{$site_title} - Half-Life 2 and Steam</title>
</head>

<body>
    <!-- Header Table -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="header">
        <tr>
            <td align="center">
                <table width="800" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td width="400">
                            <img src="{$logo_url}" alt="Steam Powered" border="0">
                        </td>
                        <td width="400" align="right" valign="middle">
                            <font color="#ffffff" size="2">
                                {foreach $navigation_links as $nav_link}
                                    <a href="{$nav_link.url}">{$nav_link.title}</a>
                                    {if !$nav_link@last} | {/if}
                                {/foreach}
                            </font>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Main Content -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">
                <table width="800" cellpadding="20" cellspacing="0" border="0" class="content">
                    <tr>
                        <td>
                            {block_placeholder "content"}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <table width="100%" cellpadding="10" cellspacing="0" border="0" style="background-color: #000000;">
        <tr>
            <td align="center">
                <font color="#666666" size="1">
                    &copy; 2004 Valve Corporation. Half-Life 2, Steam and the Steam logo are trademarks of Valve Corporation.
                </font>
            </td>
        </tr>
    </table>
</body>
</html>
