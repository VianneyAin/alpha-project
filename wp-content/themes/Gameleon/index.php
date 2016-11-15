<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------------------------------------------
    BLOG VIEW - standard blog "latest posts" view
-----------------------------------------------------------------------------------------------------------*/

get_header(); ?>
<?php
$td_trimmed_title_blog = 20; // gameleon_get_option( 'td_blog_title_trim' );
?>

<div id="main-wrapper" class="td-blog-layout-home grid col-700">

<!--<div class="td-content-inner">

<div class="td-wrap-content">

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="post-entry">
<div class="td-fly-in">

<h3 class="entry-title">
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
<?php echo wp_trim_words( get_the_title(), $td_trimmed_title_blog ); ?>
</a>
</h3>

<?php get_template_part( 'post-single-meta' ); ?>

<?php get_template_part( 'post-img-blog-index' ); // post image ?>

<div class="td-post-excerpt">
<?php the_excerpt(); ?>
</div>


</div><?php // end of td-fly-in ?>
</div><?php // end of post-entry ?>
</div><?php // end of #post id ?>

<?php endwhile; endif; ?>

</div><?php // end of td-wrap-content / ?>
</div><?php // end of td-content-inner / ?>-->

<?php
// ----------- pagination
// ---------------------------------------------------------------------------
?>

<?php //get_template_part( 'loop-nav' ); ?>

</div><?php // end of main-wrapper ?>
<!--<div class="colophon-module" style="margin-bottom:40px">
    <div class="grid col-700">
        <h3>Notre serveur rust est en ligne</h3>
    </div>
    <div class="grid col-340 fit">
        <div class="call-to-action">
            <a href="http://alpha-project.fr/rust" class="button">Rejoignez-nous!</a>
        </div>
    </div>
</div>-->

<?php get_sidebar('home'); ?>
<?php get_sidebar(); ?>

<?php get_footer(); ?>