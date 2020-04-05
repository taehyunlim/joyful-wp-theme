<?php
/**
 * Section Widget Template
 *
 * Produces output for appropriate widget class in framework.
 * $this, $instance (sanitized field values) and $args are available.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Is this first of all widgets on homepage?
$is_first_widget = ctfw_is_first_widget(); // first widget in section

// Image
$image = wp_get_attachment_image_src( $instance['image_id'], 'jubilee-square-large' );
$image_url = ! empty( $image[0] ) ? $image[0] : '';

// No image if horizontal orientation.
if ( 'horizontal' === $instance['orientation'] ) {
	$image_url = '';
}

// Shapes.
$shapes = ctfw_customization( 'shapes' );

// Link buttons.
$links = $this->ctfw_links();

// Overlay class.
$overlay_class = '';
$underlay_class = '';
if ( $image_url ) {
	$overlay_class = jubilee_alternating_overlay_class();
	$underlay_class = $overlay_class;
}

// Heading tag
$heading_tag = 'h1';
if ( ! $is_first_widget ) {
	$heading_tag = 'h2';
}

?>

<section<?php

	$section_classes = array();

	// Main classes
	$section_classes[] = 'jubilee-home-section';
	$section_classes[] = 'jubilee-image-section';
	$section_classes[] = 'jubilee-custom-section';
	$section_classes[] = jubilee_image_section_class( $image_url );

	// Has image
	if ( $image_url ) {
		$section_classes[] = 'jubilee-image-section-has-image';
		$section_classes[] = jubilee_widget_image_side_class(); // alternate left/right
	} else {
		$section_classes[] = 'jubilee-image-section-no-image';
	}

	// Is first widget
	if ( $is_first_widget ) {
		$section_classes[] = 'jubilee-first-home-widget';
	}

	// Height
	$section_classes[] = 'jubilee-viewport-height-' . $instance['height'];

	// Title
	if ( $instance['title'] ) {
		$section_classes[] = 'jubilee-section-has-title';
	} else {
		$section_classes[] = 'jubilee-section-no-title';
	}

	// Content
	if ( $instance['content'] ) {
		$section_classes[] = 'jubilee-section-has-content';
	} else {
		$section_classes[] = 'jubilee-section-no-content';
	}

	// Links/Buttons
	if ( $links ) {
		$section_classes[] = 'jubilee-section-has-buttons';
	} else {
		$section_classes[] = 'jubilee-section-no-buttons';
	}

	// Image
	if ( $image_url ) {
		$section_classes[] = 'jubilee-section-has-image';
	} else {
		$section_classes[] = 'jubilee-section-no-image';
	}

	// Large Text
	// Vertical orientation only
	if ( 'large' === $instance['text_size'] && $instance['orientation'] !== 'horizontal' ) {
		$section_classes[] = 'jubilee-section-has-large-text';
	} else {
		$section_classes[] = 'jubilee-section-no-large-text';
	}

	// Centered
	if ( $instance['centered'] ) {
		$section_classes[] = 'jubilee-section-is-centered';
	} else {
		$section_classes[] = 'jubilee-section-not-centered';
	}

	// Orientation
	$section_classes[] = 'jubilee-section-orientation-' . $instance['orientation'];

	// Output classes
	if ( ! empty( $section_classes ) ) {
		echo ' class="' . esc_attr( implode( ' ', $section_classes ) ) . '"';
	}

?> <?php echo jubilee_homepage_section_id_attr(); ?>>

	<?php if ( $image_url ) : ?>
		<div class="jubilee-image-section-image jubilee-image-section-overlay <?php echo $overlay_class; ?>"></div>
		<div class="jubilee-image-section-image" style="<?php echo jubilee_colorization_style( $image_url ); ?>"></div>
	<?php endif; ?>

	<div class="jubilee-image-section-content jubilee-custom-section-inner jubilee-centered-large">

		<div class="jubilee-image-section-content-inner jubilee-custom-section-content">

			<?php if ( $instance['title'] ) : // title provided ?>

				<<?php echo $heading_tag; ?>>
					<?php echo wptexturize( force_balance_tags( $instance['title'] ) ); // HTML allowed for <mark> tag. ?>
				</<?php echo $heading_tag; ?>>

			<?php endif; ?>

			<?php if ( $instance['content'] ) : // content provided ?>

				<div class="jubilee-custom-section-text<?php if ( preg_match( '/^\".*/i', $instance['content'] ) ) : // starts with " ?> jubilee-custom-section-text-quote<?php endif; ?>">
					<?php echo do_shortcode( wpautop( wptexturize( force_balance_tags( $instance['content'] ) ) ) ); ?>
				</div>

			<?php endif; ?>

			<?php
			$i = 0;
			if ( $links ) :
			?>

				<div class="jubilee-custom-section-buttons">

					<ul class="jubilee-buttons-list<?php if ( $instance['orientation'] != 'horizontal' ) : ?> jubilee-buttons-list-large<?php endif; ?>">

						<?php foreach( $links as $link ) : $i++ ?>
							<li><a href="<?php echo esc_url( $link['url'] ); ?>" class="<?php if ( $i > 1 ) : ?>jubilee-button-secondary<?php endif; ?><?php if ( ! $image_url ) : ?> jubilee-button-no-hover-line<?php endif; ?>"><?php echo esc_html( $link['text'] ); ?></a></li>
						<?php endforeach; ?>

					</ul>

				</div>

			<?php endif; ?>

		</div>

	</div>

	<?php if ( 'horizontal' === $instance['orientation'] ) : ?>

		<svg class="jubilee-horizontal-section-shape jubilee-shape-organic<?php if ( 'organic' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1350.28 68.4" preserveAspectRatio="none">
			<path d="M1350.23,60.74C1258,24.74,1148,3.27,1015.15,3.27,792.41,3.27,610.18,68.4,357,68.4,188.21,68.4,0,53.75,0,53.75V0H1350.23"/>
		</svg>

		<svg class="jubilee-horizontal-section-shape-bottom jubilee-shape-organic<?php if ( 'organic' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1366 96" preserveAspectRatio="none">
			<path d="M0,96c253.8,0,480.3-53.6,613.1-53.6c222.7,0-179.8,0,73.3,0c168.8,0,348.1,26.8,348.1,26.8L1232.7,96H0"/>
		</svg>

		<svg class="jubilee-horizontal-section-shape jubilee-shape-angled<?php if ( 'angled' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon points="100 0 0 100 0 0 100 0"/>
		</svg>

	<?php endif; ?>

</section>
