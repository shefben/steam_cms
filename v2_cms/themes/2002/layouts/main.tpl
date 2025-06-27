<html>
<head>
    <style type="text/css">
    <!--
    a {color: #bfba50; text-decoration: none}
    a:hover {color: #938f3c; text-decoration:; font-weight: regular}
    #layer1 { position: absolute; top: 230px; left: 171px; width: 734px; height: 523px; visibility: visible }
    -->
    </style>
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
    <title>{$site_title} - Steam Powered</title>
</head>

<body bgcolor="#626d5c">
    <div align="center">
        <table width="800" height="159" border="0" cellpadding="0" cellspacing="0" bgcolor="black">
            <tr height="16">
                <td width="799" height="16" colspan="5"></td>
                <td width="1" height="16"></td>
            </tr>
            <tr height="35">
                <td width="16" height="35"></td>
                <td width="770" height="35" colspan="3" valign="top" align="left">
                    <img src="{$logo_url}" width="770" height="29" border="0" alt="Steam Powered">
                </td>
                <td width="13" height="142" rowspan="3"></td>
                <td width="1" height="35"></td>
            </tr>
            <tr height="14">
                <td width="310" height="14" colspan="3"></td>
                <td width="476" height="107" rowspan="2" align="left" valign="top">
                    <div align="right">
                        <font size="2" face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" color="white">
                            <b>
                                {foreach $navigation_links as $nav_link}
                                    <a href="{$nav_link.url}" target="{$nav_link.target}">{$nav_link.title}</a>
                                    {if !$nav_link@last} | {/if}
                                {/foreach}
                            </b>
                        </font>
                    </div>
                </td>
                <td width="1" height="14"></td>
            </tr>
            <tr height="93">
                <td width="17" height="93" colspan="2"></td>
                <td width="293" height="93" valign="top" align="left">
                    <img src="images/LOGO_Steam2.gif" width="288" height="71" border="0" alt="Steam Logo">
                </td>
                <td width="1" height="93"></td>
            </tr>
        </table>
        
        <!-- Main Content Area -->
        <div id="layer1">
            <table width="734" bgcolor="#2d3426" cellpadding="10" cellspacing="0" border="0">
                <tr>
                    <td valign="top">
                        <font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2" color="white">
                            {block_placeholder "content"}
                        </font>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
