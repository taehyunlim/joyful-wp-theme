<?php
/**
 * Navigation
 *
 * Functions to help with navigation.
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

/**********************************
 * CUSTOM MENUS
 **********************************/

/**
 * Register header and footer menu locations
 *
 * @since 1.0
 */
function jubilee_register_menus() {

	// Register header menu location (main menu with dropdowns)
	register_nav_menu( 'header', _x( 'Header', 'menu location', 'jubilee' ) );

	// Register footer menu location
	register_nav_menu( 'footer', _x( 'Footer', 'menu location', 'jubilee' ) );

}

add_action( 'init', 'jubilee_register_menus' );

/********************************
 * BREADCRUMBS
 ********************************/

/**
 * Output breadcrumb path
 *
 * @since 1.0
 */
function jubilee_breadcrumbs() {

	// Build them with framework
	$breadcrumbs = new CTFW_Breadcrumbs( array(
		'classes'	=> '', // center the breadcrumbs like content
		/* translators: separator between breadcrumb path links */
		'separator'	=> ' <span class="jubilee-breadcrumb-separator ' . jubilee_get_icon_class( 'breadcrumb-separator' ) . '"></span> ',
		'shorten'	=> 22, // default is 30 (make some more room for archive dropdowns on right)
	) );

	// Don't show if only Home > Page. Show only for larger paths.
	if ( substr_count( $breadcrumbs, 'jubilee-breadcrumb-separator' ) <= 1 ) {
		$breadcrumbs = '';
	}

	// Return filtered
	return apply_filters( 'jubilee_breadcrumbs', $breadcrumbs );

}

/********************************
 * PREVIOUS / NEXT
 ********************************/

/**
 * Single post navigation data
 *
 * Prepare various data for rendering a Previous or Next nav block.
 *
 * @since 1.0
 * @param string $direction previous or next
 * @param object $post Post object
 * @return array Array with 'url', 'label' and 'image_style' style attribute value
 */
function jubilee_single_post_nav_data( $direction, $post ) {

	$data = array();

	// Defaults
	$data['url'] = '';
	$data['image_style'] = '';
	$data['image_brightness_style'] = '';
	$data['label'] = '';

	// Have post ID
	if ( ! empty( $post->ID ) ) {

		// URL
		$data['url'] = get_permalink( $post );

		// Image ID
		$post_image_id = get_post_thumbnail_id( $post->ID );

		// Image / URL
		if ( $post_image_id && 'ctc_person' != get_post_type() ) { // Hide image on people (eyes not centered, heads are cropped)

			$image = wp_get_attachment_image_src( $post_image_id, 'post-thumbnail' );
			$image_url = ! empty( $image[0] ) ? $image[0] : '';

			if ( $image_url ) {

				$colorization             = get_post_meta( $post->ID, '_ctcom_banner_colorization', true );
				$image_brightness         = get_post_meta( $post->ID, '_ctcom_banner_image_brightness', true );
				$image_brightness_decimal = 1 - ( ! empty( $image_brightness ) ? $image_brightness : ctfw_customization( 'header_image_brightness' ) ) / 100; // reverse since overlay
				$image_brightness_decimal = $image_brightness_decimal * 1.5; // make 50% darker because header banner has gradients to make text more legible, plus text is thicker

				$data['image_style']            = jubilee_colorization_style( $image_url, $colorization );
				$data['image_brightness_style'] = "opacity: $image_brightness_decimal;";

			}

		}

		// Label
		// Previous or Next, or Person's position, or nothing for Location
		$data['label'] = jubilee_single_post_nav_label( $direction, $post );

	}

	// Return filtered
	return apply_filters( 'jubilee_single_post_nav_data', $data, $direction, $post );

}

/**
 * Single post navigation label
 *
 * Label to show in single post nav block above the post title.
 *
 * Show Previous or Next for all post types but Location and Person.
 * Show person's Position instead of Previous or Next
 * Show nothing for Location
 *
 * Users have different idea of what Previous and Next mean on non-dated posts,
 * so it's better not to use that terminology.
 *
 * @since 1.0
 * @param string $direction previous or next
 * @param object $post Post object
 * @return string Label to show on nav control
 */
function jubilee_single_post_nav_label( $direction, $post ) {

	$label = '';

	// Not a Location (no label)
	if ( 'ctc_location' != $post->post_type ) {

		// Person, use Position
		if ( 'ctc_person' == $post->post_type ) {

			$position = get_post_meta( $post->ID, '_ctc_person_position', true );
			$position = trim( $position );

			if ( $position ) {
				$label = $position;
			}

		}

		// Use Previous/Next
		if ( ! $label ) {

			if ( 'previous' == $direction ) {
				$label = _x( 'Previous', 'single post nav', 'jubilee' );
			} else {
				$label = _x( 'Next', 'single post nav', 'jubilee' );
			}

		}

	}

	return apply_filters( 'jubilee_single_post_nav_label', $label, $direction, $post );

}
