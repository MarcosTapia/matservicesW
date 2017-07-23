<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Consultas_controller extends CI_Controller {
    private $datosEmpresaGlobal;
    private $nombreEmpresaGlobal;
    private $proveedoresGlobal;
    private $categoriasGlobal;
    private $sucursalesGlobal;
    private $ivaEmpresaGlobal;
    private $inventarioGlobal;
    private $clientesGlobal;
    private $busquedaInventarioGlobal;
    
    function __construct(){
        parent::__construct();
        $this->load->model('sistema_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->error = "";
        
        //para subir imagenes
        $this->load->helper("URL", "DATE", "URI", "FORM");
        $this->load->library('upload');
        $this->load->model('mupload_model');    
        
        $this->busquedaInventarioGlobal = $this->busquedaProductoInventario();
        $this->inventarioGlobal = $this->cargaDatosInventarios();
        $this->datosEmpresaGlobal = $this->cargaDatosEmpresa();
        $this->sistemaGlobal = $this->cargaDatosSistema();
        $this->proveedoresGlobal = $this->cargaDatosProveedores();
        $this->clientesGlobal = $this->cargaDatosClientes();
        $this->categoriasGlobal = $this->cargaDatosCategorias();
        $this->sucursalesGlobal = $this->cargaDatosSucursales();
        $this->nombreEmpresaGlobal = $this->datosEmpresaGlobal[0]->{'nombreEmpresa'};
        $this->ivaEmpresaGlobal = $this->sistemaGlobal[0]->{'ivaEmpresa'};
    }
    
    function cargaDatosEmpresa() {
        //muestra valores de datos de Empresa
        # An HTTP GET request example
        $url2 = RUTAWS.'datosempresa/obtener_datosempresas.php';
        $ch2 = curl_init($url2);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        $data2 = curl_exec($ch2);
        $datos2 = json_decode($data2);
        curl_close($ch2);
        $i=0;
        return $datos2->{'datosEmpresas'};
        //Fin muestra valores de datos de Empresa
    }
    
    function cargaDatosSistema() {
        //muestra valores de datos del Sistema
        # An HTTP GET request example
        $url2 = RUTAWS.'sistema/obtener_sistemas.php';
        $ch2 = curl_init($url2);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        $data2 = curl_exec($ch2);
        $datos2 = json_decode($data2);
        curl_close($ch2);
        $i=0;
        return $datos2->{'sistemas'};
        //Fin muestra valores de datos de Empresa
    }
    
    function cargaDatosProveedores() {
        # An HTTP GET request example
        $url = RUTAWS.'proveedores/obtener_proveedores.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        return $datos->{'proveedores'};
    }
    
    function cargaDatosCategorias() {
        //muestra valores de categorias
        # An HTTP GET request example
        $url = RUTAWS.'categorias/obtener_categorias.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        $categorias;
        $i=0;
        //Fin muestra valores de categorias
        return $datos->{'categorias'};
    }

    function cargaDatosSucursales() {
        //muestra valores de categorias
        # An HTTP GET request example
        $url = RUTAWS.'sucursales/obtener_sucursales.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        $sucursales;
        $i=0;
        //Fin muestra valores de categorias
        return $datos->{'sucursales'};
    }
    
    function cargaDatosInventarios() {
        # An HTTP GET request example
        $url = RUTAWS.'inventarios/obtener_inventarios.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        $inventarios;
        $i=0;
        return $datos->{'inventarios'};
    }
    
    function cargaDatosClientes() {
        # An HTTP GET request example
        $url = RUTAWS.'clientes/obtener_clientes.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        $inventarios;
        $i=0;
        return $datos->{'clientes'};
    }
    
    function obtieneMaxIdInventario() {
        # An HTTP GET request example
        $url = RUTAWS.'inventarios/obtener_maxidinventarios.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        return $datos->{'inventarios'};
    }
    
//    function obtieneMaxIdCompras() {
//        # An HTTP GET request example
//        $url = RUTAWS.'compras/obtener_maxidcompras.php';
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $data = curl_exec($ch);
//        $datos = json_decode($data);
//        curl_close($ch);
//        return $datos->{'compras'};
//    }
    
    function busquedaProductoInventario() {
        $query = "";
        //Obtiene producto por id
        # An HTTP GET request example
        $url = RUTAWS.'inventarios/obtener_inventarios_like_codigo.php?query='.$query;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        if ($datos->{'estado'}==1) {
            $data = array('inventarios'=>$datos->{'inventarios'});
        }        
    }
    
//    function index(){
//        $this->load->view('login_view');
//    }
//    
//    function buscaProducto() {
//        $data = array();
//        foreach ($this->inventarioGlobal as $key => $value) 
//        {
////            $data[] = array('id' => $value->codigo, 'name' => $value->descripcion);
//            $data[] = array('id' => $value->codigo, 'name' => $value->codigo.' '.$value->descripcion);
//        }
//        echo json_encode($data);
//    }
//    
//    function refrescaDatosProveedores() {
//        $this->proveedoresGlobal = $this->cargaDatosProveedores();
//        $data2 = array();
//        foreach ($this->proveedoresGlobal as $key => $value) {
//            $data2[] = array('id' => $value->idProveedor, 'name' => $value->idProveedor.' '.$value->apellidos.' '.$value->nombre);
//        }
//        //printf("%s",$data2);
//        echo json_encode($data2);
//    }
//    
//    function buscaProveedor() {
//        //echo "<script language='javascript'>alert('aaa');</script>";
//        //refrescaDatosProveedores();
//        //$this->proveedoresGlobal = $this->cargaDatosProveedores();
//        $data2 = array();
//        foreach ($this->proveedoresGlobal as $key => $value) {
//            $data2[] = array('id' => $value->idProveedor, 'name' => $value->idProveedor.' '.$value->apellidos.' '.$value->nombre);
//        }
//        //printf("%s",$data2);
//        echo json_encode($data2);
//        //unset($data2);
//    }
//    
//    function compraEnBlanco() {
//        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
//        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
//        
//        // Obtiene el idUsuario sesionado
//        $idUsuarioActual = $this->session->userdata('idUsuario');
//        // Fin Obtiene el idUsuario sesionado
//        
//        //Obtiene el no de venta que le corresponde a la venta actual
//        $maxIdReg = $this->obtieneMaxIdCompras();
//        $maxId = 0;
//        $maxId = $maxIdReg[0]->{'idCompra'};        
//        $maxId++;        
//        //Fin Obtiene el no de venta que le corresponde a la venta actual
//        
//        $data = array('idUsuario'=>$idUsuarioActual,'maxId'=>$maxId,'inventarios'=>$this->inventarioGlobal,
//            'proveedores'=>$this->proveedoresGlobal,
//            'categorias'=>$this->categoriasGlobal,
//            'sucursales'=>$this->sucursalesGlobal,
//            'usuarioDatos' => $this->session->userdata('nombre'),
//            'fecha' => $fechaIngreso,
//            'iva' => $this->ivaEmpresaGlobal,
//            'nombre_Empresa'=>$this->nombreEmpresaGlobal,
//            'permisos' => $this->session->userdata('permisos'),
//            'opcionClickeada' => '3',
//            'temporalVtaCompras' => $this->temporalVtaCompras
//            );
//        $this->load->view('layouts/header_view',$data);
//        $this->load->view('compras/compras_view',$data);
//        $this->load->view('layouts/pie_view',$data);
//    }
//    
//    function nuevoProveedorFromFormulario(){
//        //LLamadfo de WS
//        $empresa = $this->input->post("empresa");
//        $nombre = $this->input->post("nombre");
//        $apellidos = $this->input->post("apellidos");
//        $telefono_casa = $this->input->post("telefono_casa");
//        $telefono_celular = $this->input->post("telefono_celular");
//        $direccion1 = $this->input->post("direccion1");
//        $direccion2 = $this->input->post("direccion2");
//        $rfc = $this->input->post("rfc");
//        $email = $this->input->post("email");
//        $ciudad = $this->input->post("ciudad");
//        $estado = $this->input->post("estado");
//        $cp = $this->input->post("cp");
//        $pais = $this->input->post("pais");
//        $comentarios = $this->input->post("comentarios");
//        $noCuenta = $this->input->post("noCuenta");
//
//        $data = array("empresa" => $empresa, 
//            "nombre" => $nombre,
//            "apellidos" => $apellidos,
//            "telefono_casa" => $telefono_casa,
//            "telefono_celular" => $telefono_celular,
//            "direccion1" => $direccion1,
//            "direccion2" => $direccion2,
//            "rfc" => $rfc,
//            "email" => $email,
//            "ciudad" => $ciudad,
//            "estado" => $estado,
//            "cp" => $cp,
//            "pais" => $pais,
//            "comentarios" => $comentarios,
//            "noCuenta" => $noCuenta
//                );
//        $data_string = json_encode($data);
//        $ch = curl_init(RUTAWS.'proveedores/insertar_proveedor.php');
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json',
//            'Content-Length: ' . strlen($data_string))
//        );
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//        //execute post
//        $result = curl_exec($ch);
//        //close connection
//        curl_close($ch);
//        $this->proveedoresGlobal = $this->cargaDatosProveedores();
////        //respuesta web service
//        //echo json_encode(array('okdfds'=>'ok'));
//        //printf("felicidad");
//    }
//    
//    function nuevoCompraFromFormulario()
//    {
//        //echo "<script language='javascript'>alert('Estas en controler de guardao de ventas');</script>";
//        // Recibe Json
//        $obj = json_decode($_POST["myData"]);
//        // Fin Recibe Json
//        
//        //LLamado de WS de registro de venta tabla compras
//        $data_string = json_encode($obj);
//        $ch = curl_init(RUTAWS.'compras/insertar_compra.php');
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json',
//            'Content-Length: ' . strlen($data_string))
//        );
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//        //execute post
//        $result = curl_exec($ch);
//        //close connection
//        curl_close($ch);
//        //printf("%s",$result);
//        //Fin LLamado de WS de registro de venta tabla compras
//        
//        
//        //Registro de detalle de compra
//        
//        //aumenta cantidad comprada desde inventario
//        $idCompra = $obj->{'idCompra'}; // id de enlace con compras
//        $idUsuario = $obj->{'idUsuario'}; // id de enlace con usuarios
//        $tipoOperacion = $obj->{'tipoOperacion'}; // tipo de operacion 1.-compra 2.- Regreso
//        $tipoOperacionTexto = "";
//        $factor = 1; //si es venta 1 si es regreso
//        if ($tipoOperacion==1) {
//            $tipoOperacionTexto = "Compra";
//        } else {
//            $tipoOperacionTexto = "Regreso";
//            $factor = -1;
//        }
//        $bandInicio = TRUE;
//        $cantidad = 0;
//        $fechaOperacion = $obj->{'fecha'}; // fecha de operacion
//        $existencuaInventario = 0;
//            // Ciclo que barre todo el json de detalle compra
//        foreach ($obj->detalleTemporal as $fila) {
//            //esto lo hago porque el primer articulo viene en ceros con idarticulo -1
//            if ($bandInicio) {
//                $bandInicio = FALSE;
//            } else {
//                $idArticulo = $fila->{'idArticulo'};
//                $precio = $fila->{'precio'};
//                $cantidad = $fila->{'cantidad'};
//                $descuento = $fila->{'descuento'};
//                //Arma nuevo json solo con el detalle actual y datos necesarios
//                $dataDetalleCompra = array("idCompra" => $idCompra, 
//                    "idArticulo" => $idArticulo, 
//                    "precio" => $precio, 
//                    "cantidad" => $cantidad, 
//                    "descuento" => $descuento
//                        );
//                $data_string = json_encode($dataDetalleCompra);  
//                unset($dataDetalleCompra);
//                //Fin Arma nuevo json solo con el detalle actual y datos necesarios
//
//                //LLamado de WS de registro de detalle de compra tabla detallecompras
//                $ch = curl_init(RUTAWS.'detallecompras/insertar_detallecompra.php');
//                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                    'Content-Type: application/json',
//                    'Content-Length: ' . strlen($data_string))
//                );
//                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//                //execute post
//                $result = curl_exec($ch);
//                //close connection
//                //printf("%s",$result);
//                curl_close($ch);
//                //Fin llaamado de WS de registro de detalle de venta tabla detallecompras
//                
//                //Arma nuevo json solo con el detalle actual y datos necesarios
//                $cantidad = $fila->{'cantidad'} * $factor;
//                $dataMovimiento = array(
//                    "idArticulo" => $idArticulo, 
//                    "idUsuario" => $idUsuario, 
//                    "tipoOperacion" => $tipoOperacionTexto,
//                    "cantidad" => $cantidad, 
//                    "fechaOperacion" => $fechaOperacion
//                        );
//                $data_string = json_encode($dataMovimiento);  
//                unset($dataDetalleCompra);
//                //Fin Arma nuevo json solo con el detalle actual y datos necesarios
//                //LLamado de WS de registro de movimientos tabla movimientos
//                $ch = curl_init(RUTAWS.'movimientos/insertar_movimiento.php');
//                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                    'Content-Type: application/json',
//                    'Content-Length: ' . strlen($data_string))
//                );
//                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//                //execute post
//                $result = curl_exec($ch);
//                //close connection
//                //printf("%s",$result);
//                curl_close($ch);
//                //LLamado de WS de registro de movimientos tabla movimientos
//
//                // Alteracion en el inventario segun el tipo de operacion
//                    //Obtiene producto por id
//                # An HTTP GET request example
//                $url = RUTAWS.'inventarios/obtener_inventario_por_id.php?idArticulo='.$idArticulo;
//                $ch = curl_init($url);
//                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                $data = curl_exec($ch);
//                $datosProd = json_decode($data);
//                curl_close($ch);
//                if ($datosProd->{'estado'}==1) {
//                    $existencuaInventario = $datosProd->{'inventario'}->{'existencia'};
//                } else {
//                    echo "Ajusta el inventario manualmente, error al consultar producto";
//                }
//                // se realiza ajuste de inventario
//                $existencuaInventario = $existencuaInventario + $cantidad;
//                $datosProd->{'inventario'}->{'existencia'} = $existencuaInventario;
//                $datosProd->{'inventario'}->{'precioCosto'} = $precio;
//                $datosProd->{'inventario'}->{'porcentajeImpuesto'} = $descuento;
//                $datosProd->{'inventario'}->{'precioUnitario'} = $precio + ($precio * 
//                        ($descuento / 100));
//                $precioUnitario = $precio + ($precio * 
//                        ($descuento / 100));
//                $data = array("idArticulo" => $idArticulo,
//                    "existencia" => $existencuaInventario,
//                    "precioCosto" => $precio,
//                    "porcentajeImpuesto" => $descuento,
//                    "precioUnitario" => $precioUnitario
//                        );
//                $data_string = json_encode($data);
//                $ch = curl_init(RUTAWS.'inventarios/ajusta_inventarioFromCompras.php');
//                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                    'Content-Type: application/json',
//                    'Content-Length: ' . strlen($data_string))
//                );
//                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//                //execute post
//                $result = curl_exec($ch);
//                //close connection
//                curl_close($ch);
//                    // fin se realiza ajuste de inventario
//                // Fin Alteracion en el inventario segun el tipo de operacion
//
//                //Fin de Registro de detalle de compra
//            }
//        }
//            // Fin Ciclo que barre todo el json de detalle venta
//        echo "Compra Registrada";
//             
//            
//        //redirect('/ventas_controller/ventaEnBlanco');
//    }
//    
//    function borraCompraTemporal() {
//        //borra datos anteriores de temporalVtaCompra
//        $data = array("idUsuario" => 0);
//        $data_string = json_encode($data);
//        $ch = curl_init(RUTAWS.'compras/borrar_compratemporal.php');
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json',
//            'Content-Length: ' . strlen($data_string))
//        );
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//        //execute post
//        $result = curl_exec($ch);
//        //close connection
//        curl_close($ch);
//        //echo $result;
//        //Fin borra datos anteriores de temporalVtaCompra
//    }
//
//    function guardaCompraTemporal()
//    {
//        $this->borraCompraTemporal();
//        // Recibe Json
//        $obj = json_decode($_POST["myData"]);
//        // Fin Recibe Json
//        
//        //Registro de detalle de compra
//        $bandInicio = TRUE;
//            // Ciclo que barre todo el json de detalle compra
//        foreach ($obj->detalleTemporal as $fila) {
//            //esto lo hago porque el primer articulo viene en ceros con idarticulo -1
//            if ($bandInicio) {
//                $bandInicio = FALSE;
//            } else {
//                $idArticulo = $fila->{'idArticulo'};
//                $codigo = $fila->{'codigo'};
//                $precio = $fila->{'precio'};
//                $cantidad = $fila->{'cantidad'};
//                $descuento = $fila->{'descuento'};
//                $total = $precio * $cantidad;
//                $totalF = $total - ($total * ($descuento/100));
//                //Arma nuevo json solo con el detalle actual y datos necesarios
//                $dataDetalleCompra = array("idCompra" => $idCompra, 
//                    "idArticulo" => $idArticulo, 
//                    "codigo" => $codigo,
//                    "precio" => $precio, 
//                    "cantidad" => $cantidad, 
//                    "descuento" => $descuento,
//                    "total" => $totalF
//                        );
//                $data_string = json_encode($dataDetalleCompra);  
//                unset($dataDetalleCompra);
//                //Fin Arma nuevo json solo con el detalle actual y datos necesarios
//
//                //LLamado de WS de registro de detalle de compra tabla detallecompras
//                $ch = curl_init(RUTAWS.'compras/guardatemporalvtacompra.php');
//                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                    'Content-Type: application/json',
//                    'Content-Length: ' . strlen($data_string))
//                );
//                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//                //execute post
//                $result = curl_exec($ch);
//                //close connection
//                //printf("%s",$result);
//                curl_close($ch);
//                //Fin llamado de WS de registro de detalle de venta tabla detallecompras
////                //Fin de Registro de detalle de compra
//            }
//        }
//            // Fin Ciclo que barre todo el json de detalle compra
//    }
//    
//    function obtieneDatosTemporalVtaCompra() {
//        # An HTTP GET request example
//        $url = RUTAWS.'compras/obtener_temporalvtacompra.php';
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $data = curl_exec($ch);
//        $datos = json_decode($data);
////        printf("%d",$datos->{'estado'});
//        curl_close($ch);
//        if ($datos->{'estado'}==2) {
//            return null;            
//        }
//        return $datos->{'temporalVtaCompras'};
//    }
//    
//    function nuevoInventarioFromFormulario()
//    {
//        $obj = json_decode($_POST["myData"]);
//        
//        $codigo = $obj->{'codigoInv'};
//        $descripcion = $obj->{'descripcionInv'};
//        $porcentajeImpuesto = $obj->{'porcentajeImpuestoInv'};
//        $precioCosto = $obj->{'precioCostoInv'};
//        $precioUnitario = $obj->{'precioUnitarioInv'};
//        $existencia = $obj->{'existenciaInv'};
//        $existenciaMinima = $obj->{'existenciaMinimaInv'};
//        $ubicacion = $obj->{'ubicacionInv'};
//        $fechaIngreso = $obj->{'fechaIngresoInv'};
//
//        //por si no se selecciona fecha
//        if ($fechaIngreso=="") {
//            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
//            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
//        }
//        //Fin por si no se selecciona fecha
//
//        $proveedor = $obj->{'proveedorInv'};
//        $categoria = $obj->{'categoriaInv'};
//        $sucursal = $obj->{'sucursalInv'};
////        $nombre_img = $_FILES['imagen']['name'];
//
//        //obtiene maxId de inventario
//        $maxIdReg = $this->obtieneMaxIdInventario();
//        $maxId = 0;
//        $maxId = $maxIdReg[0]->{'idArticulo'};
//        //fin obtiene maxId de inventario
//
////        $tipo = //$_FILES['imagen']['type'];
////        $tamano = $_FILES['imagen']['size'];
////        //Si existe imagen y tiene un tamaño correcto
////        if ($_FILES['imagen']['name']!="") {
////            if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 50000)) {
////               //indicamos los formatos que permitimos subir a nuestro servidor
////               if (($_FILES["imagen"]["type"] == "image/jpeg")
////               || ($_FILES["imagen"]["type"] == "image/jpg")
////               || ($_FILES["imagen"]["type"] == "image/png"))
////               {
////                  // Ruta donde se guardarán las imágenes que subamos
////                  //$directorio = base_url().'fotos/inventario/';
//                  $directorio = $_SERVER['DOCUMENT_ROOT'] . 'matservices/fotos/inventario/';
////                  //Cambio el onombre de la imagen por producto mas id que corresponde
////                  if ($tipo=="image/png") {
//                      $nombre_img = "producto".($maxId + 1).".png";
////                  }
////                  if ($tipo=="image/jpeg") {
////                      $nombre_img = "producto".($maxId + 1).".jpeg";
////                  }
////                  if ($tipo=="image/jpg") {
////                      $nombre_img = "producto".($maxId + 1).".jpg";
////                  }
////                  // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
////                  move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
////                } else {
////                   //si no cumple con el formato
////                   echo "No se puede subir una imagen con ese formato ";
////                   return;
////                }
////            } else {
////               //si existe la variable pero se pasa del tamaño permitido
////               if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
////            }
////        } else {
//            $nombre_img = "producto0.png";
////        }
////        //fin falta archivo imagen
//        $observaciones = $obj->{'observacionesInv'};
//
//        $data = array("codigo" => $codigo, 
//            "descripcion" => $descripcion, 
//            "precioCosto" => $precioCosto, 
//            "precioUnitario" => $precioUnitario, 
//            "porcentajeImpuesto" => $porcentajeImpuesto, 
//            "existencia" => $existencia, 
//            "existenciaMinima" => $existenciaMinima, 
//            "ubicacion" => $ubicacion, 
//            "fechaIngreso" => $fechaIngreso,
//            "proveedor" => $proveedor,
//            "categoria" => $categoria,
//            "sucursal" => $sucursal,
//            "observaciones" => $observaciones,
//            "nombre_img" => $nombre_img
//                );
//        $data_string = json_encode($data);
//        $ch = curl_init(RUTAWS.'inventarios/insertar_inventario.php');
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json',
//            'Content-Length: ' . strlen($data_string))
//        );
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//        //execute post
//        $result = curl_exec($ch);
//        //close connection
//        curl_close($ch);
//        //printf("%s",$result);
//        //Fin llamado WS
//    }
    
    function inicioConsultas() {
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        
        // Obtiene el idUsuario sesionado
        $idUsuarioActual = $this->session->userdata('idUsuario');
        // Fin Obtiene el idUsuario sesionado
        
        $data = array('idUsuario'=>$idUsuarioActual,'inventarios'=>$this->inventarioGlobal,
            'proveedores'=>$this->proveedoresGlobal,
            'categorias'=>$this->categoriasGlobal,
            'sucursales'=>$this->sucursalesGlobal,
            'usuarioDatos' => $this->session->userdata('nombre'),
            'fecha' => $fechaIngreso,
            'iva' => $this->ivaEmpresaGlobal,
            'nombre_Empresa'=>$this->nombreEmpresaGlobal,
            'permisos' => $this->session->userdata('permisos'),
            'opcionClickeada' => '4'
            );
        $this->load->view('layouts/header_view',$data);
        $this->load->view('consultas/adminConsultas_view',$data);
        $this->load->view('layouts/pie_view',$data);
    }
    
    // Manejo de sesiones
    function cerrarSesion() {            
        if ($this->sistema_model->logout()) {
            $data = array('error'=>'1');
            redirect($this->index(),$data);
        }
    }
    
    //Fin Manejo de sesiones
    
 }

