<?php
/*----------------------------------------------------------------------------------------------------------
  Gameleon_Vertical_Scroller widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Vertical_Scroller extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

function __construct() {
  parent::__construct(
      'gameleon_vertical_scroller', // Base Widget ID
      __( '[GAMELEON] Carousel Post', 'gameleon' ), // Widget Name
      array( 'description' => __( 'A widget that displays posts in a vertical ticker, ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args
      );
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
extract( $args );

$title            		 = apply_filters( 'widget_title', $instance['title'] );
$orderby               = apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
$readmore          	   = $instance['readmore'];
$smallexcerpt       	 = $instance['smallexcerpt'];
$td_trim_title_small	 = $instance['td_trim_title_small'];
$post_type          	 = 'all';
$posts 					       = $instance['posts'];
$categories 			     = $instance['categories'];
$disable_thumb			   = ! empty( $instance['disable_thumb'] ) ? '1' : '0';
$show_footer_box 		   = ! empty( $instance['show_footer_box'] ) ? '1' : '0';

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

<div class="widget-title">
<h3>
<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
	<?php echo $title; ?>
</a>
</h3>
</div>

<div class="td-wrap-content-sidebar">


<?php
// ----------- SMALL MODULE
// ---------------------------------------------------------------------------
?>

<ul id="vertical-ticker">
	<div class="td-fly-in" >
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


<li>
<div class="td-small-module">

<div class="td-post-details"><?php // td-post-details ?>

<?php
// ----------- thumbnails
// ---------------------------------------------------------------------------
?>

<?php if( $disable_thumb == 0 ): ?>
<?php get_template_part( 'post-img' ); ?>
<?php endif; ?>

<?php
// ----------- small title
// ---------------------------------------------------------------------------
?>

<h2>
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
	<?php echo wp_trim_words( get_the_title(), $td_trim_title_small ); ?>
</a>
</h2>

<?php
// ----------- small excerpt
// ---------------------------------------------------------------------------
?>
<p>
<?php echo td_global_excerpt( $smallexcerpt ); ?>
</p>

</div><?php // end of td-post-details ?>


<?php
// -----------  meta
// ---------------------------------------------------------------------------
?>
<div class="clearfix"></div>


<?php get_template_part( 'post-meta' ); ?>

</div><?php // end of .td-small-module ?>
<div class="clearfix"></div>
</li>
<?php endwhile; ?>
</div><?php // end of .td-fly-in ?>
</ul>

</div><?php // end of td-wrap-content-sidebar ?>

<?php
// ----------- footer box
// ---------------------------------------------------------------------------
?>

<?php if( $show_footer_box == 1 ): ?>

<div class="moregames">
<div class="gamesnumber tooltip" title="<?php echo $recent_posts->found_posts; ?> <?php _e( 'articles in this category', 'gameleon' ); ?>">
<?php echo $recent_posts->found_posts; ?>
</div>
<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
<div class="moregames-link">
<?php echo $readmore; ?>
</div>
</a>
</div><?php // end of moregames ?>

<?php endif; ?>

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
$instance['readmore']             	= $new_instance['readmore'];
$instance['smallexcerpt']          	= $new_instance['smallexcerpt'];
$instance['td_trim_title_small']	  = $new_instance['td_trim_title_small'];
$instance['post_type']             	= 'all';
$instance['posts']                 	= $new_instance['posts'];
$instance['categories']            	= $new_instance['categories'];
$instance['disable_thumb']     		  = $new_instance['disable_thumb'];
$instance['show_footer_box']       	= $new_instance['show_footer_box'];
$instance['show_statistics']       	= $new_instance['show_statistics'];

return $instance;
}


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
$defaults = array(
'title'             	=> 'Recent Posts',
'readmore'         	=> 'Read More',
'orderby'             => 'date',
'smallexcerpt' 			  => '8',
'td_trim_title_small'	=> '2',
'post_type'         	=> 'all',
'posts' 				      => 4,
'categories' 			    => 'all',
'disable_thumb'			  => 'off',
'show_footer_box' 		=> 'on',
'show_statistics' 		=> 'on'
);

$orderby = isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$instance = wp_parse_args( (array) $instance, $defaults );



/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Carousel Options', 'gameleon' ); ?></h4>

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
<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to scroll:', 'gameleon' ); ?></label>
<input id="<?php echo $this->get_field_id('posts'); ?>"  class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
</p>



<h4 style="line-height: 20px;"><div class="dashicons dashicons-admin-generic" style="padding-right:5px"></div><?php _e( 'Other Options', 'gameleon' ); ?></h4>

<p>
<label for="<?php echo $this->get_field_id( 'td_trim_title_small' ); ?>"><?php _e( 'Post title length in words', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'td_trim_title_small' ); ?>" name="<?php echo $this->get_field_name( 'td_trim_title_small' ); ?>" value="<?php echo $instance['td_trim_title_small']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'smallexcerpt' ); ?>"><?php _e( 'Excerpt length in words', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'smallexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'smallexcerpt' ); ?>" value="<?php echo $instance['smallexcerpt']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo $instance['readmore']; ?>" />
</p>
<p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['disable_thumb'], 'on' ); ?> id="<?php echo $this->get_field_id('disable_thumb'); ?>" name="<?php echo $this->get_field_name( 'disable_thumb' ); ?>" />
<label for="<?php echo $this->get_field_id('disable_thumb'); ?>"><?php _e( 'Disable Post Thumbnail', 'gameleon' ); ?></label>
</p>

<p>
<input class="checkbox" type="checkbox" <?php checked( $instance['show_footer_box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_footer_box' ); ?>" name="<?php echo $this->get_field_name( 'show_footer_box' ); ?>" />
<label for="<?php echo $this->get_field_id( 'show_footer_box' ); ?>"><?php _e( 'Show footer box', 'gameleon' ); ?></label>
</p>


<?php
}

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Vertical_Scroller widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_vertical_scroller_init(){
register_widget( 'Gameleon_Vertical_Scroller' );
}

add_action( 'widgets_init', 'gameleon_vertical_scroller_init' );