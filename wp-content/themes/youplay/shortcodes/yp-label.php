<?php
/**
 * YP Label
 *
 * Example:
 * [yp_label color="default" text="Label"]
 */
add_shortcode("yp_label", "yp_label");
function yp_label($atts, $content = null) {
    extract(shortcode_atts(array(
        "color"    => "default",
        "text"     => "Label",
        "class"    => ""
    ), $atts));

    return '<span class="label ' . yp_sanitize_class($class . ' label-' . $color) . '">' . esc_html($text) . '</span>';
}



/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_youplay_label" );
function vc_youplay_label() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name"     => __("YP Label", "youplay"),
           "base"     => "yp_label",
           "controls" => "full",
           "category" => "Youplay",
           "icon"     => "icon-youplay",
           "params"   => array(
              array(
                 "type"        => "textfield",
                 "heading"     => __("Inner Text", "youplay"),
                 "param_name"  => "text",
                 "value"       => __("Label", "youplay"),
                 "description" => "",
              ),
              array(
                 "type"       => "dropdown",
                 "heading"    => __("Color", "youplay"),
                 "param_name" => "color",
                 "value"      => array(
                    __("Default", "youplay") => "",
                    __("Primary", "youplay") => "primary",
                    __("Success", "youplay") => "success",
                    __("Info", "youplay")    => "info",
                    __("Warning", "youplay") => "warning",
                    __("Danger", "youplay")  => "danger",
                 ),
                 "description" => ""
              ),
              array(
                 "type"        => "checkbox",
                 "heading"     => __("Boxed", "youplay"),
                 "param_name"  => "boxed",
                 "value"       => array( __( "", "youplay" ) => true ),
                 "description" => "Use it when your page content boxed disabled",
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Custom Classes", "youplay"),
                 "param_name"  => "class",
                 "value"       => __("", "youplay"),
                 "description" => "",
              ),
           )
        ) );
    }
}