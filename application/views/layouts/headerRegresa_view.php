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
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script> 
  </head>
<body>
<div class="container">
    <div class="row-fluid">
        <div class="col-md-12">
        <!-- xs phones, sm tablets, md desktops  lg larger desktops -->
            <img src="" />  
            <h1 class="texst-center">
                <?php if ($nombre_Empresa != "") { echo $nombre_Empresa; }?>
            </h1>   
        </div>
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="../contenido1">Inicio</a></li>
                  <li><a href="../contenido2">Consultas</a></li>
                  <li><a href="../contenido3">Entregas</a></li>
                  <li><a href="../contenido4">Configuraci&oacute;n</a></li>
                </ul>
            </div>        
