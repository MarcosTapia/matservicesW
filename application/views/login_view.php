<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<head>  	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="description" content="fresh Gray Bootstrap 3.0 Responsive Theme "/>
    <meta name="keywords" content="Template, Theme, web, html5, css3, Bootstrap,Bootstrap 3.0 Responsive Theme" />
    <meta name="author" content="Mindfreakerstuff"/>
    <link rel="shortcut icon" href="favicon.png"> 
    <title>Ingreso al Sistema</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>/css/login.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/css/animate-custom.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- start Login box -->
    <div class="container" id="login-block">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <div class="login-box clearfix animated flipInY">
                    <div class="login-logo">
                        <h3 style="font-weight:bold;">INGRESO AL SISTEMA</h3>
                        <br />
                        <a href="#"><img src="<?php echo base_url(); ?>/images/login_logo.png" alt="Logo de la Empresa" /></a>
                    </div> 
                    <hr />
                    <div class="login-form">
                        <div class="alert alert-error hide">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Error!</h4>
                             Your Error Message goes here
                        </div>
                        <form action="<?php echo site_url();?>index.php/usuarios_controller/verificaUsuario" method="post"  >
                            <input type="text" name="usuario" placeholder="Nombre de Usuario" required/> 
                            <input type="password" name="clave" placeholder="Contraseña" required/> 
                            <button type="submit" class="btn btn-red">Ingresar</button> 
                        </form>	
                    </div> 			        	
                </div>
            </div>
        </div>
    </div>
    <!-- End Login box -->
    <footer class="container">
            <p id="footer-text"><small></small></p>
    </footer>

    <script src="./js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="./js/jquery-1.9.1.min.js"><\/script>')</script> 
    <script src="./js/bootstrap.min.js"></script> 
    <script src="./js/placeholder-shim.min.js"></script>        
    <script src="./js/custom.js"></script>
</body>
</html>
