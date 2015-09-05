<?php

/**
 * Description of ControladorGestionDeDispositivos
 *
 * @author Erick Guzmán
 */
require_once '../modelo/com.inventario_expertcob.dao/DispositivoDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/DispositivoDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/TipoDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/TipoDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/MarcaDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/MarcaDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/ClaseDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/ClaseDTO.php';
require_once '../modelo/com.inventario_expertcob.dao/RevisionDAO.php';
require_once '../modelo/com.inventario_expertcob.dto/RevisionDTO.php';

class ControladorGestionDeDispositivos {

    /**
     *
     * @var DispositivoDTO 
     */
    private $dDto = null; //instancia de la clase DispositivoDTO

    /**
     *
     * @var DispositivoDAO 
     */
    private $dDao = null; //instancia de la clase DispositivoDAO

    /**
     *
     * @var TipoDTO 
     */
    private $tDto = null; //instancia de la clase TipoDTO

    /**
     *
     * @var TipoDAO 
     */
    private $tDao = null; //instancia de la clase TipoDAO

    /**
     *
     * @var MarcaDTO 
     */
    private $mDto = null; //instancia de la clase MarcaDTO

    /**
     *
     * @var MarcaDAO 
     */
    private $mDao = null; //instancia de la clase MarcaDAO

    /**
     *
     * @var ClaseDTO 
     */
    private $cDto = null; //instancia de la clase ClaseDTO

    /**
     *
     * @var ClaseDAO 
     */
    private $cDao = null; //instancia de la clase ClaseDAO

    /**
     *
     * @var RevisionDTO 
     */
    private $rDto = null; //instancia de la clase RevisionDTO

    /**
     *
     * @var RevisionDAO 
     */
    private $rDao = null; //instancia de la clase RevisionDAO

    /**
     *
     * @var array 
     */
    private $lista = null; //variable a utilizar como array

    /**
     * 
     * @param Integer $idDispositivo
     * @param String $modeloNumero
     * @param String $serial
     * @param String $valor
     * @param String $observacion
     * @param Integer $idPuesto
     * @param Integer $idMarca
     * @param Integer $idTipo
     * @param Integer $idClase
     * @param Integer $idEstado
     * @return String
     */

    public function registrarDispositivo($idDispositivo, $modeloNumero, $serial, $valor, $observacion, $idPuesto, $idMarca, $idTipo, $idEstado) {
        try {
            $this->dDao = new DispositivoDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->dDao->insertar(new DispositivoDTO($idDispositivo, utf8_decode(strtoupper($modeloNumero)), utf8_decode(strtoupper($serial)), utf8_decode($valor), utf8_decode($observacion), $idPuesto, $idMarca, $idTipo, $idEstado))
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idDispositivo
     * @param String $modeloNumero
     * @param String $serial
     * @param String $valor
     * @param String $observacion
     * @param Integer $idPuesto
     * @param Integer $idMarca
     * @param Integer $idTipo
     * @param Integer $idClase
     * @param Integer $idEstado
     * @return String
     */
    public function modificarDispositivo($idDispositivo, $modeloNumero, $serial, $valor, $observacion, $idPuesto, $idMarca, $idTipo, $idEstado) {
        try {
            $this->dDao = new DispositivoDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->dDao->modificar(new DispositivoDTO($idDispositivo, utf8_decode(strtoupper($modeloNumero)), utf8_decode(strtoupper($serial)), utf8_decode($valor), utf8_decode($observacion), $idPuesto, $idMarca, $idTipo, $idEstado))
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
    public function eliminarDispositivo($id) {
        try {
            $this->dDao = new DispositivoDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->dDao->eliminar($id)
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return DispositivoDTO
     */
    public function verDispositivo($id) {
        try {
            $this->dDao = new DispositivoDAO();
            $this->dDto = $this->dDao->verUno($id);
            return $this->dDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<DispositivoDTO>
     */
    public function verDispositivos() {
        try {
            $this->dDao = new DispositivoDAO();
            $this->lista = $this->dDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return Integer
     */
    public function contarDispositivos() {
        try {
            $this->dDao = new DispositivoDAO();
            $dispositivos = $this->dDao->contarDispositivos();
            return $dispositivos;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $num
     * @return array<DispositivoDTO>
     */
    public function verDispositivosPorOficina($num) {
        try {
            $this->dDao = new DispositivoDAO();
            $this->lista = $this->dDao->verDispositivosPorOficina($num);
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param String $nombreTipo
     * @return String
     */
    public function registrarTipo($nombreTipo, $idClase) {
        try {
            $this->tDao = new TipoDAO();
            $this->tDto = $this->tDao->verTipoPorNombre(utf8_decode(strtoupper($nombreTipo)));
            if ($this->tDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->tDao->insertar(new TipoDTO(0, utf8_decode(strtoupper($nombreTipo)), $idClase))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe un tipo de dispositivo con ese nombre'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idTipo
     * @param String $nombreTipo
     * @return String
     */
    public function modificarTipo($idTipo, $nombreTipo, $idClase) {
        try {
            $this->tDao = new TipoDAO();
            $this->tDto = $this->tDao->verTipoPorNombre(utf8_decode(strtoupper($nombreTipo)));
            if ($this->tDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->tDao->modificar(new TipoDTO($idTipo, utf8_decode(strtoupper($nombreTipo)), $idClase))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe un tipo de dispositivo con ese nombre'
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
    public function eliminarTipo($id) {
        try {
            $this->dDao = new DispositivoDAO();
            $this->dDto = $this->dDao->verDispositivoPorIdDeTipo($id);
            if ($this->dDto == null) {
                $this->tDao = new TipoDAO();
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->tDao->eliminar($id)
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > No se puede eliminar el tipo porque hay dispositivos de este tipo'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return TipoDTO
     */
    public function verTipo($id) {
        try {
            $this->tDao = new TipoDAO();
            $this->tDto = $this->tDao->verUno($id);
            return $this->tDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<TipoDTO>
     */
    public function verTipos() {
        try {
            $this->tDao = new TipoDAO();
            $this->lista = $this->tDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param String $nombreMarca
     * @return String
     */
    public function registrarMarca($nombreMarca) {
        try {
            $this->mDao = new MarcaDAO();
            $this->mDto = $this->mDao->verMarcaPorNombre(utf8_decode($nombreMarca));
            if ($this->mDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->mDao->insertar(new MarcaDTO(0, utf8_decode($nombreMarca)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una marca con ese nombre'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idMarca
     * @param String $nombreMarca
     * @return String
     */
    public function modificarMarca($idMarca, $nombreMarca) {
        try {
            $this->mDao = new MarcaDAO();
            $this->mDto = $this->mDao->verMarcaPorNombre(utf8_decode($nombreMarca));
            if ($this->mDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->mDao->modificar(new MarcaDTO($idMarca, utf8_decode($nombreMarca)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una marca con ese nombre'
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
    public function eliminarMarca($id) {
        try {
            $this->dDao = new DispositivoDAO();
            $this->dDto = $this->dDao->verDispositivoPorIdDeMarca($id);
            if ($this->dDto == null) {
                $this->mDao = new MarcaDAO();
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->mDao->eliminar($id)
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > No se puede eliminar la marca porque hay dispositivos de esta marca'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return MarcaDTO
     */
    public function verMarca($id) {
        try {
            $this->mDao = new MarcaDAO();
            $this->mDto = $this->mDao->verUno($id);
            return $this->mDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<MarcaDTO>
     */
    public function verMarcas() {
        try {
            $this->mDao = new MarcaDAO();
            $this->lista = $this->mDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param String $nombreClase
     * @return String
     */
    public function registrarClase($nombreClase) {
        try {
            $this->cDao = new ClaseDAO();
            $this->cDto = $this->cDao->verClasePorNombre(utf8_decode($nombreClase));
            if ($this->cDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->cDao->insertar(new ClaseDTO(0, utf8_decode($nombreClase)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una clase de dispositivos con ese nombre'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idMarca
     * @param String $nombreClase
     * @return String
     */
    public function modificarClase($idMarca, $nombreClase) {
        try {
            $this->cDao = new ClaseDAO();
            $this->cDto = $this->cDao->verClasePorNombre(utf8_decode($nombreClase));
            if ($this->cDto == null) {
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->cDao->modificar(new ClaseDTO($idMarca, utf8_decode($nombreClase)))
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > Ya existe una clase de equipos con ese nombre'
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
    public function eliminarClase($id) {
        try {
            $this->tDao = new TipoDAO();
            $this->tDto = $this->tDao->verTiposPorIdDeClase($id);
            if ($this->tDto == null) {
                $this->cDao = new ClaseDAO();
                return '<div class="notificacion"><div class="mensaje">'
                        . '<h2>Inventario Expertcob</h2>'
                        . $this->cDao->eliminar($id)
                        . '</div></div>';
            } else {
                return '<div class="notificacion" ><div class="mensaje" id="err">'
                        . '<h2>Inventario Expertcob</h2>'
                        . '<img alt="Error" src="../resources/imagenes/Error.png" > No se puede eliminar la clase porque hay dispositivos de esta clase'
                        . '</div></div>';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return ClaseDTO
     */
    public function verClase($id) {
        try {
            $this->cDao = new ClaseDAO();
            $this->cDto = $this->cDao->verUno($id);
            return $this->cDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<ClaseDTO>
     */
    public function verClases() {
        try {
            $this->cDao = new ClaseDAO();
            $this->lista = $this->cDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param String $mantenimiento
     * @param String $observacion
     * @param Integer $idDispositivo
     * @return String
     */
    public function registrarRevision($mantenimiento, $observacion, $idDispositivo) {
        try {
            $this->rDao = new RevisionDAO();
            $fecha = date("Y/m/d");
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->rDao->insertar(new RevisionDTO(0, $fecha, utf8_decode($mantenimiento), utf8_decode($observacion), $idDispositivo))
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $idRevision
     * @param String $mantenimiento
     * @param String $observacion
     * @param Integer $idDispositivo
     * @return String
     */
    public function modificarRevision($idRevision, $mantenimiento, $observacion, $idDispositivo) {
        try {
            $this->rDao = new RevisionDAO();
            $fecha = date("Y/m/d");
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->rDao->modificar(new RevisionDTO($idRevision, $fecha, utf8_decode($mantenimiento), utf8_decode($observacion), $idDispositivo))
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
    public function eliminarRevision($id) {
        try {
            $this->rDao = new RevisionDAO();
            return '<div class="notificacion"><div class="mensaje">'
                    . '<h2>Inventario Expertcob</h2>'
                    . $this->rDao->eliminar($id)
                    . '</div></div>';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return RevisionDTO
     */
    public function verRevision($id) {
        try {
            $this->rDao = new RevisionDAO();
            $this->rDto = $this->rDao->verUno($id);
            return $this->rDto;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @return array<RevisionDTO>
     */
    public function verRevisiones() {
        try {
            $this->rDao = new RevisionDAO();
            $this->lista = $this->rDao->verTodos();
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * 
     * @param Integer $id
     * @return array<RevisionDTO>
     */
    public function verRevisionesPorDispositivo($id) {
        try {
            $this->rDao = new RevisionDAO();
            $this->lista = $this->rDao->verRevisionesPorIdDeDispositivo($id);
            return $this->lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}
