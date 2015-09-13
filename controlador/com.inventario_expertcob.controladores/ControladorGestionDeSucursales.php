<?php

/**
 * Description of ControladorGestionDeSucursales
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/SucursalDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/SucursalDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/OficinaDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/OficinaDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/PuestoDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/PuestoDTO.php';

class ControladorGestionDeSucursales {

    /**
     *
     * @var OficinaDAO 
     */
    private $oDao = null; //instancia de la clase OficinaDAO

    /**
     *
     * @var OficinaDTO 
     */
    private $oDto = null; //instancia de la clase OficinaDTO

    /**
     *
     * @var PuestoDAO 
     */
    private $pDao = null; //instancia de la clase PuestoDAO

    /**
     *
     * @var PuestoDTO 
     */
    private $pDto = null; //instancia de la clase PuestoDTO

    /**
     *
     * @var array 
     */
    private $lista = null; //variable a utilizar como array

    /**
     * 
     * @param String $nombre
     * @param Integer $idSucursal
     * @return String
     */
    public function registrarOficina($nombre, $idSucursal) {
        try {
            $this->oDao = new OficinaDAO();
            $this->oDto = $this->oDao->consultarOficinaPorNombreYIdSucursal(utf8_decode($nombre), $idSucursal);
            if ($this->oDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->oDao->insertar(new OficinaDTO(0, utf8_decode($nombre), $idSucursal))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una oficina con ese nombre en la sucursal'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idOficina
     * @param String $nombre
     * @param Integer $idSucursal
     * @return String
     */
    public function modificarOficina($idOficina, $nombre, $idSucursal) {
        try {
            $this->oDao = new OficinaDAO();
            $this->oDto = $this->oDao->consultarOficinaPorNombreYIdSucursal(utf8_decode($nombre), $idSucursal);
            if ($this->oDto == null || $this->oDto->getNumOficina() == $idOficina) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->oDao->modificar(new OficinaDTO($idOficina, utf8_decode($nombre), $idSucursal))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una oficina con ese nombre en la sucursal'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return String
     */
    public function eliminarOficina($id) {
        try {
            $this->oDao = new OficinaDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->oDao->eliminar($id)
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return OficinaDTO
     */
    public function verUnaOficina($id) {
        try {
            $this->oDao = new OficinaDAO();
            $this->oDto = $this->oDao->verUno($id);
            return $this->oDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<OficinaDTO>
     */
    public function verOficinas() {
        try {
            $this->oDao = new OficinaDAO();
            $this->lista = $this->oDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return array<OficinaDTO>
     */
    public function verOficinasPorSucursal($id) {
        try {
            $this->oDao = new OficinaDAO();
            $this->lista = $this->oDao->verOficinasPorSucursal($id);
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param String $nombre
     * @param Long $idResponsable
     * @param Integer $idOficina
     * @return String
     */
    public function registrarPuesto($nombre, $idResponsable, $idOficina) {
        try {
            $this->pDao = new PuestoDAO();
            $this->pDto = $this->pDao->verPuestoPorNombreYOficina($idOficina, utf8_decode($nombre));
            if ($this->pDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->pDao->insertar(new PuestoDTO(0, $nombre, utf8_decode($idResponsable), $idOficina))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe un puesto con ese nombre en la oficina'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idPuesto
     * @param String $nombre
     * @param Long $idResponsable
     * @param Integer $idOficina
     * @return String
     */
    public function modificarPuesto($idPuesto, $nombre, $idResponsable, $idOficina) {
        try {
            $this->pDao = new PuestoDAO();
            $this->pDto = $this->pDao->verPuestoPorNombreYOficina($idOficina, utf8_decode($nombre));
            if ($this->pDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->pDao->modificar(new PuestoDTO($idPuesto, utf8_decode($nombre), $idResponsable, $idOficina))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe un puesto con ese nombre en la oficina'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return String
     */
    public function eliminarPuesto($id) {
        try {
            $this->pDao = new PuestoDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->pDao->eliminar($id)
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return PuestoDTO
     */
    public function verUnPuesto($id) {
        try {
            $this->pDao = new PuestoDAO();
            $this->pDto = $this->pDao->verUno($id);
            return $this->pDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<PuestoDTO>
     */
    public function verPuestos() {
        try {
            $this->pDao = new PuestoDAO();
            $this->lista = $this->pDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return array<PuestoDTO>
     */
    public function verPuestosPorNumeroDeOficina($id) {
        try {
            $this->pDao = new PuestoDAO();
            $this->lista = $this->pDao->verPuestosPorOficina($id);
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return array<PuestoDTO>
     */
    public function verPuestosPorIdDeResponsable($id) {
        try {
            $this->pDao = new PuestoDAO();
            $this->lista = $this->pDao->verPuestosPorResponsable($id);
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
