<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.<?php comments_template(); 
}
?>

<?php
while ( have_posts() ) : the_post();
	?>
<?= do_shortcode('[xyz-ihs snippet="header"]')?>

<main <?php post_class( 'site-main' ); ?> role="main">
	<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
	<?php
		if ( function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb( '<p class="pt-5" id="breadcrumbs">','</p>' );
		}
	?>
		<header class="page-header">
			<?php the_title( '<h1 class="entry-title mt-2">', '</h1>' ); ?>
		</header>
	<?php endif; ?>
	<div class="page-content">
		<?php the_content(); ?>
		<div class="post-tags">
			<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'hello-elementor' ), null, '</span>' ); ?>
		</div>
		<?php wp_link_pages(); ?>
	</div>

	
</main>
<?= do_shortcode('	[xyz-ihs snippet="footer"]')?>

	<?php
endwhile;
