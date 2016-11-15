<?php
/**
 * YP Recent Posts
 *
 * Example:
 * [yp_recent_posts style="1" count="5" pagination="false" boxed="false"]
 */
add_shortcode("yp_recent_posts", "yp_recent_posts");
function yp_recent_posts($atts, $content = null) {
    extract(shortcode_atts(array(
        "style"      => 1,
        "count"      => 5,
        "pagination" => false,
        "boxed"      => false,
        "class"      => ""
    ), $atts));

    if(yp_check($boxed)) {
      $class .= " container";
    }

    $before = $after = '';

    if($style == 3) {
      $before = '<div class="isotope">';
      $after = '</div>';
      $class .= ' isotope-list news-grid row';
    }

    ob_start();
    echo wp_kses_post($before);
    ?> <div class="youplay-news <?php echo yp_sanitize_class($class); ?>"> <?php
      $paged = 0;
      if($pagination) {
        global $yp_query;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      }
      $yp_query = new WP_Query(array(
        'showposts'     => intval($count),
        'posts_per_page'=> intval($count),
        'paged'         => $paged
      ));
      $counter = 0;
      while ($yp_query->have_posts()) : $yp_query->the_post();
        get_template_part( 'template-parts/content', $style );
      endwhile;
    ?> </div> <?php
    echo wp_kses_post($after);
    wp_reset_postdata();

    ?> <div class="clearfix"></div> <?php
    
    yp_posts_navigation();
    
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}



/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_yp_recent_posts" );
function vc_yp_recent_posts() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name" => __("YP Recent Posts", "youplay"),
           "base" => "yp_recent_posts",
           "controls" => "full",
           "category" => "Youplay",
           "icon" => "icon-youplay",
           "params" => array(
              array(
                 "type"       => "dropdown",
                 "heading"    => __("Style", "youplay"),
                 "param_name" => "style",
                 "value"      => array(
                    __("Style 1", "youplay") => 1,
                    __("Style 2", "youplay") => 2,
                    __("Style 3", "youplay") => 3
                 ),
                 "description" => ""
              ),
              array(
                 "type"        => "textfield",
                 "heading"     => __("Recent Posts Count", "youplay"),
                 "param_name"  => "count",
                 "value"       => 5,
                 "description" => "",
              ),
              array(
                 "type"        => "checkbox",
                 "heading"     => __("Show Pagination", "youplay"),
                 "param_name"  => "pagination",
                 "value"       => array( __( "", "youplay" ) => true ),
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