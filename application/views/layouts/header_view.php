<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title> <?php if ($nombre_Empresa != "") { echo $nombre_Empresa; }?> </title>
    <link href="<?php echo base_url(); ?>/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(); ?>/js/ie10-viewport-bug-workaround.js"></script> 
    
    <!-- Para Slider -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/styles/media-queries.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/flex-slider/flexslider.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo base_url(); ?>/scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/flex-slider/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/scripts/setup.js"></script> 
    
  </head>
<body>
<div class="container">
    <div class="row-fluid">
        <div class="col-md-12">
            <br>
        <!-- xs phones, sm tablets, md desktops  lg larger desktops -->
            <img src="" />  
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                  <a class="navbar-brand" href="#"><?php if ($nombre_Empresa != "") { echo $nombre_Empresa; }?></a>
                </div>
                <ul class="nav navbar-nav">
                    <!-- Para leer permisos 
                        1.- inventario
                        2.- ventas
                        3.- compras
                        4.- consultas
                        5.- proveedores
                        6.- clientes
                        7.- Empleados
                        8.- configuracion                  
                    -->
                  <li class="active"><a href="#">Inicio</a></li>
                    
                    <?php if ($permisos[0] == "1") { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/inventarios_controller/mostrarinventarios">Inventarios</a></li>
                    
                    <?php } if ($permisos[1] == "1") { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/ventas_controller/ventaEnBlanco">Ventas</a></li>
                    
                    <?php } if ($permisos[2] == "1") { ?>
                  <li><a href="#">Compras</a></li>
                    
                    <?php } if ($permisos[3] == "1") { ?>
                  <li><a href="#">Consultas</a></li>
                    
                    <?php } if ($permisos[4] == "1") { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/proveedores_controller/mostrarproveedores">Proveedores</a></li>
                    
                    <?php } if ($permisos[5] == "1") { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/clientes_controller/mostrarclientes">Clientes</a></li>
                    
                    <?php } if ($permisos[6] == "1") { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/usuarios_controller/mostrarusuarios">Empleados</a></li>
                    <?php } if ($permisos[7] == "1") { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/configuracion_controller/mostrarvalores">Configuraci&oacute;n</a></li>
                    <?php } ?>
                  <li><a href="<?php echo base_url(); ?>index.php/usuarios_controller/cerrarSesion">Salir</a></li>
                </ul>
              </div>
            </nav>            
        </div>
    </div>
            
