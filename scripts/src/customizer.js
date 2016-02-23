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

	// Show "Leave a comment" link after posts.
	wp.customize( 'show_leave_a_comment_link', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.comments-link[data-customizer="leave-a-comment"]' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '.comments-link[data-customizer="leave-a-comment"]' ).removeClass( 'customizer-display-none' );
			}
		});
	});

	// Show Theme Info (display a line of text about the theme and its creator at the bottom of pages)
	wp.customize( 'show_theme_info', function( value ) {
		value.bind( function( to ) {
			if( to == false ) {
				$( '.theme-info' ).addClass( 'customizer-display-none' );
			} else if( to == true ) {
				$( '.theme-info' ).removeClass( 'customizer-display-none' );
			}
		});
	});

	// Secondary Text Color
	wp.customize( 'secondary_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.no-touch input[type=text]:hover, .no-touch input[type=email]:hover, .no-touch input[type=password]:hover, .no-touch input[type=search]:hover, .no-touch input[type=tel]:hover, .no-touch input[type=url]:hover, .no-touch textarea:hover, article .tags, article .categories, article .date, article .date a, .comment-metadata a, .search .page-header input[type=search]' ).css( 'color', to );
			$( '.no-touch input[type=text]:hover, .no-touch input[type=email]:hover, .no-touch input[type=password]:hover, .no-touch input[type=search]:hover, .no-touch input[type=tel]:hover, .no-touch input[type=url]:hover, .no-touch textarea:hover, .no-touch .search .page-header input[type=search]:hover' ).css( 'border-color', to );
		});
	});

	// Text Color
	wp.customize( 'text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body, button, input, select, textarea, .site-title a, .menu a, .entry-title, .search-entry, .search-entry .entry-title, .entry-title a, .format-link .entry-title h2 a, .read-more, .author-name a, .explore-page .widget h1, .decode-reply-tool-plugin .replylink, .decode-reply-tool-plugin .replytrigger' ).css( 'color', to );
			$( '.page-link' ).css( 'border-color', to );
			$( '.menu ul > .menu-item-has-children > a::after, .menu ul > .page_item_has_children > a::after' ).css( 'border-top-color', to );
			$( '.footer-menu ul > .menu-item-has-children > a::after, .footer-menu ul > .page_item_has_children > a::after' ).css( 'border-bottom-color', to );
		});
	});

	// Accent Color
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
			$( 'a, .no-touch a:hover, button, input[type=button], input[type=reset], input[type=submit], .no-touch .site-title a:hover, .no-touch .menu a:hover, .menu ul li.open > a, .sidebar-menu a, .menu .current-menu-item > a, .menu .current_page_item > a, .no-touch .search-entry:hover, .no-touch .search-entry:hover .entry-title, .no-touch article .date a:hover, .no-touch .format-link .entry-title a:hover, .no-touch .comment-metadata a:hover, .no-touch .decode-reply-tool-plugin .replylink:hover, .no-touch input[type=text]:focus, .touch input[type=text]:focus, .no-touch input[type=email]:focus, .touch input[type=email]:focus, .no-touch input[type=password]:focus, .touch input[type=password]:focus, .no-touch input[type=search]:focus, .touch input[type=search]:focus, .no-touch input[type=tel]:focus, .touch input[type=tel]:focus, .no-touch input[type=url]:focus, .touch input[type=url]:focus, .no-touch textarea:focus, .touch textarea:focus, .no-touch .search .page-header input[type=search]:focus, .touch .search .page-header input[type=search]:focus' ).css( 'color', to );
			$( '.no-touch button:hover, .no-touch input[type=button]:hover, .no-touch input[type=reset]:hover, .no-touch input[type=submit]:hover, .no-touch input[type=text]:focus, .touch input[type=text]:focus, .no-touch input[type=email]:focus, .touch input[type=email]:focus, .no-touch input[type=password]:focus, .touch input[type=password]:focus, .no-touch input[type=search]:focus, .touch input[type=search]:focus, .no-touch input[type=tel]:focus, .touch input[type=tel]:focus, .no-touch input[type=url]:focus, .touch input[type=url]:focus, .no-touch textarea:focus, .touch textarea:focus, .no-touch .site-description a:hover, .no-touch .entry-content a:hover, a .page-link, .no-touch .categories a:hover, .no-touch .tags a:hover, .no-touch .comments-link a:hover, .no-touch .edit-link a:hover, .no-touch .author-site a:hover, .no-touch .theme-info a:hover, .no-touch .site-colophon a:hover, .site-header, .menu ul ul, .menu a:focus, .site-breadcrumbs, .page-title, .post blockquote, .page blockquote, .entry-footer, .entry-header .entry-meta, .search .entry-footer, .sidebar-top, .sidebar-style-constant .sidebar.left, .sidebar-style-constant .sidebar.right, .explore-page .widget h1' ).css( 'border-color', to );
			$( '.no-touch .menu ul > .menu-item-has-children > a:hover::after, .no-touch .menu ul > .page_item_has_children > a:hover::after, .menu ul li.open > a::after, .sidebar-menu ul .menu-item-has-children > a::after, .sidebar-menu ul .page_item_has_children > a::after, .menu ul > .current_page_item.menu-item-has-children > a::after, .menu ul > .current_page_item.page_item_has_children > a::after' ).css( 'border-top-color', to );
			$( '.no-touch .footer-menu ul > .menu-item-has-children > a:hover::after, .no-touch .footer-menu ul > .page_item_has_children > a:hover::after, .footer-menu ul > li.open > a::after, .footer-menu ul > .current_page_item.menu-item-has-children > a::after, .footer-menu ul > .current_page_item.page_item_has_children > a::after' ).css( 'border-bottom-color', to );
			$().css();
		});
	});
} )( jQuery );