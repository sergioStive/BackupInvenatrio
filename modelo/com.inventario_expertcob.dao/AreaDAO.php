<?php

/**
 * Description of AreaDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class AreaDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Areas WHERE IdArea = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La oficina fue eliminada exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Areas (NombreArea, IdOficina) VALUES('" . $dto->getNombreArea() . "'," . $dto->getIdOficina() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La área fue registrada exitosamente";
            } else {
                return "No se pudo registrar la área";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Areas SET NombreArea = '" . $dto->getNombreArea() . "', IdOficina = " . $dto->getIdOficina() . " WHERE IdArea = " . $dto->getIdArea() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La área fue modificada exitosamente";
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
            $this->query = "SELECT * FROM Areas;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysql_fetch_array($this->resultado)) {
                array_push($this->lista, new AreaDTO($res['IdArea'], $res['NombreArea'], $res['IdOficina']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Areas WHERE IdArea = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new AreaDTO($res['IdArea'], $res['NombreArea'], $res['IdOficina']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function consultarAreaPorNombreYIdOficna($nombre, $idOficina) {
        try {
            $this->query = "SELECT * FROM Areas WHERE NombreArea = '$nombre' AND IdOficina = $idOficina;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new AreaDTO($res['IdArea'], $res['NombreArea'], $res['IdOficina']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verAreasPorOficina($id) {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM Areas WHERE IdOficina = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysql_fetch_array($this->resultado)) {
                array_push($this->lista, AreaDTO($res['IdArea'], $res['NombreArea'], $res['IdOficina']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
