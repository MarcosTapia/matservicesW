<?php
class Sistema_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }
    
    //Para webservices
    function obtieneAlumnoPorId($idAlumno){
        $consulta = $this->db->get_where('Alumnos',array('idAlumno'=>  $idAlumno));
        return $consulta->result_array();
    }

    function obtieneAlumnos(){
        $consulta = $this->db->get('Alumnos');
        return $consulta->result_array();
    }
    
    //Fin para web services
    
    function verificaUsuario($usuario,$clave){
        $consulta = $this->db->get_where('usuarios',array('usuario'=>$usuario,'clave'=> md5($clave)));
        if ($consulta->num_rows()>0){
			return TRUE;
        } else {
            return FALSE;
        }
    }

    function obtieneUsuario($usuario,$clave){
        $consulta = $this->db->get_where('usuarios',array('usuario'=>$usuario,'clave'=>  md5($clave)));
        return $consulta->result_array();
    }  

    function obtieneUsuarioPorId($idUsuario, $clase){
        $consulta = $this->db->get_where('usuarios',array('idUsuario'=>  $idUsuario,'clase'=>  $clase));
        return $consulta->result_array();
    }
    
    function obtieneEncargadoPorDependencia($dependencia){
        $consulta = $this->db->get_where('usuarios',array('idUsuario'=>  $dependencia));
        return $consulta->result_array();
    }    

    function obtieneDespachadorPorId($idDespachador){
        $consulta = $this->db->get_where('despachadores',array('idDespachador'=>  $idDespachador));
        return $consulta->result_array();
    }
    
    function obtieneUsuariosPorClase($clase){
        $consulta = $this->db->get_where('usuarios',array('clase ='=>  $clase));
        return $consulta->result_array();
    }   

    function obtieneDespachadores(){
        $consulta = $this->db->get('despachadores');
        return $consulta->result_array();
    }   

    function obtieneUsuarios(){
        $consulta = $this->db->get('usuarios');
        return $consulta->result_array();
    }   
    
    function consultaDespachadoresPorEncargado(){
        $consulta = $this->db->get('usuarios');
        return $consulta->result_array();
    }       
    
    function obtieneEncargadosDespachadores(){
//        $this->db->where('idUsuario', $idUsuario);
//        $this->db->where('clase', $clase);
        $consulta = $this->db->get('usuarios');
        return $consulta->result_array();
    }       
    
    function consultaEntregasDespachadores() {
        $consulta = $this->db->query("select u.apellido_paterno as ap_u,u.apellido_materno as am_u,u.nombre as nom_u, 
d.apellido_paterno as ap_d, d.apellido_materno as am_d, d.nombre as nom_d, 
d.estacion as esta_d, d.turno_actual as turnoA_d, e.idEntrega as idEntrega_e, 
e.idDespachador as idDespachador_e, d.idDespachador as idDespachador_d,
u.telefono_casa as telcasa_u, u.telefono_celular as telcelular_u,
d.telefono_casa as telcasa_d, d.telefono_celular as telcelular_d,
e.noEntrega as noEntrega_e, u.idUsuario as idUsuario_u, d.dependencia as dependencia_d,
e.monto as monto_e, e.fechaEntrega as fechaEntrega_e from usuarios
as u inner join despachadores as d on u.idUsuario = d.dependencia
inner join entregas as e on d.idDespachador = e.idDespachador WHERE DATE(e.fechaEntrega) = DATE(NOW())");
        return $consulta->result_array();
    }
    
    function consultaEntregasDespachadoresGeneral() {
        $consulta = $this->db->query("select u.apellido_paterno as ap_u,u.apellido_materno as am_u,u.nombre as nom_u, 
d.apellido_paterno as ap_d, d.apellido_materno as am_d, d.nombre as nom_d, 
d.estacion as esta_d, d.turno_actual as turnoA_d, e.idEntrega as idEntrega_e, 
e.idDespachador as idDespachador_e, d.idDespachador as idDespachador_d,
u.telefono_casa as telcasa_u, u.telefono_celular as telcelular_u,
d.telefono_casa as telcasa_d, d.telefono_celular as telcelular_d,
e.noEntrega as noEntrega_e, u.idUsuario as idUsuario_u, d.dependencia as dependencia_d,
e.monto as monto_e, e.fechaEntrega as fechaEntrega_e from usuarios
as u inner join despachadores as d on u.idUsuario = d.dependencia
inner join entregas as e on d.idDespachador = e.idDespachador");
        return $consulta->result_array();
    }
    
    function actualizarUsuario($idUsuario,$usuario,$clave,$clase,$nombre,
                        $apellido_paterno,$apellido_materno,$telefono_casa,
                        $telefono_celular,$estacion,$turno){
        $data = array(
            'idUsuario' => $idUsuario,
            'usuario' => $usuario,
            'clave' => $clave,
            'nombre'=>$nombre,
            'apellido_paterno'=>$apellido_paterno,
            'apellido_materno'=>$apellido_materno,
            'telefono_casa'=>$telefono_casa,
            'telefono_celular'=>$telefono_celular,
            'estacion'=>$estacion,
            'turno_actual'=>$turno
        );
        $this->db->where('idUsuario',$idUsuario);
        return $this->db->update('usuarios', $data);        
    }       
    
    function actualizarDespachador($idDespachador,$usuario,$clave,$clase,$nombre,
                        $apellido_paterno,$apellido_materno,$telefono_casa,
                        $telefono_celular,$estacion,$turno){
        $data = array(
            'idDespachador' => $idDespachador,
            'usuario' => $usuario,
            'clave' => $clave,
            'nombre'=>$nombre,
            'apellido_paterno'=>$apellido_paterno,
            'apellido_materno'=>$apellido_materno,
            'telefono_casa'=>$telefono_casa,
            'telefono_celular'=>$telefono_celular,
            'estacion'=>$estacion,
            'turno_actual'=>$turno
        );
        $this->db->where('idDespachador',$idDespachador);
        return $this->db->update('despachadores', $data);        
    }       
    
    function actualizarDespachador2($idDespachador,$usuario,$clave,$clase,$nombre,
                        $apellido_paterno,$apellido_materno,$telefono_casa,
                        $telefono_celular,$estacion,$turno,$dependencia){
        $data = array(
            'idDespachador' => $idDespachador,
            'usuario' => $usuario,
            'clave' => $clave,
            'nombre'=>$nombre,
            'apellido_paterno'=>$apellido_paterno,
            'apellido_materno'=>$apellido_materno,
            'telefono_casa'=>$telefono_casa,
            'telefono_celular'=>$telefono_celular,
            'estacion'=>$estacion,
            'turno_actual'=>$turno,
            'dependencia'=>$dependencia
        );
        $this->db->where('idDespachador',$idDespachador);
        return $this->db->update('despachadores', $data);        
    }       
    
    function eliminaUsuario($idUsuario, $clase){
        $this->db->where('idUsuario', $idUsuario);
        $this->db->where('clase', $clase);
        return $this->db->delete('usuarios');         
    }       

    function eliminaDespachador($idDespachador){
        $this->db->where('idDespachador', $idDespachador);
        return $this->db->delete('despachadores');         
    }       
    
    function nuevoUsuario($usuario,$clave,$nombre,$clase,
                        $apellido_paterno,$apellido_materno,$telefono_casa,
                        $telefono_celular,$estacion,$turno,$dependencia){
        $data = array(
            'usuario' => $usuario,
            'clave' => md5($clave),
            'nombre'=>$nombre,
            'clase'  => $clase,
            'apellido_paterno'=>$apellido_paterno,
            'apellido_materno'=>$apellido_materno,
            'telefono_casa'=>$telefono_casa,
            'telefono_celular'=>$telefono_celular,
            'estacion'=>$estacion,
            'turno_actual'=>$turno,
            'dependencia'=>$dependencia
        );
        return $this->db->insert('usuarios', $data);        
    }
    
    function nuevoDespachador($usuario,$clave,$nombre,$clase,
                        $apellido_paterno,$apellido_materno,$telefono_casa,
                        $telefono_celular,$estacion,$turno,$dependencia){
        $data = array(
            'usuario' => $usuario,
            'clave' => md5($clave),
            'nombre'=>$nombre,
            'clase'  => $clase,
            'apellido_paterno'=>$apellido_paterno,
            'apellido_materno'=>$apellido_materno,
            'telefono_casa'=>$telefono_casa,
            'telefono_celular'=>$telefono_celular,
            'estacion'=>$estacion,
            'turno_actual'=>$turno,
            'dependencia'=>$dependencia
        );
        return $this->db->insert('despachadores', $data);        
    }

    // tabla valores
    function actualizarValores($id,$noEntregas) {
        $data = array(
            'id' => $id,
            'noEntregas' => $noEntregas);
        $this->db->where('id',$id);
        return $this->db->update('valores', $data);        
    }
    
    // tabla entregas
    function registraEntrega($idDespachador, $monto, $noEntrega){
        date_default_timezone_set('America/Mexico_City'); //configuro un nuevo timezone
        $fecha_actual=strftime("%Y-%m-%d");
        $hora_actual=strftime("%H:%M:%S");
        $fecha = $fecha_actual." ".$hora_actual;
        $data = array(
            'idDespachador' => $idDespachador,
            'monto' => $monto,
            'noEntrega'=>$noEntrega,
            'fechaEntrega'  => $fecha
        );
        return $this->db->insert('entregas', $data);        
    }
    function verificaEntrega($idDespachador, $noEntrega) {
        $consulta = $this->db->get_where('entregas',array('idDespachador'=>  $idDespachador,'noEntrega'=> $noEntrega,'fechaEntrega'=>date(now())));
        return $consulta->result_array();
    }
    //Fin tabla entregas
    

    function consultaValores() {
        $consulta = $this->db->get_where('valores',array('id ='=>  1));
        return $consulta->result_array();
    }
    // Fin tabla valores
    
    // Establece sesion para un usuario 
    function login($username, $password)
    {   
		$query = $this->db->get_where('usuarios', array('usuario' => $username,'clave'=>$password));
		if ($query->num_rows() ==1)
		{
			$row=$query->row();
			$this->session->set_userdata('person_id', $row->matricula);
			return true;
		}
		return false;
    }

    // Sale de una sesion 
    function logout()
    {
		$this->session->sess_destroy();
		return TRUE;
    }

    // Determina si un usuario esta logueado 
    function is_logged_in()
    {
		return $this->session->userdata('person_id')!=false;
    }
	


}
?>
