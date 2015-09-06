<?php

/**
 * Description of Compra
 * Entidad representante de la tabla Compras en la base de datos 
 *
 * @author Erick Guzmán
 */
class CompraDTO {

    private $numFactura = "";
    private $valor = 0.0;
    private $fecha = "";
    private $garantia = "";
    private $idProveedor = 0;

    public function __construct($numFactura, $valor, $fecha, $garantia, $idProveedor) {
        if (is_numeric($idProveedor) && is_double($valor)) {
            $this->numFactura = $numFactura;
            $this->valor = $valor;
            $this->fecha = $fecha;
            $this->garantia = $garantia;
            $this->idProveedor = $idProveedor;
        } else {
            throw new Exception("Algunos de los datos no es valido");
        }
    }

    public function getNumFactura() {
        return $this->numFactura;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getGarantia() {
        return $this->garantia;
    }

    public function getIdProveedor() {
        return $this->idProveedor;
    }

    public function setNumFactura($numFactura) {
        $this->numFactura = $numFactura;
    }

    public function setValor($valor) {
        if (is_double($valor)) {
            $this->valor = $valor;
        } else {
            throw new Exception("El valor no es valido");
        }
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setGarantia($garantia) {
        $this->garantia = $garantia;
    }

    public function setIdProveedor($idProveedor) {
        if (is_numeric($idProveedor)) {
            $this->idProveedor = $idProveedor;
        } else {
            throw new Exception("El id del proveedor no es valido");
        }
    }

}
