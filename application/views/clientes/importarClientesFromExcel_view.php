<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Importar Proveedores</title>
</head>
<body>      
    <div class="container"> <!--class="container-fluid" -->
		<div class="row-fluid">
			<div class="col-sm-2">		
			</div>		
			<div class="col-sm-5">	
                        <br>
                        <h4 style="text-align: center">Importar Clientes</h4>
                        <br>
                        <form method='post' action='importarExcel' enctype='multipart/form-data'>
                                <input type='file' name='excel' />    
                                <input type='submit' name='enviar'  value='Importar'  />
                                <input type='hidden' value='upload' name='action' />
                        </form>
                        <br><br>
                        <div class="form-group">        
                          <div class="col-sm-offset-2 col-sm-10">
                                <a href="<?php echo base_url();?>index.php/clientes_controller/mostrarClientes">
                                <button type="button" class="btn btn-xs btn-danger">Regresar</button>
                                </a>
                          </div>
                        </div>
            <br><br>
			</div>		
			<div class="col-sm-5">		
			</div>		
		</div>
	</div>
</body>
</html>






