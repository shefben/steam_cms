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
class __TwigTemplate_403b5a770a4e3b656ca9d2a4628b2e2e extends \Twig\Template
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
<meta content=\"text/html;charset=utf-8\" http-equiv=\"content-type\" />
<title>";
        // line 5
        if (($context["S_IN_MCP"] ?? null)) {
            echo $this->extensions['phpbb\template\twig\extension']->lang("MCP");
            echo " - ";
        } elseif (($context["S_IN_UCP"] ?? null)) {
            echo $this->extensions['phpbb\template\twig\extension']->lang("UCP");
            echo " - ";
        }
        echo "Steam - Support Site";
        if (($context["S_BOARD_DISABLED"] ?? null)) {
            echo " - ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOARD_DISABLED");
        }
        echo "</title>

<link rel=\"stylesheet\" href=\"";
        // line 7
        echo ($context["T_STYLESHEET_LINK"] ?? null);
        echo "\" type=\"text/css\" />

";
        // line 9
        if ((($context["S_CONTENT_DIRECTION"] ?? null) == "rtl")) {
            // line 10
            echo "    <link rel=\"stylesheet\" href=\"";
            echo ($context["T_THEME_PATH"] ?? null);
            echo "/bidi.css\" type=\"text/css\" />
";
        }
        // line 12
        echo "
<script type=\"text/javascript\">
// <![CDATA[
    var jump_page = '";
        // line 15
        echo $this->extensions['phpbb\template\twig\extension']->lang("JUMP_PAGE");
        echo ":';
    var on_page = '";
        // line 16
        echo ($context["ON_PAGE"] ?? null);
        echo "';
    var per_page = '";
        // line 17
        echo ($context["PER_PAGE"] ?? null);
        echo "';
    var base_url = '";
        // line 18
        echo ($context["A_BASE_URL"] ?? null);
        echo "';
    var style_cookie = 'phpBBstyle';
    var style_cookie_settings = '";
        // line 20
        echo ($context["A_COOKIE_SETTINGS"] ?? null);
        echo "';

    ";
        // line 22
        if (($context["S_USER_NEW_PRIVMSG"] ?? null)) {
            // line 23
            echo "        var url = '";
            echo ($context["UA_POPUP_PM"] ?? null);
            echo "';
        window.open(url.replace(/&amp;/g, '&'), '_phpbbprivmsg', 'height=225,resizable=yes,scrollbars=yes,width=400');
    ";
        }
        // line 26
        echo "
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
<body alink=\"#938f3c\" bgcolor=\"#626d5c\" link=\"#bfba50\" text=\"#c4cabe\" vlink=\"#938f3c\">

<!-- Planet Groovy Advertisement -->
<p align=\"center\" class=\"groovy-ad\">
    <a href=\"#\"><img alt=\"Planet Groovy - 24 Hour Updates, Gaming, Entertainment, News and more!\" border=\"0\" height=\"60\" src=\"";
        // line 42
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/fridaypgad.gif\" width=\"468\" class=\"groovy-banner\" /></a>
</p>

<!-- Steam Header -->
<div align=\"left\">
<table align=\"center\" bgcolor=\"#000000\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"steam-header\">
<tr class=\"spacer-h16\">
    <td colspan=\"5\" height=\"16\" width=\"799\"></td>
    <td height=\"16\" width=\"1\"></td>
</tr>
<tr class=\"spacer-h38\">
    <td colspan=\"2\" height=\"38\" width=\"17\"></td>
    <td align=\"left\" colspan=\"3\" height=\"38\" valign=\"top\" width=\"782\">
        <img border=\"0\" height=\"29\" src=\"";
        // line 55
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Type_SupportSite2.jpg\" width=\"770\" class=\"support-site-logo\" />
    </td>
    <td height=\"38\" width=\"1\"></td>
</tr>
<tr class=\"spacer-h18\">
    <td colspan=\"3\" height=\"18\" width=\"241\"></td>
    <td align=\"left\" height=\"80\" rowspan=\"2\" valign=\"top\" width=\"545\" class=\"header-nav\">
        <div align=\"right\">
            <font face=\"Arial,Helvetica,Geneva,Swiss,SunSans-Regular\" size=\"2\" class=\"header-nav-main\">
                <b><a href=\"";
        // line 64
        echo ($context["U_INDEX"] ?? null);
        echo "\">Home</a></b> |
                <b><a href=\"#\">Support</a></b> |
                <b><a href=\"";
        // line 66
        echo ($context["U_INDEX"] ?? null);
        echo "\">Forums</a></b> |
                <b><a href=\"#\">Bugs</a></b> |
                <b><a href=\"#\">Troubleshooting</a></b> |
                <b><a href=\"#\">Contact</a></b>
            </font><br />
            <font face=\"Arial,Helvetica,Geneva,Swiss,SunSans-Regular\" size=\"1\" class=\"header-nav-sub\">
                ";
        // line 72
        if (($context["S_USER_LOGGED_IN"] ?? null)) {
            // line 73
            echo "                    <a href=\"";
            echo ($context["U_PROFILE"] ?? null);
            echo "\">Account Options</a> |
                ";
        } else {
            // line 75
            echo "                    <a href=\"";
            echo ($context["U_REGISTER"] ?? null);
            echo "\">Create Account</a> |
                ";
        }
        // line 77
        echo "                <a href=\"#\">Account Options</a> |
                <a href=\"#\">Lost Password</a> |
                <a href=\"";
        // line 79
        echo ($context["U_PRIVATEMSGS"] ?? null);
        echo "\">Private Messages 
                ";
        // line 80
        if (($context["S_USER_NEW_PRIVMSG"] ?? null)) {
            echo "(";
            echo ($context["PRIVATE_MESSAGE_COUNT"] ?? null);
            echo ")";
        } else {
            echo "(?)";
        }
        echo "</a>
            </font>
        </div>
    </td>
    <td height=\"80\" rowspan=\"2\" width=\"13\"></td>
    <td height=\"18\" width=\"1\"></td>
</tr>
<tr class=\"spacer-h62\">
    <td height=\"62\" width=\"15\"></td>
    <td align=\"left\" colspan=\"2\" height=\"62\" valign=\"top\" width=\"226\">
        <img border=\"0\" height=\"51\" src=\"";
        // line 90
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Logo_Steam2.jpg\" width=\"188\" class=\"steam-logo\" />
    </td>
    <td height=\"62\" width=\"1\"></td>
</tr>
</table>
</div>

<br />

<!-- Content Wrapper -->
<table align=\"center\" bgcolor=\"#626D5C\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\" width=\"798\" class=\"content-wrapper\">
<tr valign=\"top\">
    <td align=\"left\" bgcolor=\"#4c5844\" width=\"100%\" class=\"content-inner\">
        <div align=\"center\" class=\"board-listing\">";
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
        return array (  209 => 90,  190 => 80,  186 => 79,  182 => 77,  176 => 75,  170 => 73,  168 => 72,  159 => 66,  154 => 64,  142 => 55,  126 => 42,  108 => 26,  101 => 23,  99 => 22,  94 => 20,  89 => 18,  85 => 17,  81 => 16,  77 => 15,  72 => 12,  66 => 10,  64 => 9,  59 => 7,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "overall_header.html", "");
    }
}
