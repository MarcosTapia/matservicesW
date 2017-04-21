<!DOCTYPE html>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Ingreso al Sistema</title>
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
        <div class="col-md-4">
            &nbsp;
        </div>
        <div class="col-md-4">
            <br><br><br><br><br><br><br>
            <form class="form-horizontal" role="form" action="<?php echo site_url();?>index.php/usuarios_controller/verificaUsuario" method="post">
                <div class="form-group">
                    Ingreso al Sistema
                </div>
                <div class="form-group">
                    <?php 
                        if (isset($error)) {
                          echo "USUARIO O CLAVE INCORRECTA";
                        } 
                    ?>
                </div>
                <div class="form-group">
                    <label for="usuario" class="control-label col-sm-2">Usuario:</label>
                    <div class="col-sm-7">
                        <input type="text" style="font-size: 11px;" 
                               class="form-control" id="monto" 
                               name="usuario" 
                               placeholder="Usuario">                            
                    </div>
                </div>
                <div class="form-group">
                    <label for="clave" class="control-label col-sm-2">Clave:</label>
                    <div class="col-sm-7">
                        <input type="password" style="font-size: 11px;" 
                               class="form-control" id="monto" 
                               name="clave" />                            
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7">
                        <?php $submitBtn = array('class' => 'btn-success',  
                            'value' => 'Ingresar', 'name'=>'submit'); 
                        echo form_submit($submitBtn); ?>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            &nbsp;
        </div>
    </div>
</body>
</html>
