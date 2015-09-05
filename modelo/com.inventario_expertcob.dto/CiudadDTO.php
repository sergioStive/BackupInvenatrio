<?php

/**
 * Description of CiudadDTO
 * Entidad representante de la tabla Ciudades en la base de datos 
 *
 * @author Erick Gúzman
 */
class CiudadDTO {

    private $idCiudad = 0;
    private $nombreCiudad = "";

    public function __construct($idCiudad, $nombreCiudad) {
        if (is_numeric($idCiudad)) {
            $this->idCiudad = $idCiudad;
            $this->nombreCiudad = $nombreCiudad;
        } else {
            throw new Exception("El id de la ciudad no es valido");
        }
    }

    public function getIdCiudad() {
        return $this->idCiudad;
    }

    public function getNombreCiudad() {
        return $this->nombreCiudad;
    }

    public function setIdCiudad($idCiudad) {
        if (is_numeric($idCiudad)) {
            $this->idCiudad = $idCiudad;
        } else {
            throw new Exception("El id de la ciudad no es valido");
        }
    }

    public function setNombreCiudad($nombreCiudad) {
        $this->nombreCiudad = $nombreCiudad;
    }

}
