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
<link href="<?php echo base_url();?>css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
  
    
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
    <script>
        function obtienePrecioUnitario(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            document.getElementById('precioUnitario').value = "";
            if(code == 13) { 
                var ivaDecimal;
                if (document.getElementById('porcentajeImpuesto').value=="") {
                    ivaDecimal = parseFloat(document.getElementById('ivaH').value)/100;
                } else {
                    ivaDecimal = parseFloat(document.getElementById('porcentajeImpuesto').value)/100;
                }
                var ivaCantidad = parseFloat(document.getElementById('precioCosto').value) * ivaDecimal;
                var precioUnitario = parseFloat(document.getElementById('precioCosto').value) + ivaCantidad;
                document.getElementById('precioUnitario').value = "" + precioUnitario;
                document.getElementById("existencia").focus();
                return false;
            }
        }
//        
        function habilitaSubmit() {
            document.getElementById('submit').disabled = false;
        }
    </script>
    
</head>
<body>      
    <div class="container"> <!--class="container-fluid" -->
        <div class="row-fluid">
            <div class="col-sm-1">		
            </div>		
            <div class="col-sm-6">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <form onsubmit="habilitaSubmit()" data-toggle="validator" id="productoForm" name="productoForm" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/inventarios_controller/edicionMultipleFromFormulario" method="post"  enctype="multipart/form-data" >
                    <h4 style="text-align: center">Edición Múltiple</h4>
                    <h5>Edita sólo los campos que quieras cambiar en los productos seleccionados y que van a ser iguales.</h5><br>
                    <input type="hidden" value="<?php echo $ids; ?>" name="ids" />
                    <input type="hidden" value="<?php echo $ivaEmpresa; ?>" name="ivaH" id="ivaH"/>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="codigo">C&oacute;digo:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="C&oacute;digo">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="descripcion">Descripci&oacute;n:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripci&oacute;n">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="porcentajeImpuesto">Iva:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
                            <input type="text" class="form-control" id="porcentajeImpuesto" name="porcentajeImpuesto" placeholder="Iva">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="precioCosto">Precio Costo:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input type="text" class="form-control" id="precioCosto" name="precioCosto" placeholder="Precio Costo" onkeydown="javascript: return obtienePrecioUnitario(event);">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="precioUnitario">Precio Unitario:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input type="text" class="form-control" id="precioUnitario" name="precioUnitario" placeholder="Precio Unitario" >
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="existencia">Existencia:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>
                            <input type="text" class="form-control" id="existencia" name="existencia" placeholder="Existencia">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="existenciaMinima">Existencia M&iacute;nima:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>
                            <input type="text" class="form-control" id="existenciaMinima" name="existenciaMinima" placeholder="Existencia M&iacute;nima">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="ubicacion">Ubicaci&oacute;n:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicaci&oacute;n">
                        </div>					  
                      </div>
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="proveedor">Proveedor:</label>
                      <div class="col-sm-10">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select class="form-control" name="proveedor" id="proveedor">
                              <option value=""></option>
                              <?php foreach($proveedores as $fila) {
                               echo "<option value=".$fila->{'idProveedor'}.">".$fila->{'empresa'}."</option>";
                              } ?>
                            </select>
                        </div>					  
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="categoria">Categor&iacute;a:</label>
                      <div class="col-sm-10">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select class="form-control" name="categoria" id="categoria">
                                <option value=""></option>
                                <?php foreach($categorias as $fila) {
                                 echo "<option value=".$fila->{'idCategoria'}.">".$fila->{'descripcionCategoria'}."</option>";
                                } ?>
                            </select>
                        </div>					  
                      </div>					  
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="sucursal">Sucursal:</label>
                      <div class="col-sm-10">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select class="form-control" name="sucursal" id="sucursal">
                                <option value=""></option>
                                <?php foreach($sucursales as $fila) {
                                 echo "<option value=".$fila->{'idSucursal'}.">".$fila->{'descripcionSucursal'}."</option>";
                                } ?>
                            </select>
                        </div>					  
                      </div>					  
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="fechaIngreso">FechaIngreso: </label>
                        <div class="col-md-9 inputGroupContainer">
                            <div class="input-append date form_datetime"  class="input-group"> 
                                <input type="text" value="" name="fechaIngreso" id="fechaIngreso" readonly>
                                <span class="add-on"><i class="icon-th"></i></span>
                                <script type="text/javascript">
                                    $(".form_datetime").datetimepicker({
                                        format: "yyyy-mm-dd hh:ii:ss",
                                        autoclose: true,
                                        pickerPosition: "right"
                                    });
                                </script>
                            </div>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <div class="col-sm-5">	
                            <input type="file" id="files" name="imagen"/>
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
                      <label class="control-label col-sm-3" for="observaciones">Observaciones:</label>
                      <div class="col-sm-9">
                          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                              <textarea class="form-control" rows="5" id="observaciones" name="observaciones"></textarea>
                          </div>					  
                      </div>					  
                    </div>  

                    <br><br>
                    <div class="form-group">        
                      <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" id="submit" name="submit" class="btn btn-warning">Guardar<span 
                                    class="glyphicon glyphicon-send"></span></button>
                </form>
                            <a href="<?php echo base_url();?>index.php/inventarios_controller/mostrarInventarios">
                            <button type="button" class="btn btn-danger">Regresar</button></a>
                      </div>
                    </div>							
            </div>	
            <div class="col-sm-5">		
            </div>		
        </div>
    </div>
    
</body>
</html>