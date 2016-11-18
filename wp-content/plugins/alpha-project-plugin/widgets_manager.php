<?php
include_once plugin_dir_path( __FILE__ ).'/widgets/home_articles.php';

class Widget_Manager
{
    public function __construct()
    {
        add_action('widgets_init', function(){register_widget('Home_Articles_Widget');});
    }

}
