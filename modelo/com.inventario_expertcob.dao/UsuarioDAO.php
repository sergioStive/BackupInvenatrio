<?php

/**
 * Description of UsuarioDAO
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/AbstractDAO.php';

class UsuarioDAO extends AbstractDAO {

    public function __construct() {
        parent::__construct();
    }

    public function eliminar($id) {
        try {
            $this->query = "DELETE FROM Usuarios WHERE IdUsuario = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El usuario fue eliminado exitosamente";
            } else {
                return "No se pudo eliminar el registro";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function insertar($dto) {
        try {
            $this->query = "INSERT INTO Usuarios VALUES(" . $dto->getIdPersona() . ",'" . $dto->getNombre() . "','" . $dto->getApellido() . "', MD5(" . $dto->getClave() . ")," . $dto->getIdSucursal() . "," . $dto->getIdRol() . ");";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El usuario fue registrado exitosamente";
            } else {
                return "No se pudo registrar el usuario";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function modificar($dto) {
        try {
            $this->query = "UPDATE Usuarios SET Nombre = '" . $dto->getNombre() . "', Apellidos = '" . $dto->getApellido() . "', IdSucursal = " . $dto->getIdSucursal() . ", IdRol = " . $dto->getIdRol() . " WHERE IdUsuario = " . $dto->getIdPersona() . ";";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "El usuario fue modificado exitosamente";
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
            $this->query = "SELECT * FROM Usuarios WHERE IdUsuario <> 830121569;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            while ($res = mysql_fetch_array($this->resultado)) {
                array_push($this->lista, new UsuarioDTO($res['IdUsuario'], $res['Nombres'], $res['Apellidos'], "", $res['IdSucursal'], $res['IdRol']));
            }
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUno($id) {
        try {
            $this->query = "SELECT * FROM Usuarios WHERE IdUsuario = $id;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new UsuarioDTO($res['IdUsuario'], $res['Nombres'], $res['Apellidos'], "", $res['IdSucursal'], $res['IdRol']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function verUsuarioPorContraseña($clave, $numero) {
        try {
            $this->query = "SELECT * FROM Usuarios WHERE Clave = MD5('$clave') AND IdUsuario = $numero;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new UsuarioDTO($res['IdUsuario'], $res['Nombres'], $res['Apellidos'], "", $res['IdSucursal'], $res['IdRol']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function login($numero, $clave) {
        try {
            $this->query = "SELECT * FROM Usuarios WHERE IdUsuario = $numero AND Clave = MD5('$clave');";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if (mysql_num_rows($this->resultado) > 0) {
                $res = mysql_fetch_array($this->resultado);
                $this->dto = new UsuarioDTO($res['IdUsuario'], $res['Nombres'], $res['Apellidos'], "", $res['IdSucursal'], $res['IdRol']);
            }
            return $this->dto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function cambiarContraseña($numero, $claveNueva) {
        try {
            $this->query = "UPDATE Usuarios SET Clave = MD5('$claveNueva') WHERE IdUsuario = $numero;";
            $this->resultado = $this->conexion->ejecutar($this->query);
            if ($this->resultado) {
                return "La contraseña fue cambiada exitosamente";
            } else {
                return "No se pudo cambiar la contraseña";
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
