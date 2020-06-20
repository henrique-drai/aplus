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

/* database/designer/database_tables.twig */
class __TwigTemplate_965c2ca08934207a4d080a54ea098c3ba42662f2135adb5af52ac48b9c42f025 extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tables"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["designerTable"]) {
            // line 2
            echo "    ";
            $context["i"] = twig_get_attribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 2);
            // line 3
            echo "    ";
            $context["t_n_url"] = twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getDbTableString", [], "method", false, false, false, 3), "url");
            // line 4
            echo "    ";
            $context["db"] = twig_get_attribute($this->env, $this->source, $context["designerTable"], "getDatabaseName", [], "method", false, false, false, 4);
            // line 5
            echo "    ";
            $context["db_url"] = twig_escape_filter($this->env, ($context["db"] ?? null), "url");
            // line 6
            echo "    ";
            $context["t_n"] = twig_get_attribute($this->env, $this->source, $context["designerTable"], "getDbTableString", [], "method", false, false, false, 6);
            // line 7
            echo "    ";
            $context["table_name"] = twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getTableName", [], "method", false, false, false, 7), "html");
            // line 8
            echo "    <input name=\"t_x[";
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "]\" type=\"hidden\" id=\"t_x_";
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "_\" />
    <input name=\"t_y[";
            // line 9
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "]\" type=\"hidden\" id=\"t_y_";
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "_\" />
    <input name=\"t_v[";
            // line 10
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "]\" type=\"hidden\" id=\"t_v_";
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "_\" />
    <input name=\"t_h[";
            // line 11
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "]\" type=\"hidden\" id=\"t_h_";
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "_\" />
    <table id=\"";
            // line 12
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\"
        db_url=\"";
            // line 13
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getDatabaseName", [], "method", false, false, false, 13), "url"), "html", null, true);
            echo "\"
        table_name_url=\"";
            // line 14
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getTableName", [], "method", false, false, false, 14), "url"), "html", null, true);
            echo "\"
        cellpadding=\"0\"
        cellspacing=\"0\"
        class=\"designer_tab\"
        style=\"position:absolute; left:";
            // line 19
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["tab_pos"] ?? null), ($context["t_n"] ?? null), [], "array", true, true, false, 19)) ? ((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["tab_pos"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["X"] ?? null) : null)) : (twig_random($this->env, range(20, 700)))), "html", null, true);
            echo "px; top:";
            // line 20
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, ($context["tab_pos"] ?? null), ($context["t_n"] ?? null), [], "array", true, true, false, 20)) ? ((($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["tab_pos"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["Y"] ?? null) : null)) : (twig_random($this->env, range(20, 550)))), "html", null, true);
            echo "px; display:";
            // line 21
            echo (((twig_get_attribute($this->env, $this->source, ($context["tab_pos"] ?? null), ($context["t_n"] ?? null), [], "array", true, true, false, 21) || (($context["display_page"] ?? null) ==  -1))) ? ("block") : ("none"));
            echo "; z-index: 1;\"> <!--\"-->
        <thead>
            <tr class=\"header\">
                ";
            // line 24
            if (($context["has_query"] ?? null)) {
                // line 25
                echo "                    <td class=\"select_all\">
                        <input class=\"select_all_1\"
                            type=\"checkbox\"
                            style=\"margin: 0;\"
                            value=\"select_all_";
                // line 29
                echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                echo "\"
                            id=\"select_all_";
                // line 30
                echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
                echo "\"
                            title=\"";
                // line 31
                echo _gettext("Select all");
                echo "\"
                            table_name=\"";
                // line 32
                echo twig_escape_filter($this->env, ($context["table_name"] ?? null), "html", null, true);
                echo "\"
                            db_name=\"";
                // line 33
                echo twig_escape_filter($this->env, ($context["db"] ?? null), "html", null, true);
                echo "\">
                    </td>
                ";
            }
            // line 36
            echo "                <td class=\"small_tab\"
                    title=\"";
            // line 37
            echo _gettext("Show/hide columns");
            echo "\"
                    id=\"id_hide_tbody_";
            // line 38
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\"
                    table_name=\"";
            // line 39
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\">";
            echo ((( !twig_get_attribute($this->env, $this->source, ($context["tab_pos"] ?? null), ($context["t_n"] ?? null), [], "array", true, true, false, 39) ||  !twig_test_empty((($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = ($context["tab_pos"] ?? null)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["V"] ?? null) : null)))) ? ("v") : ("&gt;"));
            echo "</td>
                <td class=\"small_tab_pref small_tab_pref_1\"
                    db=\"";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getDatabaseName", [], "method", false, false, false, 41), "html", null, true);
            echo "\"
                    db_url=\"";
            // line 42
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getDatabaseName", [], "method", false, false, false, 42), "url"), "html", null, true);
            echo "\"
                    table_name=\"";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getTableName", [], "method", false, false, false, 43), "html", null, true);
            echo "\"
                    table_name_url=\"";
            // line 44
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getTableName", [], "method", false, false, false, 44), "url"), "html", null, true);
            echo "\">
                    <img src=\"";
            // line 45
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/exec_small.png"], "method", false, false, false, 45), "html", null, true);
            echo "\"
                        title=\"";
            // line 46
            echo _gettext("See table structure");
            echo "\">
                </td>
                <td id=\"id_zag_";
            // line 48
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\"
                    class=\"tab_zag nowrap tab_zag_noquery\"
                    table_name=\"";
            // line 50
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\"
                    query_set=\"";
            // line 51
            echo ((($context["has_query"] ?? null)) ? (1) : (0));
            echo "\">
                    <span class=\"owner\">";
            // line 52
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getDatabaseName", [], "method", false, false, false, 52), "html", null, true);
            echo "</span>
                    ";
            // line 53
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getTableName", [], "method", false, false, false, 53), "html", null, true);
            echo "
                </td>
                ";
            // line 55
            if (($context["has_query"] ?? null)) {
                // line 56
                echo "                    <td class=\"tab_zag tab_zag_query\"
                        id=\"id_zag_";
                // line 57
                echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                echo "_2\"
                        table_name=\"";
                // line 58
                echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                echo "\">
                    </td>
               ";
            }
            // line 61
            echo "            </tr>
        </thead>
        <tbody id=\"id_tbody_";
            // line 63
            echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
            echo "\"";
            // line 64
            echo (((twig_get_attribute($this->env, $this->source, ($context["tab_pos"] ?? null), ($context["t_n"] ?? null), [], "array", true, true, false, 64) && twig_test_empty((($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = ($context["tab_pos"] ?? null)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["V"] ?? null) : null)))) ? (" style=\"display: none\"") : (""));
            echo ">
            ";
            // line 65
            $context["display_field"] = twig_get_attribute($this->env, $this->source, $context["designerTable"], "getDisplayField", [], "method", false, false, false, 65);
            // line 66
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(0, (twig_length_filter($this->env, (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = ($context["tab_column"] ?? null)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["COLUMN_ID"] ?? null) : null)) - 1)));
            foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
                // line 67
                echo "                ";
                $context["col_name"] = (($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = (($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = (($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f = ($context["tab_column"] ?? null)) && is_array($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f) || $__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f instanceof ArrayAccess ? ($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae) || $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae instanceof ArrayAccess ? ($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae["COLUMN_NAME"] ?? null) : null)) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9[$context["j"]] ?? null) : null);
                // line 68
                echo "                ";
                $context["tmp_column"] = ((($context["t_n"] ?? null) . ".") . (($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 = (($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f = (($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 = ($context["tab_column"] ?? null)) && is_array($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760) || $__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 instanceof ArrayAccess ? ($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f) || $__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f instanceof ArrayAccess ? ($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f["COLUMN_NAME"] ?? null) : null)) && is_array($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40) || $__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 instanceof ArrayAccess ? ($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40[$context["j"]] ?? null) : null));
                // line 69
                echo "                ";
                $context["click_field_param"] = [0 => twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source,                 // line 70
$context["designerTable"], "getTableName", [], "method", false, false, false, 70), "url"), 1 => twig_urlencode_filter((($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce = (($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b = (($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c =                 // line 71
($context["tab_column"] ?? null)) && is_array($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c) || $__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c instanceof ArrayAccess ? ($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b) || $__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b instanceof ArrayAccess ? ($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b["COLUMN_NAME"] ?? null) : null)) && is_array($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce) || $__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce instanceof ArrayAccess ? ($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce[$context["j"]] ?? null) : null))];
                // line 73
                echo "                ";
                if ( !twig_get_attribute($this->env, $this->source, $context["designerTable"], "supportsForeignkeys", [], "method", false, false, false, 73)) {
                    // line 74
                    echo "                    ";
                    $context["click_field_param"] = twig_array_merge(($context["click_field_param"] ?? null), [0 => ((twig_get_attribute($this->env, $this->source, ($context["tables_pk_or_unique_keys"] ?? null), ($context["tmp_column"] ?? null), [], "array", true, true, false, 74)) ? (1) : (0))]);
                    // line 75
                    echo "                ";
                } else {
                    // line 76
                    echo "                    ";
                    // line 78
                    echo "                    ";
                    $context["click_field_param"] = twig_array_merge(($context["click_field_param"] ?? null), [0 => ((twig_get_attribute($this->env, $this->source, ($context["tables_all_keys"] ?? null), ($context["tmp_column"] ?? null), [], "array", true, true, false, 78)) ? (1) : (0))]);
                    // line 79
                    echo "                ";
                }
                // line 80
                echo "                ";
                $context["click_field_param"] = twig_array_merge(($context["click_field_param"] ?? null), [0 => ($context["db"] ?? null)]);
                // line 81
                echo "                <tr id=\"id_tr_";
                echo twig_escape_filter($this->env, twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["designerTable"], "getTableName", [], "method", false, false, false, 81), "url"), "html", null, true);
                echo ".";
                echo twig_escape_filter($this->env, (($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 = (($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216 = (($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0 = ($context["tab_column"] ?? null)) && is_array($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0) || $__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0 instanceof ArrayAccess ? ($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216) || $__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216 instanceof ArrayAccess ? ($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216["COLUMN_NAME"] ?? null) : null)) && is_array($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972) || $__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 instanceof ArrayAccess ? ($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972[$context["j"]] ?? null) : null), "html", null, true);
                echo "\" class=\"tab_field";
                // line 82
                echo (((($context["display_field"] ?? null) == (($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c = (($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f = (($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc = ($context["tab_column"] ?? null)) && is_array($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc) || $__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc instanceof ArrayAccess ? ($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f) || $__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f instanceof ArrayAccess ? ($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f["COLUMN_NAME"] ?? null) : null)) && is_array($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c) || $__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c instanceof ArrayAccess ? ($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c[$context["j"]] ?? null) : null))) ? ("_3") : (""));
                echo "\" click_field_param=\"";
                // line 83
                echo twig_escape_filter($this->env, twig_join_filter(($context["click_field_param"] ?? null), ","), "html", null, true);
                echo "\">
                    ";
                // line 84
                if (($context["has_query"] ?? null)) {
                    // line 85
                    echo "                        <td class=\"select_all\">
                            <input class=\"select_all_store_col\"
                                value=\"";
                    // line 87
                    echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                    echo twig_escape_filter($this->env, twig_urlencode_filter((($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55 = (($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba = (($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78 = ($context["tab_column"] ?? null)) && is_array($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78) || $__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78 instanceof ArrayAccess ? ($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba) || $__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba instanceof ArrayAccess ? ($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba["COLUMN_NAME"] ?? null) : null)) && is_array($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55) || $__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55 instanceof ArrayAccess ? ($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55[$context["j"]] ?? null) : null)), "html", null, true);
                    echo "\"
                                type=\"checkbox\"
                                id=\"select_";
                    // line 89
                    echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                    echo "._";
                    echo twig_escape_filter($this->env, twig_urlencode_filter((($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de = (($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828 = (($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd = ($context["tab_column"] ?? null)) && is_array($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd) || $__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd instanceof ArrayAccess ? ($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828) || $__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828 instanceof ArrayAccess ? ($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828["COLUMN_NAME"] ?? null) : null)) && is_array($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de) || $__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de instanceof ArrayAccess ? ($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de[$context["j"]] ?? null) : null)), "html", null, true);
                    echo "\"
                                style=\"margin: 0;\"
                                title=\"";
                    // line 91
                    echo twig_escape_filter($this->env, sprintf(_gettext("Select \"%s\""), ($context["col_name"] ?? null)), "html", null, true);
                    echo "\"
                                id_check_all=\"select_all_";
                    // line 92
                    echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
                    echo "\"
                                db_name=\"";
                    // line 93
                    echo twig_escape_filter($this->env, ($context["db"] ?? null), "html", null, true);
                    echo "\"
                                table_name=\"";
                    // line 94
                    echo twig_escape_filter($this->env, ($context["table_name"] ?? null), "html", null, true);
                    echo "\"
                                col_name=\"";
                    // line 95
                    echo twig_escape_filter($this->env, ($context["col_name"] ?? null), "html", null, true);
                    echo "\">
                        </td>
                    ";
                }
                // line 98
                echo "                    <td width=\"10px\" colspan=\"3\" id=\"";
                echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                echo ".";
                // line 99
                echo twig_escape_filter($this->env, twig_urlencode_filter((($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6 = (($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855 = (($__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b = ($context["tab_column"] ?? null)) && is_array($__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b) || $__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b instanceof ArrayAccess ? ($__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855) || $__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855 instanceof ArrayAccess ? ($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855["COLUMN_NAME"] ?? null) : null)) && is_array($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6) || $__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6 instanceof ArrayAccess ? ($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6[$context["j"]] ?? null) : null)), "html", null, true);
                echo "\">
                        <div class=\"nowrap\">
                            ";
                // line 101
                $context["type"] = (($__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f = ($context["columns_type"] ?? null)) && is_array($__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f) || $__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f instanceof ArrayAccess ? ($__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f[((($context["t_n"] ?? null) . ".") . (($__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0 = (($__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55 = (($__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a = ($context["tab_column"] ?? null)) && is_array($__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a) || $__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a instanceof ArrayAccess ? ($__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55) || $__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55 instanceof ArrayAccess ? ($__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55["COLUMN_NAME"] ?? null) : null)) && is_array($__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0) || $__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0 instanceof ArrayAccess ? ($__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0[$context["j"]] ?? null) : null))] ?? null) : null);
                // line 102
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => ($context["type"] ?? null)], "method", false, false, false, 102), "html", null, true);
                echo ".png\" alt=\"*\">
                            ";
                // line 103
                echo twig_escape_filter($this->env, (($__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88 = (($__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758 = (($__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35 = ($context["tab_column"] ?? null)) && is_array($__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35) || $__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35 instanceof ArrayAccess ? ($__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758) || $__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758 instanceof ArrayAccess ? ($__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758["COLUMN_NAME"] ?? null) : null)) && is_array($__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88) || $__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88 instanceof ArrayAccess ? ($__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88[$context["j"]] ?? null) : null), "html", null, true);
                echo " : ";
                echo twig_escape_filter($this->env, (($__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b = (($__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae = (($__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54 = ($context["tab_column"] ?? null)) && is_array($__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54) || $__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54 instanceof ArrayAccess ? ($__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54[($context["t_n"] ?? null)] ?? null) : null)) && is_array($__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae) || $__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae instanceof ArrayAccess ? ($__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae["TYPE"] ?? null) : null)) && is_array($__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b) || $__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b instanceof ArrayAccess ? ($__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b[$context["j"]] ?? null) : null), "html", null, true);
                echo "
                        </div>
                    </td>
                    ";
                // line 106
                if (($context["has_query"] ?? null)) {
                    // line 107
                    echo "                        <td class=\"small_tab_pref small_tab_pref_click_opt\"
                            ";
                    // line 109
                    echo "                            option_col_name_modal=\"<strong>";
                    echo twig_escape_filter($this->env, twig_escape_filter($this->env, sprintf(_gettext("Add an option for column \"%s\"."), ($context["col_name"] ?? null)), "html"), "html");
                    echo "</strong>\"
                            db_name=\"";
                    // line 110
                    echo twig_escape_filter($this->env, ($context["db"] ?? null), "html", null, true);
                    echo "\"
                            table_name=\"";
                    // line 111
                    echo twig_escape_filter($this->env, ($context["table_name"] ?? null), "html", null, true);
                    echo "\"
                            col_name=\"";
                    // line 112
                    echo twig_escape_filter($this->env, ($context["col_name"] ?? null), "html", null, true);
                    echo "\"
                            db_table_name_url=\"";
                    // line 113
                    echo twig_escape_filter($this->env, ($context["t_n_url"] ?? null), "html", null, true);
                    echo "\">
                            <img src=\"";
                    // line 114
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/exec_small.png"], "method", false, false, false, 114), "html", null, true);
                    echo "\" title=\"";
                    echo _gettext("Options");
                    echo "\" />
                        </td>
                    ";
                }
                // line 117
                echo "                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 119
            echo "        </tbody>
    </table>
";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['designerTable'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "database/designer/database_tables.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  402 => 119,  395 => 117,  387 => 114,  383 => 113,  379 => 112,  375 => 111,  371 => 110,  366 => 109,  363 => 107,  361 => 106,  353 => 103,  348 => 102,  346 => 101,  341 => 99,  337 => 98,  331 => 95,  327 => 94,  323 => 93,  319 => 92,  315 => 91,  308 => 89,  302 => 87,  298 => 85,  296 => 84,  292 => 83,  289 => 82,  283 => 81,  280 => 80,  277 => 79,  274 => 78,  272 => 76,  269 => 75,  266 => 74,  263 => 73,  261 => 71,  260 => 70,  258 => 69,  255 => 68,  252 => 67,  247 => 66,  245 => 65,  241 => 64,  238 => 63,  234 => 61,  228 => 58,  224 => 57,  221 => 56,  219 => 55,  214 => 53,  210 => 52,  206 => 51,  202 => 50,  197 => 48,  192 => 46,  188 => 45,  184 => 44,  180 => 43,  176 => 42,  172 => 41,  165 => 39,  161 => 38,  157 => 37,  154 => 36,  148 => 33,  144 => 32,  140 => 31,  136 => 30,  132 => 29,  126 => 25,  124 => 24,  118 => 21,  115 => 20,  112 => 19,  105 => 14,  101 => 13,  97 => 12,  91 => 11,  85 => 10,  79 => 9,  72 => 8,  69 => 7,  66 => 6,  63 => 5,  60 => 4,  57 => 3,  54 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "database/designer/database_tables.twig", "C:\\xampp\\htdocs\\connect\\templates\\database\\designer\\database_tables.twig");
    }
}
