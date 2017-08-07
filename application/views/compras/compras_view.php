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
   
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.min.css" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.min.css.map" rel="stylesheet"> -->

    <link href="<?php echo base_url();?>css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery-3.2.1.min"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/bootstrap-datetimepicker.min.js"></script>


    <script language='javascript'>
        var compraJson = {'subtotalCompra':0,'ivaCompra':0,'totalCompra':0,
            'codigoProveedor':0,'tipoOperacion':1,'tipoCompra':1,'idCompra':0,'observaciones':'', 
            'fecha':'0000-00-00 00:00:00','idUsuario':'',
            detalleTemporal : [
                {'idArticulo':'-1','codigo':'-1','precio':0,'cantidad':0,'descuento':0,'total':0}
        ]};
    
	function enviarJson2() {    
            // Armado final del json
                //verifica si hay elementos en detalle de venta
            if (compraJson.detalleTemporal.length < 2) {
                alert('No hay compra para registrar');
                return;
            }
                //fib verifica si hay elementos en detalle de venta
                
                //identifica totales
            compraJson.subtotalCompra = parseFloat(document.getElementById('subtotal').value);
            compraJson.ivaCompra = parseFloat(document.getElementById('iva').value);
            compraJson.totalCompra = parseFloat(document.getElementById('total').value);
                //Fin identifica totales
            
                //identifica y guarda id proveedor
            var proveedor = document.getElementById('proveedorB').value;
            var proveedorDatos = proveedor.split(" ");
            var proveedorId = proveedorDatos[0];
            if (proveedorId=="") {
                compraJson.codigoProveedor = "1";
            } else {
                compraJson.codigoProveedor = "" + proveedorId;
            }
                //fin identifica y guarda id proveedor
                
                //Identifica modoOperacion
            compraJson.tipoOperacion = document.getElementById('modoOperacion').value;
                //Fin Identifica modoOperacion tipoCompra
                
                //Identifica tipoCompra
            compraJson.tipoCompra = document.getElementById('tipoCompra').value;    
                //Fin Identifica tipoCompra 
                
                //Identifica idCompra
            compraJson.idCompra = document.getElementById('idCompra').value;              
                //Fin Identifica idCompra
                
                //***** Identifica observaciones
            compraJson.observaciones = "marcos";
                //Fin Identifica observaciones
                
                //Identifica fechaVenta
            <?php
                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                $fechaVenta = $dt->format("Y-m-d H:i:s"); 
            ?>    
            compraJson.fecha = '<?php echo $fechaVenta; ?>';
                //Fin Identifica fechaVenta
                
                //Identifica idUsuario
            compraJson.idUsuario = '<?php echo $idUsuario; ?>';
            //restringe venta si no hay usuario seleccionado
            if (compraJson.idUsuario=="") {
                alert("Error, no puedes registrar venta. Debes ingresar al sistema, tu sesión a expirado");
                return;
            }
            //restringe venta si no hay usuario seleccionado
                //Fin Identifica idUsuario
                
            // Fin Armado final del json
            
                //Pregunta si se quiere imprimir la venta
            var r = confirm("¿Deseas imprimir la compra?");
            if (r) {
                var subtotalG = 0;
                var ivaSistema = '<?php echo $sistema[0]->{'ivaGral'}; ?>';
                var ivaG = 0;
                var totalG = 0;
                
                $.each(compraJson.detalleTemporal, function(i, v) {
                    <?php 
                       //ciclo para comparar el codigo y sacar la descripcion del producto 
                       foreach ($inventarios as $filaInv) { ?>
                            // Verifica si existe coincidencia emtre codigo con algun producto
                            if (v.codigo == <?php echo $filaInv->{'codigo'}; ?>) { 
                                var table = document.getElementById("tblPrint");
                                var noRenglones = table.rows.length;
                                //alert(noRenglones);
                                var row = table.insertRow(noRenglones);
                                var cell0 = row.insertCell(0);
                                var cell1 = row.insertCell(1);
                                var cell2 = row.insertCell(2);
                                var cell3 = row.insertCell(3);
                                var cell4 = row.insertCell(4);
                                row.id = ""+(noRenglones);

                                cell0.innerHTML = v.cantidad; 
                                cell1.innerHTML = "<?php echo $filaInv->{'descripcion'};?>";
                                cell2.innerHTML = v.precio;
                                cell3.innerHTML = v.descuento;
                                cell4.innerHTML = v.total;
                            } // Fin Verifica si existe coincidencia emtre codigo con algun producto
                    <?php
                       } // Fin ciclo para comparar el codigo y sacar la descripcion del producto 
                    ?>
                    subtotalG = subtotalG + parseFloat(v.total);
                });
                //fin funcion para recuperar venta temporal
                document.getElementById('subTotalPrint').innerHTML = "&nbsp;&nbsp;Subtotal.- " + subtotalG.toFixed(2);
                ivaG = (parseFloat(ivaSistema)/100) * subtotalG;
                document.getElementById('ivaPrint').innerHTML = "&nbsp;&nbsp;Iva.- " + ivaG.toFixed(2);
                document.getElementById('totalPrint').innerHTML = "&nbsp;&nbsp;Total.- " + (subtotalG + ivaG).toFixed(2);
                document.getElementById('pagoPrint').innerHTML = "&nbsp;&nbsp;Pago.- " + document.getElementById('txtPago').value;
                document.getElementById('cambioPrint').innerHTML = "&nbsp;&nbsp;Cambio.- " + document.getElementById('txtCambio').value;
                printDiv("ticketPrint");
            }
                //Fin Pregunta si se quiere imprimir la venta
            
            var dataString = JSON.stringify(compraJson);
            $.ajax({
               url: '<?php echo base_url();?>index.php/compras_controller/nuevoCompraFromFormulario',
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

        function recuperaCompraTemporal() {
            <?php 
            //Verifica que haya datos en temporalVtaCompra
            if (isset($temporalVtaCompras)) {
                //ciclo para recorrer el json de temporalventacompra
                foreach ($temporalVtaCompras as $fila) { 
                   //ciclo para comparar el codigo y sacar la descripcion del producto 
                   foreach ($inventarios as $filaInv) { ?>
                        // Verifica si existe coincidencia emtre codigo con algun producto
                        if (<?php echo $fila->{'codigo'}; ?> == <?php echo $filaInv->{'codigo'}; ?>) { 
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
                            row.id = ""+(noRenglones-1);
                            cell0.innerHTML = "<img src='<?php echo base_url();?>images/sistemaicons/borrar.ico' onclick='borraArticulo(this)' id="+ (noRenglones-1) +" name="+ (noRenglones-1) +" />"; 
                            cell1.innerHTML = "<?php echo $fila->{'codigo'};?>";
                            cell2.innerHTML = "<?php echo $filaInv->{'descripcion'};?>";
                            cell3.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='10' name='precio<?php echo $fila->{'idArticulo'};?>' id='precio<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'precio'};?>' onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,1)' /></div></div>";
                            cell4.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' name='cantidad<?php echo $fila->{'idArticulo'};?>' id='cantidad<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'cantidad'};?>' onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,2)' /></div></div>";
                            cell5.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' name='descuento<?php echo $fila->{'idArticulo'};?>' id='descuento<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'descuento'};?>'  onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,3)' /></div></div>";
                            cell6.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' disabled name='totalArt<?php echo $fila->{'idArticulo'};?>' id='totalArt<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'total'};?>' /></div></div>";
                            cell7.innerHTML = "<img src='<?php echo base_url();?>images/sistemaicons/agregar.ico' onclick='aumentaCantidadArticulo(<?php echo $fila->{'idArticulo'};?>)' />&nbsp;&nbsp;&nbsp;<img src='<?php echo base_url();?>images/sistemaicons/prohibido.ico' onclick='disminuyeCantidadArticulo(<?php echo $fila->{'idArticulo'};?>)' />"; 
                            compraJson.detalleTemporal.push({'idArticulo':'<?php echo $fila->{'idArticulo'};?>'
                                ,'codigo': '<?php echo $fila->{'codigo'};?>'
                                ,'precio': document.getElementById('precio<?php echo $fila->{'idArticulo'};?>').value
                                ,'cantidad': document.getElementById('cantidad<?php echo $fila->{'idArticulo'};?>').value
                                ,'descuento': document.getElementById('descuento<?php echo $fila->{'idArticulo'};?>').value
                                ,'total': document.getElementById('totalArt<?php echo $fila->{'idArticulo'};?>').value});
                            totalesGenerales();
                        } // Fin Verifica si existe coincidencia emtre codigo con algun producto
            <?php  } // Fin ciclo para comparar el codigo y sacar la descripcion del producto 
                } //Fin ciclo para recorrer el json de temporalventacompra
            } //Fin Verifica que haya datos en temporalVtaCompra
                ?>
            //fin funcion para recuperar venta temporal
            
            //borra venta temporal
            var site_url = "<?php echo site_url(); ?>";
            $.get(site_url+'index.php/compras_controller/borraCompraTemporal', function(data, status){
                var opciones = data;
            });       
            //fin borra venta temporal
        }
        
        function guardaCompraTemporal() {
            //borra y guarda compra en temporalVtaCompra
            var dataString = JSON.stringify(compraJson);
            $.ajax({
               url: '<?php echo base_url();?>index.php/compras_controller/guardaCompraTemporal',
               data: {myData: dataString},
               type: 'POST',
               success: function(response) {
//                      alert(response);
//                      location.reload();
               },
               error: function(response) {
//                      console.log('Error al ejecutar la petición');
               }
            });	
            //Fin borra y guarda compra en temporalVtaCompra
        }    
        
        function pagar(e2) { //return pagar(event)
            var tecla2 = (document.all) ? e2.keyCode : e2.which;
            if (tecla2 == 13){  
                var cambioVenta = parseFloat(document.getElementById('txtPago').value) - parseFloat(document.getElementById('total').value);
                document.getElementById('txtCambio').value = cambioVenta.toFixed(2);                
                //setTimeout(function(){ document.getElementById('txtCambio').value = ""; }, 3000);
                document.getElementById('btnCompraOk').focus();
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
                    compraJson.detalleTemporal.splice(1,1);
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
            //modifica compraJson em producto actual
            $.each(compraJson.detalleTemporal, function(i, v) {
                if (v.idArticulo == idArticulo) {
                    //alert(v.descuento);
                    v.precio = document.getElementById('precio'+idArticulo).value;
                    v.cantidad = document.getElementById('cantidad'+idArticulo).value;
                    v.descuento = document.getElementById('descuento'+idArticulo).value;
                    v.total = document.getElementById('totalArt'+idArticulo).value;
                }
            });          
            //fin modifica compraJson
            totalesGenerales();
        }
        
        function totalesGenerales() {
            //obtiene totales generales
            var subtotalG = 0;
            var ivaSistema = '<?php echo $sistema[0]->{'ivaGral'}; ?>';
//            alert('ivaSistema->'+ivaSistema);
            var ivaG = 0;
            var totalG = 0;
            $.each(compraJson.detalleTemporal, function(i, v) {
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
        
        var dataTemp;
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
//                        if (document.getElementById('tipoCompra').value == "2") {
//                            cell3.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='10' name='precio<?php echo $fila->{'idArticulo'};?>' id='precio<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'precioCosto'};?>' onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,1)' /></div></div>";
//                            precio = <?php echo $fila->{'precioCosto'};?>;
//                        } else {
//                            cell3.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='10' name='precio<?php echo $fila->{'idArticulo'};?>' id='precio<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'precioUnitario'};?>' onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,1)' /></div></div>";
//                            precio = <?php echo $fila->{'precioUnitario'};?>;
//                        }    
                        cell3.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='10' name='precio<?php echo $fila->{'idArticulo'};?>' id='precio<?php echo $fila->{'idArticulo'};?>' value='<?php echo $fila->{'precioCosto'};?>' onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,1)' /></div></div>";
                        precio = <?php echo $fila->{'precioCosto'};?>;
                        cell4.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' name='cantidad<?php echo $fila->{'idArticulo'};?>' id='cantidad<?php echo $fila->{'idArticulo'};?>' value='1' onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,2)' /></div></div>";
                        cell5.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' name='descuento<?php echo $fila->{'idArticulo'};?>' id='descuento<?php echo $fila->{'idArticulo'};?>' value='0'  onkeypress='return validaDecimal(event,<?php echo $fila->{'idArticulo'};?>,3)' /></div></div>";
                        var total = parseFloat(precio) * parseFloat(document.getElementById('cantidad<?php echo $fila->{'idArticulo'};?>').value);
                        var descuento = total * (parseFloat(document.getElementById('descuento<?php echo $fila->{'idArticulo'};?>').value) / 100);
                        var totalArtP = total - descuento;
                        cell6.innerHTML = "<div class='form-group'><div class='input-group col-sm-4'><input type='text' size='5' disabled name='totalArt<?php echo $fila->{'idArticulo'};?>' id='totalArt<?php echo $fila->{'idArticulo'};?>' value='" + totalArtP.toFixed(2) + "' /></div></div>";
                        cell7.innerHTML = "<img src='<?php echo base_url();?>images/sistemaicons/agregar.ico' onclick='aumentaCantidadArticulo(<?php echo $fila->{'idArticulo'};?>)' />&nbsp;&nbsp;&nbsp;<img src='<?php echo base_url();?>images/sistemaicons/prohibido.ico' onclick='disminuyeCantidadArticulo(<?php echo $fila->{'idArticulo'};?>)' />"; 
                        compraJson.detalleTemporal.push({'idArticulo':'<?php echo $fila->{'idArticulo'};?>', 'codigo': '<?php echo $fila->{'codigo'};?>'
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
                compraJson.detalleTemporal.splice(i-2, 1);
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
        
        
        //Para nuevo Inventario 
        function obtienePrecioUnitario(e) {
//                validaEnter(e,6);
// alert("fdsfsd");
            var code = (e.keyCode ? e.keyCode : e.which);
            document.getElementById('precioUnitarioInv').value = "";
            if(code == 13) { 
//                alert("fdsfsd");
                var ivaDecimal = parseFloat(document.getElementById('porcentajeImpuestoInv').value)/100;
                var ivaCantidad = parseFloat(document.getElementById('precioCostoInv').value) * ivaDecimal;
                var precioUnitario = parseFloat(document.getElementById('precioCostoInv').value) + ivaCantidad;
                document.getElementById('precioUnitarioInv').value = "" + precioUnitario;
                document.getElementById('existenciaInv').focus();
                return false;
            }
        }
        
        function mueveFocusAExistencia(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code == 13) { 
                document.getElementById('existenciaInv').focus();
            }
        }
        
        function habilitaSubmit() {
            //alert("cruz azul");
            document.getElementById('submit2').disabled = false;
        }
        
        function validaEnter(e,control) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code == 13) { 
                switch (control) {
                    case 1: document.getElementById('descripcionInv').focus(); break;
                    case 2: document.getElementById('precioCostoInv').focus(); break;
                    case 3: document.getElementById('existenciaMinimaInv').focus(); break;
                    case 4: document.getElementById('ubicacionInv').focus(); break;
                    case 5: document.getElementById('proveedorInv').focus(); break;
                }
                return false;
            }
        }
        //fin para nuevo inventario
        
        function enviaProdInv() {
            //e.preventDefault();
//            var form_action2 = $("#create-item2").find("form").attr("action");
            var codigoInv = $("#create-item2").find("input[name='codigoInv']").val();
            var descripcionInv = $("#create-item2").find("input[name='descripcionInv']").val();
            var porcentajeImpuestoInv = $("#create-item2").find("input[name='porcentajeImpuestoInv']").val();
            var precioCostoInv = $("#create-item2").find("input[name='precioCostoInv']").val();
            var precioUnitarioInv = $("#create-item2").find("input[name='precioUnitarioInv']").val();
            var existenciaInv = $("#create-item2").find("input[name='existenciaInv']").val();
            var existenciaMinimaInv = $("#create-item2").find("input[name='existenciaMinimaInv']").val();
            var ubicacionInv = $("#create-item2").find("input[name='ubicacionInv']").val();
            var proveedorInv = $("#create-item2").find("select[name='proveedorInv']").val();
            var categoriaInv = $("#create-item2").find("select[name='categoriaInv']").val();
            var sucursalInv = $("#create-item2").find("select[name='sucursalInv']").val();
            var fechaIngresoInv = $("#create-item2").find("input[name='fechaIngresoInv']").val();
            //var imagen = $("#create-item2").find("file[name='imagen']").val();
//            var observacionesInv = $("#create-item2").find("input[name='observacionesInv']").val();
            var observacionesInv = document.getElementById('observacionesInv').value;
            dataInv = {codigoInv:codigoInv, descripcionInv:descripcionInv, porcentajeImpuestoInv:porcentajeImpuestoInv,
                precioCostoInv:precioCostoInv,precioUnitarioInv:precioUnitarioInv,existenciaInv:existenciaInv,
                existenciaMinimaInv:existenciaMinimaInv,ubicacionInv:ubicacionInv,
                proveedorInv:proveedorInv,categoriaInv:categoriaInv,sucursalInv:sucursalInv,
                fechaIngresoInv:fechaIngresoInv,observacionesInv:observacionesInv};
            //var dataString = dataInv; compraJson
            var dataString = JSON.stringify(dataInv);
            $.ajax({
               url: '<?php echo base_url();?>index.php/compras_controller/nuevoInventarioFromFormulario',
               data: {myData: dataString},
               type: 'POST',
               success: function(response) {
                    $(".modal").modal('hide');
                    location.reload();               
               },
               error: function(response) {
               }
            });	
        }

        function printDiv(nombreDiv) {
             var contenido= document.getElementById(nombreDiv).innerHTML;
             var contenidoOriginal= document.body.innerHTML;
             document.body.innerHTML = contenido;
             window.print();
             document.body.innerHTML = contenidoOriginal;
        }

    </script>
</head>
<body onload="recuperaCompraTemporal()">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <div id="ticketPrint" name="ticketPrint" style="display:none">
                    <br>
                    <table>
                        <tr>
                            <td>
                                <p id="nomEmpresa">&nbsp;&nbsp;<?php echo $nombre_Empresa; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p id="dirEmpresa">&nbsp;&nbsp;<?php echo $dirEmpresa; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p id="rfcEmpresa">&nbsp;&nbsp;<?php echo $rfcEmpresa; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>&nbsp;&nbsp;No. Ticket de Compra: <?php echo $maxId; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>&nbsp;&nbsp;Fecha: <?php 
                                    $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                                    $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
                                    echo $fechaIngreso; ?></p>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table id='tblPrint' name='tblPrint' style="font-style: italic;text-align: center;">
                        <thead>
                        <th style="text-align: center">&nbsp;&nbsp;Cantidad&nbsp;&nbsp;</th>
                        <th style="text-align: center">&nbsp;&nbsp;Descripcion&nbsp;&nbsp;</th>
                        <th style="text-align: center">&nbsp;&nbsp;Precio Unitario&nbsp;&nbsp;</th>
                        <th style="text-align: center">&nbsp;&nbsp;% Descuento&nbsp;&nbsp;</th>
                        <th style="text-align: center;border-bottom: #000;border-width: medium;">&nbsp;&nbsp;Total&nbsp;&nbsp;</th>
                        </thead>
                    </table>
                    <br>
                    <p id="subTotalPrint"></p>
                    <p id="ivaPrint"></p>
                    <p id="totalPrint"></p>
                    <p id="pagoPrint"></p>
                    <p id="cambioPrint"></p>
                    <br>
                    <p>&nbsp;&nbsp;Gracias. Fu&eacute; un placer atenderle</p>
                </div>
                
                <table id="tblVenta" class="table table-striped" style="border: 1px solid #FFF;border-color: red">
                    <thead>
                        <tr style="background: #ffcccc">
                            <td colspan="5">
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="proveedorB">Proveedor (Opcional):</label>
                                    <br>
                                    <div class="input-group col-sm-12">
                                        <input type="hidden" class="form-control" name="proveedor" id="proveedor" />
                                        <input type="text" class="form-control col-sm-2" name="proveedorB" id="proveedorB" placeholder="Proveedor (Opcional)" autocomplete="off"  onkeypress="verificaEnter(event)" />
                                    </div>					  
                                    <br>
                                    <div class="input-group col-sm-12">
                                        <input type="button" class="btn btn-success" value="Nuevo Proveedor" data-toggle="modal" data-target="#create-item" onclick="guardaCompraTemporal();"/>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="button" class="btn btn-success" value="Nuevo Producto" data-toggle="modal" data-target="#create-item2" onclick="guardaCompraTemporal();"/>
                                    </div>					  
                                </div>       
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group col-sm-12">
                                        <p>Tipo de Registro:
                                            <select class="form-control col-sm-5" name="modoOperacion" id="modoOperacion" onchange="javascript: return muestraAdvertencia()" >
                                            <option value="1">Compra</option>
                                            <option value="2">Regreso</option>
                                        </select>
                                        </p>
                                        <p style="display:none">Tipo de Compra:
                                        <select class="form-control col-sm-5" name="tipoCompra" id="tipoCompra">
                                            <option value="1">Menudeo</option>
                                            <option value="2">Mayoreo</option>
                                        </select>
                                        </p>
                                        <p>No. de Compra:
                                            <input type="text" class="form-control" name="idCompra" id="idCompra" placeholder="Ticket Venta" value="<?php echo $maxId; ?>" disabled="true" />
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
                        <tr style="background: #ffcccc">
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
                                        <input type="button" class="btn btn-reset btn-md" value="Cancelar Compra" onclick="borraVentaTemporal()"/>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="submit" class="btn btn-primary btn-md" value="Guardar Compra" id="btnCompraOk" name="btnCompraOk" onclick="enviarJson2()" />
                                    </div>					  
                                </div>       
                            </td>
                        </tr>
                        <tr>
                            <th><img src='<?php echo base_url();?>images/sistemaicons/borrarok.ico' /></th>
                            <th>C&oacute;digo</th>
                            <th>Descripci&oacute;n</th>
                            <th>Precio Costo</th>
                            <th>Cant.</th>
                            <th>%Imp.</th>
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
                        <th>Precio Costo</th>
                        <th>Cant.</th>
                        <th>%Imp.</th>
                        <th>Total</th>
                        <th>Editar Cantidad</th>
                    </tfoot>
                </table>
            </div>
        </div> <!-- /division renglon en 12-->
    </div> <!-- / renglon-->
</div> <!-- /container -->

<!-- Modal proveedor -->
<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nuevo Proveedor</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" class="form-horizontal" action="<?php echo base_url();?>index.php/compras_controller/nuevoProveedorFromFormulario" method="post">
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
                    <button type="submit" class="btn crud-submit btn-success" >Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal proveedor -->

<!-- Modal Inventario -->
<div class="modal fade" id="create-item2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4>
            </div>
            <div class="modal-body">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <form data-toggle="validator" id="productoForm" name="productoForm" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/compras_controller/nuevoInventarioFromFormulario" method="post"  enctype="multipart/form-data" >
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="codigoInv">C&oacute;digo:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                            <input type="text" class="form-control" id="codigoInv" name="codigoInv" placeholder="C&oacute;digo" onkeypress="javascript: return validaEnter(event,1)">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="descripcionInv">Descripci&oacute;n:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                            <input type="text" class="form-control" id="descripcionInv" name="descripcionInv" placeholder="Descripci&oacute;n" onkeypress="javascript: return validaEnter(event,2)">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="porcentajeImpuestoInv">Iva:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
                            <input type="text" class="form-control" id="porcentajeImpuestoInv" name="porcentajeImpuestoInv" placeholder="Iva" value="<?php echo $iva?>">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="precioCostoInv">Precio Costo:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input type="text" class="form-control" id="precioCostoInv" name="precioCostoInv" placeholder="Precio Costo" onkeydown="javascript: return obtienePrecioUnitario(event);">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="precioUnitarioInv">Precio Unitario:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input type="text" class="form-control" id="precioUnitarioInv" name="precioUnitarioInv" placeholder="Precio Unitario" value="0" onkeypress="mueveFocusAExistencia(event)">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="existenciaInv">Existencia:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>
                            <input type="text" class="form-control" id="existenciaInv" name="existenciaInv" placeholder="Existencia" onkeypress="javascript: return validaEnter(event,3)">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="existenciaMinimaInv">Existencia M&iacute;nima:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-check"></i></span>
                            <input type="text" class="form-control" id="existenciaMinimaInv" name="existenciaMinimaInv" placeholder="Existencia M&iacute;nima" onkeypress="javascript: return validaEnter(event,4)">
                        </div>					  
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="ubicacionInv">Ubicaci&oacute;n:</label>
                      <div class="col-md-10 inputGroupContainer">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                            <input type="text" class="form-control" id="ubicacionInv" name="ubicacionInv" placeholder="Ubicaci&oacute;n" onkeypress="javascript: return validaEnter(event,5)">
                        </div>					  
                      </div>
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="proveedorInv">Proveedor:</label>
                      <div class="col-sm-10">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select class="form-control" name="proveedorInv" id="proveedorInv">
                              <option value=""></option>
                              <?php foreach($proveedores as $filaP) {
                               echo "<option value=".$filaP->{'idProveedor'}.">".$filaP->{'empresa'}."</option>";
                              } ?>
                            </select>
                        </div>					  
                      </div>					  
                    </div>  
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="categoriaInv">Categor&iacute;a:</label>
                      <div class="col-sm-10">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select class="form-control" name="categoriaInv" id="categoriaInv">
                                <option value=""></option>
                                <?php foreach($categorias as $fila) {
                                 echo "<option value=".$fila->{'idCategoria'}.">".$fila->{'descripcionCategoria'}."</option>";
                                } ?>
                            </select>
                        </div>					  
                      </div>					  
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="sucursalInv">Sucursal:</label>
                      <div class="col-sm-10">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select class="form-control" name="sucursalInv" id="sucursalInv">
                                <option value=""></option>
                                <?php foreach($sucursales as $fila) {
                                 echo "<option value=".$fila->{'idSucursal'}.">".$fila->{'descripcionSucursal'}."</option>";
                                } ?>
                            </select>
                        </div>					  
                      </div>					  
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="fechaIngresoInv">FechaIngreso: </label>
                        <div class="col-md-9 inputGroupContainer">
                            <div class="input-append date form_datetime"  class="input-group"> 
                                <input type="text" value="" name="fechaIngresoInv" id="fechaIngresoInv" readonly>
                                <span class="add-on"><i class="icon-th"></i></span>
                                <script type="text/javascript">
                                    $(".form_datetime").datetimepicker({
                                        format: "yyyy-mm-dd hh:ii:ss",
                                        autoclose: true,
                                        pickerPosition: "right"
                                    });
                                </script>
                            </div>
                        </div>
                    </div>                    
                    
<!--                    <div class="form-group">
                        <div class="col-sm-5">	
                            <p>Tamaño Imagen 100 x 100</p>
                            <input type="file" id="files" name="imagen"/>
                            <output id="list"></output>-->

                            <script>
//                                  function archivo(evt) {
//                                      var files = evt.target.files; // FileList object
//
//                                      // Obtenemos la imagen del campo "file".
//                                      for (var i = 0, f; f = files[i]; i++) {
//                                        //Solo admitimos imágenes.
//                                        if (!f.type.match('image.*')) {
//                                            continue;
//                                        }
//
//                                        var reader = new FileReader();
//
//                                        reader.onload = (function(theFile) {
//                                            return function(e) {
//                                              // Insertamos la imagen
//                                             document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
//                                            };
//                                        })(f);
//
//                                        reader.readAsDataURL(f);
//                                      }
//                                  }
//                                  document.getElementById('files').addEventListener('change', archivo, false);
                           </script>                        
<!--                        </div>		
                    </div>-->

                    <div class="form-group">
                      <label class="control-label col-sm-3" for="observacionesInv">Observaciones:</label>
                      <div class="col-sm-9">
                          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                              <textarea class="form-control" rows="5" id="observacionesInv" name="observacionesInv"></textarea>
                          </div>					  
                      </div>					  
                    </div>  
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="submitInv" onclick="enviaProdInv()" >Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Fin Modal  Inventario -->

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

        //Para busqueda de Proveedores
        var input2 = $("input[name=proveedorB]");
//        $.get(site_url+'index.php/compras_controller/refrescaDatosProveedores', function(data2){
//                                input2.typeahead({
//                                    source: data2,
//                                    minLength: 1,
//                                });
//           });
        $.get(site_url+'index.php/compras_controller/buscaProveedor', function(data2){                                
                                input2.typeahead({
                                    source: data2,
                                    minLength: 1,
                                });
        }, 'json');
        input2.change(function(){
                var current2 = input2.typeahead("getActive");
                $('#proveedor').val(current2.idProveedor);
                verificaEnter(e);
        });
        //Fin Para busqueda de Proveedores
        
        //para guardar proveedor sin salir compras
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
                //$(".modal").modal('hide');
                //toastr.success('Proveedor agregado correctamente.', 'Success Alert', {timeOut: 5000});
            });
//            recuperaCompraTemporal();
            //alert("sad");
            $(".modal").modal('hide');
            location.reload();
        });
        //fin para guardar Proveedor sin salir compras
        
});
</script>
<!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>-->
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>-->
<script type="text/javascript">
    $('#create-item2').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            codigoInv: {
                validators: {
                        stringLength: {
                            max: 40
                        },
                        notEmpty: {
                            message: 'Por favor Ingresa el Código'
                        }
                }
            },
            descripcionInv: {
                validators: {
                     stringLength: {
                        max: 50
                    },
                    notEmpty: {
                        message: 'Por favor Ingresa la Descripción'
                    }
                }
            },
            precioCostoInv: {
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
            porcentajeImpuestoInv: {
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
            existenciaInv: {
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
            existenciaMinimaInv: {
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
            ubicacionInv: {
                validators: {
                    stringLength: {
                        max: 50
                    },
                    notEmpty: {
                        message: 'Por favor Ingresa la Ubicación del producto'
                    }
                }
            },
            proveedorInv: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Selecciona un Proveedor.'
                    }
                }
            },
            categoriaInv: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Selecciona una Categoria.'
                    }
                }
            },
            sucursalInv: {
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

