<?php
/**
 * Image Functions
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

/***********************************************
 * IMAGE SIZES
 ***********************************************/

/**
 * Add image sizes
 *
 * @since 1.0
 */
function jubilee_image_sizes() {

	/*********************************
	 * THUMBNAILS
	 *********************************/

	// Default Thumbnail (post-thumbnail)
	// Also used in place of jubilee-rect-medium (see support-framework.php)
	set_post_thumbnail_size( 450, 300, true ); // crop for exact size

	/*********************************
	 * HEADER IMAGES
	 *********************************/

	// Banner Image
	// Featured image to appear at the top of pages
	// This size is excluded from upscaling in support-framework.php so not every image uploaded is upscaled to this size
	// This is height of header when viewport 1600 and shape square.
	add_image_size( 'jubilee-banner', 1600, 480, true ); // crop for exact size

	/*********************************
	 * SQUARE IMAGES
	 *********************************/

	// Square Image
	// Used for CT Highlight widget which is displayed at max width of 375px (mobile), so @2x for HiDPI
	add_image_size( 'jubilee-square', 750, 750, true ); // crop for exact size

	// Square Image Large
	// Used for homepage section side images
	// On 1980 display it's width is roughly 720 so this is about 2x for HiDPI.
	// Not so large that file size should be unreasonable; happy middle-ground for most displays.
	add_image_size( 'jubilee-square-large', 1400, 1400, true ); // crop for exact size

	// Square Image
	// Used for single Person in header, which shows at 80px. Double for HiDPI.
	add_image_size( 'jubilee-square-small', 160, 160, true ); // crop for exact size

	/*********************************
	 * RECTANGULAR IMAGES
	 *********************************/

	// Large Thumbnail (gallery 1 - 2 columns, gallery widget large)
	add_image_size( 'jubilee-rect-large', 720, 480, true ); // crop for exact size

	// Medium Thumbnail (Gallery 3 - 5 Columns, Gallery Widget Medium)
	// Uses post-thumbnail (see support-framework.php)

	// Small Thumbnail (Gallery 6 - 9 Columns, Gallery Widget Small)
	// Widget featured image is 100 wide so this is @2x
	add_image_size( 'jubilee-rect-small', 200, 133, true ); // crop for exact size

}

add_action( 'after_setup_theme', 'jubilee_image_sizes', 9 ); // before jubilee_add_theme_support_framework() so it can use ctfw_image_size_dimensions()

/**
 * Set content width
 *
 * This affect maximum embed and image sizes.
 * On front end CSS handles most of this but content editor also uses.
 *
 * Keep an eye on this for possible future add_theme_support() implementation:
 * http://core.trac.wordpress.org/ticket/21256
 *
 * @since 1.0
 * @global int $content_width
 */
function jubilee_set_content_width() {

	global $content_width;

	if ( ! isset( $content_width ) ) {

		// Width depends on page template, archive, singular, etc.
		$content_width = jubilee_content_width();

		// No sidebar in Jubilee

	}

}

add_action( 'wp', 'jubilee_set_content_width' );

/**
 * Logo image size
 *
 * This data is used in Customizer to make a recommendation to the user
 * and is used in header-logo.php for outputting logo markup.
 *
 * These values are duplicated in _variables.scss (update both files if change).
 *
 * @since 1.0
 * @param string $key If key provided, that value is returned; otherwise whole array
 * @return string|array Value for one key or whole array if none
 */
function jubilee_logo_size( $key = false ) {

	$logo_size_data = array();

	$logo_size_data['max_width'] = 250; // update in _variables.css too
	$logo_size_data['max_height'] = 60; // update in _variables.css too
	$logo_size_data['max_dimensions'] = $logo_size_data['max_width'] . 'x' . $logo_size_data['max_height'];

	$logo_size_data = apply_filters( 'jubilee_logo_size_data', $logo_size_data, $key );

	if ( $key && isset( $logo_size_data[$key] ) ) {
		$value = $logo_size_data[$key];
	} else {
		$value = $logo_size_data;
	}

	$value = apply_filters( 'jubilee_logo_size', $value, $logo_size_data, $key );

	return $value;

}

