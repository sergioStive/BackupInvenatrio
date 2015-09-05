<?php

/**
 * Description of MarcaDTO
 * Entidad representante de la tabla Marcas en la base de datos 
 *
 * @author Erick Guzmán
 */
class MarcaDTO {

    private $idMarca = 0;
    private $nombreMarca = "";

    public function __construct($idMarca, $nombreMarca) {
        if (is_numeric($idMarca)) {
            $this->idMarca = $idMarca;
            $this->nombreMarca = $nombreMarca;
        } else {
            throw new Exception("El id de la marca no es valido");
        }
    }

    public function getIdMarca() {
        return $this->idMarca;
    }

    public function getNombreMarca() {
        return $this->nombreMarca;
    }

    public function setIdMarca($idMarca) {
        if (is_numeric($idMarca)) {
            $this->idMarca = $idMarca;
        } else {
            throw new Exception("El id de la marca no es valido");
        }
    }

    public function setNombreMarca($nombreMarca) {
        $this->nombreMarca = $nombreMarca;
    }

}
