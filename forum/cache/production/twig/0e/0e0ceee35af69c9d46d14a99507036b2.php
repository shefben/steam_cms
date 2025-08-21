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
class __TwigTemplate_124f4c79f6c3c3827d811de1a6755f90 extends \Twig\Template
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
<div align=\"center\" class=\"board-listing\">
    
    <!-- Message Header -->
    <table border=\"0\" cellspacing=\"0\" width=\"600\" class=\"forum-header\">
    <tr>
        <td bgcolor=\"#001052\" width=\"100%\" class=\"forum-header-cell\">
            <p align=\"center\"><font color=\"#E2E3E6\" face=\"Arial\" size=\"2\"><b>";
        // line 10
        echo ($context["MESSAGE_TITLE"] ?? null);
        echo "</b></font></p>
        </td>
    </tr>
    </table>

    <!-- Message Content -->
    <div align=\"center\">
    <table border=\"0\" cellspacing=\"0\" width=\"600\" class=\"forum-row\">
    <tr>
        <td bgcolor=\"#606275\" width=\"100%\" class=\"forum-cell\">
            <p align=\"center\">
                <font face=\"Arial\" size=\"2\">
                ";
        // line 22
        echo ($context["MESSAGE_TEXT"] ?? null);
        echo "
                </font>
                
                ";
        // line 25
        if (($context["S_USER_NOTICE"] ?? null)) {
            // line 26
            echo "                <br /><br />
                <font face=\"Arial\" size=\"1\">
                <a href=\"";
            // line 28
            echo ($context["U_LOGIN_LOGOUT"] ?? null);
            echo "\" class=\"nav-link\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("LOGIN_LOGOUT");
            echo "</a>
                </font>
                ";
        }
        // line 31
        echo "                
                ";
        // line 32
        if (($context["L_RETURN_TO"] ?? null)) {
            // line 33
            echo "                <br /><br />
                <font face=\"Arial\" size=\"1\">
                <a href=\"";
            // line 35
            echo ($context["U_RETURN_TO"] ?? null);
            echo "\" class=\"nav-link\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("RETURN_TO");
            echo "</a>
                </font>
                ";
        }
        // line 38
        echo "                
                ";
        // line 39
        if (($context["S_META"] ?? null)) {
            // line 40
            echo "                <br /><br />
                <font face=\"Arial\" size=\"1\">
                ";
            // line 42
            echo $this->extensions['phpbb\template\twig\extension']->lang("REDIRECT");
            echo "
                </font>
                ";
        }
        // line 45
        echo "            </p>
        </td>
    </tr>
    </table>
    </div>

</div>

";
        // line 53
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "message_body.html", 53)->display($context);
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
        return array (  136 => 53,  126 => 45,  120 => 42,  116 => 40,  114 => 39,  111 => 38,  103 => 35,  99 => 33,  97 => 32,  94 => 31,  86 => 28,  82 => 26,  80 => 25,  74 => 22,  59 => 10,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "message_body.html", "");
    }
}
