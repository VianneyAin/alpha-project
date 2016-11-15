    <div class="bottom_shadow"></div>
    <div class="main_advert">
      <?php if( of_get_option('footer_textarea')==1){
      	if(of_get_option('footer_text') != ""){  
      		echo of_get_option('footer_text');
      	}elseif(of_get_option('advimage') != ""){ 
       	?>
       	<a target="_blank" href="<?php echo of_get_option('advlink'); ?>"><img src="<?php echo of_get_option('advimage'); ?>" /></a>
       	
     <?php  }} ?>
    </div>
    <div id="footer">
      <div class="row">

          <?php  if ( function_exists('dynamic_sidebar') && is_active_sidebar('footer1') ) : ?>
                <?php dynamic_sidebar('footer1'); ?>
          <?php endif; ?>


      </div>
    </div><!--********************************************* Footer end *********************************************-->
   


    <?php if( of_get_option('powered_by')!=""){ ?>
        <a id="cop_text" href="<?php echo of_get_option('powered_by'); ?>" name="cop_text">
    <?php } ?>
            <?php if(of_get_option('copyright')!=""){echo of_get_option('copyright');}?>
        </a>
	
		<div class="social">
            <?php if ( of_get_option('rss') ) { ?> <a data-original-title="Rss" data-toggle="tooltip" class="rss" target="_blank" href="<?php  echo of_get_option('rss_link');  ?>"><i class="fa fa-rss"></i> </a><?php } ?>
            <?php if ( of_get_option('youtube') ) { ?> <a data-original-title="Youtube" data-toggle="tooltip" class="youtube" target="_blank" href="<?php echo of_get_option('youtube_link');   ?>"><i class="fa fa-youtube"></i> </a><?php } ?>
			<?php if ( of_get_option('steam') ) { ?> <a data-original-title="Steam" data-toggle="tooltip" class="steam" target="_blank" href="<?php echo of_get_option('steam_link');   ?>"><i class="fa fa-gamepad"></i></a><?php } ?>
            <?php if ( of_get_option('googleplus') ) { ?> <a data-original-title="Google plus" data-toggle="tooltip" class="google-plus" target="_blank" href="<?php echo of_get_option('google_link');   ?>"><i class="fa fa-google-plus"></i></a><?php } ?>
            <?php if ( of_get_option('twitter') ) { ?> <a data-original-title="Twitter" data-toggle="tooltip" class="twitter" target="_blank" href="<?php  echo of_get_option('twitter_link');   ?>"><i class="fa fa-twitter"></i></a><?php } ?>
            <?php if ( of_get_option('facebook') ) { ?> <a data-original-title="Facebook" data-toggle="tooltip" class="facebook" target="_blank" href="<?php echo of_get_option('facebook_link');   ?>"><i class="fa fa-facebook"></i></a><?php } ?>
         </div>
		 
 <div class="clear"></div><?php wp_footer(); ?>
</body>
</html>