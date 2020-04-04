<?php
/**
 * Sermons Widget Template (Homepage)
 *
 * Produces output for appropriate widget class in framework.
 * $this, $instance (sanitized field values) and $args are available.
 * $GLOBALS['ctfw_current_widget'] can be used inside get_template_part();
 *
 * $this->ctfw_get_posts() can be used to produce a query according to widget field values.
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
		$columns = 'one'; // make space for image
	} else {
		$section_classes[] = 'jubilee-image-section-no-image';
		$columns = 'two'; // full-width if no image
	}

	// Is first widget
	if ( $is_first_widget ) {
		$section_classes[] = 'jubilee-first-home-widget';
	}

// Get posts
$posts = $this->ctfw_get_posts( $instance ); // widget's default query according to field values
$count = count( $posts );

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

			<?php if ( $posts ) : ?>

				<div class="jubilee-loop-entries jubilee-loop-<?php echo esc_attr( $columns ); ?>-columns<?php if ( $count > 2 ) : ?> jubilee-entries-more-than-two<?php endif; ?> jubilee-clearfix">

					<?php
					foreach ( $posts as $post ) {

						setup_postdata( $post );

						get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-sermon-short' );

					}
					?>

				</div>

				<?php
				// Buttons for sermon archives
				get_template_part( CTFW_THEME_PARTIAL_DIR . '/sermon-archive-buttons' );
				?>

			<?php else : ?>

				<p>
					<?php
					echo esc_html( sprintf(
						/* translators: $1$s is "sermons" (lowercase), possibly translated or changed by settings */
						_x( 'There are no %1$s to show.', 'sermons widget', 'jubilee' ),
						strtolower( ctfw_sermon_word_plural() )
					) );
					?>
				</p>

			<?php endif; ?>

		</div>

	</div>

</section>

<?php

// Reset post data.
wp_reset_postdata();
