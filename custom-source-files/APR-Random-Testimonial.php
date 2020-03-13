<?php
/*
Plugin Name: APR Random Testimonial widget
Description: Gets and displays a random testimonial from the database
Version: 1.0
*/

// Register and load the widget
//
add_action( 'widgets_init', 'my_load_customAPR_widget' );

function my_load_customAPR_widget() {
    if ( class_exists( 'EE_Registry' ) ) {
        register_widget( 'APR_Random_Testimonial' );
    }
}

// The widget
//
class APR_Random_Testimonial  extends WP_Widget {
    /**
     * Register widget with WordPress.
     */

    function __construct() {
        parent::__construct(
            'custom-apr-random-testimonial-widget',
            __( 'APR Custom Random Testimonial', 'apr_widgets' ),
            array( 'description' => __( 'A widget to display a random testimonial.', 'apr_widgets' )),
            array(
                'width' => 300,
                'height' => 350,
                'id_base' => 'custom-apr-random-testimonial-widget'
            )
        );
    }

    // Widget Backend
    public function form( $instance ) {
//        if ( isset( $instance[ 'title' ] ) ) {
//            $title = $instance[ 'title' ];
//        }
//        else {
//            $title = __( 'New title', 'wpb_widget_domain' );
//        }
// Widget admin form

        echo '<p>';
//        echo '<label for="'.$this->get_field_id( 'title' ).'">'._e( 'Title:' ).'</label>';
//        echo '<input class="widefat" id="'. $this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" />';
        echo 'Displays a single random testimonial';
        echo '</p>';
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

        $before_widget = '';
        $after_widget = '';
        extract($args);

        // get testimonial
        $hero = get_posts(array( 'post_type'=>'jetpack-testimonial', 'numberposts' => 1, 'orderby' => 'rand' ) );
        // Reset query
        wp_reset_query();

        // Before widget (defined by themes).
        echo $before_widget;
        $hero_id = $hero[0]->ID;

        echo '<div id="testimonial-section">';
            echo '<div class="inner-container">';
                echo '<div id="testimonial-container" class="inner-container">';
                    echo '<div class="testimonial-left">';
                        echo '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="116.483px" height="85.489px" viewBox="0 0 116.483 85.489" enable-background="new 0 0 116.483 85.489" xml:space="preserve">';
                            echo '<path id="openquote" d="M54.164,60.351c0,2.916-0.557,5.694-1.666,8.33c-1.113,2.639-2.639,4.965-4.582,6.977c-1.946,2.014-4.236,3.576-6.872,4.686
                                        c-2.639,1.113-5.486,1.666-8.538,1.666c-6.664,0-12.115-2.219-16.348-6.664c-4.237-4.442-6.352-10.272-6.352-17.493
                                        c0-5.691,0.761-11.174,2.291-16.452c1.526-5.274,3.608-10.308,6.248-15.098c2.636-4.79,5.727-9.299,9.267-13.536
                                        C31.152,8.533,34.934,4.612,38.962,1l9.788,9.788c-4.445,4.445-8.226,9.095-11.35,13.953c-3.124,4.861-5.31,9.928-6.56,15.203
                                        c4.025,0,7.529,0.592,10.517,1.77c2.983,1.181,5.414,2.707,7.289,4.582c1.874,1.874,3.26,4.061,4.165,6.56
                                        C53.712,55.353,54.164,57.852,54.164,60.351z M111.305,60.351c0,2.916-0.556,5.694-1.666,8.33c-1.112,2.639-2.639,4.965-4.581,6.977
                                        c-1.946,2.014-4.269,3.576-6.977,4.686c-2.707,1.113-5.59,1.666-8.642,1.666c-6.664,0-12.079-2.219-16.244-6.664
                                        c-4.165-4.442-6.248-10.272-6.248-17.493c0-5.691,0.729-11.174,2.187-16.452c1.458-5.274,3.504-10.308,6.144-15.098
                                        c2.636-4.79,5.727-9.299,9.267-13.536C88.085,8.533,91.866,4.612,95.895,1l9.788,9.788c-4.445,4.445-8.226,9.095-11.35,13.953
                                        c-3.124,4.861-5.31,9.928-6.56,15.203c4.025,0,7.529,0.592,10.517,1.77c2.984,1.181,5.447,2.707,7.393,4.582
                                        c1.942,1.874,3.364,4.061,4.269,6.56C110.853,55.353,111.305,57.852,111.305,60.351z"/>';
                        echo '</svg>';
                    echo '</div>';
                    echo '<div class="testimonial-center">';
                        echo '<div class="testimonial-text-container">';
                            echo '<div class="testimonial-text">' . wp_strip_all_tags(get_post_field('post_content', $hero_id)) . '</div>';
                            echo '<div class="testimonial-attributed"><span class="testimonial-attributed-name">' . wp_strip_all_tags(get_post_field('post_title', $hero_id)) . '</span></div>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="testimonial-right">';
                        echo '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="116.483px" height="85.489px" viewBox="0 0 116.483 85.489" enable-background="new 0 0 116.483 85.489" xml:space="preserve">';
                            echo '<path id="closequote" d="M66.948,22.658c0-2.916,0.557-5.694,1.666-8.33c1.113-2.639,2.639-4.965,4.582-6.977c1.946-2.014,4.236-3.576,6.872-4.686
                                        C82.707,1.553,85.554,1,88.605,1c6.664,0,12.115,2.219,16.348,6.664c4.237,4.442,6.352,10.272,6.352,17.493
                                        c0,5.691-0.761,11.174-2.291,16.452c-1.526,5.274-3.608,10.308-6.248,15.098c-2.636,4.79-5.727,9.299-9.267,13.536
                                        c-3.54,4.233-7.321,8.154-11.35,11.766l-9.788-9.788c4.445-4.445,8.226-9.095,11.35-13.953c3.124-4.861,5.31-9.928,6.56-15.203
                                        c-4.025,0-7.529-0.592-10.517-1.77c-2.983-1.181-5.414-2.707-7.289-4.582c-1.874-1.874-3.26-4.061-4.165-6.56
                                        C67.4,27.656,66.948,25.157,66.948,22.658z M9.807,22.658c0-2.916,0.556-5.694,1.666-8.33c1.112-2.639,2.639-4.965,4.581-6.977
                                        C18,5.337,20.323,3.776,23.031,2.666C25.738,1.553,28.621,1,31.673,1c6.664,0,12.079,2.219,16.244,6.664
                                        c4.165,4.442,6.248,10.272,6.248,17.493c0,5.691-0.729,11.174-2.187,16.452c-1.458,5.274-3.504,10.308-6.144,15.098
                                        c-2.636,4.79-5.727,9.299-9.267,13.536c-3.54,4.233-7.321,8.154-11.35,11.766l-9.788-9.788c4.445-4.445,8.226-9.095,11.35-13.953
                                        c3.124-4.861,5.31-9.928,6.56-15.203c-4.025,0-7.529-0.592-10.517-1.77c-2.984-1.181-5.447-2.707-7.393-4.582
                                        c-1.942-1.874-3.364-4.061-4.269-6.56C10.259,27.656,9.807,25.157,9.807,22.658z"/>';
                        echo '</svg>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

//        if ( get_post_meta($hero_id, 'testimonial-course', true) != '' || get_post_meta($hero_id, 'testimonial-location', true) != ''):
//            echo "<br><span class='testimonial-attributed-role'>";
//            echo get_post_meta($hero_id, 'testimonial-course', true) . ", ";
//            echo get_post_meta($hero_id, 'testimonial-location', true) . "</span>";
//        endif;
        // After widget (defined by themes).
        echo $after_widget;

    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here
