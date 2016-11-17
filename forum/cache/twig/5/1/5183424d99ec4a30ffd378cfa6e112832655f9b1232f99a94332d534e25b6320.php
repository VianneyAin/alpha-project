<?php

/* privmsg_notify.txt */
class __TwigTemplate_5183424d99ec4a30ffd378cfa6e112832655f9b1232f99a94332d534e25b6320 extends Twig_Template
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
        echo "Subject: Un nouveau message privé vient d’arriver

Bonjour ";
        // line 3
        echo (isset($context["USERNAME"]) ? $context["USERNAME"] : null);
        echo ",

Vous avez reçu un nouveau message privé de « ";
        // line 5
        echo (isset($context["AUTHOR_NAME"]) ? $context["AUTHOR_NAME"] : null);
        echo " » sur « ";
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo " » ayant pour objet :

";
        // line 7
        echo (isset($context["SUBJECT"]) ? $context["SUBJECT"] : null);
        echo "

Vous pouvez consulter votre nouveau message en cliquant sur le lien suivant :

";
        // line 11
        echo (isset($context["U_VIEW_MESSAGE"]) ? $context["U_VIEW_MESSAGE"] : null);
        echo "

Vous avez demandé à recevoir ce type de notification, rappelez-vous que vous pouvez choisir de ne plus être notifié de l’arrivée de nouveaux messages privés en modifiant l’option appropriée dans votre profil.

";
        // line 15
        echo (isset($context["EMAIL_SIG"]) ? $context["EMAIL_SIG"] : null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "privmsg_notify.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 15,  42 => 11,  35 => 7,  28 => 5,  23 => 3,  19 => 1,);
    }
}
