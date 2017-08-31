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
        
        .seleccion {
            padding: 0.2em;
            border: .5px solid #98be10;
            background: #f6feda;
        }
    </style>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>media/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
                $('#examplePedidos').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );
        $(document).ready(function() {
                $('#example2Pedidos').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );
        $(document).ready(function() {
                $('#example3Pedidos').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );            
        $(document).ready(function() {
                $('#example4Pedidos').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );            
        $(document).ready(function() {
                $('#example5Pedidos').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );            
        $(document).ready(function() {
                $('#example6Pedidos').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );            
        $(document).ready(function() {
                $('#example7Pedidos').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );            
        $(document).ready(function() {
                $('#example8Pedidos').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );            
        $(document).ready(function() {
                $('#example9Pedidos').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );            
    </script>
  
    <script language="javascript">
        function verificaSeleccion() {
            var eleccion = "<?php echo $eleccion; ?>";
            switch (eleccion) {
                case '0' : 
//                         $('#movInv1_1').toggle(2);
//                         document.getElementById("movInv1_1_1").className = "seleccion";
                         document.getElementById("contenido0").style.display = "block";
                         break;
                case '1' : $('#movInv1_1').toggle(0);
                         document.getElementById("movInv1_1_1").className = "seleccion";
                         document.getElementById("contenido1").style.display = "block";
                         break;
                case '2' : $('#vtas1').toggle(0);
                         document.getElementById("vtas1_1").className = "seleccion";
                         document.getElementById("contenido2").style.display = "block";
                         break;
                case '3' : $('#vtas1').toggle(0);
                         document.getElementById("vtas1_1").className = "seleccion";
                         document.getElementById("contenido3").style.display = "block";
                         break;
                case '4' : $('#vtas1').toggle(0);
                         document.getElementById("vtas1_1").className = "seleccion";
                         document.getElementById("contenido4").style.display = "block";
                         break;
                case '5' : $('#compras1').toggle(0);
                         document.getElementById("compras1_1").className = "seleccion";
                         document.getElementById("contenido5").style.display = "block";
                         break;
                case '6' : $('#compras1').toggle(0);
                         document.getElementById("compras1_1").className = "seleccion";
                         document.getElementById("contenido6").style.display = "block";
                         break;
                case '7' : $('#compras1').toggle(0);
                         document.getElementById("compras1_1").className = "seleccion";
                         document.getElementById("contenido7").style.display = "block";
                         break;
                case '8' : $('#vtas1').toggle(0);
                         document.getElementById("vtas1_2").className = "seleccion";
                         document.getElementById("contenido8").style.display = "block";
                         break;
                case '9' : $('#vtas1').toggle(0);
                         document.getElementById("vtas1_2").className = "seleccion";
                         document.getElementById("contenido9").style.display = "block";
                         break;
                case '10' : $('#vtas1').toggle(0);
                         document.getElementById("vtas1_2").className = "seleccion";
                         document.getElementById("contenido10").style.display = "block";
                         break;
            }
        }
        
        function verificaFechas() {
            if ((document.getElementById('fIni').value == "") || (document.getElementById('fFin').value == "")) {
                alert('Deben estar ambas fechas establecidas');
                return false;
            } 
            return true;
        }    

        function verificaFechas2() {
            if ((document.getElementById('fIni2').value == "") || (document.getElementById('fFin2').value == "")) {
                alert('Deben estar ambas fechas establecidas');
                return false;
            } 
            return true;
        }    

        function verificaFechasCompras() {
            if ((document.getElementById('fIniC').value == "") || (document.getElementById('fFinC').value == "")) {
                alert('Deben estar ambas fechas establecidas');
                return false;
            } 
            return true;
        }    

        function verificaFechasCompras2() {
            if ((document.getElementById('fIniC2').value == "") || (document.getElementById('fFinC2').value == "")) {
                alert('Deben estar ambas fechas establecidas');
                return false;
            } 
            return true;
        }    

    </script>
    
</head>
<body onload="verificaSeleccion()">
<div class="container">
    <div class="row">
        <?php 
            $correcto = $this->session->flashdata('correcto');
            if ($correcto) { ?>
        <span id="registroCorrecto" style="color:blue;"><?= $correcto ?></span>
        <?php } ?>
                
        <div class="col-md-3"> <!-- Menu-->
            <div class="span3">
                <div class="well">
                    <div>
                        <ul class="nav nav-list">
                            <li id="inicioConsultas"><label class="tree-toggle nav-list"><a href="<?php echo base_url(); ?>index.php/consultas_controller/inicioConsultas">Inicio Consultas</a></label></li>
                            <li><label class="tree-toggle nav-list">Inventarios</label>
                                <ul class="nav nav-list tree" id="movInv1_1">
                                    <li id="movInv1_1_1"><a href="<?php echo base_url(); ?>index.php/consultas_controller/movInventario">Movimientos</a></li>
                                </ul>
                            </li>
                            <li><label class="tree-toggle nav-list">Ventas</label>
                                <ul class="nav nav-list tree" id="vtas1">
                                    <li id="vtas1_1"><a href="<?php echo base_url(); ?>index.php/consultas_controller/vtasGral">General</a></li>
                                    <li id="vtas1_2"><a href="<?php echo base_url(); ?>index.php/consultas_controller/consultaPedidos">Pedidos</a></li>
                                </ul>
                            </li>
                            <li><label class="tree-toggle nav-list">Compras</label>
                                <ul class="nav nav-list tree" id="compras1">
                                    <li id="compras1_1"><a href="<?php echo base_url(); ?>index.php/consultas_controller/comprasGral">General</a></li>
                                </ul>
                            </li>
                        </ul> <!-- menu principal -->
                    </div> <!-- div de menu vertical -->
                </div> <!-- div well -->
            </div> <!-- div span3 -->
        </div> <!-- Fin Menu-->
        <div class="col-md-9">
            <div id="contenido0" style="display:none;" align="center"> <!-- Div Inicio -->
                <br>
                <img src="<?php echo base_url(); ?>/images/seccionconsultas.png" />
                <br><br><br><br>
                <p style="font-style: oblique;font-size: 50px;text-align: center">Secci&oacute;n de Consultas</p>
                <br><br>
            </div> <!-- Fin Div Inicio -->
            
            <div id="contenido1" style="display:none;" class="table-responsive"> <!-- Div Movimientos -->
                <br>
                <h4 style="text-align: center">Movimientos</h4>
                <br>
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="examplePedidos">
                    <thead>
                        <tr>
                            <th>idMovimiento</th>
                            <th>Art&iacute;culo</th>
                            <th>idUsuario</th>
                            <th>tipoOperacion</th>
                            <th>cantidad</th>
                            <th>fechaOperacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($movimientos) {
                            $i=1;
                            foreach($movimientos as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idMovimiento'} ?>">
                                    <td><?php echo $fila->{'idMovimiento'} ?></td>
                                    <td><?php echo $fila->{'descripcion'} ?></td>
                                    <td><?php echo $fila->{'nombre'}." ".$fila->{'apellido_paterno'}." ".$fila->{'apellido_materno'} ?></td>
                                    <td><?php echo $fila->{'tipoOperacion'} ?></td>
                                    <td><?php echo $fila->{'cantidad'} ?></td>
                                    <td><?php echo $fila->{'fechaOperacion'} ?></td>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>idMovimiento</th>
                            <th>Art&iacute;culo</th>
                            <th>idUsuario</th>
                            <th>tipoOperacion</th>
                            <th>cantidad</th>
                            <th>fechaOperacion</th>
                        </tr>
                    </tfoot>
                </table>
                <br><br><br><br>
            </div> <!-- Div Movimientos -->
            
            <div id="contenido2" style="display:none;"> <!-- Div Ventas -->
                <br>
                <table>
                    <tr>
                        <td><h4>Ventas en General</h4></td>
                        <td style="width: 150px;"></td>
                        <td>
                            <form onsubmit="javascript: return verificaFechas()" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/consultas_controller/consultaVentasPorFechas" method="post">
                                F.Inicial: <input type="date" name="fIni" id="fIni" style="height: 25px;width: 100px;">
                                F.Final: <input type="date" name="fFin" id="fFin" style="height: 25px;width: 100px;">
                                <input type="submit" id="submit" name="submit" class="btn btn-xs btn-success" value="Buscar" />
                            </form>
                        </td>
                    </tr>
                </table>
                <br>
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example2Pedidos">
                    <thead>
                        <tr>
                            <th>idVenta</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Usuario</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($vtasGral) {
                            $i=1;
                            foreach($vtasGral as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idVenta'} ?>">
                                    <td><?php echo $fila->{'idVenta'} ?></td>
                                    <td><?php echo $fila->{'fecha'} ?></td>
                                    <td><?php echo $fila->{'nom'}." ".$fila->{'apellidos'} ?></td>
                                    <td><?php echo $fila->{'nombre'}." ".$fila->{'apellido_paterno'}." ".$fila->{'apellido_materno'} ?></td>
                                    <td><?php echo $fila->{'observaciones'} ?></td>
                                    <td><a class="btn btn-xs btn-primary" href="consultaDetalle/<?php echo $fila->{'idVenta'} ?>">Ver Detalle</a>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>idVenta</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Usuario</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <br><br><br><br>
            </div>  <!-- Fin Div Ventas -->
            
            <div id="contenido3" style="display:none;">  <!-- Div DetalleVenta -->
                <br>
                <h4 style="text-align: center">Detalle Venta</h4>
                <br>
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example3Pedidos">
                    <thead>
                        <tr>
                            <th>idVenta</th>
                            <th>Articulo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Descuento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($detalleVenta) {
                            $i=1;
                            foreach($detalleVenta as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idDetalleVenta'} ?>">
                                    <td><?php echo $fila->{'idVenta'} ?></td>
                                    <td><?php echo $fila->{'descripcion'} ?></td>
                                    <td><?php echo $fila->{'precio'} ?></td>
                                    <td><?php echo $fila->{'cantidad'} ?></td>
                                    <td><?php echo $fila->{'descuento'} ?></a>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>idVenta</th>
                            <th>Articulo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Descuento</th>
                        </tr>
                    </tfoot>
                </table>
                <br><br><br><br>
            </div> <!-- Fin Div DetalleVenta -->            
            
            <div id="contenido4" style="display:none;"> <!-- Div consulta Venta por fechas -->
                <br>
                <table>
                    <tr>
                        <td><h4>Ventas por Fechas</h4></td>
                        <td style="width: 150px;"></td>
                        <td>
                            <form onsubmit="javascript: return verificaFechas2()"  class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/consultas_controller/consultaVentasPorFechas" method="post">
                                F.Inicial: <input type="date" name="fIni2" id="fIni2" style="height: 25px;width: 100px;">
                                F.Final: <input type="date" name="fFin2" id="fFin2" style="height: 25px;width: 100px;">
                                <input type="submit" id="submit" name="submit" class="btn btn-xs btn-success" value="Buscar" />
                            </form>
                        </td>
                    </tr>
                </table>
                <br>
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example4Pedidos">
                    <thead>
                        <tr>
                            <th>idVenta</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Usuario</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($ventasPorFecha) {
                            $i=1;
                            foreach($ventasPorFecha as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idVenta'} ?>">
                                    <td><?php echo $fila->{'idVenta'} ?></td>
                                    <td><?php echo $fila->{'fecha'} ?></td>
                                    <td><?php echo $fila->{'nom'}." ".$fila->{'apellidos'} ?></td>
                                    <td><?php echo $fila->{'nombre'}." ".$fila->{'apellido_paterno'}." ".$fila->{'apellido_materno'} ?></td>
                                    <td><?php echo $fila->{'observaciones'} ?></td>
                                    <td><a class="btn btn-xs btn-primary" href="consultaDetalle/<?php echo $fila->{'idVenta'} ?>">Ver Detalle</a>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>idVenta</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Usuario</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <br><br><br><br>
            </div>  <!-- Fin Div consulta Venta por fechas -->
            
            <div id="contenido5" style="display:none;">  <!-- Div consulta Compras -->
                <br>
                <table>
                    <tr>
                        <td><h4>Compras en General</h4></td>
                        <td style="width: 150px;"></td>
                        <td>
                            <form onsubmit="javascript: return verificaFechasCompras()" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/consultas_controller/consultaComprasPorFechas" method="post">
                                F.Inicial: <input type="date" name="fIniC" id="fIniC" style="height: 25px;width: 100px;">
                                F.Final: <input type="date" name="fFinC" id="fFinC" style="height: 25px;width: 100px;">
                                <input type="submit" id="submit" name="submit" class="btn btn-xs btn-success" value="Buscar" />
                            </form>
                        </td>
                    </tr>
                </table>
                <br>
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example5Pedidos">
                    <thead>
                        <tr>
                            <th>idCompra</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Usuario</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($comprasGral) {
                            $i=1;
                            foreach($comprasGral as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idCompra'} ?>">
                                    <td><?php echo $fila->{'idCompra'} ?></td>
                                    <td><?php echo $fila->{'fecha'} ?></td>
                                    <td><?php echo $fila->{'nom'}." ".$fila->{'apellidos'} ?></td>
                                    <td><?php echo $fila->{'nombre'}." ".$fila->{'apellido_paterno'}." ".$fila->{'apellido_materno'} ?></td>
                                    <td><?php echo $fila->{'observaciones'} ?></td>
                                    <td><a class="btn btn-xs btn-primary" href="consultaDetalleCompra/<?php echo $fila->{'idCompra'} ?>">Ver Detalle</a>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>idCompra</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Usuario</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <br><br><br><br>
            </div>  <!-- Fin Div consulta Compras -->
            
            <div id="contenido6" style="display:none;"> <!-- Div detalleCompra -->
                <br>
                <h4 style="text-align: center">Detalle Compra</h4>
                <br>
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example6Pedidos">
                    <thead>
                        <tr>
                            <th>idCompra</th>
                            <th>Articulo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Descuento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($detalleCompra) {
                            $i=1;
                            foreach($detalleCompra as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idDetalleCompra'} ?>">
                                    <td><?php echo $fila->{'idCompra'} ?></td>
                                    <td><?php echo $fila->{'descripcion'} ?></td>
                                    <td><?php echo $fila->{'precio'} ?></td>
                                    <td><?php echo $fila->{'cantidad'} ?></td>
                                    <td><?php echo $fila->{'descuento'} ?></a>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>idCompra</th>
                            <th>Articulo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Descuento</th>
                        </tr>
                    </tfoot>
                </table>
                <br><br><br><br>
            </div> <!-- Fin Div detalleCompra -->
            
            <div id="contenido7" style="display:none;"> <!-- Div consulta Compras por Fechas -->
                <br>
                <table>
                    <tr>
                        <td><h4>Compras por Fechas</h4></td>
                        <td style="width: 150px;"></td>
                        <td>
                            <form onsubmit="javascript: return verificaFechasCompras2()"  class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/consultas_controller/consultaComprasPorFechas" method="post">
                                F.Inicial: <input type="date" name="fIniC2" id="fIniC2" style="height: 25px;width: 100px;">
                                F.Final: <input type="date" name="fFinC2" id="fIniC2" style="height: 25px;width: 100px;">
                                <input type="submit" id="submit" name="submit" class="btn btn-xs btn-success" value="Buscar" />
                            </form>
                        </td>
                    </tr>
                </table>
                <br>
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example7Pedidos">
                    <thead>
                        <tr>
                            <th>idCompra</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Usuario</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($comprasPorFecha) {
                            $i=1;
                            foreach($comprasPorFecha as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idCompra'} ?>">
                                    <td><?php echo $fila->{'idCompra'} ?></td>
                                    <td><?php echo $fila->{'fecha'} ?></td>
                                    <td><?php echo $fila->{'nom'}." ".$fila->{'apellidos'} ?></td>
                                    <td><?php echo $fila->{'nombre'}." ".$fila->{'apellido_paterno'}." ".$fila->{'apellido_materno'} ?></td>
                                    <td><?php echo $fila->{'observaciones'} ?></td>
                                    <td><a class="btn btn-xs btn-primary" href="consultaDetalleCompra/<?php echo $fila->{'idCompra'} ?>">Ver Detalle</a>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>idCompra</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Usuario</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <br><br><br><br>
            </div> <!-- Fin Div consulta Compras por Fechas -->
            
            <div id="contenido8" style="display:none;">  <!-- Div consulta Pedidos -->
                <br>
                <table>
                    <tr>
                        <td><h4>Listado de Pedidos</h4></td>
                        <td style="width: 150px;"></td>
                        <td>
                            <form onsubmit="javascript: return verificaFechas()" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/consultas_controller/consultaVentasPorFechas" method="post">
                                F.Inicial: <input type="date" name="fIni" id="fIni" style="height: 25px;width: 100px;">
                                F.Final: <input type="date" name="fFin" id="fFin" style="height: 25px;width: 100px;">
                                <input type="submit" id="submit" name="submit" class="btn btn-xs btn-success" value="Buscar" />
                            </form>
                        </td>
                    </tr>
                </table>
                <br>
                <p><a class="btn btn-xs btn-success" href="<?php echo base_url(); ?>index.php/ventas_controller/ventaEnBlanco/1">Nuevo Pedido</a>
                <a class="btn btn-xs btn-success" href="importarUsersExcel">Importar desde Excel</a>
                <a class="btn btn-xs btn-success" href="exportarExcel">Exportar a Excel</a></p>
                <br>
                <div class="table-responsive">     
                    <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example8Pedidos">
                        <thead>
                            <tr>
                                <th>idPedido</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Usuario</th>
                                <th>Observaciones</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($pedidos) {
                                $i=1;
                                foreach($pedidos as $fila) {
                                ?>
                                    <tr id="fila-<?php echo $fila->{'idPedido'} ?>">
                                        <td><?php echo $fila->{'idPedido'} ?></td>
                                        <td><?php echo $fila->{'fecha'} ?></td>
                                        <td><?php echo $fila->{'nom'}." ".$fila->{'apellidos'} ?></td>
                                        <td><?php echo $fila->{'nombre'}." ".$fila->{'apellido_paterno'}." ".$fila->{'apellido_materno'} ?></td>
                                        <td><?php echo $fila->{'observaciones'} ?></td>
                                        <td><a class="btn btn-xs btn-primary" href="consultaDetallePedidos/<?php echo $fila->{'idPedido'} ?>">Detalle</a>
                                            
                                        <a class="btn btn-xs btn-primary" href="actualizarUsuario/<?php echo $fila->{'idPedido'} ?>">Editar</a>
                                        <a id="elimina<?php echo $i ?>" class='btn btn-xs btn-danger' href="eliminarUsuario/<?php echo $fila->{'idPedido'} ?>" onclick="javascript:return DeleteUser('<?php echo $fila->{'idPedido'} ?>')">Borrar</a></td>
                                    </tr>
                                    <?php $i++; 
                                }   
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>idPedido</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Usuario</th>
                                <th>Observaciones</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>  <!-- Div consulta Pedidos -->
            
            <div id="contenido9" style="display:none;">  <!-- Div DetallePedido -->
                <h4 style="text-align: center">Detalle Pedido</h4>
                <br>
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example9Pedidos">
                    <thead>
                        <tr>
                            <th>idPedido</th>
                            <th>Articulo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Descuento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($detallePedido) {
                            $i=1;
                            foreach($detallePedido as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idDetallePedido'} ?>">
                                    <td><?php echo $fila->{'idPedido'} ?></td>
                                    <td><?php echo $fila->{'descripcion'} ?></td>
                                    <td><?php echo $fila->{'precio'} ?></td>
                                    <td><?php echo $fila->{'cantidad'} ?></td>
                                    <td><?php echo $fila->{'descuento'} ?></a>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>idPedido</th>
                            <th>Articulo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Descuento</th>
                        </tr>
                    </tfoot>
                </table>
                <br><br><br><br>            
            </div>  <!-- Fin Div DetallePedido -->

            <div id="contenido10" style="display:none;">  <!-- Div Nuevo Pedido -->
                <?php
                    //$this->load->view('ventas/ventas_view');
                    //require_once(APPPATH."views/common/ventas/ventas_view.php");
                    //require_once(APPPATH."views/common/ventas/ventas_view.php");
                    //require_once(APPPATH."views/ventas/ventas_view.php");
                ?>
            </div>  <!-- Fin Div Nuevo Pedido -->
            
        </div>
    </div> <!-- / renglon-->
</div> <!-- /container -->

<script>
    $('.tree-toggle').click(function () {
        $(this).parent().children('ul.tree').toggle(2);
    });
    $(function(){
        $('.tree-toggle').parent().children('ul.tree').toggle(0);
    })            
</script>

