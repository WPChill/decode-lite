<?php
/**
 * Decode Theme Customizer
 *
 * @package Decode
 */

function decode_add_customize_controls( $wp_customize ) {
	/* Adds Textarea Control (Required until WP 4.4) */
	class Decode_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%; padding: 5px;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}
	
	/* Adds a favicon image uploader control that only allows .ico and .png files to be uploaded */
	class Decode_Customize_Favicon_Image_Control extends WP_Customize_Image_Control {
		public $extensions = array( 'png', 'ico', 'image/x-icon' );
	}
}
add_action( 'customize_register', 'decode_add_customize_controls' );

// Generic sanitization function
function decode_sanitize_setting( $input ) {
 
	$search = array(
		'@<script[^>]*?>.*?</script>@si',	// Strip out javascript
		'@<[\/\!]*?[^<>]*?>@si',			// Strip out HTML tags
		'@<style[^>]*?>.*?</style>@siU',	// Strip style tags properly
		'@<![\s\S]*?--[ \t\n\r]*>@'			// Strip multi-line comments
	);
	
	$output = preg_replace( $search, '', $input );
	return $output;
}

// Boolean sanitization function
function decode_sanitize_boolean( $input ) {
	
	if ( filter_var( $input, FILTER_VALIDATE_BOOLEAN ) ) {
		return $input;
	}
}

// String sanitization function
function decode_sanitize_string( $input ) {
 
	$output = filter_var( $input, FILTER_SANITIZE_STRING );
	return $output;
}

// HTML sanitization function
function decode_sanitize_html( $input ) {
	
	$allowed_html = array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'img' => array(
			'alt' => array(),
			'src' => array(),
			'srcset' => array(),
			'title' => array()
		),
		'strong' => array(),
	);
	
	$output = wp_kses( $input, $allowed_html );
	return $output;
}

function decode_description_is_displayed() {
	if ( get_theme_mod( 'show_site_description', true ) == true ) {
		return true;
	}
	else {
		return false;
	}
}

function decode_sidebar_is_enabled() {
	if ( get_theme_mod( 'show_sidebar', true ) == true ) {
		return true;
	}
	else {
		return false;
	}
}

function decode_social_icons_are_enabled() {
	if ( get_theme_mod( 'show_header_social_icons', false ) == true || get_theme_mod( 'show_footer_social_icons', false ) == true ) {
		return true;
	}
	else {
		return false;
	}
}

function decode_plus_electric_slide_sidebar_is_not_enabled() {
	if ( get_theme_mod( 'sidebar_style', 'original' ) != 'slide' && decode_sidebar_is_enabled()  ) {
		return true;
	}
	else {
		return false;
	}
}

class Decode_Customize {

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
public static function decode_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )        ->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' ) ->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

/**
 * Remove old, now unused theme modifications so that conflicts do not occur.
 */
	remove_theme_mod( 'show_site_navigation' );
	remove_theme_mod( 'show_social_icons' );
	remove_theme_mod( 'linkedin_username' );
	remove_theme_mod( 'yelp_userid' );
	remove_theme_mod( 'show_all_post_types' );

/**
 * Header Options
 */

 	$wp_customize->add_section( 'decode_header_options', array(
    	'title'    => __( 'Header Options', 'decode' ),
		'priority' => 32,
	) );

	
	$wp_customize->add_setting( 'favicon_image', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'show_site_title', array(
		'default'           => true,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'show_site_description', array(
		'default'           => true,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'show_header_menu', array(
		'default'           => true,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'html_description', array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'decode_sanitize_html',
	) );

	
	$wp_customize->add_control(
		new Decode_Customize_Favicon_Image_Control(
		$wp_customize, 'favicon_image', array(
			'label'    => __( 'Favicon Image (must be a PNG)', 'decode' ),
			'section'  => 'decode_header_options',
			'settings' => 'favicon_image',
			'priority' => 1,
	) ) );
	
	$wp_customize->add_control( 'show_site_title', array(
		'label'    => __( 'Show Site Title', 'decode' ),
		'section'  => 'decode_header_options',
		'type'     => 'checkbox',
		'priority' => 2,
	) );
	
	$wp_customize->add_control( 'show_site_description', array(
		'label'    => __( 'Show Site Description', 'decode' ),
		'section'  => 'decode_header_options',
		'type'     => 'checkbox',
		'priority' => 3,
	) );
	
	$wp_customize->add_control( 'show_header_menu', array(
		'label'    => __( 'Show Header Menu', 'decode' ),
		'section'  => 'decode_header_options',
		'type'     => 'checkbox',
		'priority' => 4,
	) );
	
	$wp_customize->add_control( 'html_description', array(
		'label'           => __( 'HTML for description, if you wish to replace your blog description with HTML markup', 'decode' ),
		'section'         => 'decode_header_options',
		'active_callback' => 'decode_description_is_displayed',
		'type'            => 'text',
		'priority'        => 5,
	) );



/**
 * Sidebar Options
 */

	$wp_customize->add_section( 'decode_sidebar_options', array(
    	'title'    => __( 'Sidebar Options', 'decode' ),
		'priority' => 33,
    ) );


    $wp_customize->add_setting( 'show_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );

	$wp_customize->add_setting( 'sidebar_position', array(
		'default'           => 'left',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'sidebar_button_position', array(
		'default'           => 'left',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'constant_sidebar', array(
		'default'           => 'closing',
		'sanitize_callback' => 'decode_sanitize_string',
	) );


	$wp_customize->add_control( 'show_sidebar', array(
		'label'    => __( 'Enable Sidebar', 'decode' ),
		'section'  => 'decode_sidebar_options',
		'type'     => 'checkbox',
		'priority' => 1,
	) );

	$wp_customize->add_control( 'sidebar_position', array(
		'label'           => __( 'Sidebar Position', 'decode' ),
		'section'         => 'decode_sidebar_options',
		'active_callback' => 'decode_sidebar_is_enabled',
		'type'            => 'radio',
		'choices'         => array(
			'left'           => __( 'Left', 'decode' ),
			'right'          => __( 'Right', 'decode' ),
        ),
		'priority'        => 2,
	) );

	$wp_customize->add_control( 'sidebar_button_position', array(
		'label'           => __( 'Sidebar Button Position', 'decode' ),
		'section'         => 'decode_sidebar_options',
		'active_callback' => 'decode_sidebar_is_enabled',
		'type'            => 'radio',
		'choices'         => array(
			'left'           => __( 'Left', 'decode' ),
			'right'          => __( 'Right', 'decode' ),
        ),
		'priority'        => 3,
	) );
	
	$wp_customize->add_control( 'constant_sidebar', array(
		'label'           => __( 'Always Visible Sidebar', 'decode' ),
		'section'         => 'decode_sidebar_options',
		'active_callback' => 'decode_plus_electric_slide_sidebar_is_not_enabled',
		'type'            => 'radio',
		'choices'         => array(
			'constant'       => _x( 'Always open', 'Sidebar option', 'decode' ),
			'closing'        => _x( 'Closed by default', 'Sidebar option', 'decode' ),
        ),
        'priority'  => 4,
	) );



/**
 * Discussion Options
 */

	$wp_customize->add_section( 'decode_discussion_options', array(
    	'title'    => __( 'Discussion Options', 'decode' ),
		'priority' => 34,
    ) );


	$wp_customize->add_setting( 'enable_comments', array(
		'default'           => true,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'show_allowed_tags', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );


	$wp_customize->add_control( 'enable_comments', array(
		'label'    => __( 'Enable Comments', 'decode' ),
		'section'  => 'decode_discussion_options',
		'type'     => 'checkbox',
		'priority' => 1,
	) );
	
	$wp_customize->add_control( 'show_allowed_tags', array(
		'label'    => __( 'Show allowed HTML tags on comment form', 'decode' ),
		'section'  => 'decode_discussion_options',
		'type'     => 'checkbox',
		'priority' => 2,
	) );



/**
 * Social Options
 */

	$wp_customize->add_section( 'decode_social_options', array(
    	'title'    => __( 'Social Options', 'decode' ),
		'priority' => 35,
    ) );

	$wp_customize->add_setting( 'show_header_social_icons', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'show_footer_social_icons', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'open_links_in_new_tab', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );

	$wp_customize->add_setting( 'twitter_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'facebook_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'google_plus_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'ello_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'adn_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'sina_weibo_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'myspace_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'diaspora_id', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'vk_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'dribbble_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'behance_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'linkedin_profile_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_setting( 'pinterest_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'fancy_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'etsy_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'pinboard_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'delicious_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'instagram_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( '500px_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'flickr_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'deviantart_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'bandcamp_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'soundcloud_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'itunes_link', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_setting( 'rdio_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'spotify_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'lastfm_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'vine_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'vimeo_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'youtube_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'kickstarter_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_setting( 'gittip_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'goodreads_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'tumblr_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'medium_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'svbtle_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_setting( 'wordpress_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_setting( 'stackoverflow_userid', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'reddit_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'github_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'bitbucket_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'runkeeper_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'strava_userid', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );

	$wp_customize->add_setting( 'foursquare_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'yelp_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_setting( 'slideshare_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'researchgate_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'youversion_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'psn_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'xbox_live_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'steam_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'steam_group_name', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'skype_username', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'email_address', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_email',
	) );
	
	$wp_customize->add_setting( 'website_link', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_setting( 'show_rss_icon', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );


	$wp_customize->add_control( 'show_header_social_icons', array(
		'label'    => __( 'Show Social Icons', 'decode' ) . ' '  . __( 'in Header', 'decode' ),
		'section'  => 'decode_social_options',
		'type'     => 'checkbox',
		'priority' => 1,
	) );
	
	$wp_customize->add_control( 'show_footer_social_icons', array(
		'label'    => __( 'Show Social Icons', 'decode' ) . ' ' . __( 'in Footer', 'decode' ),
		'section'  => 'decode_social_options',
		'type'     => 'checkbox',
		'priority' => 2,
	) );
	
	$wp_customize->add_control( 'open_links_in_new_tab', array(
		'label'           => __( 'Open Links in New Tab/Window', 'decode' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'checkbox',
		'priority'        => 3,
	) );

	$wp_customize->add_control( 'twitter_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Twitter' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 4,
	) );
	
	$wp_customize->add_control( 'facebook_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Facebook' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 5,
	) );

	$wp_customize->add_control( 'google_plus_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Google+' ),
		'description'     => __( ' (or the long number in your profile URL)', 'decode' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 6,
	) );
	
	$wp_customize->add_control( 'ello_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Ello' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 7,
	) );

	$wp_customize->add_control( 'adn_username', array(
    	'label'           => sprintf( __( '%s Username', 'decode' ), 'App.net' ),
        'section'         => 'decode_social_options',
        'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 8,
	) );
	
	$wp_customize->add_control( 'sina_weibo_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Sina Weibo' ),
		'description'     => __( ' (or the long number in your profile URL)', 'decode' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 9,
	) );
	
	$wp_customize->add_control( 'myspace_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'MySpace' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 10,
	) );
	
	$wp_customize->add_control( 'diaspora_id', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Diaspora' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 11,
	) );
	
	$wp_customize->add_control( 'vk_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'VK' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 12,
	) );

	$wp_customize->add_control( 'dribbble_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Dribbble' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 13,
	) );

	$wp_customize->add_control( 'behance_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Behance' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 14,
	) );

	$wp_customize->add_control( 'linkedin_profile_url', array(
		'label'           => sprintf( __( '%s Profile URL', 'decode' ), 'LinkedIn' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		//'type'            => 'url', /* Uncomment for WP >= 4.4 */
		'priority'        => 15,
	) );

	$wp_customize->add_control( 'pinterest_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Pinterest' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 16,
	) );
	
	$wp_customize->add_control( 'fancy_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Fancy' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 17,
	) );
	
	$wp_customize->add_control( 'etsy_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Etsy' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 18,
	) );
	
	$wp_customize->add_control( 'pinboard_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Pinboard' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 19,
	) );
	
	$wp_customize->add_control( 'delicious_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Delicious' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 20,
	) );

	$wp_customize->add_control( 'instagram_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Instagram' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 21,
	) );

	$wp_customize->add_control( '500px_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), '500px' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 22,
	) );

	$wp_customize->add_control( 'flickr_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Flickr' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 23,
	) );
	
	$wp_customize->add_control( 'deviantart_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'DeviantART' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 24,
	) );
	
	$wp_customize->add_control( 'bandcamp_username', array(
		'label'           => sprintf( __( '%s Site URL', 'decode' ), 'Bandcamp' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		//'type'            => 'url', /* Uncomment for WP >= 4.4 */
		'priority'        => 25,
	) );
	
	$wp_customize->add_control( 'soundcloud_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Soundcloud' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 26,
	) );
	
	$wp_customize->add_control( 'itunes_link', array(
		'label'           => sprintf( __( '%s Link', 'decode' ), 'iTunes' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		//'type'            => 'url', /* Uncomment for WP >= 4.4 */
		'priority'        => 27,
	) );

	$wp_customize->add_control( 'rdio_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Rdio' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 28,
	) );

	$wp_customize->add_control( 'spotify_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Spotify' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 29,
	) );
	
	$wp_customize->add_control( 'lastfm_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Last.fm' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 30,
	) );

	$wp_customize->add_control( 'vine_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Vine' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 31,
	) );

	$wp_customize->add_control( 'vimeo_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Vimeo' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 32,
	) );

	$wp_customize->add_control( 'youtube_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'YouTube' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 33,
	) );
	
	$wp_customize->add_control( 'kickstarter_url', array(
		'label'           => sprintf( __( '%s Site URL', 'decode' ), 'Kickstarter' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		//'type'            => 'url', /* Uncomment for WP >= 4.4 */
		'priority'        => 34,
	) );
	
	$wp_customize->add_control( 'gittip_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Gittip' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 35,
	) );
	
	$wp_customize->add_control( 'goodreads_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Goodreads' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 36,
	) );
	
	$wp_customize->add_control( 'tumblr_username', array(
		'label'           => sprintf( __( '%s Site URL', 'decode' ), 'Tumblr' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		//'type'            => 'url', /* Uncomment for WP >= 4.4 */
		'priority'        => 37,
	) );
	
	$wp_customize->add_control( 'medium_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Medium' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 38,
	) );
	
	$wp_customize->add_control( 'svbtle_url', array(
		'label'           => sprintf( __( '%s Site URL', 'decode' ), 'Svbtle' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		//'type'            => 'url', /* Uncomment for WP >= 4.4 */
		'priority'        => 39,
	) );
	
	$wp_customize->add_control( 'wordpress_url', array(
		'label'           => sprintf( __( '%s Site URL', 'decode' ), 'WordPress' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		//'type'            => 'url', /* Uncomment for WP >= 4.4 */
		'priority'        => 40,
	) );

	$wp_customize->add_control( 'stackoverflow_userid', array(
		'label'           => sprintf( __( '%s User ID', 'decode' ), 'Stack Overflow' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 41,
	) );
	
	$wp_customize->add_control( 'reddit_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Reddit' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 42,
	) );

	$wp_customize->add_control( 'github_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'GitHub' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 43,
	) );
	
	$wp_customize->add_control( 'bitbucket_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Bitbucket' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 44,
	) );
	
	$wp_customize->add_control( 'runkeeper_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Runkeeper' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 45,
	) );
	
	$wp_customize->add_control( 'strava_userid', array(
		'label'           => sprintf( __( '%s User ID', 'decode' ), 'Strava' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 46,
	) );

	$wp_customize->add_control( 'foursquare_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Foursquare' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 47,
	) );
	
	$wp_customize->add_control( 'yelp_url', array(
		'label'           => sprintf( __( '%s Profile URL', 'decode' ), 'Yelp' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		//'type'            => 'url', /* Uncomment for WP >= 4.4 */
		'priority'        => 48,
	) );
	
	$wp_customize->add_control( 'slideshare_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'SlideShare' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 49,
	) );
	
	$wp_customize->add_control( 'researchgate_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Research Gate' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 50,
	) );
	
	$wp_customize->add_control( 'youversion_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'YouVersion' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 51,
	) );
	
	$wp_customize->add_control( 'psn_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Playstation Network' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 52,
	) );
	
	$wp_customize->add_control( 'xbox_live_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Xbox Live' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 53,
	) );
	
	$wp_customize->add_control( 'steam_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Steam' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 54,
	) );
	
	$wp_customize->add_control( 'steam_group_name', array(
		'label'           => sprintf( __( '%s Group Name', 'decode' ), 'Steam' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 55,
	) );
	
	$wp_customize->add_control( 'skype_username', array(
		'label'           => sprintf( __( '%s Username', 'decode' ), 'Skype' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		'priority'        => 56,
	) );
	
	$wp_customize->add_control( 'email_address', array(
		'label'           => __( 'Email Address', 'decode' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		//'type'            => 'email', /* Uncomment for WP >= 4.4 */
		'priority'        => 57,
	) );
	
	$wp_customize->add_control( 'website_link', array(
		'label'           => sprintf( __( '%s Link', 'decode' ), 'Website' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'text',
		//'type'            => 'url', /* Uncomment for WP >= 4.4 */
		'priority'        => 58,
	) );
	
	$wp_customize->add_control( 'show_rss_icon', array(
		'label'           => __( 'RSS Feed', 'decode' ),
		'section'         => 'decode_social_options',
		'active_callback' => 'decode_social_icons_are_enabled',
		'type'            => 'checkbox',
		'priority'        => 59,
	) );
	


/**
 * Reading Options
 */

	$wp_customize->add_section( 'decode_content_options', array(
    	'title'       => __( 'Content Options', 'decode' ),
		'priority'    => 37,
		'description' => sprintf( _x( 'These options change the display of %s\'s content', '(blog name)\'s content.' ,'decode' ), get_bloginfo( 'name', 'display' ) ),
    ) );
    
    
    $wp_customize->add_setting( 'latin_extended_font', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );

	$wp_customize->add_setting( 'use_excerpts', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'use_excerpts_on_archives', array(
		'default'           => true,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'show_featured_images_on_excerpts', array(	// Yep, that's the longest setting name I have.
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'show_featured_images_on_singles', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );

    $wp_customize->add_setting( 'show_tags', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );

	$wp_customize->add_setting( 'show_categories', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'show_author_section', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'entry_date_position', array(
		'default'           => 'below',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'show_entry_date_on_excerpts', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );
	
	$wp_customize->add_setting( 'show_page_headers', array(
		'default'           => true,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );

	$wp_customize->add_setting( 'link_post_title_arrow', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );

    $wp_customize->add_setting( 'show_theme_info', array(
		'default'           => true,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );

	$wp_customize->add_setting( 'site_colophon', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_html',
		'transport'         => 'postMessage',
	) );


	$wp_customize->add_control( 'latin_extended_font', array(
		'label'    => __( 'Load Latin Extended character set. This will increase page load times.', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 1,
	) );

	$wp_customize->add_control( 'use_excerpts', array(
		'label'    => __( 'Use entry excerpts instead of full text on site home. Excludes sticky posts.', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 2,
	) );
	
	$wp_customize->add_control( 'use_excerpts_on_archives', array(
		'label'    => __( 'Use entry excerpts on archive, category, and author pages.', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 3,
	) );
	
	$wp_customize->add_control( 'show_featured_images_on_excerpts', array(
		'label'    => __( 'Display posts\' featured images when excerpts are shown.', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 4,
	) );
	
	$wp_customize->add_control( 'show_featured_images_on_singles', array(
		'label'    => __( 'Display a post\'s featured image on its individual page.', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 5,
	) );

	$wp_customize->add_control( 'show_tags', array(
		'label'    => __( 'Show tags on front page (tags will be shown on post\'s individual page)', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 6,
	) );

	$wp_customize->add_control( 'show_categories', array(
		'label'    => __( 'Show categories on front page (categories will be shown on post\'s individual page)', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 7,
	) );
	
	$wp_customize->add_control( 'show_author_section', array(
		'label'    => __( 'Show author\'s name, profile image, and bio after posts', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 8,
	) );
	
	$wp_customize->add_control( 'entry_date_position', array(
		'label'   => __( 'Entry Date Position', 'decode' ),
		'section' => 'decode_content_options',
		'type'    => 'radio',
		'choices' => array(
			'above' => __( 'Above Header', 'decode' ),
			'below' => __( 'Below Header', 'decode' ),
        ),
		'priority' => 9,
	) );
	
	$wp_customize->add_control( 'show_page_headers', array(
		'label'    => __( 'Show Page Headers', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 10,
	) );
	
	$wp_customize->add_control( 'show_entry_date_on_excerpts', array(
		'label'    => __( 'Show entry date for post excepts on the main page', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 11,
	) );

	$wp_customize->add_control( 'link_post_title_arrow', array(
		'label'    => __( 'Add an arrow before the title of a link post', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 12,
	) );

	$wp_customize->add_control( 'show_theme_info', array(
		'label'    => __( 'Show Theme Info (display a line of text about the theme and its creator at the bottom of pages)', 'decode' ),
		'section'  => 'decode_content_options',
		'type'     => 'checkbox',
		'priority' => 13,
	) );
	
	$wp_customize->add_control(
		new Decode_Customize_Textarea_Control(
		$wp_customize, 'site_colophon', array(
			'label'    => __( 'Text (colophon, copyright, credits, etc.) for the footer of the site', 'decode' ),
			'section'  => 'decode_content_options',
			'settings' => 'site_colophon',
			'type'     => 'textarea',
			'priority' => 14,
	) ) );
	
	

/**
 * Other Options
 */
 
 	$wp_customize->add_section( 'decode_other_options', array(
    	'title'    => __( 'Other Options', 'decode' ),
		'priority' => 38,
    ) );
    
    
    $wp_customize->add_setting( 'custom_css', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_string',
	) );
	
	$wp_customize->add_setting( 'add_custom_post_types', array(
		'default'           => '',
		'sanitize_callback' => 'decode_sanitize_setting',
	) );
	
	
	$wp_customize->add_control(
		new Decode_Customize_Textarea_Control(
		$wp_customize, 'custom_css', array(
			'label'       => __( 'Custom CSS', 'decode' ),
			'section'     => 'decode_other_options',
			'settings'    => 'custom_css',
			'type'        => 'textarea',
			'priority'    => 1,
			'input_attrs' => array(
				'spellcheck' => 'false',
			),
	) ) );
	
	$wp_customize->add_control( 'add_custom_post_types', array(
		'label'    => __( 'Show the following post types on home blog page. (Separate with commas)', 'decode' ),
		'section'  => 'decode_other_options',
		'type'     => 'text',
		'priority' => 2,
	) );



/**
 * Color Options
 */

	$wp_customize->add_setting( 'accent_color', array(
		'default'           => '#00B0CC',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_setting( 'secondary_accent_color', array(
		'default'           => '#008094',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_setting( 'text_color', array(
		'default'           => '#4C4C4C',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_setting( 'secondary_text_color', array(
		'default'           => '#8C8C8C',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_setting( 'accent_color_icons', array(
		'default'           => false,
		'sanitize_callback' => 'decode_sanitize_boolean',
	) );


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'       => __( 'Accent Color', 'decode' ),
		'description' => __( 'The main color used for links, borders, buttons, and more.', 'decode' ),
		'section'     => 'colors',
		'settings'    => 'accent_color',
		'priority'    => 1,
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_accent_color', array(
		'label'       => __( 'Active Link Color', 'decode' ),
		'description' => __( 'The color for currently clicked links.<br>(Try using a darker color than the Accent Color.)', 'decode' ),
		'section'     => 'colors',
		'settings'    => 'secondary_accent_color',
		'priority'    => 2,
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
		'label'       => __( 'Text Color', 'decode' ),
		'description' => __( 'The main text color.', 'decode' ),
		'section'     => 'colors',
		'settings'    => 'text_color',
		'priority'    => 3,
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'       => __( 'Secondary Text Color', 'decode' ),
		'description' => __( 'Text color used for text of secondary importance.<br>(Try using a lighter color than the main Text Color.)', 'decode' ),
		'section'     => 'colors',
		'settings'    => 'secondary_text_color',
		'priority'    => 4,
	) ) );
	
	$wp_customize->add_control( 'accent_color_icons', array(
		'label'   => __( 'Use accent color instead of text color for icons', 'decode' ),
		'section' => 'colors',
		'type'    => 'checkbox',
	) );
}
	
	/**
	* This will output the custom WordPress settings to the live theme's WP head.
	* 
	* Used by hook: 'wp_head'
	* 
	* @see add_action('wp_head',$func)
	*/
	public static function decode_output_color_css() {
		?>
		<!-- Decode Custom Colors CSS -->
		<style type="text/css">
			<?php self::generate_css(
				'body, .sidebar, .sidebar-top, .menu ul ul, .header-style-ghost .site',
				'background-color',
				'background_color',
				'#'
			);
			
			self::generate_css(
				'body, button, input, select, textarea, .site-title a, .menu a, .entry-title, .search-entry, .search-entry .entry-title, .entry-title a, .format-link .entry-title h2 a, .read-more, .author-name a, .explore-page .widget h1, .decode-reply-tool-plugin .replylink, .decode-reply-tool-plugin .replytrigger',
				'color',
				'text_color'
			);
			
			self::generate_css( 
				'.menu ul > .menu-item-has-children > a::after, .menu ul > .page_item_has_children > a::after',
				'border-top-color',
				'text_color'
			);
			
			self::generate_css( 
				'.footer-menu ul > .menu-item-has-children > a::after, .footer-menu ul > .page_item_has_children > a::after',
				'border-bottom-color',
				'text_color'
			);
			
			if ( get_theme_mod( 'accent_color_icons', false ) == false ) :
				self::generate_css( 
					'.menu-icon, .close-icon, .social-icon-fill',
					'fill',
					'text_color'
				);
			else : 
				self::generate_css( 
					'.menu-icon, .close-icon, .social-icon-fill',
					'fill',
					'accent_color'
				);
			endif;

			
			self::generate_css(
				'a, .no-touch a:hover, button, input[type=button], input[type=reset], input[type=submit], .no-touch .site-title a:hover, .no-touch .menu a:hover, .menu ul li.open > a, .sidebar-menu a, .menu .current-menu-item > a, .menu .current_page_item > a, .no-touch .search-entry:hover, .no-touch .search-entry:hover .entry-title, .no-touch article .date a:hover, .no-touch .format-link .entry-title a:hover, .no-touch .comment-metadata a:hover, .no-touch .decode-reply-tool-plugin .replylink:hover',
				'color',
				'accent_color'
			);
			
			self::generate_css(
				'.no-touch button:hover, .no-touch input[type=button]:hover, .no-touch input[type=reset]:hover, .no-touch input[type=submit]:hover, .no-touch input[type=text]:focus, .touch input[type=text]:focus, .no-touch input[type=email]:focus, .touch input[type=email]:focus, .no-touch input[type=password]:focus, .touch input[type=password]:focus, .no-touch input[type=search]:focus, .touch input[type=search]:focus, .no-touch input[type=tel]:focus, .touch input[type=tel]:focus, .no-touch input[type=url]:focus, .touch input[type=url]:focus, .no-touch textarea:focus, .touch textarea:focus, .no-touch .site-description a:hover, .no-touch .entry-content a:hover, .no-touch .categories a:hover, .no-touch .tags a:hover, .no-touch .comments-link a:hover, .no-touch .edit-link a:hover, .no-touch .author-site a:hover, .no-touch .theme-info a:hover, .no-touch .site-colophon a:hover, .site-header, .menu ul ul, .menu a:focus, .site-breadcrumbs, .page-title, .post blockquote, .page blockquote, .entry-footer, .entry-header .entry-meta, .search .entry-footer, .sidebar-top, .sidebar-style-constant .sidebar.left, .sidebar-style-constant .sidebar.right, .explore-page .widget h1',
				'border-color',
				'accent_color'
			);
			
			self::generate_css(
				'.no-touch .menu ul > .menu-item-has-children > a:hover::after, .no-touch .menu ul > .page_item_has_children > a:hover::after, .menu ul li.open > a::after, .sidebar-menu ul .menu-item-has-children > a::after, .sidebar-menu ul .page_item_has_children > a::after, .menu ul > .current_page_item.menu-item-has-children > a::after, .menu ul > .current_page_item.page_item_has_children > a::after',
				'border-top-color',
				'accent_color'
			);
			
			self::generate_css(
				'.no-touch .footer-menu ul > .menu-item-has-children > a:hover::after, .no-touch .footer-menu ul > .page_item_has_children > a:hover::after, .footer-menu ul > li.open > a::after, .footer-menu ul > .current_page_item.menu-item-has-children > a::after, .footer-menu ul > .current_page_item.page_item_has_children > a::after',
				'border-bottom-color',
				'accent_color'
			);
			
			self::generate_css(
				'.no-touch a:active, .no-touch button:focus, .touch button:focus, .no-touch button:active, .touch button:active, .no-touch input[type=button]:focus, .touch input[type=button]:focus, .no-touch input[type=button]:active, .touch input[type=button]:active, .no-touch input[type=reset]:focus, .touch input[type=reset]:focus, .no-touch input[type=reset]:active, .touch input[type=reset]:active, .no-touch input[type=submit]:focus, .touch input[type=submit]:focus, .no-touch input[type=submit]:active, .touch input[type=submit]:active, .no-touch .site-title a:active, .no-touch .menu a:active, .no-touch .sidebar-menu a:hover, .sidebar-menu ul li.open > a, .menu .current-menu-item > a:hover, .menu .current_page_item > a:hover, .sidebar-menu ul .current-menu-item > a, .sidebar-menu ul .current_page_item > a, .no-touch .sidebar-content a:hover, .no-touch .search-entry:active, .no-touch .search-entry:active .entry-title, .no-touch article .date a:active, .no-touch .format-link .entry-title a:active, .no-touch .comment-metadata a:active, .no-touch .site-description a:active, .decode-reply-tool-plugin .replylink:active, .no-touch .decode-reply-tool-plugin .replylink:active',
				'color',
				'secondary_accent_color'
			);
			
			self::generate_css(
				'.no-touch button:focus, .touch button:focus, .no-touch button:active, .touch button:active, .no-touch input[type=button]:focus, .touch input[type=button]:focus, .no-touch input[type=button]:active, .touch input[type=button]:active, .no-touch input[type=reset]:focus, .touch input[type=reset]:focus, .no-touch input[type=reset]:active, .touch input[type=reset]:active, .no-touch input[type=submit]:focus, .touch input[type=submit]:focus, .no-touch input[type=submit]:active, .touch input[type=submit]:active, .no-touch .site-description a:active, .no-touch .entry-content a:active, .no-touch .categories a:active, .no-touch .tags a:active, .no-touch .comments-link a:active, .no-touch .edit-link a:active, .no-touch .author-site a:active, .no-touch .theme-info a:active, .no-touch .site-colophon a:active',
				'border-color',
				'secondary_accent_color'
			);
			
			self::generate_css(
				'.no-touch .menu ul > .menu-item-has-children > a:active::after, .no-touch .menu ul > .page_item_has_children > a:active::after, .no-touch .sidebar-menu ul .menu-item-has-children > a:hover::after, .no-touch .sidebar-menu ul .page_item_has_children > a:hover::after, .sidebar-menu ul li.open > a::after, .sidebar-menu ul .current_page_item.menu-item-has-children > a::after, .sidebar-menu ul .current_page_item.page_item_has_children > a::after',
				'border-top-color',
				'secondary_accent_color'
			);
			
			self::generate_css(
				'.no-touch .footer-menu ul > .menu-item-has-children > a:active::after, .no-touch .footer-menu ul > .page_item_has_children > a:active::after',
				'border-bottom-color',
				'secondary_accent_color'
			);
			
			self::generate_css(
				'.no-touch input[type=text]:hover, .no-touch input[type=email]:hover, .no-touch input[type=password]:hover, .no-touch input[type=search]:hover, .no-touch input[type=tel]:hover, .no-touch input[type=url]:hover, .no-touch textarea:hover, article .tags, article .categories, article .date, article .date a, .comment-metadata a, .search .page-header input[type=search]',
				'color',
				'secondary_text_color'
			);
				
			self::generate_css(
				'.no-touch input[type=text]:hover, .no-touch input[type=email]:hover, .no-touch input[type=password]:hover, .no-touch input[type=search]:hover, .no-touch input[type=tel]:hover, .no-touch input[type=url]:hover, .no-touch textarea:hover, .no-touch .search .page-header input[type=search]:hover',
				'border-color',
				'secondary_text_color'
			);
			
			/* Adding these properties later because they need to override their :hover counterparts */
			self::generate_css(
				'.no-touch input[type=text]:focus, .touch input[type=text]:focus, .no-touch input[type=email]:focus, .touch input[type=email]:focus, .no-touch input[type=password]:focus, .touch input[type=password]:focus, .no-touch input[type=search]:focus, .touch input[type=search]:focus, .no-touch input[type=tel]:focus, .touch input[type=tel]:focus, .no-touch input[type=url]:focus, .touch input[type=url]:focus, .no-touch textarea:focus, .touch textarea:focus',
				'color',
				'text_color'
			);
				
				self::generate_css(
				'.no-touch input[type=text]:focus, .touch input[type=text]:focus, .no-touch input[type=email]:focus, .touch input[type=email]:focus, .no-touch input[type=password]:focus, .touch input[type=password]:focus, .no-touch input[type=search]:focus, .touch input[type=search]:focus, .no-touch input[type=tel]:focus, .touch input[type=tel]:focus, .no-touch input[type=url]:focus, .touch input[type=url]:focus, .no-touch textarea:focus, .touch textarea:focus, .no-touch .search .page-header input[type=search]:focus, .touch .search .page-header input[type=search]:focus',
				'border-color',
				'accent_color'
			);
			
			?>
		</style>
		<?php
	}

	
	/**
	* This will generate a line of CSS for use in header output. If the setting
	* ($mod_name) has no defined value, the CSS will not be output.
	* 
	* @uses get_theme_mod()
	* @param string $selector CSS selector
	* @param string $style The name of the CSS *property* to modify
	* @param string $mod_name The name of the 'theme_mod' option to fetch
	* @param string $prefix Optional. Anything that needs to be output before the CSS property
	* @param string $postfix Optional. Anything that needs to be output after the CSS property
	* @param bool $echo Optional. Whether to print directly to the page (default: true).
	* @return string Returns a single line of CSS with selectors and a property.
	*/
	public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {
		$return = '';
		$mod = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf('%s { %s: %s; }',
			$selector,
			$style,
			$prefix.$mod.$postfix
		);
		if ( $echo ) {
			echo $return;
			}
		}
		return $return;
	}
}

// Adds settings to Customize menu
add_action( 'customize_register', array( 'Decode_Customize', 'decode_customize_register' ) );


// Output custom CSS to live site
add_action( 'wp_head', array( 'Decode_Customize', 'decode_output_color_css' ) );

// Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
function decode_customize_preview_js() {
	wp_enqueue_script( 'decode-customizer', get_template_directory_uri() . '/scripts/customizer.js', array( 'customize-preview', 'jquery' ), '3.0.0', true );
}
add_action( 'customize_preview_init', 'decode_customize_preview_js' );
