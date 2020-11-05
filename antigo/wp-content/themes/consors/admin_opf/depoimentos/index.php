<?php require_once("../includes/config.php"); ?>
<?php 
 
  // --- Controle de acesso -----------------------------------------------------------------

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
  }
  
  // ----------------------------------------------------------------------------------------
  
  // --- CONFIG ---------------------------------------------------------------

	$table = "tab_depoimento";
	$titulo_pagina = "Depoimentos";
	$botao = true;
	$exportacao = false;

    $array = array(
  				 array("", "id_depoimento", ""), 
  				 array("Código", "id_depoimento", ""),
				 array("Título", "nm_depoimento", ""),
				 array("Data", "dt_depoimento", "formatHtml")
				 );

  // --------------------------------------------------------------------------

  
  // --- CONEXÃO --------------------------------------------------------------
  
  $objArray = new classArray($table);
  $Objs = new dao($objArray);
  $Objs->link = Connector::getDefaultLink(); 
  
  if($_POST["excluir"]){
    $Objs->delete($_POST["excluir"]+0);	
  }
  
  if($exportacao)
    $_SESSION["arrayExport"] = $Objs->setExport($arrayExport);  

  $Objs->open();
  $Obj = $Objs->selectAll();
 
  // --------------------------------------------------------------------------
?>

<?php include("../includes/inicio.php");?>


<!DOCTYPE html>
<html lang="en">
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


    <form id="formulario" name="formulario" method="post" action="formulario.php">
      <input type="hidden" name="codigo" id="codigo" value="">
      <input type="hidden" name="excluir" id="excluir" value="">
    </form>

  	<!-- Grid -->
  	  <?php include("../includes/grid.php"); ?>

</div>


<!-- Footer -->
  <?php include("../includes/footer.php"); ?>

<!-- JS -->
<?php include("../includes/js.php"); ?>

<?php include("../includes/modal.php"); ?>

</body>
</html>