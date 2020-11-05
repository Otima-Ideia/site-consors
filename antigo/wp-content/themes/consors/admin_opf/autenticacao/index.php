<?php require_once("../includes/config.php"); ?>
<?php

  $title = "Autenticação";
  
  if($_REQUEST["logout"] != ""){
	$_SESSION["user_code"] = false;
  }
  
 
  if($_POST["login"] && $_POST["senha"]){
	  
	$loggin_error = false;

    require_once("../../classes/class.inc");

    $login = str_replace("'", "", $_POST["login"]);
    $password = str_replace("'", "", $_POST["senha"]);
	
	$table = "tab_usuario";
	
	$objArray = new classArray($table);
    $Usuarios = new dao($objArray);
    $Usuarios->link = Connector::getDefaultLink();

    if($Usuarios->getValidate($login, $password)){
	  header("Location: registro.php");
	  die;
   
    }else{
	  $loggin_error = true;
	}
  
  }
  
  $titulo_pagina = "Administração";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
<?php include("../includes/head.php"); ?>

</head>

<body>



<!-- Conteudo -->

<div class="admin-form">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <!-- Widget starts -->
            <div class="widget worange">
              <!-- Widget head -->
              <div class="widget-head">
                <i class="fa fa-lock"></i> Login 
              </div>

              <div class="widget-content">
                <div class="padd">
                  <!-- Login form -->
                  <form class="form-horizontal" action="" method="post">
                    <!-- Email -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputEmail">Login:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Login" name="login" required>
                      </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputPassword">Senha:</label>
                      <div class="col-lg-9">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Senha" name="senha" required>
                      </div>
                    </div>
                                        
                        <div class="col-lg-9 col-lg-offset-3">
							<button type="submit" class="btn btn-info btn-sm">Logar</button>
							<button type="reset" class="btn btn-default btn-sm">Limpar</button>
						</div>
                    <br />
                  </form>
				  
				</div>
              </div>
                
                  <div class="widget-foot" style="display:none">
                    <span class="ui-state-error-text">Login e/ou senha incorretos!</span>
                  </div>

            </div>  
      </div>
    </div>
  </div> 
</div>

<!-- JS -->
  <?php include("../includes/js.php"); ?>

<?php if($loggin_error){ ?>

<script>
$(function () {
  $(".widget-foot").slideDown('slow');
});

</script>

<?php } ?>

</body>
</html>