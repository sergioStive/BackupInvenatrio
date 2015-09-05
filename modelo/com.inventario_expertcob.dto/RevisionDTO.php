<?php

/**
 * Description of RevisionDTO
 * Entidad representante de la tabla Revisiones en la base de datos 
 *
 * @author Erick Guzmán
 */
class RevisionDTO {

    private $idRevision = 0;
    private $fecha = "";
    private $mantenimiento = "";
    private $responsable = "";
    private $observacion = "";
    private $serialEquipo = "";

    public function __construct($idRevision, $fecha, $mantenimiento, $responsable, $observacion, $serialEquipo) {
        if (is_numeric($idRevision)) {
            $this->idRevision = $idRevision;
            $this->fecha = $fecha;
            $this->mantenimiento = $mantenimiento;
            $this->responsable = $responsable;
            $this->observacion = $observacion;
            $this->serialEquipo = $serialEquipo;
        } else {
            throw new Exception("El id de la revisión no es valido");
        }
    }

    public function getIdRevision() {
        return $this->idRevision;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getMantenimiento() {
        return $this->mantenimiento;
    }

    public function getResponsable() {
        return $this->responsable;
    }

    public function getObservacion() {
        return $this->observacion;
    }

    public function getSerialEquipo() {
        return $this->serialEquipo;
    }

    public function setIdRevision($idRevision) {
        if (is_numeric($idRevision)) {
            $this->idRevision = $idRevision;
        } else {
            throw new Exception("El id de la revisión no es valido");
        }
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setMantenimiento($mantenimiento) {
        $this->mantenimiento = $mantenimiento;
    }

    public function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    public function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    public function setSerialEquipo($serialEquipo) {
        $this->serialEquipo = $serialEquipo;
    }

}
