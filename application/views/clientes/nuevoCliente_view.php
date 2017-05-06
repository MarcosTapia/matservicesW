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
                <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/clientes_controller/nuevoClienteFromFormulario" method="post">
                    <h4>Alta de Clientes</h4>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="empresa">Empresa:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Nombre Empresa">
                      </div>					  
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Representante">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="apellidos">Apellidos:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos Representante">
                      </div>					  
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono_casa">Tel&eacute;fono Empresa:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="telefono_casa" name="telefono_casa" placeholder="Tel&eacute;fono Empresa">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono_celular">Celular:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="telefono_celular" name="telefono_celular" placeholder="Celular Representante">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="direccion1">Direcci&oacute;n 1:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="direccion1" name="direccion1" placeholder="Direcci&oacute;n 1">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="direccion2">Direcci&oacute;n 2:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="direccion2" name="direccion2" placeholder="Direcci&oacute;n 2">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="rfc">RFC:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="ciudad">Ciudad:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="estado">Estado:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cp">CP:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="cp" name="cp" placeholder="C&oacute;digo Postal">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pais">Pa&iacute;s:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="pais" name="pais" placeholder="Pa&iacute;s">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="comentarios">Comentarios:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="comentarios" name="comentarios" placeholder="Comentarios">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="noCuenta">No. Cuenta:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="noCuenta" name="noCuenta" placeholder="No. Cuenta">
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
                                        <a href="<?php echo base_url();?>index.php/clientes_controller/mostrarClientes">
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