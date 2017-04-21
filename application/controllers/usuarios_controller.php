<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios_controller extends CI_Controller {
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
    }

    function index(){
        //$this->load->view('contenido1_view');
    }
    
    function regresa() {
        echo "error";
    }
    
    function verificaUsuario() {
        //Llamada a Webservices de Usuarios
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/usuarios/verifica_usuario.php?usuario='.$_POST['usuario'].'&clave='.$_POST['clave'];
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
                    case 2: $matricula = $fila; break;
                    case 3: $usuario = $fila; break;
                    case 4: $clave = $fila; break;
                    case 5: $permisos = $fila; break;
                    case 6: $nombre = $fila; break;
                    case 7: $apellido_paterno = $fila; break;
                    case 8: $apellido_materno = $fila; break;
                    case 9: $telefono_casa = $fila; break;
                    case 10: $telefono_celular = $fila; break;
                }
                $i++;
            }
            //fin separa campos
            $data = array('idUsuario'=>$idUsuario,'matricula'=>$matricula,
                    'usuario'=>$usuario,'clave'=>$clave,
                    'permisos'=>$permisos,'nombre'=>$nombre,
                    'apellido_paterno'=>$apellido_paterno,
                    'apellido_materno'=>$apellido_materno,
                    'telefono_casa' => $telefono_casa,
                    'telefono_celular' => $telefono_celular,
                    'nombre_Empresa'=>'checar despues'
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
        $url = 'http://localhost/webservicesok/obtener_alumnos.php';
        $url = 'http://localhost/matserviceswsok/usuarios/verifica_usuario.php?usuario='.$_POST['usuario'].'&clave='.$_POST['clave'];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        //echo $data;
        echo $datos->{'estado'};
        if ($datos->{'estado'}==1) {
            foreach($datos->{'alumnos'} as $fila) {
                echo $fila->{'idalumno'}."--".$fila->{'nombre'}."--".$fila->{'direccion'}."<br>";
            }
        } else {
            echo "error";
        }
    }
    
    //Fin llamada a webservices de usuarios
}

