<?php session_start(); //inicio de sesión  ?>
<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeUsuarios.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeSucursales.php';
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
                location.href = "responsables.php?re=v";
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
                $controlador = new ControladorGestionDeUsuarios();
                $controladorSucursales = new ControladorGestionDeSucursales();

                if (isset($_REQUEST['btnModificar'])) {
                    if ($_REQUEST['txtNombre'] != "" && $_REQUEST['txtIdentificacion'] != "") {
                        echo $controlador->modificarResponsable($_REQUEST['txtIdentificacion'], $_REQUEST['txtNombre'], $_REQUEST['txtApellidos']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'responsables.php?re=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script> 

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "responsables.php?re=v";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no'])) {
                    $puestos = $controladorSucursales->verPuestosPorIdDeResponsable($_REQUEST['no']);
                    if (count($puestos) > 0) {
                        ?>

                        <div class="notificacion">
                            <div class="mensaje">
                                <h2>Inventario Expertcob</h2>
                                <?php echo "No se puede eliminar el responsable porque tiene a su nombre puestos de trabajo"; ?>
                                </table>
                            </div>
                        </div>
                        <script>
                            var segundos = 3;
                            var direccion = 'responsables.php?re=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script> 

                        <?php
                    } else {
                        ?>
                        <div class="ventanaEliminar">
                            <div class="mensaje">
                                <h2>Inventario Expertcob</h2>
                                <form method="post" action="responsables.php">
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
                    }
                } else if (isset($_REQUEST['btnEliminar'])) {
                    echo $controlador->eliminarResponsable($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'responsables.php?re=v';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script> 

                    <?php
                } else if (isset($_REQUEST['re'])) {
                    switch ($_REQUEST['re']) {
                        case "v": {
                                $responsables = $controlador->verResponsables();
                                if (count($responsables) > 0) {
                                    ?>    

                                    <div class = "list">
                                        <h3 style="color: #6495ED; font-family: 'arial';">Listado de responsables</h3>
                                        <div class="buscador">
                                            <table>
                                                <tr>
                                                    <td><label for="Filtro">Escriba algún indicio del responsable:</label></td>
                                                    <td><input id="Filtro" name="Filtro" type="text" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="tabla">
                                            <table id="TablaFiltro" >
                                                <thead>
                                                    <tr id="encabezado">
                                                        <td>Número de documento</td>
                                                        <td>Nombres</td>
                                                        <td>Apellidos</td>
                                                        <td>Modificar</td>
                                                        <td>Eliminar</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($responsables as $rDto) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $rDto->getNumeroDocumento(); ?></td>
                                                            <td><?php echo utf8_encode($rDto->getNombre()); ?></td>
                                                            <td><?php echo utf8_encode($rDto->getApellido()); ?></td>
                                                            <td><a href="responsables.php?id=<?php echo $rDto->getNumeroDocumento(); ?>"><img alt="Modificar usuario" src="../resources/imagenes/Modificar.png" ></a></td>
                                                            <td><a href="responsables.php?no=<?php echo $rDto->getNumeroDocumento(); ?>"><img alt="Eliminar usuario" src="../resources/imagenes/Eliminar.png" ></a></td>
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
                                                <?php echo "No existen responsables registrados"; ?>
                                                </table>
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
                                    ?>

                                </div>

                                <?php
                            }break;
                        default :
                            ?>

                            <script>
                                location.href = "index_admin.php";
                            </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
                    $reDto = $controlador->verUnResponsable($_REQUEST['id']);
                    if ($reDto != null) {
                        ?>

                        <form class="formPuesto" id="signupForm" method="post" action="responsables.php">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique el responsable </h3>
                            <hr>
                            <table>
                                <tr>
                                    <td><label for="txtIdentificacion">Número de documento: </label></td>
                                    <td><input name="txtIdentificacion" id="txtIdentificacion" type="text" readonly="true" value="<?php echo $reDto->getNumeroDocumento(); ?>">
                                        <label class="obligatorio"> * </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="txtNombre">Nombres: </label></td>
                                    <td><input name="txtNombre" id="txtNombreR" type="text" maxlength="20" value="<?php echo utf8_encode($reDto->getNombre()); ?>">
                                        <label class="obligatorio"> * </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="txtApellidos">Apellidos: </label></td>
                                    <td><input name="txtApellidos" id="txtApellidos" type="text" maxlength="20" value="<?php echo utf8_encode($reDto->getApellido()); ?>"></td>
                                </tr>
                            </table>
                            <div class="msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" name="btnModificar" value="Modificar">
                            <input type="button" name="btnCancelar" value="Cancelar" onclick="location.href = 'responsables.php?re=v'">
                        </form

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe un responsable con ese número de documento");
                            location.href = "responsables.php?re=v";
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
