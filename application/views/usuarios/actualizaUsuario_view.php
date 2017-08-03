<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        function verificaCampos() {
            if (document.getElementById('usuario').value=="") {
                alert("Falta llenar campo usuario");
                return false;
            }
//            if (document.getElementById('clave').value=="") {
//                alert("Falta llenar campo clave");
//                return false;
//            }
            if (document.getElementById('nombre').value=="") {
                alert("Falta llenar campo nombre");
                return false;
            }
            if ((document.getElementById("chkInventario").checked==false) &&
                    (document.getElementById("chkVentas").checked==false) && 
                    (document.getElementById("chkCompras").checked==false) && 
                    (document.getElementById("chkConsultas").checked==false) && 
                    (document.getElementById("chkProveedores").checked==false) && 
                    (document.getElementById("chkClientes").checked==false) && 
                    (document.getElementById("chkEmpleados").checked==false) && 
                    (document.getElementById("chkConfiguracion").checked==false)) { 
                alert("Debes asignar por lo menos un permiso al usuario");
                return false;
            } 
            if (document.getElementById('sucursal').value=="") {
                alert("Falta seleccionar campo sucursal");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>      
    <div class="container"> <!--class="container-fluid" -->
            <div class="row-fluid">
                <div class="col-sm-9">
                    <form onsubmit="javascript:return verificaCampos();" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/usuarios_controller/actualizarUsuarioFromFormulario" method="post">
                        <h4>Actualizaci&oacute;n de Empleados</h4>
                        <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $usuario->{'idUsuario'}; ?>" />
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="usuario">Usuario*:</label>
                          <div class="col-sm-10">
                                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario->{'usuario'}; ?>" placeholder="Usuario">
                          </div>					  
                        </div>  

                        <div class="form-group">
                          <input type="hidden" name="claveAnt" value="<?php echo $usuario->{'clave'}?>" />  
                          <label class="control-label col-sm-2" for="clave">Nueva Clave:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="clave" name="clave" placeholder="Nueva Clave">
                          </div>					  
                        </div> 

                        <div class="form-group">
                            <fieldset border="3">
                                <legent>Permisos*</legent>
                                <div class="checkbox">		
                                    <label><input type="checkbox" name="chkInventario" <?php if ($usuario->{'permisos'}[0]=="1") {
                                            echo "checked";	} ?>> Inventario</label>
                                    <label><input type="checkbox" name="chkVentas" <?php if ($usuario->{'permisos'}[1]=="1") {
                                            echo "checked";	} ?>>Ventas</label>
                                    <label><input type="checkbox" name="chkCompras" <?php if ($usuario->{'permisos'}[2]=="1") {
                                            echo "checked";	} ?>>Compras</label>
                                    <label><input type="checkbox" name="chkConsultas" <?php if ($usuario->{'permisos'}[3]=="1") {
                                            echo "checked";	} ?>>Consultas</label>
                                    <label><input type="checkbox" name="chkProveedores" <?php if ($usuario->{'permisos'}[4]=="1") {
                                            echo "checked";	} ?>>Proveedores</label>
                                    <label><input type="checkbox" name="chkClientes" <?php if ($usuario->{'permisos'}[5]=="1") {
                                            echo "checked";	} ?>>Clientes</label>
                                    <label><input type="checkbox" name="chkEmpleados" <?php if ($usuario->{'permisos'}[6]=="1") {
                                            echo "checked";	} ?>>Empleados</label>
                                    <label><input type="checkbox" name="chkConfiguracion" <?php if ($usuario->{'permisos'}[7]=="1") {
                                            echo "checked";	} ?>>Configuraci&oacute;n</label>
                                </div>
                            </fieldset>	 
                        </div> 

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                          <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario->{'nombre'}; ?>" placeholder="Nombre">
                          </div>					  
                        </div> 

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="apellido_paterno">Apellido Paterno:</label>
                          <div class="col-sm-10">
                                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="<?php echo $usuario->{'apellido_paterno'}; ?>" placeholder="Apellido Paterno">
                          </div>					  
                        </div> 

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="apellido_materno">Apellido Materno:</label>
                          <div class="col-sm-10">
                                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="<?php echo $usuario->{'apellido_materno'}; ?>" placeholder="Apellido Materno">
                          </div>					  
                        </div> 

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="telefono_casa">Telefono Casa:</label>
                          <div class="col-sm-10">
                                <input type="text" class="form-control" id="telefono_casa" name="telefono_casa" value="<?php echo $usuario->{'telefono_casa'}; ?>" placeholder="C&oacute;digo">
                          </div>					  
                        </div> 

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="telefono_celular">Telefono Celular:</label>
                          <div class="col-sm-10">
                                <input type="text" class="form-control" id="telefono_celular" name="telefono_celular" value="<?php echo $usuario->{'telefono_celular'}; ?>" placeholder="Telefono Celular">
                          </div>					  
                        </div> 
                        
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="sucursal">Sucursal*:</label>
                          <div class="col-sm-10">
                            <div class="input-group">
                                <select class="form-control" name="sucursal" id="sucursal">
                                    <option value=""></option>
                                    <?php foreach($sucursales as $fila) {
                                        if ($usuario->{'idSucursal'}==$fila->{'idSucursal'}) {
                                            echo "<option value=".$fila->{'idSucursal'}." selected>".$fila->{'descripcionSucursal'}."</option>";
                                        } else {
                                            echo "<option value=".$fila->{'idSucursal'}.">".$fila->{'descripcionSucursal'}."</option>";
                                        }
                                    } ?>
                                </select>
                            </div>					  
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
                <div class="col-sm-3">		
                </div>		
            </div>
	</div>
</body>
</html>