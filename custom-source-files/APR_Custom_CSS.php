<?php
/*
Plugin Name: APR - Custom CSS
Description: Add some common classes to the site page editor
Version: 1.0.0
Author: Brian Uhl
*/
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

/* Callback function to filter the MCE settings */
function my_mce_before_init_insert_formats( $init_array ) {
// Define the style_formats array
    $style_formats = array(
        /*
        * Each array child is a format with it's own settings
        * Notice that each array has title, block, classes, and wrapper arguments
        * Title is the label which will be visible in Formats menu
        * Block defines whether it is a span, div, selector, or inline style
        * Classes allows you to define CSS classes
        * Wrapper whether or not to add a new block-level element around any selected elements
        */
        array(
            'title' => 'Highlight Box Right',
            'block' => 'div',
            'classes' => 'highlight-box-right',
            'wrapper' => true,
        ),
        array(
            'title' => 'Highlight Box Left',
            'block' => 'div',
            'classes' => 'highlight-box-left',
            'wrapper' => true,
        ),
        array(
            'title' => 'Highlight Box Full',
            'block' => 'div',
            'classes' => 'highlight-box-full',
            'wrapper' => true,
        ),
        array(
            'title' => 'Case Study',
            'block' => 'div',
            'classes' => 'casestudy',
            'wrapper' => true,
        ),
        array(
            'title' => 'Call to Action',
            'block' => 'div',
            'classes' => 'call-to-action',
            'wrapper' => true,
        ),
        array(
            'title' => 'Footnote',
            'block' => 'div',
            'classes' => 'footnote',
            'wrapper' => true,
        ),
        array(
            'title' => 'Image Credit',
            'block' => 'div',
            'classes' => 'image-credit',
            'wrapper' => true,
        )
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

wp_enqueue_style( 'APR_Custom_CSS', get_stylesheet_directory_uri() . '/APR_Custom_CSS.css');

function my_theme_add_editor_styles() {
    add_editor_style( 'APR_Editor_Custom_CSS.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );
