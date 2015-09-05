<?php session_start(); //inicio de sesión  ?>
<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeDispositivos.php';
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
            function closeVentana() {
                $(".ventanaEliminar").slideUp("fast");
                location.href = "tipos.php?ti=v";
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
                        txtTipo: {
                            required: true,
                            minlength: 3
                        }
                    },
                    messages: {
                        txtTipo: {
                            required: "Por favor ingrese el nombre",
                            minlength: "Mínimo 3 caracteres"
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
                $controlador = new ControladorGestionDeDispositivos();

                if (isset($_REQUEST['btnRegistrar'])) {
                    if ($_REQUEST['txtTipo'] != "" && $_REQUEST['txtClase'] != "") {
                        echo $controlador->registrarTipo($_REQUEST['txtTipo'], $_REQUEST['txtClase']);
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
                            location.href = "tipos.php?ti=r";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificar'])) {
                    if ($_REQUEST['txtTipo'] != "" && is_numeric($_REQUEST['txtNumero']) && $_REQUEST['txtClase'] != "") {
                        echo $controlador->modificarTipo($_REQUEST['txtNumero'], $_REQUEST['txtTipo'], $_REQUEST['txtClase']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'tipos.php?ti=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "tipos.php?ti=v";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no'])) {
                    ?>

                    <div class="ventanaEliminar">
                        <div class="mensaje">
                            <h2>Inventario Expertcob</h2>
                            <form method="post" action="tipos.php">
                                <table>
                                    <tr>
                                        <td>¿Esta seguro que desea eliminar el registro?<input type="text" name="num" value="<?php echo $_REQUEST['no']; ?>" readonly="true" hidden="true"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="btnEliminar" value="Si">
                                            <input type="button" value="No" onclick="location.href = 'javascript:closeVentana();';">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>

                    <?php
                } else if (isset($_REQUEST['btnEliminar'])) {
                    echo $controlador->eliminarTipo($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'tipos.php?ti=v';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script>

                    <?php
                } else if (isset($_REQUEST['ti'])) {
                    switch ($_REQUEST['ti']) {
                        case "r": {
                                $clases = $controlador->verClases();
                                ?>

                                <form class="formTipo" id="signupForm" action="tipos.php" method="post">
                                    <h3 style="color: #6495ED; font-family: 'arial';">Registre un tipo de dispositivo o periférico</h3>
                                    <hr>
                                    <table>
                                        <tr>
                                            <td><label for="txtTipo">Tipo de dispositivo:</label></td>
                                            <td><input type="text" name="txtTipo" id="txtTipo" maxlength="20">
                                                <label class="obligatorio"> *</label></td>
                                        </tr>
                                        <tr>
                                            <td><label for="txtClase">Clase de equipo:</label></td>
                                            <td>
                                                <select id="txtClase" name="txtClase">
                                                    <?php
                                                    foreach ($clases as $cDto) {
                                                        ?>
                                                        <option value="<?php echo $cDto->getIdClase(); ?>"><?php echo utf8_encode($cDto->getNombreClase()); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="msjObligatorio">
                                        <label>Los campos con * son obligatorios</label>
                                    </div>
                                    <input type="submit" value="Registrar" name="btnRegistrar">
                                </form>

                                <?php
                            }break;
                        case "v": {
                                $tipos = $controlador->verTipos();
                                if (count($tipos) > 0) {
                                    ?>

                                    <div class = "list">
                                        <h3 style="color: #6495ED; font-family: 'arial';">Listado de tipos de dispositivos y perifericos</h3>
                                        <div class="buscador">
                                            <table>
                                                <tr>
                                                    <td><label for="Filtro">Escriba algún indicio del tipo:</label></td>
                                                    <td><input id="Filtro" name="Filtro" type="text" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="tabla">
                                            <table id="TablaFiltro" >
                                                <thead>
                                                    <tr id="encabezado">
                                                        <td>Tipo de dispositivo</td>
                                                        <td>Clase de equipo</td>
                                                        <td>Modificar</td>
                                                        <td>Eliminar</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($tipos as $tDto) {
                                                        $cDto = $controlador->verClase($tDto->getIdClase());
                                                        ?>
                                                        <tr>
                                                            <td><?php echo utf8_encode($tDto->getNombreTipo()); ?></td>
                                                            <td><?php echo utf8_encode($cDto->getNombreClase()); ?></td>
                                                            <td><a href="tipos.php?id=<?php echo $tDto->getIdTipo(); ?>"><img alt="Modificar tipo" src="../resources/imagenes/Modificar.png" ></a></td>
                                                            <td><a href="tipos.php?no=<?php echo $tDto->getIdTipo(); ?>"><img alt="Eliminar tipo" src="../resources/imagenes/Eliminar.png" ></a></td>
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
                                    </div>
                                    <?php
                                } else {
                                    ?>

                                    <div class="notificacion">
                                        <div class="mensaje">
                                            <h2>Inventario Expertcob</h2>
                                            <?php echo "No existen tipos registrados"; ?>
                                        </div>
                                    </div>
                                    <script>
                                        var segundos = 3;
                                        var direccion = 'index_admin.php';
                                        milisegundos = segundos * 1000;
                                        window.setTimeout("window.location.replace(direccion);", milisegundos);
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
                } else if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
                    $tDto = $controlador->verTipo($_REQUEST['id']);
                    if ($tDto != null) {
                        $clases = $controlador->verClases();
                        $clDto = $controlador->verClase($tDto->getIdClase());
                        ?>

                        <form class="formTipo" id="signupForm" action="tipos.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique el tipo de dispositivo o priférico</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td></td>
                                    <td><input type="text" name="txtNumero" id="txtNumero" hidden="true" value="<?php echo $tDto->getIdTipo(); ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="txtTipo">Tipo de dispositivo:</label></td>
                                    <td><input type="text" name="txtTipo" id="txtTipo" maxlength="20" value="<?php echo utf8_encode($tDto->getNombreTipo()); ?>">
                                        <label class="obligatorio"> *</label></td>
                                </tr>
                                <tr>
                                    <td><label for="txtClase">Clase de equipo:</label></td>
                                    <td> 
                                        <select id="txtClase" name="txtClase">
                                            <option value="<?php echo $clDto->getIdClase(); ?>"><?php echo utf8_encode($clDto->getNombreClase()); ?></option>
                                            <?php
                                            foreach ($clases as $cDto) {
                                                if ($clDto->getIdClase() != $cDto->getIdClase()) {
                                                    ?>
                                                    <option value="<?php echo $cDto->getIdClase(); ?>"><?php echo utf8_encode($cDto->getNombreClase()); ?></option>
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
                            <input type="submit" value="Modificar" name="btnModificar">
                            <input type="button" value="Cancelar" onclick="location.href = 'tipos.php?ti=v'">
                        </form>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe un tipo con ese id");
                            location.href = "tipos.php?ti=v";
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
