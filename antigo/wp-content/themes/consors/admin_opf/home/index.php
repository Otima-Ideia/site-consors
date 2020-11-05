<?php require_once("../includes/config.php"); ?>



<?php $titulo_pagina = "Home"; $alterado = false; ?>



<?php if($_REQUEST["operacao"]){ 



$_REQUEST = str_replace("'", chr(34), $_REQUEST);


$array = array(
"UPDATE tab_home SET nm_valor = '" . $_REQUEST["home_noticias"] . "' WHERE nm_config='home_noticias';",
"UPDATE tab_home SET nm_valor = '" . $_REQUEST["home_servicos"] . "' WHERE nm_config='home_servicos'");

for($i=0; $i < count($array); $i++){
  Connector::executeQuery($array[$i], Connector::getDefaultLink());  
}

$alterado = true;

}

?>



<?php

  $obj = dao::execute("tab_home", "openAjax");
  $array_campos = array(); $i=0;
  
  foreach($obj as $campos=>$valor){
    array_push($array_campos, $valor->nm_config);
    $$array_campos[$i] = $obj[$i]->nm_valor;

    $variavel = $valor->nm_config;
    $$variavel = $obj[$i]->nm_valor;

    $i++;
  }


  $objG = dao::execute("tab_grupo", "openAjax", " ORDER BY nm_grupo");
  $objC = dao::execute("tab_conteudo", "openAjax", " ORDER BY nm_conteudo");

?>


<!DOCTYPE html>

<html lang="en">



<link rel="stylesheet" type="text/css" href="../../shadowbox/shadowbox.css">



<script src="../../shadowbox/shadowbox.js" language="javascript" type="text/javascript"></script>



<script type="text/javascript">

  Shadowbox.init();

</script>



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

        <input type="hidden" name="operacao" value="true">


	    <div class="matter">

        <div class="container">



          <div class="row">



            <div class="col-md-12">





              <div class="widget wgreen">

                

                



                <div class="widget-content">

                  <div class="padd">

                        

                   <br>

                   

                    <div class="form-group alert alert-success">

                      <label class="col-lg-5 control-label">Selecione as opções desejadas para configurar a página Home </label>

                    </div>

                   

                   

                    

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Notícias</label>
                      <div class="col-lg-5">
                        
                        <select name="home_noticias" class="form-control">
                        <?php for($i=0; $i < count($objG); $i++){?>
                              <option value="<?php echo $objG[$i]->id_grupo;?>" <?php if($home_noticias == $objG[$i]->id_grupo){echo "selected='selected'";}?>><?php echo $objG[$i]->nm_grupo;?></option>
                            <?php } ?>
                      </select>

                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-lg-2 control-label">Serviços</label>
                      <div class="col-lg-5">
                        
                        <select name="home_servicos" class="form-control">
                        <?php for($i=0; $i < count($objG); $i++){?>
                              <option value="<?php echo $objG[$i]->id_grupo;?>" <?php if($home_servicos == $objG[$i]->id_grupo){echo "selected='selected'";}?>><?php echo $objG[$i]->nm_grupo;?></option>
                            <?php } ?>
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

<!-- Content ends -->



<!-- Footer -->

 	

  <?php include("../includes/footer.php"); ?>



<!-- Footer -->



<!-- Scroll to top -->

<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 





<!-- JS -->



<?php include("../includes/js.php"); ?>



<?php include("../includes/modal.php"); ?>



<!-- Script for this page -->



<?php if($alterado){?>

<script>

  noty({text: 'Alterações efetuadas com sucesso!',layout:'bottom',type:'success',timeout:2000});

</script>

<?php } ?>


<script>

  $.fn.carregarBloco = function(id) {

  $.ajax({

  url: "loop-bloco.php",

  data: {id:id},

  type: "post",

  async: false,

  error: function(){

    alert("há um erro com AJAX");

  }

  }).done(function( html ) {

    $("#bloco").append( html );

  });

}

<?php for($r=0; $r < count($objB); $r++){ ?>

  $(document).carregarBloco('<?php echo $objB[$r]->id_bloco;?>');

<?php } ?>

</script>

</body>

</html>