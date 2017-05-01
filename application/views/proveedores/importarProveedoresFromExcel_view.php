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
				<br><br>
				<form method='post' action='importarExcel' enctype='multipart/form-data'>
					<input type='file' name='excel' />    
					<input type='submit' name='enviar'  value='Importar'  />
					<input type='hidden' value='upload' name='action' />
				</form>
			</div>		
			<div class="col-sm-5">		
			</div>		
		</div>
	</div>
</body>
</html>






