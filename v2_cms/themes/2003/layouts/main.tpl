<html>
<head>
    <style type="text/css">
    <!--
    body { margin: 0; padding: 0; background-color: #2d3426; font-family: Arial, sans-serif; }
    a { color: #bfba50; text-decoration: none; }
    a:hover { color: #938f3c; text-decoration: underline; }
    .header { background-color: #1a1a1a; }
    .content { background-color: #2d3426; color: #ffffff; }
    .sidebar { background-color: #1e251a; }
    -->
    </style>
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
    <title>{$site_title} - Steam</title>
</head>

<body>
    <!-- Header Table -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="header">
        <tr>
            <td align="center">
                <table width="800" cellpadding="10" cellspacing="0" border="0">
                    <tr>
                        <td width="200">
                            <img src="{$logo_url}" alt="Steam" border="0">
                        </td>
                        <td width="600" align="right" valign="middle">
                            <font color="#bfba50" size="2">
                                {foreach $navigation_links as $nav_link}
                                    <a href="{$nav_link.url}" target="{$nav_link.target}">{$nav_link.title}</a>
                                    {if !$nav_link@last} | {/if}
                                {/foreach}
                            </font>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Main Content Table -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">
                <table width="800" cellpadding="0" cellspacing="0" border="0" class="content">
                    <tr>
                        <td width="200" valign="top" class="sidebar">
                            <!-- Sidebar Content -->
                            <table width="100%" cellpadding="15" cellspacing="0" border="0">
                                <tr>
                                    <td>
                                        <font size="2" color="#bfba50"><b>Steam Features</b></font><br><br>
                                        <font size="1" color="#ffffff">
                                            • Automatic updates<br>
                                            • Friends system<br>
                                            • Server browser<br>
                                            • Anti-cheat protection<br>
                                            • Game statistics<br>
                                        </font>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="600" valign="top">
                            <!-- Main Content -->
                            <table width="100%" cellpadding="20" cellspacing="0" border="0">
                                <tr>
                                    <td>
                                        <font size="2" color="#ffffff">
                                            {block_placeholder "content"}
                                        </font>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <table width="100%" cellpadding="10" cellspacing="0" border="0" style="background-color: #1a1a1a;">
        <tr>
            <td align="center">
                <font color="#666666" size="1">
                    &copy; 2003 Valve Corporation. Steam and the Steam logo are trademarks of Valve Corporation.
                </font>
            </td>
        </tr>
    </table>
</body>
</html>
