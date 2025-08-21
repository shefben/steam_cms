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

/* overall_footer.html */
class __TwigTemplate_7057413b07b9d27ff2d6dc87149b300e extends \Twig\Template
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
        echo "        <br />

        <!-- Timezone/Login -->
        <table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\" align=\"center\">
        <tr valign=\"top\">
            <td><font face=\"verdana,arial,helvetica\" size=\"1\">";
        // line 6
        echo $this->extensions['phpbb\template\twig\extension']->lang("TIMEZONE");
        echo ": ";
        echo ($context["S_TIMEZONE"] ?? null);
        echo ". ";
        echo ($context["CURRENT_TIME"] ?? null);
        echo "</font></td>
            <td align=\"right\">
                <font face=\"verdana,arial,helvetica\" size=\"1\">
                <a href=\"";
        // line 9
        echo ($context["U_MARK_FORUMS"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_FORUMS_READ");
        echo "</a> | 
                <a href=\"";
        // line 10
        echo ($context["U_TEAM"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("THE_TEAM");
        echo "</a>
                </font>

                ";
        // line 13
        if ( !($context["S_USER_LOGGED_IN"] ?? null)) {
            // line 14
            echo "                <form action=\"";
            echo ($context["S_LOGIN_ACTION"] ?? null);
            echo "\" method=\"post\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                    <td nowrap=\"nowrap\"><font face=\"verdana,arial,helvetica\" size=\"1\"><b>";
            // line 17
            echo $this->extensions['phpbb\template\twig\extension']->lang("LOGIN_LOGOUT");
            echo "</b><br />";
            echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAME");
            echo ": </font></td>
                </tr>
                <tr>
                    <td nowrap=\"nowrap\">
                    <input type=\"hidden\" name=\"redirect\" value=\"";
            // line 21
            echo ($context["S_REDIRECT"] ?? null);
            echo "\" />
                    <input type=\"text\" class=\"bginput\" name=\"username\" size=\"7\" maxlength=\"40\" value=\"";
            // line 22
            echo ($context["USERNAME"] ?? null);
            echo "\" />
                    <input type=\"password\" class=\"bginput\" name=\"password\" size=\"7\" maxlength=\"32\" />
                    <input type=\"submit\" class=\"bginput\" value=\"";
            // line 24
            echo $this->extensions['phpbb\template\twig\extension']->lang("LOGIN");
            echo "\" />
                    </td>
                </tr>
                </table>
                </form>
                ";
        }
        // line 30
        echo "            </td>
        </tr>
        </table>

        <br />

        <!-- Icons Legend -->
        <table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\" align=\"center\">
        <tr>
            <td align=\"center\">
                <img src=\"";
        // line 40
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/on.gif\" border=\"0\" alt=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("NEW_POSTS");
        echo "\" align=\"absmiddle\" />
                <b><font face=\"verdana,arial,helvetica\" size=\"1\">";
        // line 41
        echo $this->extensions['phpbb\template\twig\extension']->lang("NEW_POSTS");
        echo "</font></b>
                &nbsp;&nbsp;
                <img src=\"";
        // line 43
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/off.gif\" border=\"0\" alt=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("NO_NEW_POSTS");
        echo "\" align=\"absmiddle\" />
                <b><font face=\"verdana,arial,helvetica\" size=\"1\">";
        // line 44
        echo $this->extensions['phpbb\template\twig\extension']->lang("NO_NEW_POSTS");
        echo "</font></b>
                &nbsp;&nbsp;
                <img src=\"";
        // line 46
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/offlock.gif\" border=\"0\" alt=\"";
        echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_LOCKED");
        echo "\" align=\"absmiddle\" />
                <b><font face=\"verdana,arial,helvetica\" size=\"1\">";
        // line 47
        echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM_LOCKED");
        echo "</font></b>
            </td>
        </tr>
        </table>

    </td>
</tr>
</table>
<!-- /content area table -->
</center>

<!-- Footer -->
<table width=\"803\" height=\"77\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr height=\"2\">
    <td width=\"802\" height=\"2\" colspan=\"4\"></td>
    <td width=\"1\" height=\"2\"></td>
</tr>
<tr height=\"34\">
    <td width=\"356\" height=\"34\" colspan=\"2\"></td>
    <td width=\"420\" height=\"34\" valign=\"top\" align=\"left\">
        <img src=\"";
        // line 67
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/LOGO_Valve.01.gif\" width=\"82\" height=\"23\" border=\"0\" alt=\"Valve\" />
    </td>
    <td width=\"26\" height=\"74\" rowspan=\"2\"></td>
    <td width=\"1\" height=\"34\"></td>
</tr>
<tr height=\"40\">
    <td width=\"24\" height=\"40\"></td>
    <td width=\"752\" height=\"40\" colspan=\"2\" align=\"left\" valign=\"top\">
        <div align=\"center\">
            <p>
            <font face=\"Arial,Helvetica,Geneva,Swiss,SunSans-Regular\" size=\"2\">
            <a href=\"";
        // line 78
        echo ($context["U_INDEX"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("INDEX");
        echo "</a> | 
            <a href=\"#\">Support</a> | 
            <a href=\"";
        // line 80
        echo ($context["U_INDEX"] ?? null);
        echo "\">Forums</a> | 
            <a href=\"#\">Bugs</a> | 
            <a href=\"#\">Troubleshooting</a> | 
            <a href=\"#\">Contact</a>
            <br />
            </font>
            <font face=\"Arial,Helvetica,Geneva,Swiss,SunSans-Regular\" size=\"1\">
            (c) 2003 Valve, L.L.C. All rights reserved. Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve, L.L.C.
            </font>
            </p>
        </div>
    </td>
    <td width=\"1\" height=\"40\"></td>
</tr>
</table>

";
        // line 96
        if (($context["DEBUG_OUTPUT"] ?? null)) {
            echo "<br /><br /><div align=\"center\"><span class=\"gensmall\">";
            echo ($context["DEBUG_OUTPUT"] ?? null);
            echo "</span></div>";
        }
        // line 97
        echo "
<div id=\"page-footer\">
    Powered by <a href=\"https://www.phpbb.com/\">phpBB</a>&reg; Forum Software &copy; phpBB Limited<br />
    Steam theme &copy; 2003 Valve Corporation
</div>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "overall_footer.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  213 => 97,  207 => 96,  188 => 80,  181 => 78,  167 => 67,  144 => 47,  138 => 46,  133 => 44,  127 => 43,  122 => 41,  116 => 40,  104 => 30,  95 => 24,  90 => 22,  86 => 21,  77 => 17,  70 => 14,  68 => 13,  60 => 10,  54 => 9,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "overall_footer.html", "");
    }
}
