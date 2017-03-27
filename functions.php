<?php
/**
 * angry_doc functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Angry Doc
 */

if ( ! function_exists( 'angry_doc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function angry_doc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on angry_doc, use a find and replace
	 * to change 'angry_doc' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'angry_doc', get_template_directory() . '/languages' );

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
        set_post_thumbnail_size( 828, 360, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'angry_doc' ),
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
	add_theme_support( 'custom-background', apply_filters( 'angry_doc_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}

/**
	 * Add editor styles
	 */
	add_editor_style( array( 'inc/editor-styles.css', 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Raleway|Quattrocento+Sans:400,700', '/font-awesome.min.css' ) );


endif;
add_action( 'after_setup_theme', 'angry_doc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function angry_doc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'angry_doc_content_width', 640 );
}
add_action( 'after_setup_theme', 'angry_doc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function angry_doc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area', 'angry_doc' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'angry_doc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'angry_doc_widgets_init' );


register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'angry_doc' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add footer here.', 'angry_doc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

/**

 * Enqueue scripts and styles.
 */
function angry_doc_scripts() {
    
    //Add google fonts
    
        wp_enqueue_style( 'angry_doc-googlefonts','https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Raleway|Quattrocento+Sans:400,700' );
       
        wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/font-awesome.min.css' );
	
        wp_enqueue_style( 'angry_doc-style', get_stylesheet_uri() );

	wp_enqueue_script( 'angry_doc-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'angry_doc-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
        
        wp_enqueue_script( 'jquery-2.1.1', get_template_directory_uri() . '/js/jquery-2.1.1.js', array ( 'jquery' ), 1.1, true);
        
        wp_enqueue_script( 'top', get_template_directory_uri() . '/js/top.js', array ( 'jquery' ), 1.1, true);
        
        wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array ( 'jquery' ), 1.1, true);
        
        wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array ( 'jquery' ), 1.1, true);
        
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'angry_doc_scripts' );

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
