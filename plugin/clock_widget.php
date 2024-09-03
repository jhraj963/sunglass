<?php
/*
Plugin Name: Clock Widget
Plugin URI: 
Description: This plugin adds a custom clock widget.
Version: 1.0
Author: Your Name
Author URI: 
License: GPL2
*/

// The widget class
class Clock_Widget extends WP_Widget {

    // Main constructor
    public function __construct() {
        parent::__construct(
            'my_clock_widget',
            __( 'Clock Widget', 'text_domain' ),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }

    // The widget form (for the backend)
    public function form( $instance ) {

        // Set widget defaults
        $defaults = array(
            'title'    => __( 'Current Time', 'text_domain'),
        );

        // Parse current settings with defaults
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <?php // Widget Title ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

    <?php }

    // Update widget settings
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
        return $instance;
    }

    // Display the widget
    public function widget( $args, $instance ) {

        extract( $args );

        // Check the widget options
        $title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';

        // WordPress core before_widget hook (always include )
        echo $before_widget;

        // Display the widget title if defined
        if ( $title ) {
            echo '<h2 class="widget-title text-white btn btn-danger">' . $title . '</h2>';
        }

        // Display the current time
        echo '<div id="clock" style="font-size: 24px; font-family: Arial, sans-serif;"></div>';

        // JavaScript to update the clock every second
        ?>
        <script type="text/javascript">
            function updateClock() {
                var now = new Date();
                var hours = now.getHours();
                var minutes = now.getMinutes();
                var seconds = now.getSeconds();
                var ampm = hours >= 12 ? 'PM' : 'AM';

                hours = hours % 12;
                hours = hours ? hours : 12;
                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                var timeString = hours + ':' + minutes + ':' + seconds + ' ' + ampm;

                document.getElementById('clock').innerText = timeString;
            }

            setInterval(updateClock, 1000);
            updateClock(); // initial call to display clock immediately
        </script>
        <?php

        // WordPress core after_widget hook (always include )
        echo $after_widget;

    }

}

// Register the widget
function register_clock_widget() {
    register_widget( 'Clock_Widget' );
}
add_action( 'widgets_init', 'register_clock_widget' );
