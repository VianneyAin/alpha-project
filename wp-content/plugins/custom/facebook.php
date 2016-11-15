<?php
require_once( trailingslashit( get_template_directory() ). 'includes/widgets/facebook_widget.php');

class Custom_Facebook
{
    public function __construct()
    {
        add_action('widgets_init', function(){register_widget('Facebook_Widget');});
    }
}