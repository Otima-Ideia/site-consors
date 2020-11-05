<?php
/**
* WordPress template: Functions
*/

function theme_setup(){
	add_theme_support('title-tag');
		

	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	//REGISTRO DE CSS
	function theme_css(){
		wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap/bootstrap.css', '', false, 'screen');
		wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', '', false, 'screen');
		wp_enqueue_style('font-stroke', get_stylesheet_directory_uri() . '/fonts/stroke-gap/style.css', '', false, 'screen');
		wp_enqueue_style('layers', get_stylesheet_directory_uri() . '/revolution-slider/layers.css', '', false, 'screen');
		wp_enqueue_style('navigation', get_stylesheet_directory_uri() . '/revolution-slider/navigation.css', '', false, 'screen');
		wp_enqueue_style('settings', get_stylesheet_directory_uri() . '/revolution-slider/settings.css', '', false, 'screen');
		wp_enqueue_style('fancybox', get_stylesheet_directory_uri() . '/jquery.fancybox.css', '', false, 'screen');
		wp_enqueue_style('hover', get_stylesheet_directory_uri() . '/hover.css', '', false, 'screen');
		wp_enqueue_style('bxslider', get_stylesheet_directory_uri() . '/jquery.bxslider.css', '', false, 'screen');
		wp_enqueue_style('gradient', get_stylesheet_directory_uri() . '/gradient.css', '', false, 'screen');
		wp_enqueue_style('scrollbar', get_stylesheet_directory_uri() . '/jquery.mCustomScrollbar.min.css', '', false, 'screen');
		wp_enqueue_style('owl.carousel', get_stylesheet_directory_uri() . '/css/owl.carousel.css', '', false, 'screen');
		wp_enqueue_style('owl.theme', get_stylesheet_directory_uri() . '/css/owl.theme.css', '', false, 'screen');
        wp_enqueue_style('style', get_stylesheet_directory_uri() . '/css/custom/style.css', '', rand(111,9999), 'screen');
        wp_enqueue_style('responsive', get_stylesheet_directory_uri() . '/css/responsive/responsive.css', '', false, 'screen');
    }
	add_action('wp_enqueue_scripts', 'theme_css');

	//REGISTRO DE JS
	function theme_scripts(){
		// Desregistra o jQuery do Wordpress
	 wp_deregister_script('jquery');





		wp_enqueue_script('jquery', get_stylesheet_directory_uri() . '/js/jquery-2.1.4.js', array(), null, true);

		wp_enqueue_script('jquery.mCustomScrollbar', get_stylesheet_directory_uri() . '/js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), null, true);
	
		wp_enqueue_script('jquery.bxslider', get_stylesheet_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), null, true);
		
			wp_enqueue_script('jquery.themepunch.revolution', get_stylesheet_directory_uri() . '/js/revolution-slider/jquery.themepunch.revolution.min.js', array('jquery'), null, true);
			
			
			wp_enqueue_script('jquery.themepunch.tools.min', get_stylesheet_directory_uri() . '/js/revolution-slider/jquery.themepunch.tools.min.js', array('jquery'), null, true);
			
				wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true);
				
		wp_enqueue_script('jquery.appear', get_stylesheet_directory_uri() . '/js/jquery.appear.js', array('jquery'), null, true);
					
		wp_enqueue_script('jquery.countTo', get_stylesheet_directory_uri() . '/js/jquery.countTo.js', array('jquery'), null, true);
		
				wp_enqueue_script('jquery.fancybox.pack', get_stylesheet_directory_uri() . '/js/jquery.fancybox.pack.js', array('jquery'), null, true);
				
				wp_enqueue_script('owl.carousel', get_stylesheet_directory_uri() . '/js/owl.carousel.js', array('jquery'), null, true);
				
			wp_enqueue_script('owl-custom', get_stylesheet_directory_uri() . '/js/owl-custom.js', array('jquery'), null, true);
			
					wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), null, true);
					
					
					
								wp_enqueue_script('mixitup', get_stylesheet_directory_uri() . '/js/jquery.mixitup.min.js', array('jquery'), null, true);
				
								wp_enqueue_script('mixitup', get_stylesheet_directory_uri() . '/validacao.js', array('jquery'), null, true);


	}
	add_action('wp_enqueue_scripts', 'theme_scripts');

//CARREGAR SCRIPT PARA DETERMINADA PAGINA
function loadScriptsTemplate(){
	
	if (is_single()){
		// wp_enqueue_script('zoom', get_stylesheet_directory_uri() . '/js/vendors/jquery.mlens-1.7.min.js', array('jquery'), null, true);
	}
}
add_action('wp_enqueue_scripts','loadScriptsTemplate');
	// REMOVER ITENS DO HEADER EM wp_head();
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

	// REMOVE WP EMOJI
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	// REGISTRO DE IMAGENS
	add_theme_support('post-thumbnails');
	add_image_size('slider',780,329,true);
	add_image_size('item',200,200,true);
	add_image_size('post review',350,190,true);



	// REGISTRO DE MENUS
	add_theme_support('nav-menus');
	function theme_menus(){
		register_nav_menus(array(
			'header-menu' => 'Menu Principal',
			'footer-menu' => 'Footer'

		));
	}
	add_action('init', 'theme_menus');
}
add_action('after_setup_theme', 'theme_setup');
// REMOVER PADRÃO DE COLOCAR LINKS NAS IMAGENS
update_option('image_default_link_type','none');

// Busca por um template single com nome concatenado a uma categoria
// (single-[cat slug].php)
add_filter('single_template', create_function(
    '$the_template',
    'foreach( (array) get_the_category() as $cat ) {
    if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
        return TEMPLATEPATH . "/single-{$cat->slug}.php";
    }
    return $the_template;'
));


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return ' <strong>leia mais...</strong>';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

//ADD CLASS ACTIVE
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

// add the ajax fetch js
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
<script type="text/javascript">
function fetch(e){
	jQuery('.loading').css('display','block');
	jQuery('.reset-div').remove();
    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch', keyword: e.attr('id') },
        success: function(data) {			
			jQuery('#datafetch').html( data );
			jQuery('.loading').css('display','none');
        }
    });

}

</script>

<?php
}

// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

	$the_query = new WP_Query( array( 'posts_per_page' => -1,'p' => esc_attr( $_POST['keyword'] ),
	'post_type' => 'produtos_items' ) );
    if( $the_query->have_posts() ) :
		while( $the_query->have_posts() ): $the_query->the_post(); ?>
	


        
        <div class="col-md-5 reset-div" style="background-color:#208e71;;">
            <figure>
			<?php echo get_the_post_thumbnail(); ?>
            </figure>
        </div>
        <div class="col-md-7 reset-div" style="    padding: 22px  15px 22px 60px;">
		<h3><?php  the_title();?></h3>
		 <?php  the_content(); ?>
            </div>


	


        <?php endwhile;
        wp_reset_postdata();  
    endif;

    die();
}


function mytheme_widgets_init() {
    register_sidebar( array (
        'name' => __( 'Sidebar', 'your-text-domain' ),
        'id' => 'sidebar-1',
        'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'your-text-domain' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
	));
	// Add footer widget area


register_sidebar( array(
	
	'name' => 'Footer Sidebar 1',
	'id' => 'footer-sidebar-1',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
	register_sidebar( array(
	'name' => 'Footer Sidebar 2',
	'id' => 'footer-sidebar-2',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
	register_sidebar( array(
	'name' => 'Footer Sidebar 3',
	'id' => 'footer-sidebar-3',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer Sidebar 4',
		'id' => 'footer-sidebar-4',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
	register_sidebar( array(
		'name' => 'Header Social Icons',
		'id' => 'header-social',
		'before_widget' => '<div id="header-social">',
		'after_widget' => '</div>',
		) );

}
add_action( 'widgets_init', 'mytheme_widgets_init' );

// Shortcode Templates

function template_services( $attr ){
	ob_start();
	get_template_part('template-parts/services');
	return ob_get_clean();
}

add_shortcode( 'services', 'template_services');


function template_planos( $attr ){
	ob_start();
	get_template_part('template-parts/planos');
	return ob_get_clean();
}

add_shortcode( 'planos', 'template_planos');



//URL do logo da tela de login
 function chr_logo_url() {
 return get_bloginfo( 'url' );
 }
 add_filter( 'login_headerurl', 'chr_logo_url' );

//Title do logo da tela de login
 function chr_logo_title() {
 return get_bloginfo( 'name' );
 }
 add_filter( 'login_headertext', 'chr_logo_title' );

 //Alterar o logo tela de login
function chr_style_personalizado() { ?>
    <style>
    body.login div#login h1 a {
   background-image: url('https://www.saudeecompanhia.com.br/wp-content/uploads/2020/04/logo.png');
   background-size: auto;
   width: auto;
   height: 70px;
}
body.login #wp-submit{
/*     background: #41387c; */
    }
    </style>
    <?php }
    add_action( 'login_enqueue_scripts', 'chr_style_personalizado' );


// pagination
function wordpress_pagination() {
 global $wp_query;
 
 $big = 999999999;
 
 echo paginate_links( array(
 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
 'format' => '?paged=%#%',
 'current' => max( 1, get_query_var('paged') ),
 'total' => $wp_query->max_num_pages
 ) );
 }
 