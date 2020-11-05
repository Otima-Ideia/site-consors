<?php 

//error_reporting(E_ALL); 
//ini_set('display_errors', '1');

require_once("../classes/class.inc");
require_once('../classes/XLSXReader/XLSXReader.php');

//$sql = "TRUNCATE TABLE tab_cliente";
//Connector::executeQuery($sql, Connector::getDefaultLink());

try{

    $arquivo = "bairros.xlsx";

    $xlsx = new XLSXReader($arquivo);

    $sheet = $xlsx->getSheet(1);

    $data = $sheet->getData();


    foreach($data as $row) {  // --- LOOP DAS LINHAS -------------------------------

      $linha++;
      $i = 0;
      
      if($linha > 1){

        $cd_estado =       $row[1];
        $nm_cidade =       $row[2];
        $nm_bairro =       $row[3];
        $cd_latitude =     $row[4];
        $cd_longitude =    $row[5];
        $url_hasmap =      $row[6];
        $tx_embed =        $row[7];

        insert($cd_estado, $nm_cidade, $nm_bairro, $cd_latitude, $cd_longitude, $url_hasmap, $tx_embed);
        
      }

    } // FINAL DO LOOP DAS LINHAS ----------------------------------------------

  } catch (Exception $ex) {

    

  } finally {
    echo "OK";
  }

 
function insert($cd_estado, $nm_cidade, $nm_bairro, $cd_latitude, $cd_longitude, $url_hasmap, $tx_embed){
 
  $sql = "INSERT INTO tab_bairro (cd_estado, nm_cidade, nm_bairro, cd_latitude, cd_longitude, url_hasmap, tx_embed)
                                             VALUES('" . $cd_estado . "', 
                                                    '" . $nm_cidade . "',
                                                    '" . $nm_bairro . "',
                                                    '" . $cd_latitude . "',
                                                    '" . $cd_longitude . "',
                                                    '" . $url_hasmap . "',
                                                    '" . $nr_fitx_embedcha . "')";

   Connector::executeQuery($sql, Connector::getDefaultLink());

  }

?>