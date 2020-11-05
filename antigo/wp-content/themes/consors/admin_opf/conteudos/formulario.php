<?php require_once("../includes/config.php"); ?>
<?php

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
	  die();
  }
  
  // --- CONFIG --------------------------------------------------------
  
  $table = "tab_conteudo";
  $titulo_pagina = "Conteúdo";
  $acao = "Inserir";
  $alterado = false;
  
  // -------------------------------------------------------------------
  
  require_once("../../classes/class.inc");
  
  if($_REQUEST["i"]){
    if($_REQUEST["i"] != "novo")
      $_REQUEST["codigo"] = $_REQUEST["i"];
    
    $_SESSION["id_grupo_admin"] = $_REQUEST["g"];
    $_SESSION["modelo"] = "D";
  }

  $codigo = $_REQUEST["codigo"];

  $objArray = new classArray($table);
  $Objs = new dao($objArray);
  $Obj = new dto($objArray->getArray());
  
  $Objs->link = Connector::getDefaultLink();

  if($_POST['operacao']){
	  
    foreach($_POST as $name=>$value){
	  $Obj->$name = $value;
	}
	  
    $Obj->id_grupo = $_SESSION["id_grupo_admin"];

	$Obj->dt_cadastro = Functions::formatMySql($Obj->dt_cadastro);
	
	if(!$Obj->nm_slug){
    $urlPagina = Functions::permalink(utf8_decode($Obj->nm_conteudo));
  }else{
    $urlPagina = Functions::permalink(utf8_decode($Obj->nm_slug));  
  }

	$Obj->nm_slug = $urlPagina;

  	if(!$codigo){

      $Obj->dt_inclusao = date("Y-m-d H:i:s");
      $Obj->dt_alteracao = date("Y-m-d H:i:s");

		  $codigo = $Objs->insert($Obj);
	
		  $Objs->insertURL($urlPagina, $table, $codigo);

  	}else{

      $Obj->dt_alteracao = date("Y-m-d H:i:s");
		
		  $Objs->update($Obj);

		  $Objs->updateURL($urlPagina, $table, $codigo);

  	}
		
	
	// MULTIPLAS FOTOS ---------------------------------------


	$objArray = new classArray("tab_conteudo_fotos");

	$Objs = new dao($objArray);

	$Obj = new dto($objArray->getArray());

	$Objs->link = Connector::getDefaultLink();

	

	for( $i = 0; $i < count($_POST['id']); $i++ ) {

		$Obj->id = "";

		$Obj->id_conteudo = $codigo;

    $Obj->nm_foto = $_POST['nm_foto'][$i];
		$Obj->nm_miniatura = $_POST['nm_miniatura'][$i];
		
		$Obj->nm_legenda = $_POST['nm_legenda'][$i];
		
		
		if($_POST['id'][$i] == 0){

		  $Objs->insert($Obj);

		}else{

		  $Obj->id = $_POST['id'][$i];

		  $Objs->update($Obj);

		}



	}
	
	
	$lista = explode("|", $_POST['ids']);

	

	for( $i = 0; $i < count($lista); $i++ ) {

		if($_POST['ids'][$i]){

		  $Objs->delete($lista[$i]);

		}



	}
	
    $alterado = true;


	  if($_SESSION["modelo"] == "L"){
      Functions::goPage('index.php');
      die();  
    }	
  
  }
  
  if($codigo){

    $objArray = new classArray($table);
    $Objs = new dao($objArray);
    $Obj = new dto($objArray->getArray());
  
    $Objs->link = Connector::getDefaultLink();
    $acao = "Alterar";

    $Obj = $Objs->locate($codigo+0);
  
    foreach($Obj->ttoString($objArray) as $array=>$campos){
      $variavel = $campos[0];
      $$variavel = $campos[1];
    }

	  $dt_cadastro = Functions::formatHtml($dt_cadastro);
	
  	$objFotos = dao::execute("tab_conteudo_fotos", "openAjax", " WHERE id_conteudo='" . $codigo . "'");

    $caracteres = strlen($nm_description);

  }
  
  $objCo = dao::execute("tab_conteudo", "openAjax", " order by nm_conteudo");
  //$objA = dao::execute("tab_autor", "openAjax", " order by nm_autor");
  
?>

<?php include("../includes/inicio.php");?>


<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" type="text/css" href="../../shadowbox/shadowbox.css">

<script src="../../shadowbox/shadowbox.js" language="javascript" type="text/javascript"></script>

<script type="text/javascript">
  Shadowbox.init();
</script>

<?php include("../includes/head.php"); ?>

<!-- TinyMCE -->
<script src="../tinymce/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
    selector: "#tx_descricao",
    entity_encoding : "raw",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste textcolor"
    ],

	convert_urls: true,

	language: 'pt_BR',

toolbar1: "insertfile undo redo | styleselect fontselect fontsizeselect | bold italic underline | forecolor backcolor",
toolbar2: "alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",

	height: 400,
	width: 800,

  relative_urls : true,
	document_base_url : "../../",

	statusbar: false,

    file_browser_callback: function(field_name, url, type, win) {

		my_field = win.document.getElementById(field_name);

		Shadowbox.open({
        content:    '../tinymce/upload/index.php',
        player:     "iframe",
        title:      "Upload",
        height:     600,
	    width:      1024
    });

    }

});
</script>
<!-- TinyMCE -->

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
        </h2>


        <!-- Breadcrumb -->
        <div class="bread-crumb pull-right">
          <a href="index.html"><i class="fa fa-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current"><?php echo $titulo_pagina;?></a>
        </div>

        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->
        
      <form class="form-horizontal" role="form" action="" name="formulario" id="formulario" method="post">
        <input name="codigo" value="<?php echo $_REQUEST["codigo"];?>" type="hidden">
        <input name="dt_inclusao" value="<?php echo $dt_inclusao;?>" type="hidden">

        <input type="hidden" name="operacao" value="true">
		    <input type="hidden" name="ids" id="ids" value="">

	    <div class="matter">
        <div class="container">

          <div class="row">

            <div class="col-md-12">


              <div class="widget wgreen">
              
                <div class="widget-head">
                  <div class="pull-left">
                    <div style="float:left;">Ativo: &nbsp;</div>
		          	  <div class="sw-green" style="float:left;padding-right:50px">
                    	<input type="checkbox" class="toggleBtn" name="cd_status" <?php if($cd_status == 1 || $cd_status == ""){echo "checked";}?> value="1" />
                      </div>
                    </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <div class="form-group">

                    <label class="col-lg-2 control-label">Código</label>
                
                    <div class="col-lg-5">
                
                      <input type="text" class="form-control" name="id_conteudo" placeholder="Código" readonly value="<?php echo $id_conteudo?>">
                        
                    </div>
                
                 </div>
                 
                 <?php /* 
                    <div class="pull-left">
                    <div style="float:left;"><label class="col-lg-2 control-label">Autor</label></div>
                    <div class="sw-red" style="float:left;">
                      <select class="form-control" name="id_autor" id="id_autor">
                        <option value="">Autor </option>
                        <?php for($i=0; $i < count($objA); $i++){?>
                          <option value="<?php echo $objA[$i]->id_autor;?>" <?php if($id_autor == $objA[$i]->id_autor){echo "selected='selected'";}?>><?php echo $objA[$i]->nm_autor;?></option>
                        <?php } ?>
                        </select>                
                    </div>
                    
                  </div>
                  */ ?>


                    <div class="form-group alert alert-info">
                      <label class="col-lg-2 control-label">Título</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control validate[required]" name="nm_conteudo" placeholder="Título" value="<?php echo $nm_conteudo?>">
                      </div>
                    </div>
                    
                    <div class="form-group alert">
                      <label class="col-lg-2 control-label">Slug</label>
                      <div class="col-lg-5" style="width: 600px">
                        <input type="text" class="form-control" name="nm_slug" placeholder="Slug" value="<?php echo $nm_slug?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Chamada</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_chamada" placeholder="Chamada" value="<?php echo $nm_chamada?>">
                      </div>

                    </div>
                    
                    
                   
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">isPartOf - URL</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_linkagem" placeholder="isPartOf - URL (Uso para Blogs)" value="<?php echo $nm_linkagem?>">
                      </div>

                    </div>                    
 
                    
                    
                    
                    <div class="form-group alert alert-warning">
                      <label class="col-lg-2 control-label">Description</label>
                      <div class="col-lg-7">
                        <textarea class="form-control" placeholder="Description" rows="5" id="nm_description" name="nm_description" onkeyup="$('#caracteres').html($('#nm_description').val().length);"><?php echo $nm_description?></textarea><span id="caracteres"><?php echo $caracteres; ?></span> caracteres
                      </div>
                    </div>
                    
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Resumo</label>
                      <div class="col-lg-5">
                        <textarea class="form-control" placeholder="Resumo" rows="5" style="width:800px" id="nm_resumo" name="nm_resumo"><?php echo $nm_resumo?></textarea>
                      </div>
                    </div>
                     
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Json Principal</label>
                      <div class="col-lg-5">
                        <div class="sw-red" style="float:left;">
                          <input type="checkbox" class="toggleBtn" name="cd_json" <?php if($cd_json == 1 || $cd_json == ""){echo "checked";}?> value="1" />
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Json Adicional</label>
                      <div class="col-lg-5">
                        <textarea class="form-control" placeholder="Json" rows="5" style="width:800px" id="tx_json" name="tx_json"><?php echo $tx_json?></textarea>
                      </div>
                    </div>
                    
                    
                   
					         <div class="form-group">
                      <label class="col-lg-2 control-label">Descrição</label>
                      <div class="col-lg-5">
                        <textarea name="tx_descricao" id="tx_descricao" class="form-control" placeholder="Descrição"><?php echo $tx_descricao;?></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Imagem de capa</label>
                      <div class="col-lg-5" style="width:536px">
                        <input type="text" class="form-control" name="nm_capa" id="nm_capa" placeholder="Imagem de capa" value="<?php echo $nm_capa?>">
                      </div>
                      <a href="../tinymce/upload/index.php" rel="shadowbox[Mixed<?php echo rand();?>];width=1024;height=600" onClick="setMyField('nm_capa');"><img src="../img/icons/file_add.png" title="Adicionar Imagem" class="add ui-corner-left" border="0" height="30" /></a>                      
                    <span class="" style="color:#F00; font-size:16px;">&nbsp;(Width: 1000px | Height: 250px)</span>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Legenda Imagem</label>
                      <div class="col-lg-5" style="width:536px">
                        <input type="text" class="form-control" name="nm_legenda_capa" id="nm_legenda_capa" placeholder="Legenda" value="<?php echo $nm_legenda_capa?>">
                      </div>
                    </div>
                    
		          <div class="form-group">
                      <label class="col-lg-2 control-label">Imagem Rede Social</label>
                      <div class="col-lg-5" style="width:536px">
                        <input type="text" class="form-control" name="nm_imagem_rede_social" id="nm_imagem_rede_social" placeholder="Imagem Rede Social" value="<?php echo $nm_imagem_rede_social?>">
                      </div>
                      <a href="../tinymce/upload/index.php" rel="shadowbox[Mixed<?php echo rand();?>];width=1024;height=600" onClick="setMyField('nm_imagem_rede_social');"><img src="../img/icons/file_add.png" title="Adicionar Imagem" class="add ui-corner-left" border="0" height="30" /></a>                      
                    <span class="" style="color:#F00; font-size:16px;">&nbsp;(Width: 520px | Height: 272px)</span>
                    </div>
                    



                    </div>

                    <div id="DivFotos"></div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Data</label>
                      <div id="datetimepicker1" class="input-append input-group dtpicker" style="padding-left:15px">
                        <input data-format="dd/MM/yyyy" type="text" class="form-control" value="<?php echo $dt_cadastro?>" name="dt_cadastro">
                        <span class="input-group-addon add-on">
                          <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                        </span>
                      </div>
                    </div>
                    
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

<!-- Footer -->
  <?php include("../includes/footer.php"); ?>

<!-- JS -->
<?php include("../includes/js.php"); ?>

<?php include("../includes/modal.php"); ?>

<script>

$.fn.carregarFotos = function(id_tabela) {

	$.ajax({

	url: "loop-fotos.php",

	data: {id:id_tabela},

	type: "post",

	async: false,

	error: function(){

		alert("há um erro com AJAX");

	}

	}).done(function( html ) {

		$("#DivFotos").append( html );

	});

	

}


<?php for($f=0; $f < count($objFotos); $f++){ ?>

  $(document).carregarFotos('<?php echo $objFotos[$f]->id;?>');

<?php } ?>

function carregaCidade(uf){

$.ajax({
	url: 'carrega-cidades.php',
	dataType: 'html',
	type: 'POST',
	async: false,
	data: {uf:uf},
	success: function(data, textStatus) {
		$("#id_cidade").html(data);
		if(uf == "SP")
		  $("#id_cidade").val(9422);
		if(uf == "RJ")
		  $("#id_cidade").val(6861);
	},

	error: function(xhr,er) {
		$('#mensagem').html('Erro!');
	}
});
}
</script>

<?php if($alterado){?>
<script>
  noty({text: 'Alterações efetuadas com sucesso!',layout:'bottom',type:'success',timeout:2000});
</script>
<?php } ?>

</body>
</html>