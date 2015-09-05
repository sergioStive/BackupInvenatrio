<?php

/**
 * Description of PuestoDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class PuestoDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Puestos WHERE IdPuesto = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El puesto fue eliminado exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Puestos (NombrePuesto, IdArea, IdResponsable) VALUES('" . $dto->getNombrePuesto() . "', " . $dto->getIdArea() . "," . $dto->getIdResponsable() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El puesto fue registrado exitosamente";
            } else {
                return "No se pudo registrar el puesto";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Puestos SET NombrePuesto = '" . $dto->getNombrePuesto() . "', IdArea = " . $dto->getIdArea() . ", IdResponsable = " . $dto->getIdResponsable() . " WHERE IdPuesto = " . $dto->getIdPuesto() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El puesto fue modificado exitosamente";
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
            $this->query = "SELECT * FROM Puestos;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysql_fetch_array($this->resultado)) {
                array_push($this->lista, new PuestoDTO($res['IdPuesto'], $res['NombrePuesto'], $res['IdArea'], $res['IdResponsable']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Puestos WHERE IdPuesto = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new PuestoDTO($res['IdPuesto'], $res['NombrePuesto'], $res['IdArea'], $res['IdResponsable']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verPuestoPorNombreYIdArea($id, $nombre) {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM Puestos WHERE IdArea = $id AND NombrePuesto = '$nombre';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new PuestoDTO($res['IdPuesto'], $res['NombrePuesto'], $res['IdArea'], $res['IdResponsable']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verPuestosPorArea($id) {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM Puestos WHERE IdArea = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysql_fetch_array($this->resultado)) {
                array_push($this->lista, new PuestoDTO($res['IdPuesto'], $res['NombrePuesto'], $res['IdArea'], $res['IdResponsable']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verPuestosPorResponsable($id) {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM Puestos WHERE IdResponsable = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysql_fetch_array($this->resultado)) {
                array_push($this->lista, new PuestoDTO($res['IdPuesto'], $res['NombrePuesto'], $res['IdArea'], $res['IdResponsable']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
