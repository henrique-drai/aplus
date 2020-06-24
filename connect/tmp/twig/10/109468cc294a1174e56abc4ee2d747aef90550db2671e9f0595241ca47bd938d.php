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

/* database/designer/main.twig */
class __TwigTemplate_d762d1e6547045c71e5975166a17b3d6caf8dcef5f667e5c3bec791731098e09 extends \Twig\Template
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
        // line 2
        ob_start(function () { return ''; });
        // line 3
        echo "<script type=\"text/javascript\">
var designerConfig = ";
        // line 4
        echo ($context["designer_config"] ?? null);
        echo ";
</script>
";
        $___internal_3fa1e800072cdcead317d53b67919a85f9c042a6284f853009937b8c54e1be6e_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 2
        echo twig_spaceless($___internal_3fa1e800072cdcead317d53b67919a85f9c042a6284f853009937b8c54e1be6e_);
        // line 7
        echo "
";
        // line 9
        if ( !($context["has_query"] ?? null)) {
            // line 10
            echo "    <div id=\"name-panel\">
        <span id=\"page_name\">
            ";
            // line 12
            echo twig_escape_filter($this->env, (((($context["selected_page"] ?? null) == null)) ? (_gettext("Untitled")) : (($context["selected_page"] ?? null))), "html", null, true);
            echo "
        </span>
        <span id=\"saved_state\">
            ";
            // line 15
            echo (((($context["selected_page"] ?? null) == null)) ? ("*") : (""));
            echo "
        </span>
    </div>
";
        }
        // line 19
        echo "<div class=\"designer_header side-menu\" id=\"side_menu\">
    <a class=\"M_butt\" id=\"key_Show_left_menu\" href=\"#\">
        <img title=\"";
        // line 21
        echo _gettext("Show/Hide tables list");
        echo "\"
             alt=\"v\"
             src=\"";
        // line 23
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/downarrow2_m.png"], "method", false, false, false, 23), "html", null, true);
        echo "\"
             data-down=\"";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/downarrow2_m.png"], "method", false, false, false, 24), "html", null, true);
        echo "\"
             data-up=\"";
        // line 25
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/uparrow2_m.png"], "method", false, false, false, 25), "html", null, true);
        echo "\">
        <span class=\"hide hidable\">
            ";
        // line 27
        echo _gettext("Show/Hide tables list");
        // line 28
        echo "        </span>
    </a>
    <a href=\"#\" id=\"toggleFullscreen\" class=\"M_butt\">
        <img title=\"";
        // line 31
        echo _gettext("View in fullscreen");
        echo "\"
             src=\"";
        // line 32
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/viewInFullscreen.png"], "method", false, false, false, 32), "html", null, true);
        echo "\"
             data-enter=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/viewInFullscreen.png"], "method", false, false, false, 33), "html", null, true);
        echo "\"
             data-exit=\"";
        // line 34
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/exitFullscreen.png"], "method", false, false, false, 34), "html", null, true);
        echo "\">
        <span class=\"hide hidable\"
              data-exit=\"";
        // line 36
        echo _gettext("Exit fullscreen");
        echo "\"
              data-enter=\"";
        // line 37
        echo _gettext("View in fullscreen");
        echo "\">
            ";
        // line 38
        echo _gettext("View in fullscreen");
        // line 39
        echo "        </span>
    </a>
    <a href=\"#\" id=\"addOtherDbTables\" class=\"M_butt\">
        <img title=\"";
        // line 42
        echo _gettext("Add tables from other databases");
        echo "\"
             src=\"";
        // line 43
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/other_table.png"], "method", false, false, false, 43), "html", null, true);
        echo "\">
        <span class=\"hide hidable\">
            ";
        // line 45
        echo _gettext("Add tables from other databases");
        // line 46
        echo "        </span>
    </a>
    ";
        // line 48
        if ( !($context["has_query"] ?? null)) {
            // line 49
            echo "        <a id=\"newPage\" href=\"#\" class=\"M_butt\">
            <img title=\"";
            // line 50
            echo _gettext("New page");
            echo "\"
                 alt=\"\"
                 src=\"";
            // line 52
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/page_add.png"], "method", false, false, false, 52), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 54
            echo _gettext("New page");
            // line 55
            echo "            </span>
        </a>
        <a href=\"#\" id=\"editPage\" class=\"M_butt ajax\">
            <img title=\"";
            // line 58
            echo _gettext("Open page");
            echo "\"
                 src=\"";
            // line 59
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/page_edit.png"], "method", false, false, false, 59), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 61
            echo _gettext("Open page");
            // line 62
            echo "            </span>
        </a>
        <a href=\"#\" id=\"savePos\" class=\"M_butt\">
            <img title=\"";
            // line 65
            echo _gettext("Save page");
            echo "\"
                 src=\"";
            // line 66
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/save.png"], "method", false, false, false, 66), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 68
            echo _gettext("Save page");
            // line 69
            echo "            </span>
        </a>
        <a href=\"#\" id=\"SaveAs\" class=\"M_butt ajax\">
            <img title=\"";
            // line 72
            echo _gettext("Save page as");
            echo "\"
                 src=\"";
            // line 73
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/save_as.png"], "method", false, false, false, 73), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 75
            echo _gettext("Save page as");
            // line 76
            echo "            </span>
        </a>
        <a href=\"#\" id=\"delPages\" class=\"M_butt ajax\">
            <img title=\"";
            // line 79
            echo _gettext("Delete pages");
            echo "\"
                 src=\"";
            // line 80
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/page_delete.png"], "method", false, false, false, 80), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 82
            echo _gettext("Delete pages");
            // line 83
            echo "            </span>
        </a>
        <a href=\"#\" id=\"StartTableNew\" class=\"M_butt\">
            <img title=\"";
            // line 86
            echo _gettext("Create table");
            echo "\"
                 src=\"";
            // line 87
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/table.png"], "method", false, false, false, 87), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 89
            echo _gettext("Create table");
            // line 90
            echo "            </span>
        </a>
        <a href=\"#\" class=\"M_butt\" id=\"rel_button\">
            <img title=\"";
            // line 93
            echo _gettext("Create relationship");
            echo "\"
                 src=\"";
            // line 94
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/relation.png"], "method", false, false, false, 94), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 96
            echo _gettext("Create relationship");
            // line 97
            echo "            </span>
        </a>
        <a href=\"#\" class=\"M_butt\" id=\"display_field_button\">
            <img title=\"";
            // line 100
            echo _gettext("Choose column to display");
            echo "\"
                 src=\"";
            // line 101
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/display_field.png"], "method", false, false, false, 101), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 103
            echo _gettext("Choose column to display");
            // line 104
            echo "            </span>
        </a>
        <a href=\"#\" id=\"reloadPage\" class=\"M_butt\">
            <img title=\"";
            // line 107
            echo _gettext("Reload");
            echo "\"
                 src=\"";
            // line 108
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/reload.png"], "method", false, false, false, 108), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 110
            echo _gettext("Reload");
            // line 111
            echo "            </span>
        </a>
        <a href=\"";
            // line 113
            echo PhpMyAdmin\Util::getDocuLink("faq", "faq6-31");
            echo "\"
           target=\"documentation\"
           class=\"M_butt\">
            <img title=\"";
            // line 116
            echo _gettext("Help");
            echo "\"
                 src=\"";
            // line 117
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/help.png"], "method", false, false, false, 117), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 119
            echo _gettext("Help");
            // line 120
            echo "            </span>
        </a>
    ";
        }
        // line 123
        echo "    <a href=\"#\" class=\"";
        echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["params_array"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["angular_direct"] ?? null) : null), "html", null, true);
        echo "\" id=\"angular_direct_button\">
        <img title=\"";
        // line 124
        echo _gettext("Angular links");
        echo " / ";
        echo _gettext("Direct links");
        echo "\"
             src=\"";
        // line 125
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/ang_direct.png"], "method", false, false, false, 125), "html", null, true);
        echo "\">
        <span class=\"hide hidable\">
            ";
        // line 127
        echo _gettext("Angular links");
        echo " / ";
        echo _gettext("Direct links");
        // line 128
        echo "        </span>
    </a>
    <a href=\"#\" class=\"";
        // line 130
        echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["params_array"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["snap_to_grid"] ?? null) : null), "html", null, true);
        echo "\" id=\"grid_button\">
        <img title=\"";
        // line 131
        echo _gettext("Snap to grid");
        echo "\" src=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/grid.png"], "method", false, false, false, 131), "html", null, true);
        echo "\">
        <span class=\"hide hidable\">
            ";
        // line 133
        echo _gettext("Snap to grid");
        // line 134
        echo "        </span>
    </a>
    <a href=\"#\" class=\"";
        // line 136
        echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = ($context["params_array"] ?? null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["small_big_all"] ?? null) : null), "html", null, true);
        echo "\" id=\"key_SB_all\">
        <img title=\"";
        // line 137
        echo _gettext("Small/Big All");
        echo "\"
             alt=\"v\"
             src=\"";
        // line 139
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/downarrow1.png"], "method", false, false, false, 139), "html", null, true);
        echo "\"
             data-down=\"";
        // line 140
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/downarrow1.png"], "method", false, false, false, 140), "html", null, true);
        echo "\"
             data-right=\"";
        // line 141
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/rightarrow1.png"], "method", false, false, false, 141), "html", null, true);
        echo "\">
        <span class=\"hide hidable\">
            ";
        // line 143
        echo _gettext("Small/Big All");
        // line 144
        echo "        </span>
    </a>
    <a href=\"#\" id=\"SmallTabInvert\" class=\"M_butt\">
        <img title=\"";
        // line 147
        echo _gettext("Toggle small/big");
        echo "\"
             src=\"";
        // line 148
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/bottom.png"], "method", false, false, false, 148), "html", null, true);
        echo "\">
        <span class=\"hide hidable\">
            ";
        // line 150
        echo _gettext("Toggle small/big");
        // line 151
        echo "        </span>
    </a>
    <a href=\"#\" id=\"relLineInvert\" class=\"";
        // line 153
        echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["params_array"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["relation_lines"] ?? null) : null), "html", null, true);
        echo "\" >
        <img title=\"";
        // line 154
        echo _gettext("Toggle relationship lines");
        echo "\"
             src=\"";
        // line 155
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/toggle_lines.png"], "method", false, false, false, 155), "html", null, true);
        echo "\">
        <span class=\"hide hidable\">
            ";
        // line 157
        echo _gettext("Toggle relationship lines");
        // line 158
        echo "        </span>
    </a>
    ";
        // line 160
        if ( !($context["visual_builder"] ?? null)) {
            // line 161
            echo "        <a href=\"#\" id=\"exportPages\" class=\"M_butt\" >
            <img title=\"";
            // line 162
            echo _gettext("Export schema");
            echo "\"
                 src=\"";
            // line 163
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/export.png"], "method", false, false, false, 163), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 165
            echo _gettext("Export schema");
            // line 166
            echo "            </span>
        </a>
    ";
        } else {
            // line 169
            echo "        <a id=\"build_query_button\"
           class=\"M_butt\"
           href=\"#\"
           class=\"M_butt\">
            <img title=\"";
            // line 173
            echo _gettext("Build Query");
            echo "\"
                 src=\"";
            // line 174
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/query_builder.png"], "method", false, false, false, 174), "html", null, true);
            echo "\">
            <span class=\"hide hidable\">
                ";
            // line 176
            echo _gettext("Build Query");
            // line 177
            echo "            </span>
        </a>
    ";
        }
        // line 180
        echo "    <a href=\"#\" class=\"";
        echo twig_escape_filter($this->env, (($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = ($context["params_array"] ?? null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["side_menu"] ?? null) : null), "html", null, true);
        echo "\" id=\"key_Left_Right\">
        <img title=\"";
        // line 181
        echo _gettext("Move Menu");
        echo "\" alt=\">\"
             data-right=\"";
        // line 182
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/2leftarrow_m.png"], "method", false, false, false, 182), "html", null, true);
        echo "\"
             src=\"";
        // line 183
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/2rightarrow_m.png"], "method", false, false, false, 183), "html", null, true);
        echo "\">
        <span class=\"hide hidable\">
            ";
        // line 185
        echo _gettext("Move Menu");
        // line 186
        echo "        </span>
    </a>
    <a href=\"#\" class=\"";
        // line 188
        echo twig_escape_filter($this->env, (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = ($context["params_array"] ?? null)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["pin_text"] ?? null) : null), "html", null, true);
        echo "\" id=\"pin_Text\">
        <img title=\"";
        // line 189
        echo _gettext("Pin text");
        echo "\"
             alt=\">\"
             data-right=\"";
        // line 191
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/anchor.png"], "method", false, false, false, 191), "html", null, true);
        echo "\"
             src=\"";
        // line 192
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/anchor.png"], "method", false, false, false, 192), "html", null, true);
        echo "\">
        <span class=\"hide hidable\">
            ";
        // line 194
        echo _gettext("Pin text");
        // line 195
        echo "        </span>
    </a>
</div>
<div id=\"canvas_outer\">
    <form action=\"\" id=\"container-form\" method=\"post\" name=\"form1\">
        <div id=\"osn_tab\">
            <canvas class=\"designer\" id=\"canvas\" width=\"100\" height=\"100\"></canvas>
        </div>
        <div id=\"layer_menu\" class=\"hide\">
            <div class=\"center\">
                <a href=\"#\" class=\"M_butt\" target=\"_self\" >
                    <img title=\"";
        // line 206
        echo _gettext("Hide/Show all");
        echo "\"
                        alt=\"v\"
                        id=\"key_HS_all\"
                        src=\"";
        // line 209
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/downarrow1.png"], "method", false, false, false, 209), "html", null, true);
        echo "\"
                        data-down=\"";
        // line 210
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/downarrow1.png"], "method", false, false, false, 210), "html", null, true);
        echo "\"
                        data-right=\"";
        // line 211
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/rightarrow1.png"], "method", false, false, false, 211), "html", null, true);
        echo "\">
                </a>
                <a href=\"#\" class=\"M_butt\" target=\"_self\" >
                    <img alt=\"v\"
                        id=\"key_HS\"
                        title=\"";
        // line 216
        echo _gettext("Hide/Show tables with no relationship");
        echo "\"
                        src=\"";
        // line 217
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/downarrow2.png"], "method", false, false, false, 217), "html", null, true);
        echo "\"
                        data-down=\"";
        // line 218
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/downarrow2.png"], "method", false, false, false, 218), "html", null, true);
        echo "\"
                        data-right=\"";
        // line 219
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/rightarrow2.png"], "method", false, false, false, 219), "html", null, true);
        echo "\">
                </a>
            </div>
            <div id=\"id_scroll_tab\" class=\"scroll_tab\">
                <table width=\"100%\" style=\"padding-left: 3px;\"></table>
            </div>
            ";
        // line 226
        echo "            <div class=\"center\">
                ";
        // line 227
        echo _gettext("Number of tables:");
        echo " <span id=\"tables_counter\">0</span>
            </div>
            <div id=\"layer_menu_sizer\">
                <div class=\"floatleft\">
                    <img class=\"icon\"
                        data-right=\"";
        // line 232
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/resizeright.png"], "method", false, false, false, 232), "html", null, true);
        echo "\"
                        src=\"";
        // line 233
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getImgPath", [0 => "designer/resize.png"], "method", false, false, false, 233), "html", null, true);
        echo "\">
                </div>
            </div>
        </div>
        ";
        // line 238
        echo "        ";
        $this->loadTemplate("database/designer/database_tables.twig", "database/designer/main.twig", 238)->display(twig_to_array(["db" =>         // line 239
($context["db"] ?? null), "get_db" =>         // line 240
($context["get_db"] ?? null), "has_query" =>         // line 241
($context["has_query"] ?? null), "tab_pos" =>         // line 242
($context["tab_pos"] ?? null), "display_page" =>         // line 243
($context["display_page"] ?? null), "tab_column" =>         // line 244
($context["tab_column"] ?? null), "tables_all_keys" =>         // line 245
($context["tables_all_keys"] ?? null), "tables_pk_or_unique_keys" =>         // line 246
($context["tables_pk_or_unique_keys"] ?? null), "columns_type" =>         // line 247
($context["columns_type"] ?? null), "tables" =>         // line 248
($context["designerTables"] ?? null), "theme" =>         // line 249
($context["theme"] ?? null)]));
        // line 251
        echo "    </form>
</div>
<div id=\"designer_hint\"></div>
";
        // line 255
        echo "<table id=\"layer_new_relation\" class=\"hide\" width=\"5%\" cellpadding=\"0\" cellspacing=\"0\">
    <tbody>
        <tr>
            <td class=\"frams1\" width=\"10px\">
            </td>
            <td class=\"frams5\" width=\"99%\" >
            </td>
            <td class=\"frams2\" width=\"10px\">
                <div class=\"bor\">
                </div>
            </td>
        </tr>
        <tr>
            <td class=\"frams8\">
            </td>
            <td class=\"input_tab\">
                <table width=\"168\" class=\"center\" cellpadding=\"2\" cellspacing=\"0\">
                    <thead>
                        <tr>
                            <td colspan=\"2\" class=\"center nowrap\">
                                <strong>
                                    ";
        // line 276
        echo _gettext("Create relationship");
        // line 277
        echo "                                </strong>
                            </td>
                        </tr>
                    </thead>
                    <tbody id=\"foreign_relation\">
                        <tr>
                            <td colspan=\"2\" class=\"center nowrap\">
                                <strong>
                                    FOREIGN KEY
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td width=\"58\" class=\"nowrap\">
                                on delete
                            </td>
                            <td width=\"102\">
                                <select name=\"on_delete\" id=\"on_delete\">
                                    <option value=\"nix\" selected=\"selected\">
                                        --
                                    </option>
                                    <option value=\"CASCADE\">
                                        CASCADE
                                    </option>
                                    <option value=\"SET NULL\">
                                        SET NULL
                                    </option>
                                    <option value=\"NO ACTION\">
                                        NO ACTION
                                    </option>
                                    <option value=\"RESTRICT\">
                                        RESTRICT
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class=\"nowrap\">
                                on update
                            </td>
                            <td>
                                <select name=\"on_update\" id=\"on_update\">
                                    <option value=\"nix\" selected=\"selected\">
                                        --
                                    </option>
                                    <option value=\"CASCADE\">
                                        CASCADE
                                    </option>
                                    <option value=\"SET NULL\">
                                        SET NULL
                                    </option>
                                    <option value=\"NO ACTION\">
                                        NO ACTION
                                    </option>
                                    <option value=\"RESTRICT\">
                                        RESTRICT
                                    </option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan=\"2\" class=\"center nowrap\">
                                <input type=\"button\" id=\"ok_new_rel_panel\" class=\"btn btn-secondary butt\"
                                    name=\"Button\" value=\"";
        // line 342
        echo _gettext("OK");
        echo "\">
                                <input type=\"button\" id=\"cancel_new_rel_panel\"
                                    class=\"btn btn-secondary butt\" name=\"Button\" value=\"";
        // line 344
        echo _gettext("Cancel");
        echo "\">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td class=\"frams6\">
            </td>
        </tr>
        <tr>
            <td class=\"frams4\">
                <div class=\"bor\">
                </div>
            </td>
            <td class=\"frams7\">
            </td>
            <td class=\"frams3\">
            </td>
        </tr>
    </tbody>
</table>
";
        // line 366
        echo "<table id=\"layer_upd_relation\" class=\"hide\" width=\"5%\" cellpadding=\"0\" cellspacing=\"0\">
    <tbody>
        <tr>
            <td class=\"frams1\" width=\"10px\">
            </td>
            <td class=\"frams5\" width=\"99%\">
            </td>
            <td class=\"frams2\" width=\"10px\">
                <div class=\"bor\">
                </div>
            </td>
        </tr>
        <tr>
            <td class=\"frams8\">
            </td>
            <td class=\"input_tab\">
                <table width=\"100%\" class=\"center\" cellpadding=\"2\" cellspacing=\"0\">
                    <tr>
                        <td colspan=\"3\" class=\"center nowrap\">
                            <strong>
                                ";
        // line 386
        echo _gettext("Delete relationship");
        // line 387
        echo "                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"3\" class=\"center nowrap\">
                            <input id=\"del_button\" name=\"Button\" type=\"button\"
                                class=\"btn btn-secondary butt\" value=\"";
        // line 393
        echo _gettext("Delete");
        echo "\">
                            <input id=\"cancel_button\" type=\"button\" class=\"btn btn-secondary butt\"
                                name=\"Button\" value=\"";
        // line 395
        echo _gettext("Cancel");
        echo "\">
                        </td>
                    </tr>
                </table>
            </td>
            <td class=\"frams6\">
            </td>
        </tr>
        <tr>
            <td class=\"frams4\">
                <div class=\"bor\">
                </div>
            </td>
            <td class=\"frams7\">
            </td>
            <td class=\"frams3\">
            </td>
        </tr>
    </tbody>
</table>
";
        // line 415
        if (($context["has_query"] ?? null)) {
            // line 416
            echo "    ";
            // line 417
            echo "    <table id=\"designer_optionse\" class=\"hide\" width=\"5%\" cellpadding=\"0\" cellspacing=\"0\">
        <tbody>
            <tr>
                <td class=\"frams1\" width=\"10px\">
                </td>
                <td class=\"frams5\" width=\"99%\" >
                </td>
                <td class=\"frams2\" width=\"10px\">
                    <div class=\"bor\">
                    </div>
                </td>
            </tr>
            <tr>
                <td class=\"frams8\">
                </td>
                <td class=\"input_tab\">
                    <table width=\"168\" class=\"center\" cellpadding=\"2\" cellspacing=\"0\">
                        <thead>
                            <tr>
                                <td colspan=\"2\" rowspan=\"2\" id=\"option_col_name\" class=\"center nowrap\">
                                </td>
                            </tr>
                        </thead>
                        <tbody id=\"where\">
                            <tr>
                                <td class=\"center nowrap\">
                                    <b>
                                        WHERE
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"58\" class=\"nowrap\">
                                    ";
            // line 450
            echo _gettext("Relationship operator");
            // line 451
            echo "                                </td>
                                <td width=\"102\">
                                    <select name=\"rel_opt\" id=\"rel_opt\">
                                        <option value=\"--\" selected=\"selected\">
                                            --
                                        </option>
                                        <option value=\"=\">
                                            =
                                        </option>
                                        <option value=\"&gt;\">
                                            &gt;
                                        </option>
                                        <option value=\"&lt;\">
                                            &lt;
                                        </option>
                                        <option value=\"&gt;=\">
                                            &gt;=
                                        </option>
                                        <option value=\"&lt;=\">
                                            &lt;=
                                        </option>
                                        <option value=\"NOT\">
                                            NOT
                                        </option>
                                        <option value=\"IN\">
                                            IN
                                        </option>
                                        <option value=\"EXCEPT\">
                                            ";
            // line 479
            echo _gettext("Except");
            // line 480
            echo "                                        </option>
                                        <option value=\"NOT IN\">
                                            NOT IN
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class=\"nowrap\">
                                    ";
            // line 489
            echo _gettext("Value");
            // line 490
            echo "                                    <br>
                                    ";
            // line 491
            echo _gettext("subquery");
            // line 492
            echo "                                </td>
                                <td>
                                    <textarea id=\"Query\" cols=\"18\"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class=\"center nowrap\">
                                    <b>
                                        ";
            // line 500
            echo _gettext("Rename to");
            // line 501
            echo "                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"58\" class=\"nowrap\">
                                    ";
            // line 506
            echo _gettext("New name");
            // line 507
            echo "                                </td>
                                <td width=\"102\">
                                    <input type=\"text\" id=\"new_name\">
                                </td>
                            </tr>
                            <tr>
                                <td class=\"center nowrap\">
                                    <b>
                                        ";
            // line 515
            echo _gettext("Aggregate");
            // line 516
            echo "                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"58\" class=\"nowrap\">
                                    ";
            // line 521
            echo _gettext("Operator");
            // line 522
            echo "                                </td>
                                <td width=\"102\">
                                    <select name=\"operator\" id=\"operator\">
                                        <option value=\"---\" selected=\"selected\">
                                            ---
                                        </option>
                                        <option value=\"sum\" >
                                            SUM
                                        </option>
                                        <option value=\"min\">
                                            MIN
                                        </option>
                                        <option value=\"max\">
                                            MAX
                                        </option>
                                        <option value=\"avg\">
                                            AVG
                                        </option>
                                        <option value=\"count\">
                                            COUNT
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"58\" class=\"center nowrap\">
                                    <b>
                                        GROUP BY
                                    </b>
                                </td>
                                <td>
                                    <input type=\"checkbox\" value=\"groupby\" id=\"groupby\">
                                </td>
                            </tr>
                            <tr>
                                <td width=\"58\" class=\"center nowrap\">
                                    <b>
                                        ORDER BY
                                    </b>
                                </td>
                                <td>
                                    <select name=\"orderby\" id=\"orderby\">
                                        <option value=\"---\" selected=\"selected\">
                                            ---
                                        </option>
                                        <option value=\"ASC\" >
                                            ASC
                                        </option>
                                        <option value=\"DESC\">
                                            DESC
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class=\"center nowrap\">
                                    <b>
                                        HAVING
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"58\" class=\"nowrap\">
                                    ";
            // line 585
            echo _gettext("Operator");
            // line 586
            echo "                                </td>
                                <td width=\"102\">
                                    <select name=\"h_operator\" id=\"h_operator\">
                                        <option value=\"---\" selected=\"selected\">
                                            ---
                                        </option>
                                        <option value=\"None\" >
                                            ";
            // line 593
            echo _gettext("None");
            // line 594
            echo "                                        </option>
                                        <option value=\"sum\" >
                                            SUM
                                        </option>
                                        <option value=\"min\">
                                            MIN
                                        </option>
                                        <option value=\"max\">
                                            MAX
                                        </option>
                                        <option value=\"avg\">
                                            AVG
                                        </option>
                                        <option value=\"count\">
                                            COUNT
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"58\" class=\"nowrap\">
                                    ";
            // line 615
            echo _gettext("Relationship operator");
            // line 616
            echo "                                </td>
                                <td width=\"102\">
                                    <select name=\"h_rel_opt\" id=\"h_rel_opt\">
                                        <option value=\"--\" selected=\"selected\">
                                            --
                                        </option>
                                        <option value=\"=\">
                                            =
                                        </option>
                                        <option value=\"&gt;\">
                                            &gt;
                                        </option>
                                        <option value=\"&lt;\">
                                            &lt;
                                        </option>
                                        <option value=\"&gt;=\">
                                            &gt;=
                                        </option>
                                        <option value=\"&lt;=\">
                                            &lt;=
                                        </option>
                                        <option value=\"NOT\">
                                            NOT
                                        </option>
                                        <option value=\"IN\">
                                            IN
                                        </option>
                                        <option value=\"EXCEPT\">
                                            ";
            // line 644
            echo _gettext("Except");
            // line 645
            echo "                                        </option>
                                        <option value=\"NOT IN\">
                                            NOT IN
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"58\" class=\"nowrap\">
                                    ";
            // line 654
            echo _gettext("Value");
            // line 655
            echo "                                    <br>
                                    ";
            // line 656
            echo _gettext("subquery");
            // line 657
            echo "                                </td>
                                <td width=\"102\">
                                    <textarea id=\"having\" cols=\"18\"></textarea>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan=\"2\" class=\"center nowrap\">
                                    <input type=\"hidden\" id=\"ok_add_object_db_and_table_name_url\" />
                                    <input type=\"hidden\" id=\"ok_add_object_db_name\" />
                                    <input type=\"hidden\" id=\"ok_add_object_table_name\" />
                                    <input type=\"hidden\" id=\"ok_add_object_col_name\" />
                                    <input type=\"button\" id=\"ok_add_object\" class=\"btn btn-secondary butt\"
                                        name=\"Button\" value=\"";
            // line 671
            echo _gettext("OK");
            echo "\">
                                    <input type=\"button\" id=\"cancel_close_option\" class=\"btn btn-secondary butt\"
                                        name=\"Button\" value=\"";
            // line 673
            echo _gettext("Cancel");
            echo "\">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class=\"frams6\">
                </td>
            </tr>
            <tr>
                <td class=\"frams4\">
                    <div class=\"bor\">
                    </div>
                </td>
                <td class=\"frams7\">
                </td>
                <td class=\"frams3\">
                </td>
            </tr>
        </tbody>
    </table>
    ";
            // line 695
            echo "    <table id=\"query_rename_to\" class=\"hide\" width=\"5%\" cellpadding=\"0\" cellspacing=\"0\">
        <tbody>
            <tr>
                <td class=\"frams1\" width=\"10px\">
                </td>
                <td class=\"frams5\" width=\"99%\" >
                </td>
                <td class=\"frams2\" width=\"10px\">
                    <div class=\"bor\">
                    </div>
                </td>
            </tr>
            <tr>
                <td class=\"frams8\">
                </td>
                <td class=\"input_tab\">
                    <table width=\"168\" class=\"center\" cellpadding=\"2\" cellspacing=\"0\">
                        <thead>
                            <tr>
                                <td colspan=\"2\" class=\"center nowrap\">
                                    <strong>
                                        ";
            // line 716
            echo _gettext("Rename to");
            // line 717
            echo "                                    </strong>
                                </td>
                            </tr>
                        </thead>
                        <tbody id=\"rename_to\">
                            <tr>
                                <td width=\"58\" class=\"nowrap\">
                                    ";
            // line 724
            echo _gettext("New name");
            // line 725
            echo "                                </td>
                                <td width=\"102\">
                                    <input type=\"text\" id=\"e_rename\">
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan=\"2\" class=\"center nowrap\">
                                    <input type=\"button\" id=\"ok_edit_rename\" class=\"btn btn-secondary butt\"
                                        name=\"Button\" value=\"";
            // line 735
            echo _gettext("OK");
            echo "\">
                                    <input id=\"query_rename_to_button\" type=\"button\"
                                        class=\"btn btn-secondary butt\"
                                        name=\"Button\"
                                        value=\"";
            // line 739
            echo _gettext("Cancel");
            echo "\">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class=\"frams6\">
                </td>
            </tr>
            <tr>
                <td class=\"frams4\">
                    <div class=\"bor\">
                    </div>
                </td>
                <td class=\"frams7\">
                </td>
                <td class=\"frams3\">
                </td>
            </tr>
        </tbody>
    </table>
    ";
            // line 761
            echo "    <table id=\"query_having\" class=\"hide\" width=\"5%\" cellpadding=\"0\" cellspacing=\"0\">
        <tbody>
            <tr>
                <td class=\"frams1\" width=\"10px\">
                </td>
                <td class=\"frams5\" width=\"99%\" >
                </td>
                <td class=\"frams2\" width=\"10px\">
                    <div class=\"bor\">
                    </div>
                </td>
            </tr>
            <tr>
                <td class=\"frams8\">
                </td>
                <td class=\"input_tab\">
                    <table width=\"168\" class=\"center\" cellpadding=\"2\" cellspacing=\"0\">
                        <thead>
                            <tr>
                                <td colspan=\"2\" class=\"center nowrap\">
                                    <strong>
                                        HAVING
                                    </strong>
                                </td>
                            </tr>
                        </thead>
                        <tbody id=\"rename_to\">
                            <tr>
                                <td width=\"58\" class=\"nowrap\">
                                    ";
            // line 790
            echo _gettext("Operator");
            // line 791
            echo "                                </td>
                                <td width=\"102\">
                                    <select name=\"hoperator\" id=\"hoperator\">
                                        <option value=\"---\" selected=\"selected\">
                                            ---
                                        </option>
                                        <option value=\"None\" >
                                            None
                                        </option>
                                        <option value=\"sum\" >
                                            SUM
                                        </option>
                                        <option value=\"min\">
                                            MIN
                                        </option>
                                        <option value=\"max\">
                                            MAX
                                        </option>
                                        <option value=\"avg\">
                                            AVG
                                        </option>
                                        <option value=\"count\">
                                            COUNT
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <tr>
                                    <td width=\"58\" class=\"nowrap\">
                                        ";
            // line 821
            echo _gettext("Operator");
            // line 822
            echo "                                    </td>
                                    <td width=\"102\">
                                        <select name=\"hrel_opt\" id=\"hrel_opt\">
                                            <option value=\"--\" selected=\"selected\">
                                                --
                                            </option>
                                            <option value=\"=\">
                                                =
                                            </option>
                                            <option value=\"&gt;\">
                                                &gt;
                                            </option>
                                            <option value=\"&lt;\">
                                                &lt;
                                            </option>
                                            <option value=\"&gt;=\">
                                                &gt;=
                                            </option>
                                            <option value=\"&lt;=\">
                                                &lt;=
                                            </option>
                                            <option value=\"NOT\">
                                                NOT
                                            </option>
                                            <option value=\"IN\">
                                                IN
                                            </option>
                                            <option value=\"EXCEPT\">
                                                ";
            // line 850
            echo _gettext("Except");
            // line 851
            echo "                                            </option>
                                            <option value=\"NOT IN\">
                                                NOT IN
                                            </option>
                                        </select>
                                    </td>
                            </tr>
                            <tr>
                                <td class=\"nowrap\">
                                    ";
            // line 860
            echo _gettext("Value");
            // line 861
            echo "                                    <br>
                                    ";
            // line 862
            echo _gettext("subquery");
            // line 863
            echo "                                </td>
                                <td>
                                    <textarea id=\"hQuery\" cols=\"18\">
                                    </textarea>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan=\"2\" class=\"center nowrap\">
                                    <input type=\"button\" id=\"ok_edit_having\" class=\"btn btn-secondary butt\"
                                        name=\"Button\" value=\"";
            // line 874
            echo _gettext("OK");
            echo "\">
                                    <input id=\"query_having_button\" type=\"button\"
                                        class=\"btn btn-secondary butt\"
                                        name=\"Button\"
                                        value=\"";
            // line 878
            echo _gettext("Cancel");
            echo "\">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class=\"frams6\">
                </td>
            </tr>
            <tr>
                <td class=\"frams4\">
                    <div class=\"bor\">
                    </div>
                </td>
                <td class=\"frams7\">
                </td>
                <td class=\"frams3\">
                </td>
            </tr>
        </tbody>
    </table>
    ";
            // line 900
            echo "    <table id=\"query_Aggregate\" class=\"hide\" width=\"5%\" cellpadding=\"0\" cellspacing=\"0\">
        <tbody>
            <tr>
                <td class=\"frams1\" width=\"10px\">
                </td>
                <td class=\"frams5\" width=\"99%\" >
                </td>
                <td class=\"frams2\" width=\"10px\">
                    <div class=\"bor\">
                    </div>
                </td>
            </tr>
            <tr>
                <td class=\"frams8\">
                </td>
                <td class=\"input_tab\">
                    <table width=\"168\" class=\"center\" cellpadding=\"2\" cellspacing=\"0\">
                        <thead>
                            <tr>
                                <td colspan=\"2\" class=\"center nowrap\">
                                    <strong>
                                        ";
            // line 921
            echo _gettext("Aggregate");
            // line 922
            echo "                                    </strong>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width=\"58\" class=\"nowrap\">
                                    ";
            // line 929
            echo _gettext("Operator");
            // line 930
            echo "                                </td>
                                <td width=\"102\">
                                    <select name=\"operator\" id=\"e_operator\">
                                        <option value=\"---\" selected=\"selected\">
                                            ---
                                        </option>
                                        <option value=\"sum\" >
                                            SUM
                                        </option>
                                        <option value=\"min\">
                                            MIN
                                        </option>
                                        <option value=\"max\">
                                            MAX
                                        </option>
                                        <option value=\"avg\">
                                            AVG
                                        </option>
                                        <option value=\"count\">
                                            COUNT
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan=\"2\" class=\"center nowrap\">
                                    <input type=\"button\" id=\"ok_edit_Aggr\" class=\"btn btn-secondary butt\"
                                        name=\"Button\" value=\"";
            // line 959
            echo _gettext("OK");
            echo "\">
                                    <input id=\"query_Aggregate_Button\" type=\"button\"
                                        class=\"btn btn-secondary butt\"
                                        name=\"Button\"
                                        value=\"";
            // line 963
            echo _gettext("Cancel");
            echo "\">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class=\"frams6\">
                </td>
            </tr>
            <tr>
                <td class=\"frams4\">
                    <div class=\"bor\">
                    </div>
                </td>
                <td class=\"frams7\">
                </td>
                <td class=\"frams3\">
                </td>
            </tr>
        </tbody>
    </table>
    ";
            // line 985
            echo "    <table id=\"query_where\" class=\"hide\" width=\"5%\" cellpadding=\"0\" cellspacing=\"0\">
        <tbody>
            <tr>
                <td class=\"frams1\" width=\"10px\">
                </td>
                <td class=\"frams5\" width=\"99%\" >
                </td>
                <td class=\"frams2\" width=\"10px\">
                    <div class=\"bor\">
                    </div>
                </td>
            </tr>
            <tr>
                <td class=\"frams8\">
                </td>
                <td class=\"input_tab\">
                    <table width=\"168\" class=\"center\" cellpadding=\"2\" cellspacing=\"0\">
                        <thead>
                            <tr>
                                <td colspan=\"2\" class=\"center nowrap\">
                                    <strong>
                                        WHERE
                                    </strong>
                                </td>
                            </tr>
                        </thead>
                        <tbody id=\"rename_to\">
                            <tr>
                                <td width=\"58\" class=\"nowrap\">
                                    ";
            // line 1014
            echo _gettext("Operator");
            // line 1015
            echo "                                </td>
                                <td width=\"102\">
                                    <select name=\"erel_opt\" id=\"erel_opt\">
                                        <option value=\"--\" selected=\"selected\">
                                            --
                                        </option>
                                        <option value=\"=\" >
                                            =
                                        </option>
                                        <option value=\"&gt;\">
                                            &gt;
                                        </option>
                                        <option value=\"&lt;\">
                                            &lt;
                                        </option>
                                        <option value=\"&gt;=\">
                                            &gt;=
                                        </option>
                                        <option value=\"&lt;=\">
                                            &lt;=
                                        </option>
                                        <option value=\"NOT\">
                                            NOT
                                        </option>
                                        <option value=\"IN\">
                                            IN
                                        </option>
                                        <option value=\"EXCEPT\">
                                            ";
            // line 1043
            echo _gettext("Except");
            // line 1044
            echo "                                        </option>
                                        <option value=\"NOT IN\">
                                            NOT IN
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class=\"nowrap\">
                                    ";
            // line 1053
            echo _gettext("Value");
            // line 1054
            echo "                                    <br>
                                    ";
            // line 1055
            echo _gettext("subquery");
            // line 1056
            echo "                                </td>
                                <td>
                                    <textarea id=\"eQuery\" cols=\"18\">
                                    </textarea>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan=\"2\" class=\"center nowrap\">
                                    <input type=\"button\" id=\"ok_edit_where\" class=\"btn btn-secondary butt\"
                                        name=\"Button\" value=\"";
            // line 1067
            echo _gettext("OK");
            echo "\">
                                    <input id=\"query_where_button\" type=\"button\" class=\"btn btn-secondary butt\" name=\"Button\"
                                           value=\"";
            // line 1069
            echo _gettext("Cancel");
            echo "\">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class=\"frams6\">
                </td>
            </tr>
            <tr>
                <td class=\"frams4\">
                    <div class=\"bor\">
                    </div>
                </td>
                <td class=\"frams7\">
                </td>
                <td class=\"frams3\">
                </td>
            </tr>
        </tbody>
    </table>
    ";
            // line 1091
            echo "    <div class=\"panel\">
        <div class=\"clearfloat\"></div>
        <div id=\"ab\"></div>
        <div class=\"clearfloat\"></div>
    </div>
    <a class=\"trigger\" href=\"#\">";
            // line 1096
            echo _gettext("Active options");
            echo "</a>
    <div id=\"box\">
        <form method=\"post\" action=\"db_qbe.php\" id=\"vqb_form\">
            <textarea cols=\"80\" name=\"sql_query\" id=\"textSqlquery\" rows=\"15\"></textarea>
            <input type=\"hidden\" name=\"submit_sql\" value=\"true\">
            ";
            // line 1101
            echo PhpMyAdmin\Url::getHiddenInputs(($context["get_db"] ?? null));
            echo "
        </form>
    </div>
";
        }
        // line 1105
        echo "<div id=\"PMA_disable_floating_menubar\"></div>
";
    }

    public function getTemplateName()
    {
        return "database/designer/main.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1604 => 1105,  1597 => 1101,  1589 => 1096,  1582 => 1091,  1558 => 1069,  1553 => 1067,  1540 => 1056,  1538 => 1055,  1535 => 1054,  1533 => 1053,  1522 => 1044,  1520 => 1043,  1490 => 1015,  1488 => 1014,  1457 => 985,  1433 => 963,  1426 => 959,  1395 => 930,  1393 => 929,  1384 => 922,  1382 => 921,  1359 => 900,  1335 => 878,  1328 => 874,  1315 => 863,  1313 => 862,  1310 => 861,  1308 => 860,  1297 => 851,  1295 => 850,  1265 => 822,  1263 => 821,  1231 => 791,  1229 => 790,  1198 => 761,  1174 => 739,  1167 => 735,  1155 => 725,  1153 => 724,  1144 => 717,  1142 => 716,  1119 => 695,  1095 => 673,  1090 => 671,  1074 => 657,  1072 => 656,  1069 => 655,  1067 => 654,  1056 => 645,  1054 => 644,  1024 => 616,  1022 => 615,  999 => 594,  997 => 593,  988 => 586,  986 => 585,  921 => 522,  919 => 521,  912 => 516,  910 => 515,  900 => 507,  898 => 506,  891 => 501,  889 => 500,  879 => 492,  877 => 491,  874 => 490,  872 => 489,  861 => 480,  859 => 479,  829 => 451,  827 => 450,  792 => 417,  790 => 416,  788 => 415,  765 => 395,  760 => 393,  752 => 387,  750 => 386,  728 => 366,  704 => 344,  699 => 342,  632 => 277,  630 => 276,  607 => 255,  602 => 251,  600 => 249,  599 => 248,  598 => 247,  597 => 246,  596 => 245,  595 => 244,  594 => 243,  593 => 242,  592 => 241,  591 => 240,  590 => 239,  588 => 238,  581 => 233,  577 => 232,  569 => 227,  566 => 226,  557 => 219,  553 => 218,  549 => 217,  545 => 216,  537 => 211,  533 => 210,  529 => 209,  523 => 206,  510 => 195,  508 => 194,  503 => 192,  499 => 191,  494 => 189,  490 => 188,  486 => 186,  484 => 185,  479 => 183,  475 => 182,  471 => 181,  466 => 180,  461 => 177,  459 => 176,  454 => 174,  450 => 173,  444 => 169,  439 => 166,  437 => 165,  432 => 163,  428 => 162,  425 => 161,  423 => 160,  419 => 158,  417 => 157,  412 => 155,  408 => 154,  404 => 153,  400 => 151,  398 => 150,  393 => 148,  389 => 147,  384 => 144,  382 => 143,  377 => 141,  373 => 140,  369 => 139,  364 => 137,  360 => 136,  356 => 134,  354 => 133,  347 => 131,  343 => 130,  339 => 128,  335 => 127,  330 => 125,  324 => 124,  319 => 123,  314 => 120,  312 => 119,  307 => 117,  303 => 116,  297 => 113,  293 => 111,  291 => 110,  286 => 108,  282 => 107,  277 => 104,  275 => 103,  270 => 101,  266 => 100,  261 => 97,  259 => 96,  254 => 94,  250 => 93,  245 => 90,  243 => 89,  238 => 87,  234 => 86,  229 => 83,  227 => 82,  222 => 80,  218 => 79,  213 => 76,  211 => 75,  206 => 73,  202 => 72,  197 => 69,  195 => 68,  190 => 66,  186 => 65,  181 => 62,  179 => 61,  174 => 59,  170 => 58,  165 => 55,  163 => 54,  158 => 52,  153 => 50,  150 => 49,  148 => 48,  144 => 46,  142 => 45,  137 => 43,  133 => 42,  128 => 39,  126 => 38,  122 => 37,  118 => 36,  113 => 34,  109 => 33,  105 => 32,  101 => 31,  96 => 28,  94 => 27,  89 => 25,  85 => 24,  81 => 23,  76 => 21,  72 => 19,  65 => 15,  59 => 12,  55 => 10,  53 => 9,  50 => 7,  48 => 2,  42 => 4,  39 => 3,  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("", "database/designer/main.twig", "C:\\xampp\\htdocs\\connect\\templates\\database\\designer\\main.twig");
    }
}
