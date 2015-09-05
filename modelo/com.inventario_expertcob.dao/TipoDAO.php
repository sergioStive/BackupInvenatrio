<?php

/**
 * Description of TipoDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class TipoDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Tipos WHERE IdTipo = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El Tipo de dispositivo fue eliminado exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Tipos (NombreTipo, IdClase) VALUES('" . $dto->getNombreTipo() . "', " . $dto->getIdClase() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El tipo de dispositivo fue registrado exitosamente";
            } else {
                return "No se pudo registrar el tipo de dispositivo";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Tipos SET NombreTipo = '" . $dto->getNombreTipo() . "', IdClase = " . $dto->getIdClase() . " WHERE IdTipo = " . $dto->getIdTipo() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El tipo de dispositivo fue modificado exitosamente";
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
            $this->query = "SELECT * FROM Tipos;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysql_fetch_array($this->resultado)) {
                array_push($this->lista, new TipoDTO($res['IdTipo'], $res['NombreTipo'], $res['IdClase']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Tipos WHERE IdTipo = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new TipoDTO($res['IdTipo'], $res['NombreTipo'], $res['IdClase']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verTipoPorNombre($nombre) {
        try {
            $this->query = "SELECT * FROM Tipos WHERE NombreTipo = '$nombre';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new TipoDTO($res['IdTipo'], $res['NombreTipo'], $res['IdClase']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verTiposPorIdDeClase($id) {
        try {
            $this->query = "SELECT * FROM Tipos WHERE IdClase = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new TipoDTO($res['IdTipo'], $res['NombreTipo'], $res['IdClase']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
