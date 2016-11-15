<?php global $product; ?>

<div class="row youplay-side-news">
  <div class="col-xs-3 col-md-4">
    <a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" class="angled-img">
      <div class="img">
        <?php echo wp_kses_post($product->get_image()); ?>
      </div>
    </a>
  </div>
  <div class="col-xs-9 col-md-8">
    <h4 class="ellipsis"><a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><?php echo esc_html($product->get_title()); ?></a></h4>
    <?php
      $show_rating = is_numeric( $product->get_average_rating() );
      if($show_rating) {
        woocommerce_template_loop_rating();
      };
    ?>
    <div class="price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
  </div>
</div>