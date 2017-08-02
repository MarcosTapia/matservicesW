<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Generaci&oacute;n de C&oacute;digo de Barras</title>
    <script>
        function printDiv(nombreDiv) {
             var contenido= document.getElementById(nombreDiv).innerHTML;
             var contenidoOriginal= document.body.innerHTML;
             document.body.innerHTML = contenido;
             window.print();
             document.body.innerHTML = contenidoOriginal;
        }
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <br><br><br>
                <div id="areaImprimir">
                    <?php 
                        echo "<img src='".site_url()."index.php/barcode/barcode?barcode=".$items[0]['id']."&text=".$items[0]['name']."&width=256' />";
                    ?>
                </div>
                <br><br><br>
                <input type="button" class="btn btn-primary" onclick="printDiv('areaImprimir')" value="Imprimir" />
                <a href="<?php echo base_url();?>index.php/inventarios_controller/mostrarInventarios">
                <button type="button" class="btn btn-danger">Regresar</button></a>
            </div>
            <div class="col-md-3">
            </div>
        </div>  
    </div>  
</div>  
</body>
</html>
