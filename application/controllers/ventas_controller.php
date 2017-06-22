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
            $data2[] = array('name' => $value->nombre.' '.$value->apellidos);
        }
        echo json_encode($data2);
    }
    
    function ventaEnBlanco() {
        $data = array('inventarios'=>$this->inventarioGlobal,
            'iva' => $this->ivaEmpresaGlobal,
            'nombre_Empresa'=>$this->nombreEmpresaGlobal,
            'permisos' => $this->session->userdata('permisos'));
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
    
    
        //obtiene maxId de inventario
//        $maxIdReg = $this->obtieneMaxIdInventario();
//        $maxId = $maxIdReg[0]->{'idArticulo'};
        //fin obtiene maxId de inventario
    
//    function mostrarInventarios() {
//        # An HTTP GET request example
//        $url = 'http://localhost/matserviceswsok/matservsthread1/inventarios/obtener_inventarios.php';
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $data = curl_exec($ch);
//        $datos = json_decode($data);
//        curl_close($ch);
//        $inventarios;
//        $i=0;
//        $data;
//        $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal);
//        if ($datos->{'estado'}==1) {
//            $data = array('inventarios'=>$datos->{'inventarios'},
//                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
//                'permisos' => $this->session->userdata('permisos'));
//            $this->load->view('layouts/header_view',$data);
//            $this->load->view('inventarios/adminInventarios_view',$data);
//            $this->load->view('layouts/pie_view',$data);
//        } else {
//            $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
//                'permisos' => $this->session->userdata('permisos'));
//            $this->load->view('layouts/header_view',$data);
//            $this->load->view('principal_view',$data);
//            $this->load->view('layouts/pie_view',$data);
//        }
//    }
//    
//    function actualizarInventario($idArticulo) {
//        //Obtiene producto por id
//        # An HTTP GET request example
//        $url = 'http://localhost/matserviceswsok/matservsthread1/inventarios/obtener_inventario_por_id.php?idArticulo='.$idArticulo;
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $data = curl_exec($ch);
//        $datos = json_decode($data);
//        curl_close($ch);
//        if ($datos->{'estado'}==1) {
//            $data = array('inventario'=>$datos->{'inventario'},
//                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
//                'proveedores' => $this->proveedoresGlobal,
//                'categorias' => $this->categoriasGlobal,
//                'sucursales' => $this->sucursalesGlobal,
//                'ivaEmpresa' => $this->ivaEmpresaGlobal,
//                'permisos' => $this->session->userdata('permisos'));
//            $this->load->view('layouts/header_view',$data);
//            $this->load->view('inventarios/actualizaInventario_view',$data);
//            $this->load->view('layouts/pie_view',$data);
//        } else {
//            echo "error";
//        }
//    }
//
//    function actualizarInventarioFromFormulario()
//    {
//        $idArticulo = $this->input->post("idArticulo");
//        $imagenAntH = $this->input->post("imagenAntH");
//        $codigo = $this->input->post("codigo");
//        $descripcion = $this->input->post("descripcion");
//        $precioCosto = $this->input->post("precioCosto");
//        $precioUnitario = $this->input->post("precioUnitario");
//        $porcentajeImpuesto = $this->input->post("porcentajeImpuesto");
//        $existencia = $this->input->post("existencia");
//        $existenciaMinima = $this->input->post("existenciaMinima");
//        $ubicacion = $this->input->post("ubicacion");
//        $fechaIngreso = $this->input->post("fechaIngreso");
//
//        //por si no se selecciona fecha
//        if ($fechaIngreso=="") {
//            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
//            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
//        }
//        //Fin por si no se selecciona fecha
//
//        $proveedor = $this->input->post("proveedor");
//        $categoria = $this->input->post("categoria");
//        $sucursal = $this->input->post("sucursal");
//        $nombre_img = $_FILES['imagen']['name'];
//
//        //Verifica si no hubo cambio de imagen y ent asigna la anterior
//        if ($_FILES['imagen']['name']!="") {
//            //fin verifica si hubo cambio de imagen
//            $tipo = $_FILES['imagen']['type'];
//            $tamano = $_FILES['imagen']['size'];
//            //Si existe imagen y tiene un tamaño correcto
//            if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 50000)) {
//               //indicamos los formatos que permitimos subir a nuestro servidor
//               if (($_FILES["imagen"]["type"] == "image/jpeg")
//               || ($_FILES["imagen"]["type"] == "image/jpg")
//               || ($_FILES["imagen"]["type"] == "image/png"))
//               {
//                  // Ruta donde se guardarán las imágenes que subamos
//                  //$directorio = base_url().'fotos/inventario/';
//                  $directorio = $_SERVER['DOCUMENT_ROOT'] . 'matservices/fotos/inventario/';
//                  //borra imagen anterior 
//                  unlink($directorio.$imagenAntH); 
//                  //Cambio el onombre de la imagen por producto mas id que corresponde
//                  if ($tipo=="image/png") {
//                      $nombre_img = "producto".$idArticulo.".png";
//                  }
//                  if ($tipo=="image/jpeg") {
//                      $nombre_img = "producto".$idArticulo.".jpeg";
//                  }
//                  if ($tipo=="image/jpg") {
//                      $nombre_img = "producto".$idArticulo.".jpg";
//                  }
//                  // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
//                  move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
//                } else {
//                   //si no cumple con el formato
//                   echo "No se puede subir una imagen con ese formato ";
//                   return;
//                }
//            } else {
//               //si existe la variable pero se pasa del tamaño permitido
//               if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
//            }
//        } 
////            else {
////                $nombre_img = $imagenAntH;
////            }
//        //fin falta archivo imagen
//        $observaciones = $this->input->post("observaciones");
//        $data = array("idArticulo" => $idArticulo,
//            "codigo" => $codigo, 
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
//        $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/inventarios/actualizar_inventario.php');
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
//        echo $result;
//
//        //Fin llamado WS
//        redirect('/inventarios_controller/mostrarInventarios');
//    }
//
//    function eliminarInventario($idArticulo,$fotoProducto) {
//          //borro imagen del articulo
//        unlink("./fotos/inventario"."/".$fotoProducto);
//        $data = array("idArticulo" => $idArticulo);
//        $data_string = json_encode($data);
//        $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/inventarios/borrar_inventario.php');
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
//
//        //Fin llamado WS
//        redirect('/inventarios_controller/mostrarInventarios');
//    }
//    
//    function nuevoInventario() {
//        $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
//            'proveedores' => $this->proveedoresGlobal,
//            'categorias' => $this->categoriasGlobal,
//            'sucursales' => $this->sucursalesGlobal,
//            'ivaEmpresa' => $this->ivaEmpresaGlobal,
//            'permisos' => $this->session->userdata('permisos'));
//        $this->load->view('layouts/header_view',$data);
//        $this->load->view('inventarios/nuevoInventario_view',$data);
//        $this->load->view('layouts/pie_view',$data);
//    }
//
//    function nuevoInventarioFromFormulario()
//    {
////        if ($this->input->post('submit')){
//            //LLamadfo de WS
//            $codigo = $this->input->post("codigo");
////        echo "-->".$codigo;
//            $descripcion = $this->input->post("descripcion");
//            $precioCosto = $this->input->post("precioCosto");
//            $precioUnitario = $this->input->post("precioUnitario");
//            $porcentajeImpuesto = $this->input->post("porcentajeImpuesto");
//            $existencia = $this->input->post("existencia");
//            $existenciaMinima = $this->input->post("existenciaMinima");
//            $ubicacion = $this->input->post("ubicacion");
//            $fechaIngreso = $this->input->post("fechaIngreso");
//            
//            //por si no se selecciona fecha
//            if ($fechaIngreso=="") {
//                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
//                $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
//            }
//            //Fin por si no se selecciona fecha
//            
//            $proveedor = $this->input->post("proveedor");
//            $categoria = $this->input->post("categoria");
//            $sucursal = $this->input->post("sucursal");
//            $nombre_img = $_FILES['imagen']['name'];
//            
//            //obtiene maxId de inventario
//            $maxIdReg = $this->obtieneMaxIdInventario();
//            $maxId = 0;
//            $maxId = $maxIdReg[0]->{'idArticulo'};
//            //fin obtiene maxId de inventario
//        
//            $tipo = $_FILES['imagen']['type'];
//            $tamano = $_FILES['imagen']['size'];
//            //Si existe imagen y tiene un tamaño correcto
//            if ($_FILES['imagen']['name']!="") {
//                if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 50000)) {
//                   //indicamos los formatos que permitimos subir a nuestro servidor
//                   if (($_FILES["imagen"]["type"] == "image/jpeg")
//                   || ($_FILES["imagen"]["type"] == "image/jpg")
//                   || ($_FILES["imagen"]["type"] == "image/png"))
//                   {
//                      // Ruta donde se guardarán las imágenes que subamos
//                      //$directorio = base_url().'fotos/inventario/';
//                      $directorio = $_SERVER['DOCUMENT_ROOT'] . 'matservices/fotos/inventario/';
//                      //Cambio el onombre de la imagen por producto mas id que corresponde
//                      if ($tipo=="image/png") {
//                          $nombre_img = "producto".($maxId + 1).".png";
//                      }
//                      if ($tipo=="image/jpeg") {
//                          $nombre_img = "producto".($maxId + 1).".jpeg";
//                      }
//                      if ($tipo=="image/jpg") {
//                          $nombre_img = "producto".($maxId + 1).".jpg";
//                      }
//                      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
//                      move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
//                    } else {
//                       //si no cumple con el formato
//                       echo "No se puede subir una imagen con ese formato ";
//                       return;
//                    }
//                } else {
//                   //si existe la variable pero se pasa del tamaño permitido
//                   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
//                }
//            } else {
//                $nombre_img = "producto0.png";
//            }
//            //fin falta archivo imagen
//            $observaciones = $this->input->post("observaciones");
//            $data = array("codigo" => $codigo, 
//                "descripcion" => $descripcion, 
//                "precioCosto" => $precioCosto, 
//                "precioUnitario" => $precioUnitario, 
//                "porcentajeImpuesto" => $porcentajeImpuesto, 
//                "existencia" => $existencia, 
//                "existenciaMinima" => $existenciaMinima, 
//                "ubicacion" => $ubicacion, 
//                "fechaIngreso" => $fechaIngreso,
//                "proveedor" => $proveedor,
//                "categoria" => $categoria,
//                "sucursal" => $sucursal,
//                "observaciones" => $observaciones,
//                "nombre_img" => $nombre_img
//                    );
//            $data_string = json_encode($data);
//            $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/inventarios/insertar_inventario.php');
//            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                'Content-Type: application/json',
//                'Content-Length: ' . strlen($data_string))
//            );
//            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//            //execute post
//            $result = curl_exec($ch);
//            //close connection
//            curl_close($ch);
//            echo $result;
//            //Fin llamado WS
//            redirect('/inventarios_controller/mostrarInventarios');
////        }
//    }
//    //Fin llamada a webservices de usuarios
//    
//    //Importar desde Excel con libreria de PHPExcel
//    public function importarInventariosExcel(){
//        $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
//            'permisos' => $this->session->userdata('permisos'));
//        $this->load->view('layouts/header_view',$data);
//        $this->load->view('inventarios/importarInventariosFromExcel_view',$data);
//        $this->load->view('layouts/pie_view',$data);
//    }        
//
//    //Importar desde Excel con libreria de PHPExcel
//    public function importarInventarioExcel(){
//        //Cargar PHPExcel library
//        $this->load->library('excel');
//        $name   = $_FILES['excel']['name'];
//        $tname  = $_FILES['excel']['tmp_name'];
//        $obj_excel = PHPExcel_IOFactory::load($tname);       
//        $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
//        $arr_datos = array();
//        foreach ($sheetData as $index => $value) {            
//            if ( $index != 1 ){
//                $arr_datos = array(
//                        'codigo' => $value['A'],
//                        'descripcion' => $value['B'],
//                        'precioCosto' => $value['C'],
//                        'precioUnitario' => $value['D'],
//                        'porcentajeImpuesto' => $value['E'],
//                        'existencia' => $value['F'],
//                        'existenciaMinima' => $value['G'],
//                        'ubicacion' => $value['H'],
//                        'fechaIngreso' => $value['I'],
//                        'proveedor' => $value['J'],
//                        'categoria' => $value['K'],
//                        'sucursal' => $value['L'],
//                        'nombre_img' => $value['M'],
//                        'observaciones' => $value['N']
//                ); 
//                foreach ($arr_datos as $llave => $valor) {
//                    $arr_datos[$llave] = $valor;
//                }
//                //Llamada de ws para insertar
//                $data_string = json_encode($arr_datos);
//                $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/inventarios/insertar_inventario.php');
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
////                echo $result;
////                echo "<br>";
//            } 
//        }
//        redirect('/inventarios_controller/mostrarInventarios');
//    }        
//    //Fin Importar desde Excel con libreria de PHPExcel
//    
//    //Exportar datos a Excel
//    public function exportarInventarioExcel(){
//        //hash php para incluid proveedores
////        $fruits = array (
////            "fruits"  => array("a" => "Orange", "b" => "Banana", "c" => "Apple"),
////        );
////        echo $fruits["fruits"]["b"];        
//        //fin hash para incluir proveedores
//        //llamadod de ws
//        # An HTTP GET request example
//        $url = 'http://localhost/matserviceswsok/matservsthread1/inventarios/obtener_inventarios.php';
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $data = curl_exec($ch);
//        $datos = json_decode($data);
//        curl_close($ch);
//        //fin llamado de ws
//        $id=$this->uri->segment(3);
//        $nilai=$datos->{'inventarios'};
////        if (isset($datos->{'usuarios'})) {
////            foreach($nilai as $h){
////                echo "azul";
////            }
////        }
//        $totn = 0;
//        foreach($nilai as $h){
//            $totn = $totn + 1;
//        }
//        $heading=array('SUCURSAL','CÓDIGO','DESCRIPCIÓN','PRECIO COSTO','PRECIO UNITARIO','IVA','EXISTENCIA','EXIST. MIN','UBICACIÓN','PROVEEDOR','CATEGORIA','FECHA INGRESO');
//        $this->load->library('excel');
//        //Create a new Object
//        $objPHPExcel = new PHPExcel();
//        $objPHPExcel->getActiveSheet()->setTitle("Inventario");
//        //Loop Heading
//        $rowNumberH = 1;
//        $colH = 'A';
//        foreach($heading as $h){
//            $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
//            $colH++;    
//        }
//        //Loop Result
//        //$totn=$nilai->num_rows();
//        $maxrow=$totn+1;
//        $row = 2;
//        $no = 1;
//        foreach($nilai as $n){
//            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n->{'descripcionSucursal'});
//            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n->{'codigo'});
//            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n->{'descripcion'});
//            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n->{'precioCosto'});
//            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n->{'precioUnitario'});
//            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n->{'porcentajeImpuesto'});
//            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n->{'existencia'});
//            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$n->{'existenciaMinima'});
//            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$n->{'ubicacion'});
//            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$n->{'empresa'});
//            $objPHPExcel->getActiveSheet()->setCellValue('K'.$row,$n->{'descripcionCategoria'});
//            $objPHPExcel->getActiveSheet()->setCellValue('L'.$row,$n->{'fechaIngreso'});
//            $row++;
//            $no++;
//        }
//        //Freeze pane
//        $objPHPExcel->getActiveSheet()->freezePane('A2');
//        //Cell Style
//        $styleArray = array(
//                'borders' => array(
//                        'allborders' => array(
//                                'style' => PHPExcel_Style_Border::BORDER_THIN
//                        )
//                )
//        );
//        $objPHPExcel->getActiveSheet()->getStyle('A1:M'.$maxrow)->applyFromArray($styleArray);
//        //Save as an Excel BIFF (xls) file
//        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
//        header('Content-Type: application/vnd.ms-excel');
//        header('Content-Disposition: attachment;filename="Inventario.xls"');
//        header('Cache-Control: max-age=0');
//        $objWriter->save('php://output');
//        exit();
//    }	
//    //fin exportar a excel
//    
//    function edicionMultipleInventario($ids) {
//        $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
//            'ids' => $ids,
//            'proveedores' => $this->proveedoresGlobal,
//            'categorias' => $this->categoriasGlobal,
//            'sucursales' => $this->sucursalesGlobal,
//            'ivaEmpresa' => $this->ivaEmpresaGlobal,
//            'permisos' => $this->session->userdata('permisos'));
//        $this->load->view('layouts/header_view',$data);
//        $this->load->view('inventarios/edicionMultipleInventario_view',$data);
//        $this->load->view('layouts/pie_view',$data);
//    }
//    
//    function edicionMultipleFromFormulario() {
//        //valores iniciales de variables a actualizar
//        $codigo;
//        $descripcion;
//        $precioCosto;
//        $precioUnitario;
//        $porcentajeImpuesto;
//        $existencia;
//        $existenciaMinima;
//        $ubicacion;
//        $fechaIngreso;
//        $fechaIngreso; 
//        $proveedor;
//        $categoria;
//        $sucursal;
//        $nombre_img;
//        $img_ant = "";
//        $tipo_img_ant;
//        $observaciones;
//        $bandSubirImagen = 0;
//        //fin valores iniciales de variables a actualizar
//        $arrayIds = explode("_", $this->input->post("ids"));
////        foreach ($arrayIds as $elemento) {
////            echo $elemento."<br>";
////        }
//        // Recorrido de ids para modificacion
//        foreach ($arrayIds as $elemento) {
//            if ($elemento!="") {
//                //Consulto los campos por id para comparar los que hubo cambios
//                //Obtiene producto por id
//                # An HTTP GET request example
//                $url = 'http://localhost/matserviceswsok/matservsthread1/inventarios/obtener_inventario_por_id.php?idArticulo='.$elemento;
//                $ch = curl_init($url);
//                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                $data = curl_exec($ch);
//                $datos = json_decode($data);
//                curl_close($ch);
//                if ($datos->{'estado'}==1) {
//                    //comparo datos que vienen del formulario si vienen vacios lasigno el anterior
//                    if ($this->input->post("codigo")=="") {
//                        $codigo = $datos->{'inventario'}->{'codigo'};
//                    } else {
//                        $codigo = $this->input->post("codigo");
//                    }
//                    if ($this->input->post("descripcion")=="") {
//                        $descripcion = $datos->{'inventario'}->{'descripcion'};
//                    } else {
//                        $descripcion = $this->input->post("descripcion");
//                    }
//                    if ($this->input->post("precioCosto")=="") {
//                        $precioCosto = $datos->{'inventario'}->{'precioCosto'};
//                    } else {
//                        $precioCosto = $this->input->post("precioCosto");
//                    }
//                    if ($this->input->post("precioUnitario")=="") {
//                        $precioUnitario = $datos->{'inventario'}->{'precioUnitario'};
//                    } else {
//                        $precioUnitario = $this->input->post("precioUnitario");
//                    }
//                    if ($this->input->post("porcentajeImpuesto")=="") {
//                        $porcentajeImpuesto = $datos->{'inventario'}->{'porcentajeImpuesto'};
//                    } else {
//                        $porcentajeImpuesto = $this->input->post("porcentajeImpuesto");
//                    }
//                    if ($this->input->post("existencia")=="") {
//                        $existencia = $datos->{'inventario'}->{'existencia'};
//                    } else {
//                        $existencia = $this->input->post("existencia");
//                    }
//                    if ($this->input->post("existenciaMinima")=="") {
//                        $existenciaMinima = $datos->{'inventario'}->{'existenciaMinima'};
//                    } else {
//                        $existenciaMinima = $this->input->post("existenciaMinima");
//                    }
//                    if ($this->input->post("ubicacion")=="") {
//                        $ubicacion = $datos->{'inventario'}->{'ubicacion'};
//                    } else {
//                        $ubicacion = $this->input->post("ubicacion");
//                    }
//                    if ($this->input->post("fechaIngreso")=="") {
//                        $fechaIngreso = $datos->{'inventario'}->{'fechaIngreso'};
//                    } else {
//                        $fechaIngreso = $this->input->post("fechaIngreso");
//                    }
//                    if ($this->input->post("proveedor")=="") {
//                        $proveedor = $datos->{'inventario'}->{'idProveedor'};
//                    } else {
//                        $proveedor = $this->input->post("proveedor");
//                    }
//                    if ($this->input->post("categoria")=="") {
//                        $categoria = $datos->{'inventario'}->{'idCategoria'};
//                    } else {
//                        $categoria = $this->input->post("categoria");
//                    }
//                    if ($this->input->post("sucursal")=="") {
//                        $sucursal = $datos->{'inventario'}->{'idSucursal'};
//                    } else {
//                        $sucursal = $this->input->post("sucursal");
//                    }
//                    if ($this->input->post("observaciones")=="") {
//                        $observaciones = $datos->{'inventario'}->{'observaciones'};
//                    } else {
//                        $observaciones = $this->input->post("observaciones");
//                    }
//                    //echo "imagen->".$_FILES['imagen']['name']."<br>";
//                    if ($bandSubirImagen==0){
//                        $nombre_img = "";
//                        if ($_FILES['imagen']['name']=="") {
//                            $nombre_img = $datos->{'inventario'}->{'fotoProducto'};
//                        } else {
////                            echo "->".$_FILES['imagen']['name']."<br>"; 
//                            //pongo la imagen que viene con el id en cuestion
//                            $tipo = $_FILES['imagen']['type'];
//                            $tamano = $_FILES['imagen']['size'];
//                            //echo "tamaño->".$tamano."->nombreimg->";
//                            if ($_FILES['imagen']['size'] <= 50000) {
//                               //indicamos los formatos que permitimos subir a nuestro servidor
//                               if (($_FILES["imagen"]["type"] == "image/jpeg")
//                               || ($_FILES["imagen"]["type"] == "image/jpg")
//                               || ($_FILES["imagen"]["type"] == "image/png"))
//                               {
//                                  // Ruta donde se guardarán las imágenes que subamos
//                                  //$directorio = base_url().'fotos/inventario/';
//                                  $directorio = $_SERVER['DOCUMENT_ROOT'] . 'matservices/fotos/inventario/';
//                                  //Cambio el onombre de la imagen por producto mas id que corresponde
//                                  if ($tipo=="image/png") {
//                                      $nombre_img = "producto".$elemento.".png";
//                                  }
//                                  if ($tipo=="image/jpeg") {
//                                      $nombre_img = "producto".$elemento.".jpeg";
//                                  }
//                                  if ($tipo=="image/jpg") {
//                                      $nombre_img = "producto".$elemento.".jpg";
//                                  }
//                                  //borra imagen anterior
//                                  if (($datos->{'inventario'}->{'fotoProducto'}!="producto0.png") && (file_exists($directorio.$datos->{'inventario'}->{'fotoProducto'})==1)) {
//                                    unlink($directorio.$datos->{'inventario'}->{'fotoProducto'}); 
//                                  }
//                                  // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
//                                  $tipo_img_ant = $tipo;
//                                  $img_ant = $nombre_img;
//                                  move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
//                                } else {
//                                   //si no cumple con el formato
//                                   echo "No se puede subir una imagen con ese formato ";
//                                   return;
//                                }
//                            } else {
//                               //si existe la variable pero se pasa del tamaño permitido
//                               if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
//                            }
//                        }
//                        //fin comparo datos que vienen del formulario si vienen vacios lasigno el anterior
//                        $bandSubirImagen++;
//                    } else {
//                        if ($img_ant != "") {
//                            $directorio = $_SERVER['DOCUMENT_ROOT'] . 'matservices/fotos/inventario/';
//                            //Cambio el onombre de la imagen por producto mas id que corresponde
//                            if ($tipo_img_ant=="image/png") {
//                                $nombre_img = "producto".$elemento.".png";
//                            }
//                            if ($tipo_img_ant=="image/jpeg") {
//                                $nombre_img = "producto".$elemento.".jpeg";
//                            }
//                            if ($tipo_img_ant=="image/jpg") {
//                                $nombre_img = "producto".$elemento.".jpg";
//                            }
//                            //borra imagen anterior
//                            if (($datos->{'inventario'}->{'fotoProducto'}!="producto0.png")
//                                    && (file_exists($directorio.$datos->{'inventario'}->{'fotoProducto'})==1)) {
//                              unlink($directorio.$datos->{'inventario'}->{'fotoProducto'}); 
//                            }
//                            // Copio la primera imagen con el nuevo nombre
//                            copy($directorio.$img_ant, $directorio.$nombre_img);
//                            //borra imagen anterior
////                            if ($datos->{'inventario'}->{'fotoProducto'}!="producto0.png") {
////                              unlink($directorio.$datos->{'inventario'}->{'fotoProducto'}); 
////                            }
//                        }
//                    }
//                    //realizo actualizacion
//                    $data = array("idArticulo" => $elemento,
//                        "codigo" => $codigo, 
//                        "descripcion" => $descripcion, 
//                        "precioCosto" => $precioCosto, 
//                        "precioUnitario" => $precioUnitario, 
//                        "porcentajeImpuesto" => $porcentajeImpuesto, 
//                        "existencia" => $existencia, 
//                        "existenciaMinima" => $existenciaMinima, 
//                        "ubicacion" => $ubicacion, 
//                        "fechaIngreso" => $fechaIngreso,
//                        "proveedor" => $proveedor,
//                        "categoria" => $categoria,
//                        "sucursal" => $sucursal,
//                        "observaciones" => $observaciones,
//                        "nombre_img" => $nombre_img
//                            );
//                    $data_string = json_encode($data);
//                    $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/inventarios/actualizar_inventario.php');
//                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                        'Content-Type: application/json',
//                        'Content-Length: ' . strlen($data_string))
//                    );
//                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//                    //execute post
//                    $result = curl_exec($ch);
//                    //close connection
//                    curl_close($ch);
//                    //fin realizo actualización
//                } else {
//                    echo "error";
//                }
//                //echo "-->".$img_ant."<br>";
//            }
//            //Fin Consulto los campos por id para comparar los que hubo cambios
//        }         
//        redirect('/inventarios_controller/mostrarInventarios');
//    }

    // Manejo de sesiones
    function cerrarSesion() {            
            if ($this->sistema_model->logout()) {
                $data = array('error'=>'1');
                redirect($this->index(),$data);
            }
    }
    
    //Fin Manejo de sesiones
    
    
}

