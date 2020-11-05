<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

include("../../../classes/class.inc");

$table = "tab_datafiles";

$objArray = new classArray($table);
$Objs = new dao($objArray);
$Objs->link = Connector::getDefaultLink();

$gerar = $_REQUEST["gerar"];

if($gerar == 1){

  $pasta = ($_REQUEST['pasta']) ? $_REQUEST['pasta'] : "";
  $filtro = ($_REQUEST['filtro']) ? $_REQUEST['filtro'] : "";
  $pagina = ($_REQUEST['pagina']) ? $_REQUEST['pagina'] : 1;

//  $Objs->pageSize = 8;

  $Objs->openPasta($pasta, $filtro);
//  $totalPages = $Objs->pageCount;
  $ObjPasta = $Objs->selectAll();

  	if($_REQUEST['paginacao'] == 1){
		print ('P&aacute;gina <strong>' . $pagina . '</strong> de <strong>' . $totalPages . '</strong>.
				Escolha a nova p&aacute;gina:
    			<select name="selectPage" id="selectPage" class="input">');

		for($p=1; $p <= $totalPages; $p++){
			$selected = ($pagina==$p) ? 'selected="selected"' : '';
			echo '<option value="' . $p . '"' . $selected . '>' . $p . '</option>';
		}

		print ('</select>');
	}else{

     for($i=0; $i < count($ObjPasta); $i++){?>
        <div class="file" id="listarDiv_<?php echo ($i+1);?>">
        	      
                 
            <div class="img-excluir">
            	<?php if( getPerExcluir( $ObjPasta[$i]->id_datafiles ) ){?>
            		<img src="images/ico-excluir.png" onclick="fnExcluir('<?php echo ($ObjPasta[$i]->id_datafiles);?>', '<?php echo $ObjPasta[$i]->nm_datafiles;?>');" />
                <?php }?>
            </div>
            
            <div class="imagem" id="IMG_<?php echo ($ObjPasta[$i]->id_datafiles);?>">
                <?php if($ObjPasta[$i]->cd_tipo == 1){?>
                	<img src="images/pasta.png" id="<?php echo ($ObjPasta[$i]->id_datafiles);?>" ondblclick="abrir_pasta('<?php echo ($ObjPasta[$i]->id_datafiles);?>');" style="cursor:pointer"/>
                <?php }else{ ?>
                	<img src="crop.php?id_datafiles=<?php echo $ObjPasta[$i]->id_datafiles;?>&cd_pasta=<?php echo $ObjPasta[$i]->cd_pasta;?>" id="<?php echo ($ObjPasta[$i]->id_datafiles);?>" width="124" ondblclick="abrir_arquivo('<?php echo Connector::getPasta($ObjPasta[$i]->cd_pasta) . $ObjPasta[$i]->nm_datafiles;?>');" style="cursor:pointer" />
                <?php }?>
            </div>
            <div class="texto"><?php echo $ObjPasta[$i]->nm_datafiles;?></div>
        </div>
<?php
	}
	}
}

// --- NOVA PASTA -------------------------------------

if($gerar == 2){
  $nova_pasta = Functions::permalink($_REQUEST["nova_pasta"]);

  	if($_REQUEST["pAtual"] != "0"){
		$id_pasta = $_REQUEST["pAtual"];
		$dir = "../../../datafiles/" . Connector::getPasta($_REQUEST["pAtual"]);
	}else{
		$id_pasta = "0";
		$dir = "../../../datafiles/";
	}

	$exist = Connector::getAllName("tab_datafiles",
									"COUNT(*)",
									"nm_datafiles LIKE '" . $nova_pasta . "%' AND cd_tipo='1' AND  cd_pasta='" . $id_pasta . "'");
	if($exist > 0){
		$nr = ($exist + 1);
		$nova_pasta = $nova_pasta . "_" . $nr;
	}

	$arq = $dir . $nova_pasta . "/";
	mkdir($arq, 0777);

	echo $Objs->criarPasta($nova_pasta, $id_pasta);
}

// ----------------------------------------------------

// --- UPLOAD- ----------------------------------------

if($_REQUEST['funcao'] == "upload"){

	$table = "tab_datafiles";
	$objArray = new classArray($table);
  	$Objs = new dao($objArray);
  	$imgs = new dto($objArray->getArray());
  	$Objs->link = Connector::getDefaultLink();

    $images = $_FILES["files"];
	$pasta = ($_REQUEST["pUpload"]=="") ? 0 : $_REQUEST["pUpload"];

	if($pasta != "0"){
		$id_pasta = $pasta;
		$dir = "../../../datafiles/".Connector::getPasta($pasta);
	}else{
		$id_pasta = "0";
		$dir = "../../../datafiles/";
	}

    for($i=0; $i < count($images['name']); $i++){

		if($images['name'][$i] != ""){
		$ext = Functions::getExtension($images['name'][$i]);

		if(strlen($ext) == 3){
			$nomeSemExt = substr(Functions::permalink($images['name'][$i]), 0, -4);
		}else{
			$nomeSemExt = substr(Functions::permalink($images['name'][$i]), 0, -5);
		}

		$exist = Connector::getAllName("tab_datafiles",
									"COUNT(*)",
									"nm_datafiles LIKE '" . $nomeSemExt . "%' AND cd_tipo='2' AND  cd_pasta='" . $id_pasta . "'");

		if($exist > 0){
			$nr = ($exist + 1);
			$nomeSemExt = $nomeSemExt . "_" . $nr;
		}

		  $nomeComExt = $nomeSemExt . "." . $ext;

		  $novo_nome = $dir.$nomeComExt;

          //echo "[" . $images['tmp_name'][$i] . "]";
          //echo "[" . $novo_nome . "]";
          //die("ERROR");

		  move_uploaded_file($images['tmp_name'][$i], $novo_nome);

		  $imgs->nm_datafiles = $nomeComExt;
		  $imgs->cd_pasta = (int)$id_pasta;
		  $imgs->cd_tipo = 2;
		  $imgs->dt_criacao = date("Y-m-d H:i:s");

		  $Objs->insert($imgs);
		}
	}

	echo $_REQUEST["pUpload"];
  }

// ----------------------------------------------------


// ----- FUNCOES --------------------------------------
	function getPerExcluir($id){
		
		$id = (int)$id;
		$reg = 0;
		$type = (int)Connector::getAllName( "tab_datafiles", "cd_tipo", "id_datafiles=" . $id );
		
		if($type == 1)
			$reg = (int)Connector::numRegistro( "tab_datafiles", "cd_pasta=" . $id );
			
		if($reg == 0)
			return true;
		else
			return false;
		
	}
// ----------------------------------------------------
?>