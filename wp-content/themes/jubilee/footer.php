<?php
/**
 * Theme Footer
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Footer icons
$footer_icons = jubilee_social_icons( ctfw_customization( 'icon_urls' ), 'return' );

// Get first location post
$location = ctfw_first_ordered_post( 'ctc_location' );

// Get locations data, if showing location
$location_count = 0;
$locations_page = ctfw_get_page_by_template( 'locations.php' );
if ( ctfw_customization( 'show_footer_location' ) && ! empty( $location['ID'] ) ) {

	// Meta data for page
	extract( ctfw_location_data( $location['ID'] ) );

	// Get Locations page and count
	$location_counts = wp_count_posts( 'ctc_location' );
	$location_count = isset( $location_counts->publish ) ? $location_counts->publish : 0;

}

// Showing a map?
$has_map = false;
if ( ! empty( $map_lat ) && ! empty( $map_lng ) && ! empty( $address ) && empty( $GLOBALS['jubilee_top_map_shown'] ) && ctfw_customization( 'show_footer_location' ) ) {
	$has_map = true;
}

// Notice / Copyright
$footer_notice = ctfw_customization( 'footer_notice' );

// Footer menu
$footer_menu = wp_nav_menu( array(
	'theme_location'	=> 'footer',
	'menu_id'			=> 'jubilee-footer-menu-content',
	'menu_class'		=> '',
	'depth'				=> 2, // no more than 1 sub menu
	'container'			=> false, // don't wrap in div
	'fallback_cb'		=> false, // don't show pages if no menu found; show nothing
	'echo'				=> false // return instead
) );

// Shapes.
$shapes = ctfw_customization( 'shapes' );
$show_bottom_shapes = false;
if ( $shapes && ! $has_map ) {
	$show_bottom_shapes = true;
}

// Classes
$classes = array();

	// Location
	if ( $location_count ) {
		$classes[] = 'jubilee-footer-has-location';
	} else {
		$classes[] = 'jubilee-footer-no-location';
	}

	// Location Map
	if ( $has_map ) {
		$classes[] = 'jubilee-footer-has-map';
	} else {
		$classes[] = 'jubilee-footer-no-map';
	}

	// Social Icons
	if ( $footer_icons ) {
		$classes[] = 'jubilee-footer-has-icons';
	} else {
		$classes[] = 'jubilee-footer-no-icons';
	}

	// Notice
	if ( $footer_notice ) {
		$classes[] = 'jubilee-footer-has-notice';
	} else {
		$classes[] = 'jubilee-footer-no-notice';
	}

	// Footer Menu
	if ( $footer_menu ) {
		$classes[] = 'jubilee-footer-has-menu';
	} else {
		$classes[] = 'jubilee-footer-no-menu';
	}

	// Footer Menu has submenu(s)
	if ( preg_match( '/class="sub-menu"/', $footer_menu ) ) {
		$classes[] = 'jubilee-footer-has-submenu';
	} else {
		$classes[] = 'jubilee-footer-no-submenu';
	}

	// Has widgets
	if ( is_active_sidebar( 'ctcom-footer' ) ) {
		$classes[] = 'jubilee-footer-has-widgets';
	} else {
		$classes[] = 'jubilee-footer-no-widgets';
	}

	// Has widget row shapes.
	if ( $shapes && $shapes !== 'square' ) {
		$classes[] = 'jubilee-footer-widgets-has-shape';
	} else {
		$classes[] = 'jubilee-footer-widgets-no-shape';
	}

	// Has bottom shapes.
	if ( $show_bottom_shapes ) {
		$classes[] = 'jubilee-footer-bottom-has-shape';
	} else {
		$classes[] = 'jubilee-footer-bottom-no-shape';
	}

	$classes = implode( ' ', $classes );
	if ( $classes ) {
		$class_attr = ' class="' . esc_attr( $classes ) . '"';
	}

?>

<footer id="jubilee-footer"<?php echo $class_attr; ?>>

	<?php get_sidebar( 'footer' ); ?>

	<?php
	// Load map section (also used on homepage)
	get_template_part( CTFW_THEME_PARTIAL_DIR . '/map-section' );
	?>

	<?php if ( $footer_icons || $footer_notice || $footer_menu ) : ?>

		<div id="jubilee-footer-bottom" class="jubilee-color-main-bg">

			<?php if ( $show_bottom_shapes ) : ?>

				<svg class="jubilee-footer-bottom-shape jubilee-shape-organic<?php if ( 'organic' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1350.28 68.4" preserveAspectRatio="none">
					<path d="M1350.23,60.74C1258,24.74,1148,3.27,1015.15,3.27,792.41,3.27,610.18,68.4,357,68.4,188.21,68.4,0,53.75,0,53.75V0H1350.23"/>
					<!--<path d="M0,0H1350.23V53.75S1162,68.4,993.23,68.4C740.05,68.4,557.82,3.27,335.08,3.27,202.27,3.27,92.23,24.74,0,60.74"/>-->
				</svg>

				<svg class="jubilee-footer-bottom-shape jubilee-shape-angled<?php if ( 'angled' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
					<polygon points="100 0 0 100 0 0 100 0"/>
				</svg>

			<?php endif; ?>

			<div id="jubilee-footer-bottom-inner" class="jubilee-centered-large">

				<?php if ( $footer_icons ) : ?>

					<div id="jubilee-footer-icons">
						<?php echo $footer_icons; ?>
					</div>

				<?php endif; ?>

				<?php if ( $footer_menu ) : ?>

					<nav id="jubilee-footer-menu">
						<?php echo $footer_menu; ?>
					</nav>

				<?php endif; ?>

				<?php if ( $footer_notice ) : ?>

					<div id="jubilee-footer-notice">
						<?php echo nl2br( wptexturize( do_shortcode( $footer_notice ) ) ); ?>
					</div>

				<?php endif; ?>

			</div>

		</div>

	<?php endif; ?>

</footer>

<?php
// Show latest events, comments link, etc. fixed to bottom of screen
get_template_part( CTFW_THEME_PARTIAL_DIR . '/footer-sticky' );
?>

<?php
wp_footer(); // a hook for extra code in the footer, if needed
?>

</body>
</html>