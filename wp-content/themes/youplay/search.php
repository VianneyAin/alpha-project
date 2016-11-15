<?php
/**
 * The template for displaying search results pages.
 *
 * @package Youplay
 */

$side = strpos(yp_opts('search_page_layout', true), 'side-cont') !== false
					? 'left'
					: (strpos(yp_opts('search_page_layout', true), 'cont-side') !== false
					  ? 'right'
					  : false);
$boxed_cont = yp_opts('search_page_boxed_cont', true);
$banner = strpos(yp_opts('search_page_layout', true), 'banner') !== false;

get_header(); ?>

    <section class="content-wrap <?php echo ($banner?'':'no-banner'); ?>">
        <?php
            // check if layout with banner
            if ($banner) {
                echo do_shortcode('[yp_banner img_src="' . yp_opts('search_page_banner_image', true) . '" img_size="1400x600" banner_size="' . yp_opts('search_page_banner_size', true) . '" top_position="true" img_cover="' . yp_opts('search_page_banner_image_cover', true) . '"]<h2>' . sprintf( esc_html__( 'Search Results for: %s', 'youplay' ), '<span>' . get_search_query() . '</span>' ) . '</h2>[/yp_banner]');
            } else {
                echo '<h1 class="' . ($boxed_cont?'container':'') . ' mb-0">' . sprintf( esc_html__( 'Search Results for: %s', 'youplay' ), '<span>' . get_search_query() . '</span>' ) . '</h1>';
            }
        ?>

        <div class="<?php echo ($boxed_cont?'container':''); ?> youplay-content youplay-news">
            <?php
                // check if left sidebar
                if ($side == 'left') {
                    get_sidebar();
                }
            ?>

            <main <?php echo ($side?'class="col-md-9"':''); ?>>

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php
							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );
                        ?>

                    <?php endwhile; // end of the loop. ?>
                    
                    <?php yp_posts_navigation(); ?>

                <?php else : ?>

                    <?php get_template_part( 'template-parts/content', 'none' ); ?>

                <?php endif; ?>

            </main>

            <?php
                // check if right sidebar
                if ($side == 'right') {
                    get_sidebar();
                }
            ?>
        </div>1

<?php get_footer(); ?>
