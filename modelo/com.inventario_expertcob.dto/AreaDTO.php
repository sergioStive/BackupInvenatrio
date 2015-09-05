<?php

/**
 * Description of AreaDTO 
 * Entidad representante de la tabla Areas en la base de datos 
 *
 * @author Erick Guzmán
 */
class AreaDTO {

    private $idArea = 0;
    private $nombreArea = "";
    private $idOficina = 0;

    public function __construct($idArea, $nombreArea, $idOficina) {
        if (is_numeric($idArea) && is_numeric($idOficina)) {
            $this->idArea = $idArea;
            $this->nombreArea = $nombreArea;
            $this->idOficina = $idOficina;
        } else {
            throw new Exception("Algunos de los datos no son validos");
        }
    }

    public function getIdArea() {
        return $this->idArea;
    }

    public function getNombreArea() {
        return $this->nombreArea;
    }

    public function getIdOficina() {
        return $this->idOficina;
    }

    public function setIdArea($idArea) {
        if (is_numeric($idArea)) {
            $this->idArea = $idArea;
        } else {
            throw new Exception("El id de la área no es valido");
        }
    }

    public function setNombreArea($nombreArea) {
        $this->nombreArea = $nombreArea;
    }

    public function setIdOficina($idOficina) {
        if (is_numeric($idOficina)) {
            $this->idOficina = $idOficina;
        } else {
            throw new Exception("El id de la oficina no es valido");
        }
    }

}
