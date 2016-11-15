<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Youplay
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function youplay_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

  foreach($classes as $key => $class) {
      if($class == 'date') {
          $classes[$key] = 'archive-date';
      }
  }

	return $classes;
}
add_filter( 'body_class', 'youplay_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function youplay_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'youplay' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'youplay_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function youplay_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'youplay_render_title' );
endif;


/**
 * Title Tag filter for 404
 */
add_filter( 'wp_title', 'yp_title', 10, 2 );
function yp_title( $title ) {
    if( is_404() ) {
        $title = yp_opts('404_title');
    }
    return $title;
}


/**
 * Add 'full' to sizes list
 */
add_filter( 'intermediate_image_sizes', 'yp_intermediate_image_sizes' );
function yp_intermediate_image_sizes( $sizes ) {
    $sizes[] = 'full';
    return $sizes;
}


/**
 * Remove admin bar top margin
 */
add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}


/**
 * Add active classname for menu item
 */
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) || in_array('current-menu-ancestor', $classes) ){
          $classes[] = 'active ';
     }
     return $classes;
}