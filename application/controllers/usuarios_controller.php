<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios_controller extends CI_Controller {
    private $datosEmpresaGlobal;
    private $nombreEmpresaGlobal;
    
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
        $this->nombreEmpresaGlobal = $this->datosEmpresaGlobal[0]->{'nombreEmpresa'};
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

    function index(){
        $this->load->view('login_view');
    }
    
    function inicio() {
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        $data = array(
                'permisos'=>$this->session->userdata('permisos'),
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'opcionClickeada' => '0'
            );
        $this->load->view('layouts/header_view',$data);
        $this->load->view('principal_view',$data);
        $this->load->view('layouts/pie_view',$data);
    }
    
    function verificaUsuario() {
        //Llamada a Webservices de Usuarios
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/usuarios/verifica_usuario.php?usuario='.$_POST['usuario'].'&clave='.$_POST['clave'];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        if ($datos->{'estado'}==1) {
            //separa campos
            $i=1;
            foreach($datos->{'usuario'} as $fila) {
                switch ($i) {
                    case 1: $idUsuario = $fila; break;
                    case 2: $usuario = $fila; break;
                    case 3: $clave = $fila; break;
                    case 4: $permisos = $fila; break;
                    case 5: $nombre = $fila; break;
                    case 6: $apellido_paterno = $fila; break;
                    case 7: $apellido_materno = $fila; break;
                    case 8: $telefono_casa = $fila; break;
                    case 9: $telefono_celular = $fila; break;
                }
                $i++;
            }
            //fin separa campos
            
            //crea campos de sesion
            $this->session->set_userdata('nombre', $nombre." ".$apellido_paterno." ".$apellido_materno);
            $this->session->set_userdata('permisos', $permisos);
            $this->session->set_userdata('usuario', $usuario);					
            $this->session->set_userdata('clave', $clave);					
            $this->session->set_userdata('idUsuario', $idUsuario);
            
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            
            //fin crea campos de sesion
            $data = array('idUsuario'=>$idUsuario,
                    'usuario'=>$usuario,'clave'=>$clave,
                    'permisos'=>$permisos,'nombre'=>$nombre,
                    'apellido_paterno'=>$apellido_paterno,
                    'apellido_materno'=>$apellido_materno,
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'telefono_casa' => $telefono_casa,
                    'telefono_celular' => $telefono_celular,
                    'fecha' => $fechaIngreso,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'opcionClickeada' => '0'
                );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('principal_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            $data = array('error'=>'1');
            //$this->load->view('login_view',$data);
            redirect($this->index(),$data);
        }
    }
    
    function mostrarUsuarios() {
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/usuarios/obtener_usuarios.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        $usuarios;
        $i=0;
        $data;
        $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal);
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        
        if ($datos->{'estado'}==1) {
            $data = array('usuarios'=>$datos->{'usuarios'},
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '7'
                    );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('usuarios/adminUsers_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            $this->load->view('layouts/header_view',$data);
            $this->load->view('principal_view',$data);
            $this->load->view('layouts/pie_view',$data);
        }
    }
    
    function actualizarUsuario($idUsuario) {
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        //Obtiene usuario por id
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/usuarios/obtener_usuario_por_id.php?idUsuario='.$idUsuario;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        if ($datos->{'estado'}==1) {
            $data = array('usuario'=>$datos->{'usuario'},'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '7'
                    );
            $this->load->view('layouts/header_view',$data);
            $this->load->view('usuarios/actualizaUsuario_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            echo "error";
        }
    }

    function actualizarUsuarioFromFormulario()
    {
        if ($this->input->post('submit')){
            //procesado de permisos de usuario
            $permisosUsuarioLocal = "";
            //inventario
            if ($this->input->post('chkInventario')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //ventas
            if ($this->input->post('chkVentas')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Compras
            if ($this->input->post('chkCompras')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Consultas
            if ($this->input->post('chkConsultas')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Proveedores
            if ($this->input->post('chkProveedores')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Clientes
            if ($this->input->post('chkClientes')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Empleados
            if ($this->input->post('chkEmpleados')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Configuracion
            if ($this->input->post('chkConfiguracion')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //fin procesado de permisos de usuario
            
            //LLamadfo de WS
            $idUsuario = $this->input->post("idUsuario");
            $usuario = $this->input->post("usuario");
            $clave = md5($this->input->post("clave"));
            $permisos = $permisosUsuarioLocal;
            $nombre = $this->input->post("nombre");
            $apellido_paterno = $this->input->post("apellido_paterno");
            $apellido_materno = $this->input->post("apellido_materno");
            $telefono_casa = $this->input->post("telefono_casa");
            $telefono_celular = $this->input->post("telefono_celular");
            
            $data = array("idUsuario" => $idUsuario, 
                "usuario" => $usuario, 
                "clave" => $clave, 
                "permisos" => $permisos, 
                "nombre" => $nombre, 
                "apellido_paterno" => $apellido_paterno, 
                "apellido_materno" => $apellido_materno, 
                "telefono_casa" => $telefono_casa, 
                "telefono_celular" => $telefono_celular
                    );
            $data_string = json_encode($data);
            $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/usuarios/actualizar_usuario.php');
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
            $this->session->set_flashdata('correcto', 'Empleado modificado correctamente!');
            redirect('/usuarios_controller/mostrarUsuarios');
        }
    }

    function eliminarUsuario($idUsuario) {
        $data = array("idUsuario" => $idUsuario);
        $data_string = json_encode($data);
        $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/usuarios/borrar_usuario.php');
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
        //echo $result;

        //Fin llamado WS
        $this->session->set_flashdata('correcto', 'Empleado eliminado correctamente!');
        redirect('/usuarios_controller/mostrarUsuarios');
    }
    
    function nuevoUsuario() {
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
            'usuarioDatos' => $this->session->userdata('nombre'),
            'fecha' => $fechaIngreso,
            'permisos' => $this->session->userdata('permisos'),
            'opcionClickeada' => '7'
            );
        $this->load->view('layouts/header_view',$data);
        $this->load->view('usuarios/nuevoUsuario_view',$data);
        $this->load->view('layouts/pie_view',$data);
    }

    function nuevoUsuarioFromFormulario()
    {
        if ($this->input->post('submit')){
            //procesado de permisos de usuario
            $permisosUsuarioLocal = "";
            //inventario
            if ($this->input->post('chkInventario')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //ventas
            if ($this->input->post('chkVentas')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Compras
            if ($this->input->post('chkCompras')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Consultas
            if ($this->input->post('chkConsultas')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Proveedores
            if ($this->input->post('chkProveedores')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Clientes
            if ($this->input->post('chkClientes')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Empleados
            if ($this->input->post('chkEmpleados')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //Configuracion
            if ($this->input->post('chkConfiguracion')=="on") {
                $permisosUsuarioLocal = $permisosUsuarioLocal."1";
            } else {
                $permisosUsuarioLocal = $permisosUsuarioLocal."0";
            }
            //fin procesado de permisos de usuario
            
            //LLamadfo de WS
            $idUsuario = $this->input->post("idUsuario");
            $usuario = $this->input->post("usuario");
            $clave = md5($this->input->post("clave"));
            $permisos = $permisosUsuarioLocal;
            $nombre = $this->input->post("nombre");
            $apellido_paterno = $this->input->post("apellido_paterno");
            $apellido_materno = $this->input->post("apellido_materno");
            $telefono_casa = $this->input->post("telefono_casa");
            $telefono_celular = $this->input->post("telefono_celular");
            
            $data = array("idUsuario" => $idUsuario, 
                "usuario" => $usuario, 
                "clave" => $clave, 
                "permisos" => $permisos, 
                "nombre" => $nombre, 
                "apellido_paterno" => $apellido_paterno, 
                "apellido_materno" => $apellido_materno, 
                "telefono_casa" => $telefono_casa, 
                "telefono_celular" => $telefono_celular
                    );
            $data_string = json_encode($data);
            $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/usuarios/insertar_usuario.php');
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
            $this->session->set_flashdata('correcto', 'Empleado registrado correctamente!');
            redirect('/usuarios_controller/mostrarUsuarios');
        }
    }
    //Fin llamada a webservices de usuarios
    
    //Importar desde Excel con libreria de PHPExcel
    public function importarUsersExcel(){
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
            'usuarioDatos' => $this->session->userdata('nombre'),
            'fecha' => $fechaIngreso,
            'permisos' => $this->session->userdata('permisos'),
            'opcionClickeada' => '7'
            );
        $this->load->view('layouts/header_view',$data);
        $this->load->view('usuarios/importarUsersFromExcel_view',$data);
        $this->load->view('layouts/pie_view',$data);
    }        

    //Importar desde Excel con libreria de PHPExcel
    public function importarExcel(){
        //Cargar PHPExcel library
        $this->load->library('excel');
        $name   = $_FILES['excel']['name'];
        $tname  = $_FILES['excel']['tmp_name'];
        $obj_excel = PHPExcel_IOFactory::load($tname);       
        $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
        $arr_datos = array();
        foreach ($sheetData as $index => $value) {            
            if ( $index != 1 ){
                $arr_datos = array(
                        'usuario' => $value['A'],
                        'clave' => $value['B'],
                        'permisos' => $value['C'],
                        'nombre' => $value['D'],
                        'apellido_paterno' => $value['E'],
                        'apellido_materno' => $value['F'],
                        'telefono_casa' => $value['G'],
                        'telefono_celular' => $value['H']
                ); 
                foreach ($arr_datos as $llave => $valor) {
                    $arr_datos[$llave] = $valor;
                }
                //$this->db->insert('usuarios',$arr_datos);
                
                //Llamada de ws para insertar
                $data_string = json_encode($arr_datos);
                $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/usuarios/insertar_usuario.php');
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
                //echo $result;
            } 
        }
        $this->session->set_flashdata('correcto', 'Importación realizada exitosamente!');
        redirect('/usuarios_controller/mostrarUsuarios');
    }        
    //Fin Importar desde Excel con libreria de PHPExcel
    
    //Exportar datos a Excel
    public function exportarExcel(){
        //llamadod de ws
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/usuarios/obtener_usuarios.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        //fin llamado de ws
        $id=$this->uri->segment(3);
//        $nilai=$this->login_model->obtieneUsuarios();
        $nilai=$datos->{'usuarios'};
//        if (isset($datos->{'usuarios'})) {
//            foreach($nilai as $h){
//                echo "azul";
//            }
//        }
        $totn = 0;
        foreach($nilai as $h){
            $totn = $totn + 1;
        }
        $heading=array('USUARIO','CLAVE','PERMISOS','NOMBRE','AP.PATERNO','AP.MATERNO','TEL.CASA','CELULAR');
        $this->load->library('excel');
        //Create a new Object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle("Empleados");
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
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n->{'usuario'});
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,"1");
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n->{'permisos'});
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n->{'nombre'});
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n->{'apellido_paterno'});
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n->{'apellido_materno'});
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n->{'telefono_casa'});
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$n->{'telefono_celular'});
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:H'.$maxrow)->applyFromArray($styleArray);
        //Save as an Excel BIFF (xls) file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Empleados.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit();
    }	
    //fin exportar a excel
    
    // Manejo de sesiones
    function cerrarSesion() {            
            if ($this->sistema_model->logout()) {
                $data = array('error'=>'1');
                redirect($this->index(),$data);
            }
    }
    
    //Fin Manejo de sesiones
    
    
}

