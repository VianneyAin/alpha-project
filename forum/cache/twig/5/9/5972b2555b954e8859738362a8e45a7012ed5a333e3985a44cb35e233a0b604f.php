<?php

/* contact_admin.txt */
class __TwigTemplate_5972b2555b954e8859738362a8e45a7012ed5a333e3985a44cb35e233a0b604f extends Twig_Template
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
Bonjour ";
        // line 2
        echo (isset($context["TO_USERNAME"]) ? $context["TO_USERNAME"] : null);
        echo ",

Ce qui suit est un e-mail qui vous a été envoyé depuis la page de contact de « ";
        // line 4
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo " ».

";
        // line 6
        if ((isset($context["S_IS_REGISTERED"]) ? $context["S_IS_REGISTERED"] : null)) {
            // line 7
            echo "Le message a été envoyé depuis un compte du forum.
Non d’utilisateur : ";
            // line 8
            echo (isset($context["FROM_USERNAME"]) ? $context["FROM_USERNAME"] : null);
            echo "
Adresse e-mail : ";
            // line 9
            echo (isset($context["FROM_EMAIL_ADDRESS"]) ? $context["FROM_EMAIL_ADDRESS"] : null);
            echo "
Adresse IP : ";
            // line 10
            echo (isset($context["FROM_IP_ADDRESS"]) ? $context["FROM_IP_ADDRESS"] : null);
            echo "
Profil : ";
            // line 11
            echo (isset($context["U_FROM_PROFILE"]) ? $context["U_FROM_PROFILE"] : null);
            echo "
";
        } else {
            // line 13
            echo "Le message a été envoyé par un invité qui a indiqué les informations de contact suivantes :
Nom : ";
            // line 14
            echo (isset($context["FROM_USERNAME"]) ? $context["FROM_USERNAME"] : null);
            echo "
Adresse e-mail : ";
            // line 15
            echo (isset($context["FROM_EMAIL_ADDRESS"]) ? $context["FROM_EMAIL_ADDRESS"] : null);
            echo "
Adresse IP : ";
            // line 16
            echo (isset($context["FROM_IP_ADDRESS"]) ? $context["FROM_IP_ADDRESS"] : null);
            echo "
";
        }
        // line 18
        echo "

Voici le message qui vous a été envoyé :
~~~~~~~~~~~~~~~~~~~~~~~~~~~

";
        // line 23
        echo (isset($context["MESSAGE"]) ? $context["MESSAGE"] : null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "contact_admin.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 23,  70 => 18,  65 => 16,  61 => 15,  57 => 14,  54 => 13,  49 => 11,  45 => 10,  41 => 9,  37 => 8,  34 => 7,  32 => 6,  27 => 4,  22 => 2,  19 => 1,);
    }
}
