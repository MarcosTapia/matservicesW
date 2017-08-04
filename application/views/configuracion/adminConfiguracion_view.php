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
        $(document).ready(function() {
                $('#example2').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );
        $(document).ready(function() {
                $('#tblSucursal').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );

        function mensaje() {
            if (document.getElementById('registroCorrecto').innerHTML != "") {
                setTimeout(function(){ location.reload(); }, 1000);
            }
        }
    </script>
</head>
<body onload="mensaje()">
<div class="container">
    <div class="row">
        <div class="col-md-12" style="border: 1px solid #FFF;border-color: red">
            <h3 style="text-align: center">Configuraci&oacute;n General del Sistema</h3>
            <?php 
                $correcto = $this->session->flashdata('correcto');
                if ($correcto) { ?>
            <span id="registroCorrecto" style="color:blue;"><?= $correcto ?></span>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="border: 1px solid #FFF;border-color: red">
            <h4>Categor&iacute;as</h4>
            <p><a class="btn btn-xs btn-success" href="nuevoCategoria">Nueva Categor&iacute;a</a>
            <a class="btn btn-xs btn-success" href="importarCategoriasExcel">Importar desde Excel</a>
            <a class="btn btn-xs btn-success" href="exportarCategoriaExcel">Exportar a Excel</a></p>
            <div class="table-responsive">     
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th>idCategor&iacute;a</th>
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
                                    <td><?php echo $fila->{'idCategoria'} ?></td>
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
                            <th>idCategor&iacute;a</th>
                            <th>Categor&iacute;a</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br><br>
            <h4>Sucursales</h4>
            <p><a class="btn btn-xs btn-success" href="nuevoSucursal">Nueva Sucursal</a>
            <a class="btn btn-xs btn-success" href="importarSucursalesExcel">Importar desde Excel</a>
            <a class="btn btn-xs btn-success" href="exportarSucursalExcel">Exportar a Excel</a></p>
            <div class="table-responsive">     
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="tblSucursal">
                    <thead>
                        <tr>
                            <th>idSucursal</th>
                            <th>Sucursal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($sucursales) {
                            $i=1;
                            foreach($sucursales as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idSucursal'} ?>">
                                    <td><?php echo $fila->{'idSucursal'} ?></td>
                                    <td><?php echo $fila->{'descripcionSucursal'} ?></td>

                                    <td><a class="btn btn-xs btn-primary" href="actualizarSucursal/<?php echo $fila->{'idSucursal'} ?>">Editar</a>
                                    <a id="elimina<?php echo $i ?>" class='btn btn-xs btn-danger' href="eliminarSucursal/<?php echo $fila->{'idSucursal'} ?>" onclick="preguntar(<?php echo $i ?>)">Borrar</a></td>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>idSucursal</th>
                            <th>Categor&iacute;a</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br>
        </div> 
        <div class="col-md-6" style="border: 1px solid #FFF;border-color: red">
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
                                    <!-- Pendiente manejo de historico de proveedores
                            <th>Historial Proveedores</th>
                            <th>Elecci&oacute;n Precio</th>
                                    Fin Pendiente manejo de historico de proveedores -->
<!--                            <th>Inventario</th>
                            <th>Ventas</th>
                            <th>Compras</th>
                            <th>Consultas</th>
                            <th>Proveedores</th>
                            <th>Clientes</th>
                            <th>Empleados</th>
                            <th>Empresa</th>-->
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
                                    <!-- Pendiente manejo de historico de proveedores
                                    <td><?php echo $fila->{'historicoProveedores'} ?></td>
                                    <td><?php echo $fila->{'criterioHistoricoProveedores'} ?></td>
                                    -->
                                    
<!--                                    <td><?php echo $fila->{'camposInventario'} ?></td>
                                    <td><?php echo $fila->{'camposVentas'} ?></td>
                                    <td><?php echo $fila->{'camposCompras'} ?></td>
                                    <td><?php echo $fila->{'camposConsultas'} ?></td>
                                    <td><?php echo $fila->{'camposProveedores'} ?></td>
                                    <td><?php echo $fila->{'camposClientes'} ?></td>
                                    <td><?php echo $fila->{'camposEmpleados'} ?></td>
                                    <td><?php echo $fila->{'camposEmpresa'} ?></td>-->
                                    
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
