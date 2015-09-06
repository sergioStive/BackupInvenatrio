<?php

/**
 * Description of OficinaDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class OficinaDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Oficinas WHERE IdOficina = $id;";
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
            $this->query = "INSERT INTO Oficinas (NombreOficina, IdSucursal) VALUES('" . $dto->getNombreOficina() . "'," . $dto->getIdSucursal() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La oficina fue registrada exitosamente";
            } else {
                return "No se pudo registrar la oficina";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Oficinas SET NombreOficina = '" . $dto->getNombreOficina() . "', IdSucursal = " . $dto->getIdSucursal() . " WHERE IdOficina = " . $dto->getIdOficina() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La oficina fue modificada exitosamente";
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
            $this->query = "SELECT * FROM Oficinas;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new OficinaDTO($res['IdOficina'], $res['NombreOficina'], $res['IdSucursal']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Oficinas WHERE IdOficina = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new OficinaDTO($res['IdOficina'], $res['NombreOficina'], $res['IdSucursal']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function consultarOficinaPorNombreYIdSucursal($nombre, $idSucursal) {
        try {
            $this->query = "SELECT * FROM Oficinas WHERE NombreOficina = '$nombre' AND IdSucursal = $idSucursal;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new OficinaDTO($res['IdOficina'], $res['NombreOficina'], $res['IdSucursal']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verOficinasPorSucursal($id) {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM Oficinas WHERE IdSucursal = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new OficinaDTO($res['IdOficina'], $res['NombreOficina'], $res['IdSucursal']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
