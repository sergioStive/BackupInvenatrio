<?php session_start(); //inicio de sesión  ?>
<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
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
                location.href = "sucursales.php?su=v";
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
                        txtCiudad: {
                            required: true,
                            minlength: 3,
                            LetrasLatinas: true
                        }
                    },
                    messages: {
                        txtCiudad: {
                            required: "Por favor ingrese la ciudad",
                            minlength: "Mínimo 3 caracteres",
                            LetrasLatinas: "Solo letras"
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

                if (isset($_REQUEST['btnRegistrar'])) {
                    if ($_REQUEST['txtCiudad'] != "") {
                        echo $controladorSucursales->registrarSucursal($_REQUEST['txtCiudad'], $_REQUEST['txtTelefono'], $_REQUEST['txtDireccion']);
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
                            location.href = "sucursales.php?su=r";
                        </script>

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificar'])) {
                    if ($_REQUEST['txtId'] != "" && $_REQUEST['txtCiudad'] != "") {
                        echo $controladorSucursales->modificarSucursal($_REQUEST['txtId'], $_REQUEST['txtCiudad'], $_REQUEST['txtTelefono'], $_REQUEST['txtDireccion']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'sucursales.php?su=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "sucursales.php?su=v";
                        </script>;

                        <?php
                    }
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no'])) {
                    $oficinas = $controladorSucursales->verOficinasPorSucursal($_REQUEST['no']);
                    if (count($oficinas) > 0) {
                        ?>

                        <div class="notificacion">
                            <div class="mensaje">
                                <h2>Inventario Expertcob</h2>
                                <?php echo "No se puede eliminar la sucursal porque hay oficinas"; ?>
                            </div>
                        </div>
                        <script>
                            var segundos = 3;
                            var direccion = 'sucursales.php?su=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <div class="ventanaEliminar">
                            <div class="mensaje">
                                <h2>Inventario Expertcob</h2>
                                <form method="post" action="sucursales.php">
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
                    echo $controladorSucursales->eliminarSucursal($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'sucursales.php?su=v';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script>

                    <?php
                } else if (isset($_REQUEST['su'])) {
                    switch ($_REQUEST['su']) {
                        case "r": {
                                ?>

                                <form class="formRegistrarSucursal" id="signupForm" action="sucursales.php" method="post">
                                    <h3 style="color: #6495ED; font-family: 'arial';">Registre una nueva sucursal</h3>
                                    <hr>

                                    <table>
                                        <tr>
                                            <td><label for="txtCiudad">Ciudad: </label></td>
                                            <td><input name="txtCiudad" id="txtCiudad" type="text" maxlength="15">
                                                <label class="obligatorio"> * </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="txtDireccion">Dirección: </label></td>
                                            <td><input name="txtDireccion" id="txtDireccion" type="text" maxlength="20">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="txtTelefono">Teléfono: </label></td>
                                            <td><input name="txtTelefono" id="txtTelefono" type="text" maxlength="25"></td>
                                        </tr>
                                    </table>
                                    <div class="msjObligatorio">
                                        <label>Los campos con * son obligatorios</label>
                                    </div>
                                    <input type="submit" name="btnRegistrar" value="Registrar">
                                </form>

                                <?php
                            }break;
                        case "v": {
                                $listado = $controladorSucursales->verSucursales();
                                if (count($listado) > 0) {
                                    ?>    

                                    <div class = "list">
                                        <h3 style="color: #6495ED; font-family: 'arial';">Listado de sucursales</h3>
                                        <div class="buscador">
                                            <table>
                                                <tr>
                                                    <td><label for="Filtro">Escriba algún indicio de la sucursal:</label></td>
                                                    <td><input type="text" id="Filtro" name="Filtro" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="tabla">
                                            <table id="TablaFiltro">
                                                <thead>
                                                    <tr id="encabezado">
                                                        <td>Ciudad</td>
                                                        <td>Dirección</td>
                                                        <td>Teléfono</td>
                                                        <td>Oficinas</td>
                                                        <td>Modificar</td>
                                                        <td>Eliminar</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($listado as $sDto) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo utf8_encode($sDto->getCiudad()); ?></td>
                                                            <td><?php echo $sDto->getDireccion(); ?></td>
                                                            <td><?php echo $sDto->getTelefono(); ?></td>
                                                            <td><a href="oficinas.php?v=<?php echo $sDto->getIdSucursal(); ?>"><img alt="Ver oficinas" src="../resources/imagenes/Escritorio.png" ></a></td>
                                                            <td><a href="sucursales.php?id=<?php echo $sDto->getIdSucursal(); ?>"><img alt="Modificar sucursal" src="../resources/imagenes/Modificar.png" ></a></td>
                                                            <td><a href="sucursales.php?no=<?php echo $sDto->getIdSucursal(); ?>"><img alt="Eliminar sucursal" src="../resources/imagenes/Eliminar.png" ></a></td>
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
                                                <?php echo "No existen sucursales registradas"; ?>
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
                    $sDto = $controladorSucursales->verUnaSucursal($_REQUEST['id']);
                    if ($sDto != null) {
                        ?>

                        <form class="formRegistrarSucursal" id="signupForm" action="sucursales.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique la sucursal</h3>
                            <hr>

                            <table>
                                <tr>
                                    <td><label for="txtId">Número: </label></td>
                                    <td><input name="txtId" id="txtId" type="text" value="<?php echo $sDto->getIdSucursal(); ?>" readonly="true">
                                        <label class="obligatorio"> * </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="txtCiudad">Ciudad: </label></td>
                                    <td><input name="txtCiudad" id="txtCiudad" type="text" value="<?php echo utf8_encode($sDto->getCiudad()); ?>" maxlength="15">
                                        <label class="obligatorio"> * </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="txtDireccion">Dirección: </label></td>
                                    <td><input name="txtDireccion" id="txtDireccion" type="text" value="<?php echo utf8_encode($sDto->getDireccion()); ?>" maxlength="20"></td>
                                </tr>
                                <tr>
                                    <td><label for="txtTelefono">Teléfono: </label></td>
                                    <td><input name="txtTelefono" id="txtTelefono" type="text" value="<?php echo $sDto->getTelefono(); ?>" maxlength="25"></td>
                                </tr>
                            </table>
                            <div class="msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" name="btnModificar" value="Modificar">
                            <input type="button" name="btnCancelar" value="Cancelar" onclick="location.href = 'sucursales.php?su=v'">
                        </form>
                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe una sucursal con ese número de id");
                            location.href = "sucursales.php?su=v";
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
