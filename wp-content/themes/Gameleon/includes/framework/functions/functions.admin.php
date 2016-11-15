<?php
/**
 * SMOF Admin
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */


/**
 * Head Hook
 *
 * @since 1.0.0
 */
function of_head() { do_action( 'of_head' ); }

/**
 * Add default options upon activation else DB does not exist
 *
 * DEPRECATED, Class_options_machine now does this on load to ensure all values are set
 *
 * @since 1.0.0
 */
function of_option_setup()
{
	global $of_options, $options_machine;
	$options_machine = new Options_Machine($of_options);

	if (!of_get_options())
	{
		of_save_options($options_machine->Defaults);
	}
}


/*----------------------------------------------------------------------------------------------------------
	Customize theme activation message and add useful button links
-----------------------------------------------------------------------------------------------------------*/

	function optionsframework_activation_notice() {

		if ( isset( $_GET['activated'] ) ) {

			$buffer = '<div class="updated activation"><p><strong>';
			$my_theme = wp_get_theme();
			$buffer .= sprintf( __( '%s activated successfully!', 'gameleon' ), $my_theme->get( 'Name' ) );
			$buffer .= '</strong> <a target="_blank" href="' . home_url( '/' ) . '">' . __( 'Visit Site', 'gameleon' ) . '</a></p>';
			$buffer .= ' <a class="button button-primary td-activation" href="' . admin_url( 'admin.php?page=gameleon_panel' ) . '">' . __( 'Theme Options', 'gameleon' ) . '</a>';
			$buffer .= ' <a class="button button-primary td-activation" href="' . admin_url( 'widgets.php' ) . '">' . __( 'Widgets Settings', 'gameleon' ) . '</a>';
			$buffer .= ' <a class="button button-primary td-activation" target="_blank" href="http://tiguandesign.ticksy.com/">' . __( 'Support', 'gameleon' ) . '</a>';
			$buffer .= ' <a class="button button-primary td-activation" target="_blank" href="http://tiguandesign.com/docs/gameleon">' . __( 'Documentation', 'gameleon' ) . '</a>';
			$buffer .= '</p></div>';

			echo $buffer;

		}	//END if

	}	//	END function optionsframework_activation_notice


/*----------------------------------------------------------------------------------------------------------
	Hide core theme activation message and change some css
-----------------------------------------------------------------------------------------------------------*/

	function optionsframework_hide_activation() { ?>
	<style>
	.themes-php #message2 {
		display: none;
	}
	.themes-php div.activation a {
		text-decoration: none;
	}
	.button-primary.td-activation {
		border-radius: 0;
	}
	</style>
	<?php }


/*----------------------------------------------------------------------------------------------------------
	Add two links to theme options and help center in the admin bar: Theme Options and Theme Support
-----------------------------------------------------------------------------------------------------------*/

function gameleon_admin_bar_links() {
	global $wp_admin_bar;
	if(!is_super_admin() || !is_admin_bar_showing()) return;

	$wp_admin_bar->add_menu(array(
		'parent' => 'site-name',
		'title' => 'Theme Options',
		'href' => admin_url('admin.php?page=gameleon_panel'),
		'id' => 'tigu-custom-admin-menu'
		));

	$wp_admin_bar->add_menu( array(
		'id'   => 'tiguan_support_center',
		'meta' => array('title' => 'Theme Support', 'target' => '_blank'),
		'title' => 'Theme Support',
		'href' => 'http://tiguandesign.com/support/' ));

}

add_action( 'admin_bar_menu', 'gameleon_admin_bar_links', 3000 );


/**
 * Get header classes
 *
 * @since 1.0.0
 */
function of_get_header_classes_array()
{
	global $of_options;

	foreach ($of_options as $value)
	{
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));
	}

	return $hooks;
}

/**
 * Get options from the database and process them with the load filter hook.
 *
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @return array
 */
function of_get_options($key = null, $data = null) {
	global $smof_data;

	do_action('of_get_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	if ($key != null) { // Get one specific value
		$data = get_theme_mod($key, $data);
	} else { // Get all values
		$data = get_theme_mods();
	}
	$data = apply_filters('of_options_after_load', $data);
	if ($key == null) {
		$smof_data = $data;
	} else {
		$smof_data[$key] = $data;
	}
	do_action('of_option_setup_before', array(
		'key'=>$key, 'data'=>$data
	));
	return $data;

}

/**
 * Save options to the database after processing them
 *
 * @param $data Options array to save
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @uses update_option()
 * @return void
 */

function of_save_options($data, $key = null) {
	global $smof_data;
    if (empty($data))
        return;
    do_action('of_save_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	$data = apply_filters('of_options_before_save', $data);
	if ($key != null) { // Update one specific value
		if ($key == BACKUPS) {
			unset($data['smof_init']); // Don't want to change this.
		}
		set_theme_mod($key, $data);
	} else { // Update all values in $data
		foreach ( $data as $k=>$v ) {
			if (!isset($smof_data[$k]) || $smof_data[$k] != $v) { // Only write to the DB when we need to
				set_theme_mod($k, $v);
			} else if (is_array($v)) {
				foreach ($v as $key=>$val) {
					if ($key != $k && $v[$key] == $val) {
						set_theme_mod($k, $v);
						break;
					}
				}
			}
	  	}
	}
    do_action('of_save_options_after', array(
		'key'=>$key, 'data'=>$data
	));

}


/**
 * For use in themes
 *
 * @since forever
 */

$data = of_get_options();
if (!isset($smof_details))
	$smof_details = array();