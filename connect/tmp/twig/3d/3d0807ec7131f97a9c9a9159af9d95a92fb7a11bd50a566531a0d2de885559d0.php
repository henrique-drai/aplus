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

/* setup/base.twig */
class __TwigTemplate_9dd5355b33a23ad4cbd56468137742cd0856f066c40a893a98e342bd4f4f36da extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta charset=\"utf-8\">
  <title>phpMyAdmin setup</title>
  <link href=\"../favicon.ico\" rel=\"icon\" type=\"image/x-icon\">
  <link href=\"../favicon.ico\" rel=\"shortcut icon\" type=\"image/x-icon\">
  <link href=\"styles.css\" rel=\"stylesheet\" type=\"text/css\">
  <script type=\"text/javascript\" src=\"../js/vendor/jquery/jquery.min.js\"></script>
  <script type=\"text/javascript\" src=\"../js/vendor/jquery/jquery-ui.min.js\"></script>
  <script type=\"text/javascript\" src=\"../js/setup/ajax.js\"></script>
  <script type=\"text/javascript\" src=\"../js/config.js\"></script>
  <script type=\"text/javascript\" src=\"../js/setup/scripts.js\"></script>
  <script type=\"text/javascript\" src=\"../js/messages.php\"></script>
</head>
<body>

<h1>
  <span class=\"blue\">php</span><span class=\"orange\">MyAdmin</span>
  setup
</h1>

<div id=\"menu\">
  <ul>
    <li>
      <a href=\"index.php";
        // line 26
        echo PhpMyAdmin\Url::getCommon();
        echo "\"";
        echo ((twig_test_empty(($context["formset"] ?? null))) ? (" class=\"active\"") : (""));
        echo ">
        ";
        // line 27
        echo _gettext("Overview");
        // line 28
        echo "      </a>
    </li>
    ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
            // line 31
            echo "      <li>
        <a href=\"index.php";
            // line 32
            echo PhpMyAdmin\Url::getCommon(["page" => "form", "formset" => twig_get_attribute($this->env, $this->source,             // line 34
$context["page"], "formset", [], "any", false, false, false, 34)]);
            // line 35
            echo "\"";
            echo (((($context["formset"] ?? null) == twig_get_attribute($this->env, $this->source, $context["page"], "formset", [], "any", false, false, false, 35))) ? (" class=\"active\"") : (""));
            echo ">
          ";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["page"], "name", [], "any", false, false, false, 36), "html", null, true);
            echo "
        </a>
      </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "  </ul>
</div>

<div id=\"page\">
  ";
        // line 44
        $this->displayBlock('content', $context, $blocks);
        // line 45
        echo "</div>

</body>
</html>
";
    }

    // line 44
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "setup/base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 44,  110 => 45,  108 => 44,  102 => 40,  92 => 36,  87 => 35,  85 => 34,  84 => 32,  81 => 31,  77 => 30,  73 => 28,  71 => 27,  65 => 26,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "setup/base.twig", "C:\\xampp\\htdocs\\connect\\templates\\setup\\base.twig");
    }
}
