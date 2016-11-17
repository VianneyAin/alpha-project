<?php

/* ucp_pm_history.html */
class __TwigTemplate_26e901dae92edc756796e55217082fa7fa56771bc6d5eab4cca822a5afb28e91 extends Twig_Template
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
        echo "
<h3 id=\"review\">
\t<span class=\"right-box\"><a href=\"#review\" onclick=\"viewableArea(getElementById('topicreview'), true); var rev_text = getElementById('review').getElementsByTagName('a').item(0).firstChild; if (rev_text.data == '";
        // line 3
        echo addslashes($this->env->getExtension('phpbb')->lang("EXPAND_VIEW"));
        echo "'){rev_text.data = '";
        echo addslashes($this->env->getExtension('phpbb')->lang("COLLAPSE_VIEW"));
        echo "'; } else if (rev_text.data == '";
        echo addslashes($this->env->getExtension('phpbb')->lang("COLLAPSE_VIEW"));
        echo "'){rev_text.data = '";
        echo addslashes($this->env->getExtension('phpbb')->lang("EXPAND_VIEW"));
        echo "'};\">";
        echo $this->env->getExtension('phpbb')->lang("EXPAND_VIEW");
        echo "</a></span>
\t";
        // line 4
        echo $this->env->getExtension('phpbb')->lang("MESSAGE_HISTORY");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "
</h3>

";
        // line 7
        // line 8
        echo "<div id=\"topicreview\">
\t<script type=\"text/javascript\">
\t// <![CDATA[
\t\tbbcodeEnabled = ";
        // line 11
        echo (isset($context["S_BBCODE_ALLOWED"]) ? $context["S_BBCODE_ALLOWED"] : null);
        echo ";
\t// ]]>
\t</script>
\t";
        // line 14
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "history_row", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["history_row"]) {
            // line 15
            echo "\t<div class=\"post ";
            if (($this->getAttribute($context["history_row"], "S_ROW_COUNT", array()) % 2 == 0)) {
                echo "bg1";
            } else {
                echo "bg2";
            }
            echo "\">
\t\t<div class=\"inner\">

\t\t<div class=\"postbody\" id=\"pr";
            // line 18
            echo $this->getAttribute($context["history_row"], "MSG_ID", array());
            echo "\">
\t\t\t<h3><a href=\"";
            // line 19
            echo $this->getAttribute($context["history_row"], "U_VIEW_MESSAGE", array());
            echo "\" ";
            if ($this->getAttribute($context["history_row"], "S_CURRENT_MSG", array())) {
                echo "class=\"current\"";
            }
            echo ">";
            echo $this->getAttribute($context["history_row"], "SUBJECT", array());
            echo "</a></h3>

\t\t\t";
            // line 21
            $value = ($this->getAttribute($context["history_row"], "U_QUOTE", array()) || $this->getAttribute($context["history_row"], "MESSAGE_AUTHOR_QUOTE", array()));
            $context['definition']->set('SHOW_PM_HISTORY_POST_BUTTONS', $value);
            // line 22
            echo "\t\t\t";
            // line 23
            echo "\t\t\t";
            if ($this->getAttribute((isset($context["definition"]) ? $context["definition"] : null), "SHOW_PM_HISTORY_POST_BUTTONS", array())) {
                // line 24
                echo "\t\t\t<ul class=\"post-buttons\">
\t\t\t\t";
                // line 25
                // line 26
                echo "\t\t\t\t";
                if (($this->getAttribute($context["history_row"], "U_QUOTE", array()) || $this->getAttribute($context["history_row"], "MESSAGE_AUTHOR_QUOTE", array()))) {
                    // line 27
                    echo "\t\t\t\t<li>
\t\t\t\t\t<a ";
                    // line 28
                    if ($this->getAttribute($context["history_row"], "U_QUOTE", array())) {
                        echo "href=\"";
                        echo $this->getAttribute($context["history_row"], "U_QUOTE", array());
                        echo "\"";
                    } else {
                        echo "href=\"#postingbox\" onclick=\"addquote(";
                        echo $this->getAttribute($context["history_row"], "MSG_ID", array());
                        echo ", '";
                        echo $this->getAttribute($context["history_row"], "MESSAGE_AUTHOR_QUOTE", array());
                        echo "', '";
                        echo addslashes($this->env->getExtension('phpbb')->lang("WROTE"));
                        echo "');\"";
                    }
                    echo " title=\"";
                    echo $this->env->getExtension('phpbb')->lang("QUOTE");
                    echo " ";
                    echo $this->getAttribute($context["history_row"], "MESSAGE_AUTHOR", array());
                    echo "\" class=\"button icon-button quote-icon\">
\t\t\t\t\t\t<span>";
                    // line 29
                    echo $this->env->getExtension('phpbb')->lang("QUOTE");
                    echo " ";
                    echo $this->getAttribute($context["history_row"], "MESSAGE_AUTHOR", array());
                    echo "</span>
\t\t\t\t\t</a>
\t\t\t\t</li>
\t\t\t\t";
                }
                // line 33
                echo "\t\t\t\t";
                // line 34
                echo "\t\t\t</ul>
\t\t\t";
            }
            // line 36
            echo "\t\t\t";
            // line 37
            echo "
\t\t\t<p class=\"author\">";
            // line 38
            echo $this->getAttribute($context["history_row"], "MINI_POST_IMG", array());
            echo " ";
            echo $this->env->getExtension('phpbb')->lang("SENT_AT");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <strong>";
            echo $this->getAttribute($context["history_row"], "SENT_DATE", array());
            echo "</strong><br />
\t\t\t\t";
            // line 39
            echo $this->env->getExtension('phpbb')->lang("MESSAGE_BY_AUTHOR");
            echo " ";
            echo $this->getAttribute($context["history_row"], "MESSAGE_AUTHOR_FULL", array());
            echo "</p>
\t\t\t<div class=\"content\">";
            // line 40
            if ($this->getAttribute($context["history_row"], "MESSAGE", array())) {
                echo $this->getAttribute($context["history_row"], "MESSAGE", array());
            } else {
                echo "<span class=\"error\">";
                echo $this->env->getExtension('phpbb')->lang("MESSAGE_REMOVED_FROM_OUTBOX");
                echo "</span>";
            }
            echo "</div>
\t\t\t<div id=\"message_";
            // line 41
            echo $this->getAttribute($context["history_row"], "MSG_ID", array());
            echo "\" style=\"display: none;\">";
            echo $this->getAttribute($context["history_row"], "DECODED_MESSAGE", array());
            echo "</div>
\t\t</div>

\t\t</div>
\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['history_row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "</div>
";
        // line 48
        // line 49
        echo "
<hr />
<p><a href=\"#cp-main\" class=\"top2\">";
        // line 51
        echo $this->env->getExtension('phpbb')->lang("BACK_TO_TOP");
        echo "</a></p>
";
    }

    public function getTemplateName()
    {
        return "ucp_pm_history.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  189 => 51,  185 => 49,  184 => 48,  181 => 47,  167 => 41,  157 => 40,  151 => 39,  142 => 38,  139 => 37,  137 => 36,  133 => 34,  131 => 33,  122 => 29,  102 => 28,  99 => 27,  96 => 26,  95 => 25,  92 => 24,  89 => 23,  87 => 22,  84 => 21,  73 => 19,  69 => 18,  58 => 15,  54 => 14,  48 => 11,  43 => 8,  42 => 7,  35 => 4,  23 => 3,  19 => 1,);
    }
}
