<?php

/**
 * Description of OficinaDTO
 * Entidad representante de la tabla Oficinas en la base de datos 
 *
 * @author Erick Guzmán
 */
class OficinaDTO {

    private $idOficina = 0;
    private $nombreOficina = "";
    private $idSucursal = 0;

    public function __construct($idOficina, $nombreOficina, $idSucursal) {
        if (is_numeric($idOficina) && is_numeric($idSucursal)) {
            $this->idOficina = $idOficina;
            $this->nombreOficina = $nombreOficina;
            $this->idSucursal = $idSucursal;
        } else {
            throw new Exception("Algunos de los datos no son validos");
        }
    }

    public function getIdOficina() {
        return $this->idOficina;
    }

    public function getNombreOficina() {
        return $this->nombreOficina;
    }

    public function getIdSucursal() {
        return $this->idSucursal;
    }

    public function setIdOficina($idOficina) {
        if (is_numeric($idOficina)) {
            $this->idOficina = $idOficina;
        } else {
            throw new Exception("El número de oficina no es valido");
        }
    }

    public function setNombreOficina($nombreOficina) {
        $this->nombreOficina = $nombreOficina;
    }

    public function setIdSucursal($idSucursal) {
        if (is_numeric($idSucursal) && is) {
            $this->idSucursal = $idSucursal;
        } else {
            throw new Exception("El id de sucursal no es valido");
        }
    }

}
