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
<div class="col-md-12">
    <table class="table-responsive">
        <tr>
            <td>
                <p>
                <a class="btn btn-xs btn-success" href="<?php echo base_url();?>index.php/inventarios_controller/mostrarInventarios">Regresar</a>
                </p>
            </td>
            <td style="text-align: center;width: 100%;">
                <h4>Art&iacute;culo: <?php echo $articulo; ?></h4>
            </td>
        </tr>
    </table>
    <div class="table-responsive">     
        <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Tipo Operacion</th>
                    <th>Cantidad</th>
                    <th>Fecha Operacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($movimientos) {
                    $i=1;
                    foreach($movimientos as $fila) {
                    ?>
                        <tr id="fila-<?php echo $fila->{'idMovimiento'} ?>">
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
                    <th>Usuario</th>
                    <th>Tipo Operacion</th>
                    <th>Cantidad</th>
                    <th>Fecha Operacion</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div> <!-- /division renglon en 12-->
</div> <!-- / renglon-->
</div> <!-- /container -->
</body>	
</html>
