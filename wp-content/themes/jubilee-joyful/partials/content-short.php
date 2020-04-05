<?php
/**
 * Short Page Content (Archive)
 *
 * This is also the default content template. Any posts without a specific template will use this.
 * It outputs minimal content (title and content) in generic way compatible with any post type.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<article id="post-<?php the_ID(); ?>" <?php jubilee_short_post_classes( 'jubilee-entry-short' ); ?>>

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

		</header>

		<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-excerpt' ); // show excerpt if no image ?>

	</div>

</article>
