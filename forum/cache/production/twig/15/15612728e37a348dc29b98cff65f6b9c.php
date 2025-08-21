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

/* message_body.html */
class __TwigTemplate_4b89530978ea9b916ab85e145db6d3a1 extends \Twig\Template
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
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_header.html", "message_body.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<!-- Message Display -->
<!-- Message Headers -->
<table border=\"0\" cellspacing=\"0\" width=\"100%\" class=\"forum-header\">
<tr>
    <td bgcolor=\"#424B3C\" width=\"100%\" class=\"forum-header-cell\">
        <p align=\"center\"><font color=\"#EBEDEA\" face=\"Arial\" size=\"2\"><b>";
        // line 8
        echo ($context["MESSAGE_TITLE"] ?? null);
        echo "</b></font></p>
    </td>
</tr>
</table>

<!-- Message Content -->
<div align=\"center\">
<table border=\"0\" cellspacing=\"0\" width=\"100%\" class=\"forum-row\">
<tr>
    <td bgcolor=\"#4C5844\" width=\"100%\" class=\"forum-cell\">
        <p align=\"center\">
            <font face=\"Arial\" size=\"2\">
            ";
        // line 20
        echo ($context["MESSAGE_TEXT"] ?? null);
        echo "
            </font>
            
            ";
        // line 23
        if (($context["S_USER_NOTICE"] ?? null)) {
            // line 24
            echo "            <br /><br />
            <font face=\"Arial\" size=\"1\">
            <a href=\"";
            // line 26
            echo ($context["U_LOGIN_LOGOUT"] ?? null);
            echo "\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("LOGIN_LOGOUT");
            echo "</a>
            </font>
            ";
        }
        // line 29
        echo "            
            ";
        // line 30
        if (($context["L_RETURN_TO"] ?? null)) {
            // line 31
            echo "            <br /><br />
            <font face=\"Arial\" size=\"1\">
            <a href=\"";
            // line 33
            echo ($context["U_RETURN_TO"] ?? null);
            echo "\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("RETURN_TO");
            echo "</a>
            </font>
            ";
        }
        // line 36
        echo "            
            ";
        // line 37
        if (($context["S_META"] ?? null)) {
            // line 38
            echo "            <br /><br />
            <font face=\"Arial\" size=\"1\">
            ";
            // line 40
            echo $this->extensions['phpbb\template\twig\extension']->lang("REDIRECT");
            echo "
            </font>
            ";
        }
        // line 43
        echo "        </p>
    </td>
</tr>
</table>
</div>

";
        // line 49
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "message_body.html", 49)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "message_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 49,  124 => 43,  118 => 40,  114 => 38,  112 => 37,  109 => 36,  101 => 33,  97 => 31,  95 => 30,  92 => 29,  84 => 26,  80 => 24,  78 => 23,  72 => 20,  57 => 8,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "message_body.html", "");
    }
}
