<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        function armaCampoHabilidades(etapas){ 
            var habilidades = "";
            if ((document.getElementById("tipoUsuario").value == "2") && 
                    (document.getElementById("tipoUsuario").value != "")) {
                for(i=1; i<=etapas; i++) {
                    if (document.getElementById('chk' + i).checked) {
                        habilidades = habilidades + document.getElementById('chk' + i).value + "|";
                    }
                }
            }
            document.getElementById('habilidadesHdn').value = habilidades;
            //alert(habilidades);
            return true;
        }
        
        function cambiaHabilidades(etapas){
            if (document.getElementById("tipoUsuario").value == "2") {
                for(i=1; i<=etapas; i++) {
                    document.getElementById('chk' + i).disabled = false;
                }
            } else {
                for(i=1; i<=etapas; i++) {
                    document.getElementById('chk' + i).disabled = true;
                }
            }
        }
    </script>
</head>
<body>     
    <div class="container">
        <div class="row-fluid">
            <h4 style="margin-top: 150px;text-align: center">Alta de Usuario</h4>
            <br>
        </div>
        <div class="row-fluid">
            <div class="col-sm-6">
                <h4 style="margin-bottom: 20px; margin-top: -15px; text-align: center">Datos del Usuario</h4>
                <form onsubmit="javascript:return armaCampoHabilidades('<?php echo sizeof($etapas); ?>');" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/usuarios_controller/nuevoUsuarioFromFormulario" method="post">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="usuario">Usuario*:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required autofocus>
                  </div>					  
                </div>  

                <div class="form-group">
                    <label class="control-label col-sm-2" for="clave">Clave*:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="clave" name="clave" placeholder="Clave" required>
                    </div>					  
                </div> 

                <div class="form-group">
                    <label class="control-label col-sm-2" for="noEmpleado">No Empleado*:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="noEmpleado" name="noEmpleado" placeholder="No Empleado" required>
                    </div>					  
                </div> 
                    
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nombre">Nombre*:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>					  
                </div> 

                <div class="form-group">
                    <label class="control-label col-sm-2" for="apellido_paterno">Apellido Paterno:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" required>
                    </div>					  
                </div> 

                <div class="form-group">
                    <label class="control-label col-sm-2" for="apellido_materno">Apellido Materno:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" required>
                    </div>					  
                </div> 

                <div class="form-group">
                    <label class="control-label col-sm-2" for="tipoUsuario">Tipo de  Usuario*:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <select onchange="cambiaHabilidades('<?php echo sizeof($etapas); ?>');" class="form-control" name="tipoUsuario" id="tipoUsuario" required>
                                <option value="">Seleccionar uno...</option>
                                <option value="1">Administrador</option>
                                <option value="2">Operador</option>
                            </select>
                        </div>					  
                    </div>					  
                </div> 
            </div>	
            <div class="col-sm-6">
                <div class="form-group">
                    <h4 style="margin-bottom: 20px; margin-top: -15px; text-align: center">Habilidades</h4>
                    <?php 
                    $i=1;
                    foreach($etapas as $fila) {
                        echo "<div class='form-check'>";
                        echo "<input type='checkbox' name='chk".$i."' id='chk".$i."' value='".$fila->{'idEtapa'}."'";
                        echo "<label class='form-check-label' for='chk".$fila->{'idEtapa'}."'>&nbsp;&nbsp;&nbsp;".$fila->{'numeroOperacion'}." ".$fila->{'descripcion_operacion'}."</label>";
                        echo "</div>";                       
                        $i++;
                    }              
                    ?>
                </div> 
            </div>		
        </div>
        
        <div class="row-fluid">
            <br>
            <div class="form-group">
                <?php $submitBtn = array('class' => 'btn btn-primary
                ',  'value' => 'GUARDAR', 'name'=>'submit'); 
                echo form_submit($submitBtn); ?>

                <a href="<?php echo base_url();?>index.php/usuarios_controller/mostrarUsuarios">
                <button type="button" class="btn btn btn-success">REGRESAR</button>
                </a>
            </div> 
            <input type="hidden" name="habilidadesHdn" id="habilidadesHdn" />
            </form>
        </div>
    </div>
</body>
</html>