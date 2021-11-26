<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<head>  	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="shortcut icon" href="favicon.png">
    <!-- Para favicon -->
    <link href="<?php echo base_url(); ?>/images/favicon.ico" rel="icon" type="image/x-icon" />    
    
    <title>Ingreso al Sistema</title>
    <link href="<?php echo base_url(); ?>/css/bootstrap.css" rel="stylesheet">
    <script>
        function mensaje() {
            if (document.getElementById('registroCorrecto').innerHTML != "") {
                setTimeout(function(){ location.reload(); }, 1000);
            }
        }  
    </script>
    
    <style>
        /* Login Form */
        .login-form input{
            display: block;
            margin:0 auto 15px;
            width:70%;
            background: #d6d6d6;    
            border:2px solid #cc0000;
            color:black;
            padding: 8px;
        }
        /* Login Button */
        .btn.btn-red {
            width: 120px;
            display:block;
            margin: 20px auto 20px;
            color: white;
            text-transform:uppercase ;	
            text-shadow: 1px 2px 2px #c44c4c;
            background: #e75a5a; 
            border: 1px solid #008FFF;
            -webkit-box-shadow: inset 0 1px 2px #ff8c8c;
            -moz-box-shadow: inset 0 1px 2px #ff8c8c;
            box-shadow: inset 0 1px 2px #ff8c8c;
            -webkit-transition: background .5s ease-in-out;
            -moz-transition: background .5s ease-in-out;
            -o-transition: background .5s ease-in-out;
            transition: background .5s ease-in-out;
            
        }
        .btn.btn-red:hover {	 
            background: #d94444; 
        } 
        .btn.btn-red.btn-reset{
            width: 180px;
        }
    </style>
</head>
<body onload="mensaje()">
    <div class="container" 
         <?php  ?>
        <div class="row" style="margin-top: -45px;">
            <div class="col-sm-12">
                   
                   <center>
                   <a href="#">
                       <br><br>
                       <img class="img-responsive" src="<?php echo base_url(); ?>/images/WEWIRELOGO.png" alt="Logo de la Empresa" />
                   </a>
                   </center>
                   <h3 style="text-align: center; margin-top: -30px;margin-left: -10px;color:#666666">BMW</h3>
            </div>
        </div>
        <div class="row">
            <br><br>
            <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4" style="border: 5px solid #008FFF;border-radius: 10px;margin-top: -30px;">
                <div>
                    <div>
                        <br>
                        <h4 style="font-weight:bold;text-align:center;">INGRESO AL SISTEMA</h4>
                        <br>
                        <center>
                            <img id="almacen" src="<?php echo base_url(); ?>images/menubar/almacen.png" alt="Almacén" title="Almacén" />
                        </center>
                    </div> 
                    <hr />
                    <div class="login-form">
                        <div>
                            <?php 
                                $correcto = $this->session->flashdata('correcto');
                                if ($correcto) { ?>
                            <span id="registroCorrecto" style="text-align: center;color:#ff6666;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $correcto ?></span><br><br>
                            <?php 
                            } ?>
                        </div>
                        <form id="loginPrincipal" action="<?php echo site_url();?>index.php/usuarios_controller/verificaUsuario" method="post"  >
                            <input type="text" name="usuario" autocomplete="false" placeholder="Nombre de Usuario" required autofocus/> 
                            <br>
                            <input type="password" name="clave" placeholder="Contraseña" required/>
                            <br>
                            <button type="submit" class="btn btn-red" style="background: #008FFF">Ingresar</button> 
                            <br><br>
                        </form>	
                        <?php echo "<script> mensaje(); </script>"; ?>;
                    </div> 	
                </div>
                <br>
            </div>
        </div>
    </div>
</body>
</html>
