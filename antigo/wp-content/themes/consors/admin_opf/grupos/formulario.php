<?php require_once("../includes/config.php"); ?>
<?php

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
	  die();
  }
  
  // --- CONFIG --------------------------------------------------------
  
  $table = "tab_grupo";
  $titulo_pagina = "Grupo";
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
	
	$urlPagina = Functions::permalink(utf8_decode($Obj->nm_grupo));
	
	$Obj->dt_grupo = Functions::formatMySql($Obj->dt_grupo);

  	if(!$codigo){
		$codigo = $Objs->insert($Obj);
    
    if($Obj->cd_modelo < 3){
		  $Objs->insertURL($urlPagina, $table, $codigo);
    }

  	}else{
		$Objs->update($Obj);
    
      if($Obj->cd_modelo < 3){
		    $Objs->updateURL($urlPagina, $table, $codigo);
      }
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
	
	  $dt_grupo = Functions::formatHtml($dt_grupo);

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


	    <div class="matter">
        <div class="container">

          <div class="row">

            <div class="col-md-12">


              <div class="widget wgreen">

                <div class="widget-content">
                  <div class="padd">
                        
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Código</label>
                      <div class="col-lg-5" style="width: 280px">
                        <input type="text" class="form-control" name="id_grupo" placeholder="Código" readonly value="<?php echo $id_grupo?>">
                      </div>
                    <div class="pull-left">
                    <div style="float:left;"><label class="col-lg-2 control-label">Data</label></div>
                    <div class="sw-red" style="float:left;">
                    <div id="datetimepicker1" class="input-append input-group dtpicker" style="padding-left:15px">
                    <input data-format="dd/MM/yyyy" type="text" class="form-control" value="<?php echo $dt_grupo;?>" name="dt_grupo">
                    <span class="input-group-addon add-on">
                      <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                    </span>
                    </div>     
                    </div>
                    
                  </div>
                    </div>
                     
                     
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Grupo</label>
                      <div class="col-lg-5" style="width: 280px">
                        <input type="text" class="form-control" name="nm_grupo" placeholder="Grupo" value="<?php echo $nm_grupo?>">
                      </div>
                      <div class="pull-left">
                    <div style="float:left;"><label class="col-lg-2 control-label"  style="width: 170px">Aparece Menu</label></div>
                    <div class="sw-red" style="float:left;">
                      <select name="cd_menu" class="form-control">
                        <option value="S" <?php if($cd_menu == "S"){echo "selected='selected'";}?>> Sim</option>
                        <option value="N" <?php if($cd_menu == "N"){echo "selected='selected'";}?>>Não</option>
                        </select>                    
                      </div>
                    </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Chamada</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_chamada" placeholder="Chamada" value="<?php echo $nm_chamada?>">
                      </div>

                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Description</label>
                      <div class="col-lg-5" style="width:536px">
                        <textarea class="form-control" placeholder="Descrição" rows="5" id="nm_description" name="nm_description" onkeyup="$('#caracteres').html($('#nm_description').val().length);"><?php echo $nm_description?></textarea><span id="caracteres"><?php echo $caracteres; ?></span> caracteres
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
                      <label class="col-lg-2 control-label">Modelo</label>
                      <div class="col-lg-5">
                    <select name="cd_modelo" class="form-control" onchange="divModelo(this.value)">
                        <option value="" <?php if($cd_modelo == ""){echo "selected='selected'";}?>> - Selecione - </option>
                        <option value="1" <?php if($cd_modelo == 1){echo "selected='selected'";}?>>Página de Lista de Notícias</option>
                        <option value="2" <?php if($cd_modelo == 2){echo "selected='selected'";}?>>Página de Lista de Serviços</option>
                        <option value="3" <?php if($cd_modelo == 3){echo "selected='selected'";}?>>Página de Detalhe</option>
                      </select>
                      </div>
                      </div>

                      <div id="div_lista">
                      
                       <div class="form-group">
                      <label class="col-lg-2 control-label">Descrição</label>
                      <div class="col-lg-5" style="width:536px">
                        <textarea class="form-control" placeholder="Descrição" rows="5" id="tx_descricao" name="tx_descricao"><?php echo $tx_descricao?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Miniatura</label>
                      <div class="col-lg-5" style="width:536px">
                        <input type="text" class="form-control" name="nm_imagem" id="nm_imagem" placeholder="Miniatura" value="<?php echo $nm_imagem?>">
                      </div>
                      <a href="../tinymce/upload/index.php" rel="shadowbox[Mixed1];width=1024;height=600" onClick="setMyField('nm_imagem');"><img src="../img/icons/file_add.png" title="Adicionar Imagem" class="add ui-corner-left" border="0" height="30" /></a>                      
                    <span class="" style="color:#F00; font-size:16px;">&nbsp;(dimensão px)</span>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Legenda</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_legenda" placeholder="Legenda" value="<?php echo $nm_legenda?>">
                      </div>

                    </div>
                   
                    
                    <div class="form-group alert alert-info">

                      <label class="col-lg-2 control-label">Redes sociais</label> 

                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Imagem</label>
                      <div class="col-lg-5" style="width:536px">
                        <input type="text" class="form-control" name="nm_imagem_rede_social" id="nm_imagem_rede_social" placeholder="Imagem" value="<?php echo $nm_imagem_rede_social?>">
                      </div>
                      <a href="../tinymce/upload/index.php" rel="shadowbox[Mixed1];width=1024;height=600" onClick="setMyField('nm_imagem_rede_social');"><img src="../img/icons/file_add.png" title="Adicionar Imagem" class="add ui-corner-left" border="0" height="30" /></a>                      
                    <span class="" style="color:#F00; font-size:16px;">&nbsp;(dimensão px)</span>
                    </div>

                    </div>

                    <div id="div_botoes">

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
function divModelo(x){
if(x == ""){
  $("#div_lista").css("display", "none");
  $("#div_botoes").css("display", "none");
}else{
  if(x == "3"){
    $("#div_lista").css("display", "none");
    $("#div_botoes").css("display", "block");
  }else{
    $("#div_lista").css("display", "block");
    $("#div_botoes").css("display", "block");
  }
}
}

divModelo('<?php echo $cd_modelo ?>');
</script>

</body>
</html>