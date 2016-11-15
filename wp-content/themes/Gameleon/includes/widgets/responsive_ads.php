<?php
/*----------------------------------------------------------------------------------------------------------
Gameleon_Ads_Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Ads_Widget extends WP_Widget {
  /*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress  -----------------------------------------------------------------------------------------------------------*/
  function __construct() {
      parent::__construct(    'gameleon_ads_widget', // Base Widget ID    __( '[GAMELEON] Responsive Ads', 'gameleon' ),
        // Widget Name
        array( 'description' => __( 'A widget that displays a responsive Ad on Home Page or Sidebar.', 'gameleon' ), )
        // Widget Args
      );
  }

  /*----------------------------------------------------------------------------------------------------------
  Front-end display of widget
  -----------------------------------------------------------------------------------------------------------*/
  public function widget( $args, $instance ) {
    $td_ad_slot = $instance['td_ad_slot'];
    switch( $td_ad_slot ) {
      case 'sidebar':
        $td_adslot = gameleon_get_option( 'td_ad_sidebar' );
        break;
      case 'custom_ad_1':
        $td_adslot = gameleon_get_option( 'td_ad_custom1' );
        break;
      case 'custom_ad_2':
        $td_adslot = gameleon_get_option( 'td_ad_custom2' );
        break;
      case 'custom_ad_3':
        $td_adslot = gameleon_get_option( 'td_ad_custom3' );
        break;
      default:      $td_adslot = '';
    }

    $buffer = '';    $buffer .= do_shortcode( stripslashes( $td_adslot ) );
    if( $td_adslot ) {
      echo '<blockquote id="adblocker"><img src="http://alpha-project.fr/wp-content/uploads/2016/08/adblock.png" /></blockquote>';
      echo $args['before_widget'];
      echo '<div class="sidebar-ad">'. $buffer .'</div>';
      echo $args['after_widget'];
    }
    else {
      return;
    }
  }
  /*----------------------------------------------------------------------------------------------------------
  Back-end widget form
  -----------------------------------------------------------------------------------------------------------*/
  public function form( $instance ) {
    if( $instance) {
      $td_ad_slot = esc_attr( $instance['td_ad_slot'] );
    }
    else {
      $td_ad_slot = '';
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'td_ad_slot' ); ?>">
        <?php _e( 'Select the ad slot you want to display:', 'gameleon' ); ?>
      </label>
      <select id="<?php echo $this->get_field_id( 'td_ad_slot' ); ?>" name="<?php echo $this->get_field_name( 'td_ad_slot' ); ?>" class="widefat">
        <option value="sidebar"<?php if( $td_ad_slot=="sidebar" ) echo ' selected="selected"';?>><?php _e( 'Responsive Sidebar Ad', 'gameleon' );?></option>
        <option value="custom_ad_1"<?php if( $td_ad_slot=="custom_ad_1" ) echo ' selected="selected"';?>><?php _e( 'Responsive Custom Ad 1', 'gameleon' );?></option>
        <option value="custom_ad_2"<?php if( $td_ad_slot=="custom_ad_2" ) echo ' selected="selected"';?>><?php _e( 'Responsive Custom Ad 2', 'gameleon' );?></option>
        <option value="custom_ad_3"<?php if( $td_ad_slot=="custom_ad_3" ) echo ' selected="selected"';?>><?php _e( 'Responsive Custom Ad 3', 'gameleon' );?></option>
      </select>
    </p>
    <?php
  }

  /*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
  -----------------------------------------------------------------------------------------------------------*/
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['td_ad_slot'] = strip_tags($new_instance['td_ad_slot']);
    return $instance;
  }
} // end Gameleon_Ads_Widget class

/*----------------------------------------------------------------------------------------------------------
Register Gameleon_Ads_Widget widget
-----------------------------------------------------------------------------------------------------------*/
function register_gameleon_ads_widget() {
  register_widget( 'Gameleon_Ads_Widget' );
}
add_action( 'widgets_init', 'register_gameleon_ads_widget' );
