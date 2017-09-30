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
                    <!-- Para leer opcion clickeada
                        0.- inicio
                        1.- inventario
                        2.- ventas
                        3.- compras
                        4.- consultas
                        5.- proveedores
                        6.- clientes
                        7.- Empleados
                        8.- configuracion                  
                    -->
                    
                    <!-- Verifica si opcion inicio esta seleccionada -->
                    <?php if ($opcionClickeada=="0") { ?> 
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/usuarios_controller/inicio">Inicio</a></li>
                    <?php } else {  ?> 
                  <li><a href="<?php echo base_url(); ?>index.php/usuarios_controller/inicio">Inicio</a></li>
                    <?php } ?>
                    <!-- Fin Verifica si opcion inicio esta seleccionada -->
                    
                    <!-- Verifica permiso y si opcion inventario esta seleccionada -->
                    <?php if ($permisos[0] == "1") { 
                        if ($opcionClickeada=="1") { ?>
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/inventarios_controller/mostrarinventarios">Inventarios</a></li>
                        <?php } else { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/inventarios_controller/mostrarinventarios">Inventarios</a></li>
                    <!-- Fin Verifica permiso y si opcion inventario esta seleccionada -->
                    
                    <!-- Verifica permiso y si opcion ventas esta seleccionada -->
        <?php } }
            $letrero = "Ventas";
            if (isset($eleccion)) {
                if ($eleccion==10) {
                    $letrero = "Pedidos";
                }
            }
            
            if ($permisos[1] == "1") { 
                if ($opcionClickeada=="2") { ?>
          <li class="active"><a href="<?php echo base_url(); ?>index.php/ventas_controller/ventaEnBlanco/0"><?php echo $letrero;?></a></li>
                <?php } else { ?>
          <li><a href="<?php echo base_url(); ?>index.php/ventas_controller/ventaEnBlanco/0"><?php echo $letrero;?></a></li>
            <!-- Fin Verifica permiso y si opcion ventas esta seleccionada -->

                    <!-- Verifica permiso y si opcion compras esta seleccionada -->
                    <?php } } if ($permisos[2] == "1") { 
                        if ($opcionClickeada=="3") { ?>
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/compras_controller/compraEnBlanco">Compras</a></li>
                        <?php } else { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/compras_controller/compraEnBlanco">Compras</a></li>
                    <!-- Verifica permiso y si opcion compras esta seleccionada -->
                    
                    <!-- Verifica permiso y si opcion consultas esta seleccionada -->
                    <?php } } if ($permisos[3] == "1") { 
                        if ($opcionClickeada=="4") { ?>
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/consultas_controller/inicioconsultas">Consultas</a></li>
                        <?php } else { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/consultas_controller/inicioconsultas">Consultas</a></li>
                    <!-- Verifica permiso y si opcion consultas esta seleccionada -->
                    
                    <!-- Verifica permiso y si opcion proveedores esta seleccionada -->
                    <?php } } if ($permisos[4] == "1") { 
                        if ($opcionClickeada=="5") { ?>
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/proveedores_controller/mostrarproveedores">Proveedores</a></li>
                        <?php } else { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/proveedores_controller/mostrarproveedores">Proveedores</a></li>
                    <!-- Verifica permiso y si opcion proveedores esta seleccionada -->
                    
                    <!-- Verifica permiso y si opcion clientes esta seleccionada -->
                    <?php } } if ($permisos[5] == "1") { 
                        if ($opcionClickeada=="6") { ?>
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/clientes_controller/mostrarclientes">Clientes</a></li>
                        <?php } else { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/clientes_controller/mostrarclientes">Clientes</a></li>
                    <!-- Verifica permiso y si opcion clientes esta seleccionada -->
                    
                    <!-- Verifica permiso y si opcion empleados(usuarios) esta seleccionada -->
                    <?php } } if ($permisos[6] == "1") { 
                        if ($opcionClickeada=="7") { ?>
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/usuarios_controller/mostrarusuarios">Empleados</a></li>
                        <?php } else { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/usuarios_controller/mostrarusuarios">Empleados</a></li>
                    <!-- Verifica permiso y si opcion empleados(usuarios) esta seleccionada -->
                    
                    <!-- Verifica permiso y si opcion configuracion esta seleccionada -->
                    <?php } } if ($permisos[7] == "1") { 
                        if ($opcionClickeada=="8") { ?>
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/configuracion_controller/mostrarvalores">Configuraci&oacute;n</a></li>
                        <?php } else { ?>
                  <li><a href="<?php echo base_url(); ?>index.php/configuracion_controller/mostrarvalores">Configuraci&oacute;n</a></li>
                    <!-- Verifica permiso y si opcion configuracion esta seleccionada -->

                    <?php } } ?>
                  <li><a href="<?php echo base_url(); ?>index.php/usuarios_controller/cerrarSesion">Salir</a></li>
                </ul>
              </div>
            </nav>  
        </div>
    </div>
    <div class="row-fluid">
        <div class="col-md-6">
            <p style="font-size: 12px;color: #006666">Bienvenido: <?php echo $usuarioDatos; ?></p>
        </div>
        <div class="col-md-6">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <p style="font-size: 12px;color: #006666">Fecha: <?php echo $fecha; ?> </p>
            </div>
        </div>
    </div>
            
