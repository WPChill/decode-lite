<?php
/**
 * Decode Theme Customizer
 *
 * @package Decode
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function decode_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'bl/Volumes/Macintosh%20HD/Users/Scott/Dropbox/Documents/Web/Decode/Decode%202.4/inc/customizer.phpogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


/**
 * Sidebar Options
 */

	$wp_customize->add_section( 'decode_sidebar_options', array(
    	'title'    => 'Sidebar Options',
		'priority' => 33,
    ) );
    
    
    $wp_customize->add_setting( 'show_sidebar', array(
		'default'  => true,
	) );

	$wp_customize->add_setting( 'sidebar_position', array(
		'default'  => 'left',
	) );
	
	$wp_customize->add_setting( 'sidebar_button_position', array(
		'default'  => 'left',
	) );
	
	
	$wp_customize->add_control( 'show_sidebar', array(
		'label'   => 'Enable Sidebar',
		'section' => 'decode_sidebar_options',
		'type'       => 'checkbox',
		'priority'=> 1,
	) );
	
	$wp_customize->add_control( 'sidebar_position', array(
		'label'   => 'Sidebar Position',
		'section' => 'decode_sidebar_options',
		'type'    => 'radio',
		'choices' => array(
			'left'  => 'Left',
			'right' => 'Right',
        ),
		'priority'=> 2,
	) );
	
	$wp_customize->add_control( 'sidebar_button_position', array(
		'label'   => 'Sidebar Button Position',
		'section' => 'decode_sidebar_options',
		'type'    => 'radio',
		'choices' => array(
			'left'  => 'Left',
			'right' => 'Right',
        ),
		'priority'=> 3,
	) );
	


/**
 * Discussion Options
 */

	$wp_customize->add_section( 'decode_discussion_options', array(
    	'title'   => 'Discussion Options',
		'priority'=> 34,
    ) );

	
	$wp_customize->add_setting( 'enable_comments', array(
		'default' => true,
	) );
	

	$wp_customize->add_control( 'enable_comments', array(
		'label'   => 'Enable Comments',
		'section' => 'decode_discussion_options',
		'type'    => 'checkbox',
		'priority'=> 1,
	) );


/**
 * Social Options
 */

	$wp_customize->add_section( 'decode_social_options', array(
    	'title'   => 'Social Options',
		'priority'=> 35,
    ) );


	$wp_customize->add_setting( 'show_social_icons', array(
		'default' => false,
	) );

	$wp_customize->add_setting( 'twitter_username', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'adn_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'facebook_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'google_plus_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'dribbble_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'behance_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'linkedin_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'tumblr_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'pinterest_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'instagram_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( '500px_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'flickr_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'rdio_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'spotify_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'soundcloud_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'vimeo_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'youtube_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'github_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'foursquare_username', array(
		'default' => '',
	) );
	
	
	$wp_customize->add_control( 'show_social_icons', array(
		'label'   => 'Show Social Icons',
		'section' => 'decode_social_options',
		'type'    => 'checkbox',
		'priority'=> 1,
	) );
	
	$wp_customize->add_control( 'twitter_username', array(
		'label'   => 'Twitter Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 2,
	) );
 
	$wp_customize->add_control( 'adn_username', array(
    	'label'   => 'App.net Username',
        'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 3,
	) );
	
	$wp_customize->add_control( 'facebook_username', array(
		'label'   => 'Facebook Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 4,
	) );
	
	$wp_customize->add_control( 'google_plus_username', array(
		'label'   => 'Google+ Username (or the long number in your profile URL)',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 5,
	) );
	
	$wp_customize->add_control( 'dribbble_username', array(
		'label'   => 'Dribbble Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 6,
	) );
	
	$wp_customize->add_control( 'behance_username', array(
		'label'   => 'Behance Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 7,
	) );
	
	$wp_customize->add_control( 'linkedin_username', array(
		'label'   => 'Linkedin Profile ID',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 8,
	) );
	
	$wp_customize->add_control( 'tumblr_username', array(
		'label'   => 'Tumblr Site URL',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 9,
	) );
	
	$wp_customize->add_control( 'pinterest_username', array(
		'label'   => 'Pinterest Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 10,
	) );
	
	$wp_customize->add_control( 'instagram_username', array(
		'label'   => 'Instagram Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 11,
	) );
	
	$wp_customize->add_control( '500px_username', array(
		'label'   => '500px Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 12,
	) );
	
	$wp_customize->add_control( 'flickr_username', array(
		'label'   => 'Flickr Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 13,
	) );
	
	$wp_customize->add_control( 'rdio_username', array(
		'label'   => 'Rdio Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 14,
	) );
	
	$wp_customize->add_control( 'spotify_username', array(
		'label'   => 'Spotify Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 15,
	) );
	
	$wp_customize->add_control( 'soundcloud_username', array(
		'label'   => 'Soundcloud Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 16,
	) );
	
	$wp_customize->add_control( 'vimeo_username', array(
		'label'   => 'Vimeo Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 17,
	) );
	
	$wp_customize->add_control( 'youtube_username', array(
		'label'   => 'YouTube Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 18,
	) );
	
	$wp_customize->add_control( 'github_username', array(
		'label'   => 'GitHub Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 19,
	) );
	
	$wp_customize->add_control( 'foursquare_username', array(
		'label'   => 'Foursquare Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 20,
	) );



/**
 * Reading Options
 */

	$wp_customize->add_section( 'decode_reading_options', array(
    	'title'   => 'Reading Options',
		'priority'=> 37,
    ) );
    
    
    $wp_customize->add_setting( 'show_tags', array(
		'default' => false,
	) );
	
	$wp_customize->add_setting( 'show_categories', array(
		'default' => false,
	) );
	
	$wp_customize->add_setting( 'link_post_title_arrow', array(
		'default' => false,
	) );
    
    $wp_customize->add_setting( 'show_theme_info', array(
		'default' => true,
	) );
	
	$wp_customize->add_setting( 'site_colophon', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'html_description', array(
		'default' => '',
	) );
		
	
	$wp_customize->add_control( 'show_tags', array(
		'label'   => 'Show tags on front page (tags will be shown on post\'s individual page)',
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 1,
	) );
	
	$wp_customize->add_control( 'show_categories', array(
		'label'   => 'Show categories on front page (categories will be shown on post\'s individual page)',
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 2,
	) );
	
	$wp_customize->add_control( 'link_post_title_arrow', array(
		'label'   => 'Add an arrow before the title of a link post',
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 3,
	) );
	
	$wp_customize->add_control( 'show_theme_info', array(
		'label'   => 'Show Theme Info (display a line of text about the theme and its creator at the bottom of pages)',
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 4,
	) );	
	
	$wp_customize->add_control( 'site_colophon', array(
		'label'   => 'Text (colophon, copyright, credits, etc.) for the footer of the site',
		'section' => 'decode_reading_options',
		'type'    => 'text',
		'priority'=> 5,
	) );
	
	$wp_customize->add_control( 'html_description', array(
		'label'   => 'HTML for description, if you wish to replace your blog description with HTML markup',
		'section' => 'decode_reading_options',
		'type'    => 'text',
		'priority'=> 6,
	) );
	
/**
 * Color Options
 */

	$wp_customize->add_setting( 'accent_color', array(
		'default' => '#009BCD',
	) );
	
	$wp_customize->add_setting( 'secondary_accent_color', array(
		'default' => '#007EA6',
	) );
	
	$wp_customize->add_setting( 'text_color', array(
		'default' => '#444444',
	) );
	
	$wp_customize->add_setting( 'secondary_text_color', array(
		'default' => '#808080',
	) );
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'        => __( 'Accent Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'accent_color',
	) ) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_accent_color', array(
		'label'        => __( 'Active Link Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'secondary_accent_color',
	) ) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
		'label'        => __( 'Text Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'text_color',
	) ) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'        => __( 'Secondary Text Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'secondary_text_color',
	) ) );
	
}
add_action( 'customize_register', 'decode_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function decode_customize_preview_js() {
	wp_enqueue_script( 'decode_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'decode_customize_preview_js' );
