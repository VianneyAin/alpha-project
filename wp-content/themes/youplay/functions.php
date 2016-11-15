<?php
/**
 * Youplay functions and definitions
 *
 * @package Youplay
 */

add_action( 'after_setup_theme', 'yp_setup' );
if ( ! function_exists( 'yp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function yp_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Youplay, use a find and replace
     * to change 'youplay' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'youplay', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary'       => esc_html__( 'Primary Menu', 'youplay' ),
        'primary-right' => esc_html__( 'Primary Right Menu', 'youplay' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    // content width
    if ( ! isset( $content_width ) ) $content_width = 900;


    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'youplay_custom_background_args', array() ) );

    /*
     * Enable support for WooCommerce
     */
    add_theme_support( 'woocommerce' );

    // Add default image sizes
    add_theme_support('post-thumbnails');
    add_image_size('500x375', 500, 375, true);
    add_image_size('200x200', 200, 200, true);
    add_image_size('90x90', 90, 90, true);
    add_image_size('1400x600', 1400, 600, true);
    add_image_size('1440x900', 1440, 900, true);

    // Register the three useful image sizes for use in Add Media modal
    add_filter( 'image_size_names_choose', 'yp_custom_sizes' );
    function yp_custom_sizes( $sizes ) {
        return array_merge( $sizes, array(
            '500x375'   => __( 'Carousel Thumbnail (500x375)', 'youplay' ),
            '200x200'   => __( 'User Avatar (200x200)', 'youplay' ),
            '90x90'     => __( 'User Small Avatar (90x90)', 'youplay' ),
            '1400x600'  => __( '1400x600', 'youplay' ),
            '1440x900'  => __( '1440x900', 'youplay' ),
        ) );
    }
}
endif; // yp_setup

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
add_action( 'widgets_init', 'yp_widgets_init' );
function yp_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'youplay' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="side-block widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title block-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'WooCommerce Sidebar', 'youplay' ),
        'id'            => 'woocommerce_sidebar',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="side-block widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title block-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'bbPress Sidebar', 'youplay' ),
        'id'            => 'bbpress_sidebar',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="side-block widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title block-title">',
        'after_title'   => '</h4>',
    ) );
}

/**
 * Change default params when if right sidebar
 */
add_filter( 'dynamic_sidebar_params', 'yp_dynamic_sidebar_params' );
function yp_dynamic_sidebar_params( $params ) {
    $post_type = get_post_type();
    $layout = '';

    switch($post_type) {
        case 'post':
            $layout = yp_opts('single_post_layout', true);
            break;
        case 'page':
            $layout = yp_opts('single_page_layout', true);
            break;
        default:
            if(function_exists('is_bbpress') && is_bbpress()) {
                $layout = yp_opts('press_layout', true);
            } else if(function_exists('is_woocommerce') && is_woocommerce()) {
                $layout = yp_opts('single_product_layout', true);
            }
            break;
    }

    if (strpos($layout, 'cont-side') !== false) {
        $params[0]['before_widget'] = str_replace('side-block', 'side-block right-side', $params[0]['before_widget']);
    }

    return $params;
}


/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'yp_scripts' );
function yp_scripts() {
    wp_enqueue_style( 'youplay', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/plugins/fontawesome/css/font-awesome.min.css' );
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/plugins/magnific-popup/magnific-popup.css' );
    wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/assets/plugins/owl.carousel/owl.carousel.css' );
    wp_enqueue_style( 'social-likes', get_template_directory_uri() . '/assets/plugins/social-likes/social-likes_flat.css' );

    if(yp_opts('theme_style') == 'dark') {
        wp_enqueue_style( 'youplay-style1', get_template_directory_uri() . '/assets/css/youplay.css' );
        wp_enqueue_style( 'youplay-bbpress1', get_template_directory_uri() . '/assets/css/youplay-bbpress.css' );
        wp_enqueue_style( 'youplay-woocommerce1', get_template_directory_uri() . '/assets/css/youplay-woocommerce.css' );
    } else if(yp_opts('theme_style') == 'light') {
        wp_enqueue_style( 'youplay-style2', get_template_directory_uri() . '/assets/css/youplay-light.css' );
        wp_enqueue_style( 'youplay-bbpress2', get_template_directory_uri() . '/assets/css/youplay-bbpress-light.css' );
        wp_enqueue_style( 'youplay-woocommerce2', get_template_directory_uri() . '/assets/css/youplay-woocommerce-light.css' );
    } else {
        wp_enqueue_style( 'youplay-style2', get_template_directory_uri() . '/assets/css/youplay-custom.min.css' );
        wp_enqueue_style( 'youplay-bbpress1', get_template_directory_uri() . '/assets/css/youplay-bbpress.css' );
        wp_enqueue_style( 'youplay-woocommerce1', get_template_directory_uri() . '/assets/css/youplay-woocommerce.css' );
    }
    wp_enqueue_style( 'youplay-style3', get_template_directory_uri() . '/assets/css/wp-youplay.css' );


    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/plugins/jquery/jquery.min.js', '', '', true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/js/bootstrap.min.js', '', '', true );
    wp_enqueue_script( 'css-shapes-polyfill', get_template_directory_uri() . '/assets/plugins/css-shapes-polyfill/shapes-polyfill.min.js', '', '', true );
    wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/assets/plugins/html5shiv/html5shiv.min.js', '', '', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/plugins/isotope/isotope.pkgd.min.js', '', '', true );
    wp_enqueue_script( 'jquery.coundown', get_template_directory_uri() . '/assets/plugins/jquery.coundown/jquery.countdown.min.js', '', '', true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/plugins/magnific-popup/jquery.magnific-popup.min.js', '', '', true );
    wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/assets/plugins/owl.carousel/owl.carousel.min.js', '', '', true );
    wp_enqueue_script( 'skrollr', get_template_directory_uri() . '/assets/plugins/skrollr/skrollr.min.js', '', '', true );
    wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/assets/plugins/smoothscroll/smoothscroll.js', '', '', true );
    wp_enqueue_script( 'social-likes', get_template_directory_uri() . '/assets/plugins/social-likes/social-likes.min.js', '', '', true );

    wp_enqueue_script( 'youplay-js', get_template_directory_uri() . '/assets/js/youplay.min.js', '', '', true );
    wp_enqueue_script( 'youplay-wp-js', get_template_directory_uri() . '/assets/js/youplay-wp.js', '', '', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}


/**
 * Add custom typography styles
 */
add_action('wp_head', 'yp_wp_head');
function yp_wp_head() {
    require get_template_directory() . '/inc/head_styles.php';
}


/**
 * Return Option from OptionTree
 */
function yp_opts($opt_name = null, $use_meta_box = null, $postId = null){
    if($opt_name == null) {
        return null;
    }
    $value = null;

    // try get value from meta box
    if($use_meta_box) {
        if($postId == null) {
            $postId = get_the_ID();
        }
        $value = get_post_meta($postId, $opt_name, true);
    }

    // get value from options
    if(!$value || $value == 'default') {
        $value = ot_get_option($opt_name, null);
    }

    // get std value
    if($value == null && function_exists( 'ot_settings_id' )) {
        $std = get_option( ot_settings_id(), array() );
        $std = $std['settings'];

        foreach($std as $v) {
            if($v['id'] == $opt_name) {
                $value = $v['std'];
            }
        }
    }

    // change 'on' to 1 and 'off' to 0
    if($value == 'on') {
        $value = 1;
    } else if($value == 'off') {
        $value = 0;
    }

    return $value;
}
function yp_opts_e($opt_name = null, $use_meta_box = null, $postId = null){
    echo yp_opts($opt_name, $use_meta_box, $postId);
}



/**
 * Fix Content for Shortcodes
 */
function yp_fix_content($content) {
    // fix for stupid </p> tag in start of string
    if (substr($content, 0, strlen("</p>")) == "</p>") {
        $content = substr($content, strlen("</p>"));
    }

    // fix for stupid <p> tag in end of string
    $content = preg_replace('/<p>$/', '', $content);

    // remove some <br> tags near shortcodes
    $content = str_replace( "]<br />","]", ( substr( $content, 0 , 6 ) == "<br />" ? substr( $content, 6 ): $content ) );

    // remove some <p> tags near shortcodes
    $content = str_replace( "]</p>","]", $content );
    $content = str_replace( "<p>[","[", $content );

    return $content;
}



/**
 * Get Rating HTML
 */
function yp_get_rating($rating) {
    if(( yp_check($rating) || $rating == 0) && is_numeric($rating)) {
        $rating_tmp = "";

        // ceil num
        $r_rating = ceil($rating/0.5)*0.5;

        for($k = 1; $k <= 5; $k++) {
            if($k <= $r_rating) {
                $rating_tmp .= ' <i class="fa fa-star"></i>';
            } else {
                if($k - 0.5 == $r_rating) {
                    $rating_tmp .= ' <i class="fa fa-star-half-o"></i>';
                } else {
                    $rating_tmp .= ' <i class="fa fa-star-o"></i>';
                }
            }
        }

        return '<div class="rating" data-rating="' . esc_attr($rating) . '">' . $rating_tmp . '</div>';
    } else {
        return "";
    }
}


/**
 * Get avatar URL
 * http://wordpress.stackexchange.com/questions/59442/how-do-i-get-the-avatar-url-instead-of-an-html-img-tag-when-using-get-avatar
 */
function yp_get_avatar_url($get_avatar){
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return esc_url($matches[1]);
}



/**
 * Admin References
 */
require get_template_directory() . '/admin/youplay_admin.php';

/**
 * Theme Options (Option Tree)
 */
add_filter( 'ot_theme_mode', '__return_true' );
require get_template_directory() . '/inc/lib/OptionTree/ot-loader.php';
require get_template_directory() . '/inc/theme-options.php';

/**
 * Theme Metaboxes (Option Tree)
 */
require get_template_directory() . '/inc/theme-metaboxes.php';

/**
 * TGMA
 */
require get_template_directory() . '/inc/plugins-activation.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Menu walker
 */
require get_template_directory() . '/inc/menu-walker.php';

/**
 * Comments walker
 */
require get_template_directory() . '/inc/comments-walker.php';




/**
 * Shortcodes
 */
require get_template_directory() . '/shortcodes/_all.php';


/**
 * Widgets
 */
require get_template_directory() . '/widgets/recent-posts.php';


/**
 * Custom WooCommerce functions
 */
require get_template_directory() . '/woocommerce/functions.php';


/**
 * Custom bbPress functions
 */
require get_template_directory() . '/bbpress/functions.php';




/**
 * Demo Importer
 */
require get_template_directory() .'/inc/lib/radium-one-click-demo-install/init.php';

function load_radium_one_click_demo_install(){
    new Radium_Theme_Demo_Data_Importer;
}
add_action( 'after_setup_theme', 'load_radium_one_click_demo_install', 2 );