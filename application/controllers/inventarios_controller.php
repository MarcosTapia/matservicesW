<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inventarios_controller extends CI_Controller {
    private $datosEmpresaGlobal;
    private $nombreEmpresaGlobal;
    private $proveedoresGlobal;
    private $categoriasGlobal;
    private $sucursalesGlobal;
    private $ivaEmpresaGlobal;
    
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
        
        $this->datosEmpresaGlobal = $this->cargaDatosEmpresa();
        $this->sistemaGlobal = $this->cargaDatosSistema();
        $this->proveedoresGlobal = $this->cargaDatosProveedores();
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
        
    function index(){
        $this->load->view('login_view');
    }
    
    function regresa() {
        echo "error";
    }
        //obtiene maxId de inventario
//        $maxIdReg = $this->obtieneMaxIdInventario();
//        $maxId = $maxIdReg[0]->{'idArticulo'};
        //fin obtiene maxId de inventario
    
    function mostrarInventarios() {
        if ($this->is_logged_in()){
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
            $data;
            $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal);
            if ($datos->{'estado'}==1) {

                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
                //fin crea campos de sesion
                $data = array('inventarios'=>$datos->{'inventarios'},
                    'usuario' => $this->session->userdata('usuario'),
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'idSucursal' => $this->session->userdata('idSucursal'),
                    'fecha' => $fechaIngreso,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'permisos' => $this->session->userdata('permisos'),
                    'opcionClickeada' => '1'
                        );
                $this->load->view('layouts/header_view',$data);
                $this->load->view('inventarios/adminInventarios_view',$data);
                $this->load->view('layouts/pie_view',$data);
            } else {
                $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'permisos' => $this->session->userdata('permisos'));
                $this->load->view('layouts/header_view',$data);
                $this->load->view('principal_view',$data);
                $this->load->view('layouts/pie_view',$data);
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function actualizarInventario($idArticulo) {
        if ($this->is_logged_in()){
            //Obtiene producto por id
            # An HTTP GET request example
            $url = RUTAWS.'inventarios/obtener_inventario_por_id.php?idArticulo='.$idArticulo;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            curl_close($ch);
            if ($datos->{'estado'}==1) {
                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
                $data = array('inventario'=>$datos->{'inventario'},
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'proveedores' => $this->proveedoresGlobal,
                    'categorias' => $this->categoriasGlobal,
                    'sucursales' => $this->sucursalesGlobal,
                    'ivaEmpresa' => $this->ivaEmpresaGlobal,
                    'permisos' => $this->session->userdata('permisos'),
                    'opcionClickeada' => '1'
                        );
                $this->load->view('layouts/header_view',$data);
                $this->load->view('inventarios/actualizaInventario_view',$data);
                $this->load->view('layouts/pie_view',$data);
            } else {
                echo "error";
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function actualizarInventarioFromFormulario(){
        if ($this->is_logged_in()){
            $idArticulo = $this->input->post("idArticulo");
            $imagenAntH = $this->input->post("imagenAntH");
            $codigo = $this->input->post("codigo");
            $descripcion = $this->input->post("descripcion");
            $precioCosto = $this->input->post("precioCosto");
            $precioUnitario = $this->input->post("precioUnitario");
            $porcentajeImpuesto = $this->input->post("porcentajeImpuesto");
            $existencia = $this->input->post("existencia");
            $existenciaMinima = $this->input->post("existenciaMinima");
            $ubicacion = $this->input->post("ubicacion");
            $fechaIngreso = $this->input->post("fechaIngreso");

            //por si no se selecciona fecha
            if ($fechaIngreso=="") {
                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            }
            //Fin por si no se selecciona fecha

            $proveedor = $this->input->post("proveedor");
            $categoria = $this->input->post("categoria");
            $sucursal = $this->input->post("sucursal");
            $nombre_img = $_FILES['imagen']['name'];

            //Verifica si no hubo cambio de imagen y ent asigna la anterior
            if ($_FILES['imagen']['name']!="") {
                //fin verifica si hubo cambio de imagen
                $tipo = $_FILES['imagen']['type'];
                $tamano = $_FILES['imagen']['size'];
                //Si existe imagen y tiene un tamaño correcto
                if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 50000)) {
                   //indicamos los formatos que permitimos subir a nuestro servidor
                   if (($_FILES["imagen"]["type"] == "image/jpeg")
                   || ($_FILES["imagen"]["type"] == "image/jpg")
                   || ($_FILES["imagen"]["type"] == "image/png"))
                   {
                      // Ruta donde se guardarán las imágenes que subamos
                      //$directorio = base_url().'fotos/inventario/';
                      $directorio = $_SERVER['DOCUMENT_ROOT'] . 'matservices/fotos/inventario/';
                      //borra imagen anterior 
                      unlink($directorio.$imagenAntH); 
                      //Cambio el onombre de la imagen por producto mas id que corresponde
                      if ($tipo=="image/png") {
                          $nombre_img = "producto".$idArticulo.".png";
                      }
                      if ($tipo=="image/jpeg") {
                          $nombre_img = "producto".$idArticulo.".jpeg";
                      }
                      if ($tipo=="image/jpg") {
                          $nombre_img = "producto".$idArticulo.".jpg";
                      }
                      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
                      move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
                    } else {
                       //si no cumple con el formato
                       echo "No se puede subir una imagen con ese formato ";
                       return;
                    }
                } else {
                   //si existe la variable pero se pasa del tamaño permitido
                   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
                }
            } 
    //            else {
    //                $nombre_img = $imagenAntH;
    //            }
            //fin falta archivo imagen
            $observaciones = $this->input->post("observaciones");
            $data = array("idArticulo" => $idArticulo,
                "codigo" => $codigo, 
                "descripcion" => $descripcion, 
                "precioCosto" => $precioCosto, 
                "precioUnitario" => $precioUnitario, 
                "porcentajeImpuesto" => $porcentajeImpuesto, 
                "existencia" => $existencia, 
                "existenciaMinima" => $existenciaMinima, 
                "ubicacion" => $ubicacion, 
                "fechaIngreso" => $fechaIngreso,
                "proveedor" => $proveedor,
                "categoria" => $categoria,
                "sucursal" => $sucursal,
                "observaciones" => $observaciones,
                "nombre_img" => $nombre_img
                    );
            $data_string = json_encode($data);
            $ch = curl_init(RUTAWS.'inventarios/actualizar_inventario.php');
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
            echo $result;

            //Fin llamado WS
            redirect('/inventarios_controller/mostrarInventarios');
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function eliminarInventario($idArticulo,$fotoProducto) {
        if ($this->is_logged_in()){
            //echo "-->".$fotoProducto."-->".$idArticulo;
            if ($fotoProducto!="producto0.png") {
                //borro imagen del articulo
              unlink("./fotos/inventario"."/".$fotoProducto);
            }
            $data = array("idArticulo" => $idArticulo);
            $data_string = json_encode($data);
            $ch = curl_init(RUTAWS.'inventarios/borrar_inventario.php');
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
            $resultado = json_decode($result, true);
            if ($resultado['estado']==1) {
                $this->session->set_flashdata('correcto', "Eliminación Exitosa <br>");
            } else {
                $this->session->set_flashdata('correcto', "No se eliminó el registro, hay información relacionada con él<br>");
            }        
            //close connection
            curl_close($ch);
            redirect('/inventarios_controller/mostrarInventarios');
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function nuevoInventario() {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'proveedores' => $this->proveedoresGlobal,
                'categorias' => $this->categoriasGlobal,
                'sucursales' => $this->sucursalesGlobal,
                'ivaEmpresa' => $this->ivaEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '1'
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('inventarios/nuevoInventario_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function nuevoInventarioFromFormulario(){
        if ($this->is_logged_in()){
    //        if ($this->input->post('submit')){
                //LLamadfo de WS
                $codigo = $this->input->post("codigo");
    //        echo "-->".$codigo;
                $descripcion = $this->input->post("descripcion");
                $precioCosto = $this->input->post("precioCosto");
                $precioUnitario = $this->input->post("precioUnitario");
                $porcentajeImpuesto = $this->input->post("porcentajeImpuesto");
                $existencia = $this->input->post("existencia");
                $existenciaMinima = $this->input->post("existenciaMinima");
                $ubicacion = $this->input->post("ubicacion");
                $fechaIngreso = $this->input->post("fechaIngreso");

                //por si no se selecciona fecha
                if ($fechaIngreso=="") {
                    $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                    $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
                }
                //Fin por si no se selecciona fecha

                $proveedor = $this->input->post("proveedor");
                $categoria = $this->input->post("categoria");
                $sucursal = $this->input->post("sucursal");
                $nombre_img = $_FILES['imagen']['name'];

                //obtiene maxId de inventario
                $maxIdReg = $this->obtieneMaxIdInventario();
                $maxId = 0;
                $maxId = $maxIdReg[0]->{'idArticulo'};
                //fin obtiene maxId de inventario

                $tipo = $_FILES['imagen']['type'];
                $tamano = $_FILES['imagen']['size'];
                //Si existe imagen y tiene un tamaño correcto
                if ($_FILES['imagen']['name']!="") {
                    if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 50000)) {
                       //indicamos los formatos que permitimos subir a nuestro servidor
                       if (($_FILES["imagen"]["type"] == "image/jpeg")
                       || ($_FILES["imagen"]["type"] == "image/jpg")
                       || ($_FILES["imagen"]["type"] == "image/png"))
                       {
                          // Ruta donde se guardarán las imágenes que subamos
                          //$directorio = base_url().'fotos/inventario/';
                          $directorio = $_SERVER['DOCUMENT_ROOT'] . 'matservices/fotos/inventario/';
                          //Cambio el onombre de la imagen por producto mas id que corresponde
                          if ($tipo=="image/png") {
                              $nombre_img = "producto".($maxId + 1).".png";
                          }
                          if ($tipo=="image/jpeg") {
                              $nombre_img = "producto".($maxId + 1).".jpeg";
                          }
                          if ($tipo=="image/jpg") {
                              $nombre_img = "producto".($maxId + 1).".jpg";
                          }
                          // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
                          move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
                        } else {
                           //si no cumple con el formato
                           echo "No se puede subir una imagen con ese formato ";
                           return;
                        }
                    } else {
                       //si existe la variable pero se pasa del tamaño permitido
                       if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
                    }
                } else {
                    $nombre_img = "producto0.png";
                }
                //fin falta archivo imagen
                $observaciones = $this->input->post("observaciones");
                $data = array("codigo" => $codigo, 
                    "descripcion" => $descripcion, 
                    "precioCosto" => $precioCosto, 
                    "precioUnitario" => $precioUnitario, 
                    "porcentajeImpuesto" => $porcentajeImpuesto, 
                    "existencia" => $existencia, 
                    "existenciaMinima" => $existenciaMinima, 
                    "ubicacion" => $ubicacion, 
                    "fechaIngreso" => $fechaIngreso,
                    "proveedor" => $proveedor,
                    "categoria" => $categoria,
                    "sucursal" => $sucursal,
                    "observaciones" => $observaciones,
                    "nombre_img" => $nombre_img
                        );
                $data_string = json_encode($data);
                $ch = curl_init(RUTAWS.'inventarios/insertar_inventario.php');
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
                echo $result;
                //Fin llamado WS
                redirect('/inventarios_controller/mostrarInventarios');
    //        }
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    //Importar desde Excel con libreria de PHPExcel
    public function importarInventariosExcel(){
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 

            $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '1'
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('inventarios/importarInventariosFromExcel_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }        

    //Importar desde Excel con libreria de PHPExcel
//    private $regsNoImportados = array();    
    public function importarInventarioExcel(){
        if ($this->is_logged_in()){
            //variable de registros no importados
            //Cargar PHPExcel library con manejo de excepciones
            try {
                $this->load->library('excel');
                $name   = $_FILES['excel']['name'];
                $tname  = $_FILES['excel']['tmp_name'];
                $obj_excel = PHPExcel_IOFactory::load($tname);       
                $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
                $arr_datos = array();
                $i = 0;
                $regsNoImportados = array();    
            } catch (Exception $e) {
                //echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                $this->session->set_flashdata('correcto', 'Error al importar, '
                        . 'ingresa a otra opcion y vuelve a intentarlo. <br>');
            }
            $erroresImportacion = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index != 1 ){
                    $arr_datos = array(
                            'codigo' => $value['A'],
                            'descripcion' => $value['B'],
                            'precioCosto' => $value['C'],
                            'precioUnitario' => $value['D'],
                            'porcentajeImpuesto' => $value['E'],
                            'existencia' => $value['F'],
                            'existenciaMinima' => $value['G'],
                            'ubicacion' => $value['H'],
                            'fechaIngreso' => $value['I'],
                            'proveedor' => $value['J'],
                            'categoria' => $value['K'],
                            'sucursal' => $value['L'],
                            'nombre_img' => $value['M'],
                            'observaciones' => $value['N']
                    ); 
                    foreach ($arr_datos as $llave => $valor) {
                        $arr_datos[$llave] = $valor;
                    }
                    //Llamada de ws para insertar
                    $data_string = json_encode($arr_datos);
                    $ch = curl_init(RUTAWS.'inventarios/insertar_inventario.php');
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
                    
                    //para informe de registros no importados        
                    $resultado = json_decode($result, true);
                    //echo "-->".$resultado['estado']."<br>";
                    if (($resultado['estado']=="") || ($resultado['estado']==2)) {
                        $erroresImportacion = 1;
                        $this->regsNoImportados[$i]['descripcion'] = $value['B'];
                        $file = fopen("errores_importacion.txt", "a");
                        fwrite($file, $value['A']."|".$value['B']."|".$value['C'].
                                "|".$value['D']."|".$value['E']."|".$value['F'].
                                "|".$value['G']."|".$value['H']."|".$value['I'].
                                "|".$value['J']."|".$value['K']."|".$value['L'].
                                "|".$value['M']."|".$value['N']."|".PHP_EOL);
                        fclose($file);                
                    }    
                    $i++;
                    //Fin para informe de registros no importados        
                } 
            }
            //para informe de registros no importados
            if ($erroresImportacion == 1) {
                redirect('/inventarios_controller/erroresImportacionF');
                redirect($this->erroresImportacionF());
                redirect($this->erroresImportacionF($regsNoImportados));
            } else {
                redirect('/inventarios_controller/mostrarInventarios');
            }
            //Fin para informe de registros no importados        
        } else {
            redirect($this->cerrarSesion());
        }
    }        
    
//    function erroresImportacionF($regsNoImportados) {
    function erroresImportacionF() {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'sucursales' => $this->sucursalesGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'permisos' => $this->session->userdata('permisos'),
                //'regsNoImportados' => $regsNoImportados,
                'opcionClickeada' => '7'
                    );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('inventarios/erroresImportacion_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    //Fin Importar desde Excel con libreria de PHPExcel
    
    //Exportar datos a Excel
    public function exportarInventarioExcel(){
        if ($this->is_logged_in()){
            //llamadod de ws
            # An HTTP GET request example
            $url = RUTAWS.'inventarios/obtener_inventarios.php';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            curl_close($ch);
            //fin llamado de ws
            $id=$this->uri->segment(3);
            $nilai=$datos->{'inventarios'};
    //        if (isset($datos->{'usuarios'})) {
    //            foreach($nilai as $h){
    //                echo "azul";
    //            }
    //        }
            $totn = 0;
            foreach($nilai as $h){
                $totn = $totn + 1;
            }
            $heading=array('SUCURSAL','CÓDIGO','DESCRIPCIÓN','PRECIO COSTO','PRECIO UNITARIO','IVA','EXISTENCIA','EXIST. MIN','UBICACIÓN','PROVEEDOR','CATEGORIA','FECHA INGRESO');
            $this->load->library('excel');
            //Create a new Object
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getActiveSheet()->setTitle("Inventario");
            //Loop Heading
            $rowNumberH = 1;
            $colH = 'A';
            foreach($heading as $h){
                $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
                $colH++;    
            }
            //Loop Result
            //$totn=$nilai->num_rows();
            $maxrow=$totn+1;
            $row = 2;
            $no = 1;
            foreach($nilai as $n){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n->{'descripcionSucursal'});
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n->{'codigo'});
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n->{'descripcion'});
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n->{'precioCosto'});
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n->{'precioUnitario'});
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n->{'porcentajeImpuesto'});
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n->{'existencia'});
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$n->{'existenciaMinima'});
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$n->{'ubicacion'});
                $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$n->{'empresa'});
                $objPHPExcel->getActiveSheet()->setCellValue('K'.$row,$n->{'descripcionCategoria'});
                $objPHPExcel->getActiveSheet()->setCellValue('L'.$row,$n->{'fechaIngreso'});
                $row++;
                $no++;
            }
            //Freeze pane
            $objPHPExcel->getActiveSheet()->freezePane('A2');
            //Cell Style
            $styleArray = array(
                    'borders' => array(
                            'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                            )
                    )
            );
            $objPHPExcel->getActiveSheet()->getStyle('A1:M'.$maxrow)->applyFromArray($styleArray);
            //Save as an Excel BIFF (xls) file
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Inventario.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            exit();
        } else {
            redirect($this->cerrarSesion());
        }
    }	
    //fin exportar a excel
    
    function edicionMultipleInventario($ids) {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'ids' => $ids,
                'proveedores' => $this->proveedoresGlobal,
                'categorias' => $this->categoriasGlobal,
                'sucursales' => $this->sucursalesGlobal,
                'ivaEmpresa' => $this->ivaEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '1'
                    );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('inventarios/edicionMultipleInventario_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function edicionMultipleFromFormulario() {
        if ($this->is_logged_in()){
            //valores iniciales de variables a actualizar
            $codigo;
            $descripcion;
            $precioCosto;
            $precioUnitario;
            $porcentajeImpuesto;
            $existencia;
            $existenciaMinima;
            $ubicacion;
            $fechaIngreso;
            $fechaIngreso; 
            $proveedor;
            $categoria;
            $sucursal;
            $nombre_img;
            $img_ant = "";
            $tipo_img_ant;
            $observaciones;
            $bandSubirImagen = 0;
            //fin valores iniciales de variables a actualizar
            $arrayIds = explode("_", $this->input->post("ids"));
    //        foreach ($arrayIds as $elemento) {
    //            echo $elemento."<br>";
    //        }
            // Recorrido de ids para modificacion
            foreach ($arrayIds as $elemento) {
                if ($elemento!="") {
                    //Consulto los campos por id para comparar los que hubo cambios
                    //Obtiene producto por id
                    # An HTTP GET request example
                    $url = RUTAWS.'inventarios/obtener_inventario_por_id.php?idArticulo='.$elemento;
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $data = curl_exec($ch);
                    $datos = json_decode($data);
                    curl_close($ch);
                    if ($datos->{'estado'}==1) {
                        //comparo datos que vienen del formulario si vienen vacios lasigno el anterior
                        if ($this->input->post("codigo")=="") {
                            $codigo = $datos->{'inventario'}->{'codigo'};
                        } else {
                            $codigo = $this->input->post("codigo");
                        }
                        if ($this->input->post("descripcion")=="") {
                            $descripcion = $datos->{'inventario'}->{'descripcion'};
                        } else {
                            $descripcion = $this->input->post("descripcion");
                        }
                        if ($this->input->post("precioCosto")=="") {
                            $precioCosto = $datos->{'inventario'}->{'precioCosto'};
                        } else {
                            $precioCosto = $this->input->post("precioCosto");
                        }
                        if ($this->input->post("precioUnitario")=="") {
                            $precioUnitario = $datos->{'inventario'}->{'precioUnitario'};
                        } else {
                            $precioUnitario = $this->input->post("precioUnitario");
                        }
                        if ($this->input->post("porcentajeImpuesto")=="") {
                            $porcentajeImpuesto = $datos->{'inventario'}->{'porcentajeImpuesto'};
                        } else {
                            $porcentajeImpuesto = $this->input->post("porcentajeImpuesto");
                        }
                        if ($this->input->post("existencia")=="") {
                            $existencia = $datos->{'inventario'}->{'existencia'};
                        } else {
                            $existencia = $this->input->post("existencia");
                        }
                        if ($this->input->post("existenciaMinima")=="") {
                            $existenciaMinima = $datos->{'inventario'}->{'existenciaMinima'};
                        } else {
                            $existenciaMinima = $this->input->post("existenciaMinima");
                        }
                        if ($this->input->post("ubicacion")=="") {
                            $ubicacion = $datos->{'inventario'}->{'ubicacion'};
                        } else {
                            $ubicacion = $this->input->post("ubicacion");
                        }
                        if ($this->input->post("fechaIngreso")=="") {
                            $fechaIngreso = $datos->{'inventario'}->{'fechaIngreso'};
                        } else {
                            $fechaIngreso = $this->input->post("fechaIngreso");
                        }
                        if ($this->input->post("proveedor")=="") {
                            $proveedor = $datos->{'inventario'}->{'idProveedor'};
                        } else {
                            $proveedor = $this->input->post("proveedor");
                        }
                        if ($this->input->post("categoria")=="") {
                            $categoria = $datos->{'inventario'}->{'idCategoria'};
                        } else {
                            $categoria = $this->input->post("categoria");
                        }
                        if ($this->input->post("sucursal")=="") {
                            $sucursal = $datos->{'inventario'}->{'idSucursal'};
                        } else {
                            $sucursal = $this->input->post("sucursal");
                        }
                        if ($this->input->post("observaciones")=="") {
                            $observaciones = $datos->{'inventario'}->{'observaciones'};
                        } else {
                            $observaciones = $this->input->post("observaciones");
                        }
                        //echo "imagen->".$_FILES['imagen']['name']."<br>";
                        if ($bandSubirImagen==0){
                            $nombre_img = "";
                            if ($_FILES['imagen']['name']=="") {
                                $nombre_img = $datos->{'inventario'}->{'fotoProducto'};
                            } else {
    //                            echo "->".$_FILES['imagen']['name']."<br>"; 
                                //pongo la imagen que viene con el id en cuestion
                                $tipo = $_FILES['imagen']['type'];
                                $tamano = $_FILES['imagen']['size'];
                                //echo "tamaño->".$tamano."->nombreimg->";
                                if ($_FILES['imagen']['size'] <= 50000) {
                                   //indicamos los formatos que permitimos subir a nuestro servidor
                                   if (($_FILES["imagen"]["type"] == "image/jpeg")
                                   || ($_FILES["imagen"]["type"] == "image/jpg")
                                   || ($_FILES["imagen"]["type"] == "image/png"))
                                   {
                                      // Ruta donde se guardarán las imágenes que subamos
                                      //$directorio = base_url().'fotos/inventario/';
                                      $directorio = $_SERVER['DOCUMENT_ROOT'] . 'matservices/fotos/inventario/';
                                      //Cambio el onombre de la imagen por producto mas id que corresponde
                                      if ($tipo=="image/png") {
                                          $nombre_img = "producto".$elemento.".png";
                                      }
                                      if ($tipo=="image/jpeg") {
                                          $nombre_img = "producto".$elemento.".jpeg";
                                      }
                                      if ($tipo=="image/jpg") {
                                          $nombre_img = "producto".$elemento.".jpg";
                                      }
                                      //borra imagen anterior
                                      if (($datos->{'inventario'}->{'fotoProducto'}!="producto0.png") && (file_exists($directorio.$datos->{'inventario'}->{'fotoProducto'})==1)) {
                                        unlink($directorio.$datos->{'inventario'}->{'fotoProducto'}); 
                                      }
                                      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
                                      $tipo_img_ant = $tipo;
                                      $img_ant = $nombre_img;
                                      move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
                                    } else {
                                       //si no cumple con el formato
                                       echo "No se puede subir una imagen con ese formato ";
                                       return;
                                    }
                                } else {
                                   //si existe la variable pero se pasa del tamaño permitido
                                   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
                                }
                            }
                            //fin comparo datos que vienen del formulario si vienen vacios lasigno el anterior
                            $bandSubirImagen++;
                        } else {
                            if ($img_ant != "") {
                                $directorio = $_SERVER['DOCUMENT_ROOT'] . 'matservices/fotos/inventario/';
                                //Cambio el onombre de la imagen por producto mas id que corresponde
                                if ($tipo_img_ant=="image/png") {
                                    $nombre_img = "producto".$elemento.".png";
                                }
                                if ($tipo_img_ant=="image/jpeg") {
                                    $nombre_img = "producto".$elemento.".jpeg";
                                }
                                if ($tipo_img_ant=="image/jpg") {
                                    $nombre_img = "producto".$elemento.".jpg";
                                }
                                //borra imagen anterior
                                if (($datos->{'inventario'}->{'fotoProducto'}!="producto0.png")
                                        && (file_exists($directorio.$datos->{'inventario'}->{'fotoProducto'})==1)) {
                                  unlink($directorio.$datos->{'inventario'}->{'fotoProducto'}); 
                                }
                                // Copio la primera imagen con el nuevo nombre
                                copy($directorio.$img_ant, $directorio.$nombre_img);
                                //borra imagen anterior
    //                            if ($datos->{'inventario'}->{'fotoProducto'}!="producto0.png") {
    //                              unlink($directorio.$datos->{'inventario'}->{'fotoProducto'}); 
    //                            }
                            }
                        }
                        //realizo actualizacion
                        $data = array("idArticulo" => $elemento,
                            "codigo" => $codigo, 
                            "descripcion" => $descripcion, 
                            "precioCosto" => $precioCosto, 
                            "precioUnitario" => $precioUnitario, 
                            "porcentajeImpuesto" => $porcentajeImpuesto, 
                            "existencia" => $existencia, 
                            "existenciaMinima" => $existenciaMinima, 
                            "ubicacion" => $ubicacion, 
                            "fechaIngreso" => $fechaIngreso,
                            "proveedor" => $proveedor,
                            "categoria" => $categoria,
                            "sucursal" => $sucursal,
                            "observaciones" => $observaciones,
                            "nombre_img" => $nombre_img
                                );
                        $data_string = json_encode($data);
                        $ch = curl_init(RUTAWS.'inventarios/actualizar_inventario.php');
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
                        //fin realizo actualización
                    } else {
                        echo "error";
                    }
                    //echo "-->".$img_ant."<br>";
                }
                //Fin Consulto los campos por id para comparar los que hubo cambios
            }         
            redirect('/inventarios_controller/mostrarInventarios');
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function muestraMovIndividual($idArticulo) {
        if ($this->is_logged_in()){
            //obtiene articulo
            $url = RUTAWS.'inventarios/obtener_inventario_por_id.php?idArticulo='.$idArticulo;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            curl_close($ch);
            $articulo = $datos->{'inventario'}->{'descripcion'};
            //fin obtiene articulo

            //Obtiene movimiento por id
            # An HTTP GET request example
            $url = RUTAWS.'movimientos/obtener_movimiento_por_idArticulo.php?idArticulo='.$idArticulo;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            //printf("%s",$data);
            curl_close($ch);

            if ($datos->{'estado'}==1) {
                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                $fechaIngreso = $dt->format("Y-m-d H:i:s"); //'articulo'=>$datos->{'inventarios'},
                $data = array('articulo' => $articulo,
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'movimientos'=>$datos->{'movimientos'},
                    'permisos' => $this->session->userdata('permisos'),
                    'opcionClickeada' => '1'
                        );
                $this->load->view('layouts/header_view',$data);
                $this->load->view('inventarios/movimientosArticulo_view',$data);
                $this->load->view('layouts/pie_view',$data);
            } else {
                echo "error";
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function inventarioManual($idArticulo) {
        if ($this->is_logged_in()){
            //Obtiene producto por id
            # An HTTP GET request example
            $url = RUTAWS.'inventarios/obtener_inventario_por_id.php?idArticulo='.$idArticulo;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            curl_close($ch);
            if ($datos->{'estado'}==1) {
                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
                $data = array('inventario'=>$datos->{'inventario'},
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'proveedores' => $this->proveedoresGlobal,
                    'categorias' => $this->categoriasGlobal,
                    'sucursales' => $this->sucursalesGlobal,
                    'ivaEmpresa' => $this->ivaEmpresaGlobal,
                    'permisos' => $this->session->userdata('permisos'),
                    'opcionClickeada' => '1'
                        );
                $this->load->view('layouts/header_view',$data);
                $this->load->view('inventarios/inventarioManual_view',$data);
                $this->load->view('layouts/pie_view',$data);
            } else {
                echo "error";
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function actualizarInventarioManualFromFormulario(){
        if ($this->is_logged_in()){
            $idUsuario = $this->session->userdata('idUsuario');
            $idArticulo = $this->input->post("idArticulo");
            $operacion = $this->input->post("modoOperacion");
            $cantidad = $this->input->post("existencia");
            $tipoOperacionTexto = "Manual Aumento";
            if ($operacion==2) {
                $cantidad = $cantidad * -1;
                $tipoOperacionTexto = "Manual Disminución";
            }
    //        echo "-->".$idArticulo."-->".$operacion."-->".$cantidad;
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaMovimiento = $dt->format("Y-m-d H:i:s"); 
            // Alteracion en el inventario segun el tipo de operacion
                //Obtiene producto por id
            # An HTTP GET request example
            $url = RUTAWS.'inventarios/obtener_inventario_por_id.php?idArticulo='.$idArticulo;
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
            //$datosProd->{'inventario'}->{'existencia'} = $existencuaInventario;
            $data = array("idArticulo" => $idArticulo,
                "existencia" => $existencuaInventario
                    );
            $data_string = json_encode($data);
            $ch = curl_init(RUTAWS.'inventarios/ajusta_inventario.php');
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

            //Llamado de WS de registro de movimientos tabla movimientos
            $dataMovimiento = array(
                "idArticulo" => $idArticulo, 
                "idUsuario" => $idUsuario, 
                "tipoOperacion" => $tipoOperacionTexto,
                "cantidad" => $cantidad, 
                "fechaOperacion" => $fechaMovimiento
                    );
            $data_string = json_encode($dataMovimiento);  
            unset($dataDetalleVenta);
            //Fin Arma nuevo json solo con el detalle actual y datos necesarios
            //LLamado de WS de registro de movimientos tabla movimientos
            $ch = curl_init(RUTAWS.'movimientos/insertar_movimiento.php');
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
            $resultM = curl_exec($ch);
            //close connection
            //printf("%s",$result);
            curl_close($ch);
            //Fin Llamado de WS de registro de movimientos tabla movimientos

            $resultado = json_decode($resultM, true);
            if ($resultado['estado']==1) {
                $this->session->set_flashdata('correcto', "Actualización Exitosa <br>");
            } else {
                $this->session->set_flashdata('correcto', "Error. No se actualizó el registro <br>");
            }        

            //Fin llamado WS
            redirect('/inventarios_controller/mostrarInventarios');
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function detalleArticulo($idArticulo) {
        if ($this->is_logged_in()){
            //Obtiene producto por id
            # An HTTP GET request example
            $url = RUTAWS.'inventarios/obtener_inventario_por_id.php?idArticulo='.$idArticulo;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            curl_close($ch);
            if ($datos->{'estado'}==1) {
                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
                $data = array('inventario'=>$datos->{'inventario'},
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'proveedores' => $this->proveedoresGlobal,
                    'categorias' => $this->categoriasGlobal,
                    'sucursales' => $this->sucursalesGlobal,
                    'ivaEmpresa' => $this->ivaEmpresaGlobal,
                    'permisos' => $this->session->userdata('permisos'),
                    'opcionClickeada' => '1'
                        );
                $this->load->view('layouts/header_view',$data);
                $this->load->view('inventarios/detalleArticulo_view',$data);
                $this->load->view('layouts/pie_view',$data);
            } else {
                echo "error";
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function generaCodigoBarras($codigo,$descripcion) {
        if ($this->is_logged_in()){
            $result = array();
            $result[] = array('name' =>$descripcion, 'id'=> $codigo);
            $data['items'] = $result;
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array('items'=>$result,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '1'
                    );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('inventarios/barcode_sheet',$data);
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

