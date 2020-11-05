<?php require_once("../includes/config.php"); ?>



<?php $titulo_pagina = "Configurações"; $alterado = false; ?>



<?php if($_REQUEST["operacao"]){ 



$_REQUEST = str_replace("'", chr(34), $_REQUEST);


$array = array(
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["nome_empresa"] . "' WHERE nm_config='nome_empresa';",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["telefone1"] . "' WHERE nm_config='telefone1'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["telefone2"] . "' WHERE nm_config='telefone2'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["whatsapp"] . "' WHERE nm_config='whatsapp'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["email"] . "' WHERE nm_config='email'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["email_gmail"] . "' WHERE nm_config='email_gmail'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["horario"] . "' WHERE nm_config='horario'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["cep"] . "' WHERE nm_config='cep'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["endereco"] . "' WHERE nm_config='endereco'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["latitude"] . "' WHERE nm_config='latitude'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["longitude"] . "' WHERE nm_config='longitude'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["type"] . "' WHERE nm_config='type'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["additional_type"] . "' WHERE nm_config='additional_type'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["hasmap"] . "' WHERE nm_config='hasmap'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["home_title"] . "' WHERE nm_config='home_title'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["contato_sucesso_title"] . "' WHERE nm_config='contato_sucesso_title'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["orcamento_title"] . "' WHERE nm_config='orcamento_title'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["home_description"] . "' WHERE nm_config='home_description'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["contato_description"] . "' WHERE nm_config='contato_description'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["orcamento_description"] . "' WHERE nm_config='orcamento_description'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["twitter_site"] . "' WHERE nm_config='twitter_site'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["twitter_creator"] . "' WHERE nm_config='twitter_creator'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["fb_admins"] . "' WHERE nm_config='fb_admins'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["bairro"] . "' WHERE nm_config='bairro'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["cidade"] . "' WHERE nm_config='cidade'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["estado"] . "' WHERE nm_config='estado'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["isicV4"] . "' WHERE nm_config='isicV4'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["naics"] . "' WHERE nm_config='naics'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["foundingDate"] . "' WHERE nm_config='foundingDate'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["desc_localbusiness"] . "' WHERE nm_config='desc_localbusiness'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["desc_branding"] . "' WHERE nm_config='desc_branding'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["alternateName"] . "' WHERE nm_config='alternateName'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["legalName"] . "' WHERE nm_config='legalName'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["res_about_home"] . "' WHERE nm_config='res_about_home'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["res_about_internas"] . "' WHERE nm_config='res_about_internas'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["cnpj"] . "' WHERE nm_config='cnpj'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_facebook"] . "' WHERE nm_config='social_facebook'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_linkedin"] . "' WHERE nm_config='social_linkedin'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_twitter"] . "' WHERE nm_config='social_twitter'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_youtube"] . "' WHERE nm_config='social_youtube'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_instagram"] . "' WHERE nm_config='social_instagram'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_pinterest"] . "' WHERE nm_config='social_pinterest'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_vk"] . "' WHERE nm_config='social_vk'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_vimeo"] . "' WHERE nm_config='social_vimeo'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_flickr"] . "' WHERE nm_config='social_flickr'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_tumblr"] . "' WHERE nm_config='social_tumblr'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_blogger"] . "' WHERE nm_config='social_blogger'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_quora"] . "' WHERE nm_config='social_quora'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_reddit"] . "' WHERE nm_config='social_reddit'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_wordpress"] . "' WHERE nm_config='social_wordpress'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_foursquare"] . "' WHERE nm_config='social_foursquare'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_about"] . "' WHERE nm_config='social_about'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_medium"] . "' WHERE nm_config='social_medium'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["social_gbm"] . "' WHERE nm_config='social_gbm'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["cd_sp"] . "' WHERE nm_config='cd_sp'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["url_sp"] . "' WHERE nm_config='url_sp'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["cd_gua"] . "' WHERE nm_config='cd_gua'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["url_gua"] . "' WHERE nm_config='url_gua'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["cd_sbc"] . "' WHERE nm_config='cd_sbc'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["url_sbc"] . "' WHERE nm_config='url_sbc'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["cd_sa"] . "' WHERE nm_config='cd_sa'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["url_sa"] . "' WHERE nm_config='url_sa'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["cd_scs"] . "' WHERE nm_config='cd_scs'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["url_scs"] . "' WHERE nm_config='url_scs'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["hasmap_sp"] . "' WHERE nm_config='hasmap_sp'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["latitude_sp"] . "' WHERE nm_config='latitude_sp'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["longitude_sp"] . "' WHERE nm_config='longitude_sp'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["hasmap_gua"] . "' WHERE nm_config='hasmap_gua'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["latitude_gua"] . "' WHERE nm_config='latitude_gua'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["longitude_gua"] . "' WHERE nm_config='longitude_gua'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["hasmap_sbc"] . "' WHERE nm_config='hasmap_sbc'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["latitude_sbc"] . "' WHERE nm_config='latitude_sbc'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["longitude_sbc"] . "' WHERE nm_config='longitude_sbc'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["hasmap_sa"] . "' WHERE nm_config='hasmap_sa'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["latitude_sa"] . "' WHERE nm_config='latitude_sa'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["longitude_sa"] . "' WHERE nm_config='longitude_sa'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["hasmap_scs"] . "' WHERE nm_config='hasmap_scs'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["latitude_scs"] . "' WHERE nm_config='latitude_scs'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["longitude_scs"] . "' WHERE nm_config='longitude_scs'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["url_quem_somos"] . "' WHERE nm_config='url_quem_somos'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["img_localbusiness"] . "' WHERE nm_config='img_localbusiness'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["alt_logo"] . "' WHERE nm_config='alt_logo'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["title_logo"] . "' WHERE nm_config='title_logo'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["alt_logo_business"] . "' WHERE nm_config='alt_logo_business'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["title_logo_business"] . "' WHERE nm_config='title_logo_business'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_1"] . "' WHERE nm_config='semantica_1'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_2"] . "' WHERE nm_config='semantica_2'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_3"] . "' WHERE nm_config='semantica_3'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_4"] . "' WHERE nm_config='semantica_4'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_5"] . "' WHERE nm_config='semantica_5'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_6"] . "' WHERE nm_config='semantica_6'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_7"] . "' WHERE nm_config='semantica_7'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_8"] . "' WHERE nm_config='semantica_8'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_9"] . "' WHERE nm_config='semantica_9'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_10"] . "' WHERE nm_config='semantica_10'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_11"] . "' WHERE nm_config='semantica_11'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_12"] . "' WHERE nm_config='semantica_12'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["semantica_13"] . "' WHERE nm_config='semantica_13'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["wp_header_gmb"] . "' WHERE nm_config='wp_header_gmb'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["wp_footer"] . "' WHERE nm_config='wp_footer'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["texto_orcamento"] . "' WHERE nm_config='texto_orcamento'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["texto_msg_recebida"] . "' WHERE nm_config='texto_msg_recebida'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["h1_titulo"] . "' WHERE nm_config='h1_titulo'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["txt_conversao"] . "' WHERE nm_config='txt_conversao'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["h2_subtitulo"] . "' WHERE nm_config='h2_subtitulo'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["txt_chamada_servicos"] . "' WHERE nm_config='txt_chamada_servicos'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["h4_subtitulo"] . "' WHERE nm_config='h4_subtitulo'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["txt_mtv_contratar"] . "' WHERE nm_config='txt_mtv_contratar'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["h5_subtitulo"] . "' WHERE nm_config='h5_subtitulo'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["txt_chamada_blog"] . "' WHERE nm_config='txt_chamada_blog'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["h5_subtitulo_info"] . "' WHERE nm_config='h5_subtitulo_info'",
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["txt_info_diversas"] . "' WHERE nm_config='txt_info_diversas'",	
"UPDATE tab_config SET nm_valor = '" . $_REQUEST["copyright"] . "' WHERE nm_config='copyright'");
	


for($i=0; $i < count($array); $i++){
  Connector::executeQuery($array[$i], Connector::getDefaultLink());  
}

$alterado = true;

}

?>

<?php

  $obj = dao::execute("tab_config", "openAjax");
  $array_campos = array(); $i=0;
  
  foreach($obj as $campos=>$valor){
    array_push($array_campos, $valor->nm_config);
    //$$array_campos[$i] = $obj[$i]->nm_valor;

    $variavel = $valor->nm_config;
    $$variavel = $obj[$i]->nm_valor;

    $i++;

    $caracteres_home = strlen($home_description);
    $caracteres_contato = strlen($contato_description);
    $caracteres_orcamento = strlen($orcamento_description);
	  
	  
	  
  }
?>


<!DOCTYPE html>

<html lang="en">



<link rel="stylesheet" type="text/css" href="../../shadowbox/shadowbox.css">



<script src="../../shadowbox/shadowbox.js" language="javascript" type="text/javascript"></script>



<script type="text/javascript">

  Shadowbox.init();

</script>

<head>
<?php include("../includes/head.php"); ?>
</head>
<body>
<!-- Topo -->
  <?php include("../includes/topo.php"); ?>
<!-- Header -->
  <?php include("../includes/header.php"); ?>
<!-- Conteudo -->
<div class="content">

  <!-- Menu -->
    <?php include("../includes/menu.php"); ?>

    <div class="mainbar">

	    <!-- Page heading -->

	    <div class="page-head">

        <!-- Page heading -->

	      <h2 class="pull-left"><i class="fa fa-file-o"></i> <?php echo $titulo_pagina;?></h2>
        <!-- Breadcrumb -->

        <div class="bread-crumb pull-right">

          <a href="index.html"><i class="fa fa-home"></i> Home</a> 

          <!-- Divider -->

          <span class="divider">/</span> 

          <a href="#" class="bread-current"><?php echo $titulo_pagina;?></a>

        </div>



        <div class="clearfix"></div>



	    </div>


      <form class="form-horizontal" role="form" action="" name="formulario" id="formulario" method="post">

        <input type="hidden" name="operacao" value="true">
        <input type="hidden" name="idsBloco" id="idsBloco" value="">


	    <div class="matter">

        <div class="container">



          <div class="row">

            <div class="col-md-12">


              <div class="widget wgreen">


                <div class="widget-content">

                  <div class="padd">


                   <br>


<div class="form-group alert alert-success">
<label class="col-lg-8 control-label" style="text-align:left;">CONFIGURAÇÃO HTML SEMÂNTICO</label>
</div>
                    

<div class="form-group">
<label class="col-lg-2 control-label">Nome da empresa</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="nome_empresa" id="nome_empresa" placeholder="Nome da empresa" value="<?php echo $nome_empresa?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Nome Alternativo</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="alternateName" id="alternateName" placeholder="Nome Alternativo" value="<?php echo $alternateName?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Nome Legal</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="legalName" id="legalName" placeholder="Nome Legal" value="<?php echo $legalName?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">URL Quem Somos</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="url_quem_somos" id="url_quem_somos" placeholder="URL Quem Somos" value="<?php echo $url_quem_somos?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Alt Logo</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="alt_logo" id="alt_logo" placeholder="Alt Logo<" value="<?php echo $alt_logo?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Title Logo</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="title_logo" id="title_logo" placeholder="Title Logo" value="<?php echo $title_logo?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Alt Logo Business</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="alt_logo_business" id="alt_logo_business" placeholder="Alt Logo Business" value="<?php echo $alt_logo_business?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Title Logo Business</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="title_logo_business" id="title_logo_business" placeholder="Title Logo Business" value="<?php echo $title_logo_business?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">CNPJ</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="CNPJ" value="<?php echo $cnpj?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Data de Fundação</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="foundingDate" id="foundingDate" placeholder="Data de Fundação" value="<?php echo $foundingDate?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Data Copyright</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="dt_copyright" id="dt_copyright" placeholder="Data Copyright" value="<?php echo $dt_copyright?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">IMG Local Business</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="img_localbusiness" id="img_localbusiness" placeholder="IMG Local Business" value="<?php echo $img_localbusiness?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Copyright</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="copyright" id="copyright" placeholder="Copyright" value="<?php echo $copyright?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">WPHeader GMB</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="wp_header_gmb" id="wp_header_gmb" placeholder="WPHeader GMB" value="<?php echo $wp_header_gmb?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">WPFooter</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="wp_footer" id="wp_footer" placeholder="WPFooter" value="<?php echo $wp_footer?>">
</div>
</div>


                   
<div class="form-group alert alert-success">
<label class="col-lg-8 control-label" style="text-align:left;">TAGS HTML SEMÂNTICO</label>
</div>                

<div class="form-group">
<label class="col-lg-2 control-label">1 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_1" id="semantica_1" placeholder="1 - Tag Semântica" value="<?php echo $semantica_1?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">2 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_2" id="semantica_2" placeholder="2 - Tag Semântica" value="<?php echo $semantica_2?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">3 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_3" id="semantica_3" placeholder="3 - Tag Semântica" value="<?php echo $semantica_3?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">4 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_4" id="semantica_4" placeholder="4 - Tag Semântica" value="<?php echo $semantica_4?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">5 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_5" id="semantica_5" placeholder="5 - Tag Semântica" value="<?php echo $semantica_5?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">6 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_6" id="semantica_6" placeholder="6 - Tag Semântica" value="<?php echo $semantica_6?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">7 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_7" id="semantica_7" placeholder="7 - Tag Semântica" value="<?php echo $semantica_7?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">8 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_8" id="semantica_8" placeholder="8 - Tag Semântica" value="<?php echo $semantica_8?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">9 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_9" id="semantica_9" placeholder="9 - Tag Semântica" value="<?php echo $semantica_9?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">10 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_10" id="semantica_10" placeholder="10 - Tag Semântica" value="<?php echo $semantica_10?>">
</div>
</div>                                  
                                                            
<div class="form-group">
<label class="col-lg-2 control-label">11 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_11" id="semantica_11" placeholder="11 - Tag Semântica" value="<?php echo $semantica_11?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">12 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_12" id="semantica_12" placeholder="12 - Tag Semântica" value="<?php echo $semantica_12?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">13 - Tag Semântica</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="semantica_13" id="semantica_13" placeholder="13 - Tag Semântica" value="<?php echo $semantica_13?>">
</div>
</div>                                                                                
                                                                                                                        
                    
<div class="form-group alert alert-info">
<label class="col-lg-8 control-label" style="text-align:left;">DADOS ESTRUTURADOS - SCHEMA.ORG</label>
</div>                   
                    
<div class="form-group">
<label class="col-lg-2 control-label">Type</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="type" id="type" placeholder="Type" value="<?php echo $type?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Additional Type</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="additional_type" id="additional_type" placeholder="Additional Type" value="<?php echo $additional_type;?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Latitude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?php echo $latitude;?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Longitude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude?>">
</div>
</div>
                     
<div class="form-group">
<label class="col-lg-2 control-label">HasMap</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="hasmap" id="hasmap" placeholder="HasMap" value="<?php echo $hasmap?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">NAICS</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="naics" id="naics" placeholder="NAICS" value="<?php echo $naics;?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">ISIC-V4</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="isicV4" id="isicV4" placeholder="ISIC-V4" value="<?php echo $isicV4;?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">LocalBusiness</label>
<div class="col-lg-5">
<textarea class="form-control" placeholder="Description LocalBusiness" rows="7" id="desc_localbusiness" name="desc_localbusiness" onkeyup="$('#localbusiness_caracteres').html($('#desc_localbusiness').val().length)"><?php echo $desc_localbusiness?></textarea><span id="localbusiness_caracteres"><?php echo $caracteres_localbusiness; ?></span> caracteres
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Branding</label>
<div class="col-lg-5">
<textarea class="form-control" placeholder="Description Branding" rows="9" id="desc_branding" name="desc_branding" onkeyup="$('#branding_caracteres').html($('#desc_branding').val().length)"><?php echo $desc_branding?></textarea><span id="branding_caracteres"><?php echo $caracteres_branding; ?></span> caracteres
</div>
</div>                    

<div class="form-group alert alert-info">
<label class="col-lg-8 control-label" style="text-align:left;">CIDADES ATENDIDAS - DADOS ESTRUTURADOS - SCHEMA.ORG</label>
</div> 
       
<div class="form-group">
<label class="col-lg-2 control-label">Cidade São Paulo</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="cd_sp" id="cd_sp" placeholder="Cidade São Paulo" value="<?php echo $cd_sp?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">URL</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="url_sp" id="url_sp" placeholder="URL" value="<?php echo $url_sp?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">HasMap</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="hasmap_sp" id="hasmap_sp" placeholder="HasMap" value="<?php echo $hasmap_sp?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Latidude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="latitude_sp" id="latitude_sp" placeholder="Latidude" value="<?php echo $latitude_sp?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Longitude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="longitude_sp" id="longitude_sp" placeholder="Longitude" value="<?php echo $longitude_sp?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Cidade Guarulhos</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="cd_gua" id="cd_gua" placeholder="Cidade Guarulhos" value="<?php echo $cd_gua?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">URL</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="url_gua" id="url_gua" placeholder="URL" value="<?php echo $url_gua?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">HasMap</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="hasmap_gua" id="hasmap_gua" placeholder="HasMap" value="<?php echo $hasmap_gua?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Latidude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="latitude_gua" id="latitude_gua" placeholder="Latidude" value="<?php echo $latitude_gua?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Longitude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="longitude_gua" id="longitude_gua" placeholder="Longitude" value="<?php echo $longitude_gua?>">
</div>
</div>
	
<div class="form-group">
<label class="col-lg-2 control-label">Cidade São Bernardo</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="cd_sbc" id="cd_sbc" placeholder="Cidade São Bernardo" value="<?php echo $cd_sbc?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">URL</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="url_sbc" id="url_sbc" placeholder="URL" value="<?php echo $url_sbc?>">
</div>
</div>


<div class="form-group">
<label class="col-lg-2 control-label">HasMap</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="hasmap_sbc" id="hasmap_sbc" placeholder="HasMap" value="<?php echo $hasmap_sbc?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Latidude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="latitude_sbc" id="latitude_sbc" placeholder="Latidude" value="<?php echo $latitude_sbc?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Longitude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="longitude_sbc" id="longitude_sbc" placeholder="Longitude" value="<?php echo $longitude_sbc?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Cidade Santo Andre</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="cd_sa" id="cd_sa" placeholder="Cidade Santo Andre" value="<?php echo $cd_sa?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">URL</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="url_sa" id="url_sa" placeholder="URL" value="<?php echo $url_sa?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">HasMap</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="hasmap_sa" id="hasmap_sa" placeholder="HasMap" value="<?php echo $hasmap_sa?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Latidude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="latitude_sa" id="latitude_sa" placeholder="Latidude" value="<?php echo $latitude_sa?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Longitude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="longitude_sa" id="longitude_sa" placeholder="Longitude" value="<?php echo $longitude_sa?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Cidade São Caetano</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="cd_scs" id="cd_scs" placeholder="Cidade São Caetano" value="<?php echo $cd_scs?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">URL</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="url_scs" id="url_scs" placeholder="URL" value="<?php echo $url_scs?>">
</div>
</div>					  
					  

<div class="form-group">
<label class="col-lg-2 control-label">HasMap</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="hasmap_scs" id="hasmap_scs" placeholder="HasMap" value="<?php echo $hasmap_scs?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Latidude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="latitude_scs" id="latitude_scs" placeholder="Latidude" value="<?php echo $latitude_scs?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Longitude</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="longitude_scs" id="longitude_scs" placeholder="Longitude" value="<?php echo $longitude_scs?>">
</div>
</div>
					  
					  
<div class="form-group alert alert-warning">
<label class="col-lg-8 control-label" style="text-align:left;">INFORMAÇÕES DE CONTATO</label>
</div>                   
                    
<div class="form-group">
<label class="col-lg-2 control-label">Telefone 1</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="telefone1" id="telefone1" placeholder="Telefone 1" value="<?php echo $telefone1?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Telefone 2</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="telefone2" id="telefone2" placeholder="Telefone 2" value="<?php echo $telefone2?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Whatsapp</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Whatsapp" value="<?php echo $whatsapp?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">E-mail</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php echo $email?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">E-mail Gmail</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="email_gmail" id="email_gmail" placeholder="E-mail Gmail" value="<?php echo $email_gmail?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Horário</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="horario" id="horario" placeholder="Horário" value="<?php echo $horario?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Endereço</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereço" value="<?php echo $endereco?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Bairro</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" value="<?php echo $bairro?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Cidade</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" value="<?php echo $cidade?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Estado</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" value="<?php echo $estado?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">CEP</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="cep" id="cep" placeholder="CEP" value="<?php echo $cep?>">
</div>
</div>               

                   
                   
<div class="form-group alert alert-warning">
<label class="col-lg-8 control-label" style="text-align:left;">HOME</label>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Title</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="home_title" id="home_title" placeholder="Title" value="<?php echo $home_title?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Description</label>
<div class="col-lg-5">
<textarea class="form-control" placeholder="Description" rows="3" id="home_description" name="home_description" onkeyup="$('#home_caracteres').html($('#home_description').val().length)"><?php echo $home_description?></textarea><span id="home_caracteres"><?php echo $caracteres_home; ?></span> caracteres
</div>
</div>                    
 
                    
<div class="form-group">
<label class="col-lg-2 control-label">H1 - Título</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="h1_titulo" id="h1_titulo" placeholder="H1 - Título" value="<?php echo $h1_titulo?>">
</div>
</div>                                      

<div class="form-group">
<label class="col-lg-2 control-label">Conteúdo Conversão</label>
<div class="col-lg-9">
<textarea class="form-control" placeholder="Conteúdo Conversão" rows="12" id="txt_conversao" name="txt_conversao" onkeyup="$('#conversao_caracteres').html($('#txt_conversao').val().length)"><?php echo $txt_conversao?></textarea><span id="conversao_caracteres"><?php echo $caracteres_conversao; ?></span> caracteres
</div>
</div>                                                                                                                                       
                                                                             
<div class="form-group">
<label class="col-lg-2 control-label">H2 - Subtítulo</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="h2_subtitulo" id="h2_subtitulo" placeholder="Chamada Serviços" value="<?php echo $h2_subtitulo?>">
</div>
</div>  
 
<div class="form-group">
<label class="col-lg-2 control-label">Chamada Serviços</label>
<div class="col-lg-9">
<textarea class="form-control" placeholder="Chamada Serviços" rows="3" id="txt_chamada_servicos" name="txt_chamada_servicos" onkeyup="$('#chamada_caracteres').html($('#txt_chamada_servicos').val().length)"><?php echo $txt_chamada_servicos?></textarea><span id="chamada_caracteres"><?php echo $caracteres_chamada; ?></span> caracteres
</div>
</div> 
                                                                                                                                                                                                                                                                                      
 <div class="form-group">
<label class="col-lg-2 control-label">H4 - Subtítulo</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="h4_subtitulo" id="h4_subtitulo" placeholder="Por que Contratar" value="<?php echo $h4_subtitulo?>">
</div>
</div>                                                                                                          
 
<div class="form-group">
<label class="col-lg-2 control-label">Porque Contratar</label>
<div class="col-lg-9">
<textarea class="form-control" placeholder="Porque Contratar" rows="19" id="txt_mtv_contratar" name="txt_mtv_contratar" onkeyup="$('#contratar_caracteres').html($('#txt_mtv_contratar').val().length)"><?php echo $txt_mtv_contratar?></textarea><span id="contratar_caracteres"><?php echo $caracteres_contratar; ?></span> caracteres
</div>
</div>                                                                                                                                                                                                                                      
 <div class="form-group">
<label class="col-lg-2 control-label">H5 - Subtítulo</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="h5_subtitulo" id="h5_subtitulo" placeholder="Chamada Blog" value="<?php echo $h5_subtitulo?>">
</div>
</div>                                                                                                                     
<div class="form-group">
<label class="col-lg-2 control-label">Chamada Blog</label>
<div class="col-lg-9">
<textarea class="form-control" placeholder="Chamada Blog" rows="3" id="txt_chamada_blog" name="txt_chamada_blog" onkeyup="$('#blog_caracteres').html($('#txt_chamada_blog').val().length)"><?php echo $txt_chamada_blog?></textarea><span id="blog_caracteres"><?php echo $caracteres_blog; ?></span> caracteres
</div>
</div> 

 <div class="form-group">
<label class="col-lg-2 control-label">H5 - Subtítulo Oculto</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="5_subtitulo_info" id="5_subtitulo_info" placeholder="H5 Conteúdo Oculto" value="<?php echo $h5_subtitulo_info?>">
</div>
</div>                   
                                    
 <div class="form-group">
<label class="col-lg-2 control-label">Conteúdo Oculto</label>
<div class="col-lg-9">
<textarea class="form-control" placeholder="Conteúdo Oculto" rows="12" id="txt_info_diversas" name="txt_info_diversas" onkeyup="$('#oculto_caracteres').html($('#txt_info_diversas').val().length)"><?php echo $txt_info_diversas?></textarea><span id="oculto_caracteres"><?php echo $caracteres_oculto; ?></span> caracteres
</div>
</div>                                                                        
                                                                                                                                                      
                                                                                                                                                                                               
                    
<div class="form-group alert alert-success">
<label class="col-lg-8 control-label" style="text-align:left;">QUEM SOMOS FOOTER</label>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Resumo Home</label>
<div class="col-lg-5">
<textarea class="form-control" placeholder="Description" rows="10" id="res_about_home" name="res_about_home" onkeyup="$('#about_home_caracteres').html($('#res_about_home').val().length)"><?php echo $res_about_home?></textarea><span id="about_home_caracteres"><?php echo $caracteres_about_home; ?></span> caracteres
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Resumo Internas</label>
<div class="col-lg-5">
<textarea class="form-control" placeholder="Description" rows="10" id="res_about_internas" name="res_about_internas" onkeyup="$('#res_home_caracteres').html($('#res_about_internas').val().length)"><?php echo $res_about_internas?></textarea><span id="res_home_caracteres"><?php echo $caracteres_res_home; ?></span> caracteres
</div>
</div>                
                                        
                    
<div class="form-group alert alert-info">
<label class="col-lg-8 control-label" style="text-align:left;">ORÇAMENTO</label>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Título Orçamento</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="orcamento_title" id="orcamento_title" placeholder="Title" value="<?php echo $orcamento_title?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Desc. Orçamento</label>
<div class="col-lg-5">
<textarea class="form-control" placeholder="Description" rows="4" id="orcamento_description" name="orcamento_description" onkeyup="$('#orcamento_caracteres').html($('#orcamento_description').val().length)"><?php echo $orcamento_description?></textarea><span id="orcamento_caracteres"><?php echo $caracteres_orcamento; ?></span> caracteres
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Texto Introdução Orçamento</label>
<div class="col-lg-5">
<textarea class="form-control" placeholder="Texto Introdução Orçamento" rows="12" id="texto_orcamento" name="texto_orcamento" onkeyup="$('#res_orcamento_caracteres').html($('#texto_orcamento').val().length)"><?php echo $texto_orcamento?></textarea><span id="res_orcamento_caracteres"><?php echo $caracteres_res_orcamento; ?></span> caracteres
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Contato Sucesso</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="contato_sucesso_title" id="contato_sucesso_title" placeholder="Title" value="<?php echo $contato_sucesso_title?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Desc. Sucesso</label>
<div class="col-lg-5">
<textarea class="form-control" placeholder="Description" rows="4" id="contato_description" name="contato_description" onkeyup="$('#contato_caracteres').html($('#contato_description').val().length)"><?php echo $contato_description?></textarea><span id="contato_caracteres"><?php echo $caracteres_contato; ?></span> caracteres
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Texto Mensagem Recebida</label>
<div class="col-lg-5">
<textarea class="form-control" placeholder="Texto Mensagem Recebida" rows="12" id="texto_msg_recebida" name="texto_msg_recebida" onkeyup="$('#res_msg_caracteres').html($('#texto_msg_recebida').val().length)"><?php echo $texto_msg_recebida?></textarea><span id="res_msg_caracteres"><?php echo $caracteres_res_msg; ?></span> caracteres
</div>
</div>                
                   
                   
<div class="form-group alert alert-success">
<label class="col-lg-8 control-label" style="text-align:left;">CONFIG REDES SOCIAIS</label>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Twitter Site</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="twitter_site" id="twitter_site" placeholder="Twitter Site" value="<?php echo $twitter_site?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Twitter Site</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="twitter_creator" id="twitter_creator" placeholder="Twitter Creator" value="<?php echo $twitter_creator?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Facebook Admins</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="fb_admins" id="fb_admins" placeholder="Facebook Admins" value="<?php echo $fb_admins?>">
</div>
</div>
                    
                    
                    
                    
<div class="form-group alert alert-warning">
<label class="col-lg-8 control-label" style="text-align:left;">REDES SOCIAIS</label>
</div>
                    
                    
<div class="form-group">
<label class="col-lg-2 control-label">Facebook</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_facebook" id="social_facebook" placeholder="Facebook" value="<?php echo $social_facebook?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Linkedin</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_linkedin" id="social_linkedin" placeholder="Linkedin" value="<?php echo $social_linkedin?>">
</div>

</div>
<div class="form-group">
<label class="col-lg-2 control-label">Twitter</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_twitter" id="social_twitter" placeholder="Twitter" value="<?php echo $social_twitter?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Youtube</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_youtube" id="social_youtube" placeholder="Youtube" value="<?php echo $social_youtube?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Instagram</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_instagram" id="social_instagram" placeholder="Instagram" value="<?php echo $social_instagram?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Pinterest</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_pinterest" id="social_pinterest" placeholder="Pinterest" value="<?php echo $social_pinterest?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">VK</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_vk" id="social_vk" placeholder="VK" value="<?php echo $social_vk?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Vimeo</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_vimeo" id="social_vimeo" placeholder="Vimeo" value="<?php echo $social_vimeo?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Flickr</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_flickr" id="social_flickr" placeholder="Flickr" value="<?php echo $social_flickr?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Tumblr</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_tumblr" id="social_tumblr" placeholder="Tumblr" value="<?php echo $social_tumblr?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Blogger</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_blogger" id="social_blogger" placeholder="Blogger" value="<?php echo $social_blogger?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Quora</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_quora" id="social_quora" placeholder="Quora" value="<?php echo $social_quora?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Reddit</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_reddit" id="social_reddit" placeholder="Reddit" value="<?php echo $social_reddit?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">WordPress</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_wordpress" id="social_wordpress" placeholder="WordPress" value="<?php echo $social_wordpress?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Foursquare</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_foursquare" id="social_foursquare" placeholder="Foursquare" value="<?php echo $social_foursquare?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">AboutMe</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_about" id="social_about" placeholder="AboutMe" value="<?php echo $social_about?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">Medium</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_medium" id="social_medium" placeholder="Medium" value="<?php echo $social_medium?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">GMB</label>
<div class="col-lg-5">
<input type="text" class="form-control" name="social_gbm" id="social_gbm" placeholder="GMB" value="<?php echo $social_gbm?>">
</div>
</div>                   
                    
      
                  
<div id="bloco" ></div>

<div class="form-group">

<div class="col-lg-offset-2 col-lg-6">

<button type="button" data-toggle="modal" href="#myModal" onClick="gravarFormulario();" class="btn btn-sm btn-primary">Salvar</button>

<button type="button" class="btn btn-sm btn-danger" onClick="voltar();">Cancelar</button>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</form>


<!-- Matter ends -->
</div>
</div>

  <?php include("../includes/footer.php"); ?>
<!-- Footer -->
<!-- Scroll to top -->

<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 
<!-- JS -->

<?php include("../includes/js.php"); ?>
<?php include("../includes/modal.php"); ?>
<!-- Script for this page -->

<?php if($alterado){?>

<script>

  noty({text: 'Alterações efetuadas com sucesso!',layout:'bottom',type:'success',timeout:2000});

</script>

<?php } ?>


<script>

  $.fn.carregarBloco = function(id) {

  $.ajax({

  url: "loop-bloco.php",

  data: {id:id},

  type: "post",

  async: false,

  error: function(){

    alert("há um erro com AJAX");

  }

  }).done(function( html ) {

    $("#bloco").append( html );

  });

}

<?php for($r=0; $r < count($objB); $r++){ ?>

  $(document).carregarBloco('<?php echo $objB[$r]->id_bloco;?>');

<?php } ?>

</script>

</body>

</html>