<?php

	if(@is_file("../../../api/functions.class.inc"))
		$dir = "../../../";
	if(@is_file("../../api/functions.class.inc"))
		$dir = "../../";
	if(@is_file("../api/functions.class.inc"))
		$dir = "../";
	if(@is_file("api/functions.class.inc"))
		$dir = "";


    require_once($dir . "api/connector.class.inc");
    require_once($dir . "api/sql.class.inc");
	require_once($dir . "api/functions.class.inc");
	require_once($dir . "classes/manager.class.inc");

	class classArray extends classArrayManager{}

    class dto extends dtoManager{}

     class dao extends daoManager{

	
		public function openAjax($tabela, $array=null) {
		    
			$statement = "SELECT * FROM " . $tabela . " " . $array;
			
			$this->result = Connector::executeQuery($statement, $this->link);
			$this->calculatePageCount();
			return $statement;
		}
		
		public function openConteudo($id_grupo) {
		    
			$statement = "SELECT * FROM tab_conteudo WHERE id_grupo='$id_grupo'";
			
			$this->result = Connector::executeQuery($statement, $this->link);
			$this->calculatePageCount();
			return $statement;
		}
		
		public function openQuery($tabela, $statement) {

			$this->result = Connector::executeQuery($statement, $this->link);
			$this->calculatePageCount();
			return $statement;
		}
		
		public function getBairrosSeo($id_servico, $id_bairro = 0) {

			$statement = "SELECT * FROM tab_bairro WHERE id_bairro NOT IN (SELECT id_bairro FROM tab_seo_local WHERE id_servico='".$id_servico."') OR id_bairro IN (" . $id_bairro . ") ORDER by nm_bairro";

			$this->result = Connector::executeQuery($statement, $this->link);
			$this->calculatePageCount();
			return $statement;
		}

		 public function createFolder($dir) {
			mkdir($dir, 0777);
		}

		public function updateOrdem($id, $ordinal) {

			$sql = "update tab_foto set cd_ordem='$ordinal' where id_foto='$id'";
			Connector::executeQuery($sql, Connector::getDefaultLink());

		}

		public function openBairrosSeoLocal($id_bairro = null) {

			$obj = array();

			$statement = "SELECT tb.id_bairro, tb.nm_bairro, tb.nm_cidade, tb.nm_distrito, tb.nm_observacoes, tc.nm_classe, tt.nm_tipo, tz.nm_zona
							FROM tab_bairro tb
					   LEFT JOIN tab_classe tc
					   		  ON tc.id_classe=tb.cd_classe
					   LEFT JOIN tab_zona tz
					   		  ON tz.id_zona=tb.cd_zona
					   LEFT JOIN tab_tipo tt
					   		  ON tt.id_tipo=tb.cd_tipo_moradia";

			if($id_bairro)
				$statement .= " WHERE tb.id_bairro='" . $id_bairro . "'";

			//WHERE tb.id_bairro NOT IN (SELECT id_bairro FROM tab_seo_local WHERE id_servico='".$id_servico."') OR tb.id_bairro IN (" . $id_bairro . ") 

			$result = Connector::executeQuery($statement, Connector::getDefaultLink());

			while($row = mysqli_fetch_object($result)){
				$obj[] = $row;
			}
			
			return $obj;

		}

     public function openLandingPage($codigo) {

			$obj = array();

			$statement = "SELECT tb.*, tsl.*, ts.*, tc.nm_classe, tt.nm_tipo, tz.nm_zona
			
							FROM tab_seo_local tsl
					   LEFT JOIN tab_bairro tb 
					   		  ON tsl.id_bairro=tb.id_bairro
					   LEFT JOIN tab_classe tc
					   		  ON tc.id_classe=tb.cd_classe
					   LEFT JOIN tab_zona tz
					   		  ON tz.id_zona=tb.cd_zona
					   LEFT JOIN tab_tipo tt
					   		  ON tt.id_tipo=tb.cd_tipo_moradia
					   LEFT JOIN tab_servico ts
					   		  ON ts.id_servico=tsl.id_servico
					   	   WHERE tsl.id_seo_local='" . $codigo . "'";

			$result = Connector::executeQuery($statement, Connector::getDefaultLink());

			while($row = mysqli_fetch_object($result)){
				$obj[] = $row;
			}
			
			return $obj;

		}

     	public function openServicosBairro($id_bairro) {
			$obj = array();

			$statement = "SELECT ts.nm_servico, CONCAT(ts.nm_servico, ' ', tsl.nm_chamada, ' ', tb.nm_bairro) as nm_servico_title, tu.url_padrao
							FROM tab_seo_local tsl
					   LEFT JOIN tab_servico ts
					   		  ON ts.id_servico=tsl.id_servico
					   LEFT JOIN tab_bairro tb 
					   		  ON tsl.id_bairro=tb.id_bairro
					   LEFT JOIN tab_url tu
					   		  ON tsl.id_seo_local=tu.id_tabela and tu.nm_tabela='tab_seo_local'
					   	   WHERE tsl.id_bairro='" . $id_bairro . "'";

			$result = Connector::executeQuery($statement, Connector::getDefaultLink());

			while($row = mysqli_fetch_object($result)){
				$obj[] = $row;
			}
			
			return $obj;

		}


     }

?>