<?php
/*
Plugin Name: User Poll Widget
Plugin URI: 
Description: This plugin adds a custom user poll widget.
Version: 1.0
Author: Your Name
Author URI: 
License: GPL2
*/

// The widget class
class User_Poll_Widget extends WP_Widget {

    // Main constructor
    public function __construct() {
        parent::__construct(
            'user_poll_widget',
            __( 'User Poll Widget', 'text_domain' ),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }

    // The widget form (for the backend)
    public function form( $instance ) {

        // Set widget defaults
        $defaults = array(
            'title'    => '',
            'question' => '',
            'options'  => '',
        );
        
        // Parse current settings with defaults
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <!-- Poll Question -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'question' ) ); ?>"><?php _e( 'Poll Question:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'question' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'question' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['question'] ); ?>" />
        </p>

        <!-- Poll Options -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'options' ) ); ?>"><?php _e( 'Poll Options (comma separated):', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'options' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'options' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['options'] ); ?>" />
        </p>

    <?php }

    // Update widget settings
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
        $instance['question'] = isset( $new_instance['question'] ) ? wp_strip_all_tags( $new_instance['question'] ) : '';
        $instance['options']  = isset( $new_instance['options'] ) ? wp_strip_all_tags( $new_instance['options'] ) : '';
        return $instance;
    }

    // Display the widget
    public function widget( $args, $instance ) {

        extract( $args );

        // Check the widget options
        $title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
        $question = isset( $instance['question'] ) ? $instance['question'] : '';
        $options  = isset( $instance['options'] ) ? explode( ',', $instance['options'] ) : array();

        // WordPress core before_widget hook (always include )
        echo $before_widget;

        // Display the widget title if defined
        if ( $title ) {
            echo '<h2 class="widget-title text-white">' . $title . '</h2>';
        }

        // Display the poll question
        if ( $question ) {
            echo '<p>' . $question . '</p>';
        }

        // Display the poll form
        if ( !empty( $options ) ) {
            echo '<form method="post" action="">';
            echo '<ul>';
            foreach ( $options as $option ) {
                echo '<li><label><input type="radio" name="poll_option" value="' . esc_attr( $option ) . '" /> ' . esc_html( $option ) . '</label></li>';
            }
            echo '</ul>';
            echo '<input type="submit" name="poll_submit" value="Vote" />';
            echo '</form>';

            // Handle poll submission
            if ( isset( $_POST['poll_submit'] ) && isset( $_POST['poll_option'] ) ) {
                $vote = sanitize_text_field( $_POST['poll_option'] );
                $poll_results = get_option( 'poll_results', array() );
                if ( isset( $poll_results[$vote] ) ) {
                    $poll_results[$vote]++;
                } else {
                    $poll_results[$vote] = 1;
                }
                update_option( 'poll_results', $poll_results );
            }

            // Display poll results
            $poll_results = get_option( 'poll_results', array() );
            if ( !empty( $poll_results ) ) {
                echo '<h4>Results:</h4>';
                echo '<ul>';
                foreach ( $options as $option ) {
                    $count = isset( $poll_results[$option] ) ? $poll_results[$option] : 0;
                    echo '<li>' . esc_html( $option ) . ': ' . esc_html( $count ) . ' votes</li>';
                }
                echo '</ul>';
            }
        }

        // WordPress core after_widget hook (always include )
        echo $after_widget;

    }

}

// Register the widget
function register_user_poll_widget() {
    register_widget( 'User_Poll_Widget' );
}
add_action( 'widgets_init', 'register_user_poll_widget' );
