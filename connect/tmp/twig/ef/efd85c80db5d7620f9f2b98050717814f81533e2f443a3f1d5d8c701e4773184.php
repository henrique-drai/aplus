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

/* display/export/options_output_format.twig */
class __TwigTemplate_857543f62e64dc39a86dcea70a122e4d73f6579bbf733060f0d7ba075f43d68a extends \Twig\Template
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
        echo "<li>
    <label for=\"filename_template\" class=\"desc\">
        ";
        // line 3
        echo _gettext("File name template:");
        // line 4
        echo "        ";
        echo PhpMyAdmin\Util::showHint(($context["message"] ?? null));
        echo "
    </label>
    <input type=\"text\" name=\"filename_template\" id=\"filename_template\" value=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["filename_template"] ?? null), "html", null, true);
        echo "\">
    <input type=\"checkbox\" name=\"remember_template\" id=\"checkbox_remember_template\"";
        // line 9
        echo ((($context["is_checked"] ?? null)) ? (" checked") : (""));
        echo ">
    <label for=\"checkbox_remember_template\">
        ";
        // line 11
        echo _gettext("use this for future exports");
        // line 12
        echo "    </label>
</li>
";
    }

    public function getTemplateName()
    {
        return "display/export/options_output_format.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 12,  58 => 11,  53 => 9,  49 => 7,  43 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "display/export/options_output_format.twig", "C:\\xampp\\htdocs\\connect\\templates\\display\\export\\options_output_format.twig");
    }
}
