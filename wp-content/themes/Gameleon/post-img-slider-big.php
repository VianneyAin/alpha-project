<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	POST IMAGE BIG SLIDER TEMPLATE-PART FILE
-----------------------------------------------------------------------------------------------------------*/
?>
<?php
	$category = get_the_category();
	$category_id =  $category[0]->cat_ID;
	$cat_data = get_option( "category_$category_id" );
	$td_category_color = $cat_data['catBG'];
?>

<div class="td-main-slide-shadow">
<span class="main-cat"><?php the_category(' '); ?></span>
<?php if( has_post_thumbnail() || is_myarcade_game() ): ?>
<?php $image = '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'modular-slider' ) . '</a>'; ?>
<?php if ( empty( $image[0]) ) $image[0] = myarcade_featured_image (); ?>
<?php echo $image; ?>
<?php else: // show image placeholder?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
<img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/610x349.png" width="610" height="349" alt="<?php the_title(); ?>" />
</a>
<?php endif; // end of get_the_post_thumbnail ?>
</div><?php // end of td-main-slide-shadow ?>