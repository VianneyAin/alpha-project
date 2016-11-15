<?php

/*----------------------------------------------------------------------------------------------------------
  Widget class
-----------------------------------------------------------------------------------------------------------*/
class Gameleon_Tag_Cloud extends WP_Widget {


/*----------------------------------------------------------------------------------------------------------
  Register widget with WordPress
-----------------------------------------------------------------------------------------------------------*/

public function __construct() {
  parent::__construct(
    'gameleon_tag_cloud',
            __( '[GAMELEON] Tag Cloud', 'gameleon' ), // Widget Name
            array( 'description' => __( 'A SEO optimized cloud of your most popular tags.', 'gameleon' ), ) // Widget Args
            );
}


/*----------------------------------------------------------------------------------------------------------
  Front-end display of widget
-----------------------------------------------------------------------------------------------------------*/

public function widget( $args, $instance ) {
    extract( $args );
    $title          = apply_filters( 'widget_title', $instance['title'] );
    $tags_count     = $instance['td_tags_number'];
    $tags_taxonomy  = $instance['td_taxonomy'];

    $td_tag_colored = ! empty( $instance['td_tag_colored'] ) ? '1' : '0';
    $td_tag_display = ! empty( $instance['td_tag_display'] ) ? '1' : '0';

    if ( $td_tag_colored ) {
            $td_colored_tag = 'td-tag-colored';
        }
        else {
            $td_colored_tag = '';
        }
        if ( $td_tag_display ) {
            $td_tag_inline = 'td-tag-cloud-full-length';
        }
        else {
            $td_tag_inline = 'td-tag-cloud-inline';
        }

        echo $before_widget;
        if ( $instance['title'] ) {
            echo $before_title . $title . $after_title;
        }
        ?>

    <div class="td-tag-cloud-widget <?php echo $td_colored_tag; ?> <?php echo $td_tag_inline; ?>">
        <?php
        $tags = wp_tag_cloud( array(
            'number'                    => $tags_count,
            'taxonomy'                  => $tags_taxonomy,
            'orderby'                   => 'count',
            'order'                     => 'RAND',
            'topic_count_text_callback' => 'gameleon_change_tag_cloud_tooltip',
            ) );

        echo $tags;
        ?>

    </div>

    <?php
    echo $after_widget;

    }


/*----------------------------------------------------------------------------------------------------------
  Sanitize widget form values as they are saved
-----------------------------------------------------------------------------------------------------------*/

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['td_tags_number'] = esc_attr( $new_instance['td_tags_number'] );
        $instance['td_tag_colored'] = !empty($new_instance['td_tag_colored']) ? 1 : 0;
        $instance['td_tag_display'] = !empty($new_instance['td_tag_display']) ? 1 : 0;
        $instance['td_taxonomy']    = esc_attr( $new_instance['td_taxonomy'] );
        return $instance;
    }


/*----------------------------------------------------------------------------------------------------------
  Back-end widget form
-----------------------------------------------------------------------------------------------------------*/

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Tag Cloud', 'gameleon' );
        }

        if ( isset( $instance[ 'td_tags_number' ] ) ) {
            $tags_count = $instance[ 'td_tags_number' ];
        }
        else {
            $tags_count = 8;
        }
        if ( isset( $instance[ 'td_taxonomy' ] ) ) {
            $tags_taxonomy = $instance[ 'td_taxonomy' ];
        }
        else {
            $tags_taxonomy = 'post_tag';
        }
        $td_tag_colored = isset( $instance['td_tag_colored'] ) ? (bool) $instance['td_tag_colored'] : false;
        $td_tag_display = isset( $instance['td_tag_display'] ) ? (bool) $instance['td_tag_display'] : false;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'gameleon' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'td_tags_number' ); ?>"><?php _e( 'Number of Tags to show:', 'gameleon' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'td_tags_number' ); ?>" name="<?php echo $this->get_field_name( 'td_tags_number' ); ?>" type="text" value="<?php echo esc_attr( $tags_count ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id( 'td_taxonomy' ); ?>"><?php _e( 'Taxonomy:', 'gameleon' ); ?></label>
          <select id="<?php echo $this->get_field_id( 'td_taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'td_taxonomy' ); ?>" class="widefat">
            <option value="post_tag"<?php if( $tags_taxonomy == "post_tag" ) echo ' selected="selected"';?>><?php _e( 'Tags', 'gameleon' );?></option>
            <option value="category"<?php if( $tags_taxonomy == "category" ) echo ' selected="selected"';?>><?php _e( 'Categories', 'gameleon' );?></option>
          </select>
        </p>

        <p>

        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('td_tag_colored'); ?>" name="<?php echo $this->get_field_name('td_tag_colored'); ?>"<?php checked( $td_tag_colored ); ?> />
        <label for="<?php echo $this->get_field_id('td_tag_colored'); ?>"><?php _e( 'Colored Tags', 'gameleon' ); ?></label>
        </p>


        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('td_tag_display'); ?>" name="<?php echo $this->get_field_name('td_tag_display'); ?>"<?php checked( $td_tag_display ); ?> />
        <label for="<?php echo $this->get_field_id('td_tag_display'); ?>"><?php _e( 'Display tags one per line', 'gameleon' ); ?></label>
        </p>

        <?php
    }

}

/*----------------------------------------------------------------------------------------------------------
  Register Gameleon_Tag_Cloud widget
-----------------------------------------------------------------------------------------------------------*/

function gameleon_tag_cloud_init(){
    register_widget( 'Gameleon_Tag_Cloud' );
}

add_action( 'widgets_init', 'gameleon_tag_cloud_init' );