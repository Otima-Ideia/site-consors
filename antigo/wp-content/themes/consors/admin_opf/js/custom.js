/* JS */


/* Navigation */

$(document).ready(function(){

  $("#formulario").validationEngine();

  $(window).resize(function()
  {
    if($(window).width() >= 765){
      $(".sidebar #nav").slideDown(350);
    }
    else{
      $(".sidebar #nav").slideUp(350); 
    }
  });
  
   $(".has_sub > a").click(function(e){
    e.preventDefault();
    var menu_li = $(this).parent("li");
    var menu_ul = $(this).next("ul");

    if(menu_li.hasClass("open")){
      menu_ul.slideUp(350);
      menu_li.removeClass("open")
    }
    else{
      $("#nav > li > ul").slideUp(350);
      $("#nav > li").removeClass("open");
      menu_ul.slideDown(350);
      menu_li.addClass("open");
    }
  });

/* Old Code 

  $("#nav > li > a").on('click',function(e){
      if($(this).parent().hasClass("has_sub")) {
       
		  e.preventDefault();

		  if(!$(this).hasClass("subdrop")) {
			// hide any open menus and remove all other classes
			$("#nav li ul").slideUp(350);
			$("#nav li a").removeClass("subdrop");
			
			// open our new menu and add the open class
			$(this).next("ul").slideDown(350);
			$(this).addClass("subdrop");
		  }
		  
		  else if($(this).hasClass("subdrop")) {
			$(this).removeClass("subdrop");
			$(this).next("ul").slideUp(350);
		  } 
      }   
      
  }); */
});

$(document).ready(function(){
  $(".sidebar-dropdown a").on('click',function(e){
      e.preventDefault();

      if(!$(this).hasClass("open")) {
        // hide any open menus and remove all other classes
        $(".sidebar #nav").slideUp(350);
        $(".sidebar-dropdown a").removeClass("open");
        
        // open our new menu and add the open class
        $(".sidebar #nav").slideDown(350);
        $(this).addClass("open");
      }
      
      else if($(this).hasClass("open")) {
        $(this).removeClass("open");
        $(".sidebar #nav").slideUp(350);
      }
  });

});

/* Widget close */

$('.wclose').click(function(e){
  e.preventDefault();
  var $wbox = $(this).parent().parent().parent();
  $wbox.hide(100);
});

/* Widget minimize */

$('.wminimize').click(function(e){
	e.preventDefault();
	var $wcontent = $(this).parent().parent().next('.widget-content');
	if($wcontent.is(':visible')) 
	{
	  $(this).children('i').removeClass('fa fa-chevron-up');
	  $(this).children('i').addClass('fa fa-chevron-down');
	}
	else 
	{
	  $(this).children('i').removeClass('fa fa-chevron-down');
	  $(this).children('i').addClass('fa fa-chevron-up');
	}            
	$wcontent.toggle(500);
}); 

/* Calendar */

$(document).ready(function() {
  
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    $('#calendar').fullCalendar({
      header: {
        left: 'prev',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,next'
      },
      editable: true,
      events: [
        {
          title: 'All Day Event',
          start: new Date(y, m, 1)
        },
        {
          title: 'Long Event',
          start: new Date(y, m, d-5),
          end: new Date(y, m, d-2)
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d-3, 16, 0),
          allDay: false
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d+4, 16, 0),
          allDay: false
        },
        {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false
        },
        {
          title: 'Lunch',
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false
        },
        {
          title: 'Birthday Party',
          start: new Date(y, m, d+1, 19, 0),
          end: new Date(y, m, d+1, 22, 30),
          allDay: false
        },
        {
          title: 'Click for Google',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'http://google.com/'
        }
      ]
    });
    
});

/* Progressbar animation */
/*
setTimeout(function(){

	$('.progress-animated .progress-bar').each(function() {
		var me = $(this);
		var perc = me.attr("data-percentage");

		//TODO: left and right text handling

		var current_perc = 0;

		var progress = setInterval(function() {
			if (current_perc>=perc) {
				clearInterval(progress);
			} else {
				current_perc +=1;
				me.css('width', (current_perc)+'%');
			}

			me.text((current_perc)+'%');

		}, 200);

	});

},1200);
*/

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
			  	  window.location='../usuarios/';
				}, 2000);
			}

		}, 70);
		
	});
	


},0);


/* Slider */

$(function() {
	// Horizontal slider
	$( "#master1, #master2" ).slider({
		value: 60,
		orientation: "horizontal",
		range: "min",
		animate: true
	});

	$( "#master4, #master3" ).slider({
		value: 80,
		orientation: "horizontal",
		range: "min",
		animate: true
	});        

	$("#master5, #master6").slider({
		range: true,
		min: 0,
		max: 400,
		values: [ 75, 200 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		}
	});


	// Vertical slider 
	$( "#eq > span" ).each(function() {
		// read initial values from markup and remove that
		var value = parseInt( $( this ).text(), 10 );
		$( this ).empty().slider({
			value: value,
			range: "min",
			animate: true,
			orientation: "vertical"
		});
	});
});



/* Support */

$(document).ready(function(){
  $("#slist a").click(function(e){
     e.preventDefault();
     $(this).next('p').toggle(200);
  });
});

/* Scroll to Top */


$(".totop").hide();

$(function(){
	$(window).scroll(function(){
	  if ($(this).scrollTop()>300)
	  {
		$('.totop').fadeIn();
	  } 
	  else
	  {
		$('.totop').fadeOut();
	  }
	});

	$('.totop a').click(function (e) {
	  e.preventDefault();
	  $('body,html').animate({scrollTop: 0}, 500);
	});

});

/* jQuery Notification */

$(document).ready(function(){

 // setTimeout(function() {noty({text: '<strong>Howdy! Hope you are doing good...</strong>',layout:'topRight',type:'information',timeout:15000});}, 7000);

  //setTimeout(function() {noty({text: 'This is an all in one theme which includes Front End, Admin & E-Commerce. Dont miss it. Grab it now',layout:'topRight',type:'alert',timeout:13000});}, 9000);

});


$(document).ready(function() {

  $('.noty-alert').click(function (e) {
      e.preventDefault();
      noty({text: 'Some notifications goes here...',layout:'topRight',type:'alert',timeout:2000});
  });

  $('.noty-success').click(function (e) {
      e.preventDefault();
      noty({text: 'Some notifications goes here...',layout:'top',type:'success',timeout:2000});
  });

  $('.noty-error').click(function (e) {
      e.preventDefault();
      noty({text: 'Some notifications goes here...',layout:'topRight',type:'error',timeout:2000});
  });

  $('.noty-warning').click(function (e) {
      e.preventDefault();
      noty({text: 'Some notifications goes here...',layout:'bottom',type:'warning',timeout:2000});
  });

  $('.noty-information').click(function (e) {
      e.preventDefault();
      noty({text: 'Some notifications goes here...',layout:'topRight',type:'information',timeout:2000});
  });

});


/* Date picker */

$(function() {
    $('#datetimepicker1').datetimepicker({
      pickTime: false
    });
});

$(function() {
    $('.datetimepicker3').datetimepicker({
      pickTime: false
    });
});

$(function() {
    $('#datetimepicker2').datetimepicker({
      pickDate: false
    });
});

/* On Off pllugin */  
  
$(document).ready(function() {
  $('.toggleBtn').onoff();
});


/* CL Editor */

$(".cleditor").cleditor({
    width: "auto",
    height: "auto"
});

/* Modal fix */

$('.modal').appendTo($('body'));

/* Pretty Photo for Gallery*/

jQuery("a[class^='prettyPhoto']").prettyPhoto({
overlay_gallery: false, social_tools: false
});

/* Slim Scroll */

/* Slim scroll for chat widget */

$('.scroll-chat').slimscroll({
  height: '350px',
  color: 'rgba(0,0,0,0.3)',
  size: '5px'
});

/* Data tables */

$(document).ready(function() {
	
	$('#data-table').dataTable({
	   "sPaginationType": "full_numbers",
	   "oLanguage" : {
	   "sUrl": "../js/themes/pt.txt",
	   "iDisplayLength": 10,
	   "aaSorting": [[ 1, "asc" ]],
	   "bStateSave": true
	 }
	});
});


function inserir(){
  $("#codigo").val('');
  $("#formulario").submit();
}

function atualizar(cod){
  $("#codigo").val(cod);
  $("#formulario").submit();
}

function excluir(cod){
 
  setConfigModal("Exclusão...", "Tem certeza que deseja excluir este registro?");
  
  $("#modal_confirm").click(function(){
	$("#excluir").val(cod);
	$("#formulario").attr('action', 'index.php');
	$("#formulario").submit();
  });	

}

function gravarFormulario(){
 
  setConfigModal("Gravar...", "Tem certeza que deseja efetuar esta operação?");
  
  $("#modal_confirm").click(function(){
	$("#formulario").submit();
  });	

}

function setConfigModal(titulo, descricao, funcao){
  $('#titulo_modal').html(titulo);
  $('#descricao_modal').html(descricao);
}

function voltar(){
  window.location='index.php';
}

function setMyField(name){
  my_field = document.getElementById(name);
}

function openPais(id){
	$.ajax({
	url: "../ajax/getAjax.php",
	data: {tabela:'pais', id:id},
	type: "post",
	async: false,
	error: function(){
		alert("há um erro com AJAX");
	}
	}).done(function( html ) {
		$("#id_pais").html( html );
	});
}

function openCidade(id){
	$.ajax({
	url: "../ajax/getAjax.php",
	data: {tabela:'cidade', id:id},
	type: "post",
	async: false,
	error: function(){
		alert("há um erro com AJAX");
	}
	}).done(function( html ) {
		$("#id_cidade").html( html );
	});
}

function openCurso(id){
	$.ajax({
	url: "../ajax/getAjax.php",
	data: {tabela:'curso', id:id},
	type: "post",
	async: false,
	error: function(){
		alert("há um erro com AJAX");
	}
	}).done(function( html ) {
		$("#id_curso").html( html );
	});
}

function openEscola(id){
	$.ajax({
	url: "../ajax/getAjax.php",
	data: {tabela:'escola', id:id},
	type: "post",
	async: false,
	error: function(){
		alert("há um erro com AJAX");
	}
	}).done(function( html ) {
		$("#id_escola").html( html );
	});
}

function openArea(id){
	$.ajax({
	url: "../ajax/getAjax.php",
	data: {tabela:'area', id:id},
	type: "post",
	async: false,
	error: function(){
		alert("há um erro com AJAX");
	}
	}).done(function( html ) {
		$("#id_area").html( html );
	});
}

function openCategorias(id){
	$.ajax({
	url: "../ajax/getAjax.php",
	data: {tabela:'categoria', id:id},
	type: "post",
	async: false,
	error: function(){
		alert("há um erro com AJAX");
	}
	}).done(function( html ) {
		$("#id_categoria").html( html );
	});
}

function openSubCategorias(id){
	$.ajax({
	url: "../ajax/getAjax.php",
	data: {tabela:'subcategoria', id:id},
	type: "post",
	async: false,
	error: function(){
		alert("há um erro com AJAX");
	}
	}).done(function( html ) {
		$("#id_subcategoria").html( html );
	});
}