<?php require_once("../includes/config.php"); ?>
<?php

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
	  die();
  }
  
  // --- CONFIG --------------------------------------------------------
  
  $table = "tab_faq";
  $titulo_pagina = "FAQ";
  $acao = "Inserir";
  
  // -------------------------------------------------------------------
  
  require_once("../../classes/class.inc");
  
  $codigo = $_REQUEST["codigo"];

  $objArray = new classArray($table);
  $Objs = new dao($objArray);
  $Obj = new dto($objArray->getArray());
  
  $Objs->link = Connector::getDefaultLink();

  if($_POST['operacao']){

    foreach($_POST as $name=>$value){
	  $Obj->$name = $value;
	}
	
	$Obj->dt_faq = Functions::formatMySql($Obj->dt_faq);

  $urlPagina = Functions::permalink(utf8_decode($Obj->nm_faq));

  	if(!$codigo){

      $Obj->dt_inclusao = date("Y-m-d H:i:s");
      $Obj->dt_alteracao = date("Y-m-d H:i:s");

		  $codigo = $Objs->insert($Obj);
		  $Objs->insertURL($urlPagina, $table, $codigo);
  	}else{

      $Obj->dt_alteracao = date("Y-m-d H:i:s");

		  $Objs->update($Obj);
		  //$Objs->updateURL($urlPagina, $table, $codigo);

  	}
	
	Functions::goPage('index.php');
	die();
  
  }
  
  if($codigo){
	  
    $acao = "Alterar";

    $Obj = $Objs->locate($codigo+0);
  
    foreach($Obj->ttoString($objArray) as $array=>$campos){
      $variavel = $campos[0];
      $$variavel = $campos[1];
	}
	
	  $dt_faq = Functions::formatHtml($dt_faq);

    $caracteres = strlen($nm_description);

  }       
  
?>

<?php include("../includes/inicio.php");?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="../../shadowbox/shadowbox.css">

<script src="../../shadowbox/shadowbox.js" language="javascript" type="text/javascript"></script>

<script type="text/javascript">
  Shadowbox.init();
</script>

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
        <input type="hidden" name="operacao" value="true">
        <input name="dt_inclusao" value="<?php echo $dt_inclusao;?>" type="hidden">

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
                        <input type="text" class="form-control" name="id_faq" placeholder="Código" readonly value="<?php echo $id_faq?>">
                      </div>
                    <div class="pull-left">
                        <div style="float:left;"></div>
                    </div> 
                    </div>
                     
                     
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Título</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control validate[required]" name="nm_faq" placeholder="faq" value="<?php echo $nm_faq?>" <?php if($codigo){echo "readonly";} ?>>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Chamada</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_chamada" placeholder="Chamada" value="<?php echo $nm_chamada?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Autor</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_autor" placeholder="Autor" value="<?php echo $nm_autor?>">
                      </div>

                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">URL Autor</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_url_autor" placeholder="URL Autor" value="<?php echo $nm_url_autor?>">
                      </div>

                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Imagem</label>
                      <div class="col-lg-5" style="width:536px">
                        <input type="text" class="form-control" name="nm_imagem" id="nm_imagem" placeholder="Imagem" value="<?php echo $nm_imagem?>">
                      </div>
                      <a href="../tinymce/upload/index.php" rel="shadowbox[Mixed1];width=1024;height=600" onClick="setMyField('nm_imagem');"><img src="../img/icons/file_add.png" title="Adicionar Imagem" class="add ui-corner-left" border="0" height="30" /></a>                      
                    
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Legenda</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_legenda" placeholder="Legenda" value="<?php echo $nm_legenda?>">
                      </div>

                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Resumo</label>
                      <div class="col-lg-5" style="width:536px">
                        <textarea class="form-control" placeholder="Resumo" rows="5" id="nm_resumo" name="nm_resumo"><?php echo $nm_resumo?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Json</label>
                      <div class="col-lg-5" style="width:536px">
                        <textarea class="form-control" placeholder="Json" rows="5" id="tx_json" name="tx_json"><?php echo $tx_json?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Description</label>
                      <div class="col-lg-5" style="width:536px">
                        <textarea class="form-control" placeholder="Description" rows="5" id="nm_description" name="nm_description" onkeyup="$('#caracteres').html($('#nm_description').val().length);"><?php echo $nm_description?></textarea><span id="caracteres"><?php echo $caracteres; ?></span> caracteres
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label class="col-lg-2 control-label">Descrição</label>
                      <div class="col-lg-5" style="width:536px">
                        <textarea class="form-control" placeholder="Descrição" rows="5" id="tx_faq" name="tx_faq"><?php echo $tx_faq?></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Data</label>
                       <div id="datetimepicker1" class="input-append input-group dtpicker" style="padding-left:15px">
						<input data-format="dd/MM/yyyy" type="text" class="form-control" value="<?php echo $dt_faq;?>" name="dt_faq">
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

</body>
</html>