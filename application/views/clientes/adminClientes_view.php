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
            <br>
            <p><a class="btn btn-xs btn-success" href="nuevocliente">Nuevo Cliente</a>
            <a class="btn btn-xs btn-success" href="importarClientesExcel">Importar desde Excel</a>
            <a class="btn btn-xs btn-success" href="exportarClienteExcel">Exportar a Excel</a></p>
            <div class="table-responsive">     
                <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <!-- idCliente,
                            empresa,
                            nombre,
                            apellidos,
                            telefono_casa,
                            telefono_celular,
                            direccion1,
                            direccion2,
                            rfc,
                            email,
                            ciudad,
                            estado,
                            cp,
                            pais,
                            comentarios,
                            noCuenta                 
                            -->

                            <th>Empresa</th>
                            <th>Nom.Repres.</th>
                            <th>Apellidos</th>
                            <th>Tel. Fijo</th>
                            <th>Celular</th>                    
                            <th>Direccion1</th>
                            <th>Direccion2</th>
                            <th>RFC</th>                    
                            <th>Email</th>                    
                            <th>Ciudad</th>                    
                            <th>Estado</th>                    
                            <th>CP</th>                    
                            <th>Pa&iacute;s</th>
                            <th>Comentarios</th>
                            <th>No. Cuenta</th>                    
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($clientes) {
                            $i=1;
                            foreach($clientes as $fila) {
                            ?>
                                <tr id="fila-<?php echo $fila->{'idCliente'} ?>">
                                    <td><?php echo $fila->{'empresa'} ?></td>
                                    <td><?php echo $fila->{'nombre'} ?></td>
                                    <td><?php echo $fila->{'apellidos'} ?></td>
                                    <td><?php echo $fila->{'telefono_casa'} ?></td>
                                    <td><?php echo $fila->{'telefono_celular'} ?></td>
                                    <td><?php echo $fila->{'direccion1'} ?></td>
                                    <td><?php echo $fila->{'direccion2'} ?></td>                            
                                    <td><?php echo $fila->{'rfc'} ?></td>
                                    <td><?php echo $fila->{'email'} ?></td>
                                    <td><?php echo $fila->{'ciudad'} ?></td>
                                    <td><?php echo $fila->{'estado'} ?></td>
                                    <td><?php echo $fila->{'cp'} ?></td>
                                    <td><?php echo $fila->{'pais'} ?></td>
                                    <td><?php echo $fila->{'comentarios'} ?></td>
                                    <td><?php echo $fila->{'noCuenta'} ?></td>                            

                                    <td><a class="btn btn-xs btn-primary" href="actualizarCliente/<?php echo $fila->{'idCliente'} ?>">Editar</a>
                                    <a id="elimina<?php echo $i ?>" class='btn btn-xs btn-danger' href="eliminarCliente/<?php echo $fila->{'idCliente'} ?>" onclick="javascript:return confirm('¿Deseas eliminar al cliente?')">Borrar</a></td>
                                </tr>
                                <?php $i++; 
                            }   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Empresa</th>
                            <th>Nom.Repres.</th>
                            <th>Apellidos</th>
                            <th>Tel. Fijo</th>
                            <th>Celular</th>                    
                            <th>Direccion1</th>
                            <th>Direccion2</th>
                            <th>RFC</th>                    
                            <th>Email</th>                    
                            <th>Ciudad</th>                    
                            <th>Estado</th>                    
                            <th>CP</th>                    
                            <th>Pa&iacute;s</th>
                            <th>Comentarios</th>
                            <th>No. Cuenta</th>                    
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
