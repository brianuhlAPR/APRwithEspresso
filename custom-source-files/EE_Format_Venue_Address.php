<?php
/*
Plugin Name: Event Espresso - Format Venue adresses
Description: Improves the appearance of venue addresses
Version: 1.0
Author: Brian Uhl
*/

function espresso_venue_address( $type = 'multiline', $VNU_ID = 0, $echo = TRUE ) {
    EE_Registry::instance()->load_helper( 'Venue_View' );
    $venue = EEH_Venue_View::get_venue( $VNU_ID );
    if ( $echo ) {
        echo '
' . $venue->city() . ', ' . $venue->state_name() . ' ' . $venue->zip() . '
';
        return '';
    }
    return EEH_Venue_View::venue_address( $type, $VNU_ID );
}
