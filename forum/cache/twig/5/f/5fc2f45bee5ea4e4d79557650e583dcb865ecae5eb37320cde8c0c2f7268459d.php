<?php

/* quote.txt */
class __TwigTemplate_5fc2f45bee5ea4e4d79557650e583dcb865ecae5eb37320cde8c0c2f7268459d extends Twig_Template
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
        echo "Subject: Notification de citation dans le sujet - ";
        echo (isset($context["TOPIC_TITLE"]) ? $context["TOPIC_TITLE"] : null);
        echo "

Bonjour ";
        // line 3
        echo (isset($context["USERNAME"]) ? $context["USERNAME"] : null);
        echo ",

Vous recevez cette notification car « ";
        // line 5
        echo (isset($context["AUTHOR_NAME"]) ? $context["AUTHOR_NAME"] : null);
        echo " » vous a cité dans le sujet « ";
        echo (isset($context["TOPIC_TITLE"]) ? $context["TOPIC_TITLE"] : null);
        echo " » sur « ";
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo " ».

Pour consulter le message cité, cliquez sur le lien suivant :
";
        // line 8
        echo (isset($context["U_VIEW_POST"]) ? $context["U_VIEW_POST"] : null);
        echo "

Pour consulter le sujet, cliquez sur le lien suivant :
";
        // line 11
        echo (isset($context["U_TOPIC"]) ? $context["U_TOPIC"] : null);
        echo "

Pour consulter le forum, cliquez sur le lien suivant :
";
        // line 14
        echo (isset($context["U_FORUM"]) ? $context["U_FORUM"] : null);
        echo "

Si vous ne souhaitez plus recevoir de notifications des messages vous citant, veuillez modifier vos paramètres de notifications en cliquant sur le lien suivant :

";
        // line 18
        echo (isset($context["U_NOTIFICATION_SETTINGS"]) ? $context["U_NOTIFICATION_SETTINGS"] : null);
        echo "

";
        // line 20
        echo (isset($context["EMAIL_SIG"]) ? $context["EMAIL_SIG"] : null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "quote.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 20,  59 => 18,  52 => 14,  46 => 11,  40 => 8,  30 => 5,  25 => 3,  19 => 1,);
    }
}
