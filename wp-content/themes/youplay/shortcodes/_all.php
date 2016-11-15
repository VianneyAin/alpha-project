<?php
/**
 * Youplay Shortcodes
 */

/* Add Button to MCE */
add_action('init', 'add_yp_shortcodes');
function add_yp_shortcodes() {
    // Don't bother doing this stuff if the current user lacks permissions
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
        return;
 
     // Add only in Rich Editor mode
    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "add_yp_shortcodes_tinymce_plugin");
        add_filter('mce_buttons', 'register_yp_shortcode_buttons');

        wp_enqueue_style( 'yp-shortcodes', get_template_directory_uri() . '/shortcodes/css/mce.css' );
    }
}
 
function register_yp_shortcode_buttons($buttons) {
    array_push(
        $buttons,
        "|",
        "yp_text",
        "yp_button",
        "yp_button_group",
        "yp_banner",
        "yp_tabs",
        "yp_accordion",
        "yp_carousel",
        "yp_posts_carousel",
        "yp_recent_posts",
        "yp_features",
        "yp_single_image",
        "yp_progress_bar",
        "yp_label",
        "yp_alert"
    );
    return $buttons;
}
 
// Load the TinyMCE plugin
function add_yp_shortcodes_tinymce_plugin($plugin_array) {
    $shortcodeJSURL = get_template_directory_uri() . "/shortcodes/js";

    $plugin_array["yp_text"] = $shortcodeJSURL . "/yp-text.js";
    $plugin_array["yp_button"] = $shortcodeJSURL . "/yp-button.js";
    $plugin_array["yp_button_group"] = $shortcodeJSURL . "/yp-button-group.js";
    $plugin_array["yp_banner"] = $shortcodeJSURL . "/yp-banner.js";
    $plugin_array["yp_tabs"] = $shortcodeJSURL . "/yp-tabs.js";
    $plugin_array["yp_accordion"] = $shortcodeJSURL . "/yp-accordion.js";
    $plugin_array["yp_carousel"] = $shortcodeJSURL . "/yp-carousel.js";
    $plugin_array["yp_posts_carousel"] = $shortcodeJSURL . "/yp-posts-carousel.js";
    $plugin_array["yp_recent_posts"] = $shortcodeJSURL . "/yp-recent-posts.js";
    $plugin_array["yp_features"] = $shortcodeJSURL . "/yp-features.js";
    $plugin_array["yp_single_image"] = $shortcodeJSURL . "/yp-single-image.js";
    $plugin_array["yp_progress_bar"] = $shortcodeJSURL . "/yp-progress-bar.js";
    $plugin_array["yp_label"] = $shortcodeJSURL . "/yp-label.js";
    $plugin_array["yp_alert"] = $shortcodeJSURL . "/yp-alert.js";

    return $plugin_array;
}


// Check if $var isset / true / 1
function yp_check($var) {
    return !(!isset($var) || $var == false || $var == 'false' || $var = 0 || $var == "0" || $var == "");
}


/* include all shortcodes */
require dirname( __FILE__ ) . "/yp-text.php";
require dirname( __FILE__ ) . "/yp-progress-bar.php";
require dirname( __FILE__ ) . "/yp-button.php";
require dirname( __FILE__ ) . "/yp-single-image.php";
require dirname( __FILE__ ) . "/yp-banner.php";
require dirname( __FILE__ ) . "/yp-tabs.php";
require dirname( __FILE__ ) . "/yp-accordion.php";
require dirname( __FILE__ ) . "/yp-features.php";
require dirname( __FILE__ ) . "/yp-label.php";
require dirname( __FILE__ ) . "/yp-alert.php";
require dirname( __FILE__ ) . "/yp-carousel.php";
require dirname( __FILE__ ) . "/yp-posts-carousel.php";
require dirname( __FILE__ ) . "/yp-recent-posts.php";