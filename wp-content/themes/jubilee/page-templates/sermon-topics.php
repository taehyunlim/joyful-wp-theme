<?php
/**
 * Template Name: Sermon Topics
 *
 * This shows a page with sermon topics.
 *
 * partials/content-full.php outputs the page content.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Prepare sermon topics to output after page content
function jubilee_sermon_topics_after_content() {

	// Get topics
	$topics = wp_list_categories( array(
		'taxonomy' => 'ctc_sermon_topic',
		'show_count' => true,
		'title_li' => '',
		'echo' => false,
	) );

	?>

	<div id="jubilee-sermon-topics" class="jubilee-sermon-index">

		<?php
		// Buttons for switching between indexes
		get_template_part( CTFW_THEME_PARTIAL_DIR . '/sermon-archive-buttons' );
		?>

		<?php if ( $topics ) : ?>

			<ul id="jubilee-sermon-topics-list" class="jubilee-sermon-index-list jubilee-sermon-index-list-three-columns">
				<?php echo $topics; ?>
			</ul>

		<?php else : ?>

			<p id="jubilee-sermon-index-none">
				<?php _e( 'There are no topics to show.', 'jubilee' ); ?>
			</p>

		<?php endif; ?>

	</div>

	<?php

}

// Insert content after the_content() in content.php
add_action( 'jubilee_after_content', 'jubilee_sermon_topics_after_content' );

// Load main template to show the page
locate_template( 'index.php', true );
