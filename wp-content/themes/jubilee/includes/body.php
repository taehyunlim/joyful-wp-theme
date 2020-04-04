<?php
/**
 * <body> Functions
 *
 * @package    Jubilee
 * @subpackage Functions
 * @copyright  Copyright (c) 2019, ChurchThemes.com, LLC
 * @link       https://churchthemes.com/themes/jubilee
 * @license    GPLv2 or later
 * @since      1.0
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/*******************************************
 * BODY CLASSES
 *******************************************/

/**
 * Add helper classes to <body>
 *
 * IMPORTANT: Do not do client detection (mobile, browser, etc.) here.
 * Instead, do in theme's JS so works with caching plugins.
 *
 * Note: Other body classes are added via main.js since their presence
 * is easier to detect in that manner.
 *
 * Note: This can also be used by framework's 'ctfw-editor-styles' feature
 * to add body classes to editor.
 *
 * @since 1.0
 * @param array $classes Classes currently being added to body tag (when used with body_class filter)
 * @return array Modified classes
 */
function jubilee_body_classes( $classes = array() ) {

	// Fonts
	$fonts_areas = array( 'logo_font', 'heading_font', 'nav_font', 'body_font' );
	foreach ( $fonts_areas as $font_area ) {

		$font_name = ctfw_customization( $font_area );
		$font_name = sanitize_title( $font_name );

		$font_area = str_replace( '_', '-', $font_area );

		$classes[] = 'jubilee-' . $font_area . '-' . $font_name;

	}

	// Logo
	if ( 'image' == ctfw_customization( 'logo_type' ) && ctfw_customization( 'logo_image' ) ) {
		$classes[] = 'jubilee-has-logo-image';
	} else {
		$classes[] = 'jubilee-no-logo-image';
	}

	// Uppercase logo, headings, etc.
	if ( ctfw_customization( 'uppercase' ) ) {
		$classes[] = 'jubilee-has-uppercase';
	} else {
		$classes[] = 'jubilee-no-uppercase';
	}

	// Shapes
	if ( ctfw_customization( 'shapes' ) ) {
		$classes[] = 'jubilee-shapes-' . ctfw_customization( 'shapes' );
	}

	// Animations
	if ( ctfw_customization( 'scroll_animations' ) ) {
		$classes[] = 'jubilee-has-scroll-animations';
	} else {
		$classes[] = 'jubilee-no-scroll-animations';
	}

	// Single post shows map (event or location).

		// Get data if event or location.
		if ( is_singular( 'ctc_event' ) ) {
			$data = ctfw_event_data();
		} else if ( is_singular( 'ctc_location' ) ) {
			$data = ctfw_location_data();
		}

		// Map shows if have coordinates and address.
		if ( isset( $data ) && $data['map_lat'] && $data['map_lng'] && $data['address'] ) {
			$classes[] = 'jubilee-single-has-map';
		} else {
			$classes[] = 'jubilee-single-no-map';
		}

	// WordPress 4.8 or earlier (used for MediaElement.js back-compat styling)
	if ( version_compare( $GLOBALS['wp_version'], '4.8', '<=' ) ) {
		$classes[] = 'jubilee-wp-4-8-or-less';
	}

	// Sanitize - some dynamic
	// To Do: Make this a framework function working with arrays and strings - apply everywhere
	foreach ( $classes as $k => $class ) {
		$classes[$k] = sanitize_html_class( $class );
	}

	// Content width
	$classes[] = 'jubilee-content-width-' . jubilee_content_width(); // 700, 980, 1170

	return $classes;

}

add_filter( 'body_class', 'jubilee_body_classes' );
