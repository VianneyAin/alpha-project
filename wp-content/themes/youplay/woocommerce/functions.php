<?php
// WooCommerce is active
if ( !class_exists( 'WooCommerce' ) ) {
	return;
}


/* Custom Breadcrumbs */
add_filter( 'woocommerce_breadcrumb_defaults', 'yp_woocommerce_breadcrumbs' );
function yp_woocommerce_breadcrumbs($defaults) {
	$defaults['delimiter'] = ' <span class="fa fa-angle-right"></span> ';
	$defaults['wrap_before'] = '<nav class="mb-20">';
	return $defaults;
}


/* Related Producy Count */
function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 5;
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'yp_related_products_args' );
function yp_related_products_args( $args ) {
	$args['posts_per_page'] = 5;
	return $args;
}


// share action
add_action( 'woocommerce_share', 'youplay_product_sharing', 10, 0 );

// add share buttons tab
// add custom youplay tab
add_filter( 'woocommerce_product_tabs', 'yp_add_woo_tabs', 98 );
function yp_add_woo_tabs( $tabs ) {
	$tabs['sharing'] = array(
		'priority' => 25,
		'callback' => 'woocommerce_template_single_sharing'
	);

	$tabs['additional_params'] = array(
		'priority' => 26,
		'callback' => 'youplay_woo_additional_tab'
	);
	return $tabs;
}

function youplay_woo_additional_tab() {
	$use = yp_opts('single_product_additional_params', true);
	$title = yp_opts('single_product_additional_params_title', true);
	$cont = yp_opts('single_product_additional_params_cont', true);

	if($use) {
		if($title) {
			echo '<h2>' . $title . '</h2>';
		}
		if($cont) {
			echo do_shortcode($cont);
		}
	}
}



// proceed to checkout button
function woocommerce_button_proceed_to_checkout() {
	$checkout_url = WC()->cart->get_checkout_url();
	?>
	<a href="<?php echo esc_url($checkout_url); ?>" class="btn btn-default btn-lg"><?php _e( 'Proceed to Checkout', 'youplay' ); ?></a>
	<?php
}

function yp_get_text_between_tags($string, $tagname) {
	$pattern = "/<$tagname>(.*)<\/$tagname>/";
	preg_match($pattern, $string, $matches);
	return $matches[1];
}

// Product Price fix discount
add_filter( 'woocommerce_get_price_html', 'yp_woo_price_html', 100, 2 );
function yp_woo_price_html( $price ) {
	// check if no <ins> tag and return default value
	if (strpos($price, '<ins>') == false) {
		return $price;
	}

	$old = yp_get_text_between_tags($price, "del");
	$new = yp_get_text_between_tags($price, "ins");
	if($new) {
    	return $new . ($old ? (' <sup><del>' . $old . '</del></sup>') : '');
	} else {
		return $price;
	}
}

// product discount badge
function yp_woo_discount_badge( $product, $show = true ) {
	$regular = $product->regular_price;
	$current = $product->sale_price;

	if(is_numeric($regular) && is_numeric($current)) {
		$discount = ceil(100 - 100 * $current / $regular);

		if($discount == 0) {
			return '';
		}

		$bg = ' bg-default';

		if($discount >= 80) {
			$bg = ' bg-success';
		}

		return '<div class="' . yp_sanitize_class('badge' . ($show?' show':'') . $bg) . '">-' . $discount . '%</div>';
	} else {
		return '';
	}
}



// form fields
if ( ! function_exists( 'youplay_form_field' ) ) {

	/**
	 * Outputs a checkout/address form field.
	 * based on woocommerce_form_field
	 *
	 * @subpackage	Forms
	 * @param string $key
	 * @param mixed $args
	 * @param string $value (default: null)
	 * @todo This function needs to be broken up in smaller pieces
	 */
	function youplay_form_field( $key, $args, $value = null ) {
		$defaults = array(
			'type'              => 'text',
			'label'             => '',
			'description'       => '',
			'placeholder'       => '',
			'maxlength'         => false,
			'required'          => false,
			'id'                => $key,
			'class'             => array(),
			'label_class'       => array(),
			'input_class'       => array(),
			'return'            => false,
			'options'           => array(),
			'custom_attributes' => array(),
			'validate'          => array(),
			'default'           => '',
		);

		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

		if ( ( ! empty( $args['clear'] ) ) ) {
			$after = '<div class="clear"></div>';
		} else {
			$after = '';
		}

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'youplay'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( is_string( $args['label_class'] ) ) {
			$args['label_class'] = array( $args['label_class'] );
		}

		if ( is_null( $value ) ) {
			$value = $args['default'];
		}

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
			foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
			}
		}

		if ( ! empty( $args['validate'] ) ) {
			foreach( $args['validate'] as $validate ) {
				$args['class'][] = 'validate-' . $validate;
			}
		}

		switch ( $args['type'] ) {
			case 'country' :

				$countries = $key == 'shipping_country' ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

				if ( sizeof( $countries ) == 1 ) {

					$field = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] ) {
						$field .= '<label class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']  . '</label>';
					}

					$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

					$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys($countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" />';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</div>' . $after;

				} else {

					$field = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">'
							. '<p class="mt-0 ' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required  . '</p>'
							. '<div class="youplay-select"><select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . '>'
							. '<option value="">'.__( 'Select a country&hellip;', 'youplay' ) .'</option>';

					foreach ( $countries as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'youplay' ) .'</option>';
					}

					$field .= '</select></div>';

					$field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . __( 'Update country', 'youplay' ) . '" /></noscript>';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</div>' . $after;

				}

				break;
			case 'state' :

				/* Get Country */
				$country_key = $key == 'billing_state'? 'billing_country' : 'shipping_country';
				$current_cc  = WC()->checkout->get_value( $country_key );
				$states      = WC()->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {

					$field  = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field" style="display: none">';

					if ( $args['label'] ) {
						$field .= '<p class="mt-0 ' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required . '</p>';
					}
					$field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key )  . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</div>' . $after;

				} elseif ( is_array( $states ) ) {

					$field  = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] )
						$field .= '<p class="mt-0 ' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</p>';
					$field .= '<div class="youplay-select"><select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '">
						<option value="">'.__( 'Select a state&hellip;', 'youplay' ) .'</option>';

					foreach ( $states as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'youplay' ) .'</option>';
					}

					$field .= '</select></div>';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</div>' . $after;

				} else {

					$field  = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] ) {
						$field .= '<p class="mt-0 ' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</p>';
					}
					$field .= '<div class="youplay-input"><input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' /></div>';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</div>' . $after;

				}

				break;
			case 'textarea' :

				$field = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

				if ( $args['label'] ) {
					$field .= '<p class="mt-0 ' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required  . '</p>';
				}

				$field .= '<div class="youplay-textarea"><textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '" style="height: auto;" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $args['maxlength'] . ' ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="5"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>'. esc_textarea( $value  ) .'</textarea></div>';

				if ( $args['description'] ) {
					$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
				}

				$field .= '</div>' . $after;

				break;
			case 'checkbox' :

				$field = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">
						<div class="youplay-checkbox">
							<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" '.checked( $value, 1, false ) .' />

							<label class="checkbox ' . implode( ' ', $args['label_class'] ) .'" ' . implode( ' ', $custom_attributes ) . '>' . $args['label'] . $required . '</label>
						</div>';

				if ( $args['description'] ) {
					$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
				}

				$field .= '</div>' . $after;

				break;
			case 'password' :

				$field = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

				if ( $args['label'] ) {
					$field .= '<p class="mt-0 ' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</p>';
				}

				$field .= '<div class="youplay-input"><input type="password" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' /></div>';

				if ( $args['description'] ) {
					$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
				}

				$field .= '</div>' . $after;

				break;
			case 'text' :

				$field = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

				if ( $args['label'] ) {
					$field .= '<p class="mt-0 ' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required . '</p>';
				}

				$field .= '<div class="youplay-input"><input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' /></div>';

				if ( $args['description'] ) {
					$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
				}

				$field .= '</div>' . $after;

				break;
			case 'select' :

				$options = $field = '';

				if ( ! empty( $args['options'] ) ) {
					foreach ( $args['options'] as $option_key => $option_text ) {
						if ( "" === $option_key ) {
							// If we have a blank option, select2 needs a placeholder
							if ( empty( $args['placeholder'] ) ) {
								$args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'youplay' );
							}
							$custom_attributes[] = 'data-allow_clear="true"';
						}
						$options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) .'</option>';
					}

					$field = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] ) {
						$field .= '<p class="mt-0 ' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</p>';
					}

					$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select '.esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</div>' . $after;
				}

				break;
			case 'radio' :

				$field = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

				if ( $args['label'] ) {
					$field .= '<label for="' . esc_attr( current( array_keys( $args['options'] ) ) ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required  . '</label>';
				}

				if ( ! empty( $args['options'] ) ) {
					foreach ( $args['options'] as $option_key => $option_text ) {
						$field .= '<div class="youplay-radio">';
							$field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
							$field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) .'">' . $option_text . '</label>';
						$field .= '</div>';
					}
				}

				$field .= '</div>' . $after;

				break;
			default :

				$field = '';

				break;
		}

		$field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

		if ( $args['return'] ) {
			return $field;
		} else {
			echo wp_kses_post($field);
		}
	}
}





/* Override Widgets */
add_action( 'widgets_init', 'yp_override_woocommerce_widgets', 15 );
function yp_override_woocommerce_widgets() {
	$override_list = array(
		'WC_Widget_Recently_Viewed'     => 'class-wc-widget-recently-viewed.php',
		'WC_Widget_Top_Rated_Products'  => 'class-wc-widget-top-rated-products.php',
		'WC_Widget_Products'            => 'class-wc-widget-products.php',
		'WC_Widget_Recent_Reviews'      => 'class-wc-widget-recent-reviews.php',
		'WC_Widget_Product_Categories'  => 'class-wc-widget-product-categories.php',
		'WC_Widget_Price_Filter'        => 'class-wc-widget-price-filter.php',
		'WC_Widget_Layered_Nav_Filters' => 'class-wc-widget-layered-nav-filters.php',
		'WC_Widget_Product_Tag_Cloud'   => 'class-wc-widget-product-tag-cloud.php'
	);

	foreach($override_list as $key => $val) {
		if ( class_exists( $key ) ) {
			unregister_widget( $key );
			include_once( get_template_directory() . '/woocommerce/widgets/' . $val );
			register_widget( 'yp_' . $key );
		}
	}
}   
