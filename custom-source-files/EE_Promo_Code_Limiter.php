<?php
/*
Plugin Name: Agile EE Promo Code Limiter
Description: Ensures that promo codes can only be used on 'Regular' tickets
Version: 1.0
Author: Brian Uhl
*/

function update_promo_code_ticket_array( ) {
    $datetime_model = EE_Registry::instance()->load_model('Datetime');
    $where = array(
        'TKT_name' => 'Regular',
        'Datetime.DTT_EVT_end' => array( '>=', $datetime_model->current_time_for_query( 'DTT_EVT_end' ) )
    );
    $tickets = EEM_Ticket::instance()->get_all( array( $where ) );

    $promotions = EEM_Promotion::instance()->get_all();

    // create array of all ticket ids for tickets named 'Regular'
    $ticket_array = array();
    foreach ($tickets as $ticket) {
        $ticket_array[] = $ticket->ID();
    }

    // create promotion id indexed array of all active promotions and assign the ticket array to each
    $promotion_tickets = array();
    foreach ($promotions as $promotion) {
        $promotion_tickets[$promotion->ID()] = $ticket_array;
    }

    // store the multi-dimensional array of valid promotion/ticket combinations as a transient
    return $promotion_tickets;
}

// this is an array where keys are promotion IDs
// and values are arrays of ticket IDs that are applicable to that promotion
// in the following format: array( promo_ID => array( ticket_ID, ticket_ID ) );
// ex: array( 2 => array( 30, 35 ) );
// STOP!!! do not edit anything else beyond this
add_filter('FHEE__EED_Promotions__get_applicable_items__applicable_items',
    function ($applicable_items, $promotion) {
        if ( false === ( $applicable_promotion_tickets = get_transient( 'ticket-promotion-array' ) ) ) {
            // It wasn't there, so regenerate the data and save the transient
            $applicable_promotion_tickets = update_promo_code_ticket_array();
            set_transient( 'ticket-promotion-array', $applicable_promotion_tickets, 3600 );
        }
        $promotion_IDs = array_keys($applicable_promotion_tickets);
        if (! $promotion instanceof EE_Promotion || ! in_array($promotion->ID(), $promotion_IDs, true) ) {
            return $applicable_items;
        }

        foreach ($applicable_items as $key => $applicable_item) {
            if ($applicable_item instanceof EE_Line_Item && $applicable_item->OBJ_type() === 'Event') {
                $ticket_line_items = EEH_Line_Item::get_ticket_line_items($applicable_item);
                $valid_items = [];
                $invalid_items = [];
                if (is_array($ticket_line_items)) {
                    foreach ($ticket_line_items as $ticket_line_item) {
                        if (! $ticket_line_item instanceof EE_Line_Item) {
                            continue;
                        }
                        foreach ($applicable_promotion_tickets as $promotion_ID => $promotion_tickets) {
                            if ($promotion_ID !== $promotion->ID()) {
                                continue;
                            }
                            if (in_array($ticket_line_item->OBJ_ID(), $promotion_tickets, true)) {
                                // overwrite applicable event line item with ticket line item
                                $applicable_items[ $key ] = $ticket_line_item;
                                // and track the key so it's not removed on subsequent iterations
                                $valid_items[] = $key;
                                add_filter('FHEE__EED_Promotions__add_promotion_line_item__bypass_increment_promotion_scope_uses',
                                    function ($bypass_increment_promotion_scope_uses, $parent_line_item, $bypass_promotion) use ($ticket_line_item, $promotion) {
                                        if ($parent_line_item === $ticket_line_item && $bypass_promotion === $promotion) { $bypass_increment_promotion_scope_uses = true; }
                                        return $bypass_increment_promotion_scope_uses;
                                    }, 10, 4 );
                                add_filter('FHEE__EE_Promotion_Scope__generate_promotion_line_item',
                                    function ($new_line_item_props) use ($promotion_IDs) {
                                        if ($new_line_item_props['OBJ_type'] === 'Promotion' && in_array($new_line_item_props['OBJ_ID'], $promotion_IDs, true)) {
                                            $new_line_item_props['LIN_type'] = EEM_Line_Item::type_sub_line_item;
                                        }
                                        return $new_line_item_props;
                                    });
                            } else {
                                // this ticket is not valid, but don't remove the applicable item just yet
                                $invalid_items[] = $key;
                            }
                        }
                    }
                }
                // remove valid items from list of invalid ones
                $invalid_items = array_diff($invalid_items, $valid_items);
                // then remove invalid items from list of applicable items
                foreach ($invalid_items as $invalid_item) {
                    unset($applicable_items[ $invalid_item ]);
                }
            }
        }
        return $applicable_items;
    }, 10, 3
);