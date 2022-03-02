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

/* modules/custom/guestbook/templates/guestbook-theme.html.twig */
class __TwigTemplate_2556e4f9a33eb001f930a398aaecf917a74a8980082b7577efaa51258af7497e extends \Twig\Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["form"] ?? null), 1, $this->source), "html", null, true);
        echo "

";
        // line 3
        if ((($__internal_compile_0 = (($__internal_compile_1 = ($context["reviews"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["table"] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["#rows"] ?? null) : null)) {
            // line 4
            echo "  <div style=\"height: auto;\">
    <table style=\"height: auto; color: white;\" ";
            // line 5
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => "table"], "method", false, false, true, 5), 5, $this->source), "html", null, true);
            echo ">
      ";
            // line 6
            if ((($__internal_compile_2 = (($__internal_compile_3 = ($context["reviews"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["table"] ?? null) : null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["#header"] ?? null) : null)) {
                // line 7
                echo "        <thead>
          <tr>
            ";
                // line 9
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_4 = (($__internal_compile_5 = ($context["reviews"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["table"] ?? null) : null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["#header"] ?? null) : null));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 10
                    echo "              <td>";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["cell"], 10, $this->source), "html", null, true);
                    echo "</td>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cell'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 12
                echo "            ";
                if (twig_in_filter("administrator", twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "getroles", [], "any", false, false, true, 12))) {
                    // line 13
                    echo "              <td >Delete function</td>
              <td >Edit function</td>
            ";
                }
                // line 16
                echo "          </tr>
        </thead>
      ";
            }
            // line 19
            echo "
      <tbody>
        ";
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((($__internal_compile_6 = (($__internal_compile_7 = ($context["reviews"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["table"] ?? null) : null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["#rows"] ?? null) : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 22
                echo "          ";
                $context["row_classes"] = [0 => (( !                // line 23
($context["no_striping"] ?? null)) ? (twig_cycle([0 => "odd", 1 => "even"], $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, true, 23), 23, $this->source))) : (""))];
                // line 25
                echo "          <tr";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 25), "addClass", [0 => ($context["row_classes"] ?? null)], "method", false, false, true, 25), 25, $this->source), "html", null, true);
                echo ">
           <td> 
            ";
                // line 27
                if ((($__internal_compile_8 = $context["row"]) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["avatar"] ?? null) : null)) {
                    // line 28
                    echo "                  <img
                    class=\"user-avatar\"
                    src=\"";
                    // line 30
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_9 = $context["row"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["avatar"] ?? null) : null), 30, $this->source), "html", null, true);
                    echo "\"
                    alt=\"";
                    // line 31
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_10 = $context["row"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["name"] ?? null) : null), 31, $this->source), "html", null, true);
                    echo "\"
                    title=\"";
                    // line 32
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_11 = $context["row"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["name"] ?? null) : null), 32, $this->source), "html", null, true);
                    echo "\"/>
              ";
                } else {
                    // line 34
                    echo "                  <img
                    class=\"default-avatar user-avatar\"
                    src=\"/modules/custom/guestbook/img/default/user-default.png\"
                    alt=\"";
                    // line 37
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_12 = $context["row"]) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["name"] ?? null) : null), 37, $this->source), "html", null, true);
                    echo "\"
                    title=\"";
                    // line 38
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_13 = $context["row"]) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["name"] ?? null) : null), 38, $this->source), "html", null, true);
                    echo "\"/>
              ";
                }
                // line 40
                echo "            </td>
            <td class=\"user-name\">";
                // line 41
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_14 = $context["row"]) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["name"] ?? null) : null), 41, $this->source), "html", null, true);
                echo " </td>
            <td class=\"user-date\">";
                // line 42
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_date_format_filter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_15 = $context["row"]) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["timestamp"] ?? null) : null), 42, $this->source), "m/d/y H:i:s"), "html", null, true);
                echo "</td>
            <td class=\"user-feedback\">";
                // line 43
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_16 = $context["row"]) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["text"] ?? null) : null), 43, $this->source), "html", null, true);
                echo "</td>
            <td>
             ";
                // line 45
                if ((($__internal_compile_17 = $context["row"]) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["image"] ?? null) : null)) {
                    // line 46
                    echo "                <a href=\"";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_18 = $context["row"]) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["image"] ?? null) : null), 46, $this->source), "html", null, true);
                    echo "\" target=\"_blank\">
                  <img
                    class=\"user-image\"
                    src=\"";
                    // line 49
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_19 = $context["row"]) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["image"] ?? null) : null), 49, $this->source), "html", null, true);
                    echo "\"
                    alt=\"";
                    // line 50
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_20 = $context["row"]) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["name"] ?? null) : null), 50, $this->source), "html", null, true);
                    echo "\"
                    title=\"";
                    // line 51
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_21 = $context["row"]) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["name"] ?? null) : null), 51, $this->source), "html", null, true);
                    echo "\"/>
                </a>
              ";
                }
                // line 54
                echo "            </td>
            <td class=\"user-phone\">";
                // line 55
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_22 = $context["row"]) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["phone"] ?? null) : null), 55, $this->source), "html", null, true);
                echo "</td>
            <td class=\"user-email\">";
                // line 56
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_23 = $context["row"]) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["email"] ?? null) : null), 56, $this->source), "html", null, true);
                echo "</td>
            ";
                // line 57
                if (twig_in_filter("administrator", twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "getroles", [], "any", false, false, true, 57))) {
                    // line 58
                    echo "              <td>
                <div class=\"option-links\">
                  <button
                    type=\"button\"
                    class=\"btn btn-outline-danger use-ajax delete\"
                    href=\"";
                    // line 63
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("guestdelete.content", ["id" => (($__internal_compile_24 = $context["row"]) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["id"] ?? null) : null)]), "html", null, true);
                    echo "\"
                    data-dialog-options=\"{&quot;width&quot;:400}\"
                    data-dialog-type=\"modal\">
                    Delete
                  </button>
                </div>
              </td>
               <td>
                <div class=\"option-links\">
                   <button
                    type=\"button\"
                    class=\"btn btn-outline-success use-ajax edit\"
                    href=\"";
                    // line 75
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("guestedit.content", ["id" => (($__internal_compile_25 = $context["row"]) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["id"] ?? null) : null)]), "html", null, true);
                    echo "\"
                    data-dialog-options=\"{&quot;width&quot;:400}\"
                    data-dialog-type=\"modal\">
                    Edit
                  </button>
                </div>
              </td>
            ";
                }
                // line 83
                echo "          </tr>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 85
            echo "        </tbody>
    </table>
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "modules/custom/guestbook/templates/guestbook-theme.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  249 => 85,  234 => 83,  223 => 75,  208 => 63,  201 => 58,  199 => 57,  195 => 56,  191 => 55,  188 => 54,  182 => 51,  178 => 50,  174 => 49,  167 => 46,  165 => 45,  160 => 43,  156 => 42,  152 => 41,  149 => 40,  144 => 38,  140 => 37,  135 => 34,  130 => 32,  126 => 31,  122 => 30,  118 => 28,  116 => 27,  110 => 25,  108 => 23,  106 => 22,  89 => 21,  85 => 19,  80 => 16,  75 => 13,  72 => 12,  63 => 10,  59 => 9,  55 => 7,  53 => 6,  49 => 5,  46 => 4,  44 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/guestbook/templates/guestbook-theme.html.twig", "/var/www/web/modules/custom/guestbook/templates/guestbook-theme.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 3, "for" => 9, "set" => 22);
        static $filters = array("escape" => 1, "date" => 42);
        static $functions = array("cycle" => 23, "path" => 63);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set'],
                ['escape', 'date'],
                ['cycle', 'path']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
