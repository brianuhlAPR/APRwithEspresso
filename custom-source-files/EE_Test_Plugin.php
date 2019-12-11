<?php
/*
Plugin Name: Event Espresso - Testing Adding Shortcodes
Description: Testing Loading Events
Version: 1.0
Author: Brian Uhl
*/

function getEvents()
{
    $events = EEM_Event::instance()->get_upcoming_events(
        array(
            'order_by' => array( 'Datetime.DTT_EVT_start' => 'ASC' )
        )
    );
    var_dump($events);
}
add_shortcode('GET_EVENTS', 'getEvents');
