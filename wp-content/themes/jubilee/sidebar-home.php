<?php
/**
 * Homepage Widget Area
 *
 * This shows widgets on the homepage.
 */

global $jubilee_close_final_home_multiple_section;

?>

<main id="jubilee-home-main">

	<?php if ( is_active_sidebar( 'ctcom-home' ) ) : ?>

		<?php dynamic_sidebar( 'ctcom-home' ); ?>

		<?php
		// Highlights and Secondary Widgets containers needs to be closed here when used as last section on homepage.
		// See jubilee_close_final_home_multiple_section() for how the global is set.
		if ( isset( $jubilee_close_final_home_multiple_section ) ) {
			echo $jubilee_close_final_home_multiple_section;
		}
		?>

	<?php else : ?>

		<section id="jubilee-home-no-widgets-section" class="jubilee-first-home-widget jubilee-custom-section jubilee-viewport-height-40 jubilee-section-has-title jubilee-section-has-content jubilee-section-no-image">

			<div class="jubilee-custom-section-inner">

				<div class="jubilee-custom-section-content">

					<h1>
						<?php esc_html_e( 'Add Widgets', 'jubilee' ); ?>
					</h1>

					<p>
						<?php _e( 'Import starter widgets or go to <b>Appearance</b> > <b>Customize</b> > <b>Widgets</b> to add widgets to your homepage.', 'jubilee' ); ?>
					</p>

				</div>

			</div>

		</section>

	<?php endif; ?>

</main>
