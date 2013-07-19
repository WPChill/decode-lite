<?php
/**
 * Decode functions and definitions
 *
 * @package Decode
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'decode_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function decode_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on decode, use a find and replace
	 * to change 'decode' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'decode', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'decode' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'decode_custom_background_args', array(
		'default-color' => 'E3E5E7',
		'default-image' => '',
	) ) );
}
endif; // decode_setup
add_action( 'after_setup_theme', 'decode_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function decode_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'decode' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'decode_widgets_init' );

/**
 * Setup editor styles
 */
function decode_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'decode_add_editor_styles' );

/**
 * Enqueue scripts and styles
 */

if ( ! is_admin() ) {
function decode_scripts() {
	wp_enqueue_style( 'decode-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'decode-font-stylesheet', 'http://fonts.googleapis.com/css?family=Oxygen' );

	wp_enqueue_script( 'decode-modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.2', true );

	wp_enqueue_script( 'decode-respond', get_template_directory_uri() . '/js/respond.js', array(), '2.2', true );
	
	wp_enqueue_script( 'decode-fastclick', get_template_directory_uri() . '/js/fastclick.js', array(), '2.2', true );
		
	wp_enqueue_script( 'decode-sidebar', get_template_directory_uri() . '/js/sidebar.js', array('jquery'), '2.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'decode-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
}
add_action( 'wp_enqueue_scripts', 'decode_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Link post titles link to the link URL, not the permalink for link blog-style behaviour
 */
function decode_print_post_title() {

global $post;

$thePostID = $post->ID;

$post_id = get_post($thePostID);

$title = $post_id->post_title;

$perm = get_permalink($post_id);

$post_keys = array(); $post_val = array();

$post_keys = get_post_custom_keys($thePostID);

 

if (!empty($post_keys)) {

foreach ($post_keys as $pkey) {

if ($pkey=='url1' || $pkey=='title_url' || $pkey=='url_title') {

$post_val = get_post_custom_values($pkey);

}

}

if (empty($post_val)) {

$link = $perm;

} else {

$link = $post_val[0];

}

} else {

$link = $perm;

}


echo '<h2 class="entry-title"><a href="'.$link.'" rel="bookmark" title="'.$title.'">'.$title.'</a></h2>';

}