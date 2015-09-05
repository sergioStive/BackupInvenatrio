<?php

/**
 * Description of UsuarioDTO
 * Entidad representante de la tabla Usuarios en la base de datos 
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dto/PersonaDTO.php';

class UsuarioDTO extends PersonaDTO {

    private $clave = "";
    private $idSucursal = 0;
    private $idRol = 0;

    public function __construct($idUsuario, $nombre, $apellido, $clave, $idSucursal, $idRol) {
        if (is_numeric($idSucursal) && is_numeric($idRol)) {
            parent::__construct($idUsuario, $nombre, $apellido);
            $this->clave = $clave;
            $this->idSucursal = $idSucursal;
            $this->idRol = $idRol;
        } else {
            throw new Exception("Algunos de los datos no son validos");
        }
    }

    public function getClave() {
        return $this->clave;
    }

    public function getIdSucursal() {
        return $this->idSucursal;
    }

    public function getIdRol() {
        return $this->idRol;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setIdSucursal($idSucursal) {
        if (is_numeric($idSucursal)) {
            $this->idSucursal = $idSucursal;
        } else {
            throw new Exception("El id de la sucursal no es valido");
        }
    }

    public function setIdRol($idRol) {
        if (is_numeric($idRol)) {
            $this->idRol = $idRol;
        } else {
            throw new Exception("El id del rol no es valido");
        }
    }

}
