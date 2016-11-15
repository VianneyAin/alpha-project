<?php
/*
Plugin Name: Custom Alpha Project Plugin
Plugin URI: http://alpha-project.fr
Description: Un custom plugin pour Alpha Project
Version: 0.1
Author: Vianney Aïn
Author URI: http://vianneyain.com
License: GPL2
*/
class Custom_Plugin
{
	public function __construct()
	{
	    include_once plugin_dir_path( __FILE__ ).'/teamspeak.php';
	    include_once plugin_dir_path( __FILE__ ).'/facebook.php';
	    include_once plugin_dir_path( __FILE__ ).'/rust.php';
	    new Custom_Teamspeak();
	    new Custom_Facebook();
	    new Custom_Rust();
	}
}
new Custom_Plugin();