<?php

/**
 * Description of PersonaDTO
 *
 * @author Erick Guzmán
 */
abstract class PersonaDTO {

    protected $idPersona = 0;
    protected $nombre = "";
    protected $apellido = "";

    protected function __construct($idPersona, $nombre, $apellido) {
        if (is_numeric($idPersona)) {
            $this->idPersona = $idPersona;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
        } else {
            throw new Exception("El número de documento no es valido");
        }
    }

    public function getIdPersona() {
        return $this->idPersona;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setIdPersona($idPersona) {
        if (is_numeric($idPersona)) {
            $this->idPersona = $idPersona;
        } else {
            throw new Exception("El número de documento no es valido");
        }
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

}
