<?php

/*----------------------------------------------------------------------------------------------------------
  Define useful variables to display brief informations to the admin
-----------------------------------------------------------------------------------------------------------*/

  $user_info = get_userdata(1); // retrieve admin ID to display avatar image
  $count_posts = wp_count_posts(); // retrieve posts count
  $published_posts = $count_posts->publish; // published posts
  $comments_count = wp_count_comments(); // retrieve unapproved comments count
  $result = count_users(); //get users count
  ?>

  <div class="wrap" id="of_container">


<?php
/*----------------------------------------------------------------------------------------------------------
  Saving Options pop-up and opacity block
-----------------------------------------------------------------------------------------------------------*/
 ?>
    <div class="panel_opacity_saving"></div>
    <div id="of-popup-save" class="of-save-popup">
      <div class="of-save-save"><?php echo 'Options Updated';?></div>
    </div>


<?php
/*----------------------------------------------------------------------------------------------------------
  Reset Options pop-up and opacity block
-----------------------------------------------------------------------------------------------------------*/
 ?>

  <div id="of-popup-reset" class="of-save-popup">
    <div class="of-save-reset"><?php echo 'Options Reset';?></div>
  </div>

  <div id="of-popup-fail" class="of-save-popup">
    <div class="of-save-fail"><?php echo 'Error!';?></div>
  </div>

  <span style="display: none;" id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
  <input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
  <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />


<?php
/*----------------------------------------------------------------------------------------------------------
  Form Options block
-----------------------------------------------------------------------------------------------------------*/
 ?>

  <form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >

    <div id="header">


<?php
/*----------------------------------------------------------------------------------------------------------
  Logo block
-----------------------------------------------------------------------------------------------------------*/
 ?>
     <div class="logo">
      <h2><?php echo 'Theme Options'; ?></h2>
    </div>

    <div id="js-warning"><?php echo 'Warning- This options panel will not work properly without javascript!';?></div>


<?php
/*----------------------------------------------------------------------------------------------------------
  Social icons block
-----------------------------------------------------------------------------------------------------------*/
 ?>
    <div class="social-icons">
      <a target="_blank" class="support" href="http://tiguandesign.ticksy.com/" title="Support"></a>
      <a target="_blank" class="twitter" href="https://twitter.com/tiguan_support" title="Twitter"></a>
      <a target="_blank" class="facebook" href="http://www.facebook.com/Tiguandesign" title="Facebook"></a>
    </div>
    <div class="clear"></div>

  </div>


<?php
/*----------------------------------------------------------------------------------------------------------
  Header links block
-----------------------------------------------------------------------------------------------------------*/
 ?>

  <div id="info_bar">

   <div id="theme_utils" class="profile-box-title"><?php echo THEMENAME; ?> <?php echo ('V'. THEMEVERSION); ?></div>

   <a href="http://tiguandesign.com/docs/gameleon/" target="_blank">
    <div id="theme_utils" class="expand"><?php echo 'Documentation'; ?></div>
  </a>

  <a href="http://tiguandesign.ticksy.com/" target="_blank">
    <div id="theme_utils" class="expand"><?php echo 'Support Center';?></div>
  </a>

  <a href="http://www.tiguandesign.com/demos/Gameleon/" target="_blank">
    <div id="theme_utils" class="expand"><?php echo 'Demo';?></div>
  </a>

  <a href="mailto:themesupport@tiguandesign.com?Subject=Support" target="_top">
    <div id="theme_utils" class="expand"><?php echo 'Contact'; ?></div>
  </a>


<?php
/*----------------------------------------------------------------------------------------------------------
  Spinner loading image
-----------------------------------------------------------------------------------------------------------*/
 ?>
  <img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-image.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />


<?php
/*----------------------------------------------------------------------------------------------------------
  Save changes button header - static position on desktop view and relative position on responsive devices
-----------------------------------------------------------------------------------------------------------*/
 ?>

  <button id="of_save" type="button" class="td-button-hide button-primary">
    <?php echo 'Save All Changes';?>
  </button>

  <button id="of_save" type="button" class="td-button-show button-primary">
    <?php echo 'Save All Changes';?>
  </button>

</div><!-- info_bar end -->


<?php
/*----------------------------------------------------------------------------------------------------------
  Main content of options panel
-----------------------------------------------------------------------------------------------------------*/
 ?>

<div id="main">

 <div id="of-nav">
  <ul>
   <li>
    <div class="mypanel">


<?php
/*----------------------------------------------------------------------------------------------------------
  Display the admin avatar
-----------------------------------------------------------------------------------------------------------*/
 ?>

     <div class="menu-profile">
      <?php if( function_exists( 'get_avatar' ) ) {
       echo get_avatar( 1, '80' );
     } ?>
   </div>


<?php
/*----------------------------------------------------------------------------------------------------------
  Display brief informations to the admin
-----------------------------------------------------------------------------------------------------------*/
 ?>

   <div id="tigu-stats">
    <div class="welcome-admin"></div>


<?php
/*----------------------------------------------------------------------------------------------------------
  Say hello to the admin
  TODO display theme update notifications using envato toolkit library - <div class="theme-out-of-date">
-----------------------------------------------------------------------------------------------------------*/
 ?>
    <div class="theme-up-to-date">
     <?php _e( 'Howdy', 'gameleon' ); ?> <?php echo $user_info->user_login ; ?> !
   </div>

 </div>

</div>
</li>


<?php
/*----------------------------------------------------------------------------------------------------------
  Theme options menu
-----------------------------------------------------------------------------------------------------------*/
 ?>

<?php echo $options_machine->Menu ?>
</ul>
</div>


<?php
/*----------------------------------------------------------------------------------------------------------
  Main content: Settings Inputs
-----------------------------------------------------------------------------------------------------------*/
 ?>

<div id="content">
  <?php echo $options_machine->Inputs ?>
</div>

<div class="clear"></div>
</div>


<?php
/*----------------------------------------------------------------------------------------------------------
  Save changes button bottom - static position on desktop view and relative position on responsive devices
-----------------------------------------------------------------------------------------------------------*/
 ?>

<div class="save_bar">

 <img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-image.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
 <button id ="of_save" type="button" class="td-button-hide button-primary"><?php echo 'Save All Changes';?></button>
 <button id ="of_save" type="button" class="td-button-show button-primary"><?php echo 'Save All Changes';?></button>
 <button id ="of_reset" type="button" class="button-primary reset-button" ><?php echo 'Reset All Options';?></button>
 <img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-image.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />

</div><!-- save_bar end -->

</form><!-- form end -->

<div style="clear:both;"></div>

</div><!-- wrap end -->