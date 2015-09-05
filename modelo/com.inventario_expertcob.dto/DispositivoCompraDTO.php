<?php

/**
 * Description of DispositivoCompra
 * Entidad representante de la tabla DispositivoCompras en la base de datos 
 *
 * @author Erick Guzmán
 */
class DispositivoCompraDTO {

    private $serialDispositivo = "";
    private $idCompra = 0;

    public function __construct($serialDispositivo, $idCompra) {
        if (is_numeric($idCompra)) {
            $this->serialDispositivo = $serialDispositivo;
            $this->idCompra = $idCompra;
        } else {
            throw new Exception("El id de la compra no es valido");
        }
    }

    public function getSerialDispositivo() {
        return $this->serialDispositivo;
    }

    public function getIdCompra() {
        return $this->idCompra;
    }

    public function setSerialDispositivo($serialDispositivo) {
        $this->serialDispositivo = $serialDispositivo;
    }

    public function setIdCompra($idCompra) {
        if (is_numeric($idCompra)) {
            $this->idCompra = $idCompra;
        } else {
            throw new Exception("El id de la compra no es valido");
        }
    }

}
