<?php
/**
 * Giving Widget Template (Homepage)
 *
 * Produces output for appropriate widget class in framework.
 * $this, $instance (sanitized field values) and $args are available.
 * $GLOBALS['ctfw_current_widget'] can be used inside get_template_part();
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Is this first of all widgets on homepage?
$is_first_widget = ctfw_is_first_widget(); // first widget in section

// Title
$title = apply_filters( 'widget_title', $instance['title'] );

// Image
$image = wp_get_attachment_image_src( $instance['image_id'], 'jubilee-square-large' );
$image_url = ! empty( $image[0] ) ? $image[0] : '';

// Styles
$section_classes = array(
	'jubilee-image-section',
	'jubilee-home-section',
	jubilee_image_section_class( $image_url ),
);

	if ( $image_url ) {
		$section_classes[] = 'jubilee-image-section-has-image';
		$section_classes[] = jubilee_widget_image_side_class(); // alternate left/right
		$image_style = ' style="background-image: url(' . esc_url( $image_url ) . ');"';
	} else {
		$section_classes[] = 'jubilee-image-section-no-image';
	}

	// Is first widget
	if ( $is_first_widget ) {
		$section_classes[] = 'jubilee-first-home-widget';
	}

// Buttons
$button_url = $instance['button_url'] && 'http://' != $instance['button_url'] ? $instance['button_url'] : '';
$buttons = array();
if ( $button_url && $instance['button_text'] ) {
	$buttons[$instance['button_url']] = $instance['button_text'];
}

?>

<section class="<?php echo esc_attr( implode( ' ', $section_classes ) ); ?>" <?php echo jubilee_homepage_section_id_attr(); ?>>

	<?php if ( $image_url ) : ?>
		<div class="jubilee-image-section-image jubilee-image-section-overlay <?php echo jubilee_alternating_overlay_class(); ?>"></div>
		<div class="jubilee-image-section-image" style="<?php echo jubilee_colorization_style( $image_url ); ?>"></div>
	<?php endif; ?>

	<div class="jubilee-image-section-content jubilee-centered-large">

		<div class="jubilee-image-section-content-inner">

			<?php if ( $title ) : ?>
				<h2 class="jubilee-widget-title"><?php echo $title; ?></h2>
			<?php endif; ?>

			<?php if ( $instance['text'] ) : ?>

				<div class="jubilee-image-section-text">

					<?php echo wpautop( wptexturize( $instance['text'] ) ); ?>

				</div>

			<?php endif; ?>

			<?php if ( $buttons ) : ?>

				<div class="jubilee-image-section-buttons">

					<ul class="jubilee-buttons-list jubilee-buttons-list-large">

						<?php
						$button_i = 0;
						foreach ( $buttons as $button_url => $button_text ) : $button_i++;
						?>

							<li>
								<a href="<?php echo esc_url( $button_url ); ?>"<?php if ( $button_i > 1 ) : ?> class="jubilee-button-secondary jubilee-button-large"<?php endif; ?>>
									<?php echo esc_html( $button_text ); ?>
								</a>
							</li>

						<?php endforeach; ?>

					</ul>

				</div>

			<?php endif; ?>

		</div>

	</div>

</section>

<?php

// Reset post data
wp_reset_postdata();
