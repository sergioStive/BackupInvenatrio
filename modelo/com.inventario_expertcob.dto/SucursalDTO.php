<?php

/**
 * Description of SucursalDTO
 * Entidad representante de la tabla Sucursales en la base de datos 
 *
 * @author Erick Guzmán
 */
class SucursalDTO {

    private $idSucursal = 0;
    private $barrio = "";
    private $direccion = "";
    private $telefono = "";
    private $idCiudad = 0;

    public function __construct($idSucursal, $barrio, $direccion, $telefono, $idCiudad) {
        if (is_numeric($idSucursal) && is_numeric($idCiudad)) {
            $this->idSucursal = $idSucursal;
            $this->barrio = $barrio;
            $this->direccion = $direccion;
            $this->telefono = $telefono;
            $this->idCiudad = $idCiudad;
        } else {
            throw new Exception("El id de la sucursal, o el id de la ciudad no es valido");
        }
    }

    public function getIdSucursal() {
        return $this->idSucursal;
    }

    public function getBarrio() {
        return $this->barrio;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getIdCiudad() {
        return $this->idCiudad;
    }

    public function setIdSucursal($idSucursal) {
        if (is_numeric($idSucursal)) {
            $this->idSucursal = $idSucursal;
        } else {
            throw new Exception("El id de la sucursal no es valido");
        }
    }

    public function setBarrio($barrio) {
        $this->barrio = $barrio;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setIdCiudad($idCiudad) {
        if (is_numeric($idCiudad)) {
            $this->IdCiudad = $idCiudad;
        } else {
            throw new Exception("El id de la ciudad no es valido");
        }
    }

}
