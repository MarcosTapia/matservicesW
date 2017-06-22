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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap3-typeahead.min.js" type="text/javascript"></script>		
    <!-- Para ventana modal -->
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/script.js"></script>
    <!-- Fin Para ventana modal -->
    
    <script language='javascript'>
//        function agregaProducto(e){
//            var code = (e.keyCode ? e.keyCode : e.which);
//            if(code == 13) { //Enter keycode
//                var producto = document.getElementById('codigoProducto').value; 
//                var prodCod = producto.split(" ");
//                //alert(prodCod[0]);                
//                //setTimeout(borraCodigo(), 1000);
//                document.getElementById('codigoProducto').value = "";
//                var table = document.getElementById("tblVenta");
//                var noRenglones = table.rows.length;
//                //alert(noRenglones);
//                var row = table.insertRow(noRenglones-1);
//                var cell0 = row.insertCell(0);
//                var cell1 = row.insertCell(1);
//                var cell2 = row.insertCell(2);
//                var cell3 = row.insertCell(3);
//                var cell4 = row.insertCell(4);
//                var cell5 = row.insertCell(5);
//                var cell6 = row.insertCell(6);
//                var cell7 = row.insertCell(7);
//                <?php
//                 foreach ($inventarios as $fila) { ?>//
//                    if (prodCod[0] == <?php echo $fila->{'codigo'}; ?>) { 
//                        cell0.innerHTML = "<img src='<?php echo base_url();?>images/sistemaicons/borrar.ico' onclick='borrarArticulo(<?php echo $fila->{'idArticulo'};?>)' />"; 
//                        cell1.innerHTML = "<?php echo $fila->{'codigo'};?>";
//                        cell2.innerHTML = "<?php echo $fila->{'descripcion'};?>";
//                        var precio;
//                        if (document.getElementById('tipoVenta').value == "2") {
//                            cell3.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='10' name='precio<?php echo $fila->{'idArticulo'};?>' id='precio<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'precioCosto'};?>' /></div></div>";
//                            precio = <?php echo $fila->{'precioCosto'};?>;
//                        } else {
//                            cell3.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='10' name='precio<?php echo $fila->{'idArticulo'};?>' id='precio<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'precioUnitario'};?>' /></div></div>";
//                            precio = <?php echo $fila->{'precioUnitario'};?>;
//                        }    
//                        cell4.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' name='cantidad<?php echo $fila->{'idArticulo'};?>' id='cantidad<?php echo $fila->{'idArticulo'};?>' value='1' /></div></div>";
//                        cell5.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' name='descuento<?php echo $fila->{'idArticulo'};?>' id='descuento<?php echo $fila->{'idArticulo'};?>' value='0' /></div></div>";
//                        var total = parseFloat(precio) * parseFloat(document.getElementById('cantidad<?php echo $fila->{'idArticulo'};?>').value);
//                        var descuento = parseFloat(document.getElementById('descuento<?php echo $fila->{'idArticulo'};?>').value) / 100;
//                        var totalArtP = total - descuento;
//                        cell6.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' disabled name='totalArt<?php echo $fila->{'idArticulo'};?>' id='totalArt<?php echo $fila->{'idArticulo'};?>' value='" + totalArtP.toFixed(2) + "' /></div></div>";
//                        cell7.innerHTML = "<img src='<?php echo base_url();?>images/sistemaicons/agregar.ico' onclick='aumentaCantidadArticulo(<?php echo $fila->{'idArticulo'};?>)' />&nbsp;&nbsp;&nbsp;<img src='<?php echo base_url();?>images/sistemaicons/prohibido.ico' onclick='disminuyeCantidadArticulo(<?php echo $fila->{'idArticulo'};?>)' />"; 
//                    }
//               <?php  //}
//                ?>//
//            }
//        }
                
//        function borraCodigo() {
//            document.getElementById('codigoProducto').value = "";        
//        }
//        
//        function totalArticulo(id) {
//            var total = parseFloat(document.getElementById('precio' + id).value) * parseFloat(document.getElementById('cantidad' + id).value);
//            var descuento = total * (parseFloat(document.getElementById('descuento' + id).value) / 100);
//            var totalArtP = total - descuento;
//            document.getElementById('totalArt' + id).value = "" + totalArtP.toFixed(2);
//        }
//        
//        function borraArticulo(idAritculo){
//            alert('ahhh');
//            //document.getElementById("myTable").deleteRow(0);
//        }
//        
//        function aumentaCantidadArticulo(idCantidad) {
//            var idObjeto = 'cantidad' + idCantidad;
//            document.getElementById(idObjeto).value = parseInt(document.getElementById(idObjeto).value) + 1;
//            totalArticulo(idCantidad);
//        }
//        
//        function disminuyeCantidadArticulo(idCantidad) {
//            var idObjeto = 'cantidad' + idCantidad;
//            document.getElementById(idObjeto).value = parseInt(document.getElementById(idObjeto).value) - 1;
//            totalArticulo(idCantidad);
//        }
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="tblVenta" class="table table-striped" style="border: 1px solid #FFF;border-color: red">
                    <thead>
                        <tr style="background: #00ccff">
                            <td colspan="5">
                                <label class="control-label col-sm-4" for="cliente">Cliente (Opcional):</label>
                                <div class="form-group">
                                    <div class="input-group col-sm-8">
                                        <input type="text" class="form-control col-sm-2" name="clienteB" id="clienteB" placeholder="Cliente (Opcional)" autocomplete="off" />
                                        <input type="hidden" class="form-control" name="cliente" id="cliente" />
                                    </div>					  
                                </div>       
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group col-sm-4">
                                        <input type="button" class="btn btn-success" value="Nuevo Cliente" data-toggle="modal" data-target="#create-item" />
                                    </div>					  
                                </div>       
                            </td>
                            <td colspan="2">
                                <div class="form-group">
                                    <label class="control-label col-sm-6" for="modoOperacion">Tipo de Registro:</label>
                                    <div class="input-group col-sm-5">
                                        <select class="form-control col-sm-5" name="modoOperacion" id="modoOperacion">
                                            <option value="1">Venta</option>
                                            <option value="2">Regreso</option>
                                        </select>
                                    </div>					  
                                </div>       
                            </td>
                        </tr>
                        <tr style="background: #00ccff">
                            <td colspan="5">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="codigoProducto">C&oacute;digo:</label>
                                    <div class="input-group col-sm-9">
                                        <input type="hidden" class="form-control" name="country_id" id="country_id">
                                        <input type="text" class="form-control col-sm-2" name="codigoProducto" id="codigoProducto" placeholder="C&oacute;digo &oacute; Descripci&oacute;n" autocomplete="off" >
                                    </div>					  
                                </div>       
                            </td>
                            <td>
                                <div class="form-group">
                                    <label class="control-label col-sm-5" for="NoVenta">Id Venta:</label>
                                    <div class="input-group col-sm-3">
                                        <input type="text" class="form-control col-sm-2" name="NoVenta" id="NoVenta" disabled />
                                    </div>					  
                                </div>       
                            </td>
                            <td colspan="2">
                                <div class="form-group">
                                    <label class="control-label col-sm-6" for="tipoVenta">Tipo de Venta:</label>
                                    <div class="input-group col-sm-5">
                                        <select class="form-control col-sm-5" name="tipoVenta" id="tipoVenta">
                                            <option value="1">Menudeo</option>
                                            <option value="2">Mayoreo</option>
                                        </select>
                                    </div>					  
                                </div>       
                            </td>
                        </tr>
                        <tr>
                            <th><img src='<?php echo base_url();?>images/sistemaicons/borrarok.ico' /></th>
                            <th>C&oacute;digo</th>
                            <th>Descripci&oacute;n</th>
                            <th>Precio</th>
                            <th>Cant.</th>
                            <th>Desc %</th>
                            <th>Total</th>
                            <th>Editar Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <th><img src='<?php echo base_url();?>images/sistemaicons/borrarok.ico' /></th>
                        <th>C&oacute;digo</th>
                        <th>Descripci&oacute;n</th>
                        <th>Precio</th>
                        <th>Cant.</th>
                        <th>Desc %</th>
                        <th>Total</th>
                        <th>Editar Cantidad</th>
                    </tfoot>
                </table>
            </div>
        </div> <!-- /division renglon en 12-->
    </div> <!-- / renglon-->
</div> <!-- /container -->

<!-- Modal cliente -->
<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nuevo Cliente</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" class="form-horizontal" action="<?php echo base_url();?>index.php/ventas_controller/nuevoClienteFromFormulario" method="post">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="empresa">Empresa:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Nombre Empresa">
                      </div>					  
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Representante">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="apellidos">Apellidos:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos Representante">
                      </div>					  
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="telefono_casa">Tel&eacute;fono Empresa:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="telefono_casa" name="telefono_casa" placeholder="Tel&eacute;fono Empresa">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="telefono_celular">Celular:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="telefono_celular" name="telefono_celular" placeholder="Celular Representante">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="direccion1">Direcci&oacute;n 1:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="direccion1" name="direccion1" placeholder="Direcci&oacute;n 1">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="direccion2">Direcci&oacute;n 2:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="direccion2" name="direccion2" placeholder="Direcci&oacute;n 2">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="rfc">RFC:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Email:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="ciudad">Ciudad:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="estado">Estado:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="cp">CP:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="cp" name="cp" placeholder="C&oacute;digo Postal">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pais">Pa&iacute;s:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="pais" name="pais" placeholder="Pa&iacute;s">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="comentarios">Comentarios:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="comentarios" name="comentarios" placeholder="Comentarios">
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="noCuenta">No. Cuenta:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="noCuenta" name="noCuenta" placeholder="No. Cuenta">
                      </div>					  
                    </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <?php 
                //$submitBtn = array('class' => 'btn btn-primary data-dismiss="modal"','value' => 'Agregar', 'name'=>'submit'); 
                //echo form_submit($submitBtn);                 
                ?>
                <button type="submit" class="btn crud-submit btn-success">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal cliente -->

<script>
 $(document).ready(function(e){
     alert("aaaa");
        var site_url = "<?php echo site_url(); ?>";
        //alert("site_url"+site_url);
        //Para busqueda de Productos
        var input = $("input[name=codigoProducto]");
        $.get(site_url+'index.php/ventas_controller/buscaProducto', function(data){
                                input.typeahead({
                                    source: data,
                                    minLength: 1,
                                });
        }, 'json');
        input.change(function(){
                var current = input.typeahead("getActive");
                $('#country_id').val(current.id);
                //alert('dsfds');
                //agregaProducto(e);
        });
        //Fin Para busqueda de Productos

        //Para busqueda de Clientes
        var input2 = $("input[name=clienteB]");
        $.get(site_url+'index.php/ventas_controller/buscaCliente', function(data2){
                                input2.typeahead({
                                    source: data2,
                                    minLength: 1,
                                });
        }, 'json');
        input2.change(function(){
                var current2 = input2.typeahead("getActive");
                $('#cliente').val(current2.idCliente);
        });
        //Fin Para busqueda de Clientes
        
        //para guardar cliente sin salir ventas
        $(".crud-submit").click(function(e){
            e.preventDefault();
            var form_action = $("#create-item").find("form").attr("action");
            var empresa = $("#create-item").find("input[name='empresa']").val();
            var nombre = $("#create-item").find("input[name='nombre']").val();
            $.ajax({
                dataType: 'json',
                type:'POST',
                //url: url + form_action,
                url: form_action,
                data:{empresa:empresa, nombre:nombre}
            }).done(function(data){
                $(".modal").modal('hide');
                //toastr.success('Cliente agregado correctamente.', 'Success Alert', {timeOut: 5000});
            });
        });
        //fin para guardar cliente sin salir ventas
});
</script>
</body>	
</html>

