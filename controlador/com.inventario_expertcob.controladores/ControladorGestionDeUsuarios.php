<?php

/**
 * Description of ControladorGestionDeUsuarios
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/UsuarioDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/UsuarioDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/RolDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/RolDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/ResponsableDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/ResponsableDTO.php';

class ControladorGestionDeUsuarios {

    /**
     *
     * @var UsuarioDAO 
     */
    private $uDao = null; //instancia de la clase UsuarioDAO

    /**
     *
     * @var UsuarioDTO 
     */
    private $uDto = null; //instancia de la clase UsuarioDTO

    /**
     *
     * @var RolDAO 
     */
    private $rDao = null; //instancia de la clase RolDAO

    /**
     *
     * @var RolDTO 
     */
    private $rDto = null; //instancia de la clase RolDTO

    /**
     *
     * @var ResponsableDAO 
     */
    private $reDao = null; //instancia de la clase ResponsableDAO

    /**
     *
     * @var ResponsaleDTO 
     */
    private $reDto = null; //instancia de la clase ResponsaleDTO

    /**
     *
     * @var array 
     */
    private $lista = null; //variable a utilizar como array

    /**
     * 
     * @param Long $numero
     * @param String $nombre
     * @param String $apellido
     * @param Integer $sucursal
     * @param Integer $rol
     * @return String
     */

    public function registrarUsuario($numero, $nombre, $apellido, $sucursal, $rol) {
        try {
            $this->uDao = new UsuarioDAO();
            $this->uDto = $this->uDao->verUno($numero);
            if ($this->uDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->uDao->insertar(new UsuarioDTO($numero, utf8_decode($nombre), utf8_decode($apellido), $numero, $sucursal, $rol))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe un usuario con ese número de documento'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Long $numero
     * @param String $nombre
     * @param String $apellido
     * @param Integer $sucursal
     * @param Integer $rol
     * @return String
     */
    public function modificarUsuario($numero, $nombre, $apellido, $sucursal, $rol) {
        try {
            $this->uDao = new UsuarioDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->uDao->modificar(new UsuarioDTO($numero, utf8_decode($nombre), utf8_decode($apellido), $numero, $sucursal, $rol))
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return String
     */
    public function eliminarUsuario($id) {
        try {
            $this->uDao = new UsuarioDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->uDao->eliminar($id)
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return UsuarioDTO
     */
    public function verUnUsuario($id) {
        try {
            $this->uDao = new UsuarioDAO();
            $this->uDto = $this->uDao->verUno($id);
            return $this->uDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<UsuarioDTO>
     */
    public function verUsuarios() {
        try {
            $this->uDao = new UsuarioDAO();
            $this->lista = $this->uDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return RolDTO
     */
    public function verUnRol($id) {
        try {
            $this->rDao = new RolDAO();
            $this->rDto = $this->rDao->verUno($id);
            return $this->rDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<RolDTO>
     */
    public function verRoles() {
        try {
            $this->rDao = new RolDAO();
            $this->lista = $this->rDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Long $numero
     * @param String $nombre
     * @param String $apellido
     * @return String
     */
    public function registrarResponsable($numero, $nombre, $apellido) {
        try {
            $this->reDao = new ResponsableDAO();
            $this->reDto = $this->reDao->verUno($numero);
            if ($this->reDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->reDao->insertar(new ResponsableDTO($numero, utf8_decode($nombre), utf8_decode($apellido)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe un responsable con ese número de documento'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Long $numero
     * @param String $nombre
     * @param String $apellido
     * @return String
     */
    public function modificarResponsable($numero, $nombre, $apellido) {
        try {
            $this->reDao = new ResponsableDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->reDao->modificar(new ResponsableDTO($numero, utf8_decode($nombre), utf8_decode($apellido)))
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Long $id
     * @return String
     */
    public function eliminarResponsable($id) {
        try {
            $this->reDao = new ResponsableDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->reDao->eliminar($id)
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Long $id
     * @return ResponsableDTO
     */
    public function verUnResponsable($id) {
        try {
            $this->reDao = new ResponsableDAO();
            $this->reDto = $this->reDao->verUno($id);
            return $this->reDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<ResponsableDTO>
     */
    public function verResponsables() {
        try {
            $this->reDao = new ResponsableDAO();
            $this->lista = $this->reDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Long $numero
     * @param String $clave
     * @return UsuarioDTO
     */
    public function login($numero, $clave) {
        try {
            $this->uDao = new UsuarioDAO();
            $this->uDto = $this->uDao->login($numero, utf8_decode($clave));
            return $this->uDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param String $contra
     * @param String $numero
     * @return UsuarioDTO
     */
    public function verUsuarioPorContraseña($contra, $numero) {
        try {
            $this->uDao = new UsuarioDAO();
            $this->uDto = $this->uDao->verUsuarioPorContraseña(utf8_decode($contra), $numero);
            return $this->uDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Long $numero
     * @param String $claveNueva
     * @return String
     */
    public function cambiarContraseña($numero, $claveNueva) {
        try {
            $this->uDao = new UsuarioDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->uDao->cambiarContraseña($numero, utf8_decode($claveNueva))
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
