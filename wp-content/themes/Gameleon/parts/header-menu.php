 <?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	MAIN MENU OF THE THEME
-----------------------------------------------------------------------------------------------------------*/
?>

<?php
$td_sticky_menu   = gameleon_get_option( 'td_sticky_menu' );

if ( $td_sticky_menu ) {
  $td_sticky = 'td-sticky';
} else {
  $td_sticky = '';
}

?>


<div id="wrapper-menu" class="<?php echo $td_sticky; ?>">
  <div class="td-wrapper-box td-shadow">
  <?php wp_nav_menu( array(
    'container'       => 'div',
    'container_class' => 'main-nav',
    'fallback_cb'     => 'gameleon_fallback_menu',
    'theme_location'  => 'mainmenu'
    )
  );
    ?>
</div>
</div>