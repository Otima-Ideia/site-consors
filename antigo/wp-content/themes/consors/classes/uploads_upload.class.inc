<?php


	  $dir = "../../../";

	
       require_once($dir . "api/sql.class.inc");
       require_once($dir . "api/connector.class.inc");


     class Uploads {
            // Change this point!
            private $dirName = '../../../datafiles/uploads/'; // Directory Name!
			
            private $vars = array("link" => null, "pageSize" => 10, "totalFiles" => 0, "pageNumber" => -1, "pageCount" => -1);
			private $documents = array();
			private $rangeDocuments = array();

            private $result = null;

            public function __construct($filtro = null) {
			  $this->reader();
			  if($filtro)
			    $this->getArrayFilter($filtro);
				$this->calculatePageCount();
            }
			
			public function getArrayFilter($filtro){
			  $tempDocuments = $this->documents;
			  unset($this->documents);
			  for($i=0; $i < $this->totalFiles; $i++){
			    if(strstr($tempDocuments[$i], $filtro)){
				  $this->documents[] = $tempDocuments[$i];
				  $o++;
				}
			  }
			  $this->totalFiles = $o;
			}
			
			public function get_dirName(){
			  return $this->dirName;
			}

            public function __destruct() {
                   $this->close();
            }

			public function reader(){
			  $diretorio = dir($this->dirName);
			  $i=1;
			  while($arquivo = $diretorio->read()){
			    if($arquivo != "." && $arquivo != ".."){
				  $this->documents[] = $arquivo;
				  $i++;
				}
			  }
			  sort($this->documents);
			  $this->totalFiles = $i;
			  $this->pageSize = 20;
			}


            public function open($link) {

            }

            public function close() {

            }

            private function calculatePageCount() {
			  $this->pageCount = $this->totalFiles / $this->pageSize;
			  if($this->totalFiles % $this->pageSize > 0)
			    $this->pageCount = ceil($this->pageCount);
            }

            // Change this point!
            private function getObject($row) {

            }
            
            private function refreshData() {
			  $this->reader();
            }
            

            public function firstPage() {
			  return 1;
            }

            public function previousPage() {
			  
            }

            public function nextPage() {

            }

            public function lastPage() {
			  return $this->pageCount;
            }

			
			public function get_rangeDocuments(){
			  return $this->rangeDocuments;
			}
			
            public function gotoPage($pageNumber) {
			$pageNumber = ($pageNumber * $this->pageSize) - $this->pageSize;
			  unset($this->rangeDocuments);
			  for($i=0; $i < $this->pageSize; $i++){
			    if($this->documents[($pageNumber)+$i] != "")
			    $this->rangeDocuments[] = $this->documents[($pageNumber)+$i];
			  }
            }	

            // Change this point!
            public function insert(Genero $genero) {
                   $statement = SQL::getInsertStatement($this->tableName, $this->anyColumnList);
                   $statement = SQL::setString($statement, 'Cd_Tipologia', $genero->Cd_Tipologia);
				   $statement = SQL::setString($statement, 'Nm_Genero', $genero->Nm_Genero);
                   Connector::executeQuery($statement, $this->link);
                   $this->refreshData();
                   return $statement;
            }


            // Change this point!
            public function delete($Cd_Genero) {
                   $statement = SQL::getDeleteStatement($this->tableName, $this->keyColumnList);
                   $statement = SQL::setString($statement, 'Cd_Genero', $Cd_Genero);
                   Connector::executeQuery($statement, $this->link);
                   $this->refreshData();
                   return $statement;
            }

            // Change this point!
            public function locate($Cd_Genero) {

            }
			
            // Change this point!
            public function selectAll() {

            }

     }
?>
