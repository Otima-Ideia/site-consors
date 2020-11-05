<?php 
	require_once("../../../classes/class.inc");
	include("../../../classes/thumb.class.inc");
	
	$id_datafiles = $_REQUEST["id_datafiles"];
	$cd_pasta = $_REQUEST["cd_pasta"];
	
	if($cd_pasta != "0"){
		$dir = "../../../datafiles/".Connector::getPasta($cd_pasta);
	}else{
		$dir = "../../../datafiles/";
	}
	
	$imagem = $dir . Connector::getAllName("tab_datafiles", "nm_datafiles", "id_datafiles='" . $id_datafiles . "'");
	
	$extImg = Functions::getExtension($imagem, "jpg|jpeg|png|gif");
	$extDoc = Functions::getExtension($imagem, "doc|docx");
	$extPdf = Functions::getExtension($imagem, "pdf");
	$extXls = Functions::getExtension($imagem, "xls|xlsx");
	$extPpt = Functions::getExtension($imagem, "ppt|pptx|pps|ppsx");

	if($extImg)
		$imagem = $imagem;
	else if($extDoc)
		$imagem = "images/ico-doc.png";
	else if($extPdf)
		$imagem = "images/ico-pdf.png";
	else if($extXls)
		$imagem = "images/ico-xls.png";
	else if($extPpt)
		$imagem = "images/ico-ppt.png";
	else
		$imagem = "images/ico-outros.png";
	
	
	if( !is_file($imagem) ) $imagem = '../../../images/img-indisponivel.jpg';
	
	$largura = "116";
	$altura = "116";

	$thumb = new thumb( $imagem ); //link ou resource da imagem original
	$thumb->setDimensions( array( $largura, $altura ) ); //largura e altura da thumb, aceita arrays multidimensionais
	//$thumb->setFolder( "images/" ); //caso queira que a thumb seja salva numa pasta
	$thumb->sufix = true; //caso queira setar um sufixo -> imagem-750x320
	$thumb->setJpegQuality ( 90 ); //qualidade JPG (0-100)
	$thumb->setPngQuality ( 8 ); //qualidade do PNG (0-9)
	$thumb->setGifQuality ( 90 ); //qualidade do GIF (0-100)
	$thumb->crop = true; //se a imagem deverá ser cropada ou não
	$thumb->forceDownload ( false ); //true para setar a thumb para download
	$thumb->showBrowser ( true ); //true para setar a thumb para mostrar no navegador
	$thumb->process();
?>