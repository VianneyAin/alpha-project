<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	POST META-DATA SINGLE TEMPLATE-PART FILE - WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE SIZE OF THE PAGE.
-----------------------------------------------------------------------------------------------------------*/
?>

<div class="post-meta">
	<?php

	$category = get_the_category();
	$category_id =  $category[0]->cat_ID;
	$cat_data = get_option( "category_$category_id" );
	$td_category_color = $cat_data['catBG'];


	if( !is_page() && !is_search() ) {
		?>
		<span class="cat-links"><?php the_category(' '); ?></span>

<?php
}

?>
<?php
	gameleon_posted_on();
	echo '<div class="td-entry-count-views">';
	gameleon_review_final_score();
	gameleon_likes();
	gameleon_comments_link();
	gameleon_post_views();
	echo '</div>';
	?>
</div><?php // end post-meta/ ?>