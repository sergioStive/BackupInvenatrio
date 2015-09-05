<?php

/**
 * Description of MuebleEnserDTO
 * Entidad representante de la tabla MuebleEnceres en la base de datos 
 *
 * @author Erick Guzmán
 */
class MuebleEnserDTO {

    private $idMuebleEnser = 0;
    private $descripcion = "";
    private $cantidad = 0;
    private $valor = 0.0;
    private $idEstado = 0;
    private $idPuesto = 0;

    public function __construct($idMuebleEnser, $descripcion, $cantidad, $valor, $idEstado, $idPuesto) {
        if (is_numeric($idMuebleEnser) && is_numeric($idPuesto) && is_numeric($idEstado) && is_numeric($cantidad) && is_double($valor)) {
            $this->idMuebleEnser = $idMuebleEnser;
            $this->descripcion = $descripcion;
            $this->cantidad = $cantidad;
            $this->valor = $valor;
            $this->idEstado = $idEstado;
            $this->idPuesto = $idPuesto;
        } else {
            throw new Exception("Alguno de los datos no es valido");
        }
    }

    public function getIdMuebleEnser() {
        return $this->idMuebleEnser;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getIdEstado() {
        return $this->idEstado;
    }

    public function getIdPuesto() {
        return $this->idPuesto;
    }

    public function setIdMuebleEnser($idMuebleEnser) {
        if (is_numeric($idMuebleEnser)) {
            $this->idMuebleEncer = $idMuebleEnser;
        } else {
            throw new Exception("El id del mueble o enser no es valido");
        }
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setCantidad($cantidad) {
        if (is_numeric($cantidad)) {
            $this->cantidad = $cantidad;
        } else {
            throw new Exception("El número de la cantidad no es valido");
        }
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setIdEstado($idEstado) {
        if (is_numeric($idEstado)) {
            $this->idEstado = $idEstado;
        } else {
            throw new Exception("El id del estado no es valido");
        }
    }

    public function setIdPuesto($idPuesto) {
        if (is_numeric($idPuesto)) {
            $this->idPuesto = $idPuesto;
        } else {
            throw new Exception("El id del puesto no es valido");
        }
    }

}
