<?php

/**
 * Description of MubleEncerDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class MuebleEnserDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM MuebleEnseres WHERE IdMuebleEnser = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El mueble/enser fue eliminado exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO MuebleEnseres (Descripcion, Cantidad, Valor, IdEstado, IdPuesto) VALUES('" . $dto->getDescripcion() . "', " . $dto->getCantidad() . ",'" . $dto->getValor() . "', " . $dto->getIdEstado() . ", " . $dto->getIdPuesto() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El mueble/enser fue registrado exitosamente";
            } else {
                return "No se pudo registrar el mueble/enser";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar(MuebleEnserDTO $dto) {
        try {
            $this->query = "UPDATE MuebleEnseres SET Descripcion = '" . $dto->getDescripcion() . "' , Cantidad = " . $dto->getCantidad() . ", Valor = '" . $dto->getValor() . "', IdEstado = " . $dto->getIdEstado() . ", IdPuesto = " . $dto->getIdPuesto() . " WHERE IdMuebleEnser = " . $dto->getIdMuebleEnser() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El mueble/enser fue modificado exitosamente";
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
            $this->query = "SELECT * FROM MuebleEnseres;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new MuebleEnserDTO($res['IdMuebleEnser'], $res['Descripcion'], $res['Cantidad'], $res['Valor'], $res['IdEstado'], $res['IdPuesto']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM MuebleEnseres WHERE IdMuebleEnser = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new MuebleEnserDTO($res['IdMuebleEnser'], $res['Descripcion'], $res['Cantidad'], $res['Valor'], $res['IdEstado'], $res['IdPuesto']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verMueblesEnseresPorIdDePuesto($id) {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM MuebleEnseres WHERE IdPuesto = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new MuebleEnserDTO($res['IdMuebleEnser'], $res['Descripcion'], $res['Cantidad'], $res['Valor'], $res['IdEstado'], $res['IdPuesto']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verMuebleEnserPorIdDeEstado($id) {
        try {
            $this->query = "SELECT * FROM MuebleEnseres WHERE IdEstado = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new MuebleEnserDTO($res['IdMuebleEnser'], $res['Descripcion'], $res['Cantidad'], $res['Valor'], $res['IdEstado'], $res['IdPuesto']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
