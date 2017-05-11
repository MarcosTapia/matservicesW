<!DOCTYPE html>
<head>
    <meta charset="utf-8"> 
    
    <title><?php if ($nombre_Empresa != "") { echo $nombre_Empresa; }?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="distributor" content="Global" />
    <meta name="revisit-after" content="7 days" />
    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/bootstrap-datetimepicker.css" rel="stylesheet">
  
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery-3.2.1.min"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/bootstrap-datetimepicker.min.js"></script>
    
    <!-- Para previsualizar la imagen -->
    <style>
          .thumb {
            height: 80px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
          }
    </style>
</head>
<body>      
    <div class="container"> <!--class="container-fluid" -->
        <div class="row-fluid">
            <div class="col-sm-1">		
            </div>		
            <div class="col-sm-6">
                <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/inventarios_controller/nuevoInventarioFromFormulario" method="post"  enctype="multipart/form-data">
                    <h4 style="text-align: center">Nuevo Producto</h4><br>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="codigo">C&oacute;digo:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="codigo" name="codigo" placeholder="C&oacute;digo">
                      </div>					  
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="descripcion">Descripci&oacute;n:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripci&oacute;n">
                      </div>					  
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="precioCosto">Precio Costo:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="precioCosto" name="precioCosto" placeholder="Precio Costo">
                      </div>					  
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="precioUnitario">Precio Unitario:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="precioUnitario" name="precioUnitario" placeholder="Precio Unitario">
                      </div>					  
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="porcentajeImpuesto">Iva:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="porcentajeImpuesto" name="porcentajeImpuesto" value="<?php echo $ivaEmpresa; ?>">
                      </div>					  
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="existencia">Existencia:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="existencia" name="existencia" placeholder="Existencia">
                      </div>					  
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="existenciaMinima">Existencia M&iacute;nima:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="existenciaMinima" name="existenciaMinima" placeholder="Existencia M&iacute;nima">
                      </div>					  
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="ubicacion">Ubicaci&oacute;n:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicaci&oacute;n">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fechaIngreso">fechaIngreso:
                        <div class="input-append date form_datetime">
                            <!-- para fecha 
                            <?php
                               //por si no se selecciona fecha
                               //$dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                               //echo $dt->format("Y m d H:i:s"); 
                            ?>
                            -->
                            <input size="16" type="text" value="" name="fechaIngreso" id="fechaIngreso" readonly>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                        </label>

                        <script type="text/javascript">
                            $(".form_datetime").datetimepicker({
                                format: "yyyy mm dd - hh:ii",
                                autoclose: true,
                                pickerPosition: "right"
                            });
                        </script> 
                    </div>                    

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="proveedor">Proveedor:</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="proveedor" id="proveedor">
                            <option value="0">Selecciona uno..</option>
                            <?php foreach($proveedores as $fila) {
                             echo "<option value=".$fila->{'idProveedor'}.">".$fila->{'empresa'}."</option>";
                            } ?>
                        </select>
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="categoria">Categor&iacute;a:</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="categoria" id="categoria">
                            <option value="0">Selecciona uno..</option>
                            <?php foreach($categorias as $fila) {
                             echo "<option value=".$fila->{'idCategoria'}.">".$fila->{'descripcionCategoria'}."</option>";
                            } ?>
                        </select>
                      </div>					  
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-5">	
                            <input type="file" id="files" name="imagen" />
                            <output id="list"></output>

                            <script>
                                  function archivo(evt) {
                                      var files = evt.target.files; // FileList object

                                      // Obtenemos la imagen del campo "file".
                                      for (var i = 0, f; f = files[i]; i++) {
                                        //Solo admitimos imágenes.
                                        if (!f.type.match('image.*')) {
                                            continue;
                                        }

                                        var reader = new FileReader();

                                        reader.onload = (function(theFile) {
                                            return function(e) {
                                              // Insertamos la imagen
                                             document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                                            };
                                        })(f);

                                        reader.readAsDataURL(f);
                                      }
                                  }
                                  document.getElementById('files').addEventListener('change', archivo, false);
                          </script>                        
                        </div>		
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="observaciones">Observaciones:</label>
                      <div class="col-sm-10">
                          <textarea class="form-control" rows="5" id="observaciones" name="observaciones"></textarea>
                      </div>					  
                    </div>  

                    <br><br>
                    <div class="form-group">        
                      <div class="col-sm-offset-2 col-sm-10">
                            <?php $submitBtn = array('class' => 'btn btn-xs btn-success
                            ',  'value' => 'Procesar', 'name'=>'submit'); 
                            echo form_submit($submitBtn); ?>
                            <a href="<?php echo base_url();?>index.php/inventarios_controller/mostrarInventarios">
                            <button type="button" class="btn btn-xs btn-danger">Regresar</button>
                            </a>
                      </div>
                    </div>							
                </form>
            </div>	
            <div class="col-sm-5">		
            </div>		
        </div>
    </div>
</body>
</html>