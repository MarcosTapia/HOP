<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Maquinaria_controller extends CI_Controller {
    private $datosEmpresaGlobal;
    private $nombreEmpresaGlobal;
    private $usuariosGlobal;
    private $areasGlobal;
    private $proveedoresGlobal;
    private $maquinasGlobal;
    private $usuarioHerramental;
    private $categoriasGlobal;

    private $gatewayRest;
    
    function __construct(){
        parent::__construct();
        $this->load->model('sistema_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->error = "";
        
        //para subir imagenes
        $this->load->helper("URL", "DATE", "URI", "FORM");
        $this->load->library('upload');
        //$this->load->model('mupload_model');    
        
        //llamado a controlador util global
        $this->load->library('../controllers/util_controller');
        $this->load->library('../controllers/usuarios_controller');
        
        $this->areasGlobal = $this->util_controller->cargaDatosAreas();
        $this->datosEmpresaGlobal = $this->util_controller->cargaDatosEmpresa();
        $this->nombreEmpresaGlobal = $this->datosEmpresaGlobal[0]->{'nombreEmpresa'};
        $this->usuariosGlobal = $this->util_controller->cargaDatosUsuarios();
    }
    
    function index(){
        $this->load->view('login_view');
    }
    
    function inicio() {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array(
                    'permisos'=>$this->session->userdata('permisos'),
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'opcionClickeada' => '0'
                );
            $this->load->view('layouts/headerAdministrador_view',$data);
            $this->load->view('principal_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function mostrarMaquinas() {
        if ($this->is_logged_in()){
            $url = RUTAWS.'maquinaria/obtener_maquinas.php';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            curl_close($ch);
            $data = array('nombre_Empresa'=>$this->nombreEmpresaGlobal);
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            if ($datos->{'estado'}==1) {
                $data = array(
                    'categorias'=>$this->categoriasGlobal,
                    'maquinas'=>$datos->{'maquinas'},
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'permisos' => $this->session->userdata('permisos'),
                    'opcionClickeada' => '7'
                        );
                $this->load->view('layouts/headerAdministrador_view',$data);
                $this->load->view('maquinas/adminMaquinas_view',$data);
                $this->load->view('layouts/pie_view',$data);
            } else {
                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
                $data = array(
                    'categorias'=>$this->categoriasGlobal,
                    'proveedores'=>$this->proveedoresGlobal,
                    'usuarios'=>$this->usuariosGlobal,
                    'areas'=>$this->areasGlobal,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'sucursal' => $this->session->userdata('sucursal'),
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'permisos' => $this->session->userdata('permisos'),
                    'opcionClickeada' => '7'
                    );
                $this->load->view('layouts/headerAdministrador_view',$data);
                $this->load->view('maquinas/adminMaquinas_view',$data);
                $this->load->view('layouts/pie_view',$data);                
            } 
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function nuevoMaquina() {
        if ($this->is_logged_in()){
            $url = RUTAWS.'etapas/obtener_etapas.php';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            curl_close($ch);
            
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array(
                'areas'=>$this->areasGlobal,
                'etapas'=>$datos->{'etapas'},
                'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'permisos' => $this->session->userdata('permisos'),
                'opcionClickeada' => '7'
                );
            $this->load->view('layouts/headerAdministrador_view',$data);
            $this->load->view('maquinas/nuevoMaquina_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function nuevoMaquinaFromFormulario() {
        if ($this->is_logged_in()){
            if ($this->input->post('submit')){
                $numeroMaquina = $this->input->post("numeromaq");
                $nombreMaquina = $this->input->post("nombremaq");
                $idEtapa = $this->input->post("etapa");
                $idArea = $this->input->post("areas");
                $data = array(
                    "numeroMaquina" => $numeroMaquina,
                    "nombreMaquina" => $nombreMaquina, 
                    "idEtapa" => $idEtapa, 
                    "idArea" => $idArea
                    );
                $data_string = json_encode($data);
                $ch = curl_init(RUTAWS.'maquinaria/insertar_maquina.php');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
                );
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                $result = curl_exec($ch);
                curl_close($ch);
                $resultado = json_decode($result, true);
                if ($resultado['estado']==1) {
                    $this->session->set_flashdata('correcto', "Registro guardado <br>");
                } else {
                    $this->session->set_flashdata('correcto', "Error. No se guardó el registro <br>");
                }        
                redirect('/index.php/maquinaria_controller/mostrarMaquinas');
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function actualizarMaquina($idMaquina) {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s");
            
            $url = RUTAWS.'etapas/obtener_etapas.php';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $dataEtapas = curl_exec($ch);
            $datosEtapas = json_decode($dataEtapas);
            curl_close($ch);            
            
            $url = RUTAWS.'maquinaria/obtener_maquina_por_id.php?idMaquina='.$idMaquina;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            curl_close($ch);
            if ($datos->{'estado'}==1) {
                $data = array(
                    'areas'=>$this->areasGlobal,
                    'etapas'=>$datosEtapas->{'etapas'},
                    'maquina'=>$datos->{'maquina'},
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal,
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'permisos' => $this->session->userdata('permisos'),
                    'opcionClickeada' => '7'
                        );
                $this->load->view('layouts/headerAdministrador_view',$data);
                $this->load->view('maquinas/actualizaMaquina_view',$data);
                $this->load->view('layouts/pie_view',$data);
            } else {
                echo "error";
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function actualizarMaquinaFromFormulario() {
        if ($this->is_logged_in()){
            if ($this->input->post('submit')){
                $idMaquina = $this->input->post("idMaquina");
                $numeroMaquina = $this->input->post("numeromaq");
                $nombreMaquina = $this->input->post("nombremaq");
                $idEtapa = $this->input->post("etapa");
                $idArea = $this->input->post("areas");
                $data = array(
                    "idMaquina" => $idMaquina,
                    "numeroMaquina" => $numeroMaquina,
                    "nombreMaquina" => $nombreMaquina, 
                    'idEtapa' => $idEtapa,
                    "idArea" => $idArea,
                    );  
                $data_string = json_encode($data);
                $ch = curl_init(RUTAWS.'maquinaria/actualizar_maquina.php');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
                );
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                $result = curl_exec($ch);
                curl_close($ch);
                $resultado = json_decode($result, true);
                if ($resultado['estado']==1) {
                    $this->session->set_flashdata('correcto', "Registro actualizado correctamente <br>");
                } else {
                    $this->session->set_flashdata('correcto', "Error. No se actualizó el registro <br>");
                }        
                redirect('/index.php/maquinaria_controller/mostrarMaquinas');
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function eliminarMaquina($idMaquina) {
        if ($this->is_logged_in()){
            $data = array("idMaquina" => $idMaquina);
            $data_string = json_encode($data);
            $ch = curl_init(RUTAWS.'maquinaria/borrar_maquina.php');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $result = curl_exec($ch);
            //echo $result;
            curl_close($ch);
            $resultado = json_decode($result, true);
            if ($resultado['estado']==1) {
                $this->session->set_flashdata('correcto', "Registro eliminado correctamente <br>");
            } else {
                $this->session->set_flashdata('correcto', "Error. No se eliminó el registro <br>");
            }        
            redirect('/index.php/maquinaria_controller/mostrarMaquinas');
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function buscaMaquina() {
        $data2 = array();
        $elementos = array("-2");
        foreach ($this->maquinasGlobal as $key => $value) {
            $w = array_search($value->nombre_maquina,$elementos);
            if ($w == false){            
                array_push($elementos,$value->nombre_maquina);
                $data2[] = array('id' => $value->idMaquina, 'name' => $value->nombre_maquina);
            }
        }
        echo json_encode($data2);
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

