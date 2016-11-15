<?php
/**
 * YP Banner
 *
 * Example:
 * [yp_banner img_src="14" img_size="1400x600" banner_size="mid" top_position="false" img_cover="false" boxed="false"]Content[/yp_banner]
 */
add_shortcode("yp_banner", "yp_banner");
function yp_banner($atts, $content = null) {
    STATIC $i = 0;
    $i++;

    extract(shortcode_atts(array(
        "img_src"      => "",
        "img_size"     => "1400x600",
        "img_cover"    => false,
        "banner_size"  => "",
        "top_position" => false,
        "boxed"        => false,
        "class"        => ""
    ), $atts));

    if(is_numeric($img_src)) {
      $img_src = wp_get_attachment_image_src( $img_src, $img_size );
      $img_src = $img_src[0];
    }

    // parallax for image
    $imageParallax = yp_check($top_position)
                    ? "data-top='background-position: 50% 0px;' data-top-bottom='background-position: 50% -200px;'"
                    : "data-top-bottom='background-position: 50% -150px;' data-bottom-top='background-position: 50% 150px;'";

    // parallax for info when top banner
    $infoParallax = yp_check($top_position)
                   ? "data-top='opacity: 1; transform: translate3d(0px,0px,0px);'
                      data-top-bottom='opacity: 0; transform: translate3d(0px,150px,0px);'
                      data-anchor-target='.youplay-banner-id-" . intval($i) . "'"
                   : "";

    $class .= ' youplay-banner youplay-banner-id-' . intval($i);

    $class .= ' ' . $banner_size;

    if(yp_check($top_position)) {
      $class .= ' banner-top';
    }

    if(yp_check($boxed)) {
      $class .= ' container';
    }

    return "<div class='" . yp_sanitize_class($class) . "'>
              <div class='image " . (yp_check($img_cover)?'cover-bg':'') . "' style='background-image: url(" . esc_url($img_src) . ");' " . $imageParallax . "></div>

              <div class='info' " . $infoParallax . ">
                <div>
                  <div class='container'>
                    " . do_shortcode(yp_fix_content($content)) . "
                  </div>
                </div>
              </div>
            </div>";
}



/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_yp_banner" );
function vc_yp_banner() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name"              => __("YP Banner", "youplay"),
           "base"              => "yp_banner",
           "controls"          => "full",
           "category"          => "Youplay",
           "icon"              => "icon-youplay",
           "admin_enqueue_css" => get_template_directory_uri() . "/shortcodes/css/yp-banner-vc-view.css",
           "params"            => array(
              array(
                 "type"        => "textarea_html",
                 "heading"     => __("Inner Text", "youplay"),
                 "param_name"  => "content",
                 "value"       => __("<h2>Youplay</h2>", "youplay"),
                 "description" => "",
              ),
              array(
                 "type"       => "attach_image",
                 "heading"    => __("Image", "youplay"),
                 "param_name" => "img_src",
                 "value"      => __("", "youplay")
              ),
              array(
                 "type"       => "dropdown",
                 "heading"    => __("Image Size", "youplay"),
                 "param_name" => "img_size",
                 "value"      => get_intermediate_image_sizes(),
                 "std"        => "1400x645"
              ),
              array(
                 "type"       => "dropdown",
                 "heading"    => __("Banner Size", "youplay"),
                 "param_name" => "banner_size",
                 "value"      => array(
                    __("Full", "youplay")        => "full",
                    __("Mid", "youplay")         => "mid",
                    __("Small", "youplay")       => "small",
                    __("Extra Small", "youplay") => "xsmall",
                 ),
                 "std"        => __("Mid", "youplay")
              ),
              array(
                  "type"        => "checkbox",
                  "heading"     => __( "Top Position", "youplay" ),
                  "param_name"  => "top_position",
                  "value"       => array( __( "", "youplay" ) => true ),
                  "description" => __( "Check it if banner on the top of page.", "youplay" )
              ),
              array(
                  "type"        => "checkbox",
                  "heading"     => __( "Image Cover", "youplay" ),
                  "param_name"  => "img_cover",
                  "value"       => array( __( "", "youplay" ) => true )
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