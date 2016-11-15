<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<p><?php _e( 'Search for:', 'youplay' ); ?></p>
	<div class="youplay-input">
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'youplay' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'youplay' ); ?>" /> 
  </div>
	<input type="hidden" name="post_type" value="product" />
</form>
