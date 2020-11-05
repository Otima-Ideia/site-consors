<?php
	 
	 class FunctionsManager{
		 
	     public static function getExtension($arquivo, $tipo='.*'){ // MELHORAR
		 
	        preg_match("/\.(" . $tipo . "){1}$/i", $arquivo, $ext);

		   return $ext[1];
		 }
		 
		 public static function listarPasta($dir, $pasta=null){
				$d = opendir($dir);
				$i = 0;
				$nome = readdir($d);
				while( $nome != false ){
					if(is_dir($nome) && ($pasta != '') && ($nome != '.')){
						$pastas[$i] = $nome;
								$i++;
					}
					$nome = readdir($d);
				}
				return $pastas;
			}
			
			public static function SureRemoveDir($dir, $DeleteMe) {
		
			if(!$dh = opendir($dir)) return;
			
			while (($obj = readdir($dh))) {
				if($obj=='.' || $obj=='..') continue;
				
				if(!unlink($dir.'/'.$obj)) self::SureRemoveDir($dir.'/'.$obj, true);
			}
			
			if ($DeleteMe){
				closedir($dh);
				rmdir($dir);
			}
		}
			
			public static function listarArquivos($dir){
				$d = opendir($dir);
				$i = 0;
				$nome = readdir($d);
				while( $nome != false ){
					if(!is_dir($nome) && ($nome != 'Thumbs.db') ){
						$arquivos[$i] = $nome;
								$i++;
					}					
					$nome = readdir($d);
				}
				return $arquivos;
			}
			
			public static function getFormatData($data){
			  list($dia, $hora) = explode(" ", $data);
			  list($ano, $mes, $dia) = explode("-", $dia);
			  
			  return $dia . " de " .  self::getMes($mes) . " de " . $ano;
			}
			
			
			public static function getLinkMenuGrupo($obj){
			  if($obj->nm_pagina_fixa){
				if(strpos($obj->nm_pagina_fixa, "http://") === false && strpos($obj->nm_pagina_fixa, "https://") === false)
			      return $obj->nm_pagina_fixa;
				else
				  return $obj->nm_pagina_fixa . '" target="_blank';				  
			  }else{
				  return "detalhe.php?g=".$obj->id_grupo;
			  }
			  return "#";
  			}
			
			public static function getLinkMenuCategoria($obj){
			  if($obj->nm_pagina_fixa){
				if(strpos($obj->nm_pagina_fixa, "http://") === false && strpos($obj->nm_pagina_fixa, "https://") === false)
			      return $obj->nm_pagina_fixa;
				else
				  return $obj->nm_pagina_fixa . '" target="_blank';				  
			  }else{
				  return "detalhe.php?c=".$obj->id_categoria;
			  }
			  return "#";
  			}
			
			public static function getLinkMenuSubCategoria($obj){
			  if($obj->nm_pagina_fixa){
				if(strpos($obj->nm_pagina_fixa, "http://") === false && strpos($obj->nm_pagina_fixa, "https://") === false)
			      return $obj->nm_pagina_fixa;
				else
				  return $obj->nm_pagina_fixa . '" target="_blank';
			  }else{
				  return "detalhe.php?s=".$obj->id_subcategoria;
			  }
			  return "#";
  			}
			
		  
		  public static function getConfig($config){
			    return Connector::getAllName("tab_config", "nm_valor", "nm_config='$config'");
		  }
		 
		  
		  public static function get_include_contents($filename, $ar) {
			
			if (is_file($filename)) {
			  ob_start();
			  
			  $pars = array();
			  $pars = $ar;
			  
			  include $filename;
			  $contents = ob_get_contents();
			  ob_end_clean();
			  return $contents;
			}
			return false;
		  }	
		 
		 public static function getSelected($valor, $opt){
			 if($valor == $opt)
			   echo "selected='selected'";
		 }
		 
		 public static function getChecked($opt, $valor){
			  $lista = explode("|", $opt);
			  for($i=0; $i<count($lista); $i++)
			  {
				  if($lista[$i] == $valor)
				  {
					  echo 'checked="checked"';
				  }
				  else{
					  echo '';
				  }
			  }
		 }
		 
		 public static function getDataArquivo($arquivo){
			 return date ("d/m/Y H:i:s", filemtime($arquivo)); 
		 }
	 
		 public static function goPage($page){
			   echo "<script>window.location='" . $page . "'</script>";
		 }
		 
 		 public static function getFormatNumber($valor){
			   return number_format($valor, 2, ",", ".");
		 }
		 
		public static function permalink($str, $enc = "UTF-8"){

			$arr = array('.','´','`','¨','^','~','$','!',',',';',':','?',

			'[','@','#','%','&','*','(',')','_','+','{','}','<','>','/',

			'=','º','ª','¹','²','³','£','¢','¬','§',']','"','”','“','–',"'");

			$str = str_replace($arr, '-', $str);

			

			$acentos = array(

			'A' => '/À|Á|Â|Ã|Ä|Å/',

			'a' => '/à|á|â|ã|ä|å/',

			'C' => '/Ç/',

			'c' => '/ç/',

			'E' => '/È|É|Ê|Ë/',

			'e' => '/è|é|ê|ë/',

			'I' => '/Ì|Í|Î|Ï/',

			'i' => '/ì|í|î|ï/',

			'N' => '/Ñ/',

			'n' => '/ñ/',

			'O' => '/Ò|Ó|Ô|Õ|Ö/',

			'o' => '/ò|ó|ô|õ|ö/',

			'U' => '/Ù|Ú|Û|Ü/',

			'u' => '/ù|ú|û|ü/',

			'Y' => '/Ý/',

			'y' => '/ý|ÿ/',

			'a.' => '/ª/',

			'-' => '/ |"|ˆ|´|•|“|”|–/',

			'o.' => '/º/'

			);

			$res = preg_replace($acentos, array_keys($acentos),	$str);

			$res = str_replace('----', '-', $res);

			$res = str_replace('---', '-', $res);

			$res = str_replace('--', '-', $res);

			

			$exp = strrev($res);

			$exp = substr($exp, 0, 1);

			if($exp == '-') $res = substr($res, 0, (strlen($res)-1));

			

			$res = str_replace('----', '-', $res);

			$res = str_replace('---', '-', $res);

			$res = str_replace('--', '-', $res);

			

			return strtolower($res);

		}
		 
		 public static function getOnlyNumbers($var){
  		   return preg_replace("/\D/i", '', $var);
 		 }		 
		 
		 public static function mask($val, $mask){
			 
		   $val = self::getOnlyNumbers($val);
			 
		   $maskared = '';
		   $k = 0;
		   if($mask == 'tel'){
			$cont = strlen($val);
			if($cont == 11){$mask = "(##) #####-####";}
			else{$mask = "(##) ####-####";}
		   }
		   
		   for($i = 0; $i<=strlen($mask)-1; $i++){
		 	 if($mask[$i] == '#'){
		 	   if(isset($val[$k]))
		 	     $maskared .= $val[$k++];
		 	 }else{
		 	   if(isset($mask[$i]))
		 	     $maskared .= $mask[$i];
		 	 }
		   }
		   return $maskared;
		}
		
		public static function formatMySql($dt) {
		  $dt = explode("/", $dt);
          return $dt[2] . "-" . $dt[1] . "-" . $dt[0];
        }
		
		public static function formatSoData($dt) {
		  $lista = explode(" ", $dt);
          return $lista[0];
        }
			
		public static function formatHtml($dt) {
		  if($dt){
	        $listDt = explode(" ", $dt);
		    $dt = explode("-", $listDt[0]);
		    return $dt[2] . "/" . $dt[1] . "/" . $dt[0];
		  }
		}
		
		public static function formatHtmlEnglish($dt) {
	      $listDt = explode(" ", $dt);
		  $dt = explode("-", $listDt[0]);
		  return $dt[1] . "/" . $dt[2] . "/" . $dt[0];
		}
		
		public static function getDecimal($valor){
		  return str_replace(",", ".", str_replace(".", "", $valor));
		}
		
		public static function getDateExt(){
					// leitura das datas
					$dia = date('d');
					$mes = date('m');
					$ano = date('Y');
					$semana = date('w');
					
					// configuração mes
					
					$mes = self::getMes($mes);
					
					// configuração semana
					
					$semana = self::getSemana($semana);

					//Agora basta imprimir na tela...
					
					return ("$semana, $dia de $mes de $ano");

			}
			
			public static function getDataCompleta($data){
					
					$list = explode(" ", $data);
					
					list($ano, $mes, $dia) = explode("-", $list[0]);

					$mes = self::getMes($mes);
					
					return "$dia de $mes de $ano";

			}
			
			public static function getSemana($semana){
				switch ($semana) {
					
					case 0: $semana = "Domingo"; break;
					case 1: $semana = "Segunda-feira"; break;
					case 2: $semana = "Ter&ccedil;a-feira"; break;
					case 3: $semana = "Quarta-feira"; break;
					case 4: $semana = "Quinta-feira"; break;
					case 5: $semana = "Sexta-feira"; break;
					case 6: $semana = "S&aacute;bado"; break;
					
					}
					return $semana;
			}
			
			public static function getMes($mes){
			  switch ($mes){
					
					case 1: $mes = "Janeiro"; break;
					case 2: $mes = "Fevereiro"; break;
					case 3: $mes = "Mar&ccedil;o"; break;
					case 4: $mes = "Abril"; break;
					case 5: $mes = "Maio"; break;
					case 6: $mes = "Junho"; break;
					case 7: $mes = "Julho"; break;
					case 8: $mes = "Agosto"; break;
					case 9: $mes = "Setembro"; break;
					case 10: $mes = "Outubro"; break;
					case 11: $mes = "Novembro"; break;
					case 12: $mes = "Dezembro"; break;
					
					}

				return $mes;
			}
			
			public static function getSimNao($x){
				if($x==0)
				  return "N&atilde;o";
				if($x==1)
				  return "Sim";
			}
			
			public static function getStatus($status){
		    	if($status == 0)
		     		return "Inativo";
		   		if($status == 1)
		     		return "Ativo";
	     	}
			
			public static function getEstado($estado){
		      return Connector::getAllName("tab_estado","nm_estado","id_estado='" . $estado . "'");
	        }
			
			public static function getProduto($id_produto){
		      return Connector::getAllName("tab_produto","nm_produto","id_produto='" . $id_produto . "'");
	        }
			
			public static function getVariedade($id_variedade){
		      return Connector::getAllName("tab_variedade","nm_variedade","id_variedade='" . $id_variedade . "'");
	        }
			
			public static function getLogradouro($cd_logradouro){
			 if($cd_logradouro == 1){return "Alameda";}
			 if($cd_logradouro == 2){return "Avenida";}
			 if($cd_logradouro == 3){return "Estrada";}
			 if($cd_logradouro == 4){return "Pra&ccedil;a";}
			 if($cd_logradouro == 5){return "Rodovia";}
			 if($cd_logradouro == 6){return "Rua";}
			 if($cd_logradouro == 7){return "Travessa";}
		   }
		   
		   public static function getSenha($v){
		     return base64_decode($v);
		   }
		   
		   public static function getMascaraCep($v){
		     return self::mask($v, "#####-###");
		   }
		   
		   public static function getMascaraTelefone($v){
		     return self::mask($v, "tel");
		   }
		   
		   public static function getMascaraCPF($v){
		     return self::mask($v, "###.###.###-##");
		   }
		   
		   public static function getSecao($x){
			 return Connector::getAllName("tab_secao", "nm_secao", "id_secao='" . $x . "'");  
		   }
 
	 }
	 
?>