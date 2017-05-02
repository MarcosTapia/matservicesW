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
            <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/configuracion_controller/nuevoCategoriaFromFormulario" method="post">
                <h4>Alta de Categor&iacute;as</h4>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="descripcionCategoria">Categor&iacute;a:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="descripcionCategoria" name="descripcionCategoria" placeholder="Descripci&oacute;n de la Categor&iacute;a">
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
        <div class="col-md-6">
            <h4 style="text-align: center">Configuraci&oacute;n General del Sistema</h4>
            <br>
            <h5>Datos de la Empresa</h5>
            <div class="table-responsive">     
                <table class="table table-striped" style="border: 1px solid #FFF;border-color: red">
                    <thead>
                        <tr>
                            <th>Empresa</th>
                            <th>RFC</th>
                            <th>Direcci&oacute;n</th>
                            <th>Email</th>
                            <th>Tel&eacute;fono</th>
                            <th>CP</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            <th>Pais</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($datosEmpresas) {
                            $i=1;
                            foreach($datosEmpresas as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idEmpresa'} ?>">
                                    <td><?php echo $fila->{'nombreEmpresa'} ?></td>
                                    <td><?php echo $fila->{'rfcEmpresa'} ?></td>
                                    <td><?php echo $fila->{'direccionEmpresa'} ?></td>
                                    <td><?php echo $fila->{'emailEmpresa'} ?></td>
                                    <td><?php echo $fila->{'telEmpresa'} ?></td>
                                    <td><?php echo $fila->{'cpEmpresa'} ?></td>
                                    <td><?php echo $fila->{'ciudadEmpresa'} ?></td>
                                    <td><?php echo $fila->{'estadoEmpresa'} ?></td>
                                    <td><?php echo $fila->{'paisEmpresa'} ?></td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="actualizarDatosEmpresa/<?php echo $fila->{'idEmpresa'} ?>">Editar</a>
                                    </td>
                                </tr>
                                <?php $i++; 
                            }   
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <!-- VALORES GENERALES DEL SISTEMA -->
            <h5>Valores Generales del Sistema</h5>
            <div class="table-responsive">     
                <table class="table table-striped" style="border: 1px solid #FFF;border-color: red">
                    <thead>
                        <tr>
                            <th>IVA</th>
                            <th>Historial Proveedores</th>
                            <th>Elecci&oacute;n Precio</th>
                            <th>Inventario</th>
                            <th>Ventas</th>
                            <th>Compras</th>
                            <th>Consultas</th>
                            <th>Proveedores</th>
                            <th>Clientes</th>
                            <th>Empleados</th>
                            <th>Empresa</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($sistemas) {
                            $i=1;
                            foreach($sistemas as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idSistema'} ?>">
                                    <td><?php echo $fila->{'ivaEmpresa'} ?></td>
                                    
                                    <td><?php echo $fila->{'historicoProveedores'} ?></td>
                                    <td><?php echo $fila->{'criterioHistoricoProveedores'} ?></td>
                                    <td><?php echo $fila->{'camposInventario'} ?></td>
                                    <td><?php echo $fila->{'camposVentas'} ?></td>
                                    <td><?php echo $fila->{'camposCompras'} ?></td>
                                    <td><?php echo $fila->{'camposConsultas'} ?></td>
                                    <td><?php echo $fila->{'camposProveedores'} ?></td>
                                    <td><?php echo $fila->{'camposClientes'} ?></td>
                                    <td><?php echo $fila->{'camposEmpleados'} ?></td>
                                    <td><?php echo $fila->{'camposEmpresa'} ?></td>
                                    
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="actualizarSistema/<?php echo $fila->{'idSistema'} ?>">Editar</a>
                                    </td>
                                </tr>
                                <?php $i++; 
                            }   
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
            <br>
            <!-- FIN VALORES GENERALES DEL SISTEMA -->
        </div>
    </div> <!-- / renglon-->
</div> <!-- /container -->
</body>	
</html>
