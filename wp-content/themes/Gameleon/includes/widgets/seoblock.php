<?php

/*----------------------------------------------------------------------------------------------------------
Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Seo_Block extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
	parent::__construct(
		'gameleon_seo_block',
		__( '[GAMELEON] SEO Text Block', 'gameleon' ),  // Widget Name
		array( 'description' => __( 'Display a SEO text block on your home page or sidebar', 'gameleon' ), ) // Widget Args
		);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
	extract( $args );

	$title  = apply_filters( 'widget_title', $instance['title'] );
	$code 	= $instance['code'];

	echo $before_widget;

	?>

	<?php if ( $title ) : // widget title ?>
	<div class="widget-title">
	<h3>
	<?php echo $title; ?>
	</h3>
	</div>
	<?php endif; ?>


	<div class="td-fly-in">
	<div id="td-seo-block" class="seo-block">
	<p>
	<?php echo stripslashes($code); ?>
	</p>
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
	$instance 					= $old_instance;
	$instance['title']          = strip_tags( $new_instance['title'] );
	$instance['code'] 		= $new_instance['code'];

	return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
	$defaults = array(
		'title' 	=> 'Seo Block',
		'code' 	=> ''
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
<label for="<?php echo $this->get_field_id('code'); ?>"><?php _e( 'SEO Text:', 'gameleon' ); ?></label>
<textarea class="widefat" id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>"><?php echo $instance['code']; ?></textarea>
</p>


<?php
	}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Seo_Block widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_seo_block_init(){
	register_widget( 'Gameleon_Seo_Block' );
}

add_action( 'widgets_init', 'gameleon_seo_block_init' );