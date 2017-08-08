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
                                <th>proveedor</th>
                                <th>categoria</th>
                                <th>Sucursal</th>
                                <th>nombre_img</th>
                                <th>observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($regsNoImportados) {
                                foreach($regsNoImportados as $fila) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $fila['codigo'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['descripcion'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['precioCosto'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['precioUnitario'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['porcentajeImpuesto'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['existencia'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['existenciaMinima'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['ubicacion'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['fechaIngreso'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['proveedor'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['categoria'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['sucursal'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['nombre_img'];?>
                                        </td>
                                        <td>
                                            <?php echo $fila['observaciones'];?>
                                        </td>
                                    </tr>
                          <?php } 
                            } ?>   
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
                                <th>proveedor</th>
                                <th>categoria</th>
                                <th>Sucursal</th>
                                <th>nombre_img</th>
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






