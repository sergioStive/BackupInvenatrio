<?php

/**
 * Description of SistemaOperativoDTO
 * Entidad representante de la tabla SistemaOperativos en la base de datos 
 *
 * @author Erick Guzmán
 */
class SistemaOperativoDTO {

    private $idSistemaOperativo = 0;
    private $nombreSistemaOperativo = "";

    public function __construct($idSistemaOperativo, $nombreSistemaOperativo) {
        if (is_numeric($idSistemaOperativo)) {
            $this->idSistemaOperativo = $idSistemaOperativo;
            $this->nombreSistemaOperativo = $nombreSistemaOperativo;
        } else {
            throw new Exception("El id del sistema operativo no es valido");
        }
    }

    public function getIdSistemaOperativo() {
        return $this->idSistemaOperativo;
    }

    public function getNombreSistemaOperativo() {
        return $this->nombreSistemaOperativo;
    }

    public function setIdSistemaOperativo($idSistemaOperativo) {
        if ($idSistemaOperativo) {
            $this->idSistemaOperativo = $idSistemaOperativo;
        } else {
            throw new Exception("El id del sistema operativo no es valido");
        }
    }

    public function setNombreSistemaOperativo($nombreSistemaOperativo) {
        $this->nombreSistemaOperativo = $nombreSistemaOperativo;
    }

}
