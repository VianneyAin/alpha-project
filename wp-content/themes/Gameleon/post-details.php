<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	POST DETAILS TEMPLATE-PART FILE - WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE SIZE OF THE PAGE.
-----------------------------------------------------------------------------------------------------------*/
?>
<?php
if( is_category() ) {

$td_trimmed_title 	= gameleon_get_option( 'td_archive_excerpts_title' ); // trim the title for posts
$td_post_excerpt 	= gameleon_get_option( 'td_archive_excerpts_length' ); // post excerpt
} elseif ( is_search() || is_tag() ) {
$td_trimmed_title 	= 4; // trim the title for posts
$td_post_excerpt 	= 20; // post excerpt
} else {
$td_trimmed_title 	= gameleon_get_option( 'td_custop_pages_excerpts_title' ); // trim the title for posts
$td_post_excerpt 	=  gameleon_get_option( 'td_custop_pages_excerpts_text' ); // post excerpt
}
?>

<div class="td-post-details"><?php // td-post-details ?>
<h3 class="entry-title">
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo wp_trim_words( get_the_title(), $td_trimmed_title ); ?></a>
</h3>
<div class="td-post-excerpt">
<?php echo td_global_excerpt( $td_post_excerpt ); ?>
</div>
</div><?php // end of td-post-details ?>