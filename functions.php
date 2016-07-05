<?php
/**
 * Decode functions and definitions
 *
 * @package Decode
 */
if ( ! function_exists( 'decode_setup' ) ) :
/*
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function decode_setup() {
	/*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
	load_theme_textdomain( 'decode', get_template_directory() . '/languages' );
	// Register all three menus. 
	$args = array(
		'header-menu'  => __( 'Header Menu', 'decode' ),
		'sidebar-menu' => __( 'Sidebar Menu', 'decode' ),
		'footer-menu' => __( 'Footer Menu', 'decode' )
	);
	$args = apply_filters( 'decode_register_nav_menus_args', $args );
	register_nav_menus( $args );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/**
	 * Add theme support for Jetpack Site Logo.
	 *
	 * @link http://jetpack.me/support/site-logo/
	 */
	$args = array(
		'header-text' => array(
			'site-title',
			'site-description',
		),
		'size' => 'full'
	);
	$args = apply_filters( 'decode_site_logo_args', $args );
	add_theme_support( 'site-logo', $args );
	// Set up the WordPress core custom header feature.
	$args = array(
		'default-image'          => '',
		'flex-width'             => true,
		'height'                 => 300,
		'flex-height'            => true,
		'header-text'            => false,
		//'admin-head-callback'    => 'decode_admin_header_style', // @todo: Remove this function when WordPress 4.3 is released
		//'admin-preview-callback' => 'decode_admin_header_image', // @todo: Remove this function when WordPress 4.3 is released
	); 
	$args = apply_filters( 'decode_custom_header_args', $args );
	add_theme_support( 'custom-header', $args );
	// Set up the WordPress core custom background feature.
	$args = array(
		'default-color' => 'E9EBED',
	); 
	$args = apply_filters( 'decode_custom_background_args', $args );
	add_theme_support( 'custom-background', $args );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	$args = array(
		'widgets',
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
	);
	$args = apply_filters( 'decode_html5_args', $args );
	add_theme_support( 'html5', $args );
	/**
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
	add_theme_support( 'post-thumbnails' );
	
	/**
	 * Enable support for Post Formats.
	 * @link https://codex.wordpress.org/Post_Formats
	 */
	$args = array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	); 
	$args = apply_filters( 'decode_post_formats_args', $args );
	add_theme_support( 'post-formats', $args );
	// Add Image Size
	add_image_size( 'decode-pro-related-posts', 203, 150, true );
}
endif; // decode_setup
add_action( 'after_setup_theme', 'decode_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function decode_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'decode_content_width', 792 );
}
add_action( 'after_setup_theme', 'decode_content_width', 0 );
/*
 * Register styles and scripts.
 */
if ( ! is_admin() && ! function_exists( 'decode_scripts' ) ) {
function decode_scripts() {
	wp_enqueue_style( 'decode-icomoon', get_template_directory_uri().'/assets/icomoon.css', array(), '3.0.7' );
	wp_enqueue_style( 'decode-style', get_stylesheet_uri(), array(), '3.0.7' );
	
	if ( get_theme_mod( 'latin_extended_font', false ) == true ) {
		wp_enqueue_style( 'decode-font-stylesheet', '//fonts.googleapis.com/css?family=Oxygen&subset=latin-ext' );
	}
	else {
		wp_enqueue_style( 'decode-font-stylesheet', '//fonts.googleapis.com/css?family=Oxygen' );
	}
	
	wp_enqueue_script( 'decode-scripts', get_template_directory_uri() . '/scripts/decode.js', array(), '3.0.9', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'decode-keyboard-image-navigation', get_template_directory_uri() . '/scripts/keyboard-image-navigation.js', array( 'jquery' ), '2.7.5', true );
	}
	
}
}
add_action( 'wp_enqueue_scripts', 'decode_scripts' );
/**
 * Register widgetized area and update sidebar with default widgets.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'decode_widgets_init' ) ) {
function decode_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'decode' ),
		'id'            => 'sidebar-1',
		'description'   => _x( 'Only displayed if sidebar remains enabled in the Customize menu.', 'sidebar description', 'decode' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );
}
}
add_action( 'widgets_init', 'decode_widgets_init' );
/*
 * Add Custom CSS to page.
 */
if ( ! is_admin() && ! function_exists( 'decode_custom_css' ) ) {
function decode_custom_css() {
	if ( get_theme_mod( 'custom_css', '' ) !== '' ) { ?>
		<!-- Decode Custom CSS -->
		<style type="text/css">
			<?php echo get_theme_mod( 'custom_css', '' ); ?>
		</style>
	<?php }
}
}
add_action( 'wp_head', 'decode_custom_css', 11 ); // Priority of 11 will cause this to appear after the custom colors CSS.
/**
 *	TGM Plugin Activation
 */
require get_template_directory() . '/inc/tgm-plugin-activation/tgm-plugin-activation.php';
/*
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/*
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/*
 * Customize custom controls.
 */
require get_template_directory() . '/inc/custom-controls.php';
/*
 * Customize Menu additions.
 */
require get_template_directory() . '/inc/customizer.php';
/*
 * Custom Header callbacks.
 */
require get_template_directory() . '/inc/custom-header.php';
/*
 * Decode Theme Hook functions.
 */
require get_template_directory() . '/inc/decode-theme-hooks.php';
/*
 * Theme Hook Alliance functions.
 */
require get_template_directory() . '/inc/tha-theme-hooks.php';
/*
 * Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
/*
 * Setup editor styles.
 */
if ( ! function_exists( 'decode_add_editor_styles' ) ) {
function decode_add_editor_styles() {
	add_editor_style( 'editor-style.css' );
}
}
add_action( 'init', 'decode_add_editor_styles' );
/*
 * Add body classes for sidebar layout options.
 */
function decode_add_body_classes( $classes ) {
	if ( get_theme_mod( 'show_sidebar', true ) == true ) {
		// Add 'ghost-header-style' to the $classes array.
		$classes[] = 'sidebar-style-' . get_theme_mod( 'constant_sidebar', 'closing' );
		$classes[] = 'sidebar-style-' . get_theme_mod( 'sidebar_position', 'left' );
	}
	// Return the $classes array.
	return $classes;
}
add_filter( 'body_class', 'decode_add_body_classes' );
/*
 * Link post titles are turned into links to the link URL not the permalink for link blog-style behaviour.
 */
if ( ! function_exists( 'decode_print_post_title' ) ) {
	function decode_print_post_title() {
	global $post;
	$thePostID = $post->ID;
	$post_id = get_post( $thePostID );
	$title = $post_id->post_title;
	$perm = get_permalink( $post_id );
	$post_keys = array(); $post_val = array();
	$post_keys = get_post_custom_keys( $thePostID );
	if ( ! empty( $post_keys ) ) {
		foreach ( $post_keys as $pkey ) {
	
			if ( $pkey == 'title_url' || $pkey == 'url_title' || $pkey == 'title_link' ) {
				$post_val = get_post_custom_values( $pkey );
			}
		}
	
		if ( empty( $post_val ) ) {
			$link = $perm;
		}
		
		else {
			$link = $post_val[0];
		}
	}
	 
	else {
		$link = $perm;
	}
	echo '<a href="'.$link.'" rel="bookmark" title="'.$title.'">'.$title.'</a>';
	}
}
/*
 * Show all post types in main query
 */
if ( ! function_exists( 'decode_add_post_types_to_query' ) ) {
function decode_add_post_types_to_query( $query ) {
		$typelist = 'post';
		if ( get_theme_mod( 'add_custom_post_types', '' ) !== '' ) {
			$typelist .= ', ' . get_theme_mod( 'add_custom_post_types', '' );
			$typelist = explode( ', ', $typelist );
		}
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', $typelist );
	return $query;	
}
}
if ( get_theme_mod( 'add_custom_post_types', '' ) !== '' ) {
	add_action( 'pre_get_posts', 'decode_add_post_types_to_query' );
}
/**
 *	Header menu bottom
 */
if( !function_exists( 'header_menu_bottom' ) ) {
	add_action( 'header_menu_bottom', 'header_menu_bottom' );
	function header_menu_bottom() {
		if ( get_theme_mod( 'show_header_menu', true ) == true && get_theme_mod( 'decode_pro_header_options_navigation_menu_position', 'after_logo' ) == 'after_logo' ) {
			wp_nav_menu( array(
				'theme_location' => 'header-menu',
				'container'      => false,
				'menu_class'     => 'menu horizontal-menu header-menu',
				'menu_id'        => 'header-menu',
				'items_wrap'     => '<nav id="%1$s" class="%2$s" role="navigation"><ul>%3$s</ul></nav><!-- #header-menu -->',
			) );
		}
	}
}
// add custom class for archive pages
function decode_add_extra_articles_class( $classes ) {
	global $post;
	if ( is_archive() || is_home() ) {
		$classes[] = 'archive-listings';
	}
	
	return $classes;
}
add_filter( 'post_class', 'decode_add_extra_articles_class' );

if( !function_exists('decode_register_required_plugins') ) {
	/**
	 * Custom function to load TGMPA
	 *
	 * @since Decode 3.14.3
	 */
	function decode_register_required_plugins()
	{

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			// Login Customizer
			array(
				'name' => 'Simple Social Share', // The plugin name.
				'slug' => 'kiwi-social-share', // The plugin slug (typically the folder name).
				'source' => '', // The plugin source.
				'required' => false, // If false, the plugin is only 'recommended' instead of required.
				'version' => '1.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url' => '', // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name' => 'reCaptcha Security', // The plugin name.
				'slug' => 'uber-nocaptcha-recaptcha', // The plugin slug (typically the folder name).
				'source' => '', // The plugin source.
				'required' => false, // If false, the plugin is only 'recommended' instead of required.
				'version' => '1.0.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url' => '', // If set, overrides default API URL and points to an external URL.
			)
		);

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'        => 'mt-install-plugins', // Menu slug.
			'has_notices' => true,                    // Show admin notices or not.
			'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg' => true,                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message' => '',                      // Message to output right before the plugins table.
			'strings' => array(
				'page_title' => __('Install Required Plugins', 'decode'),
				'menu_title' => __('Install Plugins', 'decode'),
				'installing' => __('Installing Plugin: %s', 'decode'), // %s = plugin name.
				'oops' => __('Something went wrong with the plugin API.', 'decode'),
				'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'decode'), // %1$s = plugin name(s).
				'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'decode'), // %1$s = plugin name(s).
				'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'decode'), // %1$s = plugin name(s).
				'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'decode'), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'decode'), // %1$s = plugin name(s).
				'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'decode'), // %1$s = plugin name(s).
				'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'decode'), // %1$s = plugin name(s).
				'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'decode'), // %1$s = plugin name(s).
				'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'decode'),
				'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins', 'decode'),
				'return' => __('Return to Required Plugins Installer', 'decode'),
				'plugin_activated' => __('Plugin activated successfully.', 'decode'),
				'complete' => __('All plugins installed and activated successfully. %s', 'decode'), // %s = dashboard link.
				'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);

		tgmpa($plugins, $config);
	}

	add_action( 'tgmpa_register', 'decode_register_required_plugins' );
}

#
# More Themes Functionality
#