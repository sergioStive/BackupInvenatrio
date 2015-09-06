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
            $this->query = "SELECT * FROM Equipos;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new EquipoDTO($res['Serial'], $res['Procesador'], $res['Ram'], $res['Hdd'], $res['Disquete'], $res['CdRom'], $res['Antivirus'], $res['SisOperativoKey'], $res['OfficeKey'], $res['IdSisOperativo'], $res['IdOffice']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Equipos WHERE Serial = '$id';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new EquipoDTO($res['Serial'], $res['Procesador'], $res['Ram'], $res['Hdd'], $res['Disquete'], $res['CdRom'], $res['Antivirus'], $res['SisOperativoKey'], $res['OfficeKey'], $res['IdSisOperativo'], $res['IdOffice']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verTorrePorOffice($id) {
        try {
            $this->query = "SELECT * FROM Equipos WHERE IdOffice = '$id';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new EquipoDTO($res['Serial'], $res['Procesador'], $res['Ram'], $res['Hdd'], $res['Disquete'], $res['CdRom'], $res['Antivirus'], $res['SisOperativoKey'], $res['OfficeKey'], $res['IdSisOperativo'], $res['IdOffice']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verTorrePorSisOperativo($id) {
        try {
            $this->query = "SELECT * FROM Equipos WHERE IdSisOperativo = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new EquipoDTO($res['Serial'], $res['Procesador'], $res['Ram'], $res['Hdd'], $res['Disquete'], $res['CdRom'], $res['Antivirus'], $res['SisOperativoKey'], $res['OfficeKey'], $res['IdSisOperativo'], $res['IdOffice']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
