<?php
/**
 * Short Person Content (Archive)
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Get data
// $position, $phone, $email, $urls
extract( ctfw_person_data() );

// Less meta if using widget on homepage
if ( ctfw_is_sidebar( 'ctcom-home' ) ) {
	$email = '';
}

// Meta
$show_meta = $position || $phone || $email || $urls ? true : false;

?>

<article id="post-<?php the_ID(); ?>" <?php jubilee_short_post_classes( 'jubilee-person-short' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="jubilee-entry-short-image jubilee-hover-image">

			<?php if ( ! ctfw_has_content() ) : // not linked if no content ?>

				<?php the_post_thumbnail(); ?>

			<?php else : ?>

				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>

			<?php endif; ?>

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

					<?php if ( ! ctfw_has_content() ) : // not linked if no content ?>

						<?php the_title(); ?>

					<?php else : ?>

						<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute( array( 'echo' => false ) ); ?>"><?php the_title(); ?></a>

					<?php endif; ?>

				</h2>

			<?php endif; ?>

			<?php if ( $show_meta ) : ?>

				<ul class="jubilee-entry-meta jubilee-entry-short-meta">

					<?php if ( $position ) : ?>

						<li class="jubilee-person-short-position">

							<span class="jubilee-entry-short-label">
								<?php echo esc_html( wptexturize( $position ) ); ?>
							</span>

						</li>

					<?php endif; ?>

					<?php if ( $phone ) : ?>

						<li class="jubilee-person-short-phone">
							<?php echo esc_html( wptexturize( $phone ) ); ?>
						</li>

					<?php endif; ?>

					<?php if ( $email ) : ?>

						<li class="jubilee-person-short-email">
							<?php echo ctfw_email( $email ); // link with using antispambot() and breaking before @ ?>
						</li>

					<?php endif; ?>

					<?php if ( $urls ) : ?>

						<li class="jubilee-person-short-icons jubilee-entry-short-icons">
							<?php jubilee_social_icons( $urls ); ?>
						</li>

					<?php endif; ?>

				</ul>

			<?php endif; ?>

		</header>

		<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-excerpt' ); // show excerpt if no image ?>

	</div>

</article>
