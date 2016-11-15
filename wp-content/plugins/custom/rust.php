<?php
require_once( trailingslashit( get_template_directory() ). 'includes/widgets/rust_widget.php');

class Custom_Rust
{
    public function __construct()
    {
        add_action('widgets_init', function(){register_widget('Rust_Widget');});
    }
}