<?php
/**
 * Footer Widget Area
 *
 * This shows three widgets at the bottom of every page.
 */

// Ouput container only if have widgets
if ( ! is_active_sidebar( 'ctcom-footer' ) ) {
	return;
}

// Background class (always secondary on subpages)
//$start_secondary = ctfw_is_page_template( 'homepage' ) ? false : true;
//$bg_class = jubilee_alternating_bg_class( 'contrast', $start_secondary );
$bg_class = jubilee_alternating_bg_class();

// Shapes.
$shapes = ctfw_customization( 'shapes' );

?>

<div id="jubilee-footer-widgets-row" class="jubilee-widgets-row <?php echo esc_attr( $bg_class ); ?>">

	<svg class="jubilee-footer-widgets-shape jubilee-shape-organic<?php if ( 'organic' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1350.28 68.4" preserveAspectRatio="none">
		<path d="M1350.23,60.74C1258,24.74,1148,3.27,1015.15,3.27,792.41,3.27,610.18,68.4,357,68.4,188.21,68.4,0,53.75,0,53.75V0H1350.23"/>
	</svg>

	<svg class="jubilee-footer-widgets-shape jubilee-shape-angled<?php if ( 'angled' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon points="100 0 0 100 0 0 100 0"/>
	</svg>

	<div class="jubilee-widgets-row-inner jubilee-centered-large">

		<div class="jubilee-widgets-row-content">

			<?php dynamic_sidebar( 'ctcom-footer' ); ?>

		</div>

	</div>

</div>
