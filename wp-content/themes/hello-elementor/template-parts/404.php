<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?= do_shortcode('[xyz-ihs snippet="header"]')?>
<main class="site-main" role="main">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center align-items-center">
                <h1 class="h3 mt-5">
                    Ops! página não encontrada
                </h1>
                <p class="text-center text-muted">Infelizmente não encontramos a página solicitada, tente retorar a <a href="/">Home</a>.</p>
                <img class="img-fluid" src="http://consors-desenvolvimento.otimaideia.com.br/wp-content/uploads/2020/09/fogg-page-not-found-1.png" alt="" srcset="" width="500">
            </div>
        </div>
    </div>

</main>
<?= do_shortcode('	[xyz-ihs snippet="footer"]')?>