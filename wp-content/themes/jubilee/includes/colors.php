<?php
/**
 * Color Functions
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
 * BACKGROUND COLORS
 *******************************************/

/**
 * Alternate background color class
 *
 * This is used on background of sections on homepage, in footer, etc.
 * It automatically returns appropriate white or gray class or optional contrasting version when requested.
 *
 * @since 1.0
 * @global array $jubilee_previous_alternating_bg Details on last class returned
 * @param bool $contrast Use constrasting version of color to further differentiate (such as when showing white boxed entries)
 * @param string $start_secondary Optionally start at secondary
 * @return string Class name
 */
function jubilee_alternating_bg_class( $contrast = false, $start_secondary = false ) {

	global $jubilee_alternating_bg_data; // to retrieve prior widget's image position

	// Get mode
	if ( ! isset( $jubilee_alternating_bg_data['mode'] ) ) {
		$mode = 'primary'; // first run
	} else {

		$mode = $jubilee_alternating_bg_data['mode'];

		// Alternate mode from primary to secondary or secondary to primary, based on last use
		$mode = 'primary' == $mode ? 'secondary' : 'primary';

	}

	// Start at secondary?
	if ( $start_secondary ) {
		$mode = 'secondary';
	}

	// Use contrast only for primary (because it is white)
	if ( $contrast && 'secondary' == $mode ) {
		$contrast = false;
	}

	// Base class
	$class = 'jubilee-bg';

	// Is it secondary?
	if ( 'secondary' == $mode ) {
		$class .= '-secondary';
	}

	// Is it contrasting?
	if ( $contrast ) {
		$class .= '-contrast';
	}

	// Store current data in global for next use
	$jubilee_alternating_bg_data = array(
		'mode'		=> $mode,
		'contrast'	=> $contrast,
	);

	// Return filtered
	return apply_filters( 'jubilee_widget_image_side_class', $class );

}

/*******************************************
 * COLORIZED IMAGES
 *******************************************/

/**
 * Alternate overlay color class
 *
 * Used by CT Section widgets to alternate main and accent color overlay.
 *
 * @since 1.0
 * @global array $jubilee_previous_alternating_bg Details on last class returned
 * @param string $start_accent Optionally start at accent color
 * @return string Class name
 */
function jubilee_alternating_overlay_class( $start_accent = false ) {

	global $jubilee_alternating_overlay_data; // to retrieve prior widget's image position

	// Get mode
	if ( ! isset( $jubilee_alternating_overlay_data['mode'] ) ) {
		$mode = 'main'; // first run
	} else {

		$mode = $jubilee_alternating_overlay_data['mode'];

		// Alternate mode from main to accent or accent to main, based on last use
		$mode = 'main' === $mode ? 'accent' : 'main';

	}

	// Start at accent?
	if ( $start_accent ) {
		$mode = 'accent';
	}

	// Class.
	if ( 'main' === $mode ) {
		$class = 'jubilee-color-main-bg';
	} else {
		$class = 'jubilee-color-accent-bg';
	}

	// Store current data in global for next use
	$jubilee_alternating_overlay_data = array(
		'mode' => $mode,
	);

	// Return filtered
	return apply_filters( 'jubilee_alternating_overlay_class', $class );

}

/**
 * Opposite overlay color class
 *
 * Used by CT Section widgets to show underlay contrasting shape.
 *
 * @since 1.0
 * @global array $jubilee_previous_alternating_bg Details on last class returned
 * @return string Class name
 */
function jubilee_opposite_overlay_class() {

	global $jubilee_alternating_overlay_data; // to retrieve current widget's image position

	// Get mode
	if ( ! isset( $jubilee_alternating_overlay_data['mode'] ) ) {
		$mode = 'main'; // first run
	} else {

		$mode = $jubilee_alternating_overlay_data['mode'];

		// Alternate mode from main to accent or accent to main, based on last use
		$mode = 'main' === $mode ? 'accent' : 'main';

	}

	// Class.
	if ( 'main' === $mode ) {
		$class = 'jubilee-color-main-bg';
	} else {
		$class = 'jubilee-color-accent-bg';
	}

	// Return filtered
	return apply_filters( 'jubilee_opposite_overlay_class', $class );

}

/**
 * Get colorization data
 *
 * Return array with colorization, opacity, opacity decimal and contrast percent.
 * This is for use by CT Section widgets and page headers.
 *
 * @since 1.0
 * @param int $colorization Value to use. If not provided, Customizer setting used.
 * @return array
 */
function jubilee_colorization_data( $colorization = false ) {

	$data = array();

	// Use Customizer setting if value not given.
	if ( ! $colorization ) {
		$colorization = ctfw_customization( 'colorization' );
	}

	// Convert to int.
	$data['colorization'] = (int) $colorization;

	// Opacity.
	$data['opacity']         = 100 - $data['colorization'];
	$data['opacity_decimal'] = $data['opacity'] / 100;

	// Contrast proportional to opacity.
	// This is because reduing opacity of image dulls the image.
	$data['contrast_percent'] = 200 - $data['opacity'] + ( ( 100 - $data['opacity'] ) * 0.4 );

	// Brightness.
	$data['brightness_percent'] = round( ( ( $data['contrast_percent'] * 0.8 ) + 120 ) / 2 );
	$data['brightness_percent'] = $data['brightness_percent'] > 100 ? $data['brightness_percent'] : 100;

	// Saturate.
	$data['saturate_percent'] = $data['brightness_percent'];

	// Return filtered
	return apply_filters( 'jubilee_colorization_data', $data );

}

/**
 * Colorization style.
 *
 * Styles to reduce opacity of image that appears over colored background.
 *
 * @since 1.0
 * @param string $image_url Image URL for background image.
 * @param int $colorization Use given value; otherwise global value from Customizer.
 * @return string
 */
function jubilee_colorization_style( $image_url, $colorization = false ) {

	// Colorization data.
	$colorization_data = jubilee_colorization_data( $colorization );

	// Styles.
	$style = 'background-image: url(' . esc_url( $image_url ) . '); opacity: ' . esc_attr( $colorization_data['opacity_decimal'] ) . '; filter: contrast(' . esc_attr( $colorization_data['contrast_percent'] ) . '%) saturate(' . esc_attr( $colorization_data['saturate_percent'] ) . '%) brightness(' . esc_attr( $colorization_data['brightness_percent'] ) . '%)';

	// Escape for output.
	$style = esc_attr( $style );

	// Return filtered.
	return apply_filters( 'jubilee_colorization_style', $style );

}
