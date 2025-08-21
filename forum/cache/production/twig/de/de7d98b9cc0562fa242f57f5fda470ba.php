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
class __TwigTemplate_d73fc58d65ba38fdee63cde0e46056dd extends \Twig\Template
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
<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#3E4637\" width=\"100%\" align=\"center\">
<tr>
    <td>
        <table cellpadding=\"4\" cellspacing=\"1\" border=\"0\" width=\"100%\">
        <tr>
            <td bgcolor=\"#3E4637\" align=\"center\">
                <font face=\"verdana,arial,helvetica\" size=\"1\" color=\"#D8DED3\"><b>";
        // line 10
        echo ($context["MESSAGE_TITLE"] ?? null);
        echo "</b></font>
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#545F4E\" align=\"center\">
                <font face=\"verdana,arial,helvetica\" size=\"2\">
                ";
        // line 16
        echo ($context["MESSAGE_TEXT"] ?? null);
        echo "
                </font>
                
                ";
        // line 19
        if (($context["S_USER_NOTICE"] ?? null)) {
            // line 20
            echo "                <br /><br />
                <font face=\"verdana,arial,helvetica\" size=\"1\">
                <a href=\"";
            // line 22
            echo ($context["U_LOGIN_LOGOUT"] ?? null);
            echo "\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("LOGIN_LOGOUT");
            echo "</a>
                </font>
                ";
        }
        // line 25
        echo "                
                ";
        // line 26
        if (($context["L_RETURN_TO"] ?? null)) {
            // line 27
            echo "                <br /><br />
                <font face=\"verdana,arial,helvetica\" size=\"1\">
                <a href=\"";
            // line 29
            echo ($context["U_RETURN_TO"] ?? null);
            echo "\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("RETURN_TO");
            echo "</a>
                </font>
                ";
        }
        // line 32
        echo "                
                ";
        // line 33
        if (($context["S_META"] ?? null)) {
            // line 34
            echo "                <br /><br />
                <font face=\"verdana,arial,helvetica\" size=\"1\">
                ";
            // line 36
            echo $this->extensions['phpbb\template\twig\extension']->lang("REDIRECT");
            echo "
                </font>
                ";
        }
        // line 39
        echo "            </td>
        </tr>
        </table>
    </td>
</tr>
</table>

";
        // line 46
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "message_body.html", 46)->display($context);
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
        return array (  129 => 46,  120 => 39,  114 => 36,  110 => 34,  108 => 33,  105 => 32,  97 => 29,  93 => 27,  91 => 26,  88 => 25,  80 => 22,  76 => 20,  74 => 19,  68 => 16,  59 => 10,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "message_body.html", "");
    }
}
