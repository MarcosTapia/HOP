<?php
/**
 * Obtiene el detalle de un proyecto especificado por
 * su identificador "idProyecto"
 */

require 'Proyectos.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['idProyecto'])) {
        $parametro = $_GET['idProyecto'];
        $retorno = Proyectos::getById($parametro);
        if ($retorno) {
            $proyecto["estado"] = 1;
            $proyecto["proyecto"] = $retorno;
            print json_encode($proyecto);
        } else {
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    } else {
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}

