<?php
/**
 * YP Alert
 *
 * Example:
 * [yp_alert color="primary" dismissible="false" boxed="false"]<strong>Well done!</strong> You successfully read this important alert message.[/yp_alert]
 */
add_shortcode("yp_alert", "yp_alert");
function yp_alert($atts, $content = "<strong>Well done!</strong> You successfully read this important alert message.") {
    extract(shortcode_atts(array(
        "color"       => "primary",
        "dismissible" => false,
        "boxed"       => false,
        "class"       => ""
    ), $atts));

    if(yp_check($boxed)) {
        $class .= " container";
    }

    $dismissible_btn = yp_check($dismissible)?'<button type="button" class="close" data-dismiss="alert" aria-label="' . __("Close", "youplay") . '"><span aria-hidden="true">&times;</span></button>':'';

    $class .= ' alert-' . $color;

    if(yp_check($dismissible)) {
      $class .= ' alert-dismissible';
    }

    return '<div class="alert ' . yp_sanitize_class($class) . '" role="alert">' . $dismissible_btn . do_shortcode(yp_fix_content($content)) . '</div>';
}



/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_youplay_alert" );
function vc_youplay_alert() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name"     => __("YP Alert", "youplay"),
           "base"     => "yp_alert",
           "controls" => "full",
           "category" => "Youplay",
           "icon"     => "icon-youplay",
           "params"   => array(
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
                  "type"       => "checkbox",
                  "heading"    => __( "Dismissible", "youplay" ),
                  "param_name" => "dismissible",
                  "value"      => array( __( "", "youplay" ) => true )
              ),
              array(
                 "type"        => "textarea_html",
                 "heading"     => __("Inner Text", "youplay"),
                 "param_name"  => "content",
                 "value"       => __("<strong>Well done!</strong> You successfully read this important alert message.", "youplay"),
                 "description" => "",
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