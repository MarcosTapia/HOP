<?php

/**
 * Representa el la estructura de los Proyectos
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class Proyectos
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Proyectos'
     * @return array Datos del registro
     */
    public static function getAll() {
        $consulta = "SELECT * FROM proyectos";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de un Proyecto con un identificador determinado
     * @param $idProyecto Identificador del proyecto
     * @return mixed
     */
    public static function getById($idProyecto) {
        $consulta = "SELECT * FROM proyectos WHERE idProyecto = ?";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idProyecto));
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     */
    public static function update($idProyecto,$descripcion) {  
        $consulta = "UPDATE proyectos SET descripcion_proyecto=? WHERE idProyecto=?";
        $cmd = Database::getInstance()->getDb()->prepare($consulta);
        $cmd->execute(array($descripcion,$idProyecto));
        return $cmd;
    }

    /**
     * Insertar un nuevo proyecto
     * @param $nombre      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insert($descripcion) {
        $comando = "INSERT INTO proyectos (descripcion_proyecto) VALUES(?)";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(
            array($descripcion)
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     * @param $idProyecto identificador de la tabla Proyectos
     * @return bool Respuesta de la eliminacion
     */
    public static function delete($idProyecto) {
        $comando = "DELETE FROM proyectos WHERE idProyecto=?";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($idProyecto));
    }
    
}

?>