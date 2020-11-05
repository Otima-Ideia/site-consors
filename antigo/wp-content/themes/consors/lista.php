<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $titulo_pagina;?> - <?php echo $nome_site;?></title>
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
<meta name="twitter:title" content="<?php echo $titulo_pagina;?> - <?php echo $nome_site;?>">
<meta name="twitter:description" content="<?php echo $nm_description_rede_social;?>">
<meta name="twitter:url" content="<?php echo $url_atual;?>">
<meta name="twitter:creator" content="<?php echo $twitter_creator;?>">
<meta name="twitter:image" content="<?php echo $nm_imagem_rede_social; ?>">
<meta property="fb:admins" content="<?php echo $fb_admins;?>"/>
<meta property="og:url" content="<?php echo $url_atual;?>"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $titulo_pagina;?> - <?php echo $nome_site;?>"/>
<meta property="og:image" content="<?php echo $nm_imagem_rede_social; ?>"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="800"/>
<meta property="og:image:height" content="400"/>
<meta property="og:image:alt" content="<?php echo $nm_legenda_capa; ?>"/>
<meta property="og:description" content="<?php echo $nm_description_rede_social;?>"/>
<meta property="og:site_name" content="<?php echo $titulo_pagina;?> - <?php echo $nome_site;?>">
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
<a itemprop="item" href="<?php echo $url_grupo;?>" title="<?php echo $titulo_pagina;?>"><span itemprop="name"><?php echo $titulo_pagina;?></span></a>
<meta itemprop="position" content="2" />
</li>
</ul>
<p class="conteudo"><?php echo $semantica_11;?></p>
</div></div></div></section>
		
<?php if($modelo == 1){ ?>
<!-- / INICIO SECTION ARTIGOS -->		
<section class="career_details">

<div class="container">
<div class="row">
<!-- === Conteúdo === -->				
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right right_side left-side">

<div class="blog-variation-container blog_two">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h2>Blog do Consórcio</h2>
<p>Acompanhem nossas publicações e se mantenham informados sobre dicas de investimento, regras e normas para você que deseja vender o seu consorcio em andamento</p>	
<?php for($i=0; $i < count($obj); $i++){ ?>



	
<article itemscope itemtype="http://schema.org/Blog">
<div class="col-lg-6 col-md-6">
<div class="img_holder" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<img class="img-responsive" src="<?php echo HTTP_HOST . $obj[$i]->nm_capa;?>" alt="<?php echo $obj[$i]->nm_legenda_capa;?>">
<meta itemprop="name" content="<?php echo $obj[$i]->nm_legenda_capa;?>">
<meta itemprop="height" content="300">
<meta itemprop="width" content="435">
<meta itemprop="url" content="<?php echo HTTP_HOST . $obj[$i]->nm_capa;?>">
</div>
<time class="entry-time" itemprop="dateCreated" datetime="<?php echo str_replace(" ", "T", $obj[$i]->dt_cadastro); ?>+00:00"></time>
<time class="entry-time" itemprop="datePublished" datetime="<?php echo str_replace(" ", "T", $obj[$i]->dt_cadastro); ?>+00:00"></time>
<time class="entry-time" itemprop="dateModified" datetime="<?php echo str_replace(" ", "T", $obj[$i]->dt_alteracao); ?>+00:00"></time>

<?php include("includes/orlando.php"); ?>
<h3 itemprop="headline" style="font-size:14px;">
<?php echo $obj[$i]->nm_conteudo;?>
</h3>
<p itemprop="description" style="font-size:14px;line-height:20px;text-align:justify;padding-left:8px;padding-right:8px">
<?php echo $obj[$i]->nm_resumo;?>
</p>
<a href="<?php echo $array_conteudos_url[$obj[$i]->id_conteudo];?>" title="<?php echo $obj[$i]->nm_conteudo;?>" style="background:#ffcc00; padding-left:9px; padding-right:9px; padding-bottom:5px; padding-top:5px; margin-bottom:30px;">ler mais <i class="fa fa-arrow-circle-right"> </i></a>
</div>
</article>	
<?php if ($i % 2 == 1){ ?><div style="clear:both; margin-top:30px;"><br><br></div><?php } ?>
<?php } ?>
<?php if($total_paginas > 1){ ?>
<div style="clear:both; margin-top:30px;"></div>
<div class="pagination">

<?php for($i=1; $i <= $total_paginas; $i++){ ?>
<a href="javascript:void(0);" onClick="carregar_lista('<?php echo $i; ?>');" class="<?php if($i == $paginacao){echo "active";} ?>" style="padding-bottom:5px; padding-top:5px; padding-left: 10px; padding-right:10px; background:#802990; color:#ffffff;"><?php echo $i; ?></a>
<?php } ?>
</div>
<?php } ?>
</div></div></div>

<!-- === Início Formulário === -->				
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left left_side"><?php include("includes/form-lateral.php"); ?></div>
<!-- === Fim Formulário === -->				
</div>
</div>
</section>
<?php } ?>
<form id="form_lista" method="post">
<input type="hidden" name="paginacao" id="paginacao" value="<?php echo $paginacao;?>">
</form>
<?php include("includes/footer.php"); ?>
<?php include("includes/fontes.php"); ?>
<?php include("includes/mascara.php"); ?>
<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="validacao.js"></script>
<script>
  function carregar_lista(page){
    $("#paginacao").val(page)
    $("#form_lista").submit();
  }
</script>
</body>
</html>