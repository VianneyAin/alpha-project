<?php
/*----------------------------------------------------------------------------------------------------------
  Gameleon_Feedburner widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Feedburner extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
      'gameleon_feedburner', // Base Widget ID
      __( '[GAMELEON] Subscribe', 'gameleon' ), // Widget Name
      array( 'description' => __( 'A widget that allows users to subscribe via email to your Feedburner feed.', 'gameleon' ), ) // Widget Args
      );
}

/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		$buffer 		= $before_widget;
		//$title          = apply_filters( 'widget_title', $instance['title'] );
		$feed 			= empty( $instance['feed']) ? false : $instance['feed'];
		$text_before 	= empty( $instance['text_before'] ) ? false : $instance['text_before'];
		$button_text 	= empty( $instance['button_text'] ) ? 'Subscribe' : $instance['button_text'];
		$user 			= str_replace( 'http://feeds.feedburner.com/', '', $feed);

		// if (!empty( $title ) ) {
		// 	$buffer .= $before_title . trim($title) . $after_title;
		// }


/*----------------------------------------------------------------------------------------------------------
  Widget Content
-----------------------------------------------------------------------------------------------------------*/

		$buffer .= '<div class="td-feedburner-wrap">';
		if (strlen($text_before) > 0) {
			$buffer .= '<div id="td-feedburner-afterform">' . trim($text_before) . '</div>';
		}

		$buffer .= '<form id="gameleon_feedburner" action="http://feedburner.google.com/fb/a/mailverify" method="post" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri=' . $user . '\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\' )" target="popupwindow">';
		$placeholder = esc_attr__( 'Enter your email', 'gameleon' );
		$buffer .= '<input id="gameleon_feedburner_email" class="feedburner-email" placeholder="' . trim( $placeholder ) .'" type="text" name="email" />';
		$buffer .= '<input type="hidden" value="' . $user . '" name="uri"/>';
		$buffer .= '<input type="hidden" name="loc" value="en_US"/>';
		$buffer .= '<input id="gameleon_feedburner_submit" class="feedburner-subscribe" type="submit" value="' . trim($button_text) . '" />';
		$buffer .= '</form>';
		$buffer .= '</div>';
        $buffer .= $after_widget;

        echo $buffer;
    }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

function form ( $instance ) {

	$instance = wp_parse_args((array) $instance, array(
		//'title' 		=> '',
		'feed' 			=> '',
		'text_before' 	=> '',
		'button_text' 	=> ''
		));

		//$title 			= esc_attr( $instance['title'] );
		$feed 			= esc_attr( $instance['feed'] );
		$text_before 	= esc_attr( $instance['text_before'] );
		$button_text 	= empty( $instance['button_text'] ) ? 'Subscribe' : esc_attr( $instance['button_text'] );
?>


<?php

/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/

?>

	<p><?php _e( 'You need a Feedburner account and email subscriptions to be turned on.', 'gameleon' ); ?></p>


	<p>
		<label for="<?php echo $this->get_field_id( 'feed' ); ?>"><?php _e( 'Feedburner feed User:','gameleon' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'feed' ); ?>" name="<?php echo $this->get_field_name( 'feed' ); ?>" type="text" value="<?php echo $instance['feed']; ?>" />
		<small><em><?php echo '(http://feeds.feedburner.com/USER)'; ?></em></small>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Submit button text:','gameleon' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr($instance['button_text']); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'text_before' ); ?>"><?php _e( 'Text before the form:','gameleon' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'text_before' ); ?>" name="<?php echo $this->get_field_name( 'text_before' ); ?>" rows="10"><?php echo esc_attr($instance['text_before']); ?></textarea>
	</p>

<?php

	}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Feedburner widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_feedburner_init(){
register_widget( 'Gameleon_Feedburner' );
}

add_action( 'widgets_init', 'gameleon_feedburner_init' );