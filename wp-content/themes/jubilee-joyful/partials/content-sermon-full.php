<?php
/**
 * Full Sermon Content (Single)
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Get sermon data:
// $has_full_text			True if full text of sermon was provided as post content
// $has_download   			Has at least one downloadable file (audio, video or PDF)
// $video_player			Embed code generated from uploaded file, URL for file on other site, page on oEmbed-supported site such as YouTube, or manual embed code (HTML or shortcode)
// $video_download_url 		URL to file with extension (ie. not YouTube). If local, URL changed to force "Save As" via headers.
// $video_extension			File extension for local file (e.g. mp3)
// $video_size				File size for local file (e.g. 10 MB, 980 kB, 2 GB)
// $audio_player			Same as video
// $audio_download_url 		Same as video
// $audio_extension			File extension for local file (e.g. mp3)
// $audio_size				File size for local file (e.g. 10 MB, 980 kB, 2 GB)
// $pdf_download_url 		Same as audio/video
// $pdf_size				File size for local file (e.g. 10 MB, 980 kB, 2 GB)
extract( ctfw_sermon_data() );

// Taxonomy Terms
$speakers = get_the_term_list( $post->ID, 'ctc_sermon_speaker', '', __( ', ', 'jubilee' ) );
$topics = get_the_term_list( $post->ID, 'ctc_sermon_topic', '', __( ', ', 'jubilee' ) );
$series = get_the_term_list( $post->ID, 'ctc_sermon_series', '', __( ', ', 'jubilee' ) );
$books = get_the_term_list( $post->ID, 'ctc_sermon_book', '', __( ', ', 'jubilee' ) );

// Show buttons if need to switch between video and audio players or have at least one download link
$show_buttons = false;
if ( ( $video_player && $audio_player ) || $has_download ) {
	$show_buttons = true;
}

// Player request (?player=audio or ?player=video)
// Optionally show and scroll to a specific player
$player_request = '';
if (
	isset( $_GET['player'] ) // query string is requesting a specific player
	&& (
		( 'video' == $_GET['player'] && $video_player )		// request is for video player and video player exists
		|| ( 'audio' == $_GET['player'] && $audio_player )	// request is for audio player and audio player exists
	)
) {
	$player_request = $_GET['player'];
}

// Determine which player to show
$show_player = '';
if ( $player_request ) {
	$show_player = $player_request;
} elseif ( $video_player ) {
	$show_player = 'video';
} elseif ( $audio_player ) {
	$show_player = 'audio';
}

// Scroll to player requested, if any
if ( $player_request ) {

	add_action( 'wp_footer', 'jubilee_sermon_player_scroll' );

	function jubilee_sermon_player_scroll() {

echo <<< HTML
<script>
jQuery(document).ready(function($) {
	$.smoothScroll({
		scrollTarget: '#jubilee-sermon-media',
		offset: -135, // consider top bar height
		easing: 'swing',
		speed: 800
	});
});
</script>
HTML;

	}

}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'jubilee-entry-full jubilee-sermon-full' ); ?>>

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

			<li id="jubilee-sermon-date" class="jubilee-entry-full-date">
				<div class="jubilee-event-date-label">
					<time datetime="<?php echo esc_attr( the_time( 'c' ) ); ?>" class="jubilee-dark"><?php ctfw_post_date(); ?></time>
				</div>
			</li>

			<?php if ( $speakers ) : ?>

				<li id="jubilee-sermon-speaker">
					<?php /* <div class="jubilee-entry-full-meta-label"><?php _ex( 'Speaker', 'sermon meta label', 'jubilee' ); ?></div> */ ?>
					<?php echo $speakers; ?>
				</li>

			<?php endif; ?>

			<?php if ( $topics ) : ?>

				<li id="jubilee-sermon-topic">
					<?php /* <div class="jubilee-entry-full-meta-label"><?php _ex( 'Topic', 'sermon meta label', 'jubilee' ); ?></div> */ ?>
					<?php echo $topics; ?>
				</li>

			<?php endif; ?>

			<?php if ( $series ) : ?>

				<li id="jubilee-sermon-series">
					<?php /* <div class="jubilee-entry-full-meta-label"><?php _ex( 'Series', 'sermon meta label', 'jubilee' ); ?></div> */ ?>
					<?php echo $series; ?>
				</li>

			<?php endif; ?>

			<?php if ( $books ) : ?>

				<li id="jubilee-sermon-book">
					<?php /* <div class="jubilee-entry-full-meta-label"><?php _ex( 'Book', 'sermon meta label', 'jubilee' ); ?></div> */ ?>
					<?php echo $books; ?>
				</li>

			<?php endif; ?>

		</ul>

	</header>

	<?php
	// Show media player and buttons only if post is not password protected
	if ( ( $show_player || $show_buttons ) && ! post_password_required() ) :
	?>

		<div id="jubilee-sermon-media" class="jubilee-centered-medium">

			<?php
			// Show player if have video or audio player
			if ( $show_player ) : ?>

				<div id="jubilee-sermon-player">

					<?php if ( 'video' == $show_player ) : ?>

						<div id="jubilee-sermon-video-player">
							<?php echo $video_player; ?>
						</div>

					<?php endif; ?>

					<?php if ( 'audio' == $show_player ) : ?>

						<div id="jubilee-sermon-audio-player">
							<?php echo $audio_player ?>
						</div>

					<?php endif; ?>

				</div>

			<?php endif; ?>

			<?php
			// Show buttons if need to switch between video and audio players or have at least one download link
			if ( $show_buttons ) :
			?>

				<ul id="jubilee-sermon-buttons" class="jubilee-buttons-list">

					<?php

					// Make sure there is no whitespace between items since they are inline-block

					if ( $video_player && $audio_player ) : // have video player and audio player to switch between
						?><li id="jubilee-sermon-video-player-button">
							<a href="<?php echo esc_url( add_query_arg( 'player', 'video' ) ); ?>"<?php if ( 'video' != $show_player ) : ?> class="jubilee-button-secondary"<?php endif; ?>>
								<span class="<?php jubilee_icon_class( 'video-watch' ); ?>"></span>
								<?php _ex( 'Watch', 'single sermon button', 'jubilee' ); ?>
							</a>
						</li><?php
					endif;

					if ( $audio_player && $video_player ) : // have audio player and video player to switch between
						?><li id="jubilee-sermon-audio-player-button">
							<a href="<?php echo esc_url( add_query_arg( 'player', 'audio' ) ); ?>"<?php if ( 'audio' != $show_player ) : ?> class="jubilee-button-secondary"<?php endif; ?>>
								<span class="<?php jubilee_icon_class( 'audio-listen' ); ?>"></span>
								<?php _ex( 'Listen', 'single sermon button', 'jubilee' ); ?>
							</a>
						</li><?php
					endif;

					if ( $has_full_text ) : // have article text
						?><li id="jubilee-sermon-read-button">
							<a href="#" class="jubilee-button-secondary">
								<span class="<?php jubilee_icon_class( 'sermon-read' ); ?>"></span>
								<?php _ex( 'Read', 'single sermon button', 'jubilee' ); ?>
							</a>
						</li><?php
					endif;

					if ( $has_download ) :
						?><li id="jubilee-sermon-download-button">
							<a href="#" class="jubilee-button-secondary">
								<span class="<?php jubilee_icon_class( 'download' ); ?>"></span>
								<?php _ex( 'Save', 'single sermon button', 'jubilee' ); ?>
							</a>
						</li><?php
					endif;

					?>

				</ul>

			<?php endif; ?>

		</div>

	<?php endif; ?>

	<?php if ( ctfw_has_content() || ctfw_has_excerpt() ) : ?>

		<div id="jubilee-sermon-content" class="jubilee-entry-content jubilee-entry-full-content jubilee-centered-small">

			<?php the_content(); ?>

			<?php do_action( 'jubilee_after_content' ); ?>

		</div>

	<?php endif; ?>

	<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-footer-full' ); // multipage nav, term lists, "Edit" button, etc. ?>

</article>

<?php if ( $has_download ) : ?>

	<div id="jubilee-sermon-download-dropdown" class="jq-dropdown">

  		<div class="jq-dropdown-panel">

	  		<ul>

		  		<?php if ( $video_download_url ) : ?>

		  			<li>

						<span class="<?php jubilee_icon_class( 'video-download' ); ?>"></span>

						<a href="<?php echo esc_url( $video_download_url ); ?>" download>
							<?php
							printf(
								/* translators: %s is file type (e.g. MP3) */
								_x( 'Video (%s)', 'save link', 'jubilee' ),
								strtoupper( $video_extension )
							);
							?>
						</a>

						<?php if ( $video_size ) : ?>
							<span class="jubilee-sermon-download-dropdown-filesize"><?php echo $video_size; ?></span>
						<?php endif; ?>

					</li>

				<?php endif; ?>

		  		<?php if ( $audio_download_url ) : ?>

		  			<li>

						<span class="<?php jubilee_icon_class( 'audio-download' ); ?>"></span>

						<a href="<?php echo esc_url( $audio_download_url ); ?>" download>
							<?php
							printf(
								/* translators: %s is file type (e.g. MP3) */
								_x( 'Audio (%s)', 'save link', 'jubilee' ),
								strtoupper( $audio_extension )
							);
							?>
						</a>

						<?php if ( $audio_size ) : ?>
							<span class="jubilee-sermon-download-dropdown-filesize"><?php echo $audio_size; ?></span>
						<?php endif; ?>

					</li>

				<?php endif; ?>

		  		<?php if ( $pdf_download_url ) : ?>

		  			<li>

						<span class="<?php jubilee_icon_class( 'pdf-download' ); ?>"></span>

						<a href="<?php echo esc_url( $pdf_download_url ); ?>" download>
							<?php _ex( 'PDF', 'save link', 'jubilee' ); ?>
						</a>

						<?php if ( $pdf_size ) : ?>
							<span class="jubilee-sermon-download-dropdown-filesize"><?php echo $pdf_size; ?></span>
						<?php endif; ?>

					</li>

				<?php endif; ?>

			</ul>

		</div>

	</div>

<?php endif; ?>
