<?php

add_action('init', 'pw_options');

if (!function_exists('pw_options')) {

    function pw_options() {

// VARIABLES
        $pluginname = "Pathway";
        $shortname = "pw";

// Populate OptionsFramework option in array for use in theme
        global $pw_options;
        $pw_options = get_option('pw_options');

        $GLOBALS['template_path'] = PW_DIRECTORY;

// Access the WordPress Categories via an Array
        $pw_categories = array();
        $pw_categories_obj = get_categories('hide_empty=0');
        foreach ($pw_categories_obj as $pw_cat) {
            $pw_categories[$pw_cat->cat_ID] = $pw_cat->cat_name;
        }
        $categories_tmp = array_unshift($pw_categories, "Select a category:");

// Access the WordPress Pages via an Array
        $pw_pages = array();
        $pw_pages_obj = get_pages('sort_column=post_parent,menu_order');
        foreach ($pw_pages_obj as $pw_page) {
            $pw_pages[$pw_page->ID] = $pw_page->post_name;
        }
        $pw_pages_tmp = array_unshift($pw_pages, "Select a page:");

// Image Alignment radio box
        $options_thumb_align = array("alignleft" => "Left", "alignright" => "Right", "aligncenter" => "Center");

// Image Links to Options
        $options_image_link_to = array("image" => "The Image", "post" => "The Post");

// Testing 
        $options_select = array("one", "two", "three", "four", "five");
        $options_radio = array("one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five");

// Stylesheets Reader
        $alt_stylesheet_path = PW_FILEPATH . '/styles/';
        $alt_stylesheets = array();

        if (is_dir($alt_stylesheet_path)) {
            if ($alt_stylesheet_dir = opendir($alt_stylesheet_path)) {
                while (($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false) {
                    if (stristr($alt_stylesheet_file, ".css") !== false) {
                        $alt_stylesheets[] = $alt_stylesheet_file;
                    }
                }
            }
        }

// More Options
        $uploads_arr = wp_upload_dir();
        $all_uploads_path = $uploads_arr['path'];
        $all_uploads = get_option('pw_uploads');
        $other_entries = array("Select a number:", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19");
        $body_repeat = array("no-repeat", "repeat-x", "repeat-y", "repeat");
        $body_pos = array("top left", "top center", "top right", "center left", "center center", "center right", "bottom left", "bottom center", "bottom right");

// Set the Options Array
        $options = array();

        $options[] = array("name" => __("Heading", 'framework'),
            "type" => "heading");

        $options[] = array("name" => __("Background Color (Default #f4f4f4)", 'framework'),
            "desc" => __("Choose color to use color bg <br/><strong>OR type 'none' to use the transparent bg</strong>", 'framework'),
            "id" => $shortname . "_head_bg_color",
            "std" => "none",
            "type" => "color");

        $options[] = array("name" => __("Background Image", 'framework'),
            "desc" => __("Upload a background for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)", 'framework'),
            "id" => $shortname . "_head_bg_img",
            "std" => "",
            "type" => "upload");

        $options[] = array("name" => __("Background Position & Repeat Options", 'framework'),
            "desc" => __(": Position Vertical<div class='desc_explain'></div>: Position Horizontal<div class='desc_explain'></div>: Repeat<div class='desc_explain'></div>.", 'framework'),
            "id" => $shortname . "_head_bg_pr",
            "std" => array('position_1' => 'top', 'position_2' => 'left', 'repeat' => 'no-repeat'),
            "type" => "bg_pr");

        $options[] = array("name" => __("Custom Logo ", 'framework'),
            "desc" => __("Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)", 'framework'),
            "id" => $shortname . "_head_logo_img",
            "std" => PW_DIRECTORY."/admin/images/logo.png",
            "type" => "upload");

        $options[] = array("name" => __("Logo Height ", 'framework'),
            "desc" => __("Adjust to the height of your logo.", 'framework'),
            "id" => $shortname . "_head_logo_height",
            "std" => "80",
            "type" => "text");

// Form Options
        $options[] = array("name" => __("Form Style", 'framework'),
            "type" => "heading");

        $options[] = array("name" => __("Form Background Color ", 'framework'),
            "desc" => __("Choose color to use color bg <br/><strong>OR type 'none' to use the transparent bg</strong>.", 'framework'),
            "id" => $shortname . "_form_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array("name" => __("Form Background Image", 'framework'),
            "desc" => __("Upload a background for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)", 'framework'),
            "id" => $shortname . "_form_bg_img",
            "std" => "",
            "type" => "upload");

        $options[] = array("name" => __("Form Background Position & Repeat Options", 'framework'),
            "desc" => __(": Position Vertical<div class='desc_explain'></div>: Position Horizontal<div class='desc_explain'></div>: Repeat<div class='desc_explain'></div>.", 'framework'),
            "id" => $shortname . "_form_bg_pr",
            "std" => array('position_1' => 'top', 'position_2' => 'left', 'repeat' => 'no-repeat'),
            "type" => "bg_pr");

        $options[] = array("name" => __("Form border radius ", 'framework'),
            "desc" => __("Form border radius.", 'framework'),
            "id" => $shortname . "_form_radius",
            "std" => "0",
            "type" => "text");

        $options[] = array("name" => __("Form Border Options", 'framework'),
            "desc" => __(": Border Size | Border Style | Border Color.", 'framework'),
            "id" => $shortname . "_form_border",
            "std" => array('width' => '0', 'style' => 'solid', 'color' => '#444444'),
            "type" => "border");

        $options[] = array("name" => __("Form Shadow Options", 'framework'),
            "desc" => __(": Inset<div class='desc_explain'></div>: Horizontal<div class='desc_explain'></div>: Vertical<div class='desc_explain'></div>: Blur Radius<div class='desc_explain'></div>: Spread<div class='desc_explain'></div>: Color<div class='desc_explain'></div>", 'framework'),
            "id" => $shortname . "_form_shadow",
            "std" => array('style' => '', 'horizontal' => '0', 'vertical' => '0', 'blur' => '0', 'spread' => '0', 'color' => '#ffffff'),
            "type" => "shadow");

        $options[] = array("name" => __("Form Width ", 'framework'),
            "desc" => __("Use more than 350 width.", 'framework'),
            "id" => $shortname . "_form_width",
            "std" => "350",
            "type" => "text");

        $options[] = array("name" => __("Form Padding ", 'framework'),
            "desc" => __(": Padding Top<div class='desc_explain'></div>: Padding Right<div class='desc_explain'></div>: Padding Bottom<div class='desc_explain'></div>: Padding Left<div class='desc_explain'></div>.", 'framework'),
            "id" => $shortname . "_form_padding",
            "std" => array('padding_top' => '0', 'padding_right' => '20', 'padding_bottom' => '20', 'padding_left' => '20'),
            "type" => "padding");

        $pw_plug = get_option('pw_options');
        $pw_lab = get_option('pw_label');
        $defaultlabel="false";
        if($pw_plug!="" && $pw_lab==""){
            $defaultlabel="true";
        }
        $options[] = array("name" => __('Show Label Form', 'framework'),
            "desc" => __('Check this option if you want to show label on login form.', 'framework'),
            "id" => $shortname . "_show_label",
            "std" => $defaultlabel,
            "type" => "checkbox");

        $options[] = array("name" => __("Label Color ", 'framework'),
            "desc" => __("Label Color.", 'framework'),
            "id" => $shortname . "_form_label_color",
            "std" => "#636363",
            "type" => "color");

        $options[] = array("name" => __("Field border radius ", 'framework'),
            "desc" => __("Field border radius.", 'framework'),
            "id" => $shortname . "_form_field_radius",
            "std" => "0",
            "type" => "text");

        $options[] = array("name" => __("Field Text Color", 'framework'),
            "desc" => __("Your primary Text Color.", 'framework'),
            "id" => $shortname . "_form_text_color",
            "std" => "#737373",
            "type" => "color");

        $options[] = array("name" => __("Field Background Color ", 'framework'),
            "desc" => __("Your primary Text Color.", 'framework'),
            "id" => $shortname . "_form_field_bg_color",
            "std" => "#efefef",
            "type" => "color");

        $options[] = array("name" => __("Field Border Options ", 'framework'),
            "desc" => __(": Border Size | Border Style | Border Color.", 'framework'),
            "id" => $shortname . "_form_field_border",
            "std" => array('width' => '0', 'style' => 'solid', 'color' => 'none'),
            "type" => "border");

        $options[] = array("name" => __("Field Shadow Options", 'framework'),
            "desc" => __(": Inset<div class='desc_explain'></div>: Horizontal<div class='desc_explain'></div>: Vertical<div class='desc_explain'></div>: Blur Radius<div class='desc_explain'></div>: Spread<div class='desc_explain'></div>: Color<div class='desc_explain'></div>", 'framework'),
            "id" => $shortname . "_form_field_shadow",
            "std" => array('style' => '', 'horizontal' => '0', 'vertical' => '0', 'blur' => '0', 'spread' => '0', 'color' => '#ffffff'),
            "type" => "shadow");

        $options[] = array("name" => __("(:Focus / :Active) Field Background Color ", 'framework'),
            "desc" => __("Your primary Text Color.", 'framework'),
            "id" => $shortname . "_form_field_bg_color_hover",
            "std" => "#efefef",
            "type" => "color");

        $options[] = array("name" => __("(:Focus / :Active) Field Border Options", 'framework'),
            "desc" => __(": Border Size | Border Style | Border Color.", 'framework'),
            "id" => $shortname . "_form_field_border_hover",
            "std" => array('width' => '0', 'style' => 'solid', 'color' => 'none'),
            "type" => "border");

        $options[] = array("name" => __("(:Focus / :Active) Field Shadow Options", 'framework'),
            "desc" => __(": Inset<div class='desc_explain'></div>: Horizontal<div class='desc_explain'></div>: Vertical<div class='desc_explain'></div>: Blur Radius<div class='desc_explain'></div>: Spread<div class='desc_explain'></div>: Color<div class='desc_explain'></div>", 'framework'),
            "id" => $shortname . "_form_field_shadow_hover",
            "std" => array('style' => '', 'horizontal' => '0', 'vertical' => '0', 'blur' => '0', 'spread' => '0', 'color' => '#ffffff'),
            "type" => "shadow");

        $options[] = array("name" => __("'Lost your password ?' Color ", 'framework'),
            "desc" => __("Your primary Text Color.", 'framework'),
            "id" => $shortname . "_form_lost_color",
            "std" => "#6e6e6e",
            "type" => "color");

        $options[] = array("name" => __("(:hover ) 'Lost your password ?' Color", 'framework'),
            "desc" => __("Your primary Text Color.", 'framework'),
            "id" => $shortname . "_form_lost_color_hover",
            "std" => "#383737",
            "type" => "color");


        $pw_plug = get_option('pw_options');
        $pw_remember = get_option('pw_show_remember');
        $defaultlabel="false";
        if($pw_plug!="" && $pw_remember==""){
            $defaultlabel="true";
        }
        $options[] = array("name" => __("Show 'Remember Me ?' Text", 'framework'),
            "desc" => __("Check this option if you want to show 'Remember Me ?' Text on login form.", 'framework'),
            "id" => $shortname . "_show_remember",
            "std" => $defaultlabel,
            "type" => "checkbox");

        $options[] = array("name" => __("'Remember Me ?' Color", 'framework'),
            "desc" => __("Your primary Text Color.", 'framework'),
            "id" => $shortname . "_form_remember_color",
            "std" => "#6e6e6e",
            "type" => "color");


        $pw_plug = get_option('pw_options');
        $pw_full = get_option('pw_full_button');
        $defaultlabel="true";
        if($pw_plug!="" && $pw_full==""){
            $defaultlabel="false";
        }

        $options[] = array("name" => __("Full width button", 'framework'),
            "desc" => __("Check this option if you want to show full width button.", 'framework'),
            "id" => $shortname . "_full_button",
            "std" => $defaultlabel,
            "type" => "checkbox");

        $url = PW_DIRECTORY . '/admin/images/';
        $options[] = array("name" => __("Button Color", 'framework'),
            "desc" => __("Choose one button color.", 'framework'),
            "id" => $shortname . "_form_button_skin",
            "std" => "swhite",
            "type" => "images",
            "options" => array(
                // ios 7
                'iblue' => $url . 'btn/i-blue.png',
                'iblack' => $url . 'btn/i-black.png',
                'igray' => $url . 'btn/i-gray.png',
                'igreen' => $url . 'btn/i-green.png',
                'iorange' => $url . 'btn/i-orange.png',
                'ipink' => $url . 'btn/i-pink.png',
                'ipurple' => $url . 'btn/i-purple.png',
                'ired' => $url . 'btn/i-red.png',
                'iwhite' => $url . 'btn/i-white.png',
                // transparant
                'tblue' => $url . 'btn/t-blue.png',
                'tblack' => $url . 'btn/t-black.png',
                'tgray' => $url . 'btn/t-gray.png',
                'tgreen' => $url . 'btn/t-green.png',
                'torange' => $url . 'btn/t-orange.png',
                'tpink' => $url . 'btn/t-pink.png',
                'tpurple' => $url . 'btn/t-purple.png',
                'tred' => $url . 'btn/t-red.png',
                'twhite' => $url . 'btn/t-white.png',
                // square
                'sblue' => $url . 'btn/s-blue.jpg',
                'sbl' => $url . 'btn/s-bl.jpg',
                'sgray' => $url . 'btn/s-gray.jpg',
                'sgreen' => $url . 'btn/s-green.jpg',
                'slightblue' => $url . 'btn/s-light-blue.jpg',
                'sorange' => $url . 'btn/s-orange.jpg',
                'spink' => $url . 'btn/s-pink.jpg',
                'spurple' => $url . 'btn/s-purple.jpg',
                'sred' => $url . 'btn/s-red.jpg',
                'swhite' => $url . 'btn/s-white.jpg',
                'syellow' => $url . 'btn/s-yellow.jpg',
                // rounded
                'rblue' => $url . 'btn/r-blue.jpg',
                'rbl' => $url . 'btn/r-bl.jpg',
                'rgray' => $url . 'btn/r-gray.jpg',
                'rgreen' => $url . 'btn/r-green.jpg',
                'rlightblue' => $url . 'btn/r-light-blue.jpg',
                'rorange' => $url . 'btn/r-orange.jpg',
                'rpink' => $url . 'btn/r-pink.jpg',
                'rpurple' => $url . 'btn/r-purple.jpg',
                'rred' => $url . 'btn/r-red.jpg',
                'rwhite' => $url . 'btn/r-white.jpg',
                'ryellow' => $url . 'btn/r-yellow.jpg')
        );


// Styling Options
        $options[] = array("name" => __("Styling", 'framework'),
            "type" => "heading");

        $options[] = array("name" => __("Background Color.", 'framework'),
            "desc" => __("Your primary Background Color.", 'framework'),
            "id" => $shortname . "_style_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $options[] = array("name" => __("Background Image", 'framework'),
            "desc" => __("Upload a background for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)", 'framework'),
            "id" => $shortname . "_style_bg_img",
            "std" => "",
            "type" => "upload");

        $options[] = array("name" => __("Background Position & Repeat Options", 'framework'),
            "desc" => __(": Position Vertical<div class='desc_explain'></div>: Position Horizontal<div class='desc_explain'></div>: Repeat<div class='desc_explain'></div>.", 'framework'),
            "id" => $shortname . "_style_bg_pr",
            "std" => array('position_1' => 'top', 'position_2' => 'left', 'repeat' => 'no-repeat'),
            "type" => "bg_pr");

        $options[] = array("name" => __('Enable "Shaker" Effect animation', 'framework'),
            "desc" => __('Check this option if you want to enable the shaker effect on login form.', 'framework'),
            "id" => $shortname . "_style_shaker",
            "std" => "false",
            "type" => "checkbox");

        $options[] = array("name" => __('Custom Copyright', 'framework'),
            "desc" => __('Leave blank if you dont want any copyright message.', 'framework'),
            "id" => $shortname . "_style_copyright",
            "std" => '',
            "type" => "textarea");

        $options[] = array("name" => __("Custom Copyright Text Color.", 'framework'),
            "desc" => __("Your primary Text Color.", 'framework'),
            "id" => $shortname . "_style_copyright_color",
            "std" => "#444444",
            "type" => "color");

        $options[] = array("name" => __("Custom Copyright Link Color ", 'framework'),
            "desc" => __("Your primary Text Color.", 'framework'),
            "id" => $shortname . "_style_copyright_a_color",
            "std" => "#5a5a5a",
            "type" => "color");

        $options[] = array("name" => __("(:Hover / :Active) Custom Copyright Link Color", 'framework'),
            "desc" => __("Your primary Text Color.", 'framework'),
            "id" => $shortname . "_style_copyright_a_color_hover",
            "std" => "#121212",
            "type" => "color");

        $options[] = array("name" => __('Custom CSS', 'framework'),
            "desc" => __('Please add <strong>!important</strong> end of line css.<div class="desc_explain"></div>ex : font-size : 12px <strong>!important</strong>;', 'framework'),
            "id" => $shortname . "_style_css",
            "std" => "",
            "type" => "textarea");
// Styling Options
        $options[] = array("name" => __("Social Media", 'framework'),
            "type" => "heading");
        $options[] = array("name" => __("Icon Color", 'framework'),
            "desc" => __("Your icon color.", 'framework'),
            "id" => $shortname . "_social_color",
            "std" => "#aaaaaa",
            "type" => "color");

        $options[] = array("name" => __("(:hover ) Icon Color", 'framework'),
            "desc" => __("Your icon color when hover.", 'framework'),
            "id" => $shortname . "_social_color_hover",
            "std" => "#444444",
            "type" => "color");

        $options[] = array("name" => __("Twitter URL", 'framework'),
            "desc" => __("enter twitter url. example: https://twitter.com/vennerlabs", 'framework'),
            "id" => $shortname . "_url_twitter",
            "std" => "",
            "type" => "text",
            "size"=>"large");

        $options[] = array("name" => __("Facebook URL", 'framework'),
            "desc" => __("enter facebook url. example: https://facebook.com/vennerlabs", 'framework'),
            "id" => $shortname . "_url_facebook",
            "std" => "",
            "type" => "text",
            "size"=>"large");

        $options[] = array("name" => __("Google plus URL", 'framework'),
            "desc" => __("enter google plus url. example: https://plus.google.com/vennerlabs", 'framework'),
            "id" => $shortname . "_url_google",
            "std" => "",
            "type" => "text",
            "size"=>"large");

        $options[] = array("name" => __("Dribbble URL", 'framework'),
            "desc" => __("enter Dribbble url. example: https://dribbble.com/vennerlabs", 'framework'),
            "id" => $shortname . "_url_dribble",
            "std" => "",
            "type" => "text",
            "size"=>"large");

        $options[] = array("name" => __("LinkedIn URL", 'framework'),
            "desc" => __("enter linkedin url. example: https://linkedin.com/vennerlabs", 'framework'),
            "id" => $shortname . "_url_linkedin",
            "std" => "",
            "type" => "text",
            "size"=>"large");

        $options[] = array("name" => __("Youtube URL", 'framework'),
            "desc" => __("enter youtube url. example: https://youtube.com/vennerlabs", 'framework'),
            "id" => $shortname . "_url_youtube",
            "std" => "",
            "type" => "text",
            "size"=>"large");

        $options[] = array("name" => __("Pinterest URL", 'framework'),
            "desc" => __("enter pinterest url. example: https://pinterest.com/vennerlabs", 'framework'),
            "id" => $shortname . "_url_pinterest",
            "std" => "",
            "type" => "text",
            "size"=>"large");


        update_option('pw_plugin', $options);
        update_option('pw_pluginname', $pluginname);
        update_option('pw_shortname', $shortname);
    }

}
?>
