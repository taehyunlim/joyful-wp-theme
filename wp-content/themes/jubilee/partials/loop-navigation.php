<?php
/**
 * Output navigation at bottom of single and multiple loops
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/*********************************
 * ATTACHMENT - Back to Parent
 *********************************/

// No prev/next for gallery images since images can belong to multiple galleries.
// Instead, a lightbox plugin like Jetpack Carousel can be used for prev/next.

if ( is_attachment() ) :

?>

	<?php if ( ! empty( $post->post_parent ) && $parent_post = get_post( $post->post_parent ) ) : ?>

		<div class="jubilee-nav-left-right">
			<div class="jubilee-nav-left"><?php previous_post_link( '%link', sprintf( __( ' %s Back to %s', 'jubilee' ), '<span class="' . jubilee_get_icon_class( 'nav-button-left' ) . '"></span>', $parent_post->post_title ) ); ?></div>
		</div>

	<?php endif; ?>

<?php

/*********************************
 * SINGLE POST - Prev / Next
 *********************************/

elseif ( is_singular() && ! is_page() && ! jubilee_loop_after_content_used() ) : // use Multiple Posts nav on "loop after content" pages

	// Get prev/next posts
	$prev_post = get_previous_post();
	$next_post = get_next_post();

	// Show only if has prev or next post
	if ( ! $prev_post && ! $next_post ) {
		return;
	}

	// Get url, label and image_style
	$data_prev = jubilee_single_post_nav_data( 'previous', $prev_post );
	$data_next = jubilee_single_post_nav_data( 'next', $next_post );

	// Let child themes change this
	$prev_next_title_characters = apply_filters( 'jubilee_prev_next_title_characters', 50 ); // approx 2 lines

	// Shapes.
	$shapes = ctfw_customization( 'shapes' );

	?>

	<div class="jubilee-nav-blocks<?php

		// Have both posts
		if ( $prev_post && $next_post ) {
			echo ' jubilee-nav-block-has-both';
		}

		// No images on either
		if ( ! $data_prev['image_style'] && ! $data_next['image_style'] ) {
			echo ' jubilee-nav-block-no-images';
		}

	?>">

		<svg class="jubilee-nav-blocks-shape jubilee-shape-angled<?php if ( 'angled' === $shapes ) : ?> jubilee-show-shape<?php endif; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
			<polygon points="0,100 100,0 100,100"/>
		</svg>

		<div class="jubilee-nav-block jubilee-nav-block-left jubilee-hover-image <?php if ( $prev_post ) : ?>jubilee-color-main-bg<?php else : ?>jubilee-nav-block-empty<?php endif; ?>">

			<?php if ( $prev_post ) : ?>

				<?php if ( $data_prev['image_style'] ) : ?>
					<div class="jubilee-nav-block-image jubilee-hover-bg" style="<?php echo esc_attr( $data_prev['image_style'] ); ?>">
						<div class="jubilee-nav-block-image-brightness" style="<?php echo esc_attr( $data_prev['image_brightness_style'] ); ?>"></div>
						<div class="jubilee-banner-image-gradient"></div>
					</div>
				<?php endif; ?>

				<div class="jubilee-nav-block-content">

					<div class="jubilee-nav-block-content-columns">

						<div class="jubilee-nav-block-content-column jubilee-nav-block-content-left jubilee-nav-block-content-arrow">

							<a href="<?php echo esc_url( $data_prev['url'] ); ?>"><span class="<?php echo jubilee_get_icon_class( 'nav-block-left' ); ?>"></span></a>

						</div>

						<div class="jubilee-nav-block-content-column jubilee-nav-block-content-right jubilee-nav-block-content-text">

							<?php if ( $data_prev['label'] ) : ?>
								<div class="jubilee-nav-block-label"><?php echo esc_html( $data_prev['label'] ); ?></div>
							<?php endif; ?>

							<a href="<?php echo esc_url( $data_prev['url'] ); ?>" class="jubilee-nav-block-title"><?php echo esc_html( ctfw_shorten( $prev_post->post_title, $prev_next_title_characters ) ); ?></a>

						</div>

					</div>

				</div>

			<?php endif; ?>

		</div>

		<div class="jubilee-nav-block jubilee-nav-block-right jubilee-hover-image <?php if ( $next_post ) : ?> jubilee-color-accent-bg<?php else : ?>jubilee-nav-block-empty<?php endif; ?>">

			<?php if ( $next_post ) : ?>

				<?php if ( $data_next['image_style'] ) : ?>
					<div class="jubilee-nav-block-image jubilee-hover-bg" style="<?php echo esc_attr( $data_next['image_style'] ); ?>">
						<div class="jubilee-nav-block-image-brightness" style="<?php echo esc_attr( $data_next['image_brightness_style'] ); ?>"></div>
						<div class="jubilee-banner-image-gradient"></div>
					</div>

				<?php endif; ?>

				<div class="jubilee-nav-block-content">

					<div class="jubilee-nav-block-content-columns">

						<div class="jubilee-nav-block-content-column jubilee-nav-block-content-left jubilee-nav-block-content-text">

							<?php if ( $data_next['label'] ) : ?>
								<div class="jubilee-nav-block-label"><?php echo esc_html( $data_next['label'] ); ?></div>
							<?php endif; ?>

							<a href="<?php echo esc_url( $data_next['url'] ); ?>" class="jubilee-nav-block-title"><?php echo esc_html( ctfw_shorten( $next_post->post_title, $prev_next_title_characters ) ); ?></a>

						</div>

						<div class="jubilee-nav-block-content-column jubilee-nav-block-content-right jubilee-nav-block-content-arrow">

							<a href="<?php echo esc_url( $data_next['url'] ); ?>"><span class="<?php echo jubilee_get_icon_class( 'nav-block-right' ); ?>"></span></a>

						</div>

					</div>

				</div>

			<?php endif; ?>

		</div>

	</div>

<?php

/*********************************
 * MULTIPLE POSTS - Page 1 2 3
 *********************************/

else :

	// Query to use for pagination
	$query = jubilee_loop_after_content_query();
	if ( ! $query ) {  // use "loop after content" query if available
		$query = $wp_query; // otherwise use default query
	}

?>

	<?php if ( $query->max_num_pages > 1 ) : // show only if more than 1 page ?>

		<div class="jubilee-pagination">

			<?php
			// To Do: Replace with the_posts_pagination(), new as of WP 4.1 (how to use with CPT?)
			echo paginate_links( array(
				'base' 		=> str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ), // for search and archives: https://codex.wordpress.org/Function_Reference/paginate_links#Examples
				'current' 	=> max( 1, ctfw_page_num() ), // ctfw_page_num() returns/corrects $paged so pagination works on static front page
				'total' 	=> $query->max_num_pages,
				'type' 		=> 'list',
				'prev_text'	=> '<span class="' . jubilee_get_icon_class( 'nav-links-left' ) . '"></span>',
				'next_text'	=> '<span class="' . jubilee_get_icon_class( 'nav-links-right' ) . '"></span>',
			) );
			?>

		</div>

	<?php endif; ?>

<?php endif; ?>