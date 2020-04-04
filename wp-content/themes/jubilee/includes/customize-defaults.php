<?php
/**
 * Theme Customizer Defaults
 *
 * Define defaults for Customizer and make available to framework for use with framework functions.
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

/**
 * Default Values
 *
 * Make defaults available to framework for use anywhere with ctfw_customize_defaults().
 *
 * Assists in setting defaults when adding settings and with getting defaults for output.
 * These apply only to options array, not theme_mod or anything else.
 *
 * @since 1.0
 * @return array Default values
 */
function jubilee_customize_defaults() {

	// Default values
	$defaults = array(

		/**
		 * Colors
		 */

		'main_color' => array(
			'value'		=> '#3d80f1',
			'no_empty'	=> true
		),

		'accent_color' => array(
			'value'		=> '#ca3892',
			'no_empty'	=> true
		),

		'highlight_color' => array(
			'value'     => '#fee6af',
			'no_empty'  => true,
		),

		'colorization' => array(
			'value'		=> '15', // percent
			'no_empty'	=> true
		),

		/**
		 * Fonts (Google Fonts)
		 */

		'logo_font' => array(
			'value'		=> 'Rubik',
			'no_empty'	=> true
		),

		'nav_font' => array(
			'value'		=> 'Roboto',
			'no_empty'	=> true
		),

		'heading_font' => array(
			'value'		=> 'Rubik',
			'no_empty'	=> true
		),

		'body_font' => array(
			'value'		=> 'Roboto',
			'no_empty'	=> true
		),

		'font_subsets' => array(
			'value'		=> '',
			'no_empty'	=> false
		),

		/**
		 * Styling
		 */

		'uppercase' => array(
			'value'		=> false,
			'no_empty'	=> false
		),

		'shapes' => array(
			'value'		=> 'organic',
			'no_empty'	=> true
		),

		/**
		 * Logo
		 */

		'logo_type' => array(
			'value'		=> 'text',
			'no_empty'	=> true
		),

		'logo_image' => array(
			'value'		=> '',
			'no_empty'	=> false
		),

		'logo_hidpi' => array(
			'value'		=> '',
			'no_empty'	=> false
		),

		'logo_text' => array(
			/* translators: Default value for Logo Text */
			'value'		=> __( 'Church Name', 'jubilee' ),
			'no_empty'	=> true
		),

		'logo_text_size' => array(
			'value'		=> 'medium',
			'no_empty'	=> true
		),

		/**
		 * Header Image
		 */

		'header_image_brightness' => array(
			'value'		=> '65', // percent (same as ctfw-widget-section in support-framework.php).
			'no_empty'	=> true
		),

		/**
		 * Footer Content
		 */

		'show_footer_location' => array(
			'value'		=> true,
			'no_empty'	=> false
		),

		'footer_notice' => array(
			/* translators: This is a default option value for footer copyright/notice */
			'value'		=> sprintf(
								__( '&copy; [ctcom_current_year] [ctcom_site_name]. Powered by <a href="%s" target="_blank" rel="nofollow">ChurchThemes.com</a>', 'jubilee' ),
								'https://churchthemes.com'
							),
			'no_empty'	=> false
		),

		'bottom_sticky' => array(
			'value'		=> 'events',
			'no_empty'	=> true
		),

		'bottom_sticky_items_limit' => array(
			'value'		=> '2',
			'no_empty'	=> true
		),

		'bottom_sticky_content' => array(
			'value'		=> '',
			'no_empty'	=> false
		),

		/**
		 * Icons
		 */

		'icon_urls' => array(
			/* translators: This is a default option value for footer icons */
			'value'		=> __( "https://facebook.com\nhttps://twitter.com\nhttps://instagram.com", 'jubilee' ),
			'no_empty'	=> false
		),

		'header_search' => array(
			'value'		=> true,
			'no_empty'	=> false
		),

	);

	return $defaults;

}

add_filter( 'ctfw_customize_defaults', 'jubilee_customize_defaults' );
