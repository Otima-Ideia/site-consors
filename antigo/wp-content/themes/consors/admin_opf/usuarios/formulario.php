<?php require_once("../includes/config.php"); ?>
<?php

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
	  die();
  }
  
  if($_SESSION["user_departamento"] != 1){
  	  echo("<script>window.location='../usuarios/formulario-usuario.php';</script>");
  }
  
  // --- CONFIG --------------------------------------------------------
  
  $table = "tab_usuario";
  $titulo_pagina = "Usuário";
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

	if($Obj->nm_senha)
    $Obj->nm_senha = md5($Obj->nm_senha);
  else
    $Obj->nm_senha = Connector::getAllName("tab_usuario", "nm_senha", "id_usuario='" . $codigo . "'");

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

  }       
  
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
                
                <div class="widget-head">
                  <div class="pull-left">
                  <div style="float:left">Ativo: &nbsp;</div>
		          <div class="sw-green" style="float:left">
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
                        <input type="text" class="form-control" name="id_usuario" placeholder="Código" readonly value="<?php echo $id_usuario?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Usuário</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_usuario" placeholder="Usuário" value="<?php echo $nm_usuario?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Login</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" name="nm_login" placeholder="Login" value="<?php echo $nm_login?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Senha</label>
                      <div class="col-lg-5">
                        <input type="password" class="form-control" name="nm_senha" placeholder="Senha" value="<?php echo $nm_senha?>">
                      </div>
                    </div>  
                    
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Departamento</label>
                      <div class="col-lg-5">

                      <select name="cd_departamento" class="form-control">
                        <option value="1" <?php if($cd_departamento == 1){echo "selected='selected'";}?>>Administrador</option>
                      </select>

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