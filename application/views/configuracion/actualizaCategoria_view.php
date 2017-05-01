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
            <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/configuracion_controller/actualizarCategoriaFromFormulario" method="post">
                <h4>Modificar Categor&iacute;a</h4>
                <input type="hidden" name="idCategoria" id="idCategoria" value="<?php echo $categoria->{'idCategoria'}; ?>" />

                <div class="form-group">
                    <label class="control-label col-sm-2" for="descripcionCategoria">Categor&iacute;a:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="descripcionCategoria" name="descripcionCategoria" value="<?php echo $categoria->{'descripcionCategoria'}; ?>" placeholder="Descripci&oacute;n de la Categor&iacute;a">
                  </div>					  
                </div>  

                <table>
                    <tr>
                        <td>
                            <div class="form-group">        
                              <div class="col-sm-offset-2 col-sm-10">
                                    <?php $submitBtn = array('class' => 'btn btn-xs btn-success
                                    ',  'value' => 'Procesar', 'name'=>'submit'); 
                                    echo form_submit($submitBtn); ?>
                              </div>
                            </div>							
                        </td>
                        <td>
                            <div class="form-group">        
                              <div class="col-sm-offset-2 col-sm-10">
                                    <a href="<?php echo base_url();?>index.php/configuracion_controller/mostrarValores">
                                    <button type="button" class="btn btn-xs btn-danger">Regresar</button>
                                    </a>
                              </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>	
        <div class="col-md-6">
        </div>
    </div> <!-- / renglon-->
</div> <!-- /container -->
</body>	
</html>
