<?php
class Teamspeak_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('teamspeak', 'Teamspeak', array('description' => 'Affiche le teamspeak.' ));
    }

	public function widget($args, $instance)
	{
	    echo $args['before_widget'];
	    echo $args['before_title'];
	    echo apply_filters('widget_title', $instance['title']);
	    echo $args['after_title'];

    	$html = $instance['html'];
    	echo $html;

	    echo $args['after_widget'];
	}

	public function form($instance)
	{
	    $title = isset($instance['title']) ? $instance['title'] : '';

	    $html = isset($instance['html']) ? $instance['html'] : '';
	    ?>
	    <p>
	        <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo  $title; ?>" />
	    </p>
    	<p>
	        <label for="<?php echo $this->get_field_name( 'html' ); ?>"><?php _e( 'Code html :' ); ?></label>
	        <textarea cols="40" rows="5" id="<?php echo $this->get_field_id( 'html' ); ?>" name="<?php echo $this->get_field_name( 'html' ); ?>" ><?php echo  $html; ?></textarea>
	    </p>

	    <?php
	}
}


?>