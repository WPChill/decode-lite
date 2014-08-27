/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});
	
	// Update site background color.
	wp.customize( 'html_description', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).html( to );
		});
	});
	// Update site HTML description, if used.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' == to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				});
			}
		});
	});
	
	// Update site background color.
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body, .sidebar, .SidebarTop, .menu ul ul, .header-style-ghost .site').css('background-color', newval );
		});
	});
	
	// Open sidebar when sidebar widgets are updated.
	wp.customize.bind( 'sidebar-updated', function( sidebar_id ) { 
		if ( 'sidebar-1' === sidebar_id ) { 
			$( '#sidebar' ).addClass( 'visible' );
		}
	});
		
	// Update site footer text.
	wp.customize( 'site_colophon', function( value ) {
		value.bind( function( to ) {
			$( '.site-colophon p' ).html( to );
		});
	});
	
} )( jQuery );