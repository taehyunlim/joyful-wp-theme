<?php
/**
 * Admin Widgets Functions (theme, not framework)
 *
 * @package    Jubilee
 * @subpackage Admin
 * @copyright  Copyright (c) 2019, ChurchThemes.com, LLC
 * @link       https://churchthemes.com/themes/jubilee
 * @license    GPLv2 or later
 * @since      1.0
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add message to CT Locations widget on Home widget area
 *
 * This is hidden by default with js/admin-widgets.css
 * js/admin-widgets.css shows the message for CT Locations widget only in Homepage widget area
 *
 * @since 1.0
 */
function jubilee_home_location_widget_message( $widget ) {

	// CT Locations widget only
	if ( ! isset( $widget->id_base ) || 'ctfw-locations' != $widget->id_base ) {
		return;
	}

	// Output message
	?>
	<div class="jubilee-home-locations-widget-message">
		<?php _e( 'Your primary location will show on the homepage. A "Locations" button will appear if you have multiple locations. Set icons in <b>Customizer</b> > <b>Icons</b>.', 'jubilee' ); ?>
	</div>
	<?php

}

add_action( 'ctfw_widget_before_fields', 'jubilee_home_location_widget_message' );
