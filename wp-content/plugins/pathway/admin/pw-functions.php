<?php
/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they intend to go wrong in a big way.
	You have been warned!

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Custom login_head action - pw_theme_head
/*-----------------------------------------------------------------------------------*/
 
function pw_theme_head()
{
	$pw_style_shaker		= get_option( 'pw_style_shaker' );
	$pw_head_logo_img	 	= get_option( 'pw_head_logo_img' );
	
	remove_action( 'login_head', 'wp_shake_js', 12 );
	
	if( $pw_style_shaker == "true"){
		add_action( 'login_head', 'wp_shake_js', 12 );		
	}
	
//	add_action( 'login_head', 'wp_shake_js', 12 );	

	
	echo '<link rel="stylesheet" href="'. PW_FILEPATH .'/css/the.css" media="all" />';
	echo '<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css?ver=4.0.3" media="all" />';

    //echo '<link rel="stylesheet" href="'. PW_FILEPATH .'/css/style.php" media="all" />';
	echo "<style>
	/*==========================================================================================

This file contains styles related to the style scheme of the theme

==========================================================================================

	0.	Get Option
	1.	Document Setup (body)
	2.	Header Styles (login logo)
	3.	Form Styles (form, field, button, etc)
	4.	Copyright
	5.	Notifications
	6.	CSS Custom

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	0.	Get Option
/*-----------------------------------------------------------------------------------*/";

	// Get Option 
	$pw_options				= get_option( 'pw_options' ); // OK
	
	/* ON THEME RESET */
	if (empty($pw_options))
	{
		ob_end_flush(); 
	//	die(); 
	}
	
	// heading
	$pw_head_bg_color  		= get_option( 'pw_head_bg_color' ); // OK
	$pw_head_bg_img  		= get_option( 'pw_head_bg_img' ); // OK
	$pw_head_bg_pr 			= get_option( 'pw_head_bg_pr' ); // OK
	$pw_head_logo_img	 	= get_option( 'pw_head_logo_img' ); // OK
	$pw_head_logo_height	= get_option( 'pw_head_logo_height' ); //OK
	
	// form
	$pw_form_bg_color		= get_option( 'pw_form_bg_color' ); // OK
	$pw_form_bg_img			= get_option( 'pw_form_bg_img' ); // OK
	$pw_form_bg_pr			= get_option( 'pw_form_bg_pr' ); // OK
	$pw_form_border			= get_option( 'pw_form_border' ); // OK
	$pw_form_radius			= get_option( 'pw_form_radius' ); // OK
	$pw_form_shadow			= get_option( 'pw_form_shadow' ); // OK
	$pw_form_width			= get_option( 'pw_form_width' ); // OK
	$pw_form_padding		= get_option( 'pw_form_padding' ); // OK
	$pw_form_label_color	= get_option( 'pw_form_label_color' ); // OK
	$pw_form_text_color		= get_option( 'pw_form_text_color' ); // OK
	$pw_form_field_radius	= get_option( 'pw_form_field_radius' ); // OK
	$pw_form_field_bg_color	= get_option( 'pw_form_field_bg_color' ); // OK
	$pw_form_field_border	= get_option( 'pw_form_field_border' ); // OK
	$pw_form_field_shadow	= get_option( 'pw_form_field_shadow' ); // OK
	$pw_form_field_bg_color_hover	= get_option( 'pw_form_field_bg_color_hover' ); // OK
	$pw_form_field_border_hover		= get_option( 'pw_form_field_border_hover' ); // OK
	$pw_form_field_shadow_hover		= get_option( 'pw_form_field_shadow_hover' ); // OK
	$pw_form_lost_color		= get_option( 'pw_form_lost_color' ); // OK
	$pw_form_lost_color_hover		= get_option( 'pw_form_lost_color_hover' ); // OK
	$pw_form_remember_color	= get_option( 'pw_form_remember_color' ); // OK
	$pw_form_button_skin	= get_option( 'pw_form_button_skin' ); // OK
	
	// styling
	$pw_style_bg_color		= get_option( 'pw_style_bg_color' ); // OK
	$pw_style_bg_img		= get_option( 'pw_style_bg_img' ); // OK
	$pw_style_bg_pr			= get_option( 'pw_style_bg_pr' ); // OK
	$pw_style_shaker		= get_option( 'pw_style_shaker' ); //OK
	$pw_style_copyright		= get_option( 'pw_style_copyright' ); //OK
	$pw_style_copyright_color		= get_option( 'pw_style_copyright_color' ); //OK
	$pw_style_copyright_a_color		= get_option( 'pw_style_copyright_a_color' ); //OK
	$pw_style_copyright_a_color_hover		= get_option( 'pw_style_copyright_a_color_hover' ); //OK
	$pw_style_css			= get_option( 'pw_style_css' ); //OK

echo "
/*-----------------------------------------------------------------------------------*/
/*	1.	Document Setup (body)
/*-----------------------------------------------------------------------------------*/

html{
	background:none !important;
	background-color: transparent;
}

body {
	font:13px/20px 'Helvetica Neue', Helvetica, Arial, sans-serif;
	cursor: default;
	padding-top: 0 !important;
	
	background-image: url( ". $pw_style_bg_img ." ) !important;
	/*background-size: 100%;*/
	background-color:  ". $pw_style_bg_color ." !important;
	background-position:  ". $pw_style_bg_pr['position_1']." ".$pw_style_bg_pr['position_2'] ." !important;
	";echo ($pw_style_bg_pr['repeat']=="cover") ? "background-size: cover !important; background-repeat:no-repeat !important;" : "background-repeat:  ". $pw_style_bg_pr['repeat']; echo " !important;
}

html, body {
    height: auto;
}
/*
#backtoblog { display : none; }
*/
div.updated, .login .message { margin: 0 0 16px 0; }

/*-----------------------------------------------------------------------------------*/
/*	2.	Header Styles (login logo)
/*-----------------------------------------------------------------------------------*/

#login {
    padding: 0;
    width : ". $pw_form_width."px" ." !important;
}

.login #login h1{";
	if ($pw_head_bg_color != "none") {
	echo "background-image: url( ". $pw_head_bg_img ." ) !important;
	background-color:  ". $pw_head_bg_color ." !important;
	background-position:  ". $pw_head_bg_pr['position_1']." ".$pw_head_bg_pr['position_2'] ." !important;
	";
	echo ($pw_head_bg_pr['repeat']=="cover") ? "background-size: cover !important; background-repeat:no-repeat !important;" : "background-repeat:  ". $pw_head_bg_pr['repeat']." !important;"; 
	} else { 
	echo "background:none !important;
	background-color: transparent;
	background-image: url( ". $pw_head_bg_img ." ) !important;";
	echo ($pw_head_bg_pr['repeat']=="cover") ? "background-size: cover !important; background-repeat:no-repeat !important;" : "background-repeat:  ". $pw_head_bg_pr['repeat']." !important;"; 
	}
echo "}

h1 a {
	width : ". $pw_form_width ."px !important;
	height : ". $pw_head_logo_height ."px !important;
	padding-bottom : 0px !important;
	background-image: url( ". $pw_head_logo_img ." ) !important;	
}

.bg_pw{
	width : ". $pw_form_width ."px !important;
	background-size:auto !important;
	height : ". $pw_head_logo_height ."px !important;
	padding-bottom : 0px !important;
	background-image: url( ". $pw_head_logo_img ." ) !important;	
}

/*-----------------------------------------------------------------------------------*/
/*	3.	Form Styles (form, field, button, etc)
/*-----------------------------------------------------------------------------------*/

.login form {
	margin-left: 0;
	padding : ". $pw_form_padding['padding_top']."px ".$pw_form_padding['padding_right']."px ".$pw_form_padding['padding_bottom']."px ".$pw_form_padding['padding_left']."px" ." !important;";
	
	if ($pw_form_bg_color != "none") {
	
	echo "
	background-image: url( ". $pw_form_bg_img ." ) !important;
	background-color:  ". $pw_form_bg_color ." !important;
	background-position:  ". $pw_form_bg_pr['position_1']." ".$pw_form_bg_pr['position_2'] ." !important;";
	echo ($pw_form_bg_pr['repeat']=="cover") ? "background-size: cover !important; background-repeat:no-repeat !important;" : "background-repeat:  ". $pw_form_bg_pr['repeat']." !important;"; 

	} else {
	echo "background: none !important;
	background-color: transparent;
	background-image: url( ". $pw_form_bg_img ." ) !important;";
	}
	
	echo "
	-webkit-border-radius: ". $pw_form_radius ."px !important;
	-moz-border-radius: ". $pw_form_radius ."px !important;
	border-radius: ". $pw_form_radius ."px !important;
	
	border : ". $pw_form_border['width']."px ".$pw_form_border['style']." ".$pw_form_border['color'] ." !important;
	
	-moz-box-shadow: ". $pw_form_shadow['style']." ".$pw_form_shadow['plus_h'].$pw_form_shadow['horizontal']."px ".$pw_form_shadow['plus_v'].$pw_form_shadow['vertical']."px ".$pw_form_shadow['blur']."px ".$pw_form_shadow['spread']."px ".$pw_form_shadow['color'] ." !important;
	-webkit-box-shadow: ". $pw_form_shadow['style']." ".$pw_form_shadow['plus_h'].$pw_form_shadow['horizontal']."px ".$pw_form_shadow['plus_v'].$pw_form_shadow['vertical']."px ".$pw_form_shadow['blur']."px ".$pw_form_shadow['spread']."px ".$pw_form_shadow['color'] ." !important;
	box-shadow: ". $pw_form_shadow['style']." ".$pw_form_shadow['plus_h'].$pw_form_shadow['horizontal']."px ".$pw_form_shadow['plus_v'].$pw_form_shadow['vertical']."px ".$pw_form_shadow['blur']."px ".$pw_form_shadow['spread']."px ".$pw_form_shadow['color'] ." !important;
}

.login label {
	color : ". $pw_form_label_color ." !important;
	font-weight: bold;
	font-size : 14px !important;
	text-align: left !important;
}
";
echo "
body form .input, #user_pass, #user_login, #user_email {
	color : ". $pw_form_text_color ." ;
	font-size : 14px !important;
	padding: 19px 13px 20px 19px !important;
	margin-top : 7px  !important;
	margin-bottom: 10px !important;

	-webkit-border-radius: ". $pw_form_field_radius ."px ;
	-moz-border-radius: ". $pw_form_field_radius ."px ;
	border-radius: ". $pw_form_field_radius ."px ;
	
	background-color:  ". $pw_form_field_bg_color ." ;
	
	border : ". $pw_form_field_border['width']."px ".$pw_form_field_border['style']." ".$pw_form_field_border['color'] ." ;
	
	-moz-box-shadow: ". $pw_form_field_shadow['style']." ".$pw_form_field_shadow['plus_h'].$pw_form_field_shadow['horizontal']."px ".$pw_form_field_shadow['plus_v'].$pw_form_field_shadow['vertical']."px ".$pw_form_field_shadow['blur']."px ".$pw_form_field_shadow['spread']."px ".$pw_form_field_shadow['color'] ." ;
	-webkit-box-shadow: ". $pw_form_field_shadow['style']." ".$pw_form_field_shadow['plus_h'].$pw_form_field_shadow['horizontal']."px ".$pw_form_field_shadow['plus_v'].$pw_form_field_shadow['vertical']."px ".$pw_form_field_shadow['blur']."px ".$pw_form_field_shadow['spread']."px ".$pw_form_field_shadow['color'] ." ;
	box-shadow: ". $pw_form_field_shadow['style']." ".$pw_form_field_shadow['plus_h'].$pw_form_field_shadow['horizontal']."px ".$pw_form_field_shadow['plus_v'].$pw_form_field_shadow['vertical']."px ".$pw_form_field_shadow['blur']."px ".$pw_form_field_shadow['spread']."px ".$pw_form_field_shadow['color'] ." ;
}

body form .input:focus, body form .input:active  {
	background-color:  ". $pw_form_field_bg_color_hover ." !important;
	
	border : ". $pw_form_field_border_hover['width']."px ".$pw_form_field_border_hover['style']." ".$pw_form_field_border_hover['color'] ." !important;
	
	-moz-box-shadow: ". $pw_form_field_shadow_hover['style']." ".$pw_form_field_shadow_hover['plus_h'].$pw_form_field_shadow_hover['horizontal']."px ".$pw_form_field_shadow_hover['plus_v'].$pw_form_field_shadow_hover['vertical']."px ".$pw_form_field_shadow_hover['blur']."px ".$pw_form_field_shadow_hover['spread']."px ".$pw_form_field_shadow_hover['color'] ." !important;
	-webkit-box-shadow: ". $pw_form_field_shadow_hover['style']." ".$pw_form_field_shadow_hover['plus_h'].$pw_form_field_shadow_hover['horizontal']."px ".$pw_form_field_shadow_hover['plus_v'].$pw_form_field_shadow_hover['vertical']."px ".$pw_form_field_shadow_hover['blur']."px ".$pw_form_field_shadow_hover['spread']."px ".$pw_form_field_shadow_hover['color'] ." !important;
	box-shadow: ". $pw_form_field_shadow_hover['style']." ".$pw_form_field_shadow_hover['plus_h'].$pw_form_field_shadow_hover['horizontal']."px ".$pw_form_field_shadow_hover['plus_v'].$pw_form_field_shadow_hover['vertical']."px ".$pw_form_field_shadow_hover['blur']."px ".$pw_form_field_shadow_hover['spread']."px ".$pw_form_field_shadow_hover['color'] ." !important;
}

form .forgetmenot {
	margin-top : 20px;
}

form .forgetmenot label {
	font-size : 12px !important;
	color : ". $pw_form_remember_color ." !important;
}

form .submit {
	margin-top : 17px;
}

/* button config */

.login input.button-primary {
    display: inline-block;
	text-decoration: none;
	outline: none;
	cursor: pointer;
	font: bold HelveticaNeue, Arial, sans-serif !important;
        font-size: 12px !important;
	padding: 1px 21px !important;
	color: #555;
	text-shadow: 0 1px 0 #fff;
	margin-right : 5px;
	
	background: #f5f5f5;
	background: -webkit-gradient(linear, left top, left bottom, from(#f9f9f9), to(#f0f0f0)) ;
	background: -moz-linear-gradient(top, #f9f9f9, #f0f0f0) ;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#f0f0f0');
	
	border: 1px solid #dedede;
	border-color: #dedede #d8d8d8 #d3d3d3;
	
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
}

input.button-primary:active{
	position: relative;
	top: 1px;
	
	color: #555;
	background: #efefef !important;
	background: -webkit-gradient(linear, left top, left bottom, from(#eaeaea), to(#f4f4f4)) !important;
	background: -moz-linear-gradient(top, #eaeaea, #f4f4f4) !important;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#eaeaea', endColorstr='#f4f4f4') !important;
	border-color: #c6c6c6 !important;
}

input.button-primary:hover, input.button-primary:focus{
	color: #555;
	background: #efefef;
	background: -webkit-gradient(linear, left top, left bottom, from(#f9f9f9), to(#e9e9e9));
	background: -moz-linear-gradient(top, #f9f9f9, #e9e9e9);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9');
	border-color: #ccc;
}
form p.submit {
	width: 100%;
	margin-top:15px !important;
}
";


if ($pw_form_button_skin == 'rwhite') {
	echo "input.button-primary{
		padding: 8px 21px !important;
		-webkit-border-radius: 15px !important;
		-moz-border-radius: 15px !important;
		border-radius: 15px !important;
	}";

}

echo "input.button-primary{
	*width: auto; /* IE7 Fix */
	*overflow: visible; /* IE7 Fix */
}";


	if ($pw_form_button_skin == 'sblue' or $pw_form_button_skin == 'rblue'){
		if ($pw_form_button_skin == 'rblue') {
			echo "
			input.button-primary{
				padding: 10px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}";
		}
		echo "
		input.button-primary{
			background: #377ad0 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#52a8e8), to(#377ad0)) !important;
			background: -moz-linear-gradient(top, #52a8e8, #377ad0) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#52a8e8', endColorstr='#377ad0');
			border-color: #4081af #2e69a3 #20559a !important;
			color: #fff !important;
			text-shadow: 0 1px 1px #4081af !important;
		}
		input.button-primary:hover, input.button-primary:focus{
			background: #206bcb !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#3e9ee5), to(#206bcb)) !important;
			background: -moz-linear-gradient(top, #3e9ee5, #206bcb) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#523e9ee58e8', endColorstr='#206bcb') !important;
			border-color: #2a73a6 #165899 #07428f !important;
		}
		input.button-primary:active{
			background: #3282d3 !important;
			border-color: #154c8c #154c8c #0e408e!important;
			text-shadow: 0 -1px 1px #1d62ab !important;
		}";
	}

	if ($pw_form_button_skin == 'sbl' or $pw_form_button_skin == 'rbl'){
		if ($pw_form_button_skin == 'rbl') {
			echo"
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}";
			
		}
		echo "
		input.button-primary{
			background: #525252 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#5e5e5e), to(#434343)) !important;
			background: -moz-linear-gradient(top, #5e5e5e, #434343) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#5e5e5e', endColorstr='#434343') !important;
			border-color: #4c4c4c #313131 #1f1f1f !important;
			color: #fff !important;
			text-shadow: 0 1px 1px #2e2e2e !important;
		}
		input.button-primary:hover, input.button-primary:focus{
			background: #4b4b4b !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#686868), to(#363636)) !important;
			background: -moz-linear-gradient(top, #686868, #363636) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#686868', endColorstr='#363636') !important;
		}
		input.button-primary:active{
			background: #525252 !important;
			border-color: #313131 !important;
		}";
		
	}
	
	if ($pw_form_button_skin == 'sgray' or $pw_form_button_skin == 'rgray'){
		if ($pw_form_button_skin == 'rgray') {
			echo "
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}";
			
		}
		echo "
		input.button-primary{
			background: #969696 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#ababab), to(#818181)) !important;
			background: -moz-linear-gradient(top, #ababab, #818181) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ababab', endColorstr='#818181') !important;
			border-color: #a0a0a0 #7c7c7c #717171 !important;
			color: #fff !important;
			text-shadow: 0 1px 1px #444 !important;
		}
		input.button-primary:hover, input.button-primary:focus{
			background: #868686 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#b0b0b0), to(#6f6f6f)) !important;
			background: -moz-linear-gradient(top, #b0b0b0, #6f6f6f) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b0b0b0', endColorstr='#6f6f6f') !important;
			border-color: #666 #666 #606060 !important;
		}
		input.button-primary:active{
			background: #909090 !important;
			border-color: #606060 !important;
		}";
		
	}
	
	if ($pw_form_button_skin == 'sgreen' or $pw_form_button_skin == 'rgreen'){
		if ($pw_form_button_skin == 'rgreen') {
			echo "
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}";
			
		}
		echo"
		input.button-primary{
			background: #7fbf4d !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#7fbf4d), to(#63a62f)) !important;
			background: -moz-linear-gradient(top, #7fbf4d, #63a62f) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#7fbf4d', endColorstr='#63a62f') !important;
			border-color: #63a62f !important;
			color: #fff !important;
			text-shadow: 0 1px 0 #53961e !important;
		}
		input.button-primary:hover, input.button-primary:focus{
			background: #76b347 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#86c755), to(#5ea12a)) !important;
			background: -moz-linear-gradient(top, #86c755, #5ea12a) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#86c755', endColorstr='#5ea12a') !important;
			border-color: #53961e !important;
		}
		input.button-primary:active{
			background: #7fbf4d !important;
			border-color: #53961e !important;
		}";
		
	}
	
	if ($pw_form_button_skin == 'slightblue' or $pw_form_button_skin == 'rlightblue'){
		if ($pw_form_button_skin == 'rlightblue') {
			echo "
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}";
			
		}
		echo"
		input.button-primary{
			background: #92dbf6 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#abe4f8), to(#6fcef3)) !important;
			background: -moz-linear-gradient(top, #abe4f8, #6fcef3) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#abe4f8', endColorstr='#6fcef3') !important;
			border-color: #7cbdd5 !important;
			color: #444 !important;
			text-shadow: 0 1px 0 #b6e6f9 !important;
		}
		input.button-primary:hover, input.button-primary:focus{
			background: #85d6f5 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#b1e9fd), to(#66c6ea)) !important;
			background: -moz-linear-gradient(top, #b1e9fd, #66c6ea) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b1e9fd', endColorstr='#66c6ea') !important;
			border-color: #66a8bf !important;
		}
		input.button-primary:active{
			background: #92dbf6 !important;
			border-color: #66a8bf !important;
		}";
		
	}
	
	if ($pw_form_button_skin == 'sorange' or $pw_form_button_skin == 'rorange'){
		if ($pw_form_button_skin == 'rorange') {
			echo "
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}";
			
		}
		echo "
		input.button-primary{
			background: #ee8f1f !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#f5b026), to(#f48423)) !important;
			background: -moz-linear-gradient(top, #f5b026, #f48423) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f5b026', endColorstr='#f48423') !important;
			border-color: #e6791c #e6791c #d86f15 !important;
			color: #fff !important;
			text-shadow: 0 1px 1px #b85300 !important;
		}
		input.button-primary:hover, input.button-primary:focus{
			background: #e38512 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#ffbb33), to(#eb7b1a)) !important;
			background: -moz-linear-gradient(top, #ffbb33, #eb7b1a) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffbb33', endColorstr='#eb7b1a') !important;
			border-color: #d0680c !important;
		}
		input.button-primary:active{
			background: #ee8f1f !important;
			border-color: #d0680c !important;
		}";
		
	}
	
	if ($pw_form_button_skin == 'spink' or $pw_form_button_skin == 'rpink'){
		if ($pw_form_button_skin == 'rpink') {
			echo"
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}";
			
		}
		echo "
		input.button-primary{
			background: #f87bca !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#f87bca), to(#ec56b5)) !important;
			background: -moz-linear-gradient(top, #f87bca, #ec56b5) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f87bca', endColorstr='#ec56b5') !important;
			border-color: #e54aac #e54aac #cc3695 !important;
			color: #fff !important;
			text-shadow: 0 1px 1px #c02589 !important;
		}
		input.button-primary:hover, input.button-primary:focus{
			background: #f075c3 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#ff85d3), to(#e34dac)) !important;
			background: -moz-linear-gradient(top, #ff85d3, #e34dac) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff85d3', endColorstr='#e34dac') !important;
			border-color: #c02589 !important;
		}
		input.button-primary:active{
			background: #f87bca !important;
			border-color: #c02589 !important;
		}";
		
	}
	
	if ($pw_form_button_skin == 'spurple' or $pw_form_button_skin == 'rpurple'){
		if ($pw_form_button_skin == 'rpurple') {
			echo "
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}";
			
		}
		echo "
		input.button-primary{
			background: #995dc8 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#c785e5), to(#995dc8)) !important;
			background: -moz-linear-gradient(top, #c785e5, #995dc8) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#c785e5', endColorstr='#995dc8') !important;
			border-color: #7c45aa #7c45aa #5d288a !important;
			color: #fff !important;
			text-shadow: 0 1px 1px #370662 !important;
		}
		input.button-primary:hover, input.button-primary:focus{
			background: #8b50ba !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#cc8aea), to(#884eb8)) !important;
			background: -moz-linear-gradient(top, #cc8aea, #884eb8) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#cc8aea', endColorstr='#884eb8') !important;
			border-color: #5d288a !important;
		}
		input.button-primary:active{
			background: #995dc8 !important;
			border-color: #5d288a !important;
		}";
		
	}
	
	if ($pw_form_button_skin == 'sred' or $pw_form_button_skin == 'rred'){
		if ($pw_form_button_skin == 'rred') {
			echo "
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}";
			
		}
		echo "
		input.button-primary{
			background: #e6433d !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#f8674b), to(#d54746)) !important;
			background: -moz-linear-gradient(top, #f8674b, #d54746) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f8674b', endColorstr='#d54746') !important;
			border-color: #d1371c #d1371c #9f220d !important;
			color: #fff !important;
			text-shadow: 0 1px 1px #961a07 !important;
		}
		input.button-primary:hover, input.button-primary:focus{
			background: #dd3a37 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#ff7858), to(#cc3a3b)) !important;
			background: -moz-linear-gradient(top, #ff7858, #cc3a3b) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff7858', endColorstr='#cc3a3b') !important;
			border-color: #961a07 !important;
		}
		input.button-primary:active{
			background: #e6433d !important;
			border-color: #961a07 !important;
		}";
		
	}
	
	if ($pw_form_button_skin == 'syellow' or $pw_form_button_skin == 'ryellow'){
		if ($pw_form_button_skin == 'ryellow') {
			echo "
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}";
			
		}
		echo "
		input.button-primary{
			background: #f9e327 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#fceb4c), to(#ebd611)) !important;
			background: -moz-linear-gradient(top, #fceb4c, #ebd611) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fceb4c', endColorstr='#ebd611');
			border-color: #dcc700 #dcc700 #c2b00b !important;
			color: #444 !important;
			text-shadow: 0 1px 1px #ffff98 !important;
		}
		input.button-primary:hover, input.button-primary:focus{
			background: #ebd611 !important;
			background: -webkit-gradient(linear, left top, left bottom, from(#fffa58), to(#e1cd00)) !important;
			background: -moz-linear-gradient(top, #fffa58, #e1cd00) !important;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffa58', endColorstr='#e1cd00');
			border-color: #cebb10 !important;
		}
		input.button-primary:active{
			background: #f9e327 !important;
			border-color: #cebb10 !important;
		}";
		
	}

// button ios 7

	switch ($pw_form_button_skin){
		case 'iblue':
		echo "
			input.button-primary{
				background: #005aff !important;
				border:1px solid #005aff !important;
				color: #fff !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #2b75fc !important;
				border:1px solid #2b75fc !important;
				color: #fff !important;
			}
			input.button-primary:active{
				background: #296fef !important;
				border:1px solid #296fef !important;
				color: #fff !important;
			}";
		break;
		case 'iblack':
		echo "
			input.button-primary{
				background: #000000 !important;
				border:1px solid #000000 !important;
				color: #fff !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #424242 !important;
				border:1px solid #424242 !important;
				color: #fff !important;
			}
			input.button-primary:active{
				background: #2f2d2d !important;
				border:1px solid #2f2d2d !important;
				color: #fff !important;
			}";
		break;

		case 'igray':
		echo "
			input.button-primary{
				background: #5d5d5d !important;
				border:1px solid #5d5d5d !important;
				color: #fff !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #7f7e7e !important;
				border:1px solid #7f7e7e !important;
				color: #fff !important;
			}
			input.button-primary:active{
				background: #737171 !important;
				border:1px solid #737171 !important;
				color: #fff !important;
			}";
		break;
		case 'igreen':
		echo "
			input.button-primary{
				background: #00cf7f !important;
				border:1px solid #00cf7f !important;
				color: #fff !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #30c48b !important;
				border:1px solid #30c48b !important;
				color: #fff !important;
			}
			input.button-primary:active{
				background: #12ca83 !important;
				border:1px solid #12ca83 !important;
				color: #fff !important;
			}";
		break;
		case 'iorange':
		echo "
			input.button-primary{
				background: #ff6000 !important;
				border:1px solid #ff6000 !important;
				color: #fff !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #fd8943 !important;
				border:1px solid #fd8943 !important;
				color: #fff !important;
			}
			input.button-primary:active{
				background: #fe7a2a !important;
				border:1px solid #fe7a2a !important;
				color: #fff !important;
			}";
		break;
		case 'ipink':
		echo "
			input.button-primary{
				background: #ff2970 !important;
				border:1px solid #ff2970 !important;
				color: #fff !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #ff6b9c !important;
				border:1px solid #ff6b9c !important;
				color: #fff !important;
			}
			input.button-primary:active{
				background: #f74d86 !important;
				border:1px solid #f74d86 !important;
				color: #fff !important;
			}";
		break;
		case 'ipurple':
		echo "
			input.button-primary{
				background: #fd3ae8 !important;
				border:1px solid #fd3ae8 !important;
				color: #fff !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #fc76ee !important;
				border:1px solid #fc76ee !important;
				color: #fff !important;
			}
			input.button-primary:active{
				background: #f55ce5 !important;
				border:1px solid #f55ce5 !important;
				color: #fff !important;
			}";
		break;

		case 'iwhite':
		echo "
			input.button-primary{
				background: #c4c4c4 !important;
				border:1px solid #c4c4c4 !important;
				color: #fff !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #dedddd !important;
				border:1px solid #dedddd !important;
				color: #fff !important;
			}
			input.button-primary:active{
				background: #cdcaca !important;
				border:1px solid #cdcaca !important;
				color: #fff !important;
			}";
		break;

		case 'ired':
		echo "
			input.button-primary{
				background: #ff0000 !important;
				border:1px solid #ff0000 !important;
				color: #fff !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #fc4a4a !important;
				border:1px solid #fc4a4a !important;
				color: #fff !important;
			}
			input.button-primary:active{
				background: #f72929 !important;
				border:1px solid #f72929 !important;
				color: #fff !important;
			}";
		break;

		case 'tblue':
		echo "
			input.button-primary{
				background: #ffffff !important;
				border:1px solid #005aff !important;
				color: #005aff !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #ffffff !important;
				border:1px solid #3e82ff !important;
				color: #3e82ff !important;
			}
			input.button-primary:active{
				background: #ffffff !important;
				border:1px solid #2772fd !important;
				color: #2772fd !important;
			}";
		break;

		case 'tblack':
		echo "
			input.button-primary{
				background: #ffffff !important;
				border:1px solid #000000 !important;
				color: #000000 !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #ffffff !important;
				border:1px solid #3e3e3e !important;
				color: #3e3e3e !important;
			}
			input.button-primary:active{
				background: #ffffff !important;
				border:1px solid #2d2d2d !important;
				color: #2d2d2d !important;
			}";
		break;

		case 'tgray':
		echo "
			input.button-primary{
				background: #ffffff !important;
				border:1px solid #5d5d5d !important;
				color: #5d5d5d !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #ffffff !important;
				border:1px solid #8b8a8a !important;
				color: #8b8a8a !important;
			}
			input.button-primary:active{
				background: #ffffff !important;
				border:1px solid #797979 !important;
				color: #797979 !important;
			}";
		break;

		case 'tgreen':
		echo "
			input.button-primary{
				background: #ffffff !important;
				border:1px solid #00cf7f !important;
				color: #00cf7f !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #ffffff !important;
				border:1px solid #43dfa3 !important;
				color: #43dfa3 !important;
			}
			input.button-primary:active{
				background: #ffffff !important;
				border:1px solid #1bce89 !important;
				color: #1bce89 !important;
			}";
		break;

		case 'torange':
		echo "
			input.button-primary{
				background: #ffffff !important;
				border:1px solid #ff6000 !important;
				color: #ff6000 !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #ffffff !important;
				border:1px solid #fd8a44 !important;
				color: #fd8a44 !important;
			}
			input.button-primary:active{
				background: #ffffff !important;
				border:1px solid #fa7626 !important;
				color: #fa7626 !important;
			}";
		break;

		case 'tpink':
		echo "
			input.button-primary{
				background: #ffffff !important;
				border:1px solid #ff2970 !important;
				color: #ff2970 !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #ffffff !important;
				border:1px solid #fd689a !important;
				color: #fd689a !important;
			}
			input.button-primary:active{
				background: #ffffff !important;
				border:1px solid #fc528a !important;
				color: #fc528a !important;
			}";
		break;

		case 'tpurple':
		echo "
			input.button-primary{
				background: #ffffff !important;
				border:1px solid #fd3ae8 !important;
				color: #fd3ae8 !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #ffffff !important;
				border:1px solid #fe77ef !important;
				color: #fe77ef !important;
			}
			input.button-primary:active{
				background: #ffffff !important;
				border:1px solid #f760e7 !important;
				color: #f760e7 !important;
			}";
		break;

		case 'tred':
		echo "
			input.button-primary{
				background: #ffffff !important;
				border:1px solid #ff0000 !important;
				color: #ff0000 !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #ffffff !important;
				border:1px solid #fe6060 !important;
				color: #fe6060 !important;
			}
			input.button-primary:active{
				background: #ffffff !important;
				border:1px solid #f62929 !important;
				color: #f62929 !important;
			}";
		break;

		case 'twhite':
		echo "
			input.button-primary{
				background: #ffffff !important;
				border:1px solid #c4c4c4 !important;
				color: #c4c4c4 !important;
				text-shadow: none;
				box-shadow: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
			}
			input.button-primary:hover, input.button-primary:focus{
				background: #ffffff !important;
				border:1px solid #dfdcdc !important;
				color: #dfdcdc !important;
			}
			input.button-primary:active{
				background: #ffffff !important;
				border:1px solid #d6d6d6 !important;
				color: #d6d6d6 !important;
			}";
		break;

	}

$pw_full_button	= get_option( 'pw_full_button' );
if($pw_full_button=="true"){
	echo "
	#wp-submit {
	display: block;
	left: 5px;
	position: relative;
	width: 100%;
	height: 40px;
	font-size:16px !important;
	}
	";
}else{
	echo "
	#wp-submit {
	font-size:14px !important;
	height: 40px;
	
	}
	";

}
echo "

.login #nav, .login #backtoblog {

    margin : 15px 0 0 0 !important;
	padding : 0;
	position : absolute;
	width : ". $pw_form_width ."px !important;
	color : ". $pw_form_lost_color ." !important;
	text-align: center !important;
}
.login #backtoblog {
margin: 35px 0 0px !important;
text-decoration: underline;

}
.login #nav a, .login #backtoblog a {
	color : ". $pw_form_lost_color ." !important;
	text-decoration : none;
	font-size : 12px !important;
	text-shadow: 0 0 0 #000  !important;
}

.login #nav a:hover, .login #backtoblog a:hover {
	color : ". $pw_form_lost_color_hover ." !important;
}

.login #nav a{
text-decoration: underline;
}
/*-----------------------------------------------------------------------------------*/
/*	4.	Copyright
/*-----------------------------------------------------------------------------------*/";

echo "
#pw-copyright{
/*	position : absolute !important;*/
	font-size : 11px !important;	
	margin-top:10px;
	/*margin : "; echo $pw_form_padding['padding_bottom']+40; echo "px 0 0 -"; echo $pw_form_padding['padding_left']-3; echo "px;*/
	text-align: center !important;
	color : ". $pw_style_copyright_color ." !important;
	width : ". $pw_form_width ."px !important;
	text-decoration : none !important;
}

#pw-copyright a{
	color : ". $pw_style_copyright_a_color ." !important;
	text-decoration : none !important;
}

#pw-copyright a:hover{
	color : ". $pw_style_copyright_a_color_hover ." !important;
}

/*-----------------------------------------------------------------------------------*/
/*	5.	Notifications
/*-----------------------------------------------------------------------------------*/

div.updated, .login .message {
	margin: 12px 0 13px;
	font-size : 11px;
	text-align: center;
	line-height:15px;
	background: #f3eb90;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbf4a2), to(#ebe27f));
	background: -moz-linear-gradient(top, #fbf4a2, #ebe27f);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fbf4a2', endColorstr='#ebe27f');
	border-color: #f5e121 #f5e121 #e0cc10;
	color: #444;
	text-shadow: 0 1px 1px #ffff98;
	-webkit-box-shadow: 0 1px 2px #e9e3a4, inset 0 1px 0 #fee795;
	-moz-box-shadow: 0 1px 2px #e9e3a4, inset 0 1px 0 #fee795;
	box-shadow: 0 1px 2px #e9e3a4, inset 0 1px 0 #fee795;    
}

div.error, .login #login_error {
	margin: 12px 0 13px;
	font-size : 11px;
	text-align: center;
	line-height:15px;
	background: #f3eb90;
	background: -webkit-gradient(linear, left top, left bottom, from(#f9a89f), to(#eb8b80));
	background: -moz-linear-gradient(top, #f9a89f, #eb8b80);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9a89f', endColorstr='#eb8b80');
	border-color: #f53a21 #f53a21 #e03210;
	color: #444;
	text-shadow: 0 1px 1px #ff9898;
	-webkit-box-shadow: 0 1px 2px #e8afaf, inset 0 1px 0 #ffaaaa;
	-moz-box-shadow: 0 1px 2px #e8afaf, inset 0 1px 0 #ffaaaa;
	box-shadow: 0 1px 2px #e8afaf, inset 0 1px 0 #ffaaaa;
}

.login #login_error a { color : #565656; }

.login #login_error a:hover { color : #393939; }
.divlabel{
	display:none;

}
/*-----------------------------------------------------------------------------------*/
/*	7.	Sosial Media
/*-----------------------------------------------------------------------------------*/

#login > div.socmed {
	display: block;
	text-align: center;
	margin-top: 10px;
}
#login > div.socmed li {
	display: inline-block;
	text-align: center;
	font-size: 14px;
	color: #ffffff;
}
#login > div.socmed li a:hover {
";

	$pw_social_color_hover		= get_option( 'pw_social_color_hover' );
	echo"color: ".$pw_social_color_hover.";
}
#login > div.socmed li a {
	width: 24px;
	height: 24px;
	display: block;";

$pw_social_color		= get_option( 'pw_social_color' );
	echo"color: ".$pw_social_color.";
		text-decoration: none;
		-webkit-transition: all 0.4s ease-in-out;
		-moz-transition: all 0.4s ease-in-out;
		-ms-transition: all 0.4s ease-in-out;
		-o-transition: all 0.4s ease-in-out;
		transition: all 0.4s ease-in-out;
		margin: 5px;
}
#login > div.socmed li a i {
	font-size: 18px;
}
/*-----------------------------------------------------------------------------------*/
/*	6.	CSS Custom
/*-----------------------------------------------------------------------------------*/

". $pw_style_css ."";
echo "</style>";
	
	?>
	
	    <script type="text/javascript" src="<?php echo PW_FILEPATH; ?>/admin/js/jquery.min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                //remove h1 style
                $('h1 a').removeClass('h1 a').addClass('bg_pw');
                
                if ($('#user_email').attr('type') == 'email') {
                    $('#user_email').css('width',$('#user_login').width());
                }
                <?php
					$pw_show_label		= get_option( 'pw_show_label' );
					if( $pw_show_label == "false"){
                ?>
                	// username LABEL
				    var tmp1 = jQuery("label[for='user_login']").html();
				    jQuery("label[for='user_login']").html('<div class="divlabel">' + tmp1.replace('<br>', '</div>'));
                	// password LABEL
				    var tmp2 = jQuery("label[for='user_pass']").html();
				    jQuery("label[for='user_pass']").html('<div class="divlabel">' + tmp2.replace('<br>', '</div>'));
            	<?php
				}
            	?>
            		// add placeholder
                	jQuery("#user_login").attr("placeholder","Username");
           			jQuery("#user_pass").attr("placeholder","Password");
                <?php
					$pw_show_remember	= get_option( 'pw_show_remember' );
					if( $pw_show_remember == "false"){
                ?>
	// hide forgot password
                
                	jQuery(".forgetmenot").hide();
				<?php } ?>
					jQuery("#nav").prepend('<span style="text-decoration:none;"><img src="<?php echo PW_FILEPATH; ?>/admin/images/icons/forgot.png" width="8">&nbsp;<span>');
              //add footer  	
				<?php
				$pw_url_twitter		= get_option( 'pw_url_twitter' );
				$pw_url_facebook	= get_option( 'pw_url_facebook' );
				$pw_url_google		= get_option( 'pw_url_google' );
				$pw_url_dribble		= get_option( 'pw_url_dribble' );
				$pw_url_linkedin	= get_option( 'pw_url_linkedin' );
				$pw_url_youtube		= get_option( 'pw_url_youtube' );
				$pw_url_pinterest		= get_option( 'pw_url_pinterest' );
				$strsosmed='<div class="socmed"><ul>';
				if($pw_url_twitter!=""){
					$strsosmed.='<li><a href="'.$pw_url_twitter.'"><i class="icon fa fa-twitter"></i></a></li>';
				}
				if($pw_url_facebook!=""){
					$strsosmed.='<li><a href="'.$pw_url_facebook.'"><i class="icon fa fa-facebook"></i></a></li>';
				}
				if($pw_url_google!=""){
					$strsosmed.='<li><a href="'.$pw_url_google.'"><i class="icon fa fa-google-plus"></i></a></li>';
				}
				if($pw_url_dribble!=""){
					$strsosmed.='<li><a href="'.$pw_url_dribble.'"><i class="icon fa fa-dribbble"></i></a></li>';
				}
				if($pw_url_linkedin!=""){
					$strsosmed.='<li><a href="'.$pw_url_linkedin.'"><i class="icon fa fa-linkedin"></i></a></li>';
				}
				if($pw_url_youtube!=""){
					$strsosmed.='<li><a href="'.$pw_url_youtube.'"><i class="icon fa fa-youtube"></i></a></li>';
				}
				if($pw_url_pinterest!=""){
					$strsosmed.='<li><a href="'.$pw_url_pinterest.'"><i class="icon fa fa-pinterest"></i></a></li>';
				}
				$strsosmed.='</ul></div>';
?>
				jQuery("#loginform").after('<?php echo $strsosmed;?>');
			    
		<?php
				// add copyright
				$pw_style_copyright		= get_option( 'pw_style_copyright' );
				if(trim($pw_style_copyright)!=""){
					function escapes($str)
			        {
			                $search=array("\\","\0","\n","\r","\x1a","'",'"');
			                $replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
			                return str_replace($search,$replace,$str);
			        }
			      $copyright_content='<div id="pw-copyright">'. nl2br(escapes($pw_style_copyright)) .'</div>';
			      ?>
				
					jQuery("#loginform").after('<?php echo $copyright_content;?>');
			      <?php }?>

            });

        </script>
	<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Custom login_form action - pw_theme_foot
/*-----------------------------------------------------------------------------------*/

function pw_theme_foot()
{
	echo " ";  
}


/*-----------------------------------------------------------------------------------*/
/*	Custom lostpassword_form action - pw_theme_lostpassword
/*-----------------------------------------------------------------------------------*/

function pw_theme_lostpassword()
{
	$pw_form_width			= get_option( 'pw_form_width' ); // OK
	$pw_form_padding		= get_option( 'pw_form_padding' ); // OK
	
	
}

?>