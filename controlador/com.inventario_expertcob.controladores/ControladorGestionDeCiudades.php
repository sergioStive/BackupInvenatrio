<?php

/**
 * Description of ControladorGestionDeCiudades
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/SucursalDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/SucursalDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/CiudadDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/CiudadDTO.php';

class ControladorGestionDeCiudades {

    /**
     *
     * @var CiudadDAO 
     */
    private $cDao = null; //instancia de la clase CiudadDAO 

    /**
     *
     * @var CiudadDTO
     */
    private $cDto = null; //instancia de la clase CiudadDTO 

    /**
     *
     * @var SucursalDAO 
     */
    private $sDao = null; //instancia de la clase SucursalDAO

    /**
     *
     * @var SucursalDTO 
     */
    private $sDto = null; //instancia de la clase SucursalDTO

    /**
     *
     * @var array 
     */
    private $lista = null; //variable a utilizar como array

    /**
     * 
     * @param String $nombre
     * @return String
     */
    public function registrarCiudad($nombre) {
        try {
            $this->cDao = new CiudadDAO();
            $this->cDto = $this->cDao->verCiudadPorNombre(utf8_decode($nombre));
            if ($this->cDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->cDao->insertar(new CiudadDTO(0, utf8_decode($nombre)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una ciudad en con ese nombre'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idCiudad
     * @param String $barrio
     * @param String $telefono
     * @param String $direccion
     * @return String
     */
    public function registrarSucursal($idCiudad, $barrio, $telefono, $direccion) {
        try {
            $this->sDao = new SucursalDAO;
            $this->sDto = $this->sDao->verSucursalPorCiudadYDireccion(utf8_decode($idCiudad), utf8_decode($direccion));
            if ($this->sDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->sDao->insertar(new SucursalDTO(0, utf8_decode($barrio), utf8_decode($direccion), $telefono, $idCiudad))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una sucursal en esa ciudad con esa dirección'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    

    /**
     * 
     * @param Integer $idCiudad
     * @param String $barrio
     * @param String $telefono
     * @param String $direccion
     * @return String
     */
    public function registrarSucursal($idCiudad, $barrio, $telefono, $direccion) {
        try {
            $this->sDao = new SucursalDAO;
            $this->sDto = $this->sDao->verSucursalPorCiudadYDireccion(utf8_decode($idCiudad), utf8_decode($direccion));
            if ($this->sDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->sDao->insertar(new SucursalDTO(0, utf8_decode($barrio), utf8_decode($direccion), $telefono, $idCiudad))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una sucursal en esa ciudad con esa dirección'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $numero
     * @param Integer $idCiudad
     * @param String $barrio
     * @param String $telefono
     * @param String $direccion
     * @return String
     */
    public function modificarSucursal($numero, $idCiudad, $barrio, $telefono, $direccion) {
        try {
            $this->sDao = new SucursalDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->sDao->modificar(new SucursalDTO($numero, utf8_decode($barrio), utf8_decode($direccion), $telefono, $idCiudad))
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
    public function eliminarSucursal($id) {
        try {
            $this->sDao = new SucursalDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->sDao->eliminar($id)
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Intenger $id
     * @return SucursalDTO
     */
    public function verUnaSucursal($id) {
        try {
            $this->sDao = new SucursalDAO();
            $this->sDto = $this->sDao->verUno($id);
            return $this->sDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<SucursalDTO>
     */
    public function verSucursales() {
        try {
            $this->sDao = new SucursalDAO();
            $this->lista = $this->sDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
