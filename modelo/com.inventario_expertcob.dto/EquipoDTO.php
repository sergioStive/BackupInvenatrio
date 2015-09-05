<?php

/**
 * Description of EquipoDTO
 * Entidad representante de la tabla Equipos en la base de datos 
 *
 * @author Erick Guzmán
 */
class EquipoDTO {

    private $serial = "";
    private $procesador = "";
    private $ram = "";
    private $hdd = "";
    private $disquete = false;
    private $cdRom = "";
    private $antivirus = "";
    private $sisOperativoKey = "";
    private $officeKey = "";
    private $idSistemaOperativo = 0;
    private $idOffice = 0;

    public function __construct($serial, $procesador, $ram, $hdd, $disquete, $cdRom, $antivirus, $sisOperativoKey, $officeKey, $idSistemaOperativo, $idOffice) {
        if (is_numeric($idSistemaOperativo) && is_numeric($idOffice) && is_bool($disquete)) {
            $this->serial = $serial;
            $this->procesador = $procesador;
            $this->ram = $ram;
            $this->hdd = $hdd;
            $this->disquete = $disquete;
            $this->cdRom = $cdRom;
            $this->antivirus = $antivirus;
            $this->sisOperativoKey = $sisOperativoKey;
            $this->officeKey = $officeKey;
            $this->idSistemaOperativo = $idSistemaOperativo;
            $this->idOffice = $idOffice;
        } else {
            throw new Exception("Alguno de los datos no es valido");
        }
    }

    public function getSerial() {
        return $this->serial;
    }

    public function getProcesador() {
        return $this->procesador;
    }

    public function getRam() {
        return $this->ram;
    }

    public function getHdd() {
        return $this->hdd;
    }

    public function getDisquete() {
        return $this->disquete;
    }

    public function getCdRom() {
        return $this->cdRom;
    }

    public function getAntivirus() {
        return $this->antivirus;
    }

    public function getSisOperativoKey() {
        return $this->sisOperativoKey;
    }

    public function getOfficeKey() {
        return $this->officeKey;
    }

    public function getIdSistemaOperativo() {
        return $this->idSistemaOperativo;
    }

    public function getIdOffice() {
        return $this->idOffice;
    }

    public function setSerial($serial) {
        $this->serial = $serial;
    }

    public function setProcesador($procesador) {
        $this->procesador = $procesador;
    }

    public function setRam($ram) {
        $this->ram = $ram;
    }

    public function setHdd($hdd) {
        $this->hdd = $hdd;
    }

    public function setDisquete($disquete) {
        if (is_bool($disquete)) {
            $this->disquete = $disquete;
        } else {
            throw new Exception("El dato disquete no es valido");
        }
    }

    public function setCdRom($cdRom) {
        $this->cdRom = $cdRom;
    }

    public function setAntivirus($antivirus) {
        $this->antivirus = $antivirus;
    }

    public function setSisOperativoKey($sisOperativoKey) {
        $this->sisOperativoKey = $sisOperativoKey;
    }

    public function setOfficeKey($officeKey) {
        $this->officeKey = $officeKey;
    }

    public function setIdSistemaOperativo($idSistemaOperativo) {
        if (is_numeric($idSistemaOperativo)) {
            $this->idSistemaOperativo = $idSistemaOperativo;
        } else {
            throw new Exception("El id del sistema operativo no es valido");
        }
    }

    public function setIdOffice($idOffice) {
        if (is_numeric($idOffice)) {
            $this->idOffice = $idOffice;
        } else {
            throw new Exception("El id del office no es valido");
        }
    }

}
