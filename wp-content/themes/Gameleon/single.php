<?php



// If this file is called directly, busted!

if( !defined( 'ABSPATH' ) ) {

    exit;

}

/*----------------------------------------------------------------------------------------------------------

    Single Posts Template - we use PHP comments instead of HTML, to reduce the page size.

-----------------------------------------------------------------------------------------------------------*/

get_header(); ?>



<?php if ( defined( 'MYARCADE_VERSION' ) and is_game() ) : ?>



<?php // game variables

$custom_meta = get_post_custom( $post->ID );

$td_progressbar_enabled 	= gameleon_get_option( 'td_enable_progress_bar' );

$td_arcade_thumbnail_size 	= gameleon_get_option( 'td_arcade_featured_img' );

$td_fullscreen_enabled 		= gameleon_get_option( 'td_fullscreen_enabled' );

$td_lightsoff_enabled 		= gameleon_get_option( 'td_lightsoff_enabled' );

$td_review_tab_enabled 		= gameleon_get_option( 'td_review_tab' );

$td_cutom_tab_enabled 		= gameleon_get_option( 'td_custom_tab' );

$instructions 				= $custom_meta['mabp_instructions'][0];

$thumb_url 					= myarcade_get_thumbnail_url();

?>





<div id="content-arcade" class="grid col-1060">

<div class="td-content-inner-single-arcade">



<div id="full-screen-wrapp">





<div class="widget-title">

<h1><?php myarcade_title(); ?></h1>



<div class="td-game-buttons">

<?php if ( $td_fullscreen_enabled ) : ?>

<div class="td-fullscreen">

	<?php _e( 'Fullscreen', 'gameleon' ); ?>

</div>

<?php endif; ?>



<?php if ( $td_lightsoff_enabled ) : ?>

<div class="td-switch">

	<?php _e( 'Light Switch', 'gameleon' ); ?>

</div>

<?php endif; ?>



</div>



</div>



<div class="td-wrap-content-arcade">



<div class="clearfix"></div>





<?php if ( $td_progressbar_enabled ) : ?>

<?php get_template_part('/includes/progressbar'); ?>



<div class="td_before-game-loading">

<div id="showprogressbar">



<?php echo responsive_interstitial_ad(); // show interstitial ad ?>



<div id="progressbar">

<span id="progresstext">0%</span>

<div id="progressbarloadbg">&thinsp;</div>

</div>





</div><?php // end of #showprogressbar/ ?>

</div><?php // end of .td_before-game-loading / ?>



<div id="progressbarloadtext" onclick="window.hide();">

<?php echo gameleon_get_option( 'td_progressbar_text' ); ?>

</div>



<?php endif; // end of check "$td_progressbar_enabled" ?>



<div class="clearfix"></div>



<div id="td-game-wrap" class="showfitvids">



<?php

if ( function_exists( 'get_game' ) ) { // yep... show the MyArcade  game code

	 /* mypostid global is needed for MyScoresPresenter */

	global $mypostid;

	$mypostid = $post->ID;

	echo myarcade_get_leaderboard_code();

	echo get_game( $post->ID );

}

?>



</div><?php // end of #td-game-wrap / ?>



</div><?php // end of .td-wrap-content-arcade / ?>

</div><?php // end of #full-screen-wrapp / ?>



<div class="td-game-ad-space">

<?php echo responsive_ad_bellow_the_game(); // show the below the game ad ?>

</div><?php // end of .td-game-ad-space / ?>



<?php if( gameleon_get_option( 'td_post_navigation' ) == 1 ) : ?>

<div class="navigation">

<div class="previous"><?php previous_post_link( ' &#xf053;  &nbsp;  %link' ); ?></div>

<div class="next"><?php next_post_link( '%link &nbsp; &#xf054;' ); ?></div>

</div><?php // end of .navigation / ?>

<?php endif ; // end if( gameleon_get_option( 'td_post_navigation' ) ?>



</div><?php // end of .td-content-inner-single-arcade / ?>

</div><?php // end of #content-arcade / ?>





<div id="td-game-tabs" class="grid col-1060">

<div class="td-content-inner-single-arcade">

<div id="gametabs">



<ul class="tab-links">

<li class="active"><a href="#tab1"><?php _e( 'How To Play', 'gameleon' ); ?></a></li>



<?php if ( $td_review_tab_enabled and defined( 'TIE_Plugin' ) ): ?>

<li><a href="#tab2"><?php _e( 'Game Review', 'gameleon' ); ?></a></li>

<?php endif; ?>



<?php if ( $td_cutom_tab_enabled ) : ?>

<li><a href="#tab3"><?php _e( 'Custom Tab', 'gameleon' ); ?></a></li>

<?php endif; ?>



</ul>



<div class="gametab-content">



<div id="tab1" class="tab active">

<?php echo do_shortcode( $instructions ); ?>

</div>



<?php if ( $td_review_tab_enabled and defined( 'TIE_Plugin' ) ) : ?>

<div id="tab2" class="tab">

<?php echo do_shortcode( '[taq_review]' ); ?>

</div>

<?php endif; ?>



<?php if ( $td_cutom_tab_enabled ) : ?>

<div id="tab3" class="tab">

<?php if( gameleon_get_option( 'td_custom_tab_content' ) ) :

$td_custom_tab = gameleon_get_option( 'td_custom_tab_content' );

echo do_shortcode( stripslashes( $td_custom_tab ));

endif; ?>

</div>

<?php endif; ?>



</div><?php // end of .tab-content / ?>

</div><?php // end of #gametabs / ?>

</div><?php // end of .td-content-inner-single-arcade / ?>

</div><?php // end of .col-1060 / ?>





<?php endif; // end of check "MYARCADE_VERSION" ?>







<?php // ---------------------------------- GAME OVER ---------------------------------- / ?>



<div id="content" class="grid col-700">



<div class="td-content-inner-single">

<div class="widget-title">



<?php if ( defined( 'MYARCADE_VERSION' ) and is_game() ) : ?>



<h3><?php _e( 'Game Details', 'gameleon' ); ?></h3>



<?php else: ?>



<?php the_title( '<h1>', '</h1>' ); ?>



<?php endif; // end of check "MYARCADE_VERSION" ?>





</div>





<div class="td-wrap-content">



<?php get_gameleon_breadcrumb_lists(); ?>





<?php if( have_posts() ) : ?>

<?php while( have_posts() ) : the_post(); ?>





<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



<?php

$td_show_post_meta = gameleon_get_option( 'td_post_meta_single' );

if ( $td_show_post_meta ) : ?>

<?php get_template_part( 'post-single-meta' ); ?>

<?php endif; ?>



<div class="post-entry">



<?php if ( defined( 'MYARCADE_VERSION' ) and is_game() ) : ?>

<a href="<?php echo $thumb_url; ?>" title="<?php myarcade_title(); ?>">

<?php myarcade_thumbnail( $td_arcade_thumbnail_size, $td_arcade_thumbnail_size, 'alignleft arcade-width' ); ?>

</a>

<?php else: ?>

<?php gameleon_featured_image(); ?>

<?php endif; ?>



<?php the_content( __( 'Read More...', 'gameleon' ) ); ?>



<?php get_template_part( 'post-data' ); ?>



<?php if( gameleon_get_option( 'td_post_navigation' ) == 1 and defined( 'MYARCADE_VERSION' ) and !is_game() ) : ?>



<div class="navigation">

<div class="previous"><?php previous_post_link( ' &#xf053;  &nbsp;  %link' ); ?></div>

<div class="next"><?php next_post_link( '%link &nbsp; &#xf054;' ); ?></div>

</div><?php // end of .navigation / ?>



<?php endif ; // end if( gameleon_get_option( 'td_post_navigation' ) ?>



<?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'gameleon' ), 'after' => '</div>' ) ); ?>



<div class="clearfix"></div>



</div><?php // end of .post-entry / ?>

</div><?php // end of #post-the_ID(); / ?>



</div><?php // end of td-wrap-content / ?>

</div><?php // end of td-content-inner / ?>







<?php  if( !function_exists( 'wpsabox_author_box' ) and get_the_author_meta( 'description' ) != '' and gameleon_get_option( 'td_post_author_box' ) == 1 ) : ?>



<div class="td-content-inner-single">



<div id="author-meta">

<?php if( function_exists( 'get_avatar' ) ) {

echo get_avatar( get_the_author_meta( 'user_email' ), '100' );

} ?>

<div class="about-author"><?php the_author_posts_link(); ?></div>

<div class="auth-desc vcard author"><span class="fn"><?php the_author_meta( 'description' ) ?></span></div>

<div class="clearfix"></div>

</div><?php // end of #author-meta / ?>



</div><?php // end of td-content-inner-single / ?>



<?php endif; // no description, no author's meta ?>




<?php //SINGLE AUTHOR BOX - COMMENTE PAR VIANNEY ?>
<?php /*if ( function_exists( 'wpsabox_author_box' ) ) :*/?>

<!--<div class="td-content-inner-single-sabox">-->

<?php /*echo wpsabox_author_box();*/ // Our Simple Author Box plugin ?>

<!--</div>--><?php // end of td-content-inner-single-sabox / ?>

<?php /*endif;*/ ?>





<?php echo gameleon_related_posts(); ?>



<?php comments_template( '', true ); ?>



<?php endwhile; endif; ?>



<?php get_template_part( 'loop-nav' ); // pagination ?>





</div><?php // end of #content / ?>





<?php get_sidebar(); ?>

<?php get_footer(); ?>