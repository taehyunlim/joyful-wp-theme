<?php
/**
 * Template Name: Galleries
 *
 * This template outputs a list of pages that use the Gallery template and [gallery] shortcode.
 * It uses a combination of the .gallery class for columns and .jubilee-caption-image for representing pages.
 *
 * partials/content-full.php outputs the page content.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Prepare gallery content to output
function jubilee_galleries_after_content() {

	// Get gallery posts/pages
	$galley_posts = ctfw_gallery_posts( array(
		'orderby'	=> 'date',
		'order'		=> 'desc'
	) );

	?>

	<?php if ( ! empty( $galley_posts ) ) : ?>

		<div id="jubilee-galleries" class="jubilee-highlights-content jubilee-highlights-three-columns">

			<?php foreach ( $galley_posts as $post_id => $post_data ) :

				$image_count = $post_data['image_count'];

				// Use first image in gallery
				$image_url = '';
				if ( ! empty( $post_data['image_ids'][0] ) ) { // use first image from first gallery in content
					$image_id = $post_data['image_ids'][0];
					$image = wp_get_attachment_image_src( $image_id, 'jubilee-square' );
					$image_url = ! empty( $image[0] ) ? $image[0] : '';
				}

				// Prepare styles for image overlay
				$image_style            = '';
				$image_brightness_style = '';
				if ( $image_url ) {

					// Get settings.
					$image_brightness = ctfw_customization( 'header_image_brightness' );
					$image_opacity    = 100 - ctfw_customization( 'colorization' );
					$colorization     = 100 - $image_opacity;

					// Brightness
					$image_brightness_decimal = 1 - ( $image_brightness / 100 );
					$image_brightness_style   = "opacity: $image_brightness_decimal;";

					// Style.
					$image_style = jubilee_colorization_style( $image_url, $colorization );

				}

				// Title.
				$title = get_the_title( $post_data['post']->ID );

				// Important that there is no whitespace between elements
				?><div<?php

					$li_classes = array( 'jubilee-caption-image', 'jubilee-highlight', 'jubilee-highlight-linked' );

					// Has image?
					if ( $image_url ) {
						$li_classes[] = 'jubilee-caption-image-has-image';
					} else {
						$li_classes[] = 'jubilee-caption-image-no-image'; // main color if no image
					}

					// Has title?
					if ( $title ) {
						$li_classes[] = 'jubilee-highlight-has-title';
					} else {
						$li_classes[] = 'jubilee-highlight-no-title';
					}

					// Has description (count)?
					$has_desc = isset( $image_count );
					if ( $has_desc ) {
						$li_classes[] = 'jubilee-highlight-has-description';
					} else {
						$li_classes[] = 'jubilee-highlight-no-description';
					}

					// Has title or description (caption)?
					if ( $title || $has_desc ) {
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

				// Important that there is no whitespace between elements
				?>>

					<div class="jubilee-caption-image-inner jubilee-color-main-bg">

						<a href="<?php echo esc_url( get_permalink( $post_data['post']->ID ) ); ?>" title="<?php echo esc_attr( $title ); ?>">

							<?php if ( $image_url ) : // valid image specified ?>

								<div class="jubilee-caption-image-bg jubilee-hover-bg" style="<?php echo esc_attr( $image_style ); ?>"></div>

								<div class="jubilee-caption-image-brightness" style="<?php echo esc_attr( $image_brightness_style ); ?>"></div>

								<div class="jubilee-caption-image-gradient"></div>

							<?php endif; ?>

							<img class="jubilee-placeholder jubilee-placeholder-square<?php if ( $shapes === 'organic' ) : ?> jubilee-show-placeholder<?php endif; ?>" src="<?php echo apply_filters( 'jubilee_square_placeholder_url', CTFW_THEME_URL . '/images/square-placeholder.png' ); ?>" alt=""> <?php // use transparent placeholder thumbnail of proper proportion ?>
							<img class="jubilee-placeholder jubilee-placeholder-rect<?php if ( $shapes !== 'organic' ) : ?> jubilee-show-placeholder<?php endif; ?>" src="<?php echo apply_filters( 'jubilee_rect_placeholder_url', CTFW_THEME_URL . '/images/rect-placeholder.png' ); ?>" alt=""> <?php // use transparent placeholder thumbnail of proper proportion ?>

							<?php if ( $title || $has_desc ) : ?>
								<div class="jubilee-caption-image-caption">
							<?php endif; ?>

								<?php if ( $title ) : ?>
									<div class="jubilee-caption-image-title">
										<h2 class="jubilee-widget-title"><?php echo wptexturize( $title ); ?></h2>
									</div>
								<?php endif; ?>

								<?php if ( $has_desc ) : ?>
									<div class="jubilee-caption-image-description">
										<?php printf( _n( '1 Photo', '%d Photos', $image_count, 'jubilee' ), $image_count ); ?>
									</div>
								<?php endif; ?>

							<?php if ( $title || $has_desc ) : ?>
								</div>
							<?php endif; ?>

						</a>

					</div>

				</div><?php // Important that there is no whitespace between elements

			endforeach; ?>

		</div>

	<?php endif;

}

// Insert content after the_content() in content.php
add_action( 'jubilee_after_content', 'jubilee_galleries_after_content' );

// Load main template to show the page
locate_template( 'index.php', true );
