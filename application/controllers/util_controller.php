<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Util_controller extends CI_Controller {
    
    function __construct(){
        parent::__construct();
    }
    
    function cargaDatosEmpresa() {
        $url2 = RUTAWS.'datosempresa/obtener_datosempresas.php';
        $ch2 = curl_init($url2);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        $data2 = curl_exec($ch2);
        $datos = json_decode($data2);
        curl_close($ch2);
        if ($datos->{'estado'}==1) {
            return $datos->{'datosEmpresas'};
        } else {
            return null;
        }
    }
    
    function cargaDatosUsuarios() {
        # An HTTP GET request example
        $url = RUTAWS.'usuarios/obtener_usuarios.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        if ($datos->{'estado'}==1) {
            return $datos->{'usuarios'};
        } else {
            return null;
        }
    } 

    function index(){
        $this->load->view('login_view');
    }
    
    //**  Manejo de Sesiones
    function cerrarSesion() {
        $this->session->set_userdata('logueado',FALSE);
        $this->session->sess_destroy();
        $this->load->view('login_view');
    }

    function cargaDatosAreas() {
        $url = RUTAWS.'areas/obtener_areas.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        if ($datos->{'estado'}==1) {
            return $datos->{'areas'};
        } else {
            return null;
        }
    }
    
    function cargaDatosProyectos() {
        $url = RUTAWS.'proyectos/obtener_proyectos.php';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $datos = json_decode($data);
        curl_close($ch);
        if ($datos->{'estado'}==1) {
            return $datos->{'proyectos'};
        } else {
            return null;
        }
    }      
    
    function is_logged_in() {
        return $this->session->userdata('logueado');
    }
    //**  Fin Manejo de Sesiones
    
    
}

