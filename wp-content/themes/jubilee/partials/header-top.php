<?php
/**
 * Header Top
 *
 * Outputs logo and menu / search.
 *
 * This is loaded by header.php.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Search icon?
$search_icon = ctfw_customization( 'header_search' );

// Shapes.
$shapes = ctfw_customization( 'shapes' );

// Classes
$classes = array();

	// Search
	if ( $search_icon ) {
		$classes[] = 'jubilee-header-has-search';
	} else {
		$classes[] = 'jubilee-header-no-search';
	}

	// Class attribute
	$classes = implode( ' ', $classes );
	$class_attr = '';
	if ( $classes ) {
		$class_attr = ' class="' . esc_attr( $classes ) . '"';
	}

?>

<div id="jubilee-header-top"<?php echo $class_attr; ?>>

	<div>

		<div id="jubilee-header-top-bg">

			<svg class="jubilee-top-shape jubilee-shape-organic<?php if ( 'organic' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1350.28 68.4" preserveAspectRatio="none">
				<path d="M0,7.62c92.23,36,202.27,57.47,335.08,57.47C557.82,65.09,748,0,1001.13,0c168.79,0,349.1,47,349.1,47V68.36H0"/>
			</svg>

			<svg class="jubilee-top-shape jubilee-shape-angled<?php if ( 'angled' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
				<polygon points="0,100 100,0 100,100"/>
			</svg>

		</div>

		<div id="jubilee-header-top-container" class="jubilee-centered-large">

			<div id="jubilee-header-top-inner">

				<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/header-logo' ); ?>

				<nav id="jubilee-header-menu">

					<div id="jubilee-header-menu-inner">

						<?php
						wp_nav_menu( array(
							'theme_location'	=> 'header',
							'menu_id'			=> 'jubilee-header-menu-content',
							'menu_class'		=> 'sf-menu',
							'depth'				=> 3, // no more than 2 sub menus or risks running of screen either side
							'container'			=> false, // don't wrap in div
							'fallback_cb'		=> false, // don't show pages if no menu found - show nothing
							//'walker'			=> new CTFW_Walker_Nav_Menu_Description

						) );
						?>

					</div>

				</nav>

				<?php if ( $search_icon ) : ?>

					<div id="jubilee-header-search" role="search">

						<div id="jubilee-header-search-opened">

							<?php get_search_form(); ?>

							<a href="#" id="jubilee-header-search-close" class="<?php jubilee_icon_class( 'search-cancel' ); ?>"></a>

						</div>

						<div id="jubilee-header-search-closed">
							<a href="#" id="jubilee-header-search-open" class="<?php jubilee_icon_class( 'search-button' ); ?>"></a>
						</div>

					</div>

				<?php endif; ?>

				<div id="jubilee-header-mobile-menu"></div>

			</div>

		</div>

	</div>

</div>