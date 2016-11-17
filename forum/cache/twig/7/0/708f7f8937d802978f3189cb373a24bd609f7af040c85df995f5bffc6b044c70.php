<?php

/* navbar_responsive_header.html */
class __TwigTemplate_708f7f8937d802978f3189cb373a24bd609f7af040c85df995f5bffc6b044c70 extends Twig_Template
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
        echo "<div class=\"dropdown-container hidden inventea-mobile-dropdown-menu\">
    <a href=\"#\" class=\"dropdown-trigger inventea-toggle\"><i class=\"fa fa-bars\"></i></a>
    <div class=\"dropdown hidden\">
        <div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
        <ul class=\"dropdown-contents\" role=\"menubar\">
            ";
        // line 6
        if ((isset($context["U_SITE_HOME"]) ? $context["U_SITE_HOME"] : null)) {
            echo "<li><a href=\"";
            echo (isset($context["U_SITE_HOME"]) ? $context["U_SITE_HOME"] : null);
            echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-home\"></i> ";
            echo $this->env->getExtension('phpbb')->lang("SITE_HOME");
            echo "</a></li>";
        }
        // line 7
        echo "            <li><a href=\"";
        echo (isset($context["U_INDEX"]) ? $context["U_INDEX"] : null);
        echo "\" role=\"menuitem\"><i class=\"fa fa-fw ";
        if ((isset($context["U_SITE_HOME"]) ? $context["U_SITE_HOME"] : null)) {
            echo "fa-globe";
        } else {
            echo "fa-home";
        }
        echo "\"></i> ";
        echo $this->env->getExtension('phpbb')->lang("INDEX");
        echo "</a></li>

            ";
        // line 9
        // line 10
        echo "
            <li><a href=\"";
        // line 11
        echo (isset($context["U_FAQ"]) ? $context["U_FAQ"] : null);
        echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-info-circle\"></i> ";
        echo $this->env->getExtension('phpbb')->lang("FAQ");
        echo "</a></li>

            ";
        // line 13
        // line 14
        echo "
            ";
        // line 15
        if ((isset($context["S_DISPLAY_SEARCH"]) ? $context["S_DISPLAY_SEARCH"] : null)) {
            // line 16
            echo "                <li><a href=\"";
            echo (isset($context["U_SEARCH"]) ? $context["U_SEARCH"] : null);
            echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-search\"></i> ";
            echo $this->env->getExtension('phpbb')->lang("SEARCH");
            echo "</a></li>
                ";
            // line 17
            if ((isset($context["S_REGISTERED_USER"]) ? $context["S_REGISTERED_USER"] : null)) {
                echo "<li><a href=\"";
                echo (isset($context["U_SEARCH_SELF"]) ? $context["U_SEARCH_SELF"] : null);
                echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-comments-o\"></i> ";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_SELF");
                echo "</a></li>";
            }
            // line 18
            echo "                ";
            if ((isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null)) {
                echo "<li><a href=\"";
                echo (isset($context["U_SEARCH_NEW"]) ? $context["U_SEARCH_NEW"] : null);
                echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-comment\"></i> ";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_NEW");
                echo "</a></li>";
            }
            // line 19
            echo "                ";
            if ((isset($context["S_LOAD_UNREADS"]) ? $context["S_LOAD_UNREADS"] : null)) {
                echo "<li><a href=\"";
                echo (isset($context["U_SEARCH_UNREAD"]) ? $context["U_SEARCH_UNREAD"] : null);
                echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-comments\"></i> ";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_UNREAD");
                echo "</a></li>";
            }
            // line 20
            echo "                <li><a href=\"";
            echo (isset($context["U_SEARCH_UNANSWERED"]) ? $context["U_SEARCH_UNANSWERED"] : null);
            echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-comment-o\"></i> ";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_UNANSWERED");
            echo "</a></li>
                <li><a href=\"";
            // line 21
            echo (isset($context["U_SEARCH_ACTIVE_TOPICS"]) ? $context["U_SEARCH_ACTIVE_TOPICS"] : null);
            echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-check-circle-o\"></i> ";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ACTIVE_TOPICS");
            echo "</a></li>
            ";
        }
        // line 23
        echo "
            ";
        // line 24
        // line 25
        echo "
            ";
        // line 26
        if ( !(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null)) {
            // line 27
            echo "                ";
            if ((isset($context["S_DISPLAY_MEMBERLIST"]) ? $context["S_DISPLAY_MEMBERLIST"] : null)) {
                echo "<li><a href=\"";
                echo (isset($context["U_MEMBERLIST"]) ? $context["U_MEMBERLIST"] : null);
                echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-users\"></i> ";
                echo $this->env->getExtension('phpbb')->lang("MEMBERLIST");
                echo "</a></li>";
            }
            // line 28
            echo "                ";
            if ((isset($context["U_TEAM"]) ? $context["U_TEAM"] : null)) {
                echo "<li><a href=\"";
                echo (isset($context["U_TEAM"]) ? $context["U_TEAM"] : null);
                echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-shield\"></i> ";
                echo $this->env->getExtension('phpbb')->lang("THE_TEAM");
                echo "</a></li>";
            }
            // line 29
            echo "            ";
        }
        // line 30
        echo "
            ";
        // line 31
        if ((isset($context["U_MCP"]) ? $context["U_MCP"] : null)) {
            echo "<li><a href=\"";
            echo (isset($context["U_MCP"]) ? $context["U_MCP"] : null);
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("MCP_SHORT");
            echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-tachometer\"></i> ";
            echo $this->env->getExtension('phpbb')->lang("MCP");
            echo "</a></li>";
        }
        // line 32
        echo "            ";
        if ((isset($context["U_ACP"]) ? $context["U_ACP"] : null)) {
            echo "<li><a href=\"";
            echo (isset($context["U_ACP"]) ? $context["U_ACP"] : null);
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("ACP_SHORT");
            echo "\" role=\"menuitem\"><i class=\"fa fa-fw fa-cog\"></i> ";
            echo $this->env->getExtension('phpbb')->lang("ACP");
            echo "</a></li>";
        }
        // line 33
        echo "
            ";
        // line 34
        // line 35
        echo "        </ul>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "navbar_responsive_header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 35,  169 => 34,  166 => 33,  155 => 32,  145 => 31,  142 => 30,  139 => 29,  130 => 28,  121 => 27,  119 => 26,  116 => 25,  115 => 24,  112 => 23,  105 => 21,  98 => 20,  89 => 19,  80 => 18,  72 => 17,  65 => 16,  63 => 15,  60 => 14,  59 => 13,  52 => 11,  49 => 10,  48 => 9,  34 => 7,  26 => 6,  19 => 1,);
    }
}
