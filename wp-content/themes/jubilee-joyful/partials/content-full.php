<?php
/**
 * Full Page Content (Single)
 *
 * This is also the default content template. Any posts without a specific template will use this.
 * It outputs minimal content (title and content) in generic way compatible with any post type.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Custom page templates can use this template to insert a loop after the content.
 * For example, the Sermons page template can loop sermons after the content.
 *
 * 		// Query specific posts to loop
 * 		function jubilee_template_name_loop_after_content() { // template_name being something like 'sermons'
 * 	 		return new WP_Query();
 *    	}
 *
 *		// Make query available via filter
 *		add_filter( 'jubilee_loop_after_content_query', 'jubilee_template_name_loop_after_content' );
 *
 *		// Load main template to show the page
 *		locate_template( 'index.php', true );
 *
 * Other content can similarly be shown in this way via a custom page template:
 *
 * 		// Custom content output
 * 		function jubilee_template_name_after_content() { // template_name being something like 'sermons'
 * 			echo 'whatever';
 * 		}
 *
 * 		// Make content available via action
 *		add_action( 'jubilee_after_content', 'jubilee_template_name_after_content' );
 *
 *		// Load main template to show the page
 *		locate_template( 'index.php', true );
 */

// Using loop after content?
$loop_after_content_used = jubilee_loop_after_content_used();

$classes = array(
	'jubilee-entry-full',
);

// Loop after content used (showing list of short entries)
// In this case we don't want to use small class and we want to add detection via CSS
if ( $loop_after_content_used ) {

	$classes[] = 'jubilee-centered-large';
	$classes[] = 'jubilee-loop-after-content-used';

} else {

	// Width depends on page template, archive, singular, etc.
	$content_width = jubilee_content_width();
	if ( 1170 == $content_width ) {
		$classes[] = "jubilee-centered-large";
	} elseif ( 980 == $content_width ) {
		$classes[] = "jubilee-centered-medium";
	} else { // 700
		$classes[] = "jubilee-centered-small";
	}

	$classes[] = 'jubilee-loop-after-content-not-used';

}

// Has content?
if ( ctfw_has_content() ) {
	$classes[] = 'jubilee-entry-has-content';
} else {
	$classes[] = 'jubilee-entry-no-content';
}

$classes = implode( ' ', $classes );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<?php
	// This is visible only to screenreaders.
	// Page title is shown in banner. This is for proper HTML5 and Outline
	if ( ctfw_has_title() ) :
	?>

		<h1 id="jubilee-main-title">
			<?php jubilee_title_paged(); ?>
		</h1>

	<?php endif; ?>

	<div class="jubilee-entry-content jubilee-entry-full-content">

		<?php if ( ctfw_has_content() ) : ?>

			<?php if ( $loop_after_content_used ) : ?>
				<div class="jubilee-entry-content-inner jubilee-centered-medium">
			<?php endif; ?>

				<?php the_content(); ?>

			<?php if ( $loop_after_content_used ) : ?>
				</div>
			<?php endif; ?>

		<?php endif; ?>

		<?php do_action( 'jubilee_after_content' ); ?>

	</div>

	<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-footer-full' ); // multipage nav, taxonomy terms, "Edit" button, etc. ?>

</article>
