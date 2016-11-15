<?php


/*----------------------------------------------------------------------------------------------------------
	LOAD CSS STYLES FROM THEME OPTIONS AND CUSTOM CSS
-----------------------------------------------------------------------------------------------------------*/

	function gameleon_generated_styles() {

	global $smof_data;
	$td_widgets_style = gameleon_get_option( 'td_widgets_style' );

	$css = '<style type="text/css">';

/*----------------------------------------------------
	Boddy Typography
-----------------------------------------------------*/

	// Boddy font family
	if( !empty( $smof_data['td_body_font_family'] ) and $smof_data['td_body_font_family'] != 'none' ) {
	$css .= 'body{font-family:'. esc_html( $smof_data['td_body_font_family']) .';}';
	}
	// Boddy font size
	if( !empty( $smof_data['td_body_font_size'] ) and $smof_data['td_body_font_size'] != '14' ) {
	$css .= 'body{font-size:'. absint( $smof_data['td_body_font_size']) .'px;}';
	}
	// Boddy font style
	if( !empty( $smof_data['td_body_font_style'] ) ) {
	$css .= 'body{font-style:'. esc_html( $smof_data['td_body_font_style']) .';}';
	}
	// Boddy font weight
	if( !empty( $smof_data['td_body_font_weight'] ) ) {
	$css .= 'body{font-weight:'. esc_html( $smof_data['td_body_font_weight']) .';}';
	}
	// Boddy line height
	if( !empty( $smof_data['td_body_line_height'] ) and $smof_data['td_body_line_height'] != '21' ) {
	$css .= 'body{line-height:'. absint( $smof_data['td_body_line_height']) .'px;}';
	}

/*----------------------------------------------------
	Main menu Typography
-----------------------------------------------------*/

	// Main Menu font family
	if( !empty( $smof_data['td_main_menu_font_family'] ) and $smof_data['td_main_menu_font_family'] != 'none' ) {
	$css .= '.menu a{font-family:'. esc_html( $smof_data['td_main_menu_font_family'] ) .';}';
	}
	// Main Menu font size
	if( !empty( $smof_data['td_main_menu_font_size'] ) and $smof_data['td_main_menu_font_size'] != '16' ) {
	$css .= '.menu a{font-size:'. absint( $smof_data['td_main_menu_font_size'] ) .'px;}';
	}
	// Main Menu font style
	if( !empty( $smof_data['td_main_menu_font_style'] ) ) {
	$css .= '.menu a{font-style:'. esc_html( $smof_data['td_main_menu_font_style'] ) .';}';
	}
	// Main Menu font weight
	if( !empty( $smof_data['td_main_menu_font_weight'] ) ) {
	$css .= '.menu a{font-weight:'. esc_html( $smof_data['td_main_menu_font_weight'] ) .';}';
	}
	// Main Menu text transform
	if( !empty( $smof_data['td_main_menu_text_transform'] ) and $smof_data['td_main_menu_text_transform'] != 'none'  ) {
	$css .= '.menu a{text-transform:'. esc_html( $smof_data['td_main_menu_text_transform'] ) .';}';
	}

/*----------------------------------------------------
	Widgets Typography
-----------------------------------------------------*/

	// Widgets font family
	if( !empty( $smof_data['td_widgets_font_family'] ) and $smof_data['td_widgets_font_family'] != 'none' ) {
	$css .= '.widget-title h1, .widget-title h3 {font-family:'. esc_html( $smof_data['td_widgets_font_family'] ) .';}';
	}
	// Widgets font size
	if( !empty( $smof_data['td_widgets_font_size'] ) and $smof_data['td_widgets_font_size'] != '18' ) {
	$css .= '.widget-title h1, .widget-title h3 {font-size:'. absint( $smof_data['td_widgets_font_size'] ) .'px;}';
	}
	// Widgets font style
	if( !empty( $smof_data['td_widgets_font_style'] ) ) {
	$css .= '.widget-title h1, .widget-title h3 {font-style:'. esc_html( $smof_data['td_widgets_font_style'] ) .';}';
	}
	// Widgets font weight
	if( !empty( $smof_data['td_widgets_font_weight'] ) ) {
	$css .= '.widget-title h1, .widget-title h3 {font-weight:'. esc_html( $smof_data['td_widgets_font_weight'] ) .';}';
	}
	// Widgets font height
	if( !empty( $smof_data['td_widgets_line_height'] ) and $smof_data['td_widgets_line_height'] != '30' ) {
	$css .= '.widget-title h1, .widget-title h3 {line-height:'. absint( $smof_data['td_widgets_line_height'] ) .'px;}';
	}
	// Widgets text transform
	if( !empty( $smof_data['td_widgets_text_transform'] ) and $smof_data['td_widgets_text_transform'] != 'none'  ) {
	$css .= '.widget-title h1, .widget-title h3 {text-transform:'. esc_html( $smof_data['td_widgets_text_transform'] ) .';}';
	}

/*----------------------------------------------------
	Fly In Effect
-----------------------------------------------------*/
	if( gameleon_get_option( 'td_fly_in' ) == 0 ) {
	$css .= '.td-fly-in-effect{-webkit-animation: none; -moz-animation: none; animation: none;}';
	}
/*----------------------------------------------------
	Colors
-----------------------------------------------------*/
	// Top menu border color
	if( gameleon_get_option( 'td_top_menu_border' ) == 0 ) {
	$css .= '.top-menu{border:none;}';
	}

	if( !empty( $smof_data['td_theme_color'] ) ) {
	$css .= '.top-menu{border-bottom: 4px solid '. esc_html( $smof_data['td_theme_color'] ) .';}';
	}

/*----------------------------------------------------
	Header top & bottom margin
-----------------------------------------------------*/
	$overall_display = gameleon_get_option( 'td_overall_display' );
	if( gameleon_get_option( 'td_header_top_margin' ) != 0 ) {
	$css .= '#header{margin-top:'. absint( $smof_data['td_header_top_margin'] ) .'px;}';
	}
	if( gameleon_get_option( 'td_header_bottom_margin' ) != 40  ) {
	$css .= '#header{margin-bottom:'. absint( $smof_data['td_header_bottom_margin'] ) .'px;}';
	}

/*----------------------------------------------------
	News ticker margin
-----------------------------------------------------*/
	if( gameleon_get_option( 'td_newsticker_top_margin' ) != 0 ) {
	$css .= '.modern-ticker{margin-top:'. absint( $smof_data['td_newsticker_top_margin'] ) .'px;}';
	}
	if( gameleon_get_option( 'td_newsticker_bottom_margin' ) != 0 ) {
	$css .= '.modern-ticker{margin-bottom:'. absint( $smof_data['td_newsticker_bottom_margin'] ) .'px;}';
	}


/*----------------------------------------------------
	Games Options
-----------------------------------------------------*/
	$td_progressbar = gameleon_get_option( 'td_enable_progress_bar' );
	if ( $td_progressbar ) {
		$css .= '#td-game-wrap{width:0; height: 0;}';
	 } else {
	 	$css .= '#td-game-wrap{width:100%}';
	 }

/*----------------------------------------------------
	Colors
-----------------------------------------------------*/
	// Overall Theme Color
	if( !empty( $smof_data['td_theme_color'] ) ) {
		$css .= '.menu a:hover,
		a.button, input[type="reset"], input[type="button"], input[type="submit"],
		.front-page .menu .current_page_item a,
		.menu .current_page_item a,
		.menu .current-menu-item a,
		#td-home-tabs .tabs-wrapper li.active a:hover,
		ul.nd_tabs li:hover,
		.td-admin-links .links li a,
		.nd_recently_viewed .links li a,
		form.nd_form input.button,
		.dropcap,
		#gametabs li.active a,
		.colophon-module,
		#commentform a.button,
		#commentform input[type="reset"],
		#commentform input[type="button"],
		#commentform input[type="submit"],
		.td-owl-date,
		.feedburner-subscribe,
		.wp-pagenavi span.current,
		.td-tag-cloud-widget a,
		#td-searchsubmit,
		.cat-links a,
		.gamesnumber,
		.review-percentage .review-item span span,
		#progressbarloadbg,
		.scroll-up,
		.modern-ticker,
		.mt-news,
		main-byline a,
		.header-inner h1 a,
		#td-home-tabs .tabs-wrapper li.active a,
		.scroll-down,
		.td-social-counters li,
		.td-video-wrapp .td-embed-description .video-post-title span,
		.qtip-default,
		#td-social-tabs .tabs-wrapper li.active a,
		#td-social-tabs .tabs-wrapper li.active a:hover,
		ul.nd_tabs li.active,
		#bbp_search_submit
		{background: '. esc_html( $smof_data['td_theme_color'] ) .';}';
	}

	if( !empty( $smof_data['td_theme_color'] ) ) {
		$css .= '
		#buddypress div.dir-search input[type="submit"],
		#buddypress #activate-page .standard-form input[type="submit"],
		#buddypress .message-search input[type="submit"],
		#buddypress .item-list-tabs ul li.selected a,
		#buddypress .generic-button a,
		#buddypress .submit input[type="submit"],
		#buddypress .ac-reply-content input[type="submit"],
		#buddypress .standard-form input[type="submit"],
		#buddypress .standard-form .button-nav .current a,
		#buddypress .standard-form .button,
		#buddypress input[type="submit"],
		#buddypress a.accept,
		#buddypress .standard-form #group-create-body input[type="button"]
		{background: '. esc_html( $smof_data['td_theme_color'] ) .'!important;}';
	}

	// wp-pagenavi
	if( !empty( $smof_data['td_theme_color'] ) ) {
	$css .= '.wp-pagenavi span.current{border: 1px solid '. esc_html( $smof_data['td_theme_color'] ) .';}';
	}

	// more artivles arrow
	if( !empty( $smof_data['td_theme_color'] ) ) {
	$css .= '
	#buddypress .groups .item-meta,
	.moregames-link:after,
	#review-box .review-final-score h3,
	#review-box .review-final-score h4,
	.widget_categories .current-cat a,
	.review-box,
	.bbp-forum-title
	{color:'. esc_html( $smof_data['td_theme_color'] ) .';}';
	}

	// likes
	if( !empty( $smof_data['td_theme_color'] ) ) {
	$css .= '
	.dot-irecommendthis:hover,
	.dot-irecommendthis.active {color:'. esc_html( $smof_data['td_theme_color'] ) .'!important;}';
	}

	// footer bottom top border
	if( !empty( $smof_data['td_theme_color'] ) ) {
    $css .= '#footer {border-top: 2px solid '. esc_html( $smof_data['td_theme_color'] ) .';}';
	}

	// Selection background color
	if( !empty( $smof_data['td_theme_color'] ) ) {
	$css .= '::-moz-selection{background:'. esc_html( $smof_data['td_theme_color'] ) .';}';
	$css .= '::selection{background:'. esc_html( $smof_data['td_theme_color'] ) .';}';
	$css .= '::-webkit-selection{background:'. esc_html( $smof_data['td_theme_color'] ) .';}';
	}

	// Boddy text color
	if( !empty( $smof_data['td_body_text_color'] ) ) {
	$css .= 'body{color:'. esc_html( $smof_data['td_body_text_color']) .';}';
	}
	// Body links color
	if( !empty( $smof_data['td_links_color'] ) ) {
	$css .= 'a{color:'. esc_html( $smof_data['td_links_color'] ) .';}';
	}
	// Body links hover color
	if( !empty( $smof_data['td_links_hover_color'] ) ) {
	$css .= 'a:hover{color:'. esc_html( $smof_data['td_links_hover_color'] ) .';}';
	}
	// Menu Background color
	if( !empty( $smof_data['td_main_menu_bg'] ) ) {
	$css .= '.menu {background-color:'. esc_html( $smof_data['td_main_menu_bg'] ) .';}';
	}
	// Main Menu links color
	if( !empty( $smof_data['td_main_menu_links_color'] ) ) {
	$css .= '.menu li a {color:'. esc_html( $smof_data['td_main_menu_links_color'] ) .';}';
	}
	// Body background color
	if( !empty( $smof_data['td_body_background'] ) ) {
	$css .= 'body{background-color:'. esc_html( $smof_data['td_body_background'] ) .';}';
	}
	// Logo text color
	if( !empty( $smof_data['td_logo_color'] ) ) {
	$css .= '.header-inner h1 a {color: '. esc_html( $smof_data['td_logo_color'] ) .';}';
	}
	// Widgets Title Background Color
	if( !empty( $smof_data['td_headings_bg_color'] ) ) {
	$css .= '.widget-title, #td-home-tabs .tabs-wrapper li.active a, #td-home-tabs .tabs-wrapper li.active a:hover, #td-social-tabs .tabs-wrapper li.active a, #td-social-tabs .tabs-wrapper li.active a:hover, ul.nd_tabs li.active {background-color:'. esc_html( $smof_data['td_headings_bg_color'] ) .';}';

	}
	// Widgets Title Color
	if( !empty( $smof_data['td_headings_color'] ) ) {
	$css .= '.widget-title h1, .widget-title h1 a, .widget-title h3, .widget-title h3 a {color:'. esc_html( $smof_data['td_headings_color'] ) .';}';
	}

	// Footer menu links color
	if( !empty( $smof_data['td_footer_menu_links_color'] ) ) {
	$css .= '.footer-menu li a{color: '. esc_html( $smof_data['td_footer_menu_links_color'] ) .';}';
	}
	// Footer menu hover links color
	if( !empty( $smof_data['td_footer_menu_hover_links_color'] ) ) {
	$css .= '.footer-menu li a:hover{color: '. esc_html( $smof_data['td_footer_menu_hover_links_color'] ) .';}';
	}

/*----------------------------------------------------
	Body background
-----------------------------------------------------*/
	// Body background image
	if( !empty( $smof_data['td_background_image'] ) ) {
	$css .= 'body{background-image:url('. $smof_data['td_background_image'] .');}';
	}
	// Body background repeat
	if( !empty( $smof_data['td_background_repeat'] ) and $smof_data['td_background_repeat'] != 'no-repeat' ) {
	$css .= 'body{background-repeat:'. esc_html( $smof_data['td_background_repeat'] ) .';}';
	}
	// Body background position
	if( !empty( $smof_data['td_background_position'] ) ) {
	$css .= 'body{background-position:'. esc_html( $smof_data['td_background_position'] ) .';}';
	}
	// Body background attachment
	if( !empty( $smof_data['td_background_attachment'] ) and $smof_data['td_background_attachment'] != 'scroll' ) {
	$css .= 'body{background-attachment:'. esc_html( $smof_data['td_background_attachment'] ) .';}';
	}
/*----------------------------------------------------
	Widgets Styles
-----------------------------------------------------*/

	// Widgets style 3
	if( $td_widgets_style == 'td_style_2' ) {
	$css .= '.widget-title {background-color:transparent; margin: 10px 20px;}';

	$css .= '#content-arcade .widget-title h1 { padding: 4px 20px;}';
	$css .= '.td-game-buttons { right: 20px;}';
	$css .= '#content-arcade .widget-title {margin: 0;}';

	if( !empty( $smof_data['td_headings_bg_color'] ) ) {
	$css .= '.widget-title { border-bottom: 2px solid '. esc_html( gameleon_get_option( 'td_headings_bg_color' ) ) .';}';
	}

	$css .= '.widget-title h1, .widget-title h3 {margin: 0; padding:4px 0;}';
	$css .= '#widgets .widget-title h1, #widgets .widget-title h3 { padding:4px 0;}';
	$css .= '#widgets .widget-title {margin: -10px 0 20px;}';
	$css .= '#homepage-wrap .widget-title {margin: -10px 0px 20px 0;}';
	$css .= '.td-content-inner-no-comm  {border: none;}';
	$css .= '.td-content-inner-no-comm .widget-title {margin: 10px 0px 20px; border-bottom: 2px solid '. esc_html( gameleon_get_option( 'td_headings_bg_color' ) ) .';}';
	$css .= '#homepage-wrap .widget_tigu_home_module_1 .widget-title,
	#homepage-wrap .widget_tigu_home_module_2 .widget-title,
	#homepage-wrap .widget_tigu_home_module_3 .widget-title,
	#homepage-wrap .widget_tigu_home_module_4 .widget-title { margin: 10px 20px;}';
	$css .= '#td-home-tabs .tabs-wrapper .tabs ul {border-bottom: 2px solid '. esc_html( $smof_data['td_headings_bg_color'] ) .'; background-color: transparent;}';
	$css .= '#td-home-tabs .tabs-wrapper .tab-links a {background-color: transparent;}';
	$css .= 'ul.nd_tabs {background-color: transparent;}';
	$css .= '#td-social-tabs .tabs-wrapper .socialtabs ul, ul.nd_tabs {border-bottom: 2px solid '. esc_html( $smof_data['td_headings_bg_color'] ) .'; background-color: transparent;}';
	$css .= '#td-social-tabs .tabs-wrapper .tab-links a {background-color: transparent;}';
	}


/*----------------------------------------------------
	Next
-----------------------------------------------------*/


/*----------------------------------------------------------------------------------------------------------
	CUSTOM CSS STYLES FROM THEME OPTIONS - WILL OVERRIDE THE DEFAULT CSS OF THE THEME
-----------------------------------------------------------------------------------------------------------*/

	if( !empty( $smof_data['td_gameleon_inline_css'] ) ) {
		$css .= $smof_data['td_gameleon_inline_css'] . "\n";
	}

/*----------------------------------------------------
	Minify a bit the generated inline style
-----------------------------------------------------*/

	$css = str_replace( "\t", '', $css );
	$css = str_replace( array( "\n", "\r" ), '', $css );

/*----------------------------------------------------
	Echo the minified CSS
-----------------------------------------------------*/
$css .= '</style>';

echo $css; // echo the final compiled css - minified

}

// if Speed Booster Pack plugin is active and css to footer option is checked , we will render the inline css generated by theme options before the </body>
if ( defined( 'SPEED_BOOSTER_PACK_VERSION' ) and  isset( $sbp_options['sbp_css_async'] ) and isset( $sbp_options['sbp_footer_css'] ) ) {
	add_action( 'wp_footer', 'gameleon_generated_styles', SBP_FOOTER+2 );
} else { // render on the header after main theme styes
	add_action( 'wp_head', 'gameleon_generated_styles', 15 );
}