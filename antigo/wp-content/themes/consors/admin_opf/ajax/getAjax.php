<?php require_once("../includes/config.php"); ?>
<?php
$id = $_REQUEST["id"];
$tabela = $_REQUEST["tabela"];

if($tabela == "pais")
  $sql = "where id_idioma='" . $id . "' order by nm_pais";
  
if($tabela == "cidade")
  $sql = "where id_pais='" . $id . "' order by nm_cidade";
  
if($tabela == "curso")
  $sql = "where id_cidade='" . $id . "' order by nm_curso";
  
if($tabela == "escola")
  $sql = "where id_curso='" . $id . "' order by nm_escola";
  
if($tabela == "area")
  $sql = "where id_escola='" . $id . "' order by nm_area";
  
if($tabela == "categoria")
  $sql = "where id_grupo='" . $id . "' order by nm_categoria";
  
if($tabela == "subcategoria")
  $sql = "where id_categoria='" . $id . "' order by nm_subcategoria";

$obj = dao::execute($tabela, "Ajax", $sql);

echo "<option value = ''>Selecione</option>";

for($i=0; $i < count($obj); $i++){
  
  if($tabela == "pais")
    $lista .= "<option value='" . $obj[$i]->id_pais . "'>" . $obj[$i]->nm_pais . "</option>";
  
  if($tabela == "cidade")
    $lista .= "<option value='" . $obj[$i]->id_cidade . "'>" . $obj[$i]->nm_cidade . "</option>";
  
  if($tabela == "curso")
    $lista .= "<option value='" . $obj[$i]->id_curso . "'>" . $obj[$i]->nm_curso . "</option>";
  
  if($tabela == "escola")
    $lista .= "<option value='" . $obj[$i]->id_escola . "'>" . $obj[$i]->nm_escola . "</option>";
  
  if($tabela == "area")
    $lista .= "<option value='" . $obj[$i]->id_area . "'>" . $obj[$i]->nm_area . "</option>";
	
  if($tabela == "categoria")
    $lista .= "<option value='" . $obj[$i]->id_categoria . "'>" . $obj[$i]->nm_categoria . "</option>";
	
  if($tabela == "subcategoria")
    $lista .= "<option value='" . $obj[$i]->id_subcategoria . "'>" . $obj[$i]->nm_subcategoria . "</option>";
}

echo $lista;
?>