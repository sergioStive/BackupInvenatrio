<?php

/**
 * Description of DispositivoCompraDAO
 *
 * @author ErickGuzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class DispositivoCompraDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        return $id;
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO DispositivoCompras VALUES('" . $dto->getSerialDispositivo() . "', " . $dto->getIdCompra() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El enlace entre dispositivos y compras fue registrado exitosamente";
            } else {
                return "No se pudo registrar el enlace entre dispositivos y compras";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar(DispositivoCompraDTO $dto) {
        try {
            $this->query = "UPDATE DispositivoCompras SET SerialDispositivo = '" . $dto->getSerialDispositivo() . "' WHERE IdCompra = " . $dto->getIdCompra() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El enlace entre dispositivos y compras fue modificado exitosamente";
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
            $this->query = "SELECT * FROM DispositivoCompras;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new DispositivoCompraDTO($res['SerialDispositivo'], $res['IdCompra']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM DispositivoCompras WHERE SerialDispositivo = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new EstadoDTO($res['IdEstado'], $res['Descripcion']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verTodosPorIdCompra($id) {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM DispositivoCompras WHERE IdCompra = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new DispositivoCompraDTO($res['SerialDispositivo'], $res['IdCompra']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
