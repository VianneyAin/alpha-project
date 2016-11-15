<?php
/*----------------------------------------------------------------------------------------------------------
  Gameleon_Post_Slider widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Post_Slider extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
      'gameleon_post_slider', // Base Widget ID
      __( '[GAMELEON] Sidebar Slider', 'gameleon' ), // Widget Name
      array( 'description' => __( 'A widget that displays a slider showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
      );
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title            		 = apply_filters( 'widget_title', $instance['title'] );
$orderby               = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$post_type          	 = 'all';
$posts 					       = $instance['posts'];
$categories 			     = $instance['categories'];
$show_date 		         = ! empty( $instance['show_date'] ) ? '1' : '0';

echo $before_widget;
?>

<?php
$post_types = get_post_types();
unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
if( $post_type == 'all' ) {
$post_type_array = $post_types;
} else {
$post_type_array = $post_type;
}
?>


<?php // =============================== MAIN BLOCK =============================== ?>

<?php if ( $title ) : ?>
<div class="widget-title">
<h3>
<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
	<?php echo $title; ?>
</a>
</h3>
</div>
<?php endif; ?>

<div class="td-wrap-content-sidebar">


<?php
// ----------- SLIDER CONTENT
// ---------------------------------------------------------------------------
?>

<div id="owl-sidebar" class="owl-carousel owl-theme">

<?php
// ----------- QUERY
// ---------------------------------------------------------------------------
?>

<?php
global $wp_query, $paged;
$metakey = 'post_views_count';
$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $recent_posts;
?>

<?php while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>
<div class="td-fly-in" >
<div class="td-small-module">


<?php get_template_part( 'post-img-owl' ); ?>
<h2>
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
  <?php echo wp_trim_words( get_the_title(), 5 ); ?>
</a>
</h2>

<?php if( $show_date ): ?>
<div class="td-owl-date">
<div class="block-meta">
<?php the_time('F j, Y') ?>
</div>
</div>
<?php endif; ?>


</div><?php // end of .td-small-module ?>
</div><?php // end of .td-fly-in ?>
<?php endwhile; ?>
</div><?php // end of #owl-sidebar ?>



</div><?php // end of td-wrap-content-sidebar ?>


<?php echo $after_widget;

}


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance 						   	          = $old_instance;
$instance['title']                 	= strip_tags( $new_instance['title'] );
$instance['orderby']                = strip_tags( $new_instance['orderby'] );
$instance['post_type']             	= 'all';
$instance['posts']                 	= $new_instance['posts'];
$instance['categories']            	= $new_instance['categories'];
$instance['show_date']       	      = $new_instance['show_date'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'             	=> 'Recent Posts',
'orderby'             => 'date',
'bigexcerpt' 			    => '20',
'post_type'         	=> 'all',
'posts' 				      => 4,
'categories' 			    => 'all',
'show_date' 		      => 'on'
);

$orderby = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$instance = wp_parse_args( (array) $instance, $defaults );



/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Slider Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
<?php foreach( $categories as $category ) { ?>
<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>
<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>
<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>
<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>
<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to slide:', 'gameleon' ); ?></label>
<input id="<?php echo $this->get_field_id('posts'); ?>"  class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_date'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show Date', 'gameleon' ); ?></label>
</p>


<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Post_Slider widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_post_slider_init(){
register_widget( 'Gameleon_Post_Slider' );
}

add_action( 'widgets_init', 'gameleon_post_slider_init' );