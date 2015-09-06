<?php

/**
 * Description of ProveedorDAO
 *
 * @author Erick
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class ProveedorDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Proveedores WHERE IdProveedor = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El proveedor fue eliminado exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Proveedor VALUES(" . $dto->getIdProveedor() . ",'" . $dto->getNombreProveedor() . "','" . $dto->getDireccion() . "', '" . $dto->getTelefono() . "', '" . $dto->getEmail() . "');";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El proveedor fue registrado exitosamente";
            } else {
                return "No se pudo registrar el proveedor";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Proveedores SET NombreProveedor = '" . $dto->getNombreProveedor() . "', Direccion = '" . $dto->getDireccion() . "', Telefono = '" . $dto->getTelefono() . "', Email = '" . $dto->getEmail() . "' WHERE IdProveedor = " . $dto->getIdProveedor() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El proveedor fue modificado exitosamente";
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
            $this->query = "SELECT * FROM Proveedores;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new ProveedorDTO($res['IdProveedor'], $res['NombreProveedor'], $res['Direccion'], $res['Telefono'], $res['Email']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Proveedores WHERE IdProveedor = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new ProveedorDTO($res['IdProveedor'], $res['NombreProveedor'], $res['Direccion'], $res['Telefono'], $res['Email']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
