<?php
/**
 * Highlight Widget Template
 *
 * Produces output for appropriate widget class in framework.
 * $this, $instance (sanitized field values) and $args are available.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// No before_widget / after_widget on homepage section
if ( ctfw_is_sidebar( 'ctcom-home' ) ) {
	$args['before_widget'] = '';
	$args['after_widget'] = '';
}

// Override before/after title
// This is because Homepage Section does not use before/after, but need it for Highlight widget styling
$args['before_title'] = '<h2 class="jubilee-widget-title">';
$args['after_title'] = '</h2>';

// Title
$title = apply_filters( 'widget_title', $instance['title'] );
if ( ! empty( $title ) ) {
	$title = $args['before_title'] . $title . $args['after_title'];
}

// Image
$image = wp_get_attachment_image_src( $instance['image_id'], 'jubilee-square' );
$image_url = ! empty( $image[0] ) ? $image[0] : '';

// Prepare styles for image overlay
$image_style            = '';
$image_brightness_style = '';
if ( $image_url ) {

	// Get settings.
	$image_brightness = ! empty( $instance['image_brightness'] ) ? $instance['image_brightness'] : ctfw_customization( 'header_image_brightness' );
	$image_opacity    = ! empty( $instance['image_opacity'] ) ? $instance['image_opacity'] : ( 100 - ctfw_customization( 'colorization' ) );
	$colorization     = 100 - $image_opacity;

	// Brightness
	$image_brightness_decimal = 1 - ( $image_brightness / 100 );
	$image_brightness_style   = "opacity: $image_brightness_decimal;";

	// Style.
	$image_style = jubilee_colorization_style( $image_url, $colorization );

}

// HTML Before
echo $args['before_widget'];

// Important that there is no whitespace between elements
?><div<?php

	$li_classes = array( 'jubilee-caption-image', 'jubilee-highlight' );

	// Has image?
	if ( $image_url ) {
		$li_classes[] = 'jubilee-caption-image-has-image';
	} else {
		$li_classes[] = 'jubilee-caption-image-no-image'; // main color if no image
	}

	// Is it linked?
	if ( $instance['click_url'] ) {
		$li_classes[] = 'jubilee-highlight-linked';
	}

	// Link opens in new window?
	if ( $instance['click_new'] ) {
		$li_classes[] = 'jubilee-highlight-click-new';
	}

	// Has title?
	if ( $instance['title'] ) {
		$li_classes[] = 'jubilee-highlight-has-title';
	} else {
		$li_classes[] = 'jubilee-highlight-no-title';
	}

	// Has description?
	if ( $instance['description'] ) {
		$li_classes[] = 'jubilee-highlight-has-description';
	} else {
		$li_classes[] = 'jubilee-highlight-no-description';
	}

	// Has title or description (caption)?
	if ( $instance['title'] || $instance['description'] ) {
		$li_classes[] = 'jubilee-highlight-has-caption';
	} else {
		$li_classes[] = 'jubilee-highlight-no-caption';
	}

	// First, second, etc. through four for organic shape variance.
	$GLOBALS['jubilee_highlight_n'] = isset( $GLOBALS['jubilee_highlight_n'] ) ? $GLOBALS['jubilee_highlight_n'] + 1 : 1; // start at 1.
	$GLOBALS['jubilee_highlight_n'] = $GLOBALS['jubilee_highlight_n'] <= 4 ? $GLOBALS['jubilee_highlight_n'] : 1; // restart at 1 after 4.
	$li_classes[] = 'jubilee-highlight-' . esc_attr( $GLOBALS['jubilee_highlight_n'] ) . 'n';

	// Add classes to div
	if ( ! empty( $li_classes ) ) {
		echo ' class="' . implode( ' ', $li_classes ). '"';
	}

	// Placeholder shape.
	$shapes = ctfw_customization( 'shapes' );

?>>

	<div class="jubilee-caption-image-inner jubilee-color-main-bg">

		<?php if ( $instance['click_url'] ) : ?>
			<a href="<?php echo esc_url( do_shortcode( $instance['click_url'] ) ); ?>"<?php if ( $instance['click_new'] ) : ?> target="_blank"<?php endif; ?>>
		<?php endif; ?>

			<?php if ( $image_url ) : // valid image specified ?>

				<div class="jubilee-caption-image-bg jubilee-hover-bg" style="<?php echo esc_attr( $image_style ); ?>"></div>

				<div class="jubilee-caption-image-brightness" style="<?php echo esc_attr( $image_brightness_style ); ?>"></div>

				<div class="jubilee-caption-image-gradient"></div>

			<?php endif; ?>

			<img class="jubilee-placeholder jubilee-placeholder-square<?php if ( $shapes === 'organic' ) : ?> jubilee-show-placeholder<?php endif; ?>" src="<?php echo apply_filters( 'jubilee_square_placeholder_url', CTFW_THEME_URL . '/images/square-placeholder.png' ); ?>" alt=""> <?php // use transparent placeholder thumbnail of proper proportion ?>
			<img class="jubilee-placeholder jubilee-placeholder-rect<?php if ( $shapes !== 'organic' ) : ?> jubilee-show-placeholder<?php endif; ?>" src="<?php echo apply_filters( 'jubilee_rect_placeholder_url', CTFW_THEME_URL . '/images/rect-placeholder.png' ); ?>" alt=""> <?php // use transparent placeholder thumbnail of proper proportion ?>

			<?php if ( $title || $instance['description'] ) : ?>
				<div class="jubilee-caption-image-caption">
			<?php endif; ?>

				<?php if ( $title ) : ?>
					<div class="jubilee-caption-image-title">
						<?php echo $title; ?>
					</div>
				<?php endif; ?>

				<?php if ( $instance['description'] ) : ?>
					<div class="jubilee-caption-image-description">
						<?php echo $instance['description']; ?>
					</div>
				<?php endif; ?>

			<?php if ( $title || $instance['description'] ) : ?>
				</div>
			<?php endif; ?>

		<?php if ( $instance['click_url'] ) : ?>
			</a>
		<?php endif; ?>

	</div>

</div><?php // Important that there is no whitespace between elements

// HTML After
echo $args['after_widget'];