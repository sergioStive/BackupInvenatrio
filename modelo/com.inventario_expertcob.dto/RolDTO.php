<?php

/**
 * Description of RolDTO
 * Entidad representante de la tabla Roles en la base de datos 
 *
 * @author Erick Guzmán
 */
class RolDTO {

    private $idRol = 0;
    private $nombreRol = "";

    public function __construct($idRol, $nombreRol) {
        if (is_numeric($idRol)) {
            $this->idRol = $idRol;
            $this->nombreRol = $nombreRol;
        } else {
            throw new Exception("El id del rol no es valido");
        }
    }

    public function getIdRol() {
        return $this->idRol;
    }

    public function getNombreRol() {
        return $this->nombreRol;
    }

    public function setIdRol($idRol) {
        if (is_numeric($idRol)) {
            $this->idRol = $idRol;
        } else {
            throw new Exception("El id del rol no es valido");
        }
    }

    public function setNombreRol($nombreRol) {
        $this->nombreRol = $nombreRol;
    }

}
