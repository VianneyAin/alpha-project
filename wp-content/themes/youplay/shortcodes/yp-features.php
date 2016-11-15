<?php
/**
 * YP Features
 *
 * Example:
 * [yp_features title="Youplay" description="Description" icon="fa fa-css3" boxed="false"]
 */
add_shortcode("yp_features", "yp_features");
function yp_features($atts, $content = null) {
    extract(shortcode_atts(array(
        "icon"        => "fa fa-css3",
        "title"       => "Youplay",
        "description" => "Description",
        "boxed"       => false,
        "class"       => ""
    ), $atts));

    if(yp_check($boxed)) {
        $class .= " container";
    }

    return '<div class="youplay-features ' . yp_sanitize_class($class) . '"><div class="feature angled-bg">
              <i class="' . yp_sanitize_class($icon) . '"></i>
              <h3>' . esc_html($title) . '</h3>
              <small>' . esc_html($description) . '</small>
            </div></div>';
}



/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_youplay_features" );
function vc_youplay_features() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name"     => __("YP Features", "youplay"),
           "base"     => "yp_features",
           "controls" => "full",
           "category" => "Youplay",
           "icon"     => "icon-youplay",
           "params"   => array(
              array(
                 "type"        => "textfield",
                 "heading"     => __("Title", "youplay"),
                 "param_name"  => "title",
                 "value"       => __("Youplay", "youplay"),
                 "description" => "",
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Description", "youplay"),
                 "param_name"  => "description",
                 "value"       => __("Description", "youplay"),
                 "description" => '',
              ),
              array(
                 "type"        => "iconpicker",
                 "heading"     => __("Icon", "youplay"),
                 "param_name"  => "icon",
                 "value"       => __("fa fa-css3", "youplay"),
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