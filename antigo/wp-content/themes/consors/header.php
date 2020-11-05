<?php
//print_r($_SERVER);die; 
//error_reporting(E_ALL); ini_set('display_errors', '1');
include("classes/class.inc"); 
// ---------------------------------------------------------------------------------------
    // CONFIG -------------------------------------------------------------------------------- 
	  $nome_site = Connector::getAllName("tab_config", "nm_valor", "nm_config='nome_empresa'");;
	  $paginas = array('contato-sucesso', 'orcamento', 'contato', 'duvidas', 'consors-compra-e-venda-de-consorcio', 'entre-em-contato', 'sendvender', 'sendmail', 'mensagem-recebida', 'sitemap', 'confirmacao-envio-cota', 'seo-local');
	  $paginas = array('contato-sucesso', 'orcamento', 'contato', 'duvidas','vender-consorcio', 'consors-compra-e-venda-de-consorcio', 'entre-em-contato', 'sendvender', 'sendvender2', 'venda', 'sendmail', 'mensagem-recebida', 'sitemap', 'confirmacao-envio-cota', 'seo-local', 'comprar-consorcio', 'compro-consorcio', 'compra-de-consorcio', 'venda-de-consorcio', 'como-vender-consorcio', 'vender-consorcio', 'depoimentos', 'compramos-consorcio', 'quero-vender-meu-consorcio');

	  $id_conteudo_quem_somos = Connector::getAllName("tab_home", "nm_valor", "nm_config='home_quem_somos'");
	  $id_grupo_clientes = Connector::getAllName("tab_home", "nm_valor", "nm_config='home_clientes'");
	  $id_grupo_servicos = Connector::getAllName("tab_home", "nm_valor", "nm_config='home_servicos'");
	  $id_grupo_noticias = Connector::getAllName("tab_home", "nm_valor", "nm_config='home_noticias'");

	  $registro_pagina = 8;

    // ---------------------------------------------------------------------------------------

	// ---CONFIGS ----------------------------------------------------------------------------

	  $obj = dao::execute("tab_config", "openAjax");
	  $array_campos = array(); $i=0;
	  
	  foreach($obj as $campos=>$valor){
	    array_push($array_campos, $valor->nm_config);
	    $array_campos[$i] = $obj[$i]->nm_valor;

	  	$variavel = $valor->nm_config;
    	$variavel = $obj[$i]->nm_valor;
	    $i++;
	  }
	  
	  // ALTERAÇÃO DE CARACTERES PARA DESCRIPTION ---------------------------------------

	  $home_description_rede_social = str_replace("*", "", $home_description);
	  $home_description = str_replace("*", "✅", $home_description);

	  $contato_description_rede_social = str_replace("*", "", $contato_description);
	  $contato_description = str_replace("*", "✅", $contato_description);

	  $orcamento_description_rede_social = str_replace("*", "", $orcamento_description);
	  $orcamento_description = str_replace("*", "✅", $orcamento_description);

	  // --------------------------------------------------------------------------------

	  $nm_resumo_quem_somos = Connector::getAllName("tab_conteudo", "nm_resumo", "id_conteudo='" . $id_conteudo_quem_somos . "'");

	// ---------------------------------------------------------------------------------------

	// GRUPOS E FAQ ----------------------------------------------------------------------

	  $objGrupo = dao::execute("tab_grupo", "openAjax", " order by dt_grupo");
	  $objGrupoUrl = dao::execute("tab_url", "openAjax", " WHERE nm_tabela='tab_grupo'");
	  $objFaqUrl = dao::execute("tab_url", "openAjax", " WHERE nm_tabela='tab_faq'");
	  $objAbrangencia = dao::execute("tab_abrangencia", "openAjax", " ORDER BY nm_abrangencia");

	  for($arr=0; $arr < count($objGrupo); $arr++){
		if($objGrupo[$arr]->nm_pagina_fixa){ array_push($paginas, $objGrupo[$arr]->nm_pagina_fixa); }
	    $array_grupos_nome[$objGrupo[$arr]->id_grupo] = $objGrupo[$arr]->nm_grupo;
	  }

	  for($arr=0; $arr < count($objGrupoUrl); $arr++){
	    $array_grupos_url[$objGrupoUrl[$arr]->id_tabela] = HTTP_HOST . $objGrupoUrl[$arr]->nm_url;
	  }

	  for($arr=0; $arr < count($objFaqUrl); $arr++){
	    $array_faq_url[$objFaqUrl[$arr]->id_tabela] = HTTP_HOST . $objFaqUrl[$arr]->nm_url;
	  }

	  $objConteudoUrl = dao::execute("tab_url", "openAjax", " WHERE nm_tabela='tab_conteudo'");

	  for($arr=0; $arr < count($objConteudoUrl); $arr++){
	    $array_conteudos_url[$objConteudoUrl[$arr]->id_tabela] = HTTP_HOST . $objConteudoUrl[$arr]->nm_url;
	  }

	// ---------------------------------------------------------------------------------------


	$url_cod = (isset($_REQUEST['cod'])) ? $_REQUEST['cod'] : '';
	$lista_url = explode('/', $url_cod);

	$url_base = $lista_url[count($lista_url)-1];

	$url_atual = HTTP_HOST . $url_base;
	$pagina_atual = $url_base;

	$id_conteudo_clientes = Connector::getAllName("tab_conteudo", "id_conteudo", "id_grupo='$id_grupo_clientes'");
  	$objCli = dao::execute("tab_conteudo_fotos", "openAjax", " WHERE id_conteudo='$id_conteudo_clientes'");

  	$objS = dao::execute("tab_conteudo", "openAjax", " WHERE id_grupo='$id_grupo_servicos' and cd_status='1' order by dt_cadastro desc limit 6");
  	
  	$objComboS = dao::execute("tab_servico_dominio", "openAjax", " ORDER BY nm_servico");

	if($url_base){

		$id_url = Connector::getAllName("tab_url", "id_url", "nm_url='" . $url_cod . "'");
		$tab_consulta = Connector::getAllName("tab_url", "nm_tabela", "id_url='" . $id_url . "'");
		$codigo = Connector::getAllName("tab_url", "id_tabela", "id_url='" . $id_url . "'");
				
		if($tab_consulta == "tab_grupo" && $codigo){
	
		  if($tab_consulta == "tab_grupo"){
		    $objArray = new classArray("tab_conteudo");
			$objs = new dao($objArray);
			$objs->link = Connector::getDefaultLink();

			$objs->pageSize = $registro_pagina;

		    $objs->openAjax("tab_conteudo", " WHERE id_grupo='".$codigo."' and cd_status='1' order by dt_cadastro desc");

			$total_paginas = $objs->pageCount;

			$paginacao = $_REQUEST["paginacao"];

			if(!$paginacao) $paginacao = 1;

			$obj = $objs->gotoPage($paginacao);
			
			$total_registros = count($obj);



		    $objG = dao::execute("tab_grupo", "openAjax", " WHERE id_grupo='".$codigo."'");

			//$titulo_pagina = $array_grupos_nome[$codigo];
			//$modelo = Connector::getAllName("tab_grupo", "cd_modelo", "id_grupo='" . $codigo . "'");
			
			$titulo_pagina = $objG[0]->nm_grupo;
			$modelo = $objG[0]->cd_modelo;
			$nm_chamada = $objG[0]->nm_chamada;
			$cd_json = $objG[0]->cd_json;
			$tx_json = $objG[0]->tx_json;
			$tx_descricao = $objG[0]->tx_descricao;
			$nm_linkagem = $objG[0]->nm_linkagem;

			$nm_description = str_replace("*", "✅", $objG[0]->nm_description);
		    $nm_description_rede_social = str_replace("*", "", $objG[0]->nm_description);

			$nm_imagem_rede_social = HTTP_HOST . $objG[0]->nm_imagem_rede_social;
			$nm_legenda_capa = HTTP_HOST . $objG[0]->nm_legenda_capa;
			$nm_legenda = HTTP_HOST . $objG[0]->nm_legenda;
		  }
		
			
		  include_once "lista.php";

		}elseif($tab_consulta == "tab_seo_local"){

		  $objArray = new classArray("tab_seo_local");
		  $Objs = new dao($objArray);
		  $Obj = new dto($objArray->getArray());
		  
		  $Objs->link = Connector::getDefaultLink();

		    $obj = $Objs->openLandingPage($codigo);

		    $id_bairro = $obj[0]->id_bairro;
		    $id_servico = $obj[0]->id_servico;

		    $nm_conteudo = $obj[0]->nm_conteudo;

		    $nm_description = str_replace("*", "✅", $obj[0]->nm_description);
		    $nm_description_rede_social = str_replace("*", "", $obj[0]->nm_description);

		    $nm_resumo_servico = $obj[0]->nm_resumo_servico;
		    $nm_resumo_trabalho = $obj[0]->nm_resumo_trabalho;
		    $nm_slug = HTTP_HOST . $obj[0]->nm_slug;
		    $nm_chamada = $obj[0]->nm_chamada;
		    $nm_capa = HTTP_HOST . $obj[0]->nm_capa;
		    $nm_legenda_capa = $obj[0]->nm_legenda_capa;
		    $fl_classe_conteudo = $obj[0]->fl_classe_conteudo;
		    $tx_json = $obj[0]->tx_json;

		    $tx_descricao_seo_local = $obj[0]->tx_descricao_seo_local;
			$nm_imagem_rede_social = HTTP_HOST . $obj[0]->nm_imagem_rede_social;

		    $dt_cadastro = Functions::getFormatData($obj[0]->dt_cadastro);


		    // SERVIÇOS -------------------------------
		      
		      $nm_servico = $obj[0]->nm_servico;
		      $cd_modelo = $obj[0]->cd_modelo;

		      $titulo = $nm_servico;
		      $h1 = $nm_servico;


		    if($nm_chamada){
  			  
  			  $h1 .= " " . $nm_chamada;

  			  $nm_chamada = " " . $nm_chamada;

  			}
  			
  			$titulo .= $nm_chamada . " → ";

		    // BAIRROS -------------------------------
		    
  			if($id_bairro > 0){

		      $nm_bairro = $obj[0]->nm_bairro;
		      $nm_cidade = $obj[0]->nm_cidade;
		      $cd_estado = $obj[0]->cd_estado;
		      $url_hasmap = $obj[0]->url_hasmap;
		      $url_referencia = $obj[0]->url_referencia;
		      $nm_zona = $obj[0]->nm_zona;
		      $id_abrangencia = $obj[0]->id_abrangencia;

		      $titulo .= "【" . $nm_bairro . "】";
		      $h1 .= " " . $nm_bairro;

		      $cd_latitude = $obj[0]->cd_latitude;
		      $cd_longitude = $obj[0]->cd_longitude;

		      $objListaS = $Objs->openServicosBairro($id_bairro);

  			}

			$objF = dao::execute("tab_seo_local_fotos", "openAjax", " WHERE id_seo_local='" . $codigo . "' LIMIT 3");
			$objS = dao::execute("tab_servico", "openAjax", " ORDER by nm_servico");			

		  include_once "sp/modelo-" . $cd_modelo . ".php";

		}elseif($tab_consulta == "tab_conteudo"){
			
		    $obj = dao::execute("tab_conteudo", "openAjax", " WHERE id_conteudo='" . $codigo . "'");

		    $id_grupo = $obj[0]->id_grupo;
		    $nm_conteudo = $obj[0]->nm_conteudo;
		    
		    $nm_description = str_replace("*", "✅", $obj[0]->nm_description);
		    $nm_description_rede_social = str_replace("*", "", $obj[0]->nm_description);

		    $nm_resumo = $obj[0]->nm_resumo;
		    $nm_chamada = $obj[0]->nm_chamada;
		    $nm_capa = HTTP_HOST . $obj[0]->nm_capa;
		    $nm_legenda_capa = $obj[0]->nm_legenda_capa;
		    $nm_additionaltype = $obj[0]->nm_additionaltype;
		    $nm_categoria = $obj[0]->nm_categoria;
			$list_keywords = $obj[0]->list_keywords;
			$nm_linkagem = $obj[0]->nm_linkagem;
		    $cd_json = $obj[0]->cd_json;
		    $tx_json = $obj[0]->tx_json;
		    $tx_descricao = $obj[0]->tx_descricao;
			$nm_imagem_rede_social = HTTP_HOST . $obj[0]->nm_imagem_rede_social;

		    $cd_modelo = Connector::getAllName("tab_grupo", "cd_modelo", "id_grupo='" . $id_grupo . "'");

		    if($cd_modelo == 1){
		      $objR = dao::execute("tab_conteudo", "openAjax", " WHERE id_grupo='" . $id_grupo . "' AND id_conteudo<>'" . $codigo . "' LIMIT 3");
			}

		    $dt_cadastro = Functions::getFormatData($obj[0]->dt_cadastro);

			$dt_inclusao = Functions::getFormatData($obj[0]->dt_inclusao);
		    $dt_alteracao = Functions::getFormatData($obj[0]->dt_alteracao);

		    $dt_cadastro_seo = str_replace(" ", "T", $obj[0]->dt_cadastro) . "+00:00";
		    $dt_inclusao_seo = str_replace(" ", "T", $obj[0]->dt_inclusao) . "+00:00";
		    $dt_alteracao_seo = str_replace(" ", "T", $obj[0]->dt_alteracao) . "+00:00";

		    $nm_grupo = $array_grupos_nome[$id_grupo];		    
		
			
		// URLS ------------------------------------------------------

			  $url_grupo = $array_grupos_url[$id_grupo];
			  $url_conteudo = $array_conteudos_url[$codigo];

		// -----------------------------------------------------------

		// GALERIA DE FOTOS ------------------------------------------

			$nm_galeria1 = $obj[0]->nm_galeria1;
		    $nm_galeria2 = $obj[0]->nm_galeria2;
		    $tx_galeria1 = $obj[0]->tx_galeria1;
		    $tx_galeria2 = $obj[0]->tx_galeria2;
			
			$objF = dao::execute("tab_conteudo_fotos", "openAjax", " WHERE id_conteudo='" . $codigo . "'");

		// -----------------------------------------------------------
			
		  include_once "detalhe.php";

		}elseif($tab_consulta == "tab_faq"){
			
		    $obj = dao::execute("tab_faq", "openAjax", " WHERE id_faq='" . $codigo . "'");

		    $nm_faq = $nm_grupo = $nm_conteudo = $obj[0]->nm_faq;
		    $nm_chamada = $obj[0]->nm_chamada;
		    $nm_autor = $obj[0]->nm_autor;
		    $nm_url_autor = $obj[0]->nm_url_autor;

		    $nm_description = str_replace("*", "✅", $obj[0]->nm_description);
		    $nm_description_rede_social = str_replace("*", "", $obj[0]->nm_description);

		    $nm_imagem = $nm_imagem_rede_social = $nm_capa = HTTP_HOST . $obj[0]->nm_imagem;
		    $nm_legenda = $nm_legenda_capa = $obj[0]->nm_legenda;
		    $cd_json = $obj[0]->cd_json;
		    $tx_json = $obj[0]->tx_json;
		    $tx_faq = $obj[0]->tx_faq;


		    $dt_inclusao = $obj[0]->dt_inclusao;
		    $dt_alteracao = $obj[0]->dt_alteracao;

		    $url_grupo = $array_faq_url[$codigo];

		    $dt_inclusao_seo = str_replace(" ", "T", date('Y-m-d H:i:s',strtotime("-2 day", strtotime($obj[0]->dt_inclusao)))) . "+00:00";

		    $dt_publicacao_seo = str_replace(" ", "T", $obj[0]->dt_inclusao) . "+00:00";
		    $dt_alteracao_seo = str_replace(" ", "T", $obj[0]->dt_alteracao) . "+00:00";

		    $cd_modelo = 3;

		// -----------------------------------------------------------
			
		  include_once "detalhe.php";

		}
	}else{
		
	  $objB = dao::execute("tab_banner", "openAjax", " WHERE cd_status='1' order by dt_banner");
	  $objD = dao::execute("tab_faq", "openAjax", " WHERE cd_status='1' order by dt_faq desc");
	  
	  $objN1 = dao::execute("tab_conteudo", "openAjax", " WHERE id_grupo='$id_grupo_noticias' and cd_status='1' order by dt_cadastro desc limit 3");


	}

?>

<!doctype html>
<html lang="pt-BR">
   <script src="https://www.googleoptimize.com/optimize.js?id=OPT-TNVVTMK"></script>
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128250216-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-128250216-1', { 'optimize_id': 'OPT-TNVVTMK'});
</script>

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
<meta property="og:image" content="https://consors.com.br/images/consors.jpg" />
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
<?php $directory = get_template_directory_uri(); ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PCXPJGW');</script>
<!-- End Google Tag Manager -->




<!--Json LocalBusiness-->
<?php //include("includes/google-analytics.php"); ?>
<?php include("includes/localbusiness.php"); ?>
<?php wp_head();?>
</head>

<body class="home">
    
 <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PCXPJGW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
   
<?php include("includes/header.php"); ?>
<?php include("includes/menu.php"); ?>