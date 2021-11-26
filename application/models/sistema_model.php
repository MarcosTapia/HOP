<?php
class Sistema_model extends CI_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }
    
    //**  Manejo de Sesiones
    // Sale de una sesion 
    function logout() {
		$this->session->sess_destroy();
		return TRUE;
    }

    // Determina si un usuario esta logueado 
    function is_logged_in() {
		return $this->session->userdata('person_id')!=false;
    }
    //**  Fin Manejo de Sesiones
}
?>
