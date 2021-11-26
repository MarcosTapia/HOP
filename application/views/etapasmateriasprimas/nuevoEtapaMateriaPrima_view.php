<!DOCTYPE html lang="es">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        function armaCampoMateriasPrimas(materiasprimas){ 
            var materiaprimaStr = "";
            for(i=1; i<=materiasprimas; i++) {
                if (document.getElementById('chk' + i).checked) {
                    materiaprimaStr = materiaprimaStr + document.getElementById('chk' + i).value + "|";
                }
            }
            document.getElementById('materiaprimaHdn').value = materiaprimaStr;
            return true;
        }
    </script>    
</head>
<body>      
    <div class="container">
        <div class="row-fluid">
            <div class="col-sm-1">		
            </div>		
            <div class="col-sm-6">
                <form onsubmit="javascript:return armaCampoMateriasPrimas('<?php echo sizeof($materiasprimas); ?>');" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/etapasmateriasprimas_controller/nuevoEtapaMateriaPrimaFromFormulario" method="post">
                    <br>
                    <h4>Alta de Etapa - Materia Prima</h4>
                    <br>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="etapa">Etapa*:</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select class="form-control" name="etapa" id="etapa" required>
                                    <option value="">Seleccionar uno...</option>
                                    <?php
                                    foreach ($etapas as $fila) {
                                        echo "<option value='".$fila->{'idEtapa'}."'>".$fila->{'numeroOperacion'}." ".$fila->{'descripcion_operacion'}."</option>";
                                    }
                                    ?>
                                </select>
                            </div>					  
                        </div>					  
                    </div> 
                    
                    <div class="form-group">
                        <br>
                        <h5 style="margin-bottom: 20px; margin-top: -15px; text-align: center">Selecciona la materia prima</h5>
                        <?php 
                        $i=1;
                        foreach($materiasprimas as $fila) {
                            echo "<div class='form-check'>";
                            echo "<input type='checkbox' name='chk".$i."' id='chk".$i."' value='".$fila->{'idMateriaPrima'}."'";
                            echo "<label class='form-check-label' for='chk".$fila->{'idMateriaPrima'}."'>&nbsp;&nbsp;&nbsp;".$fila->{'descripcion_materiaprima'}." - SAP: ".$fila->{'nosap'}."</label>";
                            echo "</div>";                       
                            $i++;
                        }              
                        ?>
                    </div> 
                    <input type="hidden" name="materiaprimaHdn" id="materiaprimaHdn" />
                    
                    <br><br>
                    <div class="form-group">
                        <center>
                        <?php $submitBtn = array('class' => 'btn btn-primary
                        ',  'value' => 'GUARDAR', 'name'=>'submit'); 
                        echo form_submit($submitBtn); ?>

                        <a href="<?php echo base_url();?>index.php/etapasmateriasprimas_controller/mostrarEtapasMateriasPrimas">
                        <button type="button" class="btn btn-success">REGRESAR</button>
                        </a>
                        </center>
                    </div> 
                </form>
            </div>	
            <div class="col-sm-5">		
            </div>		
        </div>
    </div>
</body>
</html>