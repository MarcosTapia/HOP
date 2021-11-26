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
                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/proyectos_controller/actualizarProyectoFromFormulario" method="post">
                        <br>
                        <h4>Actualizaci&oacute;n del Proyecto</h4>
                        <input type="hidden" name="idProyecto" id="idProyecto" value="<?php echo $proyecto->{'idProyecto'}; ?>" />
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="descripcion">Nombre*:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $proyecto->{'descripcion_proyecto'}; ?>" placeholder="Nombre del Proyecto" required autofocus>
                            </div>					  
                        </div>  
                        <br>

                        <div class="form-group">
                            <center>
                            <?php $submitBtn = array('class' => 'btn btn-primary
                            ',  'value' => 'GUARDAR', 'name'=>'submit'); 
                            echo form_submit($submitBtn); ?>
                            
                            <a href="<?php echo base_url();?>index.php/proyectos_controller/mostrarProyectos">
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