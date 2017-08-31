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
    private $movimientosGlobal;
    private $vtasGralGlobal;
    private $comprasGralGlobal;
    private $pedidoGlobal;
    
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
        $this->movimientosGlobal = $this->cargaDatosMovimientos();
        $this->vtasGralGlobal = $this->cargaDatosVtasGralGlobal();
        $this->comprasGralGlobal = $this->cargaDatosComprasGralGlobal();
        $this->pedidoGlobal = $this->cargaDatosPedidosGralGlobal();
    }
    
    function cargaDatosPedidosGralGlobal() {
        //muestra valores de categorias
        # An HTTP GET request example
        $url = RUTAWS.'ventas/obtener_pedidos.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        //print_r($data);
        curl_close($ch);
        $pedidos;
        $i=0;
        //Fin muestra valores de categorias
        return $datos->{'pedidos'};
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

    function cargaDatosMovimientos() {
        //muestra valores de categorias
        # An HTTP GET request example
        $url = RUTAWS.'movimientos/obtener_movimientos.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        $movimientos;
        $i=0;
        //Fin muestra valores de categorias
        return $datos->{'movimientos'};
    }
    
    function cargaDatosVtasGralGlobal() {
        //muestra valores de categorias
        # An HTTP GET request example
        $url = RUTAWS.'ventas/obtener_ventas.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        $ventas;
        $i=0;
        //Fin muestra valores de categorias
        return $datos->{'ventas'};
    }

    function cargaDatosComprasGralGlobal() {
        //muestra valores de categorias
        # An HTTP GET request example
        $url = RUTAWS.'compras/obtener_compras.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        $compras;
        $i=0;
        //Fin muestra valores de categorias
        return $datos->{'compras'};
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
    
    function inicioConsultas() {
        if ($this->is_logged_in()){
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
                'opcionClickeada' => '4',
                'eleccion' => 0
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('consultas/adminConsultas_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function movInventario() {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 

            // Obtiene el idUsuario sesionado
            $idUsuarioActual = $this->session->userdata('idUsuario');
            // Fin Obtiene el idUsuario sesionado

            $data = array('idUsuario'=>$idUsuarioActual,'inventarios'=>$this->inventarioGlobal,
                'proveedores'=>$this->proveedoresGlobal,
                'movimientos'=>$this->movimientosGlobal,
                'vtasGral'=>NULL,
                'categorias'=>$this->categoriasGlobal,
                'sucursales'=>$this->sucursalesGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'iva' => $this->ivaEmpresaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '4',
                'eleccion' => 1
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('consultas/adminConsultas_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function vtasGral() {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 

            // Obtiene el idUsuario sesionado
            $idUsuarioActual = $this->session->userdata('idUsuario');
            // Fin Obtiene el idUsuario sesionado

            $data = array('idUsuario'=>$idUsuarioActual,'inventarios'=>$this->inventarioGlobal,
                'proveedores'=>$this->proveedoresGlobal,
                'movimientos'=>NULL,
                'vtasGral'=>$this->vtasGralGlobal,
                'categorias'=>$this->categoriasGlobal,
                'sucursales'=>$this->sucursalesGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'iva' => $this->ivaEmpresaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '4',
                'eleccion' => 2
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('consultas/adminConsultas_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function consultaDetalle($idVenta) {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 

            // Obtiene el idUsuario sesionado
            $idUsuarioActual = $this->session->userdata('idUsuario');
            // Fin Obtiene el idUsuario sesionado

            # An HTTP GET request example
            $url = RUTAWS.'detalleventas/obtener_detalleventa_por_id.php?idVenta='.$idVenta;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            curl_close($ch);
            $ventas;
            //Fin muestra valores de categorias

            $data = array('detalleVenta'=>$datos->{'detalleVentas'}, 
                'idUsuario'=>$idUsuarioActual,'inventarios'=>$this->inventarioGlobal,
                'proveedores'=>$this->proveedoresGlobal,
                'movimientos'=>NULL,
                'vtasGral'=>$this->vtasGralGlobal,
                'categorias'=>$this->categoriasGlobal,
                'sucursales'=>$this->sucursalesGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'iva' => $this->ivaEmpresaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '4',
                'eleccion' => 3
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('consultas/adminConsultas_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function consultaVentasPorFechas() {
        if ($this->is_logged_in()){
            //echo "azul".$this->input->post('fIni')."azul".$this->input->post('fFin');
            $fIni;
            $fFin;
            if (($this->input->post('fIni') == "") || ($this->input->post('fFin') == "")) {
                $fIni = $this->input->post('fIni2');
                $fFin = $this->input->post('fFin2');
            } else {
                $fIni = $this->input->post('fIni');
                $fFin = $this->input->post('fFin');
            }
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 

            // Obtiene el idUsuario sesionado
            $idUsuarioActual = $this->session->userdata('idUsuario');
            // Fin Obtiene el idUsuario sesionado

            # An HTTP GET request example
            $url = RUTAWS.'ventas/obtener_venta_por_fechas.php?fIni='.$fIni.'&fFin='.$fFin;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
    //        printf("%s",$data);
            $datos = json_decode($data);
            curl_close($ch);
            $ventas;
            $data = array('ventasPorFecha'=>$datos->{'ventas'}, 
                'idUsuario'=>$idUsuarioActual,'inventarios'=>$this->inventarioGlobal,
                'proveedores'=>$this->proveedoresGlobal,
                'movimientos'=>NULL,
                'vtasGral'=>NULL,
                'categorias'=>$this->categoriasGlobal,
                'sucursales'=>$this->sucursalesGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'iva' => $this->ivaEmpresaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '4',
                'eleccion' => 4
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('consultas/adminConsultas_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function comprasGral() {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 

            // Obtiene el idUsuario sesionado
            $idUsuarioActual = $this->session->userdata('idUsuario');
            // Fin Obtiene el idUsuario sesionado

            $data = array('idUsuario'=>$idUsuarioActual,'inventarios'=>$this->inventarioGlobal,
                'proveedores'=>$this->proveedoresGlobal,
                'movimientos'=>NULL,
                'comprasGral'=>$this->comprasGralGlobal,
                'categorias'=>$this->categoriasGlobal,
                'sucursales'=>$this->sucursalesGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'iva' => $this->ivaEmpresaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '4',
                'eleccion' => 5
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('consultas/adminConsultas_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function consultaDetalleCompra($idCompra) {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 

            // Obtiene el idUsuario sesionado
            $idUsuarioActual = $this->session->userdata('idUsuario');
            // Fin Obtiene el idUsuario sesionado

            # An HTTP GET request example
            $url = RUTAWS.'detallecompras/obtener_detallecompra_por_id.php?idCompra='.$idCompra;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
    //        printf("%s",$data);
            curl_close($ch);
            $compras;
            $data = array('detalleCompra'=>$datos->{'detalleCompras'}, 
                'detalleVenta'=>NULL,
                'idUsuario'=>$idUsuarioActual,'inventarios'=>$this->inventarioGlobal,
                'proveedores'=>$this->proveedoresGlobal,
                'movimientos'=>NULL,
                'vtasGral'=>$this->vtasGralGlobal,
                'categorias'=>$this->categoriasGlobal,
                'sucursales'=>$this->sucursalesGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'iva' => $this->ivaEmpresaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '4',
                'eleccion' => 6
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('consultas/adminConsultas_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function consultaComprasPorFechas() {
        if ($this->is_logged_in()){
            $fIni;
            $fFin;
            if (($this->input->post('fIniC') == "") || ($this->input->post('fFinC') == "")) {
                $fIni = $this->input->post('fIniC2');
                $fFin = $this->input->post('fFinC2');
            } else {
                $fIni = $this->input->post('fIniC');
                $fFin = $this->input->post('fFinC');
            }
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 

            // Obtiene el idUsuario sesionado
            $idUsuarioActual = $this->session->userdata('idUsuario');
            // Fin Obtiene el idUsuario sesionado

            # An HTTP GET request example
            $url = RUTAWS.'compras/obtener_compra_por_fechas.php?fIni='.$fIni.'&fFin='.$fFin;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
    //        printf("%s",$data);
            $datos = json_decode($data);
            curl_close($ch);
            $compras;
            $data = array('comprasPorFecha'=>$datos->{'compras'}, 
                'idUsuario'=>$idUsuarioActual,'inventarios'=>$this->inventarioGlobal,
                'proveedores'=>$this->proveedoresGlobal,
                'movimientos'=>NULL,
                'vtasGral'=>NULL,
                'categorias'=>$this->categoriasGlobal,
                'sucursales'=>$this->sucursalesGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'iva' => $this->ivaEmpresaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '4',
                'eleccion' => 7
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('consultas/adminConsultas_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function consultaPedidos() {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 

            // Obtiene el idUsuario sesionado
            $idUsuarioActual = $this->session->userdata('idUsuario');
            // Fin Obtiene el idUsuario sesionado

            $data = array('idUsuario'=>$idUsuarioActual,'inventarios'=>$this->inventarioGlobal,
                'pedidos'=>$this->pedidoGlobal,
                'proveedores'=>$this->proveedoresGlobal,
                'movimientos'=>NULL,
                'ventasPorFecha'=>NULL,
                'vtasGral'=>$this->vtasGralGlobal,
                'categorias'=>$this->categoriasGlobal,
                'sucursales'=>$this->sucursalesGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'iva' => $this->ivaEmpresaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '4',
                'eleccion' => 8
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('consultas/adminConsultas_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function consultaDetallePedidos($idPedido) {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 

            // Obtiene el idUsuario sesionado
            $idUsuarioActual = $this->session->userdata('idUsuario');
            // Fin Obtiene el idUsuario sesionado

            # An HTTP GET request example
            $url = RUTAWS.'ventas/obtener_detallepedido_por_id.php?idPedido='.$idPedido;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
//            print_r($data);
            curl_close($ch);
            //Fin muestra valores de categorias

            $data = array('detallePedido'=>$datos->{'detallePedidos'}, 
                'idUsuario'=>$idUsuarioActual,'inventarios'=>$this->inventarioGlobal,
                'proveedores'=>$this->proveedoresGlobal,
                'movimientos'=>NULL,
                'vtasGral'=>$this->vtasGralGlobal,
                'categorias'=>$this->categoriasGlobal,
                'sucursales'=>$this->sucursalesGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'iva' => $this->ivaEmpresaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '4',
                'eleccion' => 9
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('consultas/adminConsultas_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    //**  Manejo de Sesiones
    function cerrarSesion() {
        $this->session->set_userdata('logueado',FALSE);
        $this->session->sess_destroy();
        $this->load->view('login_view');
    }

    function is_logged_in() {
        return $this->session->userdata('logueado');
    }
    //**  Fin Manejo de Sesiones
 }

