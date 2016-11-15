<?php
// filter posts by category
$newsticker_cat_option = gameleon_get_option( 'td_newsticker_category' );
 if ( $newsticker_cat_option == "ALL CATEGORIES" ) {
 	$newsticker_cat = '';
 } else {
 	$newsticker_cat = $newsticker_cat_option;
 }
// number of news to show
$td_news_number 		= gameleon_get_option( 'td_newsticker_number' );
// show excerpt
$newsticker_excerpt 	= gameleon_get_option( 'td_newsticker_excerpt' );
// show date
$newsticker_date 		= gameleon_get_option( 'td_newsticker_date' );
// block news title
$td_ticker_title 		= gameleon_get_option( 'td_newsticker_title' );
?>
<div class="modern-ticker">
<div class="mt-body">
<div class="mt-label"><?php echo $td_ticker_title; ?></div>
<div class="mt-news">
<ul>

<?php $newsticker_posts = new WP_Query(array( 'category_name' => $newsticker_cat, 'posts_per_page' => $td_news_number )); ?>
<?php while( $newsticker_posts->have_posts()) : $newsticker_posts->the_post();?>

<li class="news-item">

<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
<?php if ( $newsticker_date ) : ?>
	<span class="news-date"><?php the_time('F j, Y'); ?></span>
<?php endif; ?>

	<span class="news-title"><?php the_title(); ?></span>

<?php if ( $newsticker_excerpt ) : ?>
	<span class="news-excerpt"><?php echo td_global_excerpt( 10 ); ?></span>
<?php endif; ?>

</a>

</li>
<?php endwhile; ?>
 <?php wp_reset_query(); ?>
</ul>
</div>
<div class="mt-controls">
<div class="mt-prev"></div>
<div class="mt-next"></div>
</div>
</div>
</div>