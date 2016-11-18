<?php
/*
Plugin Name: Alpha Project plugin
Plugin URI: http://alpha-project.fr
Description: Un custom plugin dev par la team AP
Version: 0.1
Author: Rip Red & Draker
Author URI: http://alpha-project.fr
License: None
*/

class Alpha_Project_Plugin
{
    public function __construct()
    {
        include_once plugin_dir_path( __FILE__ ).'widgets_manager.php';
        new Widget_Manager();
    }

}

new Alpha_Project_Plugin();
