<?php
/*
Plugin Name: Event Espresso - Display Price Without Tax
Description: Suppresses Event Espresso default of showing ticket prices with all taxes included
Version: 1.0
Author: Brian Uhl
*/

// display the base price of the ticket in the ticket selector (instead of the modified price)

add_filter('FHEE__ticket_selector_chart_template__ticket_price', 'change_ee_ticket_selector_base_price_display', 10, 2);
function change_ee_ticket_selector_base_price_display( $ticket_price, $ticket)
{
    return $ticket->base_price()->amount();
}

add_filter( 'FHEE__EE_Default_Line_Item_Display_Strategy___item_row__unit_price', 'my_change_ticket_row_price', 10, 3);
function my_change_ticket_row_price($unit_price, $line_item, $tax_rate)
{
    $unit_price = EEH_Template::format_currency($line_item->ticket()->base_price()->amount(),false,false);
    return $unit_price . ' + tax';
}

add_filter( 'FHEE__EE_Default_Line_Item_Display_Strategy___item_row__total', 'my_change_ticket_row_total', 10, 3);
function my_change_ticket_row_total($row_total, $line_item, $tax_rate)
{
    $unit_price = EEH_Template::format_currency($line_item->ticket()->base_price()->amount(),false,false);
    $row_total = EEH_Template::format_currency($line_item->unit_price() * $line_item->quantity(), false, false);
    return $row_total . ' + tax';
}
