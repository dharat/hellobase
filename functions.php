<?php
/**
 * HelloBase functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package HelloBase
 */

if ( ! function_exists( 'hellobase_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hellobase_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on HelloBase, use a find and replace
	 * to change 'hellobase' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'hellobase', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'hellobase' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hellobase_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'hellobase_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hellobase_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hellobase_content_width', 640 );
}
add_action( 'after_setup_theme', 'hellobase_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hellobase_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hellobase' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hellobase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'hellobase' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'hellobase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'hellobase' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'hellobase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'hellobase' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'hellobase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'hellobase' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'hellobase' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hellobase_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hellobase_scripts() {

    /*
     *  Always make sure that you use default JS register with WordPress core before adding new JS from external source.
     *  @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
     */

    wp_enqueue_style( 'hellobase-general', get_template_directory_uri().'/css/general.css' );

    # Main Style CSS file
    wp_enqueue_style( 'hellobase-style', get_stylesheet_uri() );

    # Removed Unneccesary JS files
    wp_deregister_script('admin-bar');

    # Removed and added Default Emoji again to call it in footer
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );

     # Owl Carousel Script Added, If not required, you can remove this
    wp_enqueue_script( 'hellobase-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '2.0', true );

    # Create base.js to include general scripts as much possible without conflict
	wp_enqueue_script( 'hellobase-base', get_template_directory_uri() . '/js/base.js', array(), '1.0', true );

    # If website doesnt have commenting functionality then we can remove this.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'hellobase_scripts' );

# Disable Admin Bar for all users
add_filter('show_admin_bar', '__return_false');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load TGMPA Activation compatibility file.
 */
require get_template_directory() . '/tgmpa/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/tgmpa-activation.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load CPT compatibility file.
 */
require get_template_directory() . '/classes/cpt.php';

/**
 * Load Shortcodes compatibility file.
 */
require get_template_directory() . '/classes/shortcodes.php';

/**
 * Load Contact Form 7 compatibility file.
 */
require get_template_directory() . '/classes/cf7.php';


