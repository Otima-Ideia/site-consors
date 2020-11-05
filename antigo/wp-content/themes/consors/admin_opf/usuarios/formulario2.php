<?php require_once("../includes/config.php"); ?>
<?php

//error_reporting(E_ALL); 
//ini_set('display_errors', '1'); 

  session_start();

  if(!$_SESSION["user_code"]){
  	  echo("<script>window.location='../index.php';</script>");
	  die();
  }
  
  // --- CONFIG --------------------------------------------------------
  
  $table = "tab_usuario";
  $titulo_pagina = "Usuário";
  
  // -------------------------------------------------------------------
  
  require_once("../../classes/class.inc");
  
  $codigo = $_REQUEST["codigo"];

  $objArray = new classArray($table);
  $Objs = new dao($objArray);
  $Obj = new dto($objArray->getArray());
  
  $Objs->link = Connector::getDefaultLink();

  if(isset($_POST['confirmar_x'])){

    foreach($_POST as $name=>$value){
	  $Obj->$name = $value;
	}

	$Obj->nm_senha = base64_encode($Obj->nm_senha);

  	if(!$codigo){
		$Objs->insert($Obj);
  	}else{
		$Objs->update($Obj);
  	}
	
	Functions::goPage('index.php');
	die();
  
  }
  
  if($codigo){

    $Obj = $Objs->locate($codigo+0);
  
  foreach($Obj->ttoString($objArray) as $array=>$campos){
    $$campos[0] = $campos[1];
  }

  $nm_senha = base64_decode($nm_senha);

  }       
  
?>

<?php include("../includes/inicio.php");?>


<title><?php echo $titulo_site;?></title>

<!-- tinyMCE -->

</head>

<body>

<!--TOPO------------------------------->
<?php include("../includes/menu.php"); ?>


<!--HEADER------------------------------->
<?php include("../includes/header.php"); ?>

<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td valign="top" id="conteudo">
    
    
    
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0">
       <form id="formulario" name="formulario" method="post" action="" onSubmit="return enviar(this);">
       <input type="hidden" name="codigo" value="<?php echo $codigo;?>" id="codigo"/>

      <tr>
        <td valign="middle" class="titForm"><?php echo $titulo_pagina;?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td height="25" class="espacamentoLabel"><span class="label">C&oacute;digo</span>: <input name="id_usuario" type="text" class="input" id="id_usuario" size="10" readonly value="<?php echo $codigo;?>"/></td>
                </tr>
            </table></td>
            <td width="81%">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><hr class="hrForm"/></td>
          </tr>
          <tr>
            <td colspan="2"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="691" height="25" class="label">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="35" class="label">Usu&aacute;rio:</td>
                <td class="label"><span class="espacamentoInput">
                  <input  name="nm_usuario" type="text" class="input" id="nm_usuario" size="50" value="<?php echo $nm_usuario?>" title="Usu&aacute;rio" />
                </span></td>
                <td align="left" class="label">Login:</td>
                <td align="left" class="label"><span class="espacamentoInput">
                  <input  name="nm_login" type="text" class="input" id="nm_login" size="28" value="<?php echo $nm_login?>" title="Login" />
                </span></td>
              </tr>
              <tr>
                <td width="86" height="35" class="label">Senha:</td>

                <td width="439" class="label"><span class="espacamentoInput">
                  <input  name="nm_senha" type="password" class="input" id="nm_senha" size="18" value="<?php echo $nm_senha?>" title="Senha" />
                </span></td>

                <td width="136" align="left" class="label">Confirmar senha:</td>
                <td width="334" align="left" class="label"><span class="espacamentoInput">
                  <input  name="nm_senha2" type="password" class="input" id="nm_senha2" size="18" value="<?php echo $nm_senha?>" title="Confirma&ccedil;&atilde;o de senha" />
                </span></td>

              </tr>
              <tr>
                <td height="35" class="label">E-mail</td>
                <td class="label"><span class="espacamentoInput">
                  <input  name="nm_email" type="text" class="input" id="nm_email" size="50" value="<?php echo $nm_email?>" title="E-mail" />
                </span></td>
                <td align="left" class="label">Status: </td>
                <td align="left" class="label"><select name="cd_nivel">
                  <option value="1" <?php Functions::getSelected($cd_nivel, '1');?>>Ativo</option>
                  <option value="0" <?php Functions::getSelected($cd_nivel, '0');?>>Inativo</option>
                </select></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="25" colspan="2" class="label">&nbsp;</td>
            </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="35" align="center" valign="bottom" class="tdbotoes"><input name="confirmar" type="image" src="../images/bt-confirm.png" class="btns" id="confirmar" /> 
          &nbsp;
          <img src="../images/bt-cancel.png" class="btns" id="cancelar" onClick="backPage();" style="cursor:pointer"/></td>
      </tr>
     </form> 
    </table>
    
    

    </td>
  </tr>
</table>

<?php include("../includes/footer.php"); ?>

<script src="../../js/validacao.js" language="javascript" type="text/javascript"></script>

<script language="javascript" type="text/javascript">

function enviar(obj) {

  if(validar(obj)){
	  
  if(obj.nm_senha.value != obj.nm_senha2.value){
	alert('Campos de senhas diferentes!');
	return false;  
  }


  var msg = "Deseja confirmar a ";

  if(!getRefToDiv("codigo").value)
    msg += "inclusão?";
  else 
    msg += "atualização?";

  if(confirm(msg))
    return true;

  return false;
  }
  
  return false;

}

function backPage(){
  window.location='index.php';
}

</script>

</body>
</html>