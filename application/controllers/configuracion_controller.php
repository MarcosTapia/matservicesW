<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Configuracion_controller extends CI_Controller {
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
        $this->load->view('login_view');
    }
    
    function regresa() {
        echo "error";
    }

    function mostrarValores() {
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
        $data;
        $data = array('nombre_Empresa'=>'checar despues');
        $data = array('categorias'=>$datos->{'categorias'},'nombre_Empresa'=>'checar despues',
            'permisos' => $this->session->userdata('permisos'));
        //Fin muestra valores de categorias
        
        
        $this->load->view('layouts/header_view',$data);
        $this->load->view('configuracion/adminConfiguracion_view',$data);
        $this->load->view('layouts/pie_view',$data);
    }
    
    function actualizarCategoria($idCategoria) {
        //Obtiene categoria por id
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/categorias/obtener_categoria_por_id.php?idCategoria='.$idCategoria;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        if ($datos->{'estado'}==1) {
            $data = array('categoria'=>$datos->{'categoria'},'nombre_Empresa'=>'checar despues',
                'permisos' => $this->session->userdata('permisos'));
            $this->load->view('layouts/header_view',$data);
            $this->load->view('configuracion/actualizaCategoria_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            echo "error";
        }
    }

    function actualizarCategoriaFromFormulario(){
        if ($this->input->post('submit')){
            //LLamadfo de WS
            $idCategoria = $this->input->post("idCategoria");
            $descripcionCategoria = $this->input->post("descripcionCategoria");
            
            $data = array("idCategoria" => $idCategoria, 
                "descripcionCategoria" => $descripcionCategoria);
            $data_string = json_encode($data);
            $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/categorias/actualizar_categoria.php');
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
            redirect('/configuracion_controller/mostrarValores');
        }
    }

    function eliminarCategoria($idCategoria) {
        $data = array("idCategoria" => $idCategoria);
        $data_string = json_encode($data);
        $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/categorias/borrar_categoria.php');
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
//            redirect('contenido4');
        redirect('/configuracion_controller/mostrarValores');
    }
    
    function nuevoCategoria() {
        $data = array('nombre_Empresa'=>'checar despues',
            'permisos' => $this->session->userdata('permisos'));
        $this->load->view('layouts/header_view',$data);
        $this->load->view('configuracion/nuevoCategoria_view',$data);
        $this->load->view('layouts/pie_view',$data);
    }

    function nuevoCategoriaFromFormulario(){
        if ($this->input->post('submit')){
            //LLamadfo de WS
            $descripcionCategoria = $this->input->post("descripcionCategoria");
            
            $data = array("descripcionCategoria" => $descripcionCategoria);
            $data_string = json_encode($data);
            $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/categorias/insertar_categoria.php');
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
//            redirect('contenido4');
            redirect('/configuracion_controller/mostrarValores');
        }
    }
    //Fin llamada a webservices de usuarios
    
    //Importar desde Excel con libreria de PHPExcel
    public function importarCategoriasExcel(){
        $data = array('nombre_Empresa'=>'checar despues',
            'permisos' => $this->session->userdata('permisos'));
        $this->load->view('layouts/header_view',$data);
        $this->load->view('configuracion/importarCategoriasFromExcel_view',$data);
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
                        'descripcionCategoria' => $value['A']
                ); 
                foreach ($arr_datos as $llave => $valor) {
                    $arr_datos[$llave] = $valor;
                }
                //$this->db->insert('usuarios',$arr_datos);
                
                //Llamada de ws para insertar
                $data_string = json_encode($arr_datos);
                $ch = curl_init('http://localhost/matserviceswsok/matservsthread1/categorias/insertar_categoria.php');
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
        $this->mostrarValores();
    }        
    //Fin Importar desde Excel con libreria de PHPExcel
    
    //Exportar datos a Excel
    public function exportarProveedorExcel(){
        //llamadod de ws
        # An HTTP GET request example
        $url = 'http://localhost/matserviceswsok/matservsthread1/proveedores/obtener_proveedores.php';
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
        $nilai=$datos->{'proveedores'};
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
        $objPHPExcel->getActiveSheet()->setTitle("Proveedores");

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
        header('Content-Disposition: attachment;filename="Proveedores.xls"');
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

