



<?php get_header(); ?>
<!-- ======= Breadcrumb ======= -->
<section class="p0 container-fluid banner about_banner3">
<div class="about_banner_opacity">
<div class="container">
<div class="banner_info_about">
<h3 style="color:#f1f1f1; font-size:24px;">Opinião dos nossos Clientes</h3>
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




<section class="career_details">
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right right_side">
<h1 style="font-size:22px">Depoimentos</h1>

<p>Com profissionalismo e Avaliação justa, a Consors efetiva negociações boas a ambas as partes. Veja alguns depoismentos de clintes que fizeram negócio com a Consors</p>
	
<div class="col-lg-12 col-md-12 col-sm-12 testimonial left_part" style="background:#f1f1f1;">
<div class="float_right client_info" style="padding-left:3px">
<p style="color:#12a0b1">Fábio Leopoldino</p>
<span>"Minha cota encontrava-se cancelada e com parcelas em atraso. Desde o primeiro contato, a empresa foi muito atenciosa e transparente em acompanhar o processo de reativação da cota, até a conclusão da transferência e o pagamento do valor combinado."</span>
</div>
<p class="john_speach clear_fix" style="margin-top:0;padding-top:1px">Rio de Janeiro-RJ</p>
</div>



	
<div class="col-lg-12 col-md-12 col-sm-12 testimonial left_part" style="background:#f1f1f1;; margin-top:30px;">
<div class="float_right client_info" style="padding-left:3px">
<p style="color:#12a0b1">Marcelo Bichim</p>
<span>""Gostei muito do atendimento, sempre me deixando a vontade para pensar e finalizar a negociação. Quando decidi vender, a conclusão do negócio aconteceu de forma muito transparante e tranquila, com o pagamento sendo realizado dentro da data combinada."</span>
</div>
<p class="john_speach clear_fix" style="margin-top:0;padding-top:1px">Araçatuba-SP</p>
</div>

	
<div class="col-lg-12 col-md-12 col-sm-12 testimonial left_part" style="background:#f1f1f1;; margin-top:30px;">
<div class="float_right client_info" style="padding-left:3px">
<p style="color:#12a0b1">Carmem Luiza de Moura Carvalho</p>
<span>"Eu tinha uma cota de consórcio e como estava precisando de dinheiro, decidi vender. Entrei em contato com a Consors com a minha proposta, e esta rapidamente respondeu ao meu email interessada em comprar. Todos foram muito atenciosos, responderam as minhas dúvidas e chegamos a um acordo que foi bom para ambas as partes. Agendamos um horário na própria seguradora com a qual eu tinha a cota de consórcio e fizemos a transferência da cota na hora, de forma simples, rápida e o pagamento foi feito na hora via Internet Banking, na minha frente. A todos que pretendam comprar ou vender consórcios, recomendo fazer negócio com a Consors."</span>
</div>
<p class="john_speach clear_fix" style="margin-top:0;padding-top:1px">São Paulo-SP</p>
</div>




</div>
<!-- === Início Formulário === -->				
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left left_side"><?php include("includes/form-lateral.php"); ?></div>
<!-- === Fim Formulário === -->				
</div>
</div>
</section>


<!-- =================/Career Details ============ -->	
<?php include("includes/fontes.php"); ?>
<?php include("includes/mascara.php"); ?>
<?php get_footer(); ?>