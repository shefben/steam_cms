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
class __TwigTemplate_f0213af50e698ea27b81cb2bbaf44596 extends \Twig\Template
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
        echo "                <!-- Bottom Links and Donation -->
                <p align=\"center\">
                    <font size=\"2\">
                        <b><a href=\"#\" class=\"donation-link\">Please Donate to Chatbear!</a></b> - 
                        1 second(s) - 
                        <a href=\"#\" class=\"terms-link\">Terms and Conditions</a>.
                    </font>
                </p>
                
            </td>
        </tr>
        </table>
    </td>
    <td width=\"14\">&nbsp;</td>
</tr>
</table>

<!-- Page Bottom -->
<img border=\"0\" height=\"43\" src=\"";
        // line 19
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Page-Bottom.gif\" width=\"675\" class=\"page-bottom\" />

<!-- Valve Footer -->
<div align=\"center\">
<center>
<table bgcolor=\"#C0C0C0\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"valve-footer\">
<tr height=\"29\">
    <td colspan=\"2\" height=\"29\" width=\"288\"></td>
    <td align=\"left\" height=\"29\" valign=\"top\">
        <p align=\"center\">
            <img border=\"0\" height=\"29\" src=\"";
        // line 29
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Bottom-VALVE1.gif\" width=\"81\" class=\"valve-logo\" />
        </p>
    </td>
    <td colspan=\"2\" height=\"29\" width=\"306\"></td>
    <td height=\"29\" width=\"1\"></td>
</tr>
<tr height=\"19\">
    <td height=\"19\" width=\"132\"></td>
    <td align=\"left\" colspan=\"3\" height=\"19\" valign=\"top\" width=\"463\">
        <map name=\"BottomLinks\">
            <area coords=\"6,3,40,15\" href=\"";
        // line 39
        echo ($context["U_INDEX"] ?? null);
        echo "\" shape=\"rect\" />
            <area coords=\"44,4,76,15\" href=\"#\" shape=\"rect\" />
            <area coords=\"88,3,167,14\" href=\"#\" shape=\"rect\" />
            <area coords=\"178,5,219,16\" href=\"#\" shape=\"rect\" />
            <area coords=\"234,4,312,15\" href=\"#\" shape=\"rect\" />
            <area coords=\"319,4,346,15\" href=\"";
        // line 44
        echo ($context["U_FAQ"] ?? null);
        echo "\" shape=\"rect\" />
            <area coords=\"355,5,401,16\" href=\"mailto:steamsupport@valvesoftware.com\" shape=\"rect\" />
        </map>
        <img border=\"0\" height=\"19\" src=\"";
        // line 47
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Bottom-Links.gif\" usemap=\"#BottomLinks\" width=\"412\" class=\"footer-links\" />
    </td>
    <td height=\"19\" width=\"83\"></td>
    <td height=\"19\" width=\"1\"></td>
</tr>
<tr>
    <td align=\"left\" colspan=\"5\" valign=\"top\" width=\"100%\">
        <p align=\"center\">
            <img border=\"0\" height=\"28\" src=\"";
        // line 55
        echo ($context["T_THEME_PATH"] ?? null);
        echo "/images/Bottom-COPY1.gif\" width=\"678\" class=\"footer-copyright\" />
        </p>
    </td>
    <td width=\"1\"></td>
</tr>
</table>
</center>
</div>

</td>
</tr>
</table>

";
        // line 68
        if (($context["DEBUG_OUTPUT"] ?? null)) {
            echo "<br /><br /><div align=\"center\"><span class=\"gensmall\">";
            echo ($context["DEBUG_OUTPUT"] ?? null);
            echo "</span></div>";
        }
        // line 69
        echo "
<div id=\"page-footer\" style=\"text-align: center; margin-top: 10px; font-size: 10px; color: #666;\">
    Powered by <a href=\"https://www.phpbb.com/\" style=\"color: #666;\">phpBB</a>&reg; Forum Software &copy; phpBB Limited<br />
    Chatbear theme &copy; 2002 Valve Corporation
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
        return array (  130 => 69,  124 => 68,  108 => 55,  97 => 47,  91 => 44,  83 => 39,  70 => 29,  57 => 19,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "overall_footer.html", "");
    }
}
