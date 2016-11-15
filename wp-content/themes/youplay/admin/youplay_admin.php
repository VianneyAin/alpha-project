<?php
/**
 * add admin panel styles / scripts and thickbox
 */
if(is_admin()){
  add_action('admin_print_scripts', 'yp_admin_scripts');
  add_action('admin_print_styles', 'yp_admin_styles');
}
function yp_admin_scripts() {
  add_thickbox();
  wp_enqueue_script( 'menu-custom-fields', get_template_directory_uri() . '/admin/js/menu-custom-fields.js', '', '', true );
}
function yp_admin_styles() {
  wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/plugins/fontawesome/css/font-awesome.min.css' );
  wp_enqueue_style( 'bootstrap-icons', get_template_directory_uri() . '/assets/plugins/bootstrap/css/bootstrap-icons.min.css' );
  wp_enqueue_style( 'menu-custom-fields', get_template_directory_uri() . '/admin/css/menu-custom-fields.css' );
  wp_enqueue_style( 'style', get_template_directory_uri().'/admin/css/style.css'); 
}


/**
 * add admin menu item
 */
if(is_admin()){
  add_action('admin_menu', 'yp_menu');
  function yp_menu() {
    add_menu_page('Youplay Options', 'Youplay Options', 'manage_options', 'ot-theme-options', '', 'dashicons-admin-youplay', '75.22');
    add_action('admin_bar_menu', 'add_items', 80.22);
  }
}
function add_items($admin_bar) {
  $admin_bar->add_node( array(
      'id'    => 'youplay-options',
      'title' => '<i class="icon-youplay"></i> ' . __('Youplay Options', 'youplay'),
      'href'  => admin_url('admin.php?page=ot-theme-options'),
      'meta'  => array(
          'title' => __('Youplay Options', 'youplay'),
      )
  ) );
}