


<?php get_header(); ?>
<!-- ======= Breadcrumb ======= -->
<section class="p0 container-fluid banner about_banner3">
<div class="about_banner_opacity">
<div class="container">
<div class="banner_info_about">
<h2 style="color:#f1f1f1; font-size:24px;">Consors - Vender Consórcio</h2>
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
<section class="career_details" itemscope itemtype="http://schema.org/Service">
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right right_side">

<h1 itemprop="serviceType">Vender Consórcio</h1>
<meta itemprop="additionalType" content="<?php echo $nm_additionaltype;?>" />
<div class="conteudo" style="height:auto;" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<meta itemprop="name" content="Vender seu Consórcio">
<meta itemprop="height" content="250">
<meta itemprop="width" content="1000">
<meta itemprop="url" content="<?php echo get_template_directory_uri(); ?>/datafiles/servicos/vender-consorcio-capa.jpg">
<img src="<?php echo get_template_directory_uri(); ?>/datafiles/servicos/vender-consorcio-capa.jpg" alt="venda seu consórcio na Consors" hspace="1" vspace="10" align="left">
</div>
<div style="clear:both"></div>
<div itemprop="description">
                        
<p>Vender consórcio com a melhor avaliação e pagamos à vista.  Preencha o formulário com o maior número de informações possíveis de seu plano de consórcio </p>

<p><strong style="color:#000000;">Para vender seu consórcio</strong>, preencha o formulário abaixo que entraremos em contato em minutos, com uma proposta de compra. <strong style="color:#990000;">Não venda antes de solicitar uma avaliação nossa</strong>. Como não somos intermediadores, compramos diretamente de você, o que permite <strong style="color:#000000;">ofertar um valor maior no seu consórcio</strong> que a concorrência</p>
<p style="font-size:17px; color:#12a0b1;"><strong>Formulário de venda</strong></p>


<?php include("includes/form-pagina.php"); ?>

</div></div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left left_side">

<h2>Compramos seu Consórcio</h2><p style="font-size:15px;color:#000;margin-top:15px">

<strong>1 - TEMOS A MELHOR AVALIAÇÃO. ENTENDA</strong></p><p style="padding-right:30px;color:#666"><strong style="color:#12a0b1">Não temos intermediação</strong>, compramos nossas cotas <strong style="color:#12a0b1">diretamente de nossos clientes</strong>, o que nos possibilita oferecer as melhores avaliações de mercado.</p><p style="padding-right:30px;color:#666"><strong>Preencha o Formulário, para vender o seu consórcio</strong>. Iremos avaliar as informações e retornaremos a seguir com um proposta para comprar seu consórcio. </p>
<div style="clear:both"></div><p class="conteudo"><?php echo $semantica_4;?></p><p style="font-size:14px;color:#000;margin-top:15px">

<strong>2 - SEGURANÇA NA NEGOCIAÇÃO</strong></p>


<p style="font-size:15px;color:#666;margin-top:-15px; padding-right:30px;">Estamos há mais de 35 anos no ramo e nossos clientes demonstram isso em seus depoimentos.</p><a href="https://www.consors.com.br/depoimentos">depoimentos &nbsp;&nbsp;&nbsp;</a><p style="font-size:14px;color:#000;margin-top:15px">

<strong>3 - AGILIDADE / COMPROMETIMENTO</strong></p><p style="font-size:15px;color:#666;margin-top:-15px; padding-right:30px;">
Agimos de forma rápida e transparente, respeitando o processo de transferência de cotas das administradoras</p><p style="font-size:14px;color:#000;margin-top:15px; padding-right:30px;">

<strong>4 - COMPRAMOS DAS PRINCIPAIS ADMINISTRADORAS</strong></p><p style="font-size:15px;color:#666;margin-top:-15px; padding-right:30px;">Trabalhamos com as principais administradoras do Brasil. Solicite uma avaliação gratuita.</p><p style="font-size:14px;color:#000;margin-top:15px">

<strong>5 - COMPRAMOS COTAS DE CLIENTES DE TODO BRASIL</strong></p><p style="font-size:15px;color:#666;margin-top:-15px; padding-right:30px;">Estamos localizados no centro de São Paulo, mas atuamos na compra de cotas em âmbito nacional</p>


</div>
<!-- === Fim Formulário === -->				
</div>
</div>
</section>
<!-- =================/Career Details ============ -->	
<?php include("includes/fontes.php"); ?>
<?php include("includes/mascara.php"); ?>
<?php get_footer(); ?>