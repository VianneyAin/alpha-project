<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Layered Navigation Fitlers Widget
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */
class yp_WC_Widget_Layered_Nav_Filters extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_layered_nav_filters_custom';
		$this->widget_description = __( 'Shows active layered nav filters so users can see and deactivate them.', 'youplay' );
		$this->widget_id          = 'woocommerce_layered_nav_filters';
		$this->widget_name        = __( 'WooCommerce Layered Nav Filters', 'youplay' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Active Filters', 'youplay' ),
				'label' => __( 'Title', 'youplay' )
			)
		);

		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		global $_chosen_attributes;

		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
			return;
		}

		// Price
		$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : 0;
		$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : 0;

		// remove icon
		$remove_icon = '<i class="fa fa-times pull-right mt-2"></i>';

		// remove decoration
		$no_decoration = 'style="text-decoration: none;"';

		if ( 0 < count( $_chosen_attributes ) || 0 < $min_price || 0 < $max_price ) {

			$this->widget_start( $args, $instance );

			echo '<ul class="block-content text-left">';

			// Attributes
			if ( ! is_null( $_chosen_attributes ) ) {
				foreach ( $_chosen_attributes as $taxonomy => $data ) {

					foreach ( $data['terms'] as $term_id ) {
						$term = get_term( $term_id, $taxonomy );

						if ( ! isset( $term->name ) ) {
							continue;
						}

						$taxonomy_filter = str_replace( 'pa_', '', $taxonomy );
						$current_filter  = ! empty( $_GET[ 'filter_' . $taxonomy_filter ] ) ? $_GET[ 'filter_' . $taxonomy_filter ] : '';
						$new_filter      = array_map( 'absint', explode( ',', $current_filter ) );
						$new_filter      = array_diff( $new_filter, array( $term_id ) );

						$link = remove_query_arg( 'filter_' . $taxonomy_filter );

						if ( sizeof( $new_filter ) > 0 ) {
							$link = add_query_arg( 'filter_' . $taxonomy_filter, implode( ',', $new_filter ), $link );
						}

						echo '<li><a title="' . __( 'Remove filter', 'youplay' ) . '" href="' . esc_url( $link ) . '" ' . $no_decoration . '>' . $term->name . ' ' . $remove_icon . '</a></li>';
					}
				}
			}

			if ( $min_price ) {
				$link = remove_query_arg( 'min_price' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'youplay' ) . '" href="' . esc_url( $link ) . '" ' . $no_decoration . '>' . __( 'Min', 'youplay' ) . ' ' . wc_price( $min_price ) . ' ' . $remove_icon . '</a></li>';
			}

			if ( $max_price ) {
				$link = remove_query_arg( 'max_price' );
				echo '<li class="chosen"><a title="' . __( 'Remove filter', 'youplay' ) . '" href="' . esc_url( $link ) . '" ' . $no_decoration . '>' . __( 'Max', 'youplay' ) . ' ' . wc_price( $max_price ) . ' ' . $remove_icon . '</a></li>';
			}

			echo '</ul>';

			$this->widget_end( $args );
		}
	}
}
