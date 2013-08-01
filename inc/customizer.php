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


/**
 * Other Options
 */

	$wp_customize->add_section( 'decode_other_options', array(
    	'title'   => 'Other Options',
		'priority'=> 37,
    ) );
    
    
    $wp_customize->add_setting( 'show_tags', array(
		'default' => false,
	) );
	
	$wp_customize->add_setting( 'show_categories', array(
		'default' => false,
	) );
    
    $wp_customize->add_setting( 'show_theme_info', array(
		'default' => true,
	) );
	
	$wp_customize->add_setting( 'html_description', array(
		'default' => '',
	) );
		
	
	$wp_customize->add_control( 'show_tags', array(
		'label'   => 'Show tags on front page (tags will be shown on post\'s individual page)',
		'section' => 'decode_other_options',
		'type'    => 'checkbox',
		'priority'=> 1,
	) );
	
	$wp_customize->add_control( 'show_categories', array(
		'label'   => 'Show categories on front page (categories will be shown on post\'s individual page)',
		'section' => 'decode_other_options',
		'type'    => 'checkbox',
		'priority'=> 2,
	) );
	
	$wp_customize->add_control( 'show_theme_info', array(
		'label'   => 'Show Theme Info (display a line of text about the theme and its creator at the bottom of pages)',
		'section' => 'decode_other_options',
		'type'    => 'checkbox',
		'priority'=> 3,
	) );	
	
	$wp_customize->add_control( 'html_description', array(
		'label'   => 'HTML for description, if you wish to replace your blog description with HTML markup',
		'section' => 'decode_other_options',
		'type'    => 'text',
		'priority'=> 4,
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
