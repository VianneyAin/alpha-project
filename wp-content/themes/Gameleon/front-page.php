<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	HOME PAGE TEMPLATE
	If front page is set to "Blog", include index.php to display standard blog "latest posts" view.
	Otherwise, display static front page content that can be built on the Widgets area.
-----------------------------------------------------------------------------------------------------------*/
?>

<?php if( gameleon_get_option( 'td_homepage_style' ) == 0 )  {
	locate_template( 'index.php', true );
} else {
	get_header();
	get_sidebar( 'home' );
	get_sidebar();
	get_footer();
}

?>
