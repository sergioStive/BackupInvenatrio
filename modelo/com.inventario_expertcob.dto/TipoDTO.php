<?php

/**
 * Description of TipoDTO
 * Entidad representante de la tabla Tipos en la base de datos 
 *
 * @author Erick Guzmán
 */
class TipoDTO {

    private $idTipo = 0;
    private $nombreTipo = "";
    private $idClase = 0;

    public function __construct($idTipo, $nombreTipo, $idClase) {
        if (is_numeric($idTipo) && is_numeric($idClase)) {
            $this->idTipo = $idTipo;
            $this->nombreTipo = $nombreTipo;
            $this->idClase = $idClase;
        } else {
            throw new Exception("El id del tipo o el id de la clase no es valido");
        }
    }

    public function getIdTipo() {
        return $this->idTipo;
    }

    public function getNombreTipo() {
        return $this->nombreTipo;
    }

    public function getIdClase() {
        return $this->idClase;
    }

    public function setIdTipo($idTipo) {
        if (is_numeric($idTipo)) {
            $this->idTipo = $idTipo;
        } else {
            throw new Exception("El id del tipo no es valido");
        }
    }

    public function setNombreTipo($nombreTipo) {
        $this->nombreTipo = $nombreTipo;
    }

    public function setIdClase($idClase) {
        if (is_numeric($idClase)) {
            $this->idClase = $idClase;
        } else {
            throw new Exception("El id de la clase no es valido");
        }
    }

}
