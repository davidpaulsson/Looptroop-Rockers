<?php
/**
 * looptroop-rockers-v4 functions and definitions
 *
 * @package looptroop-rockers-v4
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 576; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'ltr_v4_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function ltr_v4_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on looptroop-rockers-v4, use a find and replace
	 * to change 'ltr_v4' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ltr_v4', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Add image sizes
	 */	
	add_image_size( 'post-type-image', 576, 100000 ); // 576 pixels wide by too many pixels tall to prevent croping from the sides
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ltr_v4' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'image', 'video', 'link' ) );
}
endif; // ltr_v4_setup
add_action( 'after_setup_theme', 'ltr_v4_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function ltr_v4_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'ltr_v4_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'ltr_v4_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function ltr_v4_widgets_init() {
	register_sidebars(3, array(
		'name'          => __( 'Sidebar %d', 'ltr_v4' ),
		'id'            => 'sidebar-%d',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'ltr_v4_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function ltr_v4_scripts() {
	wp_enqueue_style( 'looptroop-rockers-v4-style', get_template_directory_uri() . '/css/screen.css' );

	wp_enqueue_script( 'looptroop-rockers-v4-scripts', get_template_directory_uri() . '/js/scripts.min.js', array(), '20120206', true );
	wp_enqueue_script( 'looptroop-rockers-v4-init', get_template_directory_uri() . '/js/ltr.min.js', array('jquery'), '20130115', true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'looptroop-rockers-v4-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'ltr_v4_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * WordPress doesn't recognize Vimeo URLs without www.
 * Let's fix that.
 */
function ltr_v4_add_vimeo_oembed_correctly() {
    wp_oembed_add_provider( '#http://(www\.)?vimeo\.com/.*#i', 'http://vimeo.com/api/oembed.{format}', true );
}
add_action('init', 'ltr_v4_add_vimeo_oembed_correctly');