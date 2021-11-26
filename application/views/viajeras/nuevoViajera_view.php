<!DOCTYPE html lang="es">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        function armaCampoEtapas(etapas){ 
            var etapasStr = "";
            for(i=1; i<=etapas; i++) {
                if (document.getElementById('chk' + i).checked) {
                    etapasStr = etapasStr + document.getElementById('chk' + i).value + "|";
                }
            }
            if (etapasStr != "") {
                document.getElementById('etapasHdn').value = etapasStr;
                return true;
            } else {
                alert("Debes seleccionar las etapas correspondientes.");
                return false;
            }
        }
        
    </script>    
</head>
<body>      
    <div class="container">
        <div class="row-fluid">
            <h4 style="margin-top: 150px;text-align: center">Alta de Tarjeta Viajera</h4>
            <br>
        </div>
        <div class="row-fluid">
            <div class="col-sm-6">
                <h4 style="margin-bottom: 20px; margin-top: -15px; text-align: center">Detalle de la Viajera</h4>
                <form onsubmit="javascript:return armaCampoEtapas('<?php echo sizeof($etapas); ?>');" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/viajeras_controller/nuevoViajeraFromFormulario" method="post">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="sap">SAP*:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="sap" name="sap" placeholder="SAP" required autofocus>
                  </div>					  
                </div>  

                <div class="form-group">
                    <label class="control-label col-sm-2" for="variant">Variant*:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="variant" name="variant" placeholder="Variant" required>
                    </div>					  
                </div> 

                <div class="form-group">
                    <label class="control-label col-sm-2" for="standard">Standard*:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="standard" name="standard" placeholder="Standard" required>
                    </div>					  
                </div> 
                    
                <div class="form-group">
                    <label class="control-label col-sm-2" for="area">Area*:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <select class="form-control" name="area" id="area" required>
                                <option value="">Seleccionar uno...</option>
                                <?php
                                foreach ($areas as $fila) {
                                    echo "<option value=".$fila->{'idArea'}.">".$fila->{'descripcion'}."</option>"; 
                                }
                                ?>                                
                            </select>
                        </div>					  
                    </div>					  
                </div> 
                    
                <div class="form-group">
                    <label class="control-label col-sm-2" for="proyecto">Proyecto*:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <select class="form-control" name="proyecto" id="proyecto" required>
                                <option value="">Seleccionar uno...</option>
                                <?php
                                foreach ($proyectos as $fila) {
                                    echo "<option value=".$fila->{'idProyecto'}.">".$fila->{'descripcion_proyecto'}."</option>"; 
                                }
                                ?>                                
                            </select>
                        </div>					  
                    </div>					  
                </div> 
                    
            </div>	
            <div class="col-sm-6">
                <div class="form-group">
                    <h4 style="margin-bottom: 20px; margin-top: -15px; text-align: center">Etapas</h4>
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
                <input type="hidden" name="etapasHdn" id="etapasHdn" />
            </div>		
        </div>
        
        <div class="row-fluid">
            <br>
            <div class="form-group">
                <?php $submitBtn = array('class' => 'btn btn-primary
                ',  'value' => 'GUARDAR', 'name'=>'submit'); 
                echo form_submit($submitBtn); ?>

                <a href="<?php echo base_url();?>index.php/viajeras_controller/mostrarViajeras">
                <button type="button" class="btn btn btn-success">REGRESAR</button>
                </a>
            </div> 
            <input type="hidden" name="habilidadesHdn" id="habilidadesHdn" />
            </form>
        </div>
        
    </div>
</body>
</html>