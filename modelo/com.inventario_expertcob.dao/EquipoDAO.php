<?php

/**
 * Description of TorreDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

 class EquipoDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Equipos WHERE Serial = '$id';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El equipo fue eliminado exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Equipos VALUES('" . $dto->getSerial() . "', '" . $dto->getProcesador() . "', '" . $dto->getRam() . "', '" . $dto->getHdd() . "', " . $dto->getDisquete() . ", '" . $dto->getCdRom() . "', '" . $dto->getAntivirus() . "', '" . $dto->getSisOperativoKey() . "', '" . $dto->getOfficeKey() . "', " . $dto->getIdSistemaOperativo() . ", " . $dto->getIdOffice() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El equipo fue registrado exitosamente";
            } else {
                return "No se pudo registrar el equipo";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar(EquipoDTO $dto) {
        try {
            $this->query = "UPDATE Equipos SET Procesador = '" . $dto->getProcesador() . "', Ram = '" . $dto->getRam() . "', Hdd = '" . $dto->getHdd() . "', Disquete = " . $dto->getDisquete() . ", CdRom = '" . $dto->getCdRom() . "', Antivirus = '" . $dto->getAntivirus() . "', SisOperativoKey = '" . $dto->getSisOperativoKey() . "', OfficeKey = '" . $dto->getOfficeKey() . "', IdSisOperativo = " . $dto->getIdSistemaOperativo() . ", IdOffice = " . $dto->getIdOffice() . " WHERE Serial = '" . $dto->getSerial() . "';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El equipo fue modificado exitosamente";
            } else {
                return "No se pudo modificar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verTodos() {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM Torres;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysql_fetch_array($this->resultado)) {
                array_push($this->lista, new TorreDTO($res['id_torre'], $res['procesador'], $res['ram'], $res['hdd'], $res['disquete'], $res['cd_rom'], $res['antivirus'], $res['sis_operativo_key'], $res['office_key'], $res['id_so'], $res['id_office']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Torres WHERE id_torre = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new TorreDTO($res['id_torre'], $res['procesador'], $res['ram'], $res['hdd'], $res['disquete'], $res['cd_rom'], $res['antivirus'], $res['sis_operativo_key'], $res['office_key'], $res['id_so'], $res['id_office']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verTorrePorOffice($id) {
        try {
            $this->query = "SELECT * FROM Torres WHERE id_office = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new TorreDTO($res['id_torre'], $res['procesador'], $res['ram'], $res['hdd'], $res['disquete'], $res['cd_rom'], $res['antivirus'], $res['sis_operativo_key'], $res['office_key'], $res['id_so'], $res['id_office']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verTorrePorSisOperativo($id) {
        try {
            $this->query = "SELECT * FROM Torres WHERE id_so = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new TorreDTO($res['id_torre'], $res['procesador'], $res['ram'], $res['hdd'], $res['disquete'], $res['cd_rom'], $res['antivirus'], $res['sis_operativo_key'], $res['office_key'], $res['id_so'], $res['id_office']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
