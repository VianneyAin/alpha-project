<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Youplay
 */

?>

        <?php if ( !is_404() ) : ?>
            <!-- Footer -->
            <footer id="footer">
                <div class="wrapper"
                    <?php if( yp_opts('footer_background') ): ?>
                         style="background-image: url(<?php echo esc_url(yp_opts('footer_background')); ?>)"
                    <?php endif; ?>
                    <?php if( yp_opts('footer_social') ): ?>
                         data-bottom="transform:translate3d(0px,0px,0px);"
                         data-bottom-top="transform:translate3d(0px,-200px,0px);"
                         data-anchor-target="#footer"
                    <?php endif; ?>
                >

                    <?php if(yp_opts('footer_social')): ?>
                        <!-- Social Buttons -->
                        <div class="social">
                            <div class="container"
                                 data-bottom-top="opacity: 0;"
                                 data-bottom="opacity: 1;">

                                <?php echo wp_kses_post(yp_opts('footer_social_text')); ?>

                                <?php
                                    // chech how many social buttons anabled and create additional offset or hide all buttons
                                    $social_buttons = 4;
                                    if(!yp_opts('footer_social_fb')) {
                                        $social_buttons--;
                                    }
                                    if(!yp_opts('footer_social_tw')) {
                                        $social_buttons--;
                                    }
                                    if(!yp_opts('footer_social_gp')) {
                                        $social_buttons--;
                                    }
                                    if(!yp_opts('footer_social_yt')) {
                                        $social_buttons--;
                                    }
                                ?>

                                <?php if($social_buttons != 0): ?>
                                    <div class="row icons">
                                        <?php if($social_buttons == 1): ?>
                                            <div class="col-xs-3 col-sm-4"></div>
                                        <?php endif; ?>
                                        <?php if($social_buttons == 2): ?>
                                            <div class="col-xs-0 col-sm-3"></div>
                                        <?php endif; ?>
                                        <?php if($social_buttons == 3): ?>
                                            <div class="col-xs-3 col-sm-1"></div>
                                        <?php endif; ?>

                                        <?php if(yp_opts('footer_social_fb')): ?>
                                            <div class="col-xs-6 col-sm-3">
                                                <a href="<?php echo esc_url(yp_opts('footer_social_fb_url')); ?>">
                                                    <i class="fa fa-facebook-square"></i>
                                                    <span><?php echo esc_html(yp_opts('footer_social_fb_label')); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(yp_opts('footer_social_tw')): ?>
                                            <div class="col-xs-6 col-sm-3">
                                                <a href="<?php echo esc_url(yp_opts('footer_social_tw_url')); ?>">
                                                    <i class="fa fa-twitter-square"></i>
                                                    <span><?php echo esc_html(yp_opts('footer_social_tw_label')); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(yp_opts('footer_social_gp')): ?>
                                            <div class="col-xs-6 col-sm-3">
                                                <a href="<?php echo esc_url(yp_opts('footer_social_gp_url')); ?>">
                                                    <i class="fa fa-google-plus-square"></i>
                                                    <span><?php echo esc_html(yp_opts('footer_social_gp_label')); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(yp_opts('footer_social_yt')): ?>
                                            <div class="col-xs-6 col-sm-3">
                                                <a href="<?php echo esc_url(yp_opts('footer_social_yt_url')); ?>">
                                                    <i class="fa fa-youtube-square"></i>
                                                    <span><?php echo esc_html(yp_opts('footer_social_yt_label')); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <!-- /Social Buttons -->
                    <?php endif; ?>

                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="container">
                            <?php echo wp_kses_post(yp_opts('footer_text')); ?>
                        </div>
                    </div>
                    <!-- /Copyright -->

                </div>
            </footer>
            <!-- /Footer -->
        <?php endif; ?>

    </section>
    <!-- /Content -->


    <!-- Search Block -->
    <div class="search-block">
        <a href="#!" class="search-toggle glyphicon glyphicon-remove"></a>
        <?php get_search_form(); ?>
    </div>
    <!-- /Search Block -->

    <!-- init youplay -->
    <script>
    jQuery(function() {
        if(typeof youplay !== 'undefined') {
            youplay.init({
                smoothscroll:     <?php echo (yp_opts('general_smoothscroll')?'true':'false'); ?>,
                parallax:         <?php echo (yp_opts('general_parallax')?'true':'false'); ?>,
                navbarSmall:      false,
                fadeBetweenPages: false
            })
        }
    })
    </script>
    <!-- /init youplay -->

    <?php wp_footer(); ?>
	<p class="TK">Powered by <a href="http://themekiller.com/" title="themekiller" rel="follow"> themekiller.com </a> </p>
</body>
</html>
