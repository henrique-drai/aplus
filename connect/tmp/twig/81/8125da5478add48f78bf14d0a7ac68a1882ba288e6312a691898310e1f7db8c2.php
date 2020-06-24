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

/* table/relation/relational_dropdown.twig */
class __TwigTemplate_db478f316ed5b1721cda5784e364b6c81abba2d3a4c4095546c6f686b6f43ebf extends \Twig\Template
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
        echo "<select name=\"";
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "\">
    <option value=\"\"></option>
    ";
        // line 3
        $context["seen_key"] = false;
        // line 4
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["values"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
            // line 5
            echo "        <option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\"";
            // line 6
            if (( !(($context["foreign"] ?? null) === false) && ($context["value"] == ($context["foreign"] ?? null)))) {
                // line 7
                echo "                selected=\"selected\"";
                // line 8
                $context["seen_key"] = true;
            }
            // line 9
            echo ">
            ";
            // line 10
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "
        </option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "    ";
        if (( !(($context["foreign"] ?? null) === false) &&  !($context["seen_key"] ?? null))) {
            // line 14
            echo "        <option value=\"";
            echo twig_escape_filter($this->env, ($context["foreign"] ?? null), "html", null, true);
            echo "\" selected=\"selected\">
            ";
            // line 15
            echo twig_escape_filter($this->env, ($context["foreign"] ?? null), "html", null, true);
            echo "
        </option>
    ";
        }
        // line 18
        echo "</select>
";
    }

    public function getTemplateName()
    {
        return "table/relation/relational_dropdown.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 18,  83 => 15,  78 => 14,  75 => 13,  66 => 10,  63 => 9,  60 => 8,  58 => 7,  56 => 6,  52 => 5,  47 => 4,  45 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "table/relation/relational_dropdown.twig", "C:\\xampp\\htdocs\\connect\\templates\\table\\relation\\relational_dropdown.twig");
    }
}
