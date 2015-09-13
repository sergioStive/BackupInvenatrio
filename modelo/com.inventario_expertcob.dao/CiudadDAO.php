<?php

/**
 * Description of CiudadDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class CiudadDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Ciudades WHERE IdCiudad = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La ciudad fue eliminada exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Ciudades (NombreCiudad) VALUES('" . $dto->getNombreCiudad() . "');";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La ciudad fue registrada exitosamente";
            } else {
                return "No se pudo registrar la ciudad";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar(CiudadDTO $dto) {
        try {
            $this->query = "UPDATE Ciudades SET NombreCiudad = '" . $dto->getNombreCiudad() . "' WHERE IdCiudad = " . $dto->getIdCiudad() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La ciudad fue modificada exitosamente";
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
            $this->query = "SELECT * FROM Ciudades;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new CiudadDTO($res['IdCiudad'], $res['NombreCiudad']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Ciudades WHERE IdCiudad = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new CiudadDTO($res['IdCiudad'], $res['NombreCiudad']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verCiudadPorNombre($nombre) {
        try {
            $this->query = "SELECT * FROM Ciudades WHERE NombreCiudad = $nombre;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new CiudadDTO($res['IdCiudad'], $res['NombreCiudad']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
