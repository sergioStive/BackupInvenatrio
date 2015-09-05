<?php

/**
 * Description of PuestoDTO
 *  Entidad representante de la tabla Puestos en la base de datos 
 *
 * @author Erick Guzmán
 */
class PuestoDTO {

    private $idPuesto = 0;
    private $nombrePuesto = "";
    private $idArea = 0;
    private $idResponsable = 0;

    public function __construct($idPuesto, $nombrePuesto, $idArea, $idResponsable) {
        if (is_numeric($idPuesto) && is_numeric($idResponsable) && is_numeric($idArea)) {
            $this->idPuesto = $idPuesto;
            $this->nombrePuesto = $nombrePuesto;
            $this->idArea = $idArea;
            $this->idResponsable = $idResponsable;
        } else {
            throw new Exception("Algunos de los datos no son validos");
        }
    }

    public function getIdPuesto() {
        return $this->idPuesto;
    }

    public function getNombrePuesto() {
        return $this->nombrePuesto;
    }

    public function getIdArea() {
        return $this->idArea;
    }
    
    public function getIdResponsable() {
        return $this->idResponsable;
    }

    public function setIdPuesto($idPuesto) {
        if (is_numeric($idPuesto)) {
            $this->idPuesto = $idPuesto;
        } else {
            throw new Exception("El id del puesto no es valido");
        }
    }

    public function setNombrePuesto($nombrePuesto) {
        $this->nombrePuesto = $nombrePuesto;
    }

    public function setIdArea($idArea) {
        if (is_numeric($idArea)) {
            $this->idArea = $idArea;
        } else {
            throw new Exception("El id de la oficina no es valido");
        }
    }
    
    public function setIdResponsable($idResponsable) {
        if (is_numeric($idResponsable)) {
            $this->idResponsable = $idResponsable;
        } else {
            throw new Exception("El id del responsable no es valido");
        }
    }

}
