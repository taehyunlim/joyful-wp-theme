<?php
/**
 * Gallery Widget Template (Homepage)
 *
 * Produces output for appropriate widget class in framework.
 * $this, $instance (sanitized field values) and $args are available.
 *
 * $this->ctfw_get_posts() can be used to produce a query according to widget field values.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Is this first of all widgets on homepage?
$is_first_widget = ctfw_is_first_widget(); // first widget in section

// Title
$title = apply_filters( 'widget_title', $instance['title'] );

// Get photo posts
// See jubilee_home_gallery_widget_args which forces settings for widget on homepage
$posts = $this->ctfw_get_posts(); // widget's default query according to field values
$photo_count = count( $posts );

// Get ID's into list
$ids_array = array();
foreach ( $posts as $post ) {
	$ids_array[] = $post->ID;
}
$ids = implode( ',', $ids_array );

// Button URL
$button_url = '';

	// Use a specific page, if specified in widget settings and exists
	if ( $instance['post_id'] && 'all' != $instance['post_id'] ) {
		$button_url = get_permalink( $instance['post_id'] );
	}

	// Use page having "Galleries" template, if exists
	if ( ! $button_url ) { // either wasn't able to get a gallery's page or did no choose a specific gallery
		$button_url = ctfw_get_page_url_by_template( 'galleries.php' );
	}

// Shapes.
$shapes = ctfw_customization( 'shapes' );

// Styles
$section_classes = array(
	'jubilee-image-section',
	'jubilee-gallery-section',
	//jubilee_alternating_bg_class( 'contrast' ),
);

	if ( $title ) {
		$section_classes[] = 'jubilee-gallery-section-has-title';
	}

	if ( $is_first_widget ) {
		$section_classes[] = 'jubilee-first-home-widget';
	}

?>

<section class="<?php echo esc_attr( implode( ' ', $section_classes ) ); ?>" <?php echo jubilee_homepage_section_id_attr(); ?>>

	<div class="jubilee-gallery-section-content">

		<?php if ( $title ) : ?>

			<header class="jubilee-gallery-section-header jubilee-centered-large">

				<?php if ( $button_url ) : ?>

					<a href="<?php echo esc_url( $button_url ); ?>" class="jubilee-button jubilee-gallery-section-button">
						<?php echo esc_html( _x( 'See More', 'home gallery widget', 'jubilee' ) ); ?>
					</a>

				<?php endif; ?>

				<h2 class="jubilee-widget-title"><?php echo $title; ?></h2>

			</header>

		<?php endif; ?>

		<?php if ( $posts ) : ?>

			<div class="jubilee-gallery-section-photos jubilee-gallery-section-photos-<?php echo esc_attr( $photo_count ); ?> jubilee-clearfix">

				<?php

				// Use gallery shortcode
				echo gallery_shortcode( array(
					'columns'	=> 0, // no row breaks
					'size'		=> 'post-thumbnail',
					'ids'		=> $ids,
				) );

				?>

			</div>

		<?php else : ?>

			<div class="jubilee-centered-large">

				<p class="jubilee-gallery-home-no-images-text">
					<?php echo esc_html( _x( 'There are no images to show.', 'gallery widget', 'jubilee' ) ); ?>
				</p>

			</div>

		<?php endif; ?>

	</div>

	<svg class="jubilee-gallery-home-shape jubilee-shape-organic<?php if ( 'organic' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1350.28 68.4" preserveAspectRatio="none">
		<path d="M1350.23,60.74C1258,24.74,1148,3.27,1015.15,3.27,792.41,3.27,610.18,68.4,357,68.4,188.21,68.4,0,53.75,0,53.75V0H1350.23"/>
	</svg>

	<svg class="jubilee-gallery-home-shape-bottom jubilee-shape-organic<?php if ( 'organic' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1366 96" preserveAspectRatio="none">
		<path d="M0,96c253.8,0,480.3-53.6,613.1-53.6c222.7,0-179.8,0,73.3,0c168.8,0,348.1,26.8,348.1,26.8L1232.7,96H0"/>
	</svg>

	<svg class="jubilee-gallery-home-shape jubilee-shape-angled<?php if ( 'angled' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon points="100 0 0 100 0 0 100 0"/>
	</svg>

</section>

<?php

// Reset post data.
wp_reset_postdata();

?>
