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

        function DeleteUser(id) {
            var conf = confirm("¿Seguro que quieres eliminar?");
            if (conf == false) {
                return false;
            } else {
                return true;
            }
        }
        
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
<div class="col-md-12">
    <?php 
        $correcto = $this->session->flashdata('correcto');
        if ($correcto) { ?>
    <span id="registroCorrecto" style="color:blue;"><?= $correcto ?></span>
    <?php } ?>
    <p><a class="btn btn-xs btn-success" href="nuevoUsuario">Nuevo Empleado</a>
    <a class="btn btn-xs btn-success" href="importarUsersExcel">Importar desde Excel</a>
    <a class="btn btn-xs btn-success" href="exportarExcel">Exportar a Excel</a></p>
    <div class="table-responsive">     
        <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Permisos</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Tel. Casa</th>
                    <th>Celular</th>
                    <th>Sucursal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($usuarios) {
                    $i=1;
                    foreach($usuarios as $fila) {
                    ?>
                        <tr id="fila-<?php echo $fila->{'idUsuario'} ?>">
                            <td><?php echo $fila->{'usuario'} ?></td>
                            <td><?php echo $fila->{'permisos'} ?></td>
                            <td><?php echo $fila->{'nombre'} ?></td>
                            <td><?php echo $fila->{'apellido_paterno'} ?></td>
                            <td><?php echo $fila->{'apellido_materno'} ?></td>
                            <td><?php echo $fila->{'telefono_casa'} ?></td>
                            <td><?php echo $fila->{'telefono_celular'} ?></td>
                            <td><?php echo $fila->{'descripcionSucursal'} ?></td>

                            <td><a class="btn btn-xs btn-primary" href="actualizarUsuario/<?php echo $fila->{'idUsuario'} ?>">Editar</a>
                            <a id="elimina<?php echo $i ?>" class='btn btn-xs btn-danger' href="eliminarUsuario/<?php echo $fila->{'idUsuario'} ?>" onclick="javascript:return DeleteUser('<?php echo $fila->{'idUsuario'} ?>')">Borrar</a></td>
                        </tr>
                        <?php $i++; 
                    }   
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Usuario</th>
                    <th>Permisos</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Tel. Casa</th>
                    <th>Celular</th>
                    <th>Sucursal</th>
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
