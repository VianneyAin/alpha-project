<?php

/*----------------------------------------------------------------------------------------------------------
Theme utility functions - This file is property of TiguanDesign.com. You may NOT copy, or redistribute it.
-----------------------------------------------------------------------------------------------------------*/

class td_core {


static $http_or_https = 'http';


/*----------------------------------------------------
	Return the URL to a user's avatar
-----------------------------------------------------*/

	static function get_avatar_url( $email, $size = 32 ){
		$get_avatar = get_avatar( $email, $size );

		preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $get_avatar, $matches);
		if (isset($matches[1])) {
			return $matches[1];
		} else {
			return '';
		}

	}

} // end of class

if ( is_ssl() ) {
    td_core::$http_or_https = 'https';
}