<?php

/**
 * Description of RevisionDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class RevisionDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Revisiones WHERE IdRevision = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La revisión fue eliminada exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Revisiones (Fecha, Mantenimiento, Responsable, Observacion, SerialEquipo) VALUES('" . $dto->getFecha() . "', '" . $dto->getMantenimiento() . "', '" . $dto->getResponsable() . "', '" . $dto->getObservacion() . "', " . $dto->getIdDispositivo() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La revisión fue registrada exitosamente";
            } else {
                return "No se pudo registrar la revisión";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Revisiones SET Fecha = '" . $dto->getFecha() . "', Mantenimiento = '" . $dto->getMantenimiento() . "', Responsable = '" . $dto->getResponsable() . "', Observación = '" . $dto->getObservacion() . "', SerialEquipo = '" . $dto->getIdDispositivo() . "', WHERE IdRevision = " . $dto->getIdRevision() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La revisión fue modificada exitosamente";
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
            $this->query = "SELECT * FROM Revisiones;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new RevisionDTO($res['IdRevision'], $res['Fecha'], $res['Mantenimiento'], $res['Responsable'], $res['Observacion'], $res['SerialEquipo']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Revisiones WHERE id_revision = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new RevisionDTO($res['IdRevision'], $res['Fecha'], $res['Mantenimiento'], $res['Responsable'], $res['Observacion'], $res['SerialEquipo']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verRevisionesPorIdDeEquipo($id) {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM Revisiones WHERE SerialEquipo = $id ORDER BY Fecha DESC;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new RevisionDTO($res['IdRevision'], $res['Fecha'], $res['Mantenimiento'], $res['Responsable'], $res['Observacion'], $res['SerialEquipo']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
