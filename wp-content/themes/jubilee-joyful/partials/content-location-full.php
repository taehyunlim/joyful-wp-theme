<?php
/**
 * Full Location Content (Single)
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Get data
// $address, $show_directions_link, $directions_url, $phone, $email, $times, $map_lat, $map_lng, $map_has_coordinates, $map_type, $map_zoom
extract( ctfw_location_data() );

// Classes
$classes = '';

// Show meta
// Not showing when have map coordinates because same details are shown in box by map already
if ( ! $map_has_coordinates && ( $address || $times || $phone || $email || $directions_url ) ) {
	$show_meta = true;
	$classes = 'jubilee-entry-has-meta';
} else {
	$show_meta = false;
	$classes = 'jubilee-entry-no-meta';
}

// Has buttons?
if ( $directions_url ) {
	$classes .= ' jubilee-entry-meta-has-buttons';
} else {
	$classes .= ' jubilee-entry-meta-no-buttons';
}

// Has content?
if ( ctfw_has_content() ) {
	$classes .= ' jubilee-entry-has-content';
} else {
	$classes .= ' jubilee-entry-no-content';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'jubilee-entry-full jubilee-location-full ' . $classes ); ?>>

	<?php
	// Load map section (also used on homepage and footer)
	get_template_part( CTFW_THEME_PARTIAL_DIR . '/map-section' );
	?>

	<header class="jubilee-entry-full-header">

		<?php
		// This is visible only to screenreaders.
		// Page title is shown in banner. This is for proper HTML5 and Outline
		if ( ctfw_has_title() ) :
		?>

			<h1 id="jubilee-main-title">
				<?php jubilee_title_paged(); ?>
			</h1>

		<?php endif; ?>

		<?php if ( $show_meta ) : ?>

			<ul class="jubilee-entry-meta jubilee-entry-full-meta">

				<?php if ( $address ) : ?>

					<li id="jubilee-location-address">
						<?php echo nl2br( esc_html( wptexturize( $address ) ) ); ?>
					</li>

				<?php endif; ?>

				<?php if ( $times ) : ?>

					<li id="jubilee-location-time">
						<div class="jubilee-dark"><?php echo nl2br( esc_html( wptexturize( $times ) ) ); ?></div>
					</li>

				<?php endif; ?>

				<?php if ( $phone ) : ?>

					<li id="jubilee-location-phone">
						<div class="jubilee-dark"><?php echo esc_html( wptexturize( $phone ) ); ?></div>
					</li>

				<?php endif; ?>

				<?php if ( $email ) : ?>

					<li id="jubilee-location-email">
						<?php echo ctfw_email( $email ); // link with using antispambot() and breaking before @ ?>
					</li>

				<?php endif; ?>

				<?php if ( $directions_url ) : ?>

					<li class="jubilee-entry-full-meta-buttons" id="jubilee-location-buttons">

						<?php if ( $directions_url ) : ?>

							<a href="<?php echo esc_url( $directions_url ); ?>" target="_blank" id="jubilee-location-directions-button" class="jubilee-button">
								<?php echo esc_html( __( 'Directions', 'jubilee' ) ); ?>
							</a>

						<?php endif; ?>

					</li>

				<?php endif; ?>

			</ul>

		<?php endif; ?>

	</header>

	<?php if ( ctfw_has_content() ) : // might not be any content, so let header sit flush with bottom ?>

		<div id="jubilee-location-content" class="jubilee-entry-content jubilee-entry-full-content jubilee-centered-small">

			<?php the_content(); ?>

			<?php do_action( 'jubilee_after_content' ); ?>

		</div>

	<?php endif; ?>

	<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-footer-full' ); // multipage nav, term lists, "Edit" button, etc. ?>

</article>
