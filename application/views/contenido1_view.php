<!DOCTYPE html>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>AA</title>
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
            <h1 class="texst-center">
                Cabecera
            </h1>   
        </div>
    </div>
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="col-md-3">
                <h3>** Solo para pruebas de los webservices basicos</h3>
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="obtener_alumno_por_id/1">Obtener Alumno por Id</a></li>
                  <li><a href="obtenerAlumnos">Obtener Alumnos</a></li>
                  <li><a href="insertar_alumno">Insertar Alumno</a></li>
                  <li><a href="borrar_alumno/1">Borrar Alumno</a></li>
                  <li><a href="actualizar_alumno">Actualizar Alumno</a></li>
                </ul>
            </div> 
            <div class="col-md-3">
                <h1>cuerpo</h1>


<?php 
form_open_multipart(base_url('index.php/inicio_controller/do_upload') );?>
 
Select One or multiple Files<input multiple="multiple" name="userfile[]" size="20" type="file" />Allowed files: gif, png, png, pdf
<input type="submit" value="upload" />                
<?php form_close();?>
                
            </div>            
        </div>        
    </div>        
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="col-md-3">
                <h1>Pie</h1>
            </div>        
        </div>        
    </div>        
</div>
</body>
</html>
