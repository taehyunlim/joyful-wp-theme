<?php
/**
 * Widget Functions
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

/**************************************
 * HOMEPAGE WIDGETS
 **************************************/

/**
 * Wrap consecutive multiple Highlight or Secondary widgets in container on homepage.
 *
 * This is to allow them to show consecutively in a row as a section.
 *
 * @since  1.0
 * @param  array $widget Widget data.
 */
function jubilee_home_multiple_widget_section( $widget ) {

	global $jubilee_prev_home_widget_is_highlight, $jubilee_prev_home_widget_is_secondary;

	// Frontend only.
	// dynamic_sidebar runs in admin area too.
	if ( is_admin() ) {
		return;
	}

	// Clear out data when in other widget area
	// Otherwise, the container will occur in footer, etc.
	if ( ! ctfw_is_sidebar( 'ctcom-home' ) ) {

		// Highlights.
		if ( isset( $jubilee_prev_home_widget_is_highlight ) ) {
			unset( $jubilee_prev_home_widget_is_highlight );
		}

		// Secondary Widgets.
		if ( isset( $jubilee_prev_home_widget_is_secondary ) ) {
			unset( $jubilee_prev_home_widget_is_secondary );
		}

		// Prevent output.
		return;

	}

	// Is this a highlight widget?
	$is_highlight = isset( $widget['classname'] ) && 'widget_ctfw-highlight' === $widget['classname'] ? true : false;

	// Is this a secondary widget (not one of the primary widgets)?
	$primary_widgets = array(
		'widget_ctfw-section',
		'widget_ctfw-highlight',
		'widget_ctfw-posts',
		'widget_ctfw-sermons',
		'widget_ctfw-events',
		'widget_ctfw-locations',
		'widget_ctfw-people',
		'widget_ctfw-gallery',
		'widget_ctfw-giving',
	);
	$is_secondary = isset( $widget['classname'] ) && ! in_array( $widget['classname'], $primary_widgets, true ) ? true : false;

	// Close container if was opened.
	$highlight_closing_tags = '</div></section>';
	$secondary_closing_tags = '</div></div></section>';

		// Previous widget was CT Highlight but this is not, so we end the row.
		if ( ! empty( $jubilee_prev_home_widget_is_highlight ) && ! $is_highlight ) {
			echo $highlight_closing_tags;
		}

		// Previous widget was Secondary but this is not, so we end the row.
		if ( ! empty( $jubilee_prev_home_widget_is_secondary ) && ! $is_secondary ) {
			echo $secondary_closing_tags;
		}

	// Open container.

		// Highlights.
		// Previous widget was not Highlight but this is, so we start the row.
		if ( empty( $jubilee_prev_home_widget_is_highlight ) && $is_highlight ) {
			echo '<section class="jubilee-home-highlights-section jubilee-home-section" ' . jubilee_homepage_section_id_attr() . '>';
			echo '	<div class="jubilee-highlights-content jubilee-highlights-three-columns">';
		}

		// Secondary Widgets.
		// Previous widget was not Secondary but this is, so we start the row.
		if ( empty( $jubilee_prev_home_widget_is_secondary ) && $is_secondary ) {
			echo '<section class="jubilee-home-secondary-widgets-section jubilee-home-section jubilee-widgets-row" ' . jubilee_homepage_section_id_attr() . '">'; // contrast for widgets having white entry boxes.
			echo '	<div class="jubilee-widgets-row-inner jubilee-centered-large">';
			echo '		<div class="jubilee-widgets-row-content">';
		}

	// Check if widget is final widget on homepage, then close the container.
	// Must be done this way because there is no following widget to add close before like above.

		// Highlights.
		if ( $is_highlight ) {
			jubilee_close_final_home_multiple_section( $widget, $highlight_closing_tags ); // sets $jubilee_close_final_home_multiple_section global for sidebar-home.php.
		}

		// Secondary Widgets.
		if( $is_secondary ) {
			jubilee_close_final_home_multiple_section( $widget, $secondary_closing_tags ); // sets $jubilee_close_final_home_multiple_section global for sidebar-home.php.
		}

	// Record what this widget is, to be used as "last widget" on next widget.
	$jubilee_prev_home_widget_is_highlight = $is_highlight;
	$jubilee_prev_home_widget_is_secondary = $is_secondary;

}

add_action( 'dynamic_sidebar', 'jubilee_home_multiple_widget_section' );

/**
 * Wrap secondary widgets in container on homepage
 *
 * Most widgets are designed narrow, so this allows consecutive secondary widgets to be shown
 * on the homepage in narrow columns, similar to how they would appear in footer or sidebar.
 *
 * Every widget THAT IS NOT listed below as a primary widget is considred secondary on homepage.
 *
 * - CT Section
 * - CT Highlight
 * - CT Posts
 * - CT Sermons
 * - CT Events
 * - CT Locations
 * - CT People
 * - CT Gallery
 * - CT Giving
 *
 * @since  1.0
 * @param  array $widget Widget data
 */
function jubilee_home_secondary_widgets_section( $widget ) {

	global $jubilee_prev_home_widget_is_secondary;

	// Frontend only
	// dynamic_sidebar runs in admin area too
	if ( is_admin() ) {
		return;
	}

	// In homepage widget area only
	// Otherwise, the container will occur in footer, etc.
	if ( ! ctfw_is_sidebar( 'ctcom-home' ) ) {

		// Clear out data when in other widget area
		if ( isset( $jubilee_prev_home_widget_is_secondary ) ) {
			unset( $jubilee_prev_home_widget_is_secondary );
		}

		// Prevent output
		return;

	}

	// Is this a secondary widget (not one of the primary widgets)?
	$primary_widgets = array(
		'widget_ctfw-section',
		'widget_ctfw-highlight',
		'widget_ctfw-posts',
		'widget_ctfw-sermons',
		'widget_ctfw-events',
		'widget_ctfw-locations',
		'widget_ctfw-people',
		'widget_ctfw-gallery',
		'widget_ctfw-giving',
	);
	$is_secondary = isset( $widget['classname'] ) && ! in_array( $widget['classname'], $primary_widgets ) ? true : false;

	// Open container
	// Previous widget was not secondary but this is, so we start the row
	$closing_tags = '</div></div></section>';
	if ( empty( $jubilee_prev_home_widget_is_secondary ) && $is_secondary ) {
		echo '<section class="jubilee-home-secondary-widgets-section jubilee-home-section jubilee-widgets-row" ' . jubilee_homepage_section_id_attr() . '>'; // contrast for widgets having white entry boxes
		echo '	<div class="jubilee-widgets-row-inner jubilee-centered-large">';
		echo '		<div class="jubilee-widgets-row-content">';
	}

	// Close container if was opened.
	// Previous widget was secondary but this is not, so we end the row.
	elseif ( ! empty( $jubilee_prev_home_widget_is_secondary ) && ! $is_secondary ) {
		echo $closing_tags;
	}

	// Check if widget is final widget on homepage, then close the container.
	// Must be done this way because there is no following widget to add close before like above.
	if( $is_secondary ) {
		jubilee_close_final_home_multiple_section( $widget, $closing_tags ); // sets $jubilee_close_final_home_multiple_section global for sidebar-home.php.
	}

	// Record what this widget is, to be used as "last widget" on next widget
	$jubilee_prev_home_widget_is_secondary = $is_secondary;

}

//add_action( 'dynamic_sidebar', 'jubilee_home_secondary_widgets_section' );

/**
 * Close final home multiple widget section.
 *
 * Check if widget is final widget on homepage, then close the container.
 * Must be done this way because there is no following widget to add close before like above.
 *
 * This applies to Highlight widget sections and Secondary Widget sections. Used by
 * jubilee_home_secondary_widgets_section() and jubilee_home_highlight_widget_section().
 *
 * Tells sidebar-home.php to close the section at bottom of homepage widget area.
 *
 * @since 1.2
 * @global string $jubilee_close_final_home_multiple_section Set closing tags if is last widget on homepage.
 * @param array $widget Current widget being displayed.
 * @param string $closing_tags Closing tags to output.
 */
function jubilee_close_final_home_multiple_section( $widget, $closing_tags ) {

	global $jubilee_close_final_home_multiple_section;

	// Get ID of final widget in homepage section.
	$sidebars_widgets = wp_get_sidebars_widgets();
	$final_widget_id = isset( $sidebars_widgets['ctcom-home'] ) ? end( $sidebars_widgets['ctcom-home'] ) : '';

	// If this widget's ID matches final widget's ID in homepage section, close the container.
	// sidebar-home.php uses this global to close the container with same code as above.
	$jubilee_close_final_home_multiple_section = '';
	if ( $widget['id'] === $final_widget_id ) {
		$jubilee_close_final_home_multiple_section = $closing_tags;
	}

}

/**
 * Force settings for Gallery widget on homepage
 *
 * @since 1.0
 * @param array $args Arguments in framework CT Gallery widget's ctfw_get_posts() method
 */
function jubilee_home_gallery_widget_args( $args ) {

	// Homepage widget area only
	if ( ! ctfw_is_sidebar( 'ctcom-home' ) ) {
		return $args;
	}

	// Force certain settings
	// These are hidden in admin area, for homepage widget area only
	$args['posts_per_page'] = 5; // limit
	$args['orderby'] = 'publish_date';
	$args['order'] = 'desc';

	return $args;

}

add_filter( 'ctfw_widget_gallery_get_posts_args', 'jubilee_home_gallery_widget_args' );

/**
 * Force settings for Posts widget on homepage
 *
 * @since 1.0
 * @param array $args Arguments in framework widget's ctfw_get_posts() method
 */
function jubilee_home_posts_widget_args( $args, $instance ) {

	// Homepage widget area only
	if ( ! ctfw_is_sidebar( 'ctcom-home' ) ) {
		return $args;
	}

	// Limit depends on whether or not image is shown
	$image = wp_get_attachment_image_src( $instance['image_id'] );
	$limit = empty( $image[0] ) ? 4 : 2;

	// Force certain settings
	// These are hidden in admin area, for homepage widget area only
	$args['numberposts'] = $limit; // limit
	$args['orderby'] = 'publish_date';
	$args['order'] = 'desc';

	return $args;

}

add_filter( 'ctfw_widget_posts_get_posts_args', 'jubilee_home_posts_widget_args', 10, 2 );

/**
 * Force settings for Sermons widget on homepage
 *
 * @since 1.0
 * @param array $args Arguments in framework widget's ctfw_get_posts() method
 */
function jubilee_home_sermons_widget_args( $args, $instance ) {

	// Homepage widget area only
	if ( ! ctfw_is_sidebar( 'ctcom-home' ) ) {
		return $args;
	}

	// Limit depends on whether or not image is shown
	$image = wp_get_attachment_image_src( $instance['image_id'] );
	$limit = empty( $image[0] ) ? 4 : 2;

	// Force certain settings
	// These are hidden in admin area, for homepage widget area only
	$args['numberposts'] = $limit; // limit
	$args['orderby'] = 'publish_date';
	$args['order'] = 'desc';

	return $args;

}

add_filter( 'ctfw_widget_sermons_get_posts_args', 'jubilee_home_sermons_widget_args', 10, 2 );

/**
 * Force settings for People widget on homepage
 *
 * @since 1.0
 * @param array $args Arguments in framework widget's ctfw_get_posts() method
 */
function jubilee_home_people_widget_args( $args, $instance ) {

	// Homepage widget area only
	if ( ! ctfw_is_sidebar( 'ctcom-home' ) ) {
		return $args;
	}

	// Limit depends on whether or not image is shown
	$image = wp_get_attachment_image_src( $instance['image_id'] );
	$limit = empty( $image[0] ) ? 4 : 2;

	// Force certain settings
	// These are hidden in admin area, for homepage widget area only
	$args['numberposts'] = $limit; // limit
	$args['orderby'] = 'menu_order';
	$args['order'] = 'asc';

	return $args;

}

add_filter( 'ctfw_widget_people_get_posts_args', 'jubilee_home_people_widget_args', 10, 2 );

/**
 * Class for homepage widget to show image on left/right
 *
 * Left and right alternate based on the prior widget's position.
 *
 * @since  1.0
 * @global string $jubilee_widget_image_position Prior widget's image position
 * @return string Class for left or right positioning
 */
function jubilee_widget_image_side_class() {

	global $jubilee_widget_image_position; // to retrieve prior widget's image position

	// If last instance's image was left, show on right
	if ( empty( $jubilee_widget_image_position ) || 'left' == $jubilee_widget_image_position ) {
		$jubilee_widget_image_position = 'right';
	}

	// If this is first instance or last was shown on right, show this on left
	else {
		$jubilee_widget_image_position = 'left';
	}

	// Form the class
	$class = 'jubilee-image-section-image-' . $jubilee_widget_image_position;

	// Return filtered
	return apply_filters( 'jubilee_widget_image_side_class', $class );

}

/**
 * Alternating section image class (even and odd)
 * *
 * @since 1.0
 * @global array $jubilee_image_section_data Details on last class returned
 * @param string $image_url Effect only if section has image.
 * @return string Class name
 */
function jubilee_image_section_class( $image_url ) {

	global $jubilee_image_section_data; // to retrieve prior widget's data

	$class = '';

	// Has image?
	if ( $image_url ) {

		if ( ! isset ( $jubilee_image_section_data['alternate'] ) || 'even' === $jubilee_image_section_data['alternate'] ) {
			$alternate = 'odd';
		} else {
			$alternate = 'even';
		}

		// Build class.
		$class = 'jubilee-section-image-' . $alternate;

		// Store current data in global for next use
		$jubilee_image_section_data = array(
			'alternate' => $alternate,
		);

	}

	// Return filtered
	return apply_filters( 'jubilee_image_section_class', $class, $image_url );

}
