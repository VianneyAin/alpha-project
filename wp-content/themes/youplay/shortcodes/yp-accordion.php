<?php
/**
 * YP Accordion
 *
 * Example:
 * [yp_accordion boxed="false"]
 *    [yp_accordion_tab title="Home" active="true"]...[/yp_accordion_tab]
 *    [yp_accordion_tab title="Other"]...[/yp_accordion_tab]
 * [/yp_accordion]
 */
add_shortcode("yp_accordion", "yp_accordion");
function yp_accordion($atts, $content = null) {
    STATIC $id = 0;
    $id++;

    extract( shortcode_atts( array(
      "boxed"   => false,
      'class'   => ''
    ), $atts ) );

    if(yp_check($boxed)) {
        $class .= " container";
    }

    $content = yp_fix_content($content);

    // extract tabs content
    $reg = get_shortcode_regex();
    preg_match_all('~'.$reg.'~',$content, $matches);
    $tab_contents = array();
    if ( isset( $matches[5] ) ) {
        $tab_contents = $matches[5];
    }

    // extract tab titles
    preg_match_all( '/yp_accordion_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
    $tab_titles = array();
    if ( isset( $matches[1] ) ) {
        $tab_titles = $matches[1];
    }

    $result = '';
    $tabID = 0;
    foreach ( $tab_titles as $tab ) {
        $tab_atts = shortcode_parse_atts($tab[0]);

        if(!isset($tab_atts['active'])) {
          $tab_atts['active'] = false;
        }
        if(!isset($tab_atts['title'])) {
          $tab_atts['title'] = "";
        }

        $fullTabID = 'tab-' . $id . '-' . $tabID;

        $result .=
         '<div class="panel panel-default">
            <div class="panel-heading" role="tab" id="' . esc_attr('heading-' . $fullTabID) . '">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion' . esc_attr($id) . '" href="' . esc_url('#collapse-'. $fullTabID) . '" aria-expanded="true" aria-controls="' . esc_attr('collapse-'. $fullTabID) . '">
                  ' . esc_html($tab_atts['title']) . ' <span class="icon-' . (yp_check($tab_atts['active'])?'minus':'plus') . '"></span>
                </a>
              </h4>
            </div>
            <div id="' . esc_attr('collapse-'. $fullTabID) . '" class="panel-collapse collapse '. (yp_check($tab_atts['active'])?' in':'') . '" role="tabpanel" aria-labelledby="' . esc_attr('heading-' . $fullTabID) . '">
              <div class="panel-body">
                ' . do_shortcode(yp_fix_content($tab_contents[$tabID])) . '
              </div>
            </div>
          </div>';

        $tabID++;
    }

    return '<div class="panel-group youplay-accordion ' . yp_sanitize_class($class) . '" id="' . esc_attr('accordion' . $id) . '" role="tablist" aria-multiselectable="false">' . $result . '</div>';
}

// each tab shortcode
add_shortcode("yp_accordion_tab", "yp_accordion_tab");
function yp_accordion_tab($atts, $content = null) {
    extract( shortcode_atts( array(
      'title' => __( "Section", "youplay" ),
      'active' => false
    ), $atts ) );


    return '<div class="panel-body">
              ' . do_shortcode(yp_fix_content($content)) . '
            </div>';
}



/* Add VC Shortcode */
add_action( "after_setup_theme", "vc_youplay_accordion" );
function vc_youplay_accordion() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
          "name" => __("YP Accordion", "youplay"),
          "base" => "yp_accordion",
          "show_settings_on_create" => false,
          "is_container" => true,
          "icon" => "icon-youplay",
          "category" => "Youplay",
          "admin_enqueue_css"   => get_template_directory_uri() . "/shortcodes/css/yp-accordion-vc-view.css",
          "admin_enqueue_js"   => get_template_directory_uri() . "/shortcodes/js/yp-accordion-vc-view.js",
          "params" => array(
            array(
               "type"        => "checkbox",
               "heading"     => __("Boxed", "youplay"),
               "param_name"  => "boxed",
               "value"       => array( __( "", "youplay" ) => true ),
               "description" => "Use it when your page content boxed disabled",
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Custom Classes", "youplay" ),
              "param_name" => "class",
              "description" => ""
            )
          ),
          "custom_markup" => "
            <div class='wpb_accordion_holder wpb_holder clearfix vc_container_for_children'>
            %content%
            </div>
            <div class='tab_controls'>
                <a class='add_tab' title='" . __( "Add section", "youplay" ) . "'><span class='vc_icon'></span> <span class='tab-label'>" . __( "Add section", "youplay" ) . "</span></a>
            </div>",
          "default_content" => "
            [yp_accordion_tab title='" . __( "Section 1", "youplay" ) . "'][/yp_accordion_tab]
            [yp_accordion_tab title='" . __( "Section 2", "youplay" ) . "'][/yp_accordion_tab]
          ",
          "js_view" => "YPAccordionView"
        ) );
    }
}
add_action( "after_setup_theme", "vc_youplay_accordion_tab" );
function vc_youplay_accordion_tab() {
    if(function_exists("wpb_map")) {
        /* Register shortcode with Visual Composer */
        wpb_map( array(
           "name"             => __("YP Accordion Content", "youplay"),
           "base"             => "yp_accordion_tab",
           "category"         => "Youplay",
           "icon"             => "icon-youplay",
           "allowed_container_element" => "vc_row",
           "content_element"  => false,
           "is_container"     => true,
           "params"           => array(
              array(
                 "type"        => "textfield",
                 "heading"     => __("Title", "youplay"),
                 "param_name"  => "title",
                 "value"       => __("Youplay", "youplay"),
                 "description" => "",
              ),
              array(
                  "type"       => "checkbox",
                  "heading"    => __( "Active", "youplay" ),
                  "param_name" => "active",
                  "value"      => array( __( "", "youplay" ) => true )
              ),
           ),
           "js_view" => "YPAccordionTabView"
        ) );
    }
}



if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_yp_accordion extends WPBakeryShortCodesContainer {
      protected $controls_css_settings = 'out-tc vc_controls-content-widget';

      public function __construct( $settings ) {
        parent::__construct( $settings );
      }


      public function contentAdmin($atts, $content = NULL) {
        $width = $custom_markup = '';
        $shortcode_attributes = array( 'width' => '1/1' );
        foreach ( $this->settings['params'] as $param ) {
          if ( $param['param_name'] != 'content' ) {
            if ( isset( $param['value'] ) && is_string( $param['value'] ) ) {
              $shortcode_attributes[ $param['param_name'] ] = __( $param['value'], "js_composer" );
            } elseif ( isset( $param['value'] ) ) {
              $shortcode_attributes[ $param['param_name'] ] = $param['value'];
            }
          } else if ( $param['param_name'] == 'content' && $content == null ) {
            $content = __( $param['value'], "js_composer" );
          }
        }
        extract( shortcode_atts(
          $shortcode_attributes
          , $atts ) );

        $output = '';

        $elem = $this->getElementHolder( $width );

        $inner = '';
        foreach ( $this->settings['params'] as $param ) {
          $param_value = '';
          $param_value = isset( $$param['param_name'] ) ? $$param['param_name'] : '';
          if ( is_array( $param_value ) ) {
            // Get first element from the array
            reset( $param_value );
            $first_key = key( $param_value );
            $param_value = $param_value[ $first_key ];
          }
          $inner .= $this->singleParamHtmlHolder( $param, $param_value );
        }
        $tmp = '';

        if ( isset( $this->settings["custom_markup"] ) && $this->settings["custom_markup"] != '' ) {
          if ( $content != '' ) {
            $custom_markup = str_ireplace( "%content%", $tmp . $content, $this->settings["custom_markup"] );
          } else if ( $content == '' && isset( $this->settings["default_content_in_template"] ) && $this->settings["default_content_in_template"] != '' ) {
            $custom_markup = str_ireplace( "%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"] );
          } else {
            $custom_markup = str_ireplace( "%content%", '', $this->settings["custom_markup"] );
          }
          $inner .= do_shortcode( $custom_markup );
        }
        $elem = str_ireplace( '%wpb_element_content%', $inner, $elem );
        $output = $elem;

        return $output;
      }
    }
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {    
    class WPBakeryShortCode_yp_accordion_tab extends WPBakeryShortCodesContainer {
      protected $controls_css_settings = 'tc vc_control-container';
      protected $controls_list = array( 'add', 'edit', 'clone', 'delete' );
      protected $predefined_atts = array(
        'class' => '',
        'width' => '',
        'title' => ''
      );
      protected $controls_template_file = 'editors/partials/backend_controls_tab.tpl.php';

      public function contentAdmin( $atts, $content = null ) {
        $width = $class = $title = '';
        extract( shortcode_atts( $this->predefined_atts, $atts ) );

        $column_controls = $this->getColumnControls( $this->settings( 'controls' ) );
        $column_controls_bottom = $this->getColumnControls( 'add', 'bottom-controls' );

        $output = '';

        $output .= '<div class="group wpb_sortable">';
          $output .= '<h3><span class="tab-label"><%= params.title %></span></h3>';

          $output .= $this->getElementHolder('1/1');

          $inner = '';
          $inner .= '<h4 class="wpb_element_title"> <i title="'.$this->settings['name'].'" class="vc_element-icon '.$this->settings['icon'].'"></i> </h4>';

          $inner .= '<div ' . $this->containerHtmlBlockParams( 100, 1 ) . '>';
          $inner .= do_shortcode( shortcode_unautop( $content ) );
          $inner .= '</div>';

          $inner .= $column_controls_bottom;

        $output .= '</div>';

        $output = str_ireplace( '%wpb_element_content%', $inner, $output );

        return $output;
      }

      public function mainHtmlBlockParams( $width, $i ) {
        return 'data-element_type="' . $this->settings["base"] . '" class=" wpb_' . $this->settings['base'] . '"' . $this->customAdminBlockParams();
      }

      public function containerHtmlBlockParams( $width, $i ) {
        return 'class="wpb_column_container vc_container_for_children"';
      }

      public function getColumnControls($controls = 'full', $extended_css = '') {
          return $this->getColumnControlsModular( $extended_css );
      }
    }
}