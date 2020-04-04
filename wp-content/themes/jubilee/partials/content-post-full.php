<?php
/**
 * Full Post Content (Single)
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Taxonomy Terms
$categories = get_the_category_list(
	/* translators: used between list items, there is a space after the comma */
	__( ', ', 'jubilee' )
);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'jubilee-entry-full jubilee-blog-full' ); ?>>

	<header class="jubilee-entry-full-header jubilee-centered-large">

		<?php
		// This is visible only to screenreaders.
		// Page title is shown in banner. This is for proper HTML5 and Outline
		if ( ctfw_has_title() ) :
		?>

			<h1 id="jubilee-main-title">
				<?php jubilee_title_paged(); ?>
			</h1>

		<?php endif; ?>

		<ul class="jubilee-entry-meta jubilee-entry-full-meta">

			<li class="jubilee-entry-full-date">
				<div class="jubilee-event-date-label">
					<time datetime="<?php echo esc_attr( the_time( 'c' ) ); ?>" class="jubilee-dark"><?php ctfw_post_date(); ?></time>
				</div>
			</li>

			<li class="jubilee-entry-full-author">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
			</li>

			<?php if ( $categories ) : ?>

				<li class="jubilee-entry-full-category">
					<?php echo $categories; ?>
				</li>

			<?php endif; ?>

		</ul>

	</header>

	<div class="jubilee-entry-content jubilee-entry-full-content jubilee-centered-small">

		<?php the_content(); ?>

		<?php do_action( 'jubilee_after_content' ); ?>

	</div>

	<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-footer-full' ); // multipage nav, term lists, "Edit" button, etc. ?>

</article>
