<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css" />
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>     
    <div class="container">
        <div class="row-fluid">
            <div class="col-sm-1">		
            </div>		
            <div class="col-sm-6">
                <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/ordenes_controller/nuevoOrdenFromFormulario" method="post">
                    <br>
                    <h4>Nueva Orden</h4>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="numeroOrden">Número Orden*:</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" id="numeroOrden" name="numeroOrden" placeholder="Número de Orden" required autofocus>
                      </div>					  
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="cantidad">Cantidad*:</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="cantidad" required>
                        </div>					  
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="viajera">Viajera*:</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                            <select class="form-control" name="viajera" id="viajera" required>
                                <option value="">Seleccionar uno...</option>
                                <?php foreach($viajeras as $fila) {
                                    echo "<option value=".$fila->{'idViajera'}.">".$fila->{'sap'}."</option>";
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

                        <a href="<?php echo base_url();?>index.php/ordenes_controller/mostrarOrdenes">
                        <button type="button" class="btn btn btn-success">REGRESAR</button>
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