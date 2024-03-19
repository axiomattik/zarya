<?php
/**
 * Zarya functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Zarya
 */

if ( ! defined( 'ZARYA_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'ZARYA_VERSION', '1.0.0' );
}

if ( ! function_exists( 'zarya_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function zarya_setup() {

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

		add_theme_support( 'menus' );
		register_nav_menus(
			array(
				'desktop-menu' => __( 'Desktop', 'zarya' ),
				'hamburger-menu' => __( 'Hamburger', 'zarya' ),
				'footer-left-menu' => __('Left Footer', 'zarya' ),
				'footer-middle-menu' => __('Middle Footer', 'zarya' ),
				'footer-right-menu' => __('Right Footer', 'zarya' ),
			)
		);



		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'zarya_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'zarya_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zarya_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zarya_content_width', 640 );
}
add_action( 'after_setup_theme', 'zarya_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zarya_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'zarya' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'zarya' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'zarya_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zarya_scripts() {
	wp_enqueue_style( 'zarya-style', get_stylesheet_uri(), array(), ZARYA_VERSION );
	wp_style_add_data( 'zarya-style', 'rtl', 'replace' );

	// TODO: use min
	wp_enqueue_script( 'zarya-script', get_template_directory_uri() . '/js/zarya.min.js', array(), ZARYA_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zarya_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/* Change 'add to cart' text */
function zarya_add_to_cart_text() {
	return __( 'Choose Options', 'zarya' );
}
//add_filter( 'woocommerce_product_single_add_to_cart_text', 'zarya_add_to_cart_text' );
//add_filter( 'woocommerce_product_add_to_cart_text', 'zarya_add_to_cart_text' );


/* Remove 'Add to Cart' button from shop page */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );


/* Make minimum quantity of product 1 */
function zarya_quantity_input_min() {
	return 1;
}
add_filter('woocommerce_quantity_input_min', 'zarya_quantity_input_min');



/* Request a WooCommerce notification via AJAX */
function zarya_wc_notice() {
	$message = $_POST["message"];
	$notice_type = $_POST["notice_type"];
	wc_add_notice($message, $notice_type);
	wc_print_notices();
	wp_die();
}
add_action( 'wp_ajax_nopriv_wc_notice', 'zarya_wc_notice' );



