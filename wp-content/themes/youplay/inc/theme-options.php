<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'init', 'custom_theme_options' );

// hide OptionTree button from admin menu
add_filter( 'ot_show_pages', '__return_false' );
function remove_ot_menu() {
  remove_submenu_page('themes.php', 'ot-theme-options');
}
add_action('admin_init', 'remove_ot_menu');

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );


  $youplay_layouts = array( 
    array(
      'value'       => 'cont',
      'label'       => 'Content',
      'src'         => get_template_directory_uri() . '/admin/images/layouts/cont.jpg'
    ),
    array(
      'value'       => 'cont-side',
      'label'       => 'Content + Sidebar',
      'src'         => get_template_directory_uri() . '/admin/images/layouts/cont-side.jpg'
    ),
    array(
      'value'       => 'side-cont',
      'label'       => 'Sidebar + Content',
      'src'         => get_template_directory_uri() . '/admin/images/layouts/side-cont.jpg'
    ),
    array(
      'value'       => 'banner-cont',
      'label'       => 'Banner + Content',
      'src'         => get_template_directory_uri() . '/admin/images/layouts/banner-cont.jpg'
    ),
    array(
      'value'       => 'banner-cont-side',
      'label'       => 'Banner + Content + Sidebar',
      'src'         => get_template_directory_uri() . '/admin/images/layouts/banner-cont-side.jpg'
    ),
    array(
      'value'       => 'banner-side-cont',
      'label'       => 'Banner + Sidebar + Content',
      'src'         => get_template_directory_uri() . '/admin/images/layouts/banner-side-cont.jpg'
    )
  );

  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => '<i class="fa fa-cogs"></i> ' . __('General', 'youplay')
      ),
      array(
        'id'          => 'theme',
        'title'       => '<i class="fa fa-magic"></i> ' . __('Theme Style', 'youplay')
      ),
      array(
        'id'          => 'fonts',
        'title'       => '<i class="fa fa-font"></i> ' . __('Fonts', 'youplay')
      ),
      array(
        'id'          => 'navigation',
        'title'       => '<i class="fa fa-bars"></i> ' . __('Navigation', 'youplay')
      ),
      array(
        'id'          => 'single_page',
        'title'       => '<i class="fa fa-files-o"></i> ' . __('Single Page', 'youplay')
      ),
      array(
        'id'          => 'single_post',
        'title'       => '<i class="fa fa-thumb-tack"></i> ' . __('Single Post', 'youplay')
      ),
      array(
        'id'          => 'archive',
        'title'       => '<i class="fa fa-archive"></i> ' . __('Posts Archive', 'youplay')
      ),
      array(
        'id'          => 'single_product',
        'title'       => '<i class="fa fa-shopping-cart"></i> ' . __('WooCommerce', 'youplay')
      ),
      array(
        'id'          => 'press',
        'title'       => '<i class="fa fa-forumbee"></i> ' . __('bbPress', 'youplay')
      ),
      array(
        'id'          => 'search',
        'title'       => '<i class="fa fa-search"></i> ' . __('Search Page', 'youplay')
      ),
      array(
        'id'          => '404',
        'title'       => '<i class="fa fa-exclamation-triangle"></i> ' . __('404', 'youplay')
      ),
      array(
        'id'          => 'footer',
        'title'       => '<i class="fa fa-hand-o-down"></i> ' . __('Footer', 'youplay')
      ),
      array(
        'id'          => 'demo',
        'title'       => '<i class="fa fa-cloud-download"></i> ' . __('Demo Data', 'youplay')
      )
    ),
    'settings'        => array( 


/**
------------------
GENERAL
------------------
*/
      array(
        'id'          => 'general_custom_css',
        'label'       => __('Custom CSS', 'youplay'),
        'desc'        => __('Custom CSS for example: html {font-size:10px;}', 'youplay'),
        'std'         => '/* custom css */',
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'general_custom_js',
        'label'       => __('Custom JS', 'youplay'),
        'desc'        => __('Custom JS', 'youplay'),
        'std'         => '/* custom js */',
        'type'        => 'javascript',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'general_favicon',
        'label'       => __('Favicon', 'youplay'),
        'desc'        => '',
        'std'         => get_template_directory_uri() . '/assets/images/icon.png',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'general_logo',
        'label'       => __('Logo', 'youplay'),
        'desc'        => __('Will be used in navigation and preloader', 'youplay'),
        'std'         => get_template_directory_uri() . '/assets/images/logo-light.png',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'general_preloader',
        'label'       => __('Show Preloader', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'general_smoothscroll',
        'label'       => __('Smooth Scroll', 'youplay'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'general_parallax',
        'label'       => __('Parallax', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),




/**
------------------
THEME STYLE
------------------
*/
      array(
        'id'          => 'theme_style',
        'label'       => __('Style', 'youplay'),
        'desc'        => '',
        'std'         => 'dark',
        'type'        => 'select',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'dark',
            'label'       => 'Dark',
            'src'         => ''
          ),
          array(
            'value'       => 'light',
            'label'       => 'Light',
            'src'         => ''
          ),
          array(
            'value'       => 'custom',
            'label'       => 'Custom',
            'src'         => ''
          )
        )
      ),

      array(
        'id'          => 'tab_theme_colors',
        'label'       => __('Colors', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'theme_colors_textblock',
        'label'       => __('If you want change colors - select Custom theme style.', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock_titled',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:not(custom)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'theme_colors_from',
        'label'       => __('Scheme From', 'youplay'),
        'desc'        => 'Select Dark if you want to set darken theme secondary colors. Or select Light if want Light secondary colors.',
        'std'         => 'dark',
        'type'        => 'select',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'dark',
            'label'       => 'Dark',
            'src'         => ''
          ),
          array(
            'value'       => 'light',
            'label'       => 'Light',
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'theme_main_color',
        'label'       => 'Main Color',
        'desc'        => '',
        'std'         => '#D92B4C',
        'type'        => 'colorpicker',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),
      array(
        'id'          => 'theme_back_color',
        'label'       => 'Back Color',
        'desc'        => '',
        'std'         => '#160962',
        'type'        => 'colorpicker',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),
      array(
        'id'          => 'theme_back_grey_color',
        'label'       => 'Back Grey Color',
        'desc'        => '',
        'std'         => '#30303D',
        'type'        => 'colorpicker',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),
      array(
        'id'          => 'theme_text_color',
        'label'       => 'Text Color',
        'desc'        => '',
        'std'         => '#FFFFFF',
        'type'        => 'colorpicker',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),
      array(
        'id'          => 'theme_primary_color',
        'label'       => 'Primary Color',
        'desc'        => '',
        'std'         => '#2B6AD9',
        'type'        => 'colorpicker',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),
      array(
        'id'          => 'theme_success_color',
        'label'       => 'Success Color',
        'desc'        => '',
        'std'         => '#2BD964',
        'type'        => 'colorpicker',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),
      array(
        'id'          => 'theme_info_color',
        'label'       => 'Info Color',
        'desc'        => '',
        'std'         => '#2BD7D9',
        'type'        => 'colorpicker',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),
      array(
        'id'          => 'theme_warning_color',
        'label'       => 'Warning Color',
        'desc'        => '',
        'std'         => '#EB8324',
        'type'        => 'colorpicker',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),
      array(
        'id'          => 'theme_danger_color',
        'label'       => 'Danger Color',
        'desc'        => '',
        'std'         => '#D92B4C',
        'type'        => 'colorpicker',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),

      array(
        'id'          => 'tab_theme_sizes',
        'label'       => __('Sizes', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'theme_sizes_textblock',
        'label'       => __('If you want change sizes - select Custom theme style.', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock_titled',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'theme_style:not(custom)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'theme_skew_size',
        'label'       => __('Skew Size', 'youplay'),
        'desc'        => 'All angled items (buttons, images, carousels, etc) uses this parameter. 8deg by default.',
        'std'         => '8',
        'type'        => 'numeric-slider',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,10,1',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),
      array(
        'id'          => 'theme_navbar_height',
        'label'       => __('Navbar Height', 'youplay'),
        'desc'        => '',
        'std'         => '80',
        'type'        => 'numeric-slider',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '50,100,1',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),
      array(
        'id'          => 'theme_navbar_small_height',
        'label'       => __('Navbar Small Height', 'youplay'),
        'desc'        => '',
        'std'         => '50',
        'type'        => 'numeric-slider',
        'section'     => 'theme',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '30,100,1',
        'class'       => '',
        'condition'   => 'theme_style:is(custom)',
        'operator'    => 'and',
      ),





/**
------------------
FONTS
------------------
*/
      array(
        'id'          => 'fonts_typography_body',
        'label'       => __('Body Typography', 'youplay'),
        'desc'        => '',
        'std'         => array(
          'font-family'    => 'lato',
          'font-size'      => '14px',
          'letter-spacing' => '0.06em',
          'line-height'    => '20px'
        ),
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google_fonts',
        'label'       => __('Google Font Load', 'youplay'),
        'desc'        => '',
        'std'         => array(
          array(
            'family'   => 'lato',
            'variants' => array('300', 'regular', '700')
          )
        ),
        'type'        => 'google-fonts',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),



/**
------------------
NAVIGAION
------------------
*/
      array(
        'id'          => 'navigation_logo',
        'label'       => __('Show Logo', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'navigation_search',
        'label'       => __('Show Search', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),



/**
------------------
SINGLE PAGE
------------------
*/
      array(
        'id'          => 'tab_page_main',
        'label'       => __('Main', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_page_layout',
        'label'       => __('Layout', 'youplay'),
        'desc'        => '',
        'std'         => 'cont',
        'type'        => 'radio-image',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $youplay_layouts
      ),
      array(
        'id'          => 'single_page_show_title',
        'label'       => __('Show Title', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_page_boxed_cont',
        'label'       => __('Boxed Content', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_page_comments',
        'label'       => __('Show Comments', 'youplay'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tab_page_banner',
        'label'       => __('Banner', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'textblock_page_banner',
        'label'       => __('Banner is not shown with selected Layout.', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock_titled',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_page_layout:is(cont),single_page_layout:is(cont-side),single_page_layout:is(side-cont)',
        'operator'    => 'or'
      ),
      array(
        'id'          => 'single_page_banner_image',
        'label'       => __('Image', 'youplay'),
        'desc'        => '',
        'std'         => get_template_directory_uri() . '/assets/images/banner-blog-bg.jpg',
        'type'        => 'upload',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_page_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_page_banner_image_cover',
        'label'       => __('Image Cover', 'youplay'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_page_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_page_banner_size',
        'label'       => __('Banner Size', 'youplay'),
        'desc'        => '',
        'std'         => 'xsmall',
        'type'        => 'select',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_page_layout:contains(banner)',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'full',
            'label'       => __('Full', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'mid',
            'label'       => __('Mid', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'small',
            'label'       => __('Small', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'xsmall',
            'label'       => __('Extra Small', 'youplay'),
            'src'         => ''
          )
        )
      ),



/**
------------------
SINGLE POST
------------------
*/
      array(
        'id'          => 'tab_post_main',
        'label'       => __('Main', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_layout',
        'label'       => __('Layout', 'youplay'),
        'desc'        => '',
        'std'         => 'banner-cont-side',
        'type'        => 'radio-image',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $youplay_layouts
      ),
      array(
        'id'          => 'single_post_boxed_cont',
        'label'       => __('Boxed Content', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_comments',
        'label'       => __('Show Comments', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tab_post_banner',
        'label'       => __('Banner', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'textblock_post_banner',
        'label'       => __('Banner is not shown with selected Layout.', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock_titled',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_post_layout:is(cont),single_post_layout:is(cont-side),single_post_layout:is(side-cont)',
        'operator'    => 'or'
      ),
      array(
        'id'          => 'single_post_banner_image',
        'label'       => __('Image', 'youplay'),
        'desc'        => '',
        'std'         => get_template_directory_uri() . '/assets/images/banner-blog-bg.jpg',
        'type'        => 'upload',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_post_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_banner_image_cover',
        'label'       => __('Image Cover', 'youplay'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_post_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_banner_size',
        'label'       => __('Banner Size', 'youplay'),
        'desc'        => '',
        'std'         => 'xsmall',
        'type'        => 'select',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_post_layout:contains(banner)',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'full',
            'label'       => __('Full', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'mid',
            'label'       => __('Mid', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'small',
            'label'       => __('Small', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'xsmall',
            'label'       => __('Extra Small', 'youplay'),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'tab_post_noimage',
        'label'       => __('No Image', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_noimage',
        'label'       => __('Image', 'youplay'),
        'desc'        => '',
        'std'         => get_template_directory_uri() . '/assets/images/noimage.jpg',
        'type'        => 'upload',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tab_post_meta',
        'label'       => __('Meta', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_tags',
        'label'       => __('Show Tags', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_author',
        'label'       => __('Show Author', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_publish_date',
        'label'       => __('Show Publish Date', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_categories',
        'label'       => __('Show Categories', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_views',
        'label'       => __('Show Views', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_comments_count',
        'label'       => __('Show Comments Count', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tab_post_social_likes',
        'label'       => __('Social Likes', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_sharing_fb',
        'label'       => __('Facebook', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_sharing_tw',
        'label'       => __('Twitter', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_sharing_gp',
        'label'       => __('Google+', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_sharing_pin',
        'label'       => __('Pinterest', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_post_sharing_vk',
        'label'       => __('Vkontakte', 'youplay'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),



/**
------------------
ARCHIVE
------------------
*/
      array(
        'id'          => 'tab_archive_main',
        'label'       => __('Main', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'archive',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'archive_layout',
        'label'       => __('Layout', 'youplay'),
        'desc'        => '',
        'std'         => 'banner-cont-side',
        'type'        => 'radio-image',
        'section'     => 'archive',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $youplay_layouts
      ),
      array(
        'id'          => 'archive_boxed_cont',
        'label'       => __('Boxed Content', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'archive',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tab_archive_banner',
        'label'       => __('Banner', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'archive',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'textblock_post_banner',
        'label'       => __('Banner is not shown with selected Layout.', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock_titled',
        'section'     => 'archive',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'archive_layout:is(cont),archive_layout:is(cont-side),archive_layout:is(side-cont)',
        'operator'    => 'or'
      ),
      array(
        'id'          => 'archive_banner_image',
        'label'       => __('Image', 'youplay'),
        'desc'        => '',
        'std'         => get_template_directory_uri() . '/assets/images/banner-blog-bg.jpg',
        'type'        => 'upload',
        'section'     => 'archive',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'archive_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'archive_banner_image_cover',
        'label'       => __('Image Cover', 'youplay'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'archive',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'archive_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'archive_banner_size',
        'label'       => __('Banner Size', 'youplay'),
        'desc'        => '',
        'std'         => 'xsmall',
        'type'        => 'select',
        'section'     => 'archive',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'archive_layout:contains(banner)',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'full',
            'label'       => __('Full', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'mid',
            'label'       => __('Mid', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'small',
            'label'       => __('Small', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'xsmall',
            'label'       => __('Extra Small', 'youplay'),
            'src'         => ''
          )
        )
      ),



/**
------------------
WooCommerce
------------------
*/
      array(
        'id'          => 'tab_product_main',
        'label'       => __('Main', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_product_layout',
        'label'       => __('Layout', 'youplay'),
        'desc'        => '',
        'std'         => 'banner-cont-side',
        'type'        => 'radio-image',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $youplay_layouts
      ),
      array(
        'id'          => 'single_product_boxed_cont',
        'label'       => __('Boxed Content', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tab_product_banner',
        'label'       => __('Banner', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'textblock_product_banner',
        'label'       => __('Banner is not shown with selected Layout.', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock_titled',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_product_layout:is(cont),single_product_layout:is(cont-side),single_product_layout:is(side-cont)',
        'operator'    => 'or'
      ),
      array(
        'id'          => 'textblock_product_banner2',
        'label'       => '',
        'desc'        => __('Banner uses featured image. You can set it in product edit page.', 'youplay'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_product_layout:contains(banner)',
        'operator'    => 'or'
      ),
      array(
        'id'          => 'single_product_banner_image_cover',
        'label'       => __('Image Cover', 'youplay'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_product_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_product_banner_size',
        'label'       => __('Banner Size', 'youplay'),
        'desc'        => '',
        'std'         => 'mid',
        'type'        => 'select',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'single_product_layout:contains(banner)',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'full',
            'label'       => __('Full', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'mid',
            'label'       => __('Mid', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'small',
            'label'       => __('Small', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'xsmall',
            'label'       => __('Extra Small', 'youplay'),
            'src'         => ''
          )
        )
      ),

      array(
        'id'          => 'tab_product_social_likes',
        'label'       => __('Social Likes', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_product_sharing_fb',
        'label'       => __('Facebook', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_product_sharing_tw',
        'label'       => __('Twitter', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_product_sharing_gp',
        'label'       => __('Google+', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_product_sharing_pin',
        'label'       => __('Pinterest', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_product_sharing_vk',
        'label'       => __('Vkontakte', 'youplay'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'tab_shop',
        'label'       => __('Shop Page', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'textblock_shop',
        'label'       => sprintf(
            __('This options will be applied to Shop page. %s', 'youplay'),
            '<a href="' . get_permalink( class_exists( 'WooCommerce' ) ? woocommerce_get_page_id( 'shop' ) : '' ) . '">' . get_permalink( class_exists( 'WooCommerce' ) ? woocommerce_get_page_id( 'shop' ) : '' ) . '</a>'
          ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock_titled',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'or'
      ),
      array(
        'id'          => 'shop_style',
        'label'       => __('Style', 'youplay'),
        'desc'        => '',
        'std'         => 'grid',
        'type'        => 'select',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'grid',
            'label'       => 'Grid',
            'src'         => ''
          ),
          array(
            'value'       => 'row',
            'label'       => 'Row',
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'shop_show_breadcrumbs',
        'label'       => __('Breadcrumbs', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'shop_show_result_count',
        'label'       => __('Result count text', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'shop_show_order_by',
        'label'       => __('"Order by" field', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'shop_show_ratings',
        'label'       => __('Ratings', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'shop_show_add_to_cart',
        'label'       => __('"Add to cart" buttons', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'single_product',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),



/**
------------------
bbPress
------------------
*/
      array(
        'id'          => 'tab_press_main',
        'label'       => __('Main', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'press',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'press_layout',
        'label'       => __('Layout', 'youplay'),
        'desc'        => '',
        'std'         => 'banner-cont-side',
        'type'        => 'radio-image',
        'section'     => 'press',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $youplay_layouts
      ),
      array(
        'id'          => 'press_breadcrumbs',
        'label'       => __('Breadcrumbs', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'press',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'press_boxed_cont',
        'label'       => __('Boxed Content', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'press',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tab_press_banner',
        'label'       => __('Banner', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'press',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'textblock_press_banner',
        'label'       => __('Banner is not shown with selected Layout.', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock_titled',
        'section'     => 'press',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'press_layout:is(cont),press_layout:is(cont-side),press_layout:is(side-cont)',
        'operator'    => 'or'
      ),
      array(
        'id'          => 'press_banner_image',
        'label'       => __('Image', 'youplay'),
        'desc'        => '',
        'std'         => get_template_directory_uri() . '/assets/images/banner-user-bg.jpg',
        'type'        => 'upload',
        'section'     => 'press',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'press_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'press_banner_image_cover',
        'label'       => __('Image Cover', 'youplay'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'press',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'press_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'press_banner_size',
        'label'       => __('Banner Size', 'youplay'),
        'desc'        => '',
        'std'         => 'small',
        'type'        => 'select',
        'section'     => 'press',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'press_layout:contains(banner)',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'full',
            'label'       => __('Full', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'mid',
            'label'       => __('Mid', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'small',
            'label'       => __('Small', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'xsmall',
            'label'       => __('Extra Small', 'youplay'),
            'src'         => ''
          )
        )
      ),



/**
------------------
Search
------------------
*/
      array(
        'id'          => 'tab_search_main',
        'label'       => __('Main', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'search_page_layout',
        'label'       => __('Layout', 'youplay'),
        'desc'        => '',
        'std'         => 'banner-cont-side',
        'type'        => 'radio-image',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $youplay_layouts
      ),
      array(
        'id'          => 'search_page_boxed_cont',
        'label'       => __('Boxed Content', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tab_search_page_banner',
        'label'       => __('Banner', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'textblock_post_banner',
        'label'       => __('Banner is not shown with selected Layout.', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock_titled',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'search_page_layout:is(cont),search_page_layout:is(cont-side),search_page_layout:is(side-cont)',
        'operator'    => 'or'
      ),
      array(
        'id'          => 'search_page_banner_image',
        'label'       => __('Image', 'youplay'),
        'desc'        => '',
        'std'         => get_template_directory_uri() . '/assets/images/banner-blog-bg.jpg',
        'type'        => 'upload',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'search_page_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'search_page_banner_image_cover',
        'label'       => __('Image Cover', 'youplay'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'search_page_layout:contains(banner)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'search_page_banner_size',
        'label'       => __('Banner Size', 'youplay'),
        'desc'        => '',
        'std'         => 'xsmall',
        'type'        => 'select',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'search_page_layout:contains(banner)',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'full',
            'label'       => __('Full', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'mid',
            'label'       => __('Mid', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'small',
            'label'       => __('Small', 'youplay'),
            'src'         => ''
          ),
          array(
            'value'       => 'xsmall',
            'label'       => __('Extra Small', 'youplay'),
            'src'         => ''
          )
        )
      ),


/**
------------------
404
------------------
*/
      array(
        'id'          => '404_title',
        'label'       => __('Page Title', 'youplay'),
        'desc'        => '',
        'std'         => __('404 - Page Not Found ;(', 'youplay'),
        'type'        => 'text',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => '404_content',
        'label'       => __('Content Text', 'youplay'),
        'desc'        => '',
        'std'         => '<h2>404</h2> <h3>Page Not Found ;(</h3>',
        'type'        => 'textarea',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => '404_search',
        'label'       => __('Show Search Form', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => '404_background',
        'label'       => __('Background Image', 'youplay'),
        'desc'        => '',
        'std'         => get_template_directory_uri() . '/assets/images/404-bg.jpg',
        'type'        => 'upload',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),




/**
------------------
FOOTER
------------------
*/
      array(
        'id'          => 'tab_footer_main',
        'label'       => __('Main', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_text',
        'label'       => __('Text', 'youplay'),
        'desc'        => '',
        'std'         => '<strong>nK</strong> &copy; 2015. All rights reserved',
        'type'        => 'textarea',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_background',
        'label'       => __('Background Image', 'youplay'),
        'desc'        => '',
        'std'         => get_template_directory_uri() . '/assets/images/footer-bg.jpg',
        'type'        => 'upload',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tab_footer_social',
        'label'       => __('Social', 'youplay'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social',
        'label'       => __('Show', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social_text',
        'label'       => __('Text', 'youplay'),
        'desc'        => '',
        'std'         => '<h3>Connect socially with <strong>youplay</strong></h3>',
        'type'        => 'textarea',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on)',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'footer_social_fb',
        'label'       => __('Facebook', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social_fb_label',
        'label'       => '',
        'desc'        => __('Label', 'youplay'),
        'std'         => __('Like on Facebook', 'youplay'),
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on),footer_social_fb:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social_fb_url',
        'label'       => '',
        'desc'        => __('URL', 'youplay'),
        'std'         => 'https://www.facebook.com/people/Nk-Dev/100005706677229',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on),footer_social_fb:is(on)',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'footer_social_tw',
        'label'       => __('Twitter', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social_tw_label',
        'label'       => '',
        'desc'        => __('Label', 'youplay'),
        'std'         => __('Follow on Twitter', 'youplay'),
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on),footer_social_tw:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social_tw_url',
        'label'       => '',
        'desc'        => __('URL', 'youplay'),
        'std'         => 'https://twitter.com/nkdevv',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on),footer_social_tw:is(on)',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'footer_social_gp',
        'label'       => __('Google+', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social_gp_label',
        'label'       => '',
        'desc'        => __('Label', 'youplay'),
        'std'         => __('Follow on Google+', 'youplay'),
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on),footer_social_gp:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social_gp_url',
        'label'       => '',
        'desc'        => __('URL', 'youplay'),
        'std'         => 'https://plus.google.com/105540650896894558095/posts',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on),footer_social_gp:is(on)',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'footer_social_yt',
        'label'       => __('Youtube', 'youplay'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social_yt_label',
        'label'       => '',
        'desc'        => __('Label', 'youplay'),
        'std'         => __('Watch on Youtube', 'youplay'),
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on),footer_social_yt:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_social_yt_url',
        'label'       => '',
        'desc'        => __('URL', 'youplay'),
        'std'         => 'http://www.youtube.com/user/nKdevelopers',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_social:is(on),footer_social_yt:is(on)',
        'operator'    => 'and'
      ),




/**
------------------
DEMO DATA
------------------
*/
      array(
        'id'          => 'textblock_demo',
        'label'       => 'Before import, make sure all the required plugins are activated.',
        'desc'        => '<a href="' . admin_url( 'themes.php?page=radium_demo_installer' ) . '">Go to Demo Import page</a>',
        'std'         => '',
        'type'        => 'textblock_titled',
        'section'     => 'demo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}


// change typography fields
add_filter( 'ot_recognized_typography_fields', 'yp_options_typography', 10, 2 );
function yp_options_typography() {
  return array( 
    'font-family', 
    'font-size',
    'letter-spacing', 
    'line-height'
  );
}



// compile main css file after save
add_filter( 'ot_after_theme_options_save', 'yp_compile_scss' );
function yp_compile_scss($options) {
  if(yp_opts('theme_style') != 'custom')
    return;

  // load scssphp
  require_once( get_template_directory() . '/inc/lib/scssphp/scss.inc.php' );

  $scss = new scssc();
  $scss->addImportPath(function($path) {
    $directory = get_template_directory() . '/assets/scss/';
    if (!file_exists($directory . $path)) return null;
    return $directory . $path;
  });
  $scss->setFormatter('scss_formatter_compressed');

  $theme_colors_from = yp_opts('theme_colors_from');
  $theme_main_color = yp_opts('theme_main_color');
  $theme_back_color = yp_opts('theme_back_color');
  $theme_back_grey_color = yp_opts('theme_back_grey_color');
  $theme_text_color = yp_opts('theme_text_color');
  $theme_primary_color = yp_opts('theme_primary_color');
  $theme_success_color = yp_opts('theme_success_color');
  $theme_info_color = yp_opts('theme_info_color');
  $theme_warning_color = yp_opts('theme_warning_color');
  $theme_danger_color = yp_opts('theme_danger_color');
  $theme_skew_size = yp_opts('theme_skew_size');
  $theme_navbar_height = yp_opts('theme_navbar_height');
  $theme_navbar_small_height = yp_opts('theme_navbar_small_height');

  $custom_vars = '
    $theme:' . $theme_colors_from . ';
    $main_color:' . $theme_main_color . ';
    $back_color:' . $theme_back_color . ';
    $back_darken_color:  ' . ($theme_colors_from == 'dark' ? 'darken($back_color, 0.13)' : '#FFFFFF') . ';
    $back_grey_color:' . $theme_back_grey_color . ';
    $back_darken_grey_color: ' . ($theme_colors_from == 'dark' ? 'darken' : 'lighten') . '($back_grey_color, 0.1);
    $text_color:' . $theme_text_color . ';
    $text_mute_color:  rgba($text_color, 0.5);
    $color_primary:' . $theme_primary_color . ';
    $color_success:' . $theme_success_color . ';
    $color_info:' . $theme_info_color . ';
    $color_warning:' . $theme_warning_color . ';
    $color_danger:' . $theme_danger_color . ';
    $skew_size:' . $theme_skew_size . 'deg;
    $navbar-height:' . $theme_navbar_height . 'px;
    $navbar-sm-height:' . $theme_navbar_small_height . 'px;';

  $result = $scss->compile('
    @import "_variables.scss";
    ' . $custom_vars . '
    @import "_includes.scss";
  ');

  // save style file
  file_put_contents(get_template_directory() . '/assets/css/youplay-custom.min.css', $result);
}



// Add Revolution Slider select option
function add_revslider_select_type( $array ) {

  $array['revslider-select'] = 'Revolution Slider Select';
  return $array;

}
add_filter( 'ot_option_types_array', 'add_revslider_select_type' ); 

// Show RevolutionSlider select option
function ot_type_revslider_select( $args = array() ) {
  extract( $args );
  $has_desc = $field_desc ? true : false;
  echo '<div class="format-setting type-revslider-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
  echo ($has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '');
    echo '<div class="format-setting-inner">';
    // Add This only if RevSlider is Activated
    if ( class_exists( 'RevSliderAdmin' ) ) {
      echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';

      /* get revolution array */
      $slider = new RevSlider();
      $arrSliders = $slider->getArrSlidersShort();

      /* has slides */
      if ( ! empty( $arrSliders ) ) {
        echo '<option value="">-- ' . __( 'Choose One', 'option-tree' ) . ' --</option>';
        foreach ( $arrSliders as $rev_id => $rev_slider ) {
          echo '<option value="' . esc_attr( $rev_id ) . '"' . selected( $field_value, $rev_id, false ) . '>' . esc_attr( $rev_slider ) . '</option>';
        }
      } else {
        echo '<option value="">' . __( 'No Sliders Found', 'option-tree' ) . '</option>';
      }
      echo '</select>';
    } else {
        echo '<span style="color: red;">' . __( 'Sorry! Revolution Slider is not Installed or Activated', 'ventus' ). '</span>';
    }
    echo '</div>';
  echo '</div>';
}