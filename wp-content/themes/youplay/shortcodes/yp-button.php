<?php
/**
 * YP Buttons
 *
 * Example:
 * [yp_button href="http://nkdev.info" size="lg" full_width="false" active="false" color="success" icon_before="fa fa-html5" icon_after=""]Youplay[/yp_button]
 *
 * Group Example:
 * [yp_button_group]
 *   [yp_button href="http://nkdev.info" size="lg" full_width="false" active="false" color="success" icon_before="fa fa-html5" icon_after=""]Youplay 1[/yp_button]
 *   [yp_button href="http://nkdev.info" size="lg" full_width="false" active="false" color="success" icon_before="fa fa-css3" icon_after=""]Youplay 2[/yp_button]
 * [/yp_button_group]
 */
add_shortcode("yp_button", "yp_button");
function yp_button($atts, $content = null) {
    extract(shortcode_atts(array(
        "href"        => "#!",
        "size"        => "",
        "full_width"  => false,
        "active"      => false,
        "color"       => "",
        "icon_before" => "",
        "icon_after"  => "",
        "class"       => ""
    ), $atts));

    if(yp_check($size)) {
      $class .= ' btn-' . $size;
    }

    if(yp_check($full_width)) {
      $class .= ' btn-full';
    }

    if(yp_check($active)) {
      $class .= ' active';
    }

    if(yp_check($color)) {
      $class .= ' btn-' . $color;
    }

    $icon_before = yp_check($icon_before) ? "<span class='" . yp_sanitize_class($icon_before) . "'></span>" : "";
    $icon_after = yp_check($icon_after) ? "<span class='" . yp_sanitize_class($icon_after) . "'></span>" : "";

    return "<a class='btn " . yp_sanitize_class($class) . "' href='" . esc_url($href) . "'>" . $icon_before . " " . esc_html($content) . " " . $icon_after . "</a>";
}

// buttons group
add_shortcode("yp_button_group", "yp_button_group");
function yp_button_group($atts, $content = null) {
    return "<div class='btn-group'>
              " . do_shortcode(yp_fix_content($content)) . "
            </div>";
}



/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_youplay_button" );
function vc_youplay_button() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name"     => __("YP Button", "youplay"),
           "base"     => "yp_button",
           "controls" => "full",
           "category" => "Youplay",
           "icon"     => "icon-youplay",
           "params"   => array(
              array(
                 "type"        => "textfield",
                 "heading"     => __("Inner Text", "youplay"),
                 "param_name"  => "content",
                 "value"       => __("Youplay", "youplay"),
                 "description" => "",
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Link", "youplay"),
                 "param_name"  => "href",
                 "value"       => __("http://nkdev.info", "youplay"),
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
                    __("Info", "youplay")    => "info",
                    __("Warning", "youplay") => "warning",
                    __("Danger", "youplay")  => "danger",
                 ),
                 "description" => ""
              ),
              array(
                 "type"       => "dropdown",
                 "heading"    => __("Size", "youplay"),
                 "param_name" => "size",
                 "value"      => array(
                    __("Default", "youplay")     => "",
                    __("Large", "youplay")       => "lg",
                    __("Small", "youplay")       => "sm",
                    __("Extra Small", "youplay") => "xs",
                 ),
                 "description" => ""
              ),
              array(
                  "type"       => "checkbox",
                  "heading"    => __( "Full Width", "youplay" ),
                  "param_name" => "full_width",
                  "value"      => array( __( "", "youplay" ) => true )
              ),
              array(
                  "type"       => "checkbox",
                  "heading"    => __( "Active", "youplay" ),
                  "param_name" => "active",
                  "value"      => array( __( "", "youplay" ) => true )
              ),
              array(
                 "type"        => "iconpicker",
                 "heading"     => __("Icon Before", "youplay"),
                 "param_name"  => "icon_before",
                 "value"       => __("fa fa-html5", "youplay"),
                 "description" => "Insert icon before inner text.",
              ),
              array(
                 "type"        => "iconpicker",
                 "heading"     => __("Icon After", "youplay"),
                 "param_name"  => "icon_after",
                 "value"       => __("", "youplay"),
                 "description" => "Insert icon after inner text.",
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