<?php
/**
 * Lost password form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<form method="post" class="lost_reset_password">

	<?php if( 'lost_password' == $args['form'] ) : ?>

		<p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'youplay' ) ); ?></p>

		<div class="form-row form-row-first">
			<label for="user_login"><?php _e( 'Username or email', 'youplay' ); ?></label>
			<div class="youplay-input">
				<input class="input-text" type="text" name="user_login" id="user_login" />
			</div>
		</div>

	<?php else : ?>

		<p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'youplay') ); ?></p>

		<div class="form-row form-row-first">
			<p for="password_1"><?php _e( 'New password', 'youplay' ); ?> <span class="required">*</span></p>
			<div class="youplay-input">
				<input type="password" class="input-text" name="password_1" id="password_1" />
			</div>
		</div>
		<div class="form-row form-row-last">
			<p for="password_2"><?php _e( 'Re-enter new password', 'youplay' ); ?> <span class="required">*</span></p>
			<div class="youplay-input">
				<input type="password" class="input-text" name="password_2" id="password_2" />
			</div>
		</div>

		<input type="hidden" name="reset_key" value="<?php echo esc_attr(isset( $args['key'] ) ? $args['key'] : ''); ?>" />
		<input type="hidden" name="reset_login" value="<?php echo esc_attr(isset( $args['login'] ) ? $args['login'] : ''); ?>" />

	<?php endif; ?>

	<div class="clear"></div>

	<div class="form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="btn btn-default btn-lg"><?php echo 'lost_password' == $args['form'] ? __( 'Reset Password', 'youplay' ) : __( 'Save', 'youplay' ); ?></button>
	</div>

	<?php wp_nonce_field( $args['form'] ); ?>

</form>
