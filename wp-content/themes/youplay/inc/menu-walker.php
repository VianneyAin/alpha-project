<?php
/**
 * Menu Extension
 * Add subtitle
 *
 * @package Youplay
 */
class nk_walker extends Walker_Nav_Menu {

    function isset_item( $item ) {
        return isset($item->title);
    }

    function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        // Add classname if has submenu
        $attributes = '';
        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));

        if (!empty($children)) {
            $attributes .= ' class="dropdown-toggle"';

            if($depth == 0) {
                $classes[] = 'dropdown';
                $classes[] = 'dropdown-hover';
            } else {
                $classes[] = 'dropdown-submenu';
                if($args->menu == 'Right Menu') {
                    $classes[] = 'pull-left';
                }
            }
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        if( $this->isset_item($item) ) {
            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
        }

        $attributes  .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' role="button"';
        $attributes .= ' aria-expanded="false"';

        $prepend = '';
        $append = '';
        $subtitle  = ! empty( $item->description ) ? '<span class="label">'.esc_attr( $item->description ).'</span>' : '';

        $caret = (!empty($children) && $depth == 0 ? ' <span class="caret"></span>' : '');

        if($depth != 0)
        {
            $subtitle = $append = $prepend = "";
        }

        if(get_post_meta($item->ID, '_menu_item_hidetitle', true)) {
            $title = '';
        } else {
            $title = apply_filters( 'the_title', $item->title, $item->ID );
        }

        $item_output = '';
        if(is_object($args)) {
            $item_output .= $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before;
            $item_output .= $prepend.$title.$append.$caret;
            $item_output .= $subtitle.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }

        if( $this->isset_item($item) ) {
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    function end_el( &$output, $item, $depth = 0, $args = array() )  {
        if( $this->isset_item($item) ) {
            $output .= '</li>';
        }
    }

    // change markup for submenus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='dropdown-menu'><ul role='menu'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}