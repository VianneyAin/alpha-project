<?php



/*----------------------------------------------------------------------------------------------------------

Widget class

-----------------------------------------------------------------------------------------------------------*/

class Gameleon_Social_Tabs extends WP_Widget {





/*----------------------------------------------------------------------------------------------------------

Register widget with WordPress

-----------------------------------------------------------------------------------------------------------*/



public function __construct() {

  parent::__construct(

    'gameleon_social_tabs',

    __( '[GAMELEON] Social Tabs', 'gameleon' ),  // Widget Name

    array( 'description' => __( 'Displays 3 social tabs on your sidebar: Facebook Like Box, Twitter and Google+.', 'gameleon' ), ) // Widget Args

    );

}





/*----------------------------------------------------------------------------------------------------------

Front-end display of widget

-----------------------------------------------------------------------------------------------------------*/



public function widget( $args, $instance ) {

  extract( $args );



  $show_facebook  = ! empty( $instance['show_facebook'] ) ? '1' : '0';

  $show_twitter   = ! empty( $instance['show_twitter'] ) ? '1' : '0';

  $show_google    = ! empty( $instance['show_google'] ) ? '1' : '0';

  $username       = $instance['username'];

  $widget_id      = $instance['widget_id'];

  $page_url       = $instance['page_url'];

  $width          = $instance['width'];

  $number         = $instance['number'];

  $color_scheme   = $instance['color_scheme'];

  $page_type      = apply_filters ( 'page_type', isset ( $instance ['page_type'] ) ? $instance ['page_type'] : '' );

  $color_scheme   = apply_filters ( 'color_scheme', isset ( $instance ['color_scheme'] ) ? $instance ['color_scheme'] : '' );

  $gp_layout      = apply_filters ( 'gp_layout', isset ( $instance ['gp_layout'] ) ? $instance ['gp_layout'] : '' );

  $facebook_page  = $instance['facebook_page'];

  $facebook_title = $instance['facebook_title'];

  $twitter_title  = $instance['twitter_title'];

  $google_title   = $instance['google_title'];

  $cover_photo    = ! empty( $instance['cover_photo'] ) ? '1' : '0';

  $tagline        = ! empty( $instance['tagline'] ) ? '1' : '0';



  echo $before_widget;


  ?>

<div id="td-social-tabs">

<div class="tabs-wrapper">

<?php

// ----------- Google+ TAB Title

// ---------------------------------------------------------------------------

?>



<div class="socialtabs">

<ul class="tab-links">



<?php if( $show_google  == 1 ): ?>

<li>

<a href="#tab1">

<?php echo $google_title; ?>

</a>

</li>

<?php endif; ?>



<?php

// ----------- Facebook TAB Title

// ---------------------------------------------------------------------------

?>



<?php if( $show_facebook == 1 ): ?>

<li class="active">

<a href="#tab2">

<?php echo $facebook_title; ?>

</a>

</li>

<?php endif; ?>



<?php

// ----------- Twitter TAB Title

// ---------------------------------------------------------------------------

?>



<?php if( $show_twitter  == 1 ): ?>

<li>

<a href="#tab3">

<?php echo $twitter_title; ?>

</a>

</li>

<?php endif; ?>



</ul>





<div class="tab-content">

<div class="td-fly-in">

<?php

// ----------- Google+ TAB Content

// ---------------------------------------------------------------------------

?>



<?php if( $show_google  == 1 ): ?>

<div id="tab1" class="tab active">



<?php

    if($page_url): ?>

      <div <?php if($page_type == 'profile') { ?>class="g-person"<?php } elseif($page_type == 'page') { ?>class="g-page"<?php } elseif($page_type == 'community') { ?>class="g-community"<?php } ?> data-width="<?php echo $width; ?>" data-href="<?php echo $page_url; ?>" data-layout="<?php echo $gp_layout; ?>" data-theme="<?php echo $color_scheme; ?>" data-rel="publisher" data-showtagline="<?php echo $tagline; ?>" data-showcoverphoto="<?php echo $cover_photo; ?>"></div>

      <script type="text/javascript">

        (function() {

          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;

          po.src = 'https://apis.google.com/js/platform.js';

          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);

        })();

      </script>

<?php endif; ?>



</div><?php // end of #tab1 ?>

<?php endif; ?>





<?php

// ----------- Facebook TAB Content

// ---------------------------------------------------------------------------

?>



<?php //if( $show_facebook == 1 ): ?>

<div id="tab2" class="tab">

<div id="fb-root"></div>

<div id="likebox-wrapper">

<div class="fb-like-box" data-href="<?php echo esc_url( $facebook_page );?>" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>

</div>



</div><?php // end of #tab2 ?>

<?php //endif; ?>



<?php

// ----------- Twitter TAB Content

// ---------------------------------------------------------------------------

?>



<?php if( $show_twitter == 1 ): ?>

<div id="tab3" class="tab">



<a class="twitter-timeline" width="300" data-tweet-limit="<?php echo $number; ?>"  href="https://twitter.com/<?php echo $username; ?>" data-chrome="noborders noscrollbar" data-widget-id="<?php echo $widget_id; ?>">Tweets by @<?php echo $username; ?></a>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>





</div><?php // end of #tab3 ?>

<?php endif; ?>





</div><?php // end of td-fly-in ?>

</div><?php // end of tab-content ?>

</div><?php // end of socialtabs ?>

</div><?php // end of tabs-wrapper ?>

</div><?php // end of #td-social-tabs ?>



    <?php

    echo $after_widget;

 }



/*----------------------------------------------------------------------------------------------------------

  Sanitize widget form values as they are saved

-----------------------------------------------------------------------------------------------------------*/



public function update( $new_instance, $old_instance ) {

  $instance = array();

  $instance                   = $old_instance;

  $instance['username']       = strip_tags( $new_instance['username'] );

  $instance['show_facebook']  = !empty($new_instance['show_facebook']) ? 1 : 0;

  $instance['show_twitter']   = !empty($new_instance['show_twitter']) ? 1 : 0;

  $instance['show_google']    = !empty($new_instance['show_google']) ? 1 : 0;

  $instance['widget_id']      = strip_tags( $new_instance['widget_id'] );

  $instance['facebook_page']  = strip_tags( $new_instance['facebook_page'] );

  $instance['page_url']       = strip_tags( $new_instance['page_url'] );

  $instance['page_type']      = strip_tags( $new_instance['page_type'] );

  $instance['color_scheme']   = strip_tags( $new_instance['color_scheme'] );

  $instance['gp_layout']      = strip_tags( $new_instance['gp_layout'] );

  $instance['width']          = absint( $new_instance['width'] );

  $instance['number']         = absint( $new_instance['number'] );

  $instance['google_title']   = strip_tags( $new_instance['google_title'] );



  $instance['cover_photo']    = $new_instance['cover_photo'];

  $instance['tagline']        = $new_instance['tagline'];



  //$instance['cover_photo'] = !empty($new_instance['cover_photo']) ? 1 : 0;

  //$instance['tagline'] = !empty($new_instance['tagline']) ? 1 : 0;



  $instance['twitter_title']  = strip_tags( $new_instance['twitter_title'] );

  $instance['facebook_title'] = strip_tags( $new_instance['facebook_title'] );



  return $instance;

}



/*----------------------------------------------------------------------------------------------------------

  Back-end widget form

-----------------------------------------------------------------------------------------------------------*/



public function form( $instance ) {

  $defaults = array(



    'username'        => '',

    'show_facebook'   => 1,

    'show_twitter'    => 1,

    'show_google'     => 1,

    'widget_id'       => '',

    'facebook_page'   => '',

    'color_scheme'   => 'light',

    'page_url'        => '',

    'page_type'       => 'page',

    'facebook_title'  => 'Facebook',

    'twitter_title'   => 'Twitter',

    'google_title'    => 'Google+',

    'gp_layout'       => 'portrait',

    'cover_photo'     => 'on',

    'tagline'         => 'on',

    'width'           => '300',

    'number'          => '3'

    );



  $page_type      = isset ( $instance ['page_type'] ) ? $instance ['page_type'] : '';

  $gp_layout      = isset ( $instance ['gp_layout'] ) ? $instance ['gp_layout'] : '';

  $color_scheme  = isset ( $instance ['color_scheme'] ) ? $instance ['color_scheme'] : '';

  $instance       = wp_parse_args( (array) $instance, $defaults );





/*----------------------------------------------------------------------------------------------------------

  Widget Options

-----------------------------------------------------------------------------------------------------------*/

?>

<h4 style="line-height: 18px;"><div class="dashicons dashicons-facebook" style="padding-right:5px"></div><?php _e( 'Facebook Tab Options', 'gameleon' ); ?></h4>



<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_facebook' ); ?>" name="<?php echo $this->get_field_name( 'show_facebook' ); ?>"<?php checked( $instance['show_facebook'] ); ?> />

<label for="<?php echo $this->get_field_id( 'show_facebook' ); ?>"><?php _e( 'Show Facebook Tab', 'gameleon' ); ?></label>

</p>



<p>

<label for="<?php echo $this->get_field_id( 'facebook_title' ); ?>"><?php _e( 'Facebook Tab Title:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook_title' ); ?>" name="<?php echo $this->get_field_name( 'facebook_title' ); ?>" value="<?php echo $instance['facebook_title']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'facebook_page' ); ?>"><?php _e( 'Facebook Fan Page:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook_page' ); ?>" name="<?php echo $this->get_field_name( 'facebook_page' ); ?>" value="<?php echo $instance['facebook_page']; ?>" />

</p>



<h4 style="line-height: 18px;"><div class="dashicons dashicons-twitter" style="padding-right:5px"></div><?php _e( 'Twitter Tab Options', 'gameleon' ); ?></h4>



<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_twitter' ); ?>" name="<?php echo $this->get_field_name( 'show_twitter' ); ?>"<?php checked( $instance['show_twitter'] ); ?> />

<label for="<?php echo $this->get_field_id( 'show_twitter' ); ?>"><?php _e( 'Show Twitter Tab', 'gameleon' ); ?></label>

</p>



<p>

<label for="<?php echo $this->get_field_id( 'twitter_title' ); ?>"><?php _e( 'Twitter Tab Title:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter_title' ); ?>" name="<?php echo $this->get_field_name( 'twitter_title' ); ?>" value="<?php echo $instance['twitter_title']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Twitter Username:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'widget_id' ); ?>"><?php _e( 'Twitter Widget ID:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'widget_id' ); ?>" name="<?php echo $this->get_field_name( 'widget_id' ); ?>" value="<?php echo $instance['widget_id']; ?>" />

</p>

<p class="description"><?php _e( 'You need to ', 'gameleon' ); ?>

<a target="blank" href="https://twitter.com/settings/widgets"><?php _e( 'create a Twitter widget', 'gameleon' ); ?></a>

<?php _e( 'and obtain a widget ID. After creating the widget, the Twitter widget ID will be a long number on your browser url between the /widgets/ and /edit portion of the url.', 'gameleon' ); ?>

</p>



<p>

<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Limit number of Tweets:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />

</p>



<h4 style="line-height: 18px;"><div class="dashicons dashicons-googleplus" style="padding-right:5px"></div><?php _e( 'Google+ Tab Options', 'gameleon' ); ?></h4>



<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_google' ); ?>" name="<?php echo $this->get_field_name( 'show_google' ); ?>"<?php checked( $instance['show_google'] ); ?> />

<label for="<?php echo $this->get_field_id( 'show_google' ); ?>"><?php _e( 'Show Google+ Tab', 'gameleon' ); ?></label>

</p>



<p>

<label for="<?php echo $this->get_field_id( 'google_title' ); ?>"><?php _e( 'Google+ Tab Title:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'google_title' ); ?>" name="<?php echo $this->get_field_name( 'google_title' ); ?>" value="<?php echo $instance['google_title']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'page_type' ); ?>"><?php _e( 'Page type', 'gameleon' ); ?>:</label>



<select id="<?php echo $this->get_field_id( 'page_type' ); ?>" name="<?php echo $this->get_field_name( 'page_type' ); ?>" class="widefat">

<option value="profile"<?php if( $page_type=="profile" ) echo ' selected="selected"';?>><?php _e( 'Profile', 'gameleon' );?></option>

<option value="page"<?php if( $page_type=="page" ) echo ' selected="selected"';?>><?php _e( 'Page', 'gameleon' );?></option>

<option value="community"<?php if( $page_type=="community" ) echo ' selected="selected"';?>><?php _e( 'Community', 'gameleon' );?></option>

</select>

</p>



<p>

<label for="<?php echo $this->get_field_id( 'page_url' ); ?>"><?php _e( 'Google+ Page Url:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php echo $instance['page_url']; ?>" />

</p>





<p>

<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" />

</p>





<p>

<label for="<?php echo $this->get_field_id( 'color_scheme' ); ?>"><?php _e( 'Color Scheme', 'gameleon' ); ?>:</label>

<select id="<?php echo $this->get_field_id( 'color_scheme' ); ?>" name="<?php echo $this->get_field_name( 'color_scheme' ); ?>" class="widefat">

<option value="light"<?php if( $color_scheme=="light" ) echo ' selected="selected"';?>><?php _e( 'Light', 'gameleon' );?></option>

<option value="dark"<?php if( $color_scheme=="dark" ) echo ' selected="selected"';?>><?php _e( 'Dark', 'gameleon' );?></option>

</select>

</p>





<p>

<label for="<?php echo $this->get_field_id( 'gp_layout' ); ?>"><?php _e( 'Layout', 'gameleon' ); ?>:</label>

<select id="<?php echo $this->get_field_id( 'gp_layout' ); ?>" name="<?php echo $this->get_field_name('gp_layout'); ?>" class="widefat">

<option value="portrait"<?php if( $gp_layout=="portrait" ) echo ' selected="selected"';?>><?php _e( 'Portrait', 'gameleon' );?></option>

<option value="landscape"<?php if( $gp_layout=="landscape" ) echo ' selected="selected"';?>><?php _e( 'Landscape', 'gameleon' );?></option>

</select>

</p>







<p>

<input class="checkbox" type="checkbox" <?php checked( $instance['cover_photo'], 'on' ); ?> id="<?php echo $this->get_field_id( 'cover_photo' ); ?>" name="<?php echo $this->get_field_name( 'cover_photo' ); ?>" />

<label for="<?php echo $this->get_field_id( 'cover_photo' ); ?>"><?php _e( 'Cover Photo', 'gameleon' ); ?></label>

</p>





<p>

<input class="checkbox" type="checkbox" <?php checked( $instance['tagline'], 'on' ); ?> id="<?php echo $this->get_field_id( 'tagline' ); ?>" name="<?php echo $this->get_field_name( 'tagline' ); ?>" />

<label for="<?php echo $this->get_field_id( 'tagline' ); ?>"><?php _e( 'Tagline', 'gameleon' ); ?></label>

</p>



<?php

  }



}



/*----------------------------------------------------------------------------------------------------------

  Register Gameleon_Social_Tabs widget

-----------------------------------------------------------------------------------------------------------*/



function gameleon_social_tabs_init(){

  register_widget( 'Gameleon_Social_Tabs' );

}



add_action( 'widgets_init', 'gameleon_social_tabs_init' );