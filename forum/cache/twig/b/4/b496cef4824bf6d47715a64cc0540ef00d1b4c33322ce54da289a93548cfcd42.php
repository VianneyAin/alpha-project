<?php

/* user_activate.txt */
class __TwigTemplate_b496cef4824bf6d47715a64cc0540ef00d1b4c33322ce54da289a93548cfcd42 extends Twig_Template
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
        echo "Subject: Réactivez votre compte

Bonjour ";
        // line 3
        echo (isset($context["USERNAME"]) ? $context["USERNAME"] : null);
        echo ",

Votre compte sur « ";
        // line 5
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo " » a été désactivé, probablement dû aux modifications effectuées dans votre profil. Afin de réactiver votre compte, vous devez cliquer sur le lien ci-dessous :

";
        // line 7
        echo (isset($context["U_ACTIVATE"]) ? $context["U_ACTIVATE"] : null);
        echo "

";
        // line 9
        echo (isset($context["EMAIL_SIG"]) ? $context["EMAIL_SIG"] : null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "user_activate.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 9,  33 => 7,  28 => 5,  23 => 3,  19 => 1,);
    }
}
