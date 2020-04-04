/**
 * Theme Customizer Live Preview
 */

jQuery( document ).ready( function( $ ) {

	/***************************************
	 * COLORS
	 ***************************************/

	// Main Color
	wp.customize( jubilee_customize_preview.option_id + '[main_color]', function( value ) {

		value.bind( function( to ) {

			var accent_hex;

			jubilee_update_main_color( to );

			// Update accent color selectors too, since gradients use both.
			accent_hex = window.parent.jQuery( '#customize-control-' + jubilee_customize_preview.option_id + '-accent_color input.color-picker-hex' ).val();
			jubilee_update_accent_color( accent_hex );

		} );

	} );

	// Accent Color
	wp.customize( jubilee_customize_preview.option_id + '[accent_color]', function( value ) {

		value.bind( function( to ) {

			var main_hex;

			jubilee_update_accent_color( to );

			// Update main color selectors too, since gradients use both.
			main_hex = window.parent.jQuery( '#customize-control-' + jubilee_customize_preview.option_id + '-main_color input.color-picker-hex' ).val();
			jubilee_update_main_color( main_hex );

		} );

	} );

	// Highlight Color
	wp.customize( jubilee_customize_preview.option_id + '[highlight_color]', function( value ) {

		value.bind( function( to ) {

			var text_selectors, text_important_selectors, border_selectors, bg_rgba_selectors, bg_rgba_half_selectors, gradient_rgba_half, rgb, rgba;

			// Gradients.
			gradient_rgba_half = jubilee_customize_preview.gradients['highlight_color_rgba_half']; // degrees and percentages

			// Hex
			text_selectors = jubilee_customize_preview[ 'highlight_color_selectors' ];
			text_important_selectors = jubilee_customize_preview[ 'highlight_color_important_selectors' ];
			border_selectors = jubilee_customize_preview[ 'highlight_color_border_selectors' ];

				// Using second method to prevent all link elements from being color (menu items, logo, etc.)
				$( 'head' ).append( '<style type="text/css">' + text_selectors + ' { color: ' + to + '; }</style>' );
				$( 'head' ).append( '<style type="text/css">' + text_important_selectors + ' { color: ' + to + ' !important; }</style>' );
				$( 'head' ).append( '<style type="text/css">' + border_selectors + ' { border-color: ' + to + ' !important; }</style>' );

			// RGB
			bg_rgba_selectors = jubilee_customize_preview[ 'highlight_color_rgba_selectors' ];
			bg_rgba_half_selectors = jubilee_customize_preview[ 'highlight_color_rgba_half_selectors' ];

				// Convert hex color to RGB
				rgb = colorconv.HEX2RGB( to );

				// Have RGB
				if ( rgb.length ) {

					// Form rgba()
					rgba = 'rgba(' + rgb.join(', ') + ', ' + jubilee_customize_preview.rgb_opacity + ')';

					// Appending <style> to head with !important produces better results than $element.css()
					$( 'head' ).append( '<style type="text/css">' + bg_rgba_selectors + ' { background: ' + rgba + ' !important; }</style>' );
					$( 'head' ).append( '<style type="text/css">' + bg_rgba_half_selectors + ' { background: linear-gradient( ' + gradient_rgba_half[0] + ', transparent ' + gradient_rgba_half[1] + ', ' + rgba + ' ' + gradient_rgba_half[2] + ' ) !important; }</style>' );

				}

		} );

	} );

	/***************************************
	 * FONTS (GOOGLE FONTS)
	 ***************************************/

	// Change Fonts ( Menu, Heading, Body )
	$.each( [ 'logo_font', 'nav_font', 'heading_font', 'body_font' ], function( index, setting ) {

		wp.customize( jubilee_customize_preview.option_id + '[' + setting + ']', function( value ) {

			value.bind( function( to ) {

				var selectors, font;

				font = to;

				// Change font
				selectors = jubilee_customize_preview[setting + '_selectors'];
				jubilee_customize_preview_font( selectors, font );

				// Change <body> class helper (tells which font used for which set of elements)
				jubilee_update_body_font_class( setting, font ); // main.js

			} );

		} );

	} );

	/***************************************
	 * LOGO
	 ***************************************/

	// Logo Text Size
	wp.customize( jubilee_customize_preview.option_id + '[logo_text_size]', function( value ) {

		value.bind( function( to ) {

			$( '#jubilee-logo-text' )
				.removeClass() // remove all classes
				.addClass( 'jubilee-logo-text-' + to );

		} );

	} );

	/***************************************
	 * MENU
	 ***************************************/

	// Re-activate dropdowns after Menu Customizer does "partial refresh" / "fast refresh"
	// https://make.wordpress.org/core/tag/menu-customizer/
	$( document ).on( 'customize-preview-menu-refreshed', function( e, params ) {

		if ( 'header' === params.wpNavMenuArgs.theme_location ) {
			jubilee_activate_menu();
		}

	} );

} );

/***************************************
 * FUNCTIONS
 ***************************************/

/**
 * Update Main Color
 */

function jubilee_update_main_color( to ) {

	var background_selectors, border_selectors, text_selectors, bg_rgba_selectors, border_rgba_selectors, gradient_main_rgba, gradient_main_rgba_alt, rgb, rgba, accent_hex, accent_rgb, accent_rgba;

	// Gradients.
	gradient_main_rgba = jubilee_customize_preview.gradients['main_color_rgba'];
	gradient_main_rgba_alt = jubilee_customize_preview.gradients['main_color_rgba_alt'];

	// Hex
	background_selectors = jubilee_customize_preview[ 'main_color_selectors' ];
	border_selectors = jubilee_customize_preview[ 'main_color_border_selectors' ];
	text_selectors = jubilee_customize_preview[ 'main_color_text_selectors' ];

		// Appending <style> to head with !important produces better results than $element.css()
		jQuery( 'head' ).append( '<style type="text/css">' + background_selectors + ' { background-color: ' + to + ' !important; }</style>' );
		jQuery( 'head' ).append( '<style type="text/css">' + border_selectors + ' { border-color: ' + to + ' !important; }</style>' );
		jQuery( 'head' ).append( '<style type="text/css">' + text_selectors + ' { color: ' + to + ' !important; }</style>' );

	// RGB
	bg_rgba_selectors = jubilee_customize_preview[ 'main_color_rgba_selectors' ];
	bg_rgba_alt_selectors = jubilee_customize_preview[ 'main_color_rgba_alt_selectors' ];
	border_rgba_selectors = jubilee_customize_preview[ 'main_color_rgba_border_selectors' ];

		// Get Accent Color from Customizer controls to use with gradient.
		accent_hex = window.parent.jQuery( '#customize-control-' + jubilee_customize_preview.option_id + '-accent_color input.color-picker-hex' ).val();

		// Convert hex color to RGB
		rgb = colorconv.HEX2RGB( to );
		accent_rgb = colorconv.HEX2RGB( accent_hex );

		// Have RGB
		if ( rgb.length ) {

			// Form rgba() values.
			rgba = 'rgba(' + rgb.join(', ') + ', ' + jubilee_customize_preview.rgb_opacity + ')';
			accent_rgba = 'rgba(' + accent_rgb.join(', ') + ', ' + jubilee_customize_preview.rgb_opacity + ')';

			// Appending <style> to head with !important produces better results than jQueryelement.css()
			jQuery( 'head' ).append( '<style type="text/css">' + bg_rgba_selectors + ' { background: linear-gradient( ' + gradient_main_rgba[0] + ', ' + rgba + ' ' + gradient_main_rgba[1] + ', ' + accent_rgba + ' ' + gradient_main_rgba[2] + ' ) !important; }</style>' );
			jQuery( 'head' ).append( '<style type="text/css">' + bg_rgba_alt_selectors + ' { background: linear-gradient( ' + gradient_main_rgba_alt[0] + ', ' + rgba + ' ' + gradient_main_rgba_alt[1] + ', ' + accent_rgba + ' ' + gradient_main_rgba_alt[2] + ' ) !important; }</style>' );
			jQuery( 'head' ).append( '<style type="text/css">' + border_rgba_selectors + ' { border-color: ' + rgba + ' !important; }</style>' );

		}

}

/**
 * Update Accent Color
 */
function jubilee_update_accent_color( to ) {

	var text_selectors, text_important_selectors, border_selectors, bg_selectors, bg_rgba_selectors, gradient_accent_rgba, rgb, rgba, main_hex, main_rgb, main_rgba;

	// Gradients.
	gradient_accent_rgba = jubilee_customize_preview.gradients['accent_color_rgba'];

	// Hex
	text_selectors = jubilee_customize_preview[ 'accent_color_selectors' ];
	text_important_selectors = jubilee_customize_preview[ 'accent_color_important_selectors' ];
	border_selectors = jubilee_customize_preview[ 'accent_color_border_selectors' ];
	bg_selectors = jubilee_customize_preview[ 'accent_color_bg_selectors' ];

		// Using second method to prevent all link elements from being color (menu items, logo, etc.)
		jQuery( 'head' ).append( '<style type="text/css">' + text_selectors + ' { color: ' + to + '; }</style>' );
		jQuery( 'head' ).append( '<style type="text/css">' + text_important_selectors + ' { color: ' + to + ' !important; }</style>' );
		jQuery( 'head' ).append( '<style type="text/css">' + border_selectors + ' { border-color: ' + to + '; }</style>' );
		jQuery( 'head' ).append( '<style type="text/css">' + bg_selectors + ' { background: ' + to + '; }</style>' );

	// RGB
	bg_rgba_selectors = jubilee_customize_preview[ 'accent_color_rgba_selectors' ];

		// Get Accent Color from Customizer controls to use with gradient.
		main_hex = window.parent.jQuery( '#customize-control-' + jubilee_customize_preview.option_id + '-main_color input.color-picker-hex' ).val();

		// Convert hex color to RGB
		rgb = colorconv.HEX2RGB( to );
		main_rgb = colorconv.HEX2RGB( main_hex );

		// Have RGB
		if ( rgb.length ) {

			// Form rgba() values
			rgba = 'rgba(' + rgb.join(', ') + ', ' + jubilee_customize_preview.rgb_opacity + ')';
			main_rgba = 'rgba(' + main_rgb.join(', ') + ', ' + jubilee_customize_preview.rgb_opacity + ')';

			// Appending <style> to head with !important produces better results than $element.css()
			jQuery( 'head' ).append( '<style type="text/css">' + bg_rgba_selectors + ' { background: linear-gradient( ' + gradient_accent_rgba[0] + ', ' + rgba + ' ' + gradient_accent_rgba[1] + ', ' + main_rgba + ' ' + gradient_accent_rgba[2] + ' ) !important; }</style>' );

		}

}

/**
 * Apply Font Change
 */
function jubilee_customize_preview_font( selectors, font ) {

	var family, styles, subsets, families;

	if ( selectors && font ) {

		// Prepare data
		family = font.replace( /\s/g, '+' ); // spaces to +
		styles = jubilee_customize_preview.fonts[font].sizes;
		subsets = window.parent.jQuery( 'input[data-customize-setting-link="' + jubilee_customize_preview.option_id + '[font_subsets]"]' ).val().replace( /\s/g, '' ); // remove spaces
		families = [family + ':' + styles + ':' + subsets];

		// Load font
		WebFont.load( {
			google: {
				families: families
			},
			active: function() {

				// Appending <style> to head with !important produces better results than $element.css()
				jQuery( 'head' ).append( '<style type="text/css">' + selectors + ' { font-family: ' + font + ' !important; }</style>' );

				// Reactivate menu ( sizing )
				jubilee_activate_menu();

				// Re-adjust MatchHeight since font can change it (short entries, gallery items)
				jubilee_match_height();

			}
		} );

	}

}
