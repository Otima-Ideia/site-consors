<?php require_once("../includes/config.php"); ?>
<?php 
 
  // --- Controle de acesso -----------------------------------------------------------------

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
  }
  
  
  // ----------------------------------------------------------------------------------------
  
  // --- CONFIG ---------------------------------------------------------------

    if($_REQUEST["g"]){
	    $_SESSION["id_grupo_admin"] = $_REQUEST["g"];
      $_SESSION["modelo"] = "L";
    }

	$table = "tab_conteudo";
	$titulo_pagina = Connector::getAllName("tab_grupo", "nm_grupo", "id_grupo='" . $_SESSION["id_grupo_admin"] . "'");
	$botao = true;
	$exportacao = false;

    $array = array(
  				 array("", "id_conteudo", ""), 
  				 array("Código", "id_conteudo", ""),
  				 array("Título", "nm_conteudo", ""),
  				 array("Grupo", "id_grupo", "getGrupo"),
  				 array("Data de cadastro", "dt_cadastro", "formatHtml"),
  				 array("Status", "cd_status", "getStatus")
				 );

  // --------------------------------------------------------------------------

  
  // --- CONEXÃO --------------------------------------------------------------
  
  $objArray = new classArray($table);
  $Objs = new dao($objArray);
  $Objs->link = Connector::getDefaultLink(); 
  
  if($_POST["excluir"]){
    $Objs->delete($_POST["excluir"]+0);	
    $sql = "DELETE FROM tab_url WHERE nm_tabela='tab_conteudo' and id_tabela='" . $_POST["excluir"] . "'";
    Connector::executeQuery($sql, Connector::getDefaultLink());
  }
  
  if($exportacao)
    $_SESSION["arrayExport"] = $Objs->setExport($arrayExport);  

  $Objs->openConteudo($_SESSION["id_grupo_admin"]);
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