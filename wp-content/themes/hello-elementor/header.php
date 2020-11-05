<?php

/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php $viewport_content = apply_filters('hello_elementor_viewport_content', 'width=device-width, initial-scale=1'); ?>
    <meta name="viewport" content="<?php echo esc_attr($viewport_content); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-eval' https://www.google-analytics.com 'unsafe-inline'; object-src 'self'" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Quer vender seu consórcio? Nós da Consors compramos consórcios em andamento, sem intermediários. Temos a Melhor avaliação com Pagamento imediato" />
    <link rel="canonical" href="https://consors.com.br/" />
    <meta name="robots" content="all, index, follow">
    <meta name="Googlebot" content="index,follow, all">
    <meta name="MSNbot" content="index,follow, all">
    <meta name="InktomiSlurp" content="index,follow, all">
    <meta name="Unknownrobot" content="index,follow, all">
    <meta name="rating" content="General">
    <meta name="audience" content="all">
    <meta name="og:region" content="São Paulo, SP/Brasil" />
    <meta name="geo.position" content="-23.5645925;-46.6471141" />
    <meta name="ICBM" content="-23.5645925;-46.6471141" />
    <meta name="geo.placename" content="São Paulo-SP" />
    <meta name="geo.region" content="SP-BR">
    <meta name="distribution" content="global" />
    <meta name="copyright" content="Compra e Venda de Consórcios" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="ConsorsOficial">
    <meta name="twitter:title" content="Consors - Compra e Venda de Consórcios - Consors">
    <meta name="twitter:description" content="Quer vender seu consórcio? Nós da Consors compramos consórcios em andamento, sem intermediários. Temos a Melhor avaliação com Pagamento imediato">
    <meta name="twitter:url" content="https://consors.com.br/">
    <meta name="twitter:creator" content="ConsorsOficial">
    <meta name="twitter:image" content="https://consors.com.br/images/consors.jpg">
    <meta property="fb:admins" content="1912255549015756" />
    <meta property="og:url" content="https://consors.com.br/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Consors - Compra e Venda de Consórcios - Consors" />
    <meta property="og:image" content="https://www.consors.com.br/images/consors.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="520" />
    <meta property="og:image:height" content="272" />
    <meta property="og:image:alt" content="Consors - Compra e Venda de Consórcios" />
    <meta property="og:description" content="Quer vender seu consórcio? Nós da Consors compramos consórcios em andamento, sem intermediários. Temos a Melhor avaliação com Pagamento imediato" />
    <meta property="og:site_name" content="Consors - Compra e Venda de Consórcios - Consors">
    <meta property="business:contact_data:street_address" content="R. Pirapitingui, 80 - Sala 108">
    <meta property="business:contact_data:locality" content="SP">
    <meta property="business:contact_data:region" content="São Paulo">
    <meta property="geo.position" content="-23.5645925, -46.6471141">
    <meta property="geo.region" content="São Paulo, SP">
    <meta property="ICBM" content="-23.5645925, -46.6471141">
    <meta property="business:contact_data:postal_code" content="01508-020">
    <meta property="business:contact_data:country_name" content="Brasil">
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PCXPJGW');</script>
<!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>
    
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PCXPJGW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <?php
    hello_elementor_body_open();

    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('header')) {
        get_template_part('template-parts/header');
    }
