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

/* setup/home/index.twig */
class __TwigTemplate_42ed9118074e2b6c89f70e83daf265b98fd1338b0a63ed19c723665fc2c10611 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("setup/base.twig", "setup/home/index.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "
<form id=\"select_lang\" method=\"post\">
  ";
        // line 5
        echo PhpMyAdmin\Url::getHiddenInputs();
        echo "
  <bdo lang=\"en\" dir=\"ltr\">
    <label for=\"lang\">
      ";
        // line 8
        echo _gettext("Language");
        // line 9
        echo "      ";
        echo (((_gettext("Language") != "Language")) ? (" - Language") : (""));
        echo "
    </label>
  </bdo>
  <br>
  <select id=\"lang\" name=\"lang\" class=\"autosubmit\" lang=\"en\" dir=\"ltr\">
    ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 15
            echo "      <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 15), "html", null, true);
            echo "\"";
            echo ((twig_get_attribute($this->env, $this->source, $context["language"], "is_active", [], "any", false, false, false, 15)) ? (" selected") : (""));
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 15);
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "  </select>
</form>

<h2>";
        // line 20
        echo _gettext("Overview");
        echo "</h2>

<a href=\"#\" id=\"show_hidden_messages\" class=\"hide\">
  ";
        // line 23
        echo _gettext("Show hidden messages");
        echo " (#MSG_COUNT)
</a>

";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["messages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 27
            echo "  <div class=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["message"], "type", [], "any", false, false, false, 27), "html", null, true);
            echo ((twig_get_attribute($this->env, $this->source, $context["message"], "is_hidden", [], "any", false, false, false, 27)) ? (" hiddenmessage") : (""));
            echo "\" id=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["message"], "id", [], "any", false, false, false, 27), "html", null, true);
            echo "\">
    <h4>";
            // line 28
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["message"], "title", [], "any", false, false, false, 28), "html", null, true);
            echo "</h4>
    ";
            // line 29
            echo twig_get_attribute($this->env, $this->source, $context["message"], "message", [], "any", false, false, false, 29);
            echo "
  </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "
<fieldset class=\"simple\">
  <legend>";
        // line 34
        echo _gettext("Servers");
        echo "</legend>

  ";
        // line 36
        echo ($context["servers_form_top_html"] ?? null);
        echo "

  <div class=\"form\">
    ";
        // line 39
        if ((($context["server_count"] ?? null) > 0)) {
            // line 40
            echo "      <table cellspacing=\"0\" class=\"datatable\">
        <tr>
          <th>#</th>
          <th>";
            // line 43
            echo _gettext("Name");
            echo "</th>
          <th>";
            // line 44
            echo _gettext("Authentication type");
            echo "</th>
          <th colspan=\"2\">DSN</th>
        </tr>

        ";
            // line 48
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["servers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["server"]) {
                // line 49
                echo "          <tr>
            <td>";
                // line 50
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["server"], "id", [], "any", false, false, false, 50), "html", null, true);
                echo "</td>
            <td>";
                // line 51
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["server"], "name", [], "any", false, false, false, 51), "html", null, true);
                echo "</td>
            <td>";
                // line 52
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["server"], "auth_type", [], "any", false, false, false, 52), "html", null, true);
                echo "</td>
            <td>";
                // line 53
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["server"], "dsn", [], "any", false, false, false, 53), "html", null, true);
                echo "</td>
            <td class=\"nowrap\">
              <small>
                <a href=\"";
                // line 56
                echo PhpMyAdmin\Url::getCommon(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["server"], "params", [], "any", false, false, false, 56), "edit", [], "any", false, false, false, 56));
                echo "\">
                  ";
                // line 57
                echo _gettext("Edit");
                // line 58
                echo "                </a>
                |
                <a class=\"delete-server\" href=\"";
                // line 60
                echo PhpMyAdmin\Url::getCommon(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["server"], "params", [], "any", false, false, false, 60), "remove", [], "any", false, false, false, 60));
                echo "\" data-post=\"";
                // line 61
                echo PhpMyAdmin\Url::getCommon(["token" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["server"], "params", [], "any", false, false, false, 61), "token", [], "any", false, false, false, 61)], "");
                echo "\">
                  ";
                // line 62
                echo _gettext("Delete");
                // line 63
                echo "                </a>
              </small>
            </td>
          </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['server'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 68
            echo "      </table>
    ";
        } else {
            // line 70
            echo "      <table width=\"100%\">
        <tr>
          <td>
            <em>";
            // line 73
            echo _gettext("There are no configured servers");
            echo "</em>
          </td>
        </tr>
      </table>
    ";
        }
        // line 78
        echo "
    <table width=\"100%\">
      <tr>
        <td class=\"lastrow left\">
          <input type=\"submit\" name=\"submit\" value=\"";
        // line 82
        echo _gettext("New server");
        echo "\">
        </td>
      </tr>
    </table>
  </div>

  ";
        // line 88
        echo ($context["form_bottom_html"] ?? null);
        echo "

</fieldset>

<fieldset class=\"simple\">
  <legend>";
        // line 93
        echo _gettext("Configuration file");
        echo "</legend>

  ";
        // line 95
        echo ($context["config_form_top_html"] ?? null);
        echo "

  <table width=\"100%\" cellspacing=\"0\">
    ";
        // line 98
        echo ($context["default_language_input"] ?? null);
        echo "
    ";
        // line 99
        echo ($context["server_default_input"] ?? null);
        echo "
    ";
        // line 100
        echo ($context["eol_input"] ?? null);
        echo "

    <tr>
      <td colspan=\"2\" class=\"lastrow left\">
        <input type=\"submit\" name=\"submit_display\" value=\"";
        // line 104
        echo _gettext("Display");
        echo "\">
        <input type=\"submit\" name=\"submit_download\" value=\"";
        // line 105
        echo _gettext("Download");
        echo "\">
        <input class=\"red\" type=\"submit\" name=\"submit_clear\" value=\"";
        // line 106
        echo _gettext("Clear");
        echo "\">
      </td>
    </tr>
  </table>

  ";
        // line 111
        echo ($context["form_bottom_html"] ?? null);
        echo "

</fieldset>

<div id=\"footer\">
  <a href=\"../url.php?url=https://www.phpmyadmin.net/\">";
        // line 116
        echo _gettext("phpMyAdmin homepage");
        echo "</a>
  <a href=\"../url.php?url=https://www.phpmyadmin.net/donate/\">";
        // line 117
        echo _gettext("Donate");
        echo "</a>
  <a href=\"";
        // line 118
        echo PhpMyAdmin\Url::getCommon(["version_check" => "1"]);
        echo "\">";
        echo _gettext("Check for latest version");
        echo "</a>
</div>

";
    }

    public function getTemplateName()
    {
        return "setup/home/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  315 => 118,  311 => 117,  307 => 116,  299 => 111,  291 => 106,  287 => 105,  283 => 104,  276 => 100,  272 => 99,  268 => 98,  262 => 95,  257 => 93,  249 => 88,  240 => 82,  234 => 78,  226 => 73,  221 => 70,  217 => 68,  207 => 63,  205 => 62,  201 => 61,  198 => 60,  194 => 58,  192 => 57,  188 => 56,  182 => 53,  178 => 52,  174 => 51,  170 => 50,  167 => 49,  163 => 48,  156 => 44,  152 => 43,  147 => 40,  145 => 39,  139 => 36,  134 => 34,  130 => 32,  121 => 29,  117 => 28,  109 => 27,  105 => 26,  99 => 23,  93 => 20,  88 => 17,  75 => 15,  71 => 14,  62 => 9,  60 => 8,  54 => 5,  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "setup/home/index.twig", "C:\\xampp\\htdocs\\connect\\templates\\setup\\home\\index.twig");
    }
}
