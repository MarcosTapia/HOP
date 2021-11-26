<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Configuracion_controller extends CI_Controller {
    private $categoriasGlobal;
    private $sucursalesGlobal;
    private $datosEmpresaGlobal;
    private $nombreEmpresaGlobal;
    private $sistemaGlobal;
    
    //permisos campos inventario
    private $permisosCamposInventarioGlobal;
    private $permisosCamposVentasGlobal;
    private $permisosCamposComprasGlobal;
    private $permisosCamposConsultasGlobal;
    private $permisosCamposProveedoresGlobal;
    private $permisosCamposClientesGlobal;
    private $permisosCamposEmpleadosGlobal;
    private $permisosCamposEmpresaGlobal;
    
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
        
        //valores globales de categorias y datos de Empresa
        $this->categoriasGlobal = $this->cargaCategorias();
        $this->sucursalesGlobal = $this->cargaSucursales();
        $this->datosEmpresaGlobal = $this->cargaDatosEmpresa();
        $this->sistemaGlobal = $this->cargaDatosSistema();
        $this->nombreEmpresaGlobal = $this->datosEmpresaGlobal[0];
        //echo "--->".$this->nombreEmpresaGlobal->{'nombreEmpresa'}."";
        
//    private $permisosCamposInventarioGlobal;
//    private $permisosCamposVentasGlobal;
//    private $permisosCamposComprasGlobal;
//    private $permisosCamposConsultasGlobal;
//    private $permisosCamposProveedoresGlobal;
//    private $permisosCamposClientesGlobal;
//    private $permisosCamposEmpleadosGlobal;
//    private $permisosCamposEmpresaGlobal;
        
    }

    function index(){
        $this->load->view('login_view');
    }
    
    function regresa() {
        echo "error";
    }
    
    function cargaCategorias() {
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
    
    function cargaSucursales() {
        //muestra valores de sucursales
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

    function mostrarValores() {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array('categorias'=>$this->categoriasGlobal,
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'sucursal' => $this->session->userdata('sucursal'),
                    'sucursales'=>$this->sucursalesGlobal,
                    'datosEmpresas'=>$this->datosEmpresaGlobal,
                    'sistemas'=>$this->sistemaGlobal,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal->{'nombreEmpresa'},
                    'opcionClickeada' => '8',
                    'permisos' => $this->session->userdata('permisos'));
            $this->load->view('layouts/header_view',$data);
            $this->load->view('configuracion/adminConfiguracion_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function actualizarCategoria($idCategoria) {
        if ($this->is_logged_in()){
            //Obtiene categoria por id
            # An HTTP GET request example
            $url = RUTAWS.'categorias/obtener_categoria_por_id.php?idCategoria='.$idCategoria;
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
                $data = array('categoria'=>$datos->{'categoria'},
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'sucursal' => $this->session->userdata('sucursal'),
                    'datosEmpresas'=>$this->datosEmpresaGlobal,
                    'sistemas'=>$this->sistemaGlobal,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal->{'nombreEmpresa'},
                    'opcionClickeada' => '8',
                    'permisos' => $this->session->userdata('permisos'));
                $this->load->view('layouts/header_view',$data);
                $this->load->view('configuracion/actualizaCategoria_view',$data);
                $this->load->view('layouts/pie_view',$data);
            } else {
                echo "error";
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function actualizarSucursal($idSucursal) {
        if ($this->is_logged_in()){
            //Obtiene sucursal por id
            # An HTTP GET request example
            $url = RUTAWS.'sucursales/obtener_sucursal_por_id.php?idSucursal='.$idSucursal;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $datos = json_decode($data);
            curl_close($ch);
            if ($datos->{'estado'}==1) {
                $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
                $fechaIngreso = $dt->format("Y-m-d H:i:s");//                    'sucursal' => $this->session->userdata('sucursal'),
                $data = array('sucursal'=>$datos->{'sucursal'},
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'datosEmpresas'=>$this->datosEmpresaGlobal,
                    'sistemas'=>$this->sistemaGlobal,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal->{'nombreEmpresa'},
                    'opcionClickeada' => '8',
                    'permisos' => $this->session->userdata('permisos'));
                $datosHeader = array(
                    'usuarioDatos' => $this->session->userdata('nombre'),
                    'fecha' => $fechaIngreso,
                    'sucursal' => $this->session->userdata('sucursal'),
                    'datosEmpresas'=>$this->datosEmpresaGlobal,
                    'sistemas'=>$this->sistemaGlobal,
                    'nombre_Empresa'=>$this->nombreEmpresaGlobal->{'nombreEmpresa'},
                    'opcionClickeada' => '8',
                    'permisos' => $this->session->userdata('permisos'));
                $this->load->view('layouts/header_view',$datosHeader);
                $this->load->view('configuracion/actualizaSucursal_view',$data);
                $this->load->view('layouts/pie_view',$data);
            } else {
                echo "error";
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function actualizarDatosEmpresa($idEmpresa) {
        if ($this->is_logged_in()){
            //Obtiene categoria por id
            # An HTTP GET request example
            $url2 = RUTAWS.'datosempresa/obtener_datosempresa_por_id.php?idEmpresa='.$idEmpresa;
            $ch2 = curl_init($url2);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            $data2 = curl_exec($ch2);
            $datos2 = json_decode($data2);
            curl_close($ch2);
            //print_r($data2);


            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array('categorias'=>$this->categoriasGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'sucursal' => $this->session->userdata('sucursal'),
                'datosEmpresa'=>$datos2->{'datosEmpresa'},
                'nombre_Empresa'=>$this->nombreEmpresaGlobal->{'nombreEmpresa'},
                'opcionClickeada' => '8',
                'permisos' => $this->session->userdata('permisos'));


            $this->load->view('layouts/header_view',$data);
            $this->load->view('configuracion/actualizaDatosEmpresa_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function actualizarSistema($idSistema) {
        if ($this->is_logged_in()){
            //Obtiene categoria por id
            # An HTTP GET request example
            $url2 = RUTAWS.'sistema/obtener_sistema_por_id.php?idSistema='.$idSistema;
            $ch2 = curl_init($url2);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            $data2 = curl_exec($ch2);
            $datos2 = json_decode($data2);
            curl_close($ch2);

            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array('categorias'=>$this->categoriasGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'sucursal' => $this->session->userdata('sucursal'),
                'sistema'=>$datos2->{'sistema'},
                'nombre_Empresa'=>$this->nombreEmpresaGlobal->{'nombreEmpresa'},
                'opcionClickeada' => '8',
                'permisos' => $this->session->userdata('permisos'));


            $this->load->view('layouts/header_view',$data);
            $this->load->view('configuracion/actualizaSistema_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function actualizarCategoriaFromFormulario(){
        if ($this->is_logged_in()){
            if ($this->input->post('submit')){
                //LLamadfo de WS
                $idCategoria = $this->input->post("idCategoria");
                $descripcionCategoria = $this->input->post("descripcionCategoria");

                $data = array("idCategoria" => $idCategoria, 
                    "descripcionCategoria" => $descripcionCategoria);
                $data_string = json_encode($data);
                $ch = curl_init(RUTAWS.'categorias/actualizar_categoria.php');
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
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function actualizarSucursalFromFormulario(){
        if ($this->is_logged_in()){
            if ($this->input->post('submit')){
                //LLamadfo de WS
                $idSucursal = $this->input->post("idSucursal");
                $descripcionSucursal = $this->input->post("descripcionSucursal");

                $data = array("idSucursal" => $idSucursal, 
                    "descripcionSucursal" => $descripcionSucursal);
                $data_string = json_encode($data);
                $ch = curl_init(RUTAWS.'sucursales/actualizar_sucursal.php');
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
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function actualizarDatosEmpresaFromFormulario(){
        if ($this->is_logged_in()){
            if ($this->input->post('submit')){
                //LLamadfo de WS
                $idEmpresa = $this->input->post("idEmpresa");
                $nombreEmpresa = $this->input->post("nombreEmpresa");
                $rfcEmpresa = $this->input->post("rfcEmpresa");
                $direccionEmpresa = $this->input->post("direccionEmpresa");
                $emailEmpresa = $this->input->post("emailEmpresa");
                $telEmpresa = $this->input->post("telEmpresa");
                $cpEmpresa = $this->input->post("cpEmpresa");
                $ciudadEmpresa = $this->input->post("ciudadEmpresa");
                $estadoEmpresa = $this->input->post("estadoEmpresa");
                $paisEmpresa = $this->input->post("paisEmpresa");

                $data = array("idEmpresa" => $idEmpresa, 
                "nombreEmpresa" => $nombreEmpresa,
                "rfcEmpresa" => $rfcEmpresa,
                "direccionEmpresa" => $direccionEmpresa,
                "emailEmpresa" => $emailEmpresa,
                "telEmpresa" => $telEmpresa,
                "cpEmpresa" => $cpEmpresa,
                "ciudadEmpresa" => $ciudadEmpresa,
                "estadoEmpresa" => $estadoEmpresa,
                "paisEmpresa" => $paisEmpresa
                        );
                $data_string = json_encode($data);
                $ch = curl_init(RUTAWS.'datosempresa/actualizar_datosempresa.php');
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
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function actualizarSistemaFromFormulario(){
        if ($this->is_logged_in()){
            if ($this->input->post('submit')){
                /************************************************************************/
                /************************************************************************/
                //inicializa valores de permisos
                $this->permisosCamposInventarioGlobal = "";
                $this->permisosCamposVentasGlobal = "";
                $this->permisosCamposComprasGlobal = "";
                $this->permisosCamposConsultasGlobal = "";
                $this->permisosCamposProveedoresGlobal = "";
                $this->permisosCamposClientesGlobal = "";
                $this->permisosCamposEmpleadosGlobal = "";
                $this->permisosCamposEmpresaGlobal = "";
                //fin inicializa valores de permisos

                //Arma permisos Inventario
                if ($this->input->post("chkCamposInventarioSistema0")=="on") {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."1";
                } else {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."0";
                }
                if ($this->input->post("chkCamposInventarioSistema1")=="on") {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."1";
                } else {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."0";
                }
                if ($this->input->post("chkCamposInventarioSistema2")=="on") {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."1";
                } else {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."0";
                }
                if ($this->input->post("chkCamposInventarioSistema3")=="on") {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."1";
                } else {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."0";
                }
                if ($this->input->post("chkCamposInventarioSistema4")=="on") {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."1";
                } else {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."0";
                }
                if ($this->input->post("chkCamposInventarioSistema5")=="on") {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."1";
                } else {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."0";
                }
                if ($this->input->post("chkCamposInventarioSistema6")=="on") {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."1";
                } else {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."0";
                }
                if ($this->input->post("chkCamposInventarioSistema7")=="on") {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."1";
                } else {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."0";
                }
                if ($this->input->post("chkCamposInventarioSistema8")=="on") {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."1";
                } else {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."0";
                }
                if ($this->input->post("chkCamposInventarioSistema9")=="on") {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."1";
                } else {
                    $this->permisosCamposInventarioGlobal = $this->permisosCamposInventarioGlobal."0";
                }
                //Fin Arma permisos Inventario


                //Arma permisos Ventas *************
                if ($this->input->post("chkCamposVentasSistema0")=="on") {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."1";
                } else {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."0";
                }
                if ($this->input->post("chkCamposVentasSistema1")=="on") {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."1";
                } else {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."0";
                }
                if ($this->input->post("chkCamposVentasSistema2")=="on") {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."1";
                } else {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."0";
                }
                if ($this->input->post("chkCamposVentasSistema3")=="on") {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."1";
                } else {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."0";
                }
                if ($this->input->post("chkCamposVentasSistema4")=="on") {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."1";
                } else {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."0";
                }
                if ($this->input->post("chkCamposVentasSistema5")=="on") {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."1";
                } else {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."0";
                }
                if ($this->input->post("chkCamposVentasSistema6")=="on") {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."1";
                } else {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."0";
                }
                if ($this->input->post("chkCamposVentasSistema7")=="on") {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."1";
                } else {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."0";
                }
                if ($this->input->post("chkCamposVentasSistema8")=="on") {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."1";
                } else {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."0";
                }
                if ($this->input->post("chkCamposVentasSistema9")=="on") {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."1";
                } else {
                    $this->permisosCamposVentasGlobal = $this->permisosCamposVentasGlobal."0";
                }
                //Fin Arma permisos Ventas


                //Arma permisos Compras **********
                if ($this->input->post("chkCamposComprasSistema0")=="on") {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."1";
                } else {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."0";
                }
                if ($this->input->post("chkCamposComprasSistema1")=="on") {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."1";
                } else {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."0";
                }
                if ($this->input->post("chkCamposComprasSistema2")=="on") {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."1";
                } else {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."0";
                }
                if ($this->input->post("chkCamposComprasSistema3")=="on") {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."1";
                } else {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."0";
                }
                if ($this->input->post("chkCamposComprasSistema4")=="on") {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."1";
                } else {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."0";
                }
                if ($this->input->post("chkCamposComprasSistema5")=="on") {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."1";
                } else {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."0";
                }
                if ($this->input->post("chkCamposComprasSistema6")=="on") {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."1";
                } else {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."0";
                }
                if ($this->input->post("chkCamposComprasSistema7")=="on") {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."1";
                } else {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."0";
                }
                if ($this->input->post("chkCamposComprasSistema8")=="on") {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."1";
                } else {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."0";
                }
                if ($this->input->post("chkCamposComprasSistema9")=="on") {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."1";
                } else {
                    $this->permisosCamposComprasGlobal = $this->permisosCamposComprasGlobal."0";
                }
                //Fin Arma permisos Compras


                //Arma permisos Consultas **********
                if ($this->input->post("chkCamposConsultasSistema0")=="on") {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."1";
                } else {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."0";
                }
                if ($this->input->post("chkCamposConsultasSistema1")=="on") {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."1";
                } else {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."0";
                }
                if ($this->input->post("chkCamposConsultasSistema2")=="on") {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."1";
                } else {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."0";
                }
                if ($this->input->post("chkCamposConsultasSistema3")=="on") {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."1";
                } else {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."0";
                }
                if ($this->input->post("chkCamposConsultasSistema4")=="on") {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."1";
                } else {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."0";
                }
                if ($this->input->post("chkCamposConsultasSistema5")=="on") {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."1";
                } else {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."0";
                }
                if ($this->input->post("chkCamposConsultasSistema6")=="on") {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."1";
                } else {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."0";
                }
                if ($this->input->post("chkCamposConsultasSistema7")=="on") {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."1";
                } else {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."0";
                }
                if ($this->input->post("chkCamposConsultasSistema8")=="on") {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."1";
                } else {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."0";
                }
                if ($this->input->post("chkCamposConsultasSistema9")=="on") {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."1";
                } else {
                    $this->permisosCamposConsultasGlobal = $this->permisosCamposConsultasGlobal."0";
                }
                //Fin Arma permisos Consultas


                //Arma permisos Proveedores **********
                if ($this->input->post("chkCamposProveedoresSistema0")=="on") {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."1";
                } else {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."0";
                }
                if ($this->input->post("chkCamposProveedoresSistema1")=="on") {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."1";
                } else {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."0";
                }
                if ($this->input->post("chkCamposProveedoresSistema2")=="on") {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."1";
                } else {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."0";
                }
                if ($this->input->post("chkCamposProveedoresSistema3")=="on") {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."1";
                } else {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."0";
                }
                if ($this->input->post("chkCamposProveedoresSistema4")=="on") {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."1";
                } else {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."0";
                }
                if ($this->input->post("chkCamposProveedoresSistema5")=="on") {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."1";
                } else {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."0";
                }
                if ($this->input->post("chkCamposProveedoresSistema6")=="on") {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."1";
                } else {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."0";
                }
                if ($this->input->post("chkCamposProveedoresSistema7")=="on") {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."1";
                } else {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."0";
                }
                if ($this->input->post("chkCamposProveedoresSistema8")=="on") {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."1";
                } else {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."0";
                }
                if ($this->input->post("chkCamposProveedoresSistema9")=="on") {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."1";
                } else {
                    $this->permisosCamposProveedoresGlobal = $this->permisosCamposProveedoresGlobal."0";
                }
                //Fin Arma permisos Proveedores


                //Arma permisos Clientes **********
                if ($this->input->post("chkCamposClientesSistema0")=="on") {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."1";
                } else {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."0";
                }
                if ($this->input->post("chkCamposClientesSistema1")=="on") {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."1";
                } else {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."0";
                }
                if ($this->input->post("chkCamposClientesSistema2")=="on") {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."1";
                } else {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."0";
                }
                if ($this->input->post("chkCamposClientesSistema3")=="on") {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."1";
                } else {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."0";
                }
                if ($this->input->post("chkCamposClientesSistema4")=="on") {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."1";
                } else {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."0";
                }
                if ($this->input->post("chkCamposClientesSistema5")=="on") {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."1";
                } else {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."0";
                }
                if ($this->input->post("chkCamposClientesSistema6")=="on") {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."1";
                } else {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."0";
                }
                if ($this->input->post("chkCamposClientesSistema7")=="on") {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."1";
                } else {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."0";
                }
                if ($this->input->post("chkCamposClientesSistema8")=="on") {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."1";
                } else {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."0";
                }
                if ($this->input->post("chkCamposClientesSistema9")=="on") {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."1";
                } else {
                    $this->permisosCamposClientesGlobal = $this->permisosCamposClientesGlobal."0";
                }
                //Fin Arma permisos Clientes


                //Arma permisos Empleados **********
                if ($this->input->post("chkCamposEmpleadosSistema0")=="on") {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."1";
                } else {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."0";
                }
                if ($this->input->post("chkCamposEmpleadosSistema1")=="on") {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."1";
                } else {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."0";
                }
                if ($this->input->post("chkCamposEmpleadosSistema2")=="on") {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."1";
                } else {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."0";
                }
                if ($this->input->post("chkCamposEmpleadosSistema3")=="on") {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."1";
                } else {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."0";
                }
                if ($this->input->post("chkCamposEmpleadosSistema4")=="on") {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."1";
                } else {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."0";
                }
                if ($this->input->post("chkCamposEmpleadosSistema5")=="on") {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."1";
                } else {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."0";
                }
                if ($this->input->post("chkCamposEmpleadosSistema6")=="on") {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."1";
                } else {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."0";
                }
                if ($this->input->post("chkCamposEmpleadosSistema7")=="on") {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."1";
                } else {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."0";
                }
                if ($this->input->post("chkCamposEmpleadosSistema8")=="on") {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."1";
                } else {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."0";
                }
                if ($this->input->post("chkCamposEmpleadosSistema9")=="on") {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."1";
                } else {
                    $this->permisosCamposEmpleadosGlobal = $this->permisosCamposEmpleadosGlobal."0";
                }
                //Fin Arma permisos Empleados


                //Arma permisos Empresa **********
                if ($this->input->post("chkCamposEmpresaSistema0")=="on") {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."1";
                } else {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."0";
                }
                if ($this->input->post("chkCamposEmpresaSistema1")=="on") {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."1";
                } else {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."0";
                }
                if ($this->input->post("chkCamposEmpresaSistema2")=="on") {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."1";
                } else {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."0";
                }
                if ($this->input->post("chkCamposEmpresaSistema3")=="on") {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."1";
                } else {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."0";
                }
                if ($this->input->post("chkCamposEmpresaSistema4")=="on") {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."1";
                } else {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."0";
                }
                if ($this->input->post("chkCamposEmpresaSistema5")=="on") {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."1";
                } else {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."0";
                }
                if ($this->input->post("chkCamposEmpresaSistema6")=="on") {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."1";
                } else {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."0";
                }
                if ($this->input->post("chkCamposEmpresaSistema7")=="on") {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."1";
                } else {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."0";
                }
                if ($this->input->post("chkCamposEmpresaSistema8")=="on") {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."1";
                } else {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."0";
                }
                if ($this->input->post("chkCamposEmpresaSistema9")=="on") {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."1";
                } else {
                    $this->permisosCamposEmpresaGlobal = $this->permisosCamposEmpresaGlobal."0";
                }
                //Fin Arma permisos Empresa
                /************************************************************************/
                /************************************************************************/

                //LLamadfo de WS
                $idSistema = $this->input->post("idSistema");
                $ivaEmpresaAnt = $this->input->post("ivaSistemaAnt");
                $ivaEmpresa = $this->input->post("ivaEmpresa");
                $ivaGral = $this->input->post("ivaGral");

                //sirve para cambio de precios 1.- parcial 2.- total
                $tipoOperacion = $this->input->post("tipoOperacion");
                $historicoProveedores = "";
                if ($this->input->post("historicoProveedores")=="on") {
                    $historicoProveedores = $historicoProveedores."1";
                } else {
                    $historicoProveedores = $historicoProveedores."0";
                }
                $criterioHistoricoProveedores = $this->input->post("criterioHistoricoProveedores");
                $camposInventario = $this->permisosCamposInventarioGlobal;
                $camposVentas = $this->permisosCamposVentasGlobal;
                $camposCompras = $this->permisosCamposComprasGlobal;
                $camposConsultas = $this->permisosCamposConsultasGlobal;
                $camposProveedores = $this->permisosCamposProveedoresGlobal;
                $camposClientes = $this->permisosCamposClientesGlobal;
                $camposEmpleados = $this->permisosCamposEmpleadosGlobal;
                $camposEmpresa = $this->permisosCamposEmpresaGlobal;

                $data = array("idSistema" => $idSistema, 
                    "ivaEmpresa" => $ivaEmpresa,
                    "historicoProveedores" => $historicoProveedores,
                    "criterioHistoricoProveedores" => $criterioHistoricoProveedores,
                    "camposInventario" => $camposInventario,
                    "camposVentas" => $camposVentas,
                    "camposCompras" => $camposCompras,
                    "camposConsultas" => $camposConsultas,
                    "camposProveedores" => $camposProveedores,
                    "camposClientes" => $camposClientes,
                    "camposEmpleados" => $camposEmpleados,
                    "camposEmpresa" => $camposEmpresa,
                    "ivaGral" => $ivaGral
                        );
                $data_string = json_encode($data);
                $ch = curl_init(RUTAWS.'sistema/actualizar_sistema.php');
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

                //verifica si hubo cambio en el iva del sistema y si asi paso se actualizan todos los precios 
                //e ivas de productos que no sean iguales al iva que estaba por defecto
                $data = array('ivaAnt'=>$ivaEmpresaAnt,'ivaNvo'=>$ivaEmpresa,'opcionCambio'=>$tipoOperacion);
                $data_string = json_encode($data);
                $ch = curl_init(RUTAWS.'inventarios/actualizar_inventarioIva.php');
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
                //fin verifica si hubo cambio en el iva del sistema
                $resultado = json_decode($result, true);
                if ($resultado['estado']==1) {
                    $this->session->set_flashdata('correcto', "Sistema actualizado correctamente <br>");
                } else {
                    $this->session->set_flashdata('correcto', "Error. No se actualizó el sistema <br>");
                }        
                redirect('/configuracion_controller/mostrarValores');
            }
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function eliminarCategoria($idCategoria) {
        if ($this->is_logged_in()){
            $data = array("idCategoria" => $idCategoria);
            $data_string = json_encode($data);
            $ch = curl_init(RUTAWS.'categorias/borrar_categoria.php');
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
            $resultado = json_decode($result, true);
            if ($resultado['estado']==1) {
                $this->session->set_flashdata('correcto', "Registro eliminado correctamente <br>");
            } else {
                $this->session->set_flashdata('correcto', "Error. No se eliminó el registro <br>");
            }        
            redirect('/configuracion_controller/mostrarValores');
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function eliminarSucursal($idSucursal) {
        if ($this->is_logged_in()){
            $data = array("idSucursal" => $idSucursal);
            $data_string = json_encode($data);
            $ch = curl_init(RUTAWS.'sucursales/borrar_sucursal.php');
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
            $resultado = json_decode($result, true);
            if ($resultado['estado']==1) {
                $this->session->set_flashdata('correcto', "Registro eliminado correctamente <br>");
            } else {
                $this->session->set_flashdata('correcto', "Error. No se eliminó el registro <br>");
            }        
            redirect('/configuracion_controller/mostrarValores');
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function nuevoCategoria() {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array(
                'datosEmpresas'=>$this->datosEmpresaGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'sistemas'=>$this->sistemaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal->{'nombreEmpresa'},
                'opcionClickeada' => '8',
                'permisos' => $this->session->userdata('permisos'));
            $this->load->view('layouts/header_view',$data);
            $this->load->view('configuracion/nuevoCategoria_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function nuevoSucursal() {
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array(
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'datosEmpresas'=>$this->datosEmpresaGlobal,
                'sistemas'=>$this->sistemaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal->{'nombreEmpresa'},
                'opcionClickeada' => '8',
                'permisos' => $this->session->userdata('permisos'));
            $this->load->view('layouts/header_view',$data);
            $this->load->view('configuracion/nuevoSucursal_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }

    function nuevoCategoriaFromFormulario(){
        if ($this->is_logged_in()){
            if ($this->input->post('submit')){
                //LLamadfo de WS
                $descripcionCategoria = $this->input->post("descripcionCategoria");

                $data = array("descripcionCategoria" => $descripcionCategoria);
                $data_string = json_encode($data);
                $ch = curl_init(RUTAWS.'categorias/insertar_categoria.php');
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
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    function nuevoSucursalFromFormulario(){
        if ($this->is_logged_in()){
            if ($this->input->post('submit')){
                //LLamadfo de WS
                $descripcionSucursal = $this->input->post("descripcionSucursal");

                $data = array("descripcionSucursal" => $descripcionSucursal);
                $data_string = json_encode($data);
                $ch = curl_init(RUTAWS.'sucursales/insertar_sucursal.php');
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
        } else {
            redirect($this->cerrarSesion());
        }
    }
    
    //Importar desde Excel con libreria de PHPExcel
    public function importarCategoriasExcel(){
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array(
                'datosEmpresas'=>$this->datosEmpresaGlobal,
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'sistemas'=>$this->sistemaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal->{'nombreEmpresa'},
                'opcionClickeada' => '8',
                'permisos' => $this->session->userdata('permisos'));
            $this->load->view('layouts/header_view',$data);
            $this->load->view('configuracion/importarCategoriasFromExcel_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }        

    public function importarSucursalesExcel(){
        if ($this->is_logged_in()){
            $dt = new DateTime("now", new DateTimeZone('America/Mexico_City'));
            $fechaIngreso = $dt->format("Y-m-d H:i:s"); 
            $data = array(
                'usuarioDatos' => $this->session->userdata('nombre'),
                'fecha' => $fechaIngreso,
                'datosEmpresas'=>$this->datosEmpresaGlobal,
                'sistemas'=>$this->sistemaGlobal,
                'nombre_Empresa'=>$this->nombreEmpresaGlobal->{'nombreEmpresa'},
                'opcionClickeada' => '8',
                'permisos' => $this->session->userdata('permisos'));
            $this->load->view('layouts/header_view',$data);
            $this->load->view('configuracion/importarSucursalesFromExcel_view',$data);
            $this->load->view('layouts/pie_view',$data);
        } else {
            redirect($this->cerrarSesion());
        }
    }        
    
    //Importar desde Excel con libreria de PHPExcel
    public function importarExcel(){
        if ($this->is_logged_in()){
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
                    $ch = curl_init(RUTAWS.'categorias/insertar_categoria.php');
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
        } else {
            redirect($this->cerrarSesion());
        }
    }        
    
    public function importarSucursalFromExcel(){
        if ($this->is_logged_in()){
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
                            'descripcionSucursal' => $value['A']
                    ); 
                    foreach ($arr_datos as $llave => $valor) {
                        $arr_datos[$llave] = $valor;
                    }
                    //$this->db->insert('usuarios',$arr_datos);

                    //Llamada de ws para insertar
                    $data_string = json_encode($arr_datos);
                    $ch = curl_init(RUTAWS.'sucursales/insertar_sucursal.php');
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
        } else {
            redirect($this->cerrarSesion());
        }
    }        
    
    //Fin Importar desde Excel con libreria de PHPExcel
    
    //Exportar datos a Excel
    public function exportarCategoriaExcel(){
        if ($this->is_logged_in()){
            //llamadod de ws
            # An HTTP GET request example
            $url = RUTAWS.'categorias/obtener_categorias.php';
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
            $nilai=$datos->{'categorias'};
    //        if (isset($datos->{'usuarios'})) {
    //            foreach($nilai as $h){
    //                echo "azul";
    //            }
    //        }
            $totn = 0;
            foreach($nilai as $h){
                $totn = $totn + 1;
            }
            $heading=array('Categoría');
            $this->load->library('excel');
            //Create a new Object
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getActiveSheet()->setTitle("Categorias");

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
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$n->{'descripcionCategoria'});
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
            $objPHPExcel->getActiveSheet()->getStyle('A1:A'.$maxrow)->applyFromArray($styleArray);
            //Save as an Excel BIFF (xls) file
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Categorias.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            exit();
        } else {
            redirect($this->cerrarSesion());
        }
    }	
    
    
    public function exportarSucursalExcel(){
        if ($this->is_logged_in()){
            //llamadod de ws
            # An HTTP GET request example
            $url = RUTAWS.'sucursales/obtener_sucursales.php';
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
            $nilai=$datos->{'sucursales'};
    //        if (isset($datos->{'usuarios'})) {
    //            foreach($nilai as $h){
    //                echo "azul";
    //            }
    //        }
            $totn = 0;
            foreach($nilai as $h){
                $totn = $totn + 1;
            }
            $heading=array('Sucursal');
            $this->load->library('excel');
            //Create a new Object
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getActiveSheet()->setTitle("Sucursales");

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
            $objPHPExcel->getActiveSheet()->getStyle('A1:A'.$maxrow)->applyFromArray($styleArray);
            //Save as an Excel BIFF (xls) file
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Sucursales.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            exit();
        } else {
            redirect($this->cerrarSesion());
        }
    }	
    //fin exportar a excel
    
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

