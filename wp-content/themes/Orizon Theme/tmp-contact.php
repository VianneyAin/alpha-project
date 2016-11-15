<?php
/* template name:Contact
*/

if(isset($_POST['submitted'])) {
$name = $_POST['contactName'];
$email = $_POST['email'];
$website = $_POST['web'];
$message = $_POST['message'];

$emailTo = of_get_option('contact_page_email'); 
$subject =  of_get_option('contact_email_subject');
$message = "
<table border='1' width=600 >
<tr>
<th>Name</th>
<td align='center'>".$name."</td>
</tr>
<tr>
<th>Email</th>
<td align='center'>".$email."</td>
</tr>
<tr>
<th>Website</th>
<td align='center'>".$website."</td>
</tr>
<tr>
<th>Message</th>
<td align='center'>".$message."</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers
$headers .= 'From: <'.$email.'>' . "\r\n";


		wp_mail($emailTo, $subject, $message, $headers);
		$emailSent = true;
	

} 
get_header(); ?>

<div id="main_news_wrapper">
  <div id="row"> 
    <!-- Left wrapper Start -->
    <div id="left_wrapper">
      <div class="header">
        <h2><span>
          <?php bloginfo('name'); ?>
          //</span> <?php echo get_the_title(); ?> </h2>
      </div>
      <div id="post_wrapper"> 
        
        <!-- Leave a response Start -->
        <div id="response" class="contact_form">
          <?php if (have_posts()) : while (have_posts()) : the_post(); 
 if(isset($emailSent) && $emailSent == true) { ?>
          <div class="thanks" style="height:359px; ">
            <h2>
              <center>
                <?php _e('Thanks, your email was sent successfully.', 'orizon'); ?>
              </center>
            </h2>
          </div>
          <?php } else { ?>
          <?php the_content(); ?>
          <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
            <div class="form_left">
              <label><?php _e('Name ', 'orizon'); ?><small><em><?php _e('(required)', 'orizon'); ?></em></small></label>
              <input type="text" name="contactName" id="contactName" value="<?php echo $_POST['contactName'];?>" class="validate[required,custom[onlyLetter],length[0,100]] text-input" />
              <label><?php _e('Email ', 'orizon'); ?><small><em><?php _e('(required)', 'orizon'); ?></em></small></label>
              <input type="text" name="email" id="email" value="<?php echo $_POST['email'];?>" class="validate[required,custom[email]] text-input" />
              <label><?php _e('Website ', 'orizon'); ?></label>
              <input type="text" name="web" id="web" />
            </div>
            <div class="form_right">
              <p class="text">
                <label><?php _e('Your Message ', 'orizon'); ?><small><em><?php _e('(required)', 'orizon'); ?></em></small></label>
                <textarea name="message" id="commentsText" rows="20" cols="30" class="validate[required,length[6,300]] text-input"><?php  echo $_POST['message'];  ?>
</textarea>
              </p>
            </div>
            <div class="form_submit">
              <input type="submit" class="read_more2" value="post">
              </input>
              <input type="hidden" name="submitted" id="submitted" value="true" />
            </div>
          </form>
          <?php } ?>
          <?php endwhile; endif; ?>
        </div>
        <div class="clear"> </div>
      </div>
    </div>
    <!-- Left wrapper end -->
    
    <?php if ( function_exists('dynamic_sidebar') && is_active_sidebar('page')) : ?>
      <div id="right_wrapper">
               <?php dynamic_sidebar('page'); ?>
      </div>
           <?php endif; ?>
    <div class="clear"> </div>
  </div>
</div>
<?php get_footer(); ?>