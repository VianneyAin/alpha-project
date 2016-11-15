<?php
/**
 * The template for displaying all single posts.
 *
 * @package Youplay
 */

$side = strpos(yp_opts('single_post_layout', true), 'side-cont') !== false
					? 'left'
					: (strpos(yp_opts('single_post_layout', true), 'cont-side') !== false
					  ? 'right'
					  : false);
$boxed_cont = yp_opts('single_post_boxed_cont', true);
$banner = strpos(yp_opts('single_post_layout', true), 'banner') !== false;
$banner_cont = yp_opts('single_post_banner_cont', true);
$rev_slider = yp_opts('single_post_revslider', true) && function_exists('putRevSlider');
$rev_slider_alias = yp_opts('single_post_revslider_alias', true);

get_header();

if($rev_slider) {
	putRevSlider($rev_slider_alias);
	$banner = true;
}

?>

  	<section class="content-wrap <?php echo ($banner?'':'no-banner'); ?>">
		<?php
			// check if layout with banner
			if ($banner && !$rev_slider) {
				echo do_shortcode('[yp_banner img_src="' . yp_opts('single_post_banner_image', true) . '" img_size="1400x600" banner_size="' . yp_opts('single_post_banner_size', true) . '" top_position="true" img_cover="' . yp_opts('single_post_banner_image_cover', true) . '"]' . ($banner_cont?wp_kses_post($banner_cont):'<h2>' . get_the_title() . '</h2>') . '[/yp_banner]');
			} else if(!$rev_slider) {
				the_title('<h1 class="' . ($boxed_cont?'container':'') . '">', '</h1>');
			}
		?>

		<div class="<?php echo ($boxed_cont?'container':''); ?> youplay-news youplay-post">
			<?php
				// check if left sidebar
				if ($side == 'left') {
					get_sidebar();
				}
			?>

			<main <?php echo ($side?'class="col-md-9"':''); ?>>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'single' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( yp_opts('single_post_comments', true) && (comments_open() || get_comments_number()) ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main>

			<?php
				// check if right sidebar
				if ($side == 'right') {
					get_sidebar();
				}
			?>
		</div>

<?php get_footer(); ?>
