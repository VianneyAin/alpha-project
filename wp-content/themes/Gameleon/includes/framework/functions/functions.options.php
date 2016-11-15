<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
        function of_options() {


//Access the WordPress Categories via an Array
        $of_categories      = array();
        $of_categories_obj  = get_categories('hide_empty=0');
        foreach ($of_categories_obj as $of_cat) {
        $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
        $categories_tmp     = array_unshift($of_categories, "ALL CATEGORIES");

$of_tags = array();
$of_tags_obj = get_tags('hide_empty=0');
foreach ($of_tags_obj as $of_tag) {
$of_tags[$of_tag->slug] = $of_tag->slug;}
$tags_tmp = array_unshift($of_tags, "ALL TAGS");




// Stylesheets Reader
$alt_stylesheet_path = LAYOUT_PATH;
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) )
{
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) )
    {
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false )
        {
            if(stristr($alt_stylesheet_file, ".css") !== false)
            {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }
    }
}

                    // Background Images Reader
                    $bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
                    $bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
                    $bg_images = array();

                    if ( is_dir($bg_images_path) ) {
                        if ($bg_images_dir = opendir($bg_images_path) ) {
                            while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
                                if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
                    natsort($bg_images); // Sorts the array into a natural order
                    $bg_images[] = $bg_images_url . $bg_images_file;
                }
            }
        }
    }

/*----------------------------------------------------------------------------------------------------------
    TODO Add options/functions that use these variables
-----------------------------------------------------------------------------------------------------------*/

// More Options
$uploads_arr 		= wp_upload_dir();
$all_uploads_path 	= $uploads_arr['path'];
$all_uploads 		= get_option('of_uploads');
$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// Image Alignment radio box
$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

// Image Links to Options
$of_options_image_link_to = array("image" => "The Image","post" => "The Post");

$theme_version = '';
$temp_obj = wp_get_theme();
$theme_obj = wp_get_theme( $temp_obj->get('Template') );
$theme_version = $theme_obj->get('Version');
$theme_name = $theme_obj->get('Name');
$theme_uri = $theme_obj->get('ThemeURI');
$author_uri = $theme_obj->get('AuthorURI');
$user_info = get_userdata(1);

$count_posts = wp_count_posts(); // retrieve posts count
$published_posts = $count_posts->publish; // published posts
$comments_count = wp_count_comments(); // retrieve unapproved comments count
$result = count_users(); // get users count
$tigu_total_users = $result['total_users'];
$shortname = "td";


$of_options_menu_blocks = array(
    "disabled" => array (
        "placebo"                   => "placebo", //REQUIRED!
        "block_fullwidth_logo"      => "Full Logo",
        "block_full_header_slider"  => "Full Slider",
        "block_news_ticker"         => "News Ticker",
        "block_modular_slider"      => "Modular Slider",
        "block_ad_banner"           => "Ad Banner",
    ),
    "enabled" => array (
        "placebo"                   => "placebo", //REQUIRED!
        "block_logo_ad"             => "Logo + Ad Banner",
        "block_main_menu"           => "Main Menu",
    ),
);

/*----------------------------------------------------------------------------------------------------------
    Font options
-----------------------------------------------------------------------------------------------------------*/

//  Font Style
$of_options_select_font_style = array(
        ''          => "Default font style",
        'italic'    => "Italic",
        'oblique'   => "Oblique",
        'normal'    => "Normal (removes italic)"
        );

//  Font Weight
$of_options_select_font_weight = array(
        ''          => "Default font weight",
        'bold'      => "Bold",
        'normal'    => "Normal"
        );


// Text Transform
$of_text_transform      = array(
        ''              => "Default text transform",
        'uppercase'     => "Uppercase",
        'capitalize'    => "Capitalize",
        'lowercase'     => "Lowercase",
        'none'          => "None"
        );


// Related Content Type
$of_options_select_related_type = array(
        'td_by_cat'      => "Category",
        'td_by_auth'     => "Author",
        'td_by_tag'      => "Tag"
        );

// Posts order query
$of_options_post_orderby_filter = array(
        'name'            => "Name",
        'date'            => "Date",
        'comment_count'   => "Popularity",
        'meta_value_num'  => "Number of Views",
        'rand'            => "Random Order"
        );

// Posts order query
$of_options_post_order_filter = array(
        'ASC'            => "Ascending",
        'DESC'           => "Descending"
        );

// Adsense Shape format Single
$of_options_select_ad_shape = array(
        'auto'            => "Automatic",
        'horizontal'      => "Horizontal banner",
        'vertical'        => "Vertical banner",
        'rectangle'       => "Rectangle"
        );

// Ad position Single
$of_options_select_ad_position_post = array(
        'on_top_post'       => "On top of article",
        'at_end_post'       => "At the end of article",
        'first_p'           => "After first paragraph",
        'to_right'          => "On the right of text content",
        'to_left'           => "On the left of text content"
        );

// Ad position Page
$of_options_select_ad_position_page = array(
        'on_top_page'       => "On top",
        'page_bottom'       => "At the bottom",
        'first_p_page'      => "After first paragraph"
        );

// Ad position Archive
$of_options_select_ad_position_archive = array(
        'on_top_archive'       => "On top",
        'archive_bottom'       => "At the bottom"
        );

// Ad position custom_pages
$of_options_select_ad_position_custom_pages = array(
        'on_top_custom'       => "On top",
        'custom_bottom'       => "At the bottom"
        );


// Ad position Home Page Blog Layout
$of_options_select_ad_position_home = array(
        'on_top_home'       => "On top",
        'home_bottom'       => "At the bottom",
        'after_x_home'      => "After x number of paragraphs - select below &#8595;"
        );

/*----------------------------------------------------------------------------------------------------------
    The Options Array
-----------------------------------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();
$url    =  ADMIN_DIR . 'assets/images/';
$url2   =  ADMIN_DIR . 'assets/images/modules/';
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
include_once( ADMIN_PATH . 'functions/google_fonts.php' ) ; // Google Fonts

// Welcome Heading
$of_options[] = array(  "name"  => "Welcome",
        "type"          => "heading"
        );

// Welcome - Content
$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "introduction",
        "std"           => "<h3 style=\"margin: 0 0 10px;\">Welcome to your Theme Options Panel !</h3>
        <p>This is your main theme options panel where you can adjust most of the theme settings. Please note that other options can also be found in the <a style=\"font-weight:600;text-decoration:none; color:#777;\" href=\"customize.php\" target=\"_blank\">Customize</a> page, where you can tweak some theme settings and see a preview of those changes in real time.<br /><br />Thanks you for using our theme!</p>",
        "icon"          => true,
        "type"          => "other"
        );

// Stats- Content
$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "introduction_2",
        "std"           => "
        <div class=\"box\">
        <div class=\"boxed-stats\">
        <div class=\"stats-box\">
        <span>Total Posts</span>
        </div>
        <h2>$published_posts</h2>
        <div class=\"chart green-chart\">
        Charts Stat
        </div>
        </div>
        <div class=\"boxed-stats\">
        <div class=\"stats-box\">
        <span>Total Comments</span>
        </div>
        <h2>$comments_count->total_comments</h2>
        <div class=\"chart red-chart\">
        Charts Stat
        </div>
        </div>
        <div class=\"boxed-stats\">
        <div class=\"stats-box\">
        <span>Total Users</span>
        </div>
        <h2>$tigu_total_users</h2>
        <div class=\"chart gray-chart\">
        Charts Stat
        </div>
        </div>
        </div>
        ",
        "icon"          => true,
        "type"          => "other"
        );



 // General Settings
$of_options[] = array( "name"  => "General Settings",
        "type"          => "heading"
        );


// Image Placeholders Genre
$of_options_select_placeholder_genre = array(
        'random'       => "Random",
        'abstract'      => "Abstract",
        'animals'       => "Animals",
        'business'      => "Business",
        'cats'          => "Cats",
        'city'          => "City",
        'food'          => "Food",
        'nightlife'     => "Nightlife",
        'fashion'       => "Fashion",
        'people'        => "People",
        'nature'        => "Nature",
        'sports'        => "Sports",
        'technics'      => "Technics",
        'transport'     => "Transport"
        );

// Image Placeholder
$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "placehold",
        "std"           => "<h3>Image Placeholder</h3>",
        "icon"          => true,
        "type"          => "info"
        );

// Image Placeholder
$of_options[] = array(  "name"  => "Image Placeholders",
        "desc"          => "Use <strong>Lorempixel.com</strong> as image placeholder for posts that have not set a featured image, or use our default dummy image. Choosing <strong>Lorem Pixel</strong> option will assign real images to articles that haven't set a featured image. This option will work in different areas of the site (e.g. related articles, some widgets, etc.). <strong>Lorem Pixel</strong> is a free web application specifically for creating placeholder images. Please note that the provided images are not included in the theme but are re-hosted by <strong>Lorempixel.com</strong> website and are released under the <a href=\"http://creativecommons.org/licenses/\" title=\"Creative Commons License\" target=\"_blank\">Creative Commons License (CC BY-SA)</a>. For more information visit <a href=\"http://lorempixel.com/#images\" title=\"Lorempixel.com\" target=\"_blank\">Lorempixel.com</a>",
        "id"            => $shortname."_lorempixel_placeholder",
        "std"           => 0,
        "folds"         => 1,
        "on"            => "Lorem Pixel",
        "off"           => "Dummy Image",
        "type"          => "switch"
         );

// Image Placeholder Color
$of_options[] = array(  "name"  => "Image Placeholder Color",
        "desc"          => "Use colored images or <em>black and white</em> images for your placeholders.",
        "id"            => $shortname."_placeholder_color",
        "fold"          => $shortname."_lorempixel_placeholder",
        "std"           => 1,
        "on"            => "Color Image",
        "off"           => "Gray Image",
        "type"          => "switch"
        );

// Related Content Type
$of_options[] = array(  "name"  => "Image Placeholder Genre",
        "desc"      => "Select the image placeholder genre for your placeholder images.",
        "id"        => $shortname."_placeholder_genre",
        "std"       => "random",
        "fold"      => $shortname."_lorempixel_placeholder",
        "type"      => "select",
        "options"   => $of_options_select_placeholder_genre
        );


// Fly-in Effect
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Fly-in Effect</h3>",
        "id"            => $shortname."_group48",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// Fly-in Effect
$of_options[] = array(  "name"  => "Fly-in Effect",
        "desc"          => "Enable or disable fly-in effect.",
        "id"            => $shortname."_fly_in",
        "std"           => 1,
        "fold"          => $shortname."_group48",
        "type"          => "switch"
        );

// Smooth scroll
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Smooth scrollbar</h3>",
        "id"            => $shortname."_group49",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// Smooth scroll
$of_options[] = array(  "name"  => "Smooth scrollbar",
        "desc"          => "Enable or disable nice smooth scrollbar.",
        "id"            => $shortname."_smooth_scrollbar",
        "std"           => 1,
        "fold"          => $shortname."_group49",
        "type"          => "switch"
        );

// Header Options Heading
$of_options[] = array(  "name"  => "Header",
        "type"      => "heading"
        );

// Top Menu
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Top Menu</h3>",
        "id"            => $shortname."_group28",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );


// Header Search Box
$of_options[] = array(  "name"  => "Search box on top menu",
        "desc"          => "Display a search box to top menu on the right side",
        "id"            => $shortname."_top_search",
        "fold"          => $shortname."_group28",
        "std"           => 0,
        "on"            => "Show",
        "off"           => "Hide",
        "type"          => "switch"
        );

// Top Menu border
$of_options[] = array(  "name"  => "Bottom border on top menu",
        "desc"          => "Displays a colored border on the bottom of top menu.",
        "id"            => $shortname."_top_menu_border",
        "fold"          => $shortname."_group28",
        "std"           => 0,
        "on"            => "Show",
        "off"           => "Hide",
        "type"          => "switch"
        );

// Main Menu
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Main Menu</h3>",
        "id"            => $shortname."_group29",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// Sticky Menu
$of_options[] = array(  "name"  => "Sticky Menu",
        "desc"          => "Enable or disable sticky menu on your header.",
        "id"            => $shortname."_sticky_menu",
        "std"           => 0,
        "fold"          => $shortname."_group29",
        "type"          => "switch"
        );

// Custom Mobile Title
$of_options[] = array(  "name"  => "Custom Mobile Title",
        "desc"          => "Enter a custom mobile menu title.",
        "id"            => $shortname."_custom_mobile_menu_title",
        "fold"          => $shortname."_group29",
        "std"           => '',
        "type"          => "text"
        );

// Favicon
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Favicon</h3>",
        "id"            => $shortname."_group43",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// Favicon
$of_options[] = array(  "name"  => "Favicon",
        "desc"      => "Upload a favicon image - maximum width and height 32px, format .png",
        "id"        => $shortname."_favicon",
        "fold"          => $shortname."_group43",
        "std"       => "",
        "type"      => "upload"
        );

// Apple Touch Icon
$of_options[] = array(  "name"  => "Apple Touch Icon",
        "desc"      => "Icon for Apple iPhone",
        "id"        => $shortname."_apple_touch_icon",
        "fold"          => $shortname."_group43",
        "std"       => "",
        "type"      => "upload"
        );

// Logo
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Logo</h3>",
        "id"            => $shortname."_group27",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// Logo img
$of_options[] = array(  "name"  => "Small Logo",
        "desc"          => "Upload your logo (250 x 100px).png ",
        "id"            => $shortname."_custom_logo",
        "fold"          => $shortname."_group27",
        "std"           => '',
        "type"          => "upload"
        );

// Logo img
$of_options[] = array(  "name"  => "Wide Logo",
        "desc"          => "Upload a full logo (any size) that will be used on home page only.",
        "id"            => $shortname."_custom_logo_wide",
        "fold"          => $shortname."_group27",
        "std"           => '',
        "type"          => "upload"
        );

// Logo alt
$of_options[] = array(  "name"  => "Logo ALT attribute",
        "desc"          => "Type your ALT attribute for your logo",
        "id"            => $shortname."_custom_logo_alt",
        "fold"          => $shortname."_group27",
        "std"           => '',
        "type"          => "text"
        );

// Logo title
$of_options[] = array(  "name"  => "Logo TITLE attribute ",
        "desc"          => "Type your TITLE attribute for your logo",
        "id"            => $shortname."_custom_logo_title",
        "fold"          => $shortname."_group27",
        "std"           => '',
        "type"          => "text"
        );

// News Ticker
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>News Ticker</h3>",
        "id"            => $shortname."_group58",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "News Ticker Title",
        "desc"          => "Type the title for the news ticker box",
        "id"            => $shortname."_newsticker_title",
        "fold"          => $shortname."_group58",
        "std"           => 'Breaking News:',
        "type"          => "text"
        );

// include
$of_options[] = array(  "name"  => "Filter news by Category",
        "desc"          => "Selected Category in this field will show up its posts in the news ticker.",
        "id"            => $shortname."_newsticker_category",
        "std"           => "ALL CATEGORIES",
        "fold"          => $shortname."_group58",
        "type"          => "select",
        "options"       => $of_categories
        );

$of_options[] = array(  "name"  => "Show Excerpt",
        "desc"          => "",
        "id"            => $shortname."_newsticker_excerpt",
        "std"           => 0,
        "fold"          => $shortname."_group58",
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Show date",
        "desc"          => "",
        "id"            => $shortname."_newsticker_date",
        "std"           => 0,
        "fold"          => $shortname."_group58",
        "type"          => "switch"
        );


$of_options[] = array(  "name"  => "Number of news to scroll",
        "desc"          => "",
        "id"            => $shortname."_newsticker_number",
        "fold"          => $shortname."_group58",
        "std"           => "6",
        "min"           => "2",
        "step"          => "1",
        "max"           => "20",
        "type"          => "sliderui"
        );


$of_options[] = array(  "name"  => "Top Margin",
    "desc"      => "Depending on the position that you choose in the <em>Header Constructor</em>, you may need to adjust the top margin of the News Ticker. The reference value is \"20\". You can also use your keyboard left/right arrows to adjust the desired value.",
    "id"        => $shortname."_newsticker_top_margin",
    "fold"      => $shortname."_group58",
    "std"       => "",
    "min"       => "0",
    "step"      => "1",
    "max"       => "100",
    "type"      => "sliderui"
    );

$of_options[] = array(  "name"  => "Bottom Margin",
    "desc"      => "Depending on the position that you choose in the <em>Header Constructor</em>, you may need to adjust the bottom margin of the News Ticker. The reference value is \"20\". You can also use your keyboard left/right arrows to adjust the desired value.",
    "id"        => $shortname."_newsticker_bottom_margin",
    "fold"      => $shortname."_group58",
    "std"       => "",
    "min"       => "0",
    "step"      => "1",
    "max"       => "100",
    "type"      => "sliderui"
    );

// Modular Slide
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Modular Slider</h3>",
        "id"            => $shortname."_group57",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );


// Filter posts
$of_options[] = array(  "name"  => "Filter posts",
        "desc"          => "Choose how you want to display posts in the slider.",
        "id"            => $shortname."_filter_slider_posts",
        "fold"          => $shortname."_group57",
        "std"           => 1,
        "on"            => "By Category",
        "off"           => "By Tag Slug",
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Number of posts to slide",
        "desc"          => "",
        "id"            => $shortname."_modular_slider_number",
        "fold"          => $shortname."_group57",
        "std"           => "3",
        "min"           => "2",
        "step"          => "1",
        "max"           => "20",
        "type"          => "sliderui"
        );

// include
$of_options[] = array(  "name"  => "Filter posts by Category",
        "desc"          => "Selected Category in this field will show up its posts in the modular slider on the homepage.",
        "id"            => $shortname."_category_in",
        "std"           => "ALL CATEGORIES",
        "fold"          => $shortname."_group57",
        "type"          => "select",
        "options"       => $of_categories
        );

// include
$of_options[] = array(  "name"  => "Filter posts by Tag Slug",
        "desc"          => "Posts with the selected tag in this field will show up in the modular slider on the homepage.",
        "id"            => $shortname."_slider_tags_in",
        "std"           => "ALL TAGS",
        "fold"          => $shortname."_group57",
        "type"          => "select",
        "options"       => $of_tags
        );


$of_options[] = array(  "name"  => "",
        "desc"          => "If you don't want to use this default built-in slider but another type of slider like <em>Slider Revolution</em> or any type of slider that uses shortcode, please fill out the field below.",
        "id"            => "introduction_7",
        "std"           => "",
        "icon"          => true,
        "fold"          => $shortname."_group57",
        "type"          => "new_info"
        );

// Modular Slider
$of_options[] = array(  "name"  => "Slider Shortcode",
        "desc"          => "Enter slider shortcode. Can be <em>Slider Revolution</em> or any type of slider that uses shortcode. Example: [rev_slider alias]",
        "id"            => $shortname."_modular_slider_shortcode",
        "fold"          => $shortname."_group57",
        "std"           => '',
        "type"          => "text"
        );


// Header Constructor
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Header Constructor</h3>",
        "id"            => $shortname."_group44",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name" => "Header Layout Manager",
        "desc"      => "Organize how you want the header to appear on your site using drag & drop feature. Note that this configuration will be used on home page only. On the any other pages of the site will be displayed the standard block \"logo + ad + menu\". If you still want the Header configuration to be available on all pages of your site, please enable one of the <strong>Overall Display</strong> options below.",
        "id"        => $shortname."_header_blocks",
        "fold"      => $shortname."_group44",
        "std"       => $of_options_menu_blocks,
        "type"      => "sorter"
        );


// Overall Header Constructor
$of_options[] = array(  "name"  => "Overall Display - All selected Header Blocks",
        "desc"          => "Enable the above header configuration on all pages of your site. Otherwise, it will be used only on your home page.",
        "id"            => $shortname."_overall_display",
        "std"           => 0,
        "fold"          => $shortname."_group44",
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Overall Display - Full Logo only",
        "desc"          => "Show the Full Logo and Main Menu on all pages of your site.",
        "id"            => $shortname."_logo_overall_display",
        "std"           => 0,
        "fold"          => $shortname."_group44",
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Header - Top Margin",
    "desc"      => "Set the top margin of your Header module. The reference value is \"40\". This option is useful for different blocks position in the Header Constructor options. You can also use your keyboard left/right arrows to adjust the desired value.",
    "id"        => $shortname."_header_top_margin",
    "fold"      => $shortname."_group44",
    "std"       => "",
    "min"       => "0",
    "step"      => "1",
    "max"       => "100",
    "type"      => "sliderui"
    );


$of_options[] = array(  "name"  => "Header - Bottom Margin",
    "desc"      => "Set the bottom margin of your Header module. The reference value is \"40\". This option is useful for different blocks position in the Header Constructor options. You can also use your keyboard left/right arrows to adjust the desired value.",
    "id"        => $shortname."_header_bottom_margin",
    "fold"      => $shortname."_group44",
    "std"       => "40",
    "min"       => "0",
    "step"      => "1",
    "max"       => "100",
    "type"      => "sliderui"
    );

// Full Slider
$of_options[] = array(  "name"  => "If you use <em>\"Full Slider\"</em> block...",
        "desc"          => "Enter slider shortcode. Can be <em>Slider Revolution</em> or any type of slider that uses shortcode. Example: [rev_slider alias]",
        "id"            => $shortname."_wide_slider_shortcode",
        "fold"          => $shortname."_group44",
        "std"           => '',
        "type"          => "text"
        );


// Template Options Heading
$of_options[] = array(  "name"  => "Template Options",
        "type"          => "heading"
        );

// Excerpts
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>General Template Options</h3>",
        "id"            => $shortname."_group1",
        "icon"          => true,
        "std"           => 1,
        "folds"         => 1,
        "type"          => "toggle"
        );

// Breadcrumb list
$of_options[] = array(  "name"  => "Homepage Layout",
        "desc"          => "Select your Homepage style. Note that our demo site is built using <strong>Magazine</strong> layout. ",
        "id"            => $shortname."_homepage_style",
        "std"           => 0,
        "fold"          => $shortname."_group1",
        "on"            => "Magazine",
        "off"           => "Blog Style",
        "type"          => "switch"
        );

// Breadcrumb list
$of_options[] = array(  "name"  => "Show Breadcrumb List",
        "desc"          => "Show or hide overall breadcrumb list (post, page, categories, archives)",
        "id"            => $shortname."_breadcrumb",
        "std"           => 0,
        "fold"          => $shortname."_group1",
        "on"            => "Show",
        "off"           => "Hide",
        "type"          => "switch"
        );


// Read More Text
$of_options[] = array(  "name"  => "Read More Text",
        "desc"          => "Enter your custom <em>Read more</em> text for excerpts",
        "id"            => $shortname."_excerpts_text",
        "std"           => "Read More...",
        "fold"          => $shortname."_group1",
        "type"          => "text"
        );


// Twitter Username
$of_options[] = array(  "name"  => "Twitter Username",
        "desc"          => "Your Twitter username will be used on Twitter share button.",
        "id"            => $shortname."_twitter_username",
        "std"           => "",
        "fold"          => $shortname."_group1",
        "type"          => "text"
        );


// Custom Page Templates
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Custom Page Templates</h3>",
        "id"            => $shortname."_group52",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "",
        "desc"          => "These options are applicable for the following custom page templates: <em>All Posts Template</em>, <em>Most Popular Template</em>, <em>Most Viewed/Played</em> and <em>Author</em> page.",
        "id"            => "introduction_7",
        "std"           => "",
        "icon"          => true,
        "fold"          => $shortname."_group52",
        "type"          => "new_info"
        );

$of_options[] = array(  "name"  => "Blog Layout",
        "desc"          => "By default, the posts are dispayed in a grid style. If you want to display the posts in a blog layout, enable this option.",
        "id"            => $shortname."_blog_layout_custop_pages",
        "std"           => 0,
        "fold"          => $shortname."_group52",
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Show meta",
        "desc"          => "Enable to display post meta: views, comments, date, etc...",
        "id"            => $shortname."_meta_custop_pages",
        "std"           => 1,
        "fold"          => $shortname."_group52",
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Title Excerpt Length",
        "desc"          => "Excerpt text limit in words. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_custop_pages_excerpts_title",
        "std"           => "3",
        "min"           => "1",
        "step"          => "1",
        "fold"          => $shortname."_group52",
        "max"           => "30",
        "type"          => "sliderui"
        );

// Excerpt Length
$of_options[] = array(  "name"  => "Text Excerpt Length",
        "desc"          => "Excerpt text limit in words. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_custop_pages_excerpts_text",
        "std"           => "8",
        "min"           => "1",
        "step"          => "1",
        "fold"          => $shortname."_group52",
        "max"           => "100",
        "type"          => "sliderui"
        );

// Custom Page Templates
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>\"Blog\" Page Template</h3>",
        "id"            => $shortname."_group54",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// oder by
$of_options[] = array(  "name"  => "Order posts by",
        "desc"      => "",
        "id"        => $shortname."_blog_orderby",
        "std"       => "date",
        "fold"      => $shortname."_group54",
        "type"      => "select",
        "options"   => $of_options_post_orderby_filter
        );

// order
$of_options[] = array(  "name"  => "Sort order",
        "desc"      => "",
        "id"        => $shortname."_blog_order",
        "std"       => "DESC",
        "fold"      => $shortname."_group54",
        "type"      => "select",
        "options"   => $of_options_post_order_filter
        );


// exclude
$of_options[] = array(  "name"  => "Exclude Category",
        "desc"          => "Enter the category ID that you don't want to be displayed. You can also enter multiple category ID's separated by commas. Example: 8,42,197.",
        "id"            => $shortname."_blog_exclude",
        "std"           => "",
        "fold"          => $shortname."_group54",
        "type"          => "text"
        );


// Custom Page Templates
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>\"All Posts\" Page Template</h3>",
        "id"            => $shortname."_group53",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// oder by
$of_options[] = array(  "name"  => "Order posts by",
        "desc"      => "",
        "id"        => $shortname."_all_posts_orderby",
        "std"       => "date",
        "fold"      => $shortname."_group53",
        "type"      => "select",
        "options"   => $of_options_post_orderby_filter
        );

// order
$of_options[] = array(  "name"  => "Sort order",
        "desc"      => "",
        "id"        => $shortname."_all_posts_order",
        "std"       => "DESC",
        "fold"      => $shortname."_group53",
        "type"      => "select",
        "options"   => $of_options_post_order_filter
        );


// exclude
$of_options[] = array(  "name"  => "Exclude Category",
        "desc"          => "Enter the category ID that you don't want to be displayed. You can also enter multiple category ID's separated by commas. Example: 8,42,197.",
        "id"            => $shortname."_all_posts_exclude",
        "std"           => "",
        "fold"          => $shortname."_group53",
        "type"          => "text"
        );



// Custom Page Templates
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>\"Most Popular\" Page Template</h3>",
        "id"            => $shortname."_group55",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// exclude
$of_options[] = array(  "name"  => "Exclude Category",
        "desc"          => "Enter the category ID that you don't want to be displayed. You can also enter multiple category ID's separated by commas. Example: 8,42,197.",
        "id"            => $shortname."_most_popular_exclude",
        "std"           => "",
        "fold"          => $shortname."_group55",
        "type"          => "text"
        );

// Custom Page Templates
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>\"Most Viewed/Played\" Page Template</h3>",
        "id"            => $shortname."_group56",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// exclude
$of_options[] = array(  "name"  => "Exclude Category",
        "desc"          => "Enter the category ID that you don't want to be displayed. You can also enter multiple category ID's separated by commas. Example: 8,42,197.",
        "id"            => $shortname."_most_viewed_exclude",
        "std"           => "",
        "fold"          => $shortname."_group56",
        "type"          => "text"
        );


// Archive & Category Page
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Archive & Category Options</h3>",
        "id"            => $shortname."_group5",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "Bog Layout",
        "desc"          => "By default, the posts are dispayed in a grid style. If you want to display the posts in a blog layout, enable this option.",
        "id"            => $shortname."_blog_layout_archive",
        "std"           => 0,
        "fold"          => $shortname."_group5",
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Show meta",
        "desc"          => "Enable to display post meta: views, comments, date, etc...",
        "id"            => $shortname."_meta_archive",
        "std"           => 1,
        "fold"          => $shortname."_group5",
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Title Excerpt Length",
        "desc"          => "Excerpt text limit in words. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_archive_excerpts_title",
        "std"           => "3",
        "min"           => "1",
        "step"          => "1",
        "fold"          => $shortname."_group5",
        "max"           => "30",
        "type"          => "sliderui"
        );

// Excerpt Length
$of_options[] = array(  "name"  => "Text Excerpt Length",
        "desc"          => "Excerpt text limit in words. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_archive_excerpts_length",
        "std"           => "8",
        "min"           => "1",
        "step"          => "1",
        "fold"          => $shortname."_group5",
        "max"           => "100",
        "type"          => "sliderui"
        );


// Page Options
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Single Page Options</h3>",
        "id"            => $shortname."_group2",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// Disable comments on pages
$of_options[] = array(  "name"  => "Disable comments on pages",
        "desc"          => "Enable or disable comments on all pages.",
        "id"            => $shortname."_disable_comments_pages",
        "std"           => 1,
        "fold"          => $shortname."_group2",
        "on"            => "Comments enabled",
        "off"           => "Comments disabled",
        "type"          => "switch"
        );

// Single Post Page
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Single Post Options</h3>",
        "id"            => $shortname."_group4",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// Featured Image Single
$of_options[] = array(  "name"  => "Featured Image",
        "desc"          => "Show or hide featured image on single posts.",
        "id"            => $shortname."_single_featured_images",
        "std"           => 1,
        "fold"          => $shortname."_group4",
        "type"          => "switch"
        );

// Crop Featured Images
$of_options[] = array(  "name"  => "Crop Featured Image",
        "desc"          => "Enable if you want to crop the featured images to 664px x 373px. <br />Note that only new images are cropped. If you want to crop your old content, use <strong>Regenerate Thumbnails</strong> plugin.",
        "id"            => $shortname."_crop_featured_image",
        "std"           => 0,
        "fold"          => $shortname."_group4",
        "type"          => "switch"
        );

// // Post Byline Categories Blog
// $of_options[] = array(  "name"  => "Categories",
//         "desc"          => "Show or hide categories meta",
//         "id"            => $shortname."_single_byline_categories",
//         "std"           => 1,
//         "fold"          => $shortname."_group4",
//         "type"          => "switch"
//         );

// // Post Byline Date Single
// $of_options[] = array(  "name"  => "Post Date",
//         "desc"          => "Show or hide date meta",
//         "id"            => $shortname."_single_byline_date",
//         "std"           => 1,
//         "fold"          => $shortname."_group4",
//         "type"          => "switch"
//         );

// // Post Byline Comments Single
// $of_options[] = array(  "name"  => "Comments Count",
//         "desc"          => "Show or hide comments count meta",
//         "id"            => $shortname."_single_byline_comments",
//         "std"           => 1,
//         "fold"          => $shortname."_group4",
//         "type"          => "switch"
//         );


// // Review
// $of_options[] = array(  "name"  => "Review  final score",
//         "desc"          => "Show or hide final score meta",
//         "id"            => $shortname."_single_review_score",
//         "std"           => 1,
//         "fold"          => $shortname."_group4",
//         "type"          => "switch"
//         );

// // Post Byline Views Count
// $of_options[] = array(  "name"  => "Views Count",
//         "desc"          => "Show or hide post views count on post.",
//         "id"            => $shortname."_single_views_count",
//         "std"           => 1,
//         "fold"          => $shortname."_group4",
//         "type"          => "switch"
//         );


$of_options[] = array(  "name"  => "Show post meta",
        "desc"          => "Enable to display post meta: category, date, views, comments, likes, review score.",
        "id"            => $shortname."_post_meta_single",
        "std"           => 1,
        "fold"          => $shortname."_group4",
        "type"          => "switch"
        );

// Post Byline Tags Single
$of_options[] = array(  "name"  => "Post Tags",
        "desc"          => "Show or hide tags meta",
        "id"            => $shortname."_single_post_tags",
        "std"           => 1,
        "fold"          => $shortname."_group4",
        "type"          => "switch"
        );

// Social Box on post
$of_options[] = array(  "name"  => "Social Box Sharing",
        "desc"          => "Show or hide the post sharing box on post.",
        "id"            => $shortname."_single_post_sharing",
        "std"           => 1,
        "fold"          => $shortname."_group4",
        "type"          => "switch"
        );

// Likes
$of_options[] = array(  "name"  => "Like, Tweet, Google+",
        "desc"          => "Show or hide the Like, Tweet, Google+ on post.",
        "id"            => $shortname."_single_post_mini_share",
        "std"           => 1,
        "fold"          => $shortname."_group4",
        "type"          => "switch"
        );

// Post author box
$of_options[] = array(  "name"  => "Author Box",
        "desc"          => "Enable or disable the author box.",
        "id"            => $shortname."_post_author_box",
        "std"           => 1,
        "fold"          => $shortname."_group4",
        "type"          => "switch"
        );

// Post navigation
$of_options[] = array(  "name"  => "Post Navigation",
        "desc"          => "Show or hide <em>next</em> and <em>previous</em> posts",
        "id"            => $shortname."_post_navigation",
        "std"           => 1,
        "fold"          => $shortname."_group4",
        "type"          => "switch"
        );

// Disable comments
$of_options[] = array(  "name"  => "Disable comments on posts",
        "desc"          => "Enable or disable comments on all posts.",
        "id"            => $shortname."_disable_comments_posts",
        "std"           => 1,
        "fold"          => $shortname."_group4",
        "on"            => "Comments enabled",
        "off"           => "Comments disabled",
        "type"          => "switch"
        );

// Related Content
$of_options[] = array(  "name"  => "Related Articles",
        "desc"          => "Show or hide related articles module on posts.",
        "id"            => $shortname."_related_content",
        "std"           => 1,
        "fold"          => $shortname."_group4",
        "type"          => "switch"
        );

// Related Articles number
$of_options[] = array(  "name"  => "Number of Related Articles",
        "desc"          => "Select how many related articles to show. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_related_content_count",
        "std"           => "2",
        "min"           => "2",
        "step"          => "2",
        "fold"          => $shortname."_group4",
        "max"           => "8",
        "type"          => "sliderui"
        );

// Related Content Type
$of_options[] = array(  "name"  => "Show Related Articles by ...",
        "desc"      => "Select by which criteria will be displayed the related articles.",
        "id"        => $shortname."_related_content_type",
        "std"       => "td_by_cat",
        "fold"      => $shortname."_group4",
        "type"      => "select",
        "options"   => $of_options_select_related_type
        );

if ( defined( 'MYARCADE_VERSION' ) ) {

// Games Options
$of_options[] = array(  "name"  => "Games Options",
        "type"          => "heading"
        );

$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "placehold",
        "std"           => "<h3>Game loading Progress Bar</h3>",
        "icon"          => true,
        "type"          => "info"
        );



$of_options[] = array(  "name"  => "Game loading Progress Bar",
        "desc"          => "Enable or disable game progress bar that appears before game starts.",
        "id"            => $shortname."_enable_progress_bar",
        "std"           => 1,
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Progress Bar Speed",
        "desc"          => "Set the load speed of the progress bar. Note that a lower value will load the bar faster and a higher value will load the bar slower. Default:10. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_bar_speed",
        "fold"          => $shortname."_enable_progress_bar",
        "std"           => '10',
        "min"           => "0",
        "step"          => "1",
        "max"           => "100",
        "type"          => "sliderui"
        );

$of_options[] = array(  "name"  => "Progress Bar Text",
        "desc"          => "Toggle to enable/disable the progress bar text under progress bar.",
        "id"            => $shortname."_bar_textload_status",
        "fold"          => $shortname."_enable_progress_bar",
        "std"           => 1,
        "type"          => "switch"
        );


$of_options[] = array(  "name"  => "Progress Bar Text Message",
        "desc"          => "Type the progress bar text message.",
        "id"            => $shortname."_progressbar_text",
        "fold"          => $shortname."_enable_progress_bar",
        "std"           => 'Game loaded, click here to play the game!',
        "type"          => "text"
        );



$of_options[] = array(  "name"  => "Text Load Limit",
        "desc"          => "Set the limit in percent of the loading progress when the progress bar text should be shown. Default:35. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_bar_textload_limit",
        "fold"          => $shortname."_enable_progress_bar",
        "std"           => '35',
        "min"           => "0",
        "step"          => "1",
        "max"           => "100",
        "type"          => "sliderui"
        );

$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Featured image</h3>",
        "id"            => $shortname."_group62",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );


$of_options[] = array(  "name"  => "Featured image dimension",
        "desc"          => "Select the desired size for the featured game image that appears on the game page (single). You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_arcade_featured_img",
        "fold"          => $shortname."_group62",
        "std"           => '300',
        "min"           => "100",
        "step"          => "1",
        "max"           => "664",
        "type"          => "sliderui"
        );


$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Game Buttons</h3>",
        "id"            => $shortname."_group63",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );


$of_options[] = array(  "name"  => "Full Screen",
        "desc"          => "Enable or disable the Full Screen Feature.",
        "id"            => $shortname."_fullscreen_enabled",
        "fold"          => $shortname."_group63",
        "std"           => 1,
        "type"          => "switch"
        );
$of_options[] = array(  "name"  => "Light Switch",
        "desc"          => "Enable or disable the Light Switch Feature.",
        "id"            => $shortname."_lightsoff_enabled",
        "fold"          => $shortname."_group63",
        "std"           => 1,
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Game Tabs</h3>",
        "id"            => $shortname."_group64",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );


$of_options[] = array(  "name"  => "Review Tab",
        "desc"          => "Enable or disable the review tab.",
        "id"            => $shortname."_review_tab",
        "fold"          => $shortname."_group64",
        "std"           => 1,
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "Custom Tab",
        "desc"          => "Enable or disable the custom tab.",
        "id"            => $shortname."_custom_tab",
        "fold"          => $shortname."_group64",
        "std"           => 0,
        "type"          => "switch"
        );

// Custom tab content
$of_options[] = array(  "name"  => "Custom Tab Content",
        "desc"          => "You can use standard HTML tags with attributes. You can also add any kind of plugin shortcodes like a chat box, social media badges, etc...",
        "id"            => $shortname."_custom_tab_content",
        "fold"          => $shortname."_group64",
        "std"           => "",
        "type"          => "textarea"
        );


} // END IF MYARCADE_VERSION


 // Footer Options Heading
$of_options[] = array( "name"  => "Footer",
        "type"          => "heading"
        );

// Image Placeholder
$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "placehold",
        "std"           => "<h3>Footer Options</h3>",
        "icon"          => true,
        "type"          => "info"
        );

// Scroll Buttons
$of_options[] = array(  "name"  => "Scroll Buttons",
        "desc"          => "Enable or disable scroll to top & scroll to bottom buttons.",
        "id"            => $shortname."_scroll_buttons",
        "std"           => 1,
        "type"          => "switch"
        );

// Custom Copyright Text
$of_options[] = array(  "name"  => "Copyright Text",
        "desc"          => "You can use standard HTML tags and attributes",
        "id"            => $shortname."_copyright",
        "std"           => "Copyright &copy; 2014",
        "type"          => "textarea"
        );

// Colophon
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Colophon</h3>",
        "id"            => $shortname."_group46",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

// Enable Colophon
$of_options[] = array(  "name"  => "Enable Colophon",
        "desc"          => "Our Colophon module allows you to add a message and a call to action button before the footer.",
        "id"            => $shortname."_colophon_enable",
        "fold"          => $shortname."_group46",
        "std"           => 0,
        "folds"         => 1,
        "on"            => "Enable",
        "off"           => "Disable",
        "type"          => "switch"
         );

// Call to Action Text1
$of_options[] = array(  "name"  => "Colophon Text",
        "desc"          => "",
        "id"            => $shortname."_colophon_txt1",
        "fold"          => $shortname."_group46",
        "std"           => "",
        "type"          => "text"
        );

// Call to Action Button Text
$of_options[] = array(  "name"  => "Colophon Button Text",
        "desc"          => "",
        "id"            => $shortname."_colophon_btn",
        "fold"          => $shortname."_group46",
        "std"           => "",
        "type"          => "text"
        );

// Call to Action Button Link
$of_options[] = array(  "name"  => "Colophon Button Link",
        "desc"          => "",
        "id"            => $shortname."_colophon_btn_link",
        "fold"          => $shortname."_group46",
        "std"           => "",
        "type"          => "text"
        );

// Responsive Adsense Heading
$of_options[] = array(  "name"  => "Responsive Ads",
        "type"          => "heading"
        );


$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Responsive ads</h3>",
        "id"            => $shortname."_group70",
        "icon"          => true,
        "std"           => 1,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "",
        "desc"          => "You can use either AdSense or custom ad codes. To displaye responsive AdSense ads, you need to create a <a href=\"https://support.google.com/adsense/answer/3543893?hl=en\" title=\"Create a responsive ad unit \" target=\"_blank\">responsive ad unit</a>. To generate the ad code for a responsive ad unit, open your AdSense dashboard and under <em>My Ads</em>, click \"Create new ad unit.\" Set Ad Size as \"Responsive Ad Unit\" and click the \"Save and Get Code\" button to generate the JavaScript code for your Responsive AdSense ad.",
        "id"            => "introduction_7",
        "std"           => "",
        "icon"          => true,
        "fold"          => $shortname."_group70",
        "type"          => "new_info"
        );


// Responsive Ads - Header
$of_options[] = array(  "name"  => "Hello there!",
        "desc"      => "<h3>Header Ad</h3>",
        "id"        => $shortname."_group14",
        "icon"      => true,
        "std"       => 0,
        "folds"     => 1,
        "type"      => "toggle"
        );


$of_options[] = array(  "name"  => "",
        "desc"      => "",
        "id"        => $shortname."_ad_header",
        "std"       => "",
        "fold"      => $shortname."_group14",
        "type"      => "textarea"
        );

$of_options[] = array(  "name"  => "Maximum Ad Size",
        "desc"          => "You can select the desired maximum ad size for Desktop view.",
        "id"            => $shortname."_ad_header_size",
        "fold"          => $shortname."_group14",
        "std"           => 1,
        "on"            => "728",
        "off"           => "468",
        "type"          => "switch"
        );


// Responsive Ads - Single
$of_options[] = array(  "name"  => "Hello there!",
        "desc"      => "<h3>Single Post Ad</h3>",
        "id"        => $shortname."_group65",
        "icon"      => true,
        "std"       => 0,
        "folds"     => 1,
        "type"      => "toggle"
        );

$of_options[] = array(  "name"  => "Paste your ad code below:",
        "desc"      => "",
        "id"        => $shortname."_ad_single_post",
        "std"       => "",
        "fold"      => $shortname."_group65",
        "type"      => "textarea"
        );

// Ad position
$of_options[] = array(  "name"  => "Where to dispay the Ad?",
        "desc"          => "",
        "id"            => $shortname."_ad_position_single",
        "std"           => "on_top_post",
        "fold"          => $shortname."_group65",
        "type"          => "select",
        "options"       => $of_options_select_ad_position_post
        );


// Responsive Ads - Single Page
$of_options[] = array(  "name"  => "Hello there!",
        "desc"      => "<h3>Single Page Ad</h3>",
        "id"        => $shortname."_group66",
        "icon"      => true,
        "std"       => 0,
        "folds"     => 1,
        "type"      => "toggle"
        );

$of_options[] = array(  "name"  => "Paste your ad code below:",
        "desc"      => "",
        "id"        => $shortname."_ad_single_page",
        "std"       => "",
        "fold"      => $shortname."_group66",
        "type"      => "textarea"
        );

// Ad position
$of_options[] = array(  "name"  => "Where to dispay the Ad?",
        "desc"          => "",
        "id"            => $shortname."_ad_position_singlepage",
        "std"           => "on_top_page",
        "fold"          => $shortname."_group66",
        "type"          => "select",
        "options"       => $of_options_select_ad_position_page
        );


// Responsive Ads - Archives
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Archive & Category Ad</h3>",
        "id"            => $shortname."_group67",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "Paste your ad code below:",
        "desc"      => "",
        "id"        => $shortname."_ad_archive",
        "std"       => "",
        "fold"      => $shortname."_group67",
        "type"      => "textarea"
        );


// Ad position - Archives
$of_options[] = array(  "name"  => "Where to dispay the Ad?",
        "desc"          => "",
        "id"            => $shortname."_ad_position_archive",
        "std"           => "on_top_archive",
        "fold"          => $shortname."_group67",
        "type"          => "select",
        "options"       => $of_options_select_ad_position_archive
        );



// Responsive Ads - Custom Page
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Custom Page Templates Ad</h3>",
        "id"            => $shortname."_group68",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "Paste your ad code below:",
        "desc"      => "",
        "id"        => $shortname."_ad_custom_pages",
        "std"       => "",
        "fold"      => $shortname."_group68",
        "type"      => "textarea"
        );


$of_options[] = array(  "name"  => "Where to dispay the Ad?",
        "desc"          => "",
        "id"            => $shortname."_ad_position_cutom_pages",
        "std"           => "on_top_archive",
        "fold"          => $shortname."_group68",
        "type"          => "select",
        "options"       => $of_options_select_ad_position_custom_pages
        );


// Responsive Ads - Sidebar
$of_options[] = array(  "name"  => "Hello there!",
        "desc"      => "<h3>Sidebar Ad</h3>",
        "id"        => $shortname."_group13",
        "icon"      => true,
        "std"       => 0,
        "folds"     => 1,
        "type"      => "toggle"
        );

$of_options[] = array(  "name"  => "Paste your ad code below:",
        "desc"      => "To show this ad on sidebar, just drag the <strong>[GAMELEON] Responsive Ads</strong> widget to the desired sidebar then select <strong>Responsive Sidebar Ad</strong>.",
        "id"        => $shortname."_ad_sidebar",
        "std"       => "",
        "fold"      => $shortname."_group13",
        "type"      => "textarea"
        );

// Responsive Ads - Custom Ad 1
$of_options[] = array(  "name"  => "Hello there!",
        "desc"      => "<h3>Custom Ad 1 - to use as a widget</h3>",
        "id"        => $shortname."_group15",
        "icon"      => true,
        "std"       => 0,
        "folds"     => 1,
        "type"      => "toggle"
        );

$of_options[] = array(  "name"  => "Paste your ad code below:",
        "desc"      => "",
        "id"        => $shortname."_ad_custom1",
        "std"       => "",
        "fold"      => $shortname."_group15",
        "type"      => "textarea"
        );

// Responsive Ads - Custom Ad 2
$of_options[] = array(  "name"  => "Hello there!",
        "desc"      => "<h3>Custom Ad 2 - to use as a widget</h3>",
        "id"        => $shortname."_group16",
        "icon"      => true,
        "std"       => 0,
        "folds"     => 1,
        "type"      => "toggle"
        );

$of_options[] = array(  "name"  => "Paste your ad code below:",
        "desc"      => "",
        "id"        => $shortname."_ad_custom2",
        "std"       => "",
        "fold"      => $shortname."_group16",
        "type"      => "textarea"
        );

// Responsive Ads - Custom Ad 3
$of_options[] = array(  "name"  => "Hello there!",
        "desc"      => "<h3>Custom Ad 3 - to use as a widget</h3>",
        "id"        => $shortname."_group17",
        "icon"      => true,
        "std"       => 0,
        "folds"     => 1,
        "type"      => "toggle"
        );


$of_options[] = array(  "name"  => "Paste your ad code below:",
        "desc"      => "",
        "id"        => $shortname."_ad_custom3",
        "std"       => "",
        "fold"      => $shortname."_group17",
        "type"      => "textarea"
        );

if ( defined( 'MYARCADE_VERSION' ) ) {

// Responsive Ads
$of_options[] = array(  "name"  => "Hello there!",
        "desc"      => "<h3>Interstitial Ad - before game starts</h3>",
        "id"        => $shortname."_group60",
        "icon"      => true,
        "std"       => 0,
        "folds"     => 1,
        "type"      => "toggle"
        );

$of_options[] = array(  "name"  => "",
    "desc"          => "<strong>Important!</strong> You are allowed to dispay interstitial Adsense ads only if you are an eligible publisher of <em>AdSense for Games</em> program. <a href=\"http://adsense.blogspot.ro/2010/10/avoiding-accidental-clicks-pt-2-use.html\" title=\"Ad placements\" target=\"_blank\">Read more...</a> <br /> However, you can display other ads using your custom code.",
    "id"            => "introduction_7",
    "std"           => "",
    "icon"          => true,
    "fold"          => $shortname."_group60",
    "type"          => "new_info"
    );


$of_options[] = array(  "name"  => "Paste your ad code below:",
        "desc"      => "",
        "id"        => $shortname."_ad_interstitial",
        "std"       => "",
        "fold"      => $shortname."_group60",
        "type"      => "textarea"
        );



// Responsive Ads - below the game
$of_options[] = array(  "name"  => "Hello there!",
        "desc"      => "<h3>Below the game Ad</h3>",
        "id"        => $shortname."_group69",
        "icon"      => true,
        "std"       => 0,
        "folds"     => 1,
        "type"      => "toggle"
        );


$of_options[] = array(  "name"  => "Paste your ad code below:",
        "desc"      => "",
        "id"        => $shortname."_ad_bellow_the_game",
        "std"       => "",
        "fold"      => $shortname."_group69",
        "type"      => "textarea"
        );


} // end if MYARCADE_VERSION

 // Background settings Heading
$of_bg_repeat  = array(
        "no-repeat" => "No Repeat",
        "repeat"    => "Tile",
        "repeat-x"  => "Tile Horizontally",
        "repeat-y"  => "Tile Vertically"
        );

$of_bg_position         = array(
        "left" => "Left",
        "center"    => "Center",
        "right"  => "Right"
        );

$of_bg_attachment       = array(
        "fixed" => "Fixed",
        "scroll"    => "Scroll"
        );

$of_options[] = array(  "name"  => "Background",
        "type"          => "heading"
        );

$of_options[] = array(  "name"  => "Background Image",
        "desc"          => "Upload a background image for your theme. After you'll choose a background image, the theme will automatically switch to boxed version.",
        "id"            => $shortname."_background_image",
        "std"           => '',
        "type"          => "upload"
        );

$of_options[] = array(  "name"  => "Background Repeat",
        "desc"          => "Select how the background image will be displayed.",
        "id"            => $shortname."_background_repeat",
        "std"           => "no-repeat",
        "type"          => "radio",
        "options"       => $of_bg_repeat
        );

$of_options[] = array(  "name"  => "Background Position",
        "desc"          => "Select your background image position.",
        "id"            => $shortname."_background_position",
        "std"           => "center",
        "type"          => "radio",
        "options"       => $of_bg_position
        );

$of_options[] = array(  "name"  => "Background Attachment",
        "desc"          => "Background attachment.",
        "id"            => $shortname."_background_attachment",
        "std"           => "scroll",
        "type"          => "radio",
        "options"       => $of_bg_attachment
        );

// Theme Colors Heading
$of_options[] = array(  "name"  => "Theme Colors",
        "type"          => "heading"
        );

// General Colors
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>General Colors</h3>",
        "id"            => $shortname."_group34",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "Theme Color",
        "desc"          => "Select your theme accent color.",
        "id"            => $shortname."_theme_color",
        "fold"          => $shortname."_group34",
        "std"           => '',
        "type"          => "color"
        );

$of_options[] = array(  "name"  => "Theme Background Color",
        "desc"          => "Pick a background color for your theme.",
        "id"            => $shortname."_body_background",
        "fold"          => $shortname."_group34",
        "std"           => '',
        "type"          => "color"
        );

$of_options[] = array(  "name"  => "Logo Text Color",
        "desc"          => "Pick a color for the logo text",
        "id"            => $shortname."_logo_color",
        "fold"          => $shortname."_group34",
        "std"           => '',
        "type"          => "color"
        );

$of_options[] = array(  "name"  => "Body Text Color",
        "desc"          => "Pick a color for the body text",
        "id"            => $shortname."_body_text_color",
        "fold"          => $shortname."_group34",
        "std"           => '',
        "type"          => "color"
        );

$of_options[] = array(  "name"  => "Links Color",
        "desc"          => "Pick a color for the links",
        "id"            => $shortname."_links_color",
        "fold"          => $shortname."_group34",
        "std"           => '',
        "type"          => "color"
        );

$of_options[] = array(  "name"  => "Links Hover Color",
        "desc"          => "Pick a color for the links hover",
        "id"            => $shortname."_links_hover_color",
        "fold"          => $shortname."_group34",
        "std"           => '',
        "type"          => "color"
        );

// Main Menu Colors
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Main Menu Colors</h3>",
        "id"            => $shortname."_group39",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "Menu Background color",
        "desc"          => "Pick a background color for main menu",
        "id"            => $shortname."_main_menu_bg",
        "fold"          => $shortname."_group39",
        "std"           => '',
        "type"          => "color"
        );

$of_options[] = array(  "name"  => "Menu Links color",
        "desc"          => "Pick a color for main menu links.",
        "id"            => $shortname."_main_menu_links_color",
        "fold"          => $shortname."_group39",
        "std"           => '',
        "type"          => "color"
        );

//  Footer Menu Colors
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Footer Menu Colors</h3>",
        "id"            => $shortname."_group40",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "Links color",
        "desc"          => "Pick a color for footer menu links. Note that the color will also apply to the social menu icons if they are used.",
        "id"            => $shortname."_footer_menu_links_color",
        "fold"          => $shortname."_group40",
        "std"           => '',
        "type"          => "color"
        );

$of_options[] = array(  "name"  => "Links Hover Color",
        "desc"          => "Pick a color for the links hover",
        "id"            => $shortname."_footer_menu_hover_links_color",
        "fold"          => $shortname."_group40",
        "std"           => '',
        "type"          => "color"
        );

//  Widgets Title
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Widget Title Colors</h3>",
        "id"            => $shortname."_group51",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "Widgets Title Color",
        "desc"          => "Pick a text color for the widgets title.",
        "id"            => $shortname."_headings_color",
        "fold"          => $shortname."_group51",
        "std"           => '',
        "type"          => "color"
        );

$of_options[] = array(  "name"  => "Widgets Title Background / Border Color",
        "desc"          => "Pick a background color for the widgets title)",
        "id"            => $shortname."_headings_bg_color",
        "fold"          => $shortname."_group51",
        "std"           => '',
        "type"          => "color"
        );

// Appearance
$of_options[] = array(  "name"  => "Appearance",
        "type"          => "heading"
        );

// Widgets Styles
$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "placehold",
        "std"           => "<h3>Widgets Styles</h3>",
        "icon"          => true,
        "type"          => "info"
        );

// Widgets Styles
$of_options[] = array(  "name"  => "Widgets Style",
        "desc"          => "Select the style of your widgets. Note that after you select the desired widget style, you might need to adjust the widgets title color & background.",
        "id"            => $shortname."_widgets_style",
        "std"           => "default",
        "type"          => "images",
        "options"       => array(
                        'default'    => $url2 . 'style1.png',
                        'td_style_2' => $url2 . 'style2.png',
                        )
        );

// Hide border on widgets bar
// $of_options[] = array(  "name"  => "Hide border on widgets bar",
//         "desc"          => "If you use a strong color as background for widget titles on the style <strong>Default</strong> and <strong>Style 4</strong>, you might want to hide the gray border around of your widget titles.",
//         "id"            => $shortname."_hide-tha-border",
//         "std"           => 0,
//         "fold"          => $shortname."_group50",
//         "type"          => "switch"
//         );

$of_options[] = array(  "name"  => "Typography",
        "type"          => "heading"
        );

// General Font Options
$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "generalfont",
        "std"           => "<h3>General Font Option</h3>",
        "icon"          => true,
        "type"          => "info"
        );

$of_options[] = array( "name" => "Google font characters subset",
        "desc"      => "Select characters subset for all Google fonts that you may use on your theme. Please note that some Google fonts does not support particular subsets!",
        "id"            => $shortname."_font_subset",
        "std"       => "latin",
        "type"      => "select",
        "options"   => $of_option_google_fonts_subsets,
        );

// Body font
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Body font</h3>",
        "id"            => $shortname."_group30",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "Font Family",
        "desc"          => "Select the font family for the body text.",
        "id"            => $shortname."_body_font_family",
        "fold"          => $shortname."_group30",
        "std"           => '',
        "type"          => "select_google_font",
        "preview"       => array(
        "text" => "This is a text preview! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum tellus in purus condimentum pulvinar. Duis cursus bibendum dui. ", // this is the text from preview box
        "size" => "14px" // this is the text size from preview box
        ),
        "options"       => $of_option_google_fonts
        );

// Font Style
$of_options[] = array(  "name"  => "Font Style",
        "desc"      => "Since some Google Fonts weren't meant to be italicized or obliqued, you may want to specify an italic font style only when you're sure that selected font has been designed with an italic style. For example, if a browser or operating system can't find the true italic version of a Google Font, it will often \"fake it\" creating a faux italic by slanting the original font.",
        "id"        => $shortname."_body_font_style",
        "std"       => '',
        "fold"      => $shortname."_group30",
        "type"      => "select",
        "options"   => $of_options_select_font_style
        );

// Font Weight
$of_options[] = array(  "name"  => "Font Weight",
        "desc"      => "Select font weight for your choosen font.",
        "id"        => $shortname."_body_font_weight",
        "std"       => '',
        "fold"      => $shortname."_group30",
        "type"      => "select",
        "options"   => $of_options_select_font_weight
        );


$of_options[] = array(  "name"  => "Font size",
        "desc"          => "Select the font size for the body text. Default font size is 13px. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_body_font_size",
        "fold"          => $shortname."_group30",
        "std"           => '14',
        "min"           => "10",
        "step"          => "1",
        "max"           => "32",
        "type"          => "sliderui"
        );

$of_options[] = array(  "name"  => "Line Height",
        "desc"          => "Select the line height property for the body text. Default line-height is 21px. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_body_line_height",
        "fold"          => $shortname."_group30",
        "std"           => '21',
        "min"           => "1",
        "step"          => "1",
        "max"           => "70",
        "type"          => "sliderui"
        );

// Main Menu font
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Main Menu</h3>",
        "id"            => $shortname."_group37",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "Font family",
        "desc"          => "Select the font family for main menu.",
        "id"            => $shortname."_main_menu_font_family",
        "fold"          => $shortname."_group37",
        "std"           => '',
        "type"          => "select_google_font",
        "preview"       => array(
        "text" => "HOME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SHOP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SERVICES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PORTFOLIO", // this is the text from preview box
        "size" => "24px" // this is the text size from preview box
        ),
        "options"       => $of_option_google_fonts
        );

// Font Style
$of_options[] = array(  "name"  => "Font Style",
        "desc"      => "Since some Google fonts weren't meant to be italicized or obliqued, you may want to specify an italic font style only when you're sure that selected font has been designed with an italic style. For example, if a browser or operating system can't find the true italic version of a Google Font, it will often \"fake it\" creating a faux italic by slanting the original font.",
        "id"        => $shortname."_main_menu_font_style",
        "std"       => '',
        "fold"      => $shortname."_group37",
        "type"      => "select",
        "options"   => $of_options_select_font_style
        );

// Font Weight
$of_options[] = array(  "name"  => "Font Weight",
        "desc"      => "Select font weight for your choosen font.",
        "id"        => $shortname."_main_menu_font_weight",
        "std"       => '',
        "fold"      => $shortname."_group37",
        "type"      => "select",
        "options"   => $of_options_select_font_weight
        );

$of_options[] = array(  "name"  => "Font size",
        "desc"          => "Select the font size for main menu. Default font-size is 16px. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_main_menu_font_size",
        "fold"          => $shortname."_group37",
        "std"           => "16",
        "min"           => "10",
        "step"          => "1",
        "max"           => "70",
        "type"          => "sliderui"
        );

$of_options[] = array(  "name"  => "Text Transform",
        "desc"          => "Select text transform property for main menu",
        "id"                => $shortname."_main_menu_text_transform",
        "std"           => "none",
        "fold"          => $shortname."_group37",
        "type"          => "select",
        "options"       => $of_text_transform
        );

// Widgets title font
$of_options[] = array(  "name"  => "Hello there!",
        "desc"          => "<h3>Widgets title</h3>",
        "id"            => $shortname."_group32",
        "icon"          => true,
        "std"           => 0,
        "folds"         => 1,
        "type"          => "toggle"
        );

$of_options[] = array(  "name"  => "Font family",
        "desc"          => "Select the font family for the widgets title.",
        "id"            => $shortname."_widgets_font_family",
        "fold"          => $shortname."_group32",
        "std"           => '',
        "type"          => "select_google_font",
        "preview"       => array(
        "text" => "This is a text preview!", // this is the text from preview box
        "size" => "30px" // this is the text size from preview box
        ),
        "options"       => $of_option_google_fonts
        );

// Font Style
$of_options[] = array(  "name"  => "Font Style",
        "desc"      => "Since some Google fonts weren't meant to be italicized or obliqued, you may want to specify an italic font style only when you're sure that selected font has been designed with an italic style. For example, if a browser or operating system can't find the true italic version of a Google Font, it will often \"fake it\" creating a faux italic by slanting the original font.",
        "id"        => $shortname."_widgets_font_style",
        "std"       => '',
        "fold"      => $shortname."_group32",
        "type"      => "select",
        "options"   => $of_options_select_font_style
        );

// Font Weight
$of_options[] = array(  "name"  => "Font Weight",
        "desc"      => "Select font weight for your choosen font.",
        "id"        => $shortname."_widgets_font_weight",
        "std"       => '',
        "fold"      => $shortname."_group32",
        "type"      => "select",
        "options"   => $of_options_select_font_weight
        );

$of_options[] = array(  "name"  => "Font size",
        "desc"          => "Select the font size for widgets title. Default font size is 18px. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_widgets_font_size",
        "fold"          => $shortname."_group32",
        "std"           => "18",
        "min"           => "10",
        "step"          => "1",
        "max"           => "70",
        "type"          => "sliderui"
        );

$of_options[] = array(  "name"  => "Line Height",
        "desc"          => "Select the line height property for widgets title. Default line-height is 30px. You can also use your keyboard left/right arrows to adjust the desired value.",
        "id"            => $shortname."_widgets_line_height",
        "fold"          => $shortname."_group32",
        "std"           => "30",
        "min"           => "1",
        "step"          => "1",
        "max"           => "70",
        "type"          => "sliderui"
        );

$of_options[] = array(  "name"  => "Text Transform",
        "desc"          => "Select text transform property for widgets title",
        "id"                => $shortname."_widgets_text_transform",
        "std"           => "none",
        "fold"          => $shortname."_group32",
        "type"          => "select",
        "options"       => $of_text_transform
        );


// Performance Options Heading
$of_options[] = array(  "name"  => "Performance",
        "type"          => "heading"
        );

$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "introduction_4",
        "std"           => "<h3>Speed Up Your Theme!</h3>",
        "icon"          => true,
        "type"          => "info"
        );

// Install Speed Booster Pack Plugin
if ( !is_plugin_active( 'speed-booster-pack/speed-booster-pack.php' ) ) { // hide this option if plugin is active
        $of_options[] = array(  "name"  => "",
                "desc"          => "",
                "id"            => $shortname."_speed_booster",
                "std"           => "<h3 style=\"margin: 0;\">Install Speed Booster Pack plugin</h3><br />
                <div class=\"td-button-div\"><a href=\"themes.php?page=install-required-plugins/\" class='button'>Install Speed Booster Pack</a></div><br />
                <span><strong>Speed Booster Pack</strong> plugin allows you to improve your page loading speed and get a higher score on the major speed testing services.</span>
                ",
                "icon"          => true,
                "type"          => "other"
                );
} else {
 $of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => $shortname."_speed_booster",
        "std"           => "<h3 style=\"margin: 0;\">Speed Booster Pack</h3><br />
        <div class=\"td-button-div\"><span class='button button-green'>Speed Booster Pack is active!</span></div><br />
        <span>Feel free to adjust the <a href=\"options-general.php?page=sbp-options/\" >Speed Booster Pack Settings</a> to suit your needs and increase your website performance.</span>
        ",
        "icon"          => true,
        "type"          => "other"
        );
}

// Minify CSS
$of_options[] = array(  "name"  => "Minify Stylesheets",
        "desc"          => "Switching to a minified version of your main CSS file helps reduce page load time on your website. It is also useful for debugging theme style (Switch off).",
        "id"            => $shortname."_css_minified",
        "std"           => 1,
        "type"          => "switch"
        );

// Minify JS
$of_options[] = array(  "name"  => "Minify Javascripts",
        "desc"          => "Switching to a minified version of your main JS file helps reduce page load time on your website. It is also useful for debugging. (Switch off).",
        "id"            => $shortname."_js_minified",
        "std"           => 1,
        "type"          => "switch"
        );

$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "introduction_5",
        "std"           => "<h3 style=\"margin: 0 0 10px;\">Additional recommendations and best practices to speed up your site</h3>
        <ul>
        <li>
        <div class=\"dashicons dashicons-yes\" style=\"color:#2DCB73\"></div><strong>Choose a good hosting service</strong> - choosing a good web hosting will increase your website performance.
        </li>
        <li>
        <div class=\"dashicons dashicons-yes\" style=\"color:#2DCB73\"></div><strong><a href=\"http://www.feedthebot.com/pagespeed/enable-compression.html\" target=\"_blank\">Enable compression</a></strong> on your website - less time to load your pages, and less bandwidth used over all.
        </li>
        <li>
        <div class=\"dashicons dashicons-yes\" style=\"color:#2DCB73\"></div><strong>Use <a href=\"http://wordpress.org/plugins/w3-total-cache/\" target=\"_blank\">W3 Total Cache</a> plugin</strong> - as a minimum configuration, we recommend to use just the full page and browser caching options enabled.
        </li>
        <li>
        <div class=\"dashicons dashicons-yes\" style=\"color:#2DCB73\"></div><strong>Use <a href=\"http://wordpress.org/plugins/wp-smushit/\" target=\"_blank\">WP Smush.it</a> plugin</strong> - reduce image file sizes and improve performance that means less time to load your pages.
        </li>
        <li>
        <div class=\"dashicons dashicons-yes\" style=\"color:#2DCB73\"></div><strong>Use <a href=\"http://wordpress.org/plugins/p3-profiler/\" target=\"_blank\">P3 Plugin Profiler</a></strong> to see which plugins are slowing down your site. Some poorly coded plugins may impact your site performance.
        </li>
        </ul>
        ",
        "icon"          => true,
        "type"          => "other"
        );

// Custom CSS Heading
$of_options[] = array(  "name"  => "Custom CSS",
        "type"          => "heading"
        );

$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "introduction_3",
        "std"           => "<h3>Custom CSS Editor - Customize the appearance of your theme</h3>",
        "icon"          => true,
        "type"          => "info"
        );

// Custom CSS
$of_options[] = array(  "name"  => "",
        "desc"          => "Here you can add your own CSS styles without the need to create a child theme or worry about theme updates overwriting your customizations. Just add your CSS here for what you want to change and your rules will take precedence. Please note that you don't need to copy all the theme's style.css content but only the css attributes you need to modify or add. <hr /><em>*This is an advanced code editor that matches the features and performance of native editors such as Sublime, Vim and TextMate.</em>",
        "id"            => $shortname."_gameleon_inline_css",
        "std"           => '',
        "type"          => "css"
        );

// Theme AutoUpdate
$of_options[] = array(  "name"  => "One click update ",
        "type"          => "heading"
        );

$of_options[] = array(  "name"  => "",
        "desc"          => "",
        "id"            => "introduction_6",
        "std"           => "<h3>One click solution for updating your theme</h3>",
        "icon"          => true,
        "type"          => "info"
        );

$of_options[] = array(  "name"  => "",
        "desc"          => "Please fill the fields below, if you want to get update notifications for your theme directly on your admin dashboard. In order to automatically update your theme, go to <a href=\"update-core.php\" target=\"_blank\">Updates</a> page of your <strong>Dashboard</strong>. If there is a new theme update available, you will have the ability to update your theme directly from this page.",
        "id"            => "introduction_7",
        "std"           => "",
        "icon"          => true,
        "type"          => "new_info"
        );

// Envato Username
$of_options[] = array(  "name"  => "Envato Username",
        "desc"          => "Please fill in your <strong>Envato</strong> username you used to purchase this theme.",
        "id"            => $shortname."_themeforest_username",
        "std"           => '',
        "type"          => "text"
        );


// Envato API key
$of_options[] = array(  "name"  => "Envato API key",
        "desc"          => "Please fill in your <strong>API Key</strong> from your <strong>Envato</strong> account. To find out how to get your <strong>API Key</strong>, check out this <a target='_blank' href='".$url."api-screenshot.png'>screenshot</a>.",
        "id"            => $shortname."_themeforest_api_key",
        "std"           => '',
        "type"          => "text"
        );


// Backup Options Heading
$of_options[] = array(  "name"  => "Backup Options",
        "type"          => "heading",
        "icon"          => ADMIN_IMAGES . "icon-backup.png"
        );

// Backup Options - Content
$of_options[] = array(  "name"  => "Backup and Restore Options",
        "id"            => "of_backup",
        "std"           => '',
        "type"          => "backup",
        "desc"          => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. <br />This is useful if you want to experiment on the options but would like to keep the old settings in case you need them back.',
        );

$of_options[] = array(  "name"  => "Transfer Theme Options Data",
        "id"            => "of_transfer",
        "std"           => '',
        "type"          => "transfer",
        "desc"          => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
        );


    }   // End function: of_options()
}   // End chack if function exists: of_options()
?>