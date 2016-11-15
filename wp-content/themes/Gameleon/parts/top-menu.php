 <?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	THE TOP MENU OF THE THEME
-----------------------------------------------------------------------------------------------------------*/
?>
<?php
if ( has_nav_menu( 'topmenu' ) ) : ?>
<div class="top-menu-wrap">
<div id="navigation-bar">
		<?php
		wp_nav_menu( array(
			'container'      => false,
			'fallback_cb'    => '',
			'menu_class'     => 'top-menu',
			'theme_location' => 'topmenu'
			)
		);

		?>

</div><?php // end of #navigation-bar ?>
</div><?php // end of top-menu-wrap ?>

<?php endif; // end of  has_nav_menu ?>