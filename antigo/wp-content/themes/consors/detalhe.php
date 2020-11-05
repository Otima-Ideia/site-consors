<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $nm_conteudo;?> - <?php echo $nome_site;?></title>
<meta name="description" content="<?php echo $nm_description;?>"/>
<link rel="canonical" href="<?php echo $url_atual;?>" />
<meta name="robots" content="all, index, follow">
<meta name="Googlebot" content="index,follow, all">
<meta name="MSNbot" content="index,follow, all">
<meta name="InktomiSlurp" content="index,follow, all">
<meta name="Unknownrobot" content="index,follow, all">
<meta name="rating" content="General">
<meta name="audience" content="all"> 
<meta name="og:region" content="São Paulo, SP/Brasil"/> 
<meta name="geo.position" content="<?php echo $latitude;?>;<?php echo $longitude;?>"/>
<meta name="ICBM" content="<?php echo $latitude;?>;<?php echo $longitude;?>"/>
<meta name="geo.placename" content="São Paulo-SP"/>
<meta name="geo.region" content="SP-BR">
<meta name="distribution" content="global"/>
<meta name="copyright" content="<?php echo $copyright;?>"/>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="<?php echo $twitter_site;?>">
<meta name="twitter:title" content="<?php echo $nm_conteudo;?> - <?php echo $nome_site;?>">
<meta name="twitter:description" content="<?php echo $nm_description_rede_social;?>">
<meta name="twitter:url" content="<?php echo $url_atual;?>">
<meta name="twitter:creator" content="<?php echo $twitter_creator;?>">
<meta name="twitter:image" content="<?php echo $nm_imagem_rede_social; ?>">
<meta property="fb:admins" content="<?php echo $fb_admins;?>"/>
<meta property="og:url" content="<?php echo $url_atual;?>"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $nm_conteudo;?> - <?php echo $nome_site;?>"/>
<meta property="og:image" content="<?php echo $nm_imagem_rede_social; ?>"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="800"/>
<meta property="og:image:height" content="400"/>
<meta property="og:image:alt" content="<?php echo $nm_legenda_capa; ?>"/>
<meta property="og:description" content="<?php echo $nm_description_rede_social;?>"/>
<meta property="og:site_name" content="<?php echo $nm_conteudo;?> - <?php echo $nome_site;?>">
<meta property="business:contact_data:street_address" content="<?php echo $endereco ?>">
<meta property="business:contact_data:locality" content="<?php echo $estado ?>">
<meta property="business:contact_data:region" content="<?php echo $cidade ?>">
<meta property="geo.position" content="<?php echo $latitude;?>, <?php echo $longitude;?>">
<meta property="geo.region" content="<?php echo $cidade ?>, <?php echo $estado ?>">
<meta property="ICBM" content="<?php echo $latitude;?>, <?php echo $longitude;?>">
<meta property="business:contact_data:postal_code" content="<?php echo $cep ?>">
<meta property="business:contact_data:country_name" content="Brasil">
<link rel="shortcut icon" href="<?php echo HTTP_HOST; ?>images/favicon.png" type="image/x-icon">

<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css" media="screen">
<link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="fonts/stroke-gap/style.css">
<link rel="stylesheet" type="text/css" href="css/custom/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive/responsive.css">
<?php include("includes/google-analytics.php"); ?>
<!--Json LocalBusiness-->
<?php include("includes/localbusiness.php"); ?>
</head>
<body>
<?php include("includes/header.php"); ?>
<?php include("includes/menu.php"); ?>
<!-- ======= Breadcrumb ======= -->
<section class="p0 container-fluid banner about_banner3">
<div class="about_banner_opacity">
<div class="container">
<div class="banner_info_about">
<h3 style="color:#f1f1f1; font-size:24px;"><?php echo $nm_chamada;?></h3>
<ul itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
<a itemprop="item" href="<?php echo HTTP_HOST; ?>" title="Home"><span itemprop="name">Home</span></a>
<meta itemprop="position" content="1" />
</li>
<li><i class="fa fa-angle-right"></i></li>
<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
<a itemprop="item" href="<?php echo $url_grupo;?>" title="<?php echo $url_grupo;?>"><span itemprop="name"><?php echo $nm_grupo;?></span></a>
<meta itemprop="position" content="2" />
</li>
<?php if($cd_modelo < 3){ ?>
<li><i class="fa fa-angle-right"></i></li>
<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
<a itemprop="item" href="<?php echo $url_atual;?>" title="<?php echo $nm_conteudo;?>"><span itemprop="name"><?php echo $nm_conteudo;?></span></a>
<meta itemprop="position" content="3" />
</li>
<?php } ?>
</ul>
<p class="conteudo"><?php echo $semantica_12;?></p>
</div></div></div></section>
		
<?php if($cd_modelo == 1){ ?>
<!-- / INICIO SECTION ARTIGOS -->		
<section class="career_details">

<div class="container">
<div class="row">
<!-- === Conteúdo === -->				
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right right_side" itemscope itemtype="http://schema.org/BlogPosting">
<article>
<h1 itemprop="headline"><?php echo $nm_conteudo;?></h1>
<meta itemprop="articleSection" content="<?php echo $nm_grupo;?>" />
<meta itemprop="mainEntityOfPage" content="<?php echo $url_atual;?>" />
<meta itemprop="isPartOf" content="<?php echo $nm_linkagem;?>" />
<div itemprop="articleBody">
<div style="height:auto;" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<meta itemprop="name" content="<?php echo $nm_legenda_capa; ?>">
<meta itemprop="height" content="1000">
<meta itemprop="width" content="250">
<meta itemprop="url" content="<?php echo $nm_capa; ?>">
<img src="<?php echo $nm_imagem_rede_social; ?>" alt="<?php echo $nm_legenda_capa; ?>" hspace="1" vspace="10" align="left">
</div>
<div style="clear:both"></div>
<time class="entry-time" itemprop="datePublished" datetime="<?php echo $dt_inclusao_seo; ?>"></time>
<time class="entry-time" itemprop="dateModified" datetime="<?php echo $dt_alteracao_seo; ?>"></time>
<?php include("includes/author.php"); ?>
<?php include("includes/publisher.php"); ?>
<?php echo str_replace("datafiles/", HTTP_HOST."datafiles/", $tx_descricao); ?>
</div>
</article>
<p class="conteudo"><?php echo $semantica_13;?></p>
</div>
<!-- === Início Formulário === -->				
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left left_side"><?php include("includes/form-lateral.php"); ?></div>
<!-- === Fim Formulário === -->				
</div>
</div>
</section>
<?php } ?>

<?php include("includes/footer.php"); ?>
<?php include("includes/fontes.php"); ?>
<?php include("includes/mascara.php"); ?>
<?php include("includes/whatsapp.php"); ?>
<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="validacao.js"></script>
</body>
</html>