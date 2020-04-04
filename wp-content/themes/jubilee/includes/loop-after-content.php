<?php
/**
 * "Loop After Content" Functions
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

/*********************************
 * LOOP AFTER CONTENT
 *********************************/

/**
 * Get "loop after content" query
 *
 * @since 1.0
 * @return object WP_Query object
 */
function jubilee_loop_after_content_query() {

	$query = apply_filters( 'jubilee_loop_after_content_query', false );

	// Post type must be supported.
	if ( isset( $query->query['post_type'] ) && ! post_type_exists( $query->query['post_type'] ) ) {
		$query = false;
	}

 	return $query;

}

/**
 * Check if "loop after content" is being used
 *
 * @since 1.0
 * @return bool Whether or not "loop after content" is used
 */
function jubilee_loop_after_content_used() {

 	$used = false;

 	if ( jubilee_loop_after_content_query() ) {
 		$used = true;
 	}

 	return apply_filters( 'jubilee_loop_after_content_used', $used );

}

/**
 * Output the loop by loading template
 *
 * @since 1.0
 * @global object $wp_query
 */
function jubilee_loop_after_content_output() {

	global $wp_query;

	// Loop posts based on query from filter
	$query = jubilee_loop_after_content_query();
	if ( $query ) {

		// Preserve original query for after loop
		$original_query = $wp_query;
		$wp_query = $query;

		// Loop posts with loop.php
		echo '<div id="jubilee-loop-after-content" class="jubilee-loop-after-content">';
		get_template_part( 'loop' );
		echo '</div>';

		// Restore original query
		$wp_query = $original_query;
		wp_reset_postdata(); // restore $post global in main query

	}

}

/**
 * Make loop content show after content
 *
 * @since 1.0
 */
function jubilee_loop_after_content() {

	// Front-end only
	if ( ! is_admin() ) {

		// Make content available via action placed after content (see content.php)
		add_action( 'jubilee_after_content', 'jubilee_loop_after_content_output' );

	}

}

add_action( 'init', 'jubilee_loop_after_content' );
