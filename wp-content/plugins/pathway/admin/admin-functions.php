<?php

/*-----------------------------------------------------------------------------------*/
/* Head Hook
/*-----------------------------------------------------------------------------------*/

function pw_head() { do_action( 'pw_head' ); }

/*-----------------------------------------------------------------------------------*/
/* Redirect to "Theme Options" screen */
/*-----------------------------------------------------------------------------------*/
add_action( 'pw_theme_activate', 'pw_themeoptions_redirect', 10 );

function pw_themeoptions_redirect () {
	// Do redirect
	header( 'Location: ' . admin_url() . 'admin.php?page=admin-interface.php' );
} // End pw_themeoptions_redirect()

/*-----------------------------------------------------------------------------------*/
/* Get the style path currently selected */
/*-----------------------------------------------------------------------------------*/

function pw_style_path() {
    $style = $_REQUEST['style'];
    if ($style != '') {
        $style_path = $style;
    } else {
        $stylesheet = get_option('pw_alt_stylesheet');
        $style_path = str_replace(".css","",$stylesheet);
    }
    if ($style_path == "default")
      echo 'images';
    else
      echo 'styles/'.$style_path;
}

/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/
if (is_admin() && isset($_GET['activate'] ) && $pagenow == "plugins.php" ) {
	//Call action that sets
	add_action('admin_head','pw_option_setup');
	// Redirect.
	//do_action( 'pw_theme_activate' );
}

function pw_option_setup(){

	//Update EMPTY options
	$pw_array = array();
	add_option('pw_options',$pw_array);

	$template = get_option('pw_plugin');
	$saved_options = get_option('pw_options');

	foreach($template as $option) {
		if($option['type'] != 'heading'){
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$pw_array[$c_id] = $c_std; 
					}
				} else {
					update_option($id,$std);
					$pw_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$pw_array[$id] = $db_option;
			}
		}
	}
	update_option('pw_options',$pw_array);
}

/*-----------------------------------------------------------------------------------*/
/* Admin Backend */
/*-----------------------------------------------------------------------------------*/
function vcframework_admin_head() { 
	
	//Tweaked the message on theme activate
	?>
    <script type="text/javascript">
    jQuery(function(){
	var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=vcframework'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
}

add_action('admin_head', 'vcframework_admin_head'); 

?>