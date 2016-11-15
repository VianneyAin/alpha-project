<?php
add_filter( 'ot_override_forced_textarea_simple', '__return_true' );

function getYouplayLayouts() {
  return array(
    array(
      'value'       => 'default',
      'label'       => 'Default',
      'src'         => get_template_directory_uri() . '/admin/images/layouts/default.jpg'
    ),
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
}


/**
------------------
PAGE METABOXES
------------------
*/
add_action( 'admin_init', 'yp_page_meta_boxes' );

if ( ! function_exists( 'yp_page_meta_boxes' ) ) {
  function yp_page_meta_boxes() {
    //layout
    $meta_box = array(
      'id'        => 'page_custom_options',
      'title'     => 'Youplay Custom Options',
      'desc'      => '',
      'pages'     => array( 'page' ),
      'context'   => 'normal',
      'priority'  => 'high',
      'fields'    => array(
        array(
          'id'          => 'tab_page_layout',
          'label'       => __('Layout', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'tab',
          'operator'    => 'and'
        ),
        array(
          'id'          => 'single_page_layout',
          'label'       => __('Layout','youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'radio-image',
          'class'       => '',
          'choices'     => getYouplayLayouts()
        ),
        array(
          'id'          => 'single_page_show_title',
          'label'       => __('Show Title', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'on',
              'label'       => __('On', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'off',
              'label'       => __('Off', 'youplay'),
              'src'         => ''
            )
          )
        ),
        array(
          'id'          => 'single_page_boxed_cont',
          'label'       => __('Boxed Content', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'on',
              'label'       => __('On', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'off',
              'label'       => __('Off', 'youplay'),
              'src'         => ''
            )
          )
        ),
        array(
          'id'          => 'single_page_comments',
          'label'       => __('Show Comments', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'on',
              'label'       => __('On', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'off',
              'label'       => __('Off', 'youplay'),
              'src'         => ''
            )
          )
        ),
        array(
          'id'          => 'single_page_nopadding',
          'label'       => __('Remove Content Padding', 'youplay'),
          'desc'        => 'Remove padding from top and bottom of content. May be useful with carousels on top and bottom.',
          'std'         => 'off',
          'type'        => 'on-off',
        ),
        array(
          'id'          => 'single_page_revslider',
          'label'       => __('Use Revolution Slider', 'youplay'),
          'desc'        => 'Title will be hidden',
          'std'         => 'off',
          'type'        => 'on-off',
        ),
        array(
          'id'          => 'single_page_revslider_alias',
          'label'       => __('Slider', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'revslider-select',
        ),

        array(
          'id'          => 'tab_page_banner',
          'label'       => __('Banner', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'tab',
          'operator'    => 'and'
        ),
        array(
          'id'          => 'single_page_banner_image',
          'label'       => __('Image', 'youplay'),
          'desc'        => '',
          'std'         => yp_opts('single_page_banner_image'),
          'type'        => 'upload',
        ),
        array(
          'id'          => 'single_page_banner_image_cover',
          'label'       => __('Image Cover', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'on',
              'label'       => __('On', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'off',
              'label'       => __('Off', 'youplay'),
              'src'         => ''
            )
          )
        ),
        array(
          'id'          => 'single_page_banner_size',
          'label'       => __('Banner Size', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
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
          'id'          => 'single_page_banner_cont',
          'label'       => __('Banner Text', 'youplay'),
          'desc'        => 'Leave blank if you want to display the name of the page',
          'std'         => '',
          'type'        => 'textarea',
        ),
      )
    );

    if(function_exists('ot_register_meta_box')) {
      ot_register_meta_box( $meta_box );
    }
  }
}


/**
------------------
POST METABOXES
------------------
*/
add_action( 'admin_init', 'yp_post_meta_boxes' );

if ( ! function_exists( 'yp_post_meta_boxes' ) ){
  
  function yp_post_meta_boxes() {
    //layout
    $meta_box = array(
      'id'        => 'post_custom_options',
      'title'     => 'Youplay Custom Options',
      'desc'      => '',
      'pages'     => array( 'post' ),
      'context'   => 'normal',
      'priority'  => 'high',
      'fields'    => array(
        array(
          'id'          => 'tab_post_layout',
          'label'       => __('Layout', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'tab',
          'operator'    => 'and'
        ),
        array(
          'id'          => 'single_post_layout',
          'label'       => __('Layout','youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'radio-image',
          'class'       => '',
          'choices'     => getYouplayLayouts()
        ),
        array(
          'id'          => 'single_post_boxed_cont',
          'label'       => __('Boxed Content', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'on',
              'label'       => __('On', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'off',
              'label'       => __('Off', 'youplay'),
              'src'         => ''
            )
          )
        ),
        array(
          'id'          => 'single_post_comments',
          'label'       => __('Show Comments', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'on',
              'label'       => __('On', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'off',
              'label'       => __('Off', 'youplay'),
              'src'         => ''
            )
          )
        ),
        array(
          'id'          => 'single_post_revslider',
          'label'       => __('Use Revolution Slider', 'youplay'),
          'desc'        => 'Title will be hidden',
          'std'         => 'off',
          'type'        => 'on-off',
        ),
        array(
          'id'          => 'single_post_revslider_alias',
          'label'       => __('Slider', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'revslider-select',
        ),

        array(
          'id'          => 'tab_post_banner',
          'label'       => __('Banner', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'tab',
          'operator'    => 'and'
        ),
        array(
          'id'          => 'single_post_banner_image',
          'label'       => __('Image', 'youplay'),
          'desc'        => '',
          'std'         => yp_opts('single_post_banner_image'),
          'type'        => 'upload',
        ),
        array(
          'id'          => 'single_post_banner_image_cover',
          'label'       => __('Image Cover', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'on',
              'label'       => __('On', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'off',
              'label'       => __('Off', 'youplay'),
              'src'         => ''
            )
          )
        ),
        array(
          'id'          => 'single_post_banner_size',
          'label'       => __('Banner Size', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
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
          'id'          => 'single_post_banner_cont',
          'label'       => __('Banner Text', 'youplay'),
          'desc'        => 'Leave blank if you want to display the name of the post',
          'std'         => '',
          'type'        => 'textarea',
        ),
      )
    );
    
    if (function_exists('ot_register_meta_box')) {
      ot_register_meta_box( $meta_box );
    }
  }
}


/**
------------------
PRODUCT METABOXES
------------------
*/
add_action( 'admin_init', 'yp_product_meta_boxes' );

if ( ! function_exists( 'yp_product_meta_boxes' ) ){
  
  function yp_product_meta_boxes() {
    //layout
    $meta_box = array(
      'id'        => 'product_custom_options',
      'title'     => 'Youplay Custom Options',
      'desc'      => '',
      'pages'     => array( 'product' ),
      'context'   => 'normal',
      'priority'  => 'low',
      'fields'    => array(
        array(
          'id'          => 'tab_product_layout',
          'label'       => __('Layout', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'tab',
          'operator'    => 'and'
        ),
        array(
          'id'          => 'single_product_layout',
          'label'       => __('Layout','youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'radio-image',
          'class'       => '',
          'choices'     => getYouplayLayouts()
        ),
        array(
          'id'          => 'single_product_boxed_cont',
          'label'       => __('Boxed Content', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'on',
              'label'       => __('On', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'off',
              'label'       => __('Off', 'youplay'),
              'src'         => ''
            )
          )
        ),
        array(
          'id'          => 'single_product_revslider',
          'label'       => __('Use Revolution Slider', 'youplay'),
          'desc'        => 'Title will be hidden',
          'std'         => 'off',
          'type'        => 'on-off',
        ),
        array(
          'id'          => 'single_product_revslider_alias',
          'label'       => __('Slider', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'revslider-select',
        ),

        array(
          'id'          => 'tab_product_banner',
          'label'       => __('Banner', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'tab',
          'operator'    => 'and'
        ),
      array(
        'id'          => 'textblock_product_banner',
        'label'       => '',
        'desc'        => __('Used Featured image', 'youplay'),
        'std'         => '',
        'type'        => 'textblock',
      ),
        array(
          'id'          => 'single_product_banner_image_cover',
          'label'       => __('Image Cover', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'on',
              'label'       => __('On', 'youplay'),
              'src'         => ''
            ),
            array(
              'value'       => 'off',
              'label'       => __('Off', 'youplay'),
              'src'         => ''
            )
          )
        ),
        array(
          'id'          => 'single_product_banner_size',
          'label'       => __('Banner Size', 'youplay'),
          'desc'        => '',
          'std'         => 'default',
          'type'        => 'select',
          'choices'     => array(
            array(
              'value'       => 'default',
              'label'       => __('Default', 'youplay'),
              'src'         => ''
            ),
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
          'id'          => 'tab_product_additional_params',
          'label'       => __('Aditional Parameters', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'tab',
          'operator'    => 'and'
        ),
        array(
          'id'          => 'single_product_additional_params',
          'label'       => __('Show Additional Params', 'youplay'),
          'desc'        => '',
          'std'         => 'off',
          'type'        => 'on-off',
        ),
        array(
          'id'          => 'single_product_additional_params_title',
          'label'       => __('Title', 'youplay'),
          'desc'        => '',
          'std'         => __('System Requirements', 'youplay'),
          'type'        => 'text',
        ),
        array(
          'id'          => 'single_product_additional_params_cont',
          'label'       => __('Content Text', 'youplay'),
          'desc'        => '',
          'std'         => '',
          'type'        => 'textarea',
        ),
      )
    );
    
    if (function_exists('ot_register_meta_box')) {
      ot_register_meta_box( $meta_box );
    }
  }
}
?>