<?php
/**
 * Events Widget Template (Homepage)
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

	// Is first widget
	if ( $is_first_widget ) {
		$section_classes[] = 'jubilee-first-home-widget';
	}

// Column settings
if ( $image_url ) {
	$section_classes[] = 'jubilee-image-section-has-image';
	$section_classes[] = jubilee_widget_image_side_class(); // alternate left/right
	$columns = 'one'; // make space for image
	$instance['limit'] = 2;
} else {
	$section_classes[] = 'jubilee-image-section-no-image';
	$columns = 'two'; // full-width if no image
	$instance['limit'] = 4;
}

// Get posts
$instance['timeframe'] = 'upcoming'; // setting hidden when used on homepage
$posts = ctfw_get_events( $instance ); // get events based on options - upcoming/past, limit, etc.
$count = count( $posts );

// Buttons
$buttons = array();

	// Events page
	$events_url = ctfw_post_type_archive_url( 'ctc_event' ); // calendar first, upcoming events otherwise, default archive if neither
	if ( $events_url ) {
		$post_type_obj = get_post_type_object( 'ctc_event' );
		$buttons[ $events_url ] = sprintf(
			/* translators: %1$s is 'Events' post type name */
			_x( 'More %1$s', 'homepage events button', 'jubilee' ),
			$post_type_obj->labels->name
		);
	}

	// Categories
	$categories = get_terms( 'ctc_event_category' );
	$categories = array_slice( $categories, 0, 3 ); // maximum; there's only so much space
	foreach ( $categories as $category ) {
		$category_url = get_term_link( $category, 'ctc_event_category' );
		$buttons[ $category_url ] = $category->name;
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

			<?php if ( $posts ) : ?>

				<div class="jubilee-loop-entries jubilee-loop-<?php echo esc_attr( $columns ); ?>-columns<?php if ( $count > 2 ) : ?> jubilee-entries-more-than-two<?php endif; ?> jubilee-clearfix">

					<?php
					foreach ( $posts as $post ) {

						setup_postdata( $post );

						get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-event-short' );

					}
					?>

				</div>

				<?php if ( $buttons ) : ?>

					<div class="jubilee-image-section-buttons">

						<ul class="jubilee-buttons-list">

							<?php
							$button_i = 0;
							foreach ( $buttons as $button_url => $button_text ) : $button_i++;
							?>

								<li>
									<a href="<?php echo esc_url( $button_url ); ?>"<?php if ( $button_i > 1 ) : ?> class="jubilee-button-secondary"<?php endif; ?>>
										<?php echo esc_html( $button_text ); ?>
									</a>
								</li>

							<?php endforeach; ?>

						</ul>

					</div>

				<?php endif; ?>

			<?php else : ?>

				<p>
					<?php echo esc_html( _x( 'There are no events to show.', 'events widget', 'jubilee' ) ); ?>
				</p>

			<?php endif; ?>

		</div>

	</div>

</section>

<?php

// Reset post data.
wp_reset_postdata();
