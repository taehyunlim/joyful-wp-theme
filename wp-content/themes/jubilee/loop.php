<?php
/**
 * This loops to show one or multiple posts using content-*.php templates.
 *
 * It is used by index.php, jubilee_loop_after_content() and can be used elsewhere.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<?php if ( have_posts() && ! is_404() ) : ?>

	<?php if ( ! is_singular() ) : $GLOBALS['jubilee_loop_multiple'] = true; ?>

		<div id="jubilee-loop-multiple" class="jubilee-clearfix jubilee-loop-entries <?php

			if ( isset( $wp_query->post_count ) ) {

				// Get posts count
				$post_count = $wp_query->post_count;

				// Less columns when there are few posts
				// Example, if only 1 location, don't show two columns
				if ( $post_count > 1 ) {
					echo 'jubilee-loop-two-columns';
				} else {
					echo 'jubilee-loop-one-column';
				}

			}

		?>">

	<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php ctfw_get_content_template(); // load content-*.php according to post type and post format ?>

		<?php endwhile; ?>

	<?php if ( ! is_singular() ) : ?>
		</div>
	<?php endif; ?>

<?php endif; ?>