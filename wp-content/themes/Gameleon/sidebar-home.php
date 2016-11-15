<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	STATIC HOME PAGE TEMPLATE
-----------------------------------------------------------------------------------------------------------*/

?>

<div id="homepage-wrap" class="grid col-700">
<?php if( !dynamic_sidebar( 'homepage-sidebar' ) ) : ?>

<div id="dummy-widget">

<div class="widget-title">
<h1>
<?php _e( 'Your First Home Page Widget', 'gameleon' ); ?>
</h1>
</div>

<div class="td-wrap-content"><?php // td-wrap-content ?>
<?php _e( 'This dummy widget will automatically disappear after you will add some widgets to the <em>Home Page</em> sidebar.', 'gameleon' ); ?>
</div><?php // end of  td-wrap-content ?>

</div><?php // end of dummy-widget ?>

<?php endif;the_widget('homepage-sidebar');?>
</div><?php // end of homepage-wrap ?>


