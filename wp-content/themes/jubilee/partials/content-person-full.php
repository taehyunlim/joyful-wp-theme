<?php
/**
 * Full Person Content (Single)
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Get data
// $position, $phone, $email, $urls
extract( ctfw_person_data() );

// Has meta to show?
$has_meta = ( $position || $phone || $email || $urls ) ? true : false;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'jubilee-entry-full jubilee-person-full' ); ?>>

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

		<?php if ( $has_meta ) : ?>

			<ul class="jubilee-entry-meta jubilee-entry-full-meta">

				<?php if ( $position ) : ?>

					<li id="jubilee-person-position" class="jubilee-entry-full-meta-bold">
						<?php echo esc_html( wptexturize( $position ) ); ?>
					</li>

				<?php endif; ?>

				<?php if ( $phone ) : ?>

					<li id="jubilee-person-phone">
						<?php echo esc_html( wptexturize( $phone ) ); ?>
					</li>

				<?php endif; ?>

				<?php if ( $email ) : ?>

					<li id="jubilee-person-email">
						<?php echo ctfw_email( $email ); // link with using antispambot() and breaking before @ ?>
					</li>

				<?php endif; ?>

				<?php if ( $urls ) : ?>

					<li id="jubilee-person-icons" class="jubilee-entry-full-icons">
						<?php jubilee_social_icons( $urls ); ?>
					</li>

				<?php endif; ?>

			</ul>

		<?php endif; ?>

	</header>

	<?php if ( ctfw_has_content() ) : // might not be any content, so let header sit flush with bottom ?>

		<div id="jubilee-person-content" class="jubilee-entry-content jubilee-entry-full-content jubilee-centered-small">

			<?php the_content(); ?>

			<?php do_action( 'jubilee_after_content' ); ?>

		</div>

	<?php endif; ?>

	<?php get_template_part( CTFW_THEME_PARTIAL_DIR . '/content-footer-full' ); // multipage nav, term lists, "Edit" button, etc. ?>

</article>
