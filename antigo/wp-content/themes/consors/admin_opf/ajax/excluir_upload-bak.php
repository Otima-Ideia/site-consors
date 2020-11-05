<?php

session_start();

require_once("../../api/connector.class.inc");

$ids = $_REQUEST["ids"];
$pasta = $_REQUEST["pasta"];

$ex = explode("|", $ids);


for($i=0; $i<count($ex); $i++){
	Connector::executeLoopDelete($ex[$i]);
	Connector::executeDeleteID($ex[$i]);
	
	if($pasta == $ex[$i])
			$pasta = "0";
}

echo $pasta;
?>
