<html>
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
</head>
<body>      
    <div class="container"> <!--class="container-fluid" -->
        <div class="row-fluid">
            <div class="col-sm-12">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <input type="hidden" name="imagenAntH" id="imagenAntH" value="<?php echo $inventario->{'fotoProducto'}; ?>" />
                    <input type="hidden" name="idArticulo" id="idArticulo" value="<?php echo $inventario->{'idArticulo'}; ?>" />
                    
                    <table class="table-responsive">
                        <tr>
                            <td style="width: 40%">
                                <h4>Detalle del Art&iacute;culo</h4>
                            </td>
                            <td style="width: 40%">
                                <div class="form-group">        
                                  <div class="col-sm-offset-2 col-sm-10">
                                        <a href="<?php echo base_url();?>index.php/inventarios_controller/mostrarInventarios">
                                        <button type="button" class="btn btn-primary">Regresar</button></a>
                                  </div>
                                </div>							
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%">
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="codigo">C&oacute;digo:</label>
                                  <div class="col-md-10 inputGroupContainer">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="C&oacute;digo" value="<?php echo $inventario->{'codigo'}; ?>" disabled="true" >
                                    </div>					  
                                  </div>
                                </div>  
                            </td>
                            <td style="width: 60%">
                                <div class="form-group">
                                  <label class="col-sm-5 control-label col-sm-3" for="descripcion">Descripci&oacute;n:</label>
                                  <div class="inputGroupContainer">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripci&oacute;n" value="<?php echo $inventario->{'descripcion'}; ?>" disabled="true" >
                                    </div>					  
                                  </div>
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%">
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="porcentajeImpuesto">Iva:</label>
                                  <div class="col-md-10 inputGroupContainer">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
                                        <input type="text" class="form-control" id="porcentajeImpuesto" name="porcentajeImpuesto" placeholder="Iva" value="<?php echo $inventario->{'porcentajeImpuesto'}; ?>" disabled="true" >
                                    </div>					  
                                  </div>
                                </div>  
                            </td>
                            <td style="width: 60%">
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="precioCosto">Precio Costo:</label>
                                  <div class="inputGroupContainer">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                        <input type="text" class="form-control" id="precioCosto" name="precioCosto" placeholder="Precio Costo" value="<?php echo $inventario->{'precioCosto'}; ?>" disabled="true" >
                                    </div>					  
                                  </div>
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="precioUnitario">Precio Unitario:</label>
                                  <div class="col-md-10 inputGroupContainer">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                        <input type="text" class="form-control" id="precioUnitario" name="precioUnitario" placeholder="Precio Unitario" value="<?php echo $inventario->{'precioUnitario'}; ?>" disabled="true" >
                                    </div>					  
                                  </div>
                                </div>  
                            </td>
                            <td>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="existencia">Existencia:</label>
                                  <div class="inputGroupContainer">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>
                                        <input type="text" class="form-control" id="existencia" name="existencia" placeholder="Existencia" value="<?php echo $inventario->{'existencia'}; ?>" disabled="true" >
                                    </div>					  
                                  </div>
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="existenciaMinima">Exist. M&iacute;nima:</label>
                                  <div class="col-md-10 inputGroupContainer">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>
                                        <input type="text" class="form-control" id="existenciaMinima" name="existenciaMinima" placeholder="Existencia M&iacute;nima" value="<?php echo $inventario->{'existenciaMinima'}; ?>" disabled="true" >
                                    </div>					  
                                  </div>
                                </div>  
                            </td>
                            <td>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="ubicacion">Ubicaci&oacute;n:</label>
                                  <div class="inputGroupContainer">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicaci&oacute;n" value="<?php echo $inventario->{'ubicacion'}; ?>" disabled="true" >
                                    </div>					  
                                  </div>
                                </div>  
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="proveedor">Prov.:</label>
                                  <div class="col-sm-10">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select class="form-control" name="proveedor" id="proveedor" disabled="true" >
                                          <option value=""></option>
                                          <?php foreach($proveedores as $fila) {
                                            if ($inventario->{'idProveedor'}==$fila->{'idProveedor'}) {
                                                echo "<option value=".$fila->{'idProveedor'}." selected>".$fila->{'empresa'}."</option>";
                                            } else {
                                                echo "<option value=".$fila->{'idProveedor'}.">".$fila->{'empresa'}."</option>";
                                            }
                                           } ?>
                                        </select>
                                    </div>					  
                                  </div>					  
                                </div>  
                            </td>
                            <td>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="categoria">Categor&iacute;a:</label>
                                  <div>
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select class="form-control" name="categoria" id="categoria" disabled="true" >
                                            <option value=""></option>
                                            <?php foreach($categorias as $fila) {
                                                if ($inventario->{'idCategoria'}==$fila->{'idCategoria'}) {
                                                    echo "<option value=".$fila->{'idCategoria'}." selected>".$fila->{'descripcionCategoria'}."</option>";
                                                } else {
                                                    echo "<option value=".$fila->{'idCategoria'}.">".$fila->{'descripcionCategoria'}."</option>";
                                                }
                                            } ?>
                                        </select>
                                    </div>					  
                                  </div>					  
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                  <label class="control-label col-sm-2" for="sucursal">Sucursal:</label>
                                  <div class="col-sm-10">
                                    <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                        <select class="form-control" name="sucursal" id="sucursal" disabled="true" >
                                            <option value=""></option>
                                            <?php foreach($sucursales as $fila) {
                                                if ($inventario->{'idSucursal'}==$fila->{'idSucursal'}) {
                                                    echo "<option value=".$fila->{'idSucursal'}." selected>".$fila->{'descripcionSucursal'}."</option>";
                                                } else {
                                                    echo "<option value=".$fila->{'idSucursal'}.">".$fila->{'descripcionSucursal'}."</option>";
                                                }
                                            } ?>
                                        </select>
                                    </div>					  
                                  </div>					  
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="fechaIngreso">FechaIngreso: </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-append date form_datetime"  class="input-group">
                                            <input type="text" name="fechaIngreso" id="fechaIngreso" value="<?php echo $inventario->{'fechaIngreso'}; ?>" disabled="true" >
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
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="imagen">Imagen:</label>
                                    <div>                                        
                                        <img name="imagen" id="imagen" src="<?php echo base_url()."fotos/inventario/".$inventario->{'fotoProducto'}; ?>"/>
                                    </div>		
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="observaciones">Observaciones:</label>
                                  <div>
                                      <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                          <textarea class="form-control" rows="5" id="observaciones" name="observaciones" disabled="true" ><?php echo $inventario->{'observaciones'}; ?></textarea>
                                      </div>					  
                                  </div>					  
                                </div>  
                            </td>
                        </tr>
                    </table>
            </div>	
        </div>
    </div>
    
    
<!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>-->
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>-->
</body>
</html>