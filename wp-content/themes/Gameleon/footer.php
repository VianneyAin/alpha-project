</div><?php // end of #wrapper-content ?>

<?php

$td_colophone           = gameleon_get_option( 'td_colophon_enable' );

$td_colophone_txt1      = gameleon_get_option( 'td_colophon_txt1' );

$td_colophone_bnt_txt   = gameleon_get_option( 'td_colophon_btn' );

$td_colophone_btn_link  = gameleon_get_option( 'td_colophon_btn_link' );

$td_scroll_buttons      = gameleon_get_option( 'td_scroll_buttons' );

?>



<?php if( $td_colophone and $td_colophone_txt1 ) : ?>



<div class="colophon-module">



<div class="grid col-700">



<h3>

<?php if( $td_colophone_txt1 ) : ?>

<?php echo $td_colophone_txt1; ?>

<?php endif; ?>

</h3>



</div><?php // end of grid col-728 / ?>



<div class="grid col-340 fit">

<div class="call-to-action">

<?php if( $td_colophone_bnt_txt ) : ?>

<a href="<?php echo $td_colophone_btn_link; ?>" class="button"><?php echo $td_colophone_bnt_txt; ?></a>

<?php endif; ?>

</div>

</div><?php // end of grid col-340 fit / ?>



</div><?php // end of colophon-module / ?>

<?php endif; ?>







<div id="footer" class="clearfix">

<div id="wrapper-footer">



<div class="td-fly-in">



<div class="grid col-340">

<?php

    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'Footer Widget 1' )):

endif;

?>

</div>





<div class="grid col-340">

<?php

    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'Footer Widget 2' )):

endif;

?>

</div>





<div class="grid col-340 fit">

<?php

    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'Footer Widget 3' )):

endif;

?>

</div>



</div><?php // end of fly-in ?>





</div><?php // end of #wrapper-footer ?>



<div class="td-second-footer">

<div class="grid col-1060 block-bottom">

    <div class="block-bottom-padding">

        <div class="grid col-520">

            <div class="copyright">

                <?php if( gameleon_get_option( 'td_copyright' ) ) :

                $copy = gameleon_get_option( 'td_copyright' );

                echo do_shortcode( stripslashes( $copy ));

                endif; ?>

            </div><?php // end of copyright / ?>

        </div><?php // end of grid col-520 / ?>



        <div class="grid col-520 fit">

            <?php if( has_nav_menu( 'footermenu', 'gameleon' ) ) : ?>

            <?php wp_nav_menu( array(

                'container'      => '',

                'fallback_cb'    => false,

                'menu_class'     => 'footer-menu',

                'theme_location' => 'footermenu'

                )

            );

            ?>

        <?php endif; ?>



</div><?php // end of col-520 fit / ?>



</div><?php // end of block-bottom-padding / ?>



</div><?php // end of col-1116 block-bottom / ?>



</div><?php // end of .td-second-footer / ?>





<?php if ( $td_scroll_buttons ) : ?>

<div style="display:none;" class="scroll-up" id="scroll_up"></div>

<div style="display:none;" class="scroll-down" id="scroll_down"></div>

<?php endif; ?>



<?php wp_footer(); ?>


<?php
show_admin_bar(false);

?>


</div><?php // end of #footer ?>

</div><?php // end of #container ?>

</body>

</html>