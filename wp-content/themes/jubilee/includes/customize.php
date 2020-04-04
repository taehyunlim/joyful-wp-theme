<?php
/**
 * Theme Customizer
 *
 * Add options to the Theme Customizer.
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

/*********************************************
 * CHOICES
 *********************************************/

/**
 * Logo Type Choices
 *
 * @since 1.0
 * @return array Choices for user selection and sanitization
 */
function jubilee_customize_logo_type_choices() {

	$choices = 	array(
		'image' => _x( 'Image', 'customizer', 'jubilee' ),
		'text'	=> _x( 'Text', 'customizer', 'jubilee' ),
	);

	return apply_filters( 'jubilee_customize_logo_type_choices', $choices );

}

/**
 * Logo Text Size Choices
 *
 * @since 1.0
 * @return array Choices for user selection and sanitization
 */
function jubilee_customize_logo_text_size_choices() {

	$choices = 	array(
		'extra-small'	=> _x( 'Extra Small', 'customizer', 'jubilee' ),
		'small'			=> _x( 'Small', 'customizer', 'jubilee' ),
		'medium'		=> _x( 'Medium', 'customizer', 'jubilee' ),
		'large'			=> _x( 'Large', 'customizer', 'jubilee' ),
		'extra-large'	=> _x( 'Extra Large', 'customizer', 'jubilee' ),
	);

	return apply_filters( 'jubilee_customize_logo_text_size_choices', $choices );

}

/**
 * Bottom Sticky Choices
 *
 * @since 1.0
 * @return array Choices for user selection and sanitization
 */
function jubilee_customize_bottom_sticky_choices() {

	$choices = array(
		'events'	=> _x( 'Upcoming Events', 'customizer', 'jubilee' ),
		'sermons'	=> sprintf(
			/* translators: %1$s is "Sermons", possibly translated or changed by settings */
			_x( 'Latest %1$s', 'customizer', 'jubilee' ),
			ctfw_sermon_word_plural()
		),
		'posts'		=> _x( 'Latest Posts', 'customizer', 'jubilee' ),
		'content'	=> _x( 'Custom Content', 'customizer', 'jubilee' ),
		'none'		=> _x( 'Nothing', 'customizer', 'jubilee' )
	);

	return apply_filters( 'jubilee_customize_bottom_sticky_choices', $choices );

}

/**
 * Bottom Sticky Items Limit Choices
 *
 * @since 1.0
 * @return array Choices for user selection and sanitization
 */
function jubilee_customize_bottom_sticky_items_limit_choices() {

	$choices = array(
		'1'	=> _x( 'One', 'customizer header items', 'jubilee' ),
		'2'	=> _x( 'Two', 'customizer header items', 'jubilee' ),
	);

	return apply_filters( 'jubilee_customize_bottom_sticky_items_limit_choices', $choices );

}

/**
 * Shapes Choices
 *
 * @since 1.0
 * @return array Choices for user selection and sanitization
 */
function jubilee_customize_shapes_choices() {

	$choices = 	array(
		'organic' 	=> __( 'Organic', 'jubilee' ),
		'angled'	=> __( 'Angeled', 'jubilee' ),
		'square'	=> __( 'Square', 'jubilee' ),
	);

	return apply_filters( 'jubilee_customize_shapes_choices', $choices );

}

/*********************************************
 * SETTINGS
 *********************************************/

/**
 * Sections, settings and controls
 *
 * @since 1.0
 * @param object $wp_customize WordPress theme customizer object
 */
function jubilee_customize_register( $wp_customize ) {

	// Master Option
	// All options will be jubilee as an array under this single option ID
	$option_id = ctfw_customize_option_id();
	$setting_type = 'option';

	// Default values
	$defaults = ctfw_customize_defaults();

	// Section and control priority
	$section_priority = 0; // start it off
	$section_increment = 18;
	$control_increment = 18;

	/*---------------------------------------------
	 * Site Identity (Core)
	 *--------------------------------------------*/

	// Add description for Site Identity
	$section = 'title_tagline';
	$wp_customize->get_section( $section )->priority = $section_priority += $section_increment; // section order
	$wp_customize->get_section( $section )->description = esc_html__( 'Site Title and Tagline are shown on search engine results, bookmarks, etc.', 'jubilee' );

	/*---------------------------------------------
	 * Colors
	 *--------------------------------------------*/

	$section = 'colors';
	$wp_customize->get_section( $section )->priority = $section_priority += $section_increment; // section order
	$wp_customize->get_section( $section )->title = esc_html__( 'Colors', 'jubilee' ); // rename
	$control_priority = 0;

		// Primary Color
		$setting = $option_id . '[main_color]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['main_color']['value'],
			'type'					=> $setting_type,
			'transport'				=> 'postMessage',
			'sanitize_callback'		=> 'jubilee_customize_sanitize_main_color',
		) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
				'label'			=> esc_html__( 'Primary Color', 'jubilee' ),
				'section'		=> $section,
				'description'	=> esc_html__( 'Header, footer and solid buttons.', 'jubilee' ),
				'priority'		=> $control_priority += $control_increment,
			) ) );

		// Accent Color
		$setting = $option_id . '[accent_color]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['accent_color']['value'],
			'type'					=> $setting_type,
			'transport'				=> 'postMessage',
			'sanitize_callback'		=> 'jubilee_customize_sanitize_accent_color',
		) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
				'label'			=> esc_html__( 'Accent Color', 'jubilee' ),
				'section'		=> $section,
				'description'	=> esc_html__( 'Outlined buttons, links and gradients.', 'jubilee' ),
				'priority'		=> $control_priority += $control_increment,
			) ) );

		// Highlight Color
		$setting = $option_id . '[highlight_color]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['highlight_color']['value'],
			'type'					=> $setting_type,
			'transport'				=> 'postMessage',
			'sanitize_callback'		=> 'jubilee_customize_sanitize_highlight_color',
		) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
				'label'			=> esc_html__( 'Highlight Color', 'jubilee' ),
				'section'		=> $section,
				'description'	=> esc_html__( 'Labels, highlights and hovered menu links.', 'jubilee' ),
				'priority'		=> $control_priority += $control_increment,
			) ) );

		// Image Colorization
		$setting = $option_id . '[colorization]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['colorization']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_colorization',
		) );

			$wp_customize->add_control( $setting, array(
				'label'			=> _x( 'Image Colorization', 'customizer', 'jubilee' ),
				'description'	=> esc_html__( 'Strength of colorization on homepage section and page header images.', 'jubilee' ),
				'section'		=> $section,
				'type'			=> 'number',
				'input_attrs' => array(
					'min' => 1,
					'max' => 100,
					'style' => 'width:60px',
				),
				'priority'		=> $control_priority += $control_increment,
			) );

	/*---------------------------------------------
	 * Fonts
	 *--------------------------------------------*/

	$section = 'jubilee_fonts';
	$wp_customize->add_section( $section, array(
		'title'			=> _x( 'Fonts', 'customizer', 'jubilee' ),
		'description'	=> esc_html__( "Choose from a hand-picked selection of Google Fonts that work well with this theme.", 'jubilee' ),
		'priority'		=> $section_priority += $section_increment, // section order
	) );
	$control_priority = 0;

		// Logo Font
		$setting = $option_id . '[logo_font]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['logo_font']['value'],
			'type'					=> $setting_type,
			'transport'				=> 'postMessage',
			'sanitize_callback'		=> 'jubilee_customize_sanitize_logo_font',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> esc_html__( 'Logo Font', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'select',
				'choices'	=> ctfw_google_font_options_array( array(
								'target' 	=> 'logo_font',
								'show_type'	=> true
							) ),
				'priority'	=> $control_priority += $control_increment,
			) );

		// Navigation Font
		$setting = $option_id . '[nav_font]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['nav_font']['value'],
			'type'					=> $setting_type,
			'transport'				=> 'postMessage',
			'sanitize_callback'		=> 'jubilee_customize_sanitize_nav_font',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> esc_html__( 'Navigation Font', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'select',
				'choices'	=> ctfw_google_font_options_array( array(
								'target' 	=> 'nav_font',
								'show_type'	=> true
							) ),
				'description'	=> esc_html__( 'Menu links and buttons', 'jubilee' ),
				'priority'	=> $control_priority += $control_increment,
			) );

		// Heading Font
		$setting = $option_id . '[heading_font]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['heading_font']['value'],
			'type'					=> $setting_type,
			'transport'				=> 'postMessage',
			'sanitize_callback'		=> 'jubilee_customize_sanitize_heading_font',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> esc_html__( 'Heading Font', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'select',
				'choices'	=> ctfw_google_font_options_array( array(
								'target' 	=> 'heading_font',
								'show_type'	=> true
							) ),
				'priority'	=> $control_priority += $control_increment,
			) );

		// Body Font
		$setting = $option_id . '[body_font]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['body_font']['value'],
			'type'					=> $setting_type,
			'transport'				=> 'postMessage',
			'sanitize_callback'		=> 'jubilee_customize_sanitize_body_font',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> esc_html__( 'Body Font', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'select',
				'choices'	=> ctfw_google_font_options_array( array(
								'target' 	=> 'body_font',
								'show_type'	=> true
							) ),
				'priority'	=> $control_priority += $control_increment,
			) );

		// Font Subsets
		$setting = $option_id . '[font_subsets]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['font_subsets']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_font_subsets',
		) );

			$wp_customize->add_control( $setting, array(
				'label'			=> esc_html__( 'Font Subsets (Optional)', 'jubilee' ),
				'section'		=> $section,
				'type'			=> 'text',
				'description'	=> esc_html__( 'Some fonts support multiple character sets (e.g. latin, cyrillic, greek, vietnamese). When none specified, latin is used. If necessary, enter multiple sets separated by commas.', 'jubilee' ),
				'priority'		=> $control_priority += $control_increment,
			) );

	/*---------------------------------------------
	 * Style
	 *--------------------------------------------*/

	$section = 'jubilee_styling';
	$wp_customize->add_section( $section, array(
		'title'			=> _x( 'Styling', 'customizer', 'jubilee' ),
		'description'	=> '',
		'priority'		=> $section_priority += $section_increment, // section order
	) );
	$control_priority = 0;

		// Text Styling
		// This is just a heading for the checkboxes below
		$setting = $option_id . '[text_styling]';
		$wp_customize->add_setting( $setting, array(
			'sanitize_callback'		=> 'trim', // this to avoid erroneous Theme Check warning
		) );

			$wp_customize->add_control( $setting, array(
				'label'			=> esc_html__( 'Text', 'jubilee' ),
				'section'		=> $section,
				'type'			=> 'hidden',
				'priority'		=> $control_priority += $control_increment,
			) );

		// Uppercase
		$setting = $option_id . '[uppercase]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['uppercase']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'ctfw_customize_sanitize_checkbox',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> esc_html__( 'Uppercase Headings', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'checkbox',
				'priority'	=> $control_priority += $control_increment,
			) );

		// Shapes
		$setting = $option_id . '[shapes]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['shapes']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_shapes',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> esc_html__( 'Shapes', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'radio',
				'choices'	=> jubilee_customize_shapes_choices(),
				'priority'	=> $control_priority += $control_increment,
			) );

	/*---------------------------------------------
	 * Logo
	 *--------------------------------------------*/

	$section = 'jubilee_logo';
	$wp_customize->add_section( $section, array(
		'title'			=> _x( 'Logo', 'customizer', 'jubilee' ),
		'description'	=>__( 'You can provide a logo image or text.', 'jubilee' ),
		'priority'		=> $section_priority += $section_increment, // section order
	) );
	$control_priority = 0;

		// Logo Type
		$setting = $option_id . '[logo_type]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['logo_type']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_logo_type',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> _x( 'Logo Type', 'customizer', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'radio',
				'choices'	=> jubilee_customize_logo_type_choices(),
				'priority'	=> $control_priority += $control_increment,
			) );

		// Logo Image
		$setting = $option_id . '[logo_image]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['logo_image']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'esc_url_raw',
		) );

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting, array(
				'label'			=> _x( 'Logo Image', 'customizer', 'jubilee' ),
				'description'	=> sprintf(
										__( '<b>%1$s maximum</b> (transparent PNG recommended).', 'jubilee' ),
										jubilee_logo_size( 'max_dimensions' )
									),
				'section'		=> $section,
				'priority'		=> $control_priority += $control_increment,
			) ) );

		// Logo Image - HiDPI / Retina
		$setting = $option_id . '[logo_hidpi]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['logo_hidpi']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'esc_url_raw',
		) );

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting, array(
				'label'		=> _x( 'HiDPI Logo (Optional)', 'customizer', 'jubilee' ),
				'description'	=> esc_html__( 'Also known as "Retina", should be exactly double the size of regular image.', 'jubilee' ),
				'section'	=> $section,
				'priority'	=> $control_priority += $control_increment,
			) ) );

		// Logo Text
		$setting = $option_id . '[logo_text]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['logo_text']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_logo_text',
		) );

			$wp_customize->add_control( $setting, array(
				'label'			=> esc_html__( 'Logo Text', 'jubilee' ),
				'section'		=> $section,
				'type'			=> 'text',
				'priority'		=> $control_priority += $control_increment
			) );

		// Logo Text Size
		$setting = $option_id . '[logo_text_size]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['logo_text_size']['value'],
			'type'					=> $setting_type,
			'transport'				=> 'postMessage',
			'sanitize_callback'		=> 'jubilee_customize_sanitize_logo_text_size',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> _x( 'Logo Text Size', 'customizer', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'radio',
				'choices'	=> jubilee_customize_logo_text_size_choices(),
				'priority'	=> $control_priority += $control_increment,
			) );

	/*---------------------------------------------
	 * Header Image
	 *--------------------------------------------*/

	$section = 'header_image';
	$wp_customize->get_section( $section )->priority = $section_priority += $section_increment; // section order
	$wp_customize->get_section( $section )->description = esc_html__( 'This image is shown on page headers (excluding homepage) when a page doesn\'t have its own image.', 'jubilee' );
	$control_priority = 0;

		// Header Image appears automatically (via add_theme_support())
		// Other custom settings added below

		// Header Image Brightness
		$setting = $option_id . '[header_image_brightness]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['header_image_brightness']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_header_image_brightness',
		) );

			$wp_customize->add_control( $setting, array(
				'label'			=> _x( 'Image Brightness (Percentage)', 'customizer', 'jubilee' ),
				'description'	=> esc_html__( 'Lower percentage makes image darker.', 'jubilee' ),
				'section'		=> $section,
				'type'			=> 'number',
				'input_attrs' => array(
					'min' => 1,
					'max' => 100,
					'style' => 'width:60px',
				),
				'priority'		=> $control_priority += $control_increment,
			) );

	/*---------------------------------------------
	 * Footer Content
	 *--------------------------------------------*/

	$section = 'jubilee_footer';
	$wp_customize->add_section( $section, array(
		'title'			=> _x( 'Footer', 'customizer', 'jubilee' ),
		'description' 	=> sprintf(
							esc_html__( 'Go to %1$s to manage widgets and %2$s to manage icons.', 'jubilee' ),
							'<b>' . esc_html__( 'Widgets > Footer', 'jubilee' ) . '</b>',
							'<b>' . esc_html__( 'Icons', 'jubilee' ) . '</b>'
						),
		'priority'		=> $section_priority += $section_increment, // section order
	) );
	$control_priority = 0;

		// Location
		$setting = $option_id . '[show_footer_location]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['show_footer_location']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'ctfw_customize_sanitize_checkbox',
		) );

			$wp_customize->add_control( $setting, array(
				'label'			=> _x( 'Show Map', 'customizer', 'jubilee' ),
				'description'	=> _x( 'A map for your primary location will be shown, except on pages where map is shown higher (homepage, location, etc.).', 'customizer', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'checkbox',
				'priority'	=> $control_priority += $control_increment,
			) );

		// Notice
		$setting = $option_id . '[footer_notice]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['footer_notice']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_footer_notice',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> _x( 'Notice', 'customizer', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'textarea',
				'priority'	=> $control_priority += $control_increment,
			) );

		// Bottom Sticky
		$setting = $option_id . '[bottom_sticky]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['bottom_sticky']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_bottom_sticky',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> _x( 'Bottom Sticky', 'customizer', 'jubilee' ),
				'description'	=> esc_html__( 'Show content in box fixed to bottom-right of screen. It stays visible as user scrolls.', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'radio',
				'choices'	=> jubilee_customize_bottom_sticky_choices(),
				'priority'	=> $control_priority += $control_increment,
			) );

		// Bottom Sticky - Items Limit
		$setting = $option_id . '[bottom_sticky_items_limit]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['bottom_sticky_items_limit']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_bottom_sticky_items_limit',
		) );

			$wp_customize->add_control( $setting, array(
				'label'			=> _x( 'Bottom Sticky Items', 'customizer', 'jubilee' ),
				'section'		=> $section,
				'type'			=> 'radio',
				'choices'		=> jubilee_customize_bottom_sticky_items_limit_choices(),
				'priority'		=> $control_priority += $control_increment,
			) );

		// Bottom Sticky - Custom Content
		$setting = $option_id . '[bottom_sticky_content]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['bottom_sticky_content']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_bottom_sticky_content',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> esc_html__( 'Custom Content', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'text',
				'priority'	=> $control_priority += $control_increment,
			) );

	/*---------------------------------------------
	 * Icons
	 *--------------------------------------------*/

	$section = 'jubilee_icons';
	$wp_customize->add_section( $section, array(
		'title'			=> _x( 'Icons', 'customizer', 'jubilee' ),
		'description' 	=> '',
		'priority'		=> $section_priority += $section_increment, // section order
	) );
	$control_priority = 0;

		// Icon URLs
		$setting = $option_id . '[icon_urls]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['icon_urls']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'jubilee_customize_sanitize_icon_urls',
		) );

			$wp_customize->add_control( $setting, array(
				'label'			=> esc_html__( 'Social Icon URLs', 'jubilee' ),
				'description'	=> sprintf(
										wp_kses(
											__( 'Icons show in the footer and on the homepage in the CT Locations widget. Enter one URL per line for %s. Use <code>[ctcom_rss_url]</code> for RSS.', 'jubilee' ),
											array(
												'code' => array()
											)
										),
										jubilee_social_icon_sites( 'or' )
									),
				'section'		=> $section,
				'type'			=> 'textarea',
				'priority'	=> $control_priority += $control_increment,
			) );

		// Search Icon (Heading)
		// This is just a heading for the checkbox below
		$setting = $option_id . '[search_icon]';
		$wp_customize->add_setting( $setting, array(
			'sanitize_callback'		=> 'trim', // this to avoid erroneous Theme Check warning
		) );

			$wp_customize->add_control( $setting, array(
				'label'			=> esc_html__( 'Search Icon', 'jubilee' ),
				'section'		=> $section,
				'type'			=> 'hidden',
				'priority'		=> $control_priority += $control_increment,
			) );

		// Search Icon (Checkbox)
		$setting = $option_id . '[header_search]';
		$wp_customize->add_setting( $setting, array(
			'default'				=> $defaults['header_search']['value'],
			'type'					=> $setting_type,
			'sanitize_callback'		=> 'ctfw_customize_sanitize_checkbox',
		) );

			$wp_customize->add_control( $setting, array(
				'label'		=> esc_html__( 'Show in Header', 'jubilee' ),
				'section'	=> $section,
				'type'		=> 'checkbox',
				'priority'	=> $control_priority += $control_increment,
			) );

	/*---------------------------------------------
	 * Homepage - Static Front Page (core)
	 *--------------------------------------------*/

	// Static Front Page (core)
	$section = 'static_front_page';
	if ( $wp_customize->get_section( $section ) ) { // section will not exist if no Pages have been made yet
		$wp_customize->get_section( $section )->title = _x( 'Homepage', 'customizer', 'jubilee' ); // rename from Static Front Page
		$wp_customize->get_section( $section )->description = esc_html__( 'Create a page that uses the Homepage template and set it as your "Front page" below. Set "Posts page" to a page that uses the Blog template.', 'jubilee' );
		$wp_customize->get_section( $section )->description .= '<br><br>';
		$wp_customize->get_section( $section )->description .= sprintf(
																	esc_html__( 'Go to %1$s to manage your homepage content.', 'jubilee' ),
																	'<b>' . esc_html__( 'Widgets > Homepage', 'jubilee' ) . '</b>'
																);
		$wp_customize->get_section( $section )->priority = $section_priority += $section_increment; // section order
		$control_priority = 0;
	}

	/*---------------------------------------------
	 * Widgets
	 *--------------------------------------------*/

	// Widgets (core) - move before "Additional CSS"
	$panel = (object) $wp_customize->get_panel( 'widgets' ); // prevent "Creating default object from empty value" warning in PHP 5.4
	$panel->priority = 199; // panel/section order

}

add_action( 'customize_register', 'jubilee_customize_register' );

/*********************************************
 * SANITIZATION
 *********************************************/

// Sanitize all fields to prevent incorrect or dangerous input.

/*---------------------------------------------
 * Colors
 *--------------------------------------------*/

/**
 * Sanitize Main Color
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_main_color( $input, $object ) {

	// Validate hex code; if empty or invalid, use default
	$output = ctfw_customize_sanitize_color( 'main_color', $input );

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_main_color', $output, $input, $object );

}

/**
 * Sanitize Accent Color
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_accent_color( $input, $object ) {

	// Sanitize hex code; if empty or invalid, use default
	$output = ctfw_customize_sanitize_color( 'accent_color', $input );

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_accent_color', $output, $input, $object );

}

/**
 * Sanitize Highlight Color
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_highlight_color( $input, $object ) {

	// Sanitize hex code; if empty or invalid, use default
	$output = ctfw_customize_sanitize_color( 'highlight_color', $input );

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_highlight_color', $output, $input, $object );

}

/*---------------------------------------------
 * Fonts
 *--------------------------------------------*/

/**
 * Sanitize Logo Font
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_logo_font( $input, $object ) {

	// Check input against choices; use default if empty value not permitted
	$output = ctfw_customize_sanitize_google_font( 'logo_font', $input );

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_logo_font', $output, $input, $object );

}

/**
 * Sanitize Menu Font
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_nav_font( $input, $object ) {

	// Check input against choices; use default if empty value not permitted
	$output = ctfw_customize_sanitize_google_font( 'nav_font', $input );

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_nav_font', $output, $input, $object );

}

/**
 * Sanitize Heading Font
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_heading_font( $input, $object ) {

	// Check input against choices; use default if empty value not permitted
	$output = ctfw_customize_sanitize_google_font( 'heading_font', $input );

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_heading_font', $output, $input, $object );

}

/**
 * Sanitize Body Font
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_body_font( $input, $object ) {

	// Check input against choices; use default if empty value not permitted
	$output = ctfw_customize_sanitize_google_font( 'body_font', $input );

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_body_font', $output, $input, $object );

}

/**
 * Sanitize Google Font Character Sets
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_font_subsets( $input, $object ) {

	// Remove whitespace, HTML, etc.
	$output = sanitize_text_field( $input );

	// Return sanitized filterable
	return apply_filters( 'jubilee_customize_sanitize_font_subsets', $output, $input, $object );

}

/*---------------------------------------------
 * Logo
 *--------------------------------------------*/

/**
 * Sanitize Logo Type
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_logo_type( $input, $object ) {

	// Check input against choices; use default if empty value not permitted
	$output = ctfw_customize_sanitize_single_choice( 'logo_type', $input, jubilee_customize_logo_type_choices() ); // ctfw_customize_sanitize_single_choice is for radio or single select

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_logo_type', $output, $input, $object );

}

/**
 * Sanitize Logo Text
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_logo_text( $input, $object ) {

	// Allow only <span> tag
	$output = wp_kses( $input, array(
		'span' => array()
	) );

	// Balance tags
	$output = force_balance_tags( $output );

	// Return sanitized filterable
	return apply_filters( 'jubilee_customize_sanitize_logo_text', $output, $input, $object );

}

/**
 * Sanitize Logo Text Size
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_logo_text_size( $input, $object ) {

	// Check input against choices; use default if empty value not permitted
	$output = ctfw_customize_sanitize_single_choice( 'logo_text_size', $input, jubilee_customize_logo_text_size_choices() ); // ctfw_customize_sanitize_single_choice is for radio or single select

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_logo_text_size', $output, $input, $object );

}

/*---------------------------------------------
 * Header Bar
 *--------------------------------------------*/

/**
 * Search Icon checkbox done directly with ctfw_customize_sanitize_checkbox()
 */

/**
 * Sanitize Icon URLs
 *
 * Used on header and footer URL lists for icons.
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized list of URLs
 */
function jubilee_customize_sanitize_icon_urls( $input, $object ) {

	// Remove empty lines and sanitize URLs
	$output = ctfw_sanitize_url_list( $input, array(
		'[ctcom_rss_url]' // allow this string instead of URL
	) );

	// Return sanitized filterable
	return apply_filters( 'jubilee_customize_sanitize_icon_urls', $output, $input, $object );

}

/*---------------------------------------------
 * Header Image
 *--------------------------------------------*/

/**
 * Image Colorization
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return int Non-negative number between 1 and 100
 */
function jubilee_customize_sanitize_colorization( $input, $object ) {

	// Force non-negative numeric value
	$output = absint( $input );

	// If 0 set it to 1
	if ( 0 == $output ) {
		$output = 1;
	}

	// If more than 100, set to 100
	if ( $output > 100 ) {
		$output = 100;
	}

	// Return sanitized filterable
	return apply_filters( 'jubilee_customize_sanitize_colorization', $output, $input, $object );

}

/**
 * Header Image Brightness
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return int Non-negative number between 1 and 100
 */
function jubilee_customize_sanitize_header_image_brightness( $input, $object ) {

	// Force non-negative numeric value
	$output = absint( $input );

	// If 0 set it to 1
	if ( 0 == $output ) {
		$output = 1;
	}

	// If more than 100, set to 100
	if ( $output > 100 ) {
		$output = 100;
	}

	// Return sanitized filterable
	return apply_filters( 'jubilee_customize_sanitize_header_image_brightness', $output, $input, $object );

}

/*---------------------------------------------
 * Footer Content
 *--------------------------------------------*/

/**
 * Show Location -- done directly with ctfw_customize_sanitize_checkbox()
 */

/**
 * Footer icons uses same function as header icons - jubilee_customize_sanitize_icon_urls(), above
 */

/**
 * Sanitize Footer Notice
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Content with "safe" HTML
 */
function jubilee_customize_sanitize_footer_notice( $input, $object ) {

	// Allow HTML (same as posts), no scripts
	$output = stripslashes( wp_filter_post_kses( addslashes( $input ) ) );

	// Balance tags (may be using HTML for link)
	$output = force_balance_tags( $output );

	// Return sanitized filterable
	return apply_filters( 'jubilee_customize_sanitize_footer_notice', $output, $input, $object );

}

/**
 * Sanitize Bottom Sticky
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_bottom_sticky( $input, $object ) {

	// Check input against choices; use default if empty value not permitted
	$output = ctfw_customize_sanitize_single_choice( 'bottom_sticky', $input, jubilee_customize_bottom_sticky_choices() ); // ctfw_customize_sanitize_single_choice is for radio or single select

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_bottom_sticky', $output, $input, $object );

}

/**
 * Sanitize Bottom Sticky Items Limit
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_bottom_sticky_items_limit( $input, $object ) {

	// Check input against choices; use default if empty value not permitted
	$output = ctfw_customize_sanitize_single_choice( 'bottom_sticky_items_limit', $input, jubilee_customize_bottom_sticky_items_limit_choices() ); // ctfw_customize_sanitize_single_choice is for radio or single select

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_bottom_sticky_items_limit', $output, $input, $object );

}

/**
 * Sanitize Bottom Sticky Custom Content
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Content with "safe" HTML
 */
function jubilee_customize_sanitize_bottom_sticky_content( $input, $object ) {

	// Allow HTML (same as posts), no scripts (better to child theme it)
	$output = stripslashes( wp_filter_post_kses( addslashes( $input ) ) );

	// Balance tags (may be using HTML for link)
	$output = force_balance_tags( $output );

	// Return sanitized filterable
	return apply_filters( 'jubilee_customize_sanitize_bottom_sticky_content', $output, $input, $object );

}

/*---------------------------------------------
 * Style
 *--------------------------------------------*/

/**
 * Sanitize Shapes
 *
 * @since 1.0
 * @param string $input Unsanitized value submitted by user
 * @param object $object
 * @return string Sanitized value
 */
function jubilee_customize_sanitize_shapes( $input, $object ) {

	// Check input against choices; use default if empty value not permitted
	$output = ctfw_customize_sanitize_single_choice( 'shapes', $input, jubilee_customize_shapes_choices() ); // ctfw_customize_sanitize_single_choice is for radio or single select

	// Return sanitized, filterable
	return apply_filters( 'jubilee_customize_sanitize_shapes', $output, $input, $object );

}

/*********************************************
 * SCRIPTS & STYLES
 *********************************************/

/**
 * Enqueue JavaScript for customizer controls
 *
 * @since 1.0
 */
function jubilee_customize_enqueue_scripts() {

	// doTimeout used by admin-customize.js
	wp_enqueue_script( 'jquery-ba-dotimeout', get_theme_file_uri( CTFW_THEME_JS_DIR . '/lib/jquery.ba-dotimeout.min.js' ), array( 'jquery' ), CTFW_THEME_VERSION ); // bust cache on theme update

	// Script that handles dynamic display of controls
	wp_enqueue_script( 'jubilee-admin-customize', get_theme_file_uri( CTFW_THEME_JS_DIR . '/admin-customize.js' ), array( 'jquery' ), CTFW_THEME_VERSION ); // bust cache on theme update

	// Make data available to script
	wp_localize_script( 'jubilee-admin-customize', 'jubilee_customize', array(
		'option_id' => ctfw_customize_option_id()
	));

}

add_action( 'customize_controls_print_scripts', 'jubilee_customize_enqueue_scripts' );

/**
 * Enqueue styles for customizer controls
 *
 * @since 1.0
 */
function jubilee_customize_enqueue_styles() {

	// Customizer styles
	wp_enqueue_style( 'jubilee-admin-customize', get_theme_file_uri( CTFW_THEME_CSS_DIR . '/admin/admin-customize.css' ), false, CTFW_THEME_VERSION ); // bust cache on update

	// Admin widgets
	// Same stylesheet used for Appearance > Widgets
	wp_enqueue_style( 'jubilee-admin-widgets', get_theme_file_uri( CTFW_THEME_CSS_DIR . '/admin/admin-widgets.css' ), false, CTFW_THEME_VERSION ); // bust cache on update

}

add_action( 'customize_controls_print_styles', 'jubilee_customize_enqueue_styles' );

/**
 * Enqueue JavaScript for customizer live preview
 *
 * @since 1.0
 */
function jubilee_customize_preview_enqueue_scripts() {

	// Google Web Font Loader
	wp_enqueue_script( 'google-webfont-loader', '//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js', false, null ); // null - don't mess with Google Fonts URL by adding version

	// Enqueue preview script
	wp_enqueue_script( 'jubilee-admin-customize-preview', get_theme_file_uri( CTFW_THEME_JS_DIR . '/admin-customize-preview.js' ), false, CTFW_THEME_VERSION ); // bust cache on theme update

	// ColorConverter.js
	wp_enqueue_script( 'colorconverter', get_theme_file_uri( CTFW_THEME_JS_DIR . '/lib/colorconverter.min.js' ), false, CTFW_THEME_VERSION ); // bust cache on theme update

	// Make data available to script
	wp_localize_script( 'jubilee-admin-customize-preview', 'jubilee_customize_preview', array(

		'option_id' 							=> ctfw_customize_option_id(),
		'fonts' 								=> ctfw_google_fonts(),
		'rgb_opacity'							=> jubilee_rgb_opacity(), // set in includes/head.php
		'gradients'								=> jubilee_gradients(),

		'logo_font_selectors'					=> jubilee_style_selectors( 'logo_font' ),
		'nav_font_selectors'					=> jubilee_style_selectors( 'nav_font' ),
		'heading_font_selectors'				=> jubilee_style_selectors( 'heading_font' ),
		'body_font_selectors'					=> jubilee_style_selectors( 'body_font' ),

		'main_color_selectors'					=> jubilee_style_selectors( 'main_color' ),
		'main_color_rgba_selectors'				=> jubilee_style_selectors( 'main_color_rgba' ),
		'main_color_rgba_alt_selectors'			=> jubilee_style_selectors( 'main_color_rgba_alt' ),
		'main_color_border_selectors'			=> jubilee_style_selectors( 'main_color_border' ),
		'main_color_rgba_border_selectors'		=> jubilee_style_selectors( 'main_color_rgba_border' ),
		'main_color_text_selectors'				=> jubilee_style_selectors( 'main_color_text' ),

		'accent_color_selectors'				=> jubilee_style_selectors( 'accent_color' ),
		'accent_color_important_selectors'		=> jubilee_style_selectors( 'accent_color_important' ),
		'accent_color_border_selectors'			=> jubilee_style_selectors( 'accent_color_border' ),
		'accent_color_bg_selectors'				=> jubilee_style_selectors( 'accent_color_bg' ),
		'accent_color_rgba_selectors'			=> jubilee_style_selectors( 'accent_color_rgba' ),

		'highlight_color_selectors'				=> jubilee_style_selectors( 'highlight_color' ),
		'highlight_color_important_selectors'	=> jubilee_style_selectors( 'highlight_color_important' ),
		'highlight_color_rgba_selectors'		=> jubilee_style_selectors( 'highlight_color_rgba' ),
		'highlight_color_rgba_half_selectors'	=> jubilee_style_selectors( 'highlight_color_rgba_half' ),
		'highlight_color_border_selectors'		=> jubilee_style_selectors( 'highlight_color_border' ),

	) );

}

add_action( 'customize_preview_init', 'jubilee_customize_preview_enqueue_scripts' );
