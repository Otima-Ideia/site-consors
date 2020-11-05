<?php include("includes/inicio.php");?>

<!-- Alerts -->
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.ui.draggable.js" type="text/javascript"></script>
<script src="js/jquery.alerts.js" type="text/javascript"></script>
<link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript">
	  $(document).ready(function () {

			$.fn.listaArvore = function(nPasta) {

			$(document).listarPasta();
            var theme = getDemoTheme();

			pastaAtual = "0";

			$('#jqxExpander').jqxExpander({ showArrow: false, toggleMode: 'none', width: '200px', height: '300px', theme: theme });
            		$.ajax({
					  url: "getArvore.php",
					  data: { gerar: nPasta},
					  type: "post",
					  error: function(){
						//alert("há um erro com AJAX");
					  }
					}).done(function( html ) {
						var source = eval(html);

						  $('#jqxTree').jqxTree({ source: source, width: '100%', height: '100%', theme: theme });
							$('#jqxTree').on('select', function (event) {
								var args = event.args;
								var item = $('#jqxTree').jqxTree('getItem', args.element);
									$(document).listarPasta(item.id);
									pastaAtual = item.id;
							});
					});

			}
        });
</script>

<title>CMS DMSNET - Upload de Arquivos</title>
<link rel="stylesheet" href="css/jqx.base.css" type="text/css" />
<style type="text/css">
.progress { position:relative; width:200px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; margin-top:7px; }
.bar { background-color: #09F; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; font-size:14px; line-height:16px; }
</style>
</head>

<body>

<div align="center">

<h1>Upload de Arquivos</h1>

<div id="navegacao">
  <div>
    <form id="myForm" action="funcoes.php" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="funcao" id="funcao" value="upload" />
        <input type="hidden" name="pUpload" id="pUpload" value="" />
    	<input type="file" name="files[]" id="files" class="upfile" size="42" multiple />
        
      	<input type="submit" class="btn" id="bt-envio" value="enviar">
	</form>

    <div class="progress" style="display:none; float:left">
        <div class="bar"></div >
        <div class="percent">0%</div >
    </div>

  </div>
  <div id="bt_nova_pasta" class="nova-pasta">Nova Pasta</div>
</div>

 <div id="arquivos">

 	<!-- Arvore - Retorno Jquery -->
	<div id="arvore">
      <div id='jqxExpander'>
        <div>Pastas</div>
        <div style="overflow: hidden;">
            <div style="border: none; margin-top:10px;" id='jqxTree'>

            </div>
        </div>
      </div>
    </div>
	<!-- Arvore -->

    <div id="html">

    </div>

  </div>

<div id="footer">

  <div id="busca">
    <input name="nm_busca" id="nm_busca" type="text" class="txt" />
    <input type="button" id="bt_busca" class="btn" value="buscar" />
  </div>

</div>

</div>

<script type="text/javascript">

$(document).ready(function(){

	$.fn.listarPasta = function(cd_pasta, pagina, filtro) {
		$.ajax({
			  url: "funcoes.php",
			  data: { gerar: 1 , pasta: cd_pasta, pagina: pagina, filtro: filtro},
			  type: "post",
			  error: function(){
				//alert("há um erro com AJAX");
			  }
			}).done(function( html ) {
				$("#pUpload").attr("value", cd_pasta);
				$("#html").html(html);
			});

		$.ajax({
			  url: "funcoes.php",
			  data: { gerar: 1, pasta:cd_pasta, paginacao: 1, pagina: pagina, filtro: filtro},
			  type: "post",
			  error: function(){
				//alert("há um erro com AJAX");
			  }
			}).done(function( html ) {
				$("#paginacao").html(html);
			});

	};

	var bar = $('.bar');
	var percent = $('.percent');

	$('#myForm').ajaxForm({
		beforeSend: function() {
			$('.progress').css("display", "none");
        	var percentVal = '0%';
        	bar.width(percentVal)
        	percent.html(percentVal);
		},
		uploadProgress: function(event, position, total, percentComplete) {
			$('.progress').css("display", "block");
			$('#bt-envio').css("display", "none");
			var percentVal = percentComplete + '%';
        	bar.width(percentVal)
        	percent.html(percentVal);
		},
		success: function() {
			var percentVal = '100%';
        	bar.width(percentVal)
        	percent.html(percentVal);
			$('.progress').css("display", "none");
		},
		complete: function(xhr) {
		  $('#bt-envio').css("display", "block");
		  $('#myForm').resetForm();
		  $(document).listarPasta(xhr.responseText);
		}
	});

	$("#bt_nova_pasta").click( function() {
		jPrompt('Digite o nome da pasta:', '', 'Criar nova pasta', function(r) {
			if( r ){
				$.ajax({
				  url: "funcoes.php",
				  data: { gerar: 2, nova_pasta: r, pAtual: pastaAtual},
				  type: "post",
				  error: function(){
					//alert("há um erro com AJAX");
				  }
				}).done(function( html ) {
					jAlert('Pasta criado com sucesso', 'Criar nova pasta');
					$(document).listaArvore(html);
				});
			}
		});
	});

	$('#selectPage').parent().change( function() {
		$(document).listarPasta(pastaAtual, $(this).find("option:selected").attr("value"));
	});

	$('#bt_busca').click( function() {
		$(document).listarPasta('', '', $('#nm_busca').val());
	});

	$('#nm_busca').bind('keypress', function (ev) {
		var keycode = (ev.keyCode ? ev.keyCode : ev.which);
		if (keycode == 13) {
			$(document).listarPasta('', '', $('#nm_busca').val());
		}
	});
	//------ Inicializacoes ----------------
	$(document).listaArvore();
	//--------------------------------------
});

function fnExcluir(id, name){
	if(id > 0){
		if(confirm('Tem certeza que deseja excluir "' + name + '"?')){
		  excluir_upload(id, pastaAtual, name);
	    }
	}
}

function abrir_arquivo(arq){
	window.parent.my_field.value = 'datafiles/'+arq;
	window.parent.Shadowbox.close();
}

function abrir_pasta(id){
	$(document).listarPasta(id);
	pastaAtual = id;
}

function getRefToDiv(divID) {
    if( document.layers ) { //Netscape layers
        return document.layers[divID]; }
    if( document.getElementById ) { //DOM; IE5, NS6, Mozilla, Opera
        return document.getElementById(divID); }
    if( document.all ) { //Proprietary DOM; IE4
        return document.all[divID]; }
    if( document[divID] ) { //Netscape alternative
        return document[divID]; }
    return false;
}
</script>



<script type="text/javascript" src="js/gettheme.js"></script>
<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="js/jqxcore.js"></script>
<script type="text/javascript" src="js/jqxpanel.js"></script>
<script type="text/javascript" src="js/jqxtree.js"></script>
<script type="text/javascript" src="js/jqxexpander.js"></script>
<script type="text/javascript" src="js/jqxscrollbar.js"></script>
<script type="text/javascript" src="js/jqxbuttons.js"></script>

<script type="text/javascript" src="../../js/jquery.form.js"></script>
<script type="text/javascript" src="../../ajax/services.js"></script>
</body>
</html>