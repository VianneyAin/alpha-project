<?php

/*----------------------------------------------------------------------------------------------------------
Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Recent_Comments extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
	parent::__construct(
		'gameleon_recent_comments',
		__( '[GAMELEON] Comments', 'gameleon' ),  // Widget Name
		array( 'description' => __( 'Displays the latest comments.', 'gameleon' ), ) // Widget Args

		);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
	global $comments, $comment;

	$cache = wp_cache_get( 'widget_recent_comments', 'widget' );

	if ( ! is_array( $cache ) )
		$cache = array();

	if ( ! isset( $args['widget_id'] ) )
		$args['widget_id'] = $this->id;

	if ( isset( $cache[ $args['widget_id'] ] ) ) {
		echo $cache[ $args['widget_id'] ];
		return;
	}

	extract( $args, EXTR_SKIP );
	$buffer = '';
	$title  = apply_filters( 'widget_title', $instance['title'] );
	$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
	if ( ! $number ) {
		$number = 3;
	}

	$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) ) );

	$buffer .= $before_widget;
	if ( $title )
		$buffer .= $before_title . $title . $after_title;

	if ( $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
		$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
		_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

		foreach ( (array)$comments as $comment) {

		ob_start(); ?>

		<div class="td-wrap-content-sidebar">
			<div class="td-fly-in" >
				<div class="td-small-module">
					<div class="td-post-details">

						<div class="grid-image recent-comments">
							<a href="<?php echo get_comment_author_url( $comment->comment_ID ) ?>">
								<img src="<?php echo td_core::get_avatar_url( $comment->comment_author_email, '80' ) ?>" alt="80x80">
							</a>
						</div>

						<div class="comments-meta">

							<a href="<?php echo get_comment_author_url() ?>">
								<?php echo $comment->comment_author; ?>
							</a>

							<?php _e( 'on', 'gameleon' ); ?>

							<span class="td-post-date">
								<?php echo date( 'd M', strtotime( $comment->comment_date )); ?>
							</span>

						</div><?php // block-meta ?>

						<h2>
							<a class="latest-comments-title" href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>">
								<?php echo $comment->post_title; ?>
							</a>
						</h2>

						<p>
							<?php echo wp_trim_words( strip_tags( get_comment_text( $comment->comment_ID ) ), 6 ); ?>
						</p>


					</div><?php // td-post-details ?>
				</div><?php // td-small-module ?>
			</div><?php // td-fly-in ?>
		</div><?php // td-wrap-content-sidebar ?>


			<?php
			$buffer .= ob_get_clean();
		}
	}
	$buffer .= $after_widget;

		echo $buffer;
		$cache[$args['widget_id']] = $buffer;
		wp_cache_set('widget_recent_comments', $cache, 'widget');
	}

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance 					= $old_instance;
	$instance['title']          = strip_tags( $new_instance['title'] );
	$instance['number'] 		= absint( $new_instance['number'] );

	$alloptions = wp_cache_get( 'alloptions', 'options' );
	if ( isset( $alloptions['widget_recent_comments'] ) ) {
		delete_option('widget_recent_comments');
	}
	return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
	$defaults = array(
		'title' 	=> 'Recent Comments',
		'number' 	=> '3'
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

<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:', 'gameleon' ); ?></label>
<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $instance['number']; ?>" size="3" />
</p>

<?php
	}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Recent_Comments widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_recent_comments_init(){
	register_widget( 'Gameleon_Recent_Comments' );
}

add_action( 'widgets_init', 'gameleon_recent_comments_init' );