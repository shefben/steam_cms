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

/* acp_ext_list.html */
class __TwigTemplate_0886f06d6343ded7b45903237ef1d3e5 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_ext_list.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

\t<h1>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSIONS_ADMIN");
        echo "</h1>

\t<p>";
        // line 7
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSIONS_EXPLAIN");
        echo "</p>

\t<fieldset class=\"quick\">
\t\t<span class=\"small\"><a href=\"https://www.phpbb.com/go/customise/extensions/3.3\" target=\"_blank\">";
        // line 10
        echo $this->extensions['phpbb\template\twig\extension']->lang("BROWSE_EXTENSIONS_DATABASE");
        echo "</a> &bull; <a href=\"";
        echo ($context["U_VERSIONCHECK_FORCE"] ?? null);
        echo "\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("VERSIONCHECK_FORCE_UPDATE_ALL");
        echo "</a> &bull; <a href=\"javascript:phpbb.toggleDisplay('version_check_settings');\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("SETTINGS");
        echo "</a></span>
\t</fieldset>

\t<form id=\"version_check_settings\" method=\"post\" action=\"";
        // line 13
        echo ($context["U_ACTION"] ?? null);
        echo "\" style=\"display:none\">

\t<fieldset>
\t\t<legend>";
        // line 16
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSIONS_VERSION_CHECK_SETTINGS");
        echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"force_unstable\">";
        // line 18
        echo $this->extensions['phpbb\template\twig\extension']->lang("FORCE_UNSTABLE");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t\t<dd>
\t\t\t\t<label><input type=\"radio\" id=\"force_unstable\" name=\"force_unstable\" class=\"radio\" value=\"1\"";
        // line 20
        if (($context["FORCE_UNSTABLE"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
        echo "</label>
\t\t\t\t<label><input type=\"radio\" name=\"force_unstable\" class=\"radio\" value=\"0\"";
        // line 21
        if ( !($context["FORCE_UNSTABLE"] ?? null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
        echo "</label>
\t\t\t</dd>
\t\t</dl>

\t\t<p class=\"submit-buttons\">
\t\t\t<input class=\"button1\" type=\"submit\" name=\"update\" value=\"";
        // line 26
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" />&nbsp;
\t\t\t<input class=\"button2\" type=\"reset\" name=\"reset\" value=\"";
        // line 27
        echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
        echo "\" />
\t\t\t<input type=\"hidden\" name=\"action\" value=\"set_config_version_check_force_unstable\" />
\t\t\t";
        // line 29
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
\t\t</p>
\t</fieldset>
\t</form>

\t<table class=\"table1\">
\t\t<col class=\"row1\" ><col class=\"row1\" ><col class=\"row2\" ><col class=\"row2\" >
\t<thead>
\t\t<tr>
\t\t\t<th>";
        // line 38
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_NAME");
        echo "</th>
\t\t\t<th style=\"text-align: center; width: 20%;\">";
        // line 39
        echo $this->extensions['phpbb\template\twig\extension']->lang("CURRENT_VERSION");
        echo "</th>
\t\t\t<th style=\"text-align: center; width: 10%;\">";
        // line 40
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_OPTIONS");
        echo "</th>
\t\t\t<th style=\"text-align: center; width: 25%;\">";
        // line 41
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_ACTIONS");
        echo "</th>
\t\t</tr>
\t</thead>
\t<tbody>
\t\t";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable([0 => "enabled", 1 => "disabled", 2 => "not_installed"]);
        foreach ($context['_seq'] as $context["_key"] => $context["list"]) {
            // line 46
            echo "\t\t\t";
            $context["blockname"] = twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), $context["list"], [], "any", false, false, false, 46);
            // line 47
            echo "\t\t\t";
            if (twig_length_filter($this->env, ($context["blockname"] ?? null))) {
                // line 48
                echo "\t\t\t<tr>
\t\t\t\t<td class=\"row3\" colspan=\"4\"><strong>";
                // line 49
                echo $this->extensions['phpbb\template\twig\extension']->lang(("EXTENSIONS_" . twig_upper_filter($this->env, $context["list"])));
                echo "</strong>
\t\t\t\t\t";
                // line 50
                if (($context["list"] == "enabled")) {
                    // line 51
                    echo "\t\t\t\t\t\t";
                    // line 52
                    echo "\t\t\t\t\t";
                } elseif (($context["list"] == "disabled")) {
                    // line 53
                    echo "\t\t\t\t\t\t";
                    // line 54
                    echo "\t\t\t\t\t";
                } elseif (($context["list"] == "not_installed")) {
                    // line 55
                    echo "\t\t\t\t\t\t";
                    // line 56
                    echo "\t\t\t\t\t";
                }
                // line 57
                echo "\t\t\t\t</td>
\t\t\t</tr>
\t\t\t";
                // line 59
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["blockname"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["data"]) {
                    // line 60
                    echo "\t\t\t<tr class=\"ext_";
                    echo $context["list"];
                    echo " row-highlight\">
\t\t\t\t<td><strong title=\"";
                    // line 61
                    echo twig_get_attribute($this->env, $this->source, $context["data"], "NAME", [], "any", false, false, false, 61);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["data"], "META_DISPLAY_NAME", [], "any", false, false, false, 61);
                    echo "</strong>
\t\t\t\t\t";
                    // line 62
                    if (($context["list"] == "enabled")) {
                        // line 63
                        echo "\t\t\t\t\t\t";
                        // line 64
                        echo "\t\t\t\t\t";
                    } elseif (($context["list"] == "disabled")) {
                        // line 65
                        echo "\t\t\t\t\t\t";
                        // line 66
                        echo "\t\t\t\t\t";
                    } elseif (($context["list"] == "not_installed")) {
                        // line 67
                        echo "\t\t\t\t\t\t";
                        // line 68
                        echo "\t\t\t\t\t";
                    }
                    // line 69
                    echo "\t\t\t\t</td>
\t\t\t\t<td style=\"text-align: center;\">
\t\t\t\t\t";
                    // line 71
                    if (twig_get_attribute($this->env, $this->source, $context["data"], "S_VERSIONCHECK", [], "any", false, false, false, 71)) {
                        // line 72
                        echo "\t\t\t\t\t<strong class=\"";
                        if (twig_get_attribute($this->env, $this->source, $context["data"], "S_UP_TO_DATE", [], "any", false, false, false, 72)) {
                            echo "current-ext";
                        } else {
                            echo "outdated-ext";
                        }
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["data"], "META_VERSION", [], "any", false, false, false, 72);
                        echo "</strong>
\t\t\t\t\t";
                        // line 73
                        if ( !twig_get_attribute($this->env, $this->source, $context["data"], "S_UP_TO_DATE", [], "any", false, false, false, 73)) {
                            echo "<i class=\"fa fa-exclamation-circle outdated-ext\" aria-hidden=\"true\"></i>";
                        }
                        // line 74
                        echo "\t\t\t\t\t";
                    } else {
                        // line 75
                        echo "\t\t\t\t\t";
                        echo twig_get_attribute($this->env, $this->source, $context["data"], "META_VERSION", [], "any", false, false, false, 75);
                        echo "
\t\t\t\t\t";
                    }
                    // line 77
                    echo "\t\t\t\t</td>
\t\t\t\t<td style=\"text-align: center;\">
\t\t\t\t\t";
                    // line 79
                    if (twig_get_attribute($this->env, $this->source, $context["data"], "U_DETAILS", [], "any", false, false, false, 79)) {
                        echo "<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["data"], "U_DETAILS", [], "any", false, false, false, 79);
                        echo "\">";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("DETAILS");
                        echo "</a>";
                    }
                    // line 80
                    echo "\t\t\t\t</td>
\t\t\t\t<td style=\"text-align: center;\">
\t\t\t\t\t";
                    // line 82
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["data"], "actions", [], "any", false, false, false, 82));
                    foreach ($context['_seq'] as $context["_key"] => $context["actions"]) {
                        // line 83
                        echo "\t\t\t\t\t\t<a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["actions"], "U_ACTION", [], "any", false, false, false, 83);
                        echo "\"";
                        if (twig_get_attribute($this->env, $this->source, $context["actions"], "L_ACTION_EXPLAIN", [], "any", false, false, false, 83)) {
                            echo " title=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["actions"], "L_ACTION_EXPLAIN", [], "any", false, false, false, 83);
                            echo "\"";
                        }
                        echo ">";
                        echo twig_get_attribute($this->env, $this->source, $context["actions"], "L_ACTION", [], "any", false, false, false, 83);
                        echo "</a>
\t\t\t\t\t\t";
                        // line 84
                        if ( !twig_get_attribute($this->env, $this->source, $context["actions"], "S_LAST_ROW", [], "any", false, false, false, 84)) {
                            echo "&nbsp;|&nbsp;";
                        }
                        // line 85
                        echo "\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actions'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 86
                    echo "\t\t\t\t</td>
\t\t\t</tr>
\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['data'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 89
                echo "\t\t\t";
            }
            // line 90
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['list'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 91
        echo "\t</tbody>
\t</table>

\t<table class=\"table1\">
\t<tr>
\t\t<th>";
        // line 96
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_INSTALL_HEADLINE");
        echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\">";
        // line 99
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_INSTALL_EXPLAIN");
        echo "</td>
\t</tr>
\t<tr>
\t\t<th>";
        // line 102
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_UPDATE_HEADLINE");
        echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\">";
        // line 105
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_UPDATE_EXPLAIN");
        echo "</td>
\t</tr>
\t<tr>
\t\t<th>";
        // line 108
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_REMOVE_HEADLINE");
        echo "</th>
\t</tr>
\t<tr>
\t\t<td class=\"row3\">";
        // line 111
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXTENSION_REMOVE_EXPLAIN");
        echo "</td>
\t</tr>
\t</tbody>
\t</table>

";
        // line 116
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_ext_list.html", 116)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_ext_list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  359 => 116,  351 => 111,  345 => 108,  339 => 105,  333 => 102,  327 => 99,  321 => 96,  314 => 91,  308 => 90,  305 => 89,  297 => 86,  291 => 85,  287 => 84,  274 => 83,  270 => 82,  266 => 80,  258 => 79,  254 => 77,  248 => 75,  245 => 74,  241 => 73,  230 => 72,  228 => 71,  224 => 69,  221 => 68,  219 => 67,  216 => 66,  214 => 65,  211 => 64,  209 => 63,  207 => 62,  201 => 61,  196 => 60,  192 => 59,  188 => 57,  185 => 56,  183 => 55,  180 => 54,  178 => 53,  175 => 52,  173 => 51,  171 => 50,  167 => 49,  164 => 48,  161 => 47,  158 => 46,  154 => 45,  147 => 41,  143 => 40,  139 => 39,  135 => 38,  123 => 29,  118 => 27,  114 => 26,  102 => 21,  94 => 20,  88 => 18,  83 => 16,  77 => 13,  65 => 10,  59 => 7,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_ext_list.html", "");
    }
}
