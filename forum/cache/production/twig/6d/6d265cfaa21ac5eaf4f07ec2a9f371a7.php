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
class __TwigTemplate_2d4b41afb7a0cfdcd3721ed4e601bb7c extends \Twig\Template
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
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<meta http-equiv=\"Content-Style-Type\" content=\"text/css\" />
<meta name=\"keywords\" content=\"vbulletin,forum,bbs,discussion,steam,valve\" />
<meta name=\"description\" content=\"Steam Users Forums is a discussion forum. To visit the forum, go to http://www.steampowered.com/forums/\" />
<title>";
        // line 8
        if (($context["S_IN_MCP"] ?? null)) {
            echo $this->extensions['phpbb\template\twig\extension']->lang("MCP");
            echo " - ";
        } elseif (($context["S_IN_UCP"] ?? null)) {
            echo $this->extensions['phpbb\template\twig\extension']->lang("UCP");
            echo " - ";
        }
        echo ($context["SITENAME"] ?? null);
        if (($context["S_BOARD_DISABLED"] ?? null)) {
            echo " - ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BOARD_DISABLED");
        }
        echo "</title>

<link rel=\"stylesheet\" href=\"";
        // line 10
        echo ($context["T_STYLESHEET_LINK"] ?? null);
        echo "\" type=\"text/css\" />

";
        // line 12
        if ((($context["S_CONTENT_DIRECTION"] ?? null) == "rtl")) {
            // line 13
            echo "    <link rel=\"stylesheet\" href=\"";
            echo ($context["T_THEME_PATH"] ?? null);
            echo "/bidi.css\" type=\"text/css\" />
";
        }
        // line 15
        echo "
<script type=\"text/javascript\">
// <![CDATA[
    var jump_page = '";
        // line 18
        echo $this->extensions['phpbb\template\twig\extension']->lang("JUMP_PAGE");
        echo ":';
    var on_page = '";
        // line 19
        echo ($context["ON_PAGE"] ?? null);
        echo "';
    var per_page = '";
        // line 20
        echo ($context["PER_PAGE"] ?? null);
        echo "';
    var base_url = '";
        // line 21
        echo ($context["A_BASE_URL"] ?? null);
        echo "';
    var style_cookie = 'phpBBstyle';
    var style_cookie_settings = '";
        // line 23
        echo ($context["A_COOKIE_SETTINGS"] ?? null);
        echo "';
    var onload_functions = new Array();
    var onunload_functions = new Array();

    ";
        // line 27
        if (($context["S_USER_NEW_PRIVMSG"] ?? null)) {
            // line 28
            echo "        var url = '";
            echo ($context["UA_POPUP_PM"] ?? null);
            echo "';
        window.open(url.replace(/&amp;/g, '&'), '_phpbbprivmsg', 'height=225,resizable=yes,scrollbars=yes,width=400');
    ";
        }
        // line 31
        echo "
    function popup(url, width, height, name)
    {
        if (!name)
        {
            name = '_popup';
        }

        window.open(url.replace(/&amp;/g, '&'), name, 'height=' + height + ',resizable=yes,scrollbars=yes,width=' + width);
        return false;
    }

    function jumpto()
    {
        var page = prompt(jump_page, on_page);
        var per_page_regex = /^[0-9]+\$/;
        var base_url_regex = /^http[s]?:\\/\\//;

        if (page !== null && page.match(per_page_regex))
        {
            page = parseInt(page, 10);
            if (page > 0)
            {
                if (base_url.match(base_url_regex))
                {
                    document.location.href = base_url.replace(/&amp;/g, '&') + '&start=' + ((page - 1) * per_page);
                }
                else
                {
                    document.location.href = base_url + '&start=' + ((page - 1) * per_page);
                }
            }
        }
    }

    function insert_text(text, spaces, popup)
    {
        var textarea;

        if (!popup)
        {
            textarea = document.forms[form_name].elements[text_name];
        }
        else
        {
            textarea = opener.document.forms[form_name].elements[text_name];
        }
        
        if (spaces)
        {
            text = ' ' + text + ' ';
        }

        if (!isNaN(textarea.selectionStart))
        {
            var sel_start = textarea.selectionStart;
            var sel_end = textarea.selectionEnd;

            mozWrap(textarea, text, '')
            textarea.selectionStart = sel_start + text.length;
            textarea.selectionEnd = sel_end + text.length;
        }
        else if (textarea.createTextRange && textarea.caretPos)
        {
            if (baseHeight != textarea.caretPos.boundingHeight)
            {
                textarea.focus();
                storeCaret(textarea);
            }
            var caret_pos = textarea.caretPos;
            caret_pos.text = caret_pos.text.charAt(caret_pos.text.length - 1) == ' ' ? caret_pos.text + text + ' ' : caret_pos.text + text;
        }
        else
        {
            textarea.value = textarea.value + text;
        }
        if (!popup)
        {
            textarea.focus();
        }
    }
// ]]>
</script>

</head>
<body bgcolor=\"#626d5c\" text=\"#000000\" leftmargin=\"10\" topmargin=\"10\" marginwidth=\"10\" marginheight=\"10\" link=\"#000020\" vlink=\"#000020\" alink=\"#000020\">

<!-- Steam Header -->
<center>
<table border=\"0\" width=\"90%\" cellpadding=\"0\" cellspacing=\"0\">
<tr>
    <td valign=\"top\" align=\"left\">
        <div align=\"center\">
            <img src=\"";
        // line 124
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Steam_header2.jpg\" border=\"0\" align=\"middle\" alt=\"Steam\" />
        </div>
    </td>
</tr>
<tr height=\"10\">
    <td valign=\"top\" align=\"left\" height=\"10\"></td>
</tr>
<tr>
    <td valign=\"top\" align=\"left\">
        <div align=\"center\">
            ";
        // line 134
        if (($context["S_USER_LOGGED_IN"] ?? null)) {
            // line 135
            echo "                <a href=\"";
            echo ($context["U_PROFILE"] ?? null);
            echo "\"><img src=\"";
            echo ($context["T_THEME_PATH"] ?? null);
            echo "/images/top_profile.gif\" alt=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("PROFILE");
            echo "\" border=\"0\" /></a>
            ";
        } else {
            // line 137
            echo "                <a href=\"";
            echo ($context["U_REGISTER"] ?? null);
            echo "\"><img src=\"";
            echo ($context["T_THEME_PATH"] ?? null);
            echo "/images/top_register.gif\" alt=\"";
            echo $this->extensions['phpbb\template\twig\extension']->lang("REGISTER");
            echo "\" border=\"0\" /></a>
            ";
        }
        // line 139
        echo "            <a href=\"";
        echo ($context["U_MEMBERLIST"] ?? null);
        echo "\"><img src=\"";
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/top_members.gif\" alt=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("MEMBERLIST");
        echo "\" border=\"0\" /></a>
            <a href=\"";
        // line 140
        echo ($context["U_FAQ"] ?? null);
        echo "\"><img src=\"";
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/top_faq.gif\" alt=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("FAQ");
        echo "\" border=\"0\" /></a>
            <a href=\"";
        // line 141
        echo ($context["U_SEARCH"] ?? null);
        echo "\"><img src=\"";
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/top_search.gif\" alt=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH");
        echo "\" border=\"0\" /></a>
            <a href=\"";
        // line 142
        echo ($context["U_INDEX"] ?? null);
        echo "\"><img src=\"";
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/top_home.gif\" alt=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("INDEX");
        echo "\" border=\"0\" /></a>
        </div>
    </td>
</tr>
</table>

<!-- Content Table -->
<table bgcolor=\"#626d5c\" width=\"800\" cellpadding=\"10\" cellspacing=\"0\" border=\"0\">
<tr>
    <td>
        <!-- Navigation -->
        ";
        // line 153
        if ( !($context["S_IS_BOT"] ?? null)) {
            // line 154
            echo "        <table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\" align=\"center\">
        <tr valign=\"top\">
            <td><img src=\"";
            // line 156
            echo ($context["T_THEME_PATH"] ?? null);
            echo "/images/vb_bullet.gif\" border=\"0\" align=\"middle\" alt=\"";
            echo ($context["SITENAME"] ?? null);
            echo "\" />
            <font face=\"verdana, arial, helvetica\" size=\"2\"><b>";
            // line 157
            echo ($context["SITENAME"] ?? null);
            echo "</b></font></td>
            <td align=\"right\">
                ";
            // line 159
            if (($context["S_USER_LOGGED_IN"] ?? null)) {
                // line 160
                echo "                    <font face=\"verdana,arial,helvetica\" size=\"1\">
                    <br /><b><a href=\"";
                // line 161
                echo ($context["U_SEARCH_ACTIVE_TOPICS"] ?? null);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("SEARCH_ACTIVE_TOPICS");
                echo "</a></b>
                    </font>
                ";
            }
            // line 164
            echo "            </td>
        </tr>
        </table>
        
        <table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\" align=\"center\">
        <tr>
            <td colspan=\"2\">
                <font face=\"verdana, arial, helvetica\" size=\"2\"><b>";
            // line 171
            echo $this->extensions['phpbb\template\twig\extension']->lang("WELCOME_GUEST");
            echo "</b></font><br />
                <font face=\"verdana,arial,helvetica\" size=\"1\">
                ";
            // line 173
            if (($context["S_USER_LOGGED_IN"] ?? null)) {
                // line 174
                echo "                    ";
                echo ($context["LAST_VISIT_DATE"] ?? null);
                echo "
                ";
            } else {
                // line 176
                echo "                    ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("REGISTER_PROMPT");
                echo "
                ";
            }
            // line 178
            echo "                </font>
                <hr />
            </td>
        </tr>
        <tr valign=\"bottom\">
            <td>
                <font face=\"verdana,arial,helvetica\" size=\"1\">
                ";
            // line 185
            echo ($context["TOTAL_POSTS"] ?? null);
            echo " • ";
            echo ($context["TOTAL_TOPICS"] ?? null);
            echo " • ";
            echo ($context["TOTAL_USERS"] ?? null);
            echo "<br />
                ";
            // line 186
            if (($context["NEWEST_USER"] ?? null)) {
                echo $this->extensions['phpbb\template\twig\extension']->lang("NEWEST_USER");
                echo ": <a href=\"";
                echo ($context["NEWEST_USER_FULL_URL"] ?? null);
                echo "\">";
                echo ($context["NEWEST_USER_COLOUR"] ?? null);
                echo "</a>";
            }
            // line 187
            echo "                </font>
            </td>
            <td align=\"right\">
                <font face=\"verdana,arial,helvetica\" size=\"1\">
                ";
            // line 191
            echo ($context["CURRENT_TIME"] ?? null);
            echo "<br />
                ";
            // line 192
            if (($context["S_USER_LOGGED_IN"] ?? null)) {
                echo ($context["LAST_VISIT_DATE"] ?? null);
            }
            // line 193
            echo "                </font>
            </td>
        </tr>
        </table>
        ";
        }
        // line 198
        echo "
        <br />";
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
        return array (  391 => 198,  384 => 193,  380 => 192,  376 => 191,  370 => 187,  361 => 186,  353 => 185,  344 => 178,  338 => 176,  332 => 174,  330 => 173,  325 => 171,  316 => 164,  308 => 161,  305 => 160,  303 => 159,  298 => 157,  292 => 156,  288 => 154,  286 => 153,  268 => 142,  260 => 141,  252 => 140,  243 => 139,  233 => 137,  223 => 135,  221 => 134,  208 => 124,  113 => 31,  106 => 28,  104 => 27,  97 => 23,  92 => 21,  88 => 20,  84 => 19,  80 => 18,  75 => 15,  69 => 13,  67 => 12,  62 => 10,  46 => 8,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "overall_header.html", "");
    }
}
