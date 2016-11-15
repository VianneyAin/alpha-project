<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------------------------------------------
    SEARCH TEMPLATE- WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/

get_header(); ?>

<div id="content" class="td-blog-layout grid col-700">
<div class="td-content-inner">

<div class="widget-title">
<h1><?php _e('Search results for', 'gameleon'); ?> "<?php echo get_search_query(); ?>"</h1>
</div>

<div class="td-wrap-content">

<?php if ( have_posts() ) : ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="post-entry">
<div class="td-fly-in">

<?php get_template_part( 'post-img-blog' ); // post image ?>

<?php get_template_part( 'post-details' ); // post title and excerpt ?>

<?php get_template_part( 'post-meta' ); // date, views, likes and comments ?>

</div><?php // end of td-fly-in ?>
</div><?php // end of post-entry ?>
</div><?php // end of #post id ?>

<?php endwhile; endif; else : ?>

<p><?php _e( 'Sorry, but nothing matched your search criteria.', 'gameleon' ); ?></p>

<?php endif; ?>

</div><?php // end of td-wrap-content / ?>
</div><?php // end of td-content-inner / ?>

<?php get_template_part( 'loop-nav' ); // pagination ?>

</div><?php // end of #content / ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>