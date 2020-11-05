<?php 
//error_reporting(E_ALL); 
//ini_set('display_errors', '1'); 

	session_start();
	
	if(!$_SESSION["user_code"]){
		echo("<script>window.location='../index.php';</script>");
	}
	
	$table = $_REQUEST['table'];
	
	require_once("../../classes/class.inc");
	
	$nameFile = explode("_", $table);
	
	$nameFile = $nameFile[1];
	
	// --- CONEXÃO --------------------------------------------------------------
	
	$objArray = new classArray($table);
	$Objs = new dao($objArray);
	
	$Objs->link = Connector::getDefaultLink();  
	if($table == "tab_usuario"){
		$Objs->openUsuarios();
	}else{
		$Objs->open();
	}
	$Obj = $Objs->selectAll();

	// --------------------------------------------------------------------------
	
	include("excelwriter.inc.php");
	$excel = new ExcelWriter($nameFile.".xls");
	if($excel==false){
		echo $excel->error;
	}
	//Escreve o nome dos campos de uma tabela
	
	$myArr = array();
	
    foreach($_SESSION["arrayExport"] as $colunas){
	  if($colunas[0])
	    array_push($myArr, utf8_decode($colunas[0]));
	}
	
	$excel->writeLine($myArr);
	
	for($i=0; $i < count($Obj); $i++){				

	$myArr = array();
	
	foreach($_SESSION["arrayExport"] as $colunas){
	  if($colunas[0]){
	    if($colunas[2]){
	      array_push($myArr, Functions::$colunas[2](str_replace("</p>", "<br>", str_replace("<p>", "", utf8_decode($Obj[$i]->$colunas[1])))));
	    }else{
	      array_push($myArr, str_replace("</p>", "<br>", str_replace("<p>", "", utf8_decode($Obj[$i]->$colunas[1]))));
	    }
	  }
	}
		
        $excel->writeLine($myArr);
	}
	
	 $excel->close();
	
	$arquivoDestino = $nameFile.".xls";
	ob_end_clean();
	ini_set('zlib.output_compression','Off');
	header('Pragma: public');
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: pre-check=0, post-check=0, max-age=0');
	header ("Pragma: no-cache");
	header("Expires: 0");
	header('Content-Transfer-Encoding: none');
	header('Content-Type: application/vnd.ms-excel;');
	header("Content-type: application/x-msexcel");
	header('Content-Disposition: attachment; filename="'.basename($arquivoDestino).'"');
	readfile($arquivoDestino);
  
?>
