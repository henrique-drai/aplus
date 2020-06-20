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

/* setup/servers/index.twig */
class __TwigTemplate_10ce568a640cc42640d447fc05a426adf227482a949efaf2233f6beddd0cb0a7 extends \Twig\Template
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
        return "setup/base.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("setup/base.twig", "setup/servers/index.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "
";
        // line 4
        if (((($context["mode"] ?? null) == "edit") && ($context["has_server"] ?? null))) {
            // line 5
            echo "  <h2>
    ";
            // line 6
            echo _gettext("Edit server");
            // line 7
            echo "    ";
            echo twig_escape_filter($this->env, ($context["server_id"] ?? null), "html", null, true);
            echo "
    <small>(";
            // line 8
            echo twig_escape_filter($this->env, ($context["server_dsn"] ?? null), "html", null, true);
            echo ")</small>
  </h2>
";
        } elseif (((        // line 10
($context["mode"] ?? null) != "revert") ||  !($context["has_server"] ?? null))) {
            // line 11
            echo "  <h2>";
            echo _gettext("Add a new server");
            echo "</h2>
";
        }
        // line 13
        echo "
";
        // line 14
        echo ($context["page"] ?? null);
        echo "

";
    }

    public function getTemplateName()
    {
        return "setup/servers/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 14,  78 => 13,  72 => 11,  70 => 10,  65 => 8,  60 => 7,  58 => 6,  55 => 5,  53 => 4,  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "setup/servers/index.twig", "C:\\xampp\\htdocs\\connect\\templates\\setup\\servers\\index.twig");
    }
}
