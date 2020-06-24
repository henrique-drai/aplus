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

/* table/relation/foreign_key_row.twig */
class __TwigTemplate_9c1dd32c12d86511ca66fbcb3c76645a7909b2f1743ea115dd5f6d85f15880ea extends \Twig\Template
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
        echo "<tr>
    ";
        // line 3
        echo "    <td>
        ";
        // line 4
        $context["js_msg"] = "";
        // line 5
        echo "        ";
        $context["this_params"] = null;
        // line 6
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["one_key"] ?? null), "constraint", [], "array", true, true, false, 6)) {
            // line 7
            echo "            ";
            $context["drop_fk_query"] = (((((("ALTER TABLE " . PhpMyAdmin\Util::backquote(($context["db"] ?? null))) . ".") . PhpMyAdmin\Util::backquote(($context["table"] ?? null))) . " DROP FOREIGN KEY ") . PhpMyAdmin\Util::backquote((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 =             // line 9
($context["one_key"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["constraint"] ?? null) : null))) . ";");
            // line 11
            echo "            ";
            $context["this_params"] = ($context["url_params"] ?? null);
            // line 12
            echo "            ";
            $context["this_params"] = ["goto" => "tbl_relation.php", "back" => "tbl_relation.php", "sql_query" =>             // line 15
($context["drop_fk_query"] ?? null), "message_to_show" => sprintf(_gettext("Foreign key constraint %s has been dropped"), (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 =             // line 17
($context["one_key"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["constraint"] ?? null) : null))];
            // line 20
            echo "            ";
            $context["js_msg"] = (((((("ALTER TABLE " . ($context["db"] ?? null)) . ".") . ($context["table"] ?? null)) . " DROP FOREIGN KEY ") . (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = ($context["one_key"] ?? null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["constraint"] ?? null) : null)) . PhpMyAdmin\Sanitize::jsFormat(";"));
            // line 21
            echo "        ";
        }
        // line 22
        echo "        ";
        if (twig_get_attribute($this->env, $this->source, ($context["one_key"] ?? null), "constraint", [], "array", true, true, false, 22)) {
            // line 23
            echo "            <input type=\"hidden\" class=\"drop_foreign_key_msg\" value=\"";
            // line 24
            echo twig_escape_filter($this->env, ($context["js_msg"] ?? null), "html", null, true);
            echo "\">
            ";
            // line 25
            $context["drop_url"] = ("sql.php" . PhpMyAdmin\Url::getCommon(($context["this_params"] ?? null)));
            // line 26
            echo "            ";
            $context["drop_str"] = PhpMyAdmin\Util::getIcon("b_drop", _gettext("Drop"));
            // line 27
            echo "            ";
            echo PhpMyAdmin\Util::linkOrButton(($context["drop_url"] ?? null), ($context["drop_str"] ?? null), ["class" => "drop_foreign_key_anchor ajax"]);
            echo "
        ";
        }
        // line 29
        echo "    </td>
    <td>
        <span class=\"formelement clearfloat\">
            <input type=\"text\" name=\"constraint_name[";
        // line 32
        echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
        echo "]\" value=\"";
        // line 33
        ((twig_get_attribute($this->env, $this->source, ($context["one_key"] ?? null), "constraint", [], "array", true, true, false, 33)) ? (print (twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["one_key"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["constraint"] ?? null) : null), "html", null, true))) : (print ("")));
        // line 34
        echo "\" placeholder=\"";
        echo _gettext("Constraint name");
        echo "\" maxlength=\"64\">
        </span>
        <div class=\"floatleft\">
            ";
        // line 40
        echo "            ";
        $context["on_delete"] = ((twig_get_attribute($this->env, $this->source, ($context["one_key"] ?? null), "on_delete", [], "array", true, true, false, 40)) ? ((($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 =         // line 41
($context["one_key"] ?? null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["on_delete"] ?? null) : null)) : ("RESTRICT"));
        // line 42
        echo "            ";
        $context["on_update"] = ((twig_get_attribute($this->env, $this->source, ($context["one_key"] ?? null), "on_update", [], "array", true, true, false, 42)) ? ((($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 =         // line 43
($context["one_key"] ?? null)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["on_update"] ?? null) : null)) : ("RESTRICT"));
        // line 44
        echo "            <span class=\"formelement\">
                ";
        // line 45
        $this->loadTemplate("table/relation/dropdown_generate.twig", "table/relation/foreign_key_row.twig", 45)->display(twig_to_array(["dropdown_question" => "ON DELETE", "select_name" => (("on_delete[" .         // line 47
($context["i"] ?? null)) . "]"), "choices" =>         // line 48
($context["options_array"] ?? null), "selected_value" =>         // line 49
($context["on_delete"] ?? null)]));
        // line 51
        echo "            </span>
            <span class=\"formelement\">
                ";
        // line 53
        $this->loadTemplate("table/relation/dropdown_generate.twig", "table/relation/foreign_key_row.twig", 53)->display(twig_to_array(["dropdown_question" => "ON UPDATE", "select_name" => (("on_update[" .         // line 55
($context["i"] ?? null)) . "]"), "choices" =>         // line 56
($context["options_array"] ?? null), "selected_value" =>         // line 57
($context["on_update"] ?? null)]));
        // line 59
        echo "            </span>
        </div>
    </td>
    <td>
        ";
        // line 63
        if (twig_get_attribute($this->env, $this->source, ($context["one_key"] ?? null), "index_list", [], "array", true, true, false, 63)) {
            // line 64
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = ($context["one_key"] ?? null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["index_list"] ?? null) : null));
            foreach ($context['_seq'] as $context["key"] => $context["column"]) {
                // line 65
                echo "                <span class=\"formelement clearfloat\">
                    ";
                // line 66
                $this->loadTemplate("table/relation/dropdown_generate.twig", "table/relation/foreign_key_row.twig", 66)->display(twig_to_array(["dropdown_question" => "", "select_name" => (("foreign_key_fields_name[" .                 // line 68
($context["i"] ?? null)) . "][]"), "choices" =>                 // line 69
($context["column_array"] ?? null), "selected_value" =>                 // line 70
$context["column"]]));
                // line 72
                echo "                </span>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 74
            echo "        ";
        } else {
            // line 75
            echo "            <span class=\"formelement clearfloat\">
                ";
            // line 76
            $this->loadTemplate("table/relation/dropdown_generate.twig", "table/relation/foreign_key_row.twig", 76)->display(twig_to_array(["dropdown_question" => "", "select_name" => (("foreign_key_fields_name[" .             // line 78
($context["i"] ?? null)) . "][]"), "choices" =>             // line 79
($context["column_array"] ?? null), "selected_value" => ""]));
            // line 82
            echo "            </span>
        ";
        }
        // line 84
        echo "        <a class=\"formelement clearfloat add_foreign_key_field\" data-index=\"";
        // line 85
        echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
        echo "\" href=\"\">
            ";
        // line 86
        echo _gettext("+ Add column");
        // line 87
        echo "        </a>
    </td>
    ";
        // line 89
        $context["tables"] = [];
        // line 90
        echo "    ";
        if (($context["foreign_db"] ?? null)) {
            // line 91
            echo "        ";
            $context["tables"] = call_user_func_array($this->env->getFunction('get_tables')->getCallable(), [($context["foreign_db"] ?? null), ($context["tbl_storage_engine"] ?? null)]);
            // line 92
            echo "    ";
        }
        // line 93
        echo "    <td>
        <span class=\"formelement clearfloat\">
            ";
        // line 95
        $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/foreign_key_row.twig", 95)->display(twig_to_array(["name" => (("destination_foreign_db[" .         // line 96
($context["i"] ?? null)) . "]"), "title" => _gettext("Database"), "values" =>         // line 98
($context["databases"] ?? null), "foreign" =>         // line 99
($context["foreign_db"] ?? null)]));
        // line 101
        echo "        </span>
    </td>
    <td>
        <span class=\"formelement clearfloat\">
            ";
        // line 105
        $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/foreign_key_row.twig", 105)->display(twig_to_array(["name" => (("destination_foreign_table[" .         // line 106
($context["i"] ?? null)) . "]"), "title" => _gettext("Table"), "values" =>         // line 108
($context["tables"] ?? null), "foreign" =>         // line 109
($context["foreign_table"] ?? null)]));
        // line 111
        echo "        </span>
    </td>
    <td>
        ";
        // line 114
        if ((($context["foreign_db"] ?? null) && ($context["foreign_table"] ?? null))) {
            // line 115
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = ($context["one_key"] ?? null)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52["ref_index_list"] ?? null) : null));
            foreach ($context['_seq'] as $context["_key"] => $context["foreign_column"]) {
                // line 116
                echo "                <span class=\"formelement clearfloat\">
                    ";
                // line 117
                $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/foreign_key_row.twig", 117)->display(twig_to_array(["name" => (("destination_foreign_column[" .                 // line 118
($context["i"] ?? null)) . "][]"), "title" => _gettext("Column"), "values" =>                 // line 120
($context["unique_columns"] ?? null), "foreign" =>                 // line 121
$context["foreign_column"]]));
                // line 123
                echo "                </span>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['foreign_column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 125
            echo "        ";
        } else {
            // line 126
            echo "            <span class=\"formelement clearfloat\">
                ";
            // line 127
            $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/foreign_key_row.twig", 127)->display(twig_to_array(["name" => (("destination_foreign_column[" .             // line 128
($context["i"] ?? null)) . "][]"), "title" => _gettext("Column"), "values" => [], "foreign" => ""]));
            // line 133
            echo "            </span>
        ";
        }
        // line 135
        echo "    </td>
</tr>
";
    }

    public function getTemplateName()
    {
        return "table/relation/foreign_key_row.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  256 => 135,  252 => 133,  250 => 128,  249 => 127,  246 => 126,  243 => 125,  236 => 123,  234 => 121,  233 => 120,  232 => 118,  231 => 117,  228 => 116,  223 => 115,  221 => 114,  216 => 111,  214 => 109,  213 => 108,  212 => 106,  211 => 105,  205 => 101,  203 => 99,  202 => 98,  201 => 96,  200 => 95,  196 => 93,  193 => 92,  190 => 91,  187 => 90,  185 => 89,  181 => 87,  179 => 86,  175 => 85,  173 => 84,  169 => 82,  167 => 79,  166 => 78,  165 => 76,  162 => 75,  159 => 74,  152 => 72,  150 => 70,  149 => 69,  148 => 68,  147 => 66,  144 => 65,  139 => 64,  137 => 63,  131 => 59,  129 => 57,  128 => 56,  127 => 55,  126 => 53,  122 => 51,  120 => 49,  119 => 48,  118 => 47,  117 => 45,  114 => 44,  112 => 43,  110 => 42,  108 => 41,  106 => 40,  99 => 34,  97 => 33,  94 => 32,  89 => 29,  83 => 27,  80 => 26,  78 => 25,  74 => 24,  72 => 23,  69 => 22,  66 => 21,  63 => 20,  61 => 17,  60 => 15,  58 => 12,  55 => 11,  53 => 9,  51 => 7,  48 => 6,  45 => 5,  43 => 4,  40 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "table/relation/foreign_key_row.twig", "C:\\xampp\\htdocs\\connect\\templates\\table\\relation\\foreign_key_row.twig");
    }
}
