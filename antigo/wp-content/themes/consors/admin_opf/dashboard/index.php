<?php 

require_once("../includes/config.php");

if(!$_SESSION["user_code"]){
  echo("<script>window.location='../index.php';</script>");
}

//ini_set('display_errors',1);
//ini_set('display_startup_erros',1);
//error_reporting(E_ALL);

$table = "tab_acesso";
$titulo_pagina = "Dashboard";

$mes = $_REQUEST["mes"];
$ano = $_REQUEST["ano"];

if($mes == "")$mes = date("m");
if($ano == "")$ano = date("Y");

// MÊS ANTERIOR -------------------------

$mes_anterior = $mes - 1;

if($mes_anterior < 1){
  $mes_anterior = 12;
  $ano_anterior = $ano - 1;
}else{
  $ano_anterior = $ano;
}

// --------------------------------------

// MÊS SEGUINTE -------------------------

$mes_seguinte = $mes + 1;

if($mes_seguinte > 12){
  $mes_seguinte = 1;
  $ano_seguinte = $ano + 1;
}else{
  $ano_seguinte = $ano;
}

if( ($ano_seguinte.$mes_seguinte) > date("Ym") ){
  $mes_seguinte = 0;
}

// --------------------------------------

$nm_mes_ano = Functions::getMes($mes) . " / " . $ano;

//  --- REDES SOCIAIS --------------------------------------------------------------------

$facebook = Connector::getAllName("tab_config", "nm_valor", "nm_config='facebook'");
$google = Connector::getAllName("tab_config", "nm_valor", "nm_config='google'");
$instagram = Connector::getAllName("tab_config", "nm_valor", "nm_config='instagram'");
$youtube = Connector::getAllName("tab_config", "nm_valor", "nm_config='youtube'");
$twitter = Connector::getAllName("tab_config", "nm_valor", "nm_config='twitter'");
$linkedin = Connector::getAllName("tab_config", "nm_valor", "nm_config='linkedin'");

$arrayDias = array();

for($i=1; $i <= 31; $i++){
  $arrayDias[$i . "/".$mes."/".$ano] = 0;
}

if($facebook){
  $objFace = dao::execute("tab_acesso", "openQuery", "SELECT count(*) as ID, DATE_FORMAT(Timestamp,'%e/%m/%Y') as Timestamp FROM tab_acesso WHERE Pagina='facebook' and month(Timestamp) = $mes and year(Timestamp) = $ano group by date(Timestamp) order by Timestamp");
}

if($google){
$objGoogle = dao::execute("tab_acesso", "openQuery", "SELECT count(*) as ID, DATE_FORMAT(Timestamp,'%e/%m/%Y') as Timestamp FROM tab_acesso WHERE Pagina='google' and month(Timestamp) = $mes and year(Timestamp) = $ano group by date(Timestamp) order by Timestamp");
}

if($instagram){
$objInstagram = dao::execute("tab_acesso", "openQuery", "SELECT count(*) as ID, DATE_FORMAT(Timestamp,'%e/%m/%Y') as Timestamp FROM tab_acesso WHERE Pagina='instagram' and month(Timestamp) = $mes and year(Timestamp) = $ano group by date(Timestamp) order by Timestamp");
}

if($youtube){
$objYoutube = dao::execute("tab_acesso", "openQuery", "SELECT count(*) as ID, DATE_FORMAT(Timestamp,'%e/%m/%Y') as Timestamp FROM tab_acesso WHERE Pagina='youtube' and month(Timestamp) = $mes and year(Timestamp) = $ano group by date(Timestamp) order by Timestamp");
}

if($twitter){
$objTwitter = dao::execute("tab_acesso", "openQuery", "SELECT count(*) as ID, DATE_FORMAT(Timestamp,'%e/%m/%Y') as Timestamp FROM tab_acesso WHERE Pagina='twitter' and month(Timestamp) = $mes and year(Timestamp) = $ano group by date(Timestamp) order by Timestamp");
}

if($linkedin){
$objLinkedin = dao::execute("tab_acesso", "openQuery", "SELECT count(*) as ID, DATE_FORMAT(Timestamp,'%e/%m/%Y') as Timestamp FROM tab_acesso WHERE Pagina='linkedin' and month(Timestamp) = $mes and year(Timestamp) = $ano group by date(Timestamp) order by Timestamp");
}

function setArray($arrayBase, $arrayDestino){

  $arrayRetorno = $arrayBase;
	
  for($i=0; $i < count($arrayDestino); $i++){

	if(array_key_exists($arrayDestino[$i]->Timestamp, $arrayRetorno)){
	  $arrayRetorno[$arrayDestino[$i]->Timestamp] = $arrayDestino[$i]->ID;
	}
  }	
  return $arrayRetorno;
}

$arrayFace = setArray($arrayDias, $objFace);
$arrayGoogle = setArray($arrayDias, $objGoogle);
$arrayInstagram = setArray($arrayDias, $objInstagram);
$arrayYoutube = setArray($arrayDias, $objYoutube);
$arrayTwitter = setArray($arrayDias, $objTwitter);
$arrayLinkedin = setArray($arrayDias, $objLinkedin);

$dias_facebook = implode(",", $arrayFace);
$total_facebook = array_sum($arrayFace);

$dias_google = implode(",", $arrayGoogle);
$total_google = array_sum($arrayGoogle);

$dias_instagram = implode(",", $arrayInstagram);
$total_instagram = array_sum($arrayInstagram);

$dias_youtube = implode(",", $arrayYoutube);
$total_youtube = array_sum($arrayYoutube);

$dias_twitter = implode(",", $arrayTwitter);
$total_twitter = array_sum($arrayTwitter);

$dias_linkedin = implode(",", $arrayLinkedin);
$total_linkedin = array_sum($arrayLinkedin);

// -----------------------------------------------------------------------------


// --- NAVEGADORES -------------------------------------------------------------

//$objDispositivo = dao::execute("tab_acesso", "openQuery", "SELECT * from tab_acesso where RedeSocial='0' and (Dispositivo='Desktop' or Dispositivo='Mobile') and month(Timestamp) = $mes and year(Timestamp) = $ano group by Session");
$objDispositivo = dao::execute("tab_acesso", "openQuery", "SELECT * from tab_acesso where RedeSocial='0' and (Dispositivo='Desktop' or Dispositivo='Mobile') and month(Timestamp) = $mes and year(Timestamp) = $ano");

$arrayDispositivo = array();

for($i=0; $i < count($objDispositivo); $i++){
  $arrayDispositivo[$objDispositivo[$i]->Dispositivo] = $arrayDispositivo[$objDispositivo[$i]->Dispositivo]+1;
}

function getIconeDispositivo($x){
  if($x == "Mobile"){
    return "mobile.png";
  }else{
    return "desktop.png";
  }
}

arsort($arrayDispositivo);

// -----------------------------------------------------------------------------


// --- PAGINAS MAIS VISITADAS --------------------------------------------------

$objPaginasVisitadas = dao::execute("tab_acesso", "openQuery", "SELECT * from tab_acesso where RedeSocial='0' and month(Timestamp) = $mes and year(Timestamp) = $ano");

$arrayPaginas = array();

for($i=0; $i < count($objPaginasVisitadas); $i++){
  $arrayPaginas[$objPaginasVisitadas[$i]->Pagina] = $arrayPaginas[$objPaginasVisitadas[$i]->Pagina]+1;
}

arsort($arrayPaginas);

// -----------------------------------------------------------------------------


// --- GRAFICO NUMERO DE VISITAS ---------------------------------------

$arrayDias = array();

for($i=1; $i <= 31; $i++){
  $arrayDias[$i] = 0;
}

//$objGrafico1 = dao::execute("tab_acesso", "openQuery", "SELECT DATE_FORMAT(Timestamp,'%e') as Timestamp FROM tab_acesso WHERE RedeSocial='0' and month(Timestamp) = $mes and year(Timestamp) = $ano group by Session order by Timestamp");
$objGrafico1 = dao::execute("tab_acesso", "openQuery", "SELECT DATE_FORMAT(Timestamp,'%e') as Timestamp FROM tab_acesso WHERE RedeSocial='0' and month(Timestamp) = $mes and year(Timestamp) = $ano order by Timestamp");

$arrayGrafico1 = setArrayGrafico($arrayDias, $objGrafico1);


function setArrayGrafico($arrayRetorno, $arrayDestino){

  for($i=0; $i < count($arrayDestino); $i++){

	  if(array_key_exists($arrayDestino[$i]->Timestamp, $arrayRetorno)){
	    $arrayRetorno[$arrayDestino[$i]->Timestamp] = $arrayRetorno[$arrayDestino[$i]->Timestamp]+1;
	  }
  }	
  
  return $arrayRetorno;
}


// -----------------------------------------------------------------------------

// --- GRAFICO REJEICAO ----------------------------------------


$arrayDias = array();

for($i=1; $i <= 31; $i++){
  $arrayDias[$i] = 0;
}

$objGrafico2 = dao::execute("tab_acesso", "openQuery", "SELECT DATE_FORMAT(Timestamp,'%e') as Timestamp FROM tab_acesso WHERE month(Timestamp) = $mes and year(Timestamp) = $ano group by Session HAVING count(Pagina) = 1");

//$objGrafico2 = dao::execute("tab_acesso", "openQuery", "SELECT DATE_FORMAT(Timestamp,'%e') as Timestamp FROM tab_acesso WHERE RedeSocial='0' and month(Timestamp) = $mes and year(Timestamp) = $ano group by Session HAVING count(Pagina) = 1");
  
$arrayGrafico2 = setArrayGrafico($arrayDias, $objGrafico2);

// -----------------------------------------------------------------------------



// --- GRAFICO CONVERSAO CONTATOS ----------------------------------------------

$arrayDias = array();

for($i=1; $i <= 31; $i++){
  $arrayDias[$i] = 0;
}

$objGraficoContatos = dao::execute("tab_contato", "openQuery", "SELECT count(*) as id_contato, DATE_FORMAT(dt_contato,'%e') as dt_contato FROM tab_contato WHERE month(dt_contato) = $mes and year(dt_contato) = $ano group by date(dt_contato)");

$arrayGraficoContatos = setArrayContatos($arrayDias, $objGraficoContatos);


function setArrayContatos($arrayBase, $arrayDestino){

  $arrayRetorno = $arrayBase;
	
  for($i=0; $i < count($arrayDestino); $i++){

	if(array_key_exists($arrayDestino[$i]->dt_contato, $arrayRetorno)){
	  $arrayRetorno[$arrayDestino[$i]->dt_contato] = $arrayDestino[$i]->id_contato;
	}
  }	
  return $arrayRetorno;
}

// -----------------------------------------------------------------------------


// --- GRAFICO CONVERSAO ORCAMENTOS --------------------------------------------

$arrayDias = array();

for($i=1; $i <= 31; $i++){
  $arrayDias[$i] = 0;
}

$objGraficoOrcamentos = dao::execute("tab_orcamento", "openQuery", "SELECT count(*) as id_orcamento, DATE_FORMAT(dt_orcamento,'%e') as dt_orcamento FROM tab_orcamento WHERE month(dt_orcamento) = $mes and year(dt_orcamento) = $ano group by date(dt_orcamento)");

$arrayGraficoOrcamentos = setArrayOrcamentos($arrayDias, $objGraficoOrcamentos);


function setArrayOrcamentos($arrayBase, $arrayDestino){

  $arrayRetorno = $arrayBase;
	
  for($i=0; $i < count($arrayDestino); $i++){

	if(array_key_exists($arrayDestino[$i]->dt_orcamento, $arrayRetorno)){
	  $arrayRetorno[$arrayDestino[$i]->dt_orcamento] = $arrayDestino[$i]->id_orcamento;
	}
  }	
  return $arrayRetorno;
}

// -----------------------------------------------------------------------------


$ObjPaginas = dao::execute("tab_acesso", "openQuery", "SELECT count(*) as ID from tab_acesso WHERE RedeSocial='0' and month(Timestamp) = $mes and year(Timestamp) = $ano");

$total_paginas = $ObjPaginas[0]->ID;

//$ObjVisitas = dao::execute("tab_acesso", "openQuery", "SELECT id from tab_acesso WHERE RedeSocial='0' and month(Timestamp) = $mes and year(Timestamp) = $ano group by Session");
$ObjVisitas = dao::execute("tab_acesso", "openQuery", "SELECT id from tab_acesso WHERE RedeSocial='0' and month(Timestamp) = $mes and year(Timestamp) = $ano");

$total_visitas = count($ObjVisitas);


//$objRejeicao = dao::execute("tab_acesso", "openQuery", "SELECT DATE_FORMAT(Timestamp,'%e') as Timestamp FROM tab_acesso WHERE RedeSocial='0' and month(Timestamp) = $mes and year(Timestamp) = $ano group by Session HAVING count(Pagina) = 1");

$objRejeicao = dao::execute("tab_acesso", "openQuery", "SELECT DATE_FORMAT(Timestamp,'%e') as Timestamp FROM tab_acesso WHERE RedeSocial='0' and month(Timestamp) = $mes and year(Timestamp) = $ano group by Session HAVING count(Pagina) = 1");

$total_rejeicao = count($objRejeicao);

if($total_visitas == 0)
  $total_visitas = 1;

$taxa_rejeicao = (100 / $total_visitas) * $total_rejeicao;

?>

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

    <?php include("../includes/menu.php"); ?>

  	  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left"><i class="fa fa-home"></i> Dashboard</h2>

        <!-- Breadcrumb -->
        <div class="bread-crumb pull-right" style="font-size: 18px">
          
          <span style="cursor: pointer;" onclick="setMesAno(<?php echo $mes_anterior; ?>, <?php echo $ano_anterior; ?>);"> << </span>

          <span class="divider" style="color: #777"><?php echo $nm_mes_ano; ?></span> 

          <?php if($mes_seguinte > 0){ ?>
            <span style="cursor: pointer;" onclick="setMesAno(<?php echo $mes_seguinte; ?>, <?php echo $ano_seguinte; ?>);"> >> </span>
          <?php } ?>
        </div>

        <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

	    <div class="matter">
        <div class="container">

          <!-- Today status. jQuery Sparkline plugin used. -->

          <div class="row">
            <div class="col-md-12"> 
              <!-- List starts -->
              <ul class="today-datas">
                <!-- List #1 -->
                <?php if($facebook){ ?>
                  <li>
                    Facebook
                    <div><span id="todayspark1" class="spark"></span></div>
                    <div class="datas-text"><?php echo $total_facebook;?> clique(s)</div>
                  </li>
                <?php } ?>

                <?php if($google){ ?>
                  <li>
                    Google+
                    <div><span id="todayspark4" class="spark"></span></div>
                    <div class="datas-text"><?php echo $total_google;?> clique(s)</div>
                  </li>
                  <?php } ?>
                <?php if($twitter){ ?>
                  <li>
                    Twitter
                    <div><span id="todayspark2" class="spark"></span></div>
                    <div class="datas-text"><?php echo $total_twitter;?> clique(s)</div>
                  </li>                
                  <?php } ?>
                <?php if($instagram){ ?>
                  <li>
                    Instagram
                    <div><span id="todayspark3" class="spark"></span></div>
                    <div class="datas-text"><?php echo $total_instagram;?> clique(s)</div>
                  </li>
                  <?php } ?>
                <?php if($youtube){ ?>
                  <li>
                    Youtube
                    <div><span id="todayspark6" class="spark"></span></div>
                    <div class="datas-text"><?php echo $total_youtube;?> clique(s)</div>
                  </li>
                <?php } ?>

	              <?php if($linkedin){ ?>
                  <li>
                    Linkedin
                    <div><span id="todayspark5" class="spark"></span></div>
                    <div class="datas-text"><?php echo $total_linkedin;?> clique(s)</div>
                  </li>
                <?php } ?>
                
                                                                                                                          
              </ul> 
              
            </div>
          </div>

          <!-- Today status ends -->

          <!-- Dashboard Graph starts -->

          <div class="row">
            <div class="col-md-12">

              <!-- Widget -->
              <div class="widget">
                <!-- Widget head -->
                <div class="widget-head">
                  <div class="pull-left">Número de visitas</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>              

                <!-- Widget content -->
                <div class="widget-content">
                  <div class="padd">

                    <!-- Curve chart (Blue color). jQuery Flot plugin used. -->
                    <div class="curve-chart-visitas" id="curve-chart"></div>

                    <hr />
                    <!-- Hover location -->
                    <div id="hoverdata">Acessos / Dia:
                    (<span id="x">0</span>, <span id="y">0</span>). <span id="clickdata"></span></div>          

                    <!-- Skil this line. <div class="uni"><input id="enableTooltip" type="checkbox">Enable tooltip</div> -->

                  </div>
                </div>
                <!-- Widget ends -->

              </div>
            </div>

          </div>


          <!-- Dashboard graph ends -->

          

          <div class="row">
            <div class="col-md-12">

              <!-- Widget -->
              <div class="widget">
                <!-- Widget head -->
                <div class="widget-head">
                  <div class="pull-left">Taxa % de rejeição</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>              

                <!-- Widget content -->
                <div class="widget-content">
                  <div class="padd">

                    <!-- Curve chart (Blue color). jQuery Flot plugin used. -->
                    <div class="curve-chart-rejeicao" id="curve-chart"></div>

                    <hr />
                    <!-- Hover location -->
                    <div id="hoverdata">Rejeição / Dia:
                    (<span id="x2">0</span>, <span id="y2">0</span>). <span id="clickdata-rejeicao"></span></div>          

                    <!-- Skil this line. <div class="uni"><input id="enableTooltip" type="checkbox">Enable tooltip</div> -->

                  </div>
                </div>
                <!-- Widget ends -->

              </div>
            </div>
                 
          
          </div>
          
          <div class="row">
          
          <div class="col-md-12">

              <!-- Widget -->
              <div class="widget">
                <!-- Widget head -->
                <div class="widget-head">
                  <div class="pull-left">Taxa de conversão - Contatos e Vender Consórcio</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>              

                <!-- Widget content -->
                <div class="widget-content">
                  <div class="padd">

                    <!-- Curve chart (Blue color). jQuery Flot plugin used. -->
                    <div class="curve-chart-conversao" id="curve-chart"></div>

                    <hr />
                    <!-- Hover location -->
                    <div id="hoverdata">Conversão / Dia:
                    (<span id="x3">0</span>, <span id="y3">0</span>). <span id="clickdata-conversao"></span></div>          

                    <!-- Skil this line. <div class="uni"><input id="enableTooltip" type="checkbox">Enable tooltip</div> -->

                  </div>
                </div>
                <!-- Widget ends -->

              </div>
            </div>        
          
          </div>

          <div class="row">
<div class="col-md-6">
            
            <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                  <div class="pull-left">Páginas mais visitadas</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content referrer">
                  <!-- Widget content -->
                  
                  <table class="table table-striped table-bordered table-hover">
                    <tr height="39">
                      <th><center>#</center></th>
                      <th>Página</th>
                      <th><center>Visitas</center></th>
                    </tr>
          <?php $i = 1 ;?>
                    <?php foreach($arrayPaginas as $pagina=>$total){ ?>
                    <?php if($i > 15)break; ?>
                      <tr height="37">
                        <td align="center"><?php echo $i;?></td>
                        <td><?php echo $pagina;?></td>
                        <td align="center"><?php echo $total;?></td>
                      </tr>
                    <?php $i++ ;?>

                    <?php } ?>
                  </table>

                  <div class="widget-foot">
                  </div>
                </div>
            
            </div>
            
          </div>  


  <div class="col-md-6">

              <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">Análise dos últimos 30 dias</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>             

                <div class="widget-content">
                  <div class="padd">

                    <!-- Visitors, pageview, bounce rate, etc., Sparklines plugin used -->
                    <ul class="current-status">

                      <li style="height:49px;">
                        <span id="status1"></span> <span class="bold">Número de visitas: <?php echo $total_visitas;?> / mês</span>
                      </li>
                      <li style="height:48px;">
                        <span id="status2"></span> <span class="bold">Taxa de rejeição: <?php echo number_format($taxa_rejeicao, 2, ",", ".");?>% / mês</span>
                      </li>
                      <li style="height:49px;">
                        <span id="status3"></span> <span class="bold">Páginas visitadas: <?php echo $total_paginas;?> / mês</span>
                      </li>
                      <li style="height:48px;">
                        <span id="status4"></span> <span class="bold">Média de páginas por visitante: <?php echo number_format($total_paginas/$total_visitas, 2, ",", ".");?> / mês</span>
                      </li>
                      <!--<li style="height:48px;">
                        <span id="status5"></span> <span class="bold">Taxa de conversão: 29%/mês</span>
                      </li>-->
                      <?php /*
                    <li style="height:48px;">
                        <span id="status6"></span> <span class="bold">Newsletter: <?php echo $total_newsletter;?> / mês</span>
                      </li>
                      */ ?>

                                                                                                   
                    </ul>

                  </div>
                </div>

              </div>

            </div>
            


<div class="col-md-6">
            
            <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">
                  <div class="pull-left">Dispositivos</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content referrer">
                  <!-- Widget content -->
                  
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th><center>#</center></th>
                      <th>Browsers</th>
                      <th>Visitas</th>
                    </tr>

                    <?php foreach($arrayDispositivo as $dispositivo=>$total){ ?>
                      <tr>
                        <td><img src="../img/icons/<?php echo getIconeDispositivo($dispositivo);?>" /></td>
                        <td><?php echo $dispositivo;?></td>
                        <td><?php echo $total;?></td>
                      </tr>
                    <?php } ?>
                  </table>

                  <div class="widget-foot">
                  </div>
                </div>
            
            </div>
            
            
                        
          </div> 

          
          </div>
          
          
          


        </div>
		  </div>

		<!-- Matter ends -->

    </div>

   <!-- Mainbar ends -->
   <div class="clearfix"></div>

</div>


<form action="" method="post" id="form">
  <input type="hidden" id="mes" name="mes">
  <input type="hidden" id="ano" name="ano">
</form>

<!-- Footer -->
  
  <?php include("../includes/footer.php"); ?>

<!-- Footer -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

<!-- JS -->

<?php include("../includes/js.php"); ?>


<!-- Script for this page -->
<script type="text/javascript">

/* Curve chart starts */

$(function () {

var sin = [], cos = [];

<?php 

  foreach($arrayGrafico1 as $dia=>$visitas){
    echo "sin.push([" . $dia . ", " . $visitas . "]);";
  }

?>

    var plot = $.plot($(".curve-chart-visitas"),
           [ { data: sin, label: "&nbsp;Visitas"} ], {
               series: {
                   lines: { show: true, fill: true},
                   points: { show: true }
               },
               grid: { hoverable: true, clickable: true, borderWidth:0 },
               yaxis: { min: 0, max: 100 },
               colors: ["#1eafed"]
             });

    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 1,
            left: x + 1,
            border: '1px solid #000',
            padding: '2px 8px',
            color: '#ccc',
            'background-color': '#FFF',
            opacity: 0.9
        }).appendTo("body").fadeIn(200);
    }
	

    var previousPoint = null;
    $(".curve-chart-visitas").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(0));
        $("#y").text(pos.y.toFixed(0));

        if ($("#enableTooltip:checked").length > 0) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(0),
                        y = item.datapoint[1].toFixed(0);
                    
                    showTooltip(item.pageX, item.pageY, 
                                item.series.label + " of " + x + " = " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
        }
    }); 

    $(".curve-chart-visitas").bind("plotclick", function (event, pos, item) {
        if (item) {
            $("#clickdata").text("Você clicou no dia " + item.datapoint[0].toFixed(0) + " com " + item.datapoint[1].toFixed(0) + " visita(s).");
            plot.highlight(item.series, item.datapoint);
        }
    });



// REJEICAO ------------------------------------------------------------------------

var sin = [], cos = [];

<?php 

  foreach($arrayGrafico2 as $dia=>$rejeicao){
    echo "sin.push([" . $dia . ", " . $rejeicao . "]);";
  }

?>

var plot2 = $.plot($(".curve-chart-rejeicao"),
           [ { data: sin, label: "&nbsp;Rejeição"} ], {
               series: {
                   lines: { show: true, fill: true},
                   points: { show: true }
               },
               grid: { hoverable: true, clickable: true, borderWidth:0 },
               yaxis: { min: 0, max: 100 },
               colors: ["#FF0000"]
             });

$(".curve-chart-rejeicao").bind("plothover", function (event, pos, item) {
        $("#x2").text(pos.x.toFixed(0));
        $("#y2").text(pos.y.toFixed(0));

        if ($("#enableTooltip:checked").length > 0) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(0),
                        y = item.datapoint[1].toFixed(0);
                    
                    showTooltip(item.pageX, item.pageY, 
                                item.series.label + " of " + x + " = " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
        }
    }); 


$(".curve-chart-rejeicao").bind("plotclick", function (event, pos, item) {
        if (item) {
			var rejeicao = ' com ' + item.datapoint[1].toFixed(0) + ' rejeições';
			
			if(item.datapoint[1].toFixed(0) == 0)
			  rejeicao = ' sem rejeições';
			if(item.datapoint[1].toFixed(0) == 1)
			  rejeicao = ' com 1 rejeição';
			
            $("#clickdata-rejeicao").text("Você clicou no dia " + item.datapoint[0].toFixed(0) + rejeicao);
            plot2.highlight(item.series, item.datapoint);
        }
    });


// CONVERSAO ----------------------------------------------------------

var sin = [], cos = [];

<?php 

  foreach($arrayGraficoContatos as $dia=>$conversao){
    echo "sin.push([" . $dia . ", " . $conversao . "]);";
  }

?>


<?php 

  foreach($arrayGraficoOrcamentos as $dia=>$conversao){
    echo "cos.push([" . $dia . ", " . $conversao . "]);";
  }

?>

<?php 
/*
  foreach($arrayGraficoChats as $dia=>$conversao){
    echo "hip.push([" . $dia . ", " . $conversao . "]);";
  }
*/
?>


var plot3 = $.plot($(".curve-chart-conversao"),
           [ { data: sin, label: " Contato(s)"}, { data: cos, label: " Vender Consórcio(s)"} ], {
               series: {
                   lines: { show: true, fill: false},
                   points: { show: true }
               },
               grid: { hoverable: true, clickable: true, borderWidth:0 },
               yaxis: { min: 0, max: 50 },
               colors: ["#FF0000", "#00FF00", "#0000FF"]
             });

$(".curve-chart-conversao").bind("plothover", function (event, pos, item) {
        $("#x3").text(pos.x.toFixed(0));
        $("#y3").text(pos.y.toFixed(0));

        if ($("#enableTooltip:checked").length > 0) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(0),
                        y = item.datapoint[1].toFixed(0);
                    
                    showTooltip(item.pageX, item.pageY, 
                                item.series.label + " of " + x + " = " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;            
            }
        }
    }); 


$(".curve-chart-conversao").bind("plotclick", function (event, pos, item) {
        if (item) {
            $("#clickdata-conversao").text("Você clicou no dia " + item.datapoint[0].toFixed(0) + " com " + item.datapoint[1].toFixed(0) + " " + item.series.label);
            plot3.highlight(item.series, item.datapoint);
        }
    });





});

/* Curve chart ends */
</script>

<script>

// FACEBOOK ----------------------------------------------------------------

$("#todayspark1").sparkline([<?php echo $dias_facebook;?>], {
    type: 'bar',
    height: '30',
	width: '150',
    barWidth: 5,
    barColor: '#3b5999'});
	
$("#todayspark2").sparkline([<?php echo $dias_twitter;?>], {
    type: 'bar',
    height: '30',
	width: '150',
    barWidth: 5,
    barColor: '#32cbfe'});
	
$("#todayspark3").sparkline([<?php echo $dias_instagram;?>], {
    type: 'bar',
    height: '30',
	width: '150',
    barWidth: 5,
    barColor: '#915d47'});
	
$("#todayspark4").sparkline([<?php echo $dias_google;?>], {
    type: 'bar',
    height: '30',
	width: '100',
    barWidth: 5,
    barColor: '#df4b38'});
	
$("#todayspark5").sparkline([<?php echo $dias_linkedin;?>], {
    type: 'bar',
    height: '30',
	width: '150',
    barWidth: 5,
    barColor: '#006699'});
	
$("#todayspark6").sparkline([<?php echo $dias_youtube;?>], {
    type: 'bar',
    height: '30',
	width: '150',
    barWidth: 5,
    barColor: '#cb2027'});		

function setMesAno(mes, ano){
  $("#mes").val(mes);
  $("#ano").val(ano);

  $("#form").submit();

}
</script>

</body>
</html>