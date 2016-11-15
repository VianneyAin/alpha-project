<?php
/**
 * YP Single Image
 *
 * Example:
 * [yp_single_image img_src="14" img_size="500x375" link_to_full_image="true" icon="fa fa-search-plus" center="false"]
 */
add_shortcode("yp_single_image", "yp_single_image");
function yp_single_image($atts, $content = null) {
    extract(shortcode_atts(array(
        "img_src"            => "",
        "img_size"           => "500x375",
        "link_to_full_image" => true,
        "icon"               => "fa fa-search-plus",
        "center"             => false,
        "class"              => ""
    ), $atts));

    $img = $img_full = $img_src;
    $icon = yp_check($icon) ? "<span class='" . yp_sanitize_class($icon) . " icon'></span>" : "";
    $max_width = '';
    $before = $after = '';

    if(is_numeric($img_src)) {
      $img = wp_get_attachment_image_src( $img_src, $img_size );
      $img = $img[0];
      $img_full = yp_check($link_to_full_image) ? wp_get_attachment_image_src( $img_src, "full" ) : "";
      $img_full = $img_full[0];
      $max_width = "style='width: " . esc_attr($img[1]) . "px;'";
    }

    if($center) {
      $before = '<div class="align-center">';
      $after = '</div>';
    }

    return $before . "<a href='" . esc_url(yp_check($link_to_full_image) ? $img_full : "#!") . "' " . $max_width . " class='angled-img image-popup " . yp_sanitize_class($class) . "'>
              <div class='img'>
                <img src='" . esc_url($img) . "' alt=''>
              </div>
              $icon
            </a>" . $after;
}



/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_yp_single_image" );
function vc_yp_single_image() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name" => __("YP Single Image", "youplay"),
           "base" => "yp_single_image",
           "controls" => "full",
           "category" => "Youplay",
           "icon" => "icon-youplay",
           "params" => array(
              array(
                 "type" => "attach_image",
                 "heading" => __("Image", "youplay"),
                 "param_name" => "img_src",
                 "value" => __("", "youplay"),
                 "description" => "",
              ),
              array(
                 "type" => "dropdown",
                 "heading" => __("Image Size", "youplay"),
                 "param_name" => "img_size",
                 "value" => get_intermediate_image_sizes(),
                 "std" => "500x375",
                 "description" => ""
              ),
              array(
                 "type" => "iconpicker",
                 "heading" => __("Icon", "youplay"),
                 "param_name" => "icon",
                 "value" => "fa fa-search-plus"
              ),
              array(
                  "type" => "checkbox",
                  "heading" => __( "Link to Full Image", "youplay" ),
                  "param_name" => "link_to_full_image",
                  "value" => array( __( "", "youplay" ) => true )
              ),
              array(
                  "type" => "checkbox",
                  "heading" => __( "Center", "youplay" ),
                  "param_name" => "center",
                  "value" => array( __( "", "youplay" ) => true )
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