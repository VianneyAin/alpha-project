<div id="widgets" class="grid col-340 fit">



<?php if( !dynamic_sidebar( 'main-sidebar' ) ) : ?>



<div class="widget-wrapper">



<div class="widget-title">

<h3>

<?php _e( 'Your First Sidebar Widget', 'gameleon' ); ?>

</h3>

</div>



<div class="textwidget">

	<?php _e( 'This dummy widget will automatically disappear after you will add some widgets to the <em>Main Sidebar</em>.', 'gameleon' ); ?>

</div>



</div>



<?php endif;?>

</div>

