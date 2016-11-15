<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Youplay
 */
?><!DOCTYPE html>
<!--[if lt IE 7]>  <html class="lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php if ( yp_opts('general_favicon') ): ?>
        <link rel="shortcut icon" href="<?php echo esc_url(yp_opts('general_favicon')); ?>" />
    <?php endif; ?>

    <style><?php yp_opts_e('general_custom_css'); ?></style>
    <script><?php yp_opts_e('general_custom_js'); ?></script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


    <?php if ( yp_opts('general_preloader') ): ?>
        <!-- Preloader -->
        <div class="page-preloader preloader-wrapp">
            <?php if ( yp_opts('general_logo') ): ?>
                <img src="<?php echo esc_url(yp_opts('general_logo')); ?>" alt="">
            <?php endif; ?>
            <div class="preloader"></div>
        </div>
        <!-- /Preloader -->
    <?php endif; ?>


    <!-- Navbar -->
    <nav class="navbar-youplay navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="off-canvas" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php //if ( yp_opts('general_logo') && yp_opts('navigation_logo') ): ?>
                    <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>">
                        <img src="<?php echo esc_url(yp_opts('general_logo')); ?>" alt="">
                    </a>
                <?php //endif; ?>
            </div>
            
            <div id="navbar" class="navbar-collapse collapse">
                <?php wp_nav_menu(array(
                    'theme_location'  => 'primary',
                    'container'       => '',
                    'menu_class'      => 'nav navbar-nav',
                    'walker'          => new nk_walker()
                ) ); ?>

                <?php if (yp_opts('navigation_search')) : ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="search-toggle"><a href="#" role="button" aria-expanded="false"><span class="glyphicon glyphicon-search"></span></a></li>
                    </ul>
                <?php endif; ?>

                <?php wp_nav_menu(array(
                    'theme_location'  => 'primary-right',
                    'container'       => '',
                    'menu_class'      => 'nav navbar-nav navbar-right',
                    'walker'          => new nk_walker()
                ) ); ?>
            </div>
        </div>
    </nav>
    <!-- /Navbar -->