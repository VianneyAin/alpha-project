<?php

/*----------------------------------------------------------------------------------------------------------
Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Social_Counter extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
	parent::__construct(
		'gameleon_social_counter',
		__( '[GAMELEON] Social Counter', 'gameleon' ),  // Widget Name
		array( 'description' => __( 'Display site social counters.', 'gameleon' ), ) // Widget Args
		);
}


/*----------------------------------------------------------------------------------------------------------
Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
	extract( $args );

	$title 			= apply_filters( 'widget_title', $instance['title'] );
	$twitter 		= $instance['twitter'];
	$twitter_key 	= $instance['twitter_key'];
	$twitter_secret = $instance['twitter_secret'];
	$facebook 		= $instance['facebook'];
	$youtube 		= $instance['youtube'];
	$googleplus 	= $instance['googleplus'];
	$posts 			= $instance['posts'];
	$comments 		= $instance['comments'];

	echo $before_widget;
    if ( $instance['title'] ) {
    echo $before_title . $title . $after_title;
}

	?>



    <?php

/*----------------------------------------------------------------------------------------------------------
	Twitter Count Function
-----------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'gameleon_get_twitter_count' ) ) {
	function gameleon_get_twitter_count( $twitter_id, $consumer_key, $consumer_secret ) {
		$twitter = get_transient('gameleon_twitter_count');
		if ($twitter !== false) return $twitter;

		// some variables
		$token = get_option('gameleon_twitter_token');
		$twitter['page_url'] = "http://www.twitter.com/$twitter_id";

		if($twitter_id && $consumer_key && $consumer_secret) {
			if(!$token) {
				// preparing credentials
				$credentials = $consumer_key . ':' . $consumer_secret;
				$toSend = base64_encode($credentials);

				// http post arguments
				$args = array(
					'method' => 'POST',
					'httpversion' => '1.1',
					'blocking' => true,
					'headers' => array(
						'Authorization' => 'Basic ' . $toSend,
						'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
					),
					'body' => array( 'grant_type' => 'client_credentials' )
				);

				add_filter('https_ssl_verify', '__return_false');
				$response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);

				$keys = json_decode(wp_remote_retrieve_body($response));

				if($keys) {
					// saving token to wp_options table
					update_option('gameleon_twitter_token', $keys->access_token);
					$token = $keys->access_token;
				}
			}
			// we have bearer token wether we obtained it from API or from options
			$args = array(
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array(
					'Authorization' => "Bearer $token"
				)
			);

			add_filter('https_ssl_verify', '__return_false');
			$api_url = "https://api.twitter.com/1.1/users/show.json?screen_name=$twitter_id";
			$response = wp_remote_get($api_url, $args);

			if (!is_wp_error($response)) {
				$twitter_reply = json_decode(wp_remote_retrieve_body($response));
				if ( isset( $twitter_reply->followers_count ) ) {
					$twitter['followers_count'] = $twitter_reply->followers_count;
				} else {
					$twitter['followers_count'] = 0;
				}
			}
		} else {
			$twitter['followers_count'] = 0;
		}

		set_transient( 'gameleon_twitter_count', $twitter, 60*60*4 ); // 4 hour cache
		return $twitter;
	}
}


/*----------------------------------------------------------------------------------------------------------
	Facebook Count Function
-----------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'gameleon_get_facebook_count' ) ) {
	function gameleon_get_facebook_count( $page_id ) {
		$facebook = get_transient('gameleon_facebook_count');
		if ($facebook !== false) return $facebook;

		try {
			$url = "http://graph.facebook.com/".$page_id;
			@$reply = json_decode(@gameleon_get_subscriber_counter($url));
			@$facebook['fans_count'] = $reply->likes;
			@$facebook['page_url'] = $reply->link;
		} catch (Exception $e) {
			$facebook['fans_count'] = '0';
			$facebook['page_url'] = 'http://www.facebook.com';
		}

		set_transient( 'gameleon_facebook_count', $facebook, 60*60*24 ); // 24 hour cache
		return $facebook;
	}
}

/*----------------------------------------------------------------------------------------------------------
	Youtube Count Function
-----------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'gameleon_get_youtube_count' ) ) {
	function gameleon_get_youtube_count( $username ) {
		$youtube = get_transient('gameleon_youtube_count');
		if ($youtube !== false) return $youtube;

		try {
			@$xmlData = @gameleon_get_subscriber_counter('http://gdata.youtube.com/feeds/api/users/' . strtolower($username));
			@$xmlData = str_replace('yt:', 'yt', $xmlData);
			@$xml = new SimpleXMLElement($xmlData);
			@$youtube['subscriber_count'] = ( string ) $xml->ytstatistics['subscriberCount'];
			@$youtube['page_url'] = "http://www.youtube.com/user/".$username;
		} catch (Exception $e) {
			$youtube['subscriber_count'] = 0;
			$youtube['page_url'] = "http://www.youtube.com";
		}

		set_transient( 'gameleon_youtube_count', $youtube, 60*60*24 ); // 24 hour cache
		return($youtube);
	}
}

/*----------------------------------------------------------------------------------------------------------
	Google Count Function
-----------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'gameleon_get_googleplus_count' ) ) {
	function gameleon_get_googleplus_count( $username ) {
		$googleplus = get_transient('gameleon_googleplus_count');
		if ($googleplus !== false) return $googleplus;

		if ( preg_match( '/[^0-9]/', $username ) && strpos( $username, '+' ) !== 0 ) {
			$username = '+'.$username;
		}

		$api_url = 'https://www.googleapis.com/plus/v1/people/'.$username.'?key=AIzaSyCfbKKE_GQqyuxXT38eVCRtlKgmMrwZz4o';
		$googleplus['page_url'] = '#';
		$googleplus['people_count'] = 0;

		$data = gameleon_get_subscriber_counter($api_url);
		$json = json_decode( $data );

		if ( ! is_wp_error( $data ) ) {
			if ( isset( $json->url ) ) {
				$googleplus['page_url'] = $json->url;
			}

			if ( isset( $json->plusOneCount ) ) {
				$googleplus['people_count'] = $json->plusOneCount;
			}
		}

		set_transient( 'gameleon_googleplus_count', $googleplus, 60*60*24 ); // 24 hour cache
		return $googleplus;
	}
}


/*----------------------------------------------------------------------------------------------------------
	Posts Count Function
-----------------------------------------------------------------------------------------------------------*/

	$count_posts = wp_count_posts();
	$published_posts = $count_posts->publish; // retrieve all published posts


/*----------------------------------------------------------------------------------------------------------
	Comments Count Function
-----------------------------------------------------------------------------------------------------------*/

	$comments_count = wp_count_comments(); // retrieve unapproved comments count


/*----------------------------------------------------------------------------------------------------------
	Subscriber Counter Function
-----------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'gameleon_get_subscriber_counter' ) ) {
	function gameleon_get_subscriber_counter( $api_url ) {
		$args = array(
			'httpversion' => '1.1',
			'blocking' => true,
		);

		$response = wp_remote_get($api_url, $args);
		if (!is_wp_error($response)) {
			return wp_remote_retrieve_body($response);
		}
	}
}

?>

<div class="td-social-counters">

<?php
/*----------------------------------------------------------------------------------------------------------
	Posts Counter Display
-----------------------------------------------------------------------------------------------------------*/
?>



<ul class="td-social-ul">

	<li class="count-posts">
		<a class="icon" href="<?php echo get_site_url(); ?>" target="_blank" rel="nofollow">
		<i class="fa fa-edit"></i>
		</a>
		<span class="items">
		<span class="count"><?php echo $published_posts; ?></span>
		<span class="label"><?php _e( 'posts', 'gameleon' ) ?></span>
		</span>
	</li>


<?php
/*----------------------------------------------------------------------------------------------------------
	Comments Counter Display
-----------------------------------------------------------------------------------------------------------*/
?>

<li class="count-comments">
	<a class="icon" href="<?php echo get_site_url(); ?>" target="_blank" rel="nofollow">
		<i class="fa  fa-comment"></i>
	</a>
	<span class="items">
		<span class="count"><?php echo $comments_count->total_comments; ?></span>
		<span class="label"><?php _e( 'comments', 'gameleon' ) ?></span>
	</span>
</li>


<?php
/*----------------------------------------------------------------------------------------------------------
	Twitter Counter Display
-----------------------------------------------------------------------------------------------------------*/

if ( $twitter ) {
	$twitter_count = gameleon_get_twitter_count( $twitter, $twitter_key, $twitter_secret );
	?>

<li class="count-twitter">
	<a class="icon" href="<?php echo esc_attr( $twitter_count['page_url'] ); ?>" target="_blank" rel="nofollow">
		<i class="fa fa-twitter"></i>
	</a>
	<span class="items">
		<span class="count"><?php echo number_format( $twitter_count['followers_count'] ); ?></span>
		<span class="label"><?php _e( 'followers', 'gameleon' ) ?></span>
	</span>
</li>

	<?php
}


/*----------------------------------------------------------------------------------------------------------
	Facebook Counter Display
-----------------------------------------------------------------------------------------------------------*/

if ( $facebook ) {
	$facebook_count = gameleon_get_facebook_count( $facebook );
	?>

	<li class="count-facebook">
		<a class="icon" href="<?php echo esc_attr( $facebook_count['page_url'] ); ?>" target="_blank" rel="nofollow">
			<i class="fa fa-facebook"></i>
		</a>
		<span class="items">
			<span class="count"><?php echo number_format( $facebook_count['fans_count'] ); ?></span>
			<span class="label"><?php _e( 'fans', 'gameleon' ) ?></span>
		</span>
	</li>


	<?php
}


/*----------------------------------------------------------------------------------------------------------
	Youtube Counter Display
-----------------------------------------------------------------------------------------------------------*/

if ( $youtube ) {
	$youtube_count = gameleon_get_youtube_count( $youtube );
	?>

<li class="count-youtube">
	<a class="icon" href="<?php echo esc_attr( $youtube_count['page_url'] ); ?>" target="_blank" rel="nofollow">
		<i class="fa fa-youtube"></i>
	</a>
	<span class="items">
		<span class="count"><?php echo number_format( $youtube_count['subscriber_count'] ); ?></span>
		<span class="label"><?php _e( 'subscribers', 'gameleon' ) ?></span>
	</span>
</li>


	<?php
}


/*----------------------------------------------------------------------------------------------------------
	Google Plus Counter Display
-----------------------------------------------------------------------------------------------------------*/

if ( $googleplus ) {
	$googleplus_count = gameleon_get_googleplus_count( $googleplus );
	?>
<li class="count-googleplus">
<a class="icon" href="<?php echo esc_attr( $googleplus_count['page_url'] ); ?>" target="_blank" rel="nofollow">
	<i class="fa fa-google-plus"></i>
</a>
<span class="items">
	<span class="count"><?php echo number_format( $googleplus_count['people_count'] ); ?></span>
	<span class="label"><?php _e( 'followers', 'gameleon' ) ?></span>
</span>
</li>


	<?php
}


?>

</ul><?php // end of ul class ?>
</div><?php // end of td-social-counters ?>

<div class="clearfix"></div>

    <?php
    wp_reset_postdata();
    echo $after_widget;
 }

/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance 					= $old_instance;
	//$new_instance 			= wp_parse_args( (array) $new_instance, $this->default );
	$instance['title']          = strip_tags( $new_instance['title'] );
	$instance['twitter'] 		= strip_tags( $new_instance['twitter'] );
	$instance['twitter_key'] 	= strip_tags( $new_instance['twitter_key'] );
	$instance['twitter_secret'] = strip_tags( $new_instance['twitter_secret'] );
	$instance['facebook'] 		= strip_tags( $new_instance['facebook'] );
	$instance['youtube'] 		= strip_tags( $new_instance['youtube'] );
	$instance['googleplus'] 	= strip_tags( $new_instance['googleplus'] );
	$instance['posts'] 			= strip_tags( $new_instance['posts'] );
	$instance['comments'] 		= strip_tags( $new_instance['comments'] );

	delete_transient( 'gameleon_twitter_count' );
	delete_transient( 'gameleon_facebook_count' );
	delete_transient( 'gameleon_youtube_count' );
	delete_transient( 'gameleon_googleplus_count' );

	return $instance;
}

/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

public function form( $instance ) {
	$defaults = array(
		'title' 			=> 'Social Counter',
		'twitter' 			=> '',
		'twitter_key'		=> '',
		'twitter_secret' 	=> '',
		'facebook' 			=> '',
		'youtube'			=> '',
		'googleplus' 		=> '',
		'posts' 			=> '',
		'comments' 			=> ''
		);

	$instance = wp_parse_args( (array) $instance, $defaults );


/*----------------------------------------------------------------------------------------------------------
  Widget Options
-----------------------------------------------------------------------------------------------------------*/
?>

<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter username:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'twitter_key' ); ?>"><?php _e( 'Twitter consumer key:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter_key' ); ?>" name="<?php echo $this->get_field_name( 'twitter_key' ); ?>" value="<?php echo $instance['twitter_key']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'twitter_secret' ); ?>"><?php _e( 'Twitter consumer secret:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter_secret' ); ?>" name="<?php echo $this->get_field_name( 'twitter_secret' ); ?>" value="<?php echo $instance['twitter_secret']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook ID:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube username:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e( 'Google+ Username/ID:', 'gameleon' ); ?></label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" value="<?php echo $instance['googleplus']; ?>" />
</p>


<?php


}

}
/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Social_Counter widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_social_counter_init() {
	register_widget( 'Gameleon_Social_Counter' );
}
add_action( 'widgets_init', 'gameleon_social_counter_init' );