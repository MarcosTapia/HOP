<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>      
    <div class="container"> <!--class="container-fluid" -->
            <div class="row-fluid">
                <div class="col-sm-9">
                    <form onsubmit="javascript:return verificaCampos();" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/maquinaria_controller/actualizarMaquinaFromFormulario" method="post">
                        <br>
                        <h4>Actualizaci&oacute;n de M&aacute;quina</h4>
                        <input type="hidden" name="idMaquina" id="idMaquina" value="<?php echo $maquina->{'idMaquina'}; ?>" />
                        <div class="form-group">
                        <label class="control-label col-sm-2" for="numeromaq">N&uacute;mero*:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="numeromaq" name="numeromaq" value="<?php echo $maquina->{'numero_maquina'}; ?>" placeholder="N&uacute;mero de M&aacute;quina" required autofocus>
                        </div>					  
                        </div>  

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nombremaq">Nombre*:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombremaq" name="nombremaq" value="<?php echo $maquina->{'nombre_maquina'}; ?>" placeholder="Nombre de la M&aacute;quina" required>
                            </div>					  
                        </div> 

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="etapa">Etapa*:</label>
                          <div class="col-sm-10">
                            <div class="input-group">
                                <select class="form-control" name="etapa" id="etapa" required>
                                    <option value="">Seleccionar uno...</option>
                                    <?php foreach($etapas as $fila) {
                                        if ($maquina->{'idEtapa'} == $fila->{'idEtapa'}) {
                                            echo "<option value=".$fila->{'idEtapa'}." selected>".$fila->{'numeroOperacion'}." ".$fila->{'descripcion_operacion'}."</option>";
                                        } else {
                                            echo "<option value=".$fila->{'idEtapa'}.">".$fila->{'numeroOperacion'}." ".$fila->{'descripcion_operacion'}."</option>";
                                        }
                                    } ?>
                                </select>
                            </div>					  
                          </div>					  
                        </div>   
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="areas">&Aacute;rea*:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select class="form-control" name="areas" id="areas" required>
                                        <option value="">Seleccionar uno...</option>
                                        <?php foreach($areas as $fila) {
                                            if ($maquina->{'idArea'} == $fila->{'idArea'}) {
                                                echo "<option value=".$fila->{'idArea'}." selected>".$fila->{'descripcion'}."</option>";
                                            } else {
                                                echo "<option value=".$fila->{'idArea'}.">".$fila->{'descripcion'}."</option>";
                                            }
                                        } ?>
                                    </select>
                                </div>					  
                            </div>					  
                        </div>    

                        <div class="form-group">
                            <br>
                            <center>
                            <?php $submitBtn = array('class' => 'btn btn-primary
                            ',  'value' => 'GUARDAR', 'name'=>'submit'); 
                            echo form_submit($submitBtn); ?>
                            
                            <a href="<?php echo base_url();?>index.php/maquinaria_controller/mostrarMaquinas">
                            <button type="button" class="btn btn-success">REGRESAR</button>
                            </a>
                            </center>
                        </div>
                    </form>
                </div>	
                <div class="col-sm-3">		
                </div>		
            </div>
	</div>
</body>
</html>