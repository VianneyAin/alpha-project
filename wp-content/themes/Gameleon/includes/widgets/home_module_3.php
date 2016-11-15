<?php



/*----------------------------------------------------------------------------------------------------------

	Tigu_Home_Module_3 Widget class

-----------------------------------------------------------------------------------------------------------*/

class Tigu_Home_Module_3 extends WP_Widget {





/*----------------------------------------------------------------------------------------------------------

Register widget with WordPress

-----------------------------------------------------------------------------------------------------------*/



public function __construct() {

parent::__construct(

'tigu_home_module_3',

__( '[GAMELEON] Home Block 3', 'gameleon' ), // Widget Name

array( 'description' => __( 'Displays two modules with a big images, showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args

);

}





/*----------------------------------------------------------------------------------------------------------

Front-end display of widget

-----------------------------------------------------------------------------------------------------------*/



public function widget( $args, $instance ) {

extract( $args );



$title            		= apply_filters( 'widget_title', $instance['title'] );

$orderby 				= apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );

$readmore          		= $instance['readmore'];

$bigexcerpt 			= $instance['bigexcerpt'];

$posts 					= $instance['posts'];

$td_trim_title_big		= $instance['td_trim_title_big'];

$post_type          	= 'all';

$categories 			= $instance['categories'];

$show_post_meta			= ! empty( $instance['show_post_meta'] ) ? '1' : '0';

$show_footer_box 		= ! empty( $instance['show_footer_box'] ) ? '1' : '0';



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



<?php // =============================== LEFT BLOCK =============================== ?>









<div class="td-content-inner">



<div class="widget-title">

<h3>

<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?>

</a>

</h3>

</div>



<div class="td-wrap-content">

<div class="td-fly-in">

<?php

global $wp_query, $paged;

$metakey = 'post_views_count';

$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );

$temp_query = $wp_query;

$wp_query = null;

$wp_query = $recent_posts;

?>



<div class="grid col-340">

<div class="td-post-details-3">

<?php $i = 0; ?>

<?php while($recent_posts->have_posts()) : $i++; if(($i % 2) == 0) : $wp_query->next_post(); else : $recent_posts->the_post(); ?>



<?php

// ----------- big featured image

// ---------------------------------------------------------------------------

?>



<?php get_template_part( 'post-img-home-modules' ); // big featured image ?>



<?php

// ----------- big image title

// ---------------------------------------------------------------------------

?>



<h2 class="td-big-title">

<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">

	<?php echo wp_trim_words( get_the_title(), $td_trim_title_big ); ?>

</a>

</h2>



<?php

// ----------- big date and comments

// ---------------------------------------------------------------------------

?>

<?php if( $show_post_meta == 1 ): ?>

<?php get_template_part( 'post-meta-small' ); // date and comments ?>

<?php endif; ?>

<?php

// ----------- big excerpt

// ---------------------------------------------------------------------------

?>



<p class="module-excerpt">

<?php echo td_global_excerpt( $bigexcerpt ); ?>

</p>

<?php endif; endwhile; ?>

</div><?php // end of td-post-details-3 ?>

</div><?php // end of grid col-340 ?>













<div class="grid col-340 fit">

<div class="td-post-details-3">

<?php $i = 0; rewind_posts(); ?>

<?php while($recent_posts->have_posts()) : $i++; if(($i % 2) !== 0) : $wp_query->next_post(); else : $recent_posts->the_post(); ?>





<?php

// ----------- big featured image

// ---------------------------------------------------------------------------

?>



<?php get_template_part( 'post-img-home-modules' ); // big featured image ?>



<?php

// ----------- big image title

// ---------------------------------------------------------------------------

?>



<h2 class="td-big-title">

<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">

	<?php echo wp_trim_words( get_the_title(), $td_trim_title_big ); ?>

</a>

</h2>



<?php

// ----------- big date and comments

// ---------------------------------------------------------------------------

?>

<?php if( $show_post_meta == 1 ): ?>

<?php get_template_part( 'post-meta-small' ); // date and comments ?>

<?php endif; ?>

<?php

// ----------- big excerpt

// ---------------------------------------------------------------------------

?>



<p class="module-excerpt">

<?php echo td_global_excerpt( $bigexcerpt ); ?>

</p>

<?php endif; endwhile; ?>

</div><?php // end of td-post-details-3 ?>

</div><?php // end of grid col-340 ?>



</div><?php // end of fly-in ?>

</div><?php // end of td-wrap-content ?>



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

</div>



<?php endif; ?>



</div><?php // end of td-content-inner ?>



<?php echo $after_widget;



}





/*----------------------------------------------------------------------------------------------------------

  Sanitize widget form values as they are saved

-----------------------------------------------------------------------------------------------------------*/



public function update( $new_instance, $old_instance ) {

$instance = array();

$instance 							= $old_instance;

$instance['title']                 	= strip_tags( $new_instance['title'] );

$instance['orderby'] 				= strip_tags( $new_instance['orderby'] );

$instance['readmore']             	= $new_instance['readmore'];

$instance['posts']                 	= $new_instance['posts'];

$instance['bigexcerpt']            	= $new_instance['bigexcerpt'];

$instance['td_trim_title_big']		= $new_instance['td_trim_title_big'];

$instance['post_type']             	= 'all';

$instance['categories']            	= $new_instance['categories'];

$instance['show_post_meta']     	= $new_instance['show_post_meta'];

$instance['show_footer_box']       	= $new_instance['show_footer_box'];



return $instance;

}





/*----------------------------------------------------------------------------------------------------------

  Back-end widget form

-----------------------------------------------------------------------------------------------------------*/



public function form( $instance ) {

$defaults = array(

'title'             	=> 'Recent Posts',

'readmore'         		=> 'Read More',

'orderby'				=> 'date',

'bigexcerpt' 			=> '20',

'posts' 				=> 4,

'td_trim_title_big'		=> '3',

'post_type'         	=> 'all',

'categories' 			=> 'all',

'show_post_meta'		=> 'on',

'show_footer_box' 		=> 'on'

);



$orderby 	= isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';



$instance 	= wp_parse_args( (array) $instance, $defaults );







/*----------------------------------------------------------------------------------------------------------

  Widget Options

-----------------------------------------------------------------------------------------------------------*/

?>



<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Module Options', 'gameleon' ); ?></h4>



<p>

<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Module Title:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>

<input id="<?php echo $this->get_field_id('posts'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />

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

<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo $instance['readmore']; ?>" />

</p>

<p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>





<h4 style="line-height: 20px;"><div class="dashicons dashicons-admin-generic" style="padding-right:5px"></div><?php _e( 'Other Options', 'gameleon' ); ?></h4>



<p>

<label for="<?php echo $this->get_field_id( 'td_trim_title_big' ); ?>"><?php _e( 'Title length in words:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'td_trim_title_big' ); ?>" name="<?php echo $this->get_field_name( 'td_trim_title_big' ); ?>" value="<?php echo $instance['td_trim_title_big']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>"><?php _e( 'Excerpt length in words', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'bigexcerpt' ); ?>" value="<?php echo $instance['bigexcerpt']; ?>" />

</p>



<p>

<input class="checkbox" type="checkbox" <?php checked( $instance['show_post_meta'], 'on' ); ?> id="<?php echo $this->get_field_id('show_post_meta'); ?>" name="<?php echo $this->get_field_name( 'show_post_meta' ); ?>" />

<label for="<?php echo $this->get_field_id('show_post_meta'); ?>"><?php _e( 'Show post meta', 'gameleon' ); ?></label>

</p>



<p>

<input class="checkbox" type="checkbox" <?php checked( $instance['show_footer_box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_footer_box' ); ?>" name="<?php echo $this->get_field_name( 'show_footer_box' ); ?>" />

<label for="<?php echo $this->get_field_id( 'show_footer_box' ); ?>"><?php _e( 'Show footer box', 'gameleon' ); ?></label>

</p>





<?php

}



}



/*----------------------------------------------------------------------------------------------------------

  Register Tigu_Home_Module_3 widget

-----------------------------------------------------------------------------------------------------------*/



function tigu_home_module_3_init(){

register_widget( 'Tigu_Home_Module_3' );

}



add_action( 'widgets_init', 'tigu_home_module_3_init' );