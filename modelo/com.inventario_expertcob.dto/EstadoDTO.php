<?php

/**
 * Description of EstadoDTO
 * Entidad representante de la tabla Estados en la base de datos 
 *
 * @author Erick Guzmán
 */
class EstadoDTO {

    private $idEstado = 0;
    private $descripcion = "";

    public function __construct($idEstado, $descripcion) {
        if (is_numeric($idEstado)) {
            $this->idEstado = $idEstado;
            $this->descripcion = $descripcion;
        } else {
            throw new Exception("El id del estado no es valido");
        }
    }

    public function getIdEstado() {
        return $this->idEstado;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setIdEstado($idEstado) {
        if (is_numeric($idEstado)) {
            $this->idEstado = $idEstado;
        } else {
            throw new Exception("El id del estado no es valido");
        }
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

}
