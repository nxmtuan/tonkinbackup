<?php

/**
 * kmar functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kmar
 */
$random_ver = rand( 1, 1000000000 );
if ( ! defined( '_S_VERSION' ) )
{
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', $random_ver );
}

if ( ! function_exists( 'kmar_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kmar_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on kmar, use a find and replace
		 * to change 'kmar' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kmar', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Menu Chính', 'kmar' ),
				'menu-2' => esc_html__( 'Menu Top', 'kmar' ),
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
				'height' => 250,
				'width' => 250,
				'flex-width' => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'kmar_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kmar_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kmar_content_width', 640 );
}
add_action( 'after_setup_theme', 'kmar_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kmar_widgets_init() {
	register_sidebar(
		array(
			'name' => esc_html__( 'Sidebar', 'kmar' ),
			'id' => 'sidebar-1',
			'description' => esc_html__( 'Add widgets here.', 'kmar' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'kmar_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kmar_scripts() {
	
	if ( is_404() )
	{
		wp_enqueue_style( 'kmar-404', get_template_directory_uri() . '/css/404.min.css', array(), _S_VERSION );
	}
	if ( class_exists( 'WooCommerce' ) )
	{
		wp_enqueue_style( 'kmar-woo', get_template_directory_uri() . '/css/woocommerce.min.css', array(), _S_VERSION );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	{
		wp_enqueue_script( 'comment-reply' );
	}
	if ( class_exists( 'WPCF7' ) )
	{
		wp_enqueue_style( 'kmar-alert', get_template_directory_uri() . '/assets/alert/css/cf7simplepopup-core.css', array(), _S_VERSION );
	}
	wp_enqueue_script( 'kmar-jquery', get_template_directory_uri() . '/assets/libs/jquery.min.js', array(), _S_VERSION, true );
	if ( class_exists( 'WPCF7' ) )
	{
		wp_enqueue_script( 'kmar-jquery_alert', get_template_directory_uri() . '/assets/alert/js/cf7simplepopup-core.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'kmar-jquery_alert_main', get_template_directory_uri() . '/assets/alert/js/sweetalert2.all.min.js', array(), _S_VERSION, true );
	}

	//css
	wp_enqueue_style( 'kmar-bootstrap', get_template_directory_uri() . '/assets/libs/bootstrap.min.css' );


	wp_enqueue_style( 'kmar-style-main', get_template_directory_uri() . '/assets/scss/style.css', array(), _S_VERSION );
	wp_enqueue_style( 'kmar-style-select2', get_template_directory_uri() . '/assets/libs/select2.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'kmar-slick', get_template_directory_uri() . '/assets/libs/slick.css' );
	wp_enqueue_style( 'kmar-ui', get_template_directory_uri() . '/assets/libs/jquery-ui.css' );
	wp_enqueue_style( 'kmar-style', get_stylesheet_uri(), array(), _S_VERSION );
	//js
	wp_enqueue_script( 'kmar-wow', get_template_directory_uri() . '/assets/libs/wow.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'kmar-js-bootstrap', get_template_directory_uri() . '/assets/libs/bootstrap.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'kmar-js-fancybox', get_template_directory_uri() . '/assets/libs/jquery.fancybox.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'kmar-js-ui', get_template_directory_uri() . '/assets/libs/jquery-ui.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'kmar-js-lazyload', get_template_directory_uri() . '/assets/libs/lazyload.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'kmar-js-moment', get_template_directory_uri() . '/assets/libs/moment.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'kmar-js-slick', get_template_directory_uri() . '/assets/libs/slick.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'kmar-js-iso', get_template_directory_uri() . '/assets/libs/isotope.pkgd.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'kmar-js-rellax', get_template_directory_uri() . '/assets/libs/rellax.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'kmar-js-ajax', get_template_directory_uri() . '/assets/js/ajax.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'kmar-js-main', get_template_directory_uri() . '/assets/js/index.js', array(), _S_VERSION, true );
	wp_localize_script( 'kmar-js-ajax', 'ajaxurl', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'security' => wp_create_nonce( 'common_nonce' ),
	) );

}
add_action( 'wp_enqueue_scripts', 'kmar_scripts' );


/**
 * Tonkin Heritage API Helper.
 */
require get_template_directory() . '/inc/api-helper.php';

if ( ! defined( 'TONKIN_ROUTES_PAGE_SLUG' ) ) {
	define( 'TONKIN_ROUTES_PAGE_SLUG', 'routes' );
}

if ( ! defined( 'TONKIN_ROUTE_DETAIL_PAGE_SLUG' ) ) {
	define( 'TONKIN_ROUTE_DETAIL_PAGE_SLUG', 'detail-route' );
}

/**
 * Build the pretty permalink for a route detail page.
 *
 * @param array $route Route payload from the API.
 * @return string
 */
function tonkin_get_route_permalink( $route ) {
	$route_id = isset( $route['id'] ) ? absint( $route['id'] ) : 0;
	if ( $route_id <= 0 ) {
		return home_url( user_trailingslashit( TONKIN_ROUTE_DETAIL_PAGE_SLUG ) );
	}

	$from_slug = ! empty( $route['from_station']['slug'] ) ? $route['from_station']['slug'] : '';
	$to_slug   = ! empty( $route['to_station']['slug'] ) ? $route['to_station']['slug'] : '';

	if ( empty( $from_slug ) ) {
		$from_name = $route['from_station']['name'] ?? ( $route['from_station']['short_name'] ?? '' );
		$from_slug = sanitize_title( $from_name );
	}

	if ( empty( $to_slug ) ) {
		$to_name = $route['to_station']['name'] ?? ( $route['to_station']['short_name'] ?? '' );
		$to_slug = sanitize_title( $to_name );
	}

	if ( empty( $from_slug ) || empty( $to_slug ) ) {
		return add_query_arg(
			array(
				'route_id' => $route_id,
			),
			home_url( user_trailingslashit( TONKIN_ROUTE_DETAIL_PAGE_SLUG ) )
		);
	}

	return home_url(
		user_trailingslashit(
			TONKIN_ROUTES_PAGE_SLUG . '/' . $from_slug . '-to-' . $to_slug . '-' . $route_id
		)
	);
}

/**
 * Register rewrite rule for route detail pretty URLs.
 */
function tonkin_register_route_rewrite_rules() {
	add_rewrite_rule(
		'^' . TONKIN_ROUTES_PAGE_SLUG . '/([a-z0-9-]+)-to-([a-z0-9-]+)-([0-9]+)/?$',
		'index.php?pagename=' . TONKIN_ROUTE_DETAIL_PAGE_SLUG . '&tonkin_route_id=$matches[3]',
		'top'
	);
}
add_action( 'init', 'tonkin_register_route_rewrite_rules' );

/**
 * Allow custom query vars for route detail URLs.
 *
 * @param array $vars Query vars.
 * @return array
 */
function tonkin_register_route_query_vars( $vars ) {
	$vars[] = 'tonkin_route_id';
	return $vars;
}
add_filter( 'query_vars', 'tonkin_register_route_query_vars' );

/**
 * Flush route rewrite rules once after this feature is introduced.
 */
function tonkin_maybe_flush_route_rewrite_rules() {
	$rewrite_version = '1';

	if ( get_option( 'tonkin_route_rewrite_version' ) === $rewrite_version ) {
		return;
	}

	tonkin_register_route_rewrite_rules();
	flush_rewrite_rules( false );
	update_option( 'tonkin_route_rewrite_version', $rewrite_version );
}
add_action( 'init', 'tonkin_maybe_flush_route_rewrite_rules', 20 );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer Wordpress.
 */
require get_template_directory() . '/inc/customizer-wp.php';

/**
 * Customizer Widget.
 */
require get_template_directory() . '/inc/customizer-widget.php';


if ( class_exists( 'WooCommerce' ) )
{
	/**
	 * Customizer Woocommerce.
	 */
	require get_template_directory() . '/inc/customizer-woo.php';
}


function load_room_posts() {
	if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'common_nonce')) {
        wp_send_json_error(['message' => 'Lỗi bảo mật!'], 403);
        wp_die();
    }
	$paged = isset( $_POST['paged'] ) ? intval( $_POST['paged'] ) : 1;
	$posts_per_page = 1;
	$post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'room';
	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => $posts_per_page,
		'paged' => $paged,
		'post_status' => 'publish',
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			$terms = get_the_terms( get_the_ID(), 'cat_room' );
			$categories_class = 'all-items default';
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) )
			{
				foreach ( $terms as $term )
				{
					$categories_class .= ' filter_' . esc_attr( $term->term_id );
				}
			}
			?>
			<div class="single-child-wrap <?php echo $categories_class; ?>">
			<?php get_template_part('template-parts/content',get_post_type())  ?>
			</div>
		<?php endwhile;
	
	endif;
	wp_reset_postdata();
	wp_die();
}

add_action( 'wp_ajax_load_rooms', 'load_room_posts' );
add_action( 'wp_ajax_nopriv_load_rooms', 'load_room_posts' );
