<?php
/*
 * Template name: Blog - Full Width
*/
?>
<?php get_header();
if(of_get_option('slider_show') == "1"){
 if (of_get_option('slider_scheme')=="0" or of_get_option('slider_scheme')=="1") {
 include('slider.php');
 }
 if (of_get_option('slider_scheme')=="2") {
include('slider-two.php');
 }
   if (of_get_option('slider_scheme')=="3") {
echo do_shortcode(of_get_option('layer'));
 }
 echo '<div class="top_shadow"></div>';
  if (of_get_option('carousel_scheme')=="1") {
include('carousel.php');
 }
}
 ?>
    <div id="main_news_wrapper">
      <div id="row">
        <!-- Left wrapper Start -->
        <div id="full_page_wrapper">
          <div class="header">
              <h2>
              <?php echo orizon_breadcrumbs(); ?>
            </h2>
          </div><?php include('main-post.php') ?>
          <div class="clear"></div>
        </div><!-- Left wrapper end -->

      </div>
    </div><?php get_footer(); ?>