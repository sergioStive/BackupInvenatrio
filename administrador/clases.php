<?php session_start(); //inicio de la sesión   ?>
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
                location.href = "clases.php?cl=v";
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
                        txtClase: {
                            required: true,
                            minlength: 3
                        }
                    },
                    messages: {
                        txtClase: {
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
                    if ($_REQUEST['txtClase'] != "") {
                        echo $controlador->registrarClase($_REQUEST['txtClase']);
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
                            location.href = "clases.php?cl=r";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificar'])) {
                    if ($_REQUEST['txtClase'] != "" && is_numeric($_REQUEST['txtNumero'])) {
                        echo $controlador->modificarClase($_REQUEST['txtNumero'], $_REQUEST['txtClase']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'clases.php?cl=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "clases.php?cl=v";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no'])) {
                    ?>

                    <div class="ventanaEliminar">
                        <div class="mensaje">
                            <h2>Inventario Expertcob</h2>
                            <form method="post" action="clases.php">
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
                    echo $controlador->eliminarClase($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'clases.php?cl=v';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script>

                    <?php
                } else if (isset($_REQUEST['cl'])) {
                    switch ($_REQUEST['cl']) {
                        case "r": {
                                ?>

                                <form class="formClase" id="signupForm" action="clases.php" method="post">
                                    <h3 style="color: #6495ED; font-family: 'arial';">Registre una clase de equipo</h3>
                                    <hr>
                                    <table>
                                        <tr>
                                            <td><label for="txtClase">Nombre:</label></td>
                                            <td><input type="text" name="txtClase" id="txtClase" maxlength="20">
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
                                $clases = $controlador->verClases();
                                if (count($clases) > 0) {
                                    ?>

                                    <div class = "list">
                                        <h3 style="color: #6495ED; font-family: 'arial';">Listado de clases de equipos</h3>
                                        <div class="buscador">
                                            <table>
                                                <tr>
                                                    <td><label for="Filtro">Escriba algún indicio de la clase:</label></td>
                                                    <td><input id="Filtro" name="Filtro" type="text" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="tabla">
                                            <table id="TablaFiltro" >
                                                <thead>
                                                    <tr id="encabezado">
                                                        <td>Nombre de la clase</td>
                                                        <td>Modificar</td>
                                                        <td>Eliminar</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($clases as $cDto) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo utf8_encode($cDto->getNombreClase()); ?></td>
                                                            <td><a href="clases.php?id=<?php echo $cDto->getIdClase(); ?>"><img alt="Modificar clase" src="../resources/imagenes/Modificar.png" ></a></td>
                                                            <td><a href="clases.php?no=<?php echo $cDto->getIdClase(); ?>"><img alt="Eliminar clase" src="../resources/imagenes/Eliminar.png" ></a></td>
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
                                            <?php echo "No existen clases registradas"; ?>
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
                    $cDto = $controlador->verClase($_REQUEST['id']);
                    if ($cDto != null) {
                        ?>

                        <form class="formClase" id="signupForm" action="clases.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique la clase de equipo</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td></td>
                                    <td><input type="text" name="txtNumero" id="txtNumero" hidden="true" value="<?php echo $cDto->getIdClase(); ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="txtClase">Nombre:</label></td>
                                    <td><input type="text" name="txtClase" id="txtClase" maxlength="20" value="<?php echo utf8_encode($cDto->getNombreClase()); ?>">
                                        <label class="obligatorio"> *</label></td>
                                </tr>
                            </table>
                            <div class="msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" value="Modificar" name="btnModificar">
                            <input type="button" value="Cancelar" onclick="location.href = 'clases.php?cl=v'">
                        </form>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe una clase con ese id");
                            location.href = "clases.php?cl=v";
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


