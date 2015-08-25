<?php

/**
* Theme Functions
*/

if ( ! function_exists( 'poynter_setup' ) ) :

/**
* Set up theme defaults and registers support for various WordPress features.
*/

function poynter_setup() {

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
	 * See: https://codex.wordpress.org/Function_Reference/add_jean_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	
	/*
	* Enable support for custom menus.
	*/

	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'poynter' ),
		'secondary'  => __( 'Secondary Menu', 'poynter' ),
	) );


	/** Register support for Post Formats.
	*/

	function add_post_formats() {
    add_theme_support( 'post-formats', array( 'quote', 'video', 'aside', 'image' ) );
	}
 
	add_action( 'after_setup_theme', 'add_post_formats', 20 );


	/*
	* Register Widget Areas.
	*/

	function poynter_widgets_init() {
 
	register_sidebar( array(
		'name' => 'Footer Widgets 1',
		'id' => 'footer_widgets_1',
		'before_widget' => '<div class="footer-widget-area">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );

		register_sidebar( array(
		'name' => 'Footer Widgets 2',
		'id' => 'footer_widgets_2',
		'before_widget' => '<div class="footer-widget-area">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );

	}
	add_action( 'widgets_init', 'poynter_widgets_init' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	* Remove Emoji script from header
	*/
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	/*
	* Remove assorted useless junk from header
	*/
	remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_generator'); // remove wordpress version
    remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
    remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
    remove_action('wp_head', 'index_rel_link'); // remove link to index page
    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
    remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

}

endif; // jean_setup
add_action( 'after_setup_theme', 'poynter_setup' );	

/**
* Use Google's JQuery CDN
*/

function poynter_jquery_init() {
	if (!is_admin()) {
		wp_deregister_script('jquery');

		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.11.3', true);

		wp_enqueue_script('jquery');
	}
}

add_action('init', 'poynter_jquery_init');

/**
* Set up Styles and Scripts
*/

function poynter_scripts() {

	/**
	* Enqueue Styles
	**/

	// Load our main stylesheet.
	wp_enqueue_style( 'poynter-style', get_stylesheet_directory_uri() . '/css/style.css' );

	// Load the Fontawesome stylesheet.
	wp_enqueue_style('poynter-fontawesome-style', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

	/**
	* Enqueue Scripts
	**/

	// Load Modernizr js.
	wp_enqueue_script( 'poynter-modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array('jquery'), false, true );

	// Load MouseWheel js.
	wp_enqueue_script( 'poynter-mousewheel-script', get_template_directory_uri() . '/js/vendor/mousewheel.min.js', array('jquery'), false, true );

	// Load Theme specific js.
	wp_enqueue_script( 'poynter-main-script', get_template_directory_uri() . '/js/main.js', array('jquery'), false, true );

}

add_action( 'wp_enqueue_scripts', 'poynter_scripts' );

/**
* Hide the Admin Bar
*/

add_filter('show_admin_bar', '__return_false');

// Add social link to menu

add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'primary' )
    	return $items."<a href='http://twitter.com/tompoynter__' class='social-item'><i class='fa fa-twitter'></i></a>";

    return $items;
}

// Add the homepage to menu options

function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );
