<?php

/**
 * Description of DispositivoDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class DispositivoDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Dispositivos WHERE Serial = '$id';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El dispositivo fue eliminado exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Dispositivos VALUES('" . $dto->getSerial() . "', '" . $dto->getModelo() . "', " . $dto->getValor() . ", '" . $dto->getObservacion() . "', " . $dto->getIdMarca() . ", " . $dto->getIdTipo() . ", " . $dto->getIdEstado() . ", '" . $dto->getSerialEquipo() . "', " . $dto->getIdPuesto() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El dispositivo fue registrado exitosamente";
            } else {
                return "No se pudo registrar el dispositivo";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Dispositivos SET Modelo = '" . $dto->getModelo() . "', Valor = " . $dto->getValor() . ", Observacion = '" . $dto->getObservacion() . "', IdMarca = " . $dto->getIdMarca() . ", IdTipo = " . $dto->getIdTipo() . ", IdEstado = " . $dto->getIdEstado() . ", SerialEquipo = '" . $dto->getSerialEquipo() . "' IdPuesto = " . $dto->getIdPuesto() . " WHERE Serial = '" . $dto->getSerial() . "';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El dispositivo fue modificado exitosamente";
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
            $this->query = "SELECT * FROM Dispositivos;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new DispositivoDTO($res['Serial'], $res['Modelo'], $res['Valor'], $res['Observacion'], $res['IdMarca'], $res['IdTipo'], $res['IdEstado'], $res['SerialEquipo'], $res['IdPuesto']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Dispositivos WHERE Serial = '$id';";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new DispositivoDTO($res['Serial'], $res['Modelo'], $res['Valor'], $res['Observacion'], $res['IdMarca'], $res['IdTipo'], $res['IdEstado'], $res['SerialEquipo'], $res['IdPuesto']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verDispositivosPorIdDePuesto($id) {
        try {
            $this->lista = array();
            $this->query = "SELECT * FROM Dispositivos WHERE IdPuesto = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new DispositivoDTO($res['Serial'], $res['Modelo'], $res['Valor'], $res['Observacion'], $res['IdMarca'], $res['IdTipo'], $res['IdEstado'], $res['SerialEquipo'], $res['IdPuesto']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verDispositivoPorIdDeTipo($id) {
        try {
            $this->query = "SELECT * FROM Dispositivos WHERE IdTipo = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new DispositivoDTO($res['Serial'], $res['Modelo'], $res['Valor'], $res['Observacion'], $res['IdMarca'], $res['IdTipo'], $res['IdEstado'], $res['SerialEquipo'], $res['IdPuesto']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verDispositivoPorIdDeMarca($id) {
        try {
            $this->query = "SELECT * FROM Dispositivos WHERE IdMarca = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new DispositivoDTO($res['Serial'], $res['Modelo'], $res['Valor'], $res['Observacion'], $res['IdMarca'], $res['IdTipo'], $res['IdEstado'], $res['SerialEquipo'], $res['IdPuesto']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verDispositivoPorIdDeEstado($id) {
        try {
            $this->query = "SELECT * FROM Dispositivos WHERE IdEstado = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $this->dto = new DispositivoDTO($res['Serial'], $res['Modelo'], $res['Valor'], $res['Observacion'], $res['IdMarca'], $res['IdTipo'], $res['IdEstado'], $res['SerialEquipo'], $res['IdPuesto']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function contarDispositivos() {
        try {
            $dispositivos = 0;
            $this->query = "SELECT COUNT(Serial) AS Dispositivos FROM Dispositivos;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysqli_num_rows($this->resultado) > 0) {
                $res = mysqli_fetch_array($this->resultado);
                $dispositivos = $res['Dispositivos'];
            }
            return $dispositivos;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verDispositivosPorOficina($idOficina) {
        try {
            $this->lista = array();
            $this->query = "SELECT D.Serial, D.Modelo, D.Valor, D.Observacion, D.IdMarca, D.IdTipo, D.IdEstado, D.SerialEquipo, D.IdPuesto FROM Dispositivos AS D INNER JOIN Puestos AS P ON D.IdPuesto = P.IdPuesto INNER JOIN Areas AS A ON A.IdArea = P.IdArea WHERE A.IdOficina = $idOficina;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new DispositivoDTO($res['Serial'], $res['Modelo'], $res['Valor'], $res['Observacion'], $res['IdMarca'], $res['IdTipo'], $res['IdEstado'], $res['SerialEquipo'], $res['IdPuesto']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verDispositivosPorArea($idArea) {
        try {
            $this->lista = array();
            $this->query = "SELECT D.Serial, D.Modelo, D.Valor, D.Observacion, D.IdMarca, D.IdTipo, D.IdEstado, D.SerialEquipo, D.IdPuesto FROM Dispositivos AS D INNER JOIN Puestos AS P ON D.IdPuesto = P.IdPuesto WHERE P.IdArea = $idArea;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysqli_fetch_array($this->resultado)) {
                array_push($this->lista, new DispositivoDTO($res['Serial'], $res['Modelo'], $res['Valor'], $res['Observacion'], $res['IdMarca'], $res['IdTipo'], $res['IdEstado'], $res['SerialEquipo'], $res['IdPuesto']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
