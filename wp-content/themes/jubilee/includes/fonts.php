<?php
/**
 * Font Functions
 *
 * Also see the helper functions in framework's fonts.php.
 *
 * @package    Jubilee
 * @subpackage Functions
 * @copyright  Copyright (c) 2019, ChurchThemes.com, LLC
 * @link       https://churchthemes.com/themes/jubilee
 * @license    GPLv2 or later
 * @since      1.0
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/*******************************************
 * GOOGLE FONTS
 *******************************************/

/**
 * Specify Google Fonts available
 *
 * A selection of Google Fonts to choose in Customizer
 * http://www.google.com/webfonts
 *
 * Filter ctfw_google_fonts to make available for framework.
 * Use ctfw_google_fonts( $target ) to get fonts.
 *
 * sizes 	copied from Google URL (can be blank if single size)
 * type 	serif, sans-serif, handwriting or display (for fallback)
 * targets	where this font is available for use (blank for all)
 *
 * Example source: http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic
 *
 * Body fonts should have regular, bold and italic. All fonts should have even line height.
 *
 * @since 1.0
 */
function jubilee_google_fonts() {

	return array(

		/**
		 * Sans Serif Fonts
		 */

		'Arimo' => array(
			'sizes'		=> '400,400italic,700,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Asap' => array(
			'sizes'		=> '400,700,400italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Cabin' => array(
			'sizes'		=> '400,700,400italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Days One' => array(
			'sizes'		=> '',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Dosis' => array(
			'sizes'		=> '400,700',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Droid Sans' => array(
			'sizes'		=> '400,700',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							//'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Lato' => array(
			'sizes'		=> '300,400,700,300italic,400italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Magra' => array(
			'sizes'		=> '400,700',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Montserrat' => array(
			'sizes'		=> '400,700',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Muli' => array(
			'sizes'		=> '400,700,400italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Nunito' => array(
			'sizes'		=> '400,700,400italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Open Sans' => array(
			'sizes'		=> '300,400,600,700,300italic,400italic,600italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Oswald' => array(
			'sizes'		=> '400,700',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Poppins' => array(
			'sizes'		=> '400,500,700,400italic,500italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Quicksand' => array(
			'sizes'		=> '400,700',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Raleway' => array(
			'sizes'		=> '200,300,400,500,700,200italic,300italic,400italic,500italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Roboto' => array(
			'sizes'		=> '300,400,700,300italic,400italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Roboto Slab' => array(
			'sizes'		=> '300,400,700',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
						)
		),

		'Rubik' => array(
			'sizes'		=> '300,400,700,300italic,400italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font',
						)
		),

		'Source Sans Pro' => array(
			'sizes'		=> '300,400,600,700,300italic,400italic,600italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Titillium Web' => array(
			'sizes'		=> '300,400,600,700,300italic,400italic,600italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Ubuntu' => array(
			'sizes'		=> '300,400,500,700,300italic,400italic,500italic,700italic',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							//'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Ubuntu Condensed' => array(
			'sizes'		=> '',
			'type'		=> 'sans-serif',
			'targets'	=> array(
							//'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		/**
		 * Serif Fonts
		 */

		'Arvo' => array(
			'sizes'		=> '400,700,400italic,700italic',
			'type'		=> 'serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Bitter' => array(
			'sizes'		=> '400,400italic,700',
			'type'		=> 'serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Caudex' => array(
			'sizes'		=> '400,700,400italic,700italic',
			'type'		=> 'serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Droid Serif' => array(
			'sizes'		=> '400,700,400italic,700italic',
			'type'		=> 'serif',
			'targets'	=> array(
							//'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Kreon' => array(
			'sizes'		=> '400,700',
			'type'		=> 'serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Lora' => array(
			'sizes'		=> '400,700,400italic,700italic',
			'type'		=> 'serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		'Noto Serif' => array(
			'sizes'		=> '400,700,400italic,700italic',
			'type'		=> 'serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)

		),

		'Tinos' => array(
			'sizes'		=> '400,700,400italic,700italic',
			'type'		=> 'serif',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							'body_font'
						)
		),

		// Display Fonts

		'Comfortaa' => array(
			'sizes'		=> '400,700',
			'type'		=> 'display',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Patua One' => array(
			'sizes'		=> '',
			'type'		=> 'display',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		/**
		 * Handwriting Fonts
		 */

		'Caveat' => array(
			'sizes'		=> '400,700',
			'type'		=> 'handwriting',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Chilanka' => array(
			'sizes'		=> '',
			'type'		=> 'handwriting',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Gloria Hallelujah' => array(
			'sizes'		=> '',
			'type'		=> 'handwriting',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Love Ya Like A Sister' => array(
			'sizes'		=> '',
			'type'		=> 'handwriting',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Nothing You Could Do' => array(
			'sizes'		=> '',
			'type'		=> 'handwriting',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Patrick Hand' => array(
			'sizes'		=> '',
			'type'		=> 'handwriting',
			'targets'	=> array(
							'logo_font',
							'nav_font',
							'heading_font',
							//'body_font'
						)
		),

		'Shadows Into Light Two' => array(
			'sizes'		=> '',
			'type'		=> 'handwriting',
			'targets'	=> array(
							'logo_font',
							//'nav_font',
							'heading_font',
							//'body_font'
						)
		),

	);

}

add_filter( 'ctfw_google_fonts', 'jubilee_google_fonts' );
