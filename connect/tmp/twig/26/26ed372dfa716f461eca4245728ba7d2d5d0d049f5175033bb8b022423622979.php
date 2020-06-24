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

/* table/relation/common_form.twig */
class __TwigTemplate_1b1f6951e11565c5bfdf3a918b8aa9fb004a0e399fb149c108e5f95f4791fe5f extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "table/page_with_secondary_tabs.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("table/page_with_secondary_tabs.twig", "table/relation/common_form.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "<form method=\"post\" action=\"tbl_relation.php\">
    ";
        // line 5
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null), ($context["table"] ?? null));
        echo "
    ";
        // line 7
        echo "    ";
        if (PhpMyAdmin\Util::isForeignKeySupported(($context["tbl_storage_engine"] ?? null))) {
            // line 8
            echo "        <fieldset>
            <legend>";
            // line 9
            echo _gettext("Foreign key constraints");
            echo "</legend>
            <div class=\"responsivetable jsresponsive\">
            <table id=\"foreign_keys\" class=\"relationalTable\">
                <thead><tr>
                    <th>";
            // line 13
            echo _gettext("Actions");
            echo "</th>
                    <th>";
            // line 14
            echo _gettext("Constraint properties");
            echo "</th>
                    ";
            // line 15
            if ((twig_upper_filter($this->env, ($context["tbl_storage_engine"] ?? null)) == "INNODB")) {
                // line 16
                echo "                        <th>
                            ";
                // line 17
                echo _gettext("Column");
                // line 18
                echo "                            ";
                echo PhpMyAdmin\Util::showHint(_gettext("Creating a foreign key over a non-indexed column would automatically create an index on it. Alternatively, you can define an index below, before creating the foreign key."));
                echo "
                        </th>
                    ";
            } else {
                // line 21
                echo "                        <th>
                            ";
                // line 22
                echo _gettext("Column");
                // line 23
                echo "                            ";
                echo PhpMyAdmin\Util::showHint(_gettext("Only columns with index will be displayed. You can define an index below."));
                echo "
                        </th>
                    ";
            }
            // line 26
            echo "                    <th colspan=\"3\">
                        ";
            // line 27
            echo _gettext("Foreign key constraint");
            // line 28
            echo "                        (";
            echo twig_escape_filter($this->env, ($context["tbl_storage_engine"] ?? null), "html", null, true);
            echo ")
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>";
            // line 35
            echo _gettext("Database");
            echo "</th>
                    <th>";
            // line 36
            echo _gettext("Table");
            echo "</th>
                    <th>";
            // line 37
            echo _gettext("Column");
            echo "</th>
                </tr></thead>
                ";
            // line 39
            $context["i"] = 0;
            // line 40
            echo "                ";
            if ( !twig_test_empty(($context["existrel_foreign"] ?? null))) {
                // line 41
                echo "                    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["existrel_foreign"] ?? null));
                foreach ($context['_seq'] as $context["key"] => $context["one_key"]) {
                    // line 42
                    echo "                        ";
                    // line 43
                    echo "                        ";
                    $context["foreign_db"] = (((twig_get_attribute($this->env, $this->source, $context["one_key"], "ref_db_name", [], "array", true, true, false, 43) &&  !(null === (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 =                     // line 44
$context["one_key"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["ref_db_name"] ?? null) : null)))) ? ((($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 =                     // line 45
$context["one_key"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["ref_db_name"] ?? null) : null)) : (($context["db"] ?? null)));
                    // line 46
                    echo "                        ";
                    $context["foreign_table"] = false;
                    // line 47
                    echo "                        ";
                    if (($context["foreign_db"] ?? null)) {
                        // line 48
                        echo "                            ";
                        $context["foreign_table"] = (((twig_get_attribute($this->env, $this->source, $context["one_key"], "ref_table_name", [], "array", true, true, false, 48) &&  !(null === (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b =                         // line 49
$context["one_key"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["ref_table_name"] ?? null) : null)))) ? ((($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 =                         // line 50
$context["one_key"]) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["ref_table_name"] ?? null) : null)) : (false));
                        // line 51
                        echo "                        ";
                    }
                    // line 52
                    echo "                        ";
                    $context["unique_columns"] = [];
                    // line 53
                    echo "                        ";
                    if ((($context["foreign_db"] ?? null) && ($context["foreign_table"] ?? null))) {
                        // line 54
                        echo "                            ";
                        $context["table_obj"] = PhpMyAdmin\Table::get(($context["foreign_table"] ?? null), ($context["foreign_db"] ?? null));
                        // line 55
                        echo "                            ";
                        $context["unique_columns"] = twig_get_attribute($this->env, $this->source, ($context["table_obj"] ?? null), "getUniqueColumns", [0 => false, 1 => false], "method", false, false, false, 55);
                        // line 56
                        echo "                        ";
                    }
                    // line 57
                    echo "                        ";
                    $this->loadTemplate("table/relation/foreign_key_row.twig", "table/relation/common_form.twig", 57)->display(twig_to_array(["i" =>                     // line 58
($context["i"] ?? null), "one_key" =>                     // line 59
$context["one_key"], "column_array" =>                     // line 60
($context["column_array"] ?? null), "options_array" =>                     // line 61
($context["options_array"] ?? null), "tbl_storage_engine" =>                     // line 62
($context["tbl_storage_engine"] ?? null), "db" =>                     // line 63
($context["db"] ?? null), "table" =>                     // line 64
($context["table"] ?? null), "url_params" =>                     // line 65
($context["url_params"] ?? null), "databases" =>                     // line 66
($context["databases"] ?? null), "foreign_db" =>                     // line 67
($context["foreign_db"] ?? null), "foreign_table" =>                     // line 68
($context["foreign_table"] ?? null), "unique_columns" =>                     // line 69
($context["unique_columns"] ?? null)]));
                    // line 71
                    echo "                        ";
                    $context["i"] = (($context["i"] ?? null) + 1);
                    // line 72
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['one_key'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 73
                echo "                ";
            }
            // line 74
            echo "                ";
            $this->loadTemplate("table/relation/foreign_key_row.twig", "table/relation/common_form.twig", 74)->display(twig_to_array(["i" =>             // line 75
($context["i"] ?? null), "one_key" => [], "column_array" =>             // line 77
($context["column_array"] ?? null), "options_array" =>             // line 78
($context["options_array"] ?? null), "tbl_storage_engine" =>             // line 79
($context["tbl_storage_engine"] ?? null), "db" =>             // line 80
($context["db"] ?? null), "table" =>             // line 81
($context["table"] ?? null), "url_params" =>             // line 82
($context["url_params"] ?? null), "databases" =>             // line 83
($context["databases"] ?? null), "foreign_db" =>             // line 84
($context["foreign_db"] ?? null), "foreign_table" =>             // line 85
($context["foreign_table"] ?? null), "unique_columns" =>             // line 86
($context["unique_columns"] ?? null)]));
            // line 88
            echo "                ";
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 89
            echo "                <tr>
                    <th colspan=\"6\">
                        <a class=\"formelement clearfloat add_foreign_key\" href=\"\">
                            ";
            // line 92
            echo _gettext("+ Add constraint");
            // line 93
            echo "                        </a>
                    </th>
                </tr>
            </table>
            </div>
        </fieldset>
    ";
        }
        // line 100
        echo "
    ";
        // line 101
        if ((($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = ($context["cfg_relation"] ?? null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["relwork"] ?? null) : null)) {
            // line 102
            echo "        ";
            if (PhpMyAdmin\Util::isForeignKeySupported(($context["tbl_storage_engine"] ?? null))) {
                // line 103
                echo "            ";
                $this->loadTemplate("div_for_slider_effect.twig", "table/relation/common_form.twig", 103)->display(twig_to_array(["id" => "ir_div", "message" => _gettext("Internal relationships"), "initial_sliders_state" =>                 // line 106
($context["default_sliders_state"] ?? null)]));
                // line 108
                echo "        ";
            }
            // line 109
            echo "
        <fieldset>
            <legend>
                ";
            // line 112
            echo _gettext("Internal relationships");
            // line 113
            echo "                ";
            echo PhpMyAdmin\Util::showDocu("config", "cfg_Servers_relation");
            echo "
            </legend>
            <table id=\"internal_relations\" class=\"relationalTable\">
                <tr>
                    <th>";
            // line 117
            echo _gettext("Column");
            echo "</th>
                    <th>";
            // line 118
            echo _gettext("Internal relation");
            // line 119
            echo "                        ";
            if (PhpMyAdmin\Util::isForeignKeySupported(($context["tbl_storage_engine"] ?? null))) {
                // line 120
                echo "                            ";
                echo PhpMyAdmin\Util::showHint(_gettext("An internal relation is not necessary when a corresponding FOREIGN KEY relation exists."));
                echo "
                        ";
            }
            // line 122
            echo "                    </th>
                    ";
            // line 123
            $context["saved_row_cnt"] = (twig_length_filter($this->env, ($context["save_row"] ?? null)) - 1);
            // line 124
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(0, ($context["saved_row_cnt"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 125
                echo "                        ";
                $context["myfield"] = (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = (($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = ($context["save_row"] ?? null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e[$context["i"]] ?? null) : null)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["Field"] ?? null) : null);
                // line 126
                echo "                        ";
                // line 128
                echo "                        ";
                $context["myfield_md5"] = (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = ($context["column_hash_array"] ?? null)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52[($context["myfield"] ?? null)] ?? null) : null);
                // line 129
                echo "
                        ";
                // line 130
                $context["foreign_table"] = false;
                // line 131
                echo "                        ";
                $context["foreign_column"] = false;
                // line 132
                echo "
                        ";
                // line 134
                echo "                        ";
                if (twig_get_attribute($this->env, $this->source, ($context["existrel"] ?? null), ($context["myfield"] ?? null), [], "array", true, true, false, 134)) {
                    // line 135
                    echo "                            ";
                    $context["foreign_db"] = (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = ($context["existrel"] ?? null)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386[($context["myfield"] ?? null)] ?? null) : null)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["foreign_db"] ?? null) : null);
                    // line 136
                    echo "                        ";
                } else {
                    // line 137
                    echo "                            ";
                    $context["foreign_db"] = ($context["db"] ?? null);
                    // line 138
                    echo "                        ";
                }
                // line 139
                echo "
                        ";
                // line 141
                echo "                        ";
                $context["tables"] = [];
                // line 142
                echo "                        ";
                if (($context["foreign_db"] ?? null)) {
                    // line 143
                    echo "                            ";
                    if (twig_get_attribute($this->env, $this->source, ($context["existrel"] ?? null), ($context["myfield"] ?? null), [], "array", true, true, false, 143)) {
                        // line 144
                        echo "                                ";
                        $context["foreign_table"] = (($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = (($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = ($context["existrel"] ?? null)) && is_array($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae) || $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae instanceof ArrayAccess ? ($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae[($context["myfield"] ?? null)] ?? null) : null)) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9["foreign_table"] ?? null) : null);
                        // line 145
                        echo "                            ";
                    }
                    // line 146
                    echo "                            ";
                    $context["tables"] = twig_get_attribute($this->env, $this->source, ($context["dbi"] ?? null), "getTables", [0 => ($context["foreign_db"] ?? null)], "method", false, false, false, 146);
                    // line 147
                    echo "                        ";
                }
                // line 148
                echo "
                        ";
                // line 150
                echo "                        ";
                $context["unique_columns"] = [];
                // line 151
                echo "                        ";
                if ((($context["foreign_db"] ?? null) && ($context["foreign_table"] ?? null))) {
                    // line 152
                    echo "                            ";
                    if (twig_get_attribute($this->env, $this->source, ($context["existrel"] ?? null), ($context["myfield"] ?? null), [], "array", true, true, false, 152)) {
                        // line 153
                        echo "                                ";
                        $context["foreign_column"] = (($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f = (($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 = ($context["existrel"] ?? null)) && is_array($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40) || $__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 instanceof ArrayAccess ? ($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40[($context["myfield"] ?? null)] ?? null) : null)) && is_array($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f) || $__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f instanceof ArrayAccess ? ($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f["foreign_field"] ?? null) : null);
                        // line 154
                        echo "                            ";
                    }
                    // line 155
                    echo "                            ";
                    $context["table_obj"] = PhpMyAdmin\Table::get(($context["foreign_table"] ?? null), ($context["foreign_db"] ?? null));
                    // line 156
                    echo "                            ";
                    $context["unique_columns"] = twig_get_attribute($this->env, $this->source, ($context["table_obj"] ?? null), "getUniqueColumns", [0 => false, 1 => false], "method", false, false, false, 156);
                    // line 157
                    echo "                        ";
                }
                // line 158
                echo "
                        <tr>
                            <td class=\"vmiddle\">
                                <strong>";
                // line 161
                echo twig_escape_filter($this->env, ($context["myfield"] ?? null), "html", null, true);
                echo "</strong>
                                <input type=\"hidden\" name=\"fields_name[";
                // line 162
                echo twig_escape_filter($this->env, ($context["myfield_md5"] ?? null), "html", null, true);
                echo "]\"
                                    value=\"";
                // line 163
                echo twig_escape_filter($this->env, ($context["myfield"] ?? null), "html", null, true);
                echo "\">
                            </td>

                            <td>
                                ";
                // line 167
                $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/common_form.twig", 167)->display(twig_to_array(["name" => (("destination_db[" .                 // line 168
($context["myfield_md5"] ?? null)) . "]"), "title" => _gettext("Database"), "values" =>                 // line 170
($context["databases"] ?? null), "foreign" =>                 // line 171
($context["foreign_db"] ?? null)]));
                // line 173
                echo "
                                ";
                // line 174
                $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/common_form.twig", 174)->display(twig_to_array(["name" => (("destination_table[" .                 // line 175
($context["myfield_md5"] ?? null)) . "]"), "title" => _gettext("Table"), "values" =>                 // line 177
($context["tables"] ?? null), "foreign" =>                 // line 178
($context["foreign_table"] ?? null)]));
                // line 180
                echo "
                                ";
                // line 181
                $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/common_form.twig", 181)->display(twig_to_array(["name" => (("destination_column[" .                 // line 182
($context["myfield_md5"] ?? null)) . "]"), "title" => _gettext("Column"), "values" =>                 // line 184
($context["unique_columns"] ?? null), "foreign" =>                 // line 185
($context["foreign_column"] ?? null)]));
                // line 187
                echo "                            </td>
                        </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 190
            echo "            </table>
        </fieldset>
        ";
            // line 192
            if (PhpMyAdmin\Util::isForeignKeySupported(($context["tbl_storage_engine"] ?? null))) {
                // line 193
                echo "            </div>
        ";
            }
            // line 195
            echo "    ";
        }
        // line 196
        echo "
    ";
        // line 197
        if ((($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f = ($context["cfg_relation"] ?? null)) && is_array($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f) || $__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f instanceof ArrayAccess ? ($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f["displaywork"] ?? null) : null)) {
            // line 198
            echo "        ";
            $context["disp"] = call_user_func_array($this->env->getFunction('get_display_field')->getCallable(), [($context["db"] ?? null), ($context["table"] ?? null)]);
            // line 199
            echo "        <fieldset>
            <label>";
            // line 200
            echo _gettext("Choose column to display:");
            echo "</label>
            <select name=\"display_field\">
                <option value=\"\">---</option>
                ";
            // line 203
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["save_row"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 204
                echo "                    <option value=\"";
                echo twig_escape_filter($this->env, (($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 = $context["row"]) && is_array($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760) || $__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 instanceof ArrayAccess ? ($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760["Field"] ?? null) : null), "html", null, true);
                echo "\"";
                // line 205
                if (((isset($context["disp"]) || array_key_exists("disp", $context)) && ((($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce = $context["row"]) && is_array($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce) || $__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce instanceof ArrayAccess ? ($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce["Field"] ?? null) : null) == ($context["disp"] ?? null)))) {
                    // line 206
                    echo "                            selected=\"selected\"";
                }
                // line 207
                echo ">
                        ";
                // line 208
                echo twig_escape_filter($this->env, (($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b = $context["row"]) && is_array($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b) || $__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b instanceof ArrayAccess ? ($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b["Field"] ?? null) : null), "html", null, true);
                echo "
                    </option>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 211
            echo "            </select>
        </fieldset>
    ";
        }
        // line 214
        echo "
    <fieldset class=\"tblFooters\">
        <input class=\"btn btn-secondary preview_sql\" type=\"button\" value=\"";
        // line 216
        echo _gettext("Preview SQL");
        echo "\">
        <input class=\"btn btn-primary\" type=\"submit\" value=\"";
        // line 217
        echo _gettext("Save");
        echo "\">
    </fieldset>
</form>
";
        // line 220
        if (($context["foreignKeySupported"] ?? null)) {
            // line 221
            echo "    ";
            echo ($context["displayIndexesHtml"] ?? null);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "table/relation/common_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  504 => 221,  502 => 220,  496 => 217,  492 => 216,  488 => 214,  483 => 211,  474 => 208,  471 => 207,  468 => 206,  466 => 205,  462 => 204,  458 => 203,  452 => 200,  449 => 199,  446 => 198,  444 => 197,  441 => 196,  438 => 195,  434 => 193,  432 => 192,  428 => 190,  420 => 187,  418 => 185,  417 => 184,  416 => 182,  415 => 181,  412 => 180,  410 => 178,  409 => 177,  408 => 175,  407 => 174,  404 => 173,  402 => 171,  401 => 170,  400 => 168,  399 => 167,  392 => 163,  388 => 162,  384 => 161,  379 => 158,  376 => 157,  373 => 156,  370 => 155,  367 => 154,  364 => 153,  361 => 152,  358 => 151,  355 => 150,  352 => 148,  349 => 147,  346 => 146,  343 => 145,  340 => 144,  337 => 143,  334 => 142,  331 => 141,  328 => 139,  325 => 138,  322 => 137,  319 => 136,  316 => 135,  313 => 134,  310 => 132,  307 => 131,  305 => 130,  302 => 129,  299 => 128,  297 => 126,  294 => 125,  289 => 124,  287 => 123,  284 => 122,  278 => 120,  275 => 119,  273 => 118,  269 => 117,  261 => 113,  259 => 112,  254 => 109,  251 => 108,  249 => 106,  247 => 103,  244 => 102,  242 => 101,  239 => 100,  230 => 93,  228 => 92,  223 => 89,  220 => 88,  218 => 86,  217 => 85,  216 => 84,  215 => 83,  214 => 82,  213 => 81,  212 => 80,  211 => 79,  210 => 78,  209 => 77,  208 => 75,  206 => 74,  203 => 73,  197 => 72,  194 => 71,  192 => 69,  191 => 68,  190 => 67,  189 => 66,  188 => 65,  187 => 64,  186 => 63,  185 => 62,  184 => 61,  183 => 60,  182 => 59,  181 => 58,  179 => 57,  176 => 56,  173 => 55,  170 => 54,  167 => 53,  164 => 52,  161 => 51,  159 => 50,  158 => 49,  156 => 48,  153 => 47,  150 => 46,  148 => 45,  147 => 44,  145 => 43,  143 => 42,  138 => 41,  135 => 40,  133 => 39,  128 => 37,  124 => 36,  120 => 35,  109 => 28,  107 => 27,  104 => 26,  97 => 23,  95 => 22,  92 => 21,  85 => 18,  83 => 17,  80 => 16,  78 => 15,  74 => 14,  70 => 13,  63 => 9,  60 => 8,  57 => 7,  53 => 5,  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "table/relation/common_form.twig", "C:\\xampp\\htdocs\\connect\\templates\\table\\relation\\common_form.twig");
    }
}
