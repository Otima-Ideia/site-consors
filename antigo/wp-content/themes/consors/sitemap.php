<?php

 //error_reporting(E_ALL); 
 //ini_set('display_errors', '1'); 

 session_start ();

 require_once ("classes/class.inc");
 
 $sitemap_id = Connector::getAllName("tab_config", "nm_valor", "nm_config='sitemap_id'");

 $Obj = dao::execute("tab_url", "openAjax", " ORDER BY id_url desc");

 $texto = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\r\n" . "\r\n";

 
 for($i=0; $i < count($Obj); $i++){

 	 if($Obj[$i]->nm_tabela == "tab_grupo"){
 	   $campo_dt = "dt_grupo";
 	   $campo_where = "id_grupo";
 	 }else if($Obj[$i]->nm_tabela == "tab_conteudo"){
 	   $campo_dt = "dt_alteracao";
 	   $campo_where = "id_conteudo";
 	 }else if($Obj[$i]->nm_tabela == "tab_seo_local"){
 	   $campo_dt = "dt_alteracao";
 	   $campo_where = "id_seo_local";
 	 }else if($Obj[$i]->nm_tabela == "tab_faq"){
 	   $campo_dt = "dt_alteracao";
 	   $campo_where = "id_faq";
 	 }

 	 if($Obj[$i]->id_url > $sitemap_id){
 	 	$prioridade = "0.80";
 	 }else{
 	 	$prioridade = "0.40";
 	 }

 	 //echo $Obj[$i]->nm_tabela . " - " . $campo_where;
 	 //echo "<br>";

 	 $data = Connector::getAllName($Obj[$i]->nm_tabela, $campo_dt, $campo_where."='" . $Obj[$i]->id_tabela . "'");

	 $texto .= '<url>' . "\r\n";
	 $texto .= '  <loc>https://www.consors.com.br/' . $Obj[$i]->nm_url . '</loc>' . "\r\n";
	 $texto .= '  <lastmod>' . str_replace(" ", "T", $data) . '+00:00</lastmod>' . "\r\n";
	 $texto .= '  <priority>' . $prioridade . '</priority>' . "\r\n";
	 $texto .= '  <changefreq>weekly</changefreq>' . "\r\n";
	 $texto .= '</url>' . "\r\n" . "\r\n";
 }

$texto .= '</urlset>';

if(is_file('sitemap.xml')){
  unlink('sitemap.xml');	
}

$fp = fopen("sitemap.xml", "a");

$escreve = fwrite($fp, $texto);

fclose($fp);

// ATUALIZAÇÃO DO ÚLTIMO ID UTILIZADO NO SITEMAP

$sql = "UPDATE tab_config SET nm_valor='" . $Obj[0]->id_url . "' WHERE nm_config='sitemap_id'";
Connector::executeQuery($sql, Connector::getDefaultLink());

// -------------------------------------------------------------------------------------------------



echo "OK";

?>

<script>
//  window.location='sys/conteudo/index.php';
</script>