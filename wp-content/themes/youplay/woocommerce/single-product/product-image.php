<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

$banner = strpos(yp_opts('single_product_layout', true), 'banner') !== false;
$rev_slider = yp_opts('single_product_revslider', true) && function_exists(putRevSlider);

// Banner with title
if ( $banner && has_post_thumbnail() && !$rev_slider ) {
	$img_src = get_post_thumbnail_id( $post->ID, 'full' );
  $img_cover = yp_opts('single_product_banner_image_cover', true);
  $banner_size  = yp_opts('single_product_banner_size', true);
  $top_position = true;

  $img_src = wp_get_attachment_image_src( $img_src, 'full' );
  $img_src = $img_src[0];

  ?>
  <div class="<?php echo yp_sanitize_class('youplay-banner banner-top youplay-banner-store-main ' . $banner_size); ?>">
    <div class='image <?php echo (yp_check($img_cover)?'cover-bg':''); ?>'
      style='background-image: url(<?php echo esc_attr($img_src); ?>);'
      data-top='background-position: 50% 0px;'
      data-top-bottom='background-position: 50% -200px;'>
    </div>

    <div class='info'
          data-top='opacity: 1; transform: translate3d(0px,0px,0px);'
          data-top-bottom='opacity: 0; transform: translate3d(0px,150px,0px);'
          data-anchor-target='.youplay-banner-store-main'>
      <div>
        <div class='container'>
          <?php the_title('<h2>', '</h2>'); ?>
          <?php woocommerce_template_single_add_to_cart(); ?>
        </div>
      </div>
    </div>
  </div>

<?php } else if(!$rev_slider) {
  the_title('<h1 class="container">', '</h1>');
  ?>

  <div class="container"><?php woocommerce_template_single_add_to_cart(); ?></div>

  <?php
} else {
  ?>
  <div class="container"><?php woocommerce_template_single_add_to_cart(); ?></div>
  <?php
}

do_action( 'woocommerce_product_thumbnails' );
?>