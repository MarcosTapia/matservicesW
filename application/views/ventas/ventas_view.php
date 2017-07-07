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
        var obsVacio = "";
        var ventaJson = {'subtotalVenta':0,'ivaVenta':0,'totalVenta':0,
            'codigoCliente':0,'tipoOperacion':1,'tipoVenta':1,'ticketVenta':0,'observaciones':'', 
            'fecha':'0000-00-00 00:00:00','idUsuario':'',
            detalleTemporal : [
                {'idArticulo':'-1','codigo':'-1','precio':0,'cantidad':0,'descuento':0,'total':0}
        ]};
    
	function enviarJson2() {    
            // Armado final del json
                //verifica si hay elementos en detalle de venta
            if (ventaJson.detalleTemporal.length < 2) {
                alert('No hay venta para registrar');
                return;
            }
                //fib verifica si hay elementos en detalle de venta
                
                //identifica totales
            ventaJson.subtotalVenta = parseFloat(document.getElementById('subtotal').value);
            ventaJson.ivaVenta = parseFloat(document.getElementById('iva').value);
            ventaJson.totalVenta = parseFloat(document.getElementById('total').value);
                //Fin identifica totales
            
                //identifica y guarda id cliente
            var cliente = document.getElementById('clienteB').value;
            var clienteDatos = cliente.split(" ");
            var clienteId = clienteDatos[0];
            if (clienteId=="") {
                ventaJson.codigoCliente = "1";
            } else {
                ventaJson.codigoCliente = "" + clienteId;
            }
                //fin identifica y guarda id cliente
                
                //Identifica modoOperacion
            ventaJson.tipoOperacion = document.getElementById('modoOperacion').value;
                //Fin Identifica modoOperacion tipoVenta
                
                //Identifica tipoVenta
            ventaJson.tipoVenta = document.getElementById('tipoVenta').value;    
                //Fin Identifica tipoVenta 
                
                //Identifica ticket
            ventaJson.ticketVenta = document.getElementById('ticket').value;              
                //Fin Identifica ticket
                
                //***** Identifica observaciones
            ventaJson.observaciones = "marcos";
                //Fin Identifica observaciones
                
                //Identifica fechaVenta
            <?php
                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                $fechaVenta = $dt->format("Y-m-d H:i:s"); 
            ?>    
            ventaJson.fecha = '<?php echo $fechaVenta; ?>';
                //Fin Identifica fechaVenta
                
                //Identifica idUsuario
            ventaJson.idUsuario = '<?php echo $idUsuario; ?>';
            //restringe venta si no hay usuario seleccionado
            if (ventaJson.idUsuario=="") {
                alert("Error, no puedes registrar venta. Debes ingresar al sistema, tu sesión a expirado");
                return;
            }
            //restringe venta si no hay usuario seleccionado
                //Fin Identifica idUsuario
                
            // Fin Armado final del json
            
            var dataString = JSON.stringify(ventaJson);
            $.ajax({
               url: '<?php echo base_url();?>index.php/ventas_controller/nuevoVentaFromFormulario',
               data: {myData: dataString},
               type: 'POST',
               success: function(response) {
                      alert(response);
                      location.reload();
               },
               error: function(response) {
                      console.log('Error al ejecutar la petición');
               }
            });	
	}
        
        function muestraAdvertencia() {
            if (document.getElementById('modoOperacion').value=="2") {
                alert("En ésta opción solo se regresa el producto en inventario, si hubo venta ésta permanece.");
            }
        }

        function pagar(e2) { //return pagar(event)
            var tecla2 = (document.all) ? e2.keyCode : e2.which;
            if (tecla2 == 13){  
                var cambioVenta = parseFloat(document.getElementById('txtPago').value) - parseFloat(document.getElementById('total').value);
                document.getElementById('txtCambio').value = cambioVenta.toFixed(2);                
                //setTimeout(function(){ document.getElementById('txtCambio').value = ""; }, 3000);
                document.getElementById('btnVentaOk').focus();
            } else {
                if (tecla2==8){
                    document.getElementById('txtCambio').value = "";
                    return true;
                }
                // Patron de entrada, en este caso solo acepta numeros
                var patron2 = /^[0-9]*\.?[0-9]*$/;
                var tecla_final2 = String.fromCharCode(tecla2);
                //alert(tecla_final2);
                var cadena2 = "" + document.getElementById('txtPago').value;
                if (tecla_final2==".") {              
                    if (cadena2.indexOf(tecla_final2)!=-1) {
                        return false;
                    }
                }
                return patron2.test(tecla_final2);
            }
       }
       
       function borraVentaTemporal() { //checar
            var r = confirm("¿Realmente deseas eliminar la venta?");
            if (r) {
                var table = document.getElementById("tblVenta");
                var noRenglones = table.rows.length;
                //Borra datos de json
                for (var i=3;i <= noRenglones; i++){
                    ventaJson.detalleTemporal.splice(1,1);
                } 
                //Fin Borra datos de json
                
                //borra renglones de la tabla
                while (noRenglones > 4){
                    document.getElementById("tblVenta").deleteRow(3);
                    noRenglones = table.rows.length;
                }
                //Fin borra renglones de la tabla
                
                totalesGenerales();
            }
        }
        
        function obtieneTotalArticulo(idArticulo){
            //alert(""+noControl);
//            alert(""+noControl+"->"+controlActual);
            precio = document.getElementById('precio'+idArticulo).value;
            var total = parseFloat(precio) * parseFloat(document.getElementById('cantidad' + idArticulo).value);
            var descuento = total * (parseFloat(document.getElementById('descuento' + idArticulo).value) / 100);
            var totalArtP = total - descuento;
            document.getElementById('totalArt'+idArticulo).value = totalArtP.toFixed(2);
            //modifica ventaJson em producto actual
            $.each(ventaJson.detalleTemporal, function(i, v) {
                if (v.idArticulo == idArticulo) {
                    //alert(v.descuento);
                    v.precio = document.getElementById('precio'+idArticulo).value;
                    v.cantidad = document.getElementById('cantidad'+idArticulo).value;
                    v.descuento = document.getElementById('descuento'+idArticulo).value;
                    v.total = document.getElementById('totalArt'+idArticulo).value;
                }
            });          
            //fin modifica ventaJson
            totalesGenerales();
        }
        
        function totalesGenerales() {
            //obtiene totales generales
            var subtotalG = 0;
            var ivaSistema = '<?php echo $iva; ?>';
//            alert('ivaSistema->'+ivaSistema);
            var ivaG = 0;
            var totalG = 0;
            $.each(ventaJson.detalleTemporal, function(i, v) {
                subtotalG = subtotalG + parseFloat(v.total);
            });
//            alert("subtotal->" + subtotalG);
            document.getElementById('subtotal').value = subtotalG.toFixed(2);
            ivaG = (parseFloat(ivaSistema)/100) * subtotalG;
            document.getElementById('iva').value = ivaG.toFixed(2);
            document.getElementById('total').value = (subtotalG + ivaG).toFixed(2);
            //obtiene totales generales
        }
        
        function validaDecimal(e,noControl,controlActual){
            //si controlActual=1 precio, si controlActual=2 cantidad, si controlActual=3 porcentaje descuento,  
            tecla = (document.all) ? e.keyCode : e.which;
            //Tecla de retroceso para borrar, siempre la permite
            if (tecla==8){
                return true;
            }
            // Patron de entrada, en este caso solo acepta numeros
            patron = /^[0-9]*\.?[0-9]*$/;
            tecla_final = String.fromCharCode(tecla);
            var cadena;
            switch (controlActual) {
                case 1: 
                    cadena = ""+document.getElementById('precio'+noControl).value; break;
                case 2: 
                    cadena = ""+document.getElementById('cantidad'+noControl).value; break;
                case 3: 
                    cadena = ""+document.getElementById('descuento'+noControl).value; break;
            }
            if (tecla_final==".") {              
                if (cadena.indexOf(tecla_final)!=-1) {
                    return false;
                }
            }
            if (tecla==13){  
                switch (controlActual) {
                    case 1: 
                        document.getElementById('cantidad'+noControl).focus(); break;
                    case 2: 
                        document.getElementById('descuento'+noControl).focus(); break;
                    case 3: 
                        document.getElementById('codigoProducto').focus(); break;
                }
            }
            obtieneTotalArticulo(noControl);
            return patron.test(tecla_final);
        }
        
        function verificaEnter(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code == 13) { //Enter keycode
                document.getElementById('codigoProducto').focus();
            }
        }
        
        function agregaProducto(e){
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code == 13) { //Enter keycode
                var producto = document.getElementById('codigoProducto').value; 
                var prodCod = producto.split(" ");
                //setTimeout(borraCodigo(), 1000);
                document.getElementById('codigoProducto').value = "";
                var table = document.getElementById("tblVenta");
                var noRenglones = table.rows.length;
                //alert(noRenglones);
                var row = table.insertRow(noRenglones-1);
                var cell0 = row.insertCell(0);
                var cell1 = row.insertCell(1);
                var cell2 = row.insertCell(2);
                var cell3 = row.insertCell(3);
                var cell4 = row.insertCell(4);
                var cell5 = row.insertCell(5);
                var cell6 = row.insertCell(6);
                var cell7 = row.insertCell(7);
                <?php
                 foreach ($inventarios as $fila) { ?>//
                    if (prodCod[0] == <?php echo $fila->{'codigo'}; ?>) { 
                        row.id = ""+(noRenglones-1);
                        cell0.innerHTML = "<img src='<?php echo base_url();?>images/sistemaicons/borrar.ico' onclick='borraArticulo(this)' id="+ (noRenglones-1) +" name="+ (noRenglones-1) +" />"; 
                        cell1.innerHTML = "<?php echo $fila->{'codigo'};?>";
                        cell2.innerHTML = "<?php echo $fila->{'descripcion'};?>";
                        var precio;
                        if (document.getElementById('tipoVenta').value == "2") {
                            cell3.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='10' name='precio<?php echo $fila->{'idArticulo'};?>' id='precio<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'precioCosto'};?>' onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,1)' /></div></div>";
                            precio = <?php echo $fila->{'precioCosto'};?>;
                        } else {
                            cell3.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='10' name='precio<?php echo $fila->{'idArticulo'};?>' id='precio<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'precioUnitario'};?>' onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,1)' /></div></div>";
                            precio = <?php echo $fila->{'precioUnitario'};?>;
                        }    
                        cell4.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' name='cantidad<?php echo $fila->{'idArticulo'};?>' id='cantidad<?php echo $fila->{'idArticulo'};?>' value='1' onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,2)' /></div></div>";
                        cell5.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' name='descuento<?php echo $fila->{'idArticulo'};?>' id='descuento<?php echo $fila->{'idArticulo'};?>' value='0'  onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,3)' /></div></div>";
                        var total = parseFloat(precio) * parseFloat(document.getElementById('cantidad<?php echo $fila->{'idArticulo'};?>').value);
                        var descuento = total * (parseFloat(document.getElementById('descuento<?php echo $fila->{'idArticulo'};?>').value) / 100);
                        var totalArtP = total - descuento;
                        cell6.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' disabled name='totalArt<?php echo $fila->{'idArticulo'};?>' id='totalArt<?php echo $fila->{'idArticulo'};?>' value='" + totalArtP.toFixed(2) + "' /></div></div>";
                        cell7.innerHTML = "<img src='<?php echo base_url();?>images/sistemaicons/agregar.ico' onclick='aumentaCantidadArticulo(<?php echo $fila->{'idArticulo'};?>)' />&nbsp;&nbsp;&nbsp;<img src='<?php echo base_url();?>images/sistemaicons/prohibido.ico' onclick='disminuyeCantidadArticulo(<?php echo $fila->{'idArticulo'};?>)' />"; 
                        ventaJson.detalleTemporal.push({'idArticulo':'<?php echo $fila->{'idArticulo'};?>', 'codigo': '<?php echo $fila->{'codigo'};?>'
                            ,'precio': document.getElementById('precio<?php echo $fila->{'idArticulo'};?>').value
                            ,'cantidad': document.getElementById('cantidad<?php echo $fila->{'idArticulo'};?>').value
                            ,'descuento': document.getElementById('descuento<?php echo $fila->{'idArticulo'};?>').value
                            ,'total': totalArtP});
                        //recuperaVentaTemporal();
                        totalesGenerales();
                    }
               <?php  }
                ?>//
            }
        }
                
        function borraCodigo() {
            document.getElementById('codigoProducto').value = "";        
        }
        
        function borraArticulo(renglonArticulo){
            var r = confirm("¿Realmente deseas borrar?");
            if (r) {
                var i = renglonArticulo.parentNode.parentNode.rowIndex;
                document.getElementById("tblVenta").deleteRow(i);
                ventaJson.detalleTemporal.splice(i-2, 1);
            }    
        }
        
        function aumentaCantidadArticulo(idCantidad) {
            var idObjeto = 'cantidad' + idCantidad;
            document.getElementById(idObjeto).value = parseInt(document.getElementById(idObjeto).value) + 1;
            //totalArticulo(idCantidad);
            obtieneTotalArticulo(idCantidad);
        }
        
        function disminuyeCantidadArticulo(idCantidad) {
            var idObjeto = 'cantidad' + idCantidad;
            document.getElementById(idObjeto).value = parseInt(document.getElementById(idObjeto).value) - 1;
            //totalArticulo(idCantidad);
            obtieneTotalArticulo(idCantidad);
        }
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
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="clienteB">Cliente (Opcional):</label>
                                    <br>
                                    <div class="input-group col-sm-12">
                                        <input type="hidden" class="form-control" name="cliente" id="cliente" />
                                        <input type="text" class="form-control col-sm-2" name="clienteB" id="clienteB" placeholder="Cliente (Opcional)" autocomplete="off"  onkeypress="verificaEnter(event)" />
                                    </div>					  
                                    <br>
                                    <div class="input-group col-sm-12">
                                        <input type="button" class="btn btn-success" value="Nuevo Cliente" data-toggle="modal" data-target="#create-item" />
                                    </div>					  
                                </div>       
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group col-sm-12">
                                        <p>Tipo de Registro:
                                            <select class="form-control col-sm-5" name="modoOperacion" id="modoOperacion" onchange="javascript: return muestraAdvertencia()" >
                                            <option value="1">Venta</option>
                                            <option value="2">Regreso</option>
                                        </select>
                                        </p>
                                        <p>Tipo de Venta:
                                        <select class="form-control col-sm-5" name="tipoVenta" id="tipoVenta">
                                            <option value="1">Menudeo</option>
                                            <option value="2">Mayoreo</option>
                                        </select>
                                        </p>
                                        <p>Ticket de Venta:
                                            <input type="text" class="form-control" name="ticket" id="ticket" placeholder="Ticket Venta" value="<?php echo $maxId; ?>" disabled="true" />
                                        </p>
                                    </div>       
                                </div>       
                            </td>
                            <td colspan="2">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="subtotal">Subtotal:</label>
                                    <div class="input-group col-sm-8">
                                        <input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="Subtotal" disabled="true" />
                                    </div>					  
                                </div>       
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="iva">Iva:</label>
                                    <div class="input-group col-sm-8">
                                        <input type="text" class="form-control" name="iva" id="iva" placeholder="Iva" disabled="true" />
                                    </div>					  
                                </div>       
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="total">Total:</label>
                                    <div class="input-group col-sm-8">
                                        <input type="text" class="form-control" name="total" id="total" placeholder="Total" disabled="true" />
                                    </div>					  
                                </div>       
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="txtPago">Pago:</label>
                                    <div class="input-group col-sm-8">
                                        <input type="text" class="form-control" name="txtPago" id="txtPago" placeholder="Pago" onkeypress="return pagar(event)" />
                                    </div>					  
                                </div>       
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="txtCambio">Cambio:</label>
                                    <div class="input-group col-sm-8">
                                        <input type="text" class="form-control" disabled="true" name="txtCambio" id="txtCambio" placeholder="Cambio" />
                                    </div>					  
                                </div>       
                            </td>
                        </tr>
                        <tr style="background: #00ccff">
                            <td colspan="6">
                                <div class="form-group">
                                    <label class="col-sm-2" for="codigoProducto">C&oacute;digo</label>
                                    <div class="input-group col-sm-10">
                                        <input type="hidden" class="form-control" name="country_id" id="country_id">
                                        <input type="text" class="form-control" name="codigoProducto" id="codigoProducto" placeholder="C&oacute;digo &oacute; Descripci&oacute;n" autocomplete="off" onkeypress="agregaProducto(event)" />
                                    </div>					  
                                </div>       
                            </td>
                            <td colspan="2">
                                <div class="form-group">
                                    <div class="input-group col-sm-12">
                                        <!-- <img src='<?php echo base_url();?>images/sistemaicons/agregar.ico' -->
                                        <!-- <i class="icon-user icon-white"></i> -->
                                        <input type="button" class="btn btn-reset btn-md" value="Cancelar Venta" onclick="borraVentaTemporal()"/>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="submit" class="btn btn-primary btn-md" value="Guardar Venta" id="btnVentaOk" name="btnVentaOk" onclick="enviarJson2()" />
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
                agregaProducto(e);
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
                verificaEnter(e);
        });
        //Fin Para busqueda de Clientes
        
        //para guardar cliente sin salir ventas
        $(".crud-submit").click(function(e){
            e.preventDefault();
            var form_action = $("#create-item").find("form").attr("action");
            var empresa = $("#create-item").find("input[name='empresa']").val();
            var nombre = $("#create-item").find("input[name='nombre']").val();
            var apellidos = $("#create-item").find("input[name='apellidos']").val();
            var telefono_casa = $("#create-item").find("input[name='telefono_casa']").val();
            var telefono_celular = $("#create-item").find("input[name='telefono_celular']").val();
            var direccion1 = $("#create-item").find("input[name='direccion1']").val();
            var direccion2 = $("#create-item").find("input[name='direccion2']").val();
            var rfc = $("#create-item").find("input[name='rfc']").val();
            var email = $("#create-item").find("input[name='email']").val();
            var ciudad = $("#create-item").find("input[name='ciudad']").val();
            var estado = $("#create-item").find("input[name='estado']").val();
            var cp = $("#create-item").find("input[name='cp']").val();
            var pais = $("#create-item").find("input[name='pais']").val();
            var comentarios = $("#create-item").find("input[name='comentarios']").val();
            var noCuenta = $("#create-item").find("input[name='noCuenta']").val();
            $.ajax({
                dataType: 'json',
                type:'POST',
                //url: url + form_action,
                url: form_action,
                data:{empresa:empresa, nombre:nombre, apellidos:apellidos,
                    telefono_casa:telefono_casa,telefono_celular:telefono_celular,
                    direccion1:direccion1,direccion2:direccion2,rfc:rfc,
                    email:email,ciudad:ciudad,estado:estado,cp:cp,pais:pais,
                    comentarios:comentarios,noCuenta:noCuenta
                    }
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

