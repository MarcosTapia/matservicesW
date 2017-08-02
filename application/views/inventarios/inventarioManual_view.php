<html>
<head>
    <meta charset="utf-8"> 
    <title><?php if ($nombre_Empresa != "") { echo $nombre_Empresa; }?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="distributor" content="Global" />
    <meta name="revisit-after" content="7 days" />
    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery-3.2.1.min"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/bootstrap-datetimepicker.min.js"></script>
    
    <!-- Para previsualizar la imagen -->
    <style>
          .thumb {
            height: 80px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
          }
    </style>
    <script>
        function habilitaSubmit() {
            document.getElementById('submit').disabled = false;
        }

    </script>
</head>
<body>      
    <div class="container"> <!--class="container-fluid" -->
        <div class="row-fluid">
            <div class="col-sm-1">		
            </div>		
            <div class="col-sm-6">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <form onsubmit="habilitaSubmit()" data-toggle="validator" id="productoForm" name="productoForm" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/inventarios_controller/actualizarInventarioManualFromFormulario" method="post">
                    <h4>Actualizaci&oacute;n de Inventario</h4>
                    <input type="hidden" name="idArticulo" id="idArticulo" value="<?php echo $inventario->{'idArticulo'}; ?>" />
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="codigo">C&oacute;digo:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="C&oacute;digo" value="<?php echo $inventario->{'codigo'}; ?>" disabled="true" >
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="descripcion">Descripci&oacute;n:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripci&oacute;n" value="<?php echo $inventario->{'descripcion'}; ?>" disabled="true" >
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="existencia">Cantidad:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>
                            <input type="text" class="form-control" id="existencia" name="existencia" placeholder="Cantidad" >
                        </div>					  
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="modoOperacion">Movimiento:</label>
                      <div class="col-sm-10">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select class="form-control" name="modoOperacion" id="sucursal">
                                <option value="1">Aumentar</option>
                                <option value="2">Disminuir</option>
                            </select>
                        </div>					  
                      </div>					  
                    </div>

                    <br><br>
                    <div class="form-group">        
                      <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" id="submit" name="submit" class="btn btn-warning">Guardar<span 
                                    class="glyphicon glyphicon-send"></span></button>
                </form>
                            <a href="<?php echo base_url();?>index.php/inventarios_controller/mostrarInventarios">
                            <button type="button" class="btn btn-danger">Regresar</button></a>
                      </div>
                    </div>							
            </div>	
            <div class="col-sm-5">		
            </div>		
        </div>
    </div>
    
    
<!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>-->
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>-->
<script type="text/javascript">
    $('#productoForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            codigo: {
                validators: {
                        stringLength: {
                            max: 40
                        },
                        notEmpty: {
                            message: 'Por favor Ingresa el Código'
                        }
                }
            },
            descripcion: {
                validators: {
                     stringLength: {
                        max: 50
                    },
                    notEmpty: {
                        message: 'Por favor Ingresa la Descripción'
                    }
                }
            },
            precioCosto: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Ingresa un valor'
                    },
                    regexp: {
                         regexp: /^[0-9]+(\.[0-9]+)?$/,
                         message: 'Ingresa valores numéricos'
                    }
                }
            },
//            precioUnitario: {
//                validators: {
//                    notEmpty: {
//                        message: 'Por favor Ingresa un valor'
//                    },
//                    regexp: {
//                         regexp: /^[0-9]+(\.[0-9]+)?$/,
//                         message: 'Ingresa valores numéricos'
//                    }
//                }
//            },
            porcentajeImpuesto: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Ingresa un valor'
                    },
                    regexp: {
                         regexp: /^[0-9]/,
                         message: 'Ingresa valores numéricos'
                    }
                }
            },
            existencia: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Ingresa un valor'
                    },
                    regexp: {
                         regexp: /^[0-9]/,
                         message: 'Ingresa valores numéricos'
                    }
                }
            },
            existenciaMinima: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Ingresa un valor'
                    },
                    regexp: {
                         regexp: /^[0-9]/,
                         message: 'Ingresa valores numéricos'
                    }
                }
            },
            ubicacion: {
                validators: {
                    stringLength: {
                        max: 50
                    },
                    notEmpty: {
                        message: 'Por favor Ingresa la Ubicación del producto'
                    }
                }
            },
            proveedor: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Selecciona un Proveedor.'
                    }
                }
            },
            categoria: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Selecciona una Categoria.'
                    }
                }
            },
            sucursal: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Selecciona una Sucursal.'
                    }
                }
            }            
        } 
    })
</script>
    
    
</body>
</html>