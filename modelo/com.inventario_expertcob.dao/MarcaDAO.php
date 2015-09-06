<?php

/**
 * Description of MarcaDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class MarcaDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Marcas WHERE IdMarca = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La marca fue eliminada exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Marcas (NombreMarca) VALUES('" . $dto->getNombreMarca() . "');";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La marca fue registrada exitosamente";
            } else {
                return "No se pudo registrar la marca";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Marcas SET NombreMarca = '" . $dto->getNombreMarca() . "' WHERE IdMarca = " . $dto->getIdMarca() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La marca fue modificada exitosamente";
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
            $this->query = "SELECT * FROM Marcas;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new MarcaDTO($res['IdMarca'], $res['NombreMarca']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Marcas WHERE IdMarca = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new MarcaDTO($res['IdMarca'], $res['NombreMarca']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verMarcaPorNombre($nombre) {
        try {
            $this->query = "SELECT * FROM Marcas WHERE NombreMarca = '$nombre';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new MarcaDTO($res['IdMarca'], $res['NombreMarca']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
