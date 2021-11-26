<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php if ($nombre_Empresa != "") { echo $nombre_Empresa; }?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
  
    <style type="text/css" title="currentStyle">
            @import "<?php echo base_url();?>media/css/demo_page.css";
            @import "<?php echo base_url();?>media/css/demo_table.css";
    </style>
    <style>
        button {
            border:3px solid brown;
            border-radius:22px;
            width:300px;            
        }  
    </style>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>media/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
                $('#example').dataTable( {
                    "aLengthMenu": [ [10, 25, 50, 100, 500, 1000, -1], [10, 25, 50,  100, 500, 1000, "All"] ],
                    "sPaginationType": "full_numbers",
                    'aaSorting': [[ 1, 'asc' ]]
                } );
        } );        

        function preguntar() {
            var conf = confirm("¿Seguro que quieres eliminar?");
            if (conf == false) {
                return false;
            } else {
                return true;
            }
        }
        
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
<div class="col-md-12">
    <?php 
        $correcto = $this->session->flashdata('correcto');
        if ($correcto) { ?>
    <span id="registroCorrecto" style="color:blue;"><?= $correcto ?></span>
    <?php } ?>
    <br>
    <h3 style="background-color:#C13030; color:white;text-align: center">Trazabilidad de Ordenes</h3>
    <br>
    <div class="table-responsive">     
        <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Fecha Orden</th>
                    <th>Etapa</th>
                    <th>Materia Prima</th>
                    <th>Fecha Mat. Prima</th>
                    <th>Operador</th>
                    <th>Máquina</th>
                    <th>Standard</th>
                    <th>Cant. Orden</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($trazabilidades) {
                    $i=1;
                    foreach($trazabilidades as $fila) { ?>
                        <tr id="fila-<?php echo $fila->{'idTrazabilidadMateriaPrima'} ?>">
                            <td><?php echo $fila->{'numeroOrden'} ?></td>
                            <td><?php echo $fila->{'fecha'} ?></td>
                            <td><?php echo $fila->{'numeroOperacion'}." ".$fila->{'descripcion_operacion'} ?></td>
                            <td><?php echo $fila->{'descripcion_materiaprima'}; ?></td>
                            <td><?php echo $fila->{'fechaMateriaPrima'}; ?></td>
                            <td><?php echo $fila->{'nombre'}." ".$fila->{'apellido_paterno'}; ?></td>
                            <td><?php echo $fila->{'nombre_maquina'}." ".$fila->{'numero_maquina'}; ?></td>
                            <td><?php echo $fila->{'standard'}; ?></td>
                            <td><?php echo $fila->{'cantidad_orden'}; ?></td>
                        </tr>
                      <?php 
                  
                      $i++;  
                    }   
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Orden</th>
                    <th>Fecha Orden</th>
                    <th>Etapa</th>
                    <th>Materia Prima</th>
                    <th>Fecha Mat. Prima</th>
                    <th>Operador</th>
                    <th>Máquina</th>
                    <th>Standard</th>
                    <th>Cant. Orden</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div> <!-- /division renglon en 12-->
</div> <!-- / renglon-->
</div> <!-- /container -->
</body>	
</html>
