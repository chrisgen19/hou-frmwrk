<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = get_template_directory() . '/functions/';
$includes_path = get_template_directory() . '/includes/';

// Don't load alt stylesheet from WooFramework
if ( ! function_exists( 'woo_output_alt_stylesheet' ) ) {
	function woo_output_alt_stylesheet () {}
}

// Define the theme-specific key to be sent to PressTrends.
define( 'WOO_PRESSTRENDS_THEMEKEY', '2qshot1k9kdwknih8cnfz389fnhuttxbb' );

// WooFramework
require_once ( $functions_path . 'admin-init.php' );			// Framework Init

if ( get_option( 'woo_woo_tumblog_switch' ) == 'true' ) {
	//Enable Tumblog Functionality and theme is upgraded
	update_option( 'woo_needs_tumblog_upgrade', 'false' );
	update_option( 'tumblog_woo_tumblog_upgraded', 'true' );
	update_option( 'tumblog_woo_tumblog_upgraded_posts_done', 'true' );
	require_once ( $functions_path . 'admin-tumblog-quickpress.php' );	// Tumblog Dashboard Functionality
}

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 			// Options panel settings and custom settings
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks
				'includes/theme-comments.php', 			// Custom comments/pingback loop
				'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php'			// Theme widgets
				);

// Theme-Specific
$includes[] = 'includes/theme-advanced.php';			// Advanced Theme Functions
$includes[] = 'includes/theme-shortcodes.php';	 		// Custom theme shortcodes
// Modules
//$includes[] = 'includes/woo-layout/woo-layout.php'; // WOO LAYOUT OFF - chrisgen off
$includes[] = 'includes/woo-meta/woo-meta.php';
$includes[] = 'includes/woo-hooks/woo-hooks.php';

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );
			
foreach ( $includes as $i ) {
	locate_template( $i, true );
}

// Load WooCommerce functions, if applicable.
if ( is_woocommerce_activated() ) {
	locate_template( 'includes/theme-woocommerce.php', true );
}

/**
 * Hourizon functions and definitions
 *
 * @package Hourizon
 * @since Hourizon 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Hourizon 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'hourizon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Hourizon 1.0
 */
function hourizon_setup() {

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
	 * If you're building a theme based on Hourizon, use a find and replace
	 * to change 'hourizon' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'hourizon', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // hourizon_setup
add_action( 'after_setup_theme', 'hourizon_setup' );

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
function hourizon_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'hourizon_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'hourizon_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Hourizon 1.0
 */
function hourizon_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'hourizon' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'hourizon_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function hourizon_scripts() {

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'hourizon_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );


// Show Home link for Nav menu
add_filter( 'wp_nav_menu_items', 'add_home_link', 10, 2 );
function add_home_link($items, $args) {
  
        if (is_front_page())
            $class = 'class="current_page_item"';
        else
            $class = '';
  
        $homeMenuItem =
                '<li ' . $class . '>' .
                $args->before .
                '<a href="' . home_url( '/' ) . '" title="Home">' .
                $args->link_before . 'Home' . $args->link_after .
                '</a>' .
                $args->after .
                '</li>';
  
        $items = $homeMenuItem . $items;
  
    return $items;
}

// Custom Admin Logo
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_url').'/images/logo.png) !important; }
    </style>';
}
add_action('login_head', 'my_custom_login_logo');

function my_custom_login_url() {
  return site_url();
}
add_filter( 'login_headerurl', 'my_custom_login_url', 10, 4 );

// Remove the Default woothemes_wp_head
//remove_action( 'wp_head',  'woothemes_wp_head'  );


/*-----------------------------------------------------------------------------------*/
/* Featured Slider: Get Slides */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woo_featured_slider_get_slides' ) ) {
function woo_featured_slider_get_slides ( $args ) {
	$defaults = array( 'limit' => '5', 'order' => 'DESC', 'term' => '0' );
	$args = wp_parse_args( (array)$args, $defaults );
	$query_args = array( 'post_type' => 'slide' );
	if ( in_array( strtoupper( $args['order'] ), array( 'ASC', 'DESC' ) ) ) {
		$query_args['order'] = strtoupper( $args['order'] );
	}
	if ( 0 < intval( $args['limit'] ) ) {
		$query_args['numberposts'] = intval( $args['limit'] );
	}
	if ( 0 < intval( $args['term'] ) ) {
		$query_args['tax_query'] = array(
										array( 'taxonomy' => 'slide-page', 'field' => 'id', 'terms' => intval( $args['term']) )
									);
	}

	$slides = false;

	$query = get_posts( $query_args );

	if ( ! is_wp_error( $query ) && ( 0 < count( $query ) ) ) {
		$slides = $query;
	}

	return $slides;
} // End woo_featured_slider_get_slides()
}

