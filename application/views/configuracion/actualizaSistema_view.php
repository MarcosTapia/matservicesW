<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php if ($nombre_Empresa != "") { echo $nombre_Empresa; }?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="distributor" content="Global" />
    <meta itemprop="contentRating" content="General" />
    <meta name="robots" content="All" />
    <meta name="revisit-after" content="7 days" />
    <meta name="description" content="The source of truly unique and awesome jquery plugins." />
    <meta name="keywords" content="slider, carousel, responsive, swipe, one to one movement, touch devices, jquery, plugin, bootstrap compatible, html5, css3" />
    <meta name="author" content="w3widgets.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
  
                <style type="text/css" title="currentStyle">
			@import "<?php echo base_url();?>media/css/demo_page.css";
			@import "<?php echo base_url();?>media/css/demo_table.css";
		</style>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"sPaginationType": "full_numbers"
				} );
			} );
		</script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12" style="border: 1px solid #FFF;border-color: red">
            <h3 style="text-align: center">Configuraci&oacute;n General del Sistema</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6" style="border: 1px solid #FFF;border-color: red">
            <h4>Categor&iacute;as</h4>
            <p><a class="btn btn-xs btn-success" href="nuevoCategoria">Nueva Categor&iacute;a</a>
            <a class="btn btn-xs btn-success" href="importarCategoriasExcel">Importar desde Excel</a>
            <a class="btn btn-xs btn-success" href="exportarCategoriaExcel">Exportar a Excel</a></p>
            <div class="table-responsive">     
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th>Categor&iacute;a</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($categorias) {
                            $i=1;
                            foreach($categorias as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idCategoria'} ?>">
                                    <td><?php echo $fila->{'descripcionCategoria'} ?></td>

                                    <td><a class="btn btn-xs btn-primary" href="actualizarCategoria/<?php echo $fila->{'idCategoria'} ?>">Editar</a>
                                    <a id="elimina<?php echo $i ?>" class='btn btn-xs btn-danger' href="eliminarCategoria/<?php echo $fila->{'idCategoria'} ?>" onclick="preguntar(<?php echo $i ?>)">Borrar</a></td>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Categor&iacute;a</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br>
        </div>	
        <div class="col-md-6" style="border: 1px solid #FFF;border-color: red">
            <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/configuracion_controller/actualizarSistemaFromFormulario" method="post">
                <h4>Modificar Datos del Sistema</h4>
                <input type="hidden" name="idSistema" id="idSistema" value="<?php echo $sistema->{'idSistema'}; ?>" />

                <div class="form-group">
                    <label class="control-label col-sm-2" for="ivaEmpresa">IVA:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="ivaEmpresa" name="ivaEmpresa" value="<?php echo $sistema->{'ivaEmpresa'}; ?>" placeholder="IVA">
                  </div>					  
                </div>  

                <div class="form-group">
                    <fieldset border="3">
                        <legent>Historial de Precios de Proveedores:</legent>
                        <div class="checkbox">		
                            <label><input type="checkbox" name="historicoProveedores" <?php if ($sistema->{'historicoProveedores'}[0]=="1") {
                                    echo "checked";	} ?>> Trabajar con Historial de Precios de Proveedores</label>
                        </div>
                    </fieldset>	 
                </div> 
                
                <div class="form-group">
                <label for="criterioHistoricoProveedores">Selecci&oacute;n de Precios:</label>
                    <select class="form-control" name="criterioHistoricoProveedores" id="criterioHistoricoProveedores">
                        <option <?php if ($sistema->{'criterioHistoricoProveedores'}=="1") {
                            echo "selected";	} ?> value="1">El m&aacute;s Alto</option>
                        <option <?php if ($sistema->{'criterioHistoricoProveedores'}=="2") {
                                    echo "selected";	} ?> value="2">El promedio de precios</option>
                    </select>
                </div>                
                
                <div class="form-group">
                    <fieldset border="3">
                        <legent>Campos a trabajar de Inventario:</legent>
                        <div class="checkbox">		
                            <label><input type="checkbox" name="chkCamposInventarioSistema0" <?php if ($sistema->{'camposInventario'}[0]=="1") {
                                    echo "checked";	} ?>>Campo0</label>
                            <label><input type="checkbox" name="chkCamposInventarioSistema1" <?php if ($sistema->{'camposInventario'}[1]=="1") {
                                    echo "checked";	} ?>>Campo1</label>
                            <label><input type="checkbox" name="chkCamposInventarioSistema2" <?php if ($sistema->{'camposInventario'}[2]=="1") {
                                    echo "checked";	} ?>>Campo2</label>
                            <label><input type="checkbox" name="chkCamposInventarioSistema3" <?php if ($sistema->{'camposInventario'}[3]=="1") {
                                    echo "checked";	} ?>>Campo3</label>
                            <label><input type="checkbox" name="chkCamposInventarioSistema4" <?php if ($sistema->{'camposInventario'}[4]=="1") {
                                    echo "checked";	} ?>>Campo4</label>
                            <label><input type="checkbox" name="chkCamposInventarioSistema5" <?php if ($sistema->{'camposInventario'}[5]=="1") {
                                    echo "checked";	} ?>>Campo5</label>
                            <label><input type="checkbox" name="chkCamposInventarioSistema6" <?php if ($sistema->{'camposInventario'}[6]=="1") {
                                    echo "checked";	} ?>>Campo6</label>
                            <label><input type="checkbox" name="chkCamposInventarioSistema7" <?php if ($sistema->{'camposInventario'}[7]=="1") {
                                    echo "checked";	} ?>>Campo7</label>
                            <label><input type="checkbox" name="chkCamposInventarioSistema8" <?php if ($sistema->{'camposInventario'}[8]=="1") {
                                    echo "checked";	} ?>>Campo8</label>
                            <label><input type="checkbox" name="chkCamposInventarioSistema9" <?php if ($sistema->{'camposInventario'}[9]=="1") {
                                    echo "checked";	} ?>>Campo9</label>
                        </div>
                    </fieldset>	 
                </div> 

                <div class="form-group">
                    <fieldset border="3">
                        <legent>Campos a trabajar de Ventas:</legent>
                        <div class="checkbox">		
                            <label><input type="checkbox" name="chkCamposVentasSistema0" <?php if ($sistema->{'camposVentas'}[0]=="1") {
                                    echo "checked";	} ?>>Campo0</label>
                            <label><input type="checkbox" name="chkCamposVentasSistema1" <?php if ($sistema->{'camposVentas'}[1]=="1") {
                                    echo "checked";	} ?>>Campo1</label>
                            <label><input type="checkbox" name="chkCamposVentasSistema2" <?php if ($sistema->{'camposVentas'}[2]=="1") {
                                    echo "checked";	} ?>>Campo2</label>
                            <label><input type="checkbox" name="chkCamposVentasSistema3" <?php if ($sistema->{'camposVentas'}[3]=="1") {
                                    echo "checked";	} ?>>Campo3</label>
                            <label><input type="checkbox" name="chkCamposVentasSistema4" <?php if ($sistema->{'camposVentas'}[4]=="1") {
                                    echo "checked";	} ?>>Campo4</label>
                            <label><input type="checkbox" name="chkCamposVentasSistema5" <?php if ($sistema->{'camposVentas'}[5]=="1") {
                                    echo "checked";	} ?>>Campo5</label>
                            <label><input type="checkbox" name="chkCamposVentasSistema6" <?php if ($sistema->{'camposVentas'}[6]=="1") {
                                    echo "checked";	} ?>>Campo6</label>
                            <label><input type="checkbox" name="chkCamposVentasSistema7" <?php if ($sistema->{'camposVentas'}[7]=="1") {
                                    echo "checked";	} ?>>Campo7</label>
                            <label><input type="checkbox" name="chkCamposVentasSistema8" <?php if ($sistema->{'camposVentas'}[8]=="1") {
                                    echo "checked";	} ?>>Campo8</label>
                            <label><input type="checkbox" name="chkCamposVentasSistema9" <?php if ($sistema->{'camposVentas'}[9]=="1") {
                                    echo "checked";	} ?>>Campo9</label>
                        </div>
                    </fieldset>	 
                </div> 
                
                <div class="form-group">
                    <fieldset border="3">
                        <legent>Campos a trabajar de Compras:</legent>
                        <div class="checkbox">		
                            <label><input type="checkbox" name="chkCamposComprasSistema0" <?php if ($sistema->{'camposCompras'}[0]=="1") {
                                    echo "checked";	} ?>>Campo0</label>
                            <label><input type="checkbox" name="chkCamposComprasSistema1" <?php if ($sistema->{'camposCompras'}[1]=="1") {
                                    echo "checked";	} ?>>Campo1</label>
                            <label><input type="checkbox" name="chkCamposComprasSistema2" <?php if ($sistema->{'camposCompras'}[2]=="1") {
                                    echo "checked";	} ?>>Campo2</label>
                            <label><input type="checkbox" name="chkCamposComprasSistema3" <?php if ($sistema->{'camposCompras'}[3]=="1") {
                                    echo "checked";	} ?>>Campo3</label>
                            <label><input type="checkbox" name="chkCamposComprasSistema4" <?php if ($sistema->{'camposCompras'}[4]=="1") {
                                    echo "checked";	} ?>>Campo4</label>
                            <label><input type="checkbox" name="chkCamposComprasSistema5" <?php if ($sistema->{'camposCompras'}[5]=="1") {
                                    echo "checked";	} ?>>Campo5</label>
                            <label><input type="checkbox" name="chkCamposComprasSistema6" <?php if ($sistema->{'camposCompras'}[6]=="1") {
                                    echo "checked";	} ?>>Campo6</label>
                            <label><input type="checkbox" name="chkCamposComprasSistema7" <?php if ($sistema->{'camposCompras'}[7]=="1") {
                                    echo "checked";	} ?>>Campo7</label>
                            <label><input type="checkbox" name="chkCamposComprasSistema8" <?php if ($sistema->{'camposCompras'}[8]=="1") {
                                    echo "checked";	} ?>>Campo8</label>
                            <label><input type="checkbox" name="chkCamposComprasSistema9" <?php if ($sistema->{'camposCompras'}[9]=="1") {
                                    echo "checked";	} ?>>Campo9</label>
                        </div>
                    </fieldset>	 
                </div> 
                
                <div class="form-group">
                    <fieldset border="3">
                        <legent>Campos a trabajar de Consultas:</legent>
                        <div class="checkbox">		
                            <label><input type="checkbox" name="chkCamposConsultasSistema0" <?php if ($sistema->{'camposConsultas'}[0]=="1") {
                                    echo "checked";	} ?>>Campo0</label>
                            <label><input type="checkbox" name="chkCamposConsultasSistema1" <?php if ($sistema->{'camposConsultas'}[1]=="1") {
                                    echo "checked";	} ?>>Campo1</label>
                            <label><input type="checkbox" name="chkCamposConsultasSistema2" <?php if ($sistema->{'camposConsultas'}[2]=="1") {
                                    echo "checked";	} ?>>Campo2</label>
                            <label><input type="checkbox" name="chkCamposConsultasSistema3" <?php if ($sistema->{'camposConsultas'}[3]=="1") {
                                    echo "checked";	} ?>>Campo3</label>
                            <label><input type="checkbox" name="chkCamposConsultasSistema4" <?php if ($sistema->{'camposConsultas'}[4]=="1") {
                                    echo "checked";	} ?>>Campo4</label>
                            <label><input type="checkbox" name="chkCamposConsultasSistema5" <?php if ($sistema->{'camposConsultas'}[5]=="1") {
                                    echo "checked";	} ?>>Campo5</label>
                            <label><input type="checkbox" name="chkCamposConsultasSistema6" <?php if ($sistema->{'camposConsultas'}[6]=="1") {
                                    echo "checked";	} ?>>Campo6</label>
                            <label><input type="checkbox" name="chkCamposConsultasSistema7" <?php if ($sistema->{'camposConsultas'}[7]=="1") {
                                    echo "checked";	} ?>>Campo7</label>
                            <label><input type="checkbox" name="chkCamposConsultasSistema8" <?php if ($sistema->{'camposConsultas'}[8]=="1") {
                                    echo "checked";	} ?>>Campo8</label>
                            <label><input type="checkbox" name="chkCamposConsultasSistema9" <?php if ($sistema->{'camposConsultas'}[9]=="1") {
                                    echo "checked";	} ?>>Campo9</label>
                        </div>
                    </fieldset>	 
                </div> 
                
                <div class="form-group">
                    <fieldset border="3">
                        <legent>Campos a trabajar de Proveedores:</legent>
                        <div class="checkbox">		
                            <label><input type="checkbox" name="chkCamposProveedoresSistema0" <?php if ($sistema->{'camposProveedores'}[0]=="1") {
                                    echo "checked";	} ?>>Campo0</label>
                            <label><input type="checkbox" name="chkCamposProveedoresSistema1" <?php if ($sistema->{'camposProveedores'}[1]=="1") {
                                    echo "checked";	} ?>>Campo1</label>
                            <label><input type="checkbox" name="chkCamposProveedoresSistema2" <?php if ($sistema->{'camposProveedores'}[2]=="1") {
                                    echo "checked";	} ?>>Campo2</label>
                            <label><input type="checkbox" name="chkCamposProveedoresSistema3" <?php if ($sistema->{'camposProveedores'}[3]=="1") {
                                    echo "checked";	} ?>>Campo3</label>
                            <label><input type="checkbox" name="chkCamposProveedoresSistema4" <?php if ($sistema->{'camposProveedores'}[4]=="1") {
                                    echo "checked";	} ?>>Campo4</label>
                            <label><input type="checkbox" name="chkCamposProveedoresSistema5" <?php if ($sistema->{'camposProveedores'}[5]=="1") {
                                    echo "checked";	} ?>>Campo5</label>
                            <label><input type="checkbox" name="chkCamposProveedoresSistema6" <?php if ($sistema->{'camposProveedores'}[6]=="1") {
                                    echo "checked";	} ?>>Campo6</label>
                            <label><input type="checkbox" name="chkCamposProveedoresSistema7" <?php if ($sistema->{'camposProveedores'}[7]=="1") {
                                    echo "checked";	} ?>>Campo7</label>
                            <label><input type="checkbox" name="chkCamposProveedoresSistema8" <?php if ($sistema->{'camposProveedores'}[8]=="1") {
                                    echo "checked";	} ?>>Campo8</label>
                            <label><input type="checkbox" name="chkCamposProveedoresSistema9" <?php if ($sistema->{'camposProveedores'}[9]=="1") {
                                    echo "checked";	} ?>>Campo9</label>
                        </div>
                    </fieldset>	 
                </div> 
                
                <div class="form-group">
                    <fieldset border="3">
                        <legent>Campos a trabajar de Clientes:</legent>
                        <div class="checkbox">		
                            <label><input type="checkbox" name="chkCamposClientesSistema0" <?php if ($sistema->{'camposClientes'}[0]=="1") {
                                    echo "checked";	} ?>>Campo0</label>
                            <label><input type="checkbox" name="chkCamposClientesSistema1" <?php if ($sistema->{'camposClientes'}[1]=="1") {
                                    echo "checked";	} ?>>Campo1</label>
                            <label><input type="checkbox" name="chkCamposClientesSistema2" <?php if ($sistema->{'camposClientes'}[2]=="1") {
                                    echo "checked";	} ?>>Campo2</label>
                            <label><input type="checkbox" name="chkCamposClientesSistema3" <?php if ($sistema->{'camposClientes'}[3]=="1") {
                                    echo "checked";	} ?>>Campo3</label>
                            <label><input type="checkbox" name="chkCamposClientesSistema4" <?php if ($sistema->{'camposClientes'}[4]=="1") {
                                    echo "checked";	} ?>>Campo4</label>
                            <label><input type="checkbox" name="chkCamposClientesSistema5" <?php if ($sistema->{'camposClientes'}[5]=="1") {
                                    echo "checked";	} ?>>Campo5</label>
                            <label><input type="checkbox" name="chkCamposClientesSistema6" <?php if ($sistema->{'camposClientes'}[6]=="1") {
                                    echo "checked";	} ?>>Campo6</label>
                            <label><input type="checkbox" name="chkCamposClientesSistema7" <?php if ($sistema->{'camposClientes'}[7]=="1") {
                                    echo "checked";	} ?>>Campo7</label>
                            <label><input type="checkbox" name="chkCamposClientesSistema8" <?php if ($sistema->{'camposClientes'}[8]=="1") {
                                    echo "checked";	} ?>>Campo8</label>
                            <label><input type="checkbox" name="chkCamposClientesSistema9" <?php if ($sistema->{'camposClientes'}[9]=="1") {
                                    echo "checked";	} ?>>Campo9</label>
                        </div>
                    </fieldset>	 
                </div> 
                
                <div class="form-group">
                    <fieldset border="3">
                        <legent>Campos a trabajar de Empleados:</legent>
                        <div class="checkbox">		
                            <label><input type="checkbox" name="chkCamposEmpleadosSistema0" <?php if ($sistema->{'camposEmpleados'}[0]=="1") {
                                    echo "checked";	} ?>>Campo0</label>
                            <label><input type="checkbox" name="chkCamposEmpleadosSistema1" <?php if ($sistema->{'camposEmpleados'}[1]=="1") {
                                    echo "checked";	} ?>>Campo1</label>
                            <label><input type="checkbox" name="chkCamposEmpleadosSistema2" <?php if ($sistema->{'camposEmpleados'}[2]=="1") {
                                    echo "checked";	} ?>>Campo2</label>
                            <label><input type="checkbox" name="chkCamposEmpleadosSistema3" <?php if ($sistema->{'camposEmpleados'}[3]=="1") {
                                    echo "checked";	} ?>>Campo3</label>
                            <label><input type="checkbox" name="chkCamposEmpleadosSistema4" <?php if ($sistema->{'camposEmpleados'}[4]=="1") {
                                    echo "checked";	} ?>>Campo4</label>
                            <label><input type="checkbox" name="chkCamposEmpleadosSistema5" <?php if ($sistema->{'camposEmpleados'}[5]=="1") {
                                    echo "checked";	} ?>>Campo5</label>
                            <label><input type="checkbox" name="chkCamposEmpleadosSistema6" <?php if ($sistema->{'camposEmpleados'}[6]=="1") {
                                    echo "checked";	} ?>>Campo6</label>
                            <label><input type="checkbox" name="chkCamposEmpleadosSistema7" <?php if ($sistema->{'camposEmpleados'}[7]=="1") {
                                    echo "checked";	} ?>>Campo7</label>
                            <label><input type="checkbox" name="chkCamposEmpleadosSistema8" <?php if ($sistema->{'camposEmpleados'}[8]=="1") {
                                    echo "checked";	} ?>>Campo8</label>
                            <label><input type="checkbox" name="chkCamposEmpleadosSistema9" <?php if ($sistema->{'camposEmpleados'}[9]=="1") {
                                    echo "checked";	} ?>>Campo9</label>
                        </div>
                    </fieldset>	 
                </div> 
                
                <div class="form-group">
                    <fieldset border="3">
                        <legent>Campos a trabajar de Empresa:</legent>
                        <div class="checkbox">		
                            <label><input type="checkbox" name="chkCamposEmpresaSistema0" <?php if ($sistema->{'camposEmpresa'}[0]=="1") {
                                    echo "checked";	} ?>>Campo0</label>
                            <label><input type="checkbox" name="chkCamposEmpresaSistema1" <?php if ($sistema->{'camposEmpresa'}[1]=="1") {
                                    echo "checked";	} ?>>Campo1</label>
                            <label><input type="checkbox" name="chkCamposEmpresaSistema2" <?php if ($sistema->{'camposEmpresa'}[2]=="1") {
                                    echo "checked";	} ?>>Campo2</label>
                            <label><input type="checkbox" name="chkCamposEmpresaSistema3" <?php if ($sistema->{'camposEmpresa'}[3]=="1") {
                                    echo "checked";	} ?>>Campo3</label>
                            <label><input type="checkbox" name="chkCamposEmpresaSistema4" <?php if ($sistema->{'camposEmpresa'}[4]=="1") {
                                    echo "checked";	} ?>>Campo4</label>
                            <label><input type="checkbox" name="chkCamposEmpresaSistema5" <?php if ($sistema->{'camposEmpresa'}[5]=="1") {
                                    echo "checked";	} ?>>Campo5</label>
                            <label><input type="checkbox" name="chkCamposEmpresaSistema6" <?php if ($sistema->{'camposEmpresa'}[6]=="1") {
                                    echo "checked";	} ?>>Campo6</label>
                            <label><input type="checkbox" name="chkCamposEmpresaSistema7" <?php if ($sistema->{'camposEmpresa'}[7]=="1") {
                                    echo "checked";	} ?>>Campo7</label>
                            <label><input type="checkbox" name="chkCamposEmpresaSistema8" <?php if ($sistema->{'camposEmpresa'}[8]=="1") {
                                    echo "checked";	} ?>>Campo8</label>
                            <label><input type="checkbox" name="chkCamposEmpresaSistema9" <?php if ($sistema->{'camposEmpresa'}[9]=="1") {
                                    echo "checked";	} ?>>Campo9</label>
                        </div>
                    </fieldset>	 
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
                                    <a href="<?php echo base_url();?>index.php/configuracion_controller/mostrarValores">
                                    <button type="button" class="btn btn-xs btn-danger">Regresar</button>
                                    </a>
                              </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div> <!-- / renglon-->
</div> <!-- /container -->
</body>	
</html>
