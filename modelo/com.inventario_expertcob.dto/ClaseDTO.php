<?php

/**
 * Description of ClaseDTO
 * Entidad representante de la tabla Clases en la base de datos 
 *
 * @author Erick Guzmán
 */
class ClaseDTO {

    private $idClase = 0;
    private $nombreClase = "";

    public function __construct($idClase, $nombreClase) {
        if (is_numeric($idClase)) {
            $this->idClase = $idClase;
            $this->nombreClase = $nombreClase;
        } else {
            throw new Exception("El id de la clase no es valido");
        }
    }

    public function getIdClase() {
        return $this->idClase;
    }

    public function getNombreClase() {
        return $this->nombreClase;
    }

    public function setIdClase($idClase) {
        if (is_numeric($idClase)) {
            $this->idClase = $idClase;
        } else {
            throw new Exception("El id de la clase no es valido");
        }
    }

    public function setNombreClase($nombreClase) {
        $this->nombreClase = $nombreClase;
    }

}
