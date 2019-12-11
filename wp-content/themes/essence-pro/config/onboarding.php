<?php
/**
 * Essence Pro.
 *
 * Onboarding config to load plugins and homepage content on theme activation.
 *
 * @package Essence Pro
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/essence/
 */

$essence_onboarding_config = array(
	'dependencies'     => array(
		'plugins' => array(
			array(
				'name'       => __( 'Atomic Blocks', 'essence-pro' ),
				'slug'       => 'atomic-blocks/atomicblocks.php',
				'public_url' => 'https://atomicblocks.com/',
			),
			array(
				'name'       => __( 'WPForms Lite (Third Party)', 'essence-pro' ),
				'slug'       => 'wpforms-lite/wpforms.php',
				'public_url' => 'https://wordpress.org/plugins/wpforms-lite/',
			),
		),
	),
	'content'          => array(
		'homepage' => array(
			'post_title'     => 'Live The Life You Deserve',
			'post_content'   => require dirname( __FILE__ ) . '/import/content/homepage.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'page_template'  => 'page-templates/blocks.php',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		),
		'blocks'   => array(
			'post_title'     => 'Block Content Examples',
			'post_content'   => require dirname( __FILE__ ) . '/import/content/block-examples.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'meta_input'     => array( '_genesis_layout' => 'full-width-content' ),
		),
		'about'    => array(
			'post_title'     => 'About Us',
			'post_content'   => require dirname( __FILE__ ) . '/import/content/about.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'featured_image' => CHILD_URL . '/config/import/images/about.jpg',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'meta_input'     => array( '_genesis_layout' => 'full-width-content' ),
		),
		'contact'  => array(
			'post_title'     => 'Contact Us',
			'post_content'   => require dirname( __FILE__ ) . '/import/content/contact.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		),
		'landing'  => array(
			'post_title'     => 'Landing Page',
			'post_content'   => require dirname( __FILE__ ) . '/import/content/landing-page.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'page_template'  => 'page-templates/landing.php',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		),
		'pricing'  => array(
			'post_title'     => 'Pricing Page',
			'post_content'   => require dirname( __FILE__ ) . '/import/content/pricing-page.php',
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'meta_input'     => array( '_genesis_layout' => 'full-width-content' ),
		),
	),
	'navigation_menus' => array(
		'primary' => array(
			'homepage' => array(
				'title' => 'Home',
			),
			'about'    => array(
				'title' => 'About Us',
			),
			'contact'  => array(
				'title' => 'Contact Us',
			),
			'blocks'   => array(
				'title' => 'Block Examples',
			),
			'landing'  => array(
				'title' => 'Landing Page',
			),
			'pricing'  => array(
				'title' => 'Pricing Page',
			),
		),
	),
);

// Import sample posts if the site is fresh.
if ( get_option( 'fresh_site' ) ) {
	$essence_onboarding_config['content']['sample-post-1'] = array(
		'post_title'     => 'Why Space and Tranquillity Matter in Your Minimal Lifestyle',
		'post_content'   => require dirname( __FILE__ ) . '/import/content/post-example.php',
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'featured_image' => CHILD_URL . '/config/import/images/sample-post-1.jpg',
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
	);
	$essence_onboarding_config['content']['sample-post-2'] = array(
		'post_title'     => 'The Secret Method to Creating the Perfect Amount of Simple',
		'post_content'   => require dirname( __FILE__ ) . '/import/content/post-example.php',
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'featured_image' => CHILD_URL . '/config/import/images/sample-post-2.jpg',
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
	);
	$essence_onboarding_config['content']['sample-post-3'] = array(
		'post_title'     => 'Understanding the Benefits of Good Nutrition',
		'post_content'   => require dirname( __FILE__ ) . '/import/content/post-example.php',
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'featured_image' => CHILD_URL . '/config/import/images/sample-post-3.jpg',
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
	);
	$essence_onboarding_config['content']['sample-post-4'] = array(
		'post_title'     => 'Unplug and Connect with Your Soul',
		'post_content'   => require dirname( __FILE__ ) . '/import/content/post-example.php',
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'featured_image' => CHILD_URL . '/config/import/images/sample-post-4.jpg',
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
	);
	$essence_onboarding_config['content']['sample-post-5'] = array(
		'post_title'     => 'Increase Your Productivity as a Working Parent',
		'post_content'   => require dirname( __FILE__ ) . '/import/content/post-example.php',
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'featured_image' => CHILD_URL . '/config/import/images/sample-post-5.jpg',
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
	);
}

return $essence_onboarding_config;
