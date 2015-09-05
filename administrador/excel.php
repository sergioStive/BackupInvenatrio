<?php session_start(); //inicio de la sesion               ?>

<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeMueblesEnseres.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeSucursales.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeDispositivos.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeTorres.php';
$fecha = date("d-m-y");
header("Content-type: application/vnd.ms-excel");
?>
<html>
    <body>
        <?php
        $controladorSucursales = new ControladorGestionDeSucursales();
        $controladorMueblesEnceres = new ControladorGestionDeMueblesEnseres();
        $controladorDispositivos = new ControladorGestionDeDispositivos();
        $controladorTorres = new ControladorGestionDeTorres();

        if (isset($_REQUEST['of']) && is_numeric($_REQUEST['of'])) {
            header("Content-Disposition: attachment; filename=Dispositivos-$fecha.xls; pagename=Reporte");
            $dispositivos = $controladorDispositivos->verDispositivosPorOficina($_REQUEST['of']);
            $oDto = $controladorSucursales->verUnaOficina($_REQUEST['of']);
            if (count($dispositivos) > 0) {
                ?>
                <table border="1">
                    <thead>
                        <tr> 
                            <td style="background-color: #6495ED; color: whitesmoke;">Oficina</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Puesto</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Tipo</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Modelo</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Serial</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Valor</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Observacion</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Marca</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Estado</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Procesador</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">HDD</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">RAM</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Disquete</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Cd-Rom</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Antivirus</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Sistema operativo</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Sistema operativo Key</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Office</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Office Key</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dispositivos as $dDto) {
                            $pDto = $controladorSucursales->verUnPuesto($dDto->getIdPuesto());
                            $tDto = $controladorDispositivos->verTipo($dDto->getIdTipo());
                            $mDto = $controladorDispositivos->verMarca($dDto->getIdMarca());
                            $eDto = $controladorMueblesEnceres->verEstado($dDto->getIdEstado());
                            ?>
                            <tr>
                                <td><?php echo utf8_encode($oDto->getNombreOficina()); ?></td>
                                <td><?php echo utf8_encode($pDto->getNombrePuesto()); ?></td>
                                <td><?php echo utf8_encode($tDto->getNombreTipo()); ?></td>
                                <td><?php echo utf8_encode($dDto->getModeloNumero()); ?></td>
                                <td><?php echo utf8_encode($dDto->getSerial()); ?></td>
                                <td><?php echo "$ " . utf8_encode($dDto->getValor()); ?></td>
                                <td><?php echo $dDto->getObservacion(); ?></td>
                                <td><?php echo utf8_encode($mDto->getNombreMarca()); ?></td>
                                <td><?php echo utf8_encode($eDto->getDescripcion()); ?></td>
                                <?php
                                $torre = $controladorTorres->verTorre($dDto->getIdDispositivo());
                                if ($torre != null) {
                                    $soDto = $controladorTorres->verSistemaOperativo($torre->getIdSistemaOperativo());
                                    $ofDto = $controladorTorres->verOffice($torre->getIdOffice());
                                    ?>
                                    <td><?php echo utf8_encode($torre->getProcesador()); ?></td>
                                    <td><?php echo utf8_encode($torre->getHdd()); ?></td>
                                    <td><?php echo utf8_encode($torre->getRam()); ?></td>
                                    <td><?php echo utf8_encode($torre->getDisquete()); ?></td>
                                    <td><?php echo utf8_encode($torre->getCdRom()); ?></td>
                                    <td><?php echo utf8_encode($torre->getAntivirus()); ?></td>
                                    <td><?php echo utf8_encode($soDto->getNombreSistemaOperativo()); ?></td>
                                    <td><?php echo utf8_encode($torre->getSisOperativoKey()); ?></td>
                                    <td><?php echo utf8_encode($ofDto->getNombreOffice()); ?></td>
                                    <td><?php echo utf8_encode($torre->getOfficeKey()); ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                ?>
                <script>
                    alert("Parametro incorrecto");
                    location.href = 'index_admin.php';
                </script> 

                <?php
            }
        } else if (isset($_REQUEST['ofm']) && is_numeric($_REQUEST['ofm'])) {
            header("Content-Disposition: attachment; filename=Mubles-$fecha.xls; pagename=Reporte");
            $muebles = $controladorMueblesEnceres->verMueblesEnseresPorOficina($_REQUEST['ofm']);
            $oDto = $controladorSucursales->verUnaOficina($_REQUEST['ofm']);
            if (count($muebles) > 0) {
                ?>
                <table border="1">
                    <thead>
                        <tr> 
                            <td style="background-color: #6495ED; color: whitesmoke;">Oficina</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Descripcion</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Cantidad</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Valor</td>
                            <td style="background-color: #6495ED; color: whitesmoke;">Estado</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($muebles as $muDto) {
                            $eDto = $controladorMueblesEnceres->verEstado($muDto->getIdEstado());
                            ?>
                            <tr>
                                <td><?php echo utf8_encode($oDto->getNombreOficina()); ?></td>
                                <td><?php echo utf8_encode($muDto->getDescripcion()); ?></td>
                                <td><?php echo utf8_encode($muDto->getCantidad()); ?></td>
                                <td><?php echo "$ " . utf8_encode($muDto->getValor()); ?></td>
                                <td><?php echo utf8_encode($eDto->getDescripcion()); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                ?>
                <script>
                    alert("Parametro incorrecto");
                    location.href = 'index_admin.php';
                </script> 

                <?php
            }
        } else {
            ?>
            <script>
                alert("No puede acceder");
                location.href = 'index_admin.php';
            </script> 

            <?php
        }
        ?>
    </body>
</html>
