<?php

require_once("../../classes/class.inc");

$ids 		= ( isset($_GET["ids"]) && $_GET["ids"] > 0 ) ? (int)$_GET["ids"] : FALSE;
$pasta 		= ( isset($_GET["pasta"]) && $_GET["pasta"] > 0 ) ? (int)$_GET["pasta"] : 0;
$nome 		= ( isset($_GET["nome"]) && strlen($_GET["nome"]) > 0 ) ? (string)$_GET["nome"] : FALSE;

if($ids > 0){
	$nm_datafiles = Connector::getAllName("tab_datafiles", "nm_datafiles", "id_datafiles = '" . $ids . "'");
	$cd_tipo = Connector::getAllName("tab_datafiles", "cd_tipo", "id_datafiles = '" . $ids . "'");
	
	if( strlen($nm_datafiles) > 0 && $nome == $nm_datafiles){
		$dir = Connector::getPasta($pasta);
		$arq = "../../datafiles/" . $dir . $nm_datafiles;
		
		if($cd_tipo == 1)
			Functions::SureRemoveDir($arq, TRUE);
		else
			unlink($arq);
		
		$sql = "delete from tab_datafiles where id_datafiles = '" . $ids . "'";
		Connector::executeQuery($sql, Connector::getDefaultLink());
	}
}

echo $nome;
?>
