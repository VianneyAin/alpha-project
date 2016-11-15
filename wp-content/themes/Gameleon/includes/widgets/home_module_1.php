<?php



/*----------------------------------------------------------------------------------------------------------

	Tigu_Home_Module_1 Widget class

-----------------------------------------------------------------------------------------------------------*/

class Tigu_Home_Module_1 extends WP_Widget {





/*----------------------------------------------------------------------------------------------------------

Register widget with WordPress

-----------------------------------------------------------------------------------------------------------*/



public function __construct() {

parent::__construct(

'tigu_home_module_1',

__( '[GAMELEON] Home Block 1', 'gameleon' ), // Widget Name

array( 'description' => __( 'Displays a block with two modules in line, one category for each block, showing your posts ordered by: date, most popular, most viewed or in a random order.', 'gameleon' ), ) // Widget Args

);

}





/*----------------------------------------------------------------------------------------------------------

Front-end display of widget

-----------------------------------------------------------------------------------------------------------*/



public function widget( $args, $instance ) {

extract( $args );



$title            		= apply_filters( 'widget_title', $instance['title'] );

$title_2           		= apply_filters( 'widget_title', $instance['title_2'] );

$orderby 				= apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );

$orderby_2 				= apply_filters ( 'orderby_2', isset ( $instance ['orderby_2'] ) ? $instance ['orderby_2'] : '' );

$readmore          		= $instance['readmore'];

$readmore_2          	= $instance['readmore_2'];

$bigexcerpt 			= $instance['bigexcerpt'];

$smallexcerpt       	= $instance['smallexcerpt'];

$td_trim_title_small	= $instance['td_trim_title_small'];

$td_trim_title_big		= $instance['td_trim_title_big'];

$post_type          	= 'all';

$post_type_2 			= 'all';

$posts 					= $instance['posts'];

$posts_2 				= $instance['posts_2'];

$categories 			= $instance['categories'];

$categories_2 			= $instance['categories_2'];

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



<div class="grid col-340">

<div class="td-content-inner">



<div class="widget-title">

<h3>

<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?></a>

</h3>

</div>



<div class="td-wrap-content">



<?php

global $wp_query, $paged;

$metakey = 'post_views_count';

$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $posts ) );

$temp_query = $wp_query;

$wp_query = null;

$wp_query = $recent_posts;

?>



<?php $counter = 1; ?>

<?php while( $recent_posts->have_posts() ): $recent_posts->the_post(); ?>



<?php if( $counter == 1 ): ?>



<div class="td-fly-in">



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



<p>

<?php echo td_global_excerpt( $bigexcerpt ); ?>

</p>



</div><?php // end of td-fly-in ?>



<?php else: // elseif( $counter !== 1 ?>



<?php

// ----------- SMALL MODULE

// ---------------------------------------------------------------------------

?>



<div class="td-small-module">

<div class="td-fly-in" >



<div class="show-tha-border"></div>



<div class="td-post-details"><?php // td-post-details ?>



<?php

// ----------- thumbnails

// ---------------------------------------------------------------------------

?>



<?php get_template_part( 'post-img' ); ?>



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



<?php if( $show_post_meta == 1 ): ?>

<?php get_template_part( 'post-meta' ); // date, views, likes comments?>

<?php endif; ?>



</div><?php // end of .td-fly-in ?>

</div><?php // end of .td-small-module ?>



<?php endif; // end of if counter = 1 ?>



<?php $counter++; endwhile; ?>



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

</div><?php // end of grid col-340 ?>



<?php // =============================== RIGHT BLOCK =============================== ?>



<?php

$post_types = get_post_types();

unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);



if( $post_type_2 == 'all' ) {

$post_type_2_array = $post_types;

} else {

$post_type_2_array = $post_type;

}

?>



<div class="grid col-340 fit">

<div class="td-content-inner">



<div class="widget-title">

<h3>

	<a href="<?php echo esc_url( get_category_link( $categories_2 ) ); ?>"><?php echo $title_2; ?></a>

</h3>

</div>



<div class="td-wrap-content">



<?php

global $wp_query, $paged;

$metakey_2 = 'post_views_count';

$recent_posts_2 = new WP_Query( array( 'cat' => $categories_2, 'orderby' => $orderby_2, 'meta_key' => $metakey_2, 'posts_per_page' => $posts_2 ) );

$temp_query = $wp_query;

$wp_query = null;

$wp_query = $recent_posts_2;

?>



<?php $counter = 1; ?>

<?php while( $recent_posts_2->have_posts() ): $recent_posts_2->the_post(); ?>



<?php if( $counter == 1 ): ?>



<div class="td-fly-in">



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



<p>

<?php echo td_global_excerpt( $bigexcerpt ); ?>

</p>



</div><?php // end of td-fly-in ?>



<?php else: // elseif( $counter !== 1 ?>



<?php

// ----------- SMALL MODULE

// ---------------------------------------------------------------------------

?>



<div class="td-small-module">

<div class="td-fly-in" >



<div class="show-tha-border"></div>



<div class="td-post-details"><?php // td-post-details ?>

<?php

// ----------- thumbnails

// ---------------------------------------------------------------------------

?>



<?php get_template_part( 'post-img' ); ?>



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



<?php if( $show_post_meta == 1 ): ?>



<?php get_template_part( 'post-meta' ); ?>



<?php endif; ?>





</div><?php // end of .td-fly-in ?>

</div><?php // end of .td-small-module ?>



<?php endif; ?><?php // end of $counter == 1 ?>



<?php $counter++; endwhile; ?>



</div><?php // end of td-wrap-content ?>





<?php

// ----------- footer box

// ---------------------------------------------------------------------------

?>



<?php if( $show_footer_box == 1 ): ?>



<div class="moregames">

<div class="gamesnumber tooltip" title="<?php echo $recent_posts_2->found_posts; ?> <?php _e( 'articles in this category', 'gameleon' ); ?>">

<?php echo $recent_posts_2->found_posts; ?>

</div>

<a href="<?php echo esc_url( get_category_link( $categories_2 ) ); ?>">

<div class="moregames-link">

<?php echo $readmore_2; ?>

</div>

</a>

</div>



<?php endif; ?>



</div><?php // end of td-content-inner ?>

</div><?php // end of col-340 ?>



<?php echo $after_widget;



}





/*----------------------------------------------------------------------------------------------------------

  Sanitize widget form values as they are saved

-----------------------------------------------------------------------------------------------------------*/



public function update( $new_instance, $old_instance ) {

$instance = array();

$instance 							= $old_instance;

$instance['title']                 	= strip_tags( $new_instance['title'] );

$instance['title_2']               	= strip_tags( $new_instance['title_2'] );

$instance['orderby'] 				= strip_tags( $new_instance['orderby'] );

$instance['orderby_2'] 				= strip_tags( $new_instance['orderby_2'] );

$instance['readmore']             	= $new_instance['readmore'];

$instance['readmore_2']            	= $new_instance['readmore_2'];

$instance['bigexcerpt']            	= $new_instance['bigexcerpt'];

$instance['smallexcerpt']          	= $new_instance['smallexcerpt'];

$instance['td_trim_title_small']	= $new_instance['td_trim_title_small'];

$instance['td_trim_title_big']		= $new_instance['td_trim_title_big'];

$instance['post_type']             	= 'all';

$instance['post_type_2']           	= 'all';

$instance['posts']                 	= $new_instance['posts'];

$instance['posts_2']               	= $new_instance['posts_2'];

$instance['categories']            	= $new_instance['categories'];

$instance['categories_2']          	= $new_instance['categories_2'];

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

'title_2' 				=> 'Recent Posts',

'readmore'         		=> 'Read More',

'readmore_2'         	=> 'Read More',

'orderby'				=> 'date',

'orderby_2'				=> 'date',

'bigexcerpt' 			=> '20',

'smallexcerpt' 			=> '8',

'td_trim_title_small'	=> '2',

'td_trim_title_big'		=> '3',

'post_type'         	=> 'all',

'post_type_2'       	=> 'all',

'posts' 				=> 3,

'posts_2' 				=> 3,

'categories' 			=> 'all',

'categories_2' 			=> 'all',

'show_post_meta'		=> 'on',

'show_footer_box' 		=> 'on'

);



$orderby 	= isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';

$orderby_2 	= isset ( $instance ['orderby_2'] ) ? $instance ['orderby_2'] : '';



$instance 	= wp_parse_args( (array) $instance, $defaults );







/*----------------------------------------------------------------------------------------------------------

  Widget Options

-----------------------------------------------------------------------------------------------------------*/

?>



<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignright" style="padding-right:5px"></div><?php _e( 'Left Module Options', 'gameleon' ); ?></h4>



<p>

<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Left Module Title:', 'gameleon' ); ?></label>

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

<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>

<input class="widefat" id="<?php echo $this->get_field_id('posts'); ?>" type="text" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo $instance['readmore']; ?>" />

</p>

<p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>



<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Right Module Options', 'gameleon' ); ?></h4>



<p>

<label for="<?php echo $this->get_field_id( 'title_2' ); ?>"><?php _e( 'Right Module Title:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title_2' ); ?>" name="<?php echo $this->get_field_name( 'title_2' ); ?>" value="<?php echo $instance['title_2']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'categories_2' ); ?>"><?php _e( 'Category filter:', 'gameleon' ); ?></label>

<select id="<?php echo $this->get_field_id( 'categories_2' ); ?>" name="<?php echo $this->get_field_name( 'categories_2' ); ?>" class="widefat categories">

<option value='all' <?php if ( 'all' == $instance['categories_2'] ) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>

<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>

<?php foreach( $categories as $category ) { ?>

<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories_2'] ) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>

<?php } ?>

</select>

</p>



<p>

<label for="<?php echo $this->get_field_id( 'orderby_2' ); ?>"><?php _e( 'Sort order:', 'gameleon' ); ?></label>

<select id="<?php echo $this->get_field_id( 'orderby_2' ); ?>" name="<?php echo $this->get_field_name( 'orderby_2' ); ?>" class="widefat">

<option value="date"<?php if( $orderby_2=="date" ) echo ' selected="selected"';?>><?php _e( 'Latest', 'gameleon' );?></option>

<option value="rand"<?php if( $orderby_2=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>

<option value="name"<?php if( $orderby_2=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetical', 'gameleon' );?></option>

<option value="comment_count"<?php if( $orderby_2=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Most Popular', 'gameleon' );?></option>

<option value="meta_value_num"<?php if( $orderby_2=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Most Viewed/Played', 'gameleon' );?></option>

</select>

</p>



<p>

<label for="<?php echo $this->get_field_id( 'posts_2' ); ?>"><?php _e( 'Number of posts to show:', 'gameleon' ); ?></label>

<input id="<?php echo $this->get_field_id('posts_2'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name( 'posts_2' ); ?>" value="<?php echo $instance['posts_2']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'readmore_2' ); ?>"><?php _e( 'Read More text:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore_2' ); ?>" name="<?php echo $this->get_field_name( 'readmore_2' ); ?>" value="<?php echo $instance['readmore_2']; ?>" />

</p>

<p class="description"><?php _e( 'Example: More Sport Articles', 'gameleon' ); ?></p>





<h4 style="line-height: 20px;"><div class="dashicons dashicons-admin-generic" style="padding-right:5px"></div><?php _e( 'Other Options', 'gameleon' ); ?></h4>



<p>

<label for="<?php echo $this->get_field_id( 'td_trim_title_big' ); ?>"><?php _e( 'Title length in words of the first post:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'td_trim_title_big' ); ?>" name="<?php echo $this->get_field_name( 'td_trim_title_big' ); ?>" value="<?php echo $instance['td_trim_title_big']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'td_trim_title_small' ); ?>"><?php _e( 'Title length in words near thumbnails:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'td_trim_title_small' ); ?>" name="<?php echo $this->get_field_name( 'td_trim_title_small' ); ?>" value="<?php echo $instance['td_trim_title_small']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>"><?php _e( 'Excerpt length in words of the first post:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'bigexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'bigexcerpt' ); ?>" value="<?php echo $instance['bigexcerpt']; ?>" />

</p>



<p>

<label for="<?php echo $this->get_field_id( 'smallexcerpt' ); ?>"><?php _e( 'Excerpt length in words near thumbnails:', 'gameleon' ); ?></label>

<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'smallexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'smallexcerpt' ); ?>" value="<?php echo $instance['smallexcerpt']; ?>" />

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

  Register Tigu_Home_Module_1 widget

-----------------------------------------------------------------------------------------------------------*/



function tigu_home_module_1_init(){

register_widget( 'Tigu_Home_Module_1' );

}



add_action( 'widgets_init', 'tigu_home_module_1_init' );