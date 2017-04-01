<?php
/**
 * koffisani functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package koffisani
 */

if ( ! function_exists( 'koffisani_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function koffisani_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on koffisani, use a find and replace
	 * to change 'koffisani' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'koffisani', get_template_directory() . '/languages' );

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

	set_post_thumbnail_size( 700, 320, TRUE );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'koffisani' ),
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
	add_theme_support( 'custom-background', apply_filters( 'koffisani_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'koffisani_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function koffisani_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'koffisani_content_width', 640 );
}
add_action( 'after_setup_theme', 'koffisani_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function koffisani_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'koffisani' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'koffisani' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'koffisani_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function koffisani_scripts() {
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .  '/css/font-awesome.min.css' );

	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() .  '/css/bootstrap.min.css' );

	wp_enqueue_style( 'koffisani-style', get_stylesheet_uri() );


	wp_enqueue_script( 'jquery', get_template_directory_uri() .  '/js/jquery-1.10.2.min.js' );

	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() .  '/js/bootstrap.min.js' );


	wp_enqueue_script( 'smartmenus-script', get_template_directory_uri() .  '/js/jquery.smartmenus.min.js' );

	wp_enqueue_script( 'smartmenu-bootstrap-script', get_template_directory_uri() .  '/js/jquery.smartmenus.bootstrap.min.js' );

	//wp_enqueue_script( 'koffisani-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'koffisani-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'koffisani-main-js', get_template_directory_uri() . '/js/main.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'koffisani_scripts' );

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

add_filter( 'get_custom_logo', 'change_logo_class' );

function change_logo_class($html) {
	$html = str_replace('custom-logo', 'img-circle', $html);
	$html = str_replace('custom-logo-link', 'img-circle', $html);

	return $html;
}

/**
 * Embed Gists with a URL
 *
 * Usage:
 * Paste a gist link into a blog post or page and it will be embedded eg:
 * https://gist.github.com/2926827
 *
 * If a gist has multiple files you can select one using a url in the following format:
 * https://gist.github.com/2926827?file=embed-gist.php
 *
 * Updated this code on June 14, 2014 to work with new(er) Gist URLs
 */
 
	wp_embed_register_handler( 'gist', '/https?:\/\/gist\.github\.com\/([a-z0-9]+)(\?file=.*)?/i', 'bhww_embed_handler_gist' );

	function bhww_embed_handler_gist( $matches, $attr, $url, $rawattr ) {

		$embed = sprintf(
				'<script src="https://gist.github.com/%1$s.js%2$s"></script>',
				esc_attr($matches[1]),
				"" //esc_attr($matches[2])
				);

		return apply_filters( 'embed_gist', $embed, $matches, $attr, $url, $rawattr );
		
	}
    /**
     * 
     * @param type $contactmethods
     * @return string
     */    
            
        function my_new_contactmethods($contactmethods) {
            # Twitter
            $contactmethods['twitter'] = 'Twitter username';
            
            # Facebook
            $contactmethods['facebook'] = 'URL Facebook commençant par https';
            
            # Linkedin
            $contactmethods['linkedin'] = 'URL LinkedIn  commençant par https';
            
            # Skype
            $contactmethods['skype'] = 'Skype';
            
            $contactmethods['github'] = 'Identifiant Github';
            
            $contactmethods['gitlab'] = "Identifiant GitLab";
            
            $contactmethods['gplus'] = "URL Google Plus" ;
            
            return $contactmethods;
        }
        
        add_filter('user_contactmethods', 'my_new_contactmethods', 10, 1);
