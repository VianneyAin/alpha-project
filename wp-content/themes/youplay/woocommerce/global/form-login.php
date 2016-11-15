<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="login" style="border: none;padding: 0; <?php if ( $hidden ) echo 'display:none;'; ?>">

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

	<div class="form-row form-row-first">
		<p><?php _e( 'Username or email', 'youplay' ); ?> <span class="required">*</span></p>
		<div class="youplay-input">
			<input type="text" class="input-text" name="username" id="username" />
		</div>
	</div>
	<div class="form-row form-row-last">
		<p><?php _e( 'Password', 'youplay' ); ?> <span class="required">*</span></p>
		<div class="youplay-input">
			<input class="input-text" type="password" name="password" id="password" />
		</div>
	</div>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<div class="form-row">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<button type="submit" class="btn btn-default"><?php _e( 'Login', 'youplay' ); ?></button>
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		
		<div class="youplay-checkbox dib ml-15">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
			<label for="rememberme" class="inline"><?php _e( 'Remember me', 'youplay' ); ?></label>
		</div>
	</div>
	<div class="lost_password">
		<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'youplay' ); ?></a>
	</div>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
