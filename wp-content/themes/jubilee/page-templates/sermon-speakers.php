<?php
/**
 * Template Name: Sermon Speakers
 *
 * This shows a page with sermon speakers.
 *
 * partials/content-full.php outputs the page content.
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Prepare sermon speakers to output after page content
function jubilee_sermon_speakers_after_content() {

	// Get speakers
	$speakers = wp_list_categories( array(
		'taxonomy' => 'ctc_sermon_speaker',
		'hierarchical' => false,
		'show_count' => true,
		'title_li' => '',
		'echo' => false,
	) );

	?>

	<div id="jubilee-sermon-speakers" class="jubilee-sermon-index">

		<?php
		// Buttons for switching between indexes
		get_template_part( CTFW_THEME_PARTIAL_DIR . '/sermon-archive-buttons' );
		?>

		<?php if ( $speakers ) : ?>

			<ul id="jubilee-sermon-speakers-list" class="jubilee-sermon-index-list jubilee-sermon-index-list-three-columns">
				<?php echo $speakers; ?>
			</ul>

		<?php else : ?>

			<p id="jubilee-sermon-index-none">
				<?php _e( 'There are no speakers to show.', 'jubilee' ); ?>
			</p>

		<?php endif; ?>

	</div>

	<?php

}

// Insert content after the_content() in content.php
add_action( 'jubilee_after_content', 'jubilee_sermon_speakers_after_content' );

// Load main template to show the page
locate_template( 'index.php', true );
