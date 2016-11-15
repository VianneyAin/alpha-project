<?php
require_once( trailingslashit( get_template_directory() ). 'includes/widgets/teamspeak_widget.php');

class Custom_Teamspeak
{
    public function __construct()
    {
        add_action('widgets_init', function(){register_widget('Teamspeak_Widget');});
    }
}