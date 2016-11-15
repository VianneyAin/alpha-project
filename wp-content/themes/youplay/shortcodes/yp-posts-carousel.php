<?php
/**
 * YP Carousel
 *
 * Example:
 * [yp_posts_carousel style="1" posts="1,2,3" show_price="true" show_rating="true" show_discount_badges="true" badges_always_show="false" boxed="false"]
 */
add_shortcode("yp_posts_carousel", "yp_posts_carousel");
function yp_posts_carousel($atts, $content = null) {
    extract(shortcode_atts(array(
        "style"               => 1,
        "posts"               => "",
        "show_price"          => true,
        "show_rating"         => true,
        "show_discount_badges"=> true,
        "badges_always_show"  => false,
        "boxed"               => false,
        "class"               => ""
    ), $atts));

    $posts = explode( ",", $posts );

    if(empty($posts)) {
      return "";
    }
    
    if(yp_check($boxed)) {
      $class .= " container";
    }

    $result_items = '';
    $yp_query = new WP_Query(array(
      'post_type'    => array('page', 'post', 'product'),
      'post__in'     => $posts
    ));

    while ($yp_query->have_posts()) : $yp_query->the_post();
      global $product;

      $ID = get_the_ID();

      $title = "<h4>" . get_the_title() . "</h4>";
      $rating = '';
      $price = '';
      $badge = '';

      $img_src = get_post_thumbnail_id( $ID );
      $img_src = wp_get_attachment_image_src( $img_src, '500x375' );
      $img_src = $img_src[0];

      if ($product) {
        if(yp_check($show_rating)) {
          $rating = yp_get_rating( $product->get_average_rating() );
        }

        if(yp_check($show_discount_badges) && function_exists('yp_woo_discount_badge')) {
          $badge = yp_woo_discount_badge($product, yp_check($badges_always_show));
        }

        if(yp_check($show_price) && $price = $product->get_price_html()) {
          $price = '<div class="price">' . $price . '</div>';
        }
      }

      $item_content = '';
      if($style == 1) {
        $item_content = 
          '<a class="angled-img" href="' . esc_url(get_permalink()) . '">
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
      } else {
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
          '<a class="angled-img" href="' . esc_url(get_permalink()) . '">
            <div class="img img-offset">
              <img src="' . esc_url($img_src) . '" alt="">
              ' . $badge . '
            </div>
            <div class="bottom-info">
              ' . $title . '
              ' . $description . '
            </div>
          </a>';
      }
      
      $result_items .= $item_content;

    endwhile;

    wp_reset_postdata();

    return '<div class="youplay-carousel ' . yp_sanitize_class($class) . '">' . $result_items . '</div>';
}


/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_youplay_posts_carousel" );
function vc_youplay_posts_carousel() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name"     => __("YP Posts Carousel", "youplay"),
           "base"     => "yp_posts_carousel",
           "controls" => "full",
           "category" => "Youplay",
           "icon"     => "icon-youplay",
           "params"   => array(
              array(
                 "type"       => "dropdown",
                 "heading"    => __("Style", "youplay"),
                 "param_name" => "style",
                 "value"      => array(
                    __("Style 1", "youplay") => 1,
                    __("Style 2", "youplay") => 2
                 ),
                 "description" => ""
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Posts", "youplay"),
                 "param_name"  => "posts",
                 "value"       => __("", "youplay"),
                 "description" => "Type here the post IDs you want to use separated by coma. ex: 23,24,25",
              ),
              array(
                 "type"        => "checkbox",
                 "heading"     => __("Show Price", "youplay"),
                 "param_name"  => "show_price",
                 "value"       => array( __( "", "youplay" ) => true ),
                 "description" => "",
              ),
              array(
                 "type"        => "checkbox",
                 "heading"     => __("Show Rating", "youplay"),
                 "param_name"  => "show_rating",
                 "value"       => array( __( "", "youplay" ) => true ),
                 "description" => "",
              ),
              array(
                 "type"        => "checkbox",
                 "heading"     => __("Show Discount Badges", "youplay"),
                 "param_name"  => "show_discount_badges",
                 "value"       => array( __( "", "youplay" ) => true ),
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