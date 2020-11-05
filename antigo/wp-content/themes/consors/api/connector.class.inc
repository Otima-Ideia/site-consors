<?php
		define('SERVIDOR', 
		$_SERVER['SERVER_NAME'] == '127.0.0.1' or 
		$_SERVER['SERVER_NAME'] == 'localhost' or 
		$_SERVER['SERVER_NAME'] == 'vitor');

		define('DOMINIO_ID', 1);
	
		if(SERVIDOR){
		define ('HTTP_HOST', 'http://'.$_SERVER['HTTP_HOST'].'/');
		}
		else{
		define ('HTTP_HOST', 'https://'.$_SERVER['HTTP_HOST'].'/');
		}  
     class Connector {
			//public static $link = null;

            private function __construct() {
            }

         
						
			public static function getDefaultLink() {
			/* Inicio Copia URL Amigavel */	
			if(SERVIDOR){

				$hostname = 'localhost';
				$username = 'root';
				$password = '';
				$database = 'local';
			
			}else{

				$hostname = 'localhost';
				$username = 'wwwconsorscom_admin';
				$password = 'y5fMpm2GPY';
				$database = 'wwwconsorscom_consors';

			}   

			/* Fim Copia URL Amigavel */             
				return self::getLink($hostname, $username, $password, $database);
            }

            public static function getLink($hostname, $username, $password, $database) {
                      $link = mysqli_connect($hostname, $username, $password)
                              or die('Não foi possível conectar: ' . mysqli_error($link));
                      mysqli_select_db($link, $database)
                      or die('Não foi possível selecionar o banco da dados ' . $database);
                   return $link;
            }
			

            public static function executeQuery($query, $link) {

//				   $link = self::getDefaultLink();

				   mysqli_query($link, "SET NAMES 'utf8'");
				   mysqli_query($link, 'SET character_set_connection=utf8');
				   mysqli_query($link, 'SET character_set_client=utf8');
				   mysqli_query($link, 'SET character_set_results=utf8');

                   $result = mysqli_query($link, $query);

                   if (!$result) die('Query inválida: ' . mysqli_error($link));

                   return $result;
            }
			
			public static function getAllName($table, $columnName, $condition){
			
				$statement = "Select $columnName from $table where $condition";
				$query = self::executeQuery($statement, self::getDefaultLink());
                if($row = mysqli_fetch_object($query)) {
                     return $row->$columnName;
                }
                return null;				
			}
			
			public static function getRangeCep($valor){
				
				$cep = Functions::getOnlyNumbers($valor);
			
				$statement = "SELECT * FROM tab_cep WHERE '" . $cep . "' BETWEEN nr_cep1 AND nr_cep2";
				$query = self::executeQuery($statement, self::getDefaultLink());
                if($row = mysqli_fetch_object($query)) {
                     return true;
                }				
			}
			
			public static function getPasta($cd_pasta=null){
				
				$caminho = false;
				$pasta = false;
				
				if($cd_pasta){
					$caminho .= "|" . self::getAllName("tab_datafiles", "nm_datafiles", "id_datafiles='" . $cd_pasta . "'") . "|";
					$pasta = self::getAllName("tab_datafiles", "cd_pasta", "id_datafiles='" . $cd_pasta . "'");
					
					if($pasta > "0"){
						$caminho .= self::getPasta($pasta);
					}
				}
				
				return trim(self::getNameFolders($caminho));
				

			}
			
			public static function getNameFolders($array=null){
				
					$lista = "";
					$list = explode("|", $array);
			
					for($n=count($list); $n >= 0; $n--){
						if($list[$n] != ""){
					    	$lista .= $list[$n] . "/" ;
						}
					}				
					return str_replace("//", "/", $lista);
			}
			
			public static function getPasta2($cd_pasta){
				$nr_pastas = self::getAllName("tab_datafiles", "COUNT(*)", "cd_tipo = '1'");
				$pasta = $cd_pasta;
				$dir = "";
				
				for($i=1; $i<=$nr_pastas; $i++){
					$pasta = self::getAllName("tab_datafiles", "cd_pasta", "id_datafiles = '" . $pasta . "'");
					if($pasta != 0){
						$dir .= self::getAllName("tab_datafiles", "nm_datafiles", "id_datafiles = '" . $pasta . "'")."/";
						$pasta = self::getAllName("tab_datafiles", "cd_pasta", "id_datafiles = '" . $pasta . "'");
					}
				}
				
				$dir = $dir . self::getAllName("tab_datafiles", "nm_datafiles", "id_datafiles = '" . $cd_pasta . "'")."/";
				
				return $dir;
			}
			
			public static function getPastaArv($cd_pasta, $dir=null){

				$dir .= "|" . $cd_pasta;
				
				$pasta = self::getAllName("tab_datafiles", "cd_pasta", "id_datafiles = '" . $cd_pasta . "'");
				
				if($pasta > 0)
				  self::getPastaArv($pasta, $dir);
				
				return $dir;
			}
			
			public static function salvarNews($nome, $email){
				
				if(!Connector::getAllName("tab_newsletter", "id_newsletter", "nm_email='" . $email . "'")){
				
				  $statement = "insert into tab_newsletter Values(null, '" . $nome . "', '" . $email . "', NOW())";
				
				  self::executeQuery($statement, self::getDefaultLink());
				}
			}
			
			public static function salvarTrabalhe($nome, $email, $fone, $estado, $cidade, $idade, $curriculo, $mensagem){
			
				  $statement = "insert into tab_trabalhe Values(null, '" . $nome . "', '" . $fone . "', '" . $email . "', '" . $estado . "', '" . $cidade . "', '" . $idade . "', '" . $mensagem . "', '" . $curriculo . "', NOW(), 1)";
				
				  self::executeQuery($statement, self::getDefaultLink());

			}
			
			public static function salvarOrcamento($nome, $email, $uf, $cidade, $agencia, $fone, $destino, $mensagem, $url){
			
				  //$statement = "insert into orcamentos_site (nome, email, uf, cidade, agencia_selecionada, telefone, opcao1, mensagem) Values(null, '" . $nome . "', '" . $email . "', '" . $uf . "', '" . $cidade . "', '" . $agencia . "', '" . $fone . "', '" . $destino . "', '" . $mensagem . "', '" . $url . "', 1, NOW())";
				  
				  $statement = "insert into orcamentos_site (nome, email, uf, cidade, agencia_selecionada, telefone, opcao1, mensagem, dtcadastro) Values('" . $nome . "', '" . $email . "', '" . $uf . "', '" . $cidade . "', '" . $agencia . "', '" . $fone . "', '" . $destino . "', '" . $mensagem . "', NOW())";
				
				  self::executeQuery($statement, self::getDefaultLink());

			}
			
			public static function salvarDepoimentos($nome, $email, $idade, $periodo, $unidade, $cidade, $depoimento, $imagem, $autorizo){
			
				  $statement = "insert into tab_depoimento Values(null, '" . $nome . "', '" . $email . "', '" . $idade . "', '" . $cidade . "', '" . $periodo . "', '" . $unidade . "', '" . $imagem . "', '" . $depoimento . "', '" . $autorizo . "', 0, NOW())";
				
				  self::executeQuery($statement, self::getDefaultLink());

			}
			
			public static function salvarContato($nome, $email, $telefone, $mensagem){
			
				  $statement = "insert into tab_contato Values(null, '" . $nome . "', '" . $email . "', '" . $telefone . "', '" . $mensagem . "', 1, NOW())";
				
				  self::executeQuery($statement, self::getDefaultLink());
			}
			
			public static function salvarQuemSomos($nome, $email, $telefone, $idade, $capital, $cidade, $mensagem){
			
				  $statement = "insert into tab_quem_somos Values(null, '" . $nome . "', '" . $email . "', '" . $telefone . "', '" . $idade . "', '" . $capital . "', '" . $cidade . "', '" . $mensagem . "', 1, NOW())";
				
				  self::executeQuery($statement, self::getDefaultLink());
			}
			
			public static function salvarVisitors($nome, $email, $pais, $assunto, $mensagem){
			
				  $statement = "insert into tab_visitor Values(null, '" . $nome . "', '" . $email . "', '" . $pais. "', '" . $assunto . "', '" . $mensagem . "', 1, NOW())";
				
				  self::executeQuery($statement, self::getDefaultLink());
			}
			
			public static function salvarOuvidoria($nome, $email, $telefone, $celular, $mensagem){
			
				  $statement = "insert into tab_ouvidoria Values(null, '" . $nome . "', '" . $email . "', '" . $telefone . "', '" . $celular . "', '" . $mensagem . "', 1, NOW())";
				
				  self::executeQuery($statement, self::getDefaultLink());
			}
			
			public static function salvarPassagem($nome, $email, $telefone, $agencia, $origem, $destino, $saida, $retorno){
			
				  $statement = "insert into tab_passagem Values(null, '" . $nome . "', '" . $email . "', '" . $telefone . "', '" . $agencia . "', '" . $origem . "', '" . $destino . "', '" . $saida . "', '" . $retorno . "', 1, NOW())";
				
				  self::executeQuery($statement, self::getDefaultLink());
			}
			
			public static function salvarSeguro($nome, $email, $telefone, $agencia, $nascimento, $duracao, $saida, $retorno){
			
				  $statement = "insert into tab_seguro Values(null, '" . $nome . "', '" . $email . "', '" . $telefone . "', '" . $agencia . "', '" . $nascimento . "', '" . $duracao . "', '" . $saida . "', '" . $retorno . "', NOW())";
				
				  self::executeQuery($statement, self::getDefaultLink());
			}
			
			public static function getPastaArv2($cd_pasta){
				$nr_pastas = self::getAllName("tab_datafiles", "COUNT(*)", "cd_tipo = '1'");
				$pasta = $cd_pasta;
				$dir = "";
				
				for($i=1; $i<=$nr_pastas; $i++){
					$pasta = self::getAllName("tab_datafiles", "cd_pasta", "id_datafiles = '" . $pasta . "'");
					if($pasta != 0){
						$dir .= "|" . $pasta;
						$pasta = self::getAllName("tab_datafiles", "cd_pasta", "id_datafiles = '" . $pasta . "'");
					}
				}
				
				$dir = $dir . "|" . $cd_pasta;

				return $dir;
			}
			
			public static function executeLoopDelete($id_pasta){
				$sql = "select * from tab_datafiles where cd_pasta = '" . $id_pasta . "'";
				$query = self::executeQuery($sql, self::getDefaultLink());
			
				while($ln = mysqli_fetch_array($query, MYSQLI_ASSOC)){
					if($ln["cd_tipo"] == 1){
						self::executeLoopDelete($ln["id_datafiles"]);
					}
				self::executeDeleteID($ln["id_datafiles"]);
				}
			}
			
			public static function executeDeleteID($id_datafiles){
				/*
				$cd_tipo = self::getAllName("tab_datafiles", "cd_tipo", "id_datafiles = '" . $id_datafiles . "'");
				$nm_datafiles = self::getAllName("tab_datafiles", "nm_datafiles", "id_datafiles = '" . $id_datafiles . "'");
				$cd_pasta = self::getAllName("tab_datafiles", "cd_pasta", "id_datafiles = '" . $id_datafiles . "'");
				
					if($cd_tipo == 1){
						 if($cd_pasta == '0'){
							 $dir = "";
						 }else{
							 $dir = self::getPasta($cd_pasta);
					     }
						 $arq = "../../datafiles/" . $dir . $nm_datafiles;
						 rmdir($arq);
					}else{
						$dir = self::getPasta($cd_pasta);
						$arq = "../../datafiles/" . $dir . $nm_datafiles;
						unlink($arq);
					}
					*/
					
				$sql = "update tab_datafiles set cd_status='1' where id_datafiles = '" . $id_datafiles . "'";
				self::executeQuery($sql, self::getDefaultLink());
			}
			
			public static function makeSelect($tabela, $campo_valor, $campo_nome, $selecionado=null, $condicao=null, $ordenacao=null, $optSeleciona=null){
				
				if($condicao)
				  $condicao = " where " . $condicao;

				if($ordenacao)
				  $ordenacao = " order by " . $ordenacao;
				
				$statement = "Select $campo_valor, $campo_nome from $tabela $condicao $ordenacao";

				$query = self::executeQuery($statement, self::getDefaultLink());
				
				if($optSeleciona != 1){				
				$lista .= "<option value=''> - Selecione - </option>";
				}
				
                while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
					
					 if($row[$campo_valor] == $selecionado){
					   $selected = "selected='selected'";
					 }else{
					   $selected = "";
					 }
					 
                     $lista .= "<option value='" . $row[$campo_valor] . "' " . $selected . ">" . $row[$campo_nome] . "</option>";
					 
                }
                return $lista;
			}
			
			
			/* Inicio Copia URL Amigavel */
			public static function getVerificarPagina($table, $url, $campo, $return, $link = null){
				
				$statement = "Select * from $table";
				$query = self::executeQuery($statement, self::getDefaultLink());
                
				while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
							
							if($link){
								$linha = permalink($row[$campo]);
							}else{
								$linha = $row[$campo];
							}
							
							if($url == $linha){
							return $row[$return];
							}						
                }
				
                return null;
				
							
			}
			
			public static function getSecao($secao){
				
				$id = Connector::getAllName("tab_conteudo", "id_conteudo", "cd_secao='" . $secao . "' and cd_status='1'");
				$nm_url = Connector::getAllName("tab_url", "nm_url", "nm_tabela='tab_conteudo' and id_tabela='" . $id . "'");
				return HTTP_HOST . $nm_url;				
			}
			
			public static function getUrl($tabela, $id){
				$url = Connector::getAllName("tab_url", "nm_url", "nm_tabela='" . $tabela . "' and id_tabela='" . $id . "'");
				
				return HTTP_HOST . $url;
			}
			
			public static function numRegistro($table, $condition) {
				
				$statement = "Select * from $table where $condition";
				$query = self::executeQuery($statement, self::getDefaultLink());
				
				if($row = mysqli_num_rows($query)) {
                     return $row;
                }
                return null;
			}
			/* Fim Copia URL Amigavel */
			
            public static function closeLink($link) {
                   try {
                       mysqli_close($link);
                   } catch(Exception $ex) {
                   }
            }
     }
?>