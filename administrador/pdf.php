
<?php
/**
 * 
 * @author Erick Guzmán
 */
session_start();
require ('../lib/fpdf17/fpdf.php');
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeMueblesEnseres.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeSucursales.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeDispositivos.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeTorres.php';


$controladorSucursales = new ControladorGestionDeSucursales();
$controladorMueblesEnceres = new ControladorGestionDeMueblesEnseres();
$controladorDispositivos = new ControladorGestionDeDispositivos();
$controladorTorres = new ControladorGestionDeTorres();


if (isset($_REQUEST['of']) && is_numeric($_REQUEST['of'])) {
    $dispositivos = $controladorDispositivos->verDispositivosPorOficina($_REQUEST['of']);
    $oDto = $controladorSucursales->verUnaOficina($_REQUEST['of']);
    if (count($dispositivos) > 0) {

        $pdf = new FPDF('L', 'mm', 'Legal');
        $pdf->AddPage();
        $pdf->Image('../resources/imagenes/favicon.png', 35, 10, 35, 20, 'PNG');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(145, 20, '', 0);
        $pdf->Cell(70, 20, "LISTADO DE DISPOSITIVOS ", 0);
        $pdf->Ln(27);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(60, 10, "Oficina: " . $oDto->getNombreOficina(), 0);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(8, 10, '', 0);
        $pdf->Cell(35, 10, 'Puesto', 0);
        $pdf->Cell(30, 10, 'Tipo', 0);
        $pdf->Cell(50, 10, 'Modelo', 0);
        $pdf->Cell(50, 10, 'Serial', 0);
        $pdf->Cell(35, 10, 'Valor', 0);
        $pdf->Cell(60, 10, utf8_decode('Observación'), 0);
        $pdf->Cell(40, 10, 'Marca', 0);
        $pdf->Cell(30, 10, 'Estado', 0);
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 10);

        $contador = 0;

        foreach ($dispositivos as $dDto) {
            $pDto = $controladorSucursales->verUnPuesto($dDto->getIdPuesto());
            $tDto = $controladorDispositivos->verTipo($dDto->getIdTipo());
            $mDto = $controladorDispositivos->verMarca($dDto->getIdMarca());
            $eDto = $controladorMueblesEnceres->verEstado($dDto->getIdEstado());

            $pdf->Cell(8, 10, '', 0);
            $pdf->Cell(35, 10, utf8_encode($pDto->getNombrePuesto()), 0);
            $pdf->Cell(30, 10, utf8_encode($tDto->getNombreTipo()), 0);
            $pdf->Cell(50, 10, utf8_encode($dDto->getModeloNumero()), 0);
            $pdf->Cell(50, 10, utf8_encode($dDto->getSerial()), 0);
            $pdf->Cell(35, 10, "$ " . utf8_encode($dDto->getValor()), 0);
            $pdf->Cell(60, 10, $dDto->getObservacion(), 0);
            $pdf->Cell(40, 10, utf8_encode($mDto->getNombreMarca()), 0);
            $pdf->Cell(30, 10, utf8_encode($eDto->getDescripcion()), 0);
            $pdf->Ln(8);
            $contador++;
        }

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 30, "Total: $contador", 0);
        $pdf->Output();
    } else {
        ?>

        <script>
            alert("Parametro incorrecto");
            location.href = 'index_admin.php';
        </script> 

        <?php
    }
} else if (isset($_REQUEST['ofm']) && is_numeric($_REQUEST['ofm'])) {
    $muebles = $controladorMueblesEnceres->verMueblesEnseresPorOficina($_REQUEST['ofm']);
    $oDto = $controladorSucursales->verUnaOficina($_REQUEST['ofm']);
    if (count($muebles) > 0) {

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('../resources/imagenes/favicon.png', 25, 10, 30, 20, 'PNG');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(65, 18, '', 0);
        $pdf->Cell(80, 20, "LISTADO DE MUEBLES Y ENCERES ", 0);
        $pdf->Ln(25);
        $pdf->Cell(30, 10, "Oficina: " . $oDto->getNombreOficina(), 0);
        $pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(25, 10, '', 0);
        $pdf->Cell(45, 10, utf8_decode('Descripción'), 0);
        $pdf->Cell(38, 10, 'Cantidad', 0);
        $pdf->Cell(38, 10, 'Valor', 0);
        $pdf->Cell(38, 10, 'Estado', 0);
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 10);

        $contador = 0;

        foreach ($muebles as $muDto) {
            $eDto = $controladorMueblesEnceres->verEstado($muDto->getIdEstado());

            $pdf->Cell(25, 10, '', 0);
            $pdf->Cell(45, 10, utf8_encode($muDto->getDescripcion()), 0);
            $pdf->Cell(38, 10, utf8_encode($muDto->getCantidad()), 0);
            $pdf->Cell(38, 10, "$ " . utf8_encode($muDto->getValor()), 0);
            $pdf->Cell(38, 10, utf8_encode($eDto->getDescripcion()), 0);
            $pdf->Ln(8);

            $contador++;
        }

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 30, "Total: $contador", 0);
        $pdf->Output();
    } else {
        ?>

        <script>
            alert("Parametro incorrecto");
            location.href = 'index_admin.php';
        </script> 

        <?php
    }
} else if (isset($_REQUEST['di']) && is_numeric($_REQUEST['di'])) {
    $dispositivo = $controladorDispositivos->verDispositivo($_REQUEST['di']);

    if ($dispositivo != null) {
        $revisiones = $controladorDispositivos->verRevisionesPorDispositivo($_REQUEST['di']);

        $pdf = new FPDF();
        $pdf->AddPage('P', '', 'Carta');
        $pdf->Image('../resources/imagenes/favicon.png', 30, 10, 20, 15, 'PNG');

        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->Cell(65, 15, '', 0);
        $pdf->Cell(80, 15, "HOJA DE VIDA DE DISPOSITIVO", 0);
        $pdf->Ln(26);
        $pdf->Cell(35, 15, '', 0);
        $pdf->Cell(80, 15, "IDENTIFICACION Y ESPECIFICACIONES DEL DISPOSITIVO", 0);
        $pdf->Ln(20);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, 'Tipo de dispositivo:', 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, utf8_decode('Ubicación del dispositivo:'), 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, 'Marca:', 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, 'Modelo:', 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, 'Serial:', 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, 'Valor:', 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t $ Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, utf8_decode('Observación:'), 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, utf8_decode('Estado:'), 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(17);

        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->Cell(55, 15, '', 0);
        $pdf->Cell(80, 15, "CARACTERISTICAS DEL DISPOSITIVO", 0);
        $pdf->Ln(20);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, 'Procesador:', 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, utf8_decode('RAM:'), 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, 'Disco duro:', 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, 'Sistema operativo:', 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(9);

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(10, 10, '', 0);
        $pdf->Cell(55, 10, 'Office:', 0);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->Cell(135, 10, "\t \t \t \t \t Torre", 0);
        $pdf->Ln(20);


        if (count($revisiones) > 0) {

            $pdf->SetFont('Helvetica', 'B', 12);
            $pdf->Cell(55, 15, '', 0);
            $pdf->Cell(80, 15, "REVISIONES DEL DISPOSITIVO", 0);
            $pdf->Ln(20);

            $pdf->SetFont('Helvetica', '', 11);
            $pdf->Cell(30, 10, '', 0);
            $pdf->Cell(65, 10, 'TIPO DE MANTENIMIENTO', 0);
            $pdf->Cell(65, 10, "OBSERVACION", 0);
            $pdf->Ln(10);

            $pdf->SetFont('Helvetica', '', 11);
            $pdf->Cell(30, 10, '', 0);
            $pdf->Cell(65, 10, 'TEXTO', 0);
            $pdf->Cell(65, 10, "TEXTO", 0);
            $pdf->Ln(8);
        }

        $pdf->SetFont('Arial', 'B', 12);
//$pdf->Cell(10, 30, "Total: $contador", 0);
        $pdf->Output();
//    } else {
//        
    }
    ?>

                    <!--<script>
                        alert("Parametro incorrecto");
                        location.href = 'index_admin.php';
                    </script> -->

    <?php
//
//    }
}

    