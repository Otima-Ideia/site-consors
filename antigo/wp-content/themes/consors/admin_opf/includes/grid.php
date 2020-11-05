<div class="mainbar">
  
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left"><i class="fa fa-home"></i> <?php echo $titulo_pagina;?></h2>

    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
      <a href="index.html"><i class="fa fa-home"></i> Home</a> 
      <!-- Divider -->
      <span class="divider">/</span> 
      <a href="#" class="bread-current"><?php echo $titulo_pagina;?></a>
    </div>

    <div class="clearfix"></div>

    </div>
    <!-- Page heading ends -->



    <!-- Matter -->

    <div class="matter">
    
    
    <div class="container">
    
        <div class="widget">
            <div class="widget-head">
              <div class="pull-left">
                <button class="btn btn-primary" onClick="inserir();" <?php if(!$botao){ ?>disabled="disabled"<?php } ?>> Adicionar + </button>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="widget-content">
              <div class="padd">
                
                <!-- Table Page -->
                <div class="page-tables">
                    <!-- Table -->
                    <div class="table-responsive">
                        
                        <table cellpadding="0" cellspacing="0" border="0" class="display" id="data-table" >
                            <thead>
                                <tr>
                                    <?php foreach($array as $colunas){?>
                                    <th height="30"><?php echo $colunas[0];?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php for($i=0; $i < count($Obj); $i++){ ?>
                            
                                <tr height="30">
                        
                                    <?php foreach($array as $valor){ ?>

                                    <?php $label = ""; $label = $valor[0]; ?>
                                    <?php $campo = ""; $campo = $valor[1]; ?>
                                    <?php $funcao = ""; $funcao = $valor[2]; ?>
                                    
                                    <?php if(!$label){ ?>
                                    
                                    <td height="30" width="90">
                                    
                                    <button class="btn btn-xs btn-default" onClick="atualizar('<?php echo $Obj[$i]->$campo ?>');"><i class="fa fa-pencil"></i> </button>
                                    &nbsp;
                                    <button class="btn btn-xs btn-danger" data-toggle="modal" href="#myModal" onClick="excluir('<?php echo $Obj[$i]->$campo ?>');"><i class="fa fa-times"></i> </button>
                                    
                                    <?php } else{ ?>
                                    
                                      <td>
                                        <?php if($funcao){ ?>
                                          <?php echo Functions::$funcao($Obj[$i]->$campo);?>
                                        <?php }else{ ?>
                                          <?php echo $Obj[$i]->$campo;?>
                                        <?php } ?>
                                      </td>
                                    <?php } ?>
                                    
                                    <?php } ?>
                        
                                </tr>
                        
                                <?php } ?>
                            
                            </tbody>
                        </table>
                                
                        <div class="clearfix"></div>
                    </div>
                    </div>
                </div>

                
              </div>
              <div class="widget-foot text-right">
                                
              <?php if($exportacao){ ?>

                <a href="../excel/getExport.php?table=<?php echo $table; ?>">
                  Exportar <img src="../img/icons/excel.png" width="30" height="30" />
                </a>
    
              <?php } ?>

              </div>
            </div>
  
         </div>
        
    </div>

</div>