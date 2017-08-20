<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Errores de Importaci&oacute;n</title>
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
    <div class="container"> <!--class="container-fluid" -->
        <div class="row-fluid">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table>
                        <tr>
                            <td><h3 style="color:red;">LISTADO DE REGISTROS QUE NO SE IMPORTARON</h3></td>
                            <td>
                                <div class="form-group">        
                                  <div class="col-sm-offset-2 col-sm-10">
                                        <a href="<?php echo base_url();?>index.php/inventarios_controller/mostrarInventarios">
                                        <button type="button" class="btn btn-xs btn-danger">Regresar</button>
                                        </a>
                                  </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                        <thead>
                            <tr>
                                <th>codigo</th>
                                <th>descripcion</th>
                                <th>precioCosto</th>
                                <th>precioUnitario</th>
                                <th>porcentajeImpuesto</th>
                                <th>existencia</th>
                                <th>existenciaMinima</th>
                                <th>ubicacion</th>
                                <th>fechaIngreso</th>
                                <th>observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $file = fopen("errores_importacion.txt", "r");
                                $cont=0;
                                $regArray = array('','','','','','','','','');
                                while(!feof($file)) {
                                    $registro = fgets($file);
                                    $regArray = explode("|",$registro);
                                    if ($cont<count($regArray)) {
                                        echo "<tr>";
                                        if ( ! isset($regArray[0])) {
                                            $regArray[0] = null;
                                        }
                                        echo "<td>".$regArray{'0'}."</td>";

                                        if ( ! isset($regArray[1])) {
                                            $regArray[1] = null;
                                        }
                                        echo "<td>".$regArray{'1'}."</td>";

                                        if ( ! isset($regArray[2])) {
                                            $regArray[2] = null;
                                        }
                                        echo "<td>".$regArray[2]."</td>";

                                        if ( ! isset($regArray[3])) {
                                            $regArray[3] = null;
                                        }
                                        echo "<td>".$regArray[3]."</td>";

                                        if ( ! isset($regArray[4])) {
                                            $regArray[4] = null;
                                        }
                                        echo "<td>".$regArray[4]."</td>";

                                        if ( ! isset($regArray[5])) {
                                            $regArray[5] = null;
                                        }
                                        echo "<td>".$regArray[5]."</td>";

                                        if ( ! isset($regArray[6])) {
                                            $regArray[6] = null;
                                        }
                                        echo "<td>".$regArray[6]."</td>";

                                        if ( ! isset($regArray[7])) {
                                            $regArray[7] = null;
                                        }
                                        echo "<td>".$regArray[7]."</td>";

                                        if ( ! isset($regArray[8])) {
                                            $regArray[8] = null;
                                        }
                                        echo "<td>".$regArray[8]."</td>";

                                        if ( ! isset($regArray[9])) {
                                            $regArray[9 ] = null;
                                        }
                                        echo "<td>".$regArray[9]."</td>";
                                        echo "</tr>";
                                    }
                                    $cont++;
                                }
                                fclose($file);
                                $file = fopen("errores_importacion.txt", "w");
                                fclose($file);
                                ?>
                          <?php 
                            ?>   
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>codigo</th>
                                <th>descripcion</th>
                                <th>precioCosto</th>
                                <th>precioUnitario</th>
                                <th>porcentajeImpuesto</th>
                                <th>existencia</th>
                                <th>existenciaMinima</th>
                                <th>ubicacion</th>
                                <th>fechaIngreso</th>
                                <th>observaciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>		
            </div>		
        </div>
    </div>
</body>
</html>






