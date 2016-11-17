<?php

/* user_activate_passwd.txt */
class __TwigTemplate_c94e7a6ad00e6c3511032c1ad73612e7b7980f4b0d60b887678f6568d51d2c41 extends Twig_Template
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
        echo "Subject: Activation du nouveau mot de passe

Bonjour ";
        // line 3
        echo (isset($context["USERNAME"]) ? $context["USERNAME"] : null);
        echo "

Vous recevez cette notification car vous avez (ou quelqu’un qui prétend être vous) demandé qu’un nouveau mot de passe vous soit envoyé pour votre compte sur « ";
        // line 5
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo " ». Si vous n’êtes pas à l'origne de cette demande, vous pouvez l’ignorer. Si vous continuez à recevoir ce type de notification, contactez l’administrateur du forum.

Pour utiliser le nouveau mot de passe, vous avez besoin de l’activer. Pour ce faire, cliquez sur le lien fourni ci-dessous.

";
        // line 9
        echo (isset($context["U_ACTIVATE"]) ? $context["U_ACTIVATE"] : null);
        echo "

Si cela réussit, vous pourrez vous connecter avec le mot de passe suivant :

Mot de passe : ";
        // line 13
        echo (isset($context["PASSWORD"]) ? $context["PASSWORD"] : null);
        echo "

Vous pouvez bien sûr changer vous-même ce mot de passe en passant par le panneau de l’utilisateur. Si vous rencontrez des difficultés, contactez l’administrateur du forum.

";
        // line 17
        echo (isset($context["EMAIL_SIG"]) ? $context["EMAIL_SIG"] : null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "user_activate_passwd.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 17,  42 => 13,  35 => 9,  28 => 5,  23 => 3,  19 => 1,);
    }
}
