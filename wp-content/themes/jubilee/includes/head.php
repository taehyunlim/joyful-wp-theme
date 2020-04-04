<?php
/**
 * <head> Functions
 *
 * Also see enqueue-styles.php and enqueue-scripts.php.
 *
 * @package    Jubilee
 * @subpackage Functions
 * @copyright  Copyright (c) 2019, ChurchThemes.com, LLC
 * @link       https://churchthemes.com/themes/jubilee
 * @license    GPLv2 or later
 * @since      1.0
 */

// No direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*******************************************
 * CUSTOM STYLES
 *******************************************/

/**
 * Opacity to use in rgba() for colored backgrounds
 * This is used in <head> and in Customizer preview
 *
 * @since 1.0
 */
function jubilee_rgb_opacity() {

	$opacity = '0.97';

	return apply_filters( 'jubilee_rgb_opacity', $opacity );

}

/**
 * Linear gradient values to use in jubilee_head_styles(), admin-customizer-preview.js and demo plugin.
 * This way can change once and affect all areas.
 *
 * @since 1.0
 * @return array Data for different sets of selectors
 */
function jubilee_gradients() {

	$gradients = array(
		'main_color_rgba'           => array( '120deg', '30%', '140%' ),
		'main_color_rgba_alt'       => array( '120deg', '0%', '160%' ),
		'accent_color_rgba'         => array( '120deg', '-20%', '120%' ),
		'highlight_color_rgba_half' => array( '180deg', '55%', '40%' ),
	);

	return apply_filters( 'jubilee_gradients', $gradients );

}

/**
 * Insert custom styles (colors, fonts, background, etc.) from Customizer for frontend and Classic Editor.
 *
 * @since 1.0
 */
function jubilee_head_styles() {

	// Colors
	$main_color = ctfw_customization( 'main_color' );
	$main_color_rgb = ctfw_hex_to_rgb( $main_color );
	$main_color_rgba = 'rgba(' . implode( ', ', $main_color_rgb ) . ', ' . jubilee_rgb_opacity() . ')'; // CSS
	$accent_color = ctfw_customization( 'accent_color' );
	$accent_color_rgb = ctfw_hex_to_rgb( $accent_color );
	$accent_color_rgba = 'rgba(' . implode( ', ', $accent_color_rgb ) . ', ' . jubilee_rgb_opacity() . ')'; // CSS
	$highlight_color = ctfw_customization( 'highlight_color' );
	$highlight_color_rgb = ctfw_hex_to_rgb( $highlight_color );
	$highlight_color_rgba = 'rgba(' . implode( ', ', $highlight_color_rgb ) . ', ' . jubilee_rgb_opacity() . ')'; // CSS

	// Fonts
	$logo_font_stack = ctfw_font_stack( ctfw_customization( 'logo_font' ), ctfw_google_fonts( 'logo_font' ) );
	$heading_font_stack = ctfw_font_stack( ctfw_customization( 'heading_font' ), ctfw_google_fonts( 'heading_font' ) );
	$nav_font_stack = ctfw_font_stack( ctfw_customization( 'nav_font' ), ctfw_google_fonts( 'nav_font' ) );
	$body_font_stack = ctfw_font_stack( ctfw_customization( 'body_font' ), ctfw_google_fonts( 'body_font' ) );

	// Gradients.
	$gradients = jubilee_gradients();

?>
<style type="text/css">
<?php echo jubilee_style_selectors( 'logo_font' ); ?> {
	font-family: <?php echo $logo_font_stack; ?>;
}

<?php echo jubilee_style_selectors( 'heading_font' ); ?> {
	font-family: <?php echo $heading_font_stack; ?>;
}

<?php echo jubilee_style_selectors( 'nav_font' ); ?> {
	font-family: <?php echo $nav_font_stack; ?>;
}

<?php echo jubilee_style_selectors( 'body_font' ); ?> {
	font-family: <?php echo $body_font_stack; ?>;
}

<?php echo jubilee_style_selectors( 'main_color' ); ?> {
	background: <?php echo $main_color; ?>;
}

<?php echo jubilee_style_selectors( 'main_color_rgba' ); ?> {
	background: <?php echo $main_color_rgba; ?>;
	background: linear-gradient( <?php echo $gradients['main_color_rgba'][0]; ?>, <?php echo $main_color_rgba; ?> <?php echo $gradients['main_color_rgba'][1]; ?>, <?php echo $accent_color_rgba; ?> <?php echo $gradients['main_color_rgba'][2]; ?>);
}

<?php echo jubilee_style_selectors( 'main_color_rgba_alt' ); ?> {
	background: <?php echo $main_color_rgba; ?>;
	background: linear-gradient( <?php echo $gradients['main_color_rgba_alt'][0]; ?>, <?php echo $main_color_rgba; ?> <?php echo $gradients['main_color_rgba_alt'][1]; ?>, <?php echo $accent_color_rgba; ?> <?php echo $gradients['main_color_rgba_alt'][2]; ?>);
}

<?php echo jubilee_style_selectors( 'main_color_border' ); ?> {
	border-color: <?php echo $main_color; ?> !important;
}

<?php echo jubilee_style_selectors( 'main_color_rgba_border' ); ?> {
	border-color: <?php echo $main_color_rgba; ?>;
}

<?php echo jubilee_style_selectors( 'main_color_text' ); ?> {
	color: <?php echo $main_color; ?> !important;
}

<?php echo jubilee_style_selectors( 'accent_color' ); ?> {
	color: <?php echo $accent_color; ?>;
}

<?php echo jubilee_style_selectors( 'accent_color_important' ); ?> {
	color: <?php echo $accent_color; ?> !important;
}

<?php echo jubilee_style_selectors( 'accent_color_border' ); ?> {
	border-color: <?php echo $accent_color; ?>;
}

<?php echo jubilee_style_selectors( 'accent_color_bg' ); ?> {
	background-color: <?php echo $accent_color; ?>;
}

<?php echo jubilee_style_selectors( 'accent_color_rgba' ); ?> {
	background: <?php echo $accent_color_rgba; ?>;
	background: linear-gradient( <?php echo $gradients['accent_color_rgba'][0]; ?>, <?php echo $accent_color_rgba; ?> <?php echo $gradients['accent_color_rgba'][1]; ?>, <?php echo $main_color_rgba; ?> <?php echo $gradients['accent_color_rgba'][2]; ?>);
}

<?php echo jubilee_style_selectors( 'highlight_color' ); ?> {
	color: <?php echo $highlight_color; ?>;
}

<?php echo jubilee_style_selectors( 'highlight_color_important' ); ?> {
	color: <?php echo $highlight_color; ?> !important;
}

<?php echo jubilee_style_selectors( 'highlight_color_rgba' ); ?> {
	background: <?php echo $highlight_color_rgba; ?>;
}

<?php echo jubilee_style_selectors( 'highlight_color_rgba_half' ); ?> {
	background: transparent;
	background: linear-gradient( <?php echo $gradients['highlight_color_rgba_half'][0]; ?>, transparent <?php echo $gradients['highlight_color_rgba_half'][1]; ?>, <?php echo $highlight_color; ?> <?php echo $gradients['highlight_color_rgba_half'][2]; ?> );
}

<?php echo jubilee_style_selectors( 'highlight_color_border' ); ?> {
	border-color: <?php echo $highlight_color; ?> !important;
}

</style>
<?php

}

add_action( 'wp_head', 'jubilee_head_styles' ); // add style to <head>

/**
 * Produce list of selectors for fonts, colors, etc. for frontend and Classic Editor.
 *
 * @since 1.0
 * @param string $group Group of selectors to return
 * @return string CSS selector list
 */
function jubilee_style_selectors( $group ) {

	$selectors = '';

	// Build elements array.
	$groups = array(

		// Font: Logo Text.
		'logo_font' => array(
			'#jubilee-logo-text'
		),

		// Font: Navigation (Menus, Buttons).
		'nav_font' => array(

			// Menus / Dropdowns
			'#jubilee-header-menu-content', // all menu links
			'.mean-container .mean-nav', // mobile menu top-level dropdown links (dropdowns are body font)
			'#jubilee-header-archives', // section nav
			'.jq-dropdown', // section nav dropdowns, calendar nav dropdowns, etc.
			'#jubilee-footer-menu',

			// Buttons use nav font
			'.jubilee-button',
			'.jubilee-buttons-list a',
			'.jubilee-menu-button > a',
			'input[type=submit]',
			'.widget_tag_cloud a',
			'.wp-block-file .wp-block-file__button',

		),

		// Font: Headings
		'heading_font' => array(

			// Major Headings
			// Those which use Heading Font below and in base-elements.scss
			// If update this, change those to be similar (also in media-queries.scss)
			'.jubilee-entry-content h1',
			'.jubilee-entry-content h2',
			'.jubilee-entry-content h3',
			'.jubilee-entry-content h4',
			'.jubilee-entry-content h5',
			'.jubilee-entry-content h6',
			'.jubilee-entry-content .jubilee-h1',
			'.jubilee-entry-content .jubilee-h2',
			'.jubilee-entry-content .jubilee-h3',
			'.jubilee-entry-content .jubilee-h4',
			'.jubilee-entry-content .jubilee-h5',
			'.jubilee-entry-content .jubilee-h6',
			'.mce-content-body h1',
			'.mce-content-body h2',
			'.mce-content-body h3',
			'.mce-content-body h4',
			'.mce-content-body h5',
			'.mce-content-body h6',
			'.textwidget h1',
			'.textwidget h2',
			'.textwidget h3',
			'.textwidget h4',
			'.textwidget h5',
			'.textwidget h6',
			'.jubilee-custom-section-content h1',
			'.jubilee-custom-section-content h2',
			'#jubilee-banner-title div',
			'.jubilee-widget-title',
			'.jubilee-caption-image-title',
			'#jubilee-comments-title',
			'#reply-title',
			'.jubilee-nav-block-title',
			'.has-drop-cap:not(:focus):first-letter',
			'#jubilee-map-section-address',

		),

		// Font: Body Text
		'body_font' => array(
			'body',
			'#cancel-comment-reply-link',
			'.jubilee-entry-short-meta a:not(.jubilee-icon)',
			'.jubilee-entry-content-short a',
			'.ctfw-breadcrumbs',
			'.jubilee-caption-image-description',
			'.jubilee-entry-full-meta-second-line',
			'#jubilee-header-archives-section-name',
			'.jubilee-comment-title span', // "Author" by name
			'#jubilee-calendar-title-category',
			'#jubilee-header-search-mobile input[type=text]',
			'.jubilee-entry-full-content .jubilee-sermon-index-list li li a:not(.jubilee-icon)',
			'pre.wp-block-verse',
			'.jubilee-entry-short-title a', // entry heading links
		),

		// Main Color (Background)
		'main_color' => array(

			// Note: main_color_rgba gradient not right in ever browser, so using solid color.
			'.jubilee-calendar-table-top',
			'.jubilee-calendar-table-header-row', // fills gaps in Retina when resizing

			// Buttons.
			'.jubilee-button:not(.jubilee-button-secondary)',
			'.jubilee-buttons-list a:not(.jubilee-button-secondary)',
			'input[type=submit]:not(.jubilee-button-secondary)',
			'.jubilee-nav-left-right a',
			'.wp-block-file .wp-block-file__button',

		),

		// Main Color (Background, RGB, Semi-transparent)
		'main_color_rgba' => array(
			'.jubilee-color-main-bg',
			'#jubilee-header-top-bg',
			'.page-template-homepage #jubilee-header-top-bg',
			'.tooltipster-sidetip.jubilee-tooltipster .tooltipster-box',
			'.has-main-background-color',
			'p.has-main-background-color',
		),

		// Main Color (Background, RGB, Semi-transparent) - Alternative (for pages headers with no image).
		'main_color_rgba_alt' => array(
			'.jubilee-color-main-bg-alt',
		),

		// Main Color (Border)
		'main_color_border' => array(
			'.jubilee-button.jubilee-button-secondary:hover',
			'.jubilee-buttons-list a.jubilee-button-secondary:hover',
			'.widget_tag_cloud a:hover',
		),

		// Main Color (Border, RGB, Semi-transparent)
		'main_color_rgba_border' => array(
			'#jubilee-header-top.jubilee-header-has-line',
		),

		// Main Color (Text)
		'main_color_text' => array(

			'.jubilee-entry-content a:hover:not(.jubilee-button):not(.wp-block-file__button)',
			'.jubilee-entry-compact-right a:hover',
			'.jubilee-entry-full-meta a:hover',
			'a:hover',
			'#jubilee-map-section-list a:hover',
			'.jubilee-entry-full-meta a:hover', // full posts, not compact/widget excerpt
			'.jubilee-entry-full-content .jubilee-entry-short-meta a:hover',
			'.jubilee-entry-full-meta > li a.mdi:hover',
			'#respond a:hover',
			'.mean-container .mean-nav ul li a.mean-expand',
			'.has-main-color',
			'p.has-main-color',

			// Buttons text on hover
			'.jubilee-button.jubilee-button-secondary:hover',
			'.jubilee-buttons-list a.jubilee-button-secondary:hover',
			'.widget_tag_cloud a:hover',

		),

		// Accent Color
		'accent_color' => array(
			'a',
			'p.has-text-color:not(.has-background) a',// nullify p.has-text-color a inherit set by block editor, when no background
			'#jubilee-map-section-marker .jubilee-icon', // map marker icon
			'#jubilee-calendar-remove-category a:hover',
			'#jubilee-calendar-header-right a',
			'.widget_search .jubilee-search-button:hover',
		),

		// Accent Color (!important declaration)
		'accent_color_important' => array(
			'.jubilee-button.jubilee-button-secondary',
			'.jubilee-buttons-list a.jubilee-button-secondary',
			'.widget_tag_cloud a',
			'.has-accent-color',
			'p.has-accent-color',
		),

		// Accent Color
		'accent_color_rgba' => array(

			'.jubilee-color-accent-bg',
			'#jubilee-sticky-inner',

			// Dropdowns.
			'.sf-menu ul', // menu dropdowns
			'.mean-container .mean-nav', // mobile menu
			'.jq-dropdown .jq-dropdown-menu', // section nav dropdowns, calendar nav dropdowns, etc.
			'.jq-dropdown .jq-dropdown-panel', // section nav dropdowns, calendar nav dropdowns, etc.

		),

		// Accent Color (Border)
		'accent_color_border' => array(

			// Light buttons on hover
			'.jubilee-button.jubilee-button-secondary',
			'.jubilee-buttons-list a.jubilee-button-secondary',
			'.widget_tag_cloud a',

			// Forms
			'input:focus',
			'textarea:focus',

		),

		// Accent Color (Background)
		'accent_color_bg' => array(

			'.has-accent-background-color',
			'p.has-accent-background-color',

			// Buttons hover.
			'.jubilee-button:not(.jubilee-button-secondary):hover',
			'.jubilee-buttons-list a:not(.jubilee-button-secondary):hover',
			'input[type=submit]:not(.jubilee-button-secondary):hover',
			'.jubilee-nav-left-right a:not(.jubilee-button-secondary):hover',
			'.wp-block-file .wp-block-file__button:not(.jubilee-button-secondary):hover',

		),

		// Highlight Color.
		'highlight_color' => array(
			'#jubilee-header-menu-content > li.jubilee-menu-button > a',
			'.jubilee-sticky-item-title:hover',
		),

		// Highlight Color (Important).
		'highlight_color_important' => array(

			'#jubilee-header-menu-content > li:hover > a', // top-level link (keeps top-level colored while hovering on submenu)
			'.mean-container .mean-nav ul li a:not(.mean-expand):hover',
			'#jubilee-header-search a:hover',
			'#jubilee-footer-menu a:hover',
			'#jubilee-footer-notice a:hover',
			'#jubilee-sticky-content-custom-content a:hover',

			// Dropdowns.
			'#jubilee-header-menu-content ul > li:hover > a',
			'#jubilee-header-menu-content ul ul li:hover > a',
			'#jubilee-header-menu-content ul ul li.sfHover > a',
			'#jubilee-header-menu-content ul ul li a:focus',
			'#jubilee-header-menu-content ul ul li a:hover',
			'#jubilee-header-menu-content ul ul li a:active',

			// Section and calendar dropdowns
			'#jubilee-dropdown-container a:hover',
			'.jq-dropdown .jq-dropdown-menu a:hover', // section nav dropdowns, calendar nav dropdowns, etc.
			'.jq-dropdown .jq-dropdown-panel a:hover', // section nav dropdowns, calendar nav dropdowns, etc.

		),

		// Highlight Color (Background, RGBA)
		'highlight_color_rgba' => array(
			'.jubilee-entry-compact-image time',
			'.jubilee-entry-compact-date time',
			'.jubilee-entry-short-label',
			'.jubilee-colored-section-label',
			'.jubilee-comment-meta time',
			'.jubilee-entry-full-meta > li.jubilee-entry-full-date .jubilee-event-date-label',
			'.jubilee-entry-full-meta > li.jubilee-entry-full-meta-bold',
			'.jubilee-sticky-item-date',
			'#jubilee-map-section-date .jubilee-map-section-item-text',
			'.jubilee-calendar-table-day-today .jubilee-calendar-table-day-heading',
			'#jubilee-header-archives',
			'.jubilee-calendar-table-day-today-bg',
		),

		// Highlight Color (Background, RGBA) - Half / Underline
		'highlight_color_rgba_half' => array(
			'body:not(.jubilee-no-mark) mark',
		),

		// Highlight Color (Border)
		'highlight_color_border' => array(
			'.jubilee-menu-button > a',
		),

	);

	// Allow filtering
	$groups = apply_filters( 'jubilee_style_selectors', $groups );

	// Build list
	if ( ! empty( $groups[$group] ) ) {
		$selectors = implode( ', ', $groups[$group] );
	}

	return $selectors;

}

/*******************************************
 * BLOCK EDITOR CUSTOM STYLES
 *******************************************/

/**
 * Block Editor <head> Styles
 *
 * Output a version of jubilee_head_styles() tailored to Gutenberg.
 *
 * This is called by ctfw_editor_styles() when specified in add_theme_support( 'ctfw-editor-styles' ) css_block_function.
 *
 * @since 1.2
 */
function jubilee_block_editor_head_styles() {

	// Colors
	$main_color = ctfw_customization( 'main_color' );
	$main_color_rgb = ctfw_hex_to_rgb( $main_color );
	$main_color_rgba = 'rgba(' . implode( ', ', $main_color_rgb ) . ', ' . jubilee_rgb_opacity() . ')'; // CSS
	$accent_color = ctfw_customization( 'accent_color' );
	$accent_color_rgb = ctfw_hex_to_rgb( $accent_color );
	$accent_color_rgba = 'rgba(' . implode( ', ', $accent_color_rgb ) . ', ' . jubilee_rgb_opacity() . ')'; // CSS
	$highlight_color = ctfw_customization( 'highlight_color' );
	$highlight_color_rgb = ctfw_hex_to_rgb( $highlight_color );
	$highlight_color_rgba = 'rgba(' . implode( ', ', $highlight_color_rgb ) . ', ' . jubilee_rgb_opacity() . ')'; // CSS

	// Fonts
	$logo_font_stack = ctfw_font_stack( ctfw_customization( 'logo_font' ), ctfw_google_fonts( 'logo_font' ) );
	$heading_font_stack = ctfw_font_stack( ctfw_customization( 'heading_font' ), ctfw_google_fonts( 'heading_font' ) );
	$nav_font_stack = ctfw_font_stack( ctfw_customization( 'nav_font' ), ctfw_google_fonts( 'nav_font' ) );
	$body_font_stack = ctfw_font_stack( ctfw_customization( 'body_font' ), ctfw_google_fonts( 'body_font' ) );

	// Gradients.
	$gradients = jubilee_gradients();

?>
<style type="text/css">

<?php echo jubilee_block_editor_style_selectors( 'heading_font' ); ?> {
	font-family: <?php echo $heading_font_stack; ?>;
}

<?php echo jubilee_block_editor_style_selectors( 'nav_font' ); ?> {
	font-family: <?php echo $nav_font_stack; ?>;
}

<?php echo jubilee_block_editor_style_selectors( 'body_font' ); ?> {
	font-family: <?php echo $body_font_stack; ?>;
}

<?php echo jubilee_block_editor_style_selectors( 'main_color' ); ?> {
	background-color: <?php echo $main_color; ?> !important;
}

<?php echo jubilee_block_editor_style_selectors( 'main_color_rgba' ); ?> {
	background: <?php echo $main_color; ?>;
	background: linear-gradient( <?php echo $gradients['main_color_rgba'][0]; ?>, <?php echo $main_color_rgba; ?> <?php echo $gradients['main_color_rgba'][1]; ?>, <?php echo $accent_color_rgba; ?> <?php echo $gradients['main_color_rgba'][2]; ?>);
}

<?php echo jubilee_block_editor_style_selectors( 'main_color_rgba_alt' ); ?> {
	background: <?php echo $main_color; ?>;
	background: linear-gradient( <?php echo $gradients['main_color_rgba_alt'][0]; ?>, <?php echo $main_color_rgba; ?> <?php echo $gradients['main_color_rgba_alt'][1]; ?>, <?php echo $accent_color_rgba; ?> <?php echo $gradients['main_color_rgba_alt'][2]; ?>);
}

<?php echo jubilee_block_editor_style_selectors( 'main_color_border' ); ?> {
	border-color: <?php echo $main_color; ?> !important;
}

<?php echo jubilee_block_editor_style_selectors( 'main_color_rgba_border' ); ?> {
	border-color: <?php echo $main_color_rgba; ?>;
}

<?php echo jubilee_block_editor_style_selectors( 'main_color_text' ); ?> {
	color: <?php echo $main_color; ?> !important;
}

<?php echo jubilee_block_editor_style_selectors( 'accent_color' ); ?> {
	color: <?php echo $accent_color; ?>;
}

<?php echo jubilee_block_editor_style_selectors( 'accent_color_important' ); ?> {
	color: <?php echo $accent_color; ?> !important;
}

<?php echo jubilee_block_editor_style_selectors( 'accent_color_border' ); ?> {
	border-color: <?php echo $accent_color; ?>;
}

<?php echo jubilee_block_editor_style_selectors( 'accent_color_bg' ); ?> {
	background-color: <?php echo $accent_color; ?>;
}

<?php echo jubilee_block_editor_style_selectors( 'accent_color_rgba' ); ?> {
	background: <?php echo $accent_color; ?>;
	background: linear-gradient( <?php echo $gradients['accent_color_rgba'][0]; ?>, <?php echo $accent_color_rgba; ?> <?php echo $gradients['accent_color_rgba'][1]; ?>, <?php echo $main_color_rgba; ?> <?php echo $gradients['accent_color_rgba'][2]; ?>);
}

<?php echo jubilee_block_editor_style_selectors( 'highlight_color' ); ?> {
	color: <?php echo $highlight_color; ?>;
}

<?php echo jubilee_block_editor_style_selectors( 'highlight_color_important' ); ?> {
	color: <?php echo $highlight_color; ?> !important;
}

<?php echo jubilee_block_editor_style_selectors( 'highlight_color_rgba' ); ?> {
	background: <?php echo $highlight_color_rgba; ?>;
}

<?php echo jubilee_block_editor_style_selectors( 'highlight_color_rgba_half' ); ?> {
	background: <?php echo $highlight_color_rgba; ?>;
	background: linear-gradient( <?php echo $gradients['highlight_color_rgba_half'][0]; ?>, transparent <?php echo $gradients['highlight_color_rgba_half'][1]; ?>, <?php echo $highlight_color; ?> <?php echo $gradients['highlight_color_rgba_half'][2]; ?> );
}

<?php echo jubilee_block_editor_style_selectors( 'highlight_color_border' ); ?> {
	border-color: <?php echo $highlight_color; ?> !important;
}

</style>
<?php

}

/**
 * Produce list of selectors for fonts, colors, etc. for Block Editor.
 *
 * This is used by jubilee_block_editor_head_styles() for Gutenberg only.
 *
 * @since 1.0
 * @param string $group Group of selectors to return
 * @return string CSS selector list
 */
function jubilee_block_editor_style_selectors( $group ) {

	$selectors = '';

	// Build elements array
	$groups = array(

		// Font: Navigation (Menus, Buttons).
		'nav_font' => array(

			// Buttons use nav font
			'.edit-post-visual-editor .wp-block-button__link',
			'.edit-post-visual-editor .jubilee-button',
			'.wp-block-file__button',

		),

		// Font: Headings
		'heading_font' => array(

			// Post Title.
			'.editor-post-title .editor-post-title__input',

			// Headings.
			'.edit-post-visual-editor .wp-block-heading h1',
			'.edit-post-visual-editor .wp-block-heading h2',
			'.edit-post-visual-editor .wp-block-heading h3',
			'.edit-post-visual-editor .wp-block-heading h4',
			'.edit-post-visual-editor .wp-block-heading h5',
			'.edit-post-visual-editor .wp-block-heading h6',

			// Classic Block.
			'.wp-block-freeform.block-library-rich-text__tinymce h1',
			'.wp-block-freeform.block-library-rich-text__tinymce h2',
			'.wp-block-freeform.block-library-rich-text__tinymce h3',
			'.wp-block-freeform.block-library-rich-text__tinymce h4',
			'.wp-block-freeform.block-library-rich-text__tinymce h5',
			'.wp-block-freeform.block-library-rich-text__tinymce h6',

			// Dropcap.
			'.edit-post-visual-editor .has-drop-cap:not(:focus):first-letter',


		),

		// Font: Body Text
		'body_font' => array(

			'.edit-post-visual-editor',
			'.edit-post-visual-editor p',
			'.edit-post-visual-editor .editor-default-block-appender input[type=text].editor-default-block-appender__content', // body placeholder.
			'.edit-post-visual-editor .wp-block-verse .block-editor-rich-text__editable',
			'.edit-post-visual-editor .wp-block-freeform blockquote:before', // Classic Editor
			'.edit-post-visual-editor .wp-block-latest-comments__comment-date',
			'.edit-post-visual-editor .wp-block-rss',
			'.edit-post-visual-editor .block-library-list .block-editor-rich-text__editable',
			'.edit-post-visual-editor .wp-block-search__input',
			'.edit-post-visual-editor figcaption',

			// Tables, etc.
			'.wp-block-freeform.block-library-rich-text__tinymce dt',
			'.edit-post-visual-editor .wp-block-freeform dt',
			'.edit-post-visual-editor .wp-block-table',
			'.edit-post-visual-editor .wp-block-table table',
			'.edit-post-visual-editor .wp-block-table td',
			'.edit-post-visual-editor .wp-block-table th',
			'.edit-post-visual-editor .wp-block-table tr:first-of-type .block-editor-rich-text__editable',
			'.wp-block-freeform.block-library-rich-text__tinymce th',
			'.edit-post-visual-editor .wp-block-quote__citation.block-editor-rich-text__editable',
			'.edit-post-visual-editor .wp-block-pullquote__citation.block-editor-rich-text__editable',
			'.edit-post-visual-editor .wp-block-pullquote cite',
			'.wp-block-freeform.block-library-rich-text__tinymce blockquote cite',
			'.wp-block-latest-comments__comment-author',
			'.wp-block-search__label .block-editor-rich-text__editable',
			'.wp-block-calendar #wp-calendar caption',
			'.wp-block-calendar #wp-calendar th',
			'.wp-block-file__textlink .block-editor-rich-text__editable',
			'.wp-block-latest-comments__comment',
			'.wp-block-latest-posts',
			'.wp-block-categories',
			'.wp-block-archives',
			'.edit-post-visual-editor .wp-caption-dd', // classic editor
			'.edit-post-visual-editor .gallery-caption', // classic editor

		),

		// Main Color (Background)
		'main_color' => array(

			// Buttons.
			'.edit-post-visual-editor .wp-block-button__link',
			'.edit-post-visual-editor .wp-block-button__link.has-background',
			'.edit-post-visual-editor .wp-block-button__link.has-main-background-color',
			'.edit-post-visual-editor .wp-block-button__link.has-accent-background-color',
			'.edit-post-visual-editor .wp-block-button__link.has-highlight-background-color',
			'.edit-post-visual-editor .jubilee-button',
			'.edit-post-visual-editor .wp-block-file .wp-block-file__button',

		),

		// Main Color (Background, RGB, Semi-transparent)
		'main_color_rgba' => array(
			'.edit-post-visual-editor .editor-post-title',
			'.edit-post-visual-editor .jubilee-color-main-bg',
			'.edit-post-visual-editor .has-main-background-color:not(.has-background)',
			'.edit-post-visual-editor p.has-main-background-color',
		),

		// Main Color (Background, RGB, Semi-transparent) - Alternative (for pages headers with no image).
		'main_color_rgba_alt' => array(

		),

		// Main Color (Border)
		'main_color_border' => array(

		),

		// Main Color (Border, RGB, Semi-transparent)
		'main_color_rgba_border' => array(

		),

		// Main Color (Text)
		'main_color_text' => array(
			'.edit-post-visual-editor .has-main-color',
			'.edit-post-visual-editor p.has-main-color',
		),

		// Accent Color
		'accent_color' => array(
			'.wp-block-freeform.block-library-rich-text__tinymce a',
			'.editor-block-list__block-edit a:not(.blocks-format-toolbar__link-value)',
			'.wp-block-file__textlink .block-editor-rich-text__editable',
		),

		// Accent Color (!important declaration)
		'accent_color_important' => array(
			'.has-accent-color:not(.wp-block-button__link)',
			'p.has-accent-color',
		),

		// Accent Color
		'accent_color_rgba' => array(

		),

		// Accent Color (Border)
		'accent_color_border' => array(

			// Headings.
			'.edit-post-visual-editor .wp-block-heading h1::before',
			'.edit-post-visual-editor .wp-block-heading h2::before',
			'.edit-post-visual-editor .wp-block-heading h3::before',
			'.edit-post-visual-editor .wp-block-heading h4::before',
			'.edit-post-visual-editor .wp-block-heading h5::before',
			'.edit-post-visual-editor .wp-block-heading h6::before',

			// Classic Block.
			'.wp-block-freeform.block-library-rich-text__tinymce h1::before',
			'.wp-block-freeform.block-library-rich-text__tinymce h2::before',
			'.wp-block-freeform.block-library-rich-text__tinymce h3::before',
			'.wp-block-freeform.block-library-rich-text__tinymce h4::before',
			'.wp-block-freeform.block-library-rich-text__tinymce h5::before',
			'.wp-block-freeform.block-library-rich-text__tinymce h6::before',

		),

		// Accent Color (Background)
		'accent_color_bg' => array(
			'.edit-post-visual-editor .has-accent-background-color:not(.wp-block-button__link)',
			'.edit-post-visual-editor p.has-accent-background-color',
		),

		// Highlight Color.
		'highlight_color' => array(

		),

		// Highlight Color (Important).
		'highlight_color_important' => array(

		),

		// Highlight Color (Background, RGBA)
		'highlight_color_rgba' => array(

		),

		// Highlight Color (Background, RGBA) - Half / Underline
		'highlight_color_rgba_half' => array(

			// Headings.
			'.edit-post-visual-editor mark',

			// Classic Block.
			'.wp-block-freeform.block-library-rich-text__tinymce mark',

		),

		// Highlight Color (Border)
		'highlight_color_border' => array(

		),

	);

	// Allow filtering.
	$groups = apply_filters( 'jubilee_block_editor_style_selectors', $groups );

	// Build list.
	if ( ! empty( $groups[ $group ] ) ) {
		$selectors = implode( ', ', $groups[ $group ] );
	}

	return $selectors;

}

/******************************************
 * JAVASCRIPT DETECTION
 ******************************************/

/**
 * Remove no-js and add js class to <html>
 *
 * Do this directly in <head> to it happens immediately (no wait for JS file to load or document ready)
 * This helps eliminate "flicker" effects in CSS due to a delay in classes being applied
 *
 * To Do: This could be made into a framework feature.
 *
 * @since 1.0
 */
function jubilee_head_js_classes() {

?>
<script type="text/javascript">

jQuery( 'html' )
 	.removeClass( 'no-js' )
 	.addClass( 'js' );

</script>
<?php

}

add_action( 'wp_head', 'jubilee_head_js_classes' );
