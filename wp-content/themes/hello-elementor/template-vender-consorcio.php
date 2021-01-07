<?php // Template name: Vender Consórcio ?>
<?php get_header();?>

<style>
    @media screen and (min-width: 768px){
        .inner-form {
            position: -webkit-sticky;
            position: sticky;
            top: 2rem;
        }
    }
</style>

<?= do_shortcode('[xyz-ihs snippet="header"]') ?>

<div class="container">
    <h2 class="my-4 text-center"><?php the_title(); ?></h2>
    <div class="row">
        <div class="col-md-8">
            <?php the_content(); ?>
        </div>
        <div class="col-md-4">
            <div class="inner-form">
                <h3 class="h5">Ficou alguma dúvida? <strong>Entre em contato conosco agora mesmo</strong></h3>
                <?= do_shortcode('[contact-form-7 id="2294" title="Vender Consórcio"]') ?>
            </div>
        </div>
    </div>
</div>

<?= do_shortcode('[xyz-ihs snippet="footer"]') ?>
