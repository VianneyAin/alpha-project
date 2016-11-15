<?php
/**
 * Youplay Plugins Activation
 *
 * @package Youplay
 */
require get_template_directory() . '/inc/lib/class-tgm-plugin-activation.php';


/**
 * Register Required Plugins
 */
add_action( 'tgmpa_register', 'youplay_register_required_plugins' );
function youplay_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // Visual Composer
        array(
            'name'               => 'WPBakery Visual Composer',
            'slug'               => 'js_composer',
            'source'             => get_template_directory() . '/inc/plugins/js_composer.zip',
            'required'           => true
        ),

        // Rev Slider
        array(
            'name'               => 'Revolution Slider',
            'slug'               => 'revslider',
            'source'             => get_template_directory() . '/inc/plugins/revslider.zip',
            'required'           => false
        ),

        // WooCommerce
        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
            'version'   => '2.3.10'
        ),

        // bbPress
        array(
            'name'      => 'bbPress',
            'slug'      => 'bbpress',
            'required'  => false,
            'version'   => '2.5.7'
        ),

    );

    $config = array(
        
        'default_path'      => '',      /* Default absolute path to pre-packaged plugins */
        'has_notices'       => true,    /* Show admin notices or not */
        'is_automatic'      => true,    /* Automatically activate plugins after installation or not */
       
    );

    tgmpa( $plugins, $config );

}