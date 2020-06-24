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

/* setup/config/index.twig */
class __TwigTemplate_4f3016c65d810c1cbd3b9676f3b6787012282904dac6904b1d37fb21435343fe extends \Twig\Template
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
        $this->parent = $this->loadTemplate("setup/base.twig", "setup/config/index.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "
<h2>";
        // line 4
        echo _gettext("Configuration file");
        echo "</h2>

";
        // line 6
        echo ($context["form_top_html"] ?? null);
        echo "

<input type=\"hidden\" name=\"eol\" value=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["eol"] ?? null), "html", null, true);
        echo "\">

";
        // line 10
        echo ($context["fieldset_top_html"] ?? null);
        echo "

<tr>
  <td>
    <textarea cols=\"50\" rows=\"20\" name=\"textconfig\" id=\"textconfig\" spellcheck=\"false\">";
        // line 15
        echo twig_escape_filter($this->env, ($context["config"] ?? null), "html", null, true);
        // line 16
        echo "</textarea>
  </td>
</tr>

<tr>
  <td class=\"lastrow left\">
    <input class=\"green\" type=\"submit\" name=\"submit_download\" value=\"";
        // line 22
        echo _gettext("Download");
        echo "\">
  </td>
</tr>

";
        // line 26
        echo ($context["form_bottom_html"] ?? null);
        echo "
";
        // line 27
        echo ($context["fieldset_bottom_html"] ?? null);
        echo "

";
    }

    public function getTemplateName()
    {
        return "setup/config/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 27,  92 => 26,  85 => 22,  77 => 16,  75 => 15,  68 => 10,  63 => 8,  58 => 6,  53 => 4,  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "setup/config/index.twig", "C:\\xampp\\htdocs\\connect\\templates\\setup\\config\\index.twig");
    }
}
