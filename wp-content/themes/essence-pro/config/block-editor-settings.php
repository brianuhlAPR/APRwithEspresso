<?php
/**
 * Block Editor settings specific to Essence Pro.
 *
 * @package Essence Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

$essence_link_color            = get_theme_mod( 'essence_link_color', essence_customizer_get_default_link_color() );
$essence_link_color_contrast   = essence_color_contrast( $essence_link_color );
$essence_link_color_brightness = essence_color_brightness( $essence_link_color, 35 );

return array(
	'admin-fonts-url'              => 'https://fonts.googleapis.com/css?family=Alegreya+Sans:400,400i,700|Lora:400,700&display=swap',
	'content-width'                => 860,
	'default-button-bg'            => $essence_link_color,
	'default-button-color'         => $essence_link_color_contrast,
	'default-button-outline-hover' => $essence_link_color_brightness,
	'default-link-color'           => $essence_link_color,
	'default-accent-color'         => $essence_link_color,
	'editor-color-palette'         => array(
		array(
			'name'  => __( 'Custom color', 'essence-pro' ),
			'slug'  => 'theme-primary',
			'color' => $essence_link_color,
		),
	),
	'editor-font-sizes'            => array(
		array(
			'name' => __( 'Small', 'essence-pro' ),
			'size' => 16,
			'slug' => 'small',
		),
		array(
			'name' => __( 'Normal', 'essence-pro' ),
			'size' => 20,
			'slug' => 'normal',
		),
		array(
			'name' => __( 'Large', 'essence-pro' ),
			'size' => 24,
			'slug' => 'large',
		),
		array(
			'name' => __( 'Larger', 'essence-pro' ),
			'size' => 28,
			'slug' => 'larger',
		),
	),
);
