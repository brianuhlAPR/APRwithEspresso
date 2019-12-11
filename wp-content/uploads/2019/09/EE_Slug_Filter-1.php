<?php
/*
Plugin Name: Site plugin for agilepainrelief.com
Description: Site specific code for agilepainrelief.com
*/
/* Begin Adding Functions Below This Line; */

add_filter( 'FHEE__EE_Register_CPTs__register_CPT__rewrite', 'my_custom_event_slug', 10, 2 );
    function my_custom_event_slug( $slug, $post_type ) {
    	if ( $post_type == 'espresso_events' ) {
    		$custom_slug = array( 'slug' => 'courses' );
    		return $custom_slug;
    	}
    	return $slug;
    }

/* Stop Adding Functions */
