<?php

// If this file is called directly, busted!

if( !defined( 'ABSPATH' ) ) {

  exit;

}


/*----------------------------------------------------------------------------------------------------------

  HEADER TEMPLATE

-----------------------------------------------------------------------------------------------------------*/

?>

<!doctype html>

<!--[if !IE]>

<html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->

<!--[if IE 7 ]>

<html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->

<!--[if IE 8 ]>

<html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->

<!--[if IE 9 ]>

<html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->

<!--[if gt IE 9]><!-->

<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>"/>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php wp_title(' - ', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11"/>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

<script type="text/javascript" src="//wow.zamimg.com/widgets/power.js"></script><script>var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>

<link rel='stylesheet' id='custom-css'  href='http://localhost/alpha-project/wp-content/themes/Gameleon/css/custom.css' type='text/css' media='all' />

<?php



// facebook fix for wrong thumbnail image when using facebook share button

if ( is_single() ) {

	global $post;

	if ( has_post_thumbnail( $post->ID ) ) {

		$gameleon_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

		if ( !empty( $gameleon_image[0] ) ) {

			echo '<meta property="og:image" content="' .  $gameleon_image[0] . '" />';

		}

	}

}



wp_head(); ?>


</head>


<body <?php body_class(); ?>>

<div id="container">

<?php

locate_template('parts/top-menu.php', true ); // yep, load the top menu

?>



<div id="header">

<?php

if ( gameleon_get_option( 'td_overall_display' ) == 1 or is_front_page() ) : ?>

<?php

global $smof_data;

$td_header_manager = $smof_data['td_header_blocks']['enabled'];



if ( $td_header_manager ) {



	foreach ( $td_header_manager as $key=>$value ) {



		switch( $key ) {



				case 'block_logo_ad': // logo + ad

				echo '<div class="header-inner">';

				locate_template('parts/header-boxed-logo-ad.php', true );

				echo '</div>';

				break;



				case 'block_fullwidth_logo': // full logo

				locate_template( 'parts/header-boxed-full-logo.php', true );

				break;



				case 'block_ad_banner': // ad only

				echo '<div class="header-inner-ad-only">';

				locate_template( 'parts/header-boxed-ad-only.php', true );

				echo '</div>';

				break;



				case 'block_main_menu': // main menu

				locate_template('parts/header-menu.php', true );

				break;



				case 'block_full_header_slider': // full slider

				locate_template( 'parts/header-boxed-slider.php', true );

				break;



				case 'block_modular_slider': // modular slider

				locate_template( 'parts/modular-slider.php', true );

				break;



				case 'block_news_ticker': // main menu

				locate_template('parts/news-ticker.php', true );

				break;



			}

		}



	}

?>





<?php

elseif ( gameleon_get_option( 'td_logo_overall_display' ) == 1 or is_front_page() ) : ?>

<div class="header-inner">

<?php

locate_template('parts/header-boxed-full-logo.php', true );

?>

</div>

<?php

locate_template('parts/header-menu.php', true );

?>





<?php else: ?>

<div class="header-inner">

<?php

locate_template('parts/header-boxed-logo-ad.php', true );

?>

</div>

<?php

locate_template('parts/header-menu.php', true );

?>

<?php endif; ?>

</div><?php // end of #header ?>


<div id="wrapper-content"><?php // end of #wrapper-content ?>


<?php gameleon_header_bottom(); // after header content hook ?>


<!-- ANALYTICS SCRIPT -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-77766023-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- END OF ANALYTICS SCRIPT -->

<div class="clearfix"></div>
