<?php
/**
 * Church Theme Framework Feature Support
 *
 * The framework's features and widgets must be enabled and configured explicitly.
 *
 * Child Themes: Use get_theme_support() to get arguments, modify them, then call
 * add_theme_support(): http://codex.wordpress.org/Function_Reference/get_theme_support
 *
 * See developer guide: https://churchthemes.com/guides/developer/framework/
 *
 * @package    Jubilee
 * @subpackage Functions
 * @copyright  Copyright (c) 2019, ChurchThemes.com, LLC
 * @link       https://churchthemes.com/themes/jubilee
 * @license    GPLv2 or later
 * @since      1.0
 */

// No direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add theme support for framework features
 *
 * @since 1.0
 */
function jubilee_add_theme_support_framework() {

	/**
	 * Setup
	 */

	// Require minimum version of WordPress
	// An admin notice is shown if old version is used
	add_theme_support( 'ctfw-wordpress-version', '5.2' );  // 5.2 at first release

	// Theme activation tasks.
	add_theme_support( 'ctfw-after-activation', array(
		'flush_rewrite_rules'	=> true, // make sure friendly URL's work
		'notice'				=> sprintf( __( '<b>Next Steps:</b> Please continue reading the <a href="%s" target="_blank">Getting Started</a> guide for the next steps after theme activation.', 'jubilee' ), 'https://churchthemes.com/guides/user/getting-started/' ),
		'hide_default_notice'	=> true, // no need to be redundant
	) );

	// Theme license options page and one-click updates
	// This interfaces with Easy Digital Downloads Software Licensing extension on a remote site
	// See framework/includes/admin/edd-license.php for more options and their defaults
	add_theme_support( 'ctfw-edd-license', array(
		'store_url'					=> 'https://churchthemes.com',
		'renewal_url'				=> 'https://churchthemes.com/renew/?license_key={license_key}', // optional URL for renewal links (ie. EDD checkout); {license_key} will be replaced with key
		'renewal_info_url'			=> 'https://churchthemes.com/go/license-renewal', // optional URL renewal information
		'options_page_message'		=> sprintf( // shown at top of Theme License page
											__( 'Please activate your license key to enable one-click theme updates and to get support from <a href="%1$s" target="_blank">ChurchThemes.com</a> for this site. Read <a href="%2$s" target="_blank">License Keys</a> for more information.', 'jubilee' ),
											'https://churchthemes.com',
											'https://churchthemes.com/go/license-keys'
										),
		'activation_error_notice'	=> sprintf( // shown when activation fails
											__( '<b>License key could not be activated.</b> Read the <a href="%1$s" target="_blank">License Keys</a> guide for help.', 'jubilee' ),
											'https://churchthemes.com/go/license-inactive'
										),
		'expired_notice'			=> __( '<strong>Theme License Expired:</strong> <a href="%4$s" target="_blank">Renew</a> your <a href="%1$s">Theme License</a> to re-enable updates and support for the <strong>%2$s</strong> theme (expired on <strong>%3$s</strong>). <a href="%5$s" target="_blank">Learn More</a>', 'jubilee' ), // optional notice to override default with when license is expired
		'expiring_soon_notice'		=> __( '<strong>Theme License Expiring Soon:</strong> <a href="%4$s" target="_blank">Renew</a> your <a href="%1$s">Theme License</a> to continue receiving updates and support for the <strong>%2$s</strong> theme (expires on <strong>%3$s</strong>). <a href="%5$s" target="_blank">Learn More</a>', 'jubilee' ), // optional notice to override default with when license expires soon
	) );

	// Grandfather basic event recurrence functionality for early users.
	// Early users retain basic recurrence. New users must install Church Content Pro.
	add_theme_support( 'ctfw-grandfather-recurring-events', '2018-10-02' ); // release date of theme version removing basic recurrence support

	/**
	 * Localization
	 */

	// Load language file from wp-content/languages/themes/textdomain-locale.mo
	// It is absolutely best to keep it outside of theme to prevent loss during update
	add_theme_support( 'ctfw-load-translation' );

	// Replace core WordPress text strings
	// WordPress core and its translations sometimes use text that is not preferred (e.g. too long)
 	add_theme_support( 'ctfw-replace-wp-text', array(
        'Correo electrónico'	=> __( 'Email', 'jubilee' ), // [Theme Check false positive] Spanish: too long for comment form
        'Adresse de contact'	=> __( 'Courriel', 'jubilee' ), // French: too long for comment form
    ) );

	/**
	 * Design
	 */

	// Prompt outdated Internet Explorer users to upgrade to a modern browser
	add_theme_support( 'ctfw-ie-unsupported', 10 ); // version 10 and earlier: https://thenextweb.com/microsoft/2016/01/05/web-developers-rejoice-internet-explorer-8-9-and-10-die-on-tuesday/

	// Add various helper classes to <body>
	add_theme_support( 'ctfw-body-classes' );

	// Preset backgrounds for Customizer
	// Images are stored in images/backgrounds (first is default)
	//add_theme_support( 'ctfw-preset-backgrounds', array() );

	/**
	 * Posts
	 */

	// Add additional classes to post_class()
	// This will add useful classes like ctfw-has-image
	add_theme_support( 'ctfw-post-classes' );

	// Shorten comment author to keep long trackback titles in check
	add_theme_support( 'ctfw-shorten-comment-author', 50 );

	// Redirect post type archives to pages using specific page templates
	// Page templates must be specified with ctfw_content_types filter. See jubilee_update_content_types().
	add_theme_support( 'ctfw-archive-redirection' );

	// Enable date archives for sermon posts
	// Flush rewrite rules (re-save permalinks) to take effect
	add_theme_support( 'ctfw-sermon-date-archive' );

	// Make event category archive show upcoming only and order soonest to latest
	add_theme_support( 'ctfw-event-category-query' );

	// Redirect invalid event calendar URLs
	// This includes months in past, beyond next year or invalid format
	// page_template and years_future can be passed as arguments. See ctfw_event_calendar_redirection()
	add_theme_support( 'ctfw-event-calendar-redirection' );

	// Add event calendar month and category to <title> (compatible with SEO plugins)
	// page_template can be passed as argument (?month=YYYY-MM-DD&category=slug is expected query string).
	// See ctfw_event_calendar_head_title() for details
	add_theme_support( 'ctfw-event-calendar-head-title' );

	// Prev/Next Event Sorting
	// This makes get_previous_post() and get_next_post() sort by event Start Date instead of Publish Date
	add_theme_support( 'ctfw-event-navigation' );

	// Make group taxonomy archive order manually (like People template)
	add_theme_support( 'ctfw-people-group-manual-order' );

	// Prev/Next Person Sorting
	// This makes get_previous_post() and get_next_post() sort by manual order instead of Publish Date
	add_theme_support( 'ctfw-person-navigation' );

	// Prev/Next Location Sorting
	// This makes get_previous_post() and get_next_post() sort by manual order instead of Publish Date
	add_theme_support( 'ctfw-location-navigation' );

	// Enable framework's ctfw_loop_after_content_used() function which is used by ctfw_has_loop_multiple();
	// This helps framework know when a loop is being output on a regular page such as via page templates like Sermons, People, etc.
	add_theme_support( 'ctfw-loop-after-content-used', 'jubilee_loop_after_content_used' );

	// Output Gutenberg color classes on frontend based on add_theme_support( 'editor-color-palette' ).
	// Note: add_theme_support( 'ctfw-editor-styles' ) does the same for editor.
	add_theme_support( 'ctfw-color-styles' );

	/**
	 * Media
	 */

	// Show size notes under "Featured Image" for specific post types
	// Provide third argument to override the default message: 'The target image size is %s.'
	// Provide each item as array( 'size', 'message' ) instead of 'size' for post type-specific messages
	add_theme_support(
		'ctfw-featured-image-notes',
		array(
			'post'			=> 'jubilee-banner',
			'ctc_sermon'	=> 'jubilee-banner',
			'ctc_event'		=> 'jubilee-banner',
			'ctc_person'	=> 'post-thumbnail',
			'ctc_location'	=> 'jubilee-banner',
			'page'			=> 'jubilee-banner'
		),
		__( 'Optionally provide an image that is at least %s (it will be cropped/resized). An image exactly this size is ideal.', 'jubilee' )
	);

	// Enable image upscaling (helpful for responsive themes)
	// Resized images will be made for all uploads, even if source is smaller than target
	add_theme_support( 'ctfw-image-upscaling', array(
		'excluded_sizes' => array(
			'jubilee-square-large', // homepage section shape backgrounds; CSS cover/center scales fine
			'jubilee-banner', // big banners; CSS cover/center scales fine
		),
	) );

	// Use custom size for gallery thumbnails
	// This will be used when size attribute not specifically set on shortcode
	add_theme_support( 'ctfw-gallery-thumb-size', array(
		'2' => 'jubilee-rect-large', 		// when 1 to 2 columns used
		'5' => 'post-thumbnail', 		// when 3 to 5 columns used
		'9' => 'jubilee-rect-small',  	// when 6 to 9 columns used
	) );

	// Remove default gallery styles
	// It is better to do all styling in style.css and not rely on <style> that WordPress injects
	add_theme_support( 'ctfw-remove-gallery-styles' );

	// Automatically make video and audio embeds responsive
	// Uses FitVid.js and custom styles to assist WordPress core embeds, [video] and [audio]
	add_theme_support( 'ctfw-responsive-embeds' );

	// Generic embeds
	// This helps make embeds more generic by setting parameters to remove
	// related videos, set neutral colors, reduce branding, etc.
	add_theme_support( 'ctfw-generic-embeds' );

	// HTML5 valid embeds
	// Corrects invalid HTML5 for YouTube, Vimeo, etc.
	add_theme_support( 'ctfw-valid-embeds' );

	// Remove ?_=1 from audio/video shortcode URLs to help with Safari and firewall issues.
	add_theme_support( 'ctfw-clean-media-shortcode-url' );

	// Use browser's player for <audio> / <video> instead of WordPress's MediaElementJS.
	// This changes how ctfw_embed_code() works,
	//add_theme_support( 'ctfw-native-player' );

	/**
	 * Attachments
	 */

 	// Prevent WordPress from adding attachment image, link, etc. to the_content()
	// We show it manually using content-attachment.php
	add_theme_support( 'ctfw-remove-prepend-attachment' );

	// Attachment inherit discussion status
	// Inherit comment and ping statuses from parent post. If not attached to a post, discussion is disabled.
	add_theme_support( 'ctfw-attachment-inherit-discussion' );

	/**
	 * Widgets
	 */

 	// Enable sidebar/widget restrictions
 	// Useful for keeping widgets in appropriate widget areas (e.g. Slide widgets)
 	// See includes/sidebars.php for configuration
 	add_theme_support( 'ctfw-sidebar-widget-restrictions' );

	// Load template filename without widget area prefix for cleaner filenames
	// Example: widget-sermons-home.php can be used instead of widget-sermons-ctcom-home.php
	add_theme_support( 'ctfw-widget-template-no-prefix', 'ctcom-' );

	/**
	 * Admin
	 */

	// Add editor styles with colors and fonts from Customizer.
	// Also outputs color classes based on add_theme_support( 'editor-color-palette' ).
	add_theme_support( 'ctfw-editor-styles', array(
		'stylesheet' 			=> 'style.css',												// For Classic Editor. style.css will be used if not specified.
		'block_stylesheet'		=> CTFW_THEME_CSS_DIR . '/admin/block-editor.css', 			// For Gutenberg Editor to style block controls.
		'css_function'			=> 'jubilee_head_styles',										// For Classic Editor. Function outputting dynamic CSS in <head> (exclude <style> tag).
		'block_css_function'	=> 'jubilee_block_editor_head_styles',						// For Gutenberg Editor. Function outputting dynamic CSS in admin <head> (exclude <style> tag).
 		'body_function'			=> 'jubilee_body_classes',									// Function returning array of classes to add to <body>.
		'fonts'					=> array( 'heading_font', 'nav_font', 'body_font' ),		// Customizer setting names for Google Fonts.
	) );

	// Show custom ordering tip under taxonomies list (very handy for People Groups)
	// Provide URL as second parameter to override the default recommended plugin
	add_theme_support( 'ctfw-taxonomy-order-note' );

	/**
	 * Import
	 */

	// Set permalink structure to "Post name" when importing content from "sampleuser"
	add_theme_support( 'ctfw-import-set-permalink-structure' );

	// Correct imported URL's in menu, content, widgets, etc.
	// Sample import files may have URLs from the dev site in menu, content, meta fields, etc.
	add_theme_support( 'ctfw-import-correct-urls', array(
		'url'			=> 'https://demos.churchthemes.com/' . CTFW_THEME_SLUG . '-sample', // base URL to replace for imported files
		'multisite_id'	=> 15, // site ID if imported files are coming off of a multisite installation
	) );

	// Set homepage as static front page after import
	// If no static front and page using homepage template doesn't exist before import, set it
	// Page using blog template is set as Posts Page if nothing already set
	add_theme_support( 'ctfw-import-set-static-front', 'homepage.php' ); // homepage template

	// Set menu locations after import
	// If zero locations already set, sample menus (if exist) are set to appropriate location.
	// If at least one location is set, assume admin is done configuring.
	add_theme_support( 'ctfw-import-set-menu-locations', array(
	     'header'	=> 'header-menu', // menu slug from sample content file
	     'footer'	=> 'footer-menu',
	) );

	// Update settings when importing content from "sampleuser"
	add_theme_support( 'ctfw-import-update-settings', array(
		'start_of_week'		=> '0', // Sunday like demo
		'posts_per_page'	=> '12',
	) );

	// Delete WordPress sample content before import
	// Move the sample post, page and comment that fresh WordPress installs have into Trash.
	add_theme_support( 'ctfw-import-delete-wp-content' );

	// Delete WordPress sample widgets on import of .xml or .wie import
	// Remove search, comments and meta WordPress widgets added to the primary widget area
	add_theme_support( 'ctfw-import-delete-wp-widgets' );

}

add_action( 'after_setup_theme', 'jubilee_add_theme_support_framework' );

/**
 * Add theme support for framework widgets
 *
 * Adding support for a framework widget will include its class, register the widget
 * and utilize the appropriate template in the widget-templates directory.
 *
 * If no fields are set, the default fields (typically all) will be used.
 * It is recommended to explicitly set fields to be used so that framework updates do
 * not introduce fields not supported by the theme.
 *
 * Related: See includes/sidebars.php for restricting widgets to specific sidebars as well
 * as restricting the number of widgets a sidebar can contain.
 *
 * @since 1.0
 */
function jubilee_add_theme_support_framework_widgets() {

	// Section Widget
	add_theme_support( 'ctfw-widget-section', array(
		'fields' => array(
			'title',
			'content',
			'text_size',
			'image_id',
			'height',
			'orientation',
			'link1_text',
			'link1_url',
			'link2_text',
			'link2_url',
			'link3_text',
			'link3_url',
			'link4_text',
			'link4_url',
		),
		'field_overrides' => array(
			'title' => array(
				'allow_html' => true, // so <mark> tag can be used.
			),
			'content' => array(
				'desc' => __( 'Provide no more than two sentences.', 'jubilee' ),
			),
			'text_size' => array(
				'name'				=> '', // remove "Text Size" name since appending " Text" to options below
				'options'			=> array(
					// removed 'small' option for this theme
					'regular'	=> _x( 'Regular Text', 'section widget text size', 'jubilee' ),
					'large'		=> _x( 'Large Text', 'section widget text size', 'jubilee' ),
				),
			),
			'image_id' => array( // tell user image is required with this theme
				'desc' => sprintf( __( 'Image cropped to <b>%s</b>. File size <b>under 200 KB</b> recommended.', 'jubilee' ), ctfw_image_size_dimensions( 'jubilee-square-large' ) ),
			),
			'height' => array(
				'default' => '65',
				'desc' => __( 'Set to 0 to auto-fit height to content.', 'jubilee' ),
			),
			'orientation' => array(
				'options'			=> array( // array of keys/values for radio or select
					'vertical'		=> _x( 'Vertical', 'section widget orientation', 'jubilee' ),
					'horizontal'	=> _x( 'Horizontal (No Image)', 'section widget orientation', 'jubilee' ),
				),
			),
		),
	) );

	// Highlight Widget
	add_theme_support( 'ctfw-widget-highlight', array(
		'fields' => array(
			'title',
			'description',
			'click_url',
			'click_new',
			'image_id',
			'image_opacity',
			'image_brightness',
		),
		'field_overrides' => array(
			'image_id' => array(
				'desc' => sprintf( __( 'Image cropped to <b>%s</b>. File size <b>under 100 KB</b> recommended.', 'jubilee' ), ctfw_image_size_dimensions( 'jubilee-square' ) ),
			),
			'image_brightness' => array(
				'desc' => __( 'Lower percentage makes image darker. Aim for easy to read text.', 'jubilee' ),
				'default' => '40',
			),
			'image_opacity' => array(
				'desc' => __( 'Lower percentage makes more color show through. Aim for easy to read text.', 'jubilee' ),
				'default' => '60',
			),
		),
	) );

	// Posts Widget
	add_theme_support( 'ctfw-widget-posts', array(
		'fields' => array(
			'title',
			'category',
			'orderby',
			'order',
			'limit',
			'show_image',
			'show_author',
			'show_date',
			'show_category',
			'show_excerpt',
			'image_id',
		),
		'field_overrides' => array(
			'limit' => array(
				'default'	=> 3,
			),
			'show_author' => array(
				'default'	=> true,
			),
			'image_id' => array( // tell user image is required with this theme
				'desc' => sprintf( __( 'Image cropped to <b>%s</b>. File size <b>under 150 KB</b> recommended.', 'jubilee' ), ctfw_image_size_dimensions( 'jubilee-square-large' ) ),
			),
		),
	) );

	// Sermons Widget
	add_theme_support( 'ctfw-widget-sermons', array(
		'fields' => array(
			'title',
			'topic',
			'book',
			'series',
			'speaker',
			'orderby',
			'order',
			'limit',
			'show_image',
			'show_date',
			'show_topic',
			'show_book',
			'show_series',
			'show_speaker',
			'show_media_types',
			'show_excerpt',
			'image_id',
		),
		'field_overrides' => array(
			'limit' => array(
				'default'	=> 3,
			),
			'image_id' => array( // tell user image is required with this theme
				'desc' => sprintf( __( 'Image cropped to <b>%s</b>. File size <b>under 150 KB</b> recommended.', 'jubilee' ), ctfw_image_size_dimensions( 'jubilee-square-large' ) ),
			),
		),
	) );

	// Events Widget
	add_theme_support( 'ctfw-widget-events', array(
		'fields' => array(
			'title',
			'timeframe',
			'category',
			'limit',
			'show_image',
			'show_date',
			'show_time',
			'show_category',
			'show_excerpt',
			'image_id',
		),
		'field_overrides' => array(
			'limit' => array(
				'default'	=> 3,
			),
			'show_time' => array(
				'default'	=> true // check the box by default
			),
			'image_id' => array( // tell user image is required with this theme
				'desc' => sprintf( __( 'Image cropped to <b>%s</b>. File size <b>under 150 KB</b> recommended.', 'jubilee' ), ctfw_image_size_dimensions( 'jubilee-square-large' ) ),
			),
		),
	) );

	// People Widget
	add_theme_support( 'ctfw-widget-people', array(
		'fields' => array(
			'title',
			'group',
			'orderby',
			'order',
			'limit',
			'show_image',
			'show_position',
			'show_phone',
			'show_email',
			'show_icons',
			'show_excerpt',
			'image_id',
		),
		'field_overrides' => array(
			'limit' => array(
				'default'	=> 3,
			),
			'show_phone' => array(
				'default'	=> false,
			),
			'image_id' => array( // tell user image is required with this theme
				'desc' => sprintf( __( 'Image cropped to <b>%s</b>. File size <b>under 30 KB</b> recommended.', 'jubilee' ), ctfw_image_size_dimensions( 'jubilee-square-large' ) ),
			),
		),
	) );

	// Locations Widget
	add_theme_support( 'ctfw-widget-locations', array(
		'fields' => array(
			'title',
			'orderby',
			'order',
			'limit',
			'show_image',
			'show_address',
			'show_phone',
			'show_email',
			'show_times',
			//'show_map',
		),
		'field_overrides' => array(
			'limit' => array(
				'default'	=> 3,
			),
		),
	) );

	// Categories Widget
	add_theme_support( 'ctfw-widget-categories', array(
		'fields' => array(
			'title',
			'taxonomy',
			'limit',
			'orderby',
			'order',
			'show_dropdown',
			'show_count',
			'show_hierarchy',
		),
		'field_overrides' => array(),
	) );

	// Archives Widget
	add_theme_support( 'ctfw-widget-archives', array(
		'fields' => array(
			'title',
			'post_type',
			'limit',
			'show_count',
			'show_dropdown',
		),
		// See jubilee_archive_widget_types() below for specifying which post types this theme supports archives for.
		// Don't use field_overrides here for that or translation will not work on the dropdowns.
	) );

	// Gallery Widget
	add_theme_support( 'ctfw-widget-gallery', array(
		'fields' => array(
			'title',
			'post_id', // post/page with gallery
			'orderby',
			'order',
			'limit',
			'thumb_size',
			'show_link',
		),
		'field_overrides' => array(
			'thumb_size' => array(
				'default'	=> 'small',
			),
			'limit' => array(
				'default'	=> 9,
			),
		),
	) );

	// Galleries Widget
	add_theme_support( 'ctfw-widget-galleries', array(
		'fields' => array(
			'title',
			'orderby',
			'order',
			'limit',
			'show_hierarchy',
		),
		'field_overrides' => array(),
	) );

	// Giving Widget
	add_theme_support( 'ctfw-widget-giving', array(
		'fields' => array(
			'title',
			'text',
			'button_text',
			'button_url',
			'image_id',
		),
		'field_overrides' => array(
			'image_id' => array( // tell user image is required with this theme
				'desc' => sprintf( __( 'Image cropped to <b>%s</b>. File size <b>under 200 KB</b> recommended.', 'jubilee' ), ctfw_image_size_dimensions( 'jubilee-square-large' ) ),
			),
		),
	) );

}

add_action( 'after_setup_theme', 'jubilee_add_theme_support_framework_widgets' );

/**
 * Remove CT Archive widget Type options
 *
 * Explicitly set post type options that this theme provides an archive for.
 * Not done with field_overrides because interferes with translation.
 *
 * @since 2.8.1
 * @param array $options Array of options from CTFW_Widget_Archives::ctfw_post_type_options().
 * @return array Modified array with limited options.
 */
function jubilee_archive_widget_types( $options ) {

	$types = array( 'post', 'ctc_sermon' ); // prevent events, locations, etc. from showing as options.

	foreach ( $options as $k => $v ) {
		if ( ! in_array( $k, $types ) ) {
			unset( $options[ $k ] );
		}
	}

	return apply_filters( 'jubilee_archive_widget_types', $options );

}

add_filter( 'ctfw_archives_widget_post_type_options', 'jubilee_archive_widget_types' );

