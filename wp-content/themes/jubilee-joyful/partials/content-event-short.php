<?php
/**
 * Short Event Content (Archive)
 *
 * This is also used in calendar when hovering or viewing on mobile as list.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Get data
// $date (localized range), $start_date, $end_date, $start_time, $end_time, $start_time_formatted, $end_time_formatted, $hide_time_range, $time (description), $time_range, $time_range_and_description, $time_range_or_description, $venue, $address, $show_directions_link, $directions_url, $map_lat, $map_lng, $map_has_coordinates, $map_type, $map_zoom, $registration_url
// Recurrence fields, $recurrence_note and $recurrence_note_short are also provided as well as $excluded_dates_note (Pro).
extract( ctfw_event_data( array(
	'abbreviate_month' => true, // abbreviate month (use Dec instead of December by replacing F with M in date_format setting)
) ) );

// Less meta if using widget on homepage
if ( ctfw_is_sidebar( 'ctcom-home' ) ) {
	$recurrence_note_short = '';
}

?>

<article data-event-id="<?php echo the_ID(); ?>" id="post-<?php the_ID(); ?>" <?php jubilee_short_post_classes( 'jubilee-event-short' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="jubilee-entry-short-image jubilee-hover-image">

			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>

		</div>

	<?php else : ?>

		<div class="jubilee-entry-short-image jubilee-entry-short-image-placeholder">
			<img src="<?php echo apply_filters( 'jubilee_rect_placeholder_url', CTFW_THEME_URL . '/images/rect-placeholder.png' ); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
		</div>

	<?php endif; ?>

	<div class="jubilee-entry-short-inner">

		<header class="jubilee-entry-short-header">

			<?php if ( ctfw_has_title() ) : ?>

				<h2 class="jubilee-entry-short-title">
					<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute( array( 'echo' => false ) ); ?>"><?php the_title(); ?></a>
				</h2>

			<?php endif; ?>

			<?php //if ( $show_meta ) : ?>

				<ul class="jubilee-entry-meta jubilee-entry-short-meta">

					<?php if ( $date ) : ?>

						<li class="jubilee-entry-short-date">

							<time class="jubilee-entry-short-label" datetime="<?php echo esc_attr( date_i18n( 'Y-m-d', strtotime( $start_date ) ) ); ?>">
								<?php echo esc_html( $date ); ?>
							</time>

						</li>

					<?php endif; ?>

					<?php if ( $time_range_or_description ) : ?>

						<li class="jubilee-event-short-time">
							<?php echo wptexturize( $time_range_or_description ); ?>
						</li>

					<?php endif; ?>

				</ul>

			<?php //endif; ?>

		</header>

		<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-excerpt' ); // show excerpt if no image ?>

	</div>

</article>
