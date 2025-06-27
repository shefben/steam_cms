<html>
<head>
    <style type="text/css">
    <!--
    body { margin: 0; padding: 0; background-color: #1a1a1a; font-family: Arial, sans-serif; }
    a { color: #ff6600; text-decoration: none; }
    a:hover { color: #ffaa33; text-decoration: underline; }
    .header { background: linear-gradient(to bottom, #000000 0%, #333333 100%); }
    .content { background-color: #2a2a2a; color: #ffffff; }
    .nav-bar { background-color: #ff6600; }
    -->
    </style>
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
    <title>{$site_title} - Steam Store</title>
</head>

<body>
    <!-- Header -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="header">
        <tr>
            <td align="center">
                <table width="800" cellpadding="15" cellspacing="0" border="0">
                    <tr>
                        <td width="300">
                            <img src="{$logo_url}" alt="Steam" border="0">
                        </td>
                        <td width="500" align="right" valign="middle">
                            <font color="#ffffff" size="2">
                                <b>Welcome to the Steam Store</b>
                            </font>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Navigation Bar -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="nav-bar">
        <tr>
            <td align="center">
                <table width="800" cellpadding="8" cellspacing="0" border="0">
                    <tr>
                        <td align="center">
                            {foreach $navigation_links as $nav_link}
                                <font color="#ffffff" size="2">
                                    <b><a href="{$nav_link.url}" target="{$nav_link.target}" style="color: #ffffff;">{$nav_link.title}</a></b>
                                </font>
                                {if !$nav_link@last} &nbsp;&nbsp;|&nbsp;&nbsp; {/if}
                            {/foreach}
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
    <table width="100%" cellpadding="15" cellspacing="0" border="0" style="background-color: #000000;">
        <tr>
            <td align="center">
                <font color="#666666" size="1">
                    &copy; 2005 Valve Corporation. Steam and the Steam logo are trademarks of Valve Corporation.
                    <br>All other trademarks are property of their respective owners.
                </font>
            </td>
        </tr>
    </table>
</body>
</html>
