<?php
/**
 * Content Functions
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
 * CONTENT WIDTH
 *******************************************/

/**
 * Content Width
 *
 * Detect content width based on template uses.
 *
 * Used in partials/content-full.php and includes/images.php.
 *
 * @since 1.0
 * @return int Width of content area in pixels
 */
function jubilee_content_width() {

	// 700
	$width = 700; // default

	// 1170
	if (
		is_page_template( array(
			CTFW_THEME_PAGE_TPL_DIR . '/width-large.php',
			CTFW_THEME_PAGE_TPL_DIR . '/events-calendar.php',
		) )
		|| is_attachment()
	) {
		$width = 1170;
	}

	// 980
	elseif (
		is_page_template( array(
			CTFW_THEME_PAGE_TPL_DIR . '/width-medium.php',
			CTFW_THEME_PAGE_TPL_DIR . '/gallery.php',
			CTFW_THEME_PAGE_TPL_DIR . '/galleries.php',
			CTFW_THEME_PAGE_TPL_DIR . '/blog.php',
			CTFW_THEME_PAGE_TPL_DIR . '/events-upcoming.php',
			CTFW_THEME_PAGE_TPL_DIR . '/events-past.php',
			CTFW_THEME_PAGE_TPL_DIR . '/locations.php',
			CTFW_THEME_PAGE_TPL_DIR . '/people.php',
			CTFW_THEME_PAGE_TPL_DIR . '/sermons.php',
			CTFW_THEME_PAGE_TPL_DIR . '/sermon-topics.php',
			CTFW_THEME_PAGE_TPL_DIR . '/sermon-series.php',
			CTFW_THEME_PAGE_TPL_DIR . '/sermon-books.php',
			CTFW_THEME_PAGE_TPL_DIR . '/sermon-speakers.php',
			CTFW_THEME_PAGE_TPL_DIR . '/sermon-dates.php',
			CTFW_THEME_PAGE_TPL_DIR . '/subpages.php',
		) )
		|| is_search()
		|| is_archive()
		|| ctfw_is_posts_page()
	) {
		$width = 980;
	}

	return apply_filters( 'jubilee_content_width', $width );

}

/*******************************************
 * EXCERPT
 *******************************************/

/**
 * Increase excerpt length
 *
 * We want it longer than default so have enough to fill space with custom truncation.
 * See jubilee_short_content()
 *
 * @since 1.0
 * @param array $classes Classes currently being added to body tag
 * @return array Modified classes
 */
function jubilee_excerpt_length( $length ) {
	return 80;
}

add_filter( 'excerpt_length', 'jubilee_excerpt_length', 999 );

/*******************************************
 * HOMEPAGE
 *******************************************/

/**
 * Return id="#" for homepage sections.
 *
 * @since 1.4.2
 * @return string id attribute
 */
function jubilee_homepage_section_id_attr() {

	$GLOBALS['jubilee_homepage_section_i'] = isset( $GLOBALS['jubilee_homepage_section_i'] ) ? $GLOBALS['jubilee_homepage_section_i'] + 1 : 1;

	return 'id="jubilee-home-section-' . esc_attr( $GLOBALS['jubilee_homepage_section_i'] ) . '"';

}
