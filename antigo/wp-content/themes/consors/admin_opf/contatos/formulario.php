<?php require_once("../includes/config.php"); ?>
<?php

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
	  die();
  }
  
  // --- CONFIG --------------------------------------------------------
  
  $table = "tab_contato";
  $titulo_pagina = "Contato";
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

	$Obj->nr_telefone = Functions::getOnlyNumbers($Obj->nr_telefone);
	//$Obj->nr_whats = Functions::getOnlyNumbers($Obj->nr_whats);
	$Obj->dt_contato = Functions::formatMySql($Obj->dt_contato);

  	if(!$codigo){
		$Objs->insert($Obj);
  	}else{
		$Objs->update($Obj);
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
	
	$nr_telefone = Functions::mask($nr_telefone, 'tel');
	//$nr_whats = Functions::mask($nr_whats, 'tel');
	$dt_contato = Functions::formatHtml($dt_contato);
  }       
  
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
                        <input type="text" class="form-control" name="id_contato" placeholder="Código" readonly value="<?php echo $id_contato?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Nome</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_nome" placeholder="Nome" value="<?php echo $nm_nome?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Telefone</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nr_telefone" placeholder="nr_telefone" value="<?php echo $nr_telefone?>">
                      </div>
                    </div>
                    <?php /*
                    <div class="form-group">
                      <label class="col-lg-2 control-label">WhatsApp</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nr_whats" placeholder="WhatsApp" value="<?php echo $nr_whats?>">
                      </div>
                    </div>
                    */ ?>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">E-mail</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_email" placeholder="E-mail" value="<?php echo $nm_email?>">
                      </div>
                    </div>
                    <?php /*
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Assunto</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_assunto" placeholder="E-mail" value="<?php echo $nm_assunto?>">
                      </div>
                    </div>
                    */  ?>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Mensagem</label>
                      <div class="col-lg-5">
                        <textarea class="form-control" placeholder="Mensagem" rows="5" id="tx_mensagem" name="tx_mensagem"><?php echo $tx_mensagem?></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Status</label>
                      <div class="col-lg-5">

                      <select name="cd_status" class="form-control">
                        <option value="1" <?php if($cd_status == 1){echo "selected='selected'";}?>>Aguardando contato (Padrão)</option>
                        <option value="2" <?php if($cd_status == 2){echo "selected='selected'";}?>>Atendimento em andamento</option>
                        <option value="3" <?php if($cd_status == 3){echo "selected='selected'";}?>>Atendimento finalizado</option>
                        <option value="4" <?php if($cd_status == 4){echo "selected='selected'";}?>>Não obtivemos retorno</option>
                      </select>

                      </div>
                    </div>    
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Data</label>
                       <div id="datetimepicker1" class="input-append input-group dtpicker" style="padding-left:15px">
						<input data-format="dd/MM/yyyy" type="text" class="form-control" value="<?php echo $dt_contato?>" name="dt_contato">
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