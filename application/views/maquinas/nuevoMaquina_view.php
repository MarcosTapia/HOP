<!DOCTYPE html lang="es">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap3-typeahead.min.js" type="text/javascript"></script>		
   
</head>
<body>      
    <div class="container"> <!--class="container-fluid" -->
        <div class="row-fluid">
            <div class="col-sm-1">		
            </div>		
            <div class="col-sm-6">
                <form onsubmit="javascript:return verificaCampos();" class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/maquinaria_controller/nuevoMaquinaFromFormulario" method="post">
                    <br>
                    <h4>Alta de Maquinaria</h4>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="numeromaq">N&uacute;mero*:</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="numeromaq" name="numeromaq" placeholder="N&uacute;mero de M&aacute;quina" required autofocus>
                      </div>					  
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombremaq">Nombre*:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="nombremaq" name="nombremaq" placeholder="Nombre de la M&aacute;quina" required>
                        </div>					  
                    </div> 

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="etapa">Etapa*:</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                            <select class="form-control" name="etapa" id="etapa" required>
                                <option value="">Seleccionar uno...</option>
                                <?php foreach($etapas as $fila) {
                                    echo "<option value=".$fila->{'idEtapa'}.">".$fila->{'numeroOperacion'}." ".$fila->{'descripcion_operacion'}."</option>";
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
                                    echo "<option value=".$fila->{'idArea'}.">".$fila->{'descripcion'}."</option>";
                                } ?>
                            </select>
                        </div>					  
                      </div>					  
                    </div>  
    <br>
                    <div class="form-group">
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
            <div class="col-sm-5">		
            </div>		
        </div>
    </div>
    
    <script>
        $(document).ready(function(e){
            //Para autocomplete nombre de maquina
            var site_url = "<?php echo site_url(); ?>";        
            var input2 = $("input[name=nombremaq]");
            $.get(site_url+'index.php/maquinaria_controller/buscaMaquina', function(data2){                                
                                    input2.typeahead({
                                        source: data2,
                                        minLength: 1,
                                    });
            }, 'json');
        });     
    </script>    
</body>
</html>