<?php

/**
 * Description of EstadoDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class EstadoDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Estados WHERE IdEstado = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El estado fue eliminado exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Estados (Descripcion) VALUES('" . $dto->getDescripcion() . "');";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El estado fue registrado exitosamente";
            } else {
                return "No se pudo registrar el estado";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Estados SET Descripcion = '" . $dto->getDescripcion() . "' WHERE IdEstado = " . $dto->getIdEstado() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El estado fue modificado exitosamente";
            } else {
                return "No se pudo modificar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verTodos() {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM Estados;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new EstadoDTO($res['IdEstado'], $res['Descripcion']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Estados WHERE IdEstado = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new EstadoDTO($res['IdEstado'], $res['Descripcion']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verEstadoPorDescripcion($descripcion) {
        try {
            $this->query = "SELECT * FROM Estados WHERE Descripcion = '$descripcion';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new EstadoDTO($res['IdEstado'], $res['Descripcion']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
