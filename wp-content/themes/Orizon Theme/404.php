<?php get_header(); ?>
    <div id="full_page_wrapper">
      <div class="header">
          <h2>
              <?php echo orizon_breadcrumbs(); ?>
            </h2>
      </div>
      <div id="post_wrapper">
        <!-- Body Start -->
        <div id="body">
          <div class="four0four">
            <p class="huge">
              <?php _e('BOOM 404!', 'orizon'); ?>
            </p><?php _e('Page not found, sorry ', 'orizon'); ?> :(
          </div>
        </div><!-- Body end -->
        <div class="clear"></div>
      </div>
    </div><!-- Full page wrapper end -->
<?php get_footer(); ?>