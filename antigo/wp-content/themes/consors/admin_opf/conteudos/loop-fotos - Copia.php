<?php require_once("../includes/config.php"); ?>


<?php 


$id = $_REQUEST["id"]; 

$rand = rand();

if($id){
	
  $obj = dao::execute("tab_conteudo_fotos", "openAjax", "WHERE id='" . $id . "'");

  $nm_foto = $obj[0]->nm_foto;
  $nm_legenda = $obj[0]->nm_legenda;

}

?>

<?php if(!$id){ ?>

<script src="../../shadowbox/shadowbox.js" language="javascript" type="text/javascript"></script>

<script type="text/javascript">
  Shadowbox.init();
</script>

<?php } ?>

<div class="form-group" id="div<?php echo $rand?>">

<input type="hidden" name="id[]" value="<?php echo $id;?>">

<div class="form-group">

    <label class="col-lg-2 control-label">Imagem</label>

    <div class="col-lg-5" style="width:500px">

        <input type="text" class="form-control" name="nm_foto[]" id="nm_foto<?php echo $rand;?>" placeholder="Imagem" value="<?php echo $nm_foto;?>" style="width:470px;">
        
        </div>
<div style="float:left;">
      <a href="../tinymce/upload/index.php" rel="shadowbox[Mixed1];width=1024;height=600" onClick="setMyField('nm_foto<?php echo $rand;?>');"><img src="../img/icons/file_add.png" title="Adicionar Imagem" class="add ui-corner-left" border="0" height="30" /></a>        
      </div>
      


<div class="pull-left">
    <div style="float:left;"><label class="col-lg-2 control-label">Legenda</label></div>
    <div class="sw-red" style="float:left;">
      <input type="text" class="form-control" name="nm_legenda[]" id="nm_legenda" placeholder="Legenda" value="<?php echo $nm_legenda?>">

    </div>
    
  </div>
 &nbsp;&nbsp;
 <span class="" style="cursor:pointer" onClick="removerFoto('<?php echo $rand;?>', '<?php echo $id;?>');">
  <img src="../img/icons/deletar.png" width="18">
 </div>
 

<hr class="bgreen" />

</div>
 
</div>



<script>



function removerFoto(rand, id){

  document.getElementById("div"+rand).remove();

  var i = 1;

  $("#ids").val($("#ids").val() + "|" + id);

}

</script>