<?php require_once("../includes/config.php"); ?>
<?php

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
	  die();
  }
  
  // --- CONFIG --------------------------------------------------------
  
  $table = "tab_autor";
  $titulo_pagina = "Autor";
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
	
	$urlPagina = Functions::permalink(utf8_decode($Obj->nm_autor));

  	if(!$codigo){
		
		$codigo = $Objs->insert($Obj);
		
		$Objs->insertURL($urlPagina, $table, $codigo);
		
  	}else{
		
		$Objs->update($Obj);
		
		$Objs->updateURL($urlPagina, $table, $codigo);
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
          <a href="../autor/index.html"><i class="fa fa-home"></i> Home</a> 
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


	    <div class="matter">
        <div class="container">

          <div class="row">

            <div class="col-md-12">


              <div class="widget wgreen">

                <div class="widget-content">
                  <div class="padd">
                        
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Código</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="id_autor" placeholder="Código" readonly value="<?php echo $id_autor?>">
                      </div>
                    <div class="pull-left">
                        <div style="float:left;"></div>
                    </div> 
                    </div>
                     
                     
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Autor</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_autor" placeholder="Autor" value="<?php echo $nm_autor?>">
                      </div>
                      
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Descrição</label>
                      <div class="col-lg-5" style="width:536px">
                        <textarea class="form-control" placeholder="Descrição" rows="5" id="tx_descricao" name="tx_descricao"><?php echo $tx_descricao?></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Imagem Avatar</label>
                      <div class="col-lg-5" style="width:536px">
                        <input type="text" class="form-control" name="nm_imagem_avatar" id="nm_imagem_avatar" placeholder="Imagem Avatar" value="<?php echo $nm_imagem_avatar?>">
                      </div>
                      <a href="../tinymce/upload/index.php" rel="shadowbox[Mixed<?php echo rand();?>];width=1024;height=600" onClick="setMyField('nm_imagem_avatar');"><img src="../img/icons/file_add.png" title="Adicionar Imagem" class="add ui-corner-left" border="0" height="30" /></a>                      
                    <span class="" style="color:#F00; font-size:16px;">&nbsp;(dimensão L: 500 | A: 375 PX)</span>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Imagem Rede Social</label>
                      <div class="col-lg-5" style="width:536px">
                        <input type="text" class="form-control" name="nm_imagem_rede_social" id="nm_imagem_rede_social" placeholder="Imagem Rede Social" value="<?php echo $nm_imagem_rede_social?>">
                      </div>
                      <a href="../tinymce/upload/index.php" rel="shadowbox[Mixed<?php echo rand();?>];width=1024;height=600" onClick="setMyField('nm_imagem_rede_social');"><img src="../img/icons/file_add.png" title="Adicionar Imagem" class="add ui-corner-left" border="0" height="30" /></a>                      
                    <span class="" style="color:#F00; font-size:16px;">&nbsp;(dimensão L: 500 | A: 375 PX)</span>
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