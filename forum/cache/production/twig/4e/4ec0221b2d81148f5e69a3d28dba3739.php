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

/* acp_styles.html */
class __TwigTemplate_c710b2a1c21a0ec7ed51ba1baa92e589 extends \Twig\Template
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
        $this->loadTemplate("overall_header.html", "acp_styles.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["S_STYLE_DETAILS"] ?? null)) {
            // line 6
            echo "\t<a href=\"";
            echo ($context["U_ACTION"] ?? null);
            echo "\" style=\"float: ";
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">&laquo; ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("BACK");
            echo "</a>
";
        }
        // line 8
        echo "
";
        // line 9
        if (($context["S_CONFIRM_ACTION"] ?? null)) {
            // line 10
            echo "<form id=\"confirm\" method=\"post\" action=\"";
            echo ($context["S_CONFIRM_ACTION"] ?? null);
            echo "\">

<fieldset>
\t<h1>";
            // line 13
            echo ($context["MESSAGE_TITLE"] ?? null);
            echo "</h1>
\t<p>";
            // line 14
            echo ($context["MESSAGE_TEXT"] ?? null);
            echo "</p>
\t";
            // line 15
            if (($context["S_CONFIRM_DELETE"] ?? null)) {
                // line 16
                echo "\t<label><input type=\"checkbox\" class=\"checkbox\" name=\"confirm_delete_files\" /> ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_FROM_FS");
                echo "</label>
\t";
            }
            // line 18
            echo "
\t";
            // line 19
            echo ($context["S_HIDDEN_FIELDS"] ?? null);
            echo "

\t<div style=\"text-align: center;\">
\t\t<input type=\"submit\" name=\"confirm\" value=\"";
            // line 22
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "\" class=\"button2\" />&nbsp;
\t\t<input type=\"submit\" name=\"cancel\" value=\"";
            // line 23
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "\" class=\"button2\" />
\t</div>

</fieldset>

</form>
";
        } else {
            // line 30
            echo "
";
            // line 31
            if (($context["L_TITLE"] ?? null)) {
                echo "<h1>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
                echo "</h1>";
            }
            // line 32
            echo "
";
            // line 33
            if (($context["L_EXPLAIN"] ?? null)) {
                echo "<p>";
                echo $this->extensions['phpbb\template\twig\extension']->lang("EXPLAIN");
                echo "</p>";
            }
            // line 34
            echo "
<fieldset class=\"quick\">
\t<span class=\"small\"><a href=\"https://www.phpbb.com/go/customise/styles/3.3\" target=\"_blank\">";
            // line 36
            echo $this->extensions['phpbb\template\twig\extension']->lang("BROWSE_STYLES_DATABASE");
            echo "</a></span>
</fieldset>

<form id=\"acp_styles\" method=\"post\" action=\"";
            // line 39
            echo ($context["U_ACTION"] ?? null);
            echo "\">
";
            // line 40
            echo ($context["S_HIDDEN_FIELDS"] ?? null);
            echo "
";
            // line 41
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "

";
            // line 43
            if (($context["S_STYLE_DETAILS"] ?? null)) {
                // line 44
                echo "\t<input type=\"hidden\" name=\"id\" value=\"";
                echo ($context["STYLE_ID"] ?? null);
                echo "\" />
\t<fieldset>
\t<dl>
\t\t<dt><label for=\"name\">";
                // line 47
                echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_NAME");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t<dd><input type=\"text\" id=\"name\" name=\"style_name\" value=\"";
                // line 48
                echo ($context["STYLE_NAME"] ?? null);
                echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label>";
                // line 51
                echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_PATH");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t<dd><strong>";
                // line 52
                echo ($context["STYLE_PATH"] ?? null);
                echo "</strong></dd>
\t</dl>
\t<dl>
\t\t<dt><label>";
                // line 55
                echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_VERSION");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t<dd><strong>";
                // line 56
                echo ($context["STYLE_VERSION"] ?? null);
                echo "</strong></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"name\">";
                // line 59
                echo $this->extensions['phpbb\template\twig\extension']->lang("COPYRIGHT");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t<dd><strong>";
                // line 60
                echo ($context["STYLE_COPYRIGHT"] ?? null);
                echo "</strong></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"style_parent\">";
                // line 63
                echo $this->extensions['phpbb\template\twig\extension']->lang("INHERITING_FROM");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t<dd><select id=\"style_parent\" name=\"style_parent\">
\t\t\t<option value=\"\"";
                // line 65
                if ((($context["STYLE_PARENT"] ?? null) == 0)) {
                    echo " selected=\"selected\"";
                }
                echo "> - </option>
\t\t\t";
                // line 66
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "parent_styles", [], "any", false, false, false, 66));
                foreach ($context['_seq'] as $context["_key"] => $context["parent_styles"]) {
                    // line 67
                    echo "\t\t\t\t<option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["parent_styles"], "STYLE_ID", [], "any", false, false, false, 67);
                    echo "\"";
                    if ((twig_get_attribute($this->env, $this->source, $context["parent_styles"], "STYLE_ID", [], "any", false, false, false, 67) == ($context["STYLE_PARENT"] ?? null))) {
                        echo " selected=\"selected\"";
                    }
                    echo ">";
                    echo twig_get_attribute($this->env, $this->source, $context["parent_styles"], "SPACER", [], "any", false, false, false, 67);
                    echo twig_get_attribute($this->env, $this->source, $context["parent_styles"], "STYLE_NAME", [], "any", false, false, false, 67);
                    echo "</option>
\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parent_styles'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 69
                echo "\t\t</select></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"style_active\">";
                // line 72
                echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_ACTIVE");
                echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                echo "</label></dt>
\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"style_active\" value=\"1\"";
                // line 73
                if (($context["S_STYLE_ACTIVE"] ?? null)) {
                    echo " id=\"style_active\" checked=\"checked\"";
                }
                echo " /> ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
                echo "</label>
\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"style_active\" value=\"0\"";
                // line 74
                if ( !($context["S_STYLE_ACTIVE"] ?? null)) {
                    echo " id=\"style_active\" checked=\"checked\"";
                }
                echo " /> ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
                echo "</label></dd>
\t</dl>
\t";
                // line 76
                if ( !($context["S_STYLE_DEFAULT"] ?? null)) {
                    // line 77
                    echo "\t\t<dl>
\t\t\t<dt><label for=\"style_default\">";
                    // line 78
                    echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_DEFAULT");
                    echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                    echo "</label></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"style_default\" value=\"1\" /> ";
                    // line 79
                    echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
                    echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" id=\"style_default\" name=\"style_default\" value=\"0\" checked=\"checked\" /> ";
                    // line 80
                    echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
                    echo "</label></dd>
\t\t</dl>
\t";
                }
                // line 83
                echo "\t</fieldset>

\t<fieldset class=\"submit-buttons\">
\t\t<legend>";
                // line 86
                echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                echo "</legend>
\t\t<input class=\"button1\" type=\"submit\" name=\"update\" value=\"";
                // line 87
                echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
                echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
                // line 88
                echo $this->extensions['phpbb\template\twig\extension']->lang("RESET");
                echo "\" />
\t\t";
                // line 89
                echo ($context["S_FORM_TOKEN"] ?? null);
                echo "
\t</fieldset>
";
            }
            // line 92
            echo "
";
            // line 93
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "styles_list", [], "any", false, false, false, 93))) {
                // line 94
                echo "\t";
                // line 95
                echo "\t<table class=\"table1 styles\">
\t<thead>
\t<tr>
\t\t<th>";
                // line 98
                echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_NAME");
                echo "</th>
\t\t<th style=\"width: 10%; white-space: nowrap; text-align: center;\">";
                // line 99
                echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_VERSION");
                echo "</th>
\t\t<th style=\"width: 10%; white-space: nowrap; text-align: center;\">";
                // line 100
                echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_PHPBB_VERSION");
                echo "</th>
\t\t";
                // line 101
                if ( !($context["STYLES_LIST_HIDE_COUNT"] ?? null)) {
                    echo "<th style=\"width: 10%; white-space: nowrap; text-align: center;\">";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_USED_BY");
                    echo "</th>";
                }
                // line 102
                echo "\t\t<th style=\"width: 25%; white-space: nowrap; text-align: center;\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("ACTIONS");
                echo "</th>
\t\t";
                // line 103
                echo ($context["STYLES_LIST_EXTRA"] ?? null);
                echo "
\t\t<th>&nbsp;</th>
\t</tr>
\t</thead>
\t";
                // line 107
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "styles_list", [], "any", false, false, false, 107));
                foreach ($context['_seq'] as $context["_key"] => $context["styles_list"]) {
                    // line 108
                    echo "\t<tbody id=\"styles-list-";
                    echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "S_ROW_COUNT", [], "any", false, false, false, 108);
                    echo "\">
\t<tr class=\"row-highlight";
                    // line 109
                    if ((twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_ID", [], "any", false, false, false, 109) &&  !twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_ACTIVE", [], "any", false, false, false, 109))) {
                        echo " row-inactive";
                    }
                    echo "\">
\t\t";
                    // line 110
                    if ((twig_get_attribute($this->env, $this->source, $context["styles_list"], "LEVEL", [], "any", false, false, false, 110) % 2 != 0)) {
                        // line 111
                        echo "\t\t\t";
                        if ((twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "ROW_CLASS", [], "any", false, false, false, 111) == "row1a")) {
                            $value = "row1b";
                            $context['definition']->set('ROW_CLASS', $value);
                        } else {
                            $value = "row1a";
                            $context['definition']->set('ROW_CLASS', $value);
                        }
                        // line 112
                        echo "\t\t";
                    } else {
                        // line 113
                        echo "\t\t\t";
                        if ((twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "ROW_CLASS", [], "any", false, false, false, 113) == "row2a")) {
                            $value = "row2b";
                            $context['definition']->set('ROW_CLASS', $value);
                        } else {
                            $value = "row2a";
                            $context['definition']->set('ROW_CLASS', $value);
                        }
                        // line 114
                        echo "\t\t";
                    }
                    // line 115
                    echo "\t\t<td class=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "ROW_CLASS", [], "any", false, false, false, 115);
                    echo "\" style=\"padding-";
                    echo ($context["S_CONTENT_FLOW_BEGIN"] ?? null);
                    echo ": ";
                    echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "PADDING", [], "any", false, false, false, 115);
                    echo "px;\">
\t\t\t";
                    // line 116
                    if (((twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_ID", [], "any", false, false, false, 116) && (twig_get_attribute($this->env, $this->source, $context["styles_list"], "COMMENT", [], "any", false, false, false, 116) == "")) && twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_ACTIVE", [], "any", false, false, false, 116))) {
                        // line 117
                        echo "\t\t\t\t<div class=\"default-style\" style=\"display: none; float: ";
                        echo ($context["S_CONTENT_FLOW_END"] ?? null);
                        echo ";\">
\t\t\t\t\t<input class=\"radio\" type=\"radio\" name=\"default\" value=\"";
                        // line 118
                        echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_ID", [], "any", false, false, false, 118);
                        echo "\"";
                        if (twig_get_attribute($this->env, $this->source, $context["styles_list"], "DEFAULT", [], "any", false, false, false, 118)) {
                            echo " checked=\"checked\"";
                        } else {
                            $value = 1;
                            $context['definition']->set('S_DEFAULT', $value);
                        }
                        echo " title=\"";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_DEFAULT");
                        echo "\" />
\t\t\t\t</div>
\t\t\t";
                    }
                    // line 121
                    echo "\t\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["styles_list"], "DEFAULT", [], "any", false, false, false, 121) || twig_get_attribute($this->env, $this->source, $context["styles_list"], "SHOW_COPYRIGHT", [], "any", false, false, false, 121))) {
                        // line 122
                        echo "\t\t\t\t<strong>";
                        echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_NAME", [], "any", false, false, false, 122);
                        echo "</strong>
\t\t\t\t";
                        // line 123
                        if ((twig_get_attribute($this->env, $this->source, $context["styles_list"], "SHOW_COPYRIGHT", [], "any", false, false, false, 123) && (twig_get_attribute($this->env, $this->source, $context["styles_list"], "COMMENT", [], "any", false, false, false, 123) == ""))) {
                            echo "<span><br />";
                            echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_COPYRIGHT", [], "any", false, false, false, 123);
                            echo "</span>";
                        }
                        // line 124
                        echo "\t\t\t";
                    } else {
                        // line 125
                        echo "\t\t\t\t<span>";
                        echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_NAME", [], "any", false, false, false, 125);
                        echo "</span>
\t\t\t";
                    }
                    // line 127
                    echo "\t\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["styles_list"], "COMMENT", [], "any", false, false, false, 127) != "")) {
                        // line 128
                        echo "\t\t\t\t<span class=\"error\"><br />";
                        echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "COMMENT", [], "any", false, false, false, 128);
                        echo "</span>
\t\t\t";
                    }
                    // line 130
                    echo "\t\t\t";
                    if (( !twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_ID", [], "any", false, false, false, 130) && (twig_get_attribute($this->env, $this->source, $context["styles_list"], "COMMENT", [], "any", false, false, false, 130) == ""))) {
                        // line 131
                        echo "\t\t\t\t<span class=\"style-path\"><br />";
                        echo $this->extensions['phpbb\template\twig\extension']->lang("STYLE_PATH");
                        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                        echo " ";
                        echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_PATH_FULL", [], "any", false, false, false, 131);
                        echo "</span>
\t\t\t";
                    }
                    // line 133
                    echo "\t\t</td>
\t\t<td class=\"";
                    // line 134
                    echo twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "ROW_CLASS", [], "any", false, false, false, 134);
                    echo " users\">";
                    echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_VERSION", [], "any", false, false, false, 134);
                    echo "</td>
\t\t<td class=\"";
                    // line 135
                    echo twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "ROW_CLASS", [], "any", false, false, false, 135);
                    echo " users\">";
                    echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_PHPBB_VERSION", [], "any", false, false, false, 135);
                    echo "</td>
\t\t";
                    // line 136
                    if ( !($context["STYLES_LIST_HIDE_COUNT"] ?? null)) {
                        // line 137
                        echo "\t\t\t<td class=\"";
                        echo twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "ROW_CLASS", [], "any", false, false, false, 137);
                        echo " users\">";
                        echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "USERS", [], "any", false, false, false, 137);
                        echo "</td>
\t\t";
                    }
                    // line 139
                    echo "\t\t<td class=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "ROW_CLASS", [], "any", false, false, false, 139);
                    echo " actions\">
\t\t\t";
                    // line 140
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["styles_list"], "actions", [], "any", false, false, false, 140));
                    foreach ($context['_seq'] as $context["_key"] => $context["actions"]) {
                        // line 141
                        echo "\t\t\t\t";
                        if ((twig_get_attribute($this->env, $this->source, $context["actions"], "S_ROW_COUNT", [], "any", false, false, false, 141) > 0)) {
                            echo " | ";
                        }
                        // line 142
                        echo "\t\t\t\t";
                        if (twig_get_attribute($this->env, $this->source, $context["actions"], "U_ACTION", [], "any", false, false, false, 142)) {
                            // line 143
                            echo "\t\t\t\t\t<a href=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["actions"], "U_ACTION", [], "any", false, false, false, 143);
                            echo "\"";
                            echo twig_get_attribute($this->env, $this->source, $context["actions"], "U_ACTION_ATTR", [], "any", false, false, false, 143);
                            echo ">";
                            echo twig_get_attribute($this->env, $this->source, $context["actions"], "L_ACTION", [], "any", false, false, false, 143);
                            echo "</a>
\t\t\t\t";
                        }
                        // line 145
                        echo "\t\t\t\t";
                        echo twig_get_attribute($this->env, $this->source, $context["actions"], "HTML", [], "any", false, false, false, 145);
                        echo "
\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actions'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 147
                    echo "\t\t</td>
\t\t";
                    // line 148
                    echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "EXTRA", [], "any", false, false, false, 148);
                    echo "
\t\t<td class=\"";
                    // line 149
                    echo twig_get_attribute($this->env, $this->source, ($context["definition"] ?? null), "ROW_CLASS", [], "any", false, false, false, 149);
                    echo " mark\" style=\"width: 20px;\">
\t\t\t";
                    // line 150
                    if (twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_ID", [], "any", false, false, false, 150)) {
                        // line 151
                        echo "\t\t\t\t";
                        if ((twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_NAME", [], "any", false, false, false, 151) !== "prosilver")) {
                            // line 152
                            echo "\t\t\t\t\t<input class=\"checkbox\" type=\"checkbox\" name=\"ids[]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_ID", [], "any", false, false, false, 152);
                            echo "\" />
\t\t\t\t";
                        }
                        // line 154
                        echo "\t\t\t";
                    } else {
                        // line 155
                        echo "\t\t\t\t";
                        if ((twig_get_attribute($this->env, $this->source, $context["styles_list"], "COMMENT", [], "any", false, false, false, 155) != "")) {
                            // line 156
                            echo "\t\t\t\t\t&nbsp;
\t\t\t\t";
                        } else {
                            // line 158
                            echo "\t\t\t\t\t<input class=\"checkbox\" type=\"checkbox\" name=\"dirs[]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["styles_list"], "STYLE_PATH", [], "any", false, false, false, 158);
                            echo "\" />
\t\t\t\t";
                        }
                        // line 160
                        echo "\t\t\t";
                    }
                    // line 161
                    echo "\t\t</td>
\t</tr>
\t</tbody>
\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['styles_list'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 165
                echo "\t</table>
";
            }
            // line 167
            echo "
";
            // line 168
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "extra_actions", [], "any", false, false, false, 168))) {
                // line 169
                echo "\t<fieldset class=\"quick\">
\t\t";
                // line 170
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "extra_actions", [], "any", false, false, false, 170));
                foreach ($context['_seq'] as $context["_key"] => $context["extra_actions"]) {
                    // line 171
                    echo "\t\t\t<input type=\"submit\" name=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["extra_actions"], "ACTION_NAME", [], "any", false, false, false, 171);
                    echo "\" class=\"button2\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["extra_actions"], "L_ACTION", [], "any", false, false, false, 171);
                    echo "\" />
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extra_actions'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 173
                echo "\t</fieldset>
";
            }
            // line 175
            echo "
</form>

";
        }
        // line 179
        echo "
";
        // line 180
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_styles.html", 180)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_styles.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  622 => 180,  619 => 179,  613 => 175,  609 => 173,  598 => 171,  594 => 170,  591 => 169,  589 => 168,  586 => 167,  582 => 165,  573 => 161,  570 => 160,  564 => 158,  560 => 156,  557 => 155,  554 => 154,  548 => 152,  545 => 151,  543 => 150,  539 => 149,  535 => 148,  532 => 147,  523 => 145,  513 => 143,  510 => 142,  505 => 141,  501 => 140,  496 => 139,  488 => 137,  486 => 136,  480 => 135,  474 => 134,  471 => 133,  462 => 131,  459 => 130,  453 => 128,  450 => 127,  444 => 125,  441 => 124,  435 => 123,  430 => 122,  427 => 121,  412 => 118,  407 => 117,  405 => 116,  396 => 115,  393 => 114,  384 => 113,  381 => 112,  372 => 111,  370 => 110,  364 => 109,  359 => 108,  355 => 107,  348 => 103,  343 => 102,  337 => 101,  333 => 100,  329 => 99,  325 => 98,  320 => 95,  318 => 94,  316 => 93,  313 => 92,  307 => 89,  303 => 88,  299 => 87,  295 => 86,  290 => 83,  284 => 80,  280 => 79,  275 => 78,  272 => 77,  270 => 76,  261 => 74,  253 => 73,  248 => 72,  243 => 69,  227 => 67,  223 => 66,  217 => 65,  211 => 63,  205 => 60,  200 => 59,  194 => 56,  189 => 55,  183 => 52,  178 => 51,  172 => 48,  167 => 47,  160 => 44,  158 => 43,  153 => 41,  149 => 40,  145 => 39,  139 => 36,  135 => 34,  129 => 33,  126 => 32,  120 => 31,  117 => 30,  107 => 23,  103 => 22,  97 => 19,  94 => 18,  88 => 16,  86 => 15,  82 => 14,  78 => 13,  71 => 10,  69 => 9,  66 => 8,  56 => 6,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "acp_styles.html", "");
    }
}
