<?php

/* mcp_move.html */
class __TwigTemplate_d984818714d0347d7502d4da60246d376edd1c99b9ab2f225cb9a32ca27b6439 extends Twig_Template
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
        if ((isset($context["S_AJAX_REQUEST"]) ? $context["S_AJAX_REQUEST"] : null)) {
            // line 2
            echo "
\t<h3>";
            // line 3
            echo (isset($context["MESSAGE_TITLE"]) ? $context["MESSAGE_TITLE"] : null);
            echo "</h3>
\t<p>";
            // line 4
            echo (isset($context["MESSAGE_TEXT"]) ? $context["MESSAGE_TEXT"] : null);
            echo "</p>

\t";
            // line 6
            if ((isset($context["ADDITIONAL_MSG"]) ? $context["ADDITIONAL_MSG"] : null)) {
                echo "<p>";
                echo (isset($context["ADDITIONAL_MSG"]) ? $context["ADDITIONAL_MSG"] : null);
                echo "</p>";
            }
            // line 7
            echo "
\t<label>
\t\t<strong>";
            // line 9
            echo $this->env->getExtension('phpbb')->lang("SELECT_DESTINATION_FORUM");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</strong>
\t\t<select name=\"to_forum_id\">";
            // line 10
            echo (isset($context["S_FORUM_SELECT"]) ? $context["S_FORUM_SELECT"] : null);
            echo "</select>
\t</label>

\t";
            // line 13
            if ((isset($context["S_CAN_LEAVE_SHADOW"]) ? $context["S_CAN_LEAVE_SHADOW"] : null)) {
                // line 14
                echo "\t\t<label for=\"move_leave_shadow\">
\t\t\t<input type=\"checkbox\" name=\"move_leave_shadow\" id=\"move_leave_shadow\" />";
                // line 15
                echo $this->env->getExtension('phpbb')->lang("LEAVE_SHADOW");
                echo "
\t\t</label>
\t";
            }
            // line 18
            echo "
\t";
            // line 19
            if ((isset($context["S_CAN_LOCK_TOPIC"]) ? $context["S_CAN_LOCK_TOPIC"] : null)) {
                // line 20
                echo "\t\t<label for=\"move_lock_topics\">
\t\t\t<input type=\"checkbox\" name=\"move_lock_topics\" id=\"move_lock_topics\" />";
                // line 21
                echo $this->env->getExtension('phpbb')->lang("LOCK_TOPIC");
                echo "
\t\t</label>
\t";
            }
            // line 24
            echo "
\t<fieldset class=\"submit-buttons\">
\t\t<input type=\"button\" name=\"confirm\" value=\"";
            // line 26
            echo (isset($context["YES_VALUE"]) ? $context["YES_VALUE"] : null);
            echo "\" class=\"button1\" />&nbsp;
\t\t<input type=\"button\" name=\"cancel\" value=\"";
            // line 27
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "\" class=\"button2\" />
\t</fieldset>

";
        } else {
            // line 31
            echo "
";
            // line 32
            $location = "overall_header.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("overall_header.html", "mcp_move.html", 32)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 33
            echo "
<form id=\"confirm\" action=\"";
            // line 34
            echo (isset($context["S_CONFIRM_ACTION"]) ? $context["S_CONFIRM_ACTION"] : null);
            echo "\" method=\"post\">

<div class=\"panel\">
\t<div class=\"inner\">

\t<div class=\"content\">
\t\t<h2 class=\"message-title\">";
            // line 40
            echo (isset($context["MESSAGE_TITLE"]) ? $context["MESSAGE_TITLE"] : null);
            echo "</h2>
\t\t";
            // line 41
            if ((isset($context["ADDITIONAL_MSG"]) ? $context["ADDITIONAL_MSG"] : null)) {
                echo "<p>";
                echo (isset($context["ADDITIONAL_MSG"]) ? $context["ADDITIONAL_MSG"] : null);
                echo "</p>";
            }
            // line 42
            echo "
\t\t<fieldset>
\t\t<dl class=\"fields2\">
\t\t\t<dt><label>";
            // line 45
            echo $this->env->getExtension('phpbb')->lang("SELECT_DESTINATION_FORUM");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label></dt>
\t\t\t<dd><select name=\"to_forum_id\">";
            // line 46
            echo (isset($context["S_FORUM_SELECT"]) ? $context["S_FORUM_SELECT"] : null);
            echo "</select></dd>
\t\t\t";
            // line 47
            if ((isset($context["S_CAN_LEAVE_SHADOW"]) ? $context["S_CAN_LEAVE_SHADOW"] : null)) {
                echo "<dd><label for=\"move_leave_shadow\"><input type=\"checkbox\" name=\"move_leave_shadow\" id=\"move_leave_shadow\" />";
                echo $this->env->getExtension('phpbb')->lang("LEAVE_SHADOW");
                echo "</label></dd>";
            }
            // line 48
            echo "\t\t\t";
            if ((isset($context["S_CAN_LOCK_TOPIC"]) ? $context["S_CAN_LOCK_TOPIC"] : null)) {
                echo "<dd><label for=\"move_lock_topics\"><input type=\"checkbox\" name=\"move_lock_topics\" id=\"move_lock_topics\" />";
                echo $this->env->getExtension('phpbb')->lang("LOCK_TOPIC");
                echo "</label></dd>";
            }
            // line 49
            echo "\t\t</dl>
\t\t<dl class=\"fields2\">
\t\t\t<dt>&nbsp;</dt>
\t\t\t<dd><strong>";
            // line 52
            echo (isset($context["MESSAGE_TEXT"]) ? $context["MESSAGE_TEXT"] : null);
            echo "</strong></dd>
\t\t</dl>
\t\t</fieldset>

\t\t<fieldset class=\"submit-buttons\">
\t\t\t";
            // line 57
            echo (isset($context["S_HIDDEN_FIELDS"]) ? $context["S_HIDDEN_FIELDS"] : null);
            echo "<input type=\"submit\" name=\"confirm\" value=\"";
            echo (isset($context["YES_VALUE"]) ? $context["YES_VALUE"] : null);
            echo "\" class=\"button1\" />&nbsp; 
\t\t\t<input type=\"submit\" name=\"cancel\" value=\"";
            // line 58
            echo $this->env->getExtension('phpbb')->lang("NO");
            echo "\" class=\"button2\" />
\t\t\t";
            // line 59
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t\t</fieldset>

\t</div>

\t</div>
</div>
</form>

";
            // line 68
            $location = "overall_footer.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("overall_footer.html", "mcp_move.html", 68)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
    }

    public function getTemplateName()
    {
        return "mcp_move.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  193 => 68,  181 => 59,  177 => 58,  171 => 57,  163 => 52,  158 => 49,  151 => 48,  145 => 47,  141 => 46,  136 => 45,  131 => 42,  125 => 41,  121 => 40,  112 => 34,  109 => 33,  97 => 32,  94 => 31,  87 => 27,  83 => 26,  79 => 24,  73 => 21,  70 => 20,  68 => 19,  65 => 18,  59 => 15,  56 => 14,  54 => 13,  48 => 10,  43 => 9,  39 => 7,  33 => 6,  28 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }
}
