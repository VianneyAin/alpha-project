<?php
/**
 * Style Config
 */
 
header("Content-type: text/css");

if(file_exists('../../../../wp-load.php')) :
	include '../../../../wp-load.php';
else:
	include '../../../../../wp-load.php';
endif; 

ob_flush(); 
?>

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
/*-----------------------------------------------------------------------------------*/
<?php 
	// Get Option 
	$pw_options				= get_option( 'pw_options' ); // OK
	
	/* ON THEME RESET */
	if (empty($pw_options))
	{
		ob_end_flush(); 
		die(); 
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

?>

/*-----------------------------------------------------------------------------------*/
/*	1.	Document Setup (body)
/*-----------------------------------------------------------------------------------*/

html{
	background:none !important;
	background-color: transparent;
}

body {
	font:13px/20px "Helvetica Neue", Helvetica, Arial, sans-serif;
	cursor: default;
	padding-top: 0 !important;
	
	background-image: url( <?php echo $pw_style_bg_img; ?> ) !important;
	/*background-size: 100%;*/
	background-color:  <?php echo $pw_style_bg_color; ?> !important;
	background-position:  <?php echo $pw_style_bg_pr['position_1']." ".$pw_style_bg_pr['position_2']; ?> !important;
	background-repeat:  <?php echo $pw_style_bg_pr['repeat']; ?> !important;
}

html, body {
    height: auto;
}

#backtoblog { display : none; }

div.updated, .login .message { margin: 0 0 16px 0; }

/*-----------------------------------------------------------------------------------*/
/*	2.	Header Styles (login logo)
/*-----------------------------------------------------------------------------------*/

#login {
    padding: 0;
    width : <?php echo $pw_form_width."px"; ?> !important;
}

.login #login h1{
	<?php if ($pw_head_bg_color != "none") {?>
	background-image: url( <?php echo $pw_head_bg_img; ?> ) !important;
	background-color:  <?php echo $pw_head_bg_color; ?> !important;
	background-position:  <?php echo $pw_head_bg_pr['position_1']." ".$pw_head_bg_pr['position_2']; ?> !important;
	background-repeat:  <?php echo $pw_head_bg_pr['repeat']; ?> !important;
	<?php } else { ?>
	background:none !important;
	background-color: transparent;
	background-image: url( <?php echo $pw_head_bg_img; ?> ) !important;
	<?php } ?>
}

h1 a {
	width : <?php echo $pw_form_width; ?>px !important;
	height : <?php echo $pw_head_logo_height; ?>px !important;
	padding-bottom : 0px !important;
	background-image: url( <?php echo $pw_head_logo_img; ?> ) !important;	
}

.bg_pw{
	width : <?php echo $pw_form_width; ?>px !important;
	height : <?php echo $pw_head_logo_height; ?>px !important;
	padding-bottom : 0px !important;
	background-image: url( <?php echo $pw_head_logo_img; ?> ) !important;	
}

/*-----------------------------------------------------------------------------------*/
/*	3.	Form Styles (form, field, button, etc)
/*-----------------------------------------------------------------------------------*/

.login form {
	margin-left: 0;
	padding : <?php echo $pw_form_padding['padding_top']."px ".$pw_form_padding['padding_right']."px ".$pw_form_padding['padding_bottom']."px ".$pw_form_padding['padding_left']."px"; ?> !important;
	
	<?php if ($pw_form_bg_color != "none") {?>
	background-image: url( <?php echo $pw_form_bg_img; ?> ) !important;
	background-color:  <?php echo $pw_form_bg_color; ?> !important;
	background-position:  <?php echo $pw_form_bg_pr['position_1']." ".$pw_form_bg_pr['position_2']; ?> !important;
	background-repeat:  <?php echo $pw_form_bg_pr['repeat']; ?> !important;
	<?php } else { ?>
	background:none !important;
	background-color: transparent;
	background-image: url( <?php echo $pw_form_bg_img; ?> ) !important;
	<?php } ?>
	
	-webkit-border-radius: <?php echo $pw_form_radius; ?>px !important;
	-moz-border-radius: <?php echo $pw_form_radius; ?>px !important;
	border-radius: <?php echo $pw_form_radius; ?>px !important;
	
	border : <?php echo $pw_form_border['width']."px ".$pw_form_border['style']." ".$pw_form_border['color']; ?> !important;
	
	-moz-box-shadow: <?php echo $pw_form_shadow['style']." ".$pw_form_shadow['horizontal']."px ".$pw_form_shadow['vertical']."px ".$pw_form_shadow['blur']."px ".$pw_form_shadow['spread']."px ".$pw_form_shadow['color']; ?> !important;
	-webkit-box-shadow: <?php echo $pw_form_shadow['style']." ".$pw_form_shadow['horizontal']."px ".$pw_form_shadow['vertical']."px ".$pw_form_shadow['blur']."px ".$pw_form_shadow['spread']."px ".$pw_form_shadow['color']; ?> !important;
	box-shadow: <?php echo $pw_form_shadow['style']." ".$pw_form_shadow['horizontal']."px ".$pw_form_shadow['vertical']."px ".$pw_form_shadow['blur']."px ".$pw_form_shadow['spread']."px ".$pw_form_shadow['color']; ?> !important;
}

.login label {
	color : <?php echo $pw_form_label_color; ?> !important;
	font-weight: bold;
	font-size : 14px !important;
	text-align: left !important;
}

body form .input, #user_pass, #user_login, #user_email {
/*	width :  <?php echo $pw_form_width-($pw_form_padding['padding_left']+$pw_form_padding['padding_right']+32); ?>px !important; */
	color : <?php echo $pw_form_text_color; ?> ;
	font-size : 14px !important;
	padding : 11px 13px 10px 13px !important;
	margin-top : 7px  !important;
	
	-webkit-border-radius: <?php echo $pw_form_field_radius; ?>px ;
	-moz-border-radius: <?php echo $pw_form_field_radius; ?>px ;
	border-radius: <?php echo $pw_form_field_radius; ?>px ;
	
	background-color:  <?php echo $pw_form_field_bg_color; ?> ;
	
	border : <?php echo $pw_form_field_border['width']."px ".$pw_form_field_border['style']." ".$pw_form_field_border['color']; ?> ;
	
	-moz-box-shadow: <?php echo $pw_form_field_shadow['style']." ".$pw_form_field_shadow['horizontal']."px ".$pw_form_field_shadow['vertical']."px ".$pw_form_field_shadow['blur']."px ".$pw_form_field_shadow['spread']."px ".$pw_form_field_shadow['color']; ?> ;
	-webkit-box-shadow: <?php echo $pw_form_field_shadow['style']." ".$pw_form_field_shadow['horizontal']."px ".$pw_form_field_shadow['vertical']."px ".$pw_form_field_shadow['blur']."px ".$pw_form_field_shadow['spread']."px ".$pw_form_field_shadow['color']; ?> ;
	box-shadow: <?php echo $pw_form_field_shadow['style']." ".$pw_form_field_shadow['horizontal']."px ".$pw_form_field_shadow['vertical']."px ".$pw_form_field_shadow['blur']."px ".$pw_form_field_shadow['spread']."px ".$pw_form_field_shadow['color']; ?> ;
        display: block;
}

body form .input:focus, body form .input:active  {
	background-color:  <?php echo $pw_form_field_bg_color_hover; ?> !important;
	
	border : <?php echo $pw_form_field_border_hover['width']."px ".$pw_form_field_border_hover['style']." ".$pw_form_field_border_hover['color']; ?> !important;
	
	-moz-box-shadow: <?php echo $pw_form_field_shadow_hover['style']." ".$pw_form_field_shadow_hover['horizontal']."px ".$pw_form_field_shadow_hover['vertical']."px ".$pw_form_field_shadow_hover['blur']."px ".$pw_form_field_shadow_hover['spread']."px ".$pw_form_field_shadow_hover['color']; ?> !important;
	-webkit-box-shadow: <?php echo $pw_form_field_shadow_hover['style']." ".$pw_form_field_shadow_hover['horizontal']."px ".$pw_form_field_shadow_hover['vertical']."px ".$pw_form_field_shadow_hover['blur']."px ".$pw_form_field_shadow_hover['spread']."px ".$pw_form_field_shadow_hover['color']; ?> !important;
	box-shadow: <?php echo $pw_form_field_shadow_hover['style']." ".$pw_form_field_shadow_hover['horizontal']."px ".$pw_form_field_shadow_hover['vertical']."px ".$pw_form_field_shadow_hover['blur']."px ".$pw_form_field_shadow_hover['spread']."px ".$pw_form_field_shadow_hover['color']; ?> !important;
}

form .forgetmenot {
	margin-top : 20px;
}

form .forgetmenot label {
	font-size : 12px !important;
	color : <?php echo $pw_form_remember_color; ?> !important;
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
	padding: 8px 21px !important;
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
}<?php
if ($pw_form_button_skin == 'rwhite') {
?>
	input.button-primary{
		padding: 8px 21px !important;
		-webkit-border-radius: 15px !important;
		-moz-border-radius: 15px !important;
		border-radius: 15px !important;
	}
<?php
}
?>

input.button-primary{
	*width: auto; /* IE7 Fix */
	*overflow: visible; /* IE7 Fix */
}

<?php
	if ($pw_form_button_skin == 'sblue' or $pw_form_button_skin == 'rblue'){
		if ($pw_form_button_skin == 'rblue') {
			?>
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}
			<?php
		}
		?>
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
		}
		<?php
	}

	if ($pw_form_button_skin == 'sbl' or $pw_form_button_skin == 'rbl'){
		if ($pw_form_button_skin == 'rbl') {
			?>
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}
			<?php
		}
		?>
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
		}
		<?php
	}
	
	if ($pw_form_button_skin == 'sgray' or $pw_form_button_skin == 'rgray'){
		if ($pw_form_button_skin == 'rgray') {
			?>
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}
			<?php
		}
		?>
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
		}
		<?php
	}
	
	if ($pw_form_button_skin == 'sgreen' or $pw_form_button_skin == 'rgreen'){
		if ($pw_form_button_skin == 'rgreen') {
			?>
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}
			<?php
		}
		?>
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
		}
		<?php
	}
	
	if ($pw_form_button_skin == 'slightblue' or $pw_form_button_skin == 'rlightblue'){
		if ($pw_form_button_skin == 'rlightblue') {
			?>
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}
			<?php
		}
		?>
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
		}
		<?php
	}
	
	if ($pw_form_button_skin == 'sorange' or $pw_form_button_skin == 'rorange'){
		if ($pw_form_button_skin == 'rorange') {
			?>
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}
			<?php
		}
		?>
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
		}
		<?php
	}
	
	if ($pw_form_button_skin == 'spink' or $pw_form_button_skin == 'rpink'){
		if ($pw_form_button_skin == 'rpink') {
			?>
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}
			<?php
		}
		?>
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
		}
		<?php
	}
	
	if ($pw_form_button_skin == 'spurple' or $pw_form_button_skin == 'rpurple'){
		if ($pw_form_button_skin == 'rpurple') {
			?>
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}
			<?php
		}
		?>
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
		}
		<?php
	}
	
	if ($pw_form_button_skin == 'sred' or $pw_form_button_skin == 'rred'){
		if ($pw_form_button_skin == 'rred') {
			?>
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}
			<?php
		}
		?>
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
		}
		<?php
	}
	
	if ($pw_form_button_skin == 'syellow' or $pw_form_button_skin == 'ryellow'){
		if ($pw_form_button_skin == 'ryellow') {
			?>
			input.button-primary{
				padding: 8px 21px !important;
				-webkit-border-radius: 15px !important;
				-moz-border-radius: 15px !important;
				border-radius: 15px !important;
			}
			<?php
		}
		?>
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
		}
		<?php
	}

?>

.login #nav, .login #backtoblog {
	
	/*
	margin-left : <?php echo $pw_form_width-$pw_form_padding['padding_right']-125; ?>px;
    margin-top : -<?php echo $pw_form_padding['padding_bottom']+82; ?>px;
	*/
	
    margin : 15px 0 0 0 !important;
	padding : 0;
	position : absolute;
	width : <?php echo $pw_form_width; ?>px !important;
	color : <?php echo $pw_form_lost_color; ?> !important;
	text-align: center !important;
}

.login #nav a, .login #backtoblog a {
	color : <?php echo $pw_form_lost_color; ?> !important;
	text-decoration : none;
	font-size : 12px !important;
	text-shadow: 0 0 0 #000  !important;
}

.login #nav a:hover, .login #backtoblog a:hover {
	color : <?php echo $pw_form_lost_color_hover; ?> !important;
}

/*-----------------------------------------------------------------------------------*/
/*	4.	Copyright
/*-----------------------------------------------------------------------------------*/

#pw-copyright{
	/*margin-top : <?php echo $pw_form_padding['padding_bottom']+20; ?>px !important;*/
	/*margin-left : -<?php echo $pw_form_padding['padding_left']; ?>px !important;*/
	position : absolute !important;
	font-size : 11px !important;	
	margin : <?php echo $pw_form_padding['padding_bottom']+40; ?>px 0 0 -<?php echo $pw_form_padding['padding_left']-3; ?>px;
	text-align: center !important;
	color : <?php echo $pw_style_copyright_color; ?> !important;
	width : <?php echo $pw_form_width; ?>px !important;
	text-decoration : none !important;
}

#pw-copyright a{
	color : <?php echo $pw_style_copyright_a_color; ?> !important;
	text-decoration : none !important;
}

#pw-copyright a:hover{
	color : <?php echo $pw_style_copyright_a_color_hover; ?> !important;
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

/*-----------------------------------------------------------------------------------*/
/*	6.	CSS Custom
/*-----------------------------------------------------------------------------------*/

<?php echo $pw_style_css; ?>

<?php ob_end_flush(); ?>