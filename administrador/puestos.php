<?php session_start(); //inicio de la sesión   ?>

<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeSucursales.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeUsuarios.php';
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
            function openVentanaEliminar() {
                $(".ventanaEliminar").slideDown("slow");
            }
            function closeVentanaEliminar(link) {
                $(".ventanaEliminar").slideUp("fast");
                location.href = 'puestos.php?of=' + link;
            }
        </script>
        <script type="text/javascript">
            function openVentana() {
                $(".ventanaRegistro").slideDown("slow");
            }
            function closeVentana() {
                $(".ventanaRegistro").slideUp("fast");
            }
        </script>
        <script type="text/javascript">
            function openVentanaM() {
                $(".ventanaModificacion").slideDown("slow");
            }
            function closeVentanaM() {
                $(".ventanaModificacion").slideUp("fast");
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
                        txtNombre: {
                            required: true,
                            minlength: 3
                        },
                        txtNombreR: {
                            required: true,
                            minlength: 3
                        },
                        txtIdentificacion: {
                            required: true,
                            number: true,
                            minlength: 7
                        }
                    },
                    messages: {
                        txtNombre: {
                            required: "Por favor ingrese el nombre",
                            minlength: "Mínimo 3 caracteres"
                        },
                        txtNombreR: {
                            required: "Por favor ingrese el nombre",
                            minlength: "Mínimo 3 caracteres"
                        },
                        txtIdentificacion: {
                            required: "Ingrese el número de documento",
                            number: "El campo debe tener números",
                            minlength: "Mínimo 7 numeros"
                        }
                    }
                });
            });
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
                $controladorUsuarios = new ControladorGestionDeUsuarios();
                $sucursales = $controladorSucursales->verSucursales();
                $responsables = $controladorUsuarios->verResponsables();
                if (isset($_REQUEST['btnRegistrar'])) {
                    if ($_REQUEST['txtNombre'] != "" && isset($_REQUEST['responsable']) && isset($_REQUEST['oficina'])) {
                        echo $controladorSucursales->registrarPuesto($_REQUEST['txtNombre'], $_REQUEST['responsable'], $_REQUEST['oficina']);
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
                            alert("Debe llenar los campos obliogatorios del formulario");
                            location.href = "puestos.php?pu=r";
                        </script>';

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificar'])) {
                    if ($_REQUEST['txtIdPuesto'] != "" && $_REQUEST['txtNombre'] != "" && $_REQUEST['responsable'] != "" && $_REQUEST['oficina'] != "") {
                        echo $controladorSucursales->modificarPuesto($_REQUEST['txtIdPuesto'], $_REQUEST['txtNombre'], $_REQUEST['responsable'], $_REQUEST['oficina']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = "puestos.php?of=<?php echo $_REQUEST['oficina']; ?>";
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obliogatorios del formulario");
                            location.href = "puestos.php?of=<?php echo $_REQUEST['oficina']; ?>";
                        </script>';

                        <?php
                    }
                } else if (isset($_REQUEST['btnRegistrarResponsable'])) {
                    if ($_REQUEST['txtNombreR'] != "" && $_REQUEST['txtIdentificacion'] != "" && is_numeric($_REQUEST['txtIdentificacion'])) {
                        echo $controladorUsuarios->registrarResponsable($_REQUEST['txtIdentificacion'], $_REQUEST['txtNombreR'], $_REQUEST['txtApellidos']);
                        if (isset($_SESSION['sucursal'])) {
                            ?>

                            <script>
                                var segundos = 3;
                                var direccion = "puestos.php?sucursal=<?php echo $_SESSION['sucursal']; ?>";
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script>

                            <?php
                        } else {
                            ?>

                            <script>
                                var segundos = 3;
                                var direccion = 'puestos.php?pu=r';
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script>

                            <?php
                        }
                    } else {
                        ?>

                        <div class="notificacion">
                            <div class="mensaje">
                                <h2>Inventario Expertcob</h2>
                                <?php echo "Debe llenar los campos obliogatorios del formulario"; ?>
                            </div>
                        </div>

                        <?php
                        if (isset($_SESSION['sucursal'])) {
                            ?>

                            <script>
                                var segundos = 3;
                                var direccion = "puestos.php?sucursal=<?php echo $_SESSION['sucursal']; ?>";
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script>

                            <?php
                        } else {
                            ?>

                            <script>
                                var segundos = 3;
                                var direccion = 'puestos.php?pu=r';
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script>

                            <?php
                        }
                    }
                } else if (isset($_REQUEST['btnRegistrarResponsableMdf'])) {
                    if ($_REQUEST['txtNombreR'] != "" && $_REQUEST['txtIdentificacion'] != "" && is_numeric($_REQUEST['txtIdentificacion'])) {
                        echo $controladorUsuarios->registrarResponsable($_REQUEST['txtIdentificacion'], $_REQUEST['txtNombreR'], $_REQUEST['txtApellidos']);
                    } else {
                        ?>

                        <div class="notificacion">
                            <div class="mensaje">
                                <h2>Inventario Expertcob</h2>
                                <?php echo "Debe llenar los campos obliogatorios del formulario"; ?>
                            </div>
                        </div>

                        <?php
                    }
                    if (isset($_SESSION['puesto'])) {
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = "puestos.php?id=<?php echo $_SESSION['puesto'] ?>";
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'sucursales.php?su=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    }
                } else if (isset($_POST['btnEliminar'])) {
                    echo $controladorSucursales->eliminarPuesto($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'sucursales.php?su=v';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script>

                    <?php
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no'])) {
                    ?>

                    <div class="ventanaEliminar">
                        <div class="mensaje" style="padding-bottom: 60px;">
                            <h2>Inventario Expertcob</h2>
                            <form method="post" action="puestos.php">
                                <table>
                                    <tr>
                                        <td>¿Esta seguro que desea eliminar el registro?, Se borrarán todos los dispositivos registrados<input type="text" name="num" value="<?php echo $_REQUEST['no']; ?>" readonly="true" hidden="true"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="btnEliminar" value="Si">
                                            <input type="button" value="No" onclick="location.href = 'javascript:closeVentanaEliminar( <?php echo $_SESSION['oficina']; ?> );';">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>

                    <?php
                } else if (isset($_REQUEST['pu'])) {
                    switch ($_REQUEST['pu']) {
                        case "r": {
                                ?>

                                <form class="formPuesto" action="puestos.php" method="post">
                                    <h3 style="color: #6495ED; font-family: 'arial';">Registre un nuevo puesto</h3>
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
                        ?>

                        <form class="formPuesto" id="signupForm" action="puestos.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Registre un nuevo puesto</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td><lable for="sucursal">Sucursal: </lable></td>
                                <td><input type="text" id="sucursal" readonly="true" value="<?php echo utf8_encode($sDto->getCiudad()); ?>">
                                    <input name="sucursal" type="text" readonly="true" hidden="true" value="<?php echo $sDto->getIdSucursal(); ?>">
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtNombre">Nombre: </lable></td>
                                <td><input name="txtNombre" id="txtNombre" type="text" maxlength="20">
                                    <label class="obligatorio"> * </label>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="responsable">Responsable: </lable></td>
                                <td><select name="responsable">
                                        <?php foreach ($responsables as $rDto) { ?>
                                            <option value="<?php echo $rDto->getNumeroDocumento(); ?>"><?php echo utf8_encode($rDto->getNombre()) . " " . utf8_encode($rDto->getApellido()); ?></option>
                                        <?php } ?>
                                    </select>
                                    <a href="javascript:openVentana();" onclick="<?php $_SESSION['sucursal'] = $_REQUEST['sucursal']; ?>" class="link">Nuevo responsable</a>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="oficina">Oficina: </lable></td>
                                <td><select name="oficina">
                                        <?php foreach ($oficinas as $oDto) { ?>
                                            <option value="<?php echo $oDto->getNumOficina(); ?>"><?php echo utf8_encode($oDto->getNombreOficina()); ?></option>
                                        <?php } ?>
                                    </select>
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
                    $puestos = $controladorSucursales->verPuestosPorNumeroDeOficina($_REQUEST['of']);
                    $oDto = $controladorSucursales->verUnaOficina($_REQUEST['of']);
                    if (count($puestos) > 0) {
                        ?>    

                        <div class = "list">
                            <h3 style="color: #6495ED; font-family: 'arial';">Listado de puestos</h3>
                            <div class="buscador">
                                <table>
                                    <tr>
                                        <td><label for="Filtro">Escriba algún indicio del puesto:</label></td>
                                        <td><input id="Filtro" name="Filtro" type="text" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tabla">
                                <table id="TablaFiltro" >
                                    <thead>
                                        <tr id="encabezado">
                                            <td>Nombre del puesto</td>
                                            <td>Oficina</td>
                                            <td>Responsable</td>
                                            <td>Modificar</td>
                                            <td>Eliminar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($puestos as $pDto) {
                                            $oDto = $controladorSucursales->verUnaOficina($pDto->getNumOficina());
                                            $rDto = $controladorUsuarios->verUnResponsable($pDto->getIdResponsable());
                                            ?>
                                            <tr>
                                                <td><?php echo utf8_encode($pDto->getNombrePuesto()); ?></td>
                                                <td><?php echo utf8_encode($oDto->getNombreOficina()); ?></td>
                                                <td><?php echo utf8_encode($rDto->getNombre() . " " . $rDto->getApellido()); ?></td>
                                                <td><a href="puestos.php?id=<?php echo $pDto->getIdPuesto(); ?>"><img alt="Modificar puesto" src="../resources/imagenes/Modificar.png" ></a></td>
                                                <td><a href="puestos.php?no=<?php echo $pDto->getIdPuesto(); ?>" onclick="<?php $_SESSION['oficina'] = $pDto->getNumOficina(); ?>"><img alt="Eliminar puesto" src="../resources/imagenes/Eliminar.png" ></a></td>
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
                                    <?php echo "No hay puestos registrados en la oficina"; ?>
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
                    $pDto = $controladorSucursales->verUnPuesto($_REQUEST['id']);
                    if ($pDto != null) {
                        $ofDto = $controladorSucursales->verUnaOficina($pDto->getNumOficina());
                        $reDto = $controladorUsuarios->verUnResponsable($pDto->getIdResponsable());
                        $responsables = $controladorUsuarios->verResponsables();
                        $oficinas = $controladorSucursales->verOficinasPorSucursal($ofDto->getIdSucursal());
                        ?>

                        <form class="formPuesto" id="signupForm" method="post" action="puestos.php">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique el puesto</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td></td>
                                    <td><input name="txtIdPuesto" id="txtIdPuesto" type="text" maxlength="10" readonly="true" value="<?php echo $pDto->getIdPuesto(); ?>" hidden="true">
                                    </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtNombre">Nombre: </lable></td>
                                <td><input name="txtNombre" id="txtNombre" type="text" maxlength="20" value="<?php echo $pDto->getNombrePuesto(); ?>">
                                    <label class="obligatorio"> * </label>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="responsable">Responsable: </lable></td>
                                <td><select name="responsable">
                                        <option value="<?php echo $reDto->getNumeroDocumento(); ?>"><?php echo utf8_encode($reDto->getNombre()) . " " . utf8_encode($reDto->getApellido()); ?></option>
                                        <?php
                                        foreach ($responsables as $rDto) {
                                            if ($reDto->getNumeroDocumento() != $rDto->getNumeroDocumento()) {
                                                ?>
                                                <option value="<?php echo $rDto->getNumeroDocumento(); ?>"><?php echo utf8_encode($rDto->getNombre()) . " " . utf8_encode($rDto->getApellido()); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <a href="javascript:openVentanaM();" onclick="<?php $_SESSION['puesto'] = $pDto->getIdPuesto(); ?>" class="link">Nuevo responsable</a>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="oficina">Oficina: </lable></td>
                                <td><select name="oficina">
                                        <option value="<?php echo $ofDto->getNumOficina(); ?>"><?php echo utf8_encode($ofDto->getNombreOficina()); ?></option>
                                        <?php
                                        foreach ($oficinas as $oDto) {
                                            if ($ofDto->getNumOficina() != $oDto->getNumOficina()) {
                                                ?>
                                                <option value="<?php echo $oDto->getNumOficina(); ?>"><?php echo utf8_encode($oDto->getNombreOficina()); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                            </table>
                            <div class="msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" name="btnModificar" value="Modificar">
                            <input type="button" name="btnCancelar" value="Cancelar" onclick="location.href = 'puestos.php?of=<?php echo $pDto->getNumOficina(); ?>'">
                        </form>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe un puesto con ese número de id");
                            location.href = "sucursales.php?su=v";
                        </script>

                        <?php
                    }
                } else {
                    ?>

                    <script>location.href = "index_admin.php";</script>

                    <?php
                }
                ?>

                <div class="ventanaRegistro">
                    <form class="formPuesto" id="signupForm" method="post" action="puestos.php" style="padding: 10px;top: 50%;left: 50%;position: absolute;margin-left: -360px;margin-top: -170px;">
                        <a id="cerrar" href="javascript:closeVentana();">Cancelar</a>
                        <h3 style="color: #6495ED; font-family: 'arial';">Registre un nuevo responsable </h3>
                        <hr>
                        <table>
                            <tr>
                                <td><label for="txtIdentificacion">Número de documento: </label></td>
                                <td><input name="txtIdentificacion" id="txtIdentificacion" type="text">
                                    <label class="obligatorio"> * </label>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="txtNombreR">Nombres: </label></td>
                                <td><input name="txtNombreR" id="txtNombreR" type="text" maxlength="20">
                                    <label class="obligatorio"> * </label>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="txtApellidos">Apellidos: </label></td>
                                <td><input name="txtApellidos" id="txtApellidos" type="text" maxlength="20"></td>
                            </tr>
                        </table>
                        <div class="msjObligatorio">
                            <label>Los campos con * son obligatorios</label>
                        </div>
                        <input type="submit" name="btnRegistrarResponsable" value="Registrar">
                    </form>
                </div>

                <div class="ventanaModificacion">
                    <form class="formPuesto" id="signupForm" method="post" action="puestos.php" style="padding: 10px;top: 50%;left: 50%;position: absolute;margin-left: -360px;margin-top: -170px;">
                        <a id="cerrar" href="javascript:closeVentanaM();">Cancelar</a>
                        <h3 style="color: #6495ED; font-family: 'arial';">Registre un nuevo responsable </h3>
                        <hr>
                        <table>
                            <tr>
                                <td><label for="txtIdentificacion">Número de documento: </label></td>
                                <td><input name="txtIdentificacion" id="txtIdentificacion" type="text">
                                    <label class="obligatorio"> * </label>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="txtNombreR">Nombres: </label></td>
                                <td><input name="txtNombreR" id="txtNombreR" type="text" maxlength="20">
                                    <label class="obligatorio"> * </label>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="txtApellidos">Apellidos: </label></td>
                                <td><input name="txtApellidos" id="txtApellidos" type="text" maxlength="20"></td>
                            </tr>
                        </table>
                        <div class="msjObligatorio">
                            <label>Los campos con * son obligatorios</label>
                        </div>
                        <input type="submit" name="btnRegistrarResponsableMdf" value="Registrar">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
