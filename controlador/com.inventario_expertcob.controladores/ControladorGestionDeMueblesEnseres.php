<?php

/**
 * Description of ControladorGestionDeMueblesEnceres
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/MuebleEnserDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/MuebleEnserDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/EstadoDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/EstadoDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/DispositivoDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/DispositivoDTO.php';

class ControladorGestionDeMueblesEnseres {

    /**
     *
     * @var MuebleEnserDAO 
     */
    private $mDao = null; //instancia de la clase MuebleEnserDAO

    /**
     *
     * @var MuebleEnserDTO 
     */
    private $mDto = null; //instancia de la clase MuebleEnserDTO

    /**
     *
     * @var EstadoDAO 
     */
    private $eDao = null; //instancia de la clase EstadoDAO

    /**
     *
     * @var EstadoDTO 
     */
    private $eDto = null; //instancia de la clase EstadoDTO

    /**
     *
     * @var DispositivoDAO 
     */
    private $dDao = null; //instancia de la clase DispositivoDAO

    /**
     *
     * @var DispositivoDTO 
     */
    private $dDto = null; //instancia de la clase DispositivoDTO

    /**
     *
     * @var array 
     */
    private $lista = null; //variable a utilizar como array

    /**
     * 
     * @param String $descripcion
     * @param Integer $cantidad
     * @param String $valor
     * @param Integer $idEstado
     * @return String
     */

    public function registrarMuebleEnser($descripcion, $cantidad, $valor, $idEstado, $idOficina) {
        try {
            $this->mDao = new MuebleEnserDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->mDao->insertar(new MuebleEnserDTO(0, utf8_decode($descripcion), $cantidad, utf8_decode($valor), $idEstado, $idOficina))
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idMuebleEnser
     * @param String $descripcion
     * @param Integer $cantidad
     * @param String $valor
     * @param Integer $idEstado
     * @return String
     */
    public function modificarMuebleEnser($idMuebleEnser, $descripcion, $cantidad, $valor, $idEstado, $idOficina) {
        try {
            $this->mDao = new MuebleEnserDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->mDao->modificar(new MuebleEnserDTO($idMuebleEnser, utf8_decode($descripcion), $cantidad, utf8_decode($valor), $idEstado, $idOficina))
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
    public function eliminarMuebleEnser($id) {
        try {
            $this->mDao = new MuebleEnserDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->mDao->eliminar($id)
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return MuebleEnserDTO
     */
    public function verMuebleEnser($id) {
        try {
            $this->mDao = new MuebleEnserDAO();
            $this->mDto = $this->mDao->verUno($id);
            return $this->mDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<MuebleEnserDTO>
     */
    public function verMueblesEnseres() {
        try {
            $this->mDao = new MuebleEnserDAO();
            $this->lista = $this->mDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<MuebleEnserDTO>
     */
    public function verMueblesEnseresPorPuesto($id) {
        try {
            $this->mDao = new MuebleEnserDAO();
            $this->lista = $this->mDao->verMueblesEnseresPorIdDePuesto($id);
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    /**
     * 
     * @return array<MuebleEnserDTO>
     */
    public function verMueblesEnseresPorOficina($num) {
        try {
            $this->mDao = new MuebleEnserDAO();
            $this->lista = $this->mDao->verMueblesEnseresPorOficina($num);
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param String $descripcion
     * @return String
     */
    public function registrarEstado($descripcion) {
        try {
            $this->eDao = new EstadoDAO();
            $this->eDto = $this->eDao->verEstadoPorDescripcion(utf8_decode($descripcion));
            if ($this->eDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->eDao->insertar(new EstadoDTO(0, utf8_decode($descripcion)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe un estado con esa descripción'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idEstado
     * @param String $descripcion
     * @return String
     */
    public function modificarEstado($idEstado, $descripcion) {
        try {
            $this->eDao = new EstadoDAO();
            $this->eDto = $this->eDao->verEstadoPorDescripcion(utf8_decode($descripcion));
            if ($this->eDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->eDao->modificar(new EstadoDTO($idEstado, utf8_decode($descripcion)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe un estado con esa descripción'
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
    public function eliminarEstado($id) {
        try {
            $this->dDao = new DispositivoDAO();
            $this->mDao = new MuebleEnserDAO();
            $this->dDto = $this->dDao->verDispositivoPorIdDeEstado($id);
            $this->mDto = $this->mDao->verMuebleEnserPorIdDeEstado($id);
            if ($this->dDto == null && $this->mDto == null) {
                $this->eDao = new EstadoDAO();
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->eDao->eliminar($id)
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > No se puede eliminar porque hay dispositivos o muebles en ese estado'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return EstadoDTO
     */
    public function verEstado($id) {
        try {
            $this->eDao = new EstadoDAO();
            $this->eDto = $this->eDao->verUno($id);
            return $this->eDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<EstadoDTO>
     */
    public function verEstados() {
        try {
            $this->eDao = new EstadoDAO();
            $this->lista = $this->eDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
