<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	Add a Featured Image Show/Hide Meta Box on the post editor screen
-----------------------------------------------------------------------------------------------------------*/

// Fire our meta box setup function on the post editor screen
add_action( 'load-post.php', 'gameleon_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'gameleon_post_meta_boxes_setup' );

/*----------------------------------------------------
	Meta box setup function
-----------------------------------------------------*/

if ( ! function_exists( 'gameleon_post_meta_boxes_setup' ) ) {

	function gameleon_post_meta_boxes_setup() {

	// Add meta boxes on the 'add_meta_boxes' hook
		add_action( 'add_meta_boxes', 'gameleon_add_post_meta_boxes' );

	// Save post meta on the 'save_post' hook
		add_action( 'save_post', 'gameleon_save_featured_image_meta', 10, 2 );

	}

}


/*----------------------------------------------------
	Create the meta box for post editor screen
-----------------------------------------------------*/

if ( ! function_exists( 'gameleon_add_post_meta_boxes' ) ) {

	function gameleon_add_post_meta_boxes() {

	$context  = apply_filters( 'gameleon_featured_image_meta_box_context', 'side' ); 	// 'normal', 'side', 'advanced'
	$priority = apply_filters( 'gameleon_featured_image_meta_box_priority', 'default' ); // 'high', 'core', 'low', 'default'

		add_meta_box(
		'gameleon-featured-image',								// Unique ID
		esc_html__( 'Featured Image - Show/Hide', 'gameleon' ),	// Title
		'gameleon_featured_image_meta_box',						// Callback function
		'post',													// Admin page (or post type)
		$context,												// Context
		$priority												// Priority
		);

	}

}


/*----------------------------------------------------
	The featured image post meta box
-----------------------------------------------------*/

if ( !function_exists( 'gameleon_featured_image_meta_box' ) ) {

	function gameleon_featured_image_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'gameleon_featured_image_nonce' ); $selected = esc_html__( get_post_meta( $object->ID, 'gameleon_featured_image', true ) ); ?>
	<p>
		<select class="widefat" name="gameleon-featured-image" id="gameleon-featured-image">
			<option value="show" <?php selected( $selected, 'show' ); ?>>Show</option>
			<option value="hide" <?php selected( $selected, 'hide' ); ?>>Hide</option>
		</select>
		<label for="gameleon-featured-image">
			<div class="howto"><?php _e( "This option may be overridden by theme options. Please note that even if you have chosen to hide the featured image for this post, you still have to set a featured image below to be used in other areas of the site.", 'gameleon' ); ?>
			</div></label>
	</p>

	<?php }

}


/*----------------------------------------------------
	Save the meta box's post metadata
-----------------------------------------------------*/

if ( !function_exists( 'gameleon_save_featured_image_meta' ) ) {

	function gameleon_save_featured_image_meta( $post_id, $post ) {

		// Verify the nonce before proceeding
		if ( !isset( $_POST['gameleon_featured_image_nonce'] ) || !wp_verify_nonce( $_POST['gameleon_featured_image_nonce'], basename( __FILE__ ) ) ) {
			return $post_id;
		}

		// Get the post type object
		$post_type = get_post_type_object( $post->post_type );

		// Check if the current user has permission to edit the post
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}

		// Get the posted data and sanitize it for use as an HTML class
		$new_meta_value = ( isset( $_POST['gameleon-featured-image'] ) ? balanceTags( $_POST['gameleon-featured-image'] ) : '' );

		// Get the meta key
		$meta_key = 'gameleon_featured_image';

		// Get the meta value of the custom field key
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		// If a new meta value was added and there was no previous value, add it
		if ( $new_meta_value && '' == $meta_value ) {
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}

		// If the new meta value does not match the old value, update it
		elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}

		// If there is no new meta value but an old value exists, delete it
		elseif ( '' == $new_meta_value && $meta_value ) {
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}

	}

}