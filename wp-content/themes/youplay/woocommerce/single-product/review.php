<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<article id="comment-<?php comment_ID(); ?>">

		<div class="review-avatar pull-left">
			<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '90' ), '' ); ?>
		</div>

		<div class="review-cont clearfix">

			<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>

				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="rating pull-right" title="<?php echo sprintf( __( 'Rated %d out of 5', 'youplay' ), $rating ) ?>">
					<?php
					for($k = 0; $k < 5; $k++) {
						if($rating <= $k) {
							echo '<i class="fa fa-star-o"></i> ';
						} else {
							echo '<i class="fa fa-star"></i> ';
						}
					}
					?>
				</div>

			<?php endif; ?>

			<?php if ( $comment->comment_approved == '0' ) : ?>

				<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'youplay' ); ?></em></p>

			<?php else : ?>
        		<span class="review-author h4"><?php comment_author(); ?></span>
        		 <?php

					if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
						if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
							echo '<em class="verified">(' . __( 'verified owner', 'youplay' ) . ')</em> ';
				?>

        		<div class="date" itemprop="datePublished"><i class="fa fa-calendar"></i> <?php echo get_comment_date( __( get_option( 'date_format' ), 'youplay' ) ); ?></div>

			<?php endif; ?>
			<div class="review-text" itemprop="description">
				<?php echo yp_comment_text(); ?>
			</div>
		</div>
	</article>
