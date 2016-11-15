<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Youplay
 */
?>

<div class="col-md-3">
	<?php
    if( is_active_sidebar('woocommerce_sidebar') && function_exists('is_woocommerce') && is_woocommerce() ) {
      dynamic_sidebar( 'woocommerce_sidebar' );
    } else if( is_active_sidebar('bbpress_sidebar') && function_exists('is_bbpress') && is_bbpress() ) {
      dynamic_sidebar( 'bbpress_sidebar' );
    } else {
      dynamic_sidebar( 'sidebar-1' );
    }
  ?>
</div>
