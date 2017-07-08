<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ventas_controller extends CI_Controller {
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
        $url2 = 'http://localhost/matserviceswsok/matservsthread1/datosempresa/obtener_datosempresas.php';
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
        $url2 = 'http://localhost/matserviceswsok/matservsthread1/sistema/obtener_sistemas.php';
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
        $url = 'http://localhost/matserviceswsok/matservsthread1/proveedores/obtener_proveedores.php';
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
        $url = 'http://localhost/matserviceswsok/matservsthread1/categorias/obtener_categorias.php';
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
        $url = 'http://localhost/matserviceswsok/matservsthread1/sucursales/obtener_sucursales.php';
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
        $url = 'http://localhost/matserviceswsok/matservsthread1/inventarios/obtener_inventarios.php';
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
        $url = 'http://localhost/matserviceswsok/matservsthread1/clientes/obtener_clientes.php';
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
        $url = 'http://localhost/matserviceswsok/matservsthread1/inventarios/obtener_maxidinventarios.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        return $datos->{'inventarios'};
    }
    
    function obtieneMaxIdVentas() {
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/ventas/obtener_maxidventas.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        return $datos->{'ventas'};
    }
    
    function busquedaProductoInventario() {
        $query = "";
        //Obtiene producto por id
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/inventarios/obtener_inventarios_like_codigo.php?query='.$query;
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
    
    function index(){
        $this->load->view('login_view');
    }
    
    function buscaProducto() {
        $data = array();
        foreach ($this->inventarioGlobal as $key => $value) 
        {
//            $data[] = array('id' => $value->codigo, 'name' => $value->descripcion);
            $data[] = array('id' => $value->codigo, 'name' => $value->codigo.' '.$value->descripcion);
        }
        echo json_encode($data);
    }
    
    function buscaCliente() {
        $data2 = array();
        foreach ($this->clientesGlobal as $key => $value) {
            $data2[] = array('id' => $value->idCliente, 'name' => $value->idCliente.' '.$value->apellidos.' '.$value->nombre);
        }
        echo json_encode($data2);
    }
    
    function ventaEnBlanco() {
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        
        // Obtiene el idUsuario sesionado
        $idUsuarioActual = $this->session->userdata('idUsuario');
        // Fin Obtiene el idUsuario sesionado
        
        //Obtiene el no de venta que le corresponde a la venta actual
        $maxIdReg = $this->obtieneMaxIdVentas();
        $maxId = 0;
        $maxId = $maxIdReg[0]->{'idVenta'};        
        $maxId++;        
        //Fin Obtiene el no de venta que le corresponde a la venta actual
        
        $data = array('idUsuario'=>$idUsuarioActual,'maxId'=>$maxId,'inventarios'=>$this->inventarioGlobal,
            'usuarioDatos' => $this->session->userdata('nombre'),
            'fecha' => $fechaIngreso,
            'iva' => $this->ivaEmpresaGlobal,
            'nombre_Empresa'=>$this->nombreEmpresaGlobal,
            'permisos' => $this->session->userdata('permisos'),
            'opcionClickeada' => '2'
            );
        $this->load->view('layouts/header_view',$data);
        $this->load->view('ventas/ventas_view',$data);
        $this->load->view('layouts/pie_view',$data);
    }
    
    function nuevoClienteFromFormulario(){
        //LLamadfo de WS
        $empresa = $this->input->post("empresa");
        $nombre = $this->input->post("nombre");
        $apellidos = $this->input->post("apellidos");
        $telefono_casa = $this->input->post("telefono_casa");
        $telefono_celular = $this->input->post("telefono_celular");
        $direccion1 = $this->input->post("direccion1");
        $direccion2 = $this->input->post("direccion2");
        $rfc = $this->input->post("rfc");
        $email = $this->input->post("email");
        $ciudad = $this->input->post("ciudad");
        $estado = $this->input->post("estado");
        $cp = $this->input->post("cp");
        $pais = $this->input->post("pais");
        $comentarios = $this->input->post("comentarios");
        $noCuenta = $this->input->post("noCuenta");

        $data = array("empresa" => $empresa, 
            "nombre" => $nombre,
            "apellidos" => $apellidos,
            "telefono_casa" => $telefono_casa,
            "telefono_celular" => $telefono_celular,
            "direccion1" => $direccion1,
            "direccion2" => $direccion2,
            "rfc" => $rfc,
            "email" => $email,
            "ciudad" => $ciudad,
            "estado" => $estado,
            "cp" => $cp,
            "pais" => $pais,
            "comentarios" => $comentarios,
            "noCuenta" => $noCuenta
                );
        $data_string = json_encode($data);
        $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/clientes/insertar_cliente.php');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        //respuesta web service
        echo json_encode(array('okdfds'=>'ok'));
    }
    
    function nuevoVentaFromFormulario()
    {
        //echo "<script language='javascript'>alert('Estas en controler de guardao de ventas');</script>";
        // Recibe Json
        $obj = json_decode($_POST["myData"]);
        // Fin Recibe Json
        
        //LLamado de WS de registro de venta tabla ventas
        $data_string = json_encode($obj);
        $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/ventas/insertar_venta.php');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        //printf("%s",$result);
        //Fin LLamado de WS de registro de venta tabla ventas
        
        
        //Registro de detalle de venta
        
        //descuenta cantidad vendida desde inventario
        $idVenta = $obj->{'ticketVenta'}; // id de enlace con ventas
        $idUsuario = $obj->{'idUsuario'}; // id de enlace con usuarios
        $tipoOperacion = $obj->{'tipoOperacion'}; // tipo de operacion 1.-venta 2.- Regreso
        $tipoOperacionTexto = "";
        $factor = -1; //si es venta 1 si es regreso
        if ($tipoOperacion==1) {
            $tipoOperacionTexto = "Venta";
        } else {
            $tipoOperacionTexto = "Regreso";
            $factor = 1;
        }
        $bandInicio = TRUE;
        $cantidad = 0;
        $fechaOperacion = $obj->{'fecha'}; // fecha de operacion
        $existencuaInventario = 0;
            // Ciclo que barre todo el json de detalle venta
        foreach ($obj->detalleTemporal as $fila) {
            //esto lo hago porque el primer articulo viene en ceros con idarticulo -1
            if ($bandInicio) {
                $bandInicio = FALSE;
            } else {
                $idArticulo = $fila->{'idArticulo'};
                $precio = $fila->{'precio'};
                $cantidad = $fila->{'cantidad'};
                $descuento = $fila->{'descuento'};
                //Arma nuevo json solo con el detalle actual y datos necesarios
                $dataDetalleVenta = array("idVenta" => $idVenta, 
                    "idArticulo" => $idArticulo, 
                    "precio" => $precio, 
                    "cantidad" => $cantidad, 
                    "descuento" => $descuento
                        );
                $data_string = json_encode($dataDetalleVenta);  
                unset($dataDetalleVenta);
                //Fin Arma nuevo json solo con el detalle actual y datos necesarios

                //LLamado de WS de registro de detalle de venta tabla detalleventas
                $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/detalleventas/insertar_detalleventa.php');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
                );
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                //execute post
                $result = curl_exec($ch);
                //close connection
                //printf("%s",$result);
                curl_close($ch);
                //Fin llaamado de WS de registro de detalle de venta tabla detalleventas
                
                //Arma nuevo json solo con el detalle actual y datos necesarios
                $cantidad = $fila->{'cantidad'} * $factor;
                $dataMovimiento = array(
                    "idArticulo" => $idArticulo, 
                    "idUsuario" => $idUsuario, 
                    "tipoOperacion" => $tipoOperacionTexto,
                    "cantidad" => $cantidad, 
                    "fechaOperacion" => $fechaOperacion
                        );
                $data_string = json_encode($dataMovimiento);  
                unset($dataDetalleVenta);
                //Fin Arma nuevo json solo con el detalle actual y datos necesarios
                //LLamado de WS de registro de movimientos tabla movimientos
                $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/movimientos/insertar_movimiento.php');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
                );
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                //execute post
                $result = curl_exec($ch);
                //close connection
                //printf("%s",$result);
                curl_close($ch);
                //LLamado de WS de registro de movimientos tabla movimientos

                // Alteracion en el inventario segun el tipo de operacion
                    //Obtiene producto por id
                # An HTTP GET request example
                $url = 'http://localhost/matserviceswsok/matservsthread1/inventarios/obtener_inventario_por_id.php?idArticulo='.$idArticulo;
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $data = curl_exec($ch);
                $datosProd = json_decode($data);
                curl_close($ch);
                if ($datosProd->{'estado'}==1) {
                    $existencuaInventario = $datosProd->{'inventario'}->{'existencia'};
                } else {
                    echo "Ajusta el inventario manualmente, error al consultar producto";
                }
                // se realiza ajuste de inventario
                $existencuaInventario = $existencuaInventario + $cantidad;
                $datosProd->{'inventario'}->{'existencia'} = $existencuaInventario;
                $data = array("idArticulo" => $idArticulo,
                    "existencia" => $existencuaInventario
                        );
                $data_string = json_encode($data);
                $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/inventarios/ajusta_inventario.php');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
                );
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                //execute post
                $result = curl_exec($ch);
                //close connection
                curl_close($ch);
                    // fin se realiza ajuste de inventario
                // Fin Alteracion en el inventario segun el tipo de operacion

                //Fin de Registro de detalle de venta
            }
        }
            // Fin Ciclo que barre todo el json de detalle venta
        echo "Venta Registrada";
             
            
        //redirect('/ventas_controller/ventaEnBlanco');
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

