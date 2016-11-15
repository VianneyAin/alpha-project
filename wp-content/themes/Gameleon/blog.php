<?php
/*
Template Name: Blog Template
*/
?>
<?php get_header(); ?>

<div id="content" class="td-blog-layout-home grid col-700">

    <div class="td-content-inner">

        <?php
        // get "orderby" option
        $post_orderby_filter = gameleon_get_option( 'td_blog_orderby' );
        // get "order" option
        $post_order_filter = gameleon_get_option( 'td_blog_order' );
        // meta_key
        $td_metakey = 'post_views_count';


        global $wp_query, $paged;
        if( get_query_var( 'paged' ) ) {
            $paged = get_query_var( 'paged' );
        } elseif( get_query_var( 'page' ) ) {
            $paged = get_query_var( 'page' );
        } else {
            $paged = 1;
        }

        // exclude posts option
        $exclude_from_all_posts = gameleon_get_option( 'td_blog_exclude' );
        $exclude_from_all_posts = explode(',',$exclude_from_all_posts); //break the string into array keys

        $blog_query = new WP_Query( array( 'category__not_in' => $exclude_from_all_posts, 'orderby' => $post_orderby_filter, 'order' => $post_order_filter, 'meta_key' => $td_metakey, 'paged' => $paged ) );
        $temp_query = $wp_query;
        $wp_query = null;
        $wp_query = $blog_query;

        $td_trimmed_title_blog = 20;

        ?>

        <div class="td-wrap-content">

            <?php if( $blog_query->have_posts() ) : while( $blog_query->have_posts() ) : $blog_query->the_post(); ?>

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
    </div><?php // end of td-content-inner / ?>

    <?php
    // ----------- pagination
    // ---------------------------------------------------------------------------
    ?>

    <?php get_template_part( 'loop-nav' ); ?>

</div><?php // end of main-wrapper ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
