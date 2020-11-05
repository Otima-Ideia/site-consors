<?php

include("classes/class.inc");

date_default_timezone_set("America/Sao_Paulo");

session_start();

$Ip = $_REQUEST["ip"];
$Dispositivo = $_REQUEST["dispositivo"];
$Session = session_id();
$Timestamp = date("Y/m/d H:i:s");
$Pagina = $_REQUEST["pagina"];

$sql = "INSERT INTO tab_acesso VALUES (NULL, '$Ip', '$Session', '$Dispositivo', '$Pagina', 0, '$Timestamp')";

Connector::executeQuery($sql, Connector::getDefaultLink());

?>