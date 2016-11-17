<?php

/* topic_notify.txt */
class __TwigTemplate_00ba1bc3a480359b6cf63720e2444ba1da9795c9be8e617f1829ebbc63002d5e extends Twig_Template
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
        echo "Subject: Notification de nouveau message dans le sujet - ";
        echo (isset($context["TOPIC_TITLE"]) ? $context["TOPIC_TITLE"] : null);
        echo "

Bonjour ";
        // line 3
        echo (isset($context["USERNAME"]) ? $context["USERNAME"] : null);
        echo ",

Vous recevez cette notification car vous surveillez le sujet « ";
        // line 5
        echo (isset($context["TOPIC_TITLE"]) ? $context["TOPIC_TITLE"] : null);
        echo " » sur « ";
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo " ». Depuis votre dernière visite, ce sujet a reçu une réponse";
        if (((isset($context["AUTHOR_NAME"]) ? $context["AUTHOR_NAME"] : null) !== "")) {
            echo " de ";
            echo (isset($context["AUTHOR_NAME"]) ? $context["AUTHOR_NAME"] : null);
        }
        echo ". Aucune autre notification ne vous sera envoyée jusqu’à votre prochaine visite sur le sujet.

Pour consulter le premier message non lu, cliquez sur le lien suivant :
";
        // line 8
        echo (isset($context["U_NEWEST_POST"]) ? $context["U_NEWEST_POST"] : null);
        echo "

Pour consulter le sujet dans son ensemble, cliquez sur le lien suivant :
";
        // line 11
        echo (isset($context["U_TOPIC"]) ? $context["U_TOPIC"] : null);
        echo "

Pour visiter le forum, cliquez sur le lien suivant :
";
        // line 14
        echo (isset($context["U_FORUM"]) ? $context["U_FORUM"] : null);
        echo "

Si vous ne souhaitez plus surveiller ce sujet, vous pouvez cliquer sur le lien « Arrêter de surveiller ce sujet » en bas du sujet indiqué ci-dessus, ou bien sur le lien suivant :

";
        // line 18
        echo (isset($context["U_STOP_WATCHING_TOPIC"]) ? $context["U_STOP_WATCHING_TOPIC"] : null);
        echo "

";
        // line 20
        echo (isset($context["EMAIL_SIG"]) ? $context["EMAIL_SIG"] : null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "topic_notify.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 20,  62 => 18,  55 => 14,  49 => 11,  43 => 8,  30 => 5,  25 => 3,  19 => 1,);
    }
}
