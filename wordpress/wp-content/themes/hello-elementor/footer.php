<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	get_template_part( 'template-parts/footer' );
}
?>

<?php wp_footer(); ?>
<div class="whats">
    <div class="whats__form">
        <div class="whats__name clearfix">

            <span style="margin:0 10px;">Forest Paper</span>
            <div>X</div>
        </div>
        <div class="whats__msgs">
            <div class="whats__msg m1">
                Olá<span>14:24</span>
            </div>
            <div class="whats__msg m2">
                Quer saber mais informações sobre a Forest Paper?<span>14:24</span>
            </div>
            <div class="whats__msg m3">
                Entre em contato via whatsapp<span>14:24</span>
            </div>
        </div>
        <?php echo do_shortcode('[contact-form-7 id="799" title="whatsapp"]');?>
    </div>
    <div class="whats__btn">
        <img title="WhatsApp" alt="WhatsApp " class="wt"
            src="http://localhost/wordpress/wp-content/uploads/2020/09/whatsapp-agencia-boa-ideia.png">
        <span style="display: none;">1</span>
    </div>
</div>

</body>
</html>
