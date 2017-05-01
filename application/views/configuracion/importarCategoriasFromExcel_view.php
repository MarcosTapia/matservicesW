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
		</script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="text-align: center">Configuraci&oacute;n General del Sistema</h3>
        </div>
    </div>
    <div class="row">
        
        <div class="col-sm-6">
            <br><br>
            <form method='post' action='importarExcel' enctype='multipart/form-data'>
                <input type='file' name='excel' />    
                <input type='submit' name='enviar' value='Importar' />
                <input type='hidden' value='upload' name='action' />
            </form>
            
        </div>	
        <div class="col-md-6">
        </div>
    </div> <!-- / renglon-->
</div> <!-- /container -->
</body>	
</html>
