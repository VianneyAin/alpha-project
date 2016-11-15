<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	BOXED: LOGO + AD - WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/
?>

<?php
$td_logo 		= gameleon_get_option( 'td_custom_logo' );
$td_logo_alt 	= gameleon_get_option( 'td_custom_logo_alt' );
$td_logo_title 	= gameleon_get_option( 'td_custom_logo_title' );

if (!empty( $td_logo_title ) ) :
	$td_logo_title = ' title="' . $td_logo_title . '"';
endif;
?>
<?php
// read the custom logo image if it's set
if( $td_logo && $td_logo != '' ) : ?>
<div id="logo">
	<a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo $td_logo; ?>" width="250" height="100" alt="<?php echo $td_logo_alt; ?>" <?php echo $td_logo_title; ?> /></a>
</div>
<?php else : // show the text logo if the logo image isn't set ?>
<h1>
	<a href="<?php echo home_url( '/' ); ?>" <?php echo $td_logo_title; ?> rel="home"><?php bloginfo( 'name' ); ?></a>
</h1>
<?php endif; ?>
<?php echo responsive_ad_header(); // show the header ad ?>