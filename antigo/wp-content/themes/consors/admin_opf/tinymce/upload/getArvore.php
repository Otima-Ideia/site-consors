[{ icon: "images/folder.png", label: "Datafiles", expanded: true, selected: true,
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1'); 

	require_once("../../../classes/class.inc");
	$table = "tab_datafiles";
	
	$objArray = new classArray($table);
	$Objs = new dao($objArray);
	$Objs->link = Connector::getDefaultLink();  
	
	$Objs->openTree();
	$ObjTree = $Objs->selectAll();
				
		print ('items: [');	
		
		for($i=0; $i < count($ObjTree); $i++){
			echo ($Objs->getArvores($ObjTree[$i]->id_datafiles, $_POST['gerar']));		
		}
		
		print ('],');
	
?>
},];