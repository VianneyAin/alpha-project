<?php
class Facebook_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('facebook', 'Facebook', array('description' => 'Affiche les détails de la page facebook' ));
    }

	public function widget($args, $instance)
	{
	    echo $args['before_widget'];
	    /*
	    echo apply_filters('widget_title', $instance['facebook_title']);
	    */

    	$facebook_title = $instance['facebook_title'];
    	$facebook_url = $instance['facebook_url'];
    	?>
    	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5&appId=1560869377534668";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
    	<div id="td-social-tabs">
			<div class="tabs-wrapper">
				<div class="socialtabs">
					<ul class="tab-links">
				    	<li class="active">
							<a href="#tab25">
								<?php echo $facebook_title; ?>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="fb-page" data-href="<?php echo $facebook_url; ?>" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $facebook_url; ?>"><a href="<?php echo $facebook_url; ?>">Chargement...</a></blockquote></div></div>
					</div>
				</div>
			</div>
		</div>

    	<?php
	    echo $args['after_widget'];
	}

	public function form($instance)
	{

	    $facebook_title = isset($instance['facebook_title']) ? $instance['facebook_title'] : '';
	    $facebook_url = isset($instance['facebook_url']) ? $instance['facebook_url'] : '';
	    ?>
	    <p>
	        <label for="<?php echo $this->get_field_name( 'facebook_title' ); ?>"><?php _e( 'Titre Facebook :' ); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'facebook_title' ); ?>" name="<?php echo $this->get_field_name( 'facebook_title' ); ?>" type="text" value="<?php echo  $facebook_title; ?>" />
	    </p>
	    <p>
	        <label for="<?php echo $this->get_field_name( 'facebook_url' ); ?>"><?php _e( 'Lien vers la page facebook :' ); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" type="text" value="<?php echo  $facebook_url; ?>" />
	    </p>

	    <?php
	}
}


?>