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
        //'iDisplayLength':100
        
        $(document).ready(function() {
                $('#tbl_maquinas').dataTable( {
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
    <h3 style="background-color:#C13030; color:white;text-align: center">Administraci&oacute;n de Maquinaria</h3>
    <br>
    <p>
        <a class="btn btn-primary" href="nuevoMaquina">Nueva M&aacute;quina</a>
    </p>
    <div class="table-responsive">     
        <table class="table" cellpadding="0" cellspacing="0" border="0" class="display" id="tbl_maquinas">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Número</th>
                    <th>Nombre M&aacute;quina</th>
                    <th>Número Operación</th>
                    <th>Operación</th>
                    <th>Area</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($maquinas) {
                    $i=1;
                    foreach($maquinas as $fila) { ?>
                        <tr id="fila-<?php echo $fila->{'idMaquina'} ?>">
                            <td><?php echo $fila->{'idMaquina'} ?></td>
                            <td><?php echo $fila->{'numero_maquina'} ?></td>
                            <td><?php echo $fila->{'nombre_maquina'} ?></td>
                            <td><?php echo $fila->{'numeroOperacion'} ?></td>
                            <td><?php echo $fila->{'descripcion_operacion'} ?></td>
                            <td><?php echo $fila->{'descripcion'} ?></td>
                            <td>
                            <a href="actualizarMaquina/<?php echo $fila->{'idMaquina'} ?>"><img src="<?php echo base_url(); ?>/images/sistemaicons/modificar.ico" alt="Editar" title="Editar" /></a>                            
                            <a href="eliminarMaquina/<?php echo $fila->{'idMaquina'} ?>/<?php echo $fila->{'idMaquina'} ?>"  onclick="javascript: return preguntar()"><img src="<?php echo base_url(); ?>/images/sistemaicons/borrar2.ico" alt="Borrar" title="Borrar" /></a>
                            </td>
                        </tr>
                      <?php 
                      $i++;  
                    }   
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Número</th>
                    <th>Nombre M&aacute;quina</th>
                    <th>Número Operación</th>
                    <th>Operación</th>
                    <th>Area</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        <?php echo "<script>mensaje();</script>"; ?>
    </div>
</div> <!-- /division renglon en 12-->
</div> <!-- / renglon-->
</div> <!-- /container -->
</body>	
</html>
