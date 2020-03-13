<?php
/*
Plugin Name: Agile EE Upcoming Events Widget
Description: A custom event list widget for Event Espresso 4 with main area and footer options
Version: 1.2
*/

function get_display_dates( $event, $date_range ) {
    $date_format = apply_filters( 'FHEE__espresso_event_date_range__date_format', get_option( 'date_format' ));
    $time_format = apply_filters( 'FHEE__espresso_event_date_range__time_format', get_option( 'time_format' ));
    $single_date_format = apply_filters( 'FHEE__espresso_event_date_range__single_date_format', get_option( 'date_format' ));
    $single_time_format = apply_filters( 'FHEE__espresso_event_date_range__single_time_format', get_option( 'time_format' ));
    if ( $date_range == TRUE ):
        $event_dates = espresso_event_date_range( $date_format, $time_format, $single_date_format, $single_time_format, $event->ID() );
    else:
        $event_dates = espresso_list_of_event_dates( $event->ID(), $date_format, $time_format, FALSE, NULL, TRUE, TRUE, $date_limit );
    endif;
    // parse out the date range string from the formatted object
    $date_string = $event_dates;
    $date_string_start = strpos($date_string,'daterange">')+11;
    $date_string_end = strpos($date_string,'</span><br/>', $date_string_start)-$date_string_start;
    $date_string = substr($date_string, $date_string_start, $date_string_end);

    // separate the two dates from range
    $events_dates = explode(" - ", trim($date_string));

    // break the first and second day into units
    $start_date = explode("&nbsp;", $events_dates[0]);
    $end_date = explode("&nbsp;", $events_dates[1]);
    //remove the comma from the date
    $start_date[1] = str_replace(",", "", $start_date[1]);
    $end_date[1] = str_replace(",", "", $end_date[1]);
    if ($start_date[0] == $end_date[0])
        $display_date = substr($start_date[0],0,3) . " " . $start_date[1] . "-" . $end_date[1] . ", " . $start_date[2];
    else
        $display_date = substr($start_date[0],0,3) . " " . $start_date[1] . " - " . substr($end_date[0],0,3) . " " . $end_date[1] . ", " . $start_date[2];
    return $display_date;
}

// Register and load the widget
//
add_action( 'widgets_init', 'my_load_customEE_widget' );

function my_load_customEE_widget() {
    if ( class_exists( 'EE_Registry' ) ) {
        register_widget( 'APR_EEW_Upcoming_Events' );
    }
}

// Optional: Remove the built-in widget
// comment this section out if you want to run both widgets
//
add_action( 'widgets_init', 'my_unregister_stock_ee_widget', 11 );

function my_unregister_stock_ee_widget() {
    unregister_widget( 'EEW_Upcoming_Events' );
}

wp_enqueue_style( 'APR_Custom_Widget_CSS', get_stylesheet_directory_uri() . '/APR_Custom_Widget_CSS.css');

// The widget
//
class APR_EEW_Upcoming_Events  extends WP_Widget {
    /**
     * Register widget with WordPress.
     */

    function __construct() {
        parent::__construct(
            'custom-ee-upcoming-events-widget',
            __( 'APR Custom Event Espresso Upcoming Events', 'event_espresso' ),
            array( 'description' => __( 'A widget to display your upcoming events.', 'event_espresso' )),
            array(
                'width' => 300,
                'height' => 350,
                'id_base' => 'custom-ee-upcoming-events-widget'
            )
        );
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     * @param array $instance Previously saved values from database.
     * @return string|void
     */
    public function form( $instance ) {
        EE_Registry::instance()->load_class( 'Question_Option', array(), FALSE, FALSE, TRUE );
        // Set up some default widget settings.
        $defaults = array(
            'title' => __('Upcoming Events', 'event_espresso'),
            'category_name' => '',
            'show_expired' => FALSE,
            'show_desc' => TRUE,
            'show_dates' => TRUE,
            'show_everywhere' => FALSE,
            'date_limit' => 2,
            'limit' => 10,
            'date_range' => FALSE,
            'image_size' => 'medium',
            'display_type' => 'home'
        );

        $instance = wp_parse_args( (array) $instance, $defaults );
        // don't add HTML labels for EE_Form_Fields generated inputs
        add_filter( 'FHEE__EEH_Form_Fields__label_html', '__return_empty_string' );
        $yes_no_values = array(
            EE_Question_Option::new_instance( array( 'QSO_value' => FALSE, 'QSO_desc' => __('No', 'event_espresso'))),
            EE_Question_Option::new_instance( array( 'QSO_value' => TRUE, 'QSO_desc' => __('Yes', 'event_espresso')))
        );
        ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Title:', 'event_espresso'); ?>
            </label>
            <input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('category_name'); ?>">
                <?php _e('Event Category:', 'event_espresso'); ?>
            </label>
            <?php
            $event_categories = array();
            /** @type EEM_Term $EEM_Term */
            $EEM_Term = EE_Registry::instance()->load_model( 'Term' );
            $categories = $EEM_Term->get_all_ee_categories( TRUE );
            if ( $categories ) {
                foreach ( $categories as $category ) {
                    if ( $category instanceof EE_Term ) {
                        $event_categories[] = EE_Question_Option::new_instance( array( 'QSO_value' => $category->get( 'slug' ), 'QSO_desc' => $category->get( 'name' )));
                    }
                }
            }
            array_unshift( $event_categories, EE_Question_Option::new_instance( array( 'QSO_value' => '', 'QSO_desc' => __(' - display all - ', 'event_espresso'))));
            echo EEH_Form_Fields::select(
                __('Event Category:', 'event_espresso'),
                $instance['category_name'],
                $event_categories,
                $this->get_field_name('category_name'),
                $this->get_field_id('category_name')
            );
            ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">
                <?php _e('Number of Events to Display:', 'event_espresso'); ?>
            </label>
            <input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo $instance['limit']; ?>" size="3" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_expired'); ?>">
                <?php _e('Show Expired Events:', 'event_espresso'); ?>
            </label>
            <?php
            echo EEH_Form_Fields::select(
                __('Show Expired Events:', 'event_espresso'),
                $instance['show_expired'],
                $yes_no_values,
                $this->get_field_name('show_expired'),
                $this->get_field_id('show_expired')
            );
            ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_size'); ?>">
                <?php _e('Image Size:', 'event_espresso'); ?>
            </label>
            <?php
            $image_sizes = array();
            $sizes = get_intermediate_image_sizes();
            if ( $sizes ) {
                // loop thru images and create option objects out of them
                foreach ( $sizes as $image_size ) {
                    $image_size = trim( $image_size );
                    // no big images plz
                    if ( ! in_array( $image_size, array( 'large', 'post-thumbnail' ))) {
                        $image_sizes[] = EE_Question_Option::new_instance( array( 'QSO_value' => $image_size, 'QSO_desc' => $image_size ));
                    }
                }
                $image_sizes[] = EE_Question_Option::new_instance( array( 'QSO_value' => 'none', 'QSO_desc' =>  __('don\'t show images', 'event_espresso') ));
            }
            echo EEH_Form_Fields::select(
                __('Image Size:', 'event_espresso'),
                $instance['image_size'],
                $image_sizes,
                $this->get_field_name('image_size'),
                $this->get_field_id('image_size')
            );
            ?>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_desc'); ?>">
                <?php _e('Show Description:', 'event_espresso'); ?>
            </label>
            <?php
            echo EEH_Form_Fields::select(
                __('Show Description:', 'event_espresso'),
                $instance['show_desc'],
                $yes_no_values,
                $this->get_field_name('show_desc'),
                $this->get_field_id('show_desc')
            );
            ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_dates'); ?>">
                <?php _e('Show Dates:', 'event_espresso'); ?>
            </label>
            <?php
            echo EEH_Form_Fields::select(
                __('Show Dates:', 'event_espresso'),
                $instance['show_dates'],
                $yes_no_values,
                $this->get_field_name('show_dates'),
                $this->get_field_id('show_dates')
            );
            ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_everywhere'); ?>">
                <?php _e('Show on all Pages:', 'event_espresso'); ?>
            </label>
            <?php
            echo EEH_Form_Fields::select(
                __('Show on all Pages:', 'event_espresso'),
                $instance['show_everywhere'],
                $yes_no_values,
                $this->get_field_name('show_everywhere'),
                $this->get_field_id('show_everywhere')
            );
            ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('date_limit'); ?>">
                <?php _e('Number of Dates to Display:', 'event_espresso'); ?>
            </label>
            <input id="<?php echo $this->get_field_id('date_limit'); ?>" name="<?php echo $this->get_field_name('date_limit'); ?>" value="<?php echo esc_attr( $instance['date_limit'] ); ?>" size="3" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('date_range'); ?>">
                <?php _e('Show Date Range:', 'event_espresso'); ?>
            </label>
            <?php
            echo EEH_Form_Fields::select(
                __('Show Date Range:', 'event_espresso'),
                $instance['date_range'],
                $yes_no_values,
                $this->get_field_name('date_range'),
                $this->get_field_id('date_range')
            );
            ?><span class="description"><br /><?php _e('This setting will replace the list of dates in the widget.', 'event_espresso'); ?></span>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('display_type'); ?>">
                <?php _e('Display Type:', 'event_espresso'); ?>
            </label>
            <?php
            $display_types = array(
                EE_Question_Option::new_instance( array( 'QSO_value' => 'home', 'QSO_desc' => __('Home Page', 'event_espresso'))),
                EE_Question_Option::new_instance( array( 'QSO_value' => 'footer', 'QSO_desc' => __('Footer', 'event_espresso'))),
                EE_Question_Option::new_instance( array( 'QSO_value' => 'course_parent', 'QSO_desc' => __('Course Parent Page', 'event_espresso'))),
                EE_Question_Option::new_instance( array( 'QSO_value' => 'course', 'QSO_desc' => __('Specific Course Page', 'event_espresso')))
            );
            echo EEH_Form_Fields::select(
                __('Display Type:', 'event_espresso'),
                $instance['display_type'],
                $display_types,
                $this->get_field_name('display_type'),
                $this->get_field_id('display_type')
            );
            ?><span class="description"><br /><?php _e('This setting will display specific details with specific styling for each display type.', 'event_espresso'); ?></span>

        </p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['category_name'] = $new_instance['category_name'];
        $instance['show_expired'] = $new_instance['show_expired'];
        $instance['limit'] = $new_instance['limit'];
        $instance['image_size'] = $new_instance['image_size'];
        $instance['show_desc'] = $new_instance['show_desc'];
        $instance['show_dates'] = $new_instance['show_dates'];
        $instance['show_everywhere'] = $new_instance['show_everywhere'];
        $instance['date_limit'] = $new_instance['date_limit'];
        $instance['date_range'] = $new_instance['date_range'];
        $instance['display_type'] = $new_instance['display_type'];
        return $instance;
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

        global $post;
        // make sure there is some kinda post object
        if ( $post instanceof WP_Post ):
            $before_widget = '';
            $before_title = '';
            $after_title = '';
            $after_widget = '';
            // but NOT an events archives page, cuz that would be like two event lists on the same page
            $show_everywhere = isset( $instance['show_everywhere'] ) ? (bool) absint( $instance['show_everywhere'] ) : TRUE;
            if ( $show_everywhere || ! ( $post->post_type == 'espresso_events' && is_archive() )):
                // let's use some of the event helper functions'
                // make separate vars out of attributes

                extract($args);

                $title = $instance['title'];

                // Before widget (defined by themes).
                echo $before_widget;
                // Display the widget title if one was input (before and after defined by themes).
                if ( ! empty( $title )) {
                    echo $before_title . $title . $after_title;
                }
                // grab widget settings
                $category = isset( $instance['category_name'] ) && ! empty( $instance['category_name'] ) ? $instance['category_name'] : FALSE;
                $show_expired = isset( $instance['show_expired'] ) ? (bool) absint( $instance['show_expired'] ) : FALSE;
                $image_size = isset( $instance['image_size'] ) && ! empty( $instance['image_size'] ) ? $instance['image_size'] : 'medium';
                $show_desc = isset( $instance['show_desc'] ) ? (bool) absint( $instance['show_desc'] ) : TRUE;
                $show_dates = isset( $instance['show_dates'] ) ? (bool) absint( $instance['show_dates'] ) : TRUE;
                $date_limit = isset( $instance['date_limit'] ) && ! empty( $instance['date_limit'] ) ? $instance['date_limit'] : NULL;
                $date_range = isset( $instance['date_range'] ) && ! empty( $instance['date_range'] ) ? $instance['date_range'] : FALSE;
                $display_type = isset( $instance['display_type'] ) && ! empty( $instance['display_type'] ) ? $instance['display_type'] : 'home';

                // start to build our where clause
                $where = array(
//                  'Datetime.DTT_is_primary' => 1,
                    'status' => array( 'IN', array( 'publish', 'sold_out' ) )
                );
                // add category
                if ( $category ) {
                    $where['Term_Taxonomy.taxonomy'] = 'espresso_event_categories';
                    $where['Term_Taxonomy.Term.slug'] = $category;
                }
                // if NOT expired then we want events that start today or in the future
                if ( ! $show_expired ) {
                    $where['Datetime.DTT_EVT_end'] = array( '>=', EEM_Datetime::instance()->current_time_for_query( 'DTT_EVT_end' ) );
                }
                // allow $where to be filtered
                $where = apply_filters( 'FHEE__EEW_Upcoming_Events__widget__where', $where, $category, $show_expired );
                // run the query
                $events = EE_Registry::instance()->load_model( 'Event' )->get_all( array(
                    $where,
                    'limit' => $instance['limit'] > 0 ? '0,' . $instance['limit'] : '0,4',
                    'order_by' => 'Datetime.DTT_EVT_start',
                    'order' => 'ASC',
                    'group_by' => 'EVT_ID'
                ));

                if ( ! empty( $events )):
                    $course_type = strtolower($category);
                    $course_types = array(
                        "csm" => array(
                            "logo" => "/wp-content/uploads/2020/02/Scrum-Alliance-seal-csm-600x600-1-150x150.png",
                            "title" => "Certified ScrumMaster Scrum Alliance seal",
                            "url" => "/certified-scrummaster-csm-training"
                        ),
                        "cspo" => array(
                            "logo" => "/wp-content/uploads/2020/02/Scrum-Alliance-seal-acsm-600x600-1-150x150.png",
                            "title" => "Advanced Certified ScrumMaster Scrum Alliance seal",
                            "url" => "/advanced-certified-scrummaster-acsm-training"
                        ),
                        "a-csm" => array(
                            "logo" => "/wp-content/uploads/2020/02/Scrum-Alliance-seal-cspo-600x600-1-150x150.png",
                            "title" => "Certified Scrum Product Owner Scrum Alliance seal",
                            "url" => "/certified-scrum-product-owner-cspo-training"
                        )
                    );

                    if  ( $display_type == 'course_parent' ):
                        $course_type_details = $course_types[$course_type];
                        echo '<div class="ee-upcoming-events-widget-list-container">';
                        foreach ( $events as $event ):
                            $display_date = $show_dates ? get_display_dates($event, $date_range) : "";
                            $event_url = apply_filters( 'FHEE_EEW_Upcoming_Events__widget__event_url', $event->get_permalink(), $event );
                            $event_location = "";
                            $event_name = strpos($event->name(), "(CSM)") ? "Certified ScrumMaster Workshop" : $event->name();
                            $event_name = strpos($event->name(), "(CSPO)") ? "Certified Scrum Product Owner Workshop" : $event_name;
                            $event_name = strpos($event->name(), "(A-CSM)") ? "Advanced Certified ScrumMaster Workshop" : $event_name;
                            foreach ($event->venues() as $venue):
                                $event_location = $venue->city();
                            endforeach;
                            echo '<div class="ee-upcoming-events-widget-list-row">';
                                echo '<div class="ee-upcoming-events-widget-list-date"><a href="'.$event_url.'">'.$display_date.'</a></div>';
                                echo '<div class="ee-upcoming-events-widget-list-detail-row">';
                                    echo '<div class="ee-upcoming-events-widget-list-cma-logo"><img src="'.$course_type_details["logo"].'" title="'.$course_type_details["title"].'" /></div>';
                                    echo '<div class="ee-upcoming-events-widget-list-location">'.$event_location.'</div>';
                                    echo '<div class="ee-upcoming-events-widget-list-title">'.$event_name.'</div>';
                                    echo '<div class="ee-upcoming-events-widget-list-action">';
                                    if ( $event->is_sold_out() || $event->is_sold_out( TRUE ) ):
                                        echo '<span class="sold_out">SOLD OUT</span>';
                                    else:
                                        echo '<a href="'.$event_url.'"><div class="cta-button course-info-button course-info-'.$course_type.'">Register Now</div></a>';
                                    endif;
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        endforeach;
                        echo '</div>';
                    else:
                        $qty = sizeof($events);
                        $widthClass = $qty == 4 ? "width25percent" : ($qty == 3 ? "width33percent" : ($qty == 2 ? "width50percent" : "width100percent"));
                        echo '<ul class="ee-upcoming-events-widget-ul ee-upcoming-events-widget-ul-'.$course_type.'">';
                        foreach ( $events as $event ):
                            // how big is the event name ?
                            $name_length = strlen( $event->name() );
                            switch( $name_length ) {
                                case $name_length > 70 :
                                    $len_class =  ' three-line';
                                    break;
                                case $name_length > 35 :
                                    $len_class =  ' two-line';
                                    break;
                                default :
                                    $len_class =  ' one-line';
                            }
                            $event_url = apply_filters( 'FHEE_EEW_Upcoming_Events__widget__event_url', $event->get_permalink(), $event );
                            $guaranteed_image_url = get_stylesheet_directory_uri()."/images/certified.svg";
                            $event_name = strpos($event->name(), "(CSM)") ? "Certified ScrumMaster Workshop" : $event->name();
                            $event_name = strpos($event->name(), "(CSPO)") ? "Certified Scrum Product Owner Workshop" : $event_name;
                            $event_name = strpos($event->name(), "(A-CSM)") ? "Advanced Certified ScrumMaster Workshop" : $event_name;
                            $course_class = strpos($event->name(), "(CSM)") ? "csm" : "";
                            $course_class = strpos($event->name(), "(CSPO)") ? "cspo" : $course_class;
                            $course_class = strpos($event->name(), "(A-CSM)") ? "a-csm" : $course_class;
                            foreach ($event->venues() as $venue):
                                $event_location = " in " . $venue->city();
                            endforeach;
                            $display_date = $show_dates ? get_display_dates($event, $date_range) : "";
                            if ( $event instanceof EE_Event && ( !is_single() || $post->ID != $event->ID() ) ):
                                if ( $display_type == 'home' ):
                                    echo '<li id="ee-upcoming-events-widget-li-' . $event->ID() . '" class="ee-upcoming-events-widget-li '.$widthClass.' ee-upcoming-events-widget-li_'.$course_class.'">';
                                    echo '<h5 class="ee-upcoming-events-widget-title-h5"><a class="ee-widget-event-name-a' . $len_class . '" href="' . $event_url . '">' . $event_name . '</a></h5>';
                                    echo '<div class="display_event_location">' . $event_location . '</div>';
                                    if ($show_dates) {
                                        echo '<div class="display_event_dates">' . $display_date . '</div>';
                                    }
                                    echo '<div class="guarantee-wrap">';
                                    echo '<div class="guarantee-block block-block">';
                                    echo '<img class="date-guarantee-course-img" src="' . $guaranteed_image_url . '" scale="0">';
                                    echo '<div class="date-guarantee-text course-text"><a href="/guaranteed-course-dates">Guaranteed course date</a></div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<a href="' . $event_url . '"><div class="cta-button course-info-button course-info-'.$course_type.'">Learn More</div></a>';
                                    if (post_password_required($event->ID())):
                                        $pswd_form = apply_filters('FHEE_EEW_Upcoming_Events__widget__password_form', get_the_password_form($event->ID()), $event);
                                        echo $pswd_form;
                                    else:
                                        if (has_post_thumbnail($event->ID()) && $image_size != 'none'):
                                            echo '<div class="ee-upcoming-events-widget-img-dv"><a class="ee-upcoming-events-widget-img" href="' . $event_url . '">' . get_the_post_thumbnail($event->ID(), $image_size) . '</a></div>';
                                        endif;
                                        $desc = $event->short_description(25);
                                        if ($show_desc && $desc):
                                            echo '<p style="margin-top: .5em">' . $desc . '</p>';
                                        endif;
                                    endif;
                                    echo '</li>';
                                elseif  ( $display_type == 'specific_course' ):
                                    echo '<li id="ee-upcoming-events-widget-li-' . $event->ID() . '" class="ee-upcoming-events-widget-li">';
                                    echo '<h5 class="ee-upcoming-events-widget-title-h5"><a class="ee-widget-event-name-a' . $len_class . '" href="' . $event_url . '">' . $event_name . "<br />" . $event_location . "<br />" . $display_date . '</a></h5>';
                                    echo '</li>';
                                else:
                                    echo '<li id="ee-upcoming-events-widget-li-' . $event->ID() . '" class="ee-upcoming-events-widget-li">';
                                    echo '<h5 class="ee-upcoming-events-widget-title-h5"><a class="ee-widget-event-name-a' . $len_class . '" href="' . $event_url . '">' . $event_name . "<br />" . $event_location . "<br />" . $display_date . '</a></h5>';
                                    echo '</li>';
                                endif;
                            endif;
                        endforeach;
                        echo '</ul>';
                    endif;
                endif;
                // After widget (defined by themes).
                echo $after_widget;
            endif;
        endif;
    }
}