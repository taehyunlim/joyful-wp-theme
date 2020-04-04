<?php
/**
 * Locations Widget Template
 *
 * Produces output for appropriate widget class in framework.
 * $this, $instance (sanitized field values) and $args are available.
 *
 * $this->ctfw_get_posts() can be used to produce a query according to widget field values.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// HTML Before
echo $args['before_widget'];

// Title
$title = apply_filters( 'widget_title', $instance['title'] );
if ( ! empty( $title ) ) {
	echo $args['before_title'] . $title . $args['after_title'];
}

// Get posts
$posts = $this->ctfw_get_posts(); // widget's default query according to field values

// Loop Posts
foreach ( $posts as $post ) : setup_postdata( $post );

	// Get data
	// $address, $show_directions_link, $directions_url, $phone, $email, $times, $map_lat, $map_lng, $map_has_coordinates, $map_type, $map_zoom
	extract( ctfw_location_data() );

	// Show content
	$show_address = $instance['show_address'] && $address ? true : false;
	$show_phone = $instance['show_phone'] && $phone ? true : false;
	$show_email = $instance['show_email'] && $email ? true : false;
	$show_times = $instance['show_times'] && $times ? true : false;
	$show_meta = ( $show_address || $show_phone || $show_email || $show_times ) ? true : false;

	// Image and map?
	$img_and_map_class = '';
	if ( $instance['show_image'] && has_post_thumbnail() && $instance['show_map'] ) {
		$img_and_map_class = ' jubilee-location-compact-image-and-map';
	}

?>

	<article <?php jubilee_compact_post_classes( array(
		'classes'			=> 'jubilee-location-compact' . $img_and_map_class,
		'widget_instance'	=> $instance,
	) ); ?>>

		<div class="jubilee-entry-compact-header">

			<?php if ( $instance['show_image'] && has_post_thumbnail() ) : ?>

				<div class="jubilee-entry-compact-image jubilee-hover-image">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail( 'jubilee-rect-small' ); ?>
					</a>
				</div>

			<?php endif; ?>

			<div class="jubilee-entry-compact-right">

				<?php if ( ctfw_has_title() ) : ?>

					<h3>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h3>

				<?php endif; ?>

				<?php if ( $show_meta ) : ?>

					<ul class="jubilee-entry-meta jubilee-entry-compact-meta">

						<?php if ( $show_address ) : ?>
							<li class="jubilee-location-compact-address">
								<?php echo wptexturize( ctfw_address_one_line( $address ) ); ?>
							</li>
						<?php endif; ?>

						<?php if ( $show_phone ) : ?>
							<li class="jubilee-location-compact-phone">
								<?php echo esc_html( wptexturize( $phone ) ); ?>
							</li>
						<?php endif; ?>

						<?php if ( $show_email ) : ?>
							<li class="jubilee-location-compact-email">
								<?php echo ctfw_email( $email ); // link with using antispambot() and breaking before @ ?>
							</li>
						<?php endif; ?>

						<?php if ( $show_times ) : ?>
							<li class="jubilee-locations-widget-entry-times">
								<?php echo wptexturize( ctfw_one_line( $times ) ); ?>
							</li>
						<?php endif; ?>

					</ul>

				<?php endif; ?>

			</div>

		</div>

	</article>

<?php

// End Loop
endforeach;

// Reset post data
wp_reset_postdata();

// No items found
if ( empty( $posts ) ) {

	?>
	<div>
		<?php _ex( 'There are no locations to show.', 'locations widget', 'jubilee' ); ?>
	</div>
	<?php

}

// HTML After
echo $args['after_widget'];