<?php

/**
 * Description of DispositivoDTO
 * Entidad representante de la tabla Dispositivos en la base de datos 
 *
 * @author Erick Guzmán
 */
class DispositivoDTO {

    private $serial = "";
    private $modelo = "";
    private $valor = 0.0;
    private $observacion = "";
    private $idMarca = 0;
    private $idTipo = 0;
    private $idEstado = 0;
    private $serialEquipo = "";
    private $idPuesto = 0;

    public function __construct($serial, $modelo, $valor, $observacion, $idMarca, $idTipo, $idEstado, $serialEquipo, $idPuesto) {
        if (is_numeric($idPuesto) && is_numeric($idMarca) && is_numeric($idTipo) && is_numeric($idEstado) && is_double($valor)) {
            $this->modelo = $modelo;
            $this->serial = $serial;
            $this->valor = $valor;
            $this->observacion = $observacion;
            $this->idMarca = $idMarca;
            $this->idTipo = $idTipo;
            $this->idEstado = $idEstado;
            $this->serialEquipo = $serialEquipo;
            $this->idPuesto = $idPuesto;
        } else {
            throw new Exception("Alguno de los datos no es valido");
        }
    }

    public function getSerial() {
        return $this->serial;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getObservacion() {
        return $this->observacion;
    }

    public function getIdMarca() {
        return $this->idMarca;
    }

    public function getIdTipo() {
        return $this->idTipo;
    }

    public function getIdEstado() {
        return $this->idEstado;
    }

    public function getSerialEquipo() {
        return $this->serialEquipo;
    }

    public function getIdPuesto() {
        return $this->idPuesto;
    }

    public function setSerial($serial) {
        $this->serial = $serial;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function setValor($valor) {
        if (is_double($valor)) {
            $this->valor = $valor;
        } else {
            throw new Exception("El valor no es valido");
        }
    }

    public function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    public function setIdMarca($idMarca) {
        if (is_numeric($idMarca)) {
            $this->idMarca = $idMarca;
        } else {
            throw new Exception("El id de la marca no es valido");
        }
    }

    public function setIdTipo($idTipo) {
        if (is_numeric($idTipo)) {
            $this->idTipo = $idTipo;
        } else {
            throw new Exception("El id del tipo no es valido");
        }
    }

    public function setIdEstado($idEstado) {
        if (is_numeric($idEstado)) {
            $this->idEstado = $idEstado;
        } else {
            throw new Exception("El id del estado no es valido");
        }
    }

    public function setSerialEquipo($serialEquipo) {
        $this->serialEquipo = $serialEquipo;
    }

    public function setIdPuesto($idPuesto) {
        if (is_numeric($idPuesto)) {
            $this->idPuesto = $idPuesto;
        } else {
            throw new Exception("El id del puesto no es valido");
        }
    }

}
