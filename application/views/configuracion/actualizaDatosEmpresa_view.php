<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php if ($nombre_Empresa != "") { echo $nombre_Empresa; }?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
  
    <script type="text/javascript" charset="utf-8">
        function mensaje() {
            if (document.getElementById('registroCorrecto').innerHTML != "") {
                setTimeout(function(){ location.reload(); }, 1000);
            }
        }
    </script>
</head>
<body onload="mensaje()">
<div class="container">
    <div class="row">
        <?php 
            $correcto = $this->session->flashdata('correcto');
            if ($correcto) { ?>
        <span id="registroCorrecto" style="color:blue;"><?= $correcto ?></span>
        <?php } ?>
        <br>
        <div class="col-md-12" style="border: 1px solid #FFF;border-color: red">
            <h3 style="text-align: center">Modificar Datos del Sistema</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/configuracion_controller/actualizarDatosEmpresaFromFormulario" method="post">
                <input type="hidden" name="idEmpresa" id="idEmpresa" value="<?php echo $datosEmpresa->{'idEmpresa'}; ?>" />
                <br><br>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="nombreEmpresa">Título del Sistema:</label>
                  <div class="col-sm-10">
                      <input required autofocus type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" value="<?php echo $datosEmpresa->{'nombreEmpresa'}; ?>" placeholder="Título del sistema">
                  </div>					  
                </div>  
                
                <div class="form-group">
                  <label class="control-label col-sm-2" for="rfcEmpresa">RFC:</label>
                  <div class="col-sm-10">
                      <input required type="text" class="form-control" id="rfcEmpresa" name="rfcEmpresa" value="<?php echo $datosEmpresa->{'rfcEmpresa'}; ?>" placeholder="RFC">
                  </div>					  
                </div>  
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="direccionEmpresa">Direcci&oacute;n:</label>
                  <div class="col-sm-10">
                      <input required type="text" class="form-control" id="direccionEmpresa" name="direccionEmpresa" value="<?php echo $datosEmpresa->{'direccionEmpresa'}; ?>" placeholder="Direcci&oacute;n">
                  </div>					  
                </div>  
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="emailEmpresa">Email:</label>
                  <div class="col-sm-10">
                      <input required type="email" class="form-control" id="emailEmpresa" name="emailEmpresa" value="<?php echo $datosEmpresa->{'emailEmpresa'}; ?>" placeholder="Email">
                  </div>					  
                </div>  
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="telEmpresa">Tel&eacute;fono:</label>
                  <div class="col-sm-10">
                      <input required type="text" class="form-control" id="telEmpresa" name="telEmpresa" value="<?php echo $datosEmpresa->{'telEmpresa'}; ?>" placeholder="Tel&eacute;fono:">
                  </div>					  
                </div>  
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="cpEmpresa">CP:</label>
                  <div class="col-sm-10">
                      <input required type="text" class="form-control" id="cpEmpresa" name="cpEmpresa" value="<?php echo $datosEmpresa->{'cpEmpresa'}; ?>" placeholder="CP">
                  </div>					  
                </div>  
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="ciudadEmpresa">Ciudad:</label>
                  <div class="col-sm-10">
                      <input required type="text" class="form-control" id="ciudadEmpresa" name="ciudadEmpresa" value="<?php echo $datosEmpresa->{'ciudadEmpresa'}; ?>" placeholder="Ciudad">
                  </div>					  
                </div>  
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="estadoEmpresa">Estado:</label>
                  <div class="col-sm-10">
                      <input required type="text" class="form-control" id="estadoEmpresa" name="estadoEmpresa" value="<?php echo $datosEmpresa->{'estadoEmpresa'}; ?>" placeholder="Estado">
                  </div>					  
                </div>  
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="paisEmpresa">Pa&iacute;s:</label>
                  <div class="col-sm-10">
                      <input required type="text" class="form-control" id="paisEmpresa" name="paisEmpresa" value="<?php echo $datosEmpresa->{'paisEmpresa'}; ?>" placeholder="Pa&iacute;s">
                  </div>					  
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="anio">Año:</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="anio" id="anio" required>
                            <option value="2020">2020</option>
                            <option value="2021" selected>2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>       
                    </div>             
                </div>
                
                
                
                <div class="form-group">
                    <br>
                    <?php $submitBtn = array('class' => 'btn btn-primary center-block',  'value' => 'Modificar', 'name'=>'submit'); 
                    echo form_submit($submitBtn); ?>
               </div>
            </form>
        </div>
        <div class="col-md-2">
            <?php echo "<script>mensaje();</script>"; ?>
        </div>
    </div> <!-- / renglon-->
</div> <!-- /container -->
</body>	
</html>
