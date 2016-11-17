<?php

/* confirm_body_prune.html */
class __TwigTemplate_3c8602f35786af516a9e65627d53bc14b6c221f8a1cab84b9aedf7579825f219 extends Twig_Template
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
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_header.html", "confirm_body_prune.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<form id=\"confirm\" method=\"post\" action=\"";
        // line 3
        echo (isset($context["S_CONFIRM_ACTION"]) ? $context["S_CONFIRM_ACTION"] : null);
        echo "\">

<fieldset id=\"userlist\">
\t<h2>";
        // line 6
        echo $this->env->getExtension('phpbb')->lang("PRUNE_USERS_LIST");
        echo "</h2>
\t";
        // line 7
        if ((isset($context["S_DEACTIVATE"]) ? $context["S_DEACTIVATE"] : null)) {
            echo "<p>";
            echo $this->env->getExtension('phpbb')->lang("PRUNE_USERS_LIST_DEACTIVATE");
            echo "</p>";
        } else {
            echo "<p>";
            echo $this->env->getExtension('phpbb')->lang("PRUNE_USERS_LIST_DELETE");
            echo "</p>";
        }
        // line 8
        echo "
\t<br />
\t";
        // line 10
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "users", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["users"]) {
            // line 11
            echo "\t&raquo; <input type=\"checkbox\" name=\"user_ids[]\" value=\"";
            echo $this->getAttribute($context["users"], "USER_ID", array());
            echo "\" checked=\"checked\" />
\t<a href=\"";
            // line 12
            echo $this->getAttribute($context["users"], "U_PROFILE", array());
            echo "\">";
            echo $this->getAttribute($context["users"], "USERNAME", array());
            echo "</a>
\t";
            // line 13
            if ($this->getAttribute($context["users"], "U_USER_ADMIN", array())) {
                echo " [ <a href=\"";
                echo $this->getAttribute($context["users"], "U_USER_ADMIN", array());
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("USER_ADMIN");
                echo "</a> ]";
            }
            echo "<br />
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['users'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "\t<br />
\t<span class=\"small\">
\t<a href=\"#\" onclick=\"marklist('userlist', 'user_ids', true)\">";
        // line 17
        echo $this->env->getExtension('phpbb')->lang("MARK_ALL");
        echo "</a> &bull;
\t<a href=\"#\" onclick=\"marklist('userlist', 'user_ids', false)\">";
        // line 18
        echo $this->env->getExtension('phpbb')->lang("UNMARK_ALL");
        echo "</a>
\t</span>
</fieldset>

<fieldset>
\t<h1>";
        // line 23
        echo (isset($context["MESSAGE_TITLE"]) ? $context["MESSAGE_TITLE"] : null);
        echo "</h1>
\t<p>";
        // line 24
        echo (isset($context["MESSAGE_TEXT"]) ? $context["MESSAGE_TEXT"] : null);
        echo "</p>

\t";
        // line 26
        echo (isset($context["S_HIDDEN_FIELDS"]) ? $context["S_HIDDEN_FIELDS"] : null);
        echo "

\t<div style=\"text-align: center;\">
\t\t<input type=\"submit\" name=\"confirm\" value=\"";
        // line 29
        echo $this->env->getExtension('phpbb')->lang("YES");
        echo "\" class=\"button2\" />&nbsp; 
\t\t<input type=\"submit\" name=\"cancel\" value=\"";
        // line 30
        echo $this->env->getExtension('phpbb')->lang("NO");
        echo "\" class=\"button2\" />
\t</div>
</fieldset>

</form>

";
        // line 36
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "confirm_body_prune.html", 36)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "confirm_body_prune.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  131 => 36,  122 => 30,  118 => 29,  112 => 26,  107 => 24,  103 => 23,  95 => 18,  91 => 17,  87 => 15,  73 => 13,  67 => 12,  62 => 11,  58 => 10,  54 => 8,  44 => 7,  40 => 6,  34 => 3,  31 => 2,  19 => 1,);
    }
}
