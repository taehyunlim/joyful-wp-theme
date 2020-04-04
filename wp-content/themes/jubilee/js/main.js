/**
 * Main JavaScript
 */

/*---------------------------------------------
 * Variables
 *--------------------------------------------*/

// Max width for mobile
var jubilee_mobile_width = 920; // match values in _media-queries.scss (multiple instances)

/*---------------------------------------------
 * <head>
 *--------------------------------------------*/

// Stop Edge browser from linking phone numbers.
// Later, when possible, style the links instead of removing.
if ( /Edge/.test( navigator.userAgent ) ) {
	jQuery( 'head' ).append( '<meta name="format-detection" content="telephone=no">' );
}

/*---------------------------------------------
 * DOM Loaded
 *--------------------------------------------*/

// DOM is fully loaded
jQuery( document ).ready( function( $ ) {

	/**********************************************
	 * LAYOUT
	 **********************************************/

	/*---------------------------------------------
	 * Match Height
	 *--------------------------------------------*/

	// Set certain elements' height equal per row (short entries, gallery items)
	jubilee_match_height();

	/*---------------------------------------------
	 * Header Menu
	 *--------------------------------------------*/

	 setTimeout( function() { // helps with mobile menu icon position old iOS
		jubilee_activate_menu();
	 }, 50 );

	 // If header menu wraps to two lines, add body class
	 // for special handling of dropdowns
	jubilee_check_menu_height();
	$( window ).resize( jubilee_check_menu_height ); // again on resize

	// Prevent items having .jubilee-menu-button from turning light on hover
	$( '.jubilee-menu-button a' ).each( function() {
		$( this ).addClass( 'jubilee-button-not-light' );
	} );

	/*---------------------------------------------
	 * Header Search
	 *--------------------------------------------*/

	// Open Search
	$( '#jubilee-header-search-open' ).click( function( e ) {

		// Stop regular click action
		e.preventDefault();

		// Add body class for "search is open"
		// See media queries for hiding logo on mobile
		$( 'body' ).addClass( 'jubilee-search-is-open' );

		// Focus on search input
		$( '#jubilee-header-search input' ).focus();

	} );

	// Close Search
	$( '#jubilee-header-search-close' ).click( function( e ) {

		// Stop regular click action
		e.preventDefault();

		// Remove body class for "search is open"
		jQuery( 'body' ).removeClass( 'jubilee-search-is-open' );

		// Snap mobile menu icon into proper position
		$( window ).resize();

	} );

	/*---------------------------------------------
	 * Header Banner
	 *--------------------------------------------*/

	if ( $( '#jubilee-banner' ).length ) {

		// Fade banner in after image loads (prevent flash of Main Color in BG)
		$( '#jubilee-banner' ).waitForImages(function() {

			if ( ! jubilee_is_mobile() ) { // not on mobile (poor performance)
				$( this ).hide().css( 'visibility', 'visible' ).fadeIn( 300 );
			} else {
				$( this ).css( 'visibility', 'visible' );
			}

		} );

	}

	/*---------------------------------------------
	 * Header Archives (Dropdowns)
	 *--------------------------------------------*/

	if ( $( '#jubilee-header-archives' ).length ) {

		// Enable dropdowns
		$( 'a.jubilee-header-archive-top-name' ).each( function() {

			var $link, $dropdown, dropdown_id;

			$link = $( this );
			$dropdown = $link.next( '.jubilee-header-archive-dropdown' );
			dropdown_id = $dropdown.attr( 'id' );

			// Move it to before </body> where jQuery Dropdown works best
			$( '<div id="jubilee-dropdow-container" style="position: static"></div>' ).appendTo( 'body' );
			$dropdown.appendTo( '#jubilee-dropdow-container' );

			// Attach dropdown to control
			$link.jqDropdown( 'attach', '#' + dropdown_id );

		} );

	}

	/*---------------------------------------------
	 * Footer
	 *--------------------------------------------*/

	// Move icons/notice after menu on mobile (when centered)
	// Using jQuery rather than flexbox for full browser support
	jubilee_rearrange_footer();
	$( window ).resize( jubilee_rearrange_footer );

	// Footer sticky show/hide
	// Show latest events, comments, etc.
	// Hide sticky when scroll to/from footer to prevent covering copyright, etc.
	// Also hide on homepage when not scrolled beneath the first section
	jubilee_show_footer_sticky();
	$( window ).scroll( jubilee_show_footer_sticky );

	// Footer sticky dismiss
	$( '#jubilee-sticky-dismiss a' ).click( function() {

		event.preventDefault();

		// Set cookie
		// Use JS Cookie - enqueued already
		Cookies.set( 'jubilee_sticky_dismissed', '1', {
			expires: 1, // hide for today
			path : jubilee_main.site_path, // work on any page
			secure : jubilee_main.is_ssl
		} );

		// Hide manually
		$( '#jubilee-sticky' ).fadeOut();

	} );

	/*---------------------------------------------
	 * Search Forms (Header, Widget, etc.)
	 *--------------------------------------------*/

	// Trim search query and stop if empty
	// Note: This presently has no effect on mobile menu (see notes above; same cause)
	$( '.jubilee-search-form form' ).submit( function( event ) {

		var s;

		s = $( 'input[name=s]', this ).val().trim();

		if ( s.length ) { // submit trimmed value
			$( 'input[name=s]', this ).val( s );
		} else { // empty, stop
			event.preventDefault();
		}

	} );

	/*---------------------------------------------
	 * Scrolling
	 *--------------------------------------------*/

	// Single.
	if ( $( 'body.single' ).length ) {

		// Scroll to comments or any other anchor
		var hash = window.location.hash;
		if ( hash ) {

			setTimeout( function() {

				// Scroll down
				$.smoothScroll( {
					scrollTarget: hash,
					offset: -160, // consider sticky bar
					easing: 'swing',
					speed: 1200,
				} );

			}, 10 );

		}

	}

	// Homepage sections.
	if ( $( 'body.home' ).length ) {

		// Scroll to sections when URL has hash.
		var hash = window.location.hash;
		if ( hash ) {

			// Scroll down
			$.smoothScroll( {
				scrollTarget: hash,
				offset: -120, // consider sticky bar
				easing: 'swing',
				speed: 1200,
			} );

		}

		// Scroll to section when link with hash clicked.
		// Example: <a href="#jubilee-home-section-4">.
		$( 'a[href*=jubilee-home-section-]' ).on( 'click', function() {

			var href = $( this ).attr( 'href' );
			var hash = href.substr( href.indexOf( '#' ) );

			$.smoothScroll( {
				scrollTarget: hash,
				offset: -120, // consider sticky bar
				easing: 'swing',
				speed: 1200,
			} );

			return false;

		} );

	}

	/*---------------------------------------------
	 * Map
	 *--------------------------------------------*/

	$( '#jubilee-map-section-content' ).fadeIn();

	/*---------------------------------------------
	 * Homepage
	 *--------------------------------------------*/

	if ( $( '.page-template-homepage' ).length ) {

		// Fade in first section, if it is first widget on homepage - and has image
		if ( ! jubilee_is_mobile() ) { // not on mobile (better performance)
			$( '.jubilee-image-section.jubilee-section-has-image.jubilee-first-home-widget' ).hide().css( 'visibility', 'visible' ).fadeIn( 400 );
		} else {
			$( '.jubilee-image-section.jubilee-section-has-image.jubilee-first-home-widget' ).hide().css( 'visibility', 'visible' ).show();
		}

	}

	/*---------------------------------------------
	 * Post Navigation
	 *--------------------------------------------*/

	// Make nav blocks on single posts click anywhere
	$( '.jubilee-nav-block' ).click( function() {

		var url;

		url = $( '.jubilee-nav-block-title', this ).prop( 'href' );

		if ( url ) {
			window.location = url;
		}

	} );

	/*---------------------------------------------
	 * Entries
	 *--------------------------------------------*/

	// Regular narrow template only.
	if ( $( '.jubilee-content-width-700' ).length ) {

		// Add class to images in full content big enough to make exceed content width.
		$( 'img.alignnone, img.aligncenter', $( '.jubilee-entry-full-content > p' ) ).each( function() {

			var img_width;

			img_width = parseFloat( $( this ).attr( 'width' ) );

			if ( img_width >= 980 ) {
				$( this ).parents( 'p' ).addClass( 'jubilee-image-exceed-700-980' );
			}

		} );

		// Add class to wide Gutenberg elements that are NOT a container (and put them in container).
		$( '.wp-block-cover.alignwide, .wp-block-cover.alignfull, .wp-block-gallery.alignwide, .wp-block-gallery.alignfull, .wp-block-columns.alignwide, .wp-block-columns.alignfull, .wp-block-table.alignwide, .wp-block-table.alignfull', $( '.jubilee-entry-full-content' ) ).each( function() {

			// Add container before element.
			var $container = $('<div class="jubilee-image-exceed-700-980 jubilee-block-wide-container"></div>');
			$( this ).after( $container );

			// Move element into container.
			$( this ).appendTo( $container );

		} );

		// Add class to wide Gutenberg elements that ARE in a container.
		$( '.wp-block-image.alignwide, .wp-block-image.alignfull, .wp-block-embed.alignwide, .wp-block-embed.alignfull, .wp-block-video.alignwide, .wp-block-video.alignfull, .wp-block-audio.alignwide, .wp-block-audio.alignfull, .wp-block-pullquote.alignwide, .wp-block-pullquote.alignfull, .wp-block-media-text.alignwide, .wp-block-media-text.alignfull', $( '.jubilee-entry-full-content' ) ).each( function() {
			$( this ).addClass( 'jubilee-image-exceed-700-980' );
		} );

	}

	/*---------------------------------------------
	 * Sermons
	 *--------------------------------------------*/

	if ( $( '.single-ctc_sermon' ).length ) {

		// Scroll down to article when "Read" is clicked
		$( '#jubilee-sermon-read-button a' ).click( function( e ) {

			e.preventDefault();

			if ( $( '#jubilee-sermon-content' ).length ) {

				var content_top = $( '#jubilee-sermon-content' ).position().top;

				$.smoothScroll( {
					offset: content_top - 135, // consider sticky bar
					easing: 'swing',
					speed: 1200,
				} );

			}

		} );

		// Dropdown for download links on Save button
		$( '#jubilee-sermon-download-button a' )
			.jqDropdown( 'attach', '#jubilee-sermon-download-dropdown' );

	}

	/*---------------------------------------------
	 * Single Event
	 *--------------------------------------------*/

	// Single event only
	if ( $( '.jubilee-event-full' ).length ) {

		// Recurrence / Excluded Dates tooltip
		$( '.jubilee-map-section-item-note a, .jubilee-event-recurrence a, .jubilee-event-excluded-dates a' ).tooltipster( {
			theme: 'jubilee-tooltipster',
			arrow: false,
			animation: 'fade',
			speed: 250, // fade speed
		    trigger: 'custom', // below works on mobile...
		    triggerOpen: {
		        mouseenter: true,
		        touchstart: true
		    },
		    triggerClose: {
		        scroll: true,
		        tap: true,
				mouseleave: true,
		    }
		} ).click( function( e ) {
			e.preventDefault(); // stop clicks
		});

	}

	/*---------------------------------------------
	 * Events Calendar
	 *--------------------------------------------*/

	// Calendar template only
	if ( $( '#jubilee-calendar' ).length ) {

		// Attach dropdowns to controls
		jubilee_attach_calendar_dropdowns();

		// AJAX-load event calendar when use controls
		// This keeps page from reloading and scrolling to top
		// PJAX updates URL, <title> and browser/back history
		$( document ).pjax( '.jubilee-calendar-control, .jubilee-calendar-dropdown a', '#jubilee-calendar', {
			fragment: '#jubilee-calendar', // replace only the calendar
			scrollTo: false, // don't scroll to top after loading
			timeout: 5000, // page reloads after timeout (default 650)
		} );

		// Loading indicator
		$( document ).on( 'pjax:send', function() {
			$( '.jubilee-calendar-dropdown-control' ).jqDropdown( 'hide' ); // hide controls
			$( '#jubilee-calendar-loading' ).show();
		})
		$( document ).on( 'pjax:complete', function() {
			$( '#jubilee-calendar-loading' ).hide();
		})

		// After contents replaced
		$( document ).on( 'pjax:success', function() {

			// Re-attach dropdowns to controls
			jubilee_attach_calendar_dropdowns();

			// Re-activate tooltip hovering
			jubilee_activate_calendar_hover();

		} );

		// Hide dropdowns on back/forward
		$( document ).on( 'pjax:popstate', function( e ) {
			if ( e.direction ) {
				$( '.jubilee-calendar-dropdown-control' ).jqDropdown( 'hide' );
			}
		} );

		// Use Tooltipster to show event hover for each link
		jubilee_activate_calendar_hover();

		// Handle mobile clicks on linked days
		$( document ).on( 'click', 'a.jubilee-calendar-table-day-number', function( e ) {

			var $day, $events, date_formatted, scroll_offset;

			e.preventDefault();

			// Get day cell
			$day = $( this ).parents( 'td' );

			// Show heading for date
			date_formatted = $day.attr( 'data-date-formatted' );
			$( '#jubilee-calendar-list h3:first-of-type' ).remove();
			$( '#jubilee-calendar-list' ).prepend( '<h3 id="jubilee-calendar-list-heading">' + date_formatted + '</h3>' );
			$( '#jubilee-calendar-list-heading' ).show();

			// Hide all events in list and show list container
			$( '#jubilee-calendar-list .jubilee-event-short' ).hide();
			$( '#jubilee-calendar-list' ).show();

			// Show all events for this day
			$events = $( '.jubilee-calendar-table-day-events li', $day );
			$events.each( function() {

				var event_id;

				// Get event ID
				event_id = $( this ).attr( 'data-event-id' );

				// Show that event in list
				$( '#jubilee-calendar-list .jubilee-event-short[data-event-id="' + event_id + '"]' ).show();

			} );

			// Scroll down if events are out of view
			// Otherwise user sees no change
			if ( ! $( '#jubilee-calendar-list-heading' ).visible() ) {

				// Scroll events into bottom of screen
				scroll_offset = 0 - $( window ).height() + 150; // negative

				$.smoothScroll( {
					scrollTarget: '#jubilee-calendar-list-heading',
					offset: scroll_offset,
					easing: 'swing',
					speed: 800
				} );

			}

		} );

	}

	/*---------------------------------------------
	 * Galleries
	 *--------------------------------------------*/

	// Make clicks on caption also go to URL
	$( '.gallery-caption' ).click( function() {

		var $parent, url;

		$parent = $( this ).parent();
		url = $( 'a', $parent ).prop( 'href' );

		// Go to URL if no data- attributes, which indicate Jetpack Carousel or possbily other lightbox
		if ( url && $.isEmptyObject( $( '.gallery-icon img', $parent ).data() ) ) {
			window.location = url;
		}

	} );

	/*---------------------------------------------
	 * Comments
	 *--------------------------------------------*/

	// Scroll to comments on click Comments sticky or comment permalink
	if ( $( 'a.jubilee-scroll-to-comments' ).length ) {
		$( 'a.jubilee-scroll-to-comments, a[href*=comment]' ).smoothScroll( {
			offset: -130, // consider sticky bar
			easing: 'swing',
			speed: 1200,
		} );
	}

	// Comment Validation using jQuery Validation Plugin by Jörn Zaefferer
	// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	if ( jQuery().validate ) { // if plugin loaded

		var $validate_params, $validate_comment_field;

		// Parameters
		$validate_params = {
			rules: {
				author: {
					required: jubilee_main.comment_name_required !== '' ? true : false // if WP configured to require
				},
				email: {
					required: jubilee_main.comment_email_required !== '' ? true : false, // if WP configured to require
					email: true // check validity
				},
				url: 'url' // optional but check validity
			},
			messages: { // localized error strings
				author: jubilee_main.comment_name_error_required,
				email: {
					required: jubilee_main.comment_email_error_required,
					email: jubilee_main.comment_email_error_invalid
				},
				url: jubilee_main.comment_url_error_invalid
			}
		};

		// Comment textarea
		// Use ID instead of name to work with Antispam Bee plugin which duplicates/hides original textarea
		$validate_comment_field = $( '#comment' ).attr( 'name' );
		$validate_params['rules'][$validate_comment_field] = 'required';
		$validate_params['messages'][$validate_comment_field] = jubilee_main.comment_message_error_required;

		// Validate the form
		$( '#commentform' ).validate( $validate_params );

	}

	/*---------------------------------------------
	 * Widgets
	 *--------------------------------------------*/

	// Categories dropdown redirect
	$( '.jubilee-dropdown-taxonomy-redirect' ).change( function() {

		var taxonomy, term_id;

		taxonomy = $( this ).prev( 'input[name=taxonomy]' ).val();
		term_id = $( 'option:selected', this ).val();

		if ( taxonomy && term_id && -1 != term_id ) {
			location.href = jubilee_main.home_url + '/?redirect_taxonomy=' + taxonomy + '&redirect_term_id=' + term_id;
		}

	} );

	/*---------------------------------------------
	 * Buttons
	 *--------------------------------------------*/

	 // Use theme styles for Gutenberg buttons.
	 $( '.wp-block-button' ).each( function() {

	 	var align_class = '';
		if ( $( this ).hasClass( 'alignleft' ) ) {
			align_class = 'alignleft';
		} else if ( $( this ).hasClass( 'alignright' ) ) {
			align_class = 'alignright';
		} else if ( $( this ).hasClass( 'aligncenter' ) ) {
			align_class = 'aligncenter';
		}

	 	// Get button link.
	 	var $button_link = $( 'a', this );

	 	// Remove class and style from button.
	 	$button_link
	 		.removeClass()
	 		.removeAttr( 'style', '' ) // color.
	 		.addClass( 'jubilee-button' )
	 		.addClass( 'jubilee-button-block' )
	 		.addClass( align_class );

	 	// Move button outside of container then remove container.
	 	$( this )
	 		.after( $button_link )
	 		.remove();

	 	// Show button (hidden in style.css).
	 	$button_link.css( 'visibility', 'visible' )

	 } );

	 // Use theme styled button for search.
	 $( '.wp-block-search__button' ).each( function() {
	 	$( this ).addClass( 'jubilee-button' );
	 } );

	/*---------------------------------------------
	 * List Item Counts
	 *--------------------------------------------*/

	// Modify list item counts
	// This includes widgets and sermon topics, etc. indexes using wp_list_categories()
	// Change (#) into <span class="jubilee-list-item-count">#</span> so it can be styled
	var $list_items = $( '.jubilee-list li, .jubilee-sermon-index-list li, .widget_categories li, .widget_ctfw-categories li, .widget_ctfw-archives li, .widget_ctfw-galleries li, .widget_recent_comments li, .widget_archive li, .widget_pages li, .widget_links li, .widget_nav_menu li, .widget_meta li' );
	for ( var i = 0; i < $list_items.length; i++ ) {

		$list_items.each( function() {

			var modified_count;

			// Manipulate it
			modified_count = $( this ).html().replace( /(<\/a>.*)\(([0-9]+)\)/, '$1 <span class="jubilee-list-item-count">$2</span>' );

			// Replace it
			$( this ).html( modified_count );

		} );

	}
	$list_items.parent( 'ul' ).css( 'visibility', 'visible' );

	/*---------------------------------------------
	 * CSS Classes
	 *--------------------------------------------*/

	// <body> classes for client detection (mobile, browser, etc.) should be done here with JS
	// instead of in body.php so that they work when caching plugins are used.

	// Scrolled down or not

		// On load
		if ( $( document ).scrollTop() > 0 ) {

			$( 'body' )
				.removeClass( 'jubilee-not-scrolled' )
				.addClass( 'jubilee-scrolled' )
				.addClass( 'jubilee-loaded-scrolled' );

		} else {

			$( 'body' )
				.addClass( 'jubilee-not-scrolled' );

		}

		// User scrolled

		$( window ).scroll( function() {

			if ( $( document ).scrollTop() > 0 ) {

				$( 'body' )
					.removeClass( 'jubilee-loaded-scrolled' )
					.removeClass( 'jubilee-not-scrolled' )
					.addClass( 'jubilee-scrolled' );

			} else {

				$( 'body' )
					.removeClass( 'jubilee-scrolled' )
					.addClass( 'jubilee-not-scrolled' );

			}

		} );

	// iOS Detection
	// Especially useful for re-styling form submit buttons, which iOS takes too much liberty with
	if ( navigator.userAgent.match( /iPad|iPod|iPhone|iWatch/ ) ) {
		$( 'body' ).addClass( 'jubilee-is-ios' );
	} else {
		$( 'body' ).addClass( 'jubilee-not-ios' );
	}

	// Showing singe post nav
	if ( $( '.jubilee-nav-blocks' ).length ) {
		$( 'body' ).addClass( 'jubilee-has-nav-blocks' );
	} else {
		$( 'body' ).addClass( 'jubilee-no-nav-blocks' );
	}

	// Showing comments section
	if ( $( '#comments' ).length ) {
		$( 'body' ).addClass( 'jubilee-has-comments-section' );
	} else {
		$( 'body' ).addClass( 'jubilee-no-comments-section' );
	}

	// Showing full entry map
	if ( $( '.jubilee-entry-full-map' ).length ) {
		$( 'body' ).addClass( 'jubilee-has-entry-map' );
	} else {
		$( 'body' ).addClass( 'jubilee-no-entry-map' );
	}

	// Add .jubilee-button to .jubilee-buttons-list a tags
	// This helps use :not(.jubilee-button) on content a bottom borders
	$( '.jubilee-buttons-list li a' ).each( function(index) {
		$( this ).addClass( 'jubilee-button' );
	} );

	// Add .jubilee-button-secondary to comments .jubilee-buttons-list a tags
	$( '.jubilee-comment-buttons.jubilee-buttons-list li a' ).each( function(index) {
		$( this ).addClass( 'jubilee-button-secondary' );
	} );

} );

/**********************************************
 * FUNCTIONS
 **********************************************/

/*---------------------------------------------
 * Menu Functions
 *--------------------------------------------*/

var $jubilee_header_menu_raw; // make accessible to jubilee_activate_menu() later

// Activate Menu Function
// Also used in Customizer admin preview JS
function jubilee_activate_menu() {

	var $header_menu_raw_list, $header_menu_raw_items;

	// Continue if menu not empty
	if ( ! jQuery( '#jubilee-header-menu-content' ).children().length ) {
		return;
	}

	// Make copy of menu contents before Superfish modified
	// Original markup works better with MeanMenu (less Supersubs and styling issues)
	if ( ! jQuery( $jubilee_header_menu_raw ).length ) { // not done already
		$jubilee_header_menu_raw = jQuery( '<div></div>' ); // Create empty div
		$header_menu_raw_list = jQuery( '<ul></ul>' ); // Create empty list
		$header_menu_raw_items = jQuery( '#jubilee-header-menu-content' ).html(); // Get menu items
		$header_menu_raw_list = $header_menu_raw_list.html( $header_menu_raw_items ); // Copy items to empty list
		$jubilee_header_menu_raw = $jubilee_header_menu_raw.html( $header_menu_raw_list ); // Copy list to div
	}

	// Regular Menu (Superfish)
	jQuery( '#jubilee-header-menu-content' ).supersubs( { // Superfish dropdowns
		minWidth: 13.5,	// minimum width of sub-menus in em units
		maxWidth: 13.5,	// maximum width of sub-menus in em units
		extraWidth: 1	// extra width can ensure lines don't sometimes turn over due to slight rounding differences and font-family
	} ).superfish( {
		disableHI: true,
		delay: 0,
		animation: {
			opacity: 'show',
			//height: 'show',
		},
		animationOut: {
			opacity: 'hide',
			//height: 'hide',
		},
		speed: 250,
		speedOut: 0,
		onInit: function() {

			// Responsive Menu (MeanMenu) for small screens
			// Replaces regular menu with responsive controls
			// Init after Superfish done because Supersubs needs menu visible for calculations
		    jQuery( $jubilee_header_menu_raw ).meanmenu( {
		    	meanMenuContainer: '#jubilee-header-mobile-menu',
				meanScreenWidth: jubilee_mobile_width, // use CSS media query to hide #jubilee-header-menu-content at same size
		    	meanRevealPosition: 'right',
		    	meanRemoveAttrs: true, // remove any Superfish classes, duplicate item ID's, etc.
		    	meanMenuClose: '<i class="' + jubilee_main.mobile_menu_close + '"></i>',
		    	meanExpand:  '+',
		    	meanContract:  '-',
		    	//removeElements: '#jubilee-header-menu-inner' // toggle visibility of regular
		    } );

			// Insert search into mobile menu
			jubilee_activate_mobile_menu();

			// Insert arrow icons for second level
			jQuery( 'ul .sf-with-ul', this ).each( function() {
				jQuery( this ).after( '<span class="jubilee-menu-arrow mdi mdi-chevron-right"></span>' );
			} );

		},
		onBeforeShow: function() {

			var $link, $dropdown, $dropdown_width, $offset;

			// Make dropdowns on right open to the left if will go off screen
			// This considers that the links may have wrapped and dropdowns may be mobile-size

			// Detect if is first-level dropdown and if not return
			if ( jQuery( this, '#jubilee-header-menu-content' ).parents( 'li.menu-item' ).length != 1 ) {
				return;
			}

			// Top-level link hovered on
			$link = jQuery( this ).parents( '#jubilee-header-menu-content > li.menu-item' );

			// First-level dropdown
			$dropdown = jQuery( '> ul', $link );

			// First-level dropdown width
			$dropdown_width = $dropdown.outerWidth();
			$dropdown_width_adjusted = $dropdown_width - 20; // compensate for left alignment

			// Remove classes first in case don't need anymore
			$link.removeClass( 'jq-dropdown-align-right jq-dropdown-open-left' );

			// Get offset between left side of link and right side of window
			$offset = jQuery( window ).width() - $link.offset().left;

			// Is it within one dropdown length of window's right edge?
			// Add .jq-dropdown-align-right to make first-level dropdown not go off screen
			if ( $offset < $dropdown_width_adjusted ) {
				$link.addClass( 'jq-dropdown-align-right' );
			}

			// Is it within two dropdown lengths of window's right edge?
			// Add .jq-dropdown-open-left to open second-level dropdowns left: https://github.com/joeldbirch/superfish/issues/98
			if ( $offset < ( $dropdown_width_adjusted * 2 ) ) {
				$link.addClass( 'jq-dropdown-open-left' );
			}

		},

	} );

}

// Add search into mobile menu
function jubilee_activate_mobile_menu() {

	var $logo, move_up;

	if ( jQuery( '.mean-container .mean-bar' ).length ) {

	    // Move mobile search container into bottom of mobile menu
	    if ( jQuery( '#jubilee-header-search' ).length && ! jQuery( '#jubilee-header-search-mobile' ).length ) {
		  	jQuery( '.mean-nav > ul' ).append( '<li id="jubilee-header-search-mobile" role="search">' + jQuery( '#jubilee-header-search .jubilee-search-form' ).html() + '</li>' );
		}

	}

}

// If header menu wraps to two lines, add body class
// for special handling of dropdowns
function jubilee_check_menu_height() {

	var header_menu_height = jQuery( '#jubilee-header-menu-content' ).height();

	if ( header_menu_height > 40 ) {
		jQuery( 'body' ).addClass( 'jubilee-header-menu-wrapped' );
	} else {
		jQuery( 'body' ).removeClass( 'jubilee-header-menu-wrapped' );
	}

}

/*---------------------------------------------
 * Footer
 *--------------------------------------------*/

// Move icons/notice after menu on mobile (when centered)
// Using jQuery rather than flexbox for full browser support
function jubilee_rearrange_footer() {

	var viewport_width, $icons_notice, $menu, icons_notice_index;

	$icons_notice = jQuery( '#jubilee-footer-icons-notice' );
	$menu = jQuery( '#jubilee-footer-menu' );

	// Have both elements
	if ( $icons_notice.length && $menu.length) {

		viewport_width = jQuery( window ).width();
		icons_notice_position = jQuery( $icons_notice ).index() + 1;

		if ( viewport_width <= 980 ) { // change width threshold in media-queries.scss too

			if ( 1 == icons_notice_position ) {
				$menu.after( $icons_notice );
			}

		} else {

			if ( 2 == icons_notice_position ) {
				$icons_notice.after( $menu );
			}

		}

	}

}

// Show latest events, comments, etc.
// Hide sticky when scroll to/from footer to prevent covering copyright, etc.
function jubilee_show_footer_sticky() {

	var scroll_bottom, top_of_footer, show;

	// Don't show if dismissed already
	if ( Cookies.get( 'jubilee_sticky_dismissed' ) ) {
		return;
	}

	// Default is show
	show = true;

	// Hide when below top of last footer element (widgets, map or bottom bar)
	scroll_bottom = jQuery( window ).scrollTop() + jQuery( window ).height();
	top_of_footer = jQuery( document ).height() - jQuery( '#jubilee-footer > *:last-child' ).height();
	if ( scroll_bottom > top_of_footer ) {
		show = false;
	}

	// Do show/hide
	if ( show ) {
		jQuery( '#jubilee-sticky' ).show();
	} else {
		jQuery( '#jubilee-sticky' ).hide();
	}

}

/*---------------------------------------------
 * Fonts
 *--------------------------------------------*/

// Change <body> helper font/setting class
// Used by Theme Customizer (and front-end demo customizer)
function jubilee_update_body_font_class( setting, font ) {

	var setting_slug, font_slug, body_class;

	// Prepare strings
	setting_slug = setting.replace( /_/g, '-' );
	font_slug = font.toLowerCase().replace( /\s/g, '-' ); // spaces to -
	body_class = 'jubilee-' + setting_slug + '-' + font_slug;

	// Remove old class
	jQuery( 'body' ).removeClass( function( i, css_class ) { // helpful info: http://bit.ly/1f7KH3f
		return ( css_class.match ( new RegExp( '\\b\\S+-' + setting_slug + '-\\S+', 'g' ) ) || [] ).join( ' ' );
	} );

	// Add new class
	jQuery( 'body' ).addClass( body_class );

}

/*---------------------------------------------
 * Map Section
 *--------------------------------------------*/

// Position Google Map on event/location, homepage and footer.
// This moves the marker to be roughly centered in right 50%
// Also run on resize to keep things in proper place
function jubilee_position_map_section() {

	// Delay improves resize accuracy
	setTimeout( function() {

		// Elements and data always needed
		var $map_element = jQuery( '#jubilee-map-section-canvas' );
		var $gmap = $map_element.data( 'ctfw-map' );
	 	var $marker = jQuery( '#jubilee-map-section-marker span' );
		var latlng = $map_element.data( 'ctfw-map-latlng' );

		// Reset location to center
		$gmap.setCenter( latlng );

		// Move marker only when info box is on left instead of top (non-mobile).
		if ( jQuery( window ).width() > 540 ) {

			// Elements and data for moving leftward
	 		var $content_container = jQuery( '#jubilee-map-section-content-container' );
			var $map_container = jQuery( '#jubilee-map-section-map' );
			var content_container_width = $content_container.width();

			// Calculations
			var half_container_width = content_container_width / 2; // centered large 1170-ish
			var map_width = $map_container.width(); // map canvas
			var current_map_center = map_width / 2;
			var new_map_center = current_map_center + ( half_container_width / 2 ); // center plus half of a half container is center of right side
			var pan_x = new_map_center - current_map_center; // distance to pan map and move marker rightward, to new center

			// Move map and marker leftward
			$gmap.panBy( '-' + pan_x, 0 );
			jQuery( $marker ).css( 'left', pan_x + 'px' );

			// Show it. Hidden on first load so it doesn't show centered before move.
			$marker.css( 'visibility', 'visible' );

		}

		// Undo the marker offset in case resizing down to mobile
		else {

			jQuery( $marker ).css( 'left', '0' );

			// Show it. Hidden on first load so it doesn't show centered before move.
			$marker.css( 'visibility', 'visible' );

		}

	}, 10 );

}

/*---------------------------------------------
 * Match Height
 *--------------------------------------------*/

// Match height wherever needed
// Also used by Customizer after font change since that can change height
function jubilee_match_height() {

	// Make short entry boxes have equal height per row
	if ( jQuery( '.jubilee-loop-entries' ).length ) {
		jQuery( '.jubilee-loop-entries .jubilee-entry-short' ).matchHeight();
	}

	// Give each gallery item same height to avoid gaps / awkward wrapping
	if ( jQuery( '.gallery-icon img' ).length ) {
		jQuery( '.gallery-icon img' ).matchHeight();
	}

	// Same for gallery index (caption images)
	if ( jQuery( '.jubilee-galleries-list .jubilee-caption-image' ).length ) {
		jQuery( '.jubilee-galleries-list .jubilee-caption-image' ).matchHeight();
	}

}

/*---------------------------------------------
 * Event Calendar
 *--------------------------------------------*/

// Attach calendar dropdowns to controls
// Used on load and after PJAX replaces content
function jubilee_attach_calendar_dropdowns() {

	// Remove it from before </body> if already exists (old before PJAX)
	jQuery( 'body > #jubilee-calendar-month-dropdown' ).remove();
	jQuery( 'body > #jubilee-calendar-category-dropdown' ).remove();

	// Move it from calendar container to before </body>
	// jQuery Dropdown works best with it there
	// But need it in main calendar container for PJAX to get new contents of dropdowns
	jQuery( '#jubilee-calendar-month-dropdown' ).appendTo( 'body' );
	jQuery( '#jubilee-calendar-category-dropdown' ).appendTo( 'body' );

	// Re-attach dropdown to control
	jQuery( '#jubilee-calendar-month-control' ).jqDropdown( 'attach', '#jubilee-calendar-month-dropdown' );
	jQuery( '#jubilee-calendar-category-control' ).jqDropdown( 'attach', '#jubilee-calendar-category-dropdown' );

}

// Use Tooltipster to show calendar's event hover for each link
function jubilee_activate_calendar_hover() {

	// Use Tooltipster to show event hover for each link
	jQuery( '#jubilee-calendar .jubilee-event-short' ).each( function() {

		var event_id;

		// Get ID
		event_id = jQuery( this ).attr( 'data-event-id' );

		// Activate tooltips on links having that ID
		if ( event_id ) {

			jQuery( '.jubilee-calendar-table-day-events a[data-event-id="' + event_id + '"]' ).tooltipster( {
				theme: 'jubilee-tooltipster-calendar',
				content: jQuery( this ),
				contentCloning: true,
				functionInit: function( origin, content ) {

					var date_formatted_abbreviated;

					// Get localized date from calendar
					date_formatted_abbreviated = jQuery( origin ).parents( 'td' ).attr( 'data-date-formatted-abbreviated' );

					// Add date to the tooltip
					jQuery( '.jubilee-entry-short-date', content ).html( date_formatted_abbreviated );

					return content;

				},
				minWidth: 450,
				maxWidth: 565,
				touchDevices: false, // no hovers on touch (including w/mouse; otherwise pure touch opens + goes)
				interactive: true, // let them click on tooltip
				arrow: false,
				delay: [ 50, 250 ],
				distance: 12,
				animation: 'fade',
				speed: 250, // fade speed
				onlyOne: true, // immediately close other tooltips when opening
				zIndex: 99997, // under sticky menu (99998) and admin bar (99999)
			} );

		}

	} );

}

/*---------------------------------------------
 * Detection
 *--------------------------------------------*/

// Is device mobile?
// The regex below is based on wp_is_mobile() -- good enough for most
// "Mobile" will handle iOS devices and many others
function jubilee_is_mobile() {
	return navigator.userAgent.match( /Mobile|Android|Silk\/|Kindle|BlackBerry|Opera Mini|Opera Mobi/ )
}
