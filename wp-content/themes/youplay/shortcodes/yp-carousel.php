<?php
/**
 * YP Carousel
 *
 * Example:
 * [yp_carousel style="1" width="100%" badges_always_show="false" center="false" boxed="false"]
 *    [yp_carousel_img img_src="88" title="Image 1" href="http://nkdev.info" rating="3" badge_text="Badge 1" badge_color="default" price="$10"]
 *    [yp_carousel_img img_src="85" title="Image 2" href="http://nkdev.info" rating="5" badge_text="Badge 2" badge_color="primary" price="$14"]
 * [/yp_carousel]
 */
add_shortcode("yp_carousel", "yp_carousel");
function yp_carousel($atts, $content = null) {
    if( !yp_check($content) ) {
      return '';
    }

    extract(shortcode_atts(array(
        "style"               => 1,
        "width"               => "100%",
        "badges_always_show"  => false,
        "center"              => false,
        "boxed"               => false,
        "class"               => ""
    ), $atts));

    if(yp_check($boxed)) {
        $class .= " container";
    }

    $cont_class = $class;

    $width = yp_check($width)?'style="max-width:' . esc_attr($width) . '"':'';

    // extract image shortcodes
    preg_match_all( '/yp_carousel_img([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
    $items = array();
    if ( isset( $matches[1] ) ) {
      $items = $matches[1];
    }

    $before = $after = '';
    if($center) {
      $before = '<div class="align-center">';
      $after = '</div>';
      $cont_class .= ' dib';
    }

    // each carousel item
    $result_items = '';
    foreach ( $items as $item ) {
      $item_atts = shortcode_parse_atts($item[0]);
      
      extract(shortcode_atts(array(
        "href"               => "",
        "img_src"            => "",
        "rating"             => "",
        "title"              => "",
        "badge_text"         => "",
        "badge_color"        => "default",
        "price"              => "",
        "class"              => ""
      ), $item_atts));

      $href = yp_check($href) ? "href='" . esc_url($href) . "'" : "";
      $title = yp_check($title) ? "<h4>" . esc_html($title) . "</h4>" : "";
      $img_full = $img_src;

      if(is_numeric($img_src)) {
        $img_full = wp_get_attachment_image_src( $img_src, 'full' );
        $img_full = $img_full[0];
        $img_src = wp_get_attachment_image_src( $img_src, '500x375' );
        $img_src = $img_src[0];
      }

      $badge = "";
      if( yp_check($badge_text) ) {
        $badge = '<div class="badge ' . yp_sanitize_class('bg-' . $badge_color) . (yp_check($badges_always_show)?' show':'') . '">' . esc_html($badge_text) . '</div>';
      }

      // rating
      $rating = yp_get_rating(esc_html($rating));


      if( yp_check($price) ) {
        $price = '<div class="price">' . esc_html($price) . '</div>';
      }

      $item_content = '';
      switch($style) {
        case 2:
          $description = '';
          if( yp_check($price) && yp_check($rating) ) {
            $description =
              '<div class="row">
                <div class="col-xs-6">
                  ' . $rating . '
                </div>
                <div class="col-xs-6">
                  ' . $price . '
                </div>
              </div>';
          } else if( yp_check($price) ) {
            $description = $price;
          } else if( yp_check($rating) ) {
            $description = $rating;
          }

          $item_content = 
            '<a class="angled-img ' . yp_sanitize_class($class) . '" ' . $href . '>
              <div class="img img-offset">
                <img src="' . esc_url($img_src) . '" alt="">
                ' . $badge . '
              </div>
              <div class="bottom-info">
                ' . $title . '
                ' . $description . '
              </div>
            </a>';
          break;

        case 3:
          $item_content = 
            '<a class="angled-img ' . yp_sanitize_class($class) . '" href="' . esc_url($img_full) . '">
              <div class="img">
                <img src="' . esc_url($img_src) . '" alt="">
                ' . $badge . '
              </div>
              <i class="fa fa-search-plus icon"></i>
            </a>';
            break;

        case 4:
          $item_content = 
            '<a href="' . esc_url($img_full) . '" class="angled-img pull-left ' . yp_sanitize_class($class) . '">
              <div class="img">
                <img src="' . esc_url($img_src) . '" alt="">
              </div>
              <i class="fa fa-search-plus icon"></i>
            </a>';
          break;

        default:
          $item_content = 
            '<a class="angled-img ' . yp_sanitize_class($class) . '" ' . $href . '>
              <div class="img">
                <img src="' . esc_url($img_src) . '" alt="">
                ' . $badge . '
              </div>
              <div class="over-info">
                <div>
                  <div>
                    ' . $title . '
                    ' . $rating . '
                    ' . $price . '
                  </div>
                </div>
              </div>
            </a>';
            break;
      }
      
      $result_items .= $item_content;

    }


    switch($style) {
      case 3:
        return '<div class="youplay-carousel gallery-popup ' . yp_sanitize_class($cont_class) . '" ' . $width . '>' . $result_items . '</div>';

      case 4:
        return $before .
            '<div class="youplay-slider gallery-popup ' . yp_sanitize_class($cont_class) . '" ' . $width . '>
              ' . $result_items . '
            </div>' .
            $after;

      default:
        return '<div class="youplay-carousel ' . yp_sanitize_class($cont_class) . '" ' . $width . '>' . $result_items . '</div>';
    }
}

// image for carousel
add_shortcode("yp_carousel_img", "yp_carousel_img");
function yp_carousel_img($atts, $content = null) {
    // full content inside yp_carousel shortcode
    return '';
}


/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_youplay_carousel" );
function vc_youplay_carousel() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name"     => __("YP Carousel", "youplay"),
           "base"     => "yp_carousel",
           "controls" => "full",
           "category" => "Youplay",
           "icon"     => "icon-youplay",
           "as_parent" => array('only' => 'yp_carousel_img'),
           "content_element" => true,
           "show_settings_on_create" => false,
           "admin_enqueue_css"       => get_template_directory_uri() . "/shortcodes/css/yp-carousel-vc-view.css",
           "params"   => array(
              array(
                 "type"       => "dropdown",
                 "heading"    => __("Style", "youplay"),
                 "param_name" => "style",
                 "value"      => array(
                    __("Style 1", "youplay") => 1,
                    __("Style 2", "youplay") => 2,
                    __("Style 3", "youplay") => 3,
                    __("Style 4", "youplay") => 4,
                 ),
                 "description" => ""
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Width", "youplay"),
                 "param_name"  => "width",
                 "value"       => __("100%", "youplay"),
                 "description" => "",
              ),
              array(
                 "type"        => "checkbox",
                 "heading"     => __("Badges Always Show", "youplay"),
                 "param_name"  => "badges_always_show",
                 "value"       => array( __( "", "youplay" ) => true ),
                 "description" => "When unchecked - show only on mouse over",
              ),
              array(
                 "type"        => "checkbox",
                 "heading"     => __("Center", "youplay"),
                 "param_name"  => "center",
                 "value"       => array( __( "", "youplay" ) => true ),
                 "description" => "Only for Style 4",
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
           ),
           "js_view" => 'VcColumnView'
        ) );
    }
}


add_action( "after_setup_theme", "vc_youplay_carousel_img" );
function vc_youplay_carousel_img() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name"     => __("YP Image", "youplay"),
           "base"     => "yp_carousel_img",
           "controls" => "full",
           "category" => "Youplay",
           "icon"     => "icon-youplay",
           "as_child" => array('only' => 'yp_carousel'),
           "content_element" => true,
           "params"   => array(
              array(
                 "type" => "attach_image",
                 "heading" => __("Image", "youplay"),
                 "param_name" => "img_src",
                 "value" => __("", "youplay"),
                 "description" => "",
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Title", "youplay"),
                 "param_name"  => "title",
                 "value"       => __("Youplay", "youplay"),
                 "description" => "Only for Style 1 and 2",
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Link", "youplay"),
                 "param_name"  => "href",
                 "value"       => __("http://nkdev.info", "youplay"),
                 "description" => "Only for Style 1 and 2",
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Rating", "youplay"),
                 "param_name"  => "rating",
                 "value"       => __("", "youplay"),
                 "description" => "Write number from 0 to 5. For example: 1 / 2 / 3.5 / etc... Only for Style 1 and 2",
              ),

              array(
                 "type"        => "textfield",
                 "heading"     => __("Badge Text", "youplay"),
                 "param_name"  => "badge_text",
                 "value"       => __("", "youplay"),
                 "description" => "",
              ),
              array(
                 "type"       => "dropdown",
                 "heading"    => __("Badge Color", "youplay"),
                 "param_name" => "badge_color",
                 "value"      => array(
                    __("Default", "youplay") => "default",
                    __("Primary", "youplay") => "primary",
                    __("Success", "youplay") => "success",
                    __("Info", "youplay")    => "info",
                    __("Warning", "youplay") => "warning",
                    __("Danger", "youplay")  => "danger",
                 ),
                 "description" => ""
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Price", "youplay"),
                 "param_name"  => "price",
                 "value"       => __("", "youplay"),
                 "description" => "Only for Style 1 and 2",
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


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_yp_carousel extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_yp_carousel_img extends WPBakeryShortCode {
    }
}