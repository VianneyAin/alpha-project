<?php

/**
 * Ninety_Login_widget class.
 *
 * @extends WP_Widget
 */
class Ninety_Login_widget extends WP_Widget {

    /**
     * Ninety_Login_widget function.
     *
     * @access public
     * @return void
     */
    function Ninety_Login_widget() {
        $widget_ops = array(
        	'description' => __(  'Ajax powered Login &amp; Register widget.', 'gameleon'  )
            );

        $this->WP_Widget( 'ninety_login_widget', __( '[GAMELEON] Log in Box', 'gameleon' ), $widget_ops );
    }

    /**
     * Test to see if the current theme is Gameleon
     *
     * @return bool
     */
    public static function is_gameleon() {
        $theme = wp_get_theme();

        if( $theme->Name == 'gameleon' || $theme->Template == 'gameleon' ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * widget function.
     *
     * @access public
     * @param mixed $args
     * @param mixed $instance
     * @return void
     */
    function widget( $args, $instance ) {
        if( $this->is_gameleon() ) {
            $GLOBALS['Ninety_Login']->widget( $args );
        }

    }
}