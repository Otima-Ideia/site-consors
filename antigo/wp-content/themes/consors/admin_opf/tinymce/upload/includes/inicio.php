<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="css/geral.css" rel="stylesheet" type="text/css" />
<link href="css/trans.css" rel="stylesheet" type="text/css" />

<?php
	@session_start();
	// --- Controle de acesso --------------------------------------------------
//	if( !isset($_SESSION["user_code"]) || $_SESSION["user_code"] < 1 ){
//		echo("<script>window.location='../index.php';</script>");
//	}
	// -------------------------------------------------------------------------
?>