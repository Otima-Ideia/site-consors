<?php $objG = dao::execute("tab_grupo", "openAjax", "order by nm_grupo");?>

<div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

  <ul id="nav">
  
    
   <li class="<?php if($table == "tab_config")echo"open";?>"><a href="../configs"><i class="fa fa-magic"></i> Configs</a></li>

   <li class="<?php if($table == "tab_home")echo"open";?>"><a href="../home"><i class="fa fa-magic"></i> Home</a></li>

    <li class="<?php if($table == "tab_banner")echo"open";?>"><a href="../banners"><i class="fa fa-magic"></i> Banners</a></li>
     
     <li class="<?php if($table == "tab_grupo")echo"open";?>"><a href="../grupos"><i class="fa fa-magic"></i> Grupos</a></li>
      

      <?php for($g=0; $g < count($objG); $g++){ ?>
      
		  <li class="<?php if($table == "tab_conteudo" && $_GET["g"] == $objG[$g]->id_grupo)echo"open";?>">
      <?php if($objG[$g]->cd_modelo == 3){ ?>
      <?php $id = Connector::getAllName("tab_conteudo", "id_conteudo", "id_grupo='" . $objG[$g]->id_grupo . "'");?>

        <?php if($id == "") $id = "novo";?>

        <a href="../conteudos/formulario.php?g=<?php echo $objG[$g]->id_grupo;?>&i=<?php echo $id;?>">
          <i class="fa fa-magic"></i>
          <?php echo $objG[$g]->nm_grupo;?>
        </a>
      <?php }else{ ?>
			  <a href="../conteudos/index.php?g=<?php echo $objG[$g]->id_grupo;?>">
			    <i class="fa fa-magic"></i>
			    <?php echo $objG[$g]->nm_grupo;?>
			  </a>
      <?php } ?>


		  </li>
        
      <?php } ?>
      
      <li class="<?php if($table == "tab_faq")echo"open";?>"><a href="../faq"><i class="fa fa-magic"></i> FAQ</a></li>
           
      <li class="<?php if($table == "tab_usuario")echo"open";?>"><a href="../usuarios"><i class="fa fa-magic"></i> Usuários</a></li>
    </ul>
</div>