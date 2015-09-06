<?php

/**
 * Description of DispositivoCompra
 * Entidad representante de la tabla DispositivoCompras en la base de datos 
 *
 * @author Erick Guzmán
 */
class DispositivoCompraDTO {

    private $serialDispositivo = "";
    private $numFactura = "";

    public function __construct($serialDispositivo, $numFactura) {
        $this->serialDispositivo = $serialDispositivo;
        $this->numFactura = $numFactura;
    }

    public function getSerialDispositivo() {
        return $this->serialDispositivo;
    }

    public function getNumFactura() {
        return $this->numFactura;
    }

    public function setSerialDispositivo($serialDispositivo) {
        $this->serialDispositivo = $serialDispositivo;
    }

    public function setNumFactura($NumFactura) {
        $this->numFactura = $NumFactura;
    }

}
