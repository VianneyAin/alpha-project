<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	BOXED: FULL LOGO - WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/
?>
<?php
$td_logo 		= gameleon_get_option( 'td_custom_logo_wide' );
$td_logo_alt 	= gameleon_get_option( 'td_custom_logo_alt' );
$td_logo_title 	= gameleon_get_option( 'td_custom_logo_title' );

if (!empty( $td_logo_title ) ) :
	$td_logo_title = ' title="' . $td_logo_title . '"';
endif;
?>
<?php
// read the custom logo image if it's set
if( $td_logo && $td_logo != '' ) :
	?>
<div id="logo-full">
	<a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo $td_logo; ?>" width="auto" height="auto" alt="<?php echo $td_logo_alt; ?>" <?php echo $td_logo_title; ?> /></a>
</div><?php // end of #logo / ?>

<?php else : // show the text logo if the logo image isn't set ?>

	<div id="text-logo-full">
		<span class="site-name-full">
			<a href="<?php echo home_url( '/' ); ?>" <?php echo $td_logo_title; ?> rel="home"><?php bloginfo( 'name' ); ?></a>
		</span>
		<span class="site-description"><?php bloginfo( 'description' ); ?></span>
	</div><?php // end of #text-logo / ?>

<?php endif; ?>