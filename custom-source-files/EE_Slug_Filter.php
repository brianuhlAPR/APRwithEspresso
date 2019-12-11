<?php
/*
Plugin Name: Event Espresso - Permalink Modifier
Description: Change default permalink type from "events" to "courses"
Version: 1.0
Author: Brian Uhl
*/
add_filter( 'FHEE__EE_Register_CPTs__register_CPT__rewrite', 'my_custom_event_slug', 10, 2 );
function my_custom_event_slug( $slug, $post_type ) {
    if ( $post_type == 'espresso_events' ) {
        $custom_slug = array( 'slug' => 'courses', 'with_front' => false );
        return $custom_slug;
    }
    return $slug;
}