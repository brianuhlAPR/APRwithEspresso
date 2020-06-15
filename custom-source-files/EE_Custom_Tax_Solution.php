<?php
/*
Plugin Name: Agile EE Custom Tax Solution
Description: Attempting to apply correct tax for event location but not on promo code amount
Version: 1.0
Author: Brian Uhl
*/

/**
 * bc_ee_apply_transaction_surcharge
 *
 * @param \EE_Checkout $checkout
 * @return \EE_Checkout
 */
function bc_ee_apply_transaction_surcharge( EE_Checkout $checkout ) {
    if ( $checkout instanceof EE_Checkout ) {
        $transaction = $checkout->transaction;
        if ( $transaction instanceof EE_Transaction ) {
            $registrations = $transaction->registrations();
            $registration = reset( $registrations );
            if ( $registration instanceof EE_Registration ) {
                $event = $registration->event();
                $event_location = "";
                if ( $event instanceof EE_Event ) {
                    $venue = $event->get_first_related('Venue');
                    if($venue instanceof EE_Venue) {
                        $event_location = $venue->state();
                    }
                    switch ( $event_location ) {
                        case 'ON' :
                            // apply the surcharge
                            add_filter( 'FHEE__bc_ee_apply_transaction_surcharge__apply_surcharge', '__return_true' );
                            // hook into function below to set surcharge details
                            add_filter( 'FHEE__bc_ee_apply_transaction_surcharge__surcharge_details', 'ee_ontario_surcharge_details' );
                            break;
                        case 'AB' :
                            // apply the surcharge
                            add_filter( 'FHEE__bc_ee_apply_transaction_surcharge__apply_surcharge', '__return_true' );
                            // hook into function below to set surcharge details
                            add_filter( 'FHEE__bc_ee_apply_transaction_surcharge__surcharge_details', 'ee_alberta_surcharge_details' );
                            break;
                    }
                }
            }
        }
    }

    // create default instance only if the above didn't set the surcharge details
    $surcharge_details = apply_filters(
        'FHEE__bc_ee_apply_transaction_surcharge__surcharge_details',
        array(
            'name'        => 'Ontario HST',                 //  name for surcharge that will be displayed
            'code'        => 'ontario-hst',                 // unique code used to identify surcharge in the db
            'description' => 'Ontario HST 13%',             // description for line item
            'percent'     => 13,                            // percentage amount
            'taxable'     => false,                         // whether or not tax is applied on top of the surcharge
        )
    );

    // apply the surcharge ?
    if ( ! apply_filters( 'FHEE__bc_ee_apply_transaction_surcharge__apply_surcharge', false )) {
        return $checkout;
    }
    // verify checkout
    if ( ! $checkout instanceof EE_Checkout ) {
        return $checkout;
    }
    // verify cart
    $cart = $checkout->cart;
    if ( ! $cart instanceof EE_Cart ) {
        return $checkout;
    }
    // verify grand total line item
    $grand_total = $cart->get_grand_total();
    if ( ! $grand_total instanceof EE_Line_Item ) {
        return $checkout;
    }
    // has surcharge already been applied ?
    $existing_surcharge = $grand_total->get_child_line_item( $surcharge_details[ 'code' ] );
    if ( $existing_surcharge instanceof EE_Line_Item ) {
        return $checkout;
    }
    EE_Registry::instance()->load_helper( 'Line_Item' );
    $pre_tax_subtotal = EEH_Line_Item::get_pre_tax_subtotal( $grand_total );
    $pre_tax_subtotal->add_child_line_item(
        EE_Line_Item::new_instance( array(
            'LIN_name'       => $surcharge_details[ 'name' ],
            'LIN_desc'       => $surcharge_details[ 'description' ],
            'LIN_unit_price' => 0,
            'LIN_percent'    => $surcharge_details[ 'percent' ],
            'LIN_quantity'   => NULL,
            'LIN_is_taxable' => $surcharge_details[ 'taxable' ],
            'LIN_order'      => 0,
            'LIN_total'      => (float) ( $percentage_amount * ( $pre_tax_subtotal->total() / 100 ) ),
            'LIN_type'       => EEM_Line_Item::type_line_item,
            'LIN_code'       => $surcharge_details[ 'code' ],
        ) )
    );
    $grand_total->recalculate_total_including_taxes();
    return $checkout;
}
add_filter( 'FHEE__EED_Single_Page_Checkout___initialize_checkout__checkout', 'bc_ee_apply_transaction_surcharge' );

/**
 * @return array
 */
function ee_ontario_surcharge_details() {
    return array(
        'name'          => 'Ontario HST',
        'code'          => 'ontario-hst',
        'description'   => 'Ontario HST 13%',
        'percent'       => 13,
        'taxable'       => false,
    );
}
/**
 * @return array
 */
function ee_alberta_surcharge_details() {
    return array(
        'name'          => 'Alberta GST',
        'code'          => 'alberta-gst',
        'description'   => 'Alberta GST 5%',
        'percent'       => 5,
        'taxable'       => false,
    );
}
