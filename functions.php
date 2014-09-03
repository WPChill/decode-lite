<?php
/**
 * Decode functions and definitions
 *
 * @package Decode
 */
 
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

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
	
	// Set up the WordPress core custom header feature.
	$args = array(
		'default-image'          => '',
		'flex-width'             => true,
		'height'                 => 300,
		'flex-height'            => true,
		'header-text'            => false,
		'admin-head-callback'    => 'decode_admin_header_style',
		'admin-preview-callback' => 'decode_admin_header_image',
	); 
	$args = apply_filters( 'decode_custom_header_args', $args );
	add_theme_support( 'custom-header', $args );

	// Set up the WordPress core custom background feature.
	$args = array(
		'default-color' => 'ECF0F1',
	); 
	$args = apply_filters( 'decode_custom_background_args', $args );
	add_theme_support( 'custom-background', $args );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	$args = array(
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
	);
	$args = apply_filters( 'decode_html5_args', $args );
	add_theme_support( 'html5', $args );

	/*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
	add_theme_support( 'post-thumbnails' );
	
	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
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
}
endif; // decode_setup
add_action( 'after_setup_theme', 'decode_setup' );

/*
 * Register styles and scripts.
 */
if ( ! is_admin() && ! function_exists( 'decode_scripts' ) ) {

function decode_scripts() {

	wp_enqueue_style( 'decode-style', get_stylesheet_uri(), array(), '3.0.1' );
	
	if ( get_theme_mod( 'latin_extended_font', false ) == true ) {
		wp_enqueue_style( 'decode-font-stylesheet', '//fonts.googleapis.com/css?family=Oxygen&subset=latin-ext' );
	}
	else {
		wp_enqueue_style( 'decode-font-stylesheet', '//fonts.googleapis.com/css?family=Oxygen' );
	}
	
	wp_enqueue_script( 'decode-scripts', get_template_directory_uri() . '/scripts/decode.js', array(), '3.0.0', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) && get_theme_mod( 'enable_comments', true ) == true ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'decode-keyboard-image-navigation', get_template_directory_uri() . '/scripts/keyboard-image-navigation.js', array( 'jquery' ), '2.7.5', true );
	}
	
}
}
add_action( 'wp_enqueue_scripts', 'decode_scripts' );

/*
 * Register widgetized area and update sidebar with default widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
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

/*
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/*
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

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
 * Add Google Profile to user contact methods.
 */
function decode_add_google_profile( $contactmethods ) {
	// Add Google Profiles
	$contactmethods['google_profile'] = 'Google Profile URL';
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'decode_add_google_profile', 10, 1 );

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
if ( ! function_exists( 'add_post_types_to_query' ) ) {

function add_post_types_to_query( $query ) {
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
	add_action( 'pre_get_posts', 'add_post_types_to_query' );
}