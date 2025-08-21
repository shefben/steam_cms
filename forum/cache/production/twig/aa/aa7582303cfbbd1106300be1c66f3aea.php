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
class __TwigTemplate_203f3bf6c484e493f349dd23c7e51257 extends \Twig\Template
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
        echo "        </div>
    </td>
</tr>
</table>

<br />

<!-- Footer -->
<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"77\" width=\"803\" class=\"page-footer\">
<tr height=\"2\">
    <td colspan=\"4\" height=\"2\" width=\"802\"></td>
    <td height=\"2\" width=\"1\"></td>
</tr>
<tr height=\"34\">
    <td colspan=\"2\" height=\"34\" width=\"356\"></td>
    <td align=\"left\" height=\"34\" valign=\"top\" width=\"420\">
        <img border=\"0\" height=\"23\" src=\"";
        // line 17
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/LOGO_Valve.01.gif\" width=\"82\" class=\"valve-logo-footer\" />
    </td>
    <td height=\"74\" rowspan=\"2\" width=\"26\"></td>
    <td height=\"34\" width=\"1\"></td>
</tr>
<tr height=\"40\">
    <td height=\"40\" width=\"24\"></td>
    <td align=\"left\" colspan=\"2\" height=\"40\" valign=\"top\" width=\"752\" class=\"footer-content\">
        <div align=\"center\">
            <p>
                <b><font face=\"Arial,Helvetica,Geneva,Swiss,SunSans-Regular\" size=\"2\" class=\"footer-links\">
                    <a href=\"";
        // line 28
        echo ($context["U_INDEX"] ?? null);
        echo "\">Home</a>
                </font></b> |
                <b><a href=\"#\">Support</a></b> |
                <b><a href=\"";
        // line 31
        echo ($context["U_INDEX"] ?? null);
        echo "\">Forums</a></b> |
                <b><a href=\"#\">Bugs</a></b> |
                <b><a href=\"#\">Troubleshooting</a></b> |
                <b><a href=\"#\">Contact</a></b>
                <br />
                <font face=\"Arial,Helvetica,Geneva,Swiss,SunSans-Regular\" size=\"1\" class=\"footer-copyright\">
                    2001 Valve, L.L.C. All rights reserved. Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve, L.L.C.
                </font>
                <br />
                <font size=\"2\" class=\"chatbear-footer\">
                    <b><a href=\"#\">Please Donate to Chatbear!</a></b> - 0 second(s) - <a href=\"#\">Terms and Conditions</a>.
                </font>
            </p>
        </div>
    </td>
    <td height=\"40\" width=\"1\"></td>
</tr>
</table>

<p></p>
<p></p>

";
        // line 53
        if (($context["DEBUG_OUTPUT"] ?? null)) {
            echo "<br /><br /><div align=\"center\"><span class=\"gensmall\">";
            echo ($context["DEBUG_OUTPUT"] ?? null);
            echo "</span></div>";
        }
        // line 54
        echo "
<div id=\"page-footer\" style=\"text-align: center; margin-top: 10px; font-size: 10px; color: #969F8E;\">
    Powered by <a href=\"https://www.phpbb.com/\" style=\"color: #bfba50;\">phpBB</a>&reg; Forum Software &copy; phpBB Limited<br />
    Steam Support Site theme &copy; 2002 Valve Corporation
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
        return array (  106 => 54,  100 => 53,  75 => 31,  69 => 28,  55 => 17,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "overall_footer.html", "");
    }
}
