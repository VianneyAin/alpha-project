<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Youplay
 */

if ( ! function_exists( 'yp_sanitize_class' ) ) :
function yp_sanitize_class($classes) {
    if (!is_array($classes)) {
        $classes = explode(' ', $classes);
    }

    foreach($classes as $k => $v){
        $classes[$k] = sanitize_html_class($v);
    }

    return join(' ', $classes);

    return $classes;
}
endif;


if ( ! function_exists( 'yp_comment_text' ) ) :
function yp_comment_text($text = null) {
		if($text == null) {
			$text = get_comment_text();
		}
    return wp_kses_post( $text );
}
endif;


if ( ! function_exists( 'yp_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function yp_posts_navigation() {
	$queryName = isset($GLOBALS['yp_query']) ? 'yp_query' : 'wp_query';

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS[$queryName]->max_num_pages < 1 ) {
		return;
	}

	$page_links = paginate_links( apply_filters( 'yp_pagination_args', array(
		'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
		'format'       => '',
		'add_args'     => '',
		'current'      => max( 1, get_query_var( 'paged' ) ),
		'total'        => $GLOBALS[$queryName]->max_num_pages,
		'prev_text'    => '&larr;',
		'next_text'    => '&rarr;',
		'type'         => 'array',
		'end_size'     => 3,
		'mid_size'     => 3
	) ) );

	if(!is_array($page_links)) {
		return;
	}

	?>
	<ul class='pagination dib'>
		<li class="sr-only"><h2><?php esc_html_e( 'Posts navigation', 'youplay' ); ?></h2></li>

		<?php foreach($page_links as $cur) : ?>
			<li <?php echo (strpos($cur, 'current') !== false ? 'class="active"' : ''); ?>>
				<?php echo wp_kses_post($cur); ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'youplay' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'youplay_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function youplay_posted_on( $get = false, $showDate = true, $showByline = true ) {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = '<span class="posted-on">' . sprintf(esc_html_x( '%s %s', 'post date', 'youplay' ), '<i class="fa fa-calendar"></i>', $time_string) . '</span>';

	$byline = '<span class="byline"> ' .
			sprintf(esc_html_x( 'by %s', 'post author', 'youplay' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>') . 
			'</span>';

	if($get) {
		return ($showDate?$posted_on:'') . ($showByline?$byline:'');
	} else {
		echo ($showDate?$posted_on:'') . ($showByline?$byline:'');
	}
}
endif;


if ( ! function_exists( 'youplay_post_thumbnail' ) ) :
/**
 * Prints HTML with image and post url
 */
function youplay_post_thumbnail( $get = false, $additional_info = '' ) {
	$template = 
		'<a href="%s" class="angled-img">
			<div class="img">
				%s
			</div>
			' . $additional_info . '
		</a>';

	if ( has_post_thumbnail() ) {
		$thumbnail = get_the_post_thumbnail( get_the_ID(), '500x375' );
	} else {
		$thumbnail = '<img src="' . esc_url(yp_opts('single_post_noimage')) . '" alt="no image">';
	}

	if($get) {
		return sprintf( $template, esc_url( get_permalink() ), $thumbnail );
	} else {
		printf( $template, esc_url( get_permalink() ), $thumbnail );
	}
}
endif;


if ( ! function_exists( 'youplay_post_tags' ) ) :
/**
 * Prints HTML with post tags
 */
function youplay_post_tags() {
	$posttags = get_the_tags();
	$tags_string = '';
	if ($posttags && yp_opts('single_post_tags')) {
		$comma = '';
	  foreach($posttags as $tag) {
	    $tags_string .= $comma . $tag->name;
	    $comma = ', ';
	  }

		$tags_string = sprintf(
			esc_html__('%s %s'),
			'<i class="fa fa-tags"></i>',
			$tags_string
		); // WPCS: XSS OK

		echo '<div class="tags">' . $tags_string . '</div>';
	}
}
endif;


if ( ! function_exists( 'youplay_post_meta' ) ) :
/**
 * Prints HTML with post meta
 */
function youplay_post_meta() {
	if(
		!yp_opts('single_post_author') &&
		!yp_opts('single_post_publish_date') &&
		!yp_opts('single_post_categories') &&
		!yp_opts('single_post_views')
		)
		return;

	// Author
	$author = sprintf(
		esc_html_x( '%s Author %s', 'post author', 'youplay' ),
		'<i class="fa fa-user meta-icon"></i>',
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	// Published
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s Published %s', 'post date', 'youplay' ),
		'<i class="fa fa-calendar"></i>',
		$time_string
	);

	// Categories
	$categories = get_the_category();
	if($categories){
		$separator = ' ';
		$output = '';
		foreach($categories as $category) {
			$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", "youplay" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
		}
		$categories = sprintf(
			esc_html_x( '%s Categories %s', 'post categories', 'youplay' ),
			'<i class="fa fa-bookmark meta-icon"></i>',
			trim($output, $separator)
		);
	}

	// Views
  $pageview_key = 'views';
  $postID = get_the_ID();
  $pageview = get_post_meta($postID, $pageview_key, true);
  if($pageview==''){
      $pageview = 0;
      delete_post_meta($postID, $pageview_key);
      add_post_meta($postID, $pageview_key, '0');
  } else {
      $pageview++;
      update_post_meta($postID, $pageview_key, $pageview);
  }
	$pageview = sprintf(
		esc_html_x( '%s Views %s', 'post views', 'youplay' ),
		'<i class="fa fa-eye meta-icon"></i>',
		$pageview
	);

	echo '<div class="meta">';

		if(yp_opts('single_post_author')) {
			echo '<div class="item">' . $author . '</div>';
		}
		if(yp_opts('single_post_publish_date')) {
			echo '<div class="item">' . $posted_on . '</div>';
		}
		if(yp_opts('single_post_categories')) {
			echo '<div class="item">' . $categories . '</div>';
		}
		if(yp_opts('single_post_views')) {
			echo '<div class="item">' . $pageview . '</div>';
		}

	echo '</div>';
}
endif;


/**
 * Prints HTML with post tags
 */
function youplay_post_sharing() {
	youplay_sharing('single_post');
}
function youplay_product_sharing() {
	youplay_sharing('single_product');
}

function youplay_sharing($type) {
	$fb = yp_opts($type . '_sharing_fb');
	$tw = yp_opts($type . '_sharing_tw');
	$gp = yp_opts($type . '_sharing_gp');
	$pin = yp_opts($type . '_sharing_pin');
	$vk = yp_opts($type . '_sharing_vk');

	if(!$fb && !$tw && !$gp && !$pin && !$vk)
		return;
	
	echo '<div class="btn-group social-list social-likes" data-counters="no">';
		if($fb) {
			echo '<span class="btn btn-default facebook" title="' . __('Share link on Facebook', 'youplay') . '"></span>';
		}
		if($tw) {
			echo '<span class="btn btn-default twitter" title="' . __('Share link on Twitter', 'youplay') . '"></span>';
		}
		if($gp) {
			echo '<span class="btn btn-default plusone" title="' . __('Share link on Google+', 'youplay') . '"></span>';
		}
		if($pin) {
			echo '<span class="btn btn-default pinterest" title="' . __('Share image on Pinterest', 'youplay') . '" data-media=""></span>';
		}
		if($vk) {
			echo '<span class="btn btn-default vkontakte" title="' . __('Share link on Vkontakte', 'youplay') . '"></span>';
		}
	echo '</div>';
}



if ( ! function_exists( 'youplay_read_more' ) ) :
/**
 * Prints HTML with post tags
 */
function youplay_read_more() {
	printf(
		'<a href="%s" class="btn read-more pull-left">%s</a>',
		esc_url( get_permalink() ),
		esc_html__( 'Read More', 'youtube' )
	); // WPCS: XSS OK
}
endif;


if ( ! function_exists( 'youplay_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function youplay_entry_footer() {
	edit_post_link( esc_html__( 'Edit', 'youplay' ), '<div class="edit-link pull-right">', '</div><div class="clearfix"></div>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'youplay' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'youplay' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'youplay' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'youplay' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'youplay' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'youplay' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'youplay' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'youplay' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'youplay' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'youplay' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'youplay' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'youplay' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'youplay' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'youplay' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'youplay' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'youplay' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'youplay' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'youplay' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'youplay' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'youplay' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'youplay' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo wp_kses_post($before) . $title . wp_kses_post($after);  // WPCS: XSS OK
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo wp_kses_post($before . $description . $after);  // WPCS: XSS OK
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function youplay_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'youplay_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'youplay_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so youplay_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so youplay_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in youplay_categorized_blog.
 */
function youplay_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'youplay_categories' );
}
add_action( 'edit_category', 'youplay_category_transient_flusher' );
add_action( 'save_post',     'youplay_category_transient_flusher' );



//change comment form
if(!function_exists('youplay_comment_form')){
function youplay_comment_form( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<div class="comment-form-author youplay-input">' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="' . __( 'Name','youplay' ) . ( $req ? ' *' : '' ) . '" /></div>',
		'email'  => '<div class="comment-form-email youplay-input">' .
		            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="' . __( 'Email','youplay'  ) . ( $req ? ' *' : '' ) . '" /></div>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s','youplay' ), '<span class="required">*</span>' );

	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'youplay' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'youplay' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','youplay'), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.','youplay' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Reply','youplay' ),
		'title_reply_to'       => __( 'Leave a Reply to %s','youplay'  ),
		'cancel_reply_link'    => __( 'Cancel reply','youplay'  ),
		'label_submit'         => __( 'Submit' ,'youplay'),
		'format'               => 'xhtml',
		'type'                 => 'comment'
	);

	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
	<?php if ( comments_open( $post_id ) ) : ?>
		<?php
		/**
		 * Fires before the comment form.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_before' );
		?>

		<div id="respond" class="<?php echo yp_sanitize_class($args['type'] . '-respond'); ?>">
        
			<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
				<h4 id="reply-title" class="mt-0"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h4>
				<?php echo wp_kses_post($args['must_log_in']); ?>
				<?php
				/**
				 * Fires after the HTML-formatted 'must log in after' message in the comment form.
				 *
				 * @since 3.0.0
				 */
				do_action( 'comment_form_must_log_in_after' );
				?>
			<?php else : ?>
				<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="<?php echo yp_sanitize_class($args['type'] . '-form'); ?>"<?php if($html5){?>  novalidate <?php } ?>>
              
				<div class="<?php echo yp_sanitize_class($args['type'] . '-avatar pull-left'); ?>">
					<?php $user_ID = get_current_user_id();
						echo get_avatar( $user_ID, 90 );
					?>
				</div>

				<div class="<?php echo yp_sanitize_class($args['type'] . '-cont clearfix'); ?>">
					<h4 id="reply-title" class="mt-0"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h4>

					<?php
					/**
					 * Fires at the top of the comment form, inside the <form> tag.
					 *
					 * @since 3.0.0
					 */
					do_action( 'comment_form_top' );
					?>
					<?php if ( is_user_logged_in() ) : ?>
						<?php
						/**
						 * Filter the 'logged in' message for the comment form for display.
						 *
						 * @since 3.0.0
						 *
						 * @param string $args['logged_in_as'] The logged-in-as HTML-formatted message.
						 * @param array  $commenter            An array containing the comment author's username, email, and URL.
						 * @param string $user_identity        If the commenter is a registered user, the display name, blank otherwise.
						 */
						echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
						?>
						<?php
						/**
						 * Fires after the is_user_logged_in() check in the comment form.
						 *
						 * @since 3.0.0
						 *
						 * @param array  $commenter     An array containing the comment author's username, email, and URL.
						 * @param string $user_identity If the commenter is a registered user, the display name, blank otherwise.
						 */
						do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
						?>
					<?php else : ?>
						<?php echo wp_kses_post($args['comment_notes_before']); ?>
						<?php
						/**
						 * Fires before the comment fields in the comment form.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_before_fields' );
						/**
						 * Fires after the comment fields in the comment form.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_after_fields' );
						?>
					<?php endif; ?>
					<?php
					/**
					 * Filter the content of the comment textarea field for display.
					 *
					 * @since 3.0.0
					 *
					 * @param string $args['comment_field'] The content of the comment textarea field.
					 */
					?>
					<?php echo wp_kses_post($args['comment_notes_after']); 
					if (!is_user_logged_in() ) :
					foreach ( (array) $args['fields'] as $name => $field ) {
						/**
						 * Filter a comment form field for display.
						 *
						 * The dynamic portion of the filter hook, $name, refers to the name
						 * of the comment form field. Such as 'author', 'email', or 'url'.
						 *
						 * @since 3.0.0
						 *
						 * @param string $field The HTML-formatted output of the comment form field.
						 */
						echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
					}
					endif;

					echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
					
					
					?>

					<p class="form-submit">
						<button name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" class="<?php echo esc_attr( $args['class_submit'] ); ?>"><?php echo esc_attr( $args['label_submit'] ); ?></button>
						<?php comment_id_fields( $post_id ); ?>
					</p>
					<?php
					/**
					 * Fires at the bottom of the comment form, inside the closing </form> tag.
					 *
					 * @since 1.5.2
					 *
					 * @param int $post_id The post ID.
					 */
					do_action( 'comment_form', $post_id );
					?>
				</div>
				</form>
			<?php endif; ?>
		</div><!-- #respond -->
		<?php
		/**
		 * Fires after the comment form.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_after' );
	else :
		/**
		 * Fires after the comment form if comments are closed.
		 *
		 * @since 3.0.0
		 */
		do_action( 'comment_form_comments_closed' );
	endif;
}
}