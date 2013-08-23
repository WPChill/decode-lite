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
	 * Specifies for the theme to use HTML 5 tags
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', ) );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'decode_custom_background_args', array(
		'default-color' => 'E3E5E7',
	) ) );

	/**
	 * This theme uses wp_nav_menu() once in header.php.
	 */
	register_nav_menus( array(
		'navigation' => __( 'Nav Menu', 'decode' ),
	) );
}
endif; // decode_setup
add_action( 'after_setup_theme', 'decode_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
if ( ! function_exists( 'decode_widgets_init' ) ) {

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
}
add_action( 'widgets_init', 'decode_widgets_init' );

/**
 * Setup editor styles
 */
if ( ! function_exists( 'decode_add_editor_styles' ) ) {

function decode_add_editor_styles() {
	add_editor_style( 'editor-style.css' );
}
}
add_action( 'init', 'decode_add_editor_styles' );

/**
 * Add Google Profile to user contact methods
 */
function decode_add_google_profile( $contactmethods ) {
	// Add Google Profiles
	$contactmethods['google_profile'] = 'Google Profile URL';
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'decode_add_google_profile', 10, 1);

/**
 * Highlight search terms in search results
 */
if ( ! function_exists( 'decode_search_excerpt_highlight' ) ) {

function decode_search_excerpt_highlight() {
    $excerpt = get_the_excerpt();
    $keys = implode('|', explode(' ', get_search_query()));
    $excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $excerpt);

    echo '<p>' . $excerpt . '</p>';
}
}

if ( ! function_exists( 'decode_search_title_highlight' ) ) {

function decode_search_title_highlight() {
    $title = get_the_title();
    $keys = implode('|', explode(' ', get_search_query()));
    $title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);

    echo $title;
}
}

/**
 * Register styles and scripts
 */

if ( ! is_admin() && ! function_exists( 'decode_scripts' ) ) {

function decode_scripts() {

	wp_register_style( 'decode-style', get_stylesheet_uri(), array(), "2.7.2" );

	wp_register_style( 'decode-font-stylesheet', 'http://fonts.googleapis.com/css?family=Oxygen&subset=latin-ext' );
	
	wp_register_script( 'decode-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '2.2', true );

	wp_register_script( 'decode-modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.7.1', false );

	wp_register_script( 'decode-respond', get_template_directory_uri() . '/js/respond.js', array(), '2.5', false );

	wp_register_script( 'decode-fastclick', get_template_directory_uri() . '/js/fastclick.js', array(), '2.3.2', true );

	wp_register_script( 'decode-sidebar', get_template_directory_uri() . '/js/sidebar.js', array('jquery'), '2.6', true );


	wp_enqueue_style( 'decode-style');

	wp_enqueue_style( 'decode-font-stylesheet' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }

	if ( is_singular() && wp_attachment_is_image() ) { wp_enqueue_script( 'decode-keyboard-image-navigation' ); }

	wp_enqueue_script( 'decode-modernizr' );

	wp_enqueue_script( 'decode-respond' );

	if (get_theme_mod( 'show_sidebar', true ) == true ) {
		wp_enqueue_script( 'decode-fastclick' );
		wp_enqueue_script( 'decode-sidebar' );
	}
}
}
add_action( 'wp_enqueue_scripts', 'decode_scripts' );

/**
 * Add custom colors to CSS
 */

if ( ! is_admin() && ! function_exists( 'decode_customize_css' ) ) {

function decode_customize_css()
{
    ?>
         <style type="text/css">
        body, .sidebar, .SidebarTop, .main-navigation ul ul {
			background: <?php echo '#' . get_background_color(); ?>;
		}

		body, button, select, textarea, .site-title a, .no-touch .site-title a:hover, .no-touch .site-title a:active, .main-navigation a, .no-touch .main-navigation a:hover, .no-touch .main-navigation a:active, .entry-title, .search-entry, .search-entry .entry-title, .entry-title a, .format-link .entry-title h2 a, .author-name a, .explore-page .widget h1, .decode-reply-tool-plugin .replylink, .decode-reply-tool-plugin .replytrigger {
			color: <?php echo get_theme_mod('text_color'); ?>;
		}
		
	<?php if (get_theme_mod( 'accent_color_icons', false ) == false ) : ?>
		.SidebarMenuTrigger, .SidebarMenuClose, .SocialIconFill {
			fill: <?php echo get_theme_mod('text_color'); ?>;
		}
	<?php else : ?>
		.SidebarMenuTrigger, .SidebarMenuClose, .SocialIconFill {
			fill: <?php echo get_theme_mod('accent_color'); ?>;
		}
	<?php endif; ?>

		a, .no-touch a:hover, .no-touch .main-navigation a:hover, .search-entry:hover, .search-entry:hover .entry-title, .no-touch footer .date a:hover, .no-touch .format-link .entry-title a:hover, .no-touch .comment-metadata a:hover, .no-touch .decode-reply-tool-plugin .replylink:hover, .main-navigation li.current_page_item > a, .main-navigation li.current-menu-item > a {
			color: <?php echo get_theme_mod('accent_color'); ?>;
		}

		.no-touch .entry-content a:hover, .no-touch .entry-meta a:hover, .site-header, .page-title, .post blockquote, .page blockquote, .post footer, .search .post, .search .page, .no-touch .theme-info a:hover, .SidebarTop, .sidebar.constant.left, .sidebar.constant.right, .no-touch .site-description a:hover, .explore-page .widget h1, .no-touch button:focus, .touch button:focus, .no-touch input[type='button']:focus, .touch input[type='button']:focus, .no-touch input[type='reset']:focus, .touch input[type='reset']:focus, .no-touch input[type='submit']:focus, .touch input[type='submit']:focus, .no-touch button:active, .touch button:active, .no-touch html input[type='button']:active, .touch html input[type='button']:active, .no-touch input[type='reset']:active, .touch input[type='reset']:active, .no-touch input[type='submit']:active, .touch input[type='submit']:active, .no-touch input[type='text']:focus, .touch input[type='text']:focus, .no-touch input[type='email']:focus, .touch input[type='email']:focus, .no-touch input[type='password']:focus, .touch input[type='password']:focus, .no-touch input[type='search']:focus, .touch input[type='search']:focus, .no-touch input[type="tel"]:focus, .touch input[type="tel"]:focus, .no-touch input[type="url"]:focus, .touch input[type="url"]:focus, .no-touch textarea:focus, .touch textarea:focus {
			border-color: <?php echo get_theme_mod('accent_color'); ?>;
		}

		.no-touch a:active, .no-touch .main-navigation a:active, .search-entry:active, .search-entry:active .entry-title, .no-touch footer .date a:active, .no-touch .format-link .entry-title a:active, .no-touch .comment-metadata a:active, .no-touch .site-description a:active, .decode-reply-tool-plugin .replylink:active, .menu li.current_page_item > a:hover, .main-navigation li.current-menu-item > a:hover, .no-touch .decode-reply-tool-plugin .replylink:active {
			color: <?php echo get_theme_mod('secondary_accent_color'); ?>;
		}

		.no-touch .entry-content a:active, .no-touch .entry-meta a:active, .no-touch .theme-info a:active, .no-touch .site-description a:active {
			border-color: <?php echo get_theme_mod('secondary_accent_color'); ?>;
		}

		.tags, .categories, footer .date, footer .date a, .comment-metadata a {
			color: <?php echo get_theme_mod('secondary_text_color'); ?>;
		}
		
		<?php echo get_theme_mod('custom_css', ''); ?>
		
         </style>
    <?php
}
}
add_action( 'wp_head', 'decode_customize_css');

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
if ( ! function_exists( 'decode_print_post_title' ) ) {

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

	if ($pkey=='title_url' || $pkey=='url_title') {

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


	echo '<a href="'.$link.'" rel="bookmark" title="'.$title.'">'.$title.'</a>';

	}
}