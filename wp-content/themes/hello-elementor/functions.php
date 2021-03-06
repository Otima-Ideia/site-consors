<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '2.2.0' );

function my_login_logo() { ?>
<style type="text/css">
	#login h1 a, .login h1 a {
		background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-otimaideia.png);
		background-size: auto;
		width: auto;
		height: 70px;
	}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_load_textdomain', [ true ], '2.0', 'hello_elementor_load_textdomain' );
		if ( apply_filters( 'hello_elementor_load_textdomain', $hook_result ) ) {
			load_theme_textdomain( 'hello-elementor', get_template_directory() . '/languages' );
		}

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_menus', [ true ], '2.0', 'hello_elementor_register_menus' );
		if ( apply_filters( 'hello_elementor_register_menus', $hook_result ) ) {
			register_nav_menus( array( 'menu-1' => __( 'Primary', 'hello-elementor' ) ) );
		}

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_theme_support', [ true ], '2.0', 'hello_elementor_add_theme_support' );
		if ( apply_filters( 'hello_elementor_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			);
			add_theme_support(
				'custom-logo',
				array(
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				)
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'editor-style.css' );

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_woocommerce_support', [ true ], '2.0', 'hello_elementor_add_woocommerce_support' );
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_elementor_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'elementor_hello_theme_enqueue_style', [ true ], '2.0', 'hello_elementor_enqueue_style' );
		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_elementor_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'hello-elementor',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_elementor_locations', [ true ], '2.0', 'hello_elementor_register_elementor_locations' );
		if ( apply_filters( 'hello_elementor_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
	function hello_elementor_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}
function wp_get_menu_array($current_menu) {

	$array_menu = wp_get_nav_menu_items($current_menu);
	$menu = array();
	foreach ($array_menu as $m) {
		if (empty($m->menu_item_parent)) {
			$menu[$m->ID] = array();
			$menu[$m->ID]['ID']      =   $m->ID;
			$menu[$m->ID]['title']       =   $m->title;
			$menu[$m->ID]['url']         =   $m->url;
			$menu[$m->ID]['children']    =   array();
		}
	}
	$submenu = array();
	foreach ($array_menu as $m) {
		if ($m->menu_item_parent) {
			$submenu[$m->ID] = array();
			$submenu[$m->ID]['ID']       =   $m->ID;
			$submenu[$m->ID]['title']    =   $m->title;
			$submenu[$m->ID]['url']  =   $m->url;
			$menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
		}
	}
	return $menu;
}

function simpletheme_script(){
	/*wp_enqueue_style("bs_css", "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");*/
	wp_enqueue_script("bs_js", "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js");
	/*wp_enqueue_script("jQuery", "https://code.jquery.com/jquery-3.5.1.slim.min.js");*/
	wp_enqueue_script("jQuery", get_stylesheet_directory_uri() . '/assets/js/jquery-3.5.1.min.js');
	wp_enqueue_script("jquery_countTo", get_stylesheet_directory_uri() . '/assets/js/jquery.countTo.js', array( 'jquery' ));
	wp_enqueue_script("maskedInput", "https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js");
	/*wp_enqueue_style("Font-Awesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css");*/
		wp_enqueue_style("bootstrap", "https://www.consors.com.br/wp-content/themes/hello-elementor/assets/css/bootstrap.min.css");
// 	wp_enqueue_style("pureCss", "https://www.consors.com.br/wp-content/themes/hello-elementor/assets/css/styles.pure.css");
	/*wp_enqueue_style("Style", "https://www.consors.com.br/wp-content/themes/hello-elementor/assets/css/style.css");*/

}
add_action("wp_enqueue_scripts","simpletheme_script");
function wpdocs_get_paginated_links( $query ) {
	// When we're on page 1, 'paged' is 0, but we're counting from 1,
	// so we're using max() to get 1 instead of 0
	$currentPage = max( 1, get_query_var( 'paged', 1 ) );

	// This creates an array with all available page numbers, if there
	// is only *one* page, max_num_pages will return 0, so here we also
	// use the max() function to make sure we'll always get 1
	$pages = range( 1, max( 1, $query->max_num_pages ) );

	// Now, map over $pages and return the page number, the url to that
	// page and a boolean indicating whether that number is the current page
	return array_map( function( $page ) use ( $currentPage ) {
		return ( object ) array(
			"isCurrent" => $page == $currentPage,
			"page" => $page,
			"url" => get_pagenum_link( $page )
		);
	}, $pages );
}
add_action("wp_enqueue_scripts","wpdocs_get_paginated_links");

function theme_xyz_header_metadata() {

    // Post object if needed
    // global $post;

    // Page conditional if needed
    // if( is_page() ){}

  ?>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Quer vender seu consórcio? Nós da Consors compramos consórcios em andamento, sem intermediários. Temos a Melhor avaliação com Pagamento imediato">
	<link rel="canonical" href="https://www.consors.com.br/">
	<meta name="robots" content="all, index, follow">
	<meta name="Googlebot" content="index,follow, all">
	<meta name="MSNbot" content="index,follow, all">
	<meta name="InktomiSlurp" content="index,follow, all">
	<meta name="Unknownrobot" content="index,follow, all">
	<meta name="rating" content="General">
	<meta name="audience" content="all">
	<meta name="og:region" content="São Paulo, SP/Brasil">
	<meta name="geo.position" content="-23.5645925;-46.6471141">
	<meta name="ICBM" content="-23.5645925;-46.6471141">
	<meta name="geo.placename" content="São Paulo-SP">
	<meta name="geo.region" content="SP-BR">
	<meta name="distribution" content="global">
	<meta name="copyright" content="Compra e Venda de Consórcios">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="ConsorsOficial">
	<meta name="twitter:title" content="Consors - Compra e Venda de Consórcios - Consors">
	<meta name="twitter:description" content="Quer vender seu consórcio? Nós da Consors compramos consórcios em andamento, sem intermediários. Temos a Melhor avaliação com Pagamento imediato">
	<meta name="twitter:url" content="https://www.consors.com.br/">
	<meta name="twitter:creator" content="ConsorsOficial">
	<meta name="twitter:image" content="https://www.consors.com.br/images/consors.jpg">
	<meta property="fb:admins" content="1912255549015756">
	<meta property="og:url" content="https://consors.com.br/">
	<meta property="og:type" content="website">
	<meta property="og:title" content="Consors - Compra e Venda de Consórcios - Consors">
	<meta property="og:image" content="https://www.consors.com.br/images/consors.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="520">
	<meta property="og:image:height" content="272">
	<meta property="og:image:alt" content="Consors - Compra e Venda de Consórcios">
	<meta property="og:description" content="Quer vender seu consórcio? Nós da Consors compramos consórcios em andamento, sem intermediários. Temos a Melhor avaliação com Pagamento imediato">
	<meta property="og:site_name" content="Consors - Compra e Venda de Consórcios - Consors">
	<meta property="business:contact_data:street_address" content="R. Pirapitingui, 80 - Sala 108">
	<meta property="business:contact_data:locality" content="SP">
	<meta property="business:contact_data:region" content="São Paulo">
	<meta property="geo.position" content="-23.5645925, -46.6471141">
	<meta property="geo.region" content="São Paulo, SP">
	<meta property="ICBM" content="-23.5645925, -46.6471141">
	<meta property="business:contact_data:postal_code" content="01508-020">
	<meta property="business:contact_data:country_name" content="Brasil">
	<meta property="og:locale" content="pt_BR" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Consors - Compra e Venda de Consórcios" />
	<meta property="og:description" content="Compra e Venda de Consórcios" />
	<meta property="og:url" content="https://www.consors.com.br/" />
	<meta property="og:site_name" content="Consors" />
	<meta name="twitter:card" content="summary_large_image" />
	<!--<link rel="icon" href="https://www.consors.com.br/antigo/wp-content/uploads/2020/04/cropped-favicon-32x32.png" sizes="32x32" />
	<link rel="icon" href="https://www.consors.com.br/antigo/wp-content/uploads/2020/04/cropped-favicon-192x192.png" sizes="192x192" />
	<link rel="apple-touch-icon" href="https://www.consors.com.br/antigo/wp-content/uploads/2020/04/cropped-favicon-180x180.png" />
	<meta name="msapplication-TileImage" content="https://www.consors.com.br/antigo/wp-content/uploads/2020/04/cropped-favicon-270x270.png" />-->
	<link rel="stylesheet" id="Style-css" href="https://www.consors.com.br/wp-content/themes/hello-elementor/assets/css/style.css" type="text/css" media="all">

  <?php

}
add_action( 'wp_head', 'theme_xyz_header_metadata' );

add_filter( 'wpseo_breadcrumb_links', 'my_custom_breadcrumb_links' );
function my_custom_breadcrumb_links( $links ) {

	$breadcrumbs[] = array(
		'url' => home_url('/blog-do-consorcio'),
		'text' => 'Blog do Consórcio',
	);

	array_splice( $links, 0, 0, $breadcrumbs ); //Prepend array to begin

	return $links;
}