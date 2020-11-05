<?php require_once("../includes/config.php"); ?>
<?php 
 
  // --- Controle de acesso -----------------------------------------------------------------

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
  }
  
  // ----------------------------------------------------------------------------------------
  
  // --- CONFIG ---------------------------------------------------------------

	$table = "tab_newsletter";
	$titulo_pagina = "Newsletters";
	$botao = false;
	$exportacao = true;

    $array = array(
  				 array("", "id_newsletter", ""), 
  				 array("Código", "id_newsletter", ""),
				 array("Nome", "nm_nome", ""),
				 array("E-mail", "nm_email", ""),
				 array("Data", "dt_newsletter", "formatHtml")
				 );
				 
    $arrayExport = array(
					 array("Data", "dt_newsletter", "formatHtml")
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
  	  <div class="mainbar">
  
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left"><i class="fa fa-home"></i> <?php echo $titulo_pagina;?></h2>

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

    <div class="matter">
    
    
    <div class="container">
    
        <div class="widget">
            <div class="widget-head">
              <div class="pull-left">
                <button class="btn btn-primary" onClick="inserir();" <?php if(!$botao){ ?>disabled="disabled"<?php } ?>> Adicionar + </button>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget-content">
              <div class="padd">
                
                <!-- Table Page -->
                <div class="page-tables">
                    <!-- Table -->
                    <div class="table-responsive">
                        
                        <table cellpadding="0" cellspacing="0" border="0" class="display" id="data-table" >
                            <thead>
                                <tr>
                                    <?php foreach($array as $colunas){?>
                                    <th height="30"><?php echo $colunas[0];?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php for($i=0; $i < count($Obj); $i++){ ?>
                            
                                <tr height="30">
                        
                                    <?php foreach($array as $valor){ ?>
                                    
                                    <?php if(!$valor[0]){ ?>
                                    
                                    <td height="30" width="70">

                                    <button class="btn btn-xs btn-danger" data-toggle="modal" href="#myModal" onClick="excluir('<?php echo $Obj[$i]->$valor[1] ?>');"><i class="fa fa-times"></i> </button>
                                    
                                    <?php } else{ ?>
                                    
                                      <td <?php echo $background;?>>
                                        <?php if($valor[2]){ ?>
                                          <?php echo Functions::$valor[2]($Obj[$i]->$valor[1]);?>
                                        <?php }else{ ?>
                                          <?php echo $Obj[$i]->$valor[1];?>
                                        <?php } ?>
                                      </td>
                                    <?php } ?>
                                    
                                    <?php } ?>
                        
                                </tr>
                        
                                <?php } ?>
                            
                            </tbody>
                        </table>
                                
                        <div class="clearfix"></div>
                    </div>
                    </div>
                </div>

                
              </div>
              <div class="widget-foot text-right">
                                
              <?php if($exportacao){ ?>

                <a href="../excel/getExport.php?table=<?php echo $table; ?>">
                  Exportar <img src="../img/icons/excel.png" width="30" height="30" />
                </a>
    
              <?php } ?>

              </div>
            </div>
  
         </div>
        
    </div>

</div>

</div>


<!-- Footer -->
  <?php include("../includes/footer.php"); ?>

<!-- JS -->
<?php include("../includes/js.php"); ?>

<?php include("../includes/modal.php"); ?>

</body>
</html>