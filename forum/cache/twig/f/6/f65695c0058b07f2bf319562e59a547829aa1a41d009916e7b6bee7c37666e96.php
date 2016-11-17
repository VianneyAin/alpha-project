<?php

/* simple_footer.html */
class __TwigTemplate_f65695c0058b07f2bf319562e59a547829aa1a41d009916e7b6bee7c37666e96 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "\t\t<div style=\"text-align: ";
        echo (isset($context["S_CONTENT_FLOW_END"]) ? $context["S_CONTENT_FLOW_END"] : null);
        echo ";\"><a href=\"#\" onclick=\"self.close(); return false;\">";
        echo $this->env->getExtension('phpbb')->lang("CLOSE_WINDOW");
        echo "</a></div>
\t<br /><br />
</div>

<div id=\"page-footer\">

\t";
        // line 7
        if ((isset($context["S_COPYRIGHT_HTML"]) ? $context["S_COPYRIGHT_HTML"] : null)) {
            // line 8
            echo "\t\t<br />";
            echo (isset($context["CREDIT_LINE"]) ? $context["CREDIT_LINE"] : null);
            echo "
\t\t";
            // line 9
            if ((isset($context["TRANSLATION_INFO"]) ? $context["TRANSLATION_INFO"] : null)) {
                echo "<br />";
                echo (isset($context["TRANSLATION_INFO"]) ? $context["TRANSLATION_INFO"] : null);
            }
            // line 10
            echo "\t";
        }
        // line 11
        echo "
\t";
        // line 12
        if ((isset($context["DEBUG_OUTPUT"]) ? $context["DEBUG_OUTPUT"] : null)) {
            // line 13
            echo "\t\t";
            if ((isset($context["S_COPYRIGHT_HTML"]) ? $context["S_COPYRIGHT_HTML"] : null)) {
                echo "<br /><br />";
            }
            // line 14
            echo "\t\t";
            echo (isset($context["DEBUG_OUTPUT"]) ? $context["DEBUG_OUTPUT"] : null);
            echo "
\t";
        }
        // line 16
        echo "
</div>

<script type=\"text/javascript\" src=\"";
        // line 19
        echo (isset($context["T_JQUERY_LINK"]) ? $context["T_JQUERY_LINK"] : null);
        echo "\"></script>
";
        // line 20
        if ((isset($context["S_ALLOW_CDN"]) ? $context["S_ALLOW_CDN"] : null)) {
            echo "<script type=\"text/javascript\">window.jQuery || document.write('\\x3Cscript src=\"";
            echo (isset($context["T_ASSETS_PATH"]) ? $context["T_ASSETS_PATH"] : null);
            echo "/javascript/jquery.min.js?assets_version=";
            echo (isset($context["T_ASSETS_VERSION"]) ? $context["T_ASSETS_VERSION"] : null);
            echo "\">\\x3C/script>');</script>";
        }
        // line 21
        echo "<script type=\"text/javascript\" src=\"";
        echo (isset($context["T_ASSETS_PATH"]) ? $context["T_ASSETS_PATH"] : null);
        echo "/javascript/core.js?assets_version=";
        echo (isset($context["T_ASSETS_VERSION"]) ? $context["T_ASSETS_VERSION"] : null);
        echo "\"></script>

";
        // line 23
        // line 24
        echo $this->getAttribute((isset($context["definition"]) ? $context["definition"] : null), "SCRIPTS", array());
        echo "

</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "simple_footer.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 24,  87 => 23,  79 => 21,  71 => 20,  67 => 19,  62 => 16,  56 => 14,  51 => 13,  49 => 12,  46 => 11,  43 => 10,  38 => 9,  33 => 8,  31 => 7,  19 => 1,);
    }
}
