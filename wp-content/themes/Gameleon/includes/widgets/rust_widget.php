<?php
class Rust_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('rust', 'Rust', array('description' => 'Affiche les détails du serveur rust' ));
    }

	public function widget($args, $instance)
	{
    	$rust_title = $instance['rust_title'];
    	$rust_url = $instance['rust_url'];

	    echo $args['before_widget'];
	    echo $args['before_title'];
	    echo apply_filters('widget_title', $rust_title);
	    echo $args['after_title'];
    	?>
    	<img style="-webkit-user-select: none" src="<?php echo $rust_url; ?>">
    	<?php
	    echo $args['after_widget'];
	}

	public function form($instance)
	{

	    $rust_title = isset($instance['rust_title']) ? $instance['rust_title'] : '';
	    $rust_url = isset($instance['rust_url']) ? $instance['rust_url'] : '';
	    ?>
	    <p>
	        <label for="<?php echo $this->get_field_name( 'rust_title' ); ?>"><?php _e( 'Titre du widget :' ); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'rust_title' ); ?>" name="<?php echo $this->get_field_name( 'rust_title' ); ?>" type="text" value="<?php echo  $rust_title; ?>" />
	    </p>
	    <p>
	        <label for="<?php echo $this->get_field_name( 'rust_url' ); ?>"><?php _e( 'Lien vers la page du serveur :' ); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'rust_url' ); ?>" name="<?php echo $this->get_field_name( 'rust_url' ); ?>" type="text" value="<?php echo  $rust_url; ?>" />
	    </p>

	    <?php
	}
}


?>