<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>      
    <div class="container"> <!--class="container-fluid" -->
        <div class="row-fluid">
            <div class="col-sm-1">		
            </div>		
            <div class="col-sm-6">
                <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/usuarios_controller/nuevoUsuarioFromFormulario" method="post">
                    <h4>Nuevo Producto</h4>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="codigo">C&oacute;digo:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="codigo" name="codigo" placeholder="C&oacute;digo">
                      </div>					  
                    </div>  


                    <table>
                        <tr>
                            <td>
                                <div class="form-group">        
                                  <div class="col-sm-offset-2 col-sm-10">
                                        <?php $submitBtn = array('class' => 'btn btn-xs btn-success
                                        ',  'value' => 'Procesar', 'name'=>'submit'); 
                                        echo form_submit($submitBtn); ?>
                                  </div>
                                </div>							
                            </td>
                            <td>
                                <div class="form-group">        
                                  <div class="col-sm-offset-2 col-sm-10">
                                        <a href="<?php echo base_url();?>index.php/usuarios_controller/mostrarUsuarios">
                                        <button type="button" class="btn btn-xs btn-danger">Regresar</button>
                                        </a>
                                  </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>	
            <div class="col-sm-5">		
            </div>		
        </div>
    </div>
</body>
</html>