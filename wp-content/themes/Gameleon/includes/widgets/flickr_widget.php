<?php

/*----------------------------------------------------------------------------------------------------------
	Gameleon_Flickr_Widget Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Flickr_Widget extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
	parent::__construct(
		'gameleon_flickr_widget',
		__( '[GAMELEON] Flickr Photos', 'gameleon' ),  // Widget Name
		array( 'description' => __( 'Displays photos from Flickr', 'gameleon' ), ) // Widget Args
		);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
	extract( $args );

	$query_args = array();

	$title  	= apply_filters( 'widget_title', $instance['title'] );
	$query_args['count'] = !empty( $instance['count'] ) ? $instance['count'] : '';
	$query_args['display'] = !empty( $instance['display'] ) ? $instance['display'] : 'latest';
	$query_args['layout'] = !empty( $instance['layout'] ) ? $instance['layout'] : 'x';
	$query_args['size'] = !empty( $instance['size'] ) ? $instance['size'] : 'm';
	$query_args['source'] = !empty( $instance['source'] ) ? $instance['source'] : 'user';
	if( !empty( $instance['tag'] ) ) {
		if( $instance['source'] == 'user' )
			$query_args['source'] = 'user_tag';
		elseif( $instance['source'] == 'group' )
			$query_args['source'] = 'group_tag';
		elseif( $instance['source'] == 'all' )
			$query_args['source'] = 'all_tag';
	}
	if($instance['source'] == 'user')
		$query_args['user'] = $instance['id'];
	elseif( $instance['source'] == 'user_set' )
		$query_args['set'] = $instance['id'];
	elseif( $instance['source'] == 'group' )
		$query_args['group'] = $instance['id'];

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
    echo '<div class="flickr-badges">';
    echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?'.http_build_query($query_args).'"></script>';
	echo '</div>';
	?>


    <?php
    echo $after_widget;
 }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
	return $new_instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
	$defaults = array(
			'title' 	=> 'Photos on Flickr',
			'source' 	=> 'user',
			'id' 		=> '',
			'count' 	=> '9',
			'display' 	=> 'latest',
			'tag' 		=> ''
		);

	$instance = wp_parse_args( (array) $instance, $defaults );

	$display = array( 'latest' => __( 'Latest', 'gameleon' ), 'random' => __( 'Random', 'gameleon' ) );
	$source = array( 'user' => __( 'User', 'gameleon' ), 'group' => __( 'Group', 'gameleon' ), 'user_set' => __( 'Set', 'gameleon' ), 'all' => __( 'Public', 'gameleon' ) );
	$count = array(1,2,3,4,5,6,7,8,9,10);

/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'source' ); ?>"><?php _e( 'Source:', 'gameleon' ); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>">
<?php foreach ( $source as $option_value => $option_label ) { ?>
<option value="<?php echo $option_value; ?>" <?php selected( $instance['source'], $option_value ); ?>><?php echo $option_label; ?></option>
<?php } ?>
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e( 'Flickr ID (<a target="_blank" href="http://www.idgettr.com">idGettr</a>):', 'gameleon' ); ?></label>
<input type="text" name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo esc_attr( $instance['id'] ); ?>" class="widefat" id="<?php echo $this->get_field_id('id'); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'tag' ); ?>"><?php _e( 'Tags:', 'gameleon' ); ?> <span class="description"><?php _e( 'Separate tag with commas', 'gameleon' ); ?></span></label>
<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tag' ); ?>" name="<?php echo $this->get_field_name( 'tag' ); ?>" value="<?php echo esc_attr( $instance['tag'] ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of images to show:', 'gameleon' ); ?></label>
<select class="smallfat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>">
<?php foreach ( $count as $option_value ) { ?>
<option value="<?php echo $option_value; ?>" <?php selected( $instance['count'], $option_value ); ?>><?php echo $option_value; ?></option>
<?php } ?>
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e( 'Sorting:', 'gameleon' ); ?></label>
<select class="widefat" id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">
<?php foreach ( $display as $option_value => $option_label ) { ?>
<option value="<?php echo $option_value; ?>" <?php selected( $instance['display'], $option_value ); ?>><?php echo $option_label; ?></option>
<?php } ?>
</select>
</p>

<?php
	}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Flickr_Widget widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_flickr_widget_init(){
	register_widget( 'Gameleon_Flickr_Widget' );
}

add_action( 'widgets_init', 'gameleon_flickr_widget_init' );