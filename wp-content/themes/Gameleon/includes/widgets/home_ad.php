<?php

/*----------------------------------------------------------------------------------------------------------
	Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Home_Ad extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
	parent::__construct(
		'gameleon_home_ad',
		__( '[GAMELEON] Home Ad', 'gameleon' ),  // Widget Name
		array( 'description' => __( 'Displays a custom ad banner on your homepage layout', 'gameleon' ), ) // Widget Args
		);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
	extract( $args );

	$title  = apply_filters( 'widget_title', $instance['title'] );
	$link 	= $instance['link'];
	$alt 	= $instance['alt'];
	$image 	= $instance['image'];
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


	<?php
	if( $image ) : ?>
		<div class="td-banner-home">
			<a href="<?php echo $link; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $alt; ?>" /></a>
		</div>
	<?php else : ?>
		<div class="td-banner-home"><?php echo stripslashes( $code ); ?></div>
	<?php endif ; ?>

    <?php
    echo $after_widget;
 }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance 			= $old_instance;
	$instance['title']  = strip_tags( $new_instance['title'] );
	$instance['link'] 	= $new_instance['link'];
	$instance['alt'] 	= $new_instance['alt'];
	$instance['image'] 	= $new_instance['image'];
	$instance['code'] 	= $new_instance['code'];

	return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
	$defaults = array(
		'title' => 'Advertisement',
        'link' 	=> '',
        'alt' 	=> 'banner',
        'image' => '',
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

<h4><?php _e( 'Using image:', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Target Url:', 'gameleon' ); ?>:</label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'alt' ); ?>"><?php _e( 'Image <em>alt</em> attribute:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'alt' ); ?>" name="<?php echo $this->get_field_name( 'alt' ); ?>" value="<?php echo $instance['alt']; ?>" />
</p>
<p class="description"><?php _e( 'An imagine element must have an <em>alt</em> attribute, useful for markup validation.', 'gameleon' ); ?>.</p>


<h4><?php _e( 'Or using custom code:', 'gameleon' ); ?></h4>
<p>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'code' ); ?>" name="<?php echo $this->get_field_name( 'code' ); ?>"><?php echo $instance['code']; ?></textarea>
</p>

<?php
	}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Home_Ad widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_home_ad_init(){
	register_widget( 'Gameleon_Home_Ad' );
}

add_action( 'widgets_init', 'gameleon_home_ad_init' );