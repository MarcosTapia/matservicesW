<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Principal_controller extends CI_Controller {
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
        $this->load->view('contenido1_view');
    }
    
    //para subir imagen
    function do_upload(){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for($i=0; $i<$cpt; $i++){
            $_FILES['userfile']['name']		= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']		= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']	= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']	= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']		= $files['userfile']['size'][$i];    

                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload();

                $upload_data 	= $this->upload->data();
                        $file_name 	=   $upload_data['file_name'];
                        $file_type 	=   $upload_data['file_type'];
                        $file_size 	=   $upload_data['file_size'];

                // Output control
                            $data['getfiledata_file_name'] = $file_name;
                            $data['getfiledata_file_type'] = $file_type;
                            $data['getfiledata_file_size'] = $file_size;
            // Insert Data for current file
                $this->mupload_model->insertNotices($form_input_Data);

            //Create a view containing just the text "Uploaded successfully"
                    $this->load->view('upload_success', $data);

        }
    }
    //fin para subir imagen
    
    private function set_upload_options(){   
            //  upload an image options
        $config = array();
        $config['upload_path'] = './fileselif/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;


        return $config;
    }    
    
    // Para los webservices
    function obtener_alumno_por_id($idAlumno) {
//        $data = array('alumno' => $this->sistema_model->obtieneAlumnoPorId($idAlumno));           
        $retorno = $this->sistema_model->obtieneAlumnoPorId($idAlumno);
        if ($retorno) {
            $alumno["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $alumno["alumno"] = $retorno;
            // Enviar objeto json del alumno
            print json_encode($alumno);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }        
    }
    
    function obtenerAlumnos() {
        $retorno = $this->sistema_model->obtieneAlumnos();
        if ($retorno) {
            $alumno["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $alumno["alumno"] = $retorno;
            // Enviar objeto json del alumno
            print json_encode($alumno);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }        
    }
    
    function insertarAlumno() {
        // Decodificando formato Json
        $body = json_decode(file_get_contents("php://input"), true);
        //solo para pruebas        
        //$myObj = array('nombre' => "marcos2",'direccion' => "juarez 152");
        //$bodyTemp = json_encode($myObj);
        //$body = json_decode($bodyTemp, true);
        //echo $bodyTemp;
        //echo "<br>*** : ".$body['nombre'];
        //echo "<br>*** : ".$body['direccion'];
        //fin solo para pruebas        
        // Insertar Alumno
        $retorno = $this->sistema_model->insertarAlumno($body['nombre'],
                   $body['direccion']);
        if ($retorno) {
            $json_string = json_encode(array("estado" => 1,"mensaje" => "Creacion correcta"));
                    echo $json_string;
        } else {
            $json_string = json_encode(array("estado" => 2,"mensaje" => "No se creo el registro"));
                    echo $json_string;
        }
    }
    
    function borrarAlumno($idAlumno) {
        // Decodificando formato Json
        $body = json_decode(file_get_contents("php://input"), true);
        //solo para pruebas        
//        $myObj = array('idalumno' => "11");
//        $bodyTemp = json_encode($myObj);
//        $body = json_decode($bodyTemp, true);
//        echo $bodyTemp;
//        echo "<br>*** : ".$body['nombre'];
//        echo "<br>*** : ".$body['direccion'];
        //fin solo para pruebas        

        $retorno = $this->sistema_model->borrarAlumno($body['idalumno']);
        if ($retorno) {
            $json_string = json_encode(array("estado" => 1,"mensaje" => "Eliminacion exitosa"));
                    echo $json_string;
        } else {
            $json_string = json_encode(array("estado" => 2,"mensaje" => "No se elimino el registro"));
                    echo $json_string;
        }
    } 

    function actualizarAlumno() {
        // Decodificando formato Json
        $body = json_decode(file_get_contents("php://input"), true);
        //solo para pruebas        
//        $myObj = array('idalumno' => "3", 'nombre' => "antonio",'direccion' => "j1");
//        $bodyTemp = json_encode($myObj);
//        $body = json_decode($bodyTemp, true);
//        echo $bodyTemp;
//        echo "<br>*** : ".$body['nombre'];
//        echo "<br>*** : ".$body['direccion'];
//        fin solo para pruebas        
        // Insertar Alumno
        $retorno = $this->sistema_model->actualizarAlumno($body['idalumno'], $body['nombre'],
                   $body['direccion']);
        if ($retorno) {
            $json_string = json_encode(array("estado" => 1,"mensaje" => "Actualizacion correcta"));
                    echo $json_string;
        } else {
            $json_string = json_encode(array("estado" => 2,"mensaje" => "No se actualizo el registro"));
                    echo $json_string;
        }
    }
    // Fin Para los webservices

    function contenido1() {        
        $data = array('error'=>$this->error,'nombre_Empresa' => "Edgar",'nombre' => "Aragon",'formaTrabajo' => "1",'opcion' => "1",'permisos' => "11111");
        $this->load->view('layouts/header_view',$data);
        $this->load->view('contenido1_view');
        $this->load->view('layouts/pie_view');
    }
    
    function contenido2() {        
        $this->nombre_Usuario = $this->session->userdata('nombre');
        //$matricula = $this->session->userdata('matricula');
        $idUsuario = $this->session->userdata('idUsuario');		
        $usuarioTemp = 'a';
        $claseEncargados = 2;
        $claseDespachadores = 3;
        $data = array('error'=>$this->error,'nombre_Empresa' => "Edgar",'nombre' => "Aragon"
                ,'formaTrabajo' => "1",'opcion' => "1",'permisos' => "11111"
                ,'usuarios' => $this->sistema_model->obtieneEncargadosDespachadores()
                ,'despachadores' => $this->sistema_model->obtieneDespachadores() 
                , 'matricula' => 1, 'permisos' => '1111111111111'
                , 'entregas' => $this->sistema_model->consultaValores()
                , 'consultaEntregasDespachadores' => $this->sistema_model->consultaEntregasDespachadoresGeneral()
                );
        $this->load->view('layouts/header_view',$data);
        $this->load->view('consultasSistema_view');
        $this->load->view('layouts/pie_view');
    }

    function crudGeneral() {
        $this->nombre_Usuario = $this->session->userdata('nombre');
        //$matricula = $this->session->userdata('matricula');
        $idUsuario = $this->session->userdata('idUsuario');		
        $usuarioTemp = 'a';
        $claseEncargados = 2;
        $claseDespachadores = 3;
        $data = array('error'=>$this->error,'nombre_Empresa' => "Edgar",'nombre' => "Aragon"
                ,'formaTrabajo' => "1",'opcion' => "1",'permisos' => "11111"
                ,'usuarios' => $this->sistema_model->obtieneEncargadosDespachadores()
                ,'despachadores' => $this->sistema_model->obtieneDespachadores() 
                , 'matricula' => 1, 'permisos' => '1111111111111'
                , 'entregas' => $this->sistema_model->consultaValores()
                , 'consultaEntregasDespachadores' => $this->sistema_model->consultaEntregasDespachadores()
                );
        $this->load->view('layouts/header_view',$data);
        $this->load->view('configurarSistema_view',$data);
        $this->load->view('layouts/pie_view');
        $this->error = "";
    }

    function contenido4() {
        $this->nombre_Usuario = $this->session->userdata('nombre');
        //$matricula = $this->session->userdata('matricula');
        $idUsuario = $this->session->userdata('idUsuario');		
        $usuarioTemp = 'a';
        $claseEncargados = 2;
        $claseDespachadores = 3;
        $data = array('error'=>$this->error,'nombre_Empresa' => "Edgar",'nombre' => "Aragon"
                ,'formaTrabajo' => "1",'opcion' => "1",'permisos' => "11111"
                , 'encargados' => $this->sistema_model->obtieneUsuariosPorClase($claseEncargados)
                , 'despachadores' => $this->sistema_model->obtieneDespachadores()
                , 'matricula' => 1, 'permisos' => '1111111111111'
                , 'entregas' => $this->sistema_model->consultaValores()
                );
        $this->load->view('layouts/header_view',$data);
        $this->load->view('encargados/adminUsers_view');
        $this->load->view('layouts/pie_view');
        $this->error = "";
    }
    
    // CRUD Encargados
    function actualizarEncargado($idUsuario) {
        $clase = 2;
        $data = array('error'=>$this->error,'nombre_Empresa' => 'edgar',
                'nombre' => 'edgardf',
                'formaTrabajo'=>1,
                'encargado' => $this->sistema_model->obtieneUsuarioPorId($idUsuario, $clase)
                );          
        $this->load->view('layouts/headerRegresa_view',$data);
        $this->load->view("encargados/actualizaEncargado_view",$data);
        $this->load->view('layouts/pie_view');
    }

    function actualizarEncargadoFromFormulario()
    {
        if ($this->input->post('submit')){
            $resultado=$this->sistema_model->actualizarUsuario(
                            $this->input->post("idUsuario"),
                            $this->input->post('usuario'),
                            $this->input->post('clave'),
                            $this->input->post('clase'),
                            $this->input->post('nombre'),
                            $this->input->post('apellido_paterno'),
                            $this->input->post('apellido_materno'),
                            $this->input->post('telefono_casa'),
                            $this->input->post('telefono_celular'),
                            $this->input->post('estacion'),
                            $this->input->post('turno'),0);
            redirect('contenido4');
        }
    }
    
    function eliminaEncargado($idUsuario) {
        $resultado=$this->sistema_model->eliminaUsuario($idUsuario,2);
        if ($resultado) {
            redirect('contenido4');
        }
    }    
    
    function nuevoEncargado() {
        $clase = 2;
        $data = array('error'=>$this->error,'nombre_Empresa' => 'edgar',
                'nombre' => 'edgardf',
                'formaTrabajo'=>1,$clase
                );                        
        $this->load->view('layouts/header_view',$data);
        $this->load->view("encargados/nuevoEncargado_view",$data);
        $this->load->view('layouts/pie_view');
    } 
    
    function nuevoEncargadoFromFormulario() {
        $dependencia = 0; //0 porque no depende de nadie
        if ($this->input->post('submit')){
            $resultado = $this->sistema_model->nuevoUsuario(
                            $this->input->post('usuario'),
                            $this->input->post('clave'),
                            $this->input->post('nombre'),
                            2,
                            $this->input->post('apellido_paterno'),
                            $this->input->post('apellido_materno'),
                            $this->input->post('telefono_casa'),
                            $this->input->post('telefono_celular'),
                            $this->input->post('estacion'),
                            $this->input->post('turno'),
                            $dependencia
                            );
            redirect('contenido4');
        }
    } 
    
    //Envia a formulario de seleccion de archivo de excel
    public function importarEncargadosDesdeExcel(){
        $this->nombre_Usuario = $this->session->userdata('nombre');
        //$matricula = $this->session->userdata('matricula');
        $idUsuario = $this->session->userdata('idUsuario');		
        $usuarioTemp = 'a';
        $claseEncargados = 2;
        $claseDespachadores = 3;
        $data = array('error'=>$this->error,'nombre_Empresa' => "Edgar",'nombre' => "Aragon"
                ,'formaTrabajo' => "1",'opcion' => "1",'permisos' => "11111"
                , 'encargados' => $this->sistema_model->obtieneUsuariosPorClase($claseEncargados)
                , 'despachadores' => $this->sistema_model->obtieneUsuariosPorClase($claseDespachadores)
                , 'matricula' => 1, 'permisos' => '1111111111111');
        $this->load->view('layouts/header_view',$data);
        $this->load->view('encargados/importarEncargadosFromExcel_view');
        $this->load->view('layouts/pie_view');
    }        
    
    //Importar desde Excel con libreria de PHPExcel  
    public function importarEncargadosExcel(){
        //Cargar PHPExcel library
        $this->load->library('excel');
        $name   = $_FILES['excel']['name'];
        $tname  = $_FILES['excel']['tmp_name'];
        if ($tname=="") {
            $this->error = 'Error, debes seleccionar un archivo';
        } else {
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            foreach ($sheetData as $index => $value) {            
                if ( $index != 1 ){
                    $arr_datos = array(
                            'usuario' => $value['A'],
                            'clave' => $value['B'],
                            'clase' => $value['C'],
                            'nombre' => $value['D'],
                            'apellido_paterno' => $value['E'],
                            'apellido_materno' => $value['F'],
                            'telefono_casa' => $value['G'],
                            'telefono_celular' => $value['H'],
                            'estacion' => $value['I'],
                            'turno_actual' => $value['J'],
                            'dependencia' => $value['J']
                    ); 
                    foreach ($arr_datos as $llave => $valor) {
                        $arr_datos[$llave] = $valor;
                    }
                    $this->db->insert('usuarios',$arr_datos);	
                } 
            }
        }
        redirect('contenido4');
    }        
    
    //Exportar Encargados a Excel
    public function exportarEncargadosExcel(){
        $id=$this->uri->segment(3);
        $nilai=$this->sistema_model->obtieneUsuariosPorClase(2);
        $totn = 0;
        foreach($nilai as $h){
                $totn = $totn + 1;
        }
        $heading=array('USUARIO','NOMBRE','AP.PATERNO','AP.MATERNO','TEL.CASA','CELULAR','ESTACIÓN','TURNO');
        $this->load->library('excel');
        //Create a new Object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle("Encargados");
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
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n['usuario']);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n['nombre']);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n['apellido_paterno']);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n['apellido_materno']);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n['telefono_casa']);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n['telefono_celular']);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n['estacion']);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$n['turno_actual']);
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:H'.$maxrow)->applyFromArray($styleArray);
        //Save as an Excel BIFF (xls) file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Encargados.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit();
    }	
    // FIN CRUD Encargados
    
    // CRUD Despachadores
    function actualizarDespachador($idDespachador) {
        $clase = 3;
        $claseEncargados = 2;
        $despachador = $this->sistema_model->obtieneDespachadorPorId($idDespachador);
        $data = array('error'=>$this->error,'nombre_Empresa' => 'edgar',
                'nombre' => 'edgardf',
                'formaTrabajo'=>1, 
                'encargados' => $this->sistema_model->obtieneUsuariosPorClase($claseEncargados),
                'despachador' => $despachador,
                'encargadoTurno' => $this->sistema_model->obtieneEncargadoPorDependencia($despachador[0]['dependencia'])
                );          
        $this->load->view('layouts/headerRegresa_view',$data);
        $this->load->view("despachadores/actualizaDespachador_view",$data);
        $this->load->view('layouts/pie_view');
    }

    function actualizarDespachadorFromFormulario()
    {
        if ($this->input->post('submit')){
            $clase = 2; //clase de encargado
            $encargado = $this->sistema_model->obtieneUsuarioPorId($this->input->post('selectEncargado'), $clase);
//            echo "--".$encargado[0]['idUsuario'];
            $resultado=$this->sistema_model->actualizarDespachador2(
                            $this->input->post("idDespachador"),
                            '0000',
                            '0000',
                            '3',
                            $this->input->post('nombre'),
                            $this->input->post('apellido_paterno'),
                            $this->input->post('apellido_materno'),
                            $this->input->post('telefono_casa'),
                            $this->input->post('telefono_celular'),
                            $encargado[0]['estacion'],
                            $encargado[0]['turno_actual'],
                            $encargado[0]['idUsuario']);
            redirect('contenido4');
        }
    }
    
    function eliminaDespachador($idDespachador) {
        $resultado=$this->sistema_model->eliminaDespachador($idDespachador);
        if ($resultado) {
            redirect('contenido4');
        }
    }    
    
    function nuevoDespachador() {
        $clase = 2;
        $data = array('error'=>$this->error,'nombre_Empresa' => 'edgar'
                ,'nombre' => 'edgardf'
                , 'encargados' => $this->sistema_model->obtieneUsuariosPorClase($clase)
                ,'formaTrabajo'=>1
                ,$clase
                );                        
        $this->load->view('layouts/header_view',$data);
        $this->load->view("despachadores/nuevoDespachador_view",$data);
        $this->load->view('layouts/pie_view');
    } 
    
    function nuevoDespachadorFromFormulario() {
        if ($this->input->post('submit')){
            $clase = 2; //clase de encargado
            $encargado = $this->sistema_model->obtieneUsuarioPorId($this->input->post('selectEncargado'), $clase);
            $resultado = $this->sistema_model->nuevoDespachador(
                            'Desp',
                            'w4mpd'.$encargado[0]['idUsuario'].'',
                            $this->input->post('nombre'),
                            3,
                            $this->input->post('apellido_paterno'),
                            $this->input->post('apellido_materno'),
                            $this->input->post('telefono_casa'),
                            $this->input->post('telefono_celular'),
                            $encargado[0]['estacion'],
                            $encargado[0]['turno_actual'],
                            $encargado[0]['idUsuario']
                            );
            redirect('contenido4');
        }
    } 
    
    //Envia a formulario de seleccion de archivo de excel
    public function importarDespachadoresDesdeExcel(){
        $this->nombre_Usuario = $this->session->userdata('nombre');
        //$matricula = $this->session->userdata('matricula');
        $idUsuario = $this->session->userdata('idUsuario');		
        $usuarioTemp = 'a';
        $claseEncargados = 2;
        $claseDespachadores = 3;
        $data = array('error'=>$this->error,'nombre_Empresa' => "Edgar",'nombre' => "Aragon"
                ,'formaTrabajo' => "1",'opcion' => "1",'permisos' => "11111"
                , 'encargados' => $this->sistema_model->obtieneUsuariosPorClase($claseEncargados)
                , 'despachadores' => $this->sistema_model->obtieneDespachadores()
                , 'matricula' => 1, 'permisos' => '1111111111111');
        $this->load->view('layouts/header_view',$data);
        $this->load->view('despachadores/importarDespachadores1FromExcel_view');
        $this->load->view('layouts/pie_view');
    }        
    
    //Importar desde Excel con libreria de PHPExcel  
    public function importarDespachadoresExcel(){
        //Cargar PHPExcel library
        $this->load->library('excel');
        $name   = $_FILES['excel']['name'];
        $tname  = $_FILES['excel']['tmp_name'];
        if ($tname=="") {
            $this->error = 'Error, debes seleccionar un archivo';
        } else {
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();            
            foreach ($sheetData as $index => $value) {            
                if ( $index != 1 ){
                    $usuario = '0000000000';
                    $clave = '0000000000';
                    $this->sistema_model->nuevoDespachador($usuario,$clave,
                        $value['A'],3,
                        $value['B'],$value['C'],
                        $value['D'],$value['E'],
                        '','',1);
                } 
            }
        }
        redirect('contenido4');
    }        

    //Exportar Despachadores a Excel
    public function exportarDespachadoresExcel(){
        $id=$this->uri->segment(3);
        $nilai=$this->sistema_model->obtieneDespachadores();
        $totn = 0;
        foreach($nilai as $h){
                $totn = $totn + 1;
        }
        $heading=array('NOMBRE','AP.PATERNO','AP.MATERNO','TEL.CASA','CELULAR','ESTACIÓN','TURNO');
        $this->load->library('excel');
        //Create a new Object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle("Despachadores");
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
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n['nombre']);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n['apellido_paterno']);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n['apellido_materno']);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n['telefono_casa']);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n['telefono_celular']);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n['estacion']);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$n['turno_actual']);
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:G'.$maxrow)->applyFromArray($styleArray);
        //Save as an Excel BIFF (xls) file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        $objPHPExcel->getActiveSheet()->getStyle('A1:G'.$maxrow)->applyFromArray($styleArray);
        //Save as an Excel BIFF (xls) file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Despachadores.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit();
    }	
    
    // FIN CRUD Despachadores
    
    // CRUD VALORES
    function cambiaValores()
    {
        if ($this->input->post('submit')){
            $resultado=$this->sistema_model->actualizarValores(1,
                            $this->input->post('noEntregas'));
            redirect('contenido4');
        }
    }
    
    // FIN CRUD VALORES
    
    //Entregas
    function registraEntrega() {
        if ($this->input->post('submit')){
            $checaEntregado = $this->sistema_model->verificaEntrega($this->input->post('selectDespachador'), $this->input->post('noEntrega'));
            if ($checaEntregado) {
//            echo "bla".$checaEntregado[0][''];
                $this->session->set_flashdata('verifica_entrega','Ya se realizó la entrega');                
            } else {
//            echo "bye";
                $this->sistema_model->registraEntrega($this->input->post('selectDespachador'), $this->input->post('monto'), $this->input->post('noEntrega'));
                $this->session->set_flashdata('verifica_entrega','Entrega Exitosa');                
            }
            redirect('contenido3');
        }
    }
    //Fin Entregas
}

