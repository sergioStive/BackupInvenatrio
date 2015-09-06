<?php

/**
 * Description of SucursalDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class SucursalDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Sucursales WHERE IdSucursal = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La sucursal fue eliminada exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Sucursales (Barrio, Direccion, Telefono, IdCiudad) VALUES('" . $dto->getBarrio() . "','" . $dto->getDireccion() . "','" . $dto->getTelefono() . "', " . $dto->getIdCiudad() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La sucursal fue registrada exitosamente";
            } else {
                return "No se pudo registrar la sucursal ";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Sucursales SET Barrio = '" . $dto->getBarrio() . "', Direccion = '" . $dto->getDireccion() . "', Telefono = '" . $dto->getTelefono() . "', IdCiudad = " . $dto->getIdCiudad() . " WHERE IdSucursal = " . $dto->getIdSucursal() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La sucursal fue modificada exitosamente";
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
            $this->query = "SELECT * FROM Sucursales;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new SucursalDTO($res['IdSucursal'], $res['Barrio'], $res['Direccion'], $res['Telefono'], $res['IdCiudad']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Sucursales WHERE IdSucursal = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new SucursalDTO($res['IdSucursal'], $res['Barrio'], $res['Direccion'], $res['Telefono'], $res['IdCiudad']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verSucursalPorCiudadYDireccion($ciudad, $direccion) {
        try {
            $this->query = "SELECT * FROM Sucursales WHERE IdCiudad = '$ciudad' AND Direccion = '$direccion';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new SucursalDTO($res['IdSucursal'], $res['Barrio'], $res['Direccion'], $res['Telefono'], $res['IdCiudad']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
