<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class=" <?php echo yp_sanitize_class($args['list_class']); ?>">

	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$link = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : "#!";

					?>

					<div class="row youplay-side-news">
					  <div class="col-xs-3 col-md-4">
					    <a href="<?php echo esc_url($link); ?>" class="angled-img">
					      <div class="img">
					        <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
					      </div>
					    </a>
					  </div>
					  <div class="col-xs-9 col-md-8">
					    <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" style="text-decoration: none;" class="pull-right mr-10" title="%s"><i class="fa fa-times"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'youplay' ) ), $cart_item_key ); ?>

					    <h4 class="ellipsis"><a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($product_name); ?>"><?php echo esc_attr($product_name); ?></a></h4>
					    
					    <?php echo WC()->cart->get_item_data( $cart_item ); ?>


							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
					  </div>
					</div>
					<?php
				}
			}
		?>

	<?php else : ?>

		<div class="block-content"><?php _e( 'No products in the cart.', 'youplay' ); ?></div>

	<?php endif; ?>

</div><!-- end product list -->

<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

	<p class="mt-15 mr-15"><strong><?php _e( 'Subtotal', 'youplay' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="btn-group mr-15 ml-15 text-center">
		<a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" class="btn btn-default btn-sm wc-forward"><?php _e( 'View Cart', 'youplay' ); ?></a>
		<a href="<?php echo esc_url(WC()->cart->get_checkout_url()); ?>" class="btn btn-default btn-sm checkout wc-forward"><?php _e( 'Checkout', 'youplay' ); ?></a>
	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
