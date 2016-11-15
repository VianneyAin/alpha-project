<?php

/*----------------------------------------------------------------------------------------------------------
  Tigu_Tabs_Widget Widget class
-----------------------------------------------------------------------------------------------------------*/
class Tigu_Tabs_Widget extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

    public function __construct() {
        parent::__construct(
            'tigu_tabs_widget',
            __( '[GAMELEON] Home Tabs', 'gameleon' ), // Widget Name
            array( 'description' => __( 'A widget that displays the tabs of recent posts, most popular posts, most viewed/played posts and random posts on your home page.', 'gameleon' ), ) // Widget Args
            );
    }


/*----------------------------------------------------------------------------------------------------------
  Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
  extract( $args );
  $posts                = $instance['posts'];
  //$td_trim_title_tabs   = $instance['td_trim_title_tabs'];
  $exclude_cat          = !empty( $instance['exclude_cat'] ) ? $instance['exclude_cat'] : NULL;
  $exclude_cat_pop      = !empty( $instance['exclude_cat_pop'] ) ? $instance['exclude_cat_pop'] : NULL;
  $exclude_cat_most     = !empty( $instance['exclude_cat_most'] ) ? $instance['exclude_cat_most'] : NULL;
  $exclude_cat_rand     = !empty( $instance['exclude_cat_rand'] ) ? $instance['exclude_cat_rand'] : NULL;
  $show_recent_posts    = ! empty( $instance['show_recent_posts'] ) ? '1' : '0';
  $show_popular_posts   = ! empty( $instance['show_popular_posts'] ) ? '1' : '0';
  $show_most_played     = ! empty( $instance['show_most_played'] ) ? '1' : '0';
  $show_random_posts    = ! empty( $instance['show_random_posts'] ) ? '1' : '0';
  ?>

<?php echo $before_widget; ?>

<div id="td-home-tabs">

<div class="tabs-wrapper">

<?php
// ----------- TABS TITLES
// ---------------------------------------------------------------------------
?>

<div class="tabs">
<ul class="tab-links">
<?php if( $show_recent_posts  == 1 ): ?>
<li class="active">
<a href="#tab1">
<?php if( defined( 'MYARCADE_VERSION') ) : ?><?php _e( 'Latest Games', 'gameleon' ); ?><?php else: ?><?php _e( 'Latest Articles', 'gameleon' ); ?><?php endif; ?>
</a>
</li>
<?php endif; ?>

<?php
// ----------- TAB TITLE 2
// ---------------------------------------------------------------------------
?>

<?php if( $show_popular_posts == 1 ): ?>
<li>
<a href="#tab2">
<?php _e( 'Most Popular', 'gameleon' ); ?>
</a>
</li>
<?php endif; ?>

<?php
// ----------- TAB TITLE 3
// ---------------------------------------------------------------------------
?>

<?php if( $show_most_played   == 1 ): ?>
<li>
<a href="#tab3">
<?php if( defined( 'MYARCADE_VERSION') ) : ?><?php _e( 'Most Played', 'gameleon' ); ?><?php else: ?><?php _e( 'Most Viewed', 'gameleon' ); ?><?php endif; ?>
</a>
</li>
<?php endif; ?>

<?php
// ----------- TAB TITLE 4
// ---------------------------------------------------------------------------
?>

<?php if( $show_random_posts  == 1 ): ?>
<li>
<a href="#tab4">
<?php if( defined( 'MYARCADE_VERSION') ) : ?><?php _e( 'Random Games', 'gameleon' ); ?><?php else: ?><?php _e( 'Random Articles', 'gameleon' ); ?><?php endif; ?>
</a>
</li>
<?php endif; ?>
</ul>


<div class="tab-content">
<div class="td-fly-in">
<?php
// ----------- TAB CONTENT 1
// ---------------------------------------------------------------------------
?>

<?php if( $show_recent_posts  == 1 ): ?>
<div id="tab1" class="tab active">

<?php
$exclude_recent_posts = $exclude_cat;
$exclude_recent_posts = explode(',',$exclude_recent_posts); //break the string into array keys
global $wp_query, $paged;
if( get_query_var( 'paged' ) ) {
$paged = get_query_var( 'paged' );
} elseif( get_query_var( 'page' ) ) {
$paged = get_query_var( 'page' );
} else {
$paged = 1;
}
$recent_posts = new WP_Query( array( 'category__not_in' => $exclude_recent_posts, 'orderby' => 'date', 'posts_per_page' => 4, 'paged' => $paged ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>
<?php while( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
<?php get_template_part( 'post-tabs' ); ?>
<?php endwhile; wp_reset_query(); ?>

</div><?php // end of #tab1 ?>
<?php endif; ?>


<?php
// ----------- TAB CONTENT 2
// ---------------------------------------------------------------------------
?>

<?php if( $show_popular_posts == 1 ): ?>
<div id="tab2" class="tab">

<?php
$exclude_popular_posts = $exclude_cat;
$exclude_popular_posts = explode(',',$exclude_popular_posts); //break the string into array keys
global $wp_query, $paged;
if( get_query_var( 'paged' ) ) {
$paged = get_query_var( 'paged' );
} elseif( get_query_var( 'page' ) ) {
$paged = get_query_var( 'page' );
} else {
$paged = 1;
}
$popular_posts = new WP_Query( array( 'category__not_in' => $exclude_popular_posts, 'orderby' => 'comment_count', 'posts_per_page' => 4, 'paged' => $paged ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $popular_posts;
?>
<?php while( $popular_posts->have_posts() ) : $popular_posts->the_post(); ?>
<?php get_template_part( 'post-tabs' ); ?>
<?php endwhile; wp_reset_query(); ?>

</div><?php // end of #tab2 ?>
<?php endif; ?>

<?php
// ----------- TAB CONTENT 3
// ---------------------------------------------------------------------------
?>

<?php if( $show_most_played   == 1 ): ?>
<div id="tab3" class="tab">

<?php
$td_metakey = 'post_views_count';
$exclude_most_viewed_posts = $exclude_cat;
$exclude_most_viewed_posts = explode(',',$exclude_most_viewed_posts); //break the string into array keys
global $wp_query, $paged;
if( get_query_var( 'paged' ) ) {
$paged = get_query_var( 'paged' );
} elseif( get_query_var( 'page' ) ) {
$paged = get_query_var( 'page' );
} else {
$paged = 1;
}
$most_viewed = new WP_Query( array( 'category__not_in' => $exclude_most_viewed_posts, 'orderby' => 'meta_value_num', 'posts_per_page' => 4, 'meta_key' => $td_metakey, 'paged' => $paged ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $most_viewed;
?>
<?php while( $most_viewed->have_posts() ) : $most_viewed->the_post(); ?>
<?php get_template_part( 'post-tabs' ); ?>
<?php endwhile; wp_reset_query(); ?>

</div><?php // end of #tab3 ?>
<?php endif; ?>

<?php
// ----------- TAB CONTENT 4
// ---------------------------------------------------------------------------
?>

<?php if( $show_random_posts  == 1 ): ?>
<div id="tab4" class="tab">

<?php
$exclude_random_posts = $exclude_cat;
$exclude_random_posts = explode(',',$exclude_random_posts); //break the string into array keys
global $wp_query, $paged;
if( get_query_var( 'paged' ) ) {
$paged = get_query_var( 'paged' );
} elseif( get_query_var( 'page' ) ) {
$paged = get_query_var( 'page' );
} else {
$paged = 1;
}
$random_posts = new WP_Query( array( 'category__not_in' => $exclude_random_posts, 'orderby' => 'rand', 'posts_per_page' => 4, 'paged' => $paged ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $random_posts;
?>
<?php while( $random_posts->have_posts() ) : $random_posts->the_post(); ?>
<?php get_template_part( 'post-tabs' ); ?>
<?php endwhile; wp_reset_query(); ?>

</div><?php // end of #tab4 ?>
<?php endif; ?>
</div><?php // end of tab-content ?>
</div><?php // end of tab-content ?>
</div><?php // end of tabs ?>
</div><?php // end of tabs-wrapper ?>
</div><?php // end of #td-home-tabs ?>

<?php echo $after_widget;
}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
  $instance = array();

      $instance = $old_instance;
      $instance['posts']              = $new_instance['posts'];
      $instance['exclude_cat']        = esc_attr( $new_instance['exclude_cat'] );
      $instance['exclude_cat_pop']    = esc_attr( $new_instance['exclude_cat_pop'] );
      $instance['exclude_cat_most']   = esc_attr( $new_instance['exclude_cat_most'] );
      $instance['exclude_cat_rand']   = esc_attr( $new_instance['exclude_cat_rand'] );
      $instance['show_recent_posts']  = $new_instance['show_recent_posts'];
      $instance['show_popular_posts'] = $new_instance['show_popular_posts'];
      $instance['show_most_played']   = $new_instance['show_most_played'];
      $instance['show_random_posts']  = $new_instance['show_random_posts'];
      //$instance['td_trim_title_tabs'] = $new_instance['td_trim_title_tabs'];

      return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
  $defaults = array(
    'exclude_cat'         => '',
    'exclude_cat_pop'     => '',
    'exclude_cat_most'    => '',
    'exclude_cat_rand'    => '',
    //'td_trim_title_tabs'  => '2',
    'show_popular_posts'  => 'on',
    'show_recent_posts'   => 'on',
    'show_most_played'    => 'on',
    'show_random_posts'   => 'on'
    );

  $instance = wp_parse_args((array) $instance, $defaults );
      ?>


<!-- START ADMIN WIDGETS AREA -->

<p>
  <input class="checkbox" type="checkbox" <?php checked( $instance['show_recent_posts'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_recent_posts' ); ?>" name="<?php echo $this->get_field_name( 'show_recent_posts' ); ?>" />
  <label for="<?php echo $this->get_field_id('show_recent_posts'); ?>"><?php _e( 'Show Recent Posts tab', 'gameleon' ); ?></label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('exclude_cat'); ?>">Exclude categories from Recent Posts:</label>
  <input class="widefat" type="text"  id="<?php echo $this->get_field_id('exclude_cat'); ?>" name="<?php echo $this->get_field_name('exclude_cat'); ?>" value="<?php echo $instance['exclude_cat']; ?>" />
</p>


<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_popular_posts'); ?>" name="<?php echo $this->get_field_name('show_popular_posts'); ?>" />
  <label for="<?php echo $this->get_field_id('show_popular_posts'); ?>"><?php _e( 'Show Most Popular Posts tab', 'gameleon' ); ?></label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('exclude_cat_pop'); ?>">Exclude categories from Popular Posts:</label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id('exclude_cat_pop'); ?>" name="<?php echo $this->get_field_name('exclude_cat_pop'); ?>" value="<?php echo $instance['exclude_cat_pop']; ?>" />
</p>


<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_most_played'], 'on'); ?> id="<?php echo $this->get_field_id('show_most_played'); ?>" name="<?php echo $this->get_field_name('show_most_played'); ?>" />
  <label for="<?php echo $this->get_field_id('show_most_played'); ?>"><?php _e( 'Show Most Viewed Posts tab', 'gameleon' ); ?></label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('exclude_cat_most'); ?>">Exclude categories from Most Viewed Posts:</label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id('exclude_cat_most'); ?>" name="<?php echo $this->get_field_name('exclude_cat_most'); ?>" value="<?php echo $instance['exclude_cat_most']; ?>" />
</p>

<p>
  <input class="checkbox" type="checkbox" <?php checked($instance['show_random_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_random_posts'); ?>" name="<?php echo $this->get_field_name('show_random_posts'); ?>" />
  <label for="<?php echo $this->get_field_id('show_random_posts'); ?>"><?php _e( 'Show Random Posts tab', 'gameleon' ); ?></label>
</p>

<p>
  <label for="<?php echo $this->get_field_id('exclude_cat_rand'); ?>">Exclude categories from Random Posts:</label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id('exclude_cat_rand'); ?>" name="<?php echo $this->get_field_name('exclude_cat_rand'); ?>" value="<?php echo $instance['exclude_cat_rand']; ?>" />
</p>
<p class="description">You can exclude certain categories by typing their IDs, separated by comma and no spaces. Example: 3,4,21,68,9,11</p>

<!-- END ADMIN WIDGETS AREA -->

        <?php
    }

}

/*----------------------------------------------------------------------------------------------------------
  Register Tigu_Tabs_Widget widget
-----------------------------------------------------------------------------------------------------------*/

function tigu_tabs_widget_init(){
    register_widget( 'Tigu_Tabs_Widget' );
}

add_action( 'widgets_init', 'tigu_tabs_widget_init' );