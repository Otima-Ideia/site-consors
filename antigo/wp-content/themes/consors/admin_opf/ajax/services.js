function GetXmlHttpObject() {
  var xmlHttp = null;
  try {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
  } catch (e) {
    // Internet Explorer
    try {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
  return xmlHttp;
}

function excluir_db(id) {

  var xmlHttp = GetXmlHttpObject();
  if(xmlHttp==null) {
    alert("Este Navegador não suporta AJAX!")
    return false;
  }
  var url = "../ajax/excluir_db.php";
  url = url + "?id=" + id;
  
  xmlHttp.onreadystatechange = function() {

  };
  try {
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  } catch(e) {
    alert(url + " não pode ser acessada!");
  }
}

function excluir_upload(id, cd_pasta, name) {

  var xmlHttp = GetXmlHttpObject();
  if(xmlHttp==null) {
    alert("Este Navegador não suporta AJAX!")
    return false;
  }
  var url = "../../ajax/excluir_upload.php";
  url = url + "?ids=" + id;
  url = url + "&pasta=" + cd_pasta;
  url = url + "&nome=" + name;

  xmlHttp.onreadystatechange = function() {
	  	var nr_pasta = xmlHttp.responseText;
		$(document).listarPasta(cd_pasta);
		$(document).listaArvore(cd_pasta);
  };
  try {
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  } catch(e) {
    alert(url + " não pode ser acessada!");
  }
}

function getCategoria(valor) {

  var xmlHttp = GetXmlHttpObject();
  if(xmlHttp==null) {
    alert("Este Navegador não suporta AJAX!")
    return false;
  }
  var url = "../ajax/getCategoria.php";
  url = url + "?grupo=" + valor;
  
  xmlHttp.onreadystatechange = function() {
	  if (xmlHttp.readyState==4) {
	  response = xmlHttp.responseText;
	  
	  $("#cat").css("display", "none");
	  $("#load").css("display", "inline");
	  
	  setTimeout(function() {
		  
	  $("#cd_categoria").html(response);
	  $("#cat").css("display", "inline");
	  $("#load").css("display", "none");
		
	}, 500);
	  
    }

  };
  try {
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  } catch(e) {
    alert(url + " não pode ser acessada!");
  }
}

function getTipo(obj) {
  var valor = obj.value;
  
  var xmlHttp = GetXmlHttpObject();
  if(xmlHttp==null) {
    alert("Este Navegador não suporta AJAX!")
    return false;
  }
  var url = "../ajax/getTipo.php";
  url = url + "?tipo=" + valor;
  
  xmlHttp.onreadystatechange = function() {
	  if (xmlHttp.readyState==4) {
	  	response = xmlHttp.responseText;
		$("select[name='cd_estado']").html(response);	  
    }

  };
  try {
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  } catch(e) {
    alert(url + " não pode ser acessada!");
  }
}

function saveAcab(id_foto, valor) {

  var xmlHttp = GetXmlHttpObject();
  if(xmlHttp==null) {
    alert("Este Navegador não suporta AJAX!")
    return false;
  }
  
  var url = "../ajax/save_acab.php";
  url = url + "?id=" + id_foto;
  url = url + "&acab=" + valor;

  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState==4) {

      var response = xmlHttp.responseText;
	  
		$("#f"+id_foto).fadeOut(function(){
			$(this).fadeIn();
		});

    }
  };
  try {
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  } catch(e) {
    alert(url + " não pode ser acessada!");
  }
}

function saveLegend(id_foto, valor) {

  var xmlHttp = GetXmlHttpObject();
  if(xmlHttp==null) {
    alert("Este Navegador não suporta AJAX!")
    return false;
  }

  var url = "../ajax/save_legend.php";
  url = url + "?id=" + id_foto;
  url = url + "&legenda=" + valor;

  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState==4) {

      var response = xmlHttp.responseText;

		$("#f"+id_foto).fadeOut(function(){
			$(this).fadeIn();
		});

    }
  };
  try {
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  } catch(e) {
    alert(url + " não pode ser acessada!");
  }
}

function saveMiniatura(id_foto){

  var xmlHttp = GetXmlHttpObject();
  if(xmlHttp==null) {
    alert("Este Navegador não suporta AJAX!")
    return false;
  }
  var url = "../ajax/save_miniatura.php";
  url = url + "?id=" + id_foto;

  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState==4) {

		$("#f"+id_foto).fadeOut(function(){
			$(this).fadeIn();
		});


    }
  };
  try {
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
  } catch(e) {
    alert(url + " não pode ser acessada!");
  }
}

function excluir_foto(id_foto){
  if(confirm("Deseja mesmo deletar esta imagem?")){

	  var xmlHttp = GetXmlHttpObject();
	  if(xmlHttp==null) {
		alert("Este Navegador não suporta AJAX!")
		return false;
	  }
	  var url = "../ajax/excluir_foto.php";
	  url = url + "?id=" + id_foto;

	  url = url + "&sid=" + Math.random();
	  xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState==4) {

		  var response = xmlHttp.responseText;

		  $("#f"+id_foto).fadeOut();

		}
	  };
	  try {
		xmlHttp.open("GET", url, true);
		xmlHttp.send(null);
	  } catch(e) {
		alert(url + " não pode ser acessada!");
	  }

  }else{
	  return false;
  }
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