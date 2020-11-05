function validar(obj){

  var i=0;

  for (i=0; i<obj.elements.length; i++){
    if(obj.elements[i].title!=""){

	  if(obj.elements[i].type == 'checkbox'){

	    if(!obj.elements[i].checked){
		  alert('O campo ' +  obj.elements[i].title + ' deve ser checado!');  
		  obj.elements[i].focus();
	      return false;
	    }
		
	  }else{
		
	    if (obj.elements[i].value == ''){
	      alert('O campo ' +  obj.elements[i].title + ' deve ser preenchido!');
	      obj.elements[i].focus();
	      return false;
	    }
	  }
    }
  }

  $('.form-actions').html('<img src=images/loader.gif width=300>');

  return true;
}


function Mascara(o,f)
{
    v_obj = o
    v_fun = f
    setTimeout("execmascara()",1)

}

/**
 * Função que Executa os objetos
 */
function execmascara()
{
    v_obj.value = v_fun(v_obj.value)

}

/**
 * Função que Determina as expressões regulares dos objetos
 */
function leech(v)
{
    v = v.replace(/o/gi,"0")
    v = v.replace(/i/gi,"1")
    v = v.replace(/z/gi,"2")
    v = v.replace(/e/gi,"3")
    v = v.replace(/a/gi,"4")
    v = v.replace(/s/gi,"5")
    v = v.replace(/t/gi,"7")
    return v

}

/**
 * Função que permite apenas numeros
 */
function Integer(v)
{
    return v.replace(/\D/g,"")

}

/**
 * Função que padroniza CEP
 */
function Cep(v)
{
   	v = v.replace(/\D/g,"")
    v = v.replace(/^(\d{5})(\d)/,"$1-$2")
    return v

}


/**
 * Função que permite apenas numeros Romanos
 */
function Romanos(v)
{
    v = v.toUpperCase()
    v = v.replace(/[^IVXLCDM]/g,"")

    while (v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"") != "") {
        v = v.replace(/.$/,"")
    }

    return v

}

/**
 * Função que padroniza o Site
 */
function  Site(v)
{
    v = v.replace(/^http:\/\/?/,"")
    dominio = v
    caminho = ""
    if (v.indexOf("/") > -1) {
        dominio = v.split("/")[0]
    }

    caminho = v.replace(/[^\/]*/, "")
    dominio = dominio.replace(/[^\w\.\+-:@]/g, "")
    caminho = caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g, "")
    caminho = caminho.replace(/([\?&])=/, "$1")
    if (caminho != "") {
        dominio = dominio.replace(/\.+$/, "")
    }

    v = "http://" + dominio + caminho
    return v

}

/**
 * Função que padroniza DATA
 */
function Data(v)
{
    v = v.replace(/\D/g,"")
    v = v.replace(/(\d{2})(\d)/,"$1/$2")
    v = v.replace(/(\d{2})(\d)/,"$1/$2")
    return v

}

/**
 * Função que padroniza DATA
 */
function Hora(v)
{
    v = v.replace(/\D/g,"")
    v = v.replace(/(\d{2})(\d)/,"$1:$2")
    return v

}

/**
 * Função que padroniza valor monétario
 */
function Valor(v){
v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
v=v.replace(/(\d)(\d{8})$/,"$1.$2");//coloca o ponto dos milhões
v=v.replace(/(\d)(\d{5})$/,"$1.$2");//coloca o ponto dos milhares
v=v.replace(/(\d)(\d{2})$/,"$1,$2");//coloca a virgula antes dos 2 últimos dígitos
return v;
} 

/**
 * Função que padroniza valor monétario
 */
function ValorCombustivel(v)
{
    v = v.replace(/\D/g,"") //Remove tudo o que não é dígito
    v = v.replace(/^([0-9]{3}\.?){3}-[0-9]{3}$/,"$1,$2");
    //v = v.replace(/(\d{3})(\d)/g,"$1,$2")
    v = v.replace(/(\d)(\d{3})$/,"$1,$2") //Coloca ponto antes dos 3 últimos digitos
    return v

}
/**
 * Função que padroniza Area
 */
function Area(v)
{
    v = v.replace(/\D/g,"")
    v = v.replace(/(\d)(\d{2})$/,"$1.$2")
    return v

}

function Telefone(v) {	
        
	  v = v.replace(/\D/g,"")
	  v = v.replace(/^(\d\d)(\d)/g,"($1) $2")
	
	if(v.length > 13){
	  v = v.replace(/(\d{5})(\d)/,"$1-$2");//coloca hífen entre o quinto e o sexto dígitos
	}
	else{
	  v = v.replace(/(\d{4})(\d)/,"$1-$2");//coloca hífen entre o quarto e o quinto dígitos
	}
	
    return v;
}

function cpfCnpj(v){

    //Remove tudo o que não é dígito
    

    if (v.length <= 14) { //CPF
	v=v.replace(/\D/g,"")
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ
	v=v.replace(/\D/g,"")
		v = v.replace(/^(\d{2})(\d)/,"$1.$2")
		v = v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
		v = v.replace(/\.(\d{3})(\d)/,".$1/$2")
		v = v.replace(/(\d{4})(\d)/,"$1-$2")
    }

    return v

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