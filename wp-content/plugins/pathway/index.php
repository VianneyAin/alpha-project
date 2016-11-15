<?php
/** 
 * Plugin Name: Pathway
 * Plugin URI: http://vennerlabs.com/
 * Description: Custom Wordpress Login Page. Yohooowh !
 * Version: 1.0.6
 * Author: VENNERCONCEPT.
 * Author URI: http://vennerlabs.com/
 * Logo Location: http://vennerlabs.com/
 * Logo Link: http://vennerlabs.com/
 */

/*-----------------------------------------------------------------------------------*/
/*	Define Path
/*-----------------------------------------------------------------------------------*/

$vc_config 	= WP_PLUGIN_URL . '/' . str_replace( '/' . basename( __FILE__ ), '', plugin_basename( __FILE__ ) );
define('PW_DIR', ABSPATH . '/wp-content/plugins/' . str_replace( '/' . basename( __FILE__ ), '', plugin_basename( __FILE__ ) ));
define('PW_FILEPATH', $vc_config);
define('PW_DIRECTORY', $vc_config);

/*-----------------------------------------------------------------------------------*/
/*	Admin Theme Option
/*-----------------------------------------------------------------------------------*/
include (PW_DIR.'/admin/admin-functions.php');
include (PW_DIR.'/admin/admin-interface.php');
include (PW_DIR.'/admin/theme-options.php');
include (PW_DIR.'/admin/theme-functions.php');
include (PW_DIR.'/admin/pw-functions.php'); 

/*-----------------------------------------------------------------------------------*/
/*	WP Action and Theme functions
/*-----------------------------------------------------------------------------------*/
add_action( 'login_head', 'pw_theme_head' );
add_action( 'login_form', 'pw_theme_foot' );
add_action( 'lostpassword_form', 'pw_theme_lostpassword' );

function pw_login_url($url) {
	return home_url();
}

function pw_login_title($url) {
	return get_option('blogname');
}

add_filter( 'login_headerurl', 'pw_login_url');
add_filter( 'login_headertitle', 'pw_login_title');
/**/
?>