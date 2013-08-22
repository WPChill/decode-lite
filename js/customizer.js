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
	// Header text color
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
	
	//Update site background color
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body, .sidebar, .SidebarTop, .main-navigation ul ul').css('background-color', newval );
		});
	});
	
	//Show/Hide site title
	wp.customize( 'show_site_title', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).slideToggle(250);
		});
	});
	
	//Show/Hide site description
	wp.customize( 'show_site_description', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).slideToggle(250);
		});
	});
	
	//Show/Hide social links
	wp.customize( 'show_social_icons', function( value ) {
		value.bind( function( to ) {
			$( '.sociallinks' ).slideToggle(250);
		});
	});
	
	//Show/Hide site navigation
	wp.customize( 'show_site_navigation', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation' ).slideToggle(250);
		});
	});
	
	//Show/Hide sidebar
	wp.customize( 'show_sidebar', function( value ) {
		value.bind( function( to ) {
			$( '.SidebarLink' ).fadeToggle(250);
		});
	});
		
	//Show/Hide comments
	wp.customize( 'enable_comments', function( value ) {
		value.bind( function( to ) {
			$( '.comments-link, #comments' ).slideToggle(250);
		});
	});
	
	//Show/Hide tags
	wp.customize( 'show_tags', function( value ) {
		value.bind( function( to ) {
			$( '.tags' ).slideToggle(250);
		});
	});
	
	//Show/Hide categories
	wp.customize( 'show_categories', function( value ) {
		value.bind( function( to ) {
			$( '.categories' ).slideToggle(250);
		});
	});
	
	//Show/Hide author section
	wp.customize( 'show_author_section', function( value ) {
		value.bind( function( to ) {
			$( '.author-section' ).slideToggle(250);
		});
	});
	
	//Show/Hide theme credit
	wp.customize( 'show_theme_info', function( value ) {
		value.bind( function( to ) {
			$( '.theme-info' ).slideToggle(250);
		});
	});
	
	//Show/Hide arrows in link post title
	wp.customize( 'link_post_title_arrow', function( value ) {
		value.bind( function( to ) {
			$( '.link-title-arrow' ).toggle(250);
		});
	});
	
	//Update site footer text
	wp.customize( 'site_colophon', function( value ) {
		value.bind( function( to ) {
			$( '.site-colophon p' ).text( to );
		});
	});
	
} )( jQuery );