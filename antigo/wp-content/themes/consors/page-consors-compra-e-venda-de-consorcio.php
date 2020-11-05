<?php get_header(); ?>
<!-- ======= Breadcrumb ======= -->
<section class="p0 container-fluid banner about_banner3">
<div class="about_banner_opacity">
<div class="container">
<div class="banner_info_about">
<h2 style="color:#f1f1f1; font-size:24px;">Consors - Especialista em Consórcio</h2>
<ul itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
<a itemprop="item" href="/" title="Home"><span itemprop="name"><?php echo get_bloginfo('name');?></span></a>
<meta itemprop="position" content="1" />
</li>
<li><i class="fa fa-angle-right"></i></li>
<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
<a itemprop="item" href="<?php the_permalink() ;?>" title="<?php the_title(); ?>"><span itemprop="name"><?php the_title(); ?></span></a>
<meta itemprop="position" content="2" />
</li>

</ul>
</div></div></div></section>


<!-- =================Career Details ============ -->
<section class="career_details">
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right right_side">
<h1 style="font-size:22px">Consors - Compra e Venda de Consórcios</h1>
 <p>A Consors é uma empresa familiar especializada em comprar e vender consórcios das maiores e melhores administradoras de todo o Brasil.</p>                       
                        
<p>A empresa, com sede localizada no centro de São Paulo/SP, possui uma experiência consolidada há mais de 35 anos de atuação no mercado, trabalhando com foco na transparência e seriedade em todas as etapas de compra e venda de consórcios, sejam eles de motos, carros, caminhões ou imóveis residenciais e comerciais. </p>

<p>A Consors conta, ainda, com um departamento jurídico próprio, que auxilia os clientes com assessoria jurídica em caráter preventivo e negocial, esclarecendo qualquer dúvida relacionada ao processo de compra ou venda de cotas. Nossos profissionais estão aptos a oferecer um atendimento completamente personalizado, de modo a entender os principais objetivos do cliente e indicar as melhores opções para o seu caso. </p>

<p>Para mais informações entre em contato! A equipe da Consors terá verdadeiro prazer em atendê-lo! </p>

<div class="author-box" style="margin-top:-10px;">
<div class="top-author-info dt">
<div class="top-author-info-content dtc" style="color:#ffffff;">
<p>* Não somos representantes ou extenção de qualquer administradora ou banco citado neste site, somos uma empresa independente que se compromete a levar informações reais e bons negócios de forma séria e transparente a seus clientes. Todas as transferências somente são feitas com a anuência da administradora de origem da cota. </p>
</div>
</div>
</div>

</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left left_side"><?php include("includes/form-lateral.php"); ?></div>
<!-- === Fim Formulário === -->				
</div>
</div>
</section>
<?php include("includes/fontes.php"); ?>
<?php include("includes/mascara.php"); ?>
<?php get_footer(); ?>
