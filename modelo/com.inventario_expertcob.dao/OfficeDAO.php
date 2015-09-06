<?php

/**
 * Description of OfficeDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class OfficeDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Office WHERE IdOffice = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La versión de office fue eliminada exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Office (NombreOffice) VALUES('" . $dto->getNombreOffice() . "');";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La versión de office fue registrada exitosamente";
            } else {
                return "No se pudo registrar la versión de office";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Office SET NombreOffice = '" . $dto->getNombreOffice() . "' WHERE IdOffice = " . $dto->getIdOffice() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La versión de office fue modificada exitosamente";
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
            $this->query = "SELECT * FROM Office;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new OfficeDTO($res['IdOffice'], $res['NombreOffice']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Office WHERE IdOffice = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new OfficeDTO($res['IdOffice'], $res['NombreOffice']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verOfficePorNombre($nombre) {
        try {
            $this->query = "SELECT * FROM Office WHERE NombreOffice = '$nombre';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new OfficeDTO($res['IdOffice'], $res['NombreOffice']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
