<?php


/*----------------------------------------------------------------------------------------------------------
	LOREM PIXEL IMAGE PLACEHOLDER GENERATOR

	* Uses Lorem Pixel Image Placeholder generator link: http://lorempixel.com/#images
	* The provided images are released under the creative commons license (CC BY-SA).
	* For more information visit http://creativecommons.org/licenses/
-----------------------------------------------------------------------------------------------------------*/

class Td_Placeholder_Module {
    public $lorempixel_width;
    public $lorempixel_height;
    public $placeholder_size;
    public $post_thumb_size;


    public function __construct( $lorempixel_width, $lorempixel_height, $placeholder_size, $post_thumb_size ) {

        $this->lorempixel_width 	= $lorempixel_width;
        $this->lorempixel_height 	= $lorempixel_height;
        $this->placeholder_size 	= $placeholder_size;
        $this->post_thumb_size 		= $post_thumb_size;

    }


    public function return_image() {

    	global $post;
        $this->use_lorempixel 		= gameleon_get_option( 'td_lorempixel_placeholder' );
		$this->lorempixel_color 	= gameleon_get_option( 'td_placeholder_color' );
		$this->lorempixel_genre 	= gameleon_get_option( 'td_placeholder_genre' );


       if ( $this->lorempixel_color == 1 ) {
			$this->lorempixel_color = '';
		} else {
			$this->lorempixel_color = 'g/';
		}

		if ( $this->lorempixel_genre == 'random' ) {
			$this->lorempixel_genre = '';
		} else {
			$this->lorempixel_genre = $this->lorempixel_genre . '/';
		}

		if ( '' != get_the_post_thumbnail( $post->ID ) ) { // check if the post has a featured image

			the_post_thumbnail( $this->post_thumb_size );

		} elseif ( $this->use_lorempixel == 1 ) {

 		$this->lorempixel  .= '<img src="http://lorempixel.com/';
    	$this->lorempixel  .= esc_attr( $this->lorempixel_color ) . esc_attr( $this->lorempixel_width ) . '/' . esc_attr( $this->lorempixel_height ) . '/' . esc_attr( $this->lorempixel_genre ) . '" />';

    	return $this->lorempixel ;

		} else {

			return '<img src="'. get_template_directory_uri() . '/images/placeholders/' . $this->placeholder_size . '" />';

		}

    }

}

// EXAMPLES OF USE IN OTHER FILES:

// $td_firstclass = new Td_Placeholder_Module( '350', '165', '350x165.png', 'related-post' );
// echo $td_firstclass->return_image();

// $td_secondclass = new Td_Placeholder_Module( '350', '165', '350x165.png', 'related-post'  );
// echo $td_secondclass->return_image();