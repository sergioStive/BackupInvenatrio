<?php session_start(); //inicio de la sesión  ?>
<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
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
            function closeVentana() {
                $(".ventanaEliminar").slideUp("fast");
                location.href = "office.php?of=v";
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
                        txtOffice: {
                            required: true,
                            minlength: 3
                        }
                    },
                    messages: {
                        txtOffice: {
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
                $controlador = new ControladorGestionDeTorres();

                if (isset($_REQUEST['btnRegistrar'])) {
                    if ($_REQUEST['txtOffice'] != "") {
                        echo $controlador->registrarOffice($_REQUEST['txtOffice']);
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
                            location.href = "office?of=r";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificar'])) {
                    if ($_REQUEST['txtOffice'] != "" && is_numeric($_REQUEST['txtNumero'])) {
                        echo $controlador->modificarOffice($_REQUEST['txtNumero'], $_REQUEST['txtOffice']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'office.php?of=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script> 

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "office.php?of=v";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no'])) {
                    ?>

                    <div class="ventanaEliminar">
                        <div class="mensaje">
                            <h2>Inventario Expertcob</h2>
                            <form method="post" action="office.php">
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
                    echo $controlador->eliminarOffice($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'office.php?of=v';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script>

                    <?php
                } else if (isset($_REQUEST['of'])) {
                    switch ($_REQUEST['of']) {
                        case "r": {
                                ?>

                                <form class="formOffice" id="signupForm" action="office.php" method="post">
                                    <h3 style="color: #6495ED; font-family: 'arial';">Registre un office</h3>
                                    <hr>
                                    <table>
                                        <tr>
                                            <td><label for="txtOffice">Office:</label></td>
                                            <td><input type="text" name="txtOffice" id="txtOffice" maxlength="30">
                                                <label class="obligatorio"> *</label></td>
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
                                $offices = $controlador->verOffices();
                                if (count($offices) > 0) {
                                    ?>

                                    <div class = "list">
                                        <h3 style="color: #6495ED; font-family: 'arial';">Listado de versiones de office</h3>
                                        <div class="buscador">
                                            <table>
                                                <tr>
                                                    <td><label for="Filtro">Escriba algún indicio del office:</label></td>
                                                    <td><input id="Filtro" name="Filtro" type="text" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="tabla">
                                            <table id="TablaFiltro" >
                                                <thead>
                                                    <tr id="encabezado">
                                                        <td>Office</td>
                                                        <td>Modificar</td>
                                                        <td>Eliminar</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($offices as $oDto) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo utf8_encode($oDto->getNombreOffice()); ?></td>
                                                            <td><a href="office.php?id=<?php echo $oDto->getIdOffice(); ?>"><img alt="Modificar office" src="../resources/imagenes/Modificar.png" ></a></td>
                                                            <td><a href="office.php?no=<?php echo $oDto->getIdOffice(); ?>"><img alt="Eliminar office" src="../resources/imagenes/Eliminar.png" ></a></td>
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
                                            <?php echo "No existen versiones de office registradas"; ?>
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
                    $oDto = $controlador->verOffice($_REQUEST['id']);
                    if ($oDto != null) {
                        ?>

                        <form class="formOffice" id="signupForm" action="office.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique el office</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td></td>
                                    <td><input type="text" name="txtNumero" id="txtNumero" hidden="true" value="<?php echo $oDto->getIdOffice(); ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="txtOffice">Office:</label></td>
                                    <td><input type="text" name="txtOffice" id="txtOffice" maxlength="30" value="<?php echo utf8_encode($oDto->getNombreOffice()); ?>">
                                        <label class="obligatorio"> *</label></td>
                                </tr>
                            </table>
                            <div class="msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" value="Modificar" name="btnModificar">
                            <input type="button" name="btnCancelar" value="Cancelar" onclick="location.href = 'office.php?of=v'">
                        </form>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe una versión de office con ese id");
                            location.href = "office.php?of=v";
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
