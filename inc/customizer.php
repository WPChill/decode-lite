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
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

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


/**
 * Header Options
 */

 	$wp_customize->add_section( 'decode_header_options', array(
    	'title'   => __( 'Header Options', 'decode' ),
		'priority'=> 32,
	) );


	$wp_customize->add_setting( 'header_image', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'favicon_image', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'show_site_title', array(
		'default' => true,
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'show_site_description', array(
		'default' => true,
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'show_header_menu', array(
		'default' => true,
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'html_description', array(
		'default' => '',
	) );


	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_image', array(
		'label'   => __( 'Header Image', 'decode' ),
		'section' => 'decode_header_options',
		'settings'=> 'header_image',
		'priority'=> 1,
	) ) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'favicon_image', array(
		'label'   => __( 'Favicon Image (recommended to be a PNG)', 'decode' ),
		'section' => 'decode_header_options',
		'settings'=> 'favicon_image',
		'priority'=> 2,
	) ) );
	
	$wp_customize->add_control( 'show_site_title', array(
		'label'   => __( 'Show Site Title', 'decode' ),
		'section' => 'decode_header_options',
		'type'    => 'checkbox',
		'priority'=> 3,
	) );
	
	$wp_customize->add_control( 'show_site_description', array(
		'label'   => __( 'Show Site Description', 'decode' ),
		'section' => 'decode_header_options',
		'type'    => 'checkbox',
		'priority'=> 4,
	) );
	
	$wp_customize->add_control( 'show_header_menu', array(
		'label'   => __( 'Show Header Menu', 'decode' ),
		'section' => 'decode_header_options',
		'type'    => 'checkbox',
		'priority'=> 5,
	) );
	
	$wp_customize->add_control( 'html_description', array(
		'label'   => __( 'HTML for description, if you wish to replace your blog description with HTML markup', 'decode' ),
		'section' => 'decode_header_options',
		'type'    => 'text',
		'priority'=> 6,
	) );



/**
 * Sidebar Options
 */

	$wp_customize->add_section( 'decode_sidebar_options', array(
    	'title'    => __( 'Sidebar Options', 'decode' ),
		'priority' => 33,
    ) );


    $wp_customize->add_setting( 'show_sidebar', array(
		'default'  => true,
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'sidebar_position', array(
		'default'  => 'left',
	) );

	$wp_customize->add_setting( 'sidebar_button_position', array(
		'default'  => 'left',
	) );
	
	$wp_customize->add_setting( 'constant_sidebar', array(
		'default'  => 'closing',
	) );


	$wp_customize->add_control( 'show_sidebar', array(
		'label'   => __( 'Enable Sidebar', 'decode' ),
		'section' => 'decode_sidebar_options',
		'type'    => 'checkbox',
		'priority'=> 1,
	) );

	$wp_customize->add_control( 'sidebar_position', array(
		'label'   => __( 'Sidebar Position', 'decode' ),
		'section' => 'decode_sidebar_options',
		'type'    => 'radio',
		'choices' => array(
			'left'  => __( 'Left', 'decode' ),
			'right' => __( 'Right', 'decode' ),
        ),
		'priority'=> 2,
	) );

	$wp_customize->add_control( 'sidebar_button_position', array(
		'label'   => __( 'Sidebar Button Position', 'decode' ),
		'section' => 'decode_sidebar_options',
		'type'    => 'radio',
		'choices' => array(
			'left'  => 'Left',
			'right' => 'Right',
        ),
		'priority'=> 3,
	) );
	
	$wp_customize->add_control( 'constant_sidebar', array(
		'label'   => __( 'Always Visible Sidebar', 'decode' ),
		'section' => 'decode_sidebar_options',
		'type'    => 'radio',
		'choices' => array(
			'constant'  => 'Always open',
			'closing' => 'Closed by default',
        ),
        'priority'=> 4,

	) );



/**
 * Discussion Options
 */

	$wp_customize->add_section( 'decode_discussion_options', array(
    	'title'   => __( 'Discussion Options', 'decode' ),
		'priority'=> 34,
    ) );


	$wp_customize->add_setting( 'enable_comments', array(
		'default' => true,
		'transport' => 'refresh',
	) );


	$wp_customize->add_control( 'enable_comments', array(
		'label'   => __( 'Enable Comments', 'decode' ),
		'section' => 'decode_discussion_options',
		'type'    => 'checkbox',
		'priority'=> 1,
	) );



/**
 * Social Options
 */

	$wp_customize->add_section( 'decode_social_options', array(
    	'title'   => __( 'Social Options', 'decode' ),
		'priority'=> 35,
    ) );


	$wp_customize->add_setting( 'show_social_icons', array(
		'default' => false,
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'open_links_in_new_tab', array(
		'default' => false,
		'transport' => 'refresh',
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
	
	$wp_customize->add_setting( 'myspace_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'diaspora_id', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'vk_username', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'dribbble_username', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'behance_username', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'linkedin_profile_url', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'pinterest_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'fancy_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'etsy_username', array(
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

	$wp_customize->add_setting( 'deviantart_username', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'soundcloud_username', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'rdio_username', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'spotify_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'lastfm_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'vine_username', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'vimeo_username', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'youtube_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'kickstarter_url', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'tumblr_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'wordpress_url', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'stackoverflow_userid', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'reddit_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'github_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'runkeeper_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'strava_userid', array(
		'default' => '',
	) );

	$wp_customize->add_setting( 'foursquare_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'yelp_userid', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'slideshare_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'researchgate_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'youversion_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'psn_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'xbox_live_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'steam_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'steam_group_name', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'skype_username', array(
		'default' => '',
	) );
	
	$wp_customize->add_setting( 'show_rss_icon', array(
		'default' => false,
	) );
	
	$wp_customize->add_setting( 'email_address', array(
		'default' => '',
	) );


	$wp_customize->add_control( 'show_social_icons', array(
		'label'   => __( 'Show Social Icons', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'checkbox',
		'priority'=> 1,
	) );
	
	$wp_customize->add_control( 'open_links_in_new_tab', array(
		'label'   => __( 'Open Links in New Tab/Window', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'checkbox',
		'priority'=> 2,
	) );

	$wp_customize->add_control( 'twitter_username', array(
		'label'   => 'Twitter ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 3,
	) );

	$wp_customize->add_control( 'adn_username', array(
    	'label'   => 'App.net ' . __( 'Username', 'decode' ),
        'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 4,
	) );

	$wp_customize->add_control( 'facebook_username', array(
		'label'   => 'Facebook ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 5,
	) );

	$wp_customize->add_control( 'google_plus_username', array(
		'label'   => 'Google+ ' . __( 'Username', 'decode' ) .  __(' (or the long number in your profile URL)', 'decode'),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 6,
	) );
	
	$wp_customize->add_control( 'myspace_username', array(
		'label'   => 'MySpace ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 7,
	) );
	
	$wp_customize->add_control( 'diaspora_id', array(
		'label'   => 'Diaspora ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 8,
	) );
	
	$wp_customize->add_control( 'vk_username', array(
		'label'   => 'VK ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 9,
	) );

	$wp_customize->add_control( 'dribbble_username', array(
		'label'   => 'Dribbble ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 10,
	) );

	$wp_customize->add_control( 'behance_username', array(
		'label'   => 'Behance ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 11,
	) );

	$wp_customize->add_control( 'linkedin_profile_url', array(
		'label'   => 'Linkedin ' . __( 'Profile URL', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 12,
	) );

	$wp_customize->add_control( 'pinterest_username', array(
		'label'   => 'Pinterest ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 13,
	) );
	
	$wp_customize->add_control( 'fancy_username', array(
		'label'   => 'Fancy ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 14,
	) );
	
	$wp_customize->add_control( 'etsy_username', array(
		'label'   => 'Etsy ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 15,
	) );

	$wp_customize->add_control( 'instagram_username', array(
		'label'   => 'Instagram ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 16,
	) );

	$wp_customize->add_control( '500px_username', array(
		'label'   => '500px ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 17,
	) );

	$wp_customize->add_control( 'flickr_username', array(
		'label'   => 'Flickr ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 18,
	) );
	
	$wp_customize->add_control( 'deviantart_username', array(
		'label'   => 'DeviantART ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 19,
	) );
	
	$wp_customize->add_control( 'soundcloud_username', array(
		'label'   => 'Soundcloud ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 20,
	) );

	$wp_customize->add_control( 'rdio_username', array(
		'label'   => 'Rdio ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 21,
	) );

	$wp_customize->add_control( 'spotify_username', array(
		'label'   => 'Spotify ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 22,
	) );
	
	$wp_customize->add_control( 'lastfm_username', array(
		'label'   => 'Last.fm ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 23,
	) );

	$wp_customize->add_control( 'vine_username', array(
		'label'   => 'Vine ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 24,
	) );

	$wp_customize->add_control( 'vimeo_username', array(
		'label'   => 'Vimeo ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 25,
	) );

	$wp_customize->add_control( 'youtube_username', array(
		'label'   => 'YouTube ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 26,
	) );
	
	$wp_customize->add_control( 'kickstarter_url', array(
		'label'   => 'Kickstarter ' . __( 'Site URL', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 27,
	) );
	
	$wp_customize->add_control( 'tumblr_username', array(
		'label'   => 'Tumblr ' . __( 'Site URL', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 28,
	) );
	
	$wp_customize->add_control( 'wordpress_url', array(
		'label'   => 'WordPress ' . __( 'Site URL', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 29,
	) );

	$wp_customize->add_control( 'stackoverflow_userid', array(
		'label'   => 'Stack Overflow ' . __( 'User ID', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 30,
	) );
	
	$wp_customize->add_control( 'reddit_username', array(
		'label'   => 'Reddit ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 31,
	) );

	$wp_customize->add_control( 'github_username', array(
		'label'   => 'GitHub ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 32,
	) );
	
	$wp_customize->add_control( 'runkeeper_username', array(
		'label'   => 'Runkeeper ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 33,
	) );
	
	$wp_customize->add_control( 'strava_userid', array(
		'label'   => 'Strava ' . __( 'User ID', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 34,
	) );

	$wp_customize->add_control( 'foursquare_username', array(
		'label'   => 'Foursquare ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 35,
	) );
	
	$wp_customize->add_control( 'yelp_userid', array(
		'label'   => 'Yelp ' . __( 'User ID', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 36,
	) );
	
	$wp_customize->add_control( 'slideshare_username', array(
		'label'   => 'SlideShare ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 37,
	) );
	
	$wp_customize->add_control( 'researchgate_username', array(
		'label'   => 'Research Gate ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 38,
	) );
	
	$wp_customize->add_control( 'youversion_username', array(
		'label'   => 'YouVersion ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 39,
	) );
	
	$wp_customize->add_control( 'psn_username', array(
		'label'   => 'Playstation Network ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 40,
	) );
	
	$wp_customize->add_control( 'xbox_live_username', array(
		'label'   => 'Xbox Live ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 41,
	) );
	
	$wp_customize->add_control( 'steam_username', array(
		'label'   => 'Steam ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 42,
	) );
	
	$wp_customize->add_control( 'steam_group_name', array(
		'label'   => 'Steam ' . __( 'Group Name', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 43,
	) );
	
	$wp_customize->add_control( 'skype_username', array(
		'label'   => 'Skype ' . __( 'Username', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 44,
	) );
	
	$wp_customize->add_control( 'show_rss_icon', array(
		'label'   => __( 'RSS Feed', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'checkbox',
		'priority'=> 45,
	) );
	
	$wp_customize->add_control( 'email_address', array(
		'label'   => __( 'Email Address', 'decode' ),
		'section' => 'decode_social_options',
		'type'    => 'text',
		'priority'=> 46,
	) );



/**
 * Reading Options
 */

	$wp_customize->add_section( 'decode_reading_options', array(
    	'title'   => __( 'Reading Options', 'decode' ),
		'priority'=> 37,
    ) );


	$wp_customize->add_setting( 'use_excerpts', array(
		'default' => false,
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'show_featured_images_on_excerpts', array(	// Yep, that's the longest setting name I have.
		'default' => false,
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'show_featured_images_on_singles', array(
		'default' => false,
		'transport' => 'refresh',
	) );

    $wp_customize->add_setting( 'show_tags', array(
		'default' => false,
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'show_categories', array(
		'default' => false,
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'show_author_section', array(
		'default' => false,
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'entry_date_position', array(
		'default' => 'below',
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'show_entry_date_on_excerpts', array(
		'default' => false,
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'show_page_headers', array(
		'default' => true,
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'link_post_title_arrow', array(
		'default' => false,
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'show_all_post_types', array(
		'default' => false,
		'transport' => 'refresh',
	) );

    $wp_customize->add_setting( 'show_theme_info', array(
		'default' => true,
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'site_colophon', array(
		'default' => '',
		'transport' => 'postMessage',
	) );


	$wp_customize->add_control( 'use_excerpts', array(
		'label'   => __( 'Use entry excerpts instead of full text on site home. Excludes sticky posts.', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 1,
	) );
	
	$wp_customize->add_control( 'show_featured_images_on_excerpts', array(
		'label'   => __( 'Display posts\' featured images when excerpts are shown on main page.', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 2,
	) );
	
	$wp_customize->add_control( 'show_featured_images_on_singles', array(
		'label'   => __( 'Display a post\'s featured image on its individual page.', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 3,
	) );

	$wp_customize->add_control( 'show_tags', array(
		'label'   => __( 'Show tags on front page (tags will be shown on post\'s individual page)', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 4,
	) );

	$wp_customize->add_control( 'show_categories', array(
		'label'   => __( 'Show categories on front page (categories will be shown on post\'s individual page)', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 5,
	) );
	
	$wp_customize->add_control( 'show_author_section', array(
		'label'   => __( 'Show author\'s name, profile image, and bio after posts', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 6,
	) );
	
	$wp_customize->add_control( 'entry_date_position', array(
		'label'   => __( 'Entry Date Position', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'radio',
		'choices' => array(
			'above'  => __( 'Above Header', 'decode' ),
			'below' => __( 'Below Header', 'decode' ),
        ),
		'priority'=> 7,
	) );
	
	$wp_customize->add_control( 'show_page_headers', array(
		'label'   => __( 'Show Page Headers', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 8,
	) );
	
	$wp_customize->add_control( 'show_entry_date_on_excerpts', array(
		'label'   => __( 'Show entry date for post excepts on the main page', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 9,
	) );

	$wp_customize->add_control( 'link_post_title_arrow', array(
		'label'   => __( 'Add an arrow before the title of a link post', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 10,
	) );
	
	$wp_customize->add_control( 'show_all_post_types', array(
		'label'   => __( 'Show all post types, including custom post types', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 11,
	) );

	$wp_customize->add_control( 'show_theme_info', array(
		'label'   => __( 'Show Theme Info (display a line of text about the theme and its creator at the bottom of pages)', 'decode' ),
		'section' => 'decode_reading_options',
		'type'    => 'checkbox',
		'priority'=> 12,
	) );
	
	$wp_customize->add_control( new Decode_Customize_Textarea_Control( $wp_customize, 'site_colophon', array(
		'label'   => __( 'Text (colophon, copyright, credits, etc.) for the footer of the site', 'decode' ),
		'section' => 'decode_reading_options',
		'settings'=> 'site_colophon',
		'priority'=> 13,
	) ) );
	
	

/**
 * Other Options
 */
 
 	$wp_customize->add_section( 'decode_other_options', array(
    	'title'   => __( 'Other Options', 'decode' ),
		'priority'=> 38,
    ) );
    
    
    $wp_customize->add_setting( 'custom_css', array(
		'default' => '',
		'transport' => 'refresh',
	) );
	
	
	$wp_customize->add_control( new Decode_Customize_Textarea_Control( $wp_customize, 'custom_css', array(
		'label'   => __( 'Custom CSS', 'decode' ),
		'section' => 'decode_other_options',
		'settings'=> 'custom_css',
		'priority'=> 1,
	) ) );



/**
 * Color Options
 */

	$wp_customize->add_setting( 'accent_color', array(
		'default'   => '#009BCD',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'secondary_accent_color', array(
		'default'   => '#007EA6',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'text_color', array(
		'default'   => '#444444',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'secondary_text_color', array(
		'default'   => '#808080',
		'transport' => 'refresh',
	) );
	
	$wp_customize->add_setting( 'accent_color_icons', array(
		'default'   => false,
		'transport' => 'refresh',
	) );


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'      => __( 'Accent Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'accent_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_accent_color', array(
		'label'      => __( 'Active Link Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'secondary_accent_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
		'label'      => __( 'Text Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'text_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'      => __( 'Secondary Text Color', 'decode' ),
		'section'    => 'colors',
		'settings'   => 'secondary_text_color',
	) ) );
	
	$wp_customize->add_control( 'accent_color_icons', array(
		'label'   => __( 'Use accent color instead of text color for icons', 'decode' ),
		'section' => 'colors',
		'type'    => 'checkbox',
	) );

}
add_action( 'customize_register', 'decode_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function decode_customize_preview_js() {
	wp_enqueue_script( 'decode-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'jquery' ), '2.7', true );
}
add_action( 'customize_preview_init', 'decode_customize_preview_js' );
