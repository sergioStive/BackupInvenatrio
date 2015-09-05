<?php

/**
 * Description of Compra
 * Entidad representante de la tabla Compras en la base de datos 
 *
 * @author Erick Guzmán
 */
class CompraDTO {

    private $idCompra = 0;
    private $factura = "";
    private $valor = 0.0;
    private $fecha = "";
    private $garantia = "";
    private $idProveedor = 0;

    public function __construct($idCompra, $factura, $valor, $fecha, $garantia, $idProveedor) {
        if (is_numeric($idCompra) && is_numeric($idProveedor) && is_double($valor)) {
            $this->idCompra = $idCompra;
            $this->factura = $factura;
            $this->valor = $valor;
            $this->fecha = $fecha;
            $this->garantia = $garantia;
            $this->idProveedor = $idProveedor;
        } else {
            throw new Exception("Algunos de los datos no es valido");
        }
    }

    public function getIdCompra() {
        return $this->idCompra;
    }

    public function getFactura() {
        return $this->factura;
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

    public function setIdCompra($idCompra) {
        if (is_numeric($idCompra)) {
            $this->idCompra = $idCompra;
        } else {
            throw new Exception("El id de la compra no es valido");
        }
    }

    public function setFactura($factura) {
        $this->factura = $factura;
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
