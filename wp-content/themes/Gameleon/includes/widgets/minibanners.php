<?php

/*----------------------------------------------------------------------------------------------------------
	Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Minibanners extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
parent::__construct(
'gameleon_minibanners',
__( '[GAMELEON] Minibanners', 'gameleon' ), // Widget Name
array( 'description' => __( 'Displays 4 custom banners of 125x125, suitable for sidebar.', 'gameleon' ), ) // Widget Args
);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

		$title  = apply_filters( 'widget_title', $instance['title'] );
		$link1 	= $instance['link1'];
		$image1 = $instance['image1'];
		$code1 	= $instance['code1'];

		$link2 	= $instance['link2'];
		$image2 = $instance['image2'];
		$code2 	= $instance['code2'];

		$link3 	= $instance['link3'];
		$image3 = $instance['image3'];
		$code3 	= $instance['code3'];

		$link4 	= $instance['link4'];
		$image4 = $instance['image4'];
		$code4 	= $instance['code4'];

		$alt1 	= $instance['alt1'];
		$alt2 	= $instance['alt2'];
		$alt3 	= $instance['alt3'];
		$alt4 	= $instance['alt4'];

        echo $before_widget;

		?>

		<?php if ( $title ) : ?>
		<div class="widget-title">
		<h3>
		<?php echo $title; ?>
		</h3>
		</div>
		<?php endif; ?>

        <div class="td-minibanners ">
		<?php
		if( $link1 || $image1 || $code1 ) {
		if( $image1 ) {
		?>
			<div class="td-banner125"><a href="<?php echo $link1; ?>"><img src="<?php echo $image1; ?>" alt="<?php echo $alt1; ?>" /></a></div>
		<?php
		}
		else {
		?>
			<div class="td-banner125"><?php echo stripslashes( $code1 ); ?></div>
		<?php }
		} ?>


		<?php
		if( $link2 || $image2 || $code2 ) {
		if( $image2 ) {
		?>
			<div class="td-banner125 right"><a href="<?php echo $link2; ?>"><img src="<?php echo $image2; ?>" alt="<?php echo $alt2; ?>" /></a></div>
		<?php
		}
		else {
		?>
			<div class="td-banner125 right"><?php echo stripslashes( $code2 ); ?></div>
		<?php }
		} ?>

		<?php
		if( $link3 || $image3 || $code3 ){
		if( $image3 ) {
		?>
			<div class="td-banner125"><a href="<?php echo $link3; ?>"><img src="<?php echo $image3; ?>" alt="<?php echo $alt3; ?>" /></a></div>
		<?php
		}
		else {
		?>
			<div class="td-banner125"><?php echo stripslashes( $code3 ); ?></div>
		<?php }
		} ?>

		<?php
		if( $link4 || $image4 || $code4 ){
		if( $image4 ) {
		?>
			<div class="td-banner125 right"><a href="<?php echo $link4; ?>"><img src="<?php echo $image4; ?>" alt="<?php echo $alt4; ?>" /></a></div>
		<?php
		}
		else {
		?>
			<div class="td-banner125 right"><?php echo stripslashes( $code4 ); ?></div>
		<?php }
		} ?>

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
	$instance['link1'] 			= $new_instance['link1'];
	$instance['image1'] 		= $new_instance['image1'];
	$instance['code1'] 			= $new_instance['code1'];

	$instance['link2'] 			= $new_instance['link2'];
	$instance['image2'] 		= $new_instance['image2'];
	$instance['code2'] 			= $new_instance['code2'];

	$instance['link3'] 			= $new_instance['link3'];
	$instance['image3'] 		= $new_instance['image3'];
	$instance['code3'] 			= $new_instance['code3'];

	$instance['link4'] 			= $new_instance['link4'];
	$instance['image4'] 		= $new_instance['image4'];
	$instance['code4'] 			= $new_instance['code4'];

	$instance['alt1'] 			= $new_instance['alt1'];
	$instance['alt2'] 			= $new_instance['alt2'];
	$instance['alt3'] 			= $new_instance['alt3'];
	$instance['alt4'] 			= $new_instance['alt4'];

	return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
		'title' 	=> 'Ads',
        'link1' 	=> '',
        'link2' 	=> '',
        'link3' 	=> '',
        'link4' 	=> '',
        'code1' 	=> '',
        'code2' 	=> '',
        'code3' 	=> '',
        'code4' 	=> '',
        'image1' 	=> '',
        'image2' 	=> '',
        'image3' 	=> '',
        'image4' 	=> '',
        'alt1'		=> 'banner',
        'alt2' 		=> 'banner',
        'alt3' 		=> 'banner',
        'alt4' 		=> 'banner'
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

<h3><?php _e( 'Banner ad 1', 'gameleon' ); ?></h3>
<h4><?php _e( 'Using image:', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'image1' ); ?>"><?php _e( 'Image Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image1' ); ?>" name="<?php echo $this->get_field_name( 'image1' ); ?>" value="<?php echo $instance['image1']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e( 'Target Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo $instance['link1']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'alt1' ); ?>"><?php _e( 'Image <em>alt</em> attribute:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'alt1' ); ?>" name="<?php echo $this->get_field_name( 'alt1' ); ?>" value="<?php echo $instance['alt1']; ?>" />
</p>
<p class="description"><?php _e( 'An imagine element must have an <em>alt</em> attribute, useful for markup validation.', 'gameleon' ); ?>.</p>


<h4><?php _e( 'Or using custom code:', 'gameleon' ); ?></h4>
<p>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'code1' ); ?>" name="<?php echo $this->get_field_name( 'code1' ); ?>"><?php echo $instance['code1']; ?></textarea>
</p>

<h3><?php _e( 'Banner ad 2', 'gameleon' ); ?></h3>
<h4><?php _e( 'Using image:', 'gameleon' ); ?></h4>
<p>
<label for="<?php echo $this->get_field_id( 'image2' ); ?>"><?php _e( 'Image Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text"  id="<?php echo $this->get_field_id( 'image2' ); ?>" name="<?php echo $this->get_field_name( 'image2' ); ?>" value="<?php echo $instance['image2']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e( 'Target Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'alt2' ); ?>"><?php _e( 'Image <em>alt</em> attribute:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'alt2' ); ?>" name="<?php echo $this->get_field_name( 'alt2' ); ?>" value="<?php echo $instance['alt2']; ?>" />
</p>


<h4><?php _e( 'Or using custom code:', 'gameleon' ); ?></h4>
<p>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'code2' ); ?>" name="<?php echo $this->get_field_name( 'code2' ); ?>"><?php echo $instance['code2']; ?></textarea>
</p>

<h3><?php _e( 'Banner ad 3', 'gameleon' ); ?></h3>
<h4><?php _e( 'Using image:', 'gameleon' ); ?></h4>
<p>
<label for="<?php echo $this->get_field_id( 'image3' ); ?>"><?php _e( 'Image Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image3' ); ?>" name="<?php echo $this->get_field_name( 'image3' ); ?>" value="<?php echo $instance['image3']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e( 'Target Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'alt3' ); ?>"><?php _e( 'Image <em>alt</em> attribute:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'alt3' ); ?>" name="<?php echo $this->get_field_name( 'alt3' ); ?>" value="<?php echo $instance['alt3']; ?>" />
</p>

<h4><?php _e( 'Or using custom code:', 'gameleon' ); ?></h4>
<p>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'code3' ); ?>" name="<?php echo $this->get_field_name( 'code3' ); ?>"><?php echo $instance['code3']; ?></textarea>
</p>

<h3><?php _e( 'Banner ad 4', 'gameleon' ); ?></h3>
<h4><?php _e( 'Using image:', 'gameleon' ); ?></h4>
<p>
<label for="<?php echo $this->get_field_id( 'image4' ); ?>"><?php _e( 'Image Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image4' ); ?>" name="<?php echo $this->get_field_name( 'image4' ); ?>" value="<?php echo $instance['image4']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e( 'Target Url:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo $instance['link4']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'alt4' ); ?>"><?php _e( 'Image <em>alt</em> attribute:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'alt4' ); ?>" name="<?php echo $this->get_field_name( 'alt4' ); ?>" value="<?php echo $instance['alt4']; ?>" />
</p>

<h4><?php _e( 'Or using custom code:', 'gameleon' ); ?></h4>
<p>
<textarea class="widefat" id="<?php echo $this->get_field_id( 'code4' ); ?>" name="<?php echo $this->get_field_name( 'code4' ); ?>"><?php echo $instance['code4']; ?></textarea>
</p>


<?php
	}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Minibanners widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_minibanners_init(){
register_widget( 'Gameleon_Minibanners' );
}

add_action( 'widgets_init', 'gameleon_minibanners_init' );