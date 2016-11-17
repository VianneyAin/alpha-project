<?php

/* forumlist_body.html */
class __TwigTemplate_90c0af83dd06eaee063641aafff1bfe1f7b5d28ed529027880dae7c050af4f7a extends Twig_Template
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
";
        // line 2
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "forumrow", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["forumrow"]) {
            // line 3
            echo "\t";
            if ((($this->getAttribute($context["forumrow"], "S_IS_CAT", array()) &&  !$this->getAttribute($context["forumrow"], "S_FIRST_ROW", array())) || $this->getAttribute($context["forumrow"], "S_NO_CAT", array()))) {
                // line 4
                echo "\t\t\t</ul>

\t\t\t</div>
\t\t</div>
\t";
            }
            // line 9
            echo "
\t";
            // line 10
            // line 11
            echo "\t";
            if ((($this->getAttribute($context["forumrow"], "S_IS_CAT", array()) || $this->getAttribute($context["forumrow"], "S_FIRST_ROW", array())) || $this->getAttribute($context["forumrow"], "S_NO_CAT", array()))) {
                // line 12
                echo "\t\t<div class=\"forabg\">
\t\t\t<div class=\"inner\">
\t\t\t<ul class=\"topiclist\">
\t\t\t\t<li class=\"header\">
\t\t\t\t\t";
                // line 16
                // line 17
                echo "\t\t\t\t\t<dl class=\"icon\">
\t\t\t\t\t\t<dt><div class=\"list-inner\">";
                // line 18
                if ($this->getAttribute($context["forumrow"], "S_IS_CAT", array())) {
                    echo "<a href=\"";
                    echo $this->getAttribute($context["forumrow"], "U_VIEWFORUM", array());
                    echo "\">";
                    echo $this->getAttribute($context["forumrow"], "FORUM_NAME", array());
                    echo "</a>";
                } else {
                    echo $this->env->getExtension('phpbb')->lang("FORUM");
                }
                echo "</div></dt>
\t\t\t\t\t\t<dd class=\"topics\">";
                // line 19
                echo $this->env->getExtension('phpbb')->lang("STATISTICS");
                echo "</dd>
\t\t\t\t\t\t<dd class=\"lastpost\"><span>";
                // line 20
                echo $this->env->getExtension('phpbb')->lang("LAST_POST");
                echo "</span></dd>
\t\t\t\t\t</dl>
\t\t\t\t\t";
                // line 22
                // line 23
                echo "\t\t\t\t</li>
\t\t\t</ul>
\t\t\t<ul class=\"topiclist forums\">
\t";
            }
            // line 27
            echo "\t";
            // line 28
            echo "
\t";
            // line 29
            if ( !$this->getAttribute($context["forumrow"], "S_IS_CAT", array())) {
                // line 30
                echo "\t\t";
                // line 31
                echo "\t\t<li class=\"row\">
\t\t\t";
                // line 32
                // line 33
                echo "\t\t\t<dl title=\"";
                echo $this->getAttribute($context["forumrow"], "FORUM_FOLDER_IMG_ALT", array());
                echo "\">
\t\t\t\t<dt class=\"icon ";
                // line 34
                echo $this->getAttribute($context["forumrow"], "FORUM_IMG_STYLE", array());
                echo "\"></dt>
\t\t\t\t<dd>
\t\t\t\t\t";
                // line 36
                if ($this->getAttribute($context["forumrow"], "S_UNREAD_FORUM", array())) {
                    echo "<a href=\"";
                    echo $this->getAttribute($context["forumrow"], "U_VIEWFORUM", array());
                    echo "\" class=\"icon-link\"></a>";
                }
                // line 37
                echo "\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t";
                // line 38
                if (((isset($context["S_ENABLE_FEEDS"]) ? $context["S_ENABLE_FEEDS"] : null) && $this->getAttribute($context["forumrow"], "S_FEED_ENABLED", array()))) {
                    echo "<!-- <a class=\"feed-icon-forum\" title=\"";
                    echo $this->env->getExtension('phpbb')->lang("FEED");
                    echo " - ";
                    echo $this->getAttribute($context["forumrow"], "FORUM_NAME", array());
                    echo "\" href=\"";
                    echo (isset($context["U_FEED"]) ? $context["U_FEED"] : null);
                    echo "?f=";
                    echo $this->getAttribute($context["forumrow"], "FORUM_ID", array());
                    echo "\"><img src=\"";
                    echo (isset($context["T_THEME_PATH"]) ? $context["T_THEME_PATH"] : null);
                    echo "/images/feed.gif\" alt=\"";
                    echo $this->env->getExtension('phpbb')->lang("FEED");
                    echo " - ";
                    echo $this->getAttribute($context["forumrow"], "FORUM_NAME", array());
                    echo "\" /></a> -->";
                }
                // line 39
                echo "
\t\t\t\t\t\t";
                // line 40
                if ($this->getAttribute($context["forumrow"], "FORUM_IMAGE", array())) {
                    echo "<span class=\"forum-image\">";
                    echo $this->getAttribute($context["forumrow"], "FORUM_IMAGE", array());
                    echo "</span>";
                }
                // line 41
                echo "\t\t\t\t\t\t<a href=\"";
                echo $this->getAttribute($context["forumrow"], "U_VIEWFORUM", array());
                echo "\" class=\"forumtitle\">";
                echo $this->getAttribute($context["forumrow"], "FORUM_NAME", array());
                echo "</a>
\t\t\t\t\t\t";
                // line 42
                if ($this->getAttribute($context["forumrow"], "FORUM_DESC", array())) {
                    echo "<br />";
                    echo $this->getAttribute($context["forumrow"], "FORUM_DESC", array());
                }
                // line 43
                echo "\t\t\t\t\t\t";
                if ($this->getAttribute($context["forumrow"], "MODERATORS", array())) {
                    // line 44
                    echo "\t\t\t\t\t\t\t<br /><strong>";
                    echo $this->getAttribute($context["forumrow"], "L_MODERATOR_STR", array());
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo "</strong> ";
                    echo $this->getAttribute($context["forumrow"], "MODERATORS", array());
                    echo "
\t\t\t\t\t\t";
                }
                // line 46
                echo "\t\t\t\t\t\t";
                if ((twig_length_filter($this->env, $this->getAttribute($context["forumrow"], "subforum", array())) && $this->getAttribute($context["forumrow"], "S_LIST_SUBFORUMS", array()))) {
                    // line 47
                    echo "\t\t\t\t\t\t\t";
                    // line 48
                    echo "\t\t\t\t\t\t\t<br /><strong>";
                    echo $this->getAttribute($context["forumrow"], "L_SUBFORUM_STR", array());
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo "</strong>
\t\t\t\t\t\t\t";
                    // line 49
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["forumrow"], "subforum", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["subforum"]) {
                        // line 50
                        echo "\t\t\t\t\t\t\t\t<a href=\"";
                        echo $this->getAttribute($context["subforum"], "U_SUBFORUM", array());
                        echo "\" class=\"subforum";
                        if ($this->getAttribute($context["subforum"], "S_UNREAD", array())) {
                            echo " unread";
                        } else {
                            echo " read";
                        }
                        echo "\" title=\"";
                        if ($this->getAttribute($context["subforum"], "S_UNREAD", array())) {
                            echo $this->env->getExtension('phpbb')->lang("UNREAD_POSTS");
                        } else {
                            echo $this->env->getExtension('phpbb')->lang("NO_UNREAD_POSTS");
                        }
                        echo "\">";
                        echo $this->getAttribute($context["subforum"], "SUBFORUM_NAME", array());
                        echo "</a>";
                        if ( !$this->getAttribute($context["subforum"], "S_LAST_ROW", array())) {
                            echo $this->env->getExtension('phpbb')->lang("COMMA_SEPARATOR");
                        }
                        // line 51
                        echo "\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subforum'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 52
                    echo "\t\t\t\t\t\t\t";
                    // line 53
                    echo "\t\t\t\t\t\t";
                }
                // line 54
                echo "
\t\t\t\t\t\t";
                // line 55
                if ( !(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null)) {
                    // line 56
                    echo "\t\t\t\t\t\t<div class=\"responsive-show\" style=\"display: none;\">
\t\t\t\t\t\t\t";
                    // line 57
                    if ($this->getAttribute($context["forumrow"], "CLICKS", array())) {
                        // line 58
                        echo "\t\t\t\t\t\t\t\t";
                        echo $this->env->getExtension('phpbb')->lang("REDIRECTS");
                        echo $this->env->getExtension('phpbb')->lang("COLON");
                        echo " <strong>";
                        echo $this->getAttribute($context["forumrow"], "CLICKS", array());
                        echo "</strong>
\t\t\t\t\t\t\t";
                    } elseif (( !$this->getAttribute(                    // line 59
$context["forumrow"], "S_IS_LINK", array()) && $this->getAttribute($context["forumrow"], "TOPICS", array()))) {
                        // line 60
                        echo "\t\t\t\t\t\t\t\t";
                        echo $this->env->getExtension('phpbb')->lang("TOPICS");
                        echo $this->env->getExtension('phpbb')->lang("COLON");
                        echo " <strong>";
                        echo $this->getAttribute($context["forumrow"], "TOPICS", array());
                        echo "</strong>
\t\t\t\t\t\t\t";
                    }
                    // line 62
                    echo "\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
                }
                // line 64
                echo "\t\t\t\t\t</div>
\t\t\t\t</dd>
\t\t\t\t";
                // line 66
                if ($this->getAttribute($context["forumrow"], "CLICKS", array())) {
                    // line 67
                    echo "\t\t\t\t\t<dd class=\"redirect\"><span>";
                    echo $this->env->getExtension('phpbb')->lang("REDIRECTS");
                    echo $this->env->getExtension('phpbb')->lang("COLON");
                    echo " <strong>";
                    echo $this->getAttribute($context["forumrow"], "CLICKS", array());
                    echo "</strong></span></dd>
\t\t\t\t";
                } elseif ( !$this->getAttribute(                // line 68
$context["forumrow"], "S_IS_LINK", array())) {
                    // line 69
                    echo "\t\t\t\t\t<dd class=\"topics\">
\t\t\t\t\t\t";
                    // line 70
                    echo $this->env->getExtension('phpbb')->lang("TOPICS");
                    echo ": <strong>";
                    echo $this->getAttribute($context["forumrow"], "TOPICS", array());
                    echo "</strong><br />
\t\t\t\t\t\t";
                    // line 71
                    echo $this->env->getExtension('phpbb')->lang("POSTS");
                    echo ": <strong>";
                    echo $this->getAttribute($context["forumrow"], "POSTS", array());
                    echo "</strong>
\t\t\t\t\t</dd>
\t\t\t\t\t<dd class=\"lastpost\"><span>
\t\t\t\t\t\t";
                    // line 74
                    if ($this->getAttribute($context["forumrow"], "U_UNAPPROVED_TOPICS", array())) {
                        // line 75
                        echo "\t\t\t\t\t\t\t<a href=\"";
                        echo $this->getAttribute($context["forumrow"], "U_UNAPPROVED_TOPICS", array());
                        echo "\">";
                        echo (isset($context["UNAPPROVED_IMG"]) ? $context["UNAPPROVED_IMG"] : null);
                        echo "</a>
\t\t\t\t\t\t";
                    } elseif ($this->getAttribute(                    // line 76
$context["forumrow"], "U_UNAPPROVED_POSTS", array())) {
                        // line 77
                        echo "\t\t\t\t\t\t\t<a href=\"";
                        echo $this->getAttribute($context["forumrow"], "U_UNAPPROVED_POSTS", array());
                        echo "\">";
                        echo (isset($context["UNAPPROVED_POST_IMG"]) ? $context["UNAPPROVED_POST_IMG"] : null);
                        echo "</a>
\t\t\t\t\t\t";
                    }
                    // line 79
                    echo "\t\t\t\t\t\t";
                    if ($this->getAttribute($context["forumrow"], "LAST_POST_TIME", array())) {
                        echo "<dfn>";
                        echo $this->env->getExtension('phpbb')->lang("LAST_POST");
                        echo "</dfn>
\t\t\t\t\t\t";
                        // line 80
                        if ($this->getAttribute($context["forumrow"], "S_DISPLAY_SUBJECT", array())) {
                            // line 81
                            echo "\t\t\t\t\t\t\t";
                            // line 82
                            echo "\t\t\t\t\t\t\t<i class=\"fa fa-fw fa-comments\"></i> <a href=\"";
                            echo $this->getAttribute($context["forumrow"], "U_LAST_POST", array());
                            echo "\" title=\"";
                            echo $this->getAttribute($context["forumrow"], "LAST_POST_SUBJECT", array());
                            echo "\" class=\"lastsubject\">";
                            echo $this->getAttribute($context["forumrow"], "LAST_POST_SUBJECT_TRUNCATED", array());
                            echo "</a> <br />
\t\t\t\t\t\t";
                        }
                        // line 84
                        echo "\t\t\t\t\t\t<i class=\"fa fa-fw fa-user\"></i> ";
                        echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
                        echo " ";
                        echo $this->getAttribute($context["forumrow"], "LAST_POSTER_FULL", array());
                        echo "
\t\t\t\t\t\t";
                        // line 85
                        if ( !(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null)) {
                            echo "<a href=\"";
                            echo $this->getAttribute($context["forumrow"], "U_LAST_POST", array());
                            echo "\">";
                            echo (isset($context["LAST_POST_IMG"]) ? $context["LAST_POST_IMG"] : null);
                            echo "</a> ";
                        }
                        echo "<br /><i class=\"fa fa-fw fa-clock-o\"></i> ";
                        echo $this->getAttribute($context["forumrow"], "LAST_POST_TIME", array());
                    } else {
                        echo "<span class=\"inventea-no-items\">";
                        echo $this->env->getExtension('phpbb')->lang("NO_POSTS");
                        echo "</span>";
                    }
                    echo "</span>
\t\t\t\t\t</dd>
\t\t\t\t";
                }
                // line 88
                echo "\t\t\t</dl>
\t\t\t";
                // line 89
                // line 90
                echo "\t\t</li>
\t\t";
                // line 91
                // line 92
                echo "\t";
            }
            // line 93
            echo "
\t";
            // line 94
            if ($this->getAttribute($context["forumrow"], "S_LAST_ROW", array())) {
                // line 95
                echo "\t\t\t</ul>

\t\t\t</div>
\t\t</div>
\t";
                // line 99
                // line 100
                echo "\t";
            }
            // line 101
            echo "
";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 103
            echo "\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t\t<strong>";
            // line 105
            echo $this->env->getExtension('phpbb')->lang("NO_FORUMS");
            echo "</strong>
\t\t</div>
\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['forumrow'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "forumlist_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  380 => 105,  376 => 103,  370 => 101,  367 => 100,  366 => 99,  360 => 95,  358 => 94,  355 => 93,  352 => 92,  351 => 91,  348 => 90,  347 => 89,  344 => 88,  325 => 85,  318 => 84,  308 => 82,  306 => 81,  304 => 80,  297 => 79,  289 => 77,  287 => 76,  280 => 75,  278 => 74,  270 => 71,  264 => 70,  261 => 69,  259 => 68,  251 => 67,  249 => 66,  245 => 64,  241 => 62,  232 => 60,  230 => 59,  222 => 58,  220 => 57,  217 => 56,  215 => 55,  212 => 54,  209 => 53,  207 => 52,  201 => 51,  180 => 50,  176 => 49,  170 => 48,  168 => 47,  165 => 46,  156 => 44,  153 => 43,  148 => 42,  141 => 41,  135 => 40,  132 => 39,  114 => 38,  111 => 37,  105 => 36,  100 => 34,  95 => 33,  94 => 32,  91 => 31,  89 => 30,  87 => 29,  84 => 28,  82 => 27,  76 => 23,  75 => 22,  70 => 20,  66 => 19,  54 => 18,  51 => 17,  50 => 16,  44 => 12,  41 => 11,  40 => 10,  37 => 9,  30 => 4,  27 => 3,  22 => 2,  19 => 1,);
    }
}
