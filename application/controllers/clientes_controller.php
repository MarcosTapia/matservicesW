<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Clientes_controller extends CI_Controller {
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

    function index(){
        $this->load->view('login_view');
    }
    
    function regresa() {
        echo "error";
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
    
    function mostrarClientes() {
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/clientes/obtener_clientes.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        $proveedores;
        $i=0;
        $data;
        $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal);
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        if ($datos->{'estado'}==1) {
            $data = array('clientes'=>$datos->{'clientes'},
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'permisos' => $this->session->userdata('permisos'));
            $this->load->view('layouts/header_view',$data);
            $this->load->view('clientes/adminClientes_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            $this->load->view('layouts/header_view',$data);
            $this->load->view('principal_view',$data);
            $this->load->view('layouts/pie_view',$data);
        }
    }
    
    function actualizarCliente($idCliente) {
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        //Obtiene usuario por id
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/clientes/obtener_cliente_por_id.php?idCliente='.$idCliente;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        if ($datos->{'estado'}==1) {
            $data = array('cliente'=>$datos->{'cliente'},'nombre_Empresa'=>$this->nombreEmpresaGlobal,
            'usuarioDatos' => $this->session->userdata('nombre'),
            'fecha' => $fechaIngreso,
                'permisos' => $this->session->userdata('permisos'));
            $this->load->view('layouts/header_view',$data);
            $this->load->view('clientes/actualizaCliente_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            echo "error";
        }
    }

    function actualizarClientesFromFormulario()
    {
        if ($this->input->post('submit')){
            //LLamadfo de WS
            $idCliente = $this->input->post("idCliente");
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
            
            $data = array("idCliente" => $idCliente, 
                "empresa" => $empresa, 
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
            $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/clientes/actualizar_cliente.php');
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
            redirect('/clientes_controller/mostrarClientes');
        }
    }

    function eliminarCliente($idCliente) {
        $data = array("idCliente" => $idCliente);
        $data_string = json_encode($data);
        $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/clientes/borrar_cliente.php');
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
        redirect('/clientes_controller/mostrarClientes');
    }
    
    function nuevoCliente() {
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
            'usuarioDatos' => $this->session->userdata('nombre'),
            'fecha' => $fechaIngreso,
            'permisos' => $this->session->userdata('permisos'));
        $this->load->view('layouts/header_view',$data);
        $this->load->view('clientes/nuevoCliente_view',$data);
        $this->load->view('layouts/pie_view',$data);
    }

    function nuevoClienteFromFormulario()
    {
        if ($this->input->post('submit')){
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
            echo $result;
            
            //Fin llamado WS
            redirect('/clientes_controller/mostrarClientes');
        }
    }
    //Fin llamada a webservices de clientes
    
    //Importar desde Excel con libreria de PHPExcel
    public function importarClientesExcel(){
        $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
        $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
        $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal,
            'usuarioDatos' => $this->session->userdata('nombre'),
            'fecha' => $fechaIngreso,
            'permisos' => $this->session->userdata('permisos'));
        $this->load->view('layouts/header_view',$data);
        $this->load->view('clientes/importarClientesFromExcel_view',$data);
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
                        'empresa' => $value['A'],
                        'nombre' => $value['B'],
                        'apellidos' => $value['C'],
                        'telefono_casa' => $value['D'],
                        'telefono_celular' => $value['E'],
                        'direccion1' => $value['F'],
                        'direccion2' => $value['G'],
                        'rfc' => $value['H'],
                        'email' => $value['I'],
                        'ciudad' => $value['J'],
                        'estado' => $value['K'],
                        'cp' => $value['L'],
                        'pais' => $value['M'],
                        'comentarios' => $value['N'],
                        'noCuenta' => $value['O']
                ); 
                foreach ($arr_datos as $llave => $valor) {
                    $arr_datos[$llave] = $valor;
                }
                //$this->db->insert('usuarios',$arr_datos);
                
                //Llamada de ws para insertar
                $data_string = json_encode($arr_datos);
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
                //echo $result;
            } 
        }
        $this->mostrarClientes();
    }        
    //Fin Importar desde Excel con libreria de PHPExcel
    
    //Exportar datos a Excel
    public function exportarClienteExcel(){
        //llamadod de ws
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/clientes/obtener_clientes.php';
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
        $nilai=$datos->{'clientes'};
//        if (isset($datos->{'usuarios'})) {
//            foreach($nilai as $h){
//                echo "azul";
//            }
//        }
        $totn = 0;
        foreach($nilai as $h){
            $totn = $totn + 1;
        }
        $heading=array('Empresa','Nombre','Apellidos','Telefono_casa',
            'Telefono_celular','Direccion1','Direccion2','RFC',
            'Email','Ciudad','Estado','CP','País','Comentarios','No. Cuenta');
        $this->load->library('excel');
        //Create a new Object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle("Clientes");

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
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n->{'empresa'});
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n->{'nombre'});
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n->{'apellidos'});
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n->{'telefono_casa'});
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n->{'telefono_celular'});
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n->{'direccion1'});
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n->{'direccion2'});
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$n->{'rfc'});
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$n->{'email'});
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$n->{'ciudad'});
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$row,$n->{'estado'});
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$row,$n->{'cp'});
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$row,$n->{'pais'});
            $objPHPExcel->getActiveSheet()->setCellValue('N'.$row,$n->{'comentarios'});
            $objPHPExcel->getActiveSheet()->setCellValue('O'.$row,$n->{'noCuenta'});
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:O'.$maxrow)->applyFromArray($styleArray);
        //Save as an Excel BIFF (xls) file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Clientes.xls"');
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

