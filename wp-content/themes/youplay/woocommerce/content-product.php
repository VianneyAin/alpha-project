<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

$shop_style = yp_opts('shop_style')=='row'?'row':'grid';
?>

<div <?php post_class( $shop_style=='grid'?'item col-lg-4 col-md-6 col-xs-12':'' ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>" class="<?php echo ($shop_style=='grid'?'angled-img':'item angled-bg'); ?>">

		<?php if($shop_style == 'grid') : ?>

			<div class="img img-offset">
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>

				<?php
					// add discount badge
					echo yp_woo_discount_badge( $product );
				?>
			</div>
			<div class="bottom-info">
				<h4><?php the_title(); ?></h4>
				<div class="row">
					<?php
					$ratingIsset = is_numeric( $product->get_average_rating() ) && yp_opts('shop_show_ratings');
					
					if( $ratingIsset ): ?>
						<div class="col-xs-6">
							<?php woocommerce_template_loop_rating(); ?>
						</div>
					<?php endif; ?>

					<div class="col-xs-<?php echo ($ratingIsset?'6':'12'); ?>">
						<div class="price">
							<?php woocommerce_template_loop_price(); ?>
						</div>
					</div>
				</div>
			</div>

		<?php else: ?>

		  <div class="row">
		    <div class="col-lg-2 col-md-3 col-xs-4">
		      <div class="angled-img">
		        <div class="img">
							<?php
								/**
								 * woocommerce_before_shop_loop_item_title hook
								 *
								 * @hooked woocommerce_show_product_loop_sale_flash - 10
								 * @hooked woocommerce_template_loop_product_thumbnail - 10
								 */
								remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
								do_action( 'woocommerce_before_shop_loop_item_title' );
							?>

							<?php
								// add discount badge
								echo yp_woo_discount_badge( $product );
							?>
		        </div>
		      </div>
		    </div>
		    <div class="col-lg-10 col-md-9 col-xs-8">
		      <div class="row">
		        <div class="col-xs-6 col-md-9">
		          <h4><?php the_title(); ?></h4>

		          <?php
							$ratingIsset = is_numeric( $product->get_average_rating() ) && yp_opts('shop_show_ratings');
							
							if( $ratingIsset ): ?>
								<?php woocommerce_template_loop_rating(); ?>
							<?php endif; ?>

		        </div>
		        <div class="col-xs-6 col-md-3 align-right">
		          <div class="price">
								<?php woocommerce_template_loop_price(); ?>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>

		<?php endif; ?>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
	</a>

	<?php

		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		if (!yp_opts('shop_show_add_to_cart') || $shop_style == 'row') {
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		}
		do_action( 'woocommerce_after_shop_loop_item' );

	?>

</div>
