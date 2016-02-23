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

	// Show Site Title
	wp.customize( 'show_site_title', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.site-title' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '.site-title' ).removeClass( 'customizer-display-none' );
			}
		});
	});

	// Show Site Description
	wp.customize( 'show_site_description', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.site-description' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '.site-description' ).removeClass( 'customizer-display-none' );
			}
		});
	});

	// Show Header Menu
	wp.customize( 'show_header_menu', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.header-menu' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '.header-menu' ).removeClass( 'customizer-display-none' );
			}
		});
	});

	// Enable Sidebar
	wp.customize( 'show_sidebar', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.sidebar-link.left, .sidebar-link.right' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '.sidebar-link.left, .sidebar-link.right' ).removeClass( 'customizer-display-none' );
			}
		});
	});

	// Sidebar Position
	wp.customize( 'sidebar_position', function( value ) {
		value.bind( function( to ) {
			if( to == 'left' ) {
				$( '.sidebar' ).addClass( 'left' );
				$( '.sidebar' ).removeClass( 'right' );
			} else if( to == 'right' ) {
				$( '.sidebar' ).addClass( 'right' );
				$( '.sidebar' ).removeClass( 'left' );
			}
		});
	});

	// Sidebar Button Position
	wp.customize( 'sidebar_button_position', function( value ) {
		value.bind( function( to ) {
			if( to == 'left' ) {
				$( '.sidebar-link' ).addClass( 'left' );
				$( '.sidebar-link' ).removeClass( 'right' );
			} else if( to == 'right' ) {
				$( '.sidebar-link' ).addClass( 'right' );
				$( '.sidebar-link' ).removeClass( 'left' );
			}
		});
	});

	// Always Visible Sidebar
	wp.customize( 'constant_sidebar', function( value ) {
		value.bind( function( to ) {
			if( to == 'constant' ) {
				$( 'body' ).addClass( 'sidebar-visible' );
			} else if( to == 'closing' ) {
				$( 'body' ).removeClass( 'sidebar-visible' );
			}
		});
	});

	// Show Social Icons in Header
	wp.customize( 'show_header_social_icons', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.site-header .contact-links' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '.site-header .contact-links' ).removeClass( 'customizer-display-none' );
			}
		});
	});

	// Show Social Icons in Footer
	wp.customize( 'show_footer_social_icons', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.site-footer .contact-links' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '.site-footer .contact-links' ).removeClass( 'customizer-display-none' );
			}
		});
	});

	// Open Links in New Tab/Window
	wp.customize( 'open_links_in_new_tab', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.contact-link' ).attr( 'target', '' );
			} else if( to == true ) {
				$( '.contact-link' ).attr( 'target', '_blank' );
			}
		});
	});
} )( jQuery );