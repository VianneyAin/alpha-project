<?php

/*----------------------------------------------------------------------------------------------------------
Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Recent_Tweets extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
  parent::__construct(
    'gameleon_recent_tweets',
    __( '[GAMELEON] Recent Tweets', 'gameleon' ),  // Widget Name
    array( 'description' => __( 'Display Latest Tweets', 'gameleon' ), ) // Widget Args
    );
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
  extract( $args );

  $title        = apply_filters( 'widget_title', $instance['title'] );
  $hide_footer  = ! empty( $instance['hide_footer'] ) ? '1' : '0';
  $username     = $instance['username'];
  $widget_id    = $instance['widget_id'];
  $number       = $instance['number'];

  echo $before_widget;

  ?>

  <?php if ( $title ) : // widget title ?>
  <div class="widget-title">
  <h3>
  <?php echo $title; ?>
  </h3>
  </div>
  <?php endif; ?>

<a class="twitter-timeline" data-tweet-limit="<?php echo $number; ?>"  href="https://twitter.com/<?php echo $username; ?>" data-chrome="<?php if( $hide_footer == 1 ): ?>nofooter<?php endif; ?> noborders noscrollbar" data-widget-id="<?php echo $widget_id; ?>">Tweets by @<?php echo $username; ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

    <?php
    echo $after_widget;
 }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
  $instance = array();
  $instance                 = $old_instance;
  $instance['title']        = strip_tags( $new_instance['title'] );
  $instance['hide_footer']  = $new_instance['hide_footer'];
  $instance['username']     = strip_tags( $new_instance['username'] );
  $instance['widget_id']    = $new_instance['widget_id'];
  $instance['number']       = absint( $new_instance['number'] );

  return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
  $defaults = array(
    'title'     => 'Recent Tweets',
    'hide_footer' => 'off',
    'username'    => '',
    'widget_id'   => '',
    'number'    => '3'
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
<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Twitter Username:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Limit number of Tweets:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'widget_id' ); ?>"><?php _e( 'Widget ID:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'widget_id' ); ?>" name="<?php echo $this->get_field_name( 'widget_id' ); ?>" value="<?php echo $instance['widget_id']; ?>" />
</p>

<p class="description"><?php _e( 'You need to ', 'gameleon' ); ?>
<a target="blank" href="https://twitter.com/settings/widgets"><?php _e( 'create a Twitter widget', 'gameleon' ); ?></a>
<?php _e( 'and obtain a widget ID. After creating the widget, the Twitter widget ID will be a long number on your browser url between the /widgets/ and /edit portion of the url.', 'gameleon' ); ?>
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['hide_footer'], 'on' ); ?> id="<?php echo $this->get_field_id('hide_footer'); ?>" name="<?php echo $this->get_field_name( 'hide_footer' ); ?>" />
<label for="<?php echo $this->get_field_id('hide_footer'); ?>"><?php _e( 'Hide Footer Timeline', 'gameleon' ); ?></label>
</p>


<?php
  }

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Recent_Tweets widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_recent_tweets_init(){
  register_widget( 'Gameleon_Recent_Tweets' );
}

add_action( 'widgets_init', 'gameleon_recent_tweets_init' );