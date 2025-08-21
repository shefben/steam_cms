<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* overall_header.html */
class __TwigTemplate_1e552a1b84dbd5692f96655371f7f5fb extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
<meta content=\"en-gb\" http-equiv=\"Content-Language\" />
<title>";
        // line 5
        if (($context["S_IN_MCP"] ?? null)) {
            echo $this->extensions['phpbb\template\twig\extension']->lang("MCP");
            echo " - ";
        } elseif (($context["S_IN_UCP"] ?? null)) {
            echo $this->extensions['phpbb\template\twig\extension']->lang("UCP");
            echo " - ";
        }
        echo "Messageboard from Chatbear";
        if (($context["S_BOARD_DISABLED"] ?? null)) {
            echo " - ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOARD_DISABLED");
        }
        echo "</title>
<meta content=\"text/html; charset=utf-8\" http-equiv=\"Content-Type\" />

<link rel=\"stylesheet\" href=\"";
        // line 8
        echo ($context["T_STYLESHEET_LINK"] ?? null);
        echo "\" type=\"text/css\" />

";
        // line 10
        if ((($context["S_CONTENT_DIRECTION"] ?? null) == "rtl")) {
            // line 11
            echo "    <link rel=\"stylesheet\" href=\"";
            echo ($context["T_THEME_PATH"] ?? null);
            echo "/bidi.css\" type=\"text/css\" />
";
        }
        // line 13
        echo "
<script type=\"text/javascript\">
// <![CDATA[
    var jump_page = '";
        // line 16
        echo $this->extensions['phpbb\template\twig\extension']->lang("JUMP_PAGE");
        echo ":';
    var on_page = '";
        // line 17
        echo ($context["ON_PAGE"] ?? null);
        echo "';
    var per_page = '";
        // line 18
        echo ($context["PER_PAGE"] ?? null);
        echo "';
    var base_url = '";
        // line 19
        echo ($context["A_BASE_URL"] ?? null);
        echo "';
    var style_cookie = 'phpBBstyle';
    var style_cookie_settings = '";
        // line 21
        echo ($context["A_COOKIE_SETTINGS"] ?? null);
        echo "';

    ";
        // line 23
        if (($context["S_USER_NEW_PRIVMSG"] ?? null)) {
            // line 24
            echo "        var url = '";
            echo ($context["UA_POPUP_PM"] ?? null);
            echo "';
        window.open(url.replace(/&amp;/g, '&'), '_phpbbprivmsg', 'height=225,resizable=yes,scrollbars=yes,width=400');
    ";
        }
        // line 27
        echo "
    // Preload images for rollover effects
    function MM_preloadImages() {
        var d=document; 
        if(d.images){ 
            if(!d.MM_p) d.MM_p=new Array();
            var i,j=d.MM_p.length,a=MM_preloadImages.arguments; 
            for(i=0; i<a.length; i++)
                if (a[i].indexOf(\"#\")!=0){ 
                    d.MM_p[j]=new Image; 
                    d.MM_p[j++].src=a[i];
                }
        }
    }

    function popup(url, width, height, name) {
        if (!name) {
            name = '_popup';
        }
        window.open(url.replace(/&amp;/g, '&'), name, 'height=' + height + ',resizable=yes,scrollbars=yes,width=' + width);
        return false;
    }
// ]]>
</script>

</head>
<body alink=\"#27346f\" bgcolor=\"silver\" link=\"#27346f\" text=\"white\" vlink=\"#27346f\">

<table border=\"0\" cellpadding=\"5\" cellspacing=\"2\" height=\"100%\" width=\"100%\">
<tr align=\"CENTER\" valign=\"CENTER\">
<td valign=\"top\">

<!-- Chatbear Advertisement -->
<div class=\"chatbear-ad\">
    <a href=\"#\"><img alt=\"Chatbear - Get your own free messageboard!\" border=\"0\" height=\"60\" src=\"";
        // line 61
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/chatbearad.gif\" width=\"468\" class=\"chatbear-banner\" /></a>
</div>

<!-- Steam Header -->
<div align=\"center\">
<center>
<table bgcolor=\"#C0C0C0\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"steam-header\">
<tr height=\"116\">
    <td align=\"left\" colspan=\"8\" height=\"116\" valign=\"top\" width=\"678\">
        <img border=\"0\" height=\"116\" src=\"";
        // line 70
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Steam-Logo.gif\" width=\"677\" class=\"steam-logo\" />
    </td>
    <td height=\"116\" width=\"1\"></td>
</tr>
<tr height=\"24\" class=\"steam-tabs\">
    <td align=\"left\" height=\"24\" valign=\"top\" width=\"28\">
        <img border=\"0\" height=\"24\" src=\"";
        // line 76
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Tabs-Home_Border.gif\" width=\"28\" />
    </td>
    <td align=\"left\" height=\"24\" valign=\"top\" width=\"62\" class=\"tab-home\">
        <a href=\"";
        // line 79
        echo ($context["U_INDEX"] ?? null);
        echo "\">
            <img border=\"0\" height=\"24\" name=\"home_tab\" src=\"";
        // line 80
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Tabs-Home_out.gif\" width=\"62\" />
        </a>
    </td>
    <td align=\"left\" height=\"24\" valign=\"top\" width=\"60\" class=\"tab-news\">
        <a href=\"#\">
            <img border=\"0\" height=\"24\" name=\"news_tab\" src=\"";
        // line 85
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Tabs-News_out.gif\" width=\"60\" />
        </a>
    </td>
    <td align=\"left\" height=\"24\" valign=\"top\" width=\"129\" class=\"tab-games\">
        <a href=\"#\">
            <img border=\"0\" height=\"24\" name=\"games_tab\" src=\"";
        // line 90
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Tabs-Games_Avail_out.gif\" width=\"129\" />
        </a>
    </td>
    <td align=\"left\" height=\"24\" valign=\"top\" width=\"76\" class=\"tab-support\">
        <a href=\"#\">
            <img border=\"0\" height=\"24\" name=\"support_tab\" src=\"";
        // line 95
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Tabs-Support_out.gif\" width=\"76\" />
        </a>
    </td>
    <td align=\"left\" height=\"24\" valign=\"top\" width=\"122\" class=\"tab-message\">
        <img border=\"0\" height=\"24\" src=\"";
        // line 99
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Tabs-Message_Board_in.gif\" width=\"122\" />
    </td>
    <td align=\"left\" height=\"24\" valign=\"top\" width=\"64\" class=\"tab-faq\">
        <a href=\"";
        // line 102
        echo ($context["U_FAQ"] ?? null);
        echo "\">
            <img border=\"0\" height=\"24\" name=\"faq_tab\" src=\"";
        // line 103
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Tabs-FAQ_out.gif\" width=\"64\" />
        </a>
    </td>
    <td align=\"left\" height=\"24\" valign=\"top\" width=\"176\">
        <img border=\"0\" height=\"24\" src=\"";
        // line 107
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Tabs-FAQ_Border.gif\" width=\"135\" />
    </td>
    <td height=\"24\" width=\"1\"></td>
</tr>
</table>
</center>
</div>

<!-- Content Wrapper -->
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"651\">
<tr>
    <td width=\"5\">&nbsp;</td>
    <td bgcolor=\"#6a6f82\" width=\"631\" class=\"content-wrapper\">
        <table border=\"0\" cellpadding=\"5\" cellspacing=\"0\" width=\"100%\">
        <tr>
            <td width=\"100%\">
                
                <!-- Top Navigation -->
                <div align=\"center\">
                <center>
                <table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" width=\"100%\" class=\"top-nav\">
                <tr>
                    <td bgcolor=\"#3C4770\" width=\"50%\" class=\"top-nav-left\">
                        <font face=\"Arial\" size=\"2\" class=\"nav-link\">
                        ";
        // line 131
        if (($context["S_USER_LOGGED_IN"] ?? null)) {
            // line 132
            echo "                            <a href=\"";
            echo ($context["U_PROFILE"] ?? null);
            echo "\">Profile</a> :
                        ";
        } else {
            // line 134
            echo "                            <a href=\"";
            echo ($context["U_REGISTER"] ?? null);
            echo "\">Signup</a> :
                        ";
        }
        // line 136
        echo "                        <a href=\"#\">Forgotten Password</a> : 
                        <a href=\"#\">Options</a>
                        </font>
                    </td>
                    <td bgcolor=\"#3C4770\" width=\"50%\" class=\"top-nav-right\">
                        <p align=\"right\">
                            <font face=\"Arial\" size=\"2\" class=\"nav-link\">
                            ";
        // line 143
        if (($context["S_USER_LOGGED_IN"] ?? null)) {
            // line 144
            echo "                                You have ";
            if (($context["S_USER_NEW_PRIVMSG"] ?? null)) {
                echo ($context["PRIVATE_MESSAGE_COUNT"] ?? null);
            } else {
                echo "0";
            }
            echo " 
                                <a href=\"";
            // line 145
            echo ($context["U_PRIVATEMSGS"] ?? null);
            echo "\">Private Messages</a>
                            ";
        } else {
            // line 147
            echo "                                You have ? <a href=\"";
            echo ($context["U_LOGIN_LOGOUT"] ?? null);
            echo "\">Private Messages</a>
                            ";
        }
        // line 149
        echo "                            </font>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan=\"2\" width=\"100%\">
                        <font color=\"#636D5A\" face=\"Arial\" size=\"2\">.</font>
                    </td>
                </tr>
                </table>
                </center>
                </div>";
    }

    public function getTemplateName()
    {
        return "overall_header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  296 => 149,  290 => 147,  285 => 145,  276 => 144,  274 => 143,  265 => 136,  259 => 134,  253 => 132,  251 => 131,  224 => 107,  217 => 103,  213 => 102,  207 => 99,  200 => 95,  192 => 90,  184 => 85,  176 => 80,  172 => 79,  166 => 76,  157 => 70,  145 => 61,  109 => 27,  102 => 24,  100 => 23,  95 => 21,  90 => 19,  86 => 18,  82 => 17,  78 => 16,  73 => 13,  67 => 11,  65 => 10,  60 => 8,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "overall_header.html", "");
    }
}
