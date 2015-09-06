<?php

/**
 * Description of SistemaOperativoDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class SistemaOperativoDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM SistemaOperativos WHERE IdSisOperativo = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El sistema operativo fue eliminado exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO SistemaOperativos (NombreSisOperativo) VALUES('" . $dto->getNombreSistemaOperativo() . "');";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El sistema operativo fue registrado exitosamente";
            } else {
                return "No se pudo registrar el sistema operativo";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE SistemaOperativos SET NombreSisOperativo = '" . $dto->getNombreSistemaOperativo() . "' WHERE IdSisOperativo = " . $dto->getIdSistemaOperativo() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El sistema operativo fue modificado exitosamente";
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
            $this->query = "SELECT * FROM SistemaOperativos;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new SistemaOperativoDTO($res['IdSisOperativo'], $res['NombreSisOperativo']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM SistemaOperativos WHERE IdSisOperativo = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new SistemaOperativoDTO($res['IdSisOperativo'], $res['NombreSisOperativo']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verSisOperativoPorNombre($nombre) {
        try {
            $this->query = "SELECT * FROM SistemaOperativos WHERE nombre_so = '$nombre';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new SistemaOperativoDTO($res['IdSisOperativo'], $res['NombreSisOperativo']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
