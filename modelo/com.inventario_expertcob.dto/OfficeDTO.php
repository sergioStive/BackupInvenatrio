<?php

/**
 * Description of OfficeDTO
 * Entidad representante de la tabla Office en la base de datos 
 *
 * @author Erick Guzmán
 */
class OfficeDTO {

    private $idOffice = 0;
    private $nombreOffice = "";

    public function __construct($idOffice, $nombreOffice) {
        if (is_numeric($idOffice)) {
            $this->idOffice = $idOffice;
            $this->nombreOffice = $nombreOffice;
        } else {
            throw new Exception("El id de office no es valido");
        }
    }

    public function getIdOffice() {
        return $this->idOffice;
    }

    public function getNombreOffice() {
        return $this->nombreOffice;
    }

    public function setIdOffice($idOffice) {
        if (is_numeric($idOffice)) {
            $this->idOffice = $idOffice;
        } else {
            throw new Exception("El id de office no es valido");
        }
    }

    public function setNombreOffice($nombreOffice) {
        $this->nombreOffice = $nombreOffice;
    }

}
