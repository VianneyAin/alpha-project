<?php

/* user_welcome_inactive.txt */
class __TwigTemplate_7e8ed120165540c7279f494e867cdaea91299184f6aac8083cef6dd639408f90 extends Twig_Template
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
        echo "Subject: Bienvenue sur les forums de « ";
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo " »
 
";
        // line 3
        echo (isset($context["WELCOME_MSG"]) ? $context["WELCOME_MSG"] : null);
        echo "

Conservez cet e-mail dans vos archives. Les informations de votre compte sont les suivantes :

----------------------------
Nom d’utilisateur : ";
        // line 8
        echo (isset($context["USERNAME"]) ? $context["USERNAME"] : null);
        echo "

Adresse du forum : ";
        // line 10
        echo (isset($context["U_BOARD"]) ? $context["U_BOARD"] : null);
        echo "
----------------------------

Cliquez sur le lien suivant afin d’activer votre compte :

";
        // line 15
        echo (isset($context["U_ACTIVATE"]) ? $context["U_ACTIVATE"] : null);
        echo "

Votre mot de passe a été stocké de manière sécurisée dans notre base de données et ne pourra pas être retrouvé. Dans le cas où vous l’auriez oublié, vous pourrez le réinitialiser en utilisant l’adresse e-mail associée à votre compte.

Merci de vous être enregistré.

";
        // line 21
        echo (isset($context["EMAIL_SIG"]) ? $context["EMAIL_SIG"] : null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "user_welcome_inactive.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 21,  46 => 15,  38 => 10,  33 => 8,  25 => 3,  19 => 1,);
    }
}
