<?php
/*
Template Name: Most Popular Template
*/
?>
<?php get_header(); ?>

<div id="main-wrapper" class="grid col-700">

<div class="td-content-inner">

<div class="widget-title">
<h1>
<?php if ( defined( 'MYARCADE_VERSION' ) ): ?>
<?php _e( 'Popular Games', 'gameleon' ); ?>
<?php else: ?>
<?php _e( 'Popular Articles', 'gameleon' ); ?>
<?php endif; ?>
</h1>
</div>


<?php

global $wp_query, $paged;
if( get_query_var( 'paged' ) ) {
$paged = get_query_var( 'paged' );
} elseif( get_query_var( 'page' ) ) {
$paged = get_query_var( 'page' );
} else {
$paged = 1;
}

// exclude posts option
$exclude_from_all_popular_posts = gameleon_get_option( 'td_most_popular_exclude' );
$exclude_from_all_popular_posts = explode(',',$exclude_from_all_popular_posts); //break the string into array keys

$popular_posts = new WP_Query( array(  'category__not_in' => $exclude_from_all_popular_posts, 'orderby' => 'comment_count', 'paged' => $paged ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $popular_posts;

$td_show_meta = gameleon_get_option( 'td_meta_custop_pages' );

// display posts in blog style
$display_blog_layout = gameleon_get_option( 'td_blog_layout_custop_pages' );
if ( $display_blog_layout == 1 ) {
$td_blog_layout_view = 'td-blog-view';
} else {
$td_blog_layout_view = '';
}

?>

<div class="td-wrap-content <?php echo $td_blog_layout_view; ?>"><?php // td-wrap-content ?>

<?php responsive_ad_custom_pages_top(); // show the top custom page ad ?>

<?php if( $popular_posts->have_posts() ) : while( $popular_posts->have_posts() ) : $popular_posts->the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="second-wrap-content"><?php // second-wrap-content ?>

<div class="td-fly-in">

<?php if ( $display_blog_layout == 1 ) : ?>
<?php get_template_part( 'post-img-blog' ); // post image ?>
<?php else : ?>
<?php get_template_part( 'post-img' ); 		// post image ?>
<?php endif; ?>

<?php get_template_part( 'post-details' ); 	// post title and excerpt ?>

<?php if ( $td_show_meta == 1 ) : ?>
<?php get_template_part( 'post-meta' ); 	// date, views, likes and comments ?>
<?php endif; ?>

</div><?php // end of td-fly-in ?>
</div><?php // end of second-wrap-content ?>
</div><?php // end of #post id ?>

<?php endwhile; endif; ?>

<div class="clearfix"></div>
<?php responsive_ad_custom_pages_bottom(); // show the top custom page ad ?>
</div><?php // end of td-wrap-content / ?>
</div><?php // end of td-content-inner / ?>

<?php
// ----------- pagination
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'loop-nav' ); ?>

</div><?php // end of main-wrapper ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>