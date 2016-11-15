<?php
/**
 * YP Text
 *
 * Example:
 * [yp_text boxed="false"]My Text[/yp_text]
 */
add_shortcode("yp_text", "yp_text");
function yp_text($atts, $content = null) {
    extract(shortcode_atts(array(
        "boxed" => false,
        "class" => ""
    ), $atts));

    if(yp_check($boxed)) {
      $class .= " container";
    }

    return "<div class='" . yp_sanitize_class($class) . "'>" . do_shortcode(yp_fix_content($content)) . "</div>";
}



/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_yp_text" );
function vc_yp_text() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name" => __("YP Text Block", "youplay"),
           "base" => "yp_text",
           "controls" => "full",
           "category" => "Youplay",
           "icon" => "icon-youplay",
           "params" => array(
              array(
                 "type"        => "textarea_html",
                 "heading"     => __("Inner Text", "youplay"),
                 "param_name"  => "content",
                 "holder"      => "div",
                 "value"       => __("", "youplay"),
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