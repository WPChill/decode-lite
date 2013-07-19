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
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


/**
 * Social Options
 */

	$wp_customize->add_section( 'decode_social_options', array(
    	'title'          => 'Social Options',
		'priority'       => 35,
    ) );


	$wp_customize->add_setting( 'show_social_icons', array(
		'default'        => 'hidden',
	) );

	$wp_customize->add_setting( 'show_twitter', array(
		'default'        => '',
	) );

	$wp_customize->add_setting( 'show_adn', array(
		'default'        => '',
	) );
	
	$wp_customize->add_setting( 'show_facebook', array(
		'default'        => '',
	) );
	
	$wp_customize->add_setting( 'show_google_plus', array(
		'default'        => 'hidden',
	) );

	$wp_customize->add_setting( 'twitter_username', array(
		'default'        => '',
	) );

	$wp_customize->add_setting( 'adn_username', array(
		'default'        => '',
	) );
	
	$wp_customize->add_setting( 'facebook_username', array(
		'default'        => '',
	) );
	
	$wp_customize->add_setting( 'google_plus_username', array(
		'default'        => '',
	) );
	
	
	$wp_customize->add_control( 'show_social_icons', array(
		'label'   => 'Show Social Icons',
		'section' => 'decode_social_options',
		'type'       => 'radio',
		'choices'    => array(
			'' => 'Show',
			'hidden' => 'Hide',
        ),
		'priority'=> 1,
	) );
	
	$wp_customize->add_control( 'show_twitter', array(
		'label'   => 'Show Twitter',
		'section' => 'decode_social_options',
		'type'       => 'radio',
		'choices'    => array(
			'' => 'Show',
			'hidden' => 'Hide',
        ),
		'priority'=> 2,
	) );
	
	$wp_customize->add_control( 'show_adn', array(
		'label'   => 'Show App.net',
		'section' => 'decode_social_options',
		'type'       => 'radio',
		'choices'    => array(
			'' => 'Show',
			'hidden' => 'Hide',
        ),
		'priority'=> 3,
	) );
	
	$wp_customize->add_control( 'show_facebook', array(
		'label'   => 'Show Facebook',
		'section' => 'decode_social_options',
		'type'       => 'radio',
		'choices'    => array(
			'' => 'Show',
			'hidden' => 'Hide',
        ),
		'priority'=> 4,
	) );
	
	$wp_customize->add_control( 'show_google_plus', array(
		'label'   => 'Show Google+',
		'section' => 'decode_social_options',
		'type'       => 'radio',
		'choices'    => array(
			'' => 'Show',
			'hidden' => 'Hide',
        ),
		'priority'=> 5,
	) );

	$wp_customize->add_control( 'twitter_username', array(
		'label'   => 'Twitter Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 6,
	) );
 
	$wp_customize->add_control( 'adn_username', array(
    	'label'   => 'App.net Username',
        'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 7,
	) );
	
	$wp_customize->add_control( 'facebook_username', array(
		'label'   => 'Facebook Username',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 8,
	) );
	
	$wp_customize->add_control( 'google_plus_username', array(
		'label'   => 'Google+ Username (or the long number in your profile URL)',
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 9,
	) );
	
	
/**
 * Sidebar Options
 */

	$wp_customize->add_section( 'decode_sidebar_options', array(
    	'title'          => 'Sidebar Options',
		'priority'       => 33,
    ) );
    
    
    $wp_customize->add_setting( 'show_sidebar', array(
		'default'        => 'hidden',
	) );

	$wp_customize->add_setting( 'sidebar_position', array(
		'default'        => 'left',
	) );
	
	$wp_customize->add_setting( 'sidebar_button_position', array(
		'default'        => 'left',
	) );
	
	
	$wp_customize->add_control( 'show_sidebar', array(
		'label'   => 'Show Sidebar',
		'section' => 'decode_sidebar_options',
		'type'       => 'radio',
		'choices'    => array(
			'' => 'Show',
			'hidden' => 'Hide',
        ),
		'priority'=> 1,
	) );
	
	$wp_customize->add_control( 'sidebar_position', array(
		'label'   => 'Sidebar Position',
		'section' => 'decode_sidebar_options',
		'type'       => 'radio',
		'choices'    => array(
			'left' => 'Left',
			'right' => 'Right',
        ),
		'priority'=> 2,
	) );
	
	$wp_customize->add_control( 'sidebar_button_position', array(
		'label'   => 'Sidebar Button Position',
		'section' => 'decode_sidebar_options',
		'type'       => 'radio',
		'choices'    => array(
			'left' => 'Left',
			'right' => 'Right',
        ),
		'priority'=> 3,
	) );
	

/**
 * Discussion Options
 */

	$wp_customize->add_section( 'decode_discussion_options', array(
    	'title'          => 'Discussion Options',
		'priority'       => 34,
    ) );

	
	$wp_customize->add_setting( 'enable_comments', array(
		'default'        => '',
	) );
	
	$wp_customize->add_setting( 'show_reply_option', array(
		'default'        => 'hidden',
	) );
	
	$wp_customize->add_setting( 'twitter_reply_username', array(
		'default'        => '',
	) );
	
	$wp_customize->add_setting( 'adn_reply_username', array(
		'default'        => '',
	) );


	$wp_customize->add_control( 'enable_comments', array(
		'label'   => 'Enable Comments',
		'section' => 'decode_discussion_options',
		'type'       => 'radio',
		'choices'    => array(
			'' => 'Show',
			'hidden' => 'Hide',
        ),
		'priority'=> 1,
	) );
	
	$wp_customize->add_control( 'show_reply_option', array(
		'label'   => 'Show Reply Tool',
		'section' => 'decode_discussion_options',
		'type'       => 'radio',
		'choices'    => array(
			'' => 'Show',
			'hidden' => 'Hide',
        ),
		'priority'=> 2,
	) );
	
	$wp_customize->add_control( 'twitter_reply_username', array(
		'label'   => 'Twitter Username for Replies',
		'section' => 'decode_discussion_options',
		'type'    => 'text',
		'priority'=> 3,
	) );
	
	$wp_customize->add_control( 'adn_reply_username', array(
		'label'   => 'App.net Username for Replies',
		'section' => 'decode_discussion_options',
		'type'    => 'text',
		'priority'=> 4,
	) );
	
	
/**
 * Other Options
 */

	$wp_customize->add_section( 'decode_other_options', array(
    	'title'          => 'Other Options',
		'priority'       => 37,
    ) );
    
    
    $wp_customize->add_setting( 'show_theme_info', array(
		'default'        => '',
	) );
	
	$wp_customize->add_setting( 'html_description', array(
		'default'        => '',
	) );
	
    $wp_customize->add_setting( 'use_html_in_description', array(
		'default'        => '',
	) );
	
	
	$wp_customize->add_control( 'show_theme_info', array(
		'label'   => 'Show Theme Info (display a line of text about the theme and its creator at the bottom of pages)',
		'section' => 'decode_other_options',
		'type'       => 'radio',
		'choices'    => array(
			'' => 'Show',
			'hidden' => 'Hide',
        ),
		'priority'=> 1,
	) );	
	
	$wp_customize->add_control( 'html_description', array(
		'label'   => 'HTML for description (set this first, then save)',
		'section' => 'decode_other_options',
		'type'    => 'text',
		'priority'=> 1,
	) );

	$wp_customize->add_control( 'use_html_in_description', array(
		'label'   => 'After saving the above setting, set and save this one. Want HTML in the header\'s description?',
		'section' => 'decode_other_options',
		'type'       => 'radio',
		'choices'    => array(
			get_theme_mod( 'html_description' ) => 'Yes',
			get_bloginfo ( 'description' ) => 'No',
        ),
		'priority'=> 2,
	) );


}
add_action( 'customize_register', 'decode_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function decode_customize_preview_js() {
	wp_enqueue_script( 'decode_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'decode_customize_preview_js' );
