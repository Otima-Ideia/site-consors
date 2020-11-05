<?php require_once("../includes/config.php"); ?>
<?php 
 
  // --- Controle de acesso -----------------------------------------------------------------

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
  }
  
  if($_SESSION["user_departamento"] != 1){
  	  echo("<script>window.location='../usuarios/formulario-usuario.php';</script>");
  }
  
  // ----------------------------------------------------------------------------------------
  
  // --- CONFIG ---------------------------------------------------------------

	$table = "tab_usuario";
	$titulo_pagina = "Usuários";
	$botao = true;
	$exportacao = true;

    $array = array(
  				 array("", "id_usuario", ""), 
  				 array("Código", "id_usuario", ""),
				 array("Usuário", "nm_usuario", ""),
				 array("Login", "nm_login", ""),
				 array("Status", "cd_status", "getStatus")
				 );
				 
	$arrayExport = array(
			     array("Codigo", "id_usuario", ""),
				 array("Usu&aacute;rio", "nm_usuario"),
				 array("Senha", "nm_senha", ""),
				 array("Login", "nm_login", ""),
				 array("Status", "cd_status", "getStatus")
				 );

  // --------------------------------------------------------------------------

  
  // --- CONEXÃO --------------------------------------------------------------
  
  require_once("../../classes/class.inc");

  $objArray = new classArray($table);
  $Objs = new dao($objArray);
  $Objs->link = Connector::getDefaultLink(); 
  
  if($_POST["excluir"]){
    $Objs->delete($_POST["excluir"]+0);	
  }
  
  if($exportacao)
    $_SESSION["arrayExport"] = $Objs->setExport($arrayExport);  

  $Objs->openUsuarios();
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