<?php
/**
 * Short Post Content (Archive)
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<article id="post-<?php the_ID(); ?>" <?php jubilee_short_post_classes(); ?>>

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

			<ul class="jubilee-entry-meta jubilee-entry-short-meta">

				<li class="jubilee-entry-short-date">

					<time datetime="<?php echo esc_attr( the_time( 'c' ) ); ?>" class="jubilee-entry-short-label">

						<?php
						ctfw_post_date( array(
							'abbreviate_date' => array( // arguments for ctfw_abbreviate_date_format(); or set true to use defaults
								'abbreviate_month'	=> true, // December = Dec
								'remove_year'		=> false,
							)
						) );
						?>

					</time>

				</li>

				<li class="jubilee-entry-short-author">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
				</li>

			</ul>

		</header>

		<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-excerpt' ); // show excerpt if no image ?>

	</div>

</article>
