<?php

/**
 * Description of CompraDAO
 *
 * @author Erick
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class CompraDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Compras WHERE NumFactura = '$id';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La compra fue eliminada exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Compras VALUES('" . $dto->getNumFactura() . "', " . $dto->getValor() . ", '" . $dto->getFecha() . "', '" . $dto->getGarantia() . "', " . $dto->getIdProveedor() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La compra fue registrada exitosamente";
            } else {
                return "No se pudo registrar la compra";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Compras SET Valor = " . $dto->getValor() . ", Fecha = '" . $dto->getFecha() . "', Grarantia = '" . $dto->getGarantia() . "', IdProveedor = " . $dto->getIdProveedor() . " WHERE NumFactura = '" . $dto->getNumFactura() . "';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La compra fue modificada exitosamente";
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
            $this->query = "SELECT * FROM Compras;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new CompraDTO($res['NumFactura'], $res['Valor'], $res['Fecha'], $res['Garantia'], $res['IdProveedor']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Compras WHERE NumFactura = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new CompraDTO($res['NumFactura'], $res['Valor'], $res['Fecha'], $res['Garantia'], $res['IdProveedor']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verCompraPorIdProveedor($id) {
        try {
            $this->query = "SELECT * FROM Compras WHERE IdProveedor = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new CompraDTO($res['NumFactura'], $res['Valor'], $res['Fecha'], $res['Garantia'], $res['IdProveedor']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
