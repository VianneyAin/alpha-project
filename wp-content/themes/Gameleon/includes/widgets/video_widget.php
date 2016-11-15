<?php
/*----------------------------------------------------------------------------------------------------------
  Gameleon_Video_Widget widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Video_Widget extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
      'gameleon_video_widget', // Base Widget ID
      __( '[GAMELEON] Video Module', 'gameleon' ), // Widget Name
      array( 'description' => __( 'A widget that plays responsive videos from any video provider allowed by WordPress.', 'gameleon' ), ) // Widget Args
      );
}



/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
  extract( $args );

  $title              = apply_filters( 'widget_title', $instance['title'] );
  $embed_url          = $instance['embed_url'];
  $post_url           = $instance['post_url'];
  $embed_width        = $instance['embed_width'];
  $embed_description  = $instance['embed_description'];

  echo $before_widget;

  ?>

  <?php if ( $title ) : // widget title ?>
  <div class="widget-title">
  <h3>
  <?php echo $title; ?>
  </h3>
  </div>
  <?php endif; ?>

  <div class="td-video-wrapp">
    <div class="td-fly-in">

      <?php

        $buffer = '';
        $buffer_post_url = '';

        if( !empty( $post_url ) ) {  // Check if post URL is entered
        $buffer_post_url .= '<a href="' . $post_url . '">';
        $buffer_post_url .= $embed_description;
        $buffer_post_url .= '</a>';
        } else {
        $buffer_post_url .= $embed_description;
        }

        if( !empty( $embed_url ) ) { // Check if embed URL is entered
        $buffer.= '<div class="td-widget-video">';
        if( !empty( $embed_width ) && $embed_width > 0 ) { // Check if user entered embed width
        $buffer.= wp_oembed_get( $embed_url, array( 'width' => $embed_width ) );
        } else {
        $buffer.= wp_oembed_get( $embed_url );
        }

        $buffer.= '</div>';
        } // end if embed URL

        if( !empty( $embed_description ) ) {   // Check if embed description is entered
        $buffer.= '<div class="td-embed-description">';
        $buffer.= '<h4 class="video-post-title">';
        $buffer.= '<span><i class="fa fa-youtube-play"></i></span>';
        $buffer.= $buffer_post_url;
        $buffer.= '</h4>';
        $buffer.= '</div>';
        }

        echo $buffer;

      ?>

    </div>
  </div>

    <?php
    echo $after_widget;
 }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
  $instance = array();
  $instance                       = $old_instance;
  $instance['title']              = strip_tags( $new_instance['title'] );
  $instance['embed_url']          = $new_instance['embed_url'];
  $instance['post_url']           = $new_instance['post_url'];
  $instance['embed_width']        = $new_instance['embed_width'];
  $instance['embed_description']  = $new_instance['embed_description'];

  return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
  $defaults = array(
    'title'             => 'Video of the day',
    'embed_url'         => '',
    'post_url'          => '',
    'embed_width'       => '300',
    'embed_description' => ''
    );

  $instance = wp_parse_args( (array) $instance, $defaults );


/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'embed_url' ); ?>"><?php _e( 'Video URL:', 'gameleon' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'embed_url' ); ?>" name="<?php echo $this->get_field_name( 'embed_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['embed_url'] ) ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'embed_width' ); ?>"><?php _e( 'Video width (optional):', 'gameleon' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'embed_width' ); ?>" name="<?php echo $this->get_field_name( 'embed_width' ); ?>" type="text" value="<?php echo esc_attr( $instance['embed_width'] ) ?>"/>
</p>
<p class="description"><?php _e( 'Suitable widths are 300 for sidebar and 700 for Homepage.', 'gameleon' ); ?></p>
<p>
<label for="<?php echo $this->get_field_id( 'embed_description' ); ?>"><?php _e( 'Video Description:', 'gameleon' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'embed_description' ); ?>" name="<?php echo $this->get_field_name( 'embed_description' ); ?>" type="text" value="<?php echo esc_attr( $instance['embed_description'] ) ?>"/>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'post_url' ); ?>"><?php _e( 'Article URL:', 'gameleon' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'post_url' ); ?>" name="<?php echo $this->get_field_name( 'post_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['post_url'] ) ?>" />
</p>
<p class="description"><?php _e( 'Enter a post URL for video description.', 'gameleon' ); ?></p>

<?php
  }

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Video_Widget widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_video_widget_init(){
  register_widget( 'Gameleon_Video_Widget' );
}

add_action( 'widgets_init', 'gameleon_video_widget_init' );