<?php session_start(); //inicio de la sesion          ?>

<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeMueblesEnseres.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeSucursales.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeDispositivos.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeTorres.php';
?>

<html>
    <head>
        <title>Inventario - Expertcob</title>
        <meta charset="UTF-8">
        <link type="image/png" rel="shortcut icon" href="../resources/imagenes/favicon.png">
        <link type="text/css" rel="stylesheet" href="../resources/css/administrador.css">
        <script type="text/javascript" src="../resources/js/jqueryVM.js"></script>
        <script type="text/javascript" src="../resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="../resources/js/jquery.validate.js"></script>
        <script type="text/javascript" src="../resources/js/jquery_table.buscador.js"></script>
        <script type="text/javascript" src="../resources/js/paging.js"></script>
        <script type="text/javascript">
            function openVentana() {
                $(".ventanaEliminar").slideDown("slow");
            }
            function closeVentana(link) {
                $(".ventanaEliminar").slideUp("fast");
                location.href = "dispositivos.php?of=" + link + "";
            }
        </script>
        <script type="text/javascript">
            jQuery.validator.addMethod("LetrasLatinas", function (value, element) {
                return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ_\s]+$/.test(value);
            });
            $.validator.setDefaults({
            });
            $().ready(function () {
                // validate signup form on keyup and submit
                $("#signupForm").validate({
                    rules: {
                        txtValor: {
                            required: true,
                            number: true,
                            minlength: 4
                        }
                    },
                    messages: {
                        txtValor: {
                            required: "Ingrese el valor",
                            number: "El campo debe tener numeros",
                            minlength: "Mínimo 4 numeros"
                        }
                    }
                });
            });
        </script>
        <script>
            function cargar(link) {
                window.open(link);
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#TablaFiltro').buscador('Filtro');
            });
        </script>
    </head>
    <body>

        <?php
        if (!isset($_SESSION["USUARIO"]) && !isset($_SESSION["ROL"])) {//valido si no existen las variables usuario y rol en la sesión
            header('location:../login/index.php'); //si no existen redirecciono a la página de login
        } else {//si existen las variables usuasrio y rol
            if ($_SESSION["ROL"] != "1") {//valido si el rol no es igual a 1 que es el correspondiente al administrador
                header('location:../login/index.php'); //redirecciono a la página de login
            }
        }
        ?>

        <div class="contenedor">

            <?php include './barra_navegacion_admin.html'; ?>

            <div class="cuerpo"> 

                <?php
                $controladorSucursales = new ControladorGestionDeSucursales();
                $controladorMueblesEnceres = new ControladorGestionDeMueblesEnseres();
                $controladorDispositivos = new ControladorGestionDeDispositivos();
                $controladorTorres = new ControladorGestionDeTorres();

                if (isset($_REQUEST['btnRegistrar'])) {
                    if (is_numeric($_REQUEST['txtValor']) && $_REQUEST['txtPuesto'] != "" && $_REQUEST['txtMarca'] != "" && $_REQUEST['txtTipo'] != "" && $_REQUEST['txtEstado'] != "") {
                        $idTipo = $_REQUEST['txtTipo'];
                        $tDto = $controladorDispositivos->verTipo($idTipo);
                        if (utf8_decode($tDto->getNombreTipo()) == "TORRE" || utf8_decode($tDto->getNombreTipo() == "CPU") || utf8_decode($tDto->getNombreTipo() == "PORTATIL") || utf8_decode($tDto->getNombreTipo() == "PORTATÍL")) {
                            $_SESSION['SERIAL'] = $_REQUEST['txtSerial'];
                            $_SESSION['MODELO'] = $_REQUEST['txtModelo'];
                            $_SESSION['VALOR'] = $_REQUEST['txtValor'];
                            $_SESSION['OBSERVACION'] = $_REQUEST['txtObservacion'];
                            $_SESSION['PUESTO'] = $_REQUEST['txtPuesto'];
                            $_SESSION['MARCA'] = $_REQUEST['txtMarca'];
                            $_SESSION['TIPO'] = $_REQUEST['txtTipo'];
                            $_SESSION['ESTADO'] = $_REQUEST['txtEstado'];
                            ?>

                            <script>
                                location.href = 'dispositivos.php?di=rd';
                            </script>

                            <?php
                        } else {
                            $idDispositivo = $controladorDispositivos->contarDispositivos();
                            if ($idDispositivo == 0) {
                                $idDispositivo = 1;
                            } else {
                                $idDispositivo += 1;
                            }
                            echo $controladorDispositivos->registrarDispositivo($idDispositivo, $_REQUEST['txtModelo'], $_REQUEST['txtSerial'], $_REQUEST['txtValor'], $_REQUEST['txtObservacion'], $_REQUEST['txtPuesto'], $_REQUEST['txtMarca'], $_REQUEST['txtTipo'], $_REQUEST['txtEstado']);
                            ?>

                            <script>
                                var segundos = 3;
                                var direccion = 'index_admin.php';
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script> 

                            <?php
                        }
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "dispositivos.php?di=r";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['btnRegistrarTorre'])) {
                    if (isset($_REQUEST['txtOffice']) && isset($_REQUEST['txtSistema']) && $_REQUEST['txtOffice'] != "" && $_REQUEST['txtSistema'] != "") {
                        $idDispositivo = $controladorDispositivos->contarDispositivos();
                        if ($idDispositivo == 0) {
                            $idDispositivo = 1;
                        } else {
                            $idDispositivo += 1;
                        }
                        $modeloNumero = $_SESSION['MODELO'];
                        $serial = $_SESSION['SERIAL'];
                        $valor = $_SESSION['VALOR'];
                        $observacion = $_SESSION['OBSERVACION'];
                        $idPuesto = $_SESSION['PUESTO'];
                        $idMarca = $_SESSION['MARCA'];
                        $idTipo = $_SESSION['TIPO'];
                        $idEstado = $_SESSION['ESTADO'];
                        $controladorDispositivos->registrarDispositivo($idDispositivo, $modeloNumero, $serial, $valor, $observacion, $idPuesto, $idMarca, $idTipo, $idEstado);
                        echo $controladorTorres->registrarTorre($idDispositivo, $_REQUEST['txtProcesador'], $_REQUEST['txtRam'], $_REQUEST['txtDisquete'], $_REQUEST['txtDisco'], $_REQUEST['txtUnidad'], $_REQUEST['txtAntivirus'], $_REQUEST['txtClaveSo'], $_REQUEST['txtClaveOf'], $_REQUEST['txtSistema'], $_REQUEST['txtOffice']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'index_admin.php';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script> 

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "dispositivos.php?di=rd";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificar'])) {
                    $oficina = "sucursales.php?su=v";
                    if (isset($_SESSION['oficina'])) {
                        $num = $_SESSION['oficina'];
                        $oficina = "dispositivos.php?of=$num";
                    }

                    if (is_numeric($_REQUEST['IdDispositivo']) && is_numeric($_REQUEST['txtValor']) && $_REQUEST['txtPuesto'] != "" && $_REQUEST['txtMarca'] != "" && $_REQUEST['txtTipo'] != "" && $_REQUEST['txtEstado'] != "") {
                        $idTipo = $_REQUEST['txtTipo'];
                        $tDto = $controladorDispositivos->verTipo($idTipo);
                        if (utf8_decode($tDto->getNombreTipo()) == "TORRE" || utf8_decode($tDto->getNombreTipo() == "CPU") || utf8_decode($tDto->getNombreTipo() == "PORTATIL") || utf8_decode($tDto->getNombreTipo() == "LAPTOP")) {
                            $_SESSION['SERIAL'] = $_REQUEST['txtSerial'];
                            $_SESSION['MODELO'] = $_REQUEST['txtModelo'];
                            $_SESSION['VALOR'] = $_REQUEST['txtValor'];
                            $_SESSION['OBSERVACION'] = $_REQUEST['txtObservacion'];
                            $_SESSION['PUESTO'] = $_REQUEST['txtPuesto'];
                            $_SESSION['MARCA'] = $_REQUEST['txtMarca'];
                            $_SESSION['TIPO'] = $_REQUEST['txtTipo'];
                            $_SESSION['ESTADO'] = $_REQUEST['txtEstado'];
                            $_SESSION['DISPOSITIVO'] = $_REQUEST['IdDispositivo'];
                            ?>

                            <script>
                                location.href = 'dispositivos.php?di=md';
                            </script>

                            <?php
                        } else {
                            echo $controladorDispositivos->modificarDispositivo($_REQUEST['IdDispositivo'], $_REQUEST['txtModelo'], $_REQUEST['txtSerial'], $_REQUEST['txtValor'], $_REQUEST['txtObservacion'], $_REQUEST['txtPuesto'], $_REQUEST['txtMarca'], $_REQUEST['txtTipo'], $_REQUEST['txtEstado']);
                            ?>

                            <script>
                                var segundos = 3;
                                var direccion = '<?php echo $oficina; ?>';
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script>

                            <?php
                        }
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "<?php echo $oficina; ?>";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificarTorre'])) {
                    $oficina = "sucursales.php?su=v";
                    if (isset($_SESSION['oficina'])) {
                        $num = $_SESSION['oficina'];
                        $oficina = "dispositivos.php?of=$num";
                    }

                    if (isset($_REQUEST['txtOffice']) && isset($_REQUEST['txtSistema']) && isset($_REQUEST['txtIdDispositivo']) && $_REQUEST['txtIdDispositivo'] != "" && $_REQUEST['txtOffice'] != "" && $_REQUEST['txtSistema'] != "") {

                        $modeloNumero = $_SESSION['MODELO'];
                        $serial = $_SESSION['SERIAL'];
                        $valor = $_SESSION['VALOR'];
                        $observacion = $_SESSION['OBSERVACION'];
                        $idPuesto = $_SESSION['PUESTO'];
                        $idMarca = $_SESSION['MARCA'];
                        $idTipo = $_SESSION['TIPO'];
                        $idEstado = $_SESSION['ESTADO'];

                        $toDto = $controladorTorres->verTorre($_REQUEST['txtIdDispositivo']);
                        $controladorDispositivos->modificarDispositivo($_REQUEST['txtIdDispositivo'], $modeloNumero, $serial, $valor, $observacion, $idPuesto, $idMarca, $idTipo, $idEstado);

                        if ($toDto != null) {
                            echo $controladorTorres->modificarTorre($_REQUEST['txtIdDispositivo'], $_REQUEST['txtProcesador'], $_REQUEST['txtRam'], $_REQUEST['txtDisquete'], $_REQUEST['txtDisco'], $_REQUEST['txtUnidad'], $_REQUEST['txtAntivirus'], $_REQUEST['txtClaveSo'], $_REQUEST['txtClaveOf'], $_REQUEST['txtSistema'], $_REQUEST['txtOffice']);
                        } else {
                            echo $controladorTorres->registrarTorre($_REQUEST['txtIdDispositivo'], $_REQUEST['txtProcesador'], $_REQUEST['txtRam'], $_REQUEST['txtDisquete'], $_REQUEST['txtDisco'], $_REQUEST['txtUnidad'], $_REQUEST['txtAntivirus'], $_REQUEST['txtClaveSo'], $_REQUEST['txtClaveOf'], $_REQUEST['txtSistema'], $_REQUEST['txtOffice']);
                        }
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = '<?php echo $oficina; ?>';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script> 

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "<?php echo $oficina; ?>";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no'])) {
                    ?>

                    <div class="ventanaEliminar">
                        <div class="mensaje" style="padding-bottom: 60px;">
                            <h2>Inventario Expertcob</h2>
                            <form method="post" action="dispositivos.php">
                                <table>
                                    <tr>
                                        <td>¿Esta seguro que desea eliminar el registro?, Se borrarán todos los mantenimientos registrados<input type="text" name="num" value="<?php echo $_REQUEST['no']; ?>" readonly="true" hidden="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="btnEliminar" value="Si">
                                            <input type="button" value="No" onclick="location.href = 'javascript:closeVentana(<?php echo $_SESSION['oficina']; ?>);';">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>

                    <?php
                } else if (isset($_REQUEST['btnEliminar'])) {
                    echo $controladorDispositivos->eliminarDispositivo($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'dispositivos.php?of=<?php echo $_SESSION['oficina']; ?>';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script>

                    <?php
                } else if (isset($_REQUEST['di'])) {
                    switch ($_REQUEST['di']) {
                        case "r": {
                                $sucursales = $controladorSucursales->verSucursales();
                                ?>

                                <form class="formPuesto" action="dispositivos.php" method="post">
                                    <h3 style="color: #6495ED; font-family: 'arial';">Registre un nuevo dispositivo</h3>
                                    <hr>
                                    <table style="margin-left: 200px;">
                                        <tr>
                                            <td><lable for="sucursal">Sucursal: </lable></td>
                                        <td><select name="sucursal" onchange="submit()">
                                                <option>Seleccionar</option>
                                                <?php
                                                foreach ($sucursales as $sDto) {
                                                    ?>
                                                    <option value = "<?php echo $sDto->getIdSucursal(); ?>" ><?php echo utf8_encode($sDto->getCiudad()); ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        </tr>
                                    </table>
                                </form>

                                <?php
                            }break;
                        case "rd": {
                                if (isset($_SESSION['MODELO']) && isset($_SESSION['SERIAL']) && isset($_SESSION['ESTADO']) && isset($_SESSION['OBSERVACION']) && isset($_SESSION['PUESTO']) && isset($_SESSION['MARCA']) && isset($_SESSION['TIPO']) && isset($_SESSION['VALOR'])) {
                                    $sistemas = $controladorTorres->verSistemasOperativos();
                                    $offices = $controladorTorres->verOffices();
                                    ?>

                                    <form class="formMueble" id="signupForm" action="dispositivos.php" method="post">
                                        <h3 style="color: #6495ED; font-family: 'arial';">Llene los datos faltantes del dispositivo</h3>
                                        <hr>
                                        <table>
                                            <tr>
                                                <td><lable for="txtOffice">Office: </lable></td>
                                            <td><select id="txtOffice" name="txtOffice">
                                                    <?php
                                                    foreach ($offices as $offDto) {
                                                        ?>
                                                        <option value="<?php echo $offDto->getIdOffice(); ?>"><?php echo utf8_encode($offDto->getNombreOffice()); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td><lable for="txtSistema">Sistema operativo: </lable></td>
                                            <td><select name="txtSistema" id="txtSistema">
                                                    <?php
                                                    foreach ($sistemas as $siDto) {
                                                        ?>
                                                        <option value="<?php echo $siDto->getIdSistemaOperativo(); ?>" ><?php echo utf8_encode($siDto->getNombreSistemaOperativo()); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <tr>
                                                <td><lable for="txtDisquete">Disquete: </lable></td>
                                            <td>
                                                <select name="txtDisquete" id="txtDisquete">
                                                    <option>SI</option>
                                                    <option>NO</option>
                                                </select>                                            
                                            </td>
                                            </tr>
                                            <tr>
                                                <td><lable for="txtUnidad">Unidad de DVD: </lable></td>
                                            <td>
                                                <select name="txtUnidad" id="txtUnidad">
                                                    <option>SI</option>
                                                    <option>NO</option>
                                                </select>                                            
                                            </td>
                                            </tr>
                                            <tr>
                                                <td><lable for="txtAntivirus">Antivirus: </lable></td>
                                            <td>
                                                <select name="txtAntivirus" id="txtAntivirus">
                                                    <option>SI</option>
                                                    <option>NO</option>
                                                </select>                                            
                                            </td>
                                            </tr>
                                            </tr>
                                            <tr>
                                                <td><lable for="txtProcesador">Procesador: </lable></td>
                                            <td>
                                                <input name="txtProcesador" id="txtProcesador" type="text" maxlength="25">
                                            </td>
                                            </tr>
                                            <tr>
                                                <td><lable for="txtRam">RAM: </lable></td>
                                            <td>
                                                <input name="txtRam" id="txtRam" type="text" maxlength="10">
                                            </td>
                                            </tr>
                                            <tr>
                                                <td><lable for="txtDisco">Capacidad del disco duro: </lable></td>
                                            <td>
                                                <input name="txtDisco" id="txtDisco" type="text" maxlength="10">
                                            </td>
                                            </tr>
                                            <tr>
                                                <td><lable for="txtClaveSo">Clave de sistema operativo: </lable></td>
                                            <td><input name="txtClaveSo" id="txtClaveSo" type="text" maxlength="29">
                                            </td>
                                            </tr>
                                            <tr>
                                                <td><lable for="txtClaveOf">Clave de Office: </lable></td>
                                            <td><input name="txtClaveOf" id="txtClaveOf" type="text" maxlength="29">
                                            </td>
                                            </tr>
                                        </table>
                                        <div class="msjObligatorio">
                                            <label>Los campos con * son obligatorios</label>
                                        </div>
                                        <input type="submit" name="btnRegistrarTorre" value="Registrar">
                                    </form>

                                    <?php
                                } else {
                                    ?>

                                    <script>
                                        location.href = "index_admin.php";
                                    </script>

                                    <?php
                                }
                            }break;
                        case "md": {
                                $oficina = "sucursales.php?su=v";
                                if (isset($_SESSION['oficina'])) {
                                    $num = $_SESSION['oficina'];
                                    $oficina = "dispositivos.php?of=$num";
                                }

                                if (isset($_SESSION['DISPOSITIVO']) && isset($_SESSION['MODELO']) && isset($_SESSION['SERIAL']) && isset($_SESSION['ESTADO']) && isset($_SESSION['OBSERVACION']) && isset($_SESSION['PUESTO']) && isset($_SESSION['MARCA']) && isset($_SESSION['TIPO']) && isset($_SESSION['VALOR'])) {
                                    $sistemas = $controladorTorres->verSistemasOperativos();
                                    $offices = $controladorTorres->verOffices();
                                    $id = $_SESSION['DISPOSITIVO'];
                                    $toDto = $controladorTorres->verTorre($id);
                                    if ($toDto != null) {
                                        $ofDto = $controladorTorres->verOffice($toDto->getIdOffice());
                                        $sopDto = $controladorTorres->verSistemaOperativo($toDto->getIdSistemaOperativo());
                                        ?>

                                        <form class="formMueble" id="signupForm" action="dispositivos.php" method="post">
                                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique los datos faltantes del dispositivo</h3>
                                            <hr>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="txtIdDispositivo" readonly="true" hidden="true" value="<?php echo $id; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtOffice">Office: </lable></td>
                                                <td><select id="txtOffice" name="txtOffice">
                                                        <option value="<?php echo $ofDto->getIdOffice(); ?>"><?php echo utf8_encode($ofDto->getNombreOffice()); ?></option>
                                                        <?php
                                                        foreach ($offices as $offDto) {
                                                            if ($ofDto->getIdOffice() != $offDto->getIdOffice()) {
                                                                ?>
                                                                <option value="<?php echo $offDto->getIdOffice(); ?>"><?php echo utf8_encode($offDto->getNombreOffice()); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtSistema">Sistema operativo: </lable></td>
                                                <td><select name="txtSistema" id="txtSistema">
                                                        <option value="<?php echo $sopDto->getIdSistemaOperativo(); ?>" ><?php echo utf8_encode($sopDto->getNombreSistemaOperativo()); ?></option>
                                                        <?php
                                                        foreach ($sistemas as $siDto) {
                                                            if ($sopDto->getIdSistemaOperativo() != $siDto->getIdSistemaOperativo()) {
                                                                ?>
                                                                <option value="<?php echo $siDto->getIdSistemaOperativo(); ?>" ><?php echo utf8_encode($siDto->getNombreSistemaOperativo()); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <tr>
                                                    <td><lable for="txtDisquete">Disquete: </lable></td>
                                                <td>
                                                    <select name="txtDisquete" id="txtDisquete">
                                                        <option><?php echo $toDto->getDisquete(); ?></option>
                                                        <?php
                                                        if ($toDto->getDisquete() == "SI") {
                                                            ?>
                                                            <option>NO</option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option>SI</option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>                                            
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtUnidad">Unidad de DVD: </lable></td>
                                                <td>
                                                    <select name="txtUnidad" id="txtUnidad">
                                                        <option><?php echo $toDto->getCdRom(); ?></option>
                                                        <?php
                                                        if ($toDto->getCdRom() == "SI") {
                                                            ?>
                                                            <option>NO</option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option>SI</option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>                                            
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtAntivirus">Antivirus: </lable></td>
                                                <td>
                                                    <select name="txtAntivirus" id="txtAntivirus">
                                                        <option><?php echo $toDto->getAntivirus(); ?></option>
                                                        <?php
                                                        if ($toDto->getAntivirus() == "SI") {
                                                            ?>
                                                            <option>NO</option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option>SI</option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>                                            
                                                </td>
                                                </tr>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtProcesador">Procesador: </lable></td>
                                                <td>
                                                    <input name="txtProcesador" id="txtProcesador" type="text" maxlength="25" value="<?php echo utf8_encode($toDto->getProcesador()); ?>">
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtRam">RAM: </lable></td>
                                                <td>
                                                    <input name="txtRam" id="txtRam" type="text" maxlength="10" value="<?php echo utf8_encode($toDto->getRam()); ?>">
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtDisco">Capacidad del disco duro: </lable></td>
                                                <td>
                                                    <input name="txtDisco" id="txtDisco" type="text" maxlength="10" value="<?php echo utf8_encode($toDto->getHdd()); ?>">
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtClaveSo">Clave de sistema operativo: </lable></td>
                                                <td><input name="txtClaveSo" id="txtClaveSo" type="text" maxlength="29" value="<?php echo utf8_encode($toDto->getSisOperativoKey()); ?>">
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtClaveOf">Clave de Office: </lable></td>
                                                <td><input name="txtClaveOf" id="txtClaveOf" type="text" maxlength="29" value="<?php echo utf8_encode($toDto->getOfficeKey()); ?>">
                                                </td>
                                                </tr>
                                            </table>
                                            <div class="msjObligatorio">
                                                <label>Los campos con * son obligatorios</label>
                                            </div>
                                            <input type="submit" name="btnModificarTorre" value="Modificar">
                                            <input type="button" onclick="location.href = '<?php echo $oficina; ?>'" value="Cancelar">
                                        </form>

                                        <?php
                                    } else {
                                        ?>

                                        <form class="formMueble" id="signupForm" action="dispositivos.php" method="post">
                                            <h3 style="color: #6495ED; font-family: 'arial';">Llene los datos faltantes del dispositivo</h3>
                                            <hr>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="txtIdDispositivo" readonly="true" hidden="true" value="<?php echo $id; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtOffice">Office: </lable></td>
                                                <td><select id="txtOffice" name="txtOffice">
                                                        <?php
                                                        foreach ($offices as $offDto) {
                                                            ?>
                                                            <option value="<?php echo $offDto->getIdOffice(); ?>"><?php echo utf8_encode($offDto->getNombreOffice()); ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtSistema">Sistema operativo: </lable></td>
                                                <td><select name="txtSistema" id="txtSistema">
                                                        <?php
                                                        foreach ($sistemas as $siDto) {
                                                            ?>
                                                            <option value="<?php echo $siDto->getIdSistemaOperativo(); ?>" ><?php echo utf8_encode($siDto->getNombreSistemaOperativo()); ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <tr>
                                                    <td><lable for="txtDisquete">Disquete: </lable></td>
                                                <td>
                                                    <select name="txtDisquete" id="txtDisquete">
                                                        <option>SI</option>
                                                        <option>NO</option>
                                                    </select>                                            
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtUnidad">Unidad de DVD: </lable></td>
                                                <td>
                                                    <select name="txtUnidad" id="txtUnidad">
                                                        <option>SI</option>
                                                        <option>NO</option>
                                                    </select>                                            
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtAntivirus">Antivirus: </lable></td>
                                                <td>
                                                    <select name="txtAntivirus" id="txtAntivirus">
                                                        <option>SI</option>
                                                        <option>NO</option>
                                                    </select>                                            
                                                </td>
                                                </tr>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtProcesador">Procesador: </lable></td>
                                                <td>
                                                    <input name="txtProcesador" id="txtProcesador" type="text" maxlength="25">
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtRam">RAM: </lable></td>
                                                <td>
                                                    <input name="txtRam" id="txtRam" type="text" maxlength="10">
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtDisco">Capacidad del disco duro: </lable></td>
                                                <td>
                                                    <input name="txtDisco" id="txtDisco" type="text" maxlength="10">
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtClaveSo">Clave de sistema operativo: </lable></td>
                                                <td><input name="txtClaveSo" id="txtClaveSo" type="text" maxlength="29">
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td><lable for="txtClaveOf">Clave de Office: </lable></td>
                                                <td><input name="txtClaveOf" id="txtClaveOf" type="text" maxlength="29">
                                                </td>
                                                </tr>
                                            </table>
                                            <div class="msjObligatorio">
                                                <label>Los campos con * son obligatorios</label>
                                            </div>
                                            <input type="submit" name="btnModificarTorre" value="Modificar">
                                            <input type="button" onclick="location.href = '<?php echo $oficina; ?>'" value="Cancelar">
                                        </form>

                                        <?php
                                    }
                                } else {
                                    ?>

                                    <script>
                                        location.href = "index_admin.php";
                                    </script>

                                    <?php
                                }
                            }break;
                        default :
                            ?>

                            <script>
                                location.href = "index_admin.php";
                            </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['sucursal']) && is_numeric($_REQUEST['sucursal'])) {
                    $sDto = $controladorSucursales->verUnaSucursal($_REQUEST['sucursal']);
                    if ($sDto != null) {
                        $oficinas = $controladorSucursales->verOficinasPorSucursal($_REQUEST['sucursal']);
                        $estados = $controladorMueblesEnceres->verEstados();
                        $tipos = $controladorDispositivos->verTipos();
                        $marcas = $controladorDispositivos->verMarcas();
                        ?>

                        <form class="formMueble" id="signupForm" action="dispositivos.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Registre un nuevo dispositivo</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td><lable for="sucursal">Sucursal: </lable></td>
                                <td><input type="text" id="sucursal" readonly="true" value="<?php echo utf8_encode($sDto->getCiudad()); ?>">
                                    <input name="sucursal" type="text" readonly="true" hidden="true" value="<?php echo $sDto->getIdSucursal(); ?>">
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtPuesto">Oficina // Puesto: </lable></td>
                                <td><select id="txtPuesto" name="txtPuesto" style="width: 230px;">
                                        <?php
                                        foreach ($oficinas as $oDto) {
                                            $puestos = $controladorSucursales->verPuestosPorNumeroDeOficina($oDto->getNumOficina());
                                            foreach ($puestos as $pDto) {
                                                ?>
                                                <option value="<?php echo $pDto->getIdPuesto(); ?>"><?php echo utf8_encode($oDto->getNombreOficina() . " // " . $pDto->getNombrePuesto()); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtTipo">Tipo de dispositivo: </lable></td>
                                <td><select name="txtTipo" id="txtTipo">
                                        <?php
                                        foreach ($tipos as $tDto) {
                                            ?>
                                            <option value="<?php echo $tDto->getIdTipo(); ?>" ><?php echo utf8_encode($tDto->getNombreTipo()); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtEstado">Estado: </lable></td>
                                <td><select name="txtEstado" id="txtEstado">
                                        <?php
                                        foreach ($estados as $eDto) {
                                            ?>
                                            <option value="<?php echo $eDto->getIdEstado(); ?>"><?php echo utf8_encode($eDto->getDescripcion()); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtMarca">Marca: </lable></td>
                                <td><select name="txtMarca" id="txtMarca">
                                        <?php
                                        foreach ($marcas as $mDto) {
                                            ?>
                                            <option value="<?php echo $mDto->getIdMarca(); ?>"><?php echo utf8_encode($mDto->getNombreMarca()); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtModelo">Número de modelo: </lable></td>
                                <td>
                                    <input name="txtModelo" id="txtModelo" type="text" maxlength="15">
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtSerial">Serial: </lable></td>
                                <td>
                                    <input name="txtSerial" id="txtSerial" type="text" maxlength="25">
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtValor">Valor: </lable></td>
                                <td><input name="txtValor" id="txtValor" type="text" maxlength="15">
                                    <label class="obligatorio"> * </label>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtObservacion">Observación: </lable></td>
                                <td>
                                    <textarea name="txtObservacion" id="txtObservacion" type="text" maxlength="80" style="width: 230px;"></textarea>
                                </td>
                                </tr>
                            </table>
                            <div class="msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" name="btnRegistrar" value="Registrar">
                        </form>

                        <?php
                    }
                } else if (isset($_REQUEST['of']) && is_numeric($_REQUEST['of'])) {
                    $dispositivos = $controladorDispositivos->verDispositivosPorOficina($_REQUEST['of']);
                    $oDto = $controladorSucursales->verUnaOficina($_REQUEST['of']);
                    if (count($dispositivos) > 0) {
                        ?>    

                        <div class = "list">
                            <h3 style="color: #6495ED; font-family: 'arial';">Listado de dispositivos</h3>
                            <div class="buscador">
                                <table>
                                    <tr>
                                        <td><label for="Filtro">Escriba algún indicio del dispositivo:</label></td>
                                        <td><input id="Filtro" name="Filtro" type="text" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                    </tr>
                                </table>
                            </div>
                            <table style="padding-top: 10px; margin: 0 auto; width: 450px;">
                                <tr>
                                    <td style="border: 2px green solid; border-radius: 4px; background-color: #3CB371; height: 30px;">
                                        <a style="color: white; text-decoration: none; font-weight: bold;" href="excel.php?of=<?php echo $_REQUEST['of']; ?>">Exportar listado a Excel</a>
                                    </td>
                                    <td style="border: 2px red solid; border-radius: 4px; background-color: #FC7E7E; height: 30px;">
                                        <a  style="color: white; text-decoration: none; font-weight: bold;" href="" onclick="cargar('pdf.php?of=<?php echo $_REQUEST['of']; ?>')">Exportar listado a PDF</a>
                                    </td>
                                </tr>
                            </table>
                            <h3>Oficina: <?php echo $oDto->getNombreOficina(); ?> </h3>
                            <div class="tabla">
                                <table id="TablaFiltro" >
                                    <thead>
                                        <tr id="encabezado">
                                            <td>Puesto</td>
                                            <td>Tipo</td>
                                            <td>Modelo</td>
                                            <td>Serial</td>
                                            <td>Valor</td>
                                            <td>Marca</td>
                                            <td>Estado</td>
                                            <td>Mantenimientos</td>
                                            <td>Modificar</td>
                                            <td>Eliminar</td>
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
                                                <td><?php echo utf8_encode($pDto->getNombrePuesto()); ?></td>
                                                <td style="font-size: 14px;"><?php echo utf8_encode($tDto->getNombreTipo()); ?></td>
                                                <td style="font-size: 13px;"><?php echo utf8_encode($dDto->getModeloNumero()); ?></td>
                                                <td style="font-size: 13px;"><?php echo utf8_encode($dDto->getSerial()); ?></td>
                                                <td><?php echo utf8_encode($dDto->getValor()); ?></td>
                                                <td style="font-size: 14px;"><?php echo utf8_encode($mDto->getNombreMarca()); ?></td>
                                                <td><?php echo utf8_encode($eDto->getDescripcion()); ?></td>
                                                <td><a href="revisiones.php?di=<?php echo $dDto->getIdDispositivo(); ?>" onclick="<?php $_SESSION['oficina'] = $_REQUEST['of']; ?>"><img alt="Ver y registrar mantenimientos" src="../resources/imagenes/Mantenimiento.png" ></a></td>
                                                <td><a href="dispositivos.php?id=<?php echo $dDto->getIdDispositivo(); ?>" onclick="<?php $_SESSION['oficina'] = $_REQUEST['of']; ?>"><img alt="Modificar dispositivo" src="../resources/imagenes/Modificar.png" ></a></td>
                                                <td><a href="dispositivos.php?no=<?php echo $dDto->getIdDispositivo(); ?>" onclick="<?php $_SESSION['oficina'] = $_REQUEST['of']; ?>"><img alt="Eliminar dispositivo" src="../resources/imagenes/Eliminar.png" ></a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div id="pageNavPosition"></div>
                                <script type="text/javascript">
                                            var pager = new Pager("TablaFiltro", 10);
                                            pager.init();
                                            pager.showPageNav("pager", "pageNavPosition");
                                            pager.showPage(1);
                                </script>
                            </div>

                            <?php
                        } else {
                            ?>

                            <div class="notificacion">
                                <div class="mensaje">
                                    <h2>Inventario Expertcob</h2>
                                    <?php echo "No hay dispositivos registrados en la oficina"; ?>
                                </div>
                            </div>
                            <script>
                                var segundos = 3;
                                var direccion = 'oficinas.php?v=<?php echo $oDto->getIdSucursal(); ?>';
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script> 

                            <?php
                        }
                        ?>

                    </div>

                    <?php
                } else if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
                    $dDto = $controladorDispositivos->verDispositivo($_REQUEST['id']);

                    $oficina = "sucursales.php?su=v";
                    if (isset($_SESSION['oficina'])) {
                        $num = $_SESSION['oficina'];
                        $oficina = "dispositivos.php?of=$num";
                    }

                    if ($dDto != null) {
                        $sucursales = $controladorSucursales->verSucursales();
                        ?>

                        <form class="formPuesto" action="dispositivos.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique el dispositivo</h3>
                            <hr>
                            <table style="margin-left: 200px;">
                                <tr>
                                    <td><lable for="sucursalM">Sucursal: </lable></td>
                                <td><select name="sucursalM" id="sucursalM" onchange="submit()">
                                        <option>Seleccionar</option>
                                        <?php
                                        foreach ($sucursales as $sDto) {
                                            ?>
                                            <option value = "<?php echo $sDto->getIdSucursal(); ?>" ><?php echo utf8_encode($sDto->getCiudad()); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="IdDispositivo" type="text" readonly="true" hidden="true" value="<?php echo $dDto->getIdDispositivo(); ?>">  
                                    </td>
                                    <td>
                                        <input type="button" onclick="location.href = '<?php echo $oficina; ?>'" value="Cancelar">
                                    </td>
                                </tr>
                            </table>
                        </form>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe dispositivo con ese id");
                            location.href = '<?php echo $oficina; ?>';
                        </script>

                        <?php
                    }
                } else if (isset($_REQUEST['sucursalM']) && isset($_REQUEST['IdDispositivo'])) {
                    $dDto = $controladorDispositivos->verDispositivo($_REQUEST['IdDispositivo']);

                    $oficina = "sucursales.php?su=v";
                    if (isset($_SESSION['oficina'])) {
                        $num = $_SESSION['oficina'];
                        $oficina = "dispositivos.php?of=$num";
                    }

                    if ($dDto != null) {
                        $oficinas = $controladorSucursales->verOficinasPorSucursal($_REQUEST['sucursalM']);
                        $estados = $controladorMueblesEnceres->verEstados();
                        $tipos = $controladorDispositivos->verTipos();
                        $marcas = $controladorDispositivos->verMarcas();
                        $puDto = $controladorSucursales->verUnPuesto($dDto->getIdPuesto());
                        $tiDto = $controladorDispositivos->verTipo($dDto->getIdTipo());
                        $maDto = $controladorDispositivos->verMarca($dDto->getIdMarca());
                        $esDto = $controladorMueblesEnceres->verEstado($dDto->getIdEstado());
                        ?>

                        <form class="formMueble" id="signupForm" action="dispositivos.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique el dispositivo</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td>
                                        <input name="IdDispositivo" type="text" readonly="true" hidden="true" value="<?php echo $dDto->getIdDispositivo(); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtPuesto">Oficina // Puesto: </lable></td>
                                <td><select id="txtPuesto" name="txtPuesto" style="width: 230px;">
                                        <?php
                                        $ofDto = $controladorSucursales->verUnaOficina($puDto->getNumOficina());
                                        ?>
                                        <option value="<?php echo $puDto->getIdPuesto(); ?>"><?php echo utf8_encode($ofDto->getNombreOficina() . " // " . $puDto->getNombrePuesto()); ?></option>
                                        <?php
                                        foreach ($oficinas as $oDto) {
                                            $puestos = $controladorSucursales->verPuestosPorNumeroDeOficina($oDto->getNumOficina());
                                            foreach ($puestos as $pDto) {
                                                if ($pDto->getIdPuesto() != $puDto->getIdPuesto()) {
                                                    ?>
                                                    <option value="<?php echo $pDto->getIdPuesto(); ?>"><?php echo utf8_encode($oDto->getNombreOficina() . " // " . $pDto->getNombrePuesto()); ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtTipo">Tipo de dispositivo: </lable></td>
                                <td><select name="txtTipo" id="txtTipo">
                                        <option value="<?php echo $tiDto->getIdTipo(); ?>" ><?php echo utf8_encode($tiDto->getNombreTipo()); ?></option>
                                        <?php
                                        foreach ($tipos as $tDto) {
                                            if ($tDto->getIdTipo() != $tiDto->getIdTipo()) {
                                                ?>
                                                <option value="<?php echo $tDto->getIdTipo(); ?>" ><?php echo utf8_encode($tDto->getNombreTipo()); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtEstado">Estado: </lable></td>
                                <td><select name="txtEstado">
                                        <option value="<?php echo $esDto->getIdEstado(); ?>"><?php echo utf8_encode($esDto->getDescripcion()); ?></option>
                                        <?php
                                        foreach ($estados as $eDto) {
                                            if ($eDto->getIdEstado() != $esDto->getIdEstado()) {
                                                ?>
                                                <option value="<?php echo $eDto->getIdEstado(); ?>"><?php echo utf8_encode($eDto->getDescripcion()); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtMarca">Marca: </lable></td>
                                <td><select name="txtMarca">
                                        <option value="<?php echo $maDto->getIdMarca(); ?>"><?php echo utf8_encode($maDto->getNombreMarca()); ?></option>
                                        <?php
                                        foreach ($marcas as $mDto) {
                                            if ($mDto->getIdMarca() != $maDto->getIdMarca()) {
                                                ?>
                                                <option value="<?php echo $mDto->getIdMarca(); ?>"><?php echo utf8_encode($mDto->getNombreMarca()); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtModelo">Número de modelo: </lable></td>
                                <td>
                                    <input name="txtModelo" id="txtModelo" type="text" maxlength="15" value="<?php echo utf8_encode($dDto->getModeloNumero()); ?>">
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtSerial">Serial: </lable></td>
                                <td>
                                    <input name="txtSerial" id="txtSerial" type="text" maxlength="25" value="<?php echo utf8_encode($dDto->getSerial()); ?>">
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtValor">Valor: </lable></td>
                                <td><input name="txtValor" id="txtValor" type="text" maxlength="15" value="<?php echo utf8_encode($dDto->getValor()); ?>">
                                    <label class="obligatorio"> * </label>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtObservacion">Observación: </lable></td>
                                <td>
                                    <textarea name="txtObservacion" id="txtObservacion" type="text" maxlength="80" style="width: 230px;"><?php echo utf8_encode($dDto->getObservacion()); ?></textarea>
                                </td>
                                </tr>
                            </table>
                            <div class="msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" name="btnModificar" value="Modificar">
                            <input type="button" onclick="location.href = '<?php echo $oficina; ?>'" value="Cancelar">
                        </form>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe dispositivo con ese id");
                            location.href = '<?php echo $oficina; ?>';
                        </script>

                        <?php
                    }
                } else {
                    ?>

                    <script>
                        location.href = "index_admin.php";
                    </script>

                    <?php
                }
                ?>

            </div>
        </div>
    </body>
</html>


