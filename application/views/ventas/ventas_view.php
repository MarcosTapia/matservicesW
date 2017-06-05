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
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-8">
                <div class="table-responsive">     
                    <table class="table table-striped" style="border: 1px solid #FFF;border-color: red">
                        <thead>
                            <tr style="background: #00ccff">
                                <th colspan="8">
                                    <div class="form-group">
                                      <label class="control-label col-sm-2" for="modoOperacion">Tipo de Registro:</label>
                                      <div class="col-sm-10">
                                        <div class="input-group">
                                            <select class="form-control" name="modoOperacion" id="modoOperacion">
                                                <option value="1">Venta</option>
                                                <option value="2">Regreso</option>
                                            </select>
                                        </div>					  
                                      </div>					  
                                    </div>       
                                </th>
                            </tr>
                            <tr style="background: #00ccff">
                                <th colspan="8">
                                    <div class="form-group">
                                      <label class="control-label col-sm-2" for="codigoProducto">C&oacute;digo Producto:</label>
                                      <div class="col-sm-10 inputGroupContainer">
                                        <div class="input-group"> <span class="input-group-addon">
                                            <input type="text" class="form-control" id="codigoProducto" name="codigoProducto" placeholder="C&oacute;digo Producto">
                                        </div>					  
                                      </div>
                                    </div>  
                                </th>
                            </tr>
                            <tr>
                                <th>Borrar</th>
                                <th>C&oacute;</th>
                                <th>Descripci&oacute;n</th>
                                <th>Precio</th>
                                <th>Cant.</th>
                                <th>Desc %</th>
                                <th>Total</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>aa</td>
                                <td>aa</td>
                                <td>aa</td>
                                <td>aa</td>
                                <td>aa</td>
                                <td>aa</td>
                                <td>aa</td>
                                <td>aa</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Borrar</th>
                                <th>C&oacute;</th>
                                <th>Descripci&oacute;n</th>
                                <th>Precio</th>
                                <th>Cant.</th>
                                <th>Desc %</th>
                                <th>Total</th>
                                <th>Editar</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="table-responsive">     
                    <table class="table" cellpadding="0" cellspacing="0" border="0" class="display">
                        <thead>
                            <tr>
                                <th>Empresa</th>
                                <th>Nom.Repres.</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>aa</td>
                                <td>aa</td>
                                <td>aa</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Empresa</th>
                                <th>Nom.Repres.</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div> <!-- /division renglon en 12-->
    </div> <!-- / renglon-->
</div> <!-- /container -->
</body>	
</html>
