<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Youplay
 */

$side = strpos(yp_opts('press_layout', true), 'side-cont') !== false
					? 'left'
					: (strpos(yp_opts('press_layout', true), 'cont-side') !== false
					  ? 'right'
					  : false);
$boxed_cont = yp_opts('press_boxed_cont', true);
$banner = strpos(yp_opts('press_layout', true), 'banner') !== false;

get_header();

?>

  <section class="content-wrap <?php echo ($banner?'':'no-banner'); ?>">
		<?php
			// check if layout with banner
			if ($banner) {
				if(bbp_is_single_user()) {
					$banner_cont = '
						<div class="youplay-user">
					    <a href="' . yp_get_avatar_url( get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 1080 ) ) ) . '" class="angled-img image-popup" title="' . get_the_title() . '">
					      <div class="img">
					        ' . get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 150 ) ) . '
					      </div>
					      <i class="fa fa-search-plus icon"></i>
					    </a>
					    <div class="user-data">
					      <h2 class="mt-0">' . get_the_title() . '</h2>
					      <!-- <div class="location"><i class="fa fa-map-marker"></i> Los Angeles</div> -->
					      <div class="activity">
					        <div>
					          <div class="num">' . bbp_get_user_display_role(). '</div>
					          <div class="title">' . __('Role', 'youplay') . '</div>
					        </div>
					        <div>
					          <div class="num">' . bbp_get_user_topic_count_raw() . '</div>
					          <div class="title">' . __('Topics', 'youplay') . '</div>
					        </div>
					        <div>
					          <div class="num">' . bbp_get_user_reply_count_raw() . '</div>
					          <div class="title">' . __('Replies', 'youplay') . '</div>
					        </div>
					      </div>
					    </div>
					  </div>';
				} else {
					$banner_cont = '<h2>' . get_the_title() . '</h2>';
				}
				echo do_shortcode('[yp_banner img_src="' . yp_opts('press_banner_image', true) . '" img_size="1400x600" banner_size="' . yp_opts('press_banner_size', true) . '" top_position="true" img_cover="' . yp_opts('press_banner_image_cover', true) . '"]' . $banner_cont . '[/yp_banner]');
			} else {
				the_title('<h1 class="' . ($boxed_cont?'container':'') . '">', '</h1>');
			}
		?>

		<div class="<?php echo ($boxed_cont?'container':''); ?> youplay-content">
			<?php
				// check if left sidebar
				if ($side == 'left') {
					get_sidebar( 'bbpress' );
				}
			?>

			<main <?php echo ($side?'class="col-md-9"':''); ?>>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
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
