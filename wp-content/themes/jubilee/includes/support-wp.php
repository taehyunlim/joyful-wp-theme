<?php
/**
 * WordPress Feature Support
 *
 * @package    Jubilee
 * @subpackage Functions
 * @copyright  Copyright (c) 2019, ChurchThemes.com, LLC
 * @link       https://churchthemes.com/themes/jubilee
 * @license    GPLv2 or later
 * @since      1.0
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add theme support for WordPress features
 *
 * @since 1.0
 */
function jubilee_add_theme_support_wp() {

	global $_wp_additional_image_sizes;

	// Output HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Title Tag.
	add_theme_support( 'title-tag' );

	// RSS feeds in <head>.
	add_theme_support( 'automatic-feed-links' );

	// Featured images.
	add_theme_support( 'post-thumbnails' );

	// Custom Header.
	add_theme_support( 'custom-header', array(
		'width'                  => $_wp_additional_image_sizes['jubilee-banner']['width'], // see includes/images.php
		'height'                 => $_wp_additional_image_sizes['jubilee-banner']['height'],
		'flex-width'             => false, // false fixes aspect ratio
		'flex-height'            => false, // false fixes aspect ratio
		'header-text'            => false,
	) );

	// Gutenberg wide image option.
	add_theme_support( 'align-wide' ); // let user choose wide image option in block editor.

	// Gutenberg color palette.
	// See variables.scss for neutral colors. Default text color not necessary.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Main', 'jubilee' ),
			'slug'  => 'main',
			'color' => ctfw_customization( 'main_color' ),
		),
		array(
			'name'  => __( 'Accent', 'jubilee' ),
			'slug'  => 'accent',
			'color' => ctfw_customization( 'accent_color' ),
		),
		array(
			'name'  => __( 'Highlight', 'jubilee' ),
			'slug'  => 'highlight',
			'color' => ctfw_customization( 'highlight_color' ),
		),
		array(
			'slug'  => __( 'Dark', 'jubilee' ),
			'slug'  => 'dark',
			'color' => '#000',      // dark text color, in case wants to make text stand out.
		),
		array(
			'slug'  => __( 'Light', 'jubilee' ),
			'slug'  => 'light',
			'color' => '#777',      // light text color in case wants to de-emphasize text.
		),
		array(
			'slug'  => __( 'Light Background', 'jubilee' ),
			'slug'  => 'light-bg',
			'color' => '#f5f5f5',   // light gray background color to contrast with white background (e.g. paragraph background).
		),
		array(
			'slug'  => __( 'White', 'jubilee' ),
			'slug'  => 'white',
			'color' => '#fff',       // white text (intended for user over Main Color, such as on a button).
		)
	) );

	// Gutenberg disable custom font size.
	// User must choose one of the specific sizes (small, normal, large, huge).
	add_theme_support( 'disable-custom-font-sizes' );

	// Responsive embeds (WordPress 5.0).
	add_theme_support( 'responsive-embeds' );

}

add_action( 'after_setup_theme', 'jubilee_add_theme_support_wp' );
