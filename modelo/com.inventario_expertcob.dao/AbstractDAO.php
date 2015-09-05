<?php

/**
 * Description of AbstractDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.utilitarias/Conexion.php';

abstract class AbstractDAO {

    protected $conexion = null; //variable que tendra la instancia de la clase Conexion para acceder a la base de datos
    protected $lista = null; //variable que se utilizara como array en cada una de las clases que hereden de esta clase
    protected $dto = null; //variable que se utilizara como objeto DTO en cada una de las clases que hereden de esta clase
    protected $resultado = null; //variable que tendra el resultado de la ejecución del Query en la base de datos
    protected $query = ""; //variable que tendra el Query a ejecutar en la base de datos

    protected function __construct() {
        $this->conexion = Conexion::get_instance(); //inicializo la variable con la instancia de la clase Conexion 
    }

    protected abstract function eliminar($id);

    protected abstract function insertar($dto);

    protected abstract function modificar($dto);

    protected abstract function verTodos();

    protected abstract function verUno($id);
}
