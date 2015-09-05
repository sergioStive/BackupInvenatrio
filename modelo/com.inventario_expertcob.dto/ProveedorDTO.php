<?php

/**
 * Description of Proveedor
 * Entidad representante de la tabla Dispositivos en la base de datos 
 *
 * @author Erick Guzmán
 */
class ProveedorDTO {

    private $idProveedor = 0;
    private $nombreProveedor = "";
    private $direccion = "";
    private $telefono = "";
    private $email = "";

    public function __construct($idProveedor, $nombreProveedor, $direccion, $telefono, $email) {
        if (is_numeric($idProveedor)) {
            $this->idProveedor = $idProveedor;
            $this->nombreProveedor = $nombreProveedor;
            $this->direccion = $direccion;
            $this->telefono = $telefono;
            $this->email = $email;
        } else {
            throw new Exception("El id del proveedor no es valido");
        }
    }

    public function getIdProveedor() {
        return $this->idProveedor;
    }

    public function getNombreProveedor() {
        return $this->nombreProveedor;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setIdProveedor($idProveedor) {
        if (is_numeric($idProveedor)) {
            $this->idProveedor = $idProveedor;
        } else {
            throw new Exception("El id del proveedor no es valido");
        }
    }

    public function setNombreProveedor($nombreProveedor) {
        $this->nombreProveedor = $nombreProveedor;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

}
