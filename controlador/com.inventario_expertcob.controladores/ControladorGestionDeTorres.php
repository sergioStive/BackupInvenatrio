<?php

/**
 * Description of ControladorGestionDeTorres
 *
 * @author Erick Guzmán
 */
//require_once '../modelo/com.inventario_expertcob.dao/TorreDAO.php';
//require_once '../modelo/com.inventario_expertcob.dto/TorreDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/OfficeDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/OfficeDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/SistemaOperativoDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/SistemaOperativoDTO.php';

class ControladorGestionDeTorres {

    /**
     *
     * @var TorreDAO 
     */
    private $tDao = null; //instancia de la clase TorreDAO

    /**
     *
     * @var TorreDTO 
     */
    private $tDto = null; //instancia de la clase TorreDTO

    /**
     *
     * @var OfficeDAO 
     */
    private $oDao = null; //instancia de la clase OfficeDAO

    /**
     *
     * @var OfficeDTO 
     */
    private $oDto = null; //instancia de la clase OfficeDTO

    /**
     *
     * @var SistemaOperativoDAO 
     */
    private $sDao = null; //instancia de la clase SistemaOperativoDAO

    /**
     *
     * @var SistemaOperativoDTO 
     */
    private $sDto = null; //instancia de la clase SistemaOperativoDTO

    /**
     *
     * @var array 
     */
    private $lista = null; //variable a utilizar como array

    /**
     * 
     * @param Integer $idTorre
     * @param String $procesador
     * @param String $ram
     * @param String $disquete
     * @param String $hdd
     * @param String $cdRom
     * @param String $antivirus
     * @param String $sisOperativoKey
     * @param String $officeKey
     * @param Integer $idSistemaOperativo
     * @param Integer $idOffice
     * @return String
     */

    public function registrarTorre($idTorre, $procesador, $ram, $disquete, $hdd, $cdRom, $antivirus, $sisOperativoKey, $officeKey, $idSistemaOperativo, $idOffice) {
        try {
            $this->tDao = new TorreDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->tDao->insertar(new TorreDTO($idTorre, utf8_decode($procesador), utf8_decode($ram), utf8_decode($hdd), utf8_decode($disquete), utf8_decode($cdRom), utf8_decode($antivirus), utf8_decode($sisOperativoKey), utf8_decode($officeKey), $idSistemaOperativo, $idOffice))
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idTorre
     * @param String $procesador
     * @param String $ram
     * @param String $disquete
     * @param String $hdd
     * @param String $cdRom
     * @param String $antivirus
     * @param String $sisOperativoKey
     * @param String $officeKey
     * @param Integer $idSistemaOperativo
     * @param Integer $idOffice
     * @return String
     */
    public function modificarTorre($idTorre, $procesador, $ram, $disquete, $hdd, $cdRom, $antivirus, $sisOperativoKey, $officeKey, $idSistemaOperativo, $idOffice) {
        try {
            $this->tDao = new TorreDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->tDao->modificar(new TorreDTO($idTorre, utf8_decode($procesador), utf8_decode($ram), utf8_decode($hdd), utf8_decode($disquete), utf8_decode($cdRom), utf8_decode($antivirus), utf8_decode($sisOperativoKey), utf8_decode($officeKey), $idSistemaOperativo, $idOffice))
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
    public function eliminarTorre($id) {
        try {
            $this->tDao = new TorreDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->tDao->eliminar($id)
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return TorreDTO
     */
    public function verTorre($id) {
        try {
            $this->tDao = new TorreDAO();
            $this->tDto = $this->tDao->verUno($id);
            return $this->tDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<TorreDTO>
     */
    public function verTorres() {
        try {
            $this->tDao = new TorreDAO();
            $this->lista = $this->tDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param String $nombreOffice
     * @return String
     */
    public function registrarOffice($nombreOffice) {
        try {
            $this->oDao = new OfficeDAO();
            $this->oDto = $this->oDao->verOfficePorNombre($nombreOffice);
            if ($this->oDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->oDao->insertar(new OfficeDTO(0, utf8_decode($nombreOffice)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una versión de office con ese nombre'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idOffice
     * @param String $nombreOffice
     * @return String
     */
    public function modificarOffice($idOffice, $nombreOffice) {
        try {
            $this->oDao = new OfficeDAO();
            $this->oDto = $this->oDao->verOfficePorNombre($nombreOffice);
            if ($this->oDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->oDao->modificar(new OfficeDTO($idOffice, utf8_decode($nombreOffice)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una versión de office con ese nombre'
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
    public function eliminarOffice($id) {
        try {
            $this->tDao = new TorreDAO();
            $this->tDto = $this->tDao->verTorrePorOffice($id);
            if ($this->tDto == null) {
                $this->oDao = new OfficeDAO();
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->oDao->eliminar($id)
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > No se puede eliminar el office porque hay torres con el software'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return OfficeDTO
     */
    public function verOffice($id) {
        try {
            $this->oDao = new OfficeDAO();
            $this->oDto = $this->oDao->verUno($id);
            return $this->oDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<OfficeDTO>
     */
    public function verOffices() {
        try {
            $this->oDao = new OfficeDAO();
            $this->lista = $this->oDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param String $nombreSistemaOperativo
     * @return String
     */
    public function registrarSistemaOperativo($nombreSistemaOperativo) {
        try {
            $this->sDao = new SistemaOperativoDAO();
            $this->sDto = $this->sDao->verSoPorNombre($nombreSistemaOperativo);
            if ($this->sDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->sDao->insertar(new SistemaOperativoDTO(0, utf8_decode($nombreSistemaOperativo)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe un sistema operativo con ese nombre'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idSistemaOpertativo
     * @param String $nombreSistemaOperativo
     * @return String
     */
    public function modificarSistemaOperativo($idSistemaOpertativo, $nombreSistemaOperativo) {
        try {
            $this->sDao = new SistemaOperativoDAO();
            $this->sDto = $this->sDao->verSoPorNombre($nombreSistemaOperativo);
            if ($this->oDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->sDao->modificar(new SistemaOperativoDTO($idSistemaOpertativo, utf8_decode($nombreSistemaOperativo)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe un sistema operativo con ese nombre'
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
    public function eliminarSistemaOperativo($id) {
        try {
            $this->tDao = new TorreDAO();
            $this->tDto = $this->tDao->verTorrePorSisOperativo($id);
            if ($this->tDto == null) {
                $this->sDao = new SistemaOperativoDAO();
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->sDao->eliminar($id)
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > No se puede eliminar el sistema operativo porque hay torres con el software'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return SistemaOperativoDTO
     */
    public function verSistemaOperativo($id) {
        try {
            $this->sDao = new SistemaOperativoDAO();
            $this->sDto = $this->sDao->verUno($id);
            return $this->sDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<SistemaOperativoDTO>
     */
    public function verSistemasOperativos() {
        try {
            $this->sDao = new SistemaOperativoDAO();
            $this->lista = $this->sDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
