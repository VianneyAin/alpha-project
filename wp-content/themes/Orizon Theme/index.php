<?php get_header();
if(of_get_option('slider_show') == "1"){
 if (of_get_option('slider_scheme')=="0" or of_get_option('slider_scheme')=="1") {
 include('slider.php');
  echo '<div class="top_shadow"></div>';
 }
 if (of_get_option('slider_scheme')=="2") {
include('slider-two.php');
 echo '<div class="top_shadow"></div>';
 }
  if (of_get_option('slider_scheme')=="3") {
echo do_shortcode(of_get_option('layer'));
 }


  if (of_get_option('carousel_scheme')=="1") {
include('carousel.php');
 }
}
 ?>
    <div id="main_news_wrapper">
      <div id="row">
        <!-- Left wrapper Start -->
        <div id="left_wrapper">
          <div class="header">

<?php if(of_get_option('general_title_text')!="") { ?>
<h2> <span><?php bloginfo('name'); ?> //&nbsp;</span><?php echo  of_get_option('general_title_text') ?> </h2>
<?php } else { ?>
<h2><span><?php bloginfo('name'); ?> //&nbsp;</span> <?php echo get_the_title(); ?> </h2>
<?php } ?>



</div>
<?php include('main-post.php') ?>
          <div class="clear"></div>
        </div><!-- Left wrapper end -->
         <?php if ( function_exists('dynamic_sidebar') && is_active_sidebar('home')) : ?>
               <div id="right_wrapper">
               <?php dynamic_sidebar('home'); ?>
               </div>
           <?php endif; ?>
        <div class="clear"></div>
      </div>
    </div><?php get_footer(); ?>