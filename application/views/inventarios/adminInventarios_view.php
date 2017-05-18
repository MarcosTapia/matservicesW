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
    <script type="text/javascript" charset="utf-8">
        function seleccionMuliple() {
            var arrayIds = "";
            var noRegistrosSeleccionados = 0;
            <?php
            foreach($inventarios as $fila) {
            ?>
                var a = <?php echo $fila->{'idArticulo'};?>;
                if (document.getElementById(a).checked) {
                    arrayIds = arrayIds + a + "_";
                    noRegistrosSeleccionados++;
                }
            <?php        
            }
            ?>
            if (arrayIds=="") {
               alert("Debes seleccionar elemento(s) para editar");
               return;
            } else if (noRegistrosSeleccionados < 2) {
               alert("Debes seleccionar al menos 2 elementos para editar");
               return;
            }    
            document.getElementById('ligaSeleccionMultiple').href = "edicionMultipleInventario/" + arrayIds; 
        }
    </script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
    <p>
    <a class="btn btn-xs btn-success" href="nuevoInventario">Nuevo</a>
    <a class="btn btn-xs btn-success" href="importarInventariosExcel/<script>document.getElementById('ids').value</script>">Importar desde Excel</a>
    <a class="btn btn-xs btn-success" href="exportarInventarioExcel">Exportar a Excel</a>
    <a class="btn btn-xs btn-success" id="ligaSeleccionMultiple" href="" onclick="seleccionMuliple();">Edici&oacute;n M&uacute;ltiple</a>
    <a class="btn btn-xs btn-success" href="exportarExcel">Inventario</a>
    <a class="btn btn-xs btn-success" href="exportarExcel">Movimientos</a></p>
    <div class="table-responsive">     
        <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Edici&oacute;n</th>
                    <th>Surtir</th>
                    <th>Sucursal</th>
                    <th>C&oacute;digo</th>
                    <th>Descripci&oacute;n</th>
                    <th>Precio Costo</th>
                    <th>precio Unit.</th>
                    <th>IVA</th>
                    <th>Existencia</th>
                    <th>Exist. M&iacute;nima</th>
                    <th>Ubicaci&oacute;n</th>
                    <th>Observ.</th>
                    <th>FechaIngreso</th>
                    <th>Proveed.</th>
                    <th>Categor&iacute;a</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- hidden de ids para seleccion multiple -->
                <input type="hidden" value="" name="ids" />
                <?php
                $ids = "";
                if($inventarios) {
                    $i=1;
                    foreach($inventarios as $fila) {
                    ?>
                        <tr id="fila-<?php echo $fila->{'idArticulo'} ?>">
                            <td>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="<?php echo $fila->{'idArticulo'};?>"  id="<?php echo $fila->{'idArticulo'};?>">
                                </label>
                            </td>
                            <td>
                                <?php if ($fila->{'existencia'} <= $fila->{'existenciaMinima'}) { ?>
                                <img src="<?php echo base_url(); ?>/images/sistemaicons/yes.ico" alt="" />
                                <?php } ?>
                            </td>
                            <td><?php echo $fila->{'descripcionSucursal'} ?></td>
                            <td><?php echo $fila->{'codigo'} ?></td>
                            <td><?php echo $fila->{'descripcion'} ?></td>
                            <td><?php echo $fila->{'precioCosto'} ?></td>
                            <td><?php echo $fila->{'precioUnitario'} ?></td>
                            <td><?php echo $fila->{'porcentajeImpuesto'} ?></td>
                            <td><?php echo $fila->{'existencia'} ?></td>
                            <td><?php echo $fila->{'existenciaMinima'} ?></td>
                            <td><?php echo $fila->{'ubicacion'} ?></td>
                            <td><?php echo $fila->{'observaciones'} ?></td>
                            <td><?php echo $fila->{'fechaIngreso'} ?></td>
                            <td><?php echo $fila->{'empresa'} ?></td>
                            <td><?php echo $fila->{'descripcionCategoria'} ?></td>

                            <td><a class="btn btn-xs btn-primary" href="actualizarInventario/<?php echo $fila->{'idArticulo'} ?>">Editar</a>
                            <a id="elimina<?php echo $i ?>" class='btn btn-xs btn-danger' href="eliminarInventario/<?php echo $fila->{'idArticulo'} ?>/<?php echo $fila->{'fotoProducto'} ?>" onclick="preguntar(<?php echo $i ?>)">Borrar</a></td>
                        </tr>
                        <?php $i++; 
                    }   
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Edici&oacute;n</th>
                    <th>Surtir</th>
                    <th>Sucursal</th>
                    <th>C&oacute;digo</th>
                    <th>Descripci&oacute;n</th>
                    <th>Precio Costo</th>
                    <th>precio Unit.</th>
                    <th>IVA</th>
                    <th>Existencia</th>
                    <th>Exist. M&iacute;nima</th>
                    <th>Ubicaci&oacute;n</th>
                    <th>Observ.</th>
                    <th>FechaIngreso</th>
                    <th>Proveed.</th>
                    <th>Categor&iacute;a</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div> <!-- /division renglon en 12-->
</div> <!-- / renglon-->
</div> <!-- /container -->
</body>	
</html>
