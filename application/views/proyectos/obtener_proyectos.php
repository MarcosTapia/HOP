<?php
/**
 * Obtiene todas los proyectos de la base de datos
 */

require 'Proyectos.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $proyectos = Proyectos::getAll();
    if ($proyectos) {
        $datos["estado"] = 1;
        $datos["proyectos"] = $proyectos;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

