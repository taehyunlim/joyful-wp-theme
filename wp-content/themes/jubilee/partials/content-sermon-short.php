<?php
/**
 * Short Sermon Content (Archive)
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Get sermon data:
// $has_full_text			True if full text of sermon was provided as post content
// $has_download   			Has at least one download (audio, video or PDF)
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

// Meta
$show_video_icon = $video_player || $video_download_url ? true : false;
$show_audio_icon = $audio_player || $audio_download_url ? true : false;
$show_icons = $has_full_text || $show_video_icon || $show_audio_icon || $pdf_download_url ? true : false;

?>

<article id="post-<?php the_ID(); ?>" <?php jubilee_short_post_classes( 'jubilee-sermon-short' ); ?>>

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

				<?php if ( $speakers ) : ?>
					<li class="jubilee-sermon-short-speaker">
						<?php echo $speakers; ?>
					</li>
				<?php endif; ?>

				<?php if ( $show_icons ) : ?>

					<li class="jubilee-sermon-short-icons jubilee-entry-short-icons">

						<ul class="jubilee-list-icons">

							<?php if ( $has_full_text ) : ?>
								<li><a href="<?php the_permalink(); ?>" class="<?php jubilee_icon_class( 'sermon-read' ); ?>" title="<?php echo esc_attr( _x( 'Read Online', 'sermon icon', 'jubilee' ) ); ?>"></a></li>
							<?php endif; ?>

							<?php if ( $show_video_icon ) : ?>
								<li><a href="<?php echo esc_url( $video_player ? add_query_arg( 'player', 'video', get_permalink() ) : get_permalink() ); ?>" class="<?php jubilee_icon_class( 'video-watch' ); ?>" title="<?php echo esc_attr( _x( 'Watch Video', 'sermon icon', 'jubilee' ) ); ?>"></a></li>
							<?php endif; ?>

							<?php if ( $show_audio_icon ) : ?>
								<li><a href="<?php echo esc_url( $audio_player ? add_query_arg( 'player', 'audio', get_permalink() ) : get_permalink() ); ?>" class="<?php jubilee_icon_class( 'audio-listen' ); ?>" title="<?php echo esc_attr( _x( 'Listen to Audio', 'sermon icon', 'jubilee' ) ); ?>"></a></li>
							<?php endif; ?>

							<?php if ( $pdf_download_url ) : ?>
								<li><a href="<?php echo esc_url( $pdf_download_url ); ?>" download class="<?php jubilee_icon_class( 'pdf-download' ); ?>" title="<?php echo esc_attr( _x( 'Download PDF', 'sermon icon', 'jubilee' ) ); ?>"></a></li>
							<?php endif; ?>

						</ul>

					</li>

				<?php endif; ?>

			</ul>

		</header>

		<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-excerpt' ); // show excerpt if no image ?>

	</div>

</article>
