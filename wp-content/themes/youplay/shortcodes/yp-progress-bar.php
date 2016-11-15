<?php
/**
 * YP Progress Bar
 *
 * Example:
 * [yp_progress stripped="true" percent="40" color="success" boxed="false"]40% Complete (success)[/yp_progress]
 */
add_shortcode("yp_progress", "yp_progress_bar");
function yp_progress_bar($atts, $content = null) {
    extract(shortcode_atts(array(
        "striped" => true,
        "percent" => 0,
        "color"   => "",
        "boxed"   => false,
        "class"   => ""
    ), $atts));

    if(yp_check($boxed)) {
        $class .= " container";
    }

    $striped = yp_check($striped) ? "progress-bar-striped" : "";
    $color = yp_check($color) ? "progress-bar-" . $color : "";

    return "<div class='progress youplay-progress " . yp_sanitize_class($class) . "'>
                <div class='progress-bar " . yp_sanitize_class($color . ' ' . $striped) . "' role='progressbar' aria-valuenow='" . esc_attr($percent) . "' aria-valuemin='0' aria-valuemax='100' style='width: " . esc_attr($percent) . "%'>
                    <span class='sr-only'>" . yp_fix_content($content) . "</span>
                </div>
            </div>";
}



/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_youplay_progress" );
function vc_youplay_progress() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name"     => __("YP Progress Bar", "youplay"),
           "base"     => "yp_progress",
           "controls" => "full",
           "category" => "Youplay",
           "icon"     => "icon-youplay",
           "params"   => array(
              array(
                 "type"        => "textfield",
                 "heading"     => __("Screen Reader Text", "youplay"),
                 "param_name"  => "content",
                 "value"       => __("40% Complete (success)", "youplay"),
                 "description" => "",
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Percent", "youplay"),
                 "param_name"  => "percent",
                 "value"       => __("40", "youplay"),
                 "description" => '',
              ),
              array(
                 "type"       => "dropdown",
                 "heading"    => __("Color", "youplay"),
                 "param_name" => "color",
                 "value"      => array(
                    __("Default", "youplay") => "",
                    __("Primary", "youplay") => "primary",
                    __("Success", "youplay") => "success",
                    __("Info", "youplay") => "info",
                    __("Warning", "youplay") => "warning",
                    __("Danger", "youplay") => "danger",
                 ),
                 "description" => ""
              ),
              array(
                  "type"       => "checkbox",
                  "heading"    => __( "Striped", "youplay" ),
                  "param_name" => "striped",
                  "value"      => array( __( "", "youplay" ) => true )
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