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

/* display/export/select_options.twig */
class __TwigTemplate_d628c5a4cb2ac12c142352bde3e884704430699478bc23f50a73e41aa6fd799b extends \Twig\Template
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
        echo "<div>
    <p>
        <a href=\"#\" onclick=\"Functions.setSelectOptions('dump', 'db_select[]', true); return false;\">
            ";
        // line 4
        echo _gettext("Select all");
        // line 5
        echo "        </a>
        /
        <a href=\"#\" onclick=\"Functions.setSelectOptions('dump', 'db_select[]', false); return false;\">
            ";
        // line 8
        echo _gettext("Unselect all");
        // line 9
        echo "        </a>
    </p>

    <select name=\"db_select[]\" id=\"db_select\" size=\"10\" multiple>
        ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["databases"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["database"]) {
            // line 14
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["database"], "name", [], "any", false, false, false, 14), "html", null, true);
            echo "\"";
            echo ((twig_get_attribute($this->env, $this->source, $context["database"], "is_selected", [], "any", false, false, false, 14)) ? (" selected") : (""));
            echo ">
                ";
            // line 15
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["database"], "name", [], "any", false, false, false, 15), "html", null, true);
            echo "
            </option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['database'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "    </select>
</div>
";
    }

    public function getTemplateName()
    {
        return "display/export/select_options.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 18,  68 => 15,  61 => 14,  57 => 13,  51 => 9,  49 => 8,  44 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "display/export/select_options.twig", "C:\\xampp\\htdocs\\connect\\templates\\display\\export\\select_options.twig");
    }
}
