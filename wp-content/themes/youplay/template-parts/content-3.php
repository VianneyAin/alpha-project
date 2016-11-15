<?php
/**
 * @package Youplay
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class("news-one item col-lg-3 col-md-6"); ?>>
  <a href="<?php echo esc_url( get_permalink() ); ?>" class="angled-img">
		<div class="img">
			<?php
        if ( has_post_thumbnail() ) {
          echo get_the_post_thumbnail( get_the_ID(), '500x375' );
        } else {
          echo '<img src="' . esc_url(yp_opts('single_post_noimage')) . '" alt="no image">';
        }
      ?>
		</div>
    <div class="bottom-info align-center">
      <?php the_title( '<h3>', '</h3>' ); ?>
			
			<?php if ( 'post' == get_post_type() ) : ?>
				<span class="date">
					<?php youplay_posted_on( false, true, false ); ?>
				</span>
			<?php endif; ?>
    </div>
  </a>
</div>