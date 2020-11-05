<?php require_once("../includes/config.php"); ?>

<?php


$titulo_pagina = "Registrando Acesso";  
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <?php include("../includes/head.php"); ?>

<body>

<div class="content">

  <div class="widget wviolet center-block" style="width:500px;">
      <div class="widget-head">
	    <div class="pull-left">Registrando Login...</div>
	    <div class="clearfix"></div>
    </div>

    <div class="widget-content">
      <div class="padd">
	    <h5>Aguarde enquanto registramos o seu login no sistema!</h5>
        <div class="progress progress-striped active" id="barra1">
	      <div class="progress-bar progress-bar-success" data-percentage="100" id="barra2">
	      </div>
	    </div>
	
        <hr />
      </div>
    </div>

  </div>
</div>


<!-- JS -->
  <?php include("../includes/js.php"); ?>

<script>
setTimeout(function(){

	$('#barra1 #barra2').each(function() {
		var me = $(this);
		var perc = me.attr("data-percentage");
		var teste;
		//TODO: left and right text handling

		var current_perc = 0;

		var progress = setInterval(function() {
			if (current_perc>=perc) {
				clearInterval(progress);
			} else {
				current_perc +=2;
				me.css('width', (current_perc)+'%');
			}

			me.text((current_perc)+'%');
			
			if(current_perc == 100){
				setTimeout(function(){
			  	  window.location='../configs/index.php';
				}, 2000);
			}

		}, 70);
		
	});
	


},0);
</script>

</body>
</html>