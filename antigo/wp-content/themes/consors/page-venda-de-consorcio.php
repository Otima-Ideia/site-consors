
<?php get_header(); ?>
<!-- ======= Breadcrumb ======= -->
<section class="p0 container-fluid banner about_banner3">
<div class="about_banner_opacity">
<div class="container">
<div class="banner_info_about">
<h3 style="color:#f1f1f1; font-size:24px;">Consors - Quer Optar pela Venda de Consórcio? Nós Compramos</h3>
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

<h1 itemprop="serviceType">Venda de Consórcio</h1>
<meta itemprop="additionalType" content="<?php echo $nm_additionaltype;?>" />
<div class="conteudo" style="height:auto;" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<meta itemprop="name" content="Quer Optar pela Venda de Consórcio? Nós Compramos">
<meta itemprop="height" content="250">
<meta itemprop="width" content="1000">
<meta itemprop="url" content="<?php echo get_template_directory_uri(); ?>/datafiles/servicos-venda-de-consorcio-capa.jpg">
<img src="<?php echo get_template_directory_uri(); ?>/datafiles/servicos/venda-de-consorcio-capa.jpg" alt="Quer Optar pela Venda de Consórcio? Nós Compramos" hspace="1" vspace="10" align="left">
</div>
<div style="clear:both"></div>
<div itemprop="description">
                        
<p>Procurando uma empresa para realizar a venda de consórcio? Entre em contato conosco e obtenha uma ótima avaliação para o seu consórcio em andamento. Compramos consorcio de todas as administradoras do Brasil</p>
<p><strong style="color:#000000;">Para vender seu consórcio</strong>, preencha o formulário abaixo que entraremos em contato em minutos, com uma proposta de compra. <strong style="color:#990000;">Não venda antes de solicitar uma avaliação nossa</strong>. Como não somos intermediadores, compramos diretamente de você, o que permite <strong style="color:#000000;">ofertar um valor maior no seu consórcio</strong> que a concorrência</p>
<p style="font-size:17px; color:#12a0b1;"><strong>Formulário de venda</strong></p>
<?php include("includes/form-pagina.php"); ?>

</div></div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left left_side">

<h6>Compramos seu Consórcio</h6><p style="font-size:15px;color:#000;margin-top:15px"><strong>1 - TEMOS A MELHOR AVALIAÇÃO. ENTENDA</strong></p><p style="padding-right:30px;color:#666"><strong style="color:#12a0b1">Não temos intermediação</strong>, compramos nossas cotas <strong style="color:#12a0b1">diretamente de nossos clientes</strong>, o que nos possibilita oferecer as melhores avaliações de mercado.</p><p style="padding-right:30px;color:#666"><strong>Preencha o Formulário, para vender o seu consórcio</strong>. Iremos avaliar as informações e retornaremos a seguir com um proposta para comprar seu consórcio. </p>
<div style="clear:both"></div><p style="font-size:14px;color:#000;margin-top:15px">
<strong>2 - SEGURANÇA NA NEGOCIAÇÃO</strong></p><p style="font-size:15px;color:#666;margin-top:-15px">Estamos há mais de 35 anos no ramo e nossos clientes demonstram isso em seus depoimentos.</p><a href="https://www.consors.com.br/depoimentos">depoimentos &nbsp;&nbsp;&nbsp;</a><p style="font-size:14px;color:#000;margin-top:15px"><strong>3 - AGILIDADE / COMPROMETIMENTO</strong></p><p style="font-size:15px;color:#666;margin-top:-15px">Agimos de forma rápida e transparente de acordo com a negociação conduzia</p><p style="font-size:14px;color:#000;margin-top:15px"><strong>4 - COMPRAMOS DE TODAS ADMINISTRADORAS</strong></p><p style="font-size:15px;color:#666;margin-top:-15px">Adquirimos cotas de consórcio de todas as administradoras do Brasil. Solicite uma avaliação gratuita.</p><p style="font-size:14px;color:#000;margin-top:15px"><strong>5 - ESCRITÓRIO NA AV. PAULISTA</strong></p><p style="font-size:15px;color:#666;margin-top:-15px">Localizados no coração de São Paulo, nosso escritório está de portas abertas para que o nosso cliente possa nos conhecer e conduzir sua negociação com a Consors de forma transparente, segura e ágil.</p>
<p class="conteudo"><?php echo $semantica_6;?>
</div>
<!-- === Fim Formulário === -->				
</div>
</div>
</section>
<!-- =================/Career Details ============ -->	
<?php include("includes/fontes.php"); ?>
<?php include("includes/mascara.php"); ?>
<?php get_footer(); ?>